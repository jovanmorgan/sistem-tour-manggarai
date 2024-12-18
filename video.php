<?php
session_start();

// Periksa apakah pengguna sudah login atau belum
if (!isset($_SESSION['id_admin'])) {
    // Pengguna belum login, arahkan kembali ke halaman masuk.php
    header("Location: ../masuk");
    exit; // Pastikan untuk menghentikan eksekusi skrip setelah mengarahkan
}

// Jika pengguna sudah login, Anda dapat melanjutkan menampilkan halaman admin.php seperti biasa
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="apple-touch-icon" sizes="76x76" href="../assets/img/apple-icon.png">
    <link rel="icon" type="image/png" href="../assets/img/logo4.png">
    <title>
        TourMa | Admin Video
    </title>
    <!--     Fonts and icons     -->
    <link href="https://fonts.googleapis.com/css?family=Poppins:200,300,400,600,700,800" rel="stylesheet" />
    <link href="https://use.fontawesome.com/releases/v5.0.6/css/all.css" rel="stylesheet">
    <!-- Nucleo Icons -->
    <link href="../assets/css/nucleo-icons.css" rel="stylesheet" />
    <!-- CSS Files -->
    <link href="../assets/css/black-dashboard.css?v=1.0.0" rel="stylesheet" />
    <!-- CSS Just for demo purpose, don't include it in your project -->
    <link href="../assets/demo/demo.css" rel="stylesheet" />
    <link href="../assets/css/loding.css" rel="stylesheet" />
</head>

<body class="">
    <div class="wrapper">
        <div class="sidebar">
            <div class="sidebar-wrapper">
                <div class="logo">
                    <a href="javascript:void(0)" class="simple-text logo-mini">
                        <img src="../img/logo4.png" width="50px" alt="" style="position: relative; bottom: 3px;">
                    </a>
                    <a href="javascript:void(0)" class="simple-text logo-normal position-relative" style="font-size: 26px; font-weight: bold; font-style: italic; right: 10px; color: #368a06;">
                        TourMa
                    </a>
                </div>
                <ul class="nav">
                    <li>
                        <a href="./admin">
                            <i class="tim-icons icon-chart-pie-36"></i>
                            <p>Dashboard</p>
                        </a>
                    </li>
                    <li class="active">
                        <a href="./video">
                            <i class="tim-icons icon-camera-18"></i>
                            <p>Video</p>
                        </a>
                    </li>
                    <li>
                        <a href="./info">
                            <i class="tim-icons icon-alert-circle-exc"></i>
                            <p>Informasi</p>
                        </a>
                    </li>
                    <li>
                        <a href="./gambar">
                            <i class="fas fa-images"></i>
                            <p>Gambar</p>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
        <div class="main-panel">
            <!-- Navbar -->
            <nav class="navbar navbar-expand-lg navbar-absolute navbar-transparent">
                <div class="container-fluid">
                    <div class="navbar-wrapper">
                        <div class="navbar-toggle d-inline">
                            <button type="button" class="navbar-toggler">
                                <span class="navbar-toggler-bar bar1"></span>
                                <span class="navbar-toggler-bar bar2"></span>
                                <span class="navbar-toggler-bar bar3"></span>
                            </button>
                        </div>
                        <a class="navbar-brand" href="javascript:void(0)">Dashboard</a>
                    </div>
                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navigation" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-bar navbar-kebab"></span>
                        <span class="navbar-toggler-bar navbar-kebab"></span>
                        <span class="navbar-toggler-bar navbar-kebab"></span>
                    </button>
                    <div class="collapse navbar-collapse" id="navigation">
                        <ul class="navbar-nav ml-auto">
                            <li class="search-bar input-group">
                                <button class="btn btn-link" id="search-button" data-toggle="modal" data-target="#searchModal"><i class="tim-icons icon-zoom-split"></i>
                                    <span class="d-lg-none d-md-block">Search</span>
                                </button>
                            </li>
                            <li class="dropdown nav-item">
                                <a href="#" class="dropdown-toggle nav-link" data-toggle="dropdown">
                                    <div class="photo">
                                        <?php
                                        // Lakukan koneksi ke database
                                        include '../koneksi.php';

                                        // Periksa apakah session id_admin telah diset
                                        if (isset($_SESSION['id_admin'])) {
                                            $id_admin = $_SESSION['id_admin'];

                                            // Query SQL untuk mengambil data admin berdasarkan id_admin dari session
                                            $query = "SELECT * FROM admin WHERE id_admin = '$id_admin'";
                                            $result = mysqli_query($koneksi, $query);

                                            // Periksa apakah query berhasil dieksekusi
                                            if ($result) {
                                                // Periksa apakah terdapat data admin
                                                if (mysqli_num_rows($result) > 0) {
                                                    // Ambil data admin sebagai array asosiatif
                                                    $admin = mysqli_fetch_assoc($result);
                                        ?>
                                                    <?php if (!empty($admin['foto_profile'])) : ?>
                                                        <img class="avatar" src="data_fp/<?php echo $admin['foto_profile']; ?>" alt="...">
                                                    <?php else : ?>
                                                        <img class="avatar" src="../assets/img/anime3.png" alt="Profile Photo">
                                                    <?php endif; ?>
                                                    <h5 class="title"><?php echo $admin['id_admin']; ?></h5>
                                        <?php
                                                } else {
                                                    // Jika tidak ada data admin
                                                    echo "Tidak ada data admin.";
                                                }
                                            } else {
                                                // Jika query tidak berhasil dieksekusi
                                                echo "Gagal mengambil data admin: " . mysqli_error($koneksi);
                                            }
                                        } else {
                                            // Jika session id_admin tidak diset
                                            echo "Session id_admin tidak tersedia.";
                                        }

                                        // Tutup koneksi ke database
                                        mysqli_close($koneksi);
                                        ?>

                                    </div>
                                    <b class="caret d-none d-lg-block d-xl-block"></b>
                                    <p class="d-lg-none">
                                        Log out
                                    </p>
                                </a>
                                <ul class="dropdown-menu dropdown-navbar">
                                    <li class="nav-link"><a href="foto_profile" class="nav-item dropdown-item">Profile</a></li>
                                    <li class="nav-link"><a href="logout" class="nav-item dropdown-item">Log
                                            out</a></li>
                                </ul>
                            </li>
                            <li class="separator d-lg-none"></li>
                        </ul>
                    </div>
                </div>
            </nav>
            <div class="modal modal-search fade" id="searchModal" tabindex="-1" role="dialog" aria-labelledby="searchModal" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <input type="text" class="form-control" id="inlineFormInputGroup" placeholder="SEARCH">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <i class="tim-icons icon-simple-remove"></i>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            <!-- End Navbar -->


            <div class="content">
                <div class="row">
                    <!-- Modal -->
                    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel" style="font-size: 150%;">Tambah Data Video</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true" style="font-size: 140%;">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <!-- Form untuk menambahkan data video -->
                                    <form id="addVideoForm" action="proses_simpan_video.php" method="POST" enctype="multipart/form-data">
                                        <div class="form-group">
                                            <label for="nama">Nama:</label>
                                            <input type="text" class="form-control" id="name" name="name" style="color: black;">
                                        </div>
                                        <div class="form-group">
                                            <label for="type">Type:</label>
                                            <select class="form-control" id="type" name="type" style="color: black;">
                                                <option value='' class="form-control" selected style="color: black;">Silakan Pilih Type Video</option>
                                                <option value='video_profile' class="form-control" style="color: black;">Video Profile</option>
                                                <option value='video_wisata' class="form-control" style="color: black;">Video Wisata</option>
                                                <option value='video_kebudayaan' class="form-control" style="color: black;">Video Kebudayaan</option>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="durasi">Durasi:</label>
                                            <input type="text" class="form-control" id="durasi" name="durasi" style="color: black;">
                                        </div>
                                        <div class="form-group">
                                            <label for="alamat">Alamat:</label>
                                            <input type="text" class="form-control" id="alamat" name="alamat" style="color: black;">
                                        </div>
                                        <div class="form-group">
                                            <label for="reting">Reting:</label>
                                            <select class="form-control" id="reting" name="reting" style="color: black;">
                                                <option value='' class="form-control" selected style="color: black;">Silakan Pilih reting</option>
                                                <?php
                                                // Loop untuk menambahkan opsi dari 1 sampai 5
                                                for ($i = 1; $i <= 5; $i++) {
                                                    echo "<option class='form-control' value='$i' style='color: black;'>Reting $i</option>";
                                                }
                                                ?>
                                            </select>
                                        </div>

                                        <input type="text" class="d-none" id="tanggal" name="tanggal" style="color: black;">
                                        <script>
                                            // Fungsi untuk mendapatkan waktu saat ini di Kota Kupang
                                            function getKupangTime() {
                                                // Buat objek waktu saat ini
                                                var currentTime = new Date();

                                                // Set zona waktu ke Waktu Indonesia Timur (WIT)
                                                var options = {
                                                    timeZone: 'Asia/Makassar' // Kota Kupang berada di Zona Waktu Indonesia Timur (WIT)
                                                };
                                                var kupangTime = currentTime.toLocaleString('id-ID', options);

                                                return kupangTime;
                                            }

                                            // Ambil elemen input tanggal
                                            var tanggalInput = document.getElementById('tanggal');

                                            // Set nilai input tanggal dengan waktu saat ini di Kota Kupang
                                            tanggalInput.value = getKupangTime();
                                        </script>

                                        <div class="form-group">
                                            <label for="deskripsi">Deskripsi:</label>
                                            <textarea class="form-control" id="deskripsi" name="deskripsi" style="color: black;"></textarea>
                                        </div>
                                        <div class="form-group">
                                            <label for="kover">Data Kover :</label>
                                            <input type="file" class="form-control-file d-none" id="kover" name="data_kover" onchange="previewImage(this, 'koverPreview')">
                                            <label class="btn btn-primary" for="kover">Pilih Gambar</label>
                                        </div>

                                        <div class="card" id="koverPreview" style="display: none;">
                                            <img class="card-img-top" id="koverImage" src="#" alt="Kover Image">
                                            <div class="card-body">
                                                <p class="card-text">Preview Kover</p>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label for="video">Data Video :</label>
                                            <input type="file" class="form-control-file d-none" id="video" name="data_video" onchange="previewVideo(this, 'videoPreview')">
                                            <label class="btn btn-primary" for="video">Pilih Video</label>
                                        </div>

                                        <div class="card" id="videoPreview" style="display: none;">
                                            <video class="card-img-top" id="videoPlayer" controls>
                                                Your browser does not support the video tag.
                                            </video>
                                            <div class="card-body">
                                                <p class="card-text">Preview Video</p>
                                            </div>
                                        </div>

                                        <script>
                                            function previewImage(input, previewId) {
                                                var preview = document.getElementById(previewId);
                                                var image = document.getElementById('koverImage');
                                                var file = input.files[0];
                                                var fileType = file.type;

                                                if (fileType.match('image.*')) {
                                                    if (input.files && input.files[0]) {
                                                        var reader = new FileReader();

                                                        reader.onload = function(e) {
                                                            image.src = e.target.result;
                                                            preview.style.display = 'block';
                                                        }

                                                        reader.readAsDataURL(input.files[0]);
                                                    } else {
                                                        image.src = '#';
                                                        preview.style.display = 'none';
                                                    }
                                                } else {
                                                    $.notify({
                                                        icon: "tim-icons icon-bell-55",
                                                        message: "Mohon pilih file gambar.",
                                                    }, {
                                                        type: 'danger',
                                                        timer: 3000,
                                                        placement: {
                                                            from: 'top',
                                                            align: 'center'
                                                        }
                                                    });
                                                    input.value = '';
                                                }
                                            }

                                            function previewVideo(input, previewId) {
                                                var preview = document.getElementById(previewId);
                                                var videoPlayer = document.getElementById('videoPlayer');
                                                var file = input.files[0];
                                                var fileType = file.type;

                                                if (fileType.match('video.*')) {
                                                    if (input.files && input.files[0]) {
                                                        var reader = new FileReader();

                                                        reader.onload = function(e) {
                                                            videoPlayer.src = e.target.result;
                                                            preview.style.display = 'block';
                                                        }

                                                        reader.readAsDataURL(input.files[0]);
                                                    } else {
                                                        videoPlayer.src = '#';
                                                        preview.style.display = 'none';
                                                    }
                                                } else {
                                                    $.notify({
                                                        icon: "tim-icons icon-bell-55",
                                                        message: "Mohon pilih file video.",
                                                    }, {
                                                        type: 'danger',
                                                        timer: 3000,
                                                        placement: {
                                                            from: 'top',
                                                            align: 'center'
                                                        }
                                                    });
                                                    input.value = '';
                                                }
                                            }
                                        </script>

                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                            <button type="submit" class="btn btn-primary addVideoBtn">Tambahkan</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Edit Modal -->
                    <div class="modal fade" id="exampleEditModal" tabindex="-1" role="dialog" aria-labelledby="editModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="editModalLabel" style="font-size: 150%;">Edit Video</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true" style="font-size: 140%;">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <!-- Form untuk menambahkan atau mengedit data video -->
                                    <form id="addEditVideoForm" action="proses_edit_video.php" method="POST" enctype="multipart/form-data">
                                        <!-- Menambahkan input tersembunyi untuk menyimpan id_video saat mengedit -->
                                        <input type="hidden" id="editId" name="editId">

                                        <!-- Nama -->
                                        <div class="form-group">
                                            <label for="name">Nama:</label>
                                            <input type="text" class="form-control" id="editName" name="editName" style="color: black;">
                                        </div>

                                        <div class="form-group">
                                            <label for="type">Type:</label>
                                            <select class="form-control" id="editType" name="editType" style="color: black;">
                                                <option value='' class="form-control" selected style="color: black;">Silakan Pilih Type Video</option>
                                                <option value='video_profile' class="form-control" style="color: black;">Video Profile</option>
                                                <option value='video_wisata' class="form-control" style="color: black;">Video Wisata</option>
                                                <option value='video_kebudayaan' class="form-control" style="color: black;">Video Kebudayaan</option>
                                            </select>
                                        </div>
                                        <!-- Durasi -->
                                        <div class="form-group">
                                            <label for="durasi">Durasi:</label>
                                            <input type="text" class="form-control" id="editDurasi" name="editDurasi" style="color: black;">
                                        </div>

                                        <!-- Alamat -->
                                        <div class="form-group">
                                            <label for="alamat">Alamat:</label>
                                            <input type="text" class="form-control" id="editAlamat" name="editAlamat" style="color: black;">
                                        </div>

                                        <!-- Reting -->
                                        <div class="form-group">
                                            <label for="reting">Reting:</label>
                                            <select class="form-control" id="editReting" name="editReting" style="color: black;">
                                                <option value='' class="form-control" selected style="color: black;">Silakan Pilih reting</option>
                                                <?php
                                                // Loop untuk menambahkan opsi dari 1 sampai 5
                                                for ($i = 1; $i <= 5; $i++) {
                                                    echo "<option class='form-control' value='$i' style='color: black;'>Reting $i</option>";
                                                }
                                                ?>
                                            </select>
                                        </div>
                                        <input type="text" class="d-none" id="edittanggal" name="edittanggal" style="color: black;">
                                        <script>
                                            // Fungsi untuk mendapatkan waktu saat ini di Kota Kupang
                                            function getKupangTime() {
                                                // Buat objek waktu saat ini
                                                var currentTime = new Date();

                                                // Set zona waktu ke Waktu Indonesia Timur (WIT)
                                                var options = {
                                                    timeZone: 'Asia/Makassar' // Kota Kupang berada di Zona Waktu Indonesia Timur (WIT)
                                                };
                                                var kupangTime = currentTime.toLocaleString('id-ID', options);

                                                return kupangTime;
                                            }

                                            // Ambil elemen input tanggal
                                            var tanggalInput = document.getElementById('edittanggal');

                                            // Set nilai input tanggal dengan waktu saat ini di Kota Kupang
                                            tanggalInput.value = getKupangTime();
                                        </script>
                                        <!-- Deskripsi -->
                                        <div class="form-group">
                                            <label for="deskripsi">Deskripsi:</label>
                                            <textarea class="form-control" id="editDeskripsi" name="editDeskripsi" style="color: black;"></textarea>
                                        </div>

                                        <!-- Hidden input untuk menyimpan nama file kover dan video yang ada di server -->
                                        <input type="hidden" id="existingKover" name="existingKover">
                                        <input type="hidden" id="existingVideo" name="existingVideo">

                                        <!-- Data Kover -->
                                        <div class="form-group">
                                            <label for="kover">Data Kover:</label>
                                            <input type="file" class="form-control-file d-none" id="editKover" name="editDataKover" onchange="previewImageAndSetExisting(this, 'koverPreview')">
                                            <label class="btn btn-primary" for="editKover">Pilih Gambar</label>
                                        </div>

                                        <!-- Preview Kover -->
                                        <div class="card" id="editkoverPreview" style="display: none;">
                                            <img class="card-img-top" id="editkoverImage" src="#" alt="Kover Image">
                                            <div class="card-body">
                                                <p class="card-text">Preview Kover</p>
                                            </div>
                                        </div>

                                        <!-- Data Video -->
                                        <div class="form-group">
                                            <label for="video">Data Video:</label>
                                            <input type="file" class="form-control-file d-none" id="editVideo" name="editDataVideo" onchange="previewVideo(this, 'videoPreview')">
                                            <label class="btn btn-primary" for="editVideo">Pilih Video</label>
                                        </div>

                                        <!-- Preview Video -->
                                        <div class="card" id="editvideoPreview" style="display: none;">
                                            <video class="card-img-top" id="editvideoPlayer" controls>
                                                Your browser does not support the video tag.
                                            </video>
                                            <div class="card-body">
                                                <p class="card-text">Preview Video</p>
                                            </div>
                                        </div>

                                        <script>
                                            function openEditModal(id, nama, type, durasi, alamat, reting, deskripsi, kover, video) {
                                                // Isi data ke dalam form edit
                                                document.getElementById('editId').value = id;
                                                document.getElementById('editName').value = nama;
                                                document.getElementById('editType').value = type;
                                                document.getElementById('editDurasi').value = durasi;
                                                document.getElementById('editAlamat').value = alamat;
                                                document.getElementById('editReting').value = reting;
                                                document.getElementById('editDeskripsi').value = deskripsi;
                                                document.getElementById('existingKover').value = kover;
                                                document.getElementById('existingVideo').value = video;

                                                // Menampilkan preview kover jika ada
                                                if (kover !== '') {
                                                    var koverPreview = document.getElementById('editkoverPreview');
                                                    var koverImage = document.getElementById('editkoverImage');
                                                    koverImage.src = kover;
                                                    koverPreview.style.display = 'block';
                                                }

                                                // Menampilkan preview video jika ada
                                                if (video !== '') {
                                                    var videoPreview = document.getElementById('editvideoPreview');
                                                    var videoPlayer = document.getElementById('editvideoPlayer');
                                                    videoPlayer.src = video;
                                                    videoPreview.style.display = 'block';
                                                }

                                                $('#exampleEditModal').modal('show');
                                            }

                                            function previewImageAndSetExisting(input, previewId) {
                                                var preview = document.getElementById(previewId);
                                                var image = document.getElementById('editkoverImage');
                                                var file = input.files[0];
                                                var fileType = file.type;

                                                // Set nilai dari hidden input dengan nama file kover yang baru dipilih
                                                document.getElementById('existingKover').value = file.name;
                                                document.getElementById('existingVideo').value = file.name;

                                                if (fileType.match('image.*')) {
                                                    if (input.files && input.files[0]) {
                                                        var reader = new FileReader();

                                                        reader.onload = function(e) {
                                                            image.src = e.target.result;
                                                            preview.style.display = 'block';
                                                        }

                                                        reader.readAsDataURL(input.files[0]);
                                                    } else {
                                                        image.src = '#';
                                                        preview.style.display = 'none';
                                                    }
                                                } else {
                                                    $.notify({
                                                        icon: "tim-icons icon-bell-55",
                                                        message: "Mohon pilih file gambar.",
                                                    }, {
                                                        type: 'danger',
                                                        timer: 3000,
                                                        placement: {
                                                            from: 'top',
                                                            align: 'center'
                                                        }
                                                    });
                                                    input.value = '';
                                                }
                                            }

                                            function previewVideo(input, previewId) {
                                                var preview = document.getElementById(previewId);
                                                var videoPlayer = document.getElementById('editvideoPlayer');
                                                var file = input.files[0];
                                                var fileType = file.type;

                                                if (fileType.match('video.*')) {
                                                    if (input.files && input.files[0]) {
                                                        var reader = new FileReader();

                                                        reader.onload = function(e) {
                                                            videoPlayer.src = e.target.result;
                                                            preview.style.display = 'block';
                                                        }

                                                        reader.readAsDataURL(input.files[0]);
                                                    } else {
                                                        videoPlayer.src = '#';
                                                        preview.style.display = 'none';
                                                    }
                                                } else {
                                                    $.notify({
                                                        icon: "tim-icons icon-bell-55",
                                                        message: "Mohon pilih file video.",
                                                    }, {
                                                        type: 'danger',
                                                        timer: 3000,
                                                        placement: {
                                                            from: 'top',
                                                            align: 'center'
                                                        }
                                                    });
                                                    input.value = '';
                                                }
                                            }
                                        </script>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                            <button type="submit" class="btn btn-primary" id="addEditVideoForm">Save changes</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="places-buttons">
                                    <div class="row">
                                        <div class="col-md-6 ml-auto mr-auto text-center">
                                            <h2 class="card-title">
                                                Data Video
                                            </h2>

                                            <p class="category">Clik untuk menambah data video</p>
                                            <hr>
                                            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
                                                Tambah Data
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-12">
                        <div class="card ">
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table tablesorter " id="videoTable">
                                        <thead class=" text-primary">
                                            <tr>
                                                <th>
                                                    Nomor
                                                </th>
                                                <th>
                                                    Name
                                                </th>
                                                <th>
                                                    Type
                                                </th>
                                                <th>
                                                    Durasi
                                                </th>
                                                <th>
                                                    Tanggal
                                                </th>
                                                <th>
                                                    Alamat
                                                </th>
                                                <th>
                                                    Reting
                                                </th>
                                                <th>
                                                    Deskripsi
                                                </th>
                                                <th>
                                                    Kover
                                                </th>
                                                <th class="text-center">
                                                    Video
                                                </th>
                                                <th class="text-center">
                                                    Option
                                                </th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            // Lakukan koneksi ke database
                                            include '../koneksi.php';

                                            // Query SQL untuk mengambil data dari tabel video
                                            $query = "SELECT * FROM video";
                                            $result = mysqli_query($koneksi, $query);

                                            // Variabel untuk menyimpan nomor urut
                                            $counter = 1;

                                            // Cek jika query berhasil dieksekusi
                                            if ($result) {
                                                // Lakukan iterasi untuk menampilkan setiap baris data dalam tabel
                                                while ($row = mysqli_fetch_assoc($result)) {
                                                    // Menghapus tulisan "data_gambar/" pada data_kover dan membuatnya menjadi $edit_data_kover
                                                    $edit_data_kover = str_replace("data_gambar/", "", $row['data_kover']);
                                                    $edit_data_video = str_replace("data_video/", "", $row['data_video']);

                                                    // Menampilkan data ke dalam tabel HTML
                                                    echo "<tr>";
                                                    echo "<td>" . $counter . "</td>";
                                                    echo "<td>" . $row['nama'] . "</td>";
                                                    echo "<td>" . $row['type'] . "</td>";
                                                    echo "<td>" . $row['durasi'] . "</td>";
                                                    echo "<td>" . $row['tanggal'] . "</td>";
                                                    echo "<td>" . $row['alamat'] . "</td>";
                                                    echo "<td>" . $row['reting'] . "</td>";
                                                    echo "<td>" . $row['deskripsi'] . "</td>";
                                                    echo "<td><img src='" . $row['data_kover'] . "' alt='Kover Image' style='max-width: 100px;'></td>";
                                                    echo "<td class='text-center'><a href='" . $row['data_video'] . "' target='_blank'>Lihat Video</a></td>";
                                                    echo "<td class='text-center'>
                                                    <button class='btn btn-primary btn-sm' onclick='openEditModal(
                                                        \"" . $row['id_video'] . "\",
                                                        \"" . $row['nama'] . "\",
                                                        \"" . $row['type'] . "\",
                                                        \"" . $row['durasi'] . "\",
                                                        \"" . $row['alamat'] . "\",
                                                        \"" . $row['reting'] . "\",
                                                        \"" . $row['deskripsi'] . "\",
                                                        \"" . $row['data_kover'] . "\",
                                                        \"" . $row['data_video'] . "\"
                                                    )'>Edit</button>
                                                    <button class='btn btn-danger btn-sm' onclick='deleteVideo(\"" . $row['id_video'] . "\")'>Hapus</button>
                                                </td>";

                                                    echo "</tr>";

                                                    // Increment nomor urut
                                                    $counter++;
                                                }
                                            } else {
                                                echo "Gagal mengambil data dari database";
                                            }

                                            // Tutup koneksi ke database
                                            mysqli_close($koneksi);
                                            ?>


                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <footer class="footer">
                <div class="container-fluid">
                    <ul class="nav">

                        <li class="nav-item">
                            <a href="javascript:void(0)" class="nav-link">
                                About Us
                            </a>
                        </li>

                    </ul>
                    <div class="copyright">
                        ©
                        <script>
                            document.write(new Date().getFullYear())
                        </script>2024 Dibuat Oleh Ayumand <i class="tim-icons icon-heart-2"></i>
                    </div>
                </div>
            </footer>
        </div>
    </div>
    <div class="fixed-plugin">
        <div class="dropdown show-dropdown">
            <a href="#" data-toggle="dropdown">
                <i class="fa fa-cog fa-2x"> </i>
            </a>
            <ul class="dropdown-menu">
                <li class="header-title">Warna Navbar</li>
                <li class="adjustments-line">
                    <a href="javascript:void(0)" class="switch-trigger background-color">
                        <div class="badge-colors text-center">
                            <span class="badge filter badge-primary active" data-color="primary"></span>
                            <span class="badge filter badge-info" data-color="blue"></span>
                            <span class="badge filter badge-success" data-color="green"></span>
                        </div>
                        <div class="clearfix"></div>
                    </a>
                </li>
                <li class="adjustments-line text-center color-change">
                    <span class="color-label">Warna Body Putih</span>
                    <span class="badge light-badge mr-2"></span>
                    <span class="badge dark-badge ml-2"></span>
                    <span class="color-label">Warna Body Hitam</span>
                </li>
                <li class="header-title">Silakan Pilih Warna Sesui Keinginan Anda!</li>
                <li class="button-container text-center">
                </li>
            </ul>
        </div>
    </div>

    <!--=============== LOADING ===============-->
    <div class="loading">
        <div class="circle"></div>
        <div class="circle"></div>
        <div class="circle"></div>
    </div>

    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <!-- Tambahkan kode JavaScript untuk mengirim data form tanpa mengarahkan ke halaman lain -->
    <script>
        const loding = document.querySelector('.loading');

        document.addEventListener('DOMContentLoaded', function() {
            document.getElementById('addVideoForm').addEventListener('submit', function(event) {
                event.preventDefault(); // Menghentikan aksi default form submit

                var form = this;
                var formData = new FormData(form);

                // Tampilkan elemen .loading sebelum mengirimkan permintaan AJAX
                loding.style.display = 'flex';

                var xhr = new XMLHttpRequest();
                xhr.open('POST', 'proses_simpan_video.php', true);
                xhr.onload = function() {
                    // Sembunyikan elemen .loading setelah permintaan AJAX selesai
                    loding.style.display = 'none';

                    if (xhr.status === 200) {
                        // Tangani respons dari proses_simpan_video.php di sini
                        var response = xhr.responseText;
                        if (response === 'success') {
                            swal("Berhasil!", "Data video berhasil ditambahkan", "success");
                            // Reset form setelah berhasil
                            form.reset();
                            // Sembunyikan preview gambar dan video setelah berhasil
                            document.getElementById('koverPreview').style.display = 'none';
                            document.getElementById('videoPreview').style.display = 'none';
                            // Tutup modal setelah berhasil
                            $('#exampleModal').modal('hide');
                            // Muat ulang tabel
                            loadTable();
                        } else if (response === 'data_tidak_lengkap') {
                            swal("Error", "Data yang anda masukan belum lengkap", "error");
                        } else {
                            swal("Error", "Gagal menambahkan data video", "error");
                        }
                    } else {
                        swal("Error", "Terjadi kesalahan saat mengirim data", "error");
                    }
                };
                xhr.send(formData);
            });
        });

        // logika untuk mengedit data video
        document.addEventListener('DOMContentLoaded', function() {
            document.getElementById('addEditVideoForm').addEventListener('submit', function(event) {
                event.preventDefault(); // Menghentikan aksi default form submit

                var form = this;
                var formData = new FormData(form);
                // Tampilkan elemen .loading sebelum mengirimkan permintaan AJAX
                loding.style.display = 'flex';

                var xhr = new XMLHttpRequest();
                xhr.open('POST', 'proses_edit_video.php', true);
                xhr.onload = function() {

                    // Sembunyikan elemen .loading setelah permintaan AJAX selesai
                    loding.style.display = 'none';

                    if (xhr.status === 200) {
                        // Tangani respons dari proses_edit_video.php di sini
                        var response = xhr.responseText;
                        if (response === 'success') {
                            swal("Suksess!", "Data video berhasil diedit", "success").then((value) => {
                                if (value) {
                                    location.reload(); // Refresh halaman setelah tombol "OK" diklik
                                }
                            });
                            // Reset form setelah berhasil
                            form.reset();
                            // Sembunyikan preview gambar dan video setelah berhasil
                            document.getElementById('editkoverPreview').style.display = 'none';
                            document.getElementById('editvideoPreview').style.display = 'none';
                            // Tutup modal setelah berhasil
                            $('#exampleEditModal').modal('hide');
                        } else if (response === 'data_tidak_lengkap') {
                            swal("Error", "Data edit yang anda masukan belum lengkap", "error");
                        } else {
                            swal("Error", "Gagal mengedit data video", "error");
                        }
                    } else {
                        swal("Error", "Terjadi kesalahan saat mengirim data", "error");
                    }
                };
                xhr.send(formData);
            });
        });

        // logika untuk menghapus data video
        function deleteVideo(id) {
            swal({
                    title: "Apakah Anda yakin?",
                    text: "Setelah dihapus, Anda tidak akan dapat memulihkan data ini!",
                    icon: "warning",
                    buttons: ["Batal", "Ya, hapus!"],
                    dangerMode: true,
                })
                .then((willDelete) => {
                    if (willDelete) {
                        // Jika pengguna mengonfirmasi untuk menghapus
                        var xhr = new XMLHttpRequest();

                        // Tampilkan elemen .loading sebelum mengirimkan permintaan AJAX
                        loding.style.display = 'flex';

                        xhr.open('POST', 'proses_hapus_video.php', true);
                        xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
                        xhr.onload = function() {

                            // Sembunyikan elemen .loading setelah permintaan AJAX selesai
                            loding.style.display = 'none';

                            if (xhr.status === 200) {
                                var response = xhr.responseText;
                                if (response === 'success') {
                                    swal("Sukses!", "Data video berhasil dihapus.", "success")
                                        .then(() => {
                                            // Refresh halaman setelah penghapusan berhasil
                                            window.location.reload();
                                        });
                                } else {
                                    swal("Error", "Gagal menghapus data video.", "error");
                                }
                            } else {
                                swal("Error", "Terjadi kesalahan saat mengirim data.", "error");
                            }
                        };
                        xhr.send("id=" + id);
                    } else {
                        // Jika pengguna membatalkan penghapusan
                        swal("Penghapusan dibatalkan", {
                            icon: "info",
                        });
                    }
                });
        }


        function loadTable() {
            var xhrTable = new XMLHttpRequest();
            xhrTable.onreadystatechange = function() {
                if (xhrTable.readyState == 4 && xhrTable.status == 200) {
                    // Perbarui konten tabel dengan respons dari server
                    document.getElementById('videoTable').innerHTML = xhrTable.responseText;
                }
            };
            xhrTable.open('GET', 'load_video_table.php', true);
            xhrTable.send();
        }
    </script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-Km4P/A4C3CfpzPnqGk3sD4cxsMkSCGS2U5x8bC+v6j8=" crossorigin="anonymous"></script>

    <!--   Core JS Files   -->
    <script src="../assets/js/core/jquery.min.js"></script>
    <script src="../assets/js/core/popper.min.js"></script>
    <script src="../assets/js/core/bootstrap.min.js"></script>
    <script src="../assets/js/plugins/perfect-scrollbar.jquery.min.js"></script>
    <!--  Google Maps Plugin    -->
    <!-- Place this tag in your head or just before your close body tag. -->
    <script src="https://maps.googleapis.com/maps/api/js?key=YOUR_KEY_HERE"></script>
    <!-- Chart JS -->
    <script src="../assets/js/plugins/chartjs.min.js"></script>
    <!--  Notifications Plugin    -->
    <script src="../assets/js/plugins/bootstrap-notify.js"></script>
    <!-- Control Center for Black Dashboard: parallax effects, scripts for the example pages etc -->
    <script src="../assets/js/black-dashboard.min.js?v=1.0.0"></script>
    <!-- Black Dashboard DEMO methods, don't include it in your project! -->
    <script src="../assets/demo/demo.js"></script>
    <script>
        $(document).ready(function() {
            $().ready(function() {
                $sidebar = $('.sidebar');
                $navbar = $('.navbar');
                $main_panel = $('.main-panel');

                $full_page = $('.full-page');

                $sidebar_responsive = $('body > .navbar-collapse');
                sidebar_mini_active = true;
                white_color = false;

                window_width = $(window).width();

                fixed_plugin_open = $('.sidebar .sidebar-wrapper .nav li.active a p').html();



                $('.fixed-plugin a').click(function(event) {
                    if ($(this).hasClass('switch-trigger')) {
                        if (event.stopPropagation) {
                            event.stopPropagation();
                        } else if (window.event) {
                            window.event.cancelBubble = true;
                        }
                    }
                });

                $('.fixed-plugin .background-color span').click(function() {
                    $(this).siblings().removeClass('active');
                    $(this).addClass('active');

                    var new_color = $(this).data('color');

                    if ($sidebar.length != 0) {
                        $sidebar.attr('data', new_color);
                    }

                    if ($main_panel.length != 0) {
                        $main_panel.attr('data', new_color);
                    }

                    if ($full_page.length != 0) {
                        $full_page.attr('filter-color', new_color);
                    }

                    if ($sidebar_responsive.length != 0) {
                        $sidebar_responsive.attr('data', new_color);
                    }
                });

                $('.switch-sidebar-mini input').on("switchChange.bootstrapSwitch", function() {
                    var $btn = $(this);

                    if (sidebar_mini_active == true) {
                        $('body').removeClass('sidebar-mini');
                        sidebar_mini_active = false;
                        blackDashboard.showSidebarMessage('Sidebar mini deactivated...');
                    } else {
                        $('body').addClass('sidebar-mini');
                        sidebar_mini_active = true;
                        blackDashboard.showSidebarMessage('Sidebar mini activated...');
                    }

                    // we simulate the window Resize so the charts will get updated in realtime.
                    var simulateWindowResize = setInterval(function() {
                        window.dispatchEvent(new Event('resize'));
                    }, 180);

                    // we stop the simulation of Window Resize after the animations are completed
                    setTimeout(function() {
                        clearInterval(simulateWindowResize);
                    }, 1000);
                });

                $('.switch-change-color input').on("switchChange.bootstrapSwitch", function() {
                    var $btn = $(this);

                    if (white_color == true) {

                        $('body').addClass('change-background');
                        setTimeout(function() {
                            $('body').removeClass('change-background');
                            $('body').removeClass('white-content');
                        }, 900);
                        white_color = false;
                    } else {

                        $('body').addClass('change-background');
                        setTimeout(function() {
                            $('body').removeClass('change-background');
                            $('body').addClass('white-content');
                        }, 900);

                        white_color = true;
                    }


                });

                $('.light-badge').click(function() {
                    $('body').addClass('white-content');
                });

                $('.dark-badge').click(function() {
                    $('body').removeClass('white-content');
                });
            });
        });
    </script>
    <script src="https://cdn.trackjs.com/agent/v3/latest/t.js"></script>
    <script>
        window.TrackJS &&
            TrackJS.install({
                token: "ee6fab19c5a04ac1a32a645abde4613a",
                application: "black-dashboard-free"
            });
    </script>
</body>

</html>