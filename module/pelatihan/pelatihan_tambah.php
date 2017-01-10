<head> 
<script type="text/javascript" src="./js/jquery-1.3.2.js"></script>
<script type="text/javascript" src="./js/ui.core.js"></script>
<script type="text/javascript" src="./js/ui.datepicker.js"></script>
<script type="text/javascript"> 
      $(document).ready(function(){
        $("#tanggal").datepicker({
		dateFormat  : "dd-mm-yy", 
          changeMonth : true,
          changeYear  : true
		  
        });
      });
	  
    </script>
</head>
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
		if(trim($_GET['Act'])=="Delete"){
			mysql_query("DELETE FROM peserta WHERE id_peserta='".$_GET['ID']."' AND kd_user='".$_SESSION['kd_user']."'", $koneksidb) 
				or die ("Gagal kosongkan tmp".mysql_error());
		}
		if(trim($_GET['Act'])=="Sucsses"){
			echo "<div class='alert alert-dismissable alert-success'><i class='glyphicon glyphicon-ok'></i> Jadwal Berhasil Disimpan</div>";
		}
	}
	
	if($_POST) {
	if(isset($_POST['btnPilih'])){
		$message = array();
		if (trim($_POST['cmbKaryawan'])=="BLANK") {
			$message[] = "<b>Peserta belum diisi</b>, silahkan masukkan peserta terlebih dahulu!";		
		}
		
		$cmbKaryawan	= $_POST['cmbKaryawan'];
		$cmbKaryawan	= str_replace("'","&acute;",$cmbKaryawan);
		$kodeBaru		= buatKode("pelatihan", "PL");
		
		if(count($message)==0){			
			$karyawanSql ="SELECT * FROM karyawan WHERE nik='$cmbKaryawan'";
			$karyawanQry = mysql_query($karyawanSql, $koneksidb) or die ("Gagal Query Tmp".mysql_error());
			$karyawanRow = mysql_fetch_array($karyawanQry);
			$karyawanQty = mysql_num_rows($karyawanQry);
			if ($karyawanQty >= 1) {
				$tmpSql = "INSERT INTO peserta SET nik='$karyawanRow[nik]', no_pelatihan='$kodeBaru', status_kehadiran='Kosong', kd_user='".$_SESSION['kd_user']."'";
				mysql_query($tmpSql, $koneksidb) or die ("Gagal Query detail karyawan : ".mysql_error());
				$cmbKaryawan	= "";
			}
			else {
				$message[] = "Tidak ada karyawan dengan NIK <b>$cmbKaryawan'</b>, silahkan ganti";
			}
		}

	}
	
	if(isset($_POST['btnSave'])){
		$message = array();
		if (trim($_POST['cmbMateri'])=="BLANK") {
			$message[] = "<b>Materi pelatihan belum dipilih</b>, silahkan pilih lagi !";		
		}
		if (trim($_POST['txtTanggal'])=="") {
			$message[] = "Tanggal pelatihan belum diisi, pilih pada combo !";		
		}
		
		$cmbMateri		= $_POST['cmbMateri'];
		$cmbMateri		= str_replace("'","&acute;",$cmbMateri);
		$txtTanggal		= $_POST['txtTanggal'];
				
		if(count($message)==0){	
			$kodeBaru		= buatKode("pelatihan", "PL");		
			$qrySave=mysql_query("INSERT INTO pelatihan SET no_pelatihan='$kodeBaru', 
									tanggal_pelatihan='".InggrisTgl($_POST['txtTanggal'])."', 
									kode_materi='$cmbMateri', 
									status_pelatihan='Terjadwal',
									kd_user='".$_SESSION['kd_user']."'") 
								  or die ("Gagal query".mysql_error());
			if($qrySave){				
				echo "<meta http-equiv='refresh' content='0; url=?page=Tambah-Pelatihan&Act=Sucsses'>";
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

$dataKode		= buatKode("pelatihan", "PL");
$dataTanggal 	= isset($_POST['txtTanggal']) ? $_POST['txtTanggal'] : date('d-m-Y');
$dataMateri		= isset($_POST['cmbMateri']) ? $_POST['cmbMateri'] : '';
?>
	<form class="form-horizontal" action="<?php $_SERVER['PHP_SELF']; ?>" method="post" name="form1" target="_self">
		<i class="glyphicon glyphicon-book"></i> <b>Informasi Pelatihan</b><br />
		<small>Informasi lengkap  mengenai pelatihan</small>
		<hr />
		<div class="form-group">
			<label class="control-label col-md-2">Kode Pelatihan</label>
			<div class="col-sm-2">
					<input type="text" class="form-control" value="<?php echo $dataKode; ?>" readonly="readonly" name="textfield" />
			</div>
		</div>
		<div class="form-group">
			<label class="control-label col-md-2">Tgl. Pelatihan</label>
			<div class="col-sm-2">
					  <input type="text" class="form-control" value="<?php echo $dataTanggal; ?>" name="txtTanggal" id="tanggal"/>
			</div>
		</div>
		<div class="form-group">
			<label class="control-label col-md-2">Materi Pelatihan</label>
			<div class="col-sm-4">
					<select name="cmbMateri" class="form-control">
						<option value="BLANK">....</option>
						<?php
						$dataSql = "SELECT * FROM materi ORDER BY kode_materi";
						$dataQry = mysql_query($dataSql, $koneksidb) or die ("Gagal Query".mysql_error());
						while ($dataRow = mysql_fetch_array($dataQry)) {
							if ($dataMateri == $dataRow['kode_materi']) {
							$cek = " selected";
						} else { $cek=""; }
						echo "<option value='$dataRow[kode_materi]' $cek> $dataRow[nama_materi]</option>";
						}
						$sqlData ="";
						?>
					</select>
			</div>
		</div>
		<hr />
		<div class="form-group">
			<label class="control-label col-md-2">Nama Karyawan</label>
			<div class="col-sm-4">
					  <select name="cmbKaryawan" class="form-control">
						<option value="BLANK">....</option>
						<?php
						$dataSql = "SELECT * FROM karyawan ORDER BY nik";
						$dataQry = mysql_query($dataSql, $koneksidb) or die ("Gagal Query".mysql_error());
						while ($dataRow = mysql_fetch_array($dataQry)) {
							if ($dataKaryawan == $dataRow['nik']) {
							$cek = " selected";
						} else { $cek=""; }
						echo "<option value='$dataRow[nik]' $cek>[ $dataRow[nik] ] $dataRow[nama_karyawan]</option>";
						}
						$sqlData ="";
						?>
					</select>
			</div>
			<button class="btn btn-info" type="submit" name="btnPilih">Tambah Peserta</button>
			<button class="btn btn-warning" type="submit" name="btnSave">Simpan Jadwal</button>
		</div> 
		<hr />
		</form>
		<table class="table table-hover" width="100%">
			<thead>
				<tr class="active">
				  <th width="49"><div align="center">No</div></th>
					<th width="157"><div align="left">NIK</div></th>
					<th width="408"><div align="left">Nama Karyawan</div></th>
				  <th width="574"><div align="left">Department</div></th>
				    <th colspan="2"><div align="center">Hapus</div></th>
			    </tr>
			</thead>
				<?php
				$pesertaSql = "SELECT * FROM peserta 
								INNER JOIN karyawan ON peserta.nik=karyawan.nik
								INNER JOIN department ON karyawan.kode_department=department.kode_department
								WHERE no_pelatihan='$dataKode'";
				$pesertaQry = mysql_query($pesertaSql, $koneksidb)  or die ("Query barang salah : ".mysql_error());
				$nomor  = 0; 
				while ($pesertaRow = mysql_fetch_array($pesertaQry)) {
				$nomor++;
				$Kode = $pesertaRow['id_peserta'];
				?>
			<tbody>
				<tr>
					<td><div align="center"><?php echo $nomor; ?></div></td>
					<td><div align="left"><?php echo $pesertaRow['nik']; ?></div></td>
					<td><div align="left"><?php echo $pesertaRow['nama_karyawan']; ?></div></td>
					<td><div align="left"><?php echo $pesertaRow['nama_department']; ?></div></td>
       				<td width="88" align="center">
					<a href="?page=Tambah-Pelatihan&Act=Delete&ID=<?php echo $Kode; ?>" target="_self" alt="Delete Data"><span class="glyphicon glyphicon-trash"></span></a>
					</td>
   				</tr>
			</tbody>
      		<?php } ?>
		</table>
		
  	</div>
</div>