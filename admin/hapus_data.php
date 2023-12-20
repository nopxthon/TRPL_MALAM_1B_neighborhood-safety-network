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

$id_laporan = $_GET["id_laporan"];
$query = "DELETE FROM laporan WHERE id_laporan = $id_laporan";
$result = mysqli_query($conn, $query);

if ($result) {
  echo '<script>alert("Laporan Berhasil Dihapus."); window.location.href = "index0.php";</script>';
} else {
  echo '<script>alert("Failed to delete data. ' . mysqli_error($conn) . '"); window.history.back();</script>';
}
?>