<?php

$server = "localhost";
$username = "root";
$password = "";
$database = "jagadb";

$conn = new mysqli($server, $username, $password, $database);

// Periksa koneksi
if ($conn->connect_error) {
  die("Koneksi gagal: " . $conn->connect_error);
}

$id_user = $_GET["id_user"];

if (isset($_POST["submit"])) {
  $nama_masy = $_POST["nama_masy"];
  $nik = $_POST["nik"];
  $username = $_POST["username"];
  $password = $_POST["password"];
  $alamat = $_POST["alamat"];
  $jenis_kelamin = $_POST["jenis_kelamin"];
  $no_telp = $_POST["no_telp"];
  $tanggal_lahir = $_POST["tanggal_lahir"];
  $umur = $_POST["umur"];

  $query = "UPDATE masyarakat SET nama_masy='$nama_masy', nik='$nik', username='$username', password='$password', alamat='$alamat', jenis_kelamin='$jenis_kelamin', no_telp='$no_telp', tanggal_lahir='$tanggal_lahir', umur='$umur'  WHERE id_user = $id_user";

  $result = mysqli_query($conn, $query);

  if ($result) {
    header("Location: index.php");
  } else {
    echo "Failed: " . mysqli_error($conn);
  }
}

?>




<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="shortcut icon" href="/jaga/foto/LOGO.png" type="image/x-icon"/>
  <!-- Bootstrap -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">

  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />

  <title>JAGA - Admin</title>
</head>

<body>
  <div class="container">

    <?php
    $query = "SELECT * FROM masyarakat WHERE id_user = $id_user";
    $result = mysqli_query($conn, $query);
    $row = mysqli_fetch_assoc($result);
    ?>

    <div class="container d-flex justify-content-center mt-5 mb-5">
      <div style="background-color: #F0F0F0; padding:50px; border-radius:10px; box-shadow: 0px 0px 12px rgba(0 ,0 ,0 , 0.5);">
        <form method="post" style="width:50vw; min-width:300px;">
          <div class="row mb-3">
            <div class="col">
              <label class="form-label">Nama</label>
              <input type="text" class="form-control" name="nama_masy" value="<?php echo $row['nama_masy'] ?>" required>
            </div>

            <div class="col">
              <label class="form-label">NIK</label>
              <input type="number" class="form-control" name="nik" value="<?php echo $row['nik'] ?>" required>
            </div>
          </div>

          <div class="mb-3">
            <label class="form-label">Nama Pengguna</label>
            <input type="text" class="form-control" name="username" value="<?php echo $row['username'] ?>" required>
          </div>

          <div class="mb-3">
            <label class="form-label">Kata Sandi</label>
            <input type="password" class="form-control" name="password" value="<?php echo $row['password'] ?>" required>
          </div>

          <div class="mb-3">
            <label class="form-label">Alamat</label>
            <input type="text" class="form-control" name="alamat" value="<?php echo $row['alamat'] ?>" required>
          </div>

          <div class="form-group mb-3">
            <label>Jenis Kelamin</label>
            &nbsp;
            <input type="radio" class="form-check-input" name="jenis_kelamin" id="Laki-laki" value="Laki-Laki" <?php echo ($row["jenis_kelamin"] == 'Laki-laki') ? "checked" : ""; ?>>
            <label for="Laki-laki" class="form-input-label">Laki-laki</label>
            &nbsp;
            <input type="radio" class="form-check-input" name="jenis_kelamin" id="Perempuan" value="Perempuan" <?php echo ($row["jenis_kelamin"] == 'Perempuan') ? "checked" : ""; ?>>
            <label for="Perempuan" class="form-input-label">Perempuan</label>
          </div>

          <div class="mb-3">
            <label class="form-label">No Telp</label>
            <input type="number" class="form-control" name="no_telp" value="<?php echo $row['no_telp'] ?>" required>
          </div>

          <div class="mb-3">
            <label class="form-label">Tanggal Lahir</label>
            <input type="date" class="form-control" name="tanggal_lahir" id="tanggal_lahir" value="<?php echo $row['tanggal_lahir'] ?>" required>
          </div>

          <div class="mb-3">
            <label class="form-label">Umur</label>
            <input type="number" class="form-control" name="umur" id="umur" value="<?php echo $row['umur'] ?>" readonly>
          </div>

          <div class="row mt-3 ms-1">
            <a href="index.php" class="col-2 me-4 btn btn-danger">Batal</a>
            <button type="submit" class="col-2 offset-7 btn btn-success" name="submit">Simpan</button>
          </div>
          <br>
        </form>
      </div>
    </div>
  </div>

  <script>
    document.addEventListener("DOMContentLoaded", function() {
      // Function to calculate age based on the birthdate
      function calculateAge() {
        var birthdate = document.getElementById("tanggal_lahir").value;
        var today = new Date();
        var birthdateDate = new Date(birthdate);
        var age = today.getFullYear() - birthdateDate.getFullYear();

        // Check if birthday has occurred this year
        if (
          today.getMonth() < birthdateDate.getMonth() ||
          (today.getMonth() === birthdateDate.getMonth() &&
            today.getDate() < birthdateDate.getDate())
        ) {
          age--;
        }

        document.getElementById("umur").value = age;
      }

      // Add an event listener to the date input to trigger the age calculation
      document.getElementById("tanggal_lahir").addEventListener("input", calculateAge);

      // Calculate age on page load
      calculateAge();
    });
  </script>

  <!-- Bootstrap JS and Popper.js -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>

  <!-- Bootstrap -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>

</body>

</html>