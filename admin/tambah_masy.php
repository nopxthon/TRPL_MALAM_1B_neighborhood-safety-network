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

    <title>JAGA - Admin</title>
</head>

<body>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f8f9fa;
        }

        .container {
            max-width: 600px;
            margin: auto;
            background-color: #ffffff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            margin-top: 50px;
        }

        h2 {
            color: #343a40;
        }

        label {
            display: block;
            margin-bottom: 8px;
            color: #495057;
        }

        input,
        select {
            width: 100%;
            padding: 8px;
            margin-bottom: 15px;
            box-sizing: border-box;
            border: 1px solid #ced4da;
            border-radius: 4px;
        }

        input[type="date"] {
            padding: 6px;
        }

        /* Styling for buttons */
        .btn {
            display: inline-block;
            padding: 8px 16px;
            font-size: 16px;
            cursor: pointer;
            text-align: center;
            text-decoration: none;
            outline: none;
            border: none;
            border-radius: 4px;
        }

        .btn-success {
            background-color: #28a745;
            color: #fff;
        }

        .btn-success:hover {
            background-color: #218838;
        }

        .btn-danger {
            background-color: #dc3545;
            color: #fff;
        }

        .btn-danger:hover {
            background-color: #c82333;
        }
    </style>



    <div class="container">
        <!-- Formulir untuk Input Data Masyarakat -->
        <form method="post" id="form1">
            <h2>Input Data Masyarakat</h2>
            <label for="nama_masy">Nama:</label>
            <input type="text" name="nama_masy" required><br>

            <label for="nik">NIK:</label>
            <input type="text" name="nik" required><br>

            <label for="username">Nama Pengguna:</label>
            <input type="text" name="username" required><br>

            <label for="password">Kata Sandi:</label>
            <input type="password" name="password" required><br>

            <label for="alamat">Alamat:</label>
            <input type="text" name="alamat" required><br>

            <label for="jenis_kelamin">Jenis Kelamin:</label>
            <select name="jenis_kelamin" required>
                <option value="Laki-laki">Laki-laki</option>
                <option value="Perempuan">Perempuan</option>
            </select><br>

            <label for="no_telp">No. Telepon:</label>
            <input type="text" name="no_telp" required><br>

            <label for="tanggal_lahir">Tanggal Lahir:</label>
            <input type="date" name="tanggal_lahir" id="tanggal_lahir" required><br>

            <label for="umur">Umur:</label>
            <input type="number" name="umur" id="umur" readonly><br>

            <div class="row mt-3 ms-1">
                <a href="index.php" class="col-2 me-4 btn btn-danger">Batal</a>
                <button type="submit" class="col-2 offset-7 btn btn-success" name="submit">Simpan</button>
            </div>

        </form>
    </div>
    </div>

    <?php
    if (isset($_POST['submit'])) {
        $nama_masy = $_POST['nama_masy'];
        $nik = $_POST['nik'];
        $username = $_POST['username'];
        $password = $_POST['password'];
        $alamat = $_POST['alamat'];
        $jenis_kelamin = $_POST['jenis_kelamin'];
        $no_telp = $_POST['no_telp'];
        $tanggal_lahir = $_POST['tanggal_lahir'];
        $umur = $_POST['umur'];

        $query = "INSERT INTO masyarakat ( nama_masy, nik, username, password, alamat, jenis_kelamin, no_telp, tanggal_lahir, umur) 
                    VALUES ('$nama_masy', '$nik', '$username', '$password', '$alamat', '$jenis_kelamin', '$no_telp', '$tanggal_lahir', '$umur')";

        $result = mysqli_query($conn, $query);

        if ($result) {
            exit();
        }
    }

    ?>

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
        });
    </script>

    <!-- Bootstrap -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>

</body>

</html>