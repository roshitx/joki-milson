<section class="vh-100 d-flex justify-content-center align-items-center">
    <div class="container h-custom">
        <div class="row d-flex justify-content-center align-items-center h-100">
            <div class="col-md-9 col-lg-6 col-xl-5">
                <img src="<?= BASE_URL ?>/img/landing/logo.png" class="img-fluid" alt="Sample image">
            </div>
            <div class="col-md-8 col-lg-6 col-xl-4 offset-xl-1">
                <h1 class="fw-bold">Hi there!</h1>
                <p class="text-secondary">Please login as cashier or admin.</p>
                <form action="<?= BASE_URL ?>/login/auth" method="POST">
                    <!-- Di halaman HTML -->
                    <?php if (isset($_SESSION['error'])) { ?>
                    <div class="alert alert-danger" role="alert">
                        <?= $_SESSION['error']; ?>
                    </div>
                    <?php unset($_SESSION['error']); // Hapus pesan setelah ditampilkan ?>
                    <?php } ?>
                    <!-- Email input -->
                    <div class="mb-3">
                        <label for="username" class="form-label">Username <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="username" placeholder="admin" name="username">
                    </div>

                    <!-- Password input -->
                    <div class="mb-3">
                        <label for="password" class="form-label">Password <span class="text-danger">*</span></label>
                        <input type="password" class="form-control" id="password" placeholder="******" name="password">
                    </div>

                    <div class="d-flex justify-content-between align-items-center">
                    </div>

                    <div class="text-center text-lg-start mt-3 pt-2 d-flex justify-content-between">
                        <button type="submit" class="btn btn-primary btn-lg"><i class="fa-solid fa-right-to-bracket"></i>Login</button>
                        <a type="button" class="btn btn-secondary btn-lg" href="<?= BASE_URL ?>/views/home">Back</a>
                    </div>

                </form>
            </div>
        </div>
    </div>
</section>