<?php
session_start();


$server = "localhost";
$username = "root";
$password = "";
$database = "jagadb";

$conn = new mysqli($server, $username, $password, $database);

// Periksa koneksi
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

if (!isset($_SESSION["user"]) || !isset($_SESSION["userType"])) {
    header("location: /jaga/logout.php");
    exit;
}

if ($_SESSION["userType"] !== 'admin') {
    // Redirect ke halaman yang sesuai dengan hak akses pengguna
    switch ($_SESSION["userType"]) {
        case 'admin':
            header("Location: /jaga/masyarakat/masyarakat.php?username=" . $_SESSION["user"]);
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
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>JAGA - Admin</title>
    <link rel="shortcut icon" href="/jaga/foto/LOGO.png" type="image/x-icon"/>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="/jaga/admin/style-admin.css" />
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
                        <li><a href="index0.php">Rekapan Laporan</a></li>
                        <li><a href="index.php">Masyarakat</a></li>
                        <li><a href="index2.php">Tim Keamanan</a></li>
                    </ul>
                    <div class="profile">
                        <div class="menu-profile" onclick="toggleMenu()">
                            <div class="user-profile"><i class="fa-solid fa-user"></i></div>
                            <div class="user-menu" id="subMenu">
                                <div class="sub-menu">
                                    <div class="sub-profile-menu">
                                        <h4 style="color: white;">Profil Admin</h4>
                                    </div>
                                    <hr style="width: 40%; margin-top:-5px">
                                    <div class="sub-nama-menu">
                                        <p><i class="fa-solid fa-user" style="margin-right: 24px; margin-left:1px;"></i><?php echo ucfirst($_SESSION['nama_admin']); ?></p>
                                    </div>
                                    <div class="sub-nik-menu">
                                        <p><i class="fa-solid fa-id-card" style="margin-right: 20px;"></i><?php echo ucfirst($_SESSION['nik']); ?></p>
                                    </div>
                                    <br>
                                    <hr>
                                    <div class="sub-logout-menu">
                                        <a href="/jaga/logout.php">
                                            <h5>Keluar</h5>
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

                <div class="container">
                    <div class="row mt-5">
                        <div class="col-2">
                            <div class="section"></div>
                            <a class="btn btn-info mb-3" href="cetak.php"><span style="font-size: 25px;"><i class="fa-solid fa-print"></i></span></a>
                        </div>


                        <div class="col-6 offset-4 d-flex justify-content-end">
                            <form method="get" action="index0.php">
                                <input style="padding-left: 20px;" class="search-input" type="text" name="search" id="search" placeholder=" Cari...">
                                <button class="search-btn" type="submit"><i class="fa-solid fa-magnifying-glass"></i></button>
                                <button style="background-color: #206357; cursor: pointer;height: 30px; color: white; width: 30px;border-radius: 20px; border: none;" href="#laporan"><i class="fa-solid fa-rotate-right"></i></button>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-10 offset-1">
                            <table class="table table-striped table-bordered text-center">
                                <thead class="table-dark">
                                    <tr>
                                        <th>No</th>
                                        <th>NIK Pelapor</th>
                                        <th>Nama Pelapor</th>
                                        <th>Jenis Laporan</th>
                                        <th>Deskripsi Laporan</th>
                                        <th>Lokasi Laporan</th>
                                        <th>Tanggal Kirim Laporan</th>
                                        <th>Status Akhir Laporan</th>
                                        <th>Dokumentasi</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>

                                    <?php
                                    $no = 1;

                                    // Check if a search query is provided
                                    if (isset($_GET['search'])) {
                                        $search = mysqli_real_escape_string($conn, $_GET['search']);
                                        $search_query = "AND (nik LIKE '%$search%' OR nama_masy LIKE '%$search%' OR jenis_laporan LIKE '%$search%' OR deskripsi_laporan LIKE '%$search%' OR detail_lokasi LIKE '%$search%' OR tanggal_kirim LIKE '%$search%' OR status_tindaklanjut LIKE '%$search%')";
                                    } else {
                                        $search_query = ""; // Empty string if no search query
                                    }

                                    $query = mysqli_query($conn, "SELECT * FROM laporan 
                                INNER JOIN masyarakat ON laporan.id_user = masyarakat.id_user 
                                WHERE status_tindaklanjut IN ('Tidak di proses', 'Sudah di proses') $search_query
                                ORDER BY tanggal_kirim DESC");

                                    while ($r = mysqli_fetch_assoc($query)) { ?>
                                        <tr>
                                            <td><?php echo $no++; ?></td>
                                            <td><?php echo $r['nik']; ?></td>
                                            <td><?php echo $r['nama_masy']; ?></td>
                                            <td><?php echo $r['jenis_laporan']; ?></td>
                                            <td><?php echo $r['deskripsi_laporan']; ?></td>
                                            <td><?php echo $r['detail_lokasi']; ?></td>
                                            <td><?php echo $r['tanggal_kirim']; ?></td>
                                            <td><?php echo $r['status_tindaklanjut']; ?></td>
                                            <td><?php
                                                $dokumentasi = $r['dokumentasi'];
                                                if (!empty($dokumentasi)) {
                                                    echo '<img src="/jaga/masyarakat/' . $dokumentasi . '" alt="Dokumentasi" style="max-width: 100px; max-height: 100px;">';
                                                } else {
                                                    echo 'Tidak Ada Foto';
                                                }
                                                ?></td>
                                            <td>
                                                <a class="text-danger" href="hapus_data.php?id_laporan=<?php echo $r["id_laporan"] ?>" class="link-dark"><i class="fa-solid fa-trash fs-5"></i>Hapus</a>
                                            </td>
                                        </tr>
                                    <?php  }
                                    ?>

                                </tbody>
                            </table>