<?php
    $conn = mysqli_connect("localhost", "root", "", "medical_record");

    // Pemeriksaan koneksi
    if (!$conn) {
        die("Koneksi database gagal: " . mysqli_connect_error());
    }
?>