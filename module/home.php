<?php 
include_once "config/inc.connection.php";
include_once "config/inc.library.php";

$userSql = "SELECT * FROM user WHERE kd_user='".$_SESSION['kd_user']."'";
$userQry = mysql_query($userSql, $koneksidb)  or die ("Query penjualan salah : ".mysql_error());
$userRow = mysql_fetch_array($userQry);
?>

<div class="col-md-6 panel-info">
	<div class="content-box-header panel-heading">
		<div class="panel-title "><i class="glyphicon glyphicon-certificate"></i>&nbsp; 5 Karyawan Terbaik</div>	
	</div>
	<div class="content-box-large box-with-header">
	<table width="100%" class="table table-hover table-bordered table-condensed">
		<thead>
		  <tr class="active">
			<td width="19%"><div align="center">NIK</div></td>
			<td width="60%">Nama Barang</td>
			<td width="21%"><div align="center">Persentase</div></td>
		  </tr>
		</thead>
		<?php
		$terbaikSql = "SELECT karyawan.*, (SELECT AVG(peserta.nilai_pelatihan) FROM peserta 
									WHERE peserta.nik=karyawan.nik AND status_kehadiran='Masuk') As total FROM karyawan ORDER BY total DESC LIMIT 5";
		$terbaikQry = mysql_query($terbaikSql, $koneksidb) or die ("Error pada file terlaris.php baris 5".mysql_error());
		$nomor = 0;
		while ($terbaikRow = mysql_fetch_array($terbaikQry)) {
			$nomor++;
		?>
		<tbody>
		  <tr>
			<td><div align="center"><?php echo $terbaikRow['nik']; ?></div></td>
			<td><?php echo $terbaikRow['nama_karyawan']; ?></td>
			<td><div align="center"><?php echo $terbaikRow['total']; ?> %</div></td>
		  </tr>
	  	</tbody>
		<?php } ?>
	</table>
	</div>
</div>

<div class="col-md-6 panel-info">
	<div class="content-box-header panel-heading">
		<div class="panel-title "><i class="glyphicon glyphicon-cloud-upload"></i>&nbsp; 5 Karyawan Baru</div>	
	</div>
	<div class="content-box-large box-with-header">
	<table width="100%" class="table table-hover table-bordered table-condensed">
		<thead>
		  <tr class="active">
			<td width="19%"><div align="center">NIK</div></td>
			<td width="60%">Nama Karyawan</td>
			<td width="21%"><div align="center">Jenis Kelamin</div></td>
		  </tr>
		</thead>
		<?php
		$pegawaiSql = "SELECT * FROM karyawan ORDER BY nik DESC LIMIT 5";
		$pegawaiQry = mysql_query($pegawaiSql, $koneksidb) or die ("Error pada file terlaris.php baris 5".mysql_error());
		$nomor = 0;
		while ($pegawaiRow = mysql_fetch_array($pegawaiQry)) {
			$nomor++;
		?>
		<tbody>
		  <tr>
			<td><div align="center"><?php echo $pegawaiRow['nik']; ?></div></td>
			<td><?php echo $pegawaiRow['nama_karyawan']; ?></td>
			<td><div align="center"><?php echo $pegawaiRow['kelamin']; ?></div></td>
		  </tr>
	  	</tbody>
		<?php } ?>
	</table>
	</div>
</div>
	