<?php
// Lakukan koneksi ke database
include '../koneksi.php';

// Cek apakah terdapat data yang dikirimkan melalui metode POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Tangkap ID info yang akan dihapus
    $id = $_POST['id'];

    // Query SQL untuk mengambil data kover dan info yang akan dihapus
    $query_select_files = "SELECT gambar1, gambar2, gambar3 FROM info WHERE id_info='$id'";
    $result_select_files = mysqli_query($koneksi, $query_select_files);

    if ($result_select_files) {
        $row = mysqli_fetch_assoc($result_select_files);
        $kover_path1 = $row['gambar1'];
        $kover_path2 = $row['gambar2'];
        $kover_path3 = $row['gambar3'];

        // Buat query SQL untuk menghapus data info berdasarkan ID
        $query_delete_info = "DELETE FROM info WHERE id_info='$id'";
        $result_delete_info = mysqli_query($koneksi, $query_delete_info);

        if ($result_delete_info) {
            // Hapus file kover jika tidak digunakan oleh data info lain
            $query_check_kover_usage1 = "SELECT COUNT(*) AS kover_usage1 FROM info WHERE gambar1='$kover_path1'";
            $result_check_kover_usage1 = mysqli_query($koneksi, $query_check_kover_usage1);
            $row_kover_usage1 = mysqli_fetch_assoc($result_check_kover_usage1);
            if ($row_kover_usage1['kover_usage1'] == 0 && file_exists($kover_path1)) {
                unlink($kover_path1);
            }

            $query_check_kover_usage2 = "SELECT COUNT(*) AS kover_usage2 FROM info WHERE gambar2='$kover_path2'";
            $result_check_kover_usage2 = mysqli_query($koneksi, $query_check_kover_usage2);
            $row_kover_usage2 = mysqli_fetch_assoc($result_check_kover_usage2);
            if ($row_kover_usage2['kover_usage2'] == 0 && file_exists($kover_path2)) {
                unlink($kover_path2);
            }

            $query_check_kover_usage3 = "SELECT COUNT(*) AS kover_usage3 FROM info WHERE gambar3='$kover_path3'";
            $result_check_kover_usage3 = mysqli_query($koneksi, $query_check_kover_usage3);
            $row_kover_usage3 = mysqli_fetch_assoc($result_check_kover_usage3);
            if ($row_kover_usage3['kover_usage3'] == 0 && file_exists($kover_path3)) {
                unlink($kover_path3);
            }

            // Jika penghapusan berhasil, kirimkan respons 'success'
            echo "success";
        } else {
            // Jika terjadi kesalahan saat melakukan proses penghapusan, kirimkan respons 'error'
            echo "error";
        }
    } else {
        // Jika terjadi kesalahan saat mengambil data kover dan info, kirimkan respons 'error'
        echo "error";
    }
} else {
    // Jika metode request bukan POST, kirimkan respons 'method_not_allowed'
    http_response_code(405);
    echo "Method Not Allowed";
}

// Tutup koneksi ke database
mysqli_close($koneksi);
