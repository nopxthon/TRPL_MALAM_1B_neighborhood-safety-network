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

$id_keamanan = $_GET["id_keamanan"];

if (isset($_POST["submit"])) {
  $nama_keamanan = $_POST["nama_keamanan"];
  $nik = $_POST["nik"];
  $username = $_POST["username"];
  $password = $_POST["password"];

  $query = "UPDATE tim_keamanan SET nama_keamanan='$nama_keamanan', nik='$nik', username='$username', password='$password' WHERE id_keamanan = $id_keamanan";

  $result = mysqli_query($conn, $query);

  if ($result) {
    header("Location: index2.php");
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

  <!-- Bootstrap -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">

  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />

  <title>PHP CRUD Application</title>
</head>

<body>

  <div class="container">
    <div class="container d-flex justify-content-center mt-5 mb-5">
      <div style="background-color: #F0F0F0; padding:50px; border-radius:10px; box-shadow: 0px 0px 12px rgba(0 ,0 ,0 , 0.5);">

        <?php
        $query = "SELECT * FROM tim_keamanan WHERE id_keamanan = $id_keamanan";
        $result = mysqli_query($conn, $query);
        $row = mysqli_fetch_assoc($result);
        ?>

        <div class="container d-flex justify-content-center">
          <form method="post" style="width:50vw; min-width:300px;">
            <div class="row mb-3">
              <div class="col">
                <label class="form-label">Nama</label>
                <input type="text" class="form-control" name="nama_keamanan" value="<?php echo $row['nama_keamanan'] ?>" required>
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

            <div class="row mt-3 ms-1">
              <a href="index2.php" class="col-2 me-4 btn btn-danger">Batal</a>
              <button type="submit" class="col-2 offset-7 btn btn-success" name="submit">Simpan</button>
            </div>
            <br>
          </form>
        </div>
      </div>

      <!-- Bootstrap JS and Popper.js -->
      <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>

      <!-- Bootstrap -->
      <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>

</body>

</html>