<div class="col-md-12 panel-warning">
	<div class="content-box-header panel-heading">
		<div class="panel-title"> Penambahan Data Jabatan</div>
	</div>
	<div class="content-box-large box-with-header">
	<?php
	include "./config/inc.connection.php";
	include "./config/inc.library.php";
	
	if($_GET) {
		if(isset($_POST['btnSimpan'])){
			$message = array();
			if (trim($_POST['txtNama'])=="") {
				$message[] = "<b>Nama Department</b> tidak boleh kosong !";		
			}
			if (trim($_POST['txtTugas'])=="") {
				$message[] = "<b>Tugas Depart</b> tidak boleh kosong !";		
			}
			
			$txtNama		= $_POST['txtNama'];
			$txtNama		= str_replace("'","&acute;",$txtNama);
			$txtTugas		= $_POST['txtTugas'];
			$txtTugas		= str_replace("'","&acute;",$txtTugas);
			
			$sqlCek="SELECT * FROM jabatan WHERE nama_jabatan='$txtNama'";
			$qryCek=mysql_query($sqlCek, $koneksidb) or die ("Eror Query".mysql_error()); 
			if(mysql_num_rows($qryCek)>=1){
				$message[] = "Maaf, Nama Jabatan <b> $txtNama </b> sudah ada, ganti dengan yang lain";
			}
	
	
			if(count($message)==0){			
				$kodeBaru	= buatKode("jabatan", "JB");
				$qrySave=mysql_query("INSERT INTO jabatan SET kode_jabatan='$kodeBaru', 
																 nama_jabatan='$txtNama',
																 tugas='$txtTugas'") or die ("Gagal query".mysql_error());
				if($qrySave){
					echo "<meta http-equiv='refresh' content='0; url=?page=Data-Jabatan'>";
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
		
		$dataKode		= buatKode("jabatan", "JB");
		$dataNama		= isset($_POST['txtNama']) ? $_POST['txtNama'] : '';
		$dataTugas 		= isset($_POST['txtTugas']) ? $_POST['txtTugas'] : '';
	} 
	?>
	<form class="form-horizontal" action="<?php $_SERVER['PHP_SELF']; ?>" method="post" name="form1" target="_self">
		<i class="glyphicon glyphicon-book"></i> <b>Informasi Jabatan</b><br />
		<small>Informasi lengkap  mengenai jabatan karyawan</small>
		<hr />
		<div class="form-group">
			<label class="control-label col-md-2">Kode Jabatan</label>
			<div class="col-sm-2">
					<input type="text" class="form-control" value="<?php echo $dataKode; ?>" readonly="readonly" name="textfield" />
			</div>
		</div>
		<div class="form-group">
			<label class="control-label col-md-2">Nama Jabatan</label>
			<div class="col-sm-4">
					  <input type="text" class="form-control" value="<?php echo $dataNama; ?>" name="txtNama" autocomplete='off'/>
			</div>
		</div>
		<div class="form-group">
			<label class="control-label col-md-2">Tanggung Jawab</label>
			<div class="col-sm-10">
					  <input type="text" class="form-control" value="<?php echo $dataTugas; ?>" name="txtTugas" autocomplete='off'/>
			</div>
		</div>
		<hr />
		<div class="form-actions">
			<div class="row">
				<div class="col-md-5">
					<button class="btn btn-warning" type="submit" name="btnSimpan">Simpan Data</button>
					<button class="btn btn-danger" type="reset">Batalkan</button>
				</div>
			</div>
		</div>					
	</form>	
  	</div>
</div>