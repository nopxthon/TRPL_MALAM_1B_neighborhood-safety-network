<?php
session_start();

include '.././koneksi.php';

if (!isset($_SESSION["user"]) || !isset($_SESSION["userType"])) {
    header("location: /jaga-master/login.php");
    exit;
}

if ($_SESSION["userType"] !== 'tim_keamanan') {
    // Redirect ke halaman yang sesuai dengan hak akses pengguna
    switch ($_SESSION["userType"]) {
        case 'masyarakat':
            header("Location: /jaga/masyarakat/masyarakat.php?username=" . $_SESSION["user"]);
            break;
        case 'admin':
            header("Location: /jaga/admin/admin.php?username=" . $_SESSION["user"]);
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
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>JAGA - Keamanan</title>
    <link rel="stylesheet" href="/jaga/css/bootstrap-grid.min.css" />
    <link rel="shortcut icon" href="/jaga/foto/LOGO.png" type="image/x-icon" />
    <link rel="stylesheet" href="/jaga/tim_keamanan/style-keamanan.css"/>
    <script src="/jaga/js/bootstrap.bundle.min.js" integrity="sha384-pzjw8H+0aNCIn1w4/4RM79XEOGQl47c4sDO/MEbqmbek5B+6EAg1PTXBRQDbh8Rw" crossorigin="anonymous"></script>
    <script src="https://kit.fontawesome.com/bc5c7901ab.js" crossorigin="anonymous"></script>

</head>

<body>
    <section>
        <div class="container-custom">
            <div>
                <!--Bar Navigasi-->
                <nav class="header1">
                    <img class="LOGO1" src="/jaga/foto/LOGO-JAGA.png" />
                    <ul class="nav1">
                        <li><a href="#laporan">Laporan Masyarakat</a></li>
                    </ul>
                    <div class="profile">
                        <div class="menu-profile" onclick="toggleMenu()">
                            <div class="user-profile"><i class="fa-solid fa-user"></i></div>
                            <div class="user-menu" id="subMenu">
                                <div class="sub-menu">
                                    <div class="sub-profile-menu">
                                        <h3>Profil Keamanan</h3>
                                    </div>
                                    <hr style="width: 49%;">
                                    <div class="sub-nama-menu">
                                        <p><i class="fa-solid fa-user" style="margin-right: 19px; margin-left:1px;"></i><?php echo ucfirst($_SESSION['nama_keamanan']); ?></p>
                                    </div>
                                    <div class="sub-nik-menu">
                                        <p><i class="fa-solid fa-id-card" style="margin-right: 15px;"></i><?php echo ucfirst($_SESSION['nik']); ?></p>
                                    </div>
                                    <br>
                                    <br>
                                    <hr style="width: 90%;">
                                    <div class="sub-logout-menu">
                                        <a href="/jaga/login.php">
                                            <h3>Keluar</h3>
                                        </a>
                                    </div>
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

                <section id="cari">
                    <div class="container">
                        <div class="row mt-5">
                            <div class="col-12">
                                <div class="row">
                                <div method="get" action="tim_keamanan.php" class="col-6 d-flex">
                                    <!-- Tambahkan button BLOK A -->
                                    <a href="?search=Ringan" class="search-blok1 me-5 d-flex align-items-center d-flex justify-content-center">Ringan</a>
                                    <!-- Tambahkan button BLOK B -->
                                    <a href="?search=Darurat" class="search-blok2 d-flex align-items-center d-flex justify-content-center">Darurat</a>
                                </div>
                                <div class="col-6 d-flex justify-content-end">
                                <form method="get" action="tim_keamanan.php">
                                    <input style="padding-left: 20px;"  class="search-input" type="text" name="search" id="search" placeholder=" Cari...">
                                    <button class="search-btn me-4" type="submit"><i class="fa-solid fa-magnifying-glass"></i></button>
                                    <button class="reset-btn" href="#laporan"><i class="fa-solid fa-rotate-right"></i></button>
                                </form>
                                </div>
                                </div>
                            </div>

                            <!-- laporan -->
                            <div class="col-12 mt-3 laporan-display">
                                <?php
                                // $nama_masy = $_SESSION["user"];
                                // Form Handling
                                if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit'])) {
                                    // Check if the 'id_laporan' key is set in the $_POST array
                                    $id_laporan_update = isset($_POST['id_laporan']) ? $_POST['id_laporan'] : '';

                                    // Proceed only if 'id_laporan' is set
                                    if ($id_laporan_update) {
                                        $status_baru = $conn->real_escape_string($_POST['status_tindaklanjut']); // Ambil status baru dari dropdown

                                        // Update status di database
                                        $update_query = "UPDATE laporan SET status_tindaklanjut = '$status_baru' WHERE id_laporan = '$id_laporan_update'";
                                        $update_result = $conn->query($update_query);

                                        if ($update_result) {
                                            // Berhasil memperbarui status
                                            echo '';
                                        }
                                    }
                                }

                                // Ambil nilai pencarian dari parameter URL
                                $search = isset($_GET['search']) ? $_GET['search'] : '';

                                /// Query untuk mengambil data laporan dari database sesuai pelapor
                                $query = "SELECT * FROM laporan INNER JOIN masyarakat ON laporan.id_user = masyarakat.id_user";

                                // Tambahkan kondisi pencarian jika ada kata kunci pencarian
                                if (!empty($search)) {
                                    $search = $conn->real_escape_string($search);
                                    // Query yang berfungsi untuk mencari laporan dengan ciri khas tertentu
                                    if ($search === 'Ringan' || $search === 'Darurat') {
                                        $query .= " WHERE jenis_laporan LIKE '%$search%'";
                                    } else {
                                        $query .= " WHERE (nama_masy LIKE '%$search%' OR detail_lokasi LIKE '%$search%' OR deskripsi_laporan LIKE '%$search%' OR tanggal_kirim LIKE '%$search%' OR status_tindaklanjut LIKE '%$search%')";
                                    }

                                    echo '<script>window.location.href = "#cari";</script>';
                                }
                                // Query yang berfungsi untuk menempatkan laporan terbaru menjadi paling atas
                                $query .= " ORDER BY FIELD(status_tindaklanjut, 'Sudah di proses', 'Tidak di proses'), tanggal_kirim DESC";

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
                                        <div class="card col-8 mb-5">
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
                                    <div class="col-3 ms-5 mt-4 label-status-laporan">
                                        <h3>Ubah Status Laporan</h3>
                                        <form method="post" id="status1">
                                            <input type="hidden" name="id_laporan" value="' . $id_laporan . '">
                                            <select class="option_status" name="status_tindaklanjut" id="ubah_status">
                                                <option value="">Pilih status</option>
                                                <option value="Sudah di proses">Sudah di proses</option>
                                                <option value="Tidak di proses">Tidak di proses</option>
                                            </select>
                                            <button style="width: 40%; height:30px; margin-left: 30px; cursor:pointer" id="submit-button" name="submit" onclick="cek_data(); return false;">Selesai</button>
                                        </form>
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
                            </div>
                        </div>
                    </div>
                </section>
                <script>
                    function cek_data(event) {
                        var selectedValue = document.getElementById('ubah_status').value;

                        if (selectedValue == '') {
                            alert('Silakan Ubah Status Laporan');
                            document.getElementById('ubah_status').focus();
                            event.preventDefault(); // Mencegah formulir untuk disubmit
                            return false;
                        }

                        alert('Laporan Selesai');

                        // Mengatur kembali opsi setelah formulir dikirim
                        document.getElementById('ubah_status').value = selectedValue;

                        // Menyembunyikan tombol submit setelah formulir dikirim
                        document.getElementById('submit-button').style.display = 'none';

                        document.getElementById('ubah_status').style.display = 'none';

                        // Mengirim formulir jika status telah dipilih
                        document.getElementById('status1').submit();
                    }
                </script>
                <br>
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
</section>
</body>