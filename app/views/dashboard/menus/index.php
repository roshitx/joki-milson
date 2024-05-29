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
                <a href="#collapseCardExample" class="d-block card-header py-3" data-toggle="collapse" role="button" aria-expanded="true" aria-controls="collapseCardExample">
                    <h6 class="m-0 font-weight-bold text-primary">List Menu</h6>
                </a>

                <!-- Card Content - Collapse -->
                <div class="collapse show" id="collapseCardExample">
                    <div class="card-header">
                        <button class="btn btn-primary btn-icon-split btn-sm addButtonMenu" data-toggle="modal" data-target="#addMenu">
                            <span class="icon text-white-50">
                                <i class="fas fa-plus"></i>
                            </span>
                            <span class="text">Tambah Menu</span>
                        </button>

                        <!-- Add menu modal -->
                        <div class="modal fade" id="addMenu" tabindex="-1" aria-labelledby="addMenuModal" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="formModalLabel">Tambah Menu</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <form action="<?= BASE_URL; ?>/menu/add" method="POST" enctype="multipart/form-data">
                                            <input type="hidden" name="id" id="id">
                                            <label for="imageInput">Gambar</label>
                                            <div class="input-group mb-3">
                                                <div class="custom-file">
                                                    <input type="file" class="custom-file-input" id="imageInput" aria-describedby="imageInput" accept="image/*" name="image">
                                                    <label class="custom-file-label" for="imageInput">Pilih gambar (jpg,
                                                        jpeg, png)</label>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="title">Nama Menu</label>
                                                <input type="text" class="form-control" id="title" name="title" required>
                                            </div>

                                            <div class="form-group">
                                                <label for="kategori">Kategori</label>
                                                <select name="kategori" id="kategori" class="custom-select">
                                                    <option value="makanan">Makanan</option>
                                                    <option value="minuman">Minuman</option>
                                                </select>
                                            </div>

                                            <div class="form-group">
                                                <label for="price">Harga</label>
                                                <div class="input-group mb-3">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text">Rp</span>
                                                    </div>
                                                    <input type="text" class="form-control" id="price" name="price" required>
                                                    <div class="input-group-append">
                                                        <span class="input-group-text">,00</span>
                                                    </div>
                                                </div>
                                            </div>

                                            <p class="text-secondary edit-info small">Mohon masukkan ulang gambar jika
                                                Anda ingin mengedit data menu.</p>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                        <button type="submit" class="btn btn-primary">Tambah Menu</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- End add menu modal -->
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table" id="table">
                                <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Gambar</th>
                                        <th scope="col">Nama Menu</th>
                                        <th scope="col">Kategori</th>
                                        <th scope="col">Harga</th>
                                        <th scope="col"><i class="fa-solid fa-gear"></i></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $iteration = 1; ?>
                                    <?php foreach ($data['menu'] as $menu) : ?>
                                        <tr>
                                            <th scope="row"><?= $iteration ?></th>
                                            <td><img src="<?= BASE_URL ?>/img/dashboard/menu/<?= $menu['image'] ?>" alt="Menu Image" width="200"></td>
                                            <td><?= $menu['title'] ?></td>
                                            <td><?= ucfirst($menu['kategori']) ?></td>
                                            <td>
                                                <?php if ($menu['show_discount']) : ?>
                                                    <p class="price"><s>Rp <?= $menu['price'] ?></s></p>
                                                    <span class="discounted_price">Rp <?= number_format($menu['discounted_price'], 3, '.', ',') ?></span>
                                                    <span class="badge badge-success">Diskon</span>
                                                <?php else : ?>
                                                    <span class="price">Rp <?= $menu['price'] ?></span>
                                                <?php endif; ?>
                                            </td>
                                            <td>
                                                <button class="btn btn-warning btn-circle btn-sm editButtonMenu" data-toggle="modal" data-target="#addMenu" data-id="<?= $menu['id'] ?>">
                                                    <i class="fas fa-edit"></i>
                                                </button>
                                                <button class="btn btn-danger btn-circle btn-sm deleteButtonMenu" data-id="<?= $menu['id'] ?>">
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
    document.querySelector('.custom-file-input').addEventListener('change', function(e) {
        var fileName = document.getElementById("imageInput").files[0].name;
        var nextSibling = e.target.nextElementSibling
        nextSibling.innerText = fileName
    })

    // Format rupiah pada input harga
    function formatRupiah(angka) {
        var reverse = angka.toString().split('').reverse().join('');
        var ribuan = reverse.match(/\d{1,3}/g);
        var hasil = ribuan ? ribuan.join('.').split('').reverse().join('') : ''; // Tambahkan pengecekan untuk nilai ribuan
        return hasil;
    }

    $('#price').on('input', function() {
        var inputValue = $(this).val().replace(/\D/g, ''); // Hanya biarkan angka
        $(this).val(formatRupiah(inputValue)); // Terapkan format Rupiah
    });

    $('#price').on('blur', function() {
        var inputValue = $(this).val().replace(/\D/g, ''); // Hanya biarkan angka
        $(this).val(formatRupiah(inputValue)); // Terapkan format Rupiah
    });

    <?php Flasher::flash(); ?>
</script>