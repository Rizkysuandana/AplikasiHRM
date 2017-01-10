-- phpMyAdmin SQL Dump
-- version 3.5.2
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jun 16, 2015 at 02:09 PM
-- Server version: 5.5.25a
-- PHP Version: 5.4.4

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `hrmdb`
--

-- --------------------------------------------------------

--
-- Table structure for table `department`
--

CREATE TABLE IF NOT EXISTS `department` (
  `kode_department` char(5) NOT NULL,
  `nama_department` varchar(50) NOT NULL,
  `tugas_department` varchar(100) NOT NULL,
  `lokasi_department` varchar(50) NOT NULL,
  `phone` varchar(20) NOT NULL,
  PRIMARY KEY (`kode_department`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `department`
--

INSERT INTO `department` (`kode_department`, `nama_department`, `tugas_department`, `lokasi_department`, `phone`) VALUES
('DEP01', 'General Affair', 'Melakukan Kontrol terhadap keluar masuk karyawan', 'Gedung 1.0 Lantai 1', '121'),
('DEP02', 'Human Resource Development', 'Melakukan pembinaan terhadap karyawan ', 'Gedung 1.0 Lantai 1 Ruang 1.0', '122'),
('DEP03', 'IT Support', 'Melakukan Perawatan Tool Pendukung', 'Gedung 1.0 Lantai 1 Ruang 1.1', '123'),
('DEP04', 'Maintenance', 'Perbaikan Peralatan Produksi', 'Gedung 1.0 Lantai 1.2', '132');

-- --------------------------------------------------------

--
-- Table structure for table `jabatan`
--

CREATE TABLE IF NOT EXISTS `jabatan` (
  `kode_jabatan` char(5) NOT NULL,
  `nama_jabatan` varchar(50) NOT NULL,
  `tugas` varchar(100) NOT NULL,
  PRIMARY KEY (`kode_jabatan`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `jabatan`
--

INSERT INTO `jabatan` (`kode_jabatan`, `nama_jabatan`, `tugas`) VALUES
('JAB01', 'Manager IT', 'Membimbing Karyawan IT'),
('JAB02', 'Manager Ganeral Affair', 'Membimbing Karyawan GA'),
('JAB03', 'Staff IT', 'Melakukan Perbaikan Tool'),
('JAB04', 'Administrasi', 'Melakukan Pencatatan Transaksi'),
('JAB05', 'Staff GA', 'Manegement Semua Karyawan'),
('JAB06', 'Direktur', 'Kontrol Semua Karyawan, Produksi Dll'),
('JAB07', 'Office Boy (OB)', 'Menjalankan 5R'),
('JAB08', 'Supir', 'Melakukan Antar Muat Barang'),
('JAB09', 'Mekanik Produksi', 'Kontrol dan Melakukan Perbaikan Peralatan Mesin Produksi');

-- --------------------------------------------------------

--
-- Table structure for table `karyawan`
--

CREATE TABLE IF NOT EXISTS `karyawan` (
  `nik` char(8) NOT NULL,
  `nama_karyawan` varchar(100) NOT NULL,
  `tempat_lahir` varchar(50) NOT NULL,
  `tanggal_lahir` date NOT NULL,
  `alamat` text NOT NULL,
  `kelamin` enum('Pria','Wanita') NOT NULL,
  `kode_perusahaan` char(5) NOT NULL,
  `kode_department` char(5) NOT NULL,
  `kode_jabatan` char(5) NOT NULL,
  `cuti` int(2) NOT NULL,
  `tanggal_masuk` date NOT NULL,
  `tanggal_berakhir` date NOT NULL,
  PRIMARY KEY (`nik`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `karyawan`
--

INSERT INTO `karyawan` (`nik`, `nama_karyawan`, `tempat_lahir`, `tanggal_lahir`, `alamat`, `kelamin`, `kode_perusahaan`, `kode_department`, `kode_jabatan`, `cuti`, `tanggal_masuk`, `tanggal_berakhir`) VALUES
('KR700001', 'Farhan Alawi', 'Bogor', '1988-11-03', 'Jl. Kolonel Bustomi Burhanudin No 05', 'Pria', 'PT001', 'DEP03', 'JAB01', 0, '2014-05-24', '0000-00-00'),
('KR700002', 'Fitria Apriani', 'Bekasi', '1993-04-07', 'Jl. Margahayu Bekasi', 'Wanita', 'PT002', 'DEP01', 'JAB02', 0, '2014-05-24', '0000-00-00'),
('KR700003', 'Herlandi', 'Bogor', '1988-01-15', 'Jln. Lio Baru', 'Pria', 'PT001', 'DEP03', 'JAB01', 0, '2015-01-01', '2015-04-30'),
('KR700004', 'Dani Ramdani', 'Bogor', '1991-01-02', 'Jl. Padjajaran', 'Pria', 'PT001', 'DEP02', 'JAB02', 0, '2015-01-01', '2016-01-01'),
('KR700005', 'Rizki Setiawan', 'Bogor', '1987-01-14', 'Cikaret RT 05/04 Kel. Harapan Jaya Cibinong', 'Pria', 'PT001', 'DEP01', 'JAB02', 0, '2015-01-21', '0000-00-00'),
('KR700006', 'Dedi Mulyadi', 'Bogor', '1976-01-15', 'Jl. Jati rawamangun No. 01 Rt. 07/01 Jaktim', 'Pria', 'PT001', 'DEP04', 'JAB04', 0, '2014-05-15', '2015-06-18'),
('KR700007', 'Misbah Arifin', 'Jakarta', '1985-08-14', 'Jl. Kesadaran I No.8 Rt.04/01 Sawangan-Depok', 'Pria', 'PT001', 'DEP04', 'JAB04', 0, '2012-04-17', '0000-00-00'),
('KR700008', 'Suryanto', 'Bogor', '1995-01-03', 'Kp. Setu bakti Rt.02/02 Pabuaran Kemang - bogor', 'Pria', 'PT002', 'DEP03', 'JAB03', 0, '2012-01-16', '0000-00-00'),
('KR700009', 'Agus Supriadi', 'Jakarta', '2015-01-21', 'Jl. Pahlawan Rt. 27/05 No.13', 'Pria', 'PT002', 'DEP04', 'JAB04', 0, '2014-01-28', '0000-00-00'),
('KR700010', 'Muhammad Sofyan', 'Bogor', '1985-01-02', 'Jl. Cimanggu Gg. Pahlawan Rt. 03/02 Tanah sareal Bogor', 'Pria', 'PT002', 'DEP01', 'JAB05', 0, '2014-01-21', '0000-00-00');

-- --------------------------------------------------------

--
-- Table structure for table `materi`
--

CREATE TABLE IF NOT EXISTS `materi` (
  `kode_materi` char(5) NOT NULL,
  `nama_materi` varchar(50) NOT NULL,
  `keterangan` varchar(100) NOT NULL,
  `instruktur` varchar(50) NOT NULL,
  PRIMARY KEY (`kode_materi`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `materi`
--

INSERT INTO `materi` (`kode_materi`, `nama_materi`, `keterangan`, `instruktur`) VALUES
('MT001', 'Leadership', 'Latihan Kepemimpinan', 'Revan Anggoro'),
('MT002', 'Berfikir Positif', '-', 'Danar'),
('MT003', 'Pengenalan Dasar ISO', '-', 'Revan Anggoro'),
('MT004', 'Skill Up Administratsi', '-', 'Revan Anggoro'),
('MT005', 'Budaya Kerja Melalui 5R', 'Materi mengenai kebersihan ruangan kerja', 'Danar'),
('MT006', 'Pengaturan Delivery', '-', 'Revan Anggoro'),
('MT007', 'Tata Tertib Karyawan', '-', 'Danar'),
('MT008', 'Dasar - Dasar Komunikasi', '-', 'Danar'),
('MT009', 'Penanggulangan Kebakaran', '-', 'Revan Anggoro');

-- --------------------------------------------------------

--
-- Table structure for table `pelatihan`
--

CREATE TABLE IF NOT EXISTS `pelatihan` (
  `no_pelatihan` char(7) NOT NULL,
  `tanggal_pelatihan` date NOT NULL,
  `kode_materi` char(5) NOT NULL,
  `status_pelatihan` varchar(50) NOT NULL,
  `kd_user` char(6) NOT NULL,
  PRIMARY KEY (`no_pelatihan`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pelatihan`
--

INSERT INTO `pelatihan` (`no_pelatihan`, `tanggal_pelatihan`, `kode_materi`, `status_pelatihan`, `kd_user`) VALUES
('PL00004', '2015-01-23', 'MT001', 'Terlaksana', 'U006'),
('PL00002', '2015-01-26', 'MT002', 'Terlaksana', 'U006'),
('PL00003', '2015-01-30', 'MT003', 'Terlaksana', 'U006'),
('PL00005', '2015-01-21', 'MT007', 'Terlaksana', 'U006'),
('PL00006', '2015-01-21', 'MT008', 'Terlaksana', 'U006');

-- --------------------------------------------------------

--
-- Table structure for table `perusahaan`
--

CREATE TABLE IF NOT EXISTS `perusahaan` (
  `kode_perusahaan` char(5) NOT NULL,
  `nama_perusahaan` varchar(50) NOT NULL,
  `jenis_perusahaan` varchar(50) NOT NULL,
  `tanggal_berdiri` date NOT NULL,
  `alamat` text NOT NULL,
  PRIMARY KEY (`kode_perusahaan`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `perusahaan`
--

INSERT INTO `perusahaan` (`kode_perusahaan`, `nama_perusahaan`, `jenis_perusahaan`, `tanggal_berdiri`, `alamat`) VALUES
('PT001', 'PT. THE SEVEN PRO SOLUTION', 'Software Development Engenering', '2014-03-24', 'Jl. Kolonel Bustomi No 1 Warungmenteng, Cijeruk, Bogor'),
('PT002', 'CV. ULUUL ABSOR BUSSINES', 'Komputer Retail', '2013-05-01', 'Jl. Kolonel Bustomi No 1 Warungmenteng');

-- --------------------------------------------------------

--
-- Table structure for table `peserta`
--

CREATE TABLE IF NOT EXISTS `peserta` (
  `id_peserta` int(6) NOT NULL AUTO_INCREMENT,
  `no_pelatihan` char(7) NOT NULL,
  `nik` char(8) NOT NULL,
  `status_kehadiran` varchar(50) NOT NULL,
  `nilai_pelatihan` int(3) NOT NULL,
  `kd_user` char(6) NOT NULL,
  PRIMARY KEY (`id_peserta`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=26 ;

--
-- Dumping data for table `peserta`
--

INSERT INTO `peserta` (`id_peserta`, `no_pelatihan`, `nik`, `status_kehadiran`, `nilai_pelatihan`, `kd_user`) VALUES
(16, 'PL00004', 'KR700004', 'Masuk', 75, 'U006'),
(15, 'PL00004', 'KR700003', 'Masuk', 80, 'U006'),
(14, 'PL00004', 'KR700002', 'Masuk', 70, 'U006'),
(13, 'PL00004', 'KR700001', 'Masuk', 80, 'U006'),
(5, 'PL00002', 'KR700001', 'Masuk', 75, 'U006'),
(6, 'PL00002', 'KR700002', 'Masuk', 40, 'U006'),
(7, 'PL00002', 'KR700003', 'Masuk', 80, 'U006'),
(8, 'PL00002', 'KR700004', 'Masuk', 80, 'U006'),
(9, 'PL00003', 'KR700001', 'Masuk', 80, 'U006'),
(10, 'PL00003', 'KR700002', 'Masuk', 80, 'U006'),
(11, 'PL00003', 'KR700003', 'Tidak Masuk', 0, 'U006'),
(12, 'PL00003', 'KR700004', 'Masuk', 60, 'U006'),
(17, 'PL00005', 'KR700007', 'Masuk', 75, 'U006'),
(18, 'PL00005', 'KR700006', 'Masuk', 80, 'U006'),
(19, 'PL00005', 'KR700009', 'Masuk', 75, 'U006'),
(20, 'PL00005', 'KR700010', 'Masuk', 65, 'U006'),
(21, 'PL00006', 'KR700006', 'Masuk', 80, 'U006'),
(22, 'PL00006', 'KR700005', 'Masuk', 70, 'U006'),
(23, 'PL00006', 'KR700008', 'Tidak Masuk', 0, 'U006'),
(24, 'PL00006', 'KR700010', 'Masuk', 90, 'U006');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `kd_user` char(4) NOT NULL,
  `nm_user` varchar(100) NOT NULL,
  `no_telepon` varchar(20) NOT NULL,
  `username` varchar(20) NOT NULL,
  `password` varchar(200) NOT NULL,
  `level` varchar(20) NOT NULL,
  PRIMARY KEY (`kd_user`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`kd_user`, `nm_user`, `no_telepon`, `username`, `password`, `level`) VALUES
('U002', 'Ginan Mubtagi', '085490209012', 'direktur', '4fbfd324f5ffcdff5dbf6f019b02eca8', 'direktur'),
('U003', 'Farhan Alawi', '081220209020', 'farhanalawi88', 'aa803cc99ed04902939dba2f907e7486', 'admin'),
('U004', 'Fidya Isynuril Farihah', '081290902020', 'fidya', '008654a4fa549ed3fc7ea054ddad3529', 'kasir'),
('U005', 'Fitria Apriani', '081220209020', 'fitriaapriani77', 'aa803cc99ed04902939dba2f907e7486', 'admin'),
('U006', 'Administrator', '0251-9222276', 'admin', '21232f297a57a5a743894a0e4a801fc3', 'admin');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
