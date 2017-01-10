<?php
include "./config/inc.connection.php";
include "./config/inc.library.php";

$row = 10;
$hal = isset($_GET['hal']) ? $_GET['hal'] : 0;
$pageSql = "SELECT * FROM peserta";
$pageQry = mysql_query($pageSql, $koneksidb) or die ("error paging: ".mysql_error());
$jml	 = mysql_num_rows($pageQry);
$max	 = ceil($jml/$row);
?>
<div class="col-md-12 panel-warning">
	<div class="content-box-header panel-heading">
		<div class="panel-title "><i class="glyphicon glyphicon-th-large"></i>&nbsp; Data Peserta</div>	
	</div>
	<div class="content-box-large box-with-header">
		<table width="100%" border="0">
			<tr>
				<td width="439">
				<form action='?page=Data-Peserta'method="POST">
				<div class="input-group form">
	            	<input type="text" name="qcari" class="form-control" placeholder="Kode Pelatihan">
	                 <span class="input-group-btn">
	                 	<button class="btn btn-warning" type="submit">Search</button>
	                 </span>
              	</div>
				</form>
				</td>
		  	</tr>
		  	<tr>
		    	<td>&nbsp;</td>
	      	</tr>
		</table>
		<table class="table table-hover" width="100%">
			<thead>
				<tr class="active">
				  <th width="29"><div align="center">No</div></th>
					<th width="137"><div align="left">No. Pelatihan</div></th>
				  <th width="196"><div align="center">NIK</div></th>
				  <th width="309"><div align="left">Nama Karyawan</div></th>
				  <th width="370"><div align="left">Department</div></th>
					<th width="191"><div align="left">Kehadiran</div></th>
				    <th colspan="2"><div align="center">Aksi</div></th>
			    </tr>
			</thead>
				<?php
					$dataSql = "SELECT * FROM peserta 
								INNER JOIN karyawan ON peserta.nik=karyawan.nik  
								INNER JOIN department ON karyawan.kode_department=department.kode_department
								ORDER BY id_peserta DESC LIMIT $hal, $row";
					if (isset($_POST['qcari'])){
						$qcari =$_POST['qcari'];
							  
						$dataSql = "SELECT * FROM peserta 
									INNER JOIN karyawan ON peserta.nik=karyawan.nik  
									INNER JOIN department ON karyawan.kode_department=department.kode_department  
									WHERE no_pelatihan like '%$qcari%' ORDER BY id_peserta DESC LIMIT $hal, $row";
						}
					$dataQry = mysql_query($dataSql, $koneksidb)  or die ("Query karyawan salah : ".mysql_error());
					$nomor  = 0; 
					while ($dataRow = mysql_fetch_array($dataQry)) {
					$nomor++;
					$Kode = $dataRow['id_peserta'];
				?>
			<tbody>
				<tr>
					<td><div align="center"><?php echo $nomor; ?></div></td>
					<td><div align="left"><?php echo $dataRow['no_pelatihan']; ?></div></td>
					<td><div align="center"><?php echo $dataRow['nik']; ?></div></td>
					<td><div align="left"><?php echo $dataRow['nama_karyawan']; ?></div></td>
					<td><div align="left"><?php echo $dataRow['nama_department']; ?></div></td>
					<td><div align="left"><?php echo $dataRow['status_kehadiran']; ?></div></td>
					<td width="23" align="center">
					<a href="?page=Ubah-Peserta&amp;Kode=<?php echo $Kode; ?>" target="_self"><span class="glyphicon glyphicon-new-window"></span></a>					</td>
       				<td width="26" align="center">
					<a href="?page=Hapus-Peserta&amp;Kode=<?php echo $Kode; ?>" target="_self" alt="Delete Data" onClick="return confirm('ANDA YAKIN AKAN MENGHAPUS DATA PENTING INI ... ?')"><span class="glyphicon glyphicon-trash"></span></a>					</td>
   				</tr>
			</tbody>
      			<?php } ?>
			<tfoot>
				<tr class="active">
					<td colspan="3"><b>Jumlah :</b> <?php echo $jml; ?> </td>
					<td colspan="6" align="right"><b>Halaman ke :</b>
					<?php
						for ($h = 1; $h <= $max; $h++) {
							$list[$h] = $row * $h - $row;
							echo " <a href='?page=Data-Peserta&hal=$list[$h]'>$h</a> ";
						}
					?></td>
				 </tr>
			</tfoot>
		</table>
  	</div>
</div>