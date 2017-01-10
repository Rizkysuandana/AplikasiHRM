<?php
include "./config/inc.connection.php";

if($_GET) {
	if(empty($_GET['Kode'])){
		echo "<b>Data yang dihapus tidak ada</b>";
	}
	else {
		$mySql = "DELETE FROM pelatihan WHERE no_pelatihan='".$_GET['Kode']."'";
		$myQry = mysql_query($mySql, $koneksidb) or die ("Eror hapus data".mysql_error());
		if($myQry){
			mysql_query("DELETE FROM peserta WHERE no_pelatihan='".$_GET['Kode']."'", $koneksidb) 
						or die ("Gagal kosongkan tmp".mysql_error());
			echo "<meta http-equiv='refresh' content='0; url=?page=Data-Pelatihan'>";
		}
	}
}
?>