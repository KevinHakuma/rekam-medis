<?php
session_start();

// Koneksi ke database
require_once "../auth/connect.php";

// Check if the form is submitted for updating data
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve form data
    $id_dokter = isset($_POST['id_dokter']) ? $_POST['id_dokter'] : null; // Check if 'id' is set in POST data
    $nama_dokter = $_POST['nama_dokter'];
    $spesialisasi = $_POST['spesialisasi'];
    $username = $_POST['username'];

    // Validate form data or perform other necessary checks

    if (!preg_match("/^[a-zA-Z ]*$/", $nama)) {
        echo '<script>
                alert("Nama hanya boleh mengandung huruf. Angka tidak diperbolehkan.");
                window.location.href = "data_dokter.php";
            </script>';
        exit();
    }

    // Update the record in the database
    $updateQuery = "UPDATE data_dokter SET nama_dokter='$nama_dokter', spesialisasi='$spesialisasi', username='$username' WHERE id_dokter='$id_dokter'";
    $updateResult = mysqli_query($conn, $updateQuery);

    if ($updateResult) {
        // Redirect back to the data_pasien.php page after successful update
        echo '<script>
            alert("Data pasien berhasil diperbarui!");
            window.location.href = "../data_dokter.php";
          </script>';
        exit();
    } else {
        // Handle the update error
        $error_message = "Error updating record: " . mysqli_error($conn);
        error_log($error_message); // Log the error
        echo "Internal Server Error. Please try again later."; // Display a generic error message
        exit();
    }
} elseif (isset($_GET['id_dokter'])) {
    // Fetch data based on the 'id' from the URL
    $id = $_GET['id_dokter'];

    // Retrieve data from the database using $id and populate your form
    $selectQuery = "SELECT * FROM data_dokter WHERE id_dokter='$id_dokter'";
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
    // Handle the case where the form is not submitted properly and 'id' is not set in the URL
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
            <li><a href="#"><i class='bx bx-user' ></i>Data Pasien</a></li>
            <li class="active"><a href="../data_dokter.php"><i class='bx bxs-user'></i>Data Dokter</a></li>
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
                    <h1>Update Data Dokter</h1>
                    <ul class="breadcrumb">
                        <li><a href="#">Home</a></li>
                        /
                        <li><a href="#">Data Dokter</a></li>
                        /
                        <li><a href="#" class="active">Update Data Dokter</a></li>
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
                <!-- Form untuk Update Data Pasien -->
                <div id="step-1">
                    <h2>Update Data Dokter</h2>
                    <form method="POST" action="update_data_dokter.php">
                        <!-- Elemen formulir Identitas Pasien -->
                        <input type="hidden" name="id_dokter" value="<?php echo $_GET['id_dokter']; ?>">
                        <div class="form-group">
                            <label for="nama_dokter">Nama Dokter:</label>
                            <input type="text" id="nama_dokter" name="nama_dokter" value="<?php echo $row['nama_dokter']; ?>" required>
                        </div>
                        <div class="form-group">
                            <label for="username">username:</label>
                            <input type="text" id="username" name="username" value="<?php echo $row['username']; ?>" required>
                        </div>
                        <div class="form-group">
                            <label for="spesialisasi">Spesialisasi:</label>
                            <select id="spesialisasi" name="spesialisasi" required>
                                <option value="Dokter Umum" <?php if ($row['spesialisasi'] == "Dokter Umum") echo "selected"; ?>>Dokter Umum</option>
                                <option value="Dokter Gigi" <?php if ($row['spesialisasi'] == "Dokter Gigi") echo "selected"; ?>>Dokter Gigi</option>
                                <option value="Dokter KIA" <?php if ($row['spesialisasi'] == "Dokter KIA") echo "selected"; ?>>Dokter KIA</option>
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