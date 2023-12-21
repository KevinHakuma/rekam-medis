<?php
session_start();

// Koneksi ke database
require_once "../auth/connect.php";

// Ambil data dari form login
$username = $_POST['username'];
$password = $_POST['password'];

$sql_staff = "SELECT * FROM data_staff WHERE username='$username'";
$result_staff = mysqli_query($conn, $sql_staff);

$sql_dokter = "SELECT * FROM data_dokter WHERE username='$username'";
$result_dokter = mysqli_query($conn, $sql_dokter);

if ($result_staff && mysqli_num_rows($result_staff) > 0) {
    $row = mysqli_fetch_assoc($result_staff);
    // Verifikasi password
    if (password_verify($password, $row['password'])) {
        // Password benar, proses login
        $_SESSION['user_id'] = $row['id_staff'];
        $_SESSION['username'] = $row['username'];

        header('Location: ../index.php');
        exit;
    } else {
        echo "Login gagal. Password salah.";
    }
} elseif ($result_dokter && mysqli_num_rows($result_dokter) > 0) {
    $row = mysqli_fetch_assoc($result_dokter);
    // Verifikasi password
    if (password_verify($password, $row['password'])) {
        // Password benar, proses login
        $_SESSION['user_id'] = $row['id_dokter'];
        $_SESSION['username'] = $row['username'];

        header('Location: ../web_dokter/index.php');
        exit;
    } else {
        echo "Login gagal. Password salah.";
    }
} else {
    echo "Login gagal. Username tidak ditemukan.";
}

// Tutup koneksi database
mysqli_close($conn);
?>
