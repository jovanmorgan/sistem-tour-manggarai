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
        TourMa | Admin Informasi
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
</head>

<body class="">
    <div class="wrapper">
        <div class="sidebar">
            <div class="sidebar-wrapper">
                <div class="logo">
                    <a href="javascript:void(0)" class="simple-text logo-mini">
                        <i class="fas fa-map-marker-alt" style="font-size: 29px;"></i>
                    </a>
                    <a href="javascript:void(0)" class="simple-text logo-normal position-relative" style="font-size: 26px; font-weight: bold; font-style: italic; right: 15px;">
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
                                                    <h5 class="title"><?php echo $admin['username']; ?></h5>
                                    </div>
                                    <b class="caret d-none d-lg-block d-xl-block"></b>
                                    <p class="d-lg-none">
                                        Log out
                                    </p>
                                </a>
                                <ul class="dropdown-menu dropdown-navbar">
                                    <li class="nav-link active"><a href="foto_profile" class="nav-item dropdown-item">Profile</a></li>
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

            <!-- End Navbar -->
            <div class="content">
                <div class="row">
                    <div class="col-md-4">
                        <div class="card card-user">
                            <div class="card-body">
                                <p class="card-text">
                                <div class="author">
                                    <div class="block block-one"></div>
                                    <div class="block block-two"></div>
                                    <div class="block block-three"></div>
                                    <div class="block block-four"></div>
                                    <a href="javascript:void(0)" onclick="document.getElementById('editFotoProfile').click()">
                                        <?php if (!empty($admin['foto_profile'])) : ?>
                                            <img class="avatar" src="data_fp/<?php echo $admin['foto_profile']; ?>" alt="...">
                                        <?php else : ?>
                                            <img class="avatar" src="../assets/img/anime3.png" alt="...">
                                        <?php endif; ?>
                                        <h5 class="title"><?php echo $admin['username']; ?></h5>
                                    </a>

                                    <!-- Input file tersembunyi untuk memilih gambar -->
                                    <input type="file" class="d-none" id="editFotoProfile" name="editFotoProfile" accept="image/*" onchange="previewAndUpdateProfile(this)">

                                    <!-- Modal untuk memilih gambar profile -->
                                    <div class="modal fade" id="editFotoProfileModal" tabindex="-1" role="dialog" aria-labelledby="editFotoProfileModalLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-lg" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="editFotoProfileModalLabel" style="font-size: 150%;">Edit Foto Profile</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close" onclick="location.reload();">
                                                        <span aria-hidden="true" style="font-size: 140%;">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="gambar">
                                                        <img id="editFotoProfilePreview" src="#" alt="Preview Foto Profile">
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal" onclick="location.reload();">Close</button>
                                                    <button type="button" class="btn btn-primary" id="btnSaveProfile">Save changes</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <p class="description">
                                        <?php echo $admin['email']; ?>
                                    </p>
                                </div>
                                </p>
                                <div class="card-description">
                                    <?php echo $admin['deskripsi']; ?>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-8">
                        <div class="card">
                            <div class="card-header">
                                <h5 class="title">Edit Profile</h5>
                            </div>
                            <div class="card-body">
                                <form id="editDataFp">
                                    <div class="row">
                                        <input type="hidden" class="form-control" name="id_admin" id="id_admin" value="<?php echo $admin['id_admin']; ?>">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label>Username</label>
                                                <input type="text" class="form-control" placeholder="Username" name="username" id="username" value="<?php echo $admin['username']; ?>">
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label>Email</label>
                                                <input type="email" class="form-control" placeholder="Email" name="email" id="email" value="<?php echo $admin['email']; ?>">
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label>Password</label>
                                                <input type="text" class="form-control" placeholder="Password" name="password" id="password" value="<?php echo $admin['password']; ?>">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-8">
                                            <div class="form-group">
                                                <label>Deskripsi</label>
                                                <textarea rows="4" cols="80" class="form-control" placeholder="Deskripsi" name="deskripsi" id="deskripsi"><?php echo $admin['deskripsi']; ?></textarea>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-footer d-flex justify-content-end">
                                        <button type="submit" class="btn btn-fill btn-primary" id="editDataFp">Save</button>
                                    </div>
                                </form>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
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

    <style>
        .loading {
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            display: none;
            /* Mula-mula, loading disembunyikan */
            justify-content: center;
            align-items: center;
            z-index: 9999;
            /* Menempatkan loading di atas elemen lain */
            height: 100vh;
            width: 100vw;
            background-color: rgba(255, 255, 255, 0.932);
            /* Menambahkan latar belakang semi transparan */
        }

        .circle {
            width: 20px;
            height: 20px;
            background-color: #41a506;
            border-radius: 50%;
            margin: 0 10px;
            animation: bounce 0.5s infinite alternate;
        }

        .circle:nth-child(2) {
            animation-delay: 0.2s;
        }

        .circle:nth-child(3) {
            animation-delay: 0.4s;
        }

        @keyframes bounce {
            from {
                transform: translateY(0);
            }

            to {
                transform: translateY(-20px);
            }
        }
    </style>

    <link href="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.12/cropper.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.12/cropper.min.js"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script>
        // Variabel global untuk menyimpan instance Cropper
        var cropper;

        const loding = document.querySelector('.loading');

        // Fungsi untuk menampilkan gambar yang dipilih dan menampilkan modal
        function previewAndUpdateProfile(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    $('#editFotoProfilePreview').attr('src', e.target.result);
                    $('#editFotoProfileModal').modal('show');
                }
                reader.readAsDataURL(input.files[0]);
            }
        }

        // Fungsi untuk memotong gambar dan menyimpannya
        function cropImage() {
            var croppedCanvas = cropper.getCroppedCanvas({
                width: 200, // Tentukan lebar gambar yang diinginkan
                height: 200 // Tentukan tinggi gambar yang diinginkan
            });
            var croppedDataUrl = croppedCanvas.toDataURL();

            // Tampilkan elemen .loading sebelum mengirimkan permintaan AJAX
            loding.style.display = 'flex';

            // Simpan data gambar ke server menggunakan AJAX
            $.ajax({
                type: 'POST',
                url: 'edit_fp.php',
                data: {
                    imageBase64: croppedDataUrl
                },
                success: function(response) {

                    // Sembunyikan elemen .loading setelah permintaan AJAX selesai
                    loding.style.display = 'none';

                    // Tampilkan sweet alert dengan pesan respon
                    swal("Sukses!", response, "success").then((value) => {
                        // Setelah pengguna menekan tombol "OK" pada SweetAlert, tampilkan alert
                        if (value) {
                            location.reload();
                        }
                    });
                },
                error: function(xhr, status, error) {
                    // Tampilkan sweet alert dengan pesan error
                    swal("Error!", xhr.responseText, "error");
                }
            });

            // Sembunyikan modal pemotongan gambar
            $('#editFotoProfileModal').modal('hide');
        }

        $(document).ready(function() {
            $('#editFotoProfileModal').on('shown.bs.modal', function() {
                // Inisialisasi Cropper setelah modal ditampilkan
                var containerWidth = $('.gambar').width();
                var containerHeight = $('.gambar').height();
                cropper = new Cropper($('#editFotoProfilePreview')[0], {
                    aspectRatio: 1, // 1:1 aspect ratio
                    viewMode: 1, // Crop mode
                    minContainerWidth: containerWidth, // Set minimum container width to match image container width
                    minContainerHeight: containerHeight, // Set minimum container height to match image container height
                });
            });

            $('#btnSaveProfile').on('click', function() {
                cropImage();
            });

            $('#editFotoProfileModal').on('hidden.bs.modal', function() {
                // Hapus cropper ketika modal ditutup
                if (cropper) {
                    cropper.destroy();
                }
            });
        });

        $(document).ready(function() {
            $('#editDataFp').on('submit', function(event) {
                event.preventDefault(); // Mencegah perilaku default form submit

                // Tangkap data formulir
                var formData = $('#editDataFp').serialize();
                // Kirim data formulir ke halaman proses_data_fp.php menggunakan AJAX

                // Tampilkan elemen .loading sebelum mengirimkan permintaan AJAX
                loding.style.display = 'flex';

                $.ajax({
                    type: 'POST',
                    url: 'proses_data_fp.php',
                    data: formData, // Kirim data formulir yang telah ditangkap
                    success: function(response) {

                        // Sembunyikan elemen .loading setelah permintaan AJAX selesai
                        loding.style.display = 'none';

                        // Tampilkan sweet alert dengan pesan respon
                        swal("Sukses!", response, "success").then((value) => {
                            // Jika pengguna menekan tombol "OK", lakukan sesuatu
                            if (value) {
                                location.reload(); // Muat ulang halaman
                            }
                        });
                    },
                    error: function(xhr, status, error) {
                        // Tampilkan sweet alert dengan pesan error
                        swal("Error!", xhr.responseText, "error");
                    }
                });
            });
        });
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