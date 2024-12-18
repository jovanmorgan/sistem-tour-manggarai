<?php
// Lakukan koneksi ke database
include '../koneksi.php';

// Cek apakah terdapat data yang dikirimkan melalui metode POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Tangkap data yang dikirimkan melalui form
    $editId = $_POST['editId'];
    $editName = $_POST['editName'];
    $editType = $_POST['editType'];
    $editDurasi = $_POST['editDurasi'];
    $edittanggal = $_POST['edittanggal'];
    $editAlamat = $_POST['editAlamat'];
    $editReting = $_POST['editReting'];
    $editDeskripsi = $_POST['editDeskripsi'];
    $existingKover = $_POST['existingKover'];
    $existingVideo = $_POST['existingVideo'];

    // Lakukan validasi data
    if (empty($editName) || empty($editType) || empty($editDurasi) || empty($editAlamat) || empty($editReting) || empty($editDeskripsi)) {
        echo "data_tidak_lengkap";
        exit();
    }

    // Query SQL untuk update data video
    $query = "UPDATE video SET nama='$editName', type='$editType', durasi='$editDurasi', tanggal='$edittanggal', alamat='$editAlamat', reting='$editReting', deskripsi='$editDeskripsi' WHERE id_video='$editId'";

    // Lakukan proses update data video di database
    $result = mysqli_query($koneksi, $query);

    if ($result) {
        // Jika update berhasil, lakukan penyimpanan file kover dan video baru jika ada yang diunggah

        // Cek apakah file kover baru diunggah
        if (!empty($_FILES['editDataKover']['name'])) {
            $kover_name = $_FILES['editDataKover']['name'];
            $kover_tmp = $_FILES['editDataKover']['tmp_name'];
            $kover_path = 'data_gambar/' . basename($kover_name); // Simpan kover di dalam folder gambar
            move_uploaded_file($kover_tmp, $kover_path);

            // Update path file kover di database
            $query_update_kover = "UPDATE video SET data_kover='$kover_path' WHERE id_video='$editId'";
            mysqli_query($koneksi, $query_update_kover);
        }

        // Cek apakah file video baru diunggah
        if (!empty($_FILES['editDataVideo']['name'])) {
            $video_name = $_FILES['editDataVideo']['name'];
            $video_tmp = $_FILES['editDataVideo']['tmp_name'];
            $video_path = 'data_video/' . basename($video_name); // Simpan video di dalam folder video
            move_uploaded_file($video_tmp, $video_path);

            // Update path file video di database
            $query_update_video = "UPDATE video SET data_video='$video_path' WHERE id_video='$editId'";
            mysqli_query($koneksi, $query_update_video);
        }

        // Setelah penyimpanan file selesai, arahkan kembali pengguna ke halaman yang sesuai
        echo "success";
        exit();
    } else {
        // Jika terjadi kesalahan saat melakukan proses update, tampilkan pesan kesalahan
        echo "Gagal melakukan proses update data video: " . mysqli_error($koneksi);
    }
} else {
    // Jika metode request bukan POST, arahkan pengguna kembali ke halaman yang sesuai
    header("Location: video.php");
    exit();
}

// Tutup koneksi ke database
mysqli_close($koneksi);
