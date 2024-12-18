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
        TourMa | Admin Galery
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
                    <li>
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
                    <li class="active">
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

            <!-- Modal -->
            <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel" style="font-size: 150%;">Tambah Data gambar</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true" style="font-size: 140%;">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <!-- Form untuk menambahkan data gambar -->
                            <form id="addgambarForm" action="gambar_proses_simpan.php" method="POST" enctype="multipart/form-data">
                                <input type="hidden" id="tanggal" name="tanggal">
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
                                <hr>
                                <div class="form-group">
                                    <label for="nama_gambar1">Nama Data Gambar 1 :</label>
                                    <input type="text" class="form-control" id="nama_gambar1" name="nama_gambar1" style="color: black;">
                                </div>
                                <div class="form-group">
                                    <label for="kover1">Data Gambar 1 :</label>
                                    <input type="file" class="form-control-file d-none" id="kover1" name="gambar1" onchange="previewImage(this, 'koverPreview1', 'koverImage1')">
                                    <label class="btn btn-primary" for="kover1">Pilih Gambar 1</label>
                                </div>

                                <div class="card" id="koverPreview1" style="display: none;">
                                    <img class="card-img-top" id="koverImage1" src="#" alt="Kover Image">
                                    <div class="card-body">
                                        <p class="card-text">Preview Kover</p>
                                    </div>
                                </div>
                                <hr>
                                <div class="form-group">
                                    <label for="nama_gambar2">Nama Data Gambar 2 :</label>
                                    <input type="text" class="form-control" id="nama_gambar2" name="nama_gambar2" style="color: black;">
                                </div>
                                <div class="form-group">
                                    <label for="kover2">Data Gambar 2 :</label>
                                    <input type="file" class="form-control-file d-none" id="kover2" name="gambar2" onchange="previewImage(this, 'koverPreview2', 'koverImage2')">
                                    <label class="btn btn-primary" for="kover2">Pilih Gambar 2</label>
                                </div>
                                <hr>
                                <div class="card" id="koverPreview2" style="display: none;">
                                    <img class="card-img-top" id="koverImage2" src="#" alt="Kover Image">
                                    <div class="card-body">
                                        <p class="card-text">Preview Kover</p>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="durasi">Nama Data Gambar 3 :</label>
                                    <input type="nama_gambar3" class="form-control" id="nama_gambar3" name="nama_gambar3" style="color: black;">
                                </div>
                                <div class="form-group">
                                    <label for="kover3">Data Gambar 3 :</label>
                                    <input type="file" class="form-control-file d-none" id="kover3" name="gambar3" onchange="previewImage(this, 'koverPreview3', 'koverImage3')">
                                    <label class="btn btn-primary" for="kover3">Pilih Gambar 3</label>
                                </div>
                                <hr>
                                <div class="card" id="koverPreview3" style="display: none;">
                                    <img class="card-img-top" id="koverImage3" src="#" alt="Kover Image">
                                    <div class="card-body">
                                        <p class="card-text">Preview Kover</p>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="nama_gambar4">Nama Data Gambar 4 :</label>
                                    <input type="text" class="form-control" id="nama_gambar4" name="nama_gambar4" style="color: black;">
                                </div>
                                <div class="form-group">
                                    <label for="kover4">Data Gambar 4 :</label>
                                    <input type="file" class="form-control-file d-none" id="kover4" name="gambar4" onchange="previewImage(this, 'koverPreview4', 'koverImage4')">
                                    <label class="btn btn-primary" for="kover4">Pilih Gambar 4</label>
                                </div>
                                <hr>
                                <div class="card" id="koverPreview4" style="display: none;">
                                    <img class="card-img-top" id="koverImage4" src="#" alt="Kover Image">
                                    <div class="card-body">
                                        <p class="card-text">Preview Kover</p>
                                    </div>
                                </div>

                                <script>
                                    function previewImage(input, previewId, imageId) {
                                        var preview = document.getElementById(previewId);
                                        var image = document.getElementById(imageId);
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
                                </script>


                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-primary addgambarBtn">Tambahkan</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Edit Modal -->
            <div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="editModalLabel" aria-hidden="true">
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
                            <form id="addEditGambarForm" action="gambar_proses_edit.php" method="POST" enctype="multipart/form-data">
                                <!-- Menambahkan input tersembunyi untuk menyimpan id_video saat mengedit -->
                                <input type="hidden" id="editid_gambar" name="id_gambar">
                                <input type="hidden" id="edittanggal" name="tanggal">
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
                                <hr>
                                <div class="form-group">
                                    <label for="nama_gambar1">Nama Data Gambar 1 :</label>
                                    <input type="text" class="form-control" id="editnama_gambar1" name="nama_gambar1" style="color: black;">
                                </div>
                                <div class="form-group">
                                    <label for="editkover1">Data Gambar 1 :</label>
                                    <input type="file" class="form-control-file d-none" id="editkover1" name="gambar1" onchange="previewImageAndSetExisting(this, 'editkoverPreview1', 'editkoverImage1')">
                                    <label class="btn btn-primary" for="editkover1">Pilih Gambar 1</label>
                                </div>

                                <div class="card" id="editkoverPreview1" style="display: none;">
                                    <img class="card-img-top" id="editkoverImage1" src="#" alt="Kover Image">
                                    <div class="card-body">
                                        <p class="card-text">Preview Kover</p>
                                    </div>
                                </div>
                                <hr>
                                <div class="form-group">
                                    <label for="nama_gambar2">Nama Data Gambar 2 :</label>
                                    <input type="text" class="form-control" id="editnama_gambar2" name="nama_gambar2" style="color: black;">
                                </div>
                                <div class="form-group">
                                    <label for="editkover2">Data Gambar 2 :</label>
                                    <input type="file" class="form-control-file d-none" id="editkover2" name="gambar2" onchange="previewImageAndSetExisting(this, 'editkoverPreview2', 'editkoverImage2')">
                                    <label class="btn btn-primary" for="editkover2">Pilih Gambar 2</label>
                                </div>
                                <hr>
                                <div class="card" id="editkoverPreview2" style="display: none;">
                                    <img class="card-img-top" id="editkoverImage2" src="#" alt="Kover Image">
                                    <div class="card-body">
                                        <p class="card-text">Preview Kover</p>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="nama_gambar3">Nama Data Gambar 3 :</label>
                                    <input type="text" class="form-control" id="editnama_gambar3" name="nama_gambar3" style="color: black;">
                                </div>
                                <div class="form-group">
                                    <label for="editkover3">Data Gambar 3 :</label>
                                    <input type="file" class="form-control-file d-none" id="editkover3" name="gambar3" onchange="previewImageAndSetExisting(this, 'editkoverPreview3', 'editkoverImage3')">
                                    <label class="btn btn-primary" for="editkover3">Pilih Gambar 3</label>
                                </div>
                                <hr>
                                <div class="card" id="editkoverPreview3" style="display: none;">
                                    <img class="card-img-top" id="editkoverImage3" src="#" alt="Kover Image">
                                    <div class="card-body">
                                        <p class="card-text">Preview Kover</p>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="nama_gambar4">Nama Data Gambar 4 :</label>
                                    <input type="text" class="form-control" id="editnama_gambar4" name="nama_gambar4" style="color: black;">
                                </div>
                                <div class="form-group">
                                    <label for="editkover4">Data Gambar 4 :</label>
                                    <input type="file" class="form-control-file d-none" id="editkover4" name="gambar4" onchange="previewImageAndSetExisting(this, 'editkoverPreview4', 'editkoverImage4')">
                                    <label class="btn btn-primary" for="editkover4">Pilih Gambar 4</label>
                                </div>
                                <hr>
                                <div class="card" id="editkoverPreview4" style="display: none;">
                                    <img class="card-img-top" id="editkoverImage4" src="#" alt="Kover Image">
                                    <div class="card-body">
                                        <p class="card-text">Preview Kover</p>
                                    </div>
                                </div>

                                <script>
                                    function openEditModal(id_gambar, tanggal, nama_gambar1, gambar1, nama_gambar2, gambar2, nama_gambar3, gambar3, nama_gambar4, gambar4) {
                                        // Isi data ke dalam form edit
                                        document.getElementById('editid_gambar').value = id_gambar;
                                        document.getElementById('edittanggal').value = tanggal;
                                        document.getElementById('editnama_gambar1').value = nama_gambar1;
                                        document.getElementById('editnama_gambar2').value = nama_gambar2;
                                        document.getElementById('editnama_gambar3').value = nama_gambar3;
                                        document.getElementById('editnama_gambar4').value = nama_gambar4;

                                        // Menampilkan preview gambar jika ada
                                        if (gambar1 !== '') {
                                            var koverPreview = document.getElementById('editkoverPreview1');
                                            var koverImage = document.getElementById('editkoverImage1');
                                            koverImage.src = gambar1;
                                            koverPreview.style.display = 'block';
                                        }
                                        // Menampilkan preview gambar jika ada
                                        if (gambar2 !== '') {
                                            var koverPreview = document.getElementById('editkoverPreview2');
                                            var koverImage = document.getElementById('editkoverImage2');
                                            koverImage.src = gambar2;
                                            koverPreview.style.display = 'block';
                                        }
                                        // Menampilkan preview gambar jika ada
                                        if (gambar3 !== '') {
                                            var koverPreview = document.getElementById('editkoverPreview3');
                                            var koverImage = document.getElementById('editkoverImage3');
                                            koverImage.src = gambar3;
                                            koverPreview.style.display = 'block';
                                        }
                                        // Menampilkan preview gambar jika ada
                                        if (gambar4 !== '') {
                                            var koverPreview = document.getElementById('editkoverPreview4');
                                            var koverImage = document.getElementById('editkoverImage4');
                                            koverImage.src = gambar4;
                                            koverPreview.style.display = 'block';
                                        }

                                        $('#editModal').modal('show');
                                    }

                                    function previewImageAndSetExisting(input, previewId, inputId) {
                                        var preview = document.getElementById(previewId);
                                        var image = document.getElementById(inputId);
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


            <div class="content">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="places-buttons">
                                    <div class="row">
                                        <div class="col-md-6 ml-auto mr-auto text-center">
                                            <h2 class="card-title">
                                                Data Gambar
                                            </h2>

                                            <p class="category">Clik untuk menambah data gambar</p>
                                            <hr>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-8 ml-auto mr-auto">
                                            <div class="row justify-content-center align-items-center">
                                                <div class="col-md-4">
                                                    <button class="btn btn-primary btn-block" data-toggle="modal" data-target="#exampleModal">Tambah Data</button>
                                                </div>
                                            </div>
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
                                    <table class="table tablesorter" id="gambarTable">
                                        <thead class="text-primary">
                                            <tr>
                                                <th class="text-center">
                                                    Nomor
                                                </th>
                                                <th class="text-center">
                                                    Tanggal
                                                </th>
                                                <th class="text-center">
                                                    Nama Gambar 1
                                                </th>
                                                <th class="text-center">
                                                    Gambar 1
                                                </th>
                                                <th class="text-center">
                                                    Nama Gambar 2
                                                </th>
                                                <th class="text-center">
                                                    Gambar 2
                                                </th>
                                                <th class="text-center">
                                                    Nama Gambar 3
                                                </th>
                                                <th class="text-center">
                                                    Gambar 3
                                                </th>
                                                <th class="text-center">
                                                    Nama Gambar 4
                                                </th>
                                                <th class="text-center">
                                                    Gambar 4
                                                </th>
                                                <th class="text-center">
                                                    Edit
                                                </th>
                                                <th class="text-center">
                                                    Hapus
                                                </th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            include '../koneksi.php';
                                            // Ambil data dari tabel gambar
                                            $sql = "SELECT * FROM gambar";
                                            $result = mysqli_query($koneksi, $sql);

                                            // Nomor urut
                                            $nomor = 1;

                                            // Loop melalui setiap baris hasil query
                                            while ($row = mysqli_fetch_assoc($result)) {
                                                echo "<tr>";
                                                echo "<td class='text-center'>" . $nomor++ . "</td>";
                                                echo "<td class='text-center'>" . $row['tanggal'] . "</td>";
                                                echo "<td class='text-center'>" . $row['nama_gambar1'] . "</td>";
                                                echo "<td class='text-center'><img src='" . $row['gambar1'] . "' alt='Gambar 1' style='max-width: 100px;'></td>";
                                                echo "<td class='text-center'>" . $row['nama_gambar2'] . "</td>";
                                                echo "<td class='text-center'><img src='" . $row['gambar2'] . "' alt='Gambar 2' style='max-width: 100px;'></td>";
                                                echo "<td class='text-center'>" . $row['nama_gambar3'] . "</td>";
                                                echo "<td class='text-center'><img src='" . $row['gambar3'] . "' alt='Gambar 3' style='max-width: 100px;'></td>";
                                                echo "<td class='text-center'>" . $row['nama_gambar4'] . "</td>";
                                                echo "<td class='text-center'><img src='" . $row['gambar4'] . "' alt='Gambar 4' style='max-width: 100px;'></td>";
                                                echo "<td class='text-center'>
                                                <button class='btn btn-primary btn-sm' onclick='openEditModal(
                                                    \"" . $row['id_gambar'] . "\",
                                                    \"" . $row['tanggal'] . "\",
                                                    \"" . $row['nama_gambar1'] . "\",
                                                    \"" . $row['gambar1'] . "\",
                                                    \"" . $row['nama_gambar2'] . "\",
                                                    \"" . $row['gambar2'] . "\",
                                                    \"" . $row['nama_gambar3'] . "\",
                                                    \"" . $row['gambar3'] . "\",
                                                    \"" . $row['nama_gambar4'] . "\",
                                                    \"" . $row['gambar4'] . "\"
                                                )'>Edit</button>
                                            </td>";

                                                echo "<td class='text-center'>
                                                <button class='btn btn-danger btn-sm text-center' onclick='deleteGambar(\"" . $row['id_gambar'] . "\")'>Hapus</button>
                                            </td>";
                                                echo "</tr>";
                                            }
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
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script>
        const loding = document.querySelector('.loading');

        document.addEventListener('DOMContentLoaded', function() {
            document.getElementById('addgambarForm').addEventListener('submit', function(event) {
                event.preventDefault(); // Menghentikan aksi default form submit

                var form = this;
                var formData = new FormData(form);

                // Tampilkan elemen .loading sebelum mengirimkan permintaan AJAX
                loding.style.display = 'flex';

                var xhr = new XMLHttpRequest();
                xhr.open('POST', 'gambar_proses_simpan.php', true);
                xhr.onload = function() {
                    // Sembunyikan elemen .loading setelah permintaan AJAX selesai
                    loding.style.display = 'none';

                    if (xhr.status === 200) {
                        // Tangani respons dari gambar_proses_simpan.php di sini
                        var response = xhr.responseText;
                        if (response === 'success') {
                            swal("Berhasil!", "Data gambar berhasil ditambahkan", "success");
                            // Reset form setelah berhasil
                            form.reset();
                            // Sembunyikan preview gambar dan gambar setelah berhasil
                            document.getElementById('koverPreview1').style.display = 'none';
                            document.getElementById('koverPreview2').style.display = 'none';
                            document.getElementById('koverPreview3').style.display = 'none';
                            document.getElementById('koverPreview4').style.display = 'none';
                            // Tutup modal setelah berhasil
                            $('#exampleModal').modal('hide');
                            // Muat ulang tabel
                            loadTable();
                        } else if (response === 'data_tidak_lengkap') {
                            swal("Error", "Data yang anda masukan belum lengkap", "error");
                        } else {
                            swal("Error", "Gagal menambahkan data gambar", "error");
                        }
                    } else {
                        swal("Error", "Terjadi kesalahan saat mengirim data", "error");
                    }
                };
                xhr.send(formData);
            });
        });

        // logika untuk mengedit data info
        document.addEventListener('DOMContentLoaded', function() {
            document.getElementById('addEditGambarForm').addEventListener('submit', function(event) {
                event.preventDefault(); // Menghentikan aksi default form submit

                var form = this;
                var formData = new FormData(form);
                // Tampilkan elemen .loading sebelum mengirimkan permintaan AJAX
                loding.style.display = 'flex';

                var xhr = new XMLHttpRequest();
                xhr.open('POST', 'gambar_proses_edit.php', true);
                xhr.onload = function() {

                    // Sembunyikan elemen .loading setelah permintaan AJAX selesai
                    loding.style.display = 'none';

                    if (xhr.status === 200) {
                        // Tangani respons dari gambar_proses_edit.php di sini
                        var response = xhr.responseText;
                        if (response === 'success') {
                            swal("Suksess!", "Data gambar berhasil diedit", "success").then((value) => {
                                if (value) {
                                    location.reload(); // Refresh halaman setelah tombol "OK" diklik
                                }
                            });
                            // Reset form setelah berhasil
                            form.reset();
                            // Sembunyikan preview gambar setelah berhasil
                            document.getElementById('editkoverPreview1').style.display = 'none';
                            document.getElementById('editkoverPreview2').style.display = 'none';
                            document.getElementById('editkoverPreview3').style.display = 'none';
                            document.getElementById('editkoverPreview4').style.display = 'none';
                            // Tutup modal setelah berhasil
                            $('#editModal').modal('hide');
                        } else if (response === 'data_tidak_lengkap') {
                            swal("Error", "Data edit yang anda masukan belum lengkap", "error");
                        } else if (response === 'gambar_tidak_dipilih') {
                            swal("Error", "Mohon masukan gambar untuk semua input gambar", "error");
                        } else {
                            swal("Error", "Gagal mengedit data gambar", "error");
                        }
                    } else {
                        swal("Error", "Terjadi kesalahan saat mengirim data", "error");
                    }
                };
                xhr.send(formData);
            });
        });


        // logika untuk menghapus data video
        function deleteGambar(id) {
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

                        xhr.open('POST', 'gambar_proses_hapus.php', true);
                        xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
                        xhr.onload = function() {

                            // Sembunyikan elemen .loading setelah permintaan AJAX selesai
                            loding.style.display = 'none';

                            if (xhr.status === 200) {
                                var response = xhr.responseText;
                                if (response === 'success') {
                                    swal("Sukses!", "Data info berhasil dihapus.", "success")
                                        .then(() => {
                                            // Refresh halaman setelah penghapusan berhasil
                                            window.location.reload();
                                        });
                                } else {
                                    swal("Error", "Gagal menghapus data info.", "error");
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
                    document.getElementById('infoTable').innerHTML = xhrTable.responseText;
                }
            };
            xhrTable.open('GET', 'info_load_table.php', true);
            xhrTable.send();
        }
    </script>

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