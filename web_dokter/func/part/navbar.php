<?php
// session_start();

    try {
    // Koneksi ke database
    $conn = mysqli_connect("localhost", "root", "", "medical_record");

    // Pemeriksaan koneksi
    if (!$conn) {
        die("Koneksi database gagal: " . mysqli_connect_error());
    }

    // Query SQL untuk mengambil data dari tabel data_staff (harus disesuaikan dengan tabel Anda)
    $result = mysqli_query($conn, "SELECT nama_dokter FROM data_dokter");

    if ($result) {
        $row = mysqli_fetch_assoc($result);
        // $_SESSION['user_id'] = $user_id;
        $_SESSION['nama_dokter'] = $row["nama_dokter"];
    } else {
        // Tabel data_staff kosong, lakukan tindakan yang sesuai
        echo "Tidak ada data staff.";
    }
} catch (Exception $e) {
    // Tangani kesalahan atau exception di sini
    echo "Terjadi kesalahan: " . $e->getMessage();
}
if (isset($_SESSION['user_id'])) {
    $user_id = $_SESSION['user_id'];

    // Query SQL untuk mengambil data nama_staff dari tabel data_staff
    $sql = "SELECT nama_dokter FROM data_dokter WHERE id_dokter = $user_id"; // Menggunakan ID staf sesuai dengan sesi

    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        $namaPengguna = $row["nama_dokter"];
    } else {
        $namaPengguna = "User";
    }
} else {
    // Pengguna belum login, beri nilai default
    $namaPengguna = "User";
}
?>

<nav>
    <i class='bx bx-menu-alt-left'></i>
    <form action="#">
        <div class="form-input">
            <input type="search" placeholder="Search">
            <button class="search-btn" type="submit"><i class='bx bx-search'></i></button>
        </div>
    </form>
    <input type="checkbox" id="theme-toggle" hidden>
    <label for="theme-toggle" class="theme-toggle"></label>
    <a href="#" class="notif">
        <i class='bx bx-bell'></i>
        <span class="count">12</span>
    </a>
    <div class="profile-dropdown">
        <a href="#" class="profile">
            <i class='bx bx-user-circle'></i>
        </a>
        <div class="profile-options">
            <span>Hi, <?php echo $namaPengguna; ?></span>
            <a href="func/profiledokter.php">Detail Profile</a>
        </div>
    </div>
</nav>