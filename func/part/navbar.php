<?php
// session_start();

    try {
    // Koneksi ke database
    $conn = mysqli_connect("localhost", "root", "", "medical_record");

    // Query SQL untuk mengambil data dari tabel data_staff (harus disesuaikan dengan tabel Anda)
    $result = mysqli_query($conn, "SELECT nama_staff FROM data_staff");

    if ($result) {
        $row = mysqli_fetch_assoc($result);
        // $_SESSION['user_id'] = $user_id;
        $_SESSION['nama_staff'] = $row["nama_staff"];
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
    $sql = "SELECT nama_staff FROM data_staff WHERE id_staff = $user_id"; // Menggunakan ID staf sesuai dengan sesi

    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        $namaPengguna = $row["nama_staff"];
    } else {
        $namaPengguna = "User";
    }
} else {
    // Pengguna belum login, beri nilai default
    $namaPengguna = "User0";
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
            <a href="detailprofile.php">Detail Profile</a>
        </div>
    </div>
</nav>