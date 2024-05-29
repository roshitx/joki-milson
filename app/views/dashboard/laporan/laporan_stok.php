<?php
if (!isset($_SESSION['user_id'])) {
    header('Location:' . BASE_URL . '/login');
    exit();
}
?>

<?php
require __DIR__ . '/../../templates/sidebar.php';
?>

<!-- Content Wrapper -->
<div id="content-wrapper" class="d-flex flex-column">
    <!-- Main Content -->
    <div id="content">

        <?php
        require __DIR__ . '/../../templates/topbar.php'
        ?>

        <!-- Begin Page Content -->
        <div class="container-fluid">

            <!-- Collapsable Card Example -->
            <div class="card shadow mb-4">
                <!-- Card Header - Accordion -->
                <a href="#collapseCardExample" class="d-block card-header py-3" data-toggle="collapse" role="button" aria-expanded="true" aria-controls="collapseCardExample">
                    <h6 class="m-0 font-weight-bold text-primary">List Stok Bahan</h6>
                </a>

                <!-- Card Content - Collapse -->
                <div class="collapse show" id="collapseCardExample">
                    <div class="card-body">
                    <div class="mb-3">
                            <form action="<?= BASE_URL ?>/laporan/stok" method="post">
                            <div class="row">
                                    <div class="col-md-2">
                                        <label for="start_date">Start Date</label>
                                        <input type="date" name="start_date" id="start_date" class="form-control">
                                    </div>

                                    <div class="col-md-2">
                                        <label for="end_date">End Date</label>
                                        <input type="date" name="end_date" id="end_date" class="form-control">
                                    </div>

                                    <div class="col-md-2 align-self-end">
                                        <button type="submit" class="btn btn-primary" id="filterBtn"><i
                                                class="fa-solid fa-filter"></i> Filter</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="table-responsive">
                            <table class="table" id="reportTable">
                                <thead>

                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Item</th>
                                        <th scope="col">Stok Awal</th>
                                        <th scope="col">Stok Akhir</th>
                                        <th scope="col">Tanggal Masuk</th>
                                        <th scope="col">Tanggal Keluar</th>
                                        <!-- Add more columns as needed -->
                                    </tr>

                                </thead>
                                <tbody>
                                    <?php $iteration = 1; ?>
                                    <?php foreach ($data['stok'] as $item) : ?>
                                        <?php
                                            if (!is_null($item['sisa_stok_tanggal'])) {
                                                $formatted_tanggal_keluar = date('d M Y', strtotime($item['sisa_stok_tanggal']));
                                              } else {
                                                $formatted_tanggal_keluar = '-';
                                              }
                                        ?>
                                        <tr>
                                            <td><?= $iteration ?></td>
                                            <td><?= $item['nama_item'] ?></td>
                                            <td><?= $item['satuan'] ?> <?= $item['type'] ?></td>
                                            <td><?= $item['satuan'] ?> <?= $item['type'] ?></td>
                                            <td><?= date('H:i:s, j F Y', strtotime($item['tanggal'])) ?></td>
                                            <td><?= $formatted_tanggal_keluar ?></td>
                                        </tr>
                                        <?php $iteration++ ?>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

        </div>
        <!-- /.container-fluid -->
    </div>
    <!-- End of Main Content -->
    <!-- Footer -->
    <footer class="sticky-footer bg-white">
        <div class="container my-auto">
            <div class="copyright text-center my-auto">
                <span>Copyright &copy; <?= WEB_NAME ?></span>
            </div>
        </div>
    </footer>
    <!-- End of Footer -->

</div>
<!-- End of Content Wrapper -->
<script>
    <?php Flasher::flash(); ?>
    $(document).ready(function() {
        $('#reportTable').DataTable({
            dom: 'Bfrtip',
            buttons: [
                'excel', 'pdf', 'print'
            ],
        });
    });
</script>