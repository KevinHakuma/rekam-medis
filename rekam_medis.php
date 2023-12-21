<?php
// session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <script src="js/qrcode.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <!-- link css  -->
    <link rel="stylesheet" href="css/style.css">
    <title>Rekam Medis</title>
</head>
<body>

    <!-- sidebar -->
    <div class="sidebar">
        <a href="#" class="logo" id="logo">
            <img src="images/logo.png" alt="">
            <div class="logo-name"><span>Klinik</span><br><span>Bhayangkara</span><br><span>Polres Madiun</span></div>
        </a>
        <ul class="side-menu">
            <li><a href="index.php"><i class='bx bxs-dashboard'></i>Dashboard</a></li>
            <li><a href="data_pasien.php"><i class='bx bx-user' ></i>Data Pasien</a></li>
            <li><a href="data_dokter.php"><i class='bx bxs-user'></i>Data Dokter</a></li>
            <li class="active"><a href="rekam_medis.php"><i class='bx bx-notepad' ></i>Data Rekam Medis</a></li>
            <!-- <li class="parent"><a href="#"><i class='bx bx-clinic' ></i>Poliklinik <i class='bx bx-chevron-down' ></i></a>
                <ul class="sub-menu">
                    <li><a href="#">Poli Umum</a></li>
                    <li><a href="#">Poli Gigi</a></li>
                    <li><a href="#">Poli KIA</a></li>
                </ul>
            </li> -->
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
        session_start();
        include 'func/part/navbar.php'
        ?>
        <!-- end of navbar  -->
        <!-- Elemen popup QR code -->
        <div class="back-qr">
            <div class="qrcode-popup" id="qrcode-popup">
                <div class="qrcode-content" id="qrcode-content">
                    <h2>QR Code</h2>
                    <div id="qrcode"></div>
                    <button class="close-qrcode" id="close-qrcode">Tutup</button>
                </div>
            </div>
        </div>
        <!-- Elemen popup QR code selesai -->
        <!-- header  -->
        <main>
            <div class="header">
                <div class="left">
                    <h1>Data Rekam Medis</h1>
                    <ul class="breadcrumb">
                        <li><a href="#">Home</a></li>
                        /
                        <li><a href="#" class="active">Data Rekam Medis</a></li>
                    </ul>
                </div>
                <a href="func/proses_rekam_medis.php" class="report">
                    <i class='bx bx-layer-plus'></i>
                    <span>Tambah Rekam Medis</span>
                </a>
            </div>

            <!-- table mulai -->
            <div class="table-container">
                <div class="judul-table">
                    <h4>Data Rekam Medis</h4>
                </div>
                <div class="table-header">
                    <table align="center">
                        <thead>
                            <tr>
                                <th>No. Rekam Medis</th>
                                <th>Nama Pasien</th>
                                <!-- <th>Diagnosa</th> -->
                                <th>Waktu Input</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php
                        // Koneksi ke database
                        require_once "auth/connect.php";

                        // Query SQL untuk mengambil data dari tabel
                        $result = mysqli_query($conn, "SELECT id, nomor_rekam_medis, nama_pasien, waktu_input FROM rekam_medis");

                        $page = isset($_GET['page']) ? intval($_GET['page']) : 1;

                        $query_total_records = mysqli_query($conn, "SELECT COUNT(*) AS total FROM rekam_medis");
                        $data_total_records = mysqli_fetch_assoc($query_total_records);
                        $total_records = $data_total_records['total'];
                        $records_per_page = 5; 
                        $offset = ($page - 1) * $records_per_page;
                        $total_pages = ceil($total_records / $records_per_page);

                        // Hitung jumlah data
                        $data_awal = max(($page - 1) * $records_per_page, 0);
                        
                        $query_data = mysqli_query($conn, "SELECT id, nomor_rekam_medis, nama_pasien, diagnosa, waktu_input FROM rekam_medis LIMIT $offset, $records_per_page");
                        
                        $i = 0;
                        while ($row = mysqli_fetch_assoc($query_data)) {
                            $i++;

                            ?>
                            <tr>
                                <td><?php echo $row['nomor_rekam_medis'];?></td>
                                <td><?php echo $row['nama_pasien']; ?></td>
                                <!-- <td><?php echo $row['diagnosa']; ?></td> -->
                                <td><?php echo $row['waktu_input'] ?></td>
                                <td>
                                    <a href="func/proses_rekam_medis.php" class="btn-edit" data-toggle="tooltip" title="Edit Data"><i class='bx bx-edit-alt' ></i></a>
                                    <a href="func/delete_data_rekam.php?id=<?php echo $row['id']; ?>" class="btn-delete" data-toggle="tooltip" title="Hapus Data"><i class='bx bxs-trash'></i></a>
                                </td>
                                <!-- <td>
                                    <button class='btn-view-qr' id="btn-view-qr" onclick='generateQRCode("<?php echo $row['nama_pasien']; ?>")' data-toggle='tooltip' title='Lihat QR'><i class='bx bx-qr-scan'></i></button>
                                </td>
                            </tr> -->
                            <tr>
                                <td colspan="5">
                                    <div id='detail-pasien-<?php echo $row['nama_pasien']; ?>' style='display:none;'>
                                        <!-- Isi detail pasien di sini -->
                                        Nama Pasien: <?php echo $row['nama_pasien']; ?><br>
                                        Diagnosa: <?php echo $row['diagnosa']; ?><br>
                                        <!-- Tambahkan detail lainnya sesuai kebutuhan -->
                                    </div>
                                </td>
                            </tr>


                                <?php
                            }?>
                        </tbody>
                    </table>    
                </div>
                <div class="table-footer">
                    <nav aria-label="Halaman">
                        <ul class="pagination justify-content-center">
                            <li class="page-item page-previous">
                                <a href="#" class="page-link" aria-label="Sebelumnya">
                                    <span aria-hidden="true">&laquo; Previous</span>
                                </a>
                            </li>

                            <?php
                            if ($page > 1) {
                                echo '<li class="page-item"><a class="page-link" href="?page=' . ($page - 1) . '">Previous</a></li>';
                            }

                            for ($i = 1; $i <= $total_pages; $i++) {
                                echo '<li class="page-item';
                                if ($i == $page) {
                                    echo ' active';
                                }
                                echo '"><a class="page-link" href="?page=' . $i . '">' . $i . '</a></li>';
                            }

                            if ($page < $total_pages) {
                                echo '<li class="page-item"><a class="page-link" href="?page=' . ($page + 1) . '">Next</a></li>';
                            }
                            ?>

                            <li class="page-item page-next">
                                <a href="#" class="page-link" aria-label="Selanjutnya">
                                    <span aria-hidden="true">Next &raquo;</span>
                                </a>
                            </li>
                        </ul>
                    </nav>
                </div>
            </div>
            
            <!-- end of tabel -->

            <!-- end of tambah rekam medis  -->

        </main>
    </div>


    <script src="js/script.js"></script>
</body>
</html>