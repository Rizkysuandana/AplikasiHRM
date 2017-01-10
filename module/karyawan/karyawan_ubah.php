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
		<div class="panel-title"> Perubahan Data Karyawan</div>
	</div>
	<div class="content-box-large box-with-header">
	<?php
	include "config/inc.connection.php";
	include "config/inc.library.php";
	
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
			
			$txtLama		= $_POST['txtLama'];
			$txtNama		= $_POST['txtNama'];
			$txtTempat		= $_POST['txtTempat'];
			$txtTglLahir	= $_POST['txtTglLahir'];
			$txtAlamat		= $_POST['txtAlamat'];
			$cmbKelamin		= $_POST['cmbKelamin'];
			$cmbPerusahaan	= $_POST['cmbPerusahaan'];
			$cmbDepartment	= $_POST['cmbDepartment'];
			$cmbJabatan		= $_POST['cmbJabatan'];
			$txtTglMasuk	= $_POST['txtTglMasuk'];
			
			$sqlCek="SELECT * FROM karyawan WHERE nama_karyawan='$txtNama' AND NOT(nama_karyawan='$txtLama')";
			$qryCek=mysql_query($sqlCek, $koneksidb) or die ("Eror Query".mysql_error()); 
			if(mysql_num_rows($qryCek)>=1){
				$message[] = "Maaf, Nama Karyawan <b> $txtNama </b> sudah ada, ganti dengan yang lain";
			}
	
			if(count($message)==0){			
				$qrySave=mysql_query("UPDATE karyawan SET 		nama_karyawan='$txtNama',
																tempat_lahir='$txtTempat', 
																tanggal_lahir='$txtTglLahir',
																kelamin='$cmbKelamin',
																kode_perusahaan='$cmbPerusahaan',
																kode_department='$cmbDepartment',
																kode_jabatan='$cmbJabatan',
																tanggal_masuk='$txtTglMasuk'
														WHERE nik ='".$_POST['txtKode']."'") 
						   or die ("Gagal query update".mysql_error());
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
		
		$KodeEdit= isset($_GET['Kode']) ?  $_GET['Kode'] : $_POST['txtKode']; 
		$sqlShow = "SELECT * FROM karyawan WHERE nik='$KodeEdit'";
		$qryShow = mysql_query($sqlShow, $koneksidb)  or die ("Query ambil data karyawan salah : ".mysql_error());
		$dataShow= mysql_fetch_array($qryShow);
		
		$dataKode			= $dataShow['nik'];
		$dataNama			= isset($dataShow['nama_karyawan']) ?  $dataShow['nama_karyawan'] : $_POST['txtNama'];
		$dataLama			= $dataShow['nama_karyawan'];
		$dataTempat			= isset($dataShow['tempat_lahir']) ?  $dataShow['tempat_lahir'] : $_POST['txtTempat'];
		$dataTglLahir 		= isset($dataShow['tanggal_lahir']) ?  $dataShow['tanggal_lahir'] : $_POST['txtTglLahir'];
		$dataAlamat			= isset($dataShow['alamat']) ?  $dataShow['alamat'] : $_POST['txtAlamat'];
		$dataJenisKelamin	= isset($dataShow['kelamin']) ?  $dataShow['kelamin'] : $_POST['cmbKelamin'];
		$dataPerusahaan		= isset($dataShow['kode_perusahaan']) ?  $dataShow['kode_perusahaan'] : $_POST['cmbPerusahaan'];
		$dataDepartment		= isset($dataShow['kode_department']) ?  $dataShow['kode_department'] : $_POST['cmbDepartment'];
		$dataJabatan		= isset($dataShow['kode_jabatan']) ?  $dataShow['kode_jabatan'] : $_POST['cmbJabatan'];
		$dataTglMasuk		= isset($dataShow['tanggal_masuk']) ?  $dataShow['tanggal_masuk'] : $_POST['txtTglMasuk'];
		$dataTglBerakhir	= isset($dataShow['tanggal_berakhir']) ?  $dataShow['tanggal_berakhir'] : $_POST['txtTglBerakhir'];
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
					  <input name="txtLama" type="hidden" value="<?php echo $dataLama; ?>" />
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
					<button class="btn btn-warning" type="submit" name="btnSimpan">Simpan Perubahan</button>
				</div>
			</div>
		</div>	
		</form>
  	</div>
</div>