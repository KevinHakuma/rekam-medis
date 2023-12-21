<?php
session_start();

// Periksa apakah pengguna telah login atau tidak
if (!isset($_SESSION['user_id'])) {
    header("Location: http://medical-record.great-site.net/");
    exit;
}

require_once "../auth/connect.php";
// $conn = new mysqli("localhost", "root", "", "medical_record");

$user_id = $_SESSION['user_id'];
$query = "SELECT * FROM data_dokter WHERE id_dokter = $user_id";
$result = $conn->query($query);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();

    // Proses pembaruan data profil di sini
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $new_name = $_POST['new_name'];
        $new_specialization = $_POST['new_specialization'];

        // Lakukan validasi data yang diperlukan di sini
        
        // Lakukan pembaruan data ke dalam database
        $update_query = "UPDATE data_dokter SET nama_dokter = '$new_name', spesialisasi = '$new_specialization' WHERE id_dokter = $user_id";
        if ($conn->query($update_query) === TRUE) {
            echo "Profil berhasil diperbarui.";
        } else {
            echo "Error: " . $conn->error;
        }
    }
?>

<!DOCTYPE html>
<html>
<head>
    <title>Detail Profile</title>
</head>
<body>
    <h1>Detail Profile</h1>
    <form method="post" action="">
        <label for="new_name">Nama Dokter:</label>
        <input type="text" name="new_name" value="<?php echo $row['nama_dokter']; ?>"><br><br>

        <label for="new_specialization">Spesialisasi:</label>
        <input type="text" name="new_specialization" value="<?php echo $row['spesialisasi']; ?>"><br><br>

        <input type="submit" value="Perbarui Profil">
    </form>
</body>
</html>

<?php
} else {
    echo "Data pengguna tidak ditemukan.";
}

// Tutup koneksi database
$conn->close();
?>
