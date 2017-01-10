<head> 
<script type="text/javascript" src="./js/jquery-1.3.2.js"></script>
<script type="text/javascript" src="./js/ui.core.js"></script>
<script type="text/javascript" src="./js/ui.datepicker.js"></script>
<script type="text/javascript"> 
      $(document).ready(function(){
        $("#tanggalAwal").datepicker({
			dateFormat  : "dd-mm-yy", 
          	changeMonth : true,
          	changeYear  : true
        });
		$("#tanggalAkhir").datepicker({
			dateFormat  : "dd-mm-yy", 
          	changeMonth : true,
          	changeYear  : true
        });
      });
	  
</script>
</head>
<?php
include "./config/inc.connection.php";
include "./config/inc.library.php";

$dataAwal 	= isset($_POST['txtTanggalAwal']) ? $_POST['txtTanggalAwal'] : date('d-m-Y');
$dataAkhir 	= isset($_POST['txtTanggalAkhir']) ? $_POST['txtTanggalAkhir'] : date('d-m-Y');

?>
<div class="col-md-12 panel-warning">
	<div class="content-box-header panel-heading">
		<div class="panel-title"> Laporan Data Pelatihan</div>
	</div>
	<div class="content-box-large box-with-header">
		<i class="glyphicon glyphicon-book"></i> <b>Informasi Priode Pelatihan</b><br />
		<small>Informasi lengkap  mengenai priode pelatihan karyawan</small>
		<hr />
		<form action="?page=Laporan-Peserta" method="post">
		  	<div class="form-group">
				<label class="control-label col-md-2">Priode Tanggal</label>
				<div class="col-md-10">
					<div class="row">
						<div class="col-sm-3">
							<div class="input-group">
							<input class="form-control" type="text" value="<?php echo $dataAwal; ?>" name="txtTanggalAwal" id="tanggalAwal">
							<span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>						
							</div>
						</div>				
						<div class="col-sm-3">	
							<div class="input-group">
							<input class="form-control" type="text" value="<?php echo $dataAkhir; ?>" name="txtTanggalAkhir" id="tanggalAkhir">
							<span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>						
							</div>
						</div><input name="btnShow" type="submit" value=" Tampilkan " class="btn btn-warning"/>
					</div>
				</div>
			</div>					
		</form>
		<br />
		<br />
		<hr />
  			<table class="table table-bordered table-condensed table-hover" width="100%">
				<thead>
			    	<tr class="active">
	        		  	<th width="37"><div align="center">No</div></th>
						<th width="140"><div align="center">Tgl.Pelatihan</div></th>
	              	  <th width="143"><div align="center">NIK</div></th>
		              	<th width="234"><div align="left">Nama Karyawan </div></th>
					  	<th width="464"><div align="left">Department</div></th>
				  	  <th width="162"><div align="left">Kehadiran</div></th>
	              	  <th width="88"><div align="center">Nilai</div></th>
			        </tr>
	          </thead>
				<?php
					$dataSql = "SELECT * FROM peserta 
								INNER JOIN pelatihan ON peserta.no_pelatihan=pelatihan.no_pelatihan 
								INNER JOIN karyawan ON peserta.nik=karyawan.nik
								INNER JOIN department ON karyawan.kode_department=department.kode_department
								LIMIT 10";
					if (isset($_POST['btnShow'])){							  
						$dataSql = "SELECT * FROM peserta 
									INNER JOIN pelatihan ON peserta.no_pelatihan=pelatihan.no_pelatihan 
									INNER JOIN karyawan ON peserta.nik=karyawan.nik
									INNER JOIN department ON karyawan.kode_department=department.kode_department
									WHERE pelatihan.tanggal_pelatihan BETWEEN '".InggrisTgl($dataAwal)."' AND '".InggrisTgl($dataAkhir)."'";
						}
					$dataQry = mysql_query($dataSql, $koneksidb)  or die ("Query pelatihan salah : ".mysql_error());
					$nomor  = 0; 
					while ($dataRow = mysql_fetch_array($dataQry)) {
					$nomor++;
				?>
			<tbody>
				<tr>
					<td><div align="center"><?php echo $nomor; ?></div></td>
					<td><div align="center"><?php echo IndonesiaTgl($dataRow['tanggal_pelatihan']); ?></div></td>
					<td><div align="center"><?php echo $dataRow['nik']; ?></div></td>
					<td><div align="left"><?php echo $dataRow['nama_karyawan']; ?></div></td>
					<td><div align="left"><?php echo $dataRow['nama_department']; ?></div></td>
					<td><div align="left"><?php echo $dataRow['status_kehadiran']; ?></div></td>
					<td align="center"><div align="center"><?php echo $dataRow['nilai_pelatihan']; ?></div></td>
				</tr>
				<?php } ?>
			</tbody>
		</table>
	</div>
</div>