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
                <a href="#collapseCardExample" class="d-block card-header py-3" data-toggle="collapse" role="button"
                    aria-expanded="true" aria-controls="collapseCardExample">
                    <h6 class="m-0 font-weight-bold text-primary">List Keuangan</h6>
                </a>

                <!-- Card Content - Collapse -->
                <div class="collapse show" id="collapseCardExample">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table" id="tableKeuangan">
                                <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Uang Masuk</th>
                                        <th scope="col">Tanggal</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $iteration = 1; ?>
                                    <?php foreach($data['uang_masuk'] as $keuangan): ?>

                                    <tr>
                                        <th scope="row"><?= $iteration ?></th>
                                        <td>Rp <?= number_format($keuangan['total_amount'], 3, '.', ',') ?></td>
                                        <td><?= $keuangan['transaction_date'] ?></td>
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
        $('#tableKeuangan').DataTable({
            dom: 'Bfrtip',
            buttons: [
                'excel', 'pdf', 'print'
            ],
        });
    });
</script>