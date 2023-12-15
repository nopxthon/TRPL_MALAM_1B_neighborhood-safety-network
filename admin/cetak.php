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
<link rel="shortcut icon" href="/jaga/foto/LOGO.png" type="image/x-icon"/>
<a href="index0.php"><img src="/jaga/foto/LOGO-IJO.png" alt="" style="width:80px;"></a>
<h2 style="text-align: center;">Rekapan Laporan Pengaduan Masyarakat</h2>
<table border="2" style="width: 100%; height: 10%;">
	<tr style="text-align: center;">
		<td>No</td>
		<td>NIK Pelapor</th>
		<td>Nama Pelapor</th>
		<td>Jenis Laporan</td>
		<td>Deskripsi Laporan</td>
		<td>Lokasi Laporan</td>
		<td>Tanggal Kirim Laporan</td>
		<td>Status Akhir Laporan</td>
	</tr>
	<?php 
		include '.././koneksi.php';
		$no=1;
		$query = mysqli_query($conn,"SELECT * FROM laporan INNER JOIN masyarakat ON laporan.id_user=masyarakat.id_user ORDER BY tanggal_kirim DESC");
		while ($r=mysqli_fetch_assoc($query)) { ?>
		<tr>
			<td><?php echo $no++; ?></td>
			<td><?php echo $r['nik']; ?></td>
			<td><?php echo $r['nama_masy']; ?></td>
			<td><?php echo $r['jenis_laporan']; ?></td>
			<td><?php echo $r['deskripsi_laporan']; ?></td>
			<td><?php echo $r['detail_lokasi']; ?></td>
			<td><?php echo $r['tanggal_kirim']; ?></td>
			<td><?php echo $r['status_tindaklanjut']; ?></td>
		</tr>
	<?php	}
	 ?>
</table>
<script type="text/javascript">
	window.print();
</script>