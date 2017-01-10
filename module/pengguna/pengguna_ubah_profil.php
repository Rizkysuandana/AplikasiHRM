<div class="col-md-12 panel-warning">
	<div class="content-box-header panel-heading">
		<div class="panel-title"> Perubahan Data Pengguna</div>
	</div>
	<div class="content-box-large box-with-header">
<?php
include "./config/inc.connection.php";

if(isset($_POST['btnSimpan'])){
	$pesanError = array();
	if (trim($_POST['txtKode'])=="") {
		$pesanError[] = "Data <b>Kode User </b> tidak terbaca !";		
	}
	if (trim($_POST['txtNamaUser'])=="") {
		$pesanError[] = "Data <b>Nama User</b> tidak boleh kosong !";		
	}
	if (trim($_POST['txtTelpon'])=="") {
		$pesanError[] = "Data <b>No. Telpon</b> tidak boleh kosong !";		
	}
	if (trim($_POST['txtUsername'])=="") {
		$pesanError[] = "Data <b>Username</b> tidak boleh kosong !";		
	}
						
	$txtNamaUser= $_POST['txtNamaUser'];
	$txtUsername= $_POST['txtUsername'];
	$txtPassword= $_POST['txtPassword'];
	$txtTelpon	= $_POST['txtTelpon'];	
	
	$cekSql="SELECT * FROM user WHERE username='$txtUsername' AND NOT(username='".$_POST['txtUsernameLm']."')";
	$cekQry=mysql_query($cekSql, $koneksidb) or die ("Eror Query".mysql_error()); 
	if(mysql_num_rows($cekQry)>=1){
		$pesanError[] = "USERNAME <b> $txtUsername </b> SUDAH ADA, ganti dengan yang lain";
	}

	if (count($pesanError)>=1 ){
		echo "<div class='alert alert-dismissable alert-warning'>";
			$noPesan=0;
			foreach ($pesanError as $indeks=>$pesan_tampil) { 
			$noPesan++;
				echo "&nbsp;&nbsp; $noPesan. $pesan_tampil<br>";
			} 
		echo "</div> <br>"; 
	}
	else {
		if (trim($txtPassword)=="") {
			$sqlSub = " password='".$_POST['txtPasswordLm']."'";
		}
		else {
			$sqlSub = "  password ='".md5($txtPassword)."'";
		}
		
		
		$mySql  = "UPDATE user SET nm_user='$txtNamaUser', username='$txtUsername', 
					no_telepon='$txtTelpon', $sqlSub  WHERE kd_user='".$_POST['txtKode']."'";
		$myQry=mysql_query($mySql, $koneksidb) or die ("Gagal query".mysql_error());
		if($myQry){
			echo "<meta http-equiv='refresh' content='0; url=?page=Data-Pengguna'>";
		}
		exit;
	}	
} 
if($_GET) { 
	$mySql = "SELECT * FROM user WHERE kd_user='".$_SESSION['kd_user']."'";
	$myQry = mysql_query($mySql, $koneksidb)  or die ("Query ambil data salah : ".mysql_error());
		$myData = mysql_fetch_array($myQry);
		
		// Masukkan data ke dalam variabel
		$dataKode	= $myData['kd_user'];
		$dataNamaUser	= isset($_POST['txtNamaUser']) ? $_POST['txtNamaUser'] : $myData['nm_user'];
		$dataUsername	= isset($_POST['txtUsername']) ? $_POST['txtUsername'] : $myData['username'];
		$dataUsernameLm	= $myData['username'];
		$dataPasswordLm	= $myData['password'];
		$dataTelpon		= isset($_POST['txtTelpon']) ? $_POST['txtTelpon'] : $myData['no_telepon']; 
} 
?>
		<form class="form-horizontal" action="<?php $_SERVER['PHP_SELF']; ?>" method="post" name="form1" target="_self">
		<i class="glyphicon glyphicon-book"></i> <b>Informasi Pengguna</b><br />
		<small>Informasi lengkap  mengenai pengguna aplikasi</small>
		<hr />
		<div class="form-group">
			<label for="inputEmail3" class="col-sm-2 control-label">Kode Pengguna</label>
			<div class="col-sm-3">
				<input type="text" class="form-control" value="<?php echo $dataKode; ?>" readonly="readonly" name="textfield">
				<input name="txtKode" type="hidden" value="<?php echo $dataKode; ?>" />
			</div>
		</div>
		<div class="form-group">
			<label for="inputPassword3" class="col-sm-2 control-label">Nama Lengkap </label>
			<div class="col-sm-5">
				<input name="txtNamaUser" type="text" value="<?php echo $dataNamaUser; ?>" class="form-control">
			</div>
		</div>
		<div class="form-group">
			<label for="inputPassword3" class="col-sm-2 control-label">No Telp</label>
			<div class="col-sm-5">
				<input name="txtTelpon" type="text" value="<?php echo $dataTelpon; ?>" class="form-control">
			</div>
		</div>
		<div class="form-group">
			<label for="inputPassword3" class="col-sm-2 control-label">Username</label>
			<div class="col-sm-5">
				<input name="txtUsername" type="text"  value="<?php echo $dataUsername; ?>" class="form-control">
				<input name="txtUsernameLm" type="hidden" value="<?php echo $dataUsernameLm; ?>" />
			</div>
		</div>
		<div class="form-group">
			<label for="inputPassword3" class="col-sm-2 control-label">Password</label>
			<div class="col-sm-5">
				<input type="password" class="form-control" placeholder="Kosongkan apabila tidak diubah" name="txtPassword">
				<input name="txtPasswordLm" type="hidden" value="<?php echo $dataPasswordLm; ?>" />
			</div>
		</div>
		<hr />
		<div class="form-actions">
			<div class="row">
				<div class="col-md-5">
					<button class="btn btn-info" type="submit" name="btnSimpan">Simpan Perubahan</button>
				</div>
			</div>
		</div>
		</form>
	</div>
</div>