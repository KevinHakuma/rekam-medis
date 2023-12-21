<?php
session_start();

require_once "../auth/connect.php";

$id = $nama = $spesialisasi = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // $id = $_POST["id_dokter"];
    $nama = $_POST["nama_dokter"];
    $spesialisasi = $_POST["spesialisasi"];
    
    $query = "INSERT INTO data_pasien (nama_dokter, spesialisasi)
              VALUES ('$nama_dokter', '$spesialisasi')";
    
    if ($conn->query($query) === TRUE) {
        // Tampilkan SweetAlert jika berhasil
        echo '<script>
                alert("Dokter telah terdaftar!");
                window.location.href = "../data_dokter.php";
              </script>';
    } else {
        echo "Error: " . $query . "<br>" . $conn->error;
    }
    
    $conn->close();
}
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <script src="js/jquery-3.7.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <!-- link css  -->
    <link rel="stylesheet" href="../css/style.css">
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
            <li><a href="#"><i class='bx bx-user' ></i>Data Pasien</a></li>
            <li class="active"><a href="../data_dokter.php"><i class='bx bxs-user'></i>Data Dokter</a></li>
            <li><a href="../rekam_medis.php"><i class='bx bx-notepad' ></i>Rekam Medis</a></li>
            <li class="parent"><a href="#"><i class='bx bx-clinic' ></i>Poliklinik <i class='bx bx-chevron-down' ></i></a>
                <ul class="sub-menu">
                    <li><a href="poliumum_dokter.php">Poli Umum</a></li>
                    <li><a href="poligigi_dokter.php">Poli Gigi</a></li>
                    <li><a href="polikia_dokter.php">Poli KIA</a></li>
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
                    <h1>Input Data Dokter</h1>
                    <ul class="breadcrumb">
                        <li><a href="#">Home</a></li>
                        /
                        <li><a href="#">Data Dokter</a></li>
                        /
                        <li><a href="#" class="active">Input Data Dokter</a></li>
                    </ul>
                </div>
                <a href="../data_dokter.php" class="report">
                    <i class='bx bx-arrow-back'></i>
                    <span>Sebelumnya</span>
                </a>
            </div>

            <!-- insight -->
            
            <!-- end of insight -->

            <!-- tambah rekam medis mulai  -->
                <div id="step-1">
                    <h2>Masukan Data Dokter</h2>
                    <form method="POST" action="">
                        <!-- Elemen formulir Identitas Pasien -->
                        <div class="form-group">
                            <label for="nama">Nama Dokter:</label>
                            <input type="text" id="nama" name="nama" required>
                        </div>
                        <div class="form-group">
                            <label for="tempat_lahir">Spesialis:</label>
                            <input type="text" id="Spesialisasi" name="Spesialisasi" required>
                        </div>
                        <button type="submit" class="form-btn">Submit</button>
                    </form>
                </div>
            <!-- end of tambah rekam medis  -->

        </main>
    </div>


    <script src="../js/script.js"></script>
</body>
</html>