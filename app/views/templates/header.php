<!DOCTYPE html>
<html class="wide wow-animation" lang="en">

<head>
  <title><?= $data['judul'] ?></title>
  <meta name="format-detection" content="telephone=no">
  <meta name="viewport"
    content="width=device-width, height=device-height, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta charset="utf-8">
  <link rel="icon" href="<?= BASE_URL ?>/img/landing/favicon.ico" type="image/x-icon">

  <!-- Jquery -->
  <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js"
    integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous">
  </script>

  <!-- Font & Bootstrap -->
  <link rel="stylesheet" type="text/css"
    href="//fonts.googleapis.com/css?family=Roboto:100,300,300i,400,500,600,700,900%7CRaleway:500">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css"
    integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">

  <!-- Stylesheet -->
  <link rel="stylesheet" href="<?= BASE_URL ?>/css/landing/fonts.css">
  <link rel="stylesheet" href="<?= BASE_URL ?>/css/landing/style.css">

  <!-- Fontawesome -->
  <script src="https://kit.fontawesome.com/024c1ae29f.js" crossorigin="anonymous"></script>

  <!-- Sweetalert -->
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>

<body>
  <!-- Page Header-->
  <header class="section page-header">
    <!-- RD Navbar-->
    <div class="rd-navbar-wrap">
      <nav class="rd-navbar rd-navbar-modern" data-layout="rd-navbar-fixed" data-sm-layout="rd-navbar-fixed"
        data-md-layout="rd-navbar-fixed" data-md-device-layout="rd-navbar-fixed" data-lg-layout="rd-navbar-static"
        data-lg-device-layout="rd-navbar-fixed" data-xl-layout="rd-navbar-static"
        data-xl-device-layout="rd-navbar-static" data-xxl-layout="rd-navbar-static"
        data-xxl-device-layout="rd-navbar-static" data-lg-stick-up-offset="56px" data-xl-stick-up-offset="56px"
        data-xxl-stick-up-offset="56px" data-lg-stick-up="true" data-xl-stick-up="true" data-xxl-stick-up="true">
        <div class="rd-navbar-inner-outer">
          <div class="rd-navbar-inner">
            <!-- RD Navbar Panel-->
            <div class="rd-navbar-panel">
              <!-- RD Navbar Toggle-->
              <button class="rd-navbar-toggle" data-rd-navbar-toggle=".rd-navbar-nav-wrap"><span></span></button>
              <!-- RD Navbar Brand-->
              <div class="rd-navbar-brand"><a class="brand" href="<?= BASE_URL ?>"><img class="brand-logo-dark"
                    src="<?= BASE_URL ?>/img/landing/logo.png" alt="" width="200" height="66" /></a></div>
            </div>
            <div class="rd-navbar-right rd-navbar-nav-wrap">
              <div class="rd-navbar-main">
                <!-- RD Navbar Nav-->
                <ul class="rd-navbar-nav">
                  <li
                    class="rd-nav-item <?= ($_SERVER['REQUEST_URI'] === '/home' || $_SERVER['REQUEST_URI'] === '/') ? ' active' : '' ?>">
                    <a class="rd-nav-link" href="<?= BASE_URL ?>/home">Home</a>
                  </li>
                  <li class="rd-nav-item <?= ($_SERVER['REQUEST_URI'] === '/orders') ? ' active' : '' ?>"><a
                      class="rd-nav-link" href="<?= BASE_URL ?>/orders">Order</a>
                  </li>
                  <?php if (isset($_SESSION['user_id'])): ?>
                  <li class="rd-nav-item"><a class="rd-nav-link" href="<?= BASE_URL ?>/dashboard"><i
                        class="fa-solid fa-chart-bar"></i> Dashboard</a></li>
                  <?php else: ?>
                  <li class="rd-nav-item"><a class="rd-nav-link" href="<?= BASE_URL ?>/login"><i
                        class="fa-solid fa-right-to-bracket"></i> Login</a></li>
                  <?php endif; ?>
                </ul>
              </div>
            </div>
          </div>
        </div>
      </nav>
    </div>
  </header>
  <script>
    $(document).ready(function () {
      var currentURL = window.location.href;
      // Loop through each navigation link
      $('.rd-navbar-nav a').each(function () {
        var linkURL = $(this).attr('href');
        // Check if the current URL contains the link URL
        if (currentURL.indexOf(linkURL) !== -1) {
          $(this).closest('li').addClass('active');
        }
      });
    });
  </script>