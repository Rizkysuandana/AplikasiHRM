<?php
include "./config/inc.connection.php";
include "./config/inc.library.php";

$row = 10;
$hal = isset($_GET['hal']) ? $_GET['hal'] : 0;
$pageSql = "SELECT * FROM karyawan";
$pageQry = mysql_query($pageSql, $koneksidb) or die ("error paging: ".mysql_error());
$jml	 = mysql_num_rows($pageQry);
$max	 = ceil($jml/$row);
?>
<div class="col-md-12 panel-warning">
	<div class="content-box-header panel-heading">
		<div class="panel-title "><i class="glyphicon glyphicon-th-large"></i>&nbsp; Data Karyawan</div>	
	</div>
	<div class="content-box-large box-with-header">
		<table width="100%" border="0">
			<tr>
				<td width="439">
				<form action='?page=Data-Karyawan'method="POST">
				<div class="input-group form">
	            	<input type="text" name="qcari" class="form-control" placeholder="Pencarian">
	                 <span class="input-group-btn">
	                 	<button class="btn btn-warning" type="submit">Search</button>
	                 </span>
              	</div>
				</form>
				</td>
				<td width="868" align="right">
					<a href="?page=Tambah-Karyawan" class="btn btn-warning"><i class="glyphicon glyphicon-plus-sign"></i> Tambah Data</a>			  			
				</td>
		  	</tr>
		  	<tr>
		    	<td>&nbsp;</td>
		    	<td align="right">&nbsp;</td>
	      	</tr>
		</table>
		<table class="table table-hover" width="100%">
			<thead>
				<tr class="active">
					<th width="32"><div align="center">No</div></th>
					<th width="108"><div align="center">NIK</div></th>
					<th width="270"><div align="left">Nama Karyawan</div></th>
					<th width="405"><div align="left">Department</div></th>
					<th width="241"><div align="left">Jenis Kelamin</div></th>
					<th><div align="center">Tgl. Masuk </div></th>
				    <th colspan="2"><div align="center">Aksi</div></th>
			    </tr>
			</thead>
				<?php
					$dataSql = "SELECT * FROM karyawan 
								INNER JOIN department ON karyawan.kode_department=department.kode_department  
								LIMIT $hal, $row";
					if (isset($_POST['qcari'])){
						$qcari =$_POST['qcari'];
							  
						$dataSql = "SELECT * FROM karyawan 
									INNER JOIN department ON karyawan.kode_department=department.kode_department
									WHERE nama_karyawan like '%$qcari%' LIMIT $hal, $row";
						}
					$dataQry = mysql_query($dataSql, $koneksidb)  or die ("Query karyawan salah : ".mysql_error());
					$nomor  = 0; 
					while ($dataRow = mysql_fetch_array($dataQry)) {
					$nomor++;
					$Kode = $dataRow['nik'];
				?>
			<tbody>
				<tr>
					<td><div align="center"><?php echo $nomor; ?></div></td>
					<td><div align="center"><?php echo $dataRow['nik']; ?></div></td>
					<td><div align="left"><?php echo $dataRow['nama_karyawan']; ?></div></td>
					<td><div align="left"><?php echo $dataRow['nama_department']; ?></div></td>
					<td><div align="left"><?php echo $dataRow['kelamin']; ?></div></td>
					<td width="183" align="center"><?php echo IndonesiaTgl($dataRow['tanggal_masuk']); ?></td>
					<td width="25" align="center">
					<a href="?page=Ubah-Karyawan&amp;Kode=<?php echo $Kode; ?>" target="_self"><span class="glyphicon glyphicon-new-window"></span></a>					</td>
       				<td width="17" align="center">
					<a href="?page=Hapus-Karyawan&amp;Kode=<?php echo $Kode; ?>" target="_self" alt="Delete Data" onClick="return confirm('ANDA YAKIN AKAN MENGHAPUS DATA PENTING INI ... ?')"><span class="glyphicon glyphicon-trash"></span></a>					</td>
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
							echo " <a href='?page=Data-Karyawan&hal=$list[$h]'>$h</a> ";
						}
					?></td>
				 </tr>
			</tfoot>
		</table>
  	</div>
</div>