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
            <a class="btn btn-secondary mb-3" href="<?= BASE_URL ?>/transaksi" role="button">Kembali</a>
            <!-- Collapsable Card Example -->
            <div class="card shadow mb-4">
                <!-- Card Header - Accordion -->
                <a href="#cardDetailOrders" class="d-block card-header py-3" data-toggle="collapse" role="button"
                    aria-expanded="true" aria-controls="cardDetailOrders">
                    <h6 class="m-0 font-weight-bold text-primary">Detail Order <?= $data['order_detail']['order_id'] ?>
                    </h6>
                </a>
                <!-- Card Content - Collapse -->
                <div class="collapse show" id="cardDetailOrders">
                    <?php
                    $formatted_order_time = date('H:i A, d M Y', strtotime($data['order_detail']['order_time']));
                    ?>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-6">
                                <p>Nama Customer : <?= $data['order_detail']['customer_name'] ?></p>
                            </div>
                            <div class="col-6">
                                <p class="text-right">Nomer Meja : <?= $data['order_detail']['table_number'] ?></p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-6">
                                <p>Waktu Order : <?= $formatted_order_time ?></p>
                            </div>
                            <div class="col-6">
                                <p class="text-right">Status Orderan : <?= $data['order_detail']['status'] ?></p>
                            </div>
                        </div>
                        <p class="mb-3 mt-3">Pesanan :</p>
                        <div class="row">
                            <?php foreach ($data['detail_menu'] as $menu) : ?>
                            <div class="col-md-4">
                                <div class="card mb-3">
                                    <img src="<?= BASE_URL ?>/img/dashboard/menu/<?= $menu['image'] ?>"
                                        class="card-img-top img-responsive" alt="...">
                                    <div class="card-body">
                                        <h5 class="card-title"><?= $menu['title'] ?><small class="text-danger">
                                                x<?= $menu['quantity'] ?></small></h5>
                                        <?php if ($menu['show_discount']): ?>
                                        <h6 class="card-subtitle mb-2 text-muted"><s>Rp <?= $menu['price'] ?></s></h6>
                                        <h6 class="card-subtitle mb-2 text-danger">Rp
                                            <?= number_format($menu['discounted_price'], 3, '.', ',') ?></h6>
                                        <span class="badge badge-warning"><?= $menu['disc'] ?>% Diskon</span>
                                        <?php else: ?>
                                        <h6 class="card-subtitle mb-2 text-muted">Rp <?= $menu['price'] ?></h6>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </div>
                            <?php endforeach ?>
                        </div>
                    </div>
                    <div class="card-footer">
                        <div class="row">
                            <?php if ($data['order_detail']['status'] == 'Selesai') { ?>
                            <div class="col-12">
                                <h2 style="font-weight: bold; text-align: center;" class="text-success">Pesanan Selesai
                                </h2>
                            </div>
                            <?php } else { ?>
                            <div class="col-12">
                                <?php  
                                $totalBelanja = $data['order_detail']['grand_total'];
                                $totalPPN = $totalBelanja * 0.11;
                                $grandTotal = $totalBelanja + $totalPPN;
                                ?>
                                <p class="m-0">Total Belanja : Rp <?= number_format($totalBelanja, 3, '.', ',') ?></p>
                                <div class="ppn" hidden>
                                    <p class="m-0">Tax PPN 11% : Rp <?= number_format($totalPPN, 3, '.', ',') ?></p>
                                </div>
                                <h2 style="font-size: 20px;" class="mb-0">Total Pembayaran :
                                    <span class="text-danger total-payment" style="font-weight: bold;">Rp
                                        <?= number_format($totalBelanja, 3, '.', ',') ?>,00</span></h2>
                                <hr>
                                <form action="<?= BASE_URL ?>/transaksi/store" method="post">
                                    <input type="hidden" value="<?= $data['order_detail']['order_id'] ?>"
                                        name="order_id">
                                    <input type="hidden" value="<?= $totalBelanja ?>" name="total_amount">
                                    <input type="hidden" value="<?= $_SESSION['name'] ?>" name="cashier_name">
                                    <input type="hidden" name="grandtotal" id="grandtotal" value="<?= $totalBelanja ?>">
                                    <div class="d-flex justify-content-between">
                                        <div class="row">
                                            <div class="form-group">
                                                <label for="payment_method">PPN & Metode Pembayaran</label>
                                                <div class="mb-3">
                                                    <input type="checkbox" name="ppn" id="ppn-switch" value="11">
                                                </div>
                                                <select class="form-control" id="payment_method" name="payment_method" required>
                                                    <option value="0" disabled selected>-- Pilih Metode Pembayaran --
                                                    </option>
                                                    <option value="cash">CASH</option>
                                                    <option value="kredit/debit">Kredit/Debit</option>
                                                    <option value="transfer bank">Transfer Bank</option>
                                                    <option value="QRIS">QRIS</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <button type="submit" class="btn btn-success"
                                                style="font-weight: bold;">Selesaikan Pesanan</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <?php } ?>
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
    $(document).ready(function () {
        $("#ppn-switch").bootstrapSwitch({
            onText: 'PPN 11%',
            onColor: 'success'
        });

        $('#ppn-switch').on('switchChange.bootstrapSwitch', function (event, state) {
            var totalBelanja = <?= $totalBelanja ?>;
            var totalPPN = totalBelanja * 0.11;
            var grandTotal = totalBelanja;

            if (state) {
                // Jika PPN diaktifkan
                $('.ppn').attr('hidden', false);
                grandTotal += totalPPN;
            } else {
                // Jika PPN dinonaktifkan
                $('.ppn').attr('hidden', true);
            }

            // Update nilai grand total
            $('.total-payment').text('Rp ' + number_format(grandTotal, 3, '.', ',') + ',00');
            $('#grandtotal').val(number_format(grandTotal, 3, '.', ','));
        });

        // Fungsi untuk format number
        function number_format(number, decimals, dec_point, thousands_sep) {
            number = (number + '').replace(/[^0-9+\-Ee.]/g, '');
            var n = !isFinite(+number) ? 0 : +number,
                prec = !isFinite(+decimals) ? 0 : Math.abs(decimals),
                sep = (typeof thousands_sep === 'undefined') ? '.' : thousands_sep,
                dec = (typeof dec_point === 'undefined') ? ',' : dec_point,
                s = '',
                toFixedFix = function (n, prec) {
                    var k = Math.pow(10, prec);
                    return '' + (Math.round(n * k) / k).toFixed(prec);
                };
            // Fix for IE parseFloat(0.55).toFixed(0) = 0;
            s = (prec ? toFixedFix(n, prec) : '' + Math.round(n)).split('.');
            if (s[0].length > 3) {
                s[0] = s[0].replace(/\B(?=(?:\d{3})+(?!\d))/g, sep);
            }
            if ((s[1] || '').length < prec) {
                s[1] = s[1] || '';
                s[1] += new Array(prec - s[1].length + 1).join('0');
            }
            return s.join(dec);
        }
    }); 
    
    <?php Flasher::flash(); ?>
</script>