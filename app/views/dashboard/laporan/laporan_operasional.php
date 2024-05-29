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
                    <h6 class="m-0 font-weight-bold text-primary">List Biaya Operasional & Pengeluaran</h6>
                </a>

                <!-- Card Content - Collapse -->
                <div class="collapse show" id="collapseCardExample">
                    <div class="card-body">
                        <div class="mb-3">
                            <form action="<?= BASE_URL ?>/laporan/operasional" method="post">
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
                                        <button type="submit" class="btn btn-primary" id="filterBtn"><i class="fa-solid fa-filter"></i> Filter</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="table-responsive">
                            <table class="table" id="reportTable">
                                <thead>

                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Tanggal</th>
                                        <th scope="col">Tipe Pengeluaran</th>
                                        <th scope="col">Deskripsi</th>
                                        <th scope="col">Total Biaya</th>
                                    </tr>

                                </thead>
                                <tbody>
                                    <?php $iteration = 1; ?>
                                    <?php foreach ($data['pengeluaran'] as $item) : ?>
                                        <tr>
                                            <td><?= $iteration ?></td>
                                            <td><?= date('H:i:s, j F Y', strtotime($item['date'])) ?></td>
                                            <td><?= $item['type'] ?></td>
                                            <td><?= $item['description'] ?></td>
                                            <td>Rp <?= $item['amount'] ?></td>
                                        </tr>
                                        <?php $iteration++ ?>
                                    <?php endforeach; ?>
                                    <tr>
                                        <?php
                                        $total_amount = floatval($data['omset_penjualan']['total_amount']);
                                        $total_pengeluaran = $data['omset_penjualan']['total_pengeluaran'];
                                        ?>
                                        <td colspan="4">Hasil omset - pengeluaran</td>
                                        <td>Rp <?= $total_amount - $total_pengeluaran ?></td>
                                    </tr>
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