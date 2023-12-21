<?php
session_start();

require_once "../auth/connect.php";

$nik = $nama = $tempat_lahir = $tanggal_lahir = $alamat = $jenis_kelamin = $status = $pekerjaan = $telepon = $poli = "";

$query_select = "SELECT nomor_rekam_medis FROM data_pasien ORDER BY nomor_rekam_medis DESC LIMIT 1";
$result_select = $conn->query($query_select);

if ($result_select->num_rows > 0) {
    $row = $result_select->fetch_assoc();
    $nomor_terakhir = sprintf("%06d", $row['nomor_rekam_medis'] + 1);
} else {
    // Tidak ada data, nomor dimulai dari 1
    $nomor_terakhir = sprintf("%06d", 1);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Ambil nilai yang dikirimkan melalui POST
    $nik = $_POST["nik"];
    $nama = $_POST["nama"];
    $tempat_lahir = $_POST["tempat_lahir"];
    $tanggal_lahir = $_POST["tanggal_lahir"];
    $alamat = $_POST["alamat"];
    $jenis_kelamin = $_POST["jenis_kelamin"];
    $status = $_POST["status"];
    $pekerjaan = $_POST["pekerjaan"];
    $telepon = $_POST["telepon"];
    $poli = $_POST["poli"];

    // Validasi nama (hanya huruf)
    if (!preg_match("/^[a-zA-Z ]*$/", $nama)) {
        echo '<script>
                alert("Nama hanya boleh mengandung huruf. Angka tidak diperbolehkan.");
                window.location.href = "input_pasien.php";
              </script>';
        exit();
    }

    $query = "INSERT INTO data_pasien (nik, nama, tempat_lahir, tanggal_lahir, alamat, jenis_kelamin, status, pekerjaan, telepon, poli, nomor_rekam_medis)
    VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($query);

    // Bind parameter, add $nomor_terakhir at the end
    $stmt->bind_param("sssssssssss", $nik, $nama, $tempat_lahir, $tanggal_lahir, $alamat, $jenis_kelamin, $status, $pekerjaan, $telepon, $poli, $nomor_terakhir);

    if ($stmt->execute()) {
        // Tampilkan SweetAlert jika berhasil
        echo '<script>
                alert("Pasien telah terdaftar!");
                window.location.href = "../data_pasien.php";
              </script>';
    } else {
        // Tampilkan pesan kesalahan jika query gagal
        echo '<script>
                alert("Terjadi kesalahan: ' . $stmt->error . '");
                window.location.href = "input_pasien.php";
              </script>';
    }

    // Tutup statement
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
            <li class="active"><a href="#"><i class='bx bx-user' ></i>Data Pasien</a></li>
            <li><a href="../data_dokter.php"><i class='bx bxs-user'></i>Data Dokter</a></li>
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
                    <h1>Input Data Pasien</h1>
                    <ul class="breadcrumb">
                        <li><a href="#">Home</a></li>
                        /
                        <li><a href="#">Data Pasien</a></li>
                        /
                        <li><a href="#" class="active">Input Data Pasien</a></li>
                    </ul>
                </div>
                <a href="../data_pasien.php" class="report">
                    <i class='bx bx-arrow-back'></i>
                    <span>Sebelumnya</span>
                </a>
            </div>

            <!-- insight -->
            
            <!-- end of insight -->

            <!-- tambah rekam medis mulai  -->
                <div id="step-1">
                    <h2>Masukan Data Pasien</h2>
                    
                    <form method="POST" action="input_pasien.php">
                        <!-- Elemen formulir Identitas Pasien -->
                        <div class="form-group">
                            <label for="no_rekam">No. Rekam Medis:</label>
                            <input type="text" name="nomor_rekam_medis" id="no_rekam" value="<?php echo $nomor_terakhir; ?>" readonly>
                        </div>

                        <div class="form-group">
                            <label for="nik">NIK Pasien:</label>
                            <input type="text" id="nik" name="nik" required>
                        </div>
                        <div class="form-group">
                            <label for="nama">Nama Pasien:</label>
                            <input type="text" id="nama" name="nama" required>
                        </div>
                        <div class="form-group">
                            <label for="tempat_lahir">Tempat Lahir:</label>
                            <input type="text" id="tempat_lahir" name="tempat_lahir" required>
                        </div>
                        <div class="form-group">
                            <label for="tanggal_lahir">Tanggal Lahir:</label>
                            <input type="date" id="tanggal_lahir" name="tanggal_lahir" required>
                        </div>
                        <div class="form-group">
                            <label for="alamat">Alamat:</label>
                            <input type="text" id="alamat" name="alamat" required>
                        </div>
                        <div class="form-group">
                            <label for="jenis_kelamin">Jenis Kelamin:</label>
                            <select id="jenis_kelamin" name="jenis_kelamin" required>
                                <option value="Laki-Laki">Laki-Laki</option>
                                <option value="perempuan">Perempuan</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="status">Status:</label>
                            <select id="status" name="status" required>
                                <option value="Lajang">Lajang</option>
                                <option value="Menikah">Menikah</option>
                                <option value="Duda">Duda</option>
                                <option value="Janda">Janda</option>
                                <option value="Bercerai">Bercerai</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="pekerjaan">Pekerjaan:</label>
                            <input type="text" id="pekerjaan" name="pekerjaan">
                        </div>
                        <div class="form-group">
                            <label for="telepon">No. Telepon:</label>
                            <input type="tel" id="telepon" name="telepon" required>
                        </div>
                        <div class="form-group">
                            <label for="poli">Poliklinik:</label>
                            <select id="poli" name="poli" required>
                                <option value="Poli Umum">Poli Umum</option>
                                <option value="Poli Gigi">Poli Gigi</option>
                                <option value="Poli KIA">Poli KIA</option>
                            </select>
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