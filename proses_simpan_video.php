<?php
include '../koneksi.php';

// Terima data dari formulir HTML
$name = $_POST['name'];
$type = $_POST['type'];
$durasi = $_POST['durasi'];
$tanggal = $_POST['tanggal'];
$alamat = $_POST['alamat'];
$reting = $_POST['reting'];
$deskripsi = $_POST['deskripsi'];

// Lakukan validasi data
if (empty($name) || empty($type) || empty($durasi) || empty($alamat) || empty($reting) || empty($deskripsi)) {
    echo "data_tidak_lengkap";
    exit();
}

$kover_name = $_FILES['data_kover']['name'];
$kover_tmp = $_FILES['data_kover']['tmp_name'];
$kover_path = 'data_gambar/' . basename($kover_name); // Simpan kover di dalam folder gambar
move_uploaded_file($kover_tmp, $kover_path);

// Upload file video
$video_name = $_FILES['data_video']['name'];
$video_tmp = $_FILES['data_video']['tmp_name'];
$video_path = 'data_video/' . basename($video_name); // Simpan video di dalam folder video
move_uploaded_file($video_tmp, $video_path);


// Buat query SQL untuk menambahkan data video ke dalam database
$query = "INSERT INTO video (nama, type, durasi, tanggal, alamat, reting, deskripsi, data_kover, data_video) 
        VALUES ('$name', '$type', '$durasi', '$tanggal', '$alamat', '$reting', '$deskripsi', '$kover_path', '$video_path')";

// Jalankan query
if (mysqli_query($koneksi, $query)) {
    echo "success";
} else {
    echo "error";
}


// Tutup koneksi ke database
mysqli_close($koneksi);
