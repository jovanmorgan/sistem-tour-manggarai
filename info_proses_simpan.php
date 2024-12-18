<?php
include '../koneksi.php';

// Terima data dari formulir HTML
$nama_info = $_POST['nama_info'];
$jarak = $_POST['jarak'] . " Km";
$waktu = $_POST['waktu'] . " Jam";
$lokasi = $_POST['lokasi'];
$reting = $_POST['reting'];
$deskripsi = $_POST['deskripsi'];

// Lakukan validasi data
if (empty($nama_info) || empty($jarak) || empty($waktu) || empty($lokasi) || empty($reting) || empty($deskripsi)) {
    echo "data_tidak_lengkap";
    exit();
}

$kover_name1 = $_FILES['gambar1']['name'];
$kover_tmp1 = $_FILES['gambar1']['tmp_name'];
$kover_path1 = 'data_gambar_info/' . basename($kover_name1); // Simpan kover di dalam folder gambar
move_uploaded_file($kover_tmp1, $kover_path1);

$kover_name2 = $_FILES['gambar2']['name'];
$kover_tmp2 = $_FILES['gambar2']['tmp_name'];
$kover_path2 = 'data_gambar/' . basename($kover_name2); // Simpan kover di dalam folder gambar
move_uploaded_file($kover_tmp2, $kover_path2);

$kover_name3 = $_FILES['gambar3']['name'];
$kover_tmp3 = $_FILES['gambar3']['tmp_name'];
$kover_path3 = 'data_gambar/' . basename($kover_name3); // Simpan kover di dalam folder gambar
move_uploaded_file($kover_tmp3, $kover_path3);

// Buat query SQL untuk menambahkan data video ke dalam database
$query = "INSERT INTO info (nama_info, jarak, waktu, lokasi, reting, deskripsi, gambar1, gambar2, gambar3) 
        VALUES ('$nama_info', '$jarak', '$waktu', '$lokasi', '$reting', '$deskripsi', '$kover_path1', '$kover_path2', '$kover_path3')";

// Jalankan query
if (mysqli_query($koneksi, $query)) {
    echo "success";
} else {
    echo "error";
}


// Tutup koneksi ke database
mysqli_close($koneksi);
