<?php
session_start();

include '.././koneksi.php';

if (!isset($_SESSION["user"]) || !isset($_SESSION["userType"])) {
    header("location: /jaga/login.php");
    exit;
}

if ($_SESSION["userType"] !== 'masyarakat') {
    // Redirect ke halaman yang sesuai dengan hak akses pengguna
    switch ($_SESSION["userType"]) {
        case 'admin':
            header("Location: /jaga/admin/admin.php?username=" . $_SESSION["user"]);
            break;
        case 'organisasi':
            header("Location: /jaga/tim_keamanan/tim_keamanan.php?username=" . $_SESSION["user"]);
            break;
        default:
            header("Location: /jaga/login.php");
            break;
    }
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>JAGA</title>
    <link rel="stylesheet" href="/jaga/css/bootstrap-grid.min.css" />
    <link rel="shortcut icon" href="/jaga/foto/LOGO.png" type="image/x-icon"/>
    <!-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.2/font/bootstrap-icons.min.css"> -->
    <link rel="stylesheet" href="/jaga/masyarakat/style-home.css" />
    <script src="/jaga/js/bootstrap.bundle.min.js" integrity="sha384-pzjw8H+0aNCIn1w4/4RM79XEOGQl47c4sDO/MEbqmbek5B+6EAg1PTXBRQDbh8Rw" crossorigin="anonymous"></script>
    <script src="https://kit.fontawesome.com/bc5c7901ab.js" crossorigin="anonymous"></script>
</head>

<body>
    <div class="container-custom">
        <div>
            <!--Bar Navigasi-->
            <nav class="header1">
                <img class="LOGO1" src="/jaga/foto/LOGO-JAGA.png" />
                <ul class="nav1">
                    <li><a href="#pengingat">Pengingat Lingkungan</a></li>
                    <li><a href="#laporan">Laporan Masyarakat</a></li>
                    <li><a href="#tentangkami">Tentang Kami</a></li>
                </ul>
                <div class="nav2">
                    <ul class="lapor-btn">
                        <li><a href="form-lapor.php">LAPOR</a></li>
                    </ul>
                </div>

                <div class="menu-profile" onclick="toggleMenu()">
                    <div class="user-profile"><i class="fa-solid fa-user"></i></div>
                    <div class="user-menu" id="subMenu">
                        <div class="sub-menu">
                            <div class="sub-profile-menu">
                                <h3>Profil Masyarakat</h3>
                            </div>
                            <hr style="width: 55%;">
                            <div class="sub-nama-menu">
                                <p><i class="fa-solid fa-user" style="margin-right: 19px; margin-left:1px;"></i><?php echo ucfirst($_SESSION['nama_masy']); ?></p>
                            </div>
                            <div class="sub-nik-menu">
                                <p><i class="fa-solid fa-id-card" style="margin-right: 15px;"></i><?php echo ucfirst($_SESSION['nik']); ?></p>
                            </div>
                            <div class="sub-alamat-menu">
                                <p><i class="fa-solid fa-location-dot" style="margin-right: 21px; margin-left:1px;"></i><?php echo ucfirst($_SESSION['alamat']); ?></p>
                            </div>
                            <div class="sub-kelamin-menu">
                                <p><i class="fa-solid fa-venus-mars" style="margin-right: 14px; margin-left:1px;"></i><?php echo ucfirst($_SESSION['jenis_kelamin']); ?></p>
                            </div>
                            <div class="sub-telp-menu">
                                <p><i class="fa-solid fa-phone" style="margin-right: 14px; margin-left:4px;"></i><?php echo ucfirst($_SESSION['no_telp']); ?></p>
                            </div>
                            <hr style="width: 90%;">
                            <div class="sub-logout-menu">
                                <a href="/jaga/logout.php">
                                    <h3>Keluar</h3>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </nav>

            <script>
                // dropmenu
                let subMenu = document.getElementById("subMenu");

                function toggleMenu() {
                    subMenu.classList.toggle("open-menu");
                }
            </script>

            <!--content-->
            <!--pengingat lingkungan-->
            <section class="img-wrapper" id="pengingat">
                <div class="slides">
                    <span id="slide-1"></span>
                    <span id="slide-2"></span>
                    <span id="slide-3"></span>

                    <div class="slider">
                        <img id="slide-1" src="/jaga/foto/foto1.jpg" alt="">
                        <img id="slide-2" src="/jaga/foto/foto2.jpg" alt="">
                        <img id="slide-3" src="/jaga/foto/foto3.jpg" alt="">
                    </div>
                </div>

                <div class="nav-slider">
                    <a href="#slide-1">1</a>
                    <a href="#slide-2">2</a>
                    <a href="#slide-3">3</a>
                </div>
            </section>

            <!--display laporan-->
            <section id="cari">
                <div class="bg-lapor">
                    <div class="container">
                        <div class="row mt-5">
                            <div class="col-6 offset-3 mt-5" id="laporan">
                                <h2 class="laporan-title d-flex justify-content-center">Laporan Masyarakat</h2>
                            </div>

                            <!-- search content -->
                            <div class="row mt-5 mb-4">
                                <div method="get" action="beranda.php" class="col-3 offset-1 d-flex">
                                    <!-- Tambahkan button BLOK A -->
                                    <a href="?search=BLOK A" class="search-blok me-5 d-flex align-items-center d-flex justify-content-center">BLOK A</a>
                                    <!-- Tambahkan button BLOK B -->
                                    <a href="?search=BLOK B" class="search-blok d-flex align-items-center d-flex justify-content-center">BLOK B</a>
                                </div>
                                <div class="col-4 offset-3 d-flex justify-content-end">
                                    <form method="get" action="beranda.php">
                                        <input style="padding-left: 20px;" class="search-input" type="text" name="search" id="search" placeholder=" Cari...">
                                        <button class="search-btn" type="submit"><i class="fa-solid fa-magnifying-glass"></i></button>
                                        <button style="background-color: #206357; cursor: pointer;height: 30px; color: white; width: 30px;border-radius: 20px; border: none;" href="#laporan"><i class="fa-solid fa-rotate-right"></i></button>
                                    </form>
                                </div>
                                <div class="col-10 offset-1 mt-3 laporan-display">

                                    <!--Laporan Masyarakat-->
                                    <?php
                                    // $nama_masy = $_SESSION["user"];

                                    // Ambil nilai pencarian dari parameter URL
                                    $search = isset($_GET['search']) ? $_GET['search'] : '';

                                    /// Query untuk mengambil data laporan dari database sesuai pelapor
                                    $query = "SELECT * FROM laporan INNER JOIN masyarakat ON laporan.id_user = masyarakat.id_user";

                                    // Tambahkan kondisi pencarian jika ada kata kunci pencarian
                                    if (!empty($search)) {
                                        $search = $conn->real_escape_string($search);
                                        // Query yang berfungsi untuk mencari laporan dengan ciri khas tertentu
                                        if ($search === 'BLOK A' || $search === 'BLOK B') {
                                            $query .= " WHERE detail_lokasi LIKE '%$search%'";
                                        } else {
                                            $query .= " WHERE (nama_masy LIKE '%$search%' OR jenis_laporan LIKE '%$search%' OR deskripsi_laporan LIKE '%$search%' OR tanggal_kirim LIKE '%$search%' OR status_tindaklanjut LIKE '%$search%')";
                                        }

                                        echo '<script>window.location.href = "#cari";</script>';
                                    }
                                    // Query yang berfungsi untuk menempatkan laporan terbaru menjadi paling atas
                                    $query .= " ORDER BY tanggal_kirim DESC";

                                    $result = $conn->query($query);

                                    // Periksa apakah query berhasil dijalankan
                                    if ($result) {
                                        // Tampilkan konten HTML
                                        while ($row = $result->fetch_assoc()) {
                                            $id_laporan = $row['id_laporan'];
                                            $jenis_laporan = $row['jenis_laporan'];
                                            $deskripsi_laporan = $row['deskripsi_laporan'];
                                            $detail_lokasi = $row['detail_lokasi'];
                                            $dokumentasi = $row['dokumentasi'];
                                            $tanggal_kirim = $row['tanggal_kirim'];
                                            $status_tindaklanjut = $row['status_tindaklanjut'];
                                            // $id_user = $row['id_user'];
                                            $nama_masy = $row['nama_masy'];

                                            // Berikut adalah tampilan tabel laporan pada laman beranda
                                            echo '<div class="row">
                                                <div class="card col-12 mb-5">
                                                <div class="row p-2">
                                                    <div class="info-laporan col-8">
                                                    <div class="row">
                                                        <div class="col-6 mt-2">
                                                        <p class="nama-pelapor"><span style="color: #454545; font-size: 17px">Pelapor : </span>' . $nama_masy . '</p>
                                                        <p class="lokasi"><span style="color: #454545; font-size: 17px">Lokasi : </span>' . $detail_lokasi . '</p>
                                                        </div>
                                                        <div class="col-6 mt-2">
                                                        <p class="jenis"><span style="color: #454545; font-size: 17px">Jenis Laporan : </span>' . $jenis_laporan . '</p>
                                                        <p class="status"><span style="color: #454545; font-size: 17px">Status : </span>' . $status_tindaklanjut . '</p>
                                                        <p class="tanggal"><span style="color: #454545; font-size: 17px">Tanggal Kirim : </span>' . $tanggal_kirim . '</p>
                                                        </div>
                                                        <div class="col-12">
                                                        <p style="font-size: 90%;">Isi Laporan : </p>
                                                        <div class="deskripsi-laporan p-2">
                                                        <p id="activity">' . $deskripsi_laporan . '</p>   
                                                                </div>
                                                            </div>
                                                            </div>
                                                            </div>
                                                            <div class="lapor-foto col-4">
                                                                <img src="/jaga/masyarakat/' . $dokumentasi . ' "class="card-img" alt="Tidak Ada Foto" oninput="updateCardContent(this, \'imageAlt\')">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>';
                                        }

                                        // Bebaskan hasil query
                                        $result->free_result();
                                    } else {
                                        // Tampilkan pesan jika query gagal
                                        echo "Error: " . $query . "<br>" . $conn->error;
                                    }

                                    // Tutup koneksi ke database
                                    $conn->close();
                                    ?>
                                    <!-- </br>
                            </div> -->
                                    <!-- <style>
                                body {
                                    background: radial-gradient(#d61212, #332042);
                                    background-size: cover;
                                    /* Adjust the size to cover the entire background */
                                    background-position: center;
                                    /* Center the background image */
                                    background-repeat: no-repeat;
                                    /* Prevent the background image from repeating */
                                }
                            </style> -->
                                    <!-- Add your content here, such as cards or a list of activities -->
                                    <!-- <div class="row">
                                <div class="col-md-5"> -->
                                    <!-- Your content goes here -->
                                    <!-- </div>
                                <div class="col-md-5"> -->
                                    <!-- Your content goes here -->
                                    <!-- </div>
                                <div class="col-md-5"> -->
                                    <!-- Your content goes here -->
                                    <!-- </div>
                            </div>
                        </div> -->
                                    <!-- Add this script to your page -->
                                    <!-- <script>
                            function updateCardContent(element, property) {
                                // Retrieve the edited content and update the corresponding property
                                const content = element.innerText;
                                const card = element.closest('.row');

                                switch (property) {
                                    case 'name':
                                        card.querySelector('.row-nama-pelapor').innerText = content;
                                        break;
                                    case 'location':
                                        card.querySelector('.card-text i.bi-geo-alt-fill + span').innerText = content;
                                        break;
                                    case 'title':
                                        card.querySelector('.card-title').innerText = content;
                                        break;
                                    case 'statue':
                                        card.querySelector('.card-text + span').innerText = content;
                                        break;
                                    case 'date':
                                        card.querySelector('.card-text i.bi-calendar-date-fill + span').innerText = content;
                                        break;
                                    case 'description':
                                        card.querySelector('.row-deskripsi-laporan').innerText = content;
                                        break;
                                    case 'imageAlt':
                                        card.querySelector('.card-img').alt = content;
                                        break;
                                        // Add more cases for other editable content
                                }
                            }


                            function completeActivity(id_laporan) {
                                // Menggunakan AJAX untuk mengirim permintaan ke server
                                const xhr = new XMLHttpRequest();
                                xhr.open('POST', 'complete_activity.php', true);
                                xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
                                xhr.onload = function() {
                                    if (xhr.status === 200) {
                                        // Handle response
                                        console.log('Activity marked as completed.');

                                        // Redirect ke laporan.php atau halaman berikutnya
                                        window.location.href = 'beranda.php?id_laporan=' + id_laporan;
                                    } else {
                                        console.error('Failed to complete activity.');
                                    }
                                };

                                // Perlu menambahkan ini untuk mengirim data dengan metode POST
                                xhr.send('id_laporan=' + id_laporan);
                            }
                        </script> -->
                                </div>
                            </div>
            </section>
            <!--Footer-->
            <footer id="tentangkami">
                <div>
                    <h4 style="font-family: 'poppins-semibold'">Tentang Kami</h4>
                    <center>
                        <div class="col-8" style="font-size: 15px; font-family: 'poppins-medium'"">
              JAGA adalah aplikasi yang digunakan untuk meningkatkan kesadaran
              akan keamanan lingkungan dan mengantisipasi diri dari kejahatan
              dengan batasan yang berlaku.
            </div>
          </center>
          <br/>
          <p>&copy; 2023 JAGA</p>
        </div>
      </footer>
    </div>
    </div>
  </body>
</html>