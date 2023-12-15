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

<?php



if ($_SERVER["REQUEST_METHOD"] === "POST") {
  date_default_timezone_set('Asia/Jakarta');

  $id_user = $_SESSION["id_user"];
  $id_laporan = isset($_POST["id_laporan"]) ? $_POST["id_laporan"] : '';
  $jenis_laporan = $_POST["jenis_laporan"];
  $deskripsi_laporan = $_POST["deskripsi_laporan"];
  $detail_lokasi = $_POST["lokasi"];
  $tanggal_kirim = date('Y-m-d H:i:s');
  $status_tindaklanjut = isset($_POST["status_tindaklanjut"]) ? $_POST["status_tindaklanjut"] : '';

  if ($jenis_laporan != 'Ringan' && $jenis_laporan != 'Berat') {
    // Handle kesalahan, misalnya beri pesan kesalahan atau kembalikan respon error
    echo "Error: Jenis laporan tidak valid.";
}

  // Inisialisasi variabel untuk path dokumentasi default
  $upload_path = null;

  // Cek apakah file dikirim
  if (!empty($_FILES['dokumentasi']['name'])) {
      // Proses file dokumentasi
      $nama_file = $_FILES['dokumentasi']['name'];
      $tmp_file = $_FILES['dokumentasi']['tmp_name'];

      // Simpan file ke direktori tertentu (misalnya: upload/)
      $upload_dir = "upload/";
      $upload_path = $upload_dir . $nama_file;

      // Pindahkan file ke direktori upload
      // $nama_baru = $folder. "/" .time(). ".jpg";
      if (!move_uploaded_file($tmp_file, $upload_path)) {
          echo "Error uploading file.";
          exit;
      }
  }

  // Implementasikan penyimpanan data ke database
  $status_tindaklanjut_default = "sedang di proses";
  $query = "INSERT INTO laporan (id_laporan, jenis_laporan, deskripsi_laporan, detail_lokasi, dokumentasi, tanggal_kirim, status_tindaklanjut, id_user) 
               VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("ssssssss", $id_laporan, $jenis_laporan, $deskripsi_laporan, $detail_lokasi, $upload_path, $tanggal_kirim, $status_tindaklanjut_default, $id_user);
    $stmt->execute();

    if ($stmt->affected_rows > 0) {
      // Redirect ke halaman beranda setelah berhasil menyimpan
      header("Location: /jaga/masyarakat/form-lapor.php?username=" . $_SESSION["user"]);
      exit;
  } else {
      // Hapus file yang sudah diupload jika gagal menyimpan ke database
      if ($upload_path) {
          unlink($upload_path);
      }
      // Tampilkan pesan error jika gagal menyimpan
      echo "Error: " . $stmt->error;
  }
  $stmt->close();
}

?>



<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>JAGA - Lapor</title>
  <link rel="stylesheet" href="/jaga/css/bootstrap-grid.min.css" />
  <link rel="shortcut icon" href="/jaga/foto/LOGO.png" type="image/x-icon" />
  <link rel="stylesheet" href="/jaga/masyarakat/style-lapor.css" />

  <script src="/jaga/jaga-script.js"></script>
</head>

<body>
  <section>
    <div class="container">
      <div class="row">
        <div class="col-8 offset-2 pt-4">
          <div class="bg-lapor pb-5">
            <div class="row">
              <div class="col-12 ps-5 pe-5 pt-4">
                <h2 class="title-lapor d-flex justify-content-center pt-2 pb-2">
                  LAPORKAN KELUHAN ANDA
                </h2>
              </div>
              <div class="border-form col-10 offset-1 mt-4">
                <form method="post" enctype="multipart/form-data" id="form1">
                  <div class="col-11 ps-3 pe-3 pt-2">
                    <label for="deskripsi"><span style="font-size: 20px;">Jenis Laporan :</span></label>
                    <div class="row m-3">
                      <div class="form-ringan col-4 d-flex justify-content-evenly" style="padding: 10px;border: 1px solid #ccc; border-radius: 4px;">
                        <input type="radio" id="laporanRingan" name="jenis_laporan" value="Ringan">
                        <label style="font-size: 16px; font-family: poppins-bold;" for="laporanRingan">Laporan Ringan</label>
                      </div>
                      <div class="col-4 offset-2 d-flex justify-content-evenly" style="padding: 10px;border: 1px solid #ccc; border-radius: 4px;">
                        <input type="radio" id="laporanDarurat" name="jenis_laporan" value="Darurat" onclick="alert('Peringatan!\nLaporan Darurat Digunakan Jika Terjadi Hal yang Bersifat Darurat Seperti Kebakaran, Perampokan, Beradu Fisik Dan Lain-lain')">
                        <label style="font-size: 16px; font-family: poppins-bold; color: #CF0000;" for="laporanDarurat">Laporan Darurat</label>
                      </div>
                    </div>
                  </div>
                  <div class="col-11 ps-3 pe-3 pt-2 mt-4">
                    <label for="deskripsi">Deskripsi Laporan :</label>
                    <textarea id="deskripsi" name="deskripsi_laporan" rows="5" placeholder="Contoh :  Ada Beberapa Orang Sedang Beradu Mulut di blok A Nomor 20 di Sekitar Warung Pak Budi"></textarea>
                  </div>
                  <div class="col-11 ps-3 pe-3 pt-3">
                  <label for="lokasi">Lokasi :</label>
                    <select id="lokasi" name="lokasi" style="padding: 10px; width: 30%">
                      <option value=""> Pilih Blok </option>
                      <option value="BLOK A">BLOK A</option>
                      <option value="BLOK B">BLOK B</option>
                    </select>
                  </div>
                  <div class="unggahFoto col-10 ps-3 pt-3">
                    <label for="dokumentasi">Pengunggahan Foto(opsional) :</label>
                    <input type="file" id="dokumentasi" name="dokumentasi" accept="image/*">
                    <button id="hapus-tombol" onclick="hapusGambar()">Hapus Foto</button>
                    <div class="container">
                      <div class="row mt-5">
                        <div class="btn-beranda col-4 d-flex justify-content-center">
                          <a href="beranda.php" style="
                                text-decoration: none;
                                color: rgb(255, 255, 255);
                              ">Kembali Ke Beranda</a>
                        </div>

                        <div class="btn-reset-kirim col-4 offset-4 d-flex">
                          <button type="reset" style="width: 120%; margin-right: 10px">
                            Kosongkan
                          </button>
                          <button style="width: 120%" id="submit-button" name="submit" onclick="cek_data(); return false;">Kirim</button>
                        </div>
                      </div>
                    </div>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <script>
    function cek_data() {
// Pengecekan jenis laporan
var jenisLaporan = document.querySelector('input[name="jenis_laporan"]:checked');
      if (!jenisLaporan) {
        alert('Pilih Salah Satu Jenis Laporan (Ringan/Darurat)');
        return false;
      }

      if (jenisLaporan.value === 'Laporan Darurat') {
        alert('Peringatan!\nLaporan Darurat Digunakan Jika Terjadi Hal yang Bersifat Darurat Seperti Kebakaran, Perampokan, Beradu Fisik Dan Lain-lain');
      }

      // Pengecekan jenis laporan
      var jenisLaporan = document.querySelector('input[name="jenis_laporan"]:checked');
      if (!jenisLaporan) {
        alert('Pilih salah satu jenis laporan (Ringan/Darurat)');
        return false;
      }
      if (document.getElementById('deskripsi').value == '') {
        alert('Deskripsi Harus Diisi');
        document.getElementById('deskripsi').focus();
        return false;
      }
      if (document.getElementById('lokasi').value == '') {
        alert('Lokasi Harus Diisi');
        document.getElementById('lokasi').focus();
        return false;
      }

      // Tampilkan konfirmasi
      var isConfirmed = confirm("Apakah Laporan yang Anda Buat Sudah Benar?");
      if (isConfirmed) {
        document.getElementById('form1').submit(alert('Laporan Anda Berhasil Terkirim'));
      }
      return isConfirmed;
    }
  </script>
</body>

</html>