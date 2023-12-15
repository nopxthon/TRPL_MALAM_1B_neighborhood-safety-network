        <div class="row">
          <div class="col s12 m9">
            <h3 class="orange-text">Laporan</h3>
          </div> 
          <div class="col s12 m3">
            <div class="section"></div>
            <a class="waves-effect waves-light btn blue" href="cetak.php"><i class="material-icons">print</i></a>
          </div>
        </div>

        <table id="example" class="display responsive-table" style="width:100%">
          <thead>
              <tr>
				<th>No</th>
				<th>NIK Pelapor</th>
				<th>Nama Pelapor</th>
				<th>Jenis Laporan</th>
				<th>Deskripsi Laporan</th>
				<th>Lokasi Laporan</th>
				<th>Tanggal Kirim Laporan</th>
				<th>Status Akhir Laporan</th>
              </tr>
          </thead>
          <tbody>
            
	<?php 
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
            <?php  }
             ?>

          </tbody>
        </table>        