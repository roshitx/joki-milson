<!-- Pengecekan Auth dan juga Middleware -->
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
                    <h6 class="m-0 font-weight-bold text-primary">List Cashier</h6>
                </a>

                <!-- Card Content - Collapse -->
                <div class="collapse show" id="collapseCardExample">
                    <div class="card-header">
                        <button class="btn btn-primary btn-icon-split btn-sm addButtonCashier" data-toggle="modal"
                            data-target="#addCashier">
                            <span class="icon text-white-50">
                                <i class="fas fa-user-plus"></i>
                            </span>
                            <span class="text">Add Cashier</span>
                        </button>

                        <!-- Add cashier modal -->
                        <div class="modal fade" id="addCashier" tabindex="-1" aria-labelledby="addCashierModal"
                            aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="formModalLabel">Add Cashier</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <form action="<?= BASE_URL; ?>/cashier/add" method="POST">
                                            <input type="hidden" name="id" id="id">
                                            <div class="form-group">
                                                <label for="name">Name</label>
                                                <input type="text" class="form-control" id="name" name="name">
                                            </div>
                                            <div class="form-group">
                                                <label for="username">Username</label>
                                                <input type="text" class="form-control" id="username" name="username">
                                            </div>
                                            <div class="form-group">
                                                <label for="username">Password</label>
                                                <input type="password" class="form-control" id="password" name="password">
                                            </div>
                                            <div class="form-group">
                                                <label for="email">Email address</label>
                                                <input type="email" class="form-control" id="email" name="email">
                                            </div>

                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary"
                                            data-dismiss="modal">Close</button>
                                        <button type="submit" class="btn btn-primary">Add Cashier</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- End add cashier modal -->
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table" id="table">
                                <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Name</th>
                                        <th scope="col">Username</th>
                                        <th scope="col">Email</th>
                                        <th scope="col"><i class="fa-solid fa-gear"></i></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $iteration = 1; ?>
                                    <?php foreach($data['cashier'] as $cashier): ?>

                                    <tr>
                                        <th scope="row"><?= $iteration ?></th>
                                        <td><?= $cashier['name'] ?></td>
                                        <td><?= $cashier['username'] ?></td>
                                        <td><?= $cashier['email'] ?></td>
                                        <td>
                                            <button class="btn btn-warning btn-circle btn-sm editButtonCashier"
                                                data-toggle="modal" data-target="#addCashier"
                                                data-id="<?= $cashier['id'] ?>">
                                                <i class="fas fa-edit"></i>
                                            </button>
                                            <button class="btn btn-danger btn-circle btn-sm deleteButtonCashier"
                                                data-id="<?= $cashier['id'] ?>">
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
    <?php Flasher::flash(); ?>
</script>