<div class="col-md-12 panel-warning">
	<div class="content-box-header panel-heading">
		<div class="panel-title"> Perubahan Nilai Pelatihan</div>
	</div>
	<div class="content-box-large box-with-header">
	<?php
	include "config/inc.connection.php";
	include "config/inc.library.php";
	
	if($_GET) {
		if(isset($_POST['btnSimpan'])){
			$message = array();
			if (trim($_POST['txtKode'])=="") {
				$message[] = "<b>Nama Department</b> tidak boleh kosong !";		
			}

			$txtKehadiran		= $_POST['txtKehadiran'];
			$txtKehadiran		= str_replace("'","&acute;",$txtKehadiran);
			$txtNilai			= $_POST['txtNilai'];
			$txtNilai			= str_replace("'","&acute;",$txtNilai);
			
			
			if(count($message)==0){	
				$qryUpdate=mysql_query("UPDATE peserta SET  nilai_pelatihan='$txtNilai', 
															status_kehadiran='$txtKehadiran'
										WHERE id_peserta ='".$_POST['txtKode']."'") 
						   or die ("Gagal query update".mysql_error());
				if($qryUpdate){
					echo "<meta http-equiv='refresh' content='0; url=?page=Data-Peserta'>";
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
		$sqlShow = "SELECT * FROM peserta INNER JOIN karyawan ON peserta.nik=karyawan.nik WHERE id_peserta='$KodeEdit'";
		$qryShow = mysql_query($sqlShow, $koneksidb)  or die ("Query ambil data materi salah : ".mysql_error());
		$dataShow= mysql_fetch_array($qryShow);
		
		$dataKode			= $dataShow['id_peserta'];
		$dataNama			= $dataShow['nama_karyawan'];
		$dataNilai		 	= isset($dataShow['nilai_pelatihan']) ?  $dataShow['nilai_pelatihan'] : $_POST['txtNilai'];
		$dataKehadiran	 	= isset($dataShow['status_kehadiran']) ?  $dataShow['status_kehadiran'] : $_POST['txtKehadiran'];
	} 
	?>
	<form class="form-horizontal" action="<?php $_SERVER['PHP_SELF']; ?>" method="post" name="form1" target="_self">
		<i class="glyphicon glyphicon-book"></i> <b>Informasi Materi</b><br />
		<small>Informasi lengkap  mengenai materi pelatihan</small>
		<hr />
		<div class="form-group">
			<label class="control-label col-md-2">ID Peserta</label>
			<div class="col-sm-2">
					<input type="text" class="form-control" value="<?php echo $dataKode; ?>" readonly="readonly" name="textfield" />
					<input name="txtKode" type="hidden" value="<?php echo $dataKode; ?>" />
			</div>
		</div>
		<div class="form-group">
			<label class="control-label col-md-2">Nama Peserta</label>
			<div class="col-sm-4">
					  <input type="text" class="form-control" value="<?php echo $dataNama; ?>"/>
			</div>
		</div>
		<div class="form-group">
			<label class="control-label col-md-2">Kehadiran</label>
			<div class="col-sm-2">
				<select name="txtKehadiran" class="form-control">
				  <option value="BLANK">....</option>
				  <?php
				  $pilihan	= array("Kosong", "Tidak Masuk", "Masuk", "Izin", "Sakit");
				  foreach ($pilihan as $nilai) {
					if ($dataKehadiran==$nilai) {
						$cek=" selected";
					} else { $cek = ""; }
					echo "<option value='$nilai' $cek>$nilai</option>";
				  }
				  ?>
				</select>
			</div>
		</div>
		<div class="form-group">
			<label class="control-label col-md-2">Nilai</label>
			<div class="col-sm-2">
			<input type="text" class="form-control" name="txtNilai" value="<?php echo $dataNilai; ?>"/>
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