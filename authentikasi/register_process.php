
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
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <style>
        /* Atur font Poppins untuk SweetAlert */
        .swal-title, .swal-text, .swal-button {
            font-family: 'Poppins', sans-serif !important;
        }
    </style>
    <title>Document</title>
</head>
<body>
<?php
session_start();

// Sambungkan ke database
require_once "../auth/connect.php";

// Ambil data dari formulir
$nama_staff = $_POST['nama_staff'];
$username = $_POST['username'];
$password = $_POST['password'];
$user_type = $_POST['user_type'];

// Hash password
$hashed_password = password_hash($password, PASSWORD_DEFAULT);

if ($user_type === 'Dokter') {
    $sql = "INSERT INTO data_dokter (nama_dokter, user_type, username, password) VALUES ('$nama_staff', '$user_type', '$username', '$hashed_password')";
} elseif ($user_type === 'Staff') {
    $sql = "INSERT INTO data_staff (nama_staff, username, password, user_type) VALUES ('$nama_staff', '$username', '$hashed_password', '$user_type')";
} else {
    echo "Pilihan pengguna tidak valid.";
}

if (mysqli_query($conn, $sql)) {
    // Registrasi berhasil, tampilkan SweetAlert
    echo "<script>
            Swal.fire({
                icon: 'success',
                title: 'Registrasi Berhasil!',
                text: 'Anda dapat melanjutkan ke halaman login.',
                confirmButtonText: 'OK'
            }).then((result) => {
                if (result.isConfirmed) {
                    // Arahkan pengguna ke halaman login
                    window.location.href = 'login.php';
                }
            });
          </script>";
} else {
    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
}

// Tutup koneksi
mysqli_close($conn);
?>
</body>
</html>