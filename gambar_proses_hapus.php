<?php
// Lakukan koneksi ke database
include '../koneksi.php';

// Cek apakah terdapat data yang dikirimkan melalui metode POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Tangkap ID gambar yang akan dihapus
    $id = $_POST['id'];

    // Query SQL untuk mengambil data kover dan gambar yang akan dihapus
    $query_select_files = "SELECT gambar1, gambar2, gambar3, gambar4 FROM gambar WHERE id_gambar='$id'";
    $result_select_files = mysqli_query($koneksi, $query_select_files);

    if ($result_select_files) {
        $row = mysqli_fetch_assoc($result_select_files);
        $kover_path1 = $row['gambar1'];
        $kover_path2 = $row['gambar2'];
        $kover_path3 = $row['gambar3'];
        $kover_path4 = $row['gambar4'];

        // Buat query SQL untuk menghapus data gambar berdasarkan ID
        $query_delete_gambar = "DELETE FROM gambar WHERE id_gambar='$id'";
        $result_delete_gambar = mysqli_query($koneksi, $query_delete_gambar);

        if ($result_delete_gambar) {
            // Hapus file kover jika tidak digunakan oleh data gambar lain
            $query_check_kover_usage1 = "SELECT COUNT(*) AS kover_usage1 FROM gambar WHERE gambar1='$kover_path1'";
            $result_check_kover_usage1 = mysqli_query($koneksi, $query_check_kover_usage1);
            $row_kover_usage1 = mysqli_fetch_assoc($result_check_kover_usage1);
            if ($row_kover_usage1['kover_usage1'] == 0 && file_exists($kover_path1)) {
                unlink($kover_path1);
            }

            $query_check_kover_usage2 = "SELECT COUNT(*) AS kover_usage2 FROM gambar WHERE gambar2='$kover_path2'";
            $result_check_kover_usage2 = mysqli_query($koneksi, $query_check_kover_usage2);
            $row_kover_usage2 = mysqli_fetch_assoc($result_check_kover_usage2);
            if ($row_kover_usage2['kover_usage2'] == 0 && file_exists($kover_path2)) {
                unlink($kover_path2);
            }

            $query_check_kover_usage3 = "SELECT COUNT(*) AS kover_usage3 FROM gambar WHERE gambar3='$kover_path3'";
            $result_check_kover_usage3 = mysqli_query($koneksi, $query_check_kover_usage3);
            $row_kover_usage3 = mysqli_fetch_assoc($result_check_kover_usage3);
            if ($row_kover_usage3['kover_usage3'] == 0 && file_exists($kover_path3)) {
                unlink($kover_path3);
            }

            $query_check_kover_usage4 = "SELECT COUNT(*) AS kover_usage4 FROM gambar WHERE gambar4='$kover_path4'";
            $result_check_kover_usage4 = mysqli_query($koneksi, $query_check_kover_usage4);
            $row_kover_usage4 = mysqli_fetch_assoc($result_check_kover_usage4);
            if ($row_kover_usage4['kover_usage4'] == 0 && file_exists($kover_path4)) {
                unlink($kover_path4);
            }

            // Jika penghapusan berhasil, kirimkan respons 'success'
            echo "success";
        } else {
            // Jika terjadi kesalahan saat melakukan proses penghapusan, kirimkan respons 'error'
            echo "error";
        }
    } else {
        // Jika terjadi kesalahan saat mengambil data kover dan gambar, kirimkan respons 'error'
        echo "error";
    }
} else {
    // Jika metode request bukan POST, kirimkan respons 'method_not_allowed'
    http_response_code(405);
    echo "Method Not Allowed";
}

// Tutup koneksi ke database
mysqli_close($koneksi);
