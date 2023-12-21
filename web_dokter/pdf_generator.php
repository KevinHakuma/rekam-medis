<?php
header('Content-Type: application/pdf');

require('fpdf.php'); // Sesuaikan path ke file FPDF Anda

// Fungsi untuk menghasilkan file PDF
function generatePDF($namaPasien) {
    // Buat objek PDF
    $pdf = new FPDF();
    $pdf->AddPage();
    $pdf->SetFont('Arial', 'B', 16);

    // Query SQL untuk mengambil data dari tabel sesuai nama pasien
    $conn = new mysqli("localhost", "root", "", "medical_record");
    if ($conn->connect_error) {
        die("Koneksi database gagal: " . $conn->connect_error);
    }

    $namaPasien = $conn->real_escape_string($namaPasien);
    $query = "SELECT * FROM rekam_medis WHERE nama_pasien = '$namaPasien'";
    $result = $conn->query($query);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();

        // Isi data ke file PDF
        $pdf->Cell(0, 10, "Detail Rekam Medis", 0, 1, 'C');
        $pdf->Ln(10);

        $pdf->SetFont('Arial', '', 12);

        // Tentukan lebar kolom secara manual
        $labelWidth = 80;
        $valueWidth = 110; // Sisa lebar untuk nilai

        // Menampilkan data dalam format tabel dengan border
        $data = array(
            "No. Rekam Medis" => $row["nomor_rekam_medis"],
            "Nama Pasien" => $row["nama_pasien"],
            "Keluhan Utama" => $row["keluhan_utama"],
            "Keluhan Tambahan" => $row["keluhan_tambahan"],
            "Berat Badan" => $row["berat_badan"],
            "Cara Berjalan" => $row["cara_berjalan"],
            "Menopang Saat Duduk" => $row["menopang_duduk"],
            "Kehilangan BB dalam 3 bulan Terakhir" => $row["kehilangan_bb"],
            "Diagnosa" => $row["diagnosa"],
            "Waktu Input" => $row["waktu_input"]
            // Tambahkan data lainnya sesuai kebutuhan
        );

        foreach ($data as $label => $value) {
            $pdf->Cell($labelWidth, 10, $label, 1); // 1 menandakan border
            $pdf->Cell($valueWidth, 10, $value, 1);
            $pdf->Ln(10); // Spasi antar data
        }

        // Simpan ke file PDF dengan nama yang sesuai (misalnya, nama_pasien.pdf)
        $pdf->Output($row["nama_pasien"] . '.pdf', 'I');
    } else {
        echo "Tidak ada data pasien dengan nama tersebut.";
    }

    $conn->close();
}

// Ambil parameter 'nama' dari URL
if (isset($_GET['nama'])) {
    $namaPasien = $_GET['nama'];
    generatePDF($namaPasien);
} else {
    echo "Parameter 'nama' tidak ditemukan.";
}
?>
