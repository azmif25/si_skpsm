<?php
include '../koneksi.php';
?>


<head>
    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="assets/plugins/fontawesome-free/css/all.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="assets/dist/css/adminlte.min.css">
</head>

<body>
    <div class="container">
        <div class="row">
            <div class="col-10">
                <div class="card">
                    <div class="card-head text-center">
                        <div class="card-tittle">
                            <h3>Analisis Kepuasan Pelanggan Pada Bulan <?php echo date('F') ?></h3>
                        </div>
                    </div>
                    <div class="card-body">
                        <script src="../admin/assets/plugins/chart.js/Chart.js"></script>
                        <div class="col-12">
                            <div>
                                <canvas id="myChart"></canvas>
                            </div>
                        </div>
                    </div>
                </div>
                <script>
                    var ctx = document.getElementById("myChart").getContext('2d');
                    var myChart = new Chart(ctx, {
                        type: 'bar',
                        data: {
                            labels: ["Sangat Buruk", "Buruk", "Sedang", "Puas", "Sangat Puas"],
                            datasets: [{
                                label: '',
                                data: [
                                    <?php
                                    $jumlah_sangat_buruk = mysqli_query($koneksi, "select * from tanggapan where kepuasan='Sangat Buruk' AND MONTH(tanggal) = MONTH(CURRENT_DATE())");
                                    echo mysqli_num_rows($jumlah_sangat_buruk);
                                    ?>,
                                    <?php
                                    $jumlah_buruk = mysqli_query($koneksi, "select * from tanggapan where kepuasan='Buruk' AND MONTH(tanggal) = MONTH(CURRENT_DATE())");
                                    echo mysqli_num_rows($jumlah_buruk);
                                    ?>,
                                    <?php
                                    $jumlah_sedang = mysqli_query($koneksi, "select * from tanggapan where kepuasan='Sedang' AND MONTH(tanggal) = MONTH(CURRENT_DATE())");
                                    echo mysqli_num_rows($jumlah_sedang);
                                    ?>,
                                    <?php
                                    $jumlah_puas = mysqli_query($koneksi, "select * from tanggapan where kepuasan='Puas' AND MONTH(tanggal) = MONTH(CURRENT_DATE())");
                                    echo mysqli_num_rows($jumlah_puas);
                                    ?>,
                                    <?php
                                    $jumlah_sangat_puas = mysqli_query($koneksi, "select * from tanggapan where kepuasan='Sangat Puas' AND MONTH(tanggal) = MONTH(CURRENT_DATE())");
                                    echo mysqli_num_rows($jumlah_sangat_puas);
                                    ?>
                                ],
                                backgroundColor: [
                                    'rgba(255, 99, 132, 0.2)',
                                    'rgba(54, 162, 235, 0.2)',
                                    'rgba(255, 206, 86, 0.2)',
                                    'rgba(75, 192, 192, 0.2)',
                                    'rgba(85, 120, 99, 0.2)'
                                ],
                                borderColor: [
                                    'rgba(255,99,132,1)',
                                    'rgba(54, 162, 235, 1)',
                                    'rgba(255, 206, 86, 1)',
                                    'rgba(75, 192, 192, 1)',
                                    'rgba(85, 120, 99, 1)'
                                ],
                                borderWidth: 1
                            }]
                        },
                        options: {
                            scales: {
                                yAxes: [{
                                    ticks: {
                                        beginAtZero: true
                                    }
                                }]
                            }
                        }
                    });
                </script>
                <script>
                    window.print();
                </script>
            </div>
        </div>
    </div>
</body>