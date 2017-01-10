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
		<form action="?page=Laporan-Pelatihan" method="post">
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
		              <th width="149"><div align="center">No. Pelatihan</div></th>
		              <th width="417"><div align="left">Materi Pelatihan </div></th>
					  <th width="170"><div align="left">Instruktur</div></th>
		              <th width="166"><div align="left">Status</div></th>
					  <th width="189"><div align="left">Petugas</div></th>
			        </tr>
	          </thead>
				<?php
					$dataSql = "SELECT * FROM pelatihan 
								INNER JOIN materi ON pelatihan.kode_materi=materi.kode_materi 
								INNER JOIN user ON pelatihan.kd_user=user.kd_user
								LIMIT 10";
					if (isset($_POST['btnShow'])){							  
						$dataSql = "SELECT * FROM pelatihan 
									INNER JOIN materi ON pelatihan.kode_materi=materi.kode_materi
									INNER JOIN user ON pelatihan.kd_user=user.kd_user
									WHERE tanggal_pelatihan BETWEEN '".InggrisTgl($dataAwal)."' AND '".InggrisTgl($dataAkhir)."'";
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
					<td><div align="center"><?php echo $dataRow['no_pelatihan']; ?></div></td>
					<td><div align="left"><?php echo $dataRow['nama_materi']; ?></div></td>
					<td><div align="left"><?php echo $dataRow['instruktur']; ?></div></td>
					<td><div align="left"><?php echo $dataRow['status_pelatihan']; ?></div></td>
					<td align="center"><div align="left"><?php echo $dataRow['nm_user']; ?></div></td>
				</tr>
				<?php } ?>
			</tbody>
		</table>
	</div>
</div>