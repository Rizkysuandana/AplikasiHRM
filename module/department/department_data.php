<?php
include "./config/inc.connection.php";
include "./config/inc.library.php";

$row = 10;
$hal = isset($_GET['hal']) ? $_GET['hal'] : 0;
$pageSql = "SELECT * FROM department";
$pageQry = mysql_query($pageSql, $koneksidb) or die ("error paging: ".mysql_error());
$jml	 = mysql_num_rows($pageQry);
$max	 = ceil($jml/$row);
?>
<div class="col-md-12 panel-warning">
	<div class="content-box-header panel-heading">
		<div class="panel-title "><i class="glyphicon glyphicon-folder-close"></i>&nbsp; Data Department</div>	
	</div>
	<div class="content-box-large box-with-header">
		<table width="100%" border="0">
			<tr>
				<td width="439">
				<form action='?page=Data-Department'method="POST">
				<div class="input-group form">
	            	<input type="text" name="qcari" class="form-control" placeholder="Pencarian">
	                 <span class="input-group-btn">
	                 	<button class="btn btn-warning" type="submit">Search</button>
	                 </span>
              	</div>
				</form>
				</td>
				<td width="868" align="right">
					<a href="?page=Tambah-Department" class="btn btn-warning"><i class="glyphicon glyphicon-plus-sign"></i> Tambah Data</a>			  			
				</td>
		  	</tr>
		  	<tr>
		    	<td>&nbsp;</td>
		    	<td align="right">&nbsp;</td>
	      	</tr>
		</table>
		<table class="table table-hover">
			<thead>
				<tr class="active">
					<th width="35"><div align="center">No</div></th>
					<th width="82"><div align="left">Kode</div></th>
					<th width="310"><div align="left">Nama Department</div></th>
					<th width="297"><div align="left">Lokasi Department</div></th>
					<th width="168"><div align="center">Line Phone</div></th>
					<th colspan="2"><div align="center">Aksi</div></th>
				</tr>
				</thead>
						<?php
							$dataSql = "SELECT * FROM department LIMIT $hal, $row";
							if (isset($_POST['qcari'])){
								$qcari =$_POST['qcari'];
							  
							$dataSql = "SELECT * FROM department WHERE nama_department like '%$qcari%' LIMIT $hal, $row";
							}
							$dataQry = mysql_query($dataSql, $koneksidb)  or die ("Query department salah : ".mysql_error());
							$nomor  = 0; 
							while ($dataRow = mysql_fetch_array($dataQry)) {
							$nomor++;
							$Kode = $dataRow['kode_department'];
						?>
				<tbody>
					<tr>
						<td><div align="center"><?php echo $nomor; ?></div></td>
						<td><div align="left"><?php echo $dataRow['kode_department']; ?></div></td>
						<td><div align="left"><?php echo $dataRow['nama_department']; ?></div></td>
						<td><div align="left"><?php echo $dataRow['lokasi_department']; ?></div></td>
						<td><div align="center"><?php echo $dataRow['phone']; ?></div></td>
						<td width="17" align="center">
						<a href="?page=Ubah-Department&amp;Kode=<?php echo $Kode; ?>" target="_self"><span class="glyphicon glyphicon-new-window"></span></a> 
						</td>
       					<td width="18" align="center"><a href="?page=Hapus-Department&amp;Kode=<?php echo $Kode; ?>" target="_self" alt="Delete Data" onClick="return confirm('ANDA YAKIN AKAN MENGHAPUS DATA PENTING INI ... ?')"><span class="glyphicon glyphicon-trash"></span></a>
						</td>
   					</tr>
				</tbody>
      				<?php } ?>
				<tfoot>
					<tr class="active">
						<td colspan="3"><b>Jumlah :</b> <?php echo $jml; ?> </td>
						<td colspan="5" align="right"><b>Halaman ke :</b>
						<?php
						for ($h = 1; $h <= $max; $h++) {
							$list[$h] = $row * $h - $row;
							echo " <a href='?page=Data-Department&hal=$list[$h]'>$h</a> ";
						}
						?></td>
					</tr>
				</tfoot>
			</table>
	</div>
</div>