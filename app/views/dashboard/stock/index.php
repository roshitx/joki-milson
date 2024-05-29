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
                    <h6 class="m-0 font-weight-bold text-primary">List Stok Bahan</h6>
                </a>

                <!-- Card Content - Collapse -->
                <div class="collapse show" id="collapseCardExample">
                    <div class="card-header">
                        <button class="btn btn-primary btn-icon-split btn-sm addButtonStock" data-toggle="modal"
                            data-target="#addStock">
                            <span class="icon text-white-50">
                                <i class="fas fa-plus"></i>
                            </span>
                            <span class="text">Tambah Stok</span>
                        </button>

                        <!-- Add stock modal -->
                        <div class="modal fade" id="addStock" tabindex="-1" aria-labelledby="addStockModal"
                            aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="formModalLabel">Tambah Data Stok</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <form action="<?= BASE_URL; ?>/stok/add" method="POST">
                                            <input type="hidden" name="id" id="id">

                                            <div class="form-group">
                                                <label for="nama_item">Nama Item</label>
                                                <input type="text" class="form-control" name="nama_item" id="nama_item"
                                                    required>
                                            </div>

                                            <div class="form-group">
                                                <label for="satuan">Jumlah</label>
                                                <input type="number" class="form-control" id="satuan" name="satuan"
                                                    required>
                                            </div>

                                            <div class="form-group">
                                                <label for="type">Jenis Satuan</label>
                                                <select name="type" id="type" class="form-control" required>
                                                    <option value="Gram">Gram</option>
                                                    <option value="Pcs">Pcs</option>
                                                    <option value="Ml">Mililiter</option>
                                                    <option value="liter">Liter</option>
                                                </select>
                                            </div>

                                            <div class="form-group">
                                                <label for="tanggal">Tanggal Masuk</label>
                                                <input type="date" class="form-control" id="tanggal" name="tanggal"
                                                    required>
                                            </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary"
                                            data-dismiss="modal">Close</button>
                                        <button type="submit" class="btn btn-primary">Tambah Stok</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- End add stock modal -->

                        <!-- Add sisa stock modal -->
                        <div class="modal fade" id="addSisaStock" tabindex="-1" aria-labelledby="addStockModal"
                            aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="formModalLabel">Sisa Stok</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <form action="<?= BASE_URL; ?>/stok/sisa_stok" method="POST">
                                            <input type="hidden" name="id" id="idSisaStok">

                                            <div class="form-group">
                                                <label for="sisa_stok">Sisa Stok</label>
                                                <input type="number" class="form-control" name="sisa_stok"
                                                    id="sisa_stok" required>
                                            </div>

                                            <div class="form-group">
                                                <label for="type_sisa_stok">Jenis Satuan</label>
                                                <select name="type_sisa_stok" id="type_sisa_stok" class="form-control" required>
                                                    <option value="Gram">Gram</option>
                                                    <option value="Pcs">Pcs</option>
                                                    <option value="Ml">Mililiter</option>
                                                    <option value="Liter">Liter</option>
                                                </select>
                                            </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary"
                                            data-dismiss="modal">Close</button>
                                        <button type="submit" class="btn btn-primary">Tambah Stok</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- End add sisa stock modal -->
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table" id="tableStock">
                                <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Nama Item</th>
                                        <th scope="col">Jumlah</th>
                                        <th scope="col">Tanggal Masuk</th>
                                        <th scope="col">Sisa Stok</th>
                                        <th scope="col">Tanggal Keluar</th>
                                        <th scope="col"><i class="fa-solid fa-gear"></i></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $iteration = 1; ?>
                                    <?php foreach($data['stock'] as $stock): ?>
                                    <?php
                                            $formatted_tanggal_masuk = date('d M Y', strtotime($stock['tanggal']));
                                            if (!is_null($stock['sisa_stok_tanggal'])) {
                                                $formatted_tanggal_keluar = date('d M Y', strtotime($stock['sisa_stok_tanggal']));
                                              } else {
                                                $formatted_tanggal_keluar = '-';
                                              }
                                        ?>
                                    <tr>
                                        <th scope="row"><?= $iteration ?></th>
                                        <td><?= $stock['nama_item'] ?></td>
                                        <td><?= $stock['satuan'] ?> <?= $stock['type'] ?></td>
                                        <td><?= $formatted_tanggal_masuk ?></td>
                                        <td><?= $stock['sisa_stok'] ?> <?= $stock['type_sisa_stok'] ?></td>
                                        <td><?= $formatted_tanggal_keluar ?? 'Tes' ?></td>
                                        <td>
                                            <button class="btn btn-info btn-circle btn-sm buttonSisaStok"
                                                data-toggle="modal" data-target="#addSisaStok"
                                                data-id="<?= $stock['id'] ?>">
                                                <i class="fa-solid fa-box"></i>
                                            </button>
                                            <button class="btn btn-danger btn-circle btn-sm deleteButtonStok"
                                                data-id="<?= $stock['id'] ?>">
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
        $('#tableStock').DataTable();

        $('.buttonSisaStok').click(function () {
            let id = $(this).data('id');
            $('#idSisaStok').val(id);
            $('#addSisaStock').modal('show');
        })
    });

    <?php Flasher::flash(); ?>
</script>