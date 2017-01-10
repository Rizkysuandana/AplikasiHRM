<div class="col-md-12 panel-warning">
	<div class="content-box-header panel-heading">
		<div class="panel-title"> Perubahan Data Materi Pelatihan</div>
	</div>
	<div class="content-box-large box-with-header">
	<?php
	include "config/inc.connection.php";
	include "config/inc.library.php";
	
	if($_GET) {
		if(isset($_POST['btnSimpan'])){
			$message = array();
			if (trim($_POST['txtNama'])=="") {
				$message[] = "<b>Nama Department</b> tidak boleh kosong !";		
			}
			if (trim($_POST['txtKeterangan'])=="") {
				$message[] = "<b>Keterangan</b> tidak boleh kosong !";		
			}
			if (trim($_POST['txtInstruktur'])=="") {
				$message[] = "<b>Instruktur</b> tidak boleh kosong !";		
			}
		
			$txtLama		= $_POST['txtLama'];
			$txtNama		= $_POST['txtNama'];
			$txtNama		= str_replace("'","&acute;",$txtNama);
			$txtKeterangan	= $_POST['txtKeterangan'];
			$txtKeterangan		= str_replace("'","&acute;",$txtKeterangan);
			$txtInstruktur		= $_POST['txtInstruktur'];
			$txtInstruktur		= str_replace("'","&acute;",$txtInstruktur);
			
			$sqlCek="SELECT * FROM materi WHERE nama_materi='$txtNama' AND NOT(nama_materi='$txtLama')";
			$qryCek=mysql_query($sqlCek, $koneksidb) or die ("Eror Query".mysql_error()); 
			if(mysql_num_rows($qryCek)>=1){
				$message[] = "Maaf, Nama Materi <b> $txtNama </b> sudah ada, ganti dengan yang lain";
			}
			
			
			if(count($message)==0){	
				$qryUpdate=mysql_query("UPDATE materi SET    nama_materi='$txtNama',
																 keterangan='$txtKeterangan', 
																 instruktur='$txtInstruktur'
										WHERE kode_materi ='".$_POST['txtKode']."'") 
						   or die ("Gagal query update".mysql_error());
				if($qryUpdate){
					echo "<meta http-equiv='refresh' content='0; url=?page=Data-Materi'>";
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
		$sqlShow = "SELECT * FROM materi WHERE kode_materi='$KodeEdit'";
		$qryShow = mysql_query($sqlShow, $koneksidb)  or die ("Query ambil data materi salah : ".mysql_error());
		$dataShow= mysql_fetch_array($qryShow);
		
		$dataKode			= $dataShow['kode_materi'];
		$dataNama			= isset($dataShow['nama_materi']) ?  $dataShow['nama_materi'] : $_POST['txtNama'];
		$dataLama			= $dataShow['nama_materi'];
		$dataKeterangan 	= isset($dataShow['keterangan']) ?  $dataShow['keterangan'] : $_POST['txtKeterangan'];
		$dataInstruktur 	= isset($dataShow['instruktur']) ?  $dataShow['instruktur'] : $_POST['txtInstruktur'];
	} 
	?>
	<form class="form-horizontal" action="<?php $_SERVER['PHP_SELF']; ?>" method="post" name="form1" target="_self">
		<i class="glyphicon glyphicon-book"></i> <b>Informasi Materi</b><br />
		<small>Informasi lengkap  mengenai materi pelatihan</small>
		<hr />
		<div class="form-group">
			<label class="control-label col-md-2">Kode Materi</label>
			<div class="col-sm-2">
					<input type="text" class="form-control" value="<?php echo $dataKode; ?>" readonly="readonly" name="textfield" />
					<input name="txtKode" type="hidden" value="<?php echo $dataKode; ?>" />
			</div>
		</div>
		<div class="form-group">
			<label class="control-label col-md-2">Materi Pelatihan</label>
			<div class="col-sm-4">
					  <input type="text" class="form-control" value="<?php echo $dataNama; ?>" name="txtNama" />
					  <input type="hidden" class="form-control" value="<?php echo $dataLama; ?>" name="txtLama" />
			</div>
		</div>
		<div class="form-group">
			<label class="control-label col-md-2">Keterangan</label>
			<div class="col-sm-9">
					  <input type="text" class="form-control" value="<?php echo $dataKeterangan; ?>" name="txtKeterangan" autocomplete='off'/>
			</div>
		</div>
		<div class="form-group">
			<label class="control-label col-md-2">Instruktur</label>
			<div class="col-sm-4">
					  <input type="text" class="form-control" value="<?php echo $dataInstruktur; ?>" name="txtInstruktur" />
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