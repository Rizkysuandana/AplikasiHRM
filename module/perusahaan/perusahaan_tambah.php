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
		<div class="panel-title"> Penambahan Data Perusahaan</div>
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
				
				$txtNama		= $_POST['txtNama'];
				$txtNama		= str_replace("'","&acute;",$txtNama);
				$txtJenis		= $_POST['txtJenis'];
				$txtJenis		= str_replace("'","&acute;",$txtJenis);
				$txtTanggal		= $_POST['txtTanggal'];
				$txtTanggal		= str_replace("'","&acute;",$txtTanggal);
				$txtAlamat		= $_POST['txtAlamat'];
				$txtAlamat		= str_replace("'","&acute;",$txtAlamat);
				
				$sqlCek="SELECT * FROM perusahaan WHERE nama_perusahaan='$txtNama'";
				$qryCek=mysql_query($sqlCek, $koneksidb) or die ("Eror Query".mysql_error()); 
				if(mysql_num_rows($qryCek)>=1){
					$message[] = "Maaf, Nama Perusahaan <b> $txtNama </b> sudah ada, ganti dengan yang lain";
				}
		
		
				if(count($message)==0){			
					$kodeBaru	= buatKode("perusahaan", "PT");
					$qrySave=mysql_query("INSERT INTO perusahaan SET kode_perusahaan='$kodeBaru', nama_perusahaan='$txtNama',
										  jenis_perusahaan='$txtJenis', tanggal_berdiri='$txtTanggal',
										  alamat='$txtAlamat'") or die ("Gagal query".mysql_error());
					if($qrySave){
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
			
			$dataKode		= buatKode("perusahaan", "PT");
			$dataNama		= isset($_POST['txtNama']) ? $_POST['txtNama'] : '';
			$dataJenis 		= isset($_POST['txtJenis']) ? $_POST['txtJenis'] : '';
			$dataTanggal 	= isset($_POST['txtTanggal']) ? $_POST['txtTanggal'] : date('Y-m-d');
			$dataAlamat		= isset($_POST['txtAlamat']) ? $_POST['txtAlamat'] : '';
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
			</div>				
		</div>
		<div class="form-group">
			<label class="control-label col-md-2">Nama Perusahaan</label>
			<div class="col-sm-4">
					  <input type="text" class="form-control" value="<?php echo $dataNama; ?>" name="txtNama" autocomplete='off'/>
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
					<button class="btn btn-info" type="submit" name="btnSimpan">Simpan Data</button>
					<button class="btn btn-danger" type="reset">Batalkan</button>
				</div>
			</div>
		</div>		
		</form>
	</div>
</div>