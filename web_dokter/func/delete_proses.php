<?php
// Koneksi ke database
require_once "../auth/connect.php";

// Periksa apakah ada parameter id yang dikirimkan melalui URL
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Lakukan penghapusan data dari tabel sesuai dengan id
    $query_delete = mysqli_query($conn, "DELETE FROM data_pasien WHERE id = $id");

    if ($query_delete) {
        // Jika penghapusan berhasil, arahkan kembali ke halaman data_pasien.php
        ?>

        <!DOCTYPE html>
        <html lang="en">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
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
            <script>
            // Gunakan SweetAlert untuk konfirmasi penghapusan
            Swal.fire({
                title: 'Berhasil',
                text: 'Data berhasil dihapus.',
                icon: 'success',
                confirmButtonText: 'OK'
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = "../data_pasien.php"; // Redirect ke halaman data_pasien.php atau yang sesuai
                }
            });
            </script>
        </body>
        </html>

        <?php
        exit();
    } else {
        // Jika terjadi kesalahan dalam penghapusan, tampilkan pesan kesalahan
        echo "Error: " . mysqli_error($conn);
    }
} else {
    // Jika parameter id tidak ada, tampilkan pesan kesalahan
    echo "ID tidak ditemukan";
}

// Tutup koneksi ke database
mysqli_close($conn);
?>
