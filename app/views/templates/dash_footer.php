</div>
<!-- End of Page Wrapper -->

<!-- Scroll to Top Button-->
<a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
</a>

<!-- Logout Modal-->
<div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
            <div class="modal-footer">
                <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                <button class="btn btn-primary" id="logoutButton">Logout</button>
            </div>
        </div>
    </div>
</div>


<!-- Bootstrap core JavaScript-->
<script src="<?= BASE_URL ?>/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

<!-- script.js -->
<script src="<?= BASE_URL ?>/js/dashboard/script.js"></script>

<!-- Core plugin JavaScript-->
<script src="<?= BASE_URL ?>/vendor/jquery-easing/jquery.easing.min.js"></script>

<!-- Custom scripts for all pages-->
<script src="<?= BASE_URL ?>/js/dashboard/sb-admin-2.min.js"></script>

<!-- Page level plugins -->
<script src="<?= BASE_URL ?>/vendor/chart.js/Chart.min.js"></script>

<!-- Page level custom scripts -->
<script src="js/demo/chart-area-demo.js"></script>
<script src="js/demo/chart-pie-demo.js"></script>

<!-- Datatables -->
<script src="<?= BASE_URL ?>/vendor/datatables/jquery.dataTables.min.js"></script>
<script src="<?= BASE_URL ?>/vendor/datatables/dataTables.bootstrap4.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.4.2/js/dataTables.buttons.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/buttons/2.4.2/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.4.2/js/buttons.print.min.js"></script>
<script>
    $(document).ready(function () {
        $('#table').DataTable();
        $('.deleteButtonCashier').click(function () {
            let cashierId = $(this).data('id');
            let deleteCashierUrl = '<?= BASE_URL ?>/cashier/delete/' + cashierId;

            Swal.fire({
                title: 'Are you sure?',
                text: 'You will not be able to recover this!',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Yes, delete it!',
                cancelButtonText: 'No, cancel',
                reverseButtons: true
            }).then((result) => {
                if (result.isConfirmed) {
                    // If confirmed, redirect to the delete URL
                    window.location.href = deleteCashierUrl;
                }
            });
        });

        $('.deleteButtonMenu').click(function () {
            let menuId = $(this).data('id');
            let deleteMenuUrl = '<?= BASE_URL ?>/menu/delete/' + menuId;

            Swal.fire({
                title: 'Are you sure?',
                text: 'You will not be able to recover this!',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Yes, delete it!',
                cancelButtonText: 'No, cancel',
                reverseButtons: true
            }).then((result) => {
                if (result.isConfirmed) {
                    // If confirmed, redirect to the delete URL
                    window.location.href = deleteMenuUrl;
                }
            });
        });

        $('.deleteButtonSalary').click(function () {
            let gajiId = $(this).data('id');
            let deleteGajiUrl = '<?= BASE_URL ?>/salary/delete/' + gajiId;

            Swal.fire({
                title: 'Are you sure?',
                text: 'You will not be able to recover this!',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Yes, delete it!',
                cancelButtonText: 'No, cancel',
                reverseButtons: true
            }).then((result) => {
                if (result.isConfirmed) {
                    // If confirmed, redirect to the delete URL
                    window.location.href = deleteGajiUrl;
                }
            });
        });

        $('.deleteButtonDiscount').click(function () {
            let diskonId = $(this).data('id');
            let deleteDiskonUrl = '<?= BASE_URL ?>/discount/delete/' + diskonId;

            Swal.fire({
                title: 'Are you sure?',
                text: 'You will not be able to recover this!',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Yes, delete it!',
                cancelButtonText: 'No, cancel',
                reverseButtons: true
            }).then((result) => {
                if (result.isConfirmed) {
                    // If confirmed, redirect to the delete URL
                    window.location.href = deleteDiskonUrl;
                }
            });
        });

        $('.deleteButtonPengeluaran').click(function () {
            let pengeluaranId = $(this).data('id');
            let deletePengeluaranUrl = '<?= BASE_URL ?>/pengeluaran/delete/' + pengeluaranId;

            Swal.fire({
                title: 'Are you sure?',
                text: 'You will not be able to recover this!',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Yes, delete it!',
                cancelButtonText: 'No, cancel',
                reverseButtons: true
            }).then((result) => {
                if (result.isConfirmed) {
                    // If confirmed, redirect to the delete URL
                    window.location.href = deletePengeluaranUrl;
                }
            });
        });

        $('.deleteButtonStok').click(function () {
            let stokId = $(this).data('id');
            console.log(stokId);
            let deleteStokUrl = '<?= BASE_URL ?>/stok/delete/' + stokId;

            Swal.fire({
                title: 'Are you sure?',
                text: 'You will not be able to recover this!',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Yes, delete it!',
                cancelButtonText: 'No, cancel',
                reverseButtons: true
            }).then((result) => {
                if (result.isConfirmed) {
                    // If confirmed, redirect to the delete URL
                    window.location.href = deleteStokUrl;
                }
            });
        });

        document.getElementById('logoutButton').addEventListener('click', function () {
            window.location.href = '<?= BASE_URL ?>/logout';
        });
    });
</script>
</body>

</html>