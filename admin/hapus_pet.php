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
$query = "DELETE FROM tim_keamanan WHERE id_keamanan = $id_keamanan";
$result = mysqli_query($conn, $query);

if ($result) {
  echo '<script>alert("Data deleted successfully."); window.location.href = "index2.php";</script>';
} else {
  echo '<script>alert("Failed to delete data. ' . mysqli_error($conn) . '"); window.history.back();</script>';
}
?>