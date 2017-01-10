<?php
include "./config/inc.connection.php";
include "./config/inc.library.php";

$row = 10;
$hal = isset($_GET['hal']) ? $_GET['hal'] : 0;
$pageSql = "SELECT * FROM perusahaan";
$pageQry = mysql_query($pageSql, $koneksidb) or die ("error paging: ".mysql_error());
$jml	 = mysql_num_rows($pageQry);
$max	 = ceil($jml/$row);
?>
<div class="col-md-12 panel-warning">
	<div class="content-box-header panel-heading">
		<div class="panel-title "><i class="glyphicon glyphicon-folder-close"></i>&nbsp; Data Perusahaan</div>	
	</div>
	<div class="content-box-large box-with-header">
		<table width="100%" border="0">
			<tr>
				<td width="439">
				<form action='?page=Data-Perusahaan'method="POST">
				<div class="input-group form">
	            	<input type="text" name="qcari" class="form-control" placeholder="Pencarian">
	                 <span class="input-group-btn">
	                 	<button class="btn btn-warning" type="submit">Search</button>
	                 </span>
              	</div>
				</form>
				</td>
				<td width="868" align="right">
					<a href="?page=Tambah-Perusahaan" class="btn btn-warning"><i class="glyphicon glyphicon-plus-sign"></i> Tambah Data</a>			  			
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
					<th width="35"><div align="center">No</div></th>
					<th width="82"><div align="left">Kode</div></th>
					<th width="310"><div align="left">Nama Perusahaan</div></th>
					<th width="297"><div align="left">Jenis Perusahaan</div></th>
					<th width="168"><div align="center">Tanggal Berdiri</div></th>
					<th colspan="2"><div align="center">Aksi</div></th>
				</tr>
			</thead>
			<?php
				$dataSql = "SELECT * FROM perusahaan  LIMIT $hal, $row";
				if (isset($_POST['qcari'])){
					$qcari =$_POST['qcari'];
							  
					$dataSql = "SELECT * FROM perusahaan WHERE nama_perusahaan like '%$qcari%' LIMIT $hal, $row";
					}
				$dataQry = mysql_query($dataSql, $koneksidb)  or die ("Query perusahaan salah : ".mysql_error());
				$nomor  = 0; 
				while ($dataRow = mysql_fetch_array($dataQry)) {
				$nomor++;
				$Kode = $dataRow['kode_perusahaan'];
			?>
			<tbody>
				<tr>
					<td><div align="center"><?php echo $nomor; ?></div></td>
					<td><div align="left"><?php echo $dataRow['kode_perusahaan']; ?></div></td>
					<td><div align="left"><?php echo $dataRow['nama_perusahaan']; ?></div></td>
					<td><div align="left"><?php echo $dataRow['jenis_perusahaan']; ?></div></td>
					<td><div align="center"><?php echo $dataRow['tanggal_berdiri']; ?></div></td>
					<td width="17" align="center">
					<a href="?page=Ubah-Perusahaan&amp;Kode=<?php echo $Kode; ?>" target="_self"><span class="glyphicon glyphicon-new-window"></span></a>
					</td>
       				<td width="18" align="center"><a href="?page=Hapus-Perusahaan&amp;Kode=<?php echo $Kode; ?>" target="_self" alt="Delete Data" onClick="return confirm('ANDA YAKIN AKAN MENGHAPUS DATA PENTING INI ... ?')"><span class="glyphicon glyphicon-trash"></span></a>
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
							echo " <a href='?page=Data-Perusahaan&hal=$list[$h]'>$h</a> ";
						}
					?></td>
				</tr>
			</tfoot>
		</table>
	</div>
</div>