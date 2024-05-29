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
                    <h6 class="m-0 font-weight-bold text-primary">List Omset Penjualan</h6>
                </a>

                <!-- Card Content - Collapse -->
                <div class="collapse show" id="collapseCardExample">
                    <div class="card-body">
                        <div class="mb-3">
                            <form action="<?= BASE_URL ?>/laporan/omset" method="post">
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
                                        <th scope="col" class="text-center">#</th>
                                        <th scope="col" class="text-center">Tanggal</th>
                                        <th scope="col" class="text-center">Total Omset Penjualan</th>
                                    </tr>

                                </thead>
                                <tbody>
                                    <?php 
                                        $grandTotal = 0;
                                        $iteration = 1;
                                    ?>
                                    <?php foreach ($data['omset'] as $item): ?>
                                        <tr>
                                            <td class="text-center"><?= $iteration ?></td>
                                            <td class="text-center"><?= date('d-m-Y', strtotime($item['transaction_date'])) ?></td>
                                            <td class="text-center">Rp <?= $item['total_omset'] ?></td> 
                                        </tr>

                                        <?php
                                            $grandTotal += $item['total_omset'];  
                                        ?>
                                        
                                        <?php $iteration++ ?>
                                    <?php endforeach; ?>
                                    <tr>
                                        <td class="text-right" colspan="2"><b>Grand Total :</b></td>
                                        <td class="text-center">Rp <?= number_format($grandTotal, 3, '.', ',')?></td> 
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