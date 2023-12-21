<!-- Kode HTML Anda -->


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
    <!-- link css  -->
    <!-- <link rel="stylesheet" href="css/style.css"> -->
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
            <li><a href="index.php"><i class='bx bxs-dashboard'></i>Dashboard</a></li>
            <li><a href="data_pasien.php"><i class='bx bx-user' ></i>Data Pasien</a></li>
            <li class="active"><a href="data_dokter.php"><i class='bx bxs-user'></i>Data Dokter</a></li>
            <li><a href="rekam_medis.php"><i class='bx bx-notepad' ></i>Rekam Medis</a></li>
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
                    <h1>Detail Profile</h1>
                    <ul class="breadcrumb">
                        <li><a href="#">Home</a></li>
                        /
                        <li><a href="#">Data Dokter</a></li>
                        /
                        <li><a href="#" class="active">Detail Profile</a></li>
                    </ul>
                </div>
                <!-- <a href="/rekamMedis/func/input_dokter.php" class="report">
                    <i class='bx bx-layer-plus'></i>
                    <span>Tambah Data Dokter</span>
                </a> -->
            </div>

            <!-- start data dokter -->
            <?php
session_start();

// Periksa apakah pengguna telah login atau tidak
if (!isset($_SESSION['user_id'])) {
    header("Location: http://locahost/rekamMedis");
    exit;
}

// require_once "../auth/connect.php";
$conn = new mysqli("localhost", "root", "", "medical_record");

$user_id = $_SESSION['user_id'];
$query = "SELECT id_dokter, nama_dokter, spesialisasi FROM data_dokter WHERE id_dokter = $user_id";
$result = $conn->query($query);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();

    // Proses pembaruan data profil di sini
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $new_name = $_POST['new_name'];
        $new_spesialis = $_POST['new_spesialis'];

        // Lakukan validasi data yang diperlukan di sini

        // Lakukan pembaruan data ke dalam database
        $update_query = "UPDATE data_dokter SET nama_dokter = '$new_name', spesialisasi = '$new_spesialis' WHERE id_dokter = $user_id";
        if ($conn->query($update_query) === TRUE) {
            echo "";
        } else {
            echo "Error: " . $conn->error;
        }
    }
?>
            <div id="step-1">
                <h2>Detail Profile</h2>
                <form method="post" action="">
                    <div class="form-group">
                        <label for="new_name">Nama Dokter:</label>
                        <input type="text" name="new_name" value="<?php echo $row['nama_dokter']; ?>">
                    </div>
                    
                    <div class="form-group">
                        <label for="new_spesialis">Spesialisasi:</label>
                        <input type="text" name="new_spesialis" value="<?php echo $row['spesialisasi']; ?>">
                    </div>

                    <button type="submit" class="form-btn">Submit</button>
                </form>
            </div>
            <!-- end of data dokter  -->

        </main>
    </div>

    <script src="../js/script.js"></script>
</body>
</html>


<?php
} else {
    echo "Data pengguna tidak ditemukan.";
}

?>