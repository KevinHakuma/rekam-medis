<?php
session_start();
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
            <li><a href="../data_pasien.php"><i class='bx bx-user' ></i>Data Pasien</a></li>
            <li><a href="../data_dokter.php"><i class='bx bxs-user'></i>Data Dokter</a></li>
            <li class="active"><a href="rekam_medis.php"><i class='bx bx-notepad' ></i>Rekam Medis</a></li>
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
        <nav>
            <i class='bx bx-menu-alt-left' ></i>
            <form action="#">
                <div class="form-input">
                    <input type="search" placeholder="Search">
                    <button class="search-btn" type="submit"><i class='bx bx-search' ></i></button>
                </div>
            </form>
            <input type="checkbox" id="theme-toggle" hidden>
            <label for="theme-toggle" class="theme-toggle"></label>
            <a href="#" class="notif">
                <i class='bx bx-bell' ></i>
                <span class="count">12</span>
            </a>
            <a href="#" class="profile">
                <img src="../images/profile1.png">
            </a>
        </nav>
        <!-- end of navbar  -->

        <!-- header  -->
        <main>
            <div class="header">
                <div class="left">
                    <h1>Input Rekam Medis</h1>
                    <ul class="breadcrumb">
                        <li><a href="#">Home</a></li>
                        /
                        <li><a href="#">Rekam Medis</a></li>
                        /
                        <li><a href="#" class="active">Input Rekam Medis</a></li>
                    </ul>
                </div>
                <a href="../rekam_medis.php" class="report">
                    <i class='bx bx-arrow-back'></i>
                    <span>Sebelumnya</span>
                </a>
            </div>


            <!-- tambah rekam medis mulai  -->
        <div id="step-1">
        <?php
        require_once "../auth/connect.php";

        // Ambil nilai id dari parameter URL
        $id_pasien = isset($_GET['nama']);
        $id_pasien = mysqli_real_escape_string($conn, $id_pasien);

        // Query SQL untuk mengambil data dari tabel berdasarkan id
        $query = "SELECT id, nomor_rekam_medis, nama_pasien FROM rekam_medis WHERE nama_pasien = $id_pasien";
        $result = mysqli_query($conn, $query);

        // Cek apakah query berhasil
        if ($result) {
            // Fetch data dari hasil query
            $row = mysqli_fetch_assoc($result);
        } else {
            // Tampilkan pesan kesalahan jika query gagal
            echo "Error: " . mysqli_error($conn);
            exit; // Hentikan eksekusi skrip jika terjadi kesalahan query
        }
        ?>
            <form action="input_diagnosa.php" method="post">
                <div class="form-group">
                    <label for="nomor_rekam_medis">Nomor Rekam Medis:</label>
                    <input type="text" name="nomor_rekam_medis" id="nomor_rekam_medis"  required>
                </div>
                <div class="form-group">
                    <label for="nama_pasien">Nama Pasien:</label>
                    <input type="text" name="nama_pasien" id="nama_pasien" required>
                </div>
                <div class="form-group">
                    <label for="diagnosa">Diagnosa:</label>
                    <input type="text" name="diagnosa" id="diagnosa" required>
                </div>
                <!-- Tombol submit formulir -->
                <button type="submit" value="Simpan Rekam Medis" class="form-btn">Submit</button>
            </form>
        </div>
        <!-- end of tambah rekam medis  -->


        </main>
    </div>


    <script src="../js/script.js"></script>
</body>
</html>





