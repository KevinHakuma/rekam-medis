<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <!-- link css  -->
    <link rel="stylesheet" href="../css/detail_pasien_style.css">
    <link rel="stylesheet" href="../css/sweetalert2.min.css">
    <title>Rekam Medis</title>
</head>
<body>

    <!-- sidebar -->
    <div class="sidebar">
        <a href="#" class="logo" id="logo">
            <img src="../images/logo.png" alt="">
            <div class="logo-name"><span>Klinik</span><br><span>Bhayangkara</span><br><span>Polres Madiun</span></div>
        </a>
        <ul class="side-menu">
            <li><a href="../index.php"><i class='bx bxs-dashboard'></i>Dashboard</a></li>
            <li><a href="../data_pasien.php"><i class='bx bx-user' ></i>Data Pasien</a></li>
            <li><a href="../data_dokter.php"><i class='bx bxs-user'></i>Data Dokter</a></li>
            <li class="active"><a href="rekam_medis.php"><i class='bx bx-notepad' ></i>Rekam Medis</a></li>
            <li class="parent"><a href="#"><i class='bx bx-clinic' ></i>Poliklinik <i class='bx bx-chevron-down' ></i></a>
                <ul class="sub-menu">
                    <li><a href="poliumum.php">Poli Umum</a></li>
                    <li><a href="poligigi.php">Poli Gigi</a></li>
                    <li><a href="polikia.php">Poli KIA</a></li>
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
        include 'part/navbar.php'
        ?>
        <!-- end of navbar  -->

        <!-- header  -->
        <main>
            <div class="header">
                <div class="left">
                    <h1>Detail Pasien</h1>
                    <ul class="breadcrumb">
                        <li><a href="#">Home</a></li>
                        /
                        <li><a href="#">Data Dokter</a></li>
                        /
                        <li><a href="#" class="active">Detail Pasien</a></li>
                    </ul>
                </div>
                <a href="#" class="report">
                    <i class='bx bx-layer-plus'></i>
                    <span>Tambah Data Dokter</span>
                </a>
            </div>

            <!-- start data dokter -->
            <div class="table-container">
                <?php
                require_once "../auth/connect.php";
                $namaPasien = $_GET['nama'];
                $query = "SELECT * FROM rekam_medis WHERE nama_pasien = '$namaPasien'";

                $result = $conn->query($query);
                echo "<script>generateQRCode('$namaPasien');</script>";

                if ($result->num_rows > 0) {
                    $row = $result->fetch_assoc();
                ?>


                <div class="judul-table">
                    <h4>Detail Rekam Medis</h4>
                </div>
                <div class="content-detail">
                <table>                      
                            <tr>
                                <th>Nama Pasien</th>
                                <th>:</th>
                                <td><?php echo $row["nama_pasien"]; ?></td>
                            </tr>
                            <tr>
                                <th>Keluhan Utama</th>
                                <th>:</th>
                                <td><?php echo $row["keluhan_utama"]; ?></td>
                            </tr>
                            <tr>
                                <th>Keluhan Tambahan</th>
                                <th>:</th>
                                <td><?php echo $row["keluhan_tambahan"]; ?></td>
                            </tr>
                            <tr>
                                <th>Berat Badan (kg)</th>
                                <th>:</th>
                                <td><?php echo $row["berat_badan"]; ?></td>
                            </tr>
                            <tr>
                                <th>Cara Berjalan</th>
                                <th>:</th>
                                <td><?php echo $row["cara_berjalan"]; ?></td>
                            </tr>
                            <tr>
                                <th>Menopang Saat Duduk</th>
                                <th>:</th>
                                <td><?php echo $row["menopang_duduk"]; ?></td>
                            </tr>
                            <tr>
                                <th>IMT Kurang</th>
                                <th>:</th>
                                <td><?php echo $row["imt_kurang"]; ?></td>
                            </tr>
                            <tr>
                                <th>Kehilangan BB dalam 3 Bulan Terakhir</th>
                                <th>:</th>
                                <td><?php echo $row["kehilangan_bb"]; ?></td>
                            </tr>
                            <tr>
                                <th>Penurunan Asupan Makanan 1 Minggu Terakhir</th>
                                <th>:</th>
                                <td><?php echo $row["penurunan_asupan"]; ?></td>
                            </tr>
                            <tr>
                                <th>Apakah Pasien Mengalami Sakit Berat? Jelaskan</th>
                                <th>:</th>
                                <td><?php echo $row["sakit_berat"]; ?></td>
                            </tr>
                            <tr>
                                <th>Diagnosa</th>
                                <th>:</th>
                                <td><?php echo $row["diagnosa"]; ?></td>
                            </tr>
                            <tr>
                                <th>Waktu Input</th>
                                <th>:</th>
                                <td><?php echo $row["waktu_input"]; ?></td>
                            </tr>
                    </table>
                    <?php
                    } else {
                        echo "Tidak ada data pasien dengan nama tersebut.";
                    }
                    $conn->close();
                    ?>
                </div>
                <div class="table-footer">

                </div>
            </div>
            <!-- end of data dokter  -->

        </main>
    </div>

    


    <script src="../js/script.js"></script>
</body>
</html>