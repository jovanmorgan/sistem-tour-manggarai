<?php
// Lakukan koneksi ke database
include '../koneksi.php';

// Cek apakah terdapat data yang dikirimkan melalui metode POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Terima data dari formulir HTML
    $id_info = $_POST['id_info'];
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

    // Query SQL untuk update data info
    $query = "UPDATE info SET nama_info='$nama_info', jarak='$jarak', waktu='$waktu', lokasi='$lokasi', reting='$reting', deskripsi='$deskripsi' WHERE id_info='$id_info'";

    // Lakukan proses update data info di database
    $result = mysqli_query($koneksi, $query);

    if ($result) {
        // Jika update berhasil, lakukan penyimpanan file kover dan info baru jika ada yang diunggah

         // Cek apakah file info baru diunggah
         if (!empty($_FILES['gambar1']['name'])) {
            $info_name1 = $_FILES['gambar1']['name'];
            $info_tmp1 = $_FILES['gambar1']['tmp_name'];
            $info_path1 = 'data_gambar_info/' . basename($info_name1); // Simpan info di dalam folder info
            move_uploaded_file($info_tmp1, $info_path1);

            // Update path file info di database
            $query_update_info1 = "UPDATE info SET gambar1='$info_path1' WHERE id_info ='$id_info'";
            mysqli_query($koneksi, $query_update_info1);
        }

        // Cek apakah file info baru diunggah
        if (!empty($_FILES['gambar2']['name'])) {
            $info_name2 = $_FILES['gambar2']['name'];
            $info_tmp2 = $_FILES['gambar2']['tmp_name'];
            $info_path2 = 'data_gambar_info/' . basename($info_name2); // Simpan info di dalam folder info
            move_uploaded_file($info_tmp2, $info_path2);

            // Update path file info di database
            $query_update_info2 = "UPDATE info SET gambar2='$info_path2' WHERE id_info ='$id_info'";
            mysqli_query($koneksi, $query_update_info2);
        }

        // Cek apakah file info baru diunggah
        if (!empty($_FILES['gambar3']['name'])) {
            $info_name3 = $_FILES['gambar3']['name'];
            $info_tmp3 = $_FILES['gambar3']['tmp_name'];
            $info_path3 = 'data_gambar_info/' . basename($info_name3); // Simpan info di dalam folder info
            move_uploaded_file($info_tmp3, $info_path3);

            // Update path file info di database
            $query_update_info3 = "UPDATE info SET gambar3='$info_path3' WHERE id_info ='$id_info'";
            mysqli_query($koneksi, $query_update_info3);
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
