<div class="col-md-12 panel-warning">
	<div class="content-box-header panel-heading">
		<div class="panel-title"> Penambahan Data Materi Pelatihan</div>
	</div>
	<div class="content-box-large box-with-header">
	<?php
	include "./config/inc.connection.php";
	include "./config/inc.library.php";
	
	if($_GET) {
		if(isset($_POST['btnSimpan'])){
			$message = array();
			if (trim($_POST['txtNama'])=="") {
				$message[] = "<b>Nama Perusahaan</b> tidak boleh kosong !";		
			}
			if (trim($_POST['txtKeterangan'])=="") {
				$message[] = "<b>Keterangan</b> tidak boleh kosong !";		
			}
			if (trim($_POST['txtPemateri'])=="") {
				$message[] = "<b>Nama Instruktur</b> tidak boleh kosong !";		
			}
			
			$txtNama		= $_POST['txtNama'];
			$txtNama		= str_replace("'","&acute;",$txtNama);
			$txtKeterangan	= $_POST['txtKeterangan'];
			$txtKeterangan	= str_replace("'","&acute;",$txtKeterangan);
			$txtPemateri	= $_POST['txtPemateri'];
			$txtPemateri	= str_replace("'","&acute;",$txtPemateri);
			
			$sqlCek="SELECT * FROM materi WHERE nama_materi='$txtNama'";
			$qryCek=mysql_query($sqlCek, $koneksidb) or die ("Eror Query".mysql_error()); 
			if(mysql_num_rows($qryCek)>=1){
				$message[] = "Maaf, Nama Materi <b> $txtNama </b> sudah ada, ganti dengan yang lain";
			}
	
	
			if(count($message)==0){			
				$kodeBaru	= buatKode("materi", "MT");
				$qrySave=mysql_query("INSERT INTO materi SET kode_materi='$kodeBaru', nama_materi='$txtNama',
									  keterangan='$txtKeterangan', instruktur='$txtPemateri'") or die ("Gagal query".mysql_error());
				if($qrySave){
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
		
		$dataKode		= buatKode("materi", "MT");
		$dataNama		= isset($_POST['txtNama']) ? $_POST['txtNama'] : '';
		$dataKeterangan = isset($_POST['txtKeterangan']) ? $_POST['txtKeterangan'] : '';
		$dataPemateri	= isset($_POST['txtPemateri']) ? $_POST['txtPemateri'] : '';
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
			</div>
		</div>
		<div class="form-group">
			<label class="control-label col-md-2">Materi Pelatihan</label>
			<div class="col-sm-4">
					  <input type="text" class="form-control" value="<?php echo $dataNama; ?>" name="txtNama" autocomplete='off'/>
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
					  <input type="text" class="form-control" value="<?php echo $dataPemateri; ?>" name="txtPemateri" />
			</div>
		</div>
		<hr />
		<div class="form-actions">
			<div class="row">
				<div class="col-md-5">
					<button class="btn btn-warning" type="submit" name="btnSimpan">Simpan Data</button>
					<button class="btn btn-info" type="reset">Batalkan</button>
				</div>
			</div>
		</div>					
		</form>
  	</div>
</div>