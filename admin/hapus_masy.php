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
$query = "DELETE FROM masyarakat WHERE id_user = $id_user";
$result = mysqli_query($conn, $query);

if ($result) {
  echo '<script>alert("Data Berhasil Dihapus."); window.location.href = "index.php";</script>';
} else {
  echo '<script>alert("Failed to delete data. ' . mysqli_error($conn) . '"); window.history.back();</script>';
}
?>