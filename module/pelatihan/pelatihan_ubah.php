<head> 
<script type="text/javascript" src="./js/jquery-1.3.2.js"></script>
<script type="text/javascript" src="./js/ui.core.js"></script>
<script type="text/javascript" src="./js/ui.datepicker.js"></script>
<script type="text/javascript"> 
      $(document).ready(function(){
        $("#tanggal").datepicker({
		dateFormat  : "dd-mm-yy", 
          changeMonth : true,
          changeYear  : true
		  
        });
      });
	  
    </script>
</head>
<div class="col-md-12 panel-warning">
	<div class="content-box-header panel-heading">
		<div class="panel-title"> Perubahan Data Jadwal Pelatihan</div>
	</div>
	<div class="content-box-large box-with-header">
	<?php
	include "config/inc.connection.php";
	include "config/inc.library.php";
	
	if($_GET) {
		if(isset($_POST['btnSimpan'])){
			$message = array();
			if (trim($_POST['txtKode'])=="") {
				$message[] = "<b>No. Pelatihan</b> tidak boleh kosong !";		
			}
			if (trim($_POST['txtTanggal'])=="") {
				$message[] = "<b>Tgl. Pelatihan</b> tidak boleh kosong !";		
			}
			if (trim($_POST['txtMateri'])=="") {
				$message[] = "<b>Materi pelatihan</b> tidak boleh kosong !";		
			}
		
			$txtMateri		= $_POST['txtMateri'];
			$txtMateri		= str_replace("'","&acute;",$txtMateri);
			$txtTanggal		= $_POST['txtTanggal'];
			$txtTanggal		= str_replace("'","&acute;",$txtTanggal);
			
			
			if(count($message)==0){	
				$qryUpdate=mysql_query("UPDATE pelatihan SET    tanggal_pelatihan='".InggrisTgl($txtTanggal)."',
																 kode_materi='$txtMateri'
										WHERE no_pelatihan ='".$_POST['txtKode']."'") 
						   or die ("Gagal query update".mysql_error());
				if($qryUpdate){
					echo "<meta http-equiv='refresh' content='0; url=?page=Data-Pelatihan'>";
				}
				exit;
			}	
			
			if (! count($message)==0 ){
				echo "<div class='alert alert-dismissable alert-warning'>";
					$Num=0;
					foreach ($message as $indeks=>$pesan_tampil) { 
					$Num++;
						echo "&nbsp;&nbsp;$Num. $pesan_tampil<br>";	
					} 
				echo "</div>"; 
			}
		} 
		
		$KodeEdit= isset($_GET['Kode']) ?  $_GET['Kode'] : $_POST['txtKode']; 
		$sqlShow = "SELECT * FROM pelatihan WHERE no_pelatihan='$KodeEdit'";
		$qryShow = mysql_query($sqlShow, $koneksidb)  or die ("Query ambil data materi salah : ".mysql_error());
		$dataShow= mysql_fetch_array($qryShow);
		
		$dataKode			= $dataShow['no_pelatihan'];
		$dataMateri			= isset($dataShow['kode_materi']) ?  $dataShow['kode_materi'] : $_POST['txtMateri'];
		$dataTanggal	 	= isset($dataShow['tanggal_pelatihan']) ?  $dataShow['tanggal_pelatihan'] : $_POST['txtTanggal'];
	} 
	?>
	<form class="form-horizontal" action="<?php $_SERVER['PHP_SELF']; ?>" method="post" name="form1" target="_self">
		<i class="glyphicon glyphicon-book"></i> <b>Informasi Pelatihan</b><br />
		<small>Informasi lengkap  mengenai perubahan jadwal pelatihan</small>
		<hr />
		<div class="form-group">
			<label class="control-label col-md-2">No. Pelatihan</label>
			<div class="col-sm-2">
					<input type="text" class="form-control" value="<?php echo $dataKode; ?>" readonly="readonly" name="textfield" />
					<input name="txtKode" type="hidden" value="<?php echo $dataKode; ?>" />
			</div>
		</div>
		<div class="form-group">
			<label class="control-label col-md-2">Tgl. Pelatihan</label>
			<div class="col-sm-2">
					  <input type="text" class="form-control" value="<?php echo IndonesiaTgl($dataTanggal); ?>" name="txtTanggal" id="tanggal"/>
			</div>
		</div>
		<div class="form-group">
			<label class="control-label col-md-2">Materi Pelatihan</label>
			<div class="col-sm-4">
					<select name="txtMateri" class="form-control">
						<option value="BLANK">....</option>
						<?php
						$dataSql = "SELECT * FROM materi ORDER BY kode_materi";
						$dataQry = mysql_query($dataSql, $koneksidb) or die ("Gagal Query".mysql_error());
						while ($dataRow = mysql_fetch_array($dataQry)) {
							if ($dataMateri == $dataRow['kode_materi']) {
							$cek = " selected";
						} else { $cek=""; }
						echo "<option value='$dataRow[kode_materi]' $cek> $dataRow[nama_materi]</option>";
						}
						$sqlData ="";
						?>
					</select>
			</div>
		</div>
		<hr />
		<div class="form-actions">
			<div class="row">
				<div class="col-md-5">
					<button class="btn btn-warning" type="submit" name="btnSimpan">Simpan Perubahan</button>
				</div>
			</div>
		</div>					
	</form>
  	</div>
</div>