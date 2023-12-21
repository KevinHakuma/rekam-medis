<?php
session_start();

require_once "../auth/connect.php"; // Pastikan Anda telah membuat koneksi database

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Ambil data dari formulir input
    $nomor_rekam_medis = $_POST["nomor_rekam_medis"];
    $nama_pasien = $_POST["nama_pasien_input"]; // Mengambil nama pasien dari input tersembunyi
    $keluhan_utama = $_POST["keluhan_utama"];
    $keluhan_tambahan = $_POST["keluhan_tambahan"];
    $berat_badan = $_POST["berat_badan"];

    // Ambil nilai dari checkbox cara_berjalan
    $cara_berjalan = "";
    if (isset($_POST["cara_berjalan"])) {
        $cara_berjalan = implode(", ", $_POST["cara_berjalan"]);
    }

    $menopang_duduk = $_POST["menopang_duduk"];
    $imt_kurang = $_POST["imt_kurang"];
    $kehilangan_bb = $_POST["kehilangan_bb"];
    $penurunan_asupan = $_POST["penurunan_asupan"];
    $sakit_berat = $_POST["sakit_berat"];
    // $diagnosa = $_POST["diagnosa"];

    // Query SQL untuk menyimpan data rekam medis ke dalam tabel rekam_medis
    $query = "INSERT INTO rekam_medis (nomor_rekam_medis, nama_pasien, keluhan_utama, keluhan_tambahan, berat_badan, cara_berjalan, menopang_duduk, imt_kurang, kehilangan_bb, penurunan_asupan, sakit_berat)
              VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

    // Menggunakan prepared statement untuk mencegah SQL Injection
    $stmt = $conn->prepare($query);
    $stmt->bind_param("sssssssssss", $nomor_rekam_medis, $nama_pasien, $keluhan_utama, $keluhan_tambahan, $berat_badan, $cara_berjalan, $menopang_duduk, $imt_kurang, $kehilangan_bb, $penurunan_asupan, $sakit_berat);

    if ($stmt->execute()) {
        // Tampilkan SweetAlert jika berhasil
        echo '<script>
                alert("Data rekam medis berhasil disimpan!");
                window.location.href = "../rekam_medis.php";
              </script>';
    } else {
        echo "Error: " . $stmt->error;
    }

    // Tutup statement
    $stmt->close();
    
    // Tutup koneksi
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
            <li><a href="../data_pasien.php"><i class='bx bx-user' ></i>Data Pasien</a></li>
            <li><a href="../data_dokter.php"><i class='bx bxs-user'></i>Data Dokter</a></li>
            <li class="active"><a href="rekam_medis.php"><i class='bx bx-notepad' ></i>Data Rekam Medis</a></li>
            <!-- <li class="parent"><a href="#"><i class='bx bx-clinic' ></i>Poliklinik <i class='bx bx-chevron-down' ></i></a>
                <ul class="sub-menu">
                    <li><a href="poliumum_dokter.php">Poli Umum</a></li>
                    <li><a href="poligigi_dokter.php">Poli Gigi</a></li>
                    <li><a href="polikia_dokter.php">Poli KIA</a></li>
                </ul> -->
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
                <form action="proses_rekam_medis.php" method="POST">
                    <div class="form-group">
                        <label for="nomor_rekam_medis">Nomor Rekam Medis:</label>
                        <input type="text" name="nomor_rekam_medis" id="nomor_rekam_medis" required >
                    </div>
                    <div class="form-group">
                        <label for="nama_pasien">Nama Pasien:</label>
                        <select name="nama_pasien" id="nama_pasien" onchange="setNomorRekamMedis()">
                            <option value="">Pilih Nama Pasien</option>
                            <?php
                            $result = mysqli_query($conn, "SELECT id, nama, nomor_rekam_medis FROM data_pasien");

                            while ($row = mysqli_fetch_assoc($result)) {
                                // Atur value pada opsi sesuai kebutuhan
                                echo '<option value="' . $row['id'] . ',' . $row['nama'] . ',' . $row['nomor_rekam_medis'] . '">' . $row['nama'] . '</option>';
                            }
                            ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <input type="hidden" name="nama_pasien_input" id="nama_pasien_input">
                    </div>

                    <!-- A. anamesa -->
                    <div class="form-group">
                        <h3>A. Anamesa</h3>
                        <label for="keluhan_utama">1. Keluhan Utama:</label>
                        <input type="text" name="keluhan_utama" id="keluhan_utama" required>
                    </div>
                    <div class="form-group">
                        <label for="keluhan_tambahan">2. Keluhan Tambahan:</label>
                        <input type="text" name="keluhan_tambahan" id="keluhan_tambahan">
                    </div>

                    <!-- B. Pemeriksaan Fisik -->
                    <div class="form-group">
                        <h3>B. Pemeriksaan Fisik</h3>
                        <label for="berat_badan">1. Berat Badan (kg):</label>
                        <input type="number" name="berat_badan" id="berat_badan" step="0.01" required>
                    </div>

                    <!-- C. Resiko Jatuh -->
                    <div class="form-group">
                        <h3>C. Resiko Jatuh</h3>
                        <label>1. Cara Berjalan Pasien:</label>
                        <br>
                        <input type="checkbox" name="cara_berjalan[]" value="Tidak Seimbang"> Tidak Seimbang / Sempoyongan / Limbung
                        <br>
                        <input type="checkbox" name="cara_berjalan[]" value="Menggunakan Alat Bantu"> Menggunakan Alat Bantu
                    </div>
                    <div class="form-group">
                        <label for="menopang_duduk">2. Menopang Saat Duduk:</label>
                        <input type="text" name="menopang_duduk" id="menopang_duduk">
                    </div>

                    <!-- E. Status Nutrisi -->
                    <div class="form-group">
                        <h3>E. Status Nutrisi</h3>
                        <label>1. IMT < 18 kg/m2:</label>
                        <input type="radio" name="imt_kurang" value="Ya"> Ya
                        <input type="radio" name="imt_kurang" value="Tidak"> Tidak
                    </div>
                    <div class="form-group">
                        <label>2. Kehilangan BB dalam 3 Bulan Terakhir:</label>
                        <input type="radio" name="kehilangan_bb" value="Ya"> Ya
                        <input type="radio" name="kehilangan_bb" value="Tidak"> Tidak
                    </div>
                    <div class="form-group">
                        <label>3. Penurunan Asupan Makanan 1 Minggu Terakhir:</label>
                        <input type="radio" name="penurunan_asupan" value="Ya"> Ya
                        <input type="radio" name="penurunan_asupan" value="Tidak"> Tidak
                    </div>
                    <div class="form-group">
                        <label for="sakit_berat">4. Apakah Pasien Mengalami Sakit Berat? Jelaskan:</label>
                        <input type="text" name="sakit_berat" id="sakit_berat">
                    </div>

                    <!-- <div class="form-group">
                        <h3>F. Diagnosa</h3>
                        <label for="diagnosa">1. Diagnosa:</label>
                        <input type="text" name="diagnosa" id="diagnosa">
                    </div> -->

                    <button type="submit" value="Simpan Rekam Medis" class="form-btn">Submit</button>
                </form>
                </div>
            <!-- end of tambah rekam medis  -->

        </main>
    </div>


    <script src="../js/script.js"></script>
    <script>
    function setNomorRekamMedis() {
        const namaPasienSelect = document.getElementById("nama_pasien");
        const nomorRekamMedisInput = document.getElementById("nomor_rekam_medis");
        const selectedOption = namaPasienSelect.options[namaPasienSelect.selectedIndex];

        if (selectedOption.value !== "") {
            // Memecah nilai terpilih menjadi ID, Nama Pasien, dan Nomor Rekam Medis
            const [id, namaPasien, nomorRekamMedis] = selectedOption.value.split(",");
            nomorRekamMedisInput.value = nomorRekamMedis;
            nomorRekamMedisInput.dataset.id = id; // Menetapkan ID ke atribut data

            // Anda juga dapat memasukkan nama pasien ke dalam input tersembunyi jika Anda ingin
            const namaPasienInput = document.getElementById("nama_pasien_input");
            namaPasienInput.value = namaPasien;
        } else {
            nomorRekamMedisInput.value = "";
            nomorRekamMedisInput.dataset.id = ""; // Menghapus ID jika tidak ada pilihan

            // Kosongkan input nama pasien jika tidak ada pilihan
            const namaPasienInput = document.getElementById("nama_pasien_input");
            namaPasienInput.value = "";
        }
    }

    </script>
</body>
</html>