<?php
// Start the session
session_start();

// Include the database connection file
require_once "../auth/connect.php";

// Check if the form is submitted for updating data
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve form data
    $id = isset($_POST['id']) ? $_POST['id'] : null;
    $nik = isset($_POST['nik']) ? $_POST['nik'] : null;
    $nama = isset($_POST['nama']) ? $_POST['nama'] : null;
    $tempat_lahir = isset($_POST['tempat_lahir']) ? $_POST['tempat_lahir'] : null;
    $tanggal_lahir = isset($_POST['tanggal_lahir']) ? $_POST['tanggal_lahir'] : null;
    $alamat = isset($_POST['alamat']) ? $_POST['alamat'] : null;
    $jenis_kelamin = isset($_POST['jenis_kelamin']) ? $_POST['jenis_kelamin'] : null;
    $status = isset($_POST['newStatus']) ? $_POST['newStatus'] : null;
    $pekerjaan = isset($_POST['pekerjaan']) ? $_POST['pekerjaan'] : null;
    $telepon = isset($_POST['telepon']) ? $_POST['telepon'] : null;
    $poli = isset($_POST['poli']) ? $_POST['poli'] : null;
    $no_rekam = isset($_POST['nomor_rekam_medis']) ? $_POST['nomor_rekam_medis'] : null;

    // Validate form data or perform other necessary checks
    if (!preg_match("/^[a-zA-Z ]*$/", $nama)) {
        echo '<script>
                alert("Nama hanya boleh mengandung huruf. Angka tidak diperbolehkan.");
                window.location.href = "input_pasien.php";
            </script>';
        exit();
    }

    // Update the record in the 'data_pasien' table
    $updateQuery = "UPDATE data_pasien 
                    SET nik='$nik', nama='$nama', tempat_lahir='$tempat_lahir', tanggal_lahir='$tanggal_lahir', alamat='$alamat', jenis_kelamin='$jenis_kelamin', status='$status', pekerjaan='$pekerjaan', telepon='$telepon', poli='$poli' 
                    WHERE id='$id'";
    $updateResult = mysqli_query($conn, $updateQuery);

    // Update the 'nama' field in the 'rekam_medis' table
    $updateRekamMedisQuery = "UPDATE rekam_medis SET nama_pasien=? WHERE data_pasien_id=?";
    $updateRekamMedisStatement = mysqli_prepare($conn, $updateRekamMedisQuery);
    mysqli_stmt_bind_param($updateRekamMedisStatement, "si", $nama, $id);

// Execute the update statement for 'rekam_medis'
    $updateRekamMedisResult = mysqli_stmt_execute($updateRekamMedisStatement);

    if ($updateResult && $updateRekamMedisResult) {
        // Redirect back to the 'data_pasien.php' page after a successful update
        echo '<script>
            alert("Data pasien berhasil diperbarui!");
            window.location.href = "../data_pasien.php";
          </script>';
        exit();
    } else {
        // Handle the update error
        $error_message = "Error updating record: " . mysqli_error($conn);
        error_log($error_message); // Log the error
        echo "Internal Server Error. Please try again later."; // Display a generic error message
        exit();
    }
} elseif (isset($_GET['id'])) {
    // Fetch data based on the 'id' from the URL
    $id = $_GET['id'];

    // Retrieve data from the database using $id and populate your form
    $selectQuery = "SELECT * FROM data_pasien WHERE id='$id'";
    $selectResult = mysqli_query($conn, $selectQuery);

    if ($selectResult) {
        $row = mysqli_fetch_assoc($selectResult);

        // Ensure that you handle the case where $row is empty (id not found in the database)
        // ...

    } else {
        // Handle the query error
        $error_message = "Error fetching record: " . mysqli_error($conn);
        error_log($error_message); // Log the error
        echo "Internal Server Error. Please try again later."; // Display a generic error message
        exit();
    }
} else {
    // Handle the case where the form is not submitted properly, and 'id' is not set in the URL
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
                    <h1>Update Data Pasien</h1>
                    <ul class="breadcrumb">
                        <li><a href="#">Home</a></li>
                        /
                        <li><a href="#">Data Pasien</a></li>
                        /
                        <li><a href="#" class="active">Update Data Pasien</a></li>
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
                <!-- Form untuk Update Data Pasien -->
                <div id="step-1">
                    <h2>Update Data Pasien</h2>
                    <form method="POST" action="update_data.php">
                        <!-- Elemen formulir Identitas Pasien -->
                        <input type="hidden" name="id" value="<?php echo isset($_GET['id']) ? $_GET['id'] : ''; ?>">
                        <div class="form-group">
                            <label for="nik">NIK Pasien:</label>
                            <input type="text" id="nik" name="nik" value="<?php echo isset($row['nik']) ? $row['nik'] : ''; ?>" required>
                        </div>
                        <div class="form-group">
                            <label for="nama">Nama Pasien:</label>
                            <input type="text" id="nama" name="nama" value="<?php echo isset($row['nama']) ? $row['nama'] : ''; ?>" required>
                        </div>
                        <div class="form-group">
                            <label for="tempat_lahir">Tempat Lahir:</label>
                            <input type="text" id="tempat_lahir" name="tempat_lahir" value="<?php echo isset($row['tempat_lahir']) ? $row['tempat_lahir'] : ''; ?>" required>
                        </div>
                        <div class="form-group">
                            <label for="tanggal_lahir">Tanggal Lahir:</label>
                            <input type="date" id="tanggal_lahir" name="tanggal_lahir" value="<?php echo isset($row['tanggal_lahir']) ? $row['tanggal_lahir'] : ''; ?>" required>
                        </div>
                        <div class="form-group">
                            <label for="alamat">Alamat:</label>
                            <input type="text" id="alamat" name="alamat" value="<?php echo isset($row['alamat']) ? $row['alamat'] : ''; ?>" required>
                        </div>
                        <div class="form-group">
                            <label for="jenis_kelamin">Jenis Kelamin:</label>
                            <select id="jenis_kelamin" name="jenis_kelamin" required>
                                <option value="Laki-Laki" <?php if (isset($row['jenis_kelamin']) && $row['jenis_kelamin'] == "Laki-Laki") echo "selected"; ?>>Laki-Laki</option>
                                <option value="Perempuan" <?php if (isset($row['jenis_kelamin']) && $row['jenis_kelamin'] == "Perempuan") echo "selected"; ?>>Perempuan</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="newStatus">Status:</label>
                            <select id="newStatus" name="newStatus" required>
                                <option value="Lajang" <?php if (isset($row['status']) && $row['status'] == "Lajang") echo "selected"; ?>>Lajang</option>
                                <option value="Menikah" <?php if (isset($row['status']) && $row['status'] == "Menikah") echo "selected"; ?>>Menikah</option>
                                <option value="Duda" <?php if (isset($row['status']) && $row['status'] == "Duda") echo "selected"; ?>>Duda</option>
                                <option value="Janda" <?php if (isset($row['status']) && $row['status'] == "Janda") echo "selected"; ?>>Janda</option>
                                <option value="Bercerai" <?php if (isset($row['status']) && $row['status'] == "Bercerai") echo "selected"; ?>>Bercerai</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="pekerjaan">Pekerjaan:</label>
                            <input type="text" id="pekerjaan" name="pekerjaan" value="<?php echo isset($row['pekerjaan']) ? $row['pekerjaan'] : ''; ?>">
                        </div>
                        <div class="form-group">
                            <label for="telepon">No. Telepon:</label>
                            <input type="tel" id="telepon" name="telepon" value="<?php echo isset($row['telepon']) ? $row['telepon'] : ''; ?>" required>
                        </div>
                        <div class="form-group">
                            <label for="poli">Poliklinik:</label>
                            <select id="poli" name="poli" required>
                                <option value="Poli Umum" <?php if (isset($row['poli']) && $row['poli'] == "Poli Umum") echo "selected"; ?>>Poli Umum</option>
                                <option value="Poli Gigi" <?php if (isset($row['poli']) && $row['poli'] == "Poli Gigi") echo "selected"; ?>>Poli Gigi</option>
                                <option value="Poli KIA" <?php if (isset($row['poli']) && $row['poli'] == "Poli KIA") echo "selected"; ?>>Poli KIA</option>
                            </select>
                        </div>
                        <button type="submit" class="form-btn">Update Data</button>
                    </form>
                </div>
            <!-- end of tambah rekam medis  -->

        </main>
    </div>

    <script src="../js/script.js"></script>
</body>
</html>
