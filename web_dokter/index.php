<?php
session_start();

// Koneksi ke database (ganti informasi sesuai dengan database Anda)
require_once "../auth/connect.php";

// Query SQL untuk mengambil total pasien
$queryPasien = "SELECT COUNT(*) AS total_pasien FROM data_pasien";
$resultPasien = mysqli_query($conn, $queryPasien);

// Query SQL untuk mengambil total dokter
$queryDokter = "SELECT COUNT(*) AS total_dokter FROM data_dokter";
$resultDokter = mysqli_query($conn, $queryDokter);

// Query SQL untuk mengambil total rekam medis
$queryRekamMedis = "SELECT COUNT(*) AS total_rekam_medis FROM rekam_medis";
$resultRekamMedis = mysqli_query($conn, $queryRekamMedis);

// Tutup koneksi database
mysqli_close($conn);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <!-- link css  -->
    <link rel="stylesheet" href="css/style.css">
    <title>Rekam Medis</title>
</head>
<body>

    <!-- sidebar -->
    <div class="sidebar">
        <a href="#" class="logo" id="logo">
            <img src="images/logo.png" alt="">
            <div class="logo-name"><span>Klinik</span><br><span>Bhayangkara</span><br><span>Polres Madiun</span></div>
        </a>
        <ul class="side-menu">
            <li class="active"><a href="index.php"><i class='bx bxs-dashboard'></i>Dashboard</a></li>
            <li><a href="data_pasien.php"><i class='bx bx-user' ></i>Data Pasien</a></li>
            <li><a href="data_dokter.php"><i class='bx bxs-user'></i>Data Dokter</a></li>
            <li><a href="rekam_medis.php"><i class='bx bx-notepad' ></i>Rekam Medis</a></li>
            <li class="parent"><a href="#"><i class='bx bx-clinic' ></i>Poliklinik <i class='bx bx-chevron-down' ></i></a>
                <ul class="sub-menu">
                    <li><a href="func/poliumum_dokter.php">Poli Umum</a></li>
                    <li><a href="func/poligigi_dokter.php">Poli Gigi</a></li>
                    <li><a href="func/polikia_dokter.php">Poli KIA</a></li>
                </ul>
            </li>
        </ul>
        <ul class="side-menu">
            <li>
                <a href="func/logout.php" class="logout">
                    <i class='bx bx-log-out-circle' ></i>
                    Logout
                </a>
            </li>
        </ul>
    </div>
    <!-- end of sidebar -->
    <!-- main content  -->
    <div class="content">
        <!-- navbar -->
        <?php
        include 'func/part/navbar.php'
        ?>
        <!-- end of navbar  -->

        <!-- header  -->
        <main>
            <div class="header">
                <div class="left">
                    <h1>Dashboard Dokter</h1>
                    <ul class="breadcrumb">
                        <li><a href="#">Home</a></li>
                        /
                        <li><a href="#" class="active">Dashboard</a></li>
                    </ul>
                </div>
            </div>

            <!-- scan mulai  -->
            <!-- <div id="scanButtonContainer">
                <button id="scanButton" class="btn-scan">
                    <p>Scan</p>
                    <i class='bx bx-scan'></i> 
                </button>
            </div> -->
            <!-- scan selesai  -->
            
            <!-- insight -->
            <ul class="insight">
                <li>
                    <i class='bx bxs-group'></i>
                    <span class="info">
                        <h3>
                            <?php
                            if ($resultPasien && mysqli_num_rows($resultPasien) > 0) {
                                $rowPasien = mysqli_fetch_assoc($resultPasien);
                                echo $rowPasien["total_pasien"];
                            } else {
                                echo "0";
                            }
                            ?>
                        </h3>
                        <p>Pasien</p>
                    </span>
                </li>
                <li>
                    <i class='bx bx-group'></i>
                    <span class="info">
                        <h3>
                            <?php
                            if ($resultDokter && mysqli_num_rows($resultDokter) > 0) {
                                $rowDokter = mysqli_fetch_assoc($resultDokter);
                                echo $rowDokter["total_dokter"];
                            } else {
                                echo "0";
                            }
                            ?>
                        </h3>
                        <p>Dokter</p>
                    </span>
                </li>
                <li>
                    <i class='bx bx-home-heart'></i>
                    <span class="info">
                        <h3>
                            <?php
                            if ($resultRekamMedis && mysqli_num_rows($resultRekamMedis) > 0) {
                                $rowRekamMedis = mysqli_fetch_assoc($resultRekamMedis);
                                echo $rowRekamMedis["total_rekam_medis"];
                            } else {
                                echo "0";
                            }
                            ?>
                        </h3>
                        <p>Rekam Medis</p>
                    </span>
                </li>
            </ul>
            <!-- end of insight -->
        </main>
    </div>

    


    <script src="js/script.js"></script>
</body>
</html>