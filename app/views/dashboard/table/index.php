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
                    <h6 class="m-0 font-weight-bold text-primary">List Meja</h6>
                </a>

                <!-- Card Content - Collapse -->
                <div class="collapse show" id="collapseCardExample">
                    <div class="card-header">
                        <button class="btn btn-primary btn-icon-split btn-sm addButtonTable" data-toggle="modal"
                            data-target="#addTable">
                            <span class="icon text-white-50">
                                <i class="fas fa-plus"></i>
                            </span>
                            <span class="text">Tambah Meja</span>
                        </button>

                        <!-- Add table modal -->
                        <div class="modal fade" id="addTable" tabindex="-1" aria-labelledby="addTableModal"
                            aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="formModalLabel">Tambah Meja</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <form action="<?= BASE_URL; ?>/table/add" method="POST">
                                            <input type="hidden" name="id" id="id">

                                            <div class="form-group">
                                                <label for="nomor_meja">Nomor Meja</label>
                                                <div class="input-group mb-3">
                                                    <input type="number" class="form-control" id="nomor_meja" value=""
                                                        name="nomor_meja" required readonly>
                                                </div>
                                            </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary"
                                            data-dismiss="modal">Close</button>
                                        <button type="submit" class="btn btn-primary">Tambah Meja</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- End add salary modal -->
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table" id="tableMeja">
                                <thead>
                                    <tr>
                                        <th scope="col" width="1%">#</th>
                                        <th scope="col">Nomor Meja</th>
                                        <th scope="col">QR Code</th>
                                        <th scope="col" width="10%"><i class="fa-solid fa-gear"></i></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $iteration = 1; ?>
                                    <?php foreach($data['table'] as $table): ?>

                                    <tr>
                                        <th scope="row"><?= $iteration ?></th>
                                        <td><?= $table['nomor_meja'] ?></td>
                                        <td><?= $table['qr'] ?></td>
                                        <td>
                                            <button class="btn btn-warning btn-circle btn-sm editButtonTable"
                                                data-toggle="modal" data-target="#addTable"
                                                data-id="<?= $table['id'] ?>">
                                                <i class="fas fa-edit"></i>
                                            </button>
                                            <button class="btn btn-danger btn-circle btn-sm deleteButtonTable"
                                                data-id="<?= $table['id'] ?>">
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
        $('#tableMeja').DataTable();
    });

    $('.addButtonTable').on('click', function () {
        $.ajax({
            url: '<?= BASE_URL; ?>/table/getNomorMeja',
            method: 'GET',
            dataType: 'json',
            success: function (data) {
                console.log(data);
                $('#nomor_meja').val(data.nomor_meja);
            },
            error: function (xhr, status, error) {
                console.error("Kesalahan dalam permintaan Ajax: " + error);
            }
        });
    });

    // Format rupiah pada input harga
    function formatRupiah(angka) {
        var reverse = angka.toString().split('').reverse().join('');
        var ribuan = reverse.match(/\d{1,3}/g);
        var hasil = ribuan.join('.').split('').reverse().join('');
        return hasil;
    }

    <?php Flasher::flash(); ?>
</script>