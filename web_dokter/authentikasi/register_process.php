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

// Query untuk memasukkan data ke dalam tabel
$sql = "INSERT INTO data_staff (nama_staff, username, password, user_type) VALUES ('$nama_staff', '$username', '$hashed_password', '$user_type')";

// Coba eksekusi query
if (mysqli_query($conn, $sql)) {
    echo "Registrasi berhasil!";
} else {
    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
}

// Tutup koneksi
mysqli_close($conn);
?>
