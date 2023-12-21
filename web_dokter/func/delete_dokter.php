

    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300&display=swap" rel="stylesheet">
        <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/2.9.1/umd/popper.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
        <!-- link css  -->
        <link rel="stylesheet" href="css/style.css">
        <style>
        body {
            font-family: 'Poppins', sans-serif;
        }
    </style>
        <title>Konfirmasi Hapus Data</title>
    </head>
    <body>
    <?php
// Koneksi ke database
require_once "../auth/connect.php";

// Periksa apakah ada parameter id yang dikirimkan melalui URL
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    ?>
        <script>
        // Gunakan SweetAlert untuk konfirmasi penghapusan
        Swal.fire({
            title: 'Konfirmasi Hapus Data',
            text: 'Anda yakin ingin menghapus data ini?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya, Hapus!',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.isConfirmed) {
                // Jika pengguna mengonfirmasi untuk menghapus, arahkan ke proses penghapusan
                window.location.href = 'delete_dokter_proses.php?id=<?php echo $id; ?>';
            } else {
                // Jika pengguna membatalkan penghapusan, arahkan kembali ke halaman data_pasien.php
                window.location.href = '../data_dokter.php';
            }
        });
        </script>
    </body>
    </html>

    <?php
} else {
    // Jika parameter id tidak ada, tampilkan pesan kesalahan
    echo '<script>
            alert("ID tidak ditemukan.");
            window.location.href = "data_dokter.php";
          </script>';
    exit();
}

// Tutup koneksi ke database
mysqli_close($conn);
?>
