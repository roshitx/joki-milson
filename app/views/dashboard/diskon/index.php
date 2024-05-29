<?php
    if (!isset($_SESSION['user_id'])) {
        header('Location:' . BASE_URL . '/login');
        exit();
    } elseif ($_SESSION['role'] !== 'admin') {
        // Jika peran pengguna bukan 'admin', tampilkan pesan SweetAlert
        echo '<script>';
        echo 'Swal.fire({
                icon: "warning",
                title: "Akses Ditolak!",
                text: "Anda tidak memiliki akses ke resource ini.",
                confirmButtonText: "Kembali ke Dashboard"
                }).then(function () {
                window.location.href = "' . BASE_URL . '/dashboard";
                });';
        echo '</script>';
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
                    <h6 class="m-0 font-weight-bold text-primary">List Diskon</h6>
                </a>

                <!-- Card Content - Collapse -->
                <div class="collapse show" id="collapseCardExample">
                    <div class="card-header">
                        <a href="<?= BASE_URL ?>/discount/create" class="btn btn-primary btn-icon-split btn-sm">
                            <span class="icon text-white-50">
                                <i class="fas fa-plus"></i>
                            </span>
                            <span class="text">Tambah Diskon</span>
                        </a>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table" id="table">
                                <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Menu</th>
                                        <th scope="col">Jumlah Diskon (%)</th>
                                        <th scope="col">Harga Normal</th>
                                        <th scope="col">Harga Diskon</th>
                                        <th scope="col">Periode</th>
                                        <th scope="col"><i class="fa-solid fa-gear"></i></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $iteration = 1; ?>
                                    <?php foreach($data['discount'] as $diskon): ?>

                                    <tr>
                                        <th scope="row"><?= $iteration ?></th>
                                        <td><?= $diskon['title'] ?></td>
                                        <td><?= $diskon['disc'] ?>%</td>
                                        <td>Rp <?= $diskon['price'] ?></td>
                                        <td>Rp <?= $diskon['discounted_price'] ?></td>
                                        <td><?= date('d/m/Y', strtotime($diskon['start_date'])) . ' - ' . date('d/m/Y', strtotime($diskon['end_date'])) ?></td>
                                        <td>
                                            <button class="btn btn-danger btn-circle btn-sm deleteButtonDiscount"
                                                data-id="<?= $diskon['id'] ?>">
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
    function calculateTotalSalary() {
        var gajiBulanan = parseFloat(document.getElementById('gaji_bulanan').value) || 0;
        var jumlahMasuk = parseInt(document.getElementById('present').value) || 0;

        var totalGaji = (gajiBulanan / 30) * jumlahMasuk;

        document.getElementById('salary').value = totalGaji.toFixed(0);
    }

    <?php Flasher::flash(); ?>
</script>