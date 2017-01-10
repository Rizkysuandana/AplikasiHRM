<head> 
<script type="text/javascript" src="./js/jquery-1.3.2.js"></script>
<script type="text/javascript" src="./js/ui.core.js"></script>
<script type="text/javascript" src="./js/ui.datepicker.js"></script>
<script type="text/javascript"> 
      $(document).ready(function(){
        $("#tglLahir").datepicker({
			dateFormat  : "yy-mm-dd", 
          	changeMonth : true,
          	changeYear  : true 
        });
		 $("#tglMasuk").datepicker({
			dateFormat  : "yy-mm-dd", 
          	changeMonth : true,
          	changeYear  : true  
        });
		$("#tglBerakhir").datepicker({
			dateFormat  : "yy-mm-dd", 
          	changeMonth : true,
          	changeYear  : true
        });
      });
</script>
</head>
<div class="col-md-12 panel-warning">
	<div class="content-box-header panel-heading">
		<div class="panel-title"> Penambahan Data Karyawan</div>
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
			if (trim($_POST['txtAlamat'])=="") {
				$message[] = "<b>Jenis Perusahaan</b> tidak boleh kosong !";		
			}
			if (trim($_POST['txtTempat'])=="") {
				$message[] = "<b>Tempat Lahir</b> tidak boleh kosong !";		
			}
			if (trim($_POST['cmbKelamin'])=="BLANK") {
				$message[] = "<b>Jenis Kelamin</b> tidak boleh kosong !";		
			}
			if (trim($_POST['cmbPerusahaan'])=="BLANK") {
				$message[] = "<b>Data Perusahaan</b> tidak boleh kosong !";		
			}
			if (trim($_POST['cmbDepartment'])=="BLANK") {
				$message[] = "<b>Data Department</b> tidak boleh kosong !";		
			}
			if (trim($_POST['cmbJabatan'])=="BLANK") {
				$message[] = "<b>Data Jabatan</b> tidak boleh kosong !";		
			}
			if (trim($_POST['txtAlamat'])=="") {
				$message[] = "<b>Alamat Perusahaan</b> tidak boleh kosong !";		
			}
			
			$txtNama		= $_POST['txtNama'];
			$txtTempat		= $_POST['txtTempat'];
			$txtTglLahir	= $_POST['txtTglLahir'];
			$txtAlamat		= $_POST['txtAlamat'];
			$cmbKelamin		= $_POST['cmbKelamin'];
			$cmbPerusahaan	= $_POST['cmbPerusahaan'];
			$cmbDepartment	= $_POST['cmbDepartment'];
			$cmbJabatan		= $_POST['cmbJabatan'];
			$txtTglMasuk	= $_POST['txtTglMasuk'];
			$txtTglBerakhir	= $_POST['txtTglBerakhir'];
	
			if(count($message)==0){			
				$kodeBaru	= buatKode("karyawan", "KR7");
				$qrySave=mysql_query("INSERT INTO karyawan SET nik='$kodeBaru', 
																nama_karyawan='$txtNama',
																tempat_lahir='$txtTempat', 
																tanggal_lahir='$txtTglLahir',
																kelamin='$cmbKelamin',
																kode_perusahaan='$cmbPerusahaan',
																kode_department='$cmbDepartment',
																kode_jabatan='$cmbJabatan',
																tanggal_masuk='$txtTglMasuk',
																tanggal_berakhir='$txtTglBerakhir',
																alamat='$txtAlamat'") or die ("Gagal query".mysql_error());
				if($qrySave){
					echo "<meta http-equiv='refresh' content='0; url=?page=Data-Karyawan'>";
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
		
		$dataKode			= buatKode("karyawan", "KR7");
		$dataNama			= isset($_POST['txtNama']) ? $_POST['txtNama'] : '';
		$dataTempat			= isset($_POST['txtTempat']) ? $_POST['txtTempat'] : '';
		$dataTglLahir 		= isset($_POST['txtTglLahir']) ? $_POST['txtTglLahir'] : date('Y-m-d');
		$dataAlamat			= isset($_POST['txtAlamat']) ? $_POST['txtAlamat'] : '';
		$dataJenisKelamin	= isset($_POST['cmbKelamin']) ? $_POST['cmbKelamin'] : '';
		$dataPerusahaan		= isset($_POST['cmbPerusahan']) ? $_POST['cmbPerusahan'] : '';
		$dataDepartment		= isset($_POST['cmbDepartment']) ? $_POST['cmbDepartment'] : '';
		$dataJabatan		= isset($_POST['cmbJabatan']) ? $_POST['cmbJabatan'] : '';
		$dataTglMasuk		= isset($_POST['txtTglMasuk']) ? $_POST['txtTglMasuk'] : date('Y-m-d');
		$dataTglBerakhir	= isset($_POST['txtTglBerakhir']) ? $_POST['txtTglBerakhir'] : '';
	} 
	?>
	<form class="form-horizontal" action="<?php $_SERVER['PHP_SELF']; ?>" method="post" name="form1" target="_self">
		<i class="glyphicon glyphicon-book"></i> <b>Informasi Pribadi</b><br />
		<small>Informasi lengkap  mengenai pribadi karyawan</small>
		<hr />
		<div class="form-group">
			<label class="control-label col-md-2">No. Karyawan</label>
			<div class="col-sm-2">
				<input type="text" class="form-control" value="<?php echo $dataKode; ?>" readonly="readonly" name="textfield" />
			</div>
		</div>
		<div class="form-group">
			<label class="control-label col-md-2">Nama Karyawan</label>
			<div class="col-sm-5">
				<input type="text" class="form-control" value="<?php echo $dataNama; ?>" name="txtNama" autocomplete='off'/>
			</div>
		</div>
		<div class="form-group">
			<label class="control-label col-md-2">Tempat, Tgl. Lahir</label>
			<div class="col-sm-3">
				<input type="text" class="form-control" value="<?php echo $dataTempat; ?>" name="txtTempat" autocomplete='off'/>
			</div>
			<div class="col-sm-2">
				<input type="text" class="form-control" value="<?php echo $dataTglLahir; ?>" name="txtTglLahir" id="tglLahir" />
			</div>
		</div>
		<div class="form-group">
			<label class="control-label col-md-2">Jenis Kelamin</label>
			<div class="col-sm-2">
					 <select name="cmbKelamin" class="form-control">
						<option value="BLANK">....</option>
						<?php
						$pilihan	= array("Pria", "Wanita");
						foreach ($pilihan as $nilai) {
							if ($dataJenisKelamin==$nilai) {
								$cek=" selected";
							} else { $cek = ""; }
							echo "<option value='$nilai' $cek>$nilai</option>";
							}
						?>
					</select>
			</div>
		</div>
		<div class="form-group">
			<label class="control-label col-md-2">Alamat Karyawan</label>
			<div class="col-sm-10">
				<input type="text" class="form-control" value="<?php echo $dataAlamat; ?>" name="txtAlamat" autocomplete='off'/>
			</div>
		</div>
		<hr />
		<i class="glyphicon glyphicon-book"></i> <b>Informasi Pekerjaan</b><br />
		<small>Informasi lengkap  mengenai pekerjaan karyawan</small>
		<hr />
		<div class="form-group">
			<label class="control-label col-md-2">Perusahaan</label>
			<div class="col-sm-4">
					  <select name="cmbPerusahaan" class="form-control">
						<option value="BLANK">....</option>
						<?php
						$dataSql = "SELECT * FROM perusahaan ORDER BY kode_perusahaan";
						$dataQry = mysql_query($dataSql, $koneksidb) or die ("Gagal Query".mysql_error());
						while ($dataRow = mysql_fetch_array($dataQry)) {
							if ($dataPerusahaan == $dataRow['kode_perusahaan']) {
							$cek = " selected";
							} else { $cek=""; }
							echo "<option value='$dataRow[kode_perusahaan]' $cek>$dataRow[nama_perusahaan]</option>";
							}
						$sqlData ="";
						?>
						</select>
				</div>
			</div>
		<div class="form-group">
			<label class="control-label col-md-2">Department</label>
			<div class="col-sm-4">
					  <select name="cmbDepartment" class="form-control">
						<option value="BLANK">....</option>
						<?php
						$dataSql = "SELECT * FROM department ORDER BY kode_department";
						$dataQry = mysql_query($dataSql, $koneksidb) or die ("Gagal Query".mysql_error());
						while ($dataRow = mysql_fetch_array($dataQry)) {
							if ($dataDepartment == $dataRow['kode_department']) {
							$cek = " selected";
							} else { $cek=""; }
							echo "<option value='$dataRow[kode_department]' $cek>$dataRow[nama_department]</option>";
							}
						$sqlData ="";
						?>
						</select>
			</div>
		</div>
		<div class="form-group">
			<label class="control-label col-md-2">Jabatan</label>
			<div class="col-sm-4">
					  <select name="cmbJabatan" class="form-control">
						<option value="BLANK">....</option>
						<?php
						$dataSql = "SELECT * FROM jabatan ORDER BY kode_jabatan";
						$dataQry = mysql_query($dataSql, $koneksidb) or die ("Gagal Query".mysql_error());
						while ($dataRow = mysql_fetch_array($dataQry)) {
							if ($dataJabatan == $dataRow['kode_jabatan']) {
							$cek = " selected";
							} else { $cek=""; }
							echo "<option value='$dataRow[kode_jabatan]' $cek>$dataRow[nama_jabatan]</option>";
							}
						$sqlData ="";
						?>
						</select>
			</div>
		</div>
		<div class="form-group">
			<label class="control-label col-md-2">Tgl. Masuk / Keluar</label>
			<div class="col-sm-2">
				<input type="text" class="form-control" value="<?php echo $dataTglMasuk; ?>" name="txtTglMasuk" id="tglMasuk" />
			</div>
			<div class="col-sm-2">
				<input type="text" class="form-control" value="<?php echo $dataTglBerakhir; ?>" name="txtTglBerakhir" id="tglBerakhir" />
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