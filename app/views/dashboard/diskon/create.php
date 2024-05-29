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
                    <h6 class="m-0 font-weight-bold text-primary">Tambah Diskon</h6>
                </a>

                <!-- Card Content - Collapse -->
                <div class="collapse show" id="collapseCardExample">
                    <div class="card-body">
                        <form action="<?= BASE_URL ?>/discount/store" method="post">
                            <div class="form-group mb-3">
                                <label for="name">Menu</label>
                                <select name="menu_id" id="menu_id" class="form-control" required>
                                    <option value="0" disabled selected>-- Pilih menu --</option>
                                    <?php foreach ($data['menus'] as $menu): ?>
                                    <option value="<?= $menu['menu_id'] ?>"><?= $menu['title'] ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <div class="row mt-3">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="harga">Harga / item</label>
                                        <input type="text" class="form-control" id="harga" readonly>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="username">Diskon</label>
                                        <div class="input-group">
                                            <input type="text" class="form-control" id="disc" name="disc"
                                                placeholder="Cth : 25.." max="100" min="0">
                                            <div class="input-group-append">
                                                <span class="input-group-text">%</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row mt-3">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="start_date">Tanggal Mulai</label>
                                        <input type="date" class="form-control" id="start_date" name="start_date" required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="end_date">Tanggal Berakhir</label>
                                        <input type="date" class="form-control" id="end_date" name="end_date" required>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12 mb-3 d-flex justify-content-between">
                                    <a href="<?= BASE_URL ?>/discount" class="btn btn-secondary">Kembali</a>
                                    <button type="submit" class="btn btn-primary">Submit</button>
                                </div>
                            </div>
                        </form>
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
        $('#menu_id').select2({
            theme: 'classic',
            width: '100%',
        });

        $('#menu_id').change(function () {
            let menu_id = $(this).val();
            $.ajax({
                url: 'http://localhost/milson-coffee/public/discount/getMenuPrice/' + menu_id, // Change URL to a specific action
                method: 'GET', 
                dataType: 'json',
                success: function (response) {
                    $('#harga').val('Rp ' + response.price);
                },

                error: function (jqXHR, textStatus, error) {
                    console.log(error);
                }
            });
        });
    });
</script>