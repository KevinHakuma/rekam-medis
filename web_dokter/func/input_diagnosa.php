<?php
session_start();
require_once "../auth/connect.php";

// Check if the 'nama' parameter exists in the URL
if (isset($_GET['nama'])) {
    // Get the patient's name from the URL
    $patientName = $_GET['nama'];

    // Fetch relevant data based on the patient's name
    $query = "SELECT id, nomor_rekam_medis, nama_pasien FROM rekam_medis WHERE nama_pasien = '$patientName'";
    $result = mysqli_query($conn, $query);

    // Check if the query was successful
    if ($result) {
        // Fetch data from the query result
        $row = mysqli_fetch_assoc($result);

        // Display the fetched data in the form
        ?>
        <!DOCTYPE html>
        <html lang="en">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
            <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
            <!-- <link rel="stylesheet" href="../css/style.css"> -->
            <link rel="stylesheet" href="../css/detail_pasien_style.css">
            <title>Input Diagnosa</title>
            <!-- Include your CSS and other head elements -->
        </head>
        <body>

        <!-- sidebar -->
        <!-- <div class="sidebar">
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
                        <li><a href="func/poliumum_dokter.php">Poli Umum</a></li>
                        <li><a href="func/poligigi_dokter.php">Poli Gigi</a></li>
                        <li><a href="func/polikia_dokter.php">Poli KIA</a></li>
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
        </div> -->
        <!-- end of sidebar -->
        <div class="content">
        <!-- navbar -->
        <!-- end of navbar  -->

        <!-- header  -->
        <main>
            <div class="header">
                <div class="left">
                    <h1>Input Diagnosa</h1>
                    <ul class="breadcrumb">
                        <li><a href="#">Home</a></li>
                        /
                        <li><a href="#" class="active">Rekam Medis</a></li>
                    </ul>
                </div>
                <a href="/rekamMedis_lama/web_dokter/rekam_medis.php" class="report">
                    <i class='bx bx-left-arrow-alt'></i>
                    <span>Kembali</span>
                </a>
            </div>

            <!-- start data dokter -->
            <div class="table-container">
                <div class="judul-table">
                    <h4>Input Diagnosa</h4>
                </div>
                <div class="content-detail">
                    <form action="process_diagnosa.php" method="post">
                        <table>
                            <tr>
                                <td>No. Rekam Medis </td>
                                <td> : </td>
                                <td> <?php echo isset($row['nomor_rekam_medis']) ? $row['nomor_rekam_medis'] : ''; ?></td>
                            </tr>
                            
                            <tr>
                                <td>Nama Pasien </td>
                                <td> : </td>
                                <td> <?php echo isset($row['nama_pasien']) ? $row['nama_pasien'] : ''; ?></td>
                            </tr>

                            <tr>
                                <td>Diagnosa </td>
                                <input type="hidden" name="patient_id" value="<?php echo $row['id']; ?>">
                                <td> : </td>
                                <td> <textarea name="diagnosa" id="diagnosa" rows="8" cols="30" required></textarea></td>
                            </tr>
                        </table>
                        <button class="form-btn" type="submit">Submit Diagnosa</button>
                    </form>
                </div>
            </div>

            <!-- end of data dokter  -->

        </main>
    </div>

            <!-- Include your JS and other body elements -->
            <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
            <script src="../js/script.js"></script>
        </body>
        </html>
        <?php
    } else {
        // Handle the case where the query fails
        echo "Error: " . mysqli_error($conn);
    }

    // Close the database connection
    mysqli_close($conn);
} else {
    // Redirect back to the previous page or display an error message
    header("Location: ../rekam_medis.php");
    exit;
}
?>
