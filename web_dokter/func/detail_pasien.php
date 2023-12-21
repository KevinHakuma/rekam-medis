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

    <!-- main content  -->
    <div class="content">
        <!-- navbar -->
        <!-- end of navbar  -->

        <!-- header  -->
        <main>
            <div class="header">
                <div class="left">
                    <h1>Detail Pasien</h1>
                    <ul class="breadcrumb">
                        <button id="downloadButton" class="download" onclick="downloadPDF()"><i class='bx bx-cloud-download'></i>
                        <span>Download</span></buttons> 
                    </ul>
                </div>
                <a href="../index.php" class="back">
                    <i class='bx bx-left-arrow-alt'></i>
                    <span>Kembali</span>
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
                                <th>No. Rekam Medis</th>
                                <th>:</th>
                                <td><?php echo $row["nomor_rekam_medis"]; ?></td>
                            </tr>
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