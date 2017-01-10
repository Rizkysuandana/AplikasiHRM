<div class="col-md-12 panel-warning">
	<div class="content-box-header panel-heading">
		<div class="panel-title"> Penambahan Data Pengguna</div>
	</div>
	<div class="content-box-large box-with-header">
	<?php
	include "./config/inc.connection.php";
	include "./config/inc.library.php";
	
	if(isset($_POST['btnSimpan'])){
		$pesanError = array();
		if (trim($_POST['txtNamaUser'])=="") {
			$pesanError[] = "Data <b>Nama User</b> tidak boleh kosong !";		
		}
		if (trim($_POST['txtTelpon'])=="") {
			$pesanError[] = "Data <b>No. Telpon</b> tidak boleh kosong !";		
		}
		if (trim($_POST['txtUsername'])=="") {
			$pesanError[] = "Data <b>Username</b> tidak boleh kosong !";		
		}
		if (trim($_POST['txtPassword'])=="") {
			$pesanError[] = "Data <b>Password</b> tidak boleh kosong !";		
		}
		if (trim($_POST['cmbLevel'])=="BLANK") {
			$pesanError[] = "Data <b>Level login</b> belum dipilih !";		
		}
				
		$txtNamaUser= $_POST['txtNamaUser'];
		$txtUsername= $_POST['txtUsername'];
		$txtPassword= $_POST['txtPassword'];
		$txtTelpon	= $_POST['txtTelpon'];
		$cmbLevel	= $_POST['cmbLevel'];
		
		$cekSql="SELECT * FROM user WHERE username='$txtUsername'";
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
			$kodeBaru	= buatKode("user", "U");
			$mySql  	= "INSERT INTO user (kd_user, nm_user, no_telepon, 
											 username, password, level)
							VALUES ('$kodeBaru', 
									'$txtNamaUser', 
									'$txtTelpon', 
									'$txtUsername', 
									'".md5($txtPassword)."', 
									'$cmbLevel')";
			$myQry=mysql_query($mySql, $koneksidb) or die ("Gagal query".mysql_error());
			if($myQry){
				echo "<meta http-equiv='refresh' content='0; url=?page=Data-Pengguna'>";
			}
			exit;
		}	
	} 
	$dataKode		= buatKode("user", "U");
	$dataNamaUser	= isset($_POST['txtNamaUser']) ? $_POST['txtNamaUser'] : '';
	$dataUsername	= isset($_POST['txtUsername']) ? $_POST['txtUsername'] : '';
	$dataTelpon		= isset($_POST['txtTelpon']) ? $_POST['txtTelpon'] : '';
	$dataLevel		= isset($_POST['cmbLevel']) ? $_POST['cmbLevel'] : '';
	?>
		<form class="form-horizontal" action="<?php $_SERVER['PHP_SELF']; ?>" method="post" name="form1" target="_self">
		<i class="glyphicon glyphicon-book"></i> <b>Informasi Pengguna</b><br />
		<small>Informasi lengkap  mengenai pengguna aplikasi</small>
		<hr />
		<div class="form-group">
			<label class="control-label col-md-2">Kode Pengguna</label>
			<div class="col-sm-3">
				<input type="text" class="form-control" value="<?php echo $dataKode; ?>" readonly="readonly" name="textfield">
			</div>
		</div>
		<div class="form-group">
			<label class="control-label col-md-2">Nama Lengkap </label>
			<div class="col-sm-5">
				<input name="txtNamaUser" type="text" value="<?php echo $dataNamaUser; ?>" class="form-control">
			</div>
		</div>
		<div class="form-group">
			<label class="control-label col-md-2">No Telp</label>
			<div class="col-sm-5">
				<input name="txtTelpon" type="text" value="<?php echo $dataTelpon; ?>" class="form-control">
			</div>
		</div>
		<div class="form-group">
			<label class="control-label col-md-2">Username</label>
			<div class="col-sm-5">
				<input name="txtUsername" type="text"  value="<?php echo $dataUsername; ?>" class="form-control">
			</div>
		</div>
		<div class="form-group">
			<label class="control-label col-md-2">Password</label>
			<div class="col-sm-5">
				<input type="password" class="form-control" placeholder="Password Pengguna" name="txtPassword">
			</div>
		</div>
		<div class="form-group">
			<label class="control-label col-md-2">Level Login</label>
			<div class="col-md-3">
				<select class="form-control" name="cmbLevel">
					<option value="BLANK"></option>
					<?php
					$pilihan	= array("user", "direktur", "admin");
					foreach ($pilihan as $nilai) {
						if ($dataLevel==$nilai) {
							$cek=" selected";
							} else { $cek = ""; }
							echo "<option value='$nilai' $cek>$nilai</option>";
						}
					?>
				</select>
			</div>
		</div>
		<hr>
		<div class="form-actions">
			<div class="row">
				<div class="col-md-5">
					<button class="btn btn-info" type="submit" name="btnSimpan"><i class="fa fa-save"></i>Simpan Data</button>
					<button class="btn btn-danger" type="reset">Batalkan</button>
				</div>
			</div>
		</div>
		</form>
	</div>
</div>