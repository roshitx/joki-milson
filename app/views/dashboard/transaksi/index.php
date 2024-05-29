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
                    <h6 class="m-0 font-weight-bold text-primary">List Order</h6>
                </a>

                <!-- Card Content - Collapse -->
                <div class="collapse show" id="collapseCardExample">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table" id="table">
                                <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Nama Customer</th>
                                        <th scope="col">Nomor Meja</th>
                                        <th scope="col">Waktu Order</th>
                                        <th scope="col">Status</th>
                                        <th scope="col">Grand Total</th>
                                        <th scope="col"><i class="fa-solid fa-gear"></i></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $iteration = 1; ?>
                                    <?php foreach($data['order'] as $order): ?>
                                        <?php
                                            $formatted_order_time = date('H:i A, d M Y', strtotime($order['order_time']));
                                        ?>
                                    <tr>
                                        <th scope="row"><?= $iteration ?></th>
                                        <td><?= $order['customer_name'] ?></td>
                                        <td><?= $order['table_number'] ?></td>
                                        <td><?= $formatted_order_time ?></td>
                                        <td><?php if ($order['status'] == 'Sedang diproses') {
                                            ?> <span class="badge badge-warning"><?= $order['status'] ?></span>
                                            <?php } else { ?>
                                                <span class="badge badge-success"><?= $order['status'] ?></span>
                                            <?php  } ?></td>
                                        <td>Rp <?= $order['grand_total'] ?></td>
                                        <td>
                                            <a href="<?= BASE_URL ?>/transaksi/detail/<?= $order['order_id'] ?>"  id="detailOrder-<?= $order['order_id'] ?>" class="btn btn-info btn-circle btn-sm"
                                                data-id="<?= $order['order_id'] ?>">
                                                <i class="fa-solid fa-dollar-sign"></i>
                                            </a>
                                        </td>
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
    $(document).ready(function() {
        $('[data-id]').click(function() {
        var orderId = $(this).data('id'); // Mendapatkan nilai dari data-id

        console.log(orderId); // Mencetak ID ke konsol
    });
    })

    <?php Flasher::flash(); ?>
</script>