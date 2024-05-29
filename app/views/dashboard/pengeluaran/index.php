<!-- Pengecekan Auth dan juga Middleware -->
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
                    <h6 class="m-0 font-weight-bold text-primary">List Biaya Pengeluaran</h6>
                </a>

                <!-- Card Content - Collapse -->
                <div class="collapse show" id="collapseCardExample">
                    <div class="card-header">
                        <button class="btn btn-primary btn-icon-split btn-sm addButtonPengeluaran" data-toggle="modal"
                            data-target="#addPengeluaran">
                            <span class="icon text-white-50">
                                <i class="fa-solid fa-file-invoice-dollar"></i>
                            </span>
                            <span class="text">Add Biaya Pengeluaran</span>
                        </button>

                        <!-- Add pengeluaran modal -->
                        <div class="modal fade" id="addPengeluaran" tabindex="-1" aria-labelledby="addPengeluaranModal"
                            aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="formModalLabel">Add Pengeluaran</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <form action="<?= BASE_URL; ?>/pengeluaran/add" method="POST">
                                            <input type="hidden" name="id" id="id">
                                            <div class="form-group">
                                                <label for="type">Tipe Pengeluaran <span class="text-danger">*</span></label>
                                                <select name="type" id="type" class="form-control">
                                                    <option value="0" selected disabled hidden>-- Pilih tipe biaya pengeluaran --</option>
                                                    <option value="Beli barang">Beli barang</option>
                                                    <option value="Bayar sewa">Bayar sewa</option>
                                                    <option value="Bayar tagihan">Bayar tagihan</option>
                                                    <option value="Bayar jasa">Bayar jasa</option>
                                                    <option value="Beli bahan baku">Beli bahan baku</option>
                                                    <option value="Khusus">Khusus</option>
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label for="description">Deskripsi <span class="text-danger">*</span></label>
                                                <textarea name="description" id="description" cols="5" rows="5" class="form-control"></textarea>
                                            </div>
                                            <div class="form-group">
                                                <label for="amount">Nominal Biaya Pengeluaran</label>
                                                <div class="input-group mb-3">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text">Rp</span>
                                                    </div>
                                                    <input type="text" class="form-control" id="amount" name="amount"
                                                        required>
                                                    <div class="input-group-append">
                                                        <span class="input-group-text">,00</span>
                                                    </div>
                                                </div>
                                            </div>

                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary"
                                            data-dismiss="modal">Close</button>
                                        <button type="submit" class="btn btn-primary">Add Pengeluaran</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- End add Pengeluaran modal -->
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table" id="table">
                                <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Tanggal</th>
                                        <th scope="col">Tipe</th>
                                        <th scope="col">Deskripsi</th>
                                        <th scope="col">Total Biaya</th>
                                        <th scope="col"><i class="fa-solid fa-gear"></i></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $iteration = 1; ?>
                                    <?php foreach($data['pengeluaran'] as $item): ?>

                                    <tr>
                                        <th scope="row"><?= $iteration ?></th>
                                        <td><?= date('H:i:s, j F Y', strtotime($item['date'])) ?></td>
                                        <td><?= $item['type'] ?></td>
                                        <td><?= $item['description'] ?></td>
                                        <td>Rp <?= $item['amount'] ?></td>
                                        <td>
                                            <button class="btn btn-warning btn-circle btn-sm editButtonPengeluaran"
                                                data-toggle="modal" data-target="#addPengeluaran"
                                                data-id="<?= $item['id'] ?>">
                                                <i class="fas fa-edit"></i>
                                            </button>
                                            <button class="btn btn-danger btn-circle btn-sm deleteButtonPengeluaran"
                                                data-id="<?= $item['id'] ?>">
                                                <i class="fas fa-trash"></i>
                                            </button>
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
        // Format rupiah pada input harga
        function formatRupiah(angka) {
        var reverse = angka.toString().split('').reverse().join('');
        var ribuan = reverse.match(/\d{1,3}/g);
        var hasil = ribuan.join('.').split('').reverse().join('');
        return hasil;
    }

    $('#amount').on('input', function () {
        var inputValue = $(this).val().replace(/\D/g, ''); // Hanya biarkan angka
        $(this).val(formatRupiah(inputValue)); // Terapkan format Rupiah
    });

    $('#amount').on('blur', function () {
        var inputValue = $(this).val().replace(/\D/g, ''); // Hanya biarkan angka
        $(this).val(formatRupiah(inputValue)); // Terapkan format Rupiah
    });

    <?php Flasher::flash(); ?>
</script>