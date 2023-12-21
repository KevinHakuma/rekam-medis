<?php
session_start();

// Hapus semua data session
session_destroy();

// Arahkan pengguna kembali ke halaman login atau halaman lain sesuai kebutuhan
header("Location: ../");
exit;
?>
