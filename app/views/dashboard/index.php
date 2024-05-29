<?php
    if (!isset($_SESSION['user_id'])) {
        header('Location:' . BASE_URL . '/login'); // Ganti dengan URL login yang sesuai
        exit();
    }
?>


<?php
    require __DIR__ . '/../templates/sidebar.php';
?>

<!-- Content Wrapper -->
<div id="content-wrapper" class="d-flex flex-column">

    <!-- Main Content -->
    <div id="content">

        <?php 
            require __DIR__ . '/../templates/topbar.php'
        ?>

        <!-- Begin Page Content -->
        <div class="container-fluid">

            <!-- Page Heading -->
            <div class="d-sm-flex align-items-center justify-content-between mb-4">
                <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
            </div>

            <!-- Content Row -->
            <div class="row">


                <div class="col-xl-3 col-md-6 mb-4">
                    <div class="card border-left-primary shadow h-100 py-2">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                        Total Kasir</div>
                                    <div class="h5 mb-0 font-weight-bold text-gray-800">
                                        <?= count($data['total_cashier']) ?> Kasir</div>
                                </div>
                                <div class="col-auto">
                                    <i class="fa-solid fa-clipboard-user fa-2x text-gray-300"></i></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Earnings (Monthly) Card Example -->
                <div class="col-xl-3 col-md-6 mb-4">
                    <div class="card border-left-success shadow h-100 py-2">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                        Total Menu</div>
                                    <div class="h5 mb-0 font-weight-bold text-gray-800">
                                        <?= count($data['total_menu']) ?> Menu</div>
                                </div>
                                <div class="col-auto">
                                    <i class="fa-solid fa-bowl-food fa-2x text-gray-300"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Earnings (Monthly) Card Example -->
                <div class="col-xl-3 col-md-6 mb-4">
                    <div class="card border-left-info shadow h-100 py-2">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Total Pesanan
                                        Hari Ini
                                    </div>
                                    <div class="row no-gutters align-items-center">
                                        <div class="col-auto">
                                            <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800">
                                                <?= $data['total_orders_today'] ?> Pesanan</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-auto">
                                    <i class="fas fa-clipboard-list fa-2x text-gray-300"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Pending Requests Card Example -->
                <div class="col-xl-3 col-md-6 mb-4">
                    <div class="card border-left-warning shadow h-100 py-2">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                        Total Item Terjual Hari Ini</div>
                                    <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $data['total_item_sold'] ?>
                                        Item</div>
                                </div>
                                <div class="col-auto">
                                    <i class="fas fa-comments fa-2x text-gray-300"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Content Row -->

            <div class="row">

                <!-- Area Chart -->
                <div class="col-xl-8 col-lg-7">
                    <div class="card shadow mb-4">
                        <!-- Card Header - Dropdown -->
                        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                            <h6 class="m-0 font-weight-bold text-primary">Grafik Pendapatan</h6>
                        </div>
                        <!-- Card Body -->
                        <div class="card-body">
                            <div class="chart-area">
                                <canvas id="myAreaChart"></canvas>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Pie Chart -->
                <div class="col-xl-4 col-lg-5">
                    <div class="card shadow mb-4">
                        <!-- Card Header - Dropdown -->
                        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                            <h6 class="m-0 font-weight-bold text-primary">Grafik Penjualan Item by Kategori</h6>
                            <div class="dropdown no-arrow">
                            </div>
                        </div>
                        <!-- Card Body -->
                        <div class="card-body">
                            <div class="chart-pie pt-4 pb-2">
                                <canvas id="myPieChart"></canvas>
                            </div>
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
        $.ajax({
            url: 'http://localhost/milson-coffee/public/transaksi/getMonthlyProfit',
            method: 'GET',
            dataType: 'json',
            success: function (response) {
                const ctx = document.getElementById('myAreaChart');

                // Ambil data bulan dan total pendapatan dari respons JSON
                const labels = response.map(item => item.bulan);
                const datasetData = response.map(item => item
                    .total_pendapatan); // Konversi ke tipe data numerik

                const chartData = {
                    labels: labels,
                    datasets: [{
                        label: 'Pendapatan Perbulan',
                        data: datasetData,
                        fill: true,
                        borderColor: 'rgb(75, 192, 192)',
                        tension: 0.1
                    }]
                };

                const config = {
                    type: 'line',
                    data: chartData,
                    options: {
                        scales: {
                            y: {
                                beginAtZero: true,
                                ticks: {
                                    callback: function (value, index, values) {
                                        return 'Rp ' + value;
                                    }
                                }
                            }
                        }
                    }
                };

                new Chart(ctx, config);
            },
            error: function (xhr, status, error) {
                console.error("Kesalahan dalam permintaan Ajax: " + error);
            }
        });

        $.ajax({
            url: 'http://localhost/milson-coffee/public/transaksi/getMonthlySoldItemByCategory',
            method: 'GET',
            dataType: 'json',
            success: function (response) {
                console.log(response);

                // Ambil data kategori dan total penjualan dari respons JSON
                const labels = response.map(item => item.kategori);
                const datasetData = response.map(item => item.total_penjualan);

                const pieChartData = {
                    labels: labels,
                    datasets: [{
                        data: datasetData,
                        backgroundColor: ['rgb(75, 192, 192)',
                            'rgb(255, 99, 132)'
                        ], // Warna untuk setiap kategori
                    }]
                };

                const ctx = document.getElementById('myPieChart').getContext('2d');

                new Chart(ctx, {
                    type: 'pie',
                    data: pieChartData,
                    options: {
                        width: 1000,
                        height: 1000
                    }
                });
            },
            error: function (xhr, status, error) {
                console.error("Kesalahan dalam permintaan Ajax: " + error);
            }
        });


    });
</script>