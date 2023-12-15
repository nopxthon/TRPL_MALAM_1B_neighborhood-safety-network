<?php
include ".././koneksi.php";


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Ambil informasi dari formulir
    // $deskripsi_kejadian = $_POST["deskripsi"];
    // $lokasi_kejadian = $_POST["lokasi"];
    // $tanggal_kirim = date('Y-m-d H:i:s'); // Tanggal dan waktu saat ini

    // Simpan foto ke direktori (anda bisa menyimpan namanya ke database)
    $dokumentasi_path = "/upload/" . uniqid() . "_" . basename($_FILES["dokumentasi"]["name"]);
    move_uploaded_file($_FILES["dokumentasi"]["tmp_name"], $dokumentasi_path);


    // Periksa file gambar dikirim
    if (!empty($_FILES["dokumentasi"]["name"])) {
        // File gambar dikirim, lanjutkan dengan proses upload
        $upload_dir = "/upload/";
        $dokumentasi_path = $upload_dir . uniqid() . "_" . basename($_FILES["dokumentasi"]["name"]);
        move_uploaded_file($_FILES["dokumentasi"]["tmp_name"], $dokumentasi_path);
    }
    // ,$nama_baru
    // Simpan informasi ke database atau lakukan tindakan yang sesuai
    // Misalnya, Anda dapat menggunakan MySQLi untuk menyimpan ke database

    if ($conn->connect_error) {
        die("Koneksi ke database gagal: " . $conn->connect_error);
    }

    // Query untuk menyimpan informasi ke database
    $sql = "INSERT INTO laporan (deskripsi_kejadian, lokasi_kejadian, dokumentasi, tanggal_kirim) 
            VALUES ('$deskripsi_kejadian', '$lokasi_kejadian', '$dokumentasi_path', '$tanggal_kirim')";

    if ($conn->query($sql) === TRUE) {
        echo "Laporan berhasil dikirim!";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $conn->close();
}
?>
