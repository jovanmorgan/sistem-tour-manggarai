<?php
include '../koneksi.php';

// Terima data dari formulir HTML
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id_gambar = $_POST['id_gambar'];
    $tanggal = $_POST['tanggal'];
    $nama_gambar1 = $_POST['nama_gambar1'];
    $nama_gambar2 = $_POST['nama_gambar2'];
    $nama_gambar3 = $_POST['nama_gambar3'];
    $nama_gambar4 = $_POST['nama_gambar4'];

    // Lakukan validasi data
    if (empty($id_gambar) || empty($tanggal) || empty($nama_gambar1) || empty($nama_gambar2) || empty($nama_gambar3) || empty($nama_gambar4)) {
        echo "data_tidak_lengkap";
        exit();
    }

    // Query SQL untuk update data info
    $query = "UPDATE gambar SET tanggal='$tanggal', nama_gambar1='$nama_gambar1', nama_gambar2='$nama_gambar2', nama_gambar3='$nama_gambar3', nama_gambar4='$nama_gambar4' WHERE id_gambar='$id_gambar'";

    // Lakukan proses update data info di database
    $result = mysqli_query($koneksi, $query);

    if ($result) {
        // Jika update berhasil, lakukan penyimpanan file kover dan info baru jika ada yang diunggah

        // Cek apakah file info baru diunggah
        if (!empty($_FILES['gambar1']['name'])) {
            $info_name1 = $_FILES['gambar1']['name'];
            $info_tmp1 = $_FILES['gambar1']['tmp_name'];
            $info_path1 = 'data_gambar/' . basename($info_name1); // Simpan info di dalam folder info
            move_uploaded_file($info_tmp1, $info_path1);

            // Update path file info di database
            $query_update_info1 = "UPDATE gambar SET gambar1='$info_path1' WHERE id_gambar ='$id_gambar'";
            mysqli_query($koneksi, $query_update_info1);
        }

        // Cek apakah file info baru diunggah
        if (!empty($_FILES['gambar2']['name'])) {
            $info_name2 = $_FILES['gambar2']['name'];
            $info_tmp2 = $_FILES['gambar2']['tmp_name'];
            $info_path2 = 'data_gambar/' . basename($info_name2); // Simpan info di dalam folder info
            move_uploaded_file($info_tmp2, $info_path2);

            // Update path file info di database
            $query_update_info2 = "UPDATE gambar SET gambar2='$info_path2' WHERE id_gambar ='$id_gambar'";
            mysqli_query($koneksi, $query_update_info2);
        }

        // Cek apakah file info baru diunggah
        if (!empty($_FILES['gambar3']['name'])) {
            $info_name3 = $_FILES['gambar3']['name'];
            $info_tmp3 = $_FILES['gambar3']['tmp_name'];
            $info_path3 = 'data_gambar/' . basename($info_name3); // Simpan info di dalam folder info
            move_uploaded_file($info_tmp3, $info_path3);

            // Update path file info di database
            $query_update_info3 = "UPDATE gambar SET gambar3='$info_path3' WHERE id_gambar ='$id_gambar'";
            mysqli_query($koneksi, $query_update_info3);
        }

        // Cek apakah file info baru diunggah
        if (!empty($_FILES['gambar4']['name'])) {
            $info_name4 = $_FILES['gambar4']['name'];
            $info_tmp4 = $_FILES['gambar4']['tmp_name'];
            $info_path4 = 'data_gambar/' . basename($info_name4); // Simpan info di dalam folder info
            move_uploaded_file($info_tmp4, $info_path4);

            // Update path file info di database
            $query_update_info4 = "UPDATE gambar SET gambar4='$info_path4' WHERE id_gambar ='$id_gambar'";
            mysqli_query($koneksi, $query_update_info4);
        }
        // Setelah penyimpanan file selesai, arahkan kembali pengguna ke halaman yang sesuai
        echo "success";
        exit();
    } else {
        // Jika terjadi kesalahan saat melakukan proses update, tampilkan pesan kesalahan
        echo "Gagal melakukan proses update data info: " . mysqli_error($koneksi);
    }
} else {
    // Jika metode request bukan POST, arahkan pengguna kembali ke halaman yang sesuai
    header("Location: info.php");
    exit();
}

// Tutup koneksi ke database
mysqli_close($koneksi);
