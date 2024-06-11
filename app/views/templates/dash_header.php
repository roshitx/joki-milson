<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Milson Coffee Cashier App">
    <meta name="author" content="Milson Coffee Developer">

    <title><?= $data['judul']; ?></title>

    <link rel="icon" href="<?= BASE_URL ?>/img/landing/favicon.ico" type="image/x-icon">
    <script src="https://kit.fontawesome.com/024c1ae29f.js" crossorigin="anonymous"></script>
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Jquery -->
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js"
        integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous">
    </script>
    <script src="<?= BASE_URL ?>/vendor/jquery/jquery.min.js"></script>

    <!-- Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <!-- Custom styles for this template-->
    <link href="<?= BASE_URL ?>/css/dashboard/sb-admin-2.min.css" rel="stylesheet">

    <!-- Datatables -->
    <link href="<?= BASE_URL ?>/vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.4.2/css/buttons.dataTables.min.css">

    <!-- Sweetalert -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <!-- Select2 -->
    <link rel="stylesheet" href="<?= BASE_URL ?>/vendor/select2/dist/css/select2.min.css">
    <script src="<?= BASE_URL ?>/vendor/select2/dist/js/select2.min.js"></script>

    <!-- SwitchMaster -->
    <link rel="stylesheet" href="<?= BASE_URL ?>/vendor/bootstrap-switch-master/dist/css/bootstrap4/bootstrap-switch.css">
    <script src="<?= BASE_URL ?>/vendor/bootstrap-switch-master/dist/js/bootstrap-switch.js"></script>
    <style>
        #customFile .custom-file-input:lang(en)::after {
            content: "Select file...";
        }

        #customFile .custom-file-input:lang(en)::before {
            content: "Click me";
        }

        /*when a value is selected, this class removes the content */
        .custom-file-input.selected:lang(en)::after {
            content: "" !important;
        }

        .custom-file {
            overflow: hidden;
        }

        .custom-file-input {
            white-space: nowrap;
        }
    </style>
</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">