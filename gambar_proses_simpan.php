<?php
include '../koneksi.php';

// Terima data dari formulir HTML
$tanggal = $_POST['tanggal'];
$nama_gambar1 = $_POST['nama_gambar1'];
$nama_gambar2 = $_POST['nama_gambar2'];
$nama_gambar3 = $_POST['nama_gambar3'];
$nama_gambar4 = $_POST['nama_gambar4'];

// Lakukan validasi data
if (empty($tanggal) || empty($nama_gambar1) || empty($nama_gambar2) || empty($nama_gambar3) || empty($nama_gambar4)) {
    echo "data_tidak_lengkap";
    exit();
}

$kover_name1 = $_FILES['gambar1']['name'];
$kover_tmp1 = $_FILES['gambar1']['tmp_name'];
$kover_path1 = 'data_gambar/' . basename($kover_name1); // Simpan kover di dalam folder gambar
move_uploaded_file($kover_tmp1, $kover_path1);

$kover_name2 = $_FILES['gambar2']['name'];
$kover_tmp2 = $_FILES['gambar2']['tmp_name'];
$kover_path2 = 'data_gambar/' . basename($kover_name2); // Simpan kover di dalam folder gambar
move_uploaded_file($kover_tmp2, $kover_path2);

$kover_name3 = $_FILES['gambar3']['name'];
$kover_tmp3 = $_FILES['gambar3']['tmp_name'];
$kover_path3 = 'data_gambar/' . basename($kover_name3); // Simpan kover di dalam folder gambar
move_uploaded_file($kover_tmp3, $kover_path3);

$kover_name4 = $_FILES['gambar4']['name'];
$kover_tmp4 = $_FILES['gambar4']['tmp_name'];
$kover_path4 = 'data_gambar/' . basename($kover_name4); // Simpan kover di dalam folder gambar
move_uploaded_file($kover_tmp4, $kover_path4);

// Buat query SQL untuk menambahkan data video ke dalam database
$query = "INSERT INTO gambar (tanggal, nama_gambar1, nama_gambar2, nama_gambar3, nama_gambar4, gambar1, gambar2, gambar3, gambar4) 
        VALUES ('$tanggal', '$nama_gambar1', '$nama_gambar2', '$nama_gambar3', '$nama_gambar4', '$kover_path1', '$kover_path2', '$kover_path3', '$kover_path4')";

// Jalankan query
if (mysqli_query($koneksi, $query)) {
    echo "success";
} else {
    echo "error";
}


// Tutup koneksi ke database
mysqli_close($koneksi);
