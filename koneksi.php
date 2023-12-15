<?php

function connectDB() {
    $server = "localhost";
    $username = "root";
    $password = "";
    $database = "jagadb";

    $conn = mysqli_connect($server, $username, $password, $database);

    if($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    return $conn;
}

global $conn;

$conn = connectDB();

?>