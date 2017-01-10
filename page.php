<?php
	$pg=$_GET['page'];
		if($pg=="Beranda"){ include"module/home.php"; }
	// DATA PENGGUNA
		if($pg=="Data-Pengguna") { include"module/pengguna/pengguna_data.php"; }
		if($pg=="Tambah-Pengguna") { include"module/pengguna/pengguna_tambah.php"; }
		if($pg=="Ubah-Pengguna") { include"module/pengguna/pengguna_ubah.php"; }
		if($pg=="Ubah-Pengguna-Profil") { include"module/pengguna/pengguna_ubah_profil.php"; }
		if($pg=="Hapus-Pengguna") { include"module/pengguna/pengguna_hapus.php"; }
	// DATA PERUSAHAAN
		if($pg=="Data-Perusahaan"){ include"module/perusahaan/perusahaan_data.php"; }
		if($pg=="Tambah-Perusahaan"){ include"module/perusahaan/perusahaan_tambah.php"; }
		if($pg=="Ubah-Perusahaan"){ include"module/perusahaan/perusahaan_ubah.php"; }
		if($pg=="Hapus-Perusahaan"){ include"module/perusahaan/perusahaan_hapus.php"; }
	// DATA DEPARTMENT	
		if($pg=="Data-Department"){ include"module/department/department_data.php"; }
		if($pg=="Tambah-Department"){ include"module/department/department_tambah.php"; }
		if($pg=="Ubah-Department"){ include"module/department/department_ubah.php"; }
		if($pg=="Hapus-Department"){ include"module/department/department_hapus.php"; }
	// DATA JABATAN
		if($pg=="Data-Jabatan"){ include"module/jabatan/jabatan_data.php"; }
		if($pg=="Tambah-Jabatan"){ include"module/jabatan/jabatan_tambah.php"; }
		if($pg=="Ubah-Jabatan"){ include"module/jabatan/jabatan_ubah.php"; }
		if($pg=="Hapus-Jabatan"){ include"module/jabatan/jabatan_hapus.php"; }
	// DATA KARYAWAN
		if($pg=="Data-Karyawan"){ include"module/karyawan/karyawan_data.php"; }
		if($pg=="Tambah-Karyawan"){ include"module/karyawan/karyawan_tambah.php"; }
		if($pg=="Ubah-Karyawan"){ include"module/karyawan/karyawan_ubah.php"; }
		if($pg=="Hapus-Karyawan"){ include"module/karyawan/karyawan_hapus.php"; }
	// DATA MATERI
		if($pg=="Data-Materi"){ include"module/materi/materi_data.php"; }
		if($pg=="Tambah-Materi"){ include"module/materi/materi_tambah.php"; }
		if($pg=="Ubah-Materi"){ include"module/materi/materi_ubah.php"; }
		if($pg=="Hapus-Materi"){ include"module/materi/materi_hapus.php"; }
	// DATA PELATIHAN
		if($pg=="Data-Pelatihan"){ include"module/pelatihan/pelatihan_data.php"; }
		if($pg=="Tambah-Pelatihan"){ include"module/pelatihan/pelatihan_tambah.php"; }
		if($pg=="Ubah-Pelatihan"){ include"module/pelatihan/pelatihan_ubah.php"; }
		if($pg=="Hapus-Pelatihan"){ include"module/pelatihan/pelatihan_hapus.php"; }
	// DATA PESERTA
		if($pg=="Penilaian-Peserta"){ include"module/peserta/peserta_penilaian.php"; }
		if($pg=="Data-Peserta"){ include"module/peserta/peserta_data.php"; }
		if($pg=="Ubah-Peserta"){ include"module/peserta/peserta_ubah.php"; }
		if($pg=="Hapus-Peserta"){ include"module/peserta/peserta_hapus.php"; }
	// DATA LAPORAN
		if($pg=="Laporan-Karyawan"){ include"module/laporan/laporan_karyawan.php"; }	
		if($pg=="Laporan-Pelatihan"){ include"module/laporan/laporan_pelatihan.php"; }	
		if($pg=="Laporan-Peserta"){ include"module/laporan/laporan_peserta.php"; }	
?>