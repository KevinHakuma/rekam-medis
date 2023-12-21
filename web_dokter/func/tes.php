$query = "SELECT nomor_rekam_medis FROM data_pasien ORDER BY nomor_rekam_medis DESC LIMIT 1";
$result = $conn->query($query);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $nomor_terakhir = $row['nomor_rekam_medis'] + 1;
} else {
    // Tidak ada data, nomor dimulai dari 1
    $nomor_terakhir = 1;
}