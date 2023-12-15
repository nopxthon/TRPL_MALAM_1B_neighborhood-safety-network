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

?>

<?php
include '.././koneksi.php';

$no = 1;
$search_query = ""; // Inisialisasi string pencarian

if (isset($_GET['search'])) {
  $search = mysqli_real_escape_string($conn, $_GET['search']);
  $search_query = "AND (nama_masy LIKE '%$search%' OR nik LIKE '%$search%' OR username LIKE '%$search%' OR alamat LIKE '%$search%' OR jenis_kelamin LIKE '%$search%' OR no_telp LIKE '%$search%' OR tanggal_lahir LIKE '%$search%' OR umur LIKE '%$search%')";
}

$query = "SELECT * FROM masyarakat WHERE 1 $search_query";
$result = mysqli_query($conn, $query);
?>

<!DOCTYPE html>
<html>

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>JAGA - Admin</title>
  <link rel="shortcut icon" href="/jaga/foto/LOGO.png" type="image/x-icon"/>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
  <link rel="stylesheet" href="/jaga/admin/style-admin.css" />
  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
  <script src="https://kit.fontawesome.com/bc5c7901ab.js" crossorigin="anonymous"></script>
  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
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
        <div class="container-fluid">
          <div class="row  mt-5">
            <div class="col-2 offset-1">
              <a href="tambah_masy.php" class="btn btn-info mb-3"><i class="fa-solid fa-plus"></i></a>
            </div>
            <div class="col-6 offset-2 d-flex justify-content-end">
              <form method="get" action="index.php">
                <input style="padding-left: 20px;" class="search-input" type="text" name="search" id="search" placeholder=" Cari...">
                <button class="search-btn" type="submit"><i class="fa-solid fa-magnifying-glass"></i></button>
                <button style="background-color: #206357; cursor: pointer;height: 30px; color: white; width: 30px;border-radius: 20px; border: none;" href="#laporan"><i class="fa-solid fa-rotate-right"></i></button>
              </form>
            </div>
          </div>
          <div class="row">
            <div class="col-10 offset-1">
              <table class="table table-striped table-bordered text-center">
                <thead class="table-dark">
                  <tr>
                    <th scope="col">No</th>
                    <th scope="col">Nama</th>
                    <th scope="col">NIK</th>
                    <th scope="col">Username</th>
                    <th scope="col">Alamat</th>
                    <th scope="col">Jenis Kelamin</th>
                    <th scope="col">No Telp</th>
                    <th scope="col">Tanggal Lahir</th>
                    <th scope="col">Umur</th>
                    <th scope="col">Aksi</th>
                  </tr>
                </thead>
            </div>
          </div>
          <tbody>
            <?php
            $result = mysqli_query($conn, $query);
            while ($row = mysqli_fetch_assoc($result)) {
            ?>
              <tr>
                <td><?php echo $no++; ?></td>
                <td><?php echo $row["nama_masy"] ?></td>
                <td><?php echo $row["nik"] ?></td>
                <td><?php echo $row["username"] ?></td>
                <td><?php echo $row["alamat"] ?></td>
                <td><?php echo $row["jenis_kelamin"] ?></td>
                <td><?php echo $row["no_telp"] ?></td>
                <td><?php echo $row["tanggal_lahir"] ?></td>
                <td><?php echo $row["umur"] ?></td>
                <td>
                  <div><a class="col-2" href="edit_masy.php?id_user=<?php echo $row["id_user"] ?>" class="link-dark"><i class="fa-solid fa-pen-to-square fs-5"></i>Edit</a></div>
                  <div class="d-flex"><a class="text-danger" href="hapus_masy.php?id_user=<?php echo $row["id_user"] ?>" class="link-dark"><i class="fa-solid fa-trash fs-5"></i>Hapus</a></div>
                </td>
              </tr>
            <?php
            }
            ?>
          </tbody>
          </table>
        </div>

        <!-- Bootstrap -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>

</body>

</html>