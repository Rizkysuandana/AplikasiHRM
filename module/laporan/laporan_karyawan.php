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
		<div class="panel-title"> Laporan Data Karyawan</div>
	</div>
	<div class="content-box-large box-with-header">
		<i class="glyphicon glyphicon-book"></i> <b>Informasi Priode Masuk</b><br />
		<small>Informasi lengkap  mengenai priode masuk karyawan</small>
		<hr />
		<form action="?page=Laporan-Karyawan" method="post">
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
		        		<th width="29"><div align="center">No</div></th>
						<th width="90"><div align="center">Tgl.Masuk</div></th>
			            <th width="79"><div align="center">NIK</div></th>
			            <th width="245"><div align="left">Nama Karyawan </div></th>
						<th width="174"><div align="left">Tempat, Tgl. Lahir</div></th>
			            <th width="65"><div align="center">Kelamin</div></th>
						<th width="313"><div align="left">Department</div></th>
		              	<th width="269"><div align="left">Jabatan</div></th>
			        </tr>
	          </thead>
				<?php
					$dataSql = "SELECT * FROM karyawan 
								INNER JOIN department ON karyawan.kode_department=department.kode_department
								INNER JOIN jabatan ON karyawan.kode_jabatan=jabatan.kode_jabatan LIMIT 10";
					if (isset($_POST['btnShow'])){							  
						$dataSql = "SELECT * FROM karyawan 
									INNER JOIN department ON karyawan.kode_department=department.kode_department
									INNER JOIN jabatan ON karyawan.kode_jabatan=jabatan.kode_jabatan
									WHERE tanggal_masuk BETWEEN '".InggrisTgl($dataAwal)."' AND '".InggrisTgl($dataAkhir)."'";
						}
					$dataQry = mysql_query($dataSql, $koneksidb)  or die ("Query karyawan salah : ".mysql_error());
					$nomor  = 0; 
					while ($dataRow = mysql_fetch_array($dataQry)) {
					$nomor++;
				?>
			<tbody>
				<tr>
					<td><div align="center"><?php echo $nomor; ?></div></td>
					<td><div align="center"><?php echo IndonesiaTgl($dataRow['tanggal_masuk']); ?></div></td>
					<td><div align="center"><?php echo $dataRow['nik']; ?></div></td>
					<td><div align="left"><?php echo $dataRow['nama_karyawan']; ?></div></td>
					<td><div align="left"><?php echo $dataRow['tempat_lahir']; ?>, <?php echo IndonesiaTgl($dataRow['tanggal_lahir']); ?></div></td>
					<td><div align="center"><?php echo $dataRow['kelamin']; ?></div></td>
					<td align="center"><div align="left"><?php echo $dataRow['nama_department']; ?></div></td>
					<td align="center"><div align="left"><?php echo $dataRow['nama_jabatan']; ?></div></td>
				</tr>
				<?php } ?>
			</tbody>
		</table>
	</div>
</div>