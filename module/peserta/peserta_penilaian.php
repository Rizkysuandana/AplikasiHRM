<div class="col-md-12 panel-warning">
	<div class="content-box-header panel-heading">
		<div class="panel-title"> Penambahan Jadwal Pelatihan</div>
	</div>
	<div class="content-box-large box-with-header">
	<?php
	include "./config/inc.connection.php";
	include "./config/inc.library.php";
	
	if($_GET) {
		if(isset($_GET['Act'])){
			if(trim($_GET['Act'])=="Sucsses"){
				echo "<div class='alert alert-dismissable alert-success'><i class='glyphicon glyphicon-ok'></i> Penilaian Pelatihan Berhasil Disimpan</div>";
			}
		}
		
		if($_POST) {
		if(isset($_POST['btnPilih'])){
			$message = array();
			if (trim($_POST['txtPeserta'])=="BLANK") {
				$message[] = "<b>Peserta belum diisi</b>, silahkan masukkan peserta terlebih dahulu!";		
			}
			if (trim($_POST['txtKehadiran'])=="BLANK") {
				$message[] = "<b>Kehadiran belum diisi</b>, silahkan masukkan status kehadiran terlebih dahulu!";		
			}
			
			$txtPeserta		= $_POST['txtPeserta'];
			$txtPeserta		= str_replace("'","&acute;",$txtPeserta);
			$txtKehadiran	= $_POST['txtKehadiran'];
			$txtKehadiran	= str_replace("'","&acute;",$txtKehadiran);
			$txtNilai		= $_POST['txtNilai'];
			$txtNilai		= str_replace("'","&acute;",$txtNilai);
			
			if(count($message)==0){			
					$tmpSql = "UPDATE peserta SET status_kehadiran='$txtKehadiran', nilai_pelatihan='$txtNilai' WHERE id_peserta='".$_POST['txtPeserta']."'";
					mysql_query($tmpSql, $koneksidb) or die ("Gagal Query detail karyawan : ".mysql_error());
			}
	
		}
		
		if(isset($_POST['btnSave'])){
			$message = array();
			if (trim($_POST['txtPelatihan'])=="BLANK") {
				$message[] = "<b>Materi pelatihan belum dipilih</b>, silahkan pilih lagi !";		
			}
			
			$txtPelatihan		= $_POST['txtPelatihan'];
			$txtPelatihan		= str_replace("'","&acute;",$txtPelatihan);
					
			if(count($message)==0){		
				$qrySave=mysql_query("UPDATE pelatihan SET status_pelatihan='Terlaksana' WHERE no_pelatihan='$txtPelatihan'") 
									  or die ("Gagal query".mysql_error());
				if($qrySave){				
					echo "<meta http-equiv='refresh' content='0; url=?page=Penilaian-Peserta&Act=Sucsses'>";
				}
				else{
					$message[] = "Gagal penyimpanan ke database";
				}
			}	
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
	} 
	
	$dataPelatihan 	= isset($_POST['txtPelatihan']) ? $_POST['txtPelatihan'] : '';
	
	?>
	<SCRIPT language="JavaScript">
	function submitform() {
		document.form1.submit();
	}
	</SCRIPT> 
	<form class="form-horizontal" action="<?php $_SERVER['PHP_SELF']; ?>" method="post" name="form1" target="_self">
		<i class="glyphicon glyphicon-book"></i> <b>Informasi Pelatihan</b><br />
		<small>Informasi lengkap  mengenai pelatihan</small>
		<hr />
		<div class="form-group">
			<label class="control-label col-md-2">No Pelatihan</label>
			<div class="col-sm-4">
					<select name="txtPelatihan" class="form-control" onchange="javascript:submitform();">
						<option value="BLANK">....</option>
						<?php
						$dataSql = "SELECT * FROM pelatihan WHERE status_pelatihan='Terjadwal' ORDER BY no_pelatihan ASC";
						$dataQry = mysql_query($dataSql, $koneksidb) or die ("Gagal Query".mysql_error());
						while ($dataRow = mysql_fetch_array($dataQry)) {
							if ($dataPelatihan == $dataRow['no_pelatihan']) {
							$cek = " selected";
						} else { $cek=""; }
						echo "<option value='$dataRow[no_pelatihan]' $cek> $dataRow[no_pelatihan]</option>";
						}
						$sqlData ="";
						?>
					</select>
			</div>
		</div>
		<hr />
		<i class="glyphicon glyphicon-book"></i> <b>Informasi Peserta</b><br />
		<small>Informasi lengkap  mengenai penilaian peserta pelatihan</small>
		<hr />
		<div class="form-group">
			<label class="control-label col-md-2">Nama Karyawan</label>
			<div class="col-sm-4">
					  <select name="txtPeserta" class="form-control">
						<option value="BLANK">....</option>
						<?php
						$dataSql = "SELECT * FROM peserta INNER JOIN karyawan ON peserta.nik=karyawan.nik
									WHERE peserta.no_pelatihan='$dataPelatihan' AND status_kehadiran='Kosong' ORDER BY id_peserta ASC";
						$dataQry = mysql_query($dataSql, $koneksidb) or die ("Gagal Query".mysql_error());
						while ($dataRow = mysql_fetch_array($dataQry)) {
							if ($dataPeserta == $dataRow['id_peserta']) {
							$cek = " selected";
						} else { $cek=""; }
						echo "<option value='$dataRow[id_peserta]' $cek>[ $dataRow[nik] ] $dataRow[nama_karyawan]</option>";
						}
						$sqlData ="";
						?>
					</select>
			</div>
		</div>
		<div class="form-group">
			<label class="control-label col-md-2">Kehadiran</label>
			<div class="col-sm-2">
				<select name="txtKehadiran" class="form-control">
				  <option value="BLANK">....</option>
				  <?php
				  $pilihan	= array("Tidak Masuk", "Masuk", "Izin", "Sakit");
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
				<div class="input-group form">
					<input type="text" name="txtNilai" class="form-control">
					<span class="input-group-btn">
						<button class="btn btn-default" type="submit" name="btnPilih">Simpan</button>
					</span>
				</div>
			</div>
		</div> 
		<hr />
		<button class="btn btn-warning" type="submit" name="btnSave">Simpan Penilaian</button>
		</form>		
  	</div>
</div>