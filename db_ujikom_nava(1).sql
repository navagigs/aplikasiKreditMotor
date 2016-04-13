-- phpMyAdmin SQL Dump
-- version 3.2.4
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Feb 20, 2014 at 10:46 PM
-- Server version: 5.1.41
-- PHP Version: 5.3.1

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `db_ujikom_nava`
--

-- --------------------------------------------------------

--
-- Table structure for table `akad`
--

CREATE TABLE IF NOT EXISTS `akad` (
  `akad_no_dokumen` varchar(10) NOT NULL,
  `akad_tgl` varchar(10) NOT NULL,
  `debitur_no_rekening` varchar(25) NOT NULL,
  `penjamin_no_penjamin` varchar(10) NOT NULL,
  `akad_tenor` varchar(5) NOT NULL,
  `akad_merk_motor` varchar(20) NOT NULL,
  `akad_jenis_motor` varchar(10) NOT NULL,
  `akad_harga` varchar(10) NOT NULL,
  `akad_no_rangka` varchar(10) NOT NULL,
  `akad_no_mesin` varchar(10) NOT NULL,
  `akad_angsuran` varchar(6) NOT NULL,
  `akad_status` varchar(10) NOT NULL,
  PRIMARY KEY (`akad_no_dokumen`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `akad`
--

INSERT INTO `akad` (`akad_no_dokumen`, `akad_tgl`, `debitur_no_rekening`, `penjamin_no_penjamin`, `akad_tenor`, `akad_merk_motor`, `akad_jenis_motor`, `akad_harga`, `akad_no_rangka`, `akad_no_mesin`, `akad_angsuran`, `akad_status`) VALUES
('DOK-NO.001', '2014-02-20', 'ATM001', 'PEN-NO.001', '36', 'Honda', 'Beat', '12000000', 'RANG1', 'MESIN1', '340000', 'mengangsur'),
('DOK-NO.002', '2014-02-20', 'ATM002', 'PEN-NO.002', '24', 'Yamaha', 'Mio', '13000000', 'RANG1', 'MESIN1', '552500', 'mengangsur'),
('DOK-NO.003', '2014-02-20', 'ATM003', 'PEN-NO.003', '12', 'Suzuki', 'FU15', '19000000', 'RANG3', 'MESIN3', '161500', 'mengangsur'),
('DOK-NO.004', '2014-02-20', 'ATM004', 'PEN-NO.004', '12', 'Yamaha', 'Jupiter', '17500000', 'RANG4', 'MESIN4', '148750', 'mengangsur'),
('DOK-NO.005', '2014-02-20', 'ATM005', 'PEN-NO.005', '36', 'Kawasaki', 'KLX', '24000000', 'RANG5', 'MESIN5', '680000', 'mengangsur'),
('DOK-NO.006', '2014-02-20', 'ATM006', 'PEN-NO.006', '12', 'Yamaha', 'Mio', '12000000', 'RANG1', 'MESIN1', '102000', 'mengangsur'),
('DOK-NO.007', '2014-02-20', 'ATM007', 'PEN-NO.007', '24', 'Yamaha', 'Jupiter', '15000000', 'RANG7', 'MESIN7', '637500', 'mengangsur'),
('DOK-NO.008', '2014-02-20', 'ATM008', 'PEN-NO.008', '12', 'Yamaha', 'Jupiter', '13500000', 'RANG8', 'MESIN8', '114750', 'mengangsur'),
('DOK-NO.009', '2014-02-20', 'ATM009', 'PEN-NO.009', '12', 'Suzuki', 'Smash', '12000000', 'RANG9', 'MESIN9', '102000', 'mengangsur'),
('DOK-NO.010', '2014-02-20', 'ATM010', 'PEN-NO.010', '12', 'Yamaha', 'Byson', '22000000', 'RANG10', 'MESIN10', '187000', 'mengangsur'),
('DOK-NO.011', '2014-02-20', 'ATM011', 'PEN-NO.011', '12', 'Honda', 'Supra', '12500000', 'RANG11', 'MESIN11', '106250', 'mengangsur'),
('DOK-NO.012', '2014-02-21', 'ATM012', 'PEN-NO.012', '36', 'Honda', 'Beat', '12000000', 'RANG12', 'MESIN12', '340000', 'mengangsur');

-- --------------------------------------------------------

--
-- Table structure for table `angsuran`
--

CREATE TABLE IF NOT EXISTS `angsuran` (
  `no_bayar` bigint(20) NOT NULL AUTO_INCREMENT,
  `debitur_no_rekening` varchar(25) NOT NULL,
  `akad_no_dokumen` varchar(20) NOT NULL,
  `akad_tgl` date NOT NULL,
  `tgl_bayar` date NOT NULL,
  `angsuran_ke` int(11) NOT NULL,
  `jumlah_bayar` double NOT NULL,
  PRIMARY KEY (`no_bayar`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `angsuran`
--


-- --------------------------------------------------------

--
-- Table structure for table `aplikasi`
--

CREATE TABLE IF NOT EXISTS `aplikasi` (
  `aplikasi_no_aplikasi` varchar(10) NOT NULL,
  `aplikasi_merk_motor` varchar(20) NOT NULL,
  `aplikasi_jenis_motor` varchar(10) NOT NULL,
  `aplikasi_warna` varchar(10) NOT NULL,
  `aplikasi_tpenghasilan` varchar(10) NOT NULL,
  `debitur_no_rekening` varchar(25) NOT NULL,
  PRIMARY KEY (`aplikasi_no_aplikasi`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `aplikasi`
--

INSERT INTO `aplikasi` (`aplikasi_no_aplikasi`, `aplikasi_merk_motor`, `aplikasi_jenis_motor`, `aplikasi_warna`, `aplikasi_tpenghasilan`, `debitur_no_rekening`) VALUES
('APP/NO.001', 'Honda', 'Beat', 'Hitam', '5000000', 'ATM001'),
('APP/NO.002', 'Yamaha', 'Mio', 'Hitam', '9000000', 'ATM002'),
('APP/NO.003', 'Suzuki', 'FU15', 'Merah', '10000000', 'ATM003'),
('APP/NO.004', 'Yamaha', 'Jupiter', 'Biru', '8000000', 'ATM004'),
('APP/NO.005', 'Kawasaki', 'KLX', 'Hijau', '4500000', 'ATM005'),
('APP/NO.006', 'Yamaha', 'Mio', 'Merah', '4000000', 'ATM006'),
('APP/NO.007', 'Yamaha', 'Jupiter', 'Merah', '5000000', 'ATM007'),
('APP/NO.008', 'Yamaha', 'Jupiter', 'Merah', '7000000', 'ATM008'),
('APP/NO.009', 'Suzuki', 'Smash', 'Orange', '4000000', 'ATM009'),
('APP/NO.010', 'Yamaha', 'Byson', 'Putih', '10000000', 'ATM010'),
('APP/NO.011', 'Honda', 'Supra', 'Hitam', '5000000', 'ATM011'),
('APP/NO.012', 'Honda', 'Beat', 'Hitam', '5000000', 'ATM012');

-- --------------------------------------------------------

--
-- Table structure for table `background`
--

CREATE TABLE IF NOT EXISTS `background` (
  `background_id` int(5) NOT NULL AUTO_INCREMENT,
  `background_gambar` varchar(100) COLLATE latin1_general_ci NOT NULL,
  `tgl_posting` date NOT NULL,
  PRIMARY KEY (`background_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=34 ;

--
-- Dumping data for table `background`
--

INSERT INTO `background` (`background_id`, `background_gambar`, `tgl_posting`) VALUES
(1, 'main-bg.png', '2014-02-11');

-- --------------------------------------------------------

--
-- Table structure for table `debitur`
--

CREATE TABLE IF NOT EXISTS `debitur` (
  `debitur_no_rekening` varchar(25) NOT NULL,
  `debitur_nama` varchar(40) NOT NULL,
  `debitur_alamat` varchar(100) NOT NULL,
  `debitur_tgllahir` varchar(10) NOT NULL,
  `debitur_noktp` varchar(20) NOT NULL,
  `debitur_jk` varchar(10) NOT NULL,
  `debitur_pekerjaan` varchar(20) NOT NULL,
  `debitur_penghasilan` varchar(10) NOT NULL,
  `debitur_penghasilan2` varchar(10) NOT NULL,
  `penjamin_no_penjamin` varchar(10) NOT NULL,
  PRIMARY KEY (`debitur_no_rekening`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `debitur`
--

INSERT INTO `debitur` (`debitur_no_rekening`, `debitur_nama`, `debitur_alamat`, `debitur_tgllahir`, `debitur_noktp`, `debitur_jk`, `debitur_pekerjaan`, `debitur_penghasilan`, `debitur_penghasilan2`, `penjamin_no_penjamin`) VALUES
('ATM001', 'Ikhsan Robani', 'Cikalong Wetan', '1995-01-30', 'KTP001', 'Laki-Laki', 'ABRI', '3000000', '2000000', 'PEN-NO.001'),
('ATM002', 'Farhan Fauzan', 'Bandung', '1995-02-14', 'KTP002', 'Perempuan', 'PNS', '4000000', '5000000', 'PEN-NO.002'),
('ATM003', 'Fernanda', 'Purabaya', '1954-05-04', 'KTP003', 'Laki-Laki', 'PNS', '5000000', '5000000', 'PEN-NO.003'),
('ATM004', 'Try Galih Prasetya', 'Padalarang', '1995-08-30', 'KTP004', 'Laki-Laki', 'PNS', '3000000', '5000000', 'PEN-NO.004'),
('ATM005', 'Moh Abdul Malik', 'Padalarang', '1996-02-01', 'KTP005', 'Laki-Laki', 'PNS', '4000000', '500000', 'PEN-NO.005'),
('ATM006', 'Achmad Fathoni', 'Ciburuy', '1996-07-08', 'KTP006', 'Laki-Laki', 'PNS', '3000000', '1000000', 'PEN-NO.006'),
('ATM007', 'Bakti Teguh Aryana', 'Gadobangkong', '1993-02-15', 'KTP007', 'Laki-Laki', 'PNS', '3000000', '2000000', 'PEN-NO.007'),
('ATM008', 'Taryana', 'Cikalong Wetan', '1995-02-01', 'KTP008', 'Laki-Laki', 'Wiraswasta', '5000000', '2000000', 'PEN-NO.008'),
('ATM009', 'Ryan Fauzi', 'Cipatat', '1996-02-01', 'KTP009', 'Laki-Laki', 'PNS', '2500000', '1500000', 'PEN-NO.009'),
('ATM010', 'Nava Gia Ginasta', 'Cianjur', '1995-05-10', 'KTP010', 'Laki-Laki', 'PNS', '5000000', '5000000', 'PEN-NO.010'),
('ATM011', 'Fahmi Fauzi', 'Gadobangkong', '1996-02-08', 'KTP011', 'Laki-Laki', 'PNS', '2000000', '3000000', 'PEN-NO.011'),
('ATM012', 'Irlan', 'Padalarang', '1995-02-02', 'KTP012', 'Laki-Laki', 'PNS', '3000000', '2000000', 'PEN-NO.012');

-- --------------------------------------------------------

--
-- Table structure for table `penjamin`
--

CREATE TABLE IF NOT EXISTS `penjamin` (
  `penjamin_no_penjamin` varchar(10) NOT NULL,
  `penjamin_nama` varchar(40) NOT NULL,
  `penjamin_alamat` varchar(100) NOT NULL,
  `penjamin_tgllahir` varchar(10) NOT NULL,
  `penjamin_hubungan` varchar(10) NOT NULL,
  PRIMARY KEY (`penjamin_no_penjamin`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `penjamin`
--

INSERT INTO `penjamin` (`penjamin_no_penjamin`, `penjamin_nama`, `penjamin_alamat`, `penjamin_tgllahir`, `penjamin_hubungan`) VALUES
('PEN-NO.001', 'Sandi', 'Cikalong Wetan', '', 'Kakak'),
('PEN-NO.002', 'Kenji', 'Bandung', '', 'Kakak'),
('PEN-NO.003', 'Isco', 'Purabaya', '', 'Kakak'),
('PEN-NO.004', 'Dedi Kusnandar', 'Padalarang', '', 'Ayah'),
('PEN-NO.005', 'Junaedi', 'Bandung', '', 'Kakak'),
('PEN-NO.006', 'Dani', 'Ciburuy', '', 'Kakak'),
('PEN-NO.007', 'Aguero', 'Gadobangkong', '', 'Kakak'),
('PEN-NO.008', 'Taryiso', 'Cikalong Wetan', '', 'Kakak'),
('PEN-NO.009', 'Asep Budi', 'Cipatat', '', 'Kakak'),
('PEN-NO.010', 'Nandan Vava', 'Cianjur', '', 'Ayah'),
('PEN-NO.011', 'Sukardi', 'Gadobangkong', '', 'Ayah'),
('PEN-NO.012', 'Kusin', 'Bandung', '', 'Suami');

-- --------------------------------------------------------

--
-- Table structure for table `penyerahan`
--

CREATE TABLE IF NOT EXISTS `penyerahan` (
  `no_dokumen` varchar(10) NOT NULL,
  `nama` varchar(40) NOT NULL,
  `alamat` varchar(100) NOT NULL,
  `merk_motor` varchar(20) NOT NULL,
  `jenis_motor` varchar(10) NOT NULL,
  `no_berita_acara` varchar(15) NOT NULL,
  `no_surat_jalan` varchar(15) NOT NULL,
  `tgl_penyerahan` varchar(10) NOT NULL,
  `yang_menyerahkan` varchar(50) NOT NULL,
  `no_polisi` varchar(10) NOT NULL,
  `no_mesin` varchar(10) NOT NULL,
  `no_rangka` varchar(10) NOT NULL,
  `warna` varchar(10) NOT NULL,
  `status` varchar(20) NOT NULL,
  PRIMARY KEY (`no_dokumen`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `penyerahan`
--

INSERT INTO `penyerahan` (`no_dokumen`, `nama`, `alamat`, `merk_motor`, `jenis_motor`, `no_berita_acara`, `no_surat_jalan`, `tgl_penyerahan`, `yang_menyerahkan`, `no_polisi`, `no_mesin`, `no_rangka`, `warna`, `status`) VALUES
('DOK-NO.001', 'Ikhsan Robani', 'Cikalong Wetan', 'Honda', 'Beat', 'BER1', 'SJ1', '2014-02-21', 'Ujikom', 'D123DA', 'MESIN1', 'RANG1', 'Hitam', 'mengangsur'),
('DOK-NO.010', 'Nava Gia Ginasta', 'Cianjur', 'Yamaha', 'Byson', 'BA1', 'SJ1', '2014-02-20', 'FERNANDA', 'F5718ZA', 'MESIN10', 'RANG10', 'Putih', 'mengangsur');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `username` varchar(50) COLLATE latin1_general_ci NOT NULL,
  `password` varchar(50) COLLATE latin1_general_ci NOT NULL,
  `nama_lengkap` varchar(100) COLLATE latin1_general_ci NOT NULL,
  `email` varchar(100) COLLATE latin1_general_ci NOT NULL,
  `no_telp` varchar(20) COLLATE latin1_general_ci NOT NULL,
  `level` varchar(20) COLLATE latin1_general_ci NOT NULL DEFAULT 'user',
  `blokir` enum('Y','N') COLLATE latin1_general_ci NOT NULL DEFAULT 'N',
  `id_session` varchar(100) COLLATE latin1_general_ci NOT NULL,
  PRIMARY KEY (`username`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`username`, `password`, `nama_lengkap`, `email`, `no_telp`, `level`, `blokir`, `id_session`) VALUES
('admin', '21232f297a57a5a743894a0e4a801fc3', 'Nava Gia Ginasta', 'nava.webdevelopers@gmail.com', '08238923848', 'admin', 'N', 'j2i340eh8vak9bjhq6277pflf6');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
