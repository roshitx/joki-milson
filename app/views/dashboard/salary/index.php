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
                    <h6 class="m-0 font-weight-bold text-primary">List Gaji</h6>
                </a>

                <!-- Card Content - Collapse -->
                <div class="collapse show" id="collapseCardExample">
                    <div class="card-header">
                        <button class="btn btn-primary btn-icon-split btn-sm addButtonSalary" data-toggle="modal"
                            data-target="#addSalary">
                            <span class="icon text-white-50">
                                <i class="fas fa-plus"></i>
                            </span>
                            <span class="text">Tambah Gaji</span>
                        </button>

                        <!-- Add salary modal -->
                        <div class="modal fade" id="addSalary" tabindex="-1" aria-labelledby="addSalaryModal"
                            aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="formModalLabel">Tambah Gaji</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <form action="<?= BASE_URL; ?>/salary/add" method="POST">
                                            <input type="hidden" name="id" id="id">
                                            <div class="form-group">
                                                <label for="title">Nama Karyawan</label>
                                                <select name="cashier_name" id="cashier_name" class="form-control">
                                                    <option selected disabled> -- Pilih Karyawan -- </option>
                                                    <?php foreach ($data['cashier'] as $cashier) : ?>
                                                    <option value="<?= $cashier['name']; ?>">
                                                        <?= $cashier['name']; ?></option>
                                                    <?php endforeach; ?>
                                                </select>
                                            </div>

                                            <div class="form-group">
                                                <label for="gaji_bulanan">Gaji / Bulan</label>
                                                <div class="input-group mb-3">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text">Rp</span>
                                                    </div>
                                                    <input type="text" class="form-control" id="gaji_bulanan"
                                                        name="monthly_sal" required>
                                                    <div class="input-group-append">
                                                        <span class="input-group-text">,00</span>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label for="present">Jumlah Masuk / Bulan</label>
                                                <div class="input-group mb-3">
                                                    <input type="number" class="form-control" id="present"
                                                        name="present" required>
                                                    <div class="input-group-append">
                                                        <span class="input-group-text">Hari</span>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label for="overtime">Lembur / Bulan</label>
                                                <div class="input-group mb-3">
                                                    <input type="number" class="form-control" id="overtime"
                                                        name="overtime" required>
                                                    <div class="input-group-append">
                                                        <span class="input-group-text">Hari</span>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label for="salary">Total Gaji</label>
                                                <div class="input-group mb-3">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text">Rp</span>
                                                    </div>
                                                    <input type="text" class="form-control" id="salary" name="salary"
                                                        required readonly>
                                                    <div class="input-group-append">
                                                        <span class="input-group-text">,00</span>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label for="month">Bulan & Tahun</label>
                                                <div class="input-group mb-3">
                                                    <input type="month" class="form-control" id="month" name="month"
                                                        required>
                                                </div>
                                            </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary"
                                            data-dismiss="modal">Close</button>
                                        <button type="submit" class="btn btn-primary">Tambah Salary</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- End add salary modal -->
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table" id="tableSalary">
                                <thead>
                                    <tr>
                                        <th scope="col" width="1%">#</th>
                                        <th scope="col">Nama Kasir</th>
                                        <th scope="col">Bulan & Tahun</th>
                                        <th scope="col">Jumlah Gaji</th>
                                        <th scope="col">Jumlah Masuk</th>
                                        <th scope="col">Jumlah Lembur</th>
                                        <th scope="col">Total Gaji</th>
                                        <th scope="col"><i class="fa-solid fa-gear"></i></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $iteration = 1; ?>
                                    <?php foreach($data['salary'] as $salary): ?>

                                    <tr>
                                        <th scope="row"><?= $iteration ?></th>
                                        <td><?= $salary['cashier_name'] ?></td>
                                        <td><?= $salary['month'] ? date('F Y', strtotime($salary['month'])) : '-' ?></td>
                                        <td>Rp <?= number_format($salary['monthly_sal'], 0, ',', '.') ?></td>
                                        <td><?= ucfirst($salary['present']) ?> Hari</td>
                                        <td><?= ucfirst($salary['overtime']) ?> Hari</td>
                                        <td>Rp <?= number_format($salary['salary'], 0, ',', '.') ?></td>
                                        <td>
                                            <button class="btn btn-warning btn-circle btn-sm editButtonSalary"
                                                data-toggle="modal" data-target="#addSalary"
                                                data-id="<?= $salary['id'] ?>">
                                                <i class="fas fa-edit"></i>
                                            </button>
                                            <button class="btn btn-danger btn-circle btn-sm deleteButtonSalary"
                                                data-id="<?= $salary['id'] ?>">
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
    $(document).ready(function () {
        $('#tableSalary').DataTable({
            dom: 'Bfrtip',
            buttons: [
                'excel', 'pdf', 'print'
            ],
        });
    });

    function calculateTotalSalary() {
        var gajiBulanan = parseFloat(document.getElementById('gaji_bulanan').value) || 0;
        var jumlahMasuk = parseInt(document.getElementById('present').value) || 0;
        var lembur = parseInt(document.getElementById('overtime').value) || 0;

        var regularSalary = (gajiBulanan / 30) * jumlahMasuk;

        var overtimePay = 0;
        if (lembur > 0) {
            var overtimeRate = 50000; // Constant representing nominal pay per overtime day
            overtimePay = overtimeRate * lembur;
        }

        // Calculate total salary
        var totalSalary = regularSalary + overtimePay;

        document.getElementById('salary').value = totalSalary.toFixed(0);
    }

    // Panggil fungsi perhitungan saat nilai input berubah
    document.getElementById('gaji_bulanan').addEventListener('input', calculateTotalSalary);
    document.getElementById('present').addEventListener('input', calculateTotalSalary);
    document.getElementById('overtime').addEventListener('input', calculateTotalSalary);

    // Format rupiah pada input harga
    function formatRupiah(angka) {
        var reverse = angka.toString().split('').reverse().join('');
        var ribuan = reverse.match(/\d{1,3}/g);
        var hasil = ribuan.join('.').split('').reverse().join('');
        return hasil;
    }

    <?php Flasher::flash(); ?>
</script>