<div class="col-md-12 panel-warning">
	<div class="content-box-header panel-heading">
		<div class="panel-title"> Perubahan Data Department</div>
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
			if (trim($_POST['txtLokasi'])=="") {
				$message[] = "<b>Lokasi Department</b> tidak boleh kosong !";		
			}
			if (trim($_POST['txtPhone'])=="") {
				$message[] = "<b>Line Phone department</b> tidak boleh kosong !";		
			}
			
			$txtLama		= $_POST['txtLama'];
			$txtNama		= $_POST['txtNama'];
			$txtNama		= str_replace("'","&acute;",$txtNama);
			$txtTugas		= $_POST['txtTugas'];
			$txtTugas		= str_replace("'","&acute;",$txtTugas);
			$txtLokasi		= $_POST['txtLokasi'];
			$txtLokasi		= str_replace("'","&acute;",$txtLokasi);
			$txtPhone		= $_POST['txtPhone'];
			$txtPhone		= str_replace("'","&acute;",$txtPhone);
			
			$sqlCek="SELECT * FROM department WHERE nama_department='$txtNama' AND NOT(nama_department='$txtLama')";
			$qryCek=mysql_query($sqlCek, $koneksidb) or die ("Eror Query".mysql_error()); 
			if(mysql_num_rows($qryCek)>=1){
				$message[] = "Maaf, Nama Department <b> $txtNama </b> sudah ada, ganti dengan yang lain";
			}
			
			
			if(count($message)==0){	
				$qryUpdate=mysql_query("UPDATE department SET    nama_department='$txtNama',
																 tugas_department='$txtTugas', 
																 lokasi_department='$txtLokasi',
																 phone='$txtPhone'
										WHERE kode_department ='".$_POST['txtKode']."'") 
						   or die ("Gagal query update".mysql_error());
				if($qryUpdate){
					echo "<meta http-equiv='refresh' content='0; url=?page=Data-Department'>";
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
		$sqlShow = "SELECT * FROM department WHERE kode_department='$KodeEdit'";
		$qryShow = mysql_query($sqlShow, $koneksidb)  or die ("Query ambil data department salah : ".mysql_error());
		$dataShow= mysql_fetch_array($qryShow);
		
		$dataKode		= $dataShow['kode_department'];
		$dataNama		= isset($dataShow['nama_department']) ?  $dataShow['nama_department'] : $_POST['txtNama'];
		$dataLama		= $dataShow['nama_department'];
		$dataTugas 		= isset($dataShow['tugas_department']) ?  $dataShow['tugas_department'] : $_POST['txtTugas'];
		$dataLokasi 	= isset($dataShow['lokasi_department']) ?  $dataShow['lokasi_department'] : $_POST['txtLokasi'];
		$dataPhone		= isset($dataShow['phone']) ?  $dataShow['phone'] : $_POST['txtPhone'];
	} 
	?>
	<form class="form-horizontal" action="<?php $_SERVER['PHP_SELF']; ?>" method="post" name="form1" target="_self">
		<i class="glyphicon glyphicon-book"></i> <b>Informasi Department</b><br />
		<small>Informasi lengkap  mengenai department karyawan</small>
		<hr />
		<div class="form-group">
			<label class="control-label col-md-2">Kode Department</label>
			<div class="col-sm-2">
					<input type="text" class="form-control" value="<?php echo $dataKode; ?>" readonly="readonly" name="textfield" />
					<input name="txtKode" type="hidden" value="<?php echo $dataKode; ?>" />
			</div>
		</div>
		<div class="form-group">
			<label class="control-label col-md-2">Nama Department</label>
			<div class="col-sm-4">
					  <input type="text" class="form-control" value="<?php echo $dataNama; ?>" name="txtNama" />
			</div>
		</div>
		<div class="form-group">
			<label class="control-label col-md-2">Tugas</label>
			<div class="col-sm-10">
					  <input type="text" class="form-control" value="<?php echo $dataTugas; ?>" name="txtTugas" autocomplete='off'/>
			</div>
		</div>
		<div class="form-group">
			<label class="control-label col-md-2">Lokasi Department</label>
			<div class="col-sm-4">
					  <input type="text" class="form-control" value="<?php echo $dataLokasi; ?>" name="txtLokasi" />
			</div>
		</div>
		<div class="form-group">
			<label class="control-label col-md-2">Line Phone</label>
			<div class="col-sm-2">
					  <input type="text" class="form-control" value="<?php echo $dataPhone; ?>" name="txtPhone" autocomplete='off'/>
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