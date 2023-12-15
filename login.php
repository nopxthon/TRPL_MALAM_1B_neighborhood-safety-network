<?php
session_start();

include 'koneksi.php';

// Fungsi untuk melakukan login
function login($username, $password) {
    $conn = connectDB();

    // Hindari SQL Injection
    $username = $conn->real_escape_string($username);
    $password = $conn->real_escape_string($password);

    // Enkripsi password dengan MD5
    // $password = md5($password);

    // Tentukan tabel login berdasarkan username
    $tables = ['admin', 'masyarakat', 'tim_keamanan'];

    foreach ($tables as $table) {
        $query = "SELECT * FROM $table WHERE username='$username' AND password='$password'";
        $result = $conn->query($query);

        if ($result->num_rows == 1) {
          $row = $result->fetch_assoc();

            // Login berhasil
            $_SESSION['user'] = $username;
            $_SESSION['userType'] = $table;

              // Set Cookies
              setcookie('username', $username, time() + (86400 * 30), "/"); //86400 1 hari
              setcookie('userType', $table, time() + (86400 * 30), "/");

              switch ($table) {
                case 'admin':
                    $_SESSION['id_admin'] = $row['id_admin'];
                    $_SESSION['nama_admin'] = $row['nama_admin'];
                    $_SESSION['nik'] = $row['nik'];
                    header("Location: admin/index.php");
                    break;
                case 'masyarakat':
                    $_SESSION['id_user'] = $row['id_user'];
                    $_SESSION['nama_masy'] = $row['nama_masy'];
                    $_SESSION['nik'] = $row['nik'];
                    $_SESSION['tanggal_lahir'] = $row['tanggal_lahir'];
                    $_SESSION['alamat'] = $row['alamat'];
                    $_SESSION['jenis_kelamin'] = $row['jenis_kelamin'];
                    $_SESSION['no_telp'] = $row['no_telp'];
                    header("Location: masyarakat/beranda.php");
                    break;
                case 'tim_keamanan':
                    $_SESSION['id_keamanan'] = $row['id_keamanan'];
                    $_SESSION['nama_keamanan'] = $row['nama_keamanan'];
                    $_SESSION['nik'] = $row['nik']; 
                    header("Location: tim_keamanan/tim_keamanan.php");
                    break;
                default:
                    // Tambahkan penanganan kesalahan jika diperlukan
                    break;
            }
            exit();
        }
    }

    // Jika tidak ada kesesuaian, login gagal
    echo '<script>alert("Gagal Masuk. Periksa Kembali Nama Pengguna dan Kata Sandi Anda");</script>';

    $conn->close();
}


if ( isset($_POST['login']) ) {
    $username = $_POST["username"];
    $password = $_POST["password"];


    login($username, $password);
}
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <link rel="stylesheet" href="style-login.css" />
    <link rel="stylesheet" href="css/bootstrap-grid.min.css" />
    <link rel="shortcut icon" href="foto/LOGO.png" type="image/x-icon" />
    <title>JAGA - Masuk</title>
  </head>
  <body>
    <section>
      <div>
        <div class="container">
          <div class="row">
            <div class="col-md-10 offset-1 py-5">
              <br><br>
                <div class="form-box">
                  <img src="foto/LOGO-JAGA.png">
                    <div class="form-value">
                      <form action="" method="post" > 
                      <div class="inputbox">
                        <ion-icon name="person-outline"></ion-icon>
                        <input type="text" name="username" required />
                        <label for=""><b>Nama Pengguna</b></label>
                      </div>
                      <div class="inputbox">
                        <ion-icon name="lock-closed-outline"></ion-icon>
                        <input type="password" name="password" required />
                        <label for=""><b>Kata Sandi</b></label>
                      </div>
                      <button name="login" type="submit">MASUK</button>
                    </form>

                    <?php
            
            if (isset($_SESSION["user"], $_SESSION["userType"])) {
               
                switch ($_SESSION["userType"]) {
                    case 'admin':
                        header("Location: admin/index.php?username=" . $_SESSION["user"]);
                        break;
                    case 'relawan':
                        header("Location: masyarakat/masyarakat.php?username=" . $_SESSION["user"]);
                        break;
                    case 'organisasi':
                        header("Location: tim_keamanan/tim_keamanan.php?username=" . $_SESSION["user"]);
                        break;
                    default:
                        
                        break;
                }
                exit();
            }
            ?>

                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
    <script
      type="module"
      src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"
    ></script>
    <script
      nomodule
      src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"
    ></script>
  </body>
</html>
