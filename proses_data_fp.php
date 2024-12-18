<?php
// Lakukan koneksi ke database
include '../koneksi.php';

// Cek apakah terdapat data yang dikirimkan melalui metode POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Tangkap data yang dikirimkan melalui form
    $id_admin = $_POST['id_admin'];
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $deskripsi = $_POST['deskripsi'];

    // Lakukan validasi data
    if (empty($username) || empty($email) || empty($password) || empty($deskripsi)) {
        echo "data tidak lengkap";
        exit();
    }

    // Query SQL untuk update data foto profile
    $query = "UPDATE admin SET username='$username', email='$email', password='$password', deskripsi='$deskripsi' WHERE id_admin='$id_admin'";

    // Lakukan proses update data foto profile di database
    $result = mysqli_query($koneksi, $query);
    if ($result) {
        echo "success";
        exit();
    } else {
        // Jika terjadi kesalahan saat melakukan proses update, tampilkan pesan kesalahan
        echo "Gagal melakukan proses update data foto profile: " . mysqli_error($koneksi);
    }
} else {
    // Jika metode request bukan POST, berikan respons yang sesuai
    echo "Invalid request method";
    exit();
}

// Tutup koneksi ke database
mysqli_close($koneksi);
