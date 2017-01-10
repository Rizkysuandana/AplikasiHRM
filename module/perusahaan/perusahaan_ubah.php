<head> 
<script type="text/javascript" src="./js/jquery-1.3.2.js"></script>
<script type="text/javascript" src="./js/ui.core.js"></script>
<script type="text/javascript" src="./js/ui.datepicker.js"></script>


<script type="text/javascript"> 
      $(document).ready(function(){
        $("#tanggal").datepicker({
		dateFormat  : "yy-mm-dd", 
          changeMonth : true,
          changeYear  : true
		  
        });
      });
	  
    </script>
</head>
<div class="col-md-12 panel-warning">
	<div class="content-box-header panel-heading">
		<div class="panel-title"> Perubahan Data Perusahaan</div>
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
				if (trim($_POST['txtJenis'])=="") {
					$message[] = "<b>Jenis Perusahaan</b> tidak boleh kosong !";		
				}
				if (trim($_POST['txtTanggal'])=="") {
					$message[] = "<b>Tanggal Berdiri</b> tidak boleh kosong !";		
				}
				if (trim($_POST['txtAlamat'])=="") {
					$message[] = "<b>Alamat Perusahaan</b> tidak boleh kosong !";		
				}
				
				$txtLama		= $_POST['txtLama'];
				$txtNama		= $_POST['txtNama'];
				$txtNama		= str_replace("'","&acute;",$txtNama);
				$txtJenis		= $_POST['txtJenis'];
				$txtJenis		= str_replace("'","&acute;",$txtJenis);
				$txtTanggal		= $_POST['txtTanggal'];
				$txtTanggal		= str_replace("'","&acute;",$txtTanggal);
				$txtAlamat		= $_POST['txtAlamat'];
				$txtAlamat		= str_replace("'","&acute;",$txtAlamat);
				
				$sqlCek="SELECT * FROM perusahaan WHERE nama_perusahaan='$txtNama' AND NOT(nama_perusahaan='$txtLama')";
				$qryCek=mysql_query($sqlCek, $koneksidb) or die ("Eror Query".mysql_error()); 
				if(mysql_num_rows($qryCek)>=1){
					$message[] = "Maaf, Nama Perusahaan <b> $txtNama </b> sudah ada, ganti dengan yang lain";
				}
				
				
				if(count($message)==0){	
					$qryUpdate=mysql_query("UPDATE perusahaan SET nama_perusahaan='$txtNama',
																  jenis_perusahaan='$txtJenis', 
																  tanggal_berdiri='$txtTanggal',
																  alamat='$txtAlamat'
											WHERE kode_perusahaan ='".$_POST['txtKode']."'") 
							   or die ("Gagal query update".mysql_error());
					if($qryUpdate){
						echo "<meta http-equiv='refresh' content='0; url=?page=Data-Perusahaan'>";
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
			$sqlShow = "SELECT * FROM perusahaan WHERE kode_perusahaan='$KodeEdit'";
			$qryShow = mysql_query($sqlShow, $koneksidb)  or die ("Query ambil data perusahaan salah : ".mysql_error());
			$dataShow= mysql_fetch_array($qryShow);
			
			$dataKode		= $dataShow['kode_perusahaan'];
			$dataNama		= isset($dataShow['nama_perusahaan']) ?  $dataShow['nama_perusahaan'] : $_POST['txtNama'];
			$dataLama		= $dataShow['nama_perusahaan'];
			$dataJenis 		= isset($dataShow['jenis_perusahaan']) ?  $dataShow['jenis_perusahaan'] : $_POST['txtJenis'];
			$dataTanggal 	= isset($dataShow['tanggal_berdiri']) ?  $dataShow['tanggal_berdiri'] : $_POST['txtTanggal'];
			$dataAlamat		= isset($dataShow['alamat']) ?  $dataShow['alamat'] : $_POST['txtAlamat'];
		} 
		?>
		<form class="form-horizontal" action="<?php $_SERVER['PHP_SELF']; ?>" method="post" name="form1" target="_self">
		<i class="glyphicon glyphicon-book"></i> <b>Informasi Perusahaan</b><br />
		<small>Informasi lengkap  mengenai perusahaan</small>
		<hr />
		<div class="form-group">
			<label class="control-label col-md-2">Kode Perusahaan</label>
			<div class="col-sm-2">
					<input type="text" class="form-control" value="<?php echo $dataKode; ?>" readonly="readonly" name="textfield" />
					<input name="txtKode" type="hidden" value="<?php echo $dataKode; ?>" />
			</div>
		</div>
		<div class="form-group">
			<label class="control-label col-md-2">Nama Perusahaan</label>
			<div class="col-sm-4">
					  <input type="text" class="form-control" value="<?php echo $dataNama; ?>" name="txtNama" />
					  <input name="txtLama" type="hidden" value="<?php echo $dataLama; ?>" />
			</div>
		</div>
		<div class="form-group">
			<label class="control-label col-md-2">Jenis Produksi</label>
			<div class="col-sm-5">
					  <input type="text" class="form-control" value="<?php echo $dataJenis; ?>" name="txtJenis" autocomplete='off'/>
			</div>
		</div>
		<div class="form-group">
			<label class="control-label col-md-2">Tgl. Berdiri</label>
			<div class="col-sm-2">
					  <input type="text" class="form-control" value="<?php echo $dataTanggal; ?>" name="txtTanggal" id="tanggal" />
			</div>
		</div>
		<div class="form-group">
			<label class="control-label col-md-2">Alamat Perusahaan</label>
			<div class="col-sm-10">
					  <input type="text" class="form-control" value="<?php echo $dataAlamat; ?>" name="txtAlamat" autocomplete='off'/>
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