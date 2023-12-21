<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrasi</title>
    <!-- Sertakan file Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <div class="container">
        <h1 class="mt-5">Registrasi</h1>
        <form action="register_process.php" method="POST">
            <div class="form-group">
                <label for="nama_staff">Nama Staff:</label>
                <input type="text" class="form-control" id="nama_staff" name="nama_staff" required>
            </div>
            <div class="form-group">
                <label for="username">Username:</label>
                <input type="text" class="form-control" id="username" name="username" required>
            </div>
            <div class="form-group">
                <label for="password">Password:</label>
                <input type="password" class="form-control" id="password" name="password" required>
            </div>
            <div class="form-group">
                <label for="user_type">Jabatan:</label>
                <select class="form-control" id="user_type" name="user_type" required>
                    <option value="Dokter">Dokter</option>
                    <option value="Staff">Staff Rekam Medis</option>
                    <!-- Tambahkan opsi lainnya sesuai kebutuhan -->
                </select>
            </div>
            <!-- Tambahkan input lainnya sesuai kebutuhan -->
            <button type="submit" class="btn btn-primary">Daftar</button>
        </form>
    </div>
    <!-- Sertakan file Bootstrap JavaScript (Opsional) -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@1.16.0/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
