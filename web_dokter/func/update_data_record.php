<?php
session_start();

// Koneksi ke database
require_once "../auth/connect.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve form data
    $id_dokter = isset($_POST['id']) ? $_POST['id'] : null;
    $nama_pasien = $_POST['nama_pasien'];
    $keluhan_utama = $_POST['keluhan_utama'];
    $keluhan_tambahan = $_POST['keluhan_tambahan'];
    $berat_badan = $_POST['berat_badan'];

    $cara_berjalan = "";
    if (isset($_POST["cara_berjalan"])) {
        $cara_berjalan = implode(", ", $_POST["cara_berjalan"]);
    }

    $menopang_duduk = $_POST['menopang_duduk'];
    $imt_kurang = $_POST['imt_kurang'];
    $kehilangan_bb = $_POST['kehilangan_bb'];
    $penurupan_asupan = $_POST['penurupan_asupan'];
    $sakit_berat = $_POST['sakit_berat'];
    $diagnosa = $_POST['diagnosa'];

    if (!preg_match("/^[a-zA-Z ]*$/", $nama_pasien)) {
        echo '<script>
                alert("Nama hanya boleh mengandung huruf. Angka tidak diperbolehkan.");
                window.location.href = "data_dokter.php";
            </script>';
        exit();
    }

    $updateQuery = "UPDATE rekam_medis SET nama_pasien='$nama_pasien', keluhan_utama='$keluhan_utama', keluhan_tambahan='$keluhan_tambahan', berat_badan='$berat_badan', cara_berjalan='$cara_berjalan', menopang_duduk='$menopang_duduk', imt_kurang='$imt_kurang', kehilangan_bb='$kehilangan_bb', penurunan_asupan='$penurunan_asupan', sakit_berat='$sakit_berat', diagnosa='$diagnosa' WHERE id='$id_dokter'";
    $updateResult = mysqli_query($conn, $updateQuery);

    if ($updateResult) {
        echo '<script>
            alert("Data pasien berhasil diperbarui!");
            window.location.href = "../rekam_medis.php";
          </script>';
        exit();
    } else {
        $error_message = "Error updating record: " . mysqli_error($conn);
        error_log($error_message);
        echo "Internal Server Error. Please try again later.";
        exit();
    }
} elseif (isset($_GET['id'])) {
    $id = $_GET['id'];
    $selectQuery = "SELECT * FROM rekam_medis WHERE id='$id'";
    $selectResult = mysqli_query($conn, $selectQuery);

    if ($selectResult) {
        $row = mysqli_fetch_assoc($selectResult);
    } else {
        $error_message = "Error fetching record: " . mysqli_error($conn);
        error_log($error_message);
        echo "Internal Server Error. Please try again later.";
        exit();
    }
} else {
    echo "Invalid form submission";
    exit();
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
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="../css/sweetalert2.min.css">
    <title>Rekam Medis</title>
</head>
<body>

    <div class="sidebar">
        <a href="#" class="logo" id="logo">
            <img src="../images/logo.png" alt="">
            <div class="logo-name"><span>Klinik</span><br><span>Bhayangkara</span><br><span>Polres Madiun</span></div>
        </a>
        <ul class="side-menu">
            <li><a href="../index.php"><i class='bx bxs-dashboard'></i>Dashboard</a></li>
            <li><a href="#"><i class='bx bx-user' ></i>Data Pasien</a></li>
            <li><a href="../data_dokter.php"><i class='bx bxs-user'></i>Data Dokter</a></li>
            <li class="active"><a href="../rekam_medis.php"><i class='bx bx-notepad' ></i>Rekam Medis</a></li>
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

    <div class="content">
        <?php
        include 'part/navbar.php'
        ?>
        <main>
            <div class="header">
                <div class="left">
                    <h1>Update Data Rekam Medis</h1>
                    <ul class="breadcrumb">
                        <li><a href="#">Home</a></li>
                        /
                        <li><a href="#">Rekam Medis</a></li>
                        /
                        <li><a href="#" class="active">Update Data Rekam Medis</a></li>
                    </ul>
                </div>
                <a href="../data_dokter.php" class="report">
                    <i class='bx bx-arrow-back'></i>
                    <span>Sebelumnya</span>
                </a>
            </div>

            <div id="step-1">
                <h2>Update Data Rekam Medis</h2>
                <form method="POST" action="update_data_record.php">
                <input type="hidden" name="id" value="<?php echo $_GET['id']; ?>">
                        <div class="form-group">
                            <label for="nama_pasien">Nama Pasien:</label>
                            <input type="text" id="nama_pasien" name="nama_pasien" value="<?php echo isset($row['nama_pasien']) ? $row['nama_pasien'] : ''; ?>">
                        </div>
                        <div class="form-group">
                            <label for="keluhan_utama">Keluhan Utama:</label>
                            <input type="text" id="keluhan_utama" name="keluhan_utama" value="<?php echo isset($row['keluhan_utama']) ? $row['keluhan_utama'] : ''; ?>">
                        </div>
                        <div class="form-group">
                            <label for="keluhan_tambahan">Keluhan Tambahan:</label>
                            <input type="text" id="keluhan_tambahan" name="keluhan_tambahan" value="<?php echo isset($row['keluhan_tambahan']) ? $row['keluhan_tambahan'] : ''; ?>">
                        </div>
                        <div class="form-group">
                            <label for="berat_badan">Berat Badan (kg):</label>
                            <input type="number" name="berat_badan" id="berat_badan" step="0.01" value="<?php echo isset($row['berat_badan']) ? $row['berat_badan'] : ''; ?>">
                        </div>
                        <div class="form-group">
                            <label>Cara Berjalan Pasien:</label>
                            <br>
                            <input type="checkbox" name="cara_berjalan[]" value="Tidak Seimbang" <?php echo (isset($row['cara_berjalan']) && strpos($row['cara_berjalan'], 'Tidak Seimbang') !== false) ? 'checked' : ''; ?>> Tidak Seimbang / Sempoyongan / Limbung
                            <br>
                            <input type="checkbox" name="cara_berjalan[]" value="Menggunakan Alat Bantu" <?php echo (isset($row['cara_berjalan']) && strpos($row['cara_berjalan'], 'Menggunakan Alat Bantu') !== false) ? 'checked' : ''; ?>> Menggunakan Alat Bantu
                        </div>
                        <div class="form-group">
                            <label for="menopang_duduk">Menopang Saat Duduk:</label>
                            <input type="text" name="menopang_duduk" id="menopang_duduk" value="<?php echo isset($row['menopang_duduk']) ? $row['menopang_duduk'] : ''; ?>">
                        </div>

                        <div class="form-group">
                            <label>IMT < 18 kg/m2:</label>
                            <input type="radio" name="imt_kurang" value="Ya" <?php echo (isset($row['imt_kurang']) && $row['imt_kurang'] == 'Ya') ? 'checked' : ''; ?>> Ya
                            <input type="radio" name="imt_kurang" value="Tidak" <?php echo (isset($row['imt_kurang']) && $row['imt_kurang'] == 'Tidak') ? 'checked' : ''; ?>> Tidak
                        </div>
                        <div class="form-group">
                            <label>Kehilangan BB dalam 3 Bulan Terakhir:</label>
                            <input type="radio" name="kehilangan_bb" value="Ya" <?php echo (isset($row['kehilangan_bb']) && $row['kehilangan_bb'] == 'Ya') ? 'checked' : ''; ?>> Ya
                            <input type="radio" name="kehilangan_bb" value="Tidak" <?php echo (isset($row['kehilangan_bb']) && $row['kehilangan_bb'] == 'Tidak') ? 'checked' : ''; ?>> Tidak
                        </div>
                        <div class="form-group">
                            <label>Penurunan Asupan Makanan 1 Minggu Terakhir:</label>
                            <input type="radio" name="penurunan_asupan" value="Ya" <?php echo (isset($row['penurunan_asupan']) && $row['penurunan_asupan'] == 'Ya') ? 'checked' : ''; ?>> Ya
                            <input type="radio" name="penurunan_asupan" value="Tidak" <?php echo (isset($row['penurunan_asupan']) && $row['penurunan_asupan'] == 'Tidak') ? 'checked' : ''; ?>> Tidak
                        </div>
                    <div class="form-group">
                        <label for="sakit_berat">Apakah Pasien Mengalami Sakit Berat? Jelaskan:</label>
                        <input type="text" name="sakit_berat" id="sakit_berat" value="<?php echo isset($row['sakit_berat']) ? $row['sakit_berat'] : ''; ?>">
                    </div>
                    <div class="form-group">
                        <label for="diagnosa">Diagnosa:</label>
                        <input type="text" name="diagnosa" id="diagnosa" value="<?php echo isset($row['diagnosa']) ? $row['diagnosa'] : ''; ?>">
                    </div>
                    <button type="submit" class="form-btn">Update Data</button>
                </form>
            </div>
        </main>
    </div>

    <script src="../js/script.js"></script>
</body>
</html>
