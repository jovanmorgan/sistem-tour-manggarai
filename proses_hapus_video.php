<?php
// Lakukan koneksi ke database
include '../koneksi.php';

// Cek apakah terdapat data yang dikirimkan melalui metode POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Tangkap ID video yang akan dihapus
    $id = $_POST['id'];

    // Query SQL untuk mengambil data kover dan video yang akan dihapus
    $query_select_files = "SELECT data_kover, data_video FROM video WHERE id_video='$id'";
    $result_select_files = mysqli_query($koneksi, $query_select_files);

    if ($result_select_files) {
        $row = mysqli_fetch_assoc($result_select_files);
        $kover_path = $row['data_kover'];
        $video_path = $row['data_video'];

        // Buat query SQL untuk menghapus data video berdasarkan ID
        $query_delete_video = "DELETE FROM video WHERE id_video='$id'";
        $result_delete_video = mysqli_query($koneksi, $query_delete_video);

        if ($result_delete_video) {
            // Hapus file kover jika tidak digunakan oleh data video lain
            $query_check_kover_usage = "SELECT COUNT(*) AS kover_usage FROM video WHERE data_kover='$kover_path'";
            $result_check_kover_usage = mysqli_query($koneksi, $query_check_kover_usage);
            $row_kover_usage = mysqli_fetch_assoc($result_check_kover_usage);
            if ($row_kover_usage['kover_usage'] == 0 && file_exists($kover_path)) {
                unlink($kover_path);
            }

            // Hapus file video jika tidak digunakan oleh data video lain
            $query_check_video_usage = "SELECT COUNT(*) AS video_usage FROM video WHERE data_video='$video_path'";
            $result_check_video_usage = mysqli_query($koneksi, $query_check_video_usage);
            $row_video_usage = mysqli_fetch_assoc($result_check_video_usage);
            if ($row_video_usage['video_usage'] == 0 && file_exists($video_path)) {
                unlink($video_path);
            }

            // Jika penghapusan berhasil, kirimkan respons 'success'
            echo "success";
        } else {
            // Jika terjadi kesalahan saat melakukan proses penghapusan, kirimkan respons 'error'
            echo "error";
        }
    } else {
        // Jika terjadi kesalahan saat mengambil data kover dan video, kirimkan respons 'error'
        echo "error";
    }
} else {
    // Jika metode request bukan POST, kirimkan respons 'method_not_allowed'
    http_response_code(405);
    echo "Method Not Allowed";
}

// Tutup koneksi ke database
mysqli_close($koneksi);
