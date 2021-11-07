-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: sql213.epizy.com
-- Waktu pembuatan: 10 Agu 2020 pada 00.28
-- Versi server: 5.6.48-88.0
-- Versi PHP: 7.2.22

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `epiz_25786654_bimbel`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `absensi_murid`
--

CREATE TABLE `absensi_murid` (
  `id_absen` int(11) NOT NULL,
  `idMurid` varchar(12) NOT NULL,
  `namaMurid` text NOT NULL,
  `jamMulai` text NOT NULL,
  `tingkat` enum('TK','SD','SMP','SMA') NOT NULL,
  `paket` enum('Bimbel','MAFIA','Bahasa Mandarin','Bahasa Inggris') NOT NULL,
  `kelas` int(11) NOT NULL,
  `tanggalAbsen` date NOT NULL,
  `absensi` enum('Hadir','Ijin','Alpha','Sakit') NOT NULL,
  `keterangan` text NOT NULL,
  `petugas` text NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `absensi_murid`
--

INSERT INTO `absensi_murid` (`id_absen`, `idMurid`, `namaMurid`, `jamMulai`, `tingkat`, `paket`, `kelas`, `tanggalAbsen`, `absensi`, `keterangan`, `petugas`) VALUES
(1, 'SM10001', 'Budiman', '13:00-20:00', 'SMA', 'Bimbel', 12, '2020-05-29', 'Hadir', '-', '-'),
(2, 'SM11002', 'Kevin', '13:00-20:00', 'SMA', 'Bimbel', 11, '2020-05-29', 'Ijin', 'Lomba', '-'),
(3, 'MP7001', 'JN', '13:00-18:00', 'SMP', 'Bimbel', 7, '2020-07-09', 'Hadir', 'Terlambat', 'Gladys'),
(4, 'MP7001', 'JN', '13:00-18:00', 'SMP', 'Bimbel', 7, '2020-07-10', 'Hadir', '-', 'Gladys'),
(5, 'SD6002', 'Kayla', '13:00-18:00', 'SD', 'Bimbel', 6, '2020-07-19', 'Hadir', '-', '-'),
(6, 'SD6001', 'Jonathan Voice', '13:00-18:00', 'SD', 'Bimbel', 6, '2020-07-19', 'Hadir', '-', '-'),
(7, 'SD6002', 'Kayla', '13:00-18:00', 'SD', 'Bimbel', 6, '2020-07-23', 'Hadir', '-', '-'),
(8, 'SD6001', 'Jonathan Voice', '13:00-18:00', 'SD', 'Bimbel', 6, '2020-07-23', 'Hadir', '-', '-'),
(9, 'SD6001', 'Jonathan Voice', '13:00-18:00', 'SD', 'Bimbel', 6, '2020-07-22', 'Hadir', '-', '-'),
(10, 'SD6002', 'Kayla', '13:00-18:00', 'SD', 'Bimbel', 6, '2020-07-22', 'Hadir', '-', '-'),
(11, 'MP9002', 'vanesa raykita', '13:00-20:00', 'SMP', 'Bimbel', 9, '2020-07-22', 'Hadir', '-', '-'),
(14, 'MP9005', 'david tse', '13:00-20:00', 'SMP', 'Bimbel', 9, '2020-07-22', 'Hadir', '-', '-'),
(15, 'MP9002', 'vanesa raykita', '13:00-20:00', 'SMP', 'Bimbel', 9, '2020-07-22', 'Hadir', '-', '-'),
(20, 'SD2001', 'Jason Giordano', '13:00-18:00', 'SD', 'Bimbel', 2, '2020-08-07', 'Hadir', '-', '-'),
(18, 'MP9002', 'vanesa raykita', '13:00-20:00', 'SMP', 'Bimbel', 9, '2020-07-23', 'Hadir', '-', '-'),
(19, 'SD2001', 'Jason Giordano', '13:00-18:00', 'SD', 'Bimbel', 2, '2020-07-23', 'Hadir', '-', '-');

-- --------------------------------------------------------

--
-- Struktur dari tabel `absensi_tentor`
--

CREATE TABLE `absensi_tentor` (
  `id_absen` int(11) NOT NULL,
  `idTentor` varchar(12) NOT NULL,
  `namaTentor` text NOT NULL,
  `jamMulai` time NOT NULL,
  `jamAkhir` time NOT NULL,
  `tglAbsen` datetime NOT NULL,
  `paket` enum('Bimbel','MAFIA','Bahasa Inggris','Bahasa Mandarin') NOT NULL,
  `kelas` int(11) NOT NULL,
  `absensi` enum('Hadir','Ijin','Alpha','Sakit') NOT NULL,
  `keterangan` text NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `absensi_tentor`
--

INSERT INTO `absensi_tentor` (`id_absen`, `idTentor`, `namaTentor`, `jamMulai`, `jamAkhir`, `tglAbsen`, `paket`, `kelas`, `absensi`, `keterangan`) VALUES
(18, 'TE001', 'Cherryl Jasmine', '13:00:00', '20:00:00', '2020-07-24 00:00:00', 'Bimbel', 8, 'Hadir', '-'),
(16, 'TE001', 'Cherryl Jasmine', '13:00:00', '20:00:00', '2020-07-23 00:00:00', 'Bimbel', 8, 'Hadir', '-'),
(22, 'TE001', 'Cherryl Jasmine', '13:00:00', '20:00:00', '2020-08-07 00:00:00', 'Bimbel', 9, 'Hadir', '-');

-- --------------------------------------------------------

--
-- Struktur dari tabel `biaya_bimbingan`
--

CREATE TABLE `biaya_bimbingan` (
  `id` int(11) NOT NULL,
  `paket` enum('Bimbel','MAFIA','Bahasa Inggris','Bahasa Mandarin') NOT NULL,
  `tingkat` enum('TK','SD','SMP','SMA') NOT NULL,
  `biaya` text NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `biaya_bimbingan`
--

INSERT INTO `biaya_bimbingan` (`id`, `paket`, `tingkat`, `biaya`) VALUES
(18, 'Bahasa Mandarin', 'SMP', '250000'),
(17, 'Bahasa Inggris', 'SMP', '200000'),
(16, 'Bimbel', 'SD', '470000'),
(15, 'Bimbel', 'SMP', '570000');

-- --------------------------------------------------------

--
-- Struktur dari tabel `honor_tentor`
--

CREATE TABLE `honor_tentor` (
  `id` int(11) NOT NULL,
  `paket` enum('Bimbel','MAFIA','Bahasa Mandarin','Bahasa Inggris') NOT NULL,
  `jenisTentor` enum('Harian','Tetap') NOT NULL,
  `honor` text NOT NULL,
  `tingkatan` enum('TK','SD','SMP','SMA') NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `honor_tentor`
--

INSERT INTO `honor_tentor` (`id`, `paket`, `jenisTentor`, `honor`, `tingkatan`) VALUES
(18, 'Bahasa Inggris', 'Tetap', '200000', 'SD'),
(17, 'Bimbel', 'Tetap', '200000', 'SD'),
(16, 'Bimbel', 'Harian', '120000', 'SMP'),
(15, 'Bimbel', 'Tetap', '300000', 'SMP');

-- --------------------------------------------------------

--
-- Struktur dari tabel `kantin`
--

CREATE TABLE `kantin` (
  `kodeKantin` varchar(12) COLLATE utf8_unicode_ci NOT NULL,
  `nama` text COLLATE utf8_unicode_ci NOT NULL,
  `harga` text COLLATE utf8_unicode_ci NOT NULL,
  `jenis` enum('Makanan','Alat Tulis') COLLATE utf8_unicode_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data untuk tabel `kantin`
--

INSERT INTO `kantin` (`kodeKantin`, `nama`, `harga`, `jenis`) VALUES
('AT001', 'Penghapus', '2500', 'Alat Tulis'),
('MA001', 'Paket 15', '15000', 'Makanan'),
('AT002', 'Pulpen', '2500', 'Alat Tulis'),
('MA002', 'Nasi goreng ', '15000', 'Makanan'),
('MA003', 'Bakmi', '18000', 'Makanan');

-- --------------------------------------------------------

--
-- Struktur dari tabel `kbm`
--

CREATE TABLE `kbm` (
  `id` int(11) NOT NULL,
  `kelas` text NOT NULL,
  `paket` enum('Bimbel','MAFIA','Bahasa Mandarin','Bahasa Inggris') NOT NULL,
  `jamMulai` time NOT NULL,
  `jamAkhir` time NOT NULL,
  `hariMengajar` text NOT NULL,
  `tingkat` enum('TK','SD','SMP','SMA') NOT NULL,
  `tentor` varchar(10) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `kbm`
--

INSERT INTO `kbm` (`id`, `kelas`, `paket`, `jamMulai`, `jamAkhir`, `hariMengajar`, `tingkat`, `tentor`) VALUES
(16, '2', 'Bimbel', '11:00:00', '16:00:00', 'Monday, Thursday, Tuesday, Friday, Wednesday', 'SD', 'TE006'),
(18, '6', 'Bimbel', '13:00:00', '18:00:00', 'Monday', 'SD', 'TE004'),
(19, '8', 'Bimbel', '13:00:00', '20:00:00', 'Friday', 'SMP', 'TE005'),
(20, '9', 'Bimbel', '13:00:00', '20:00:00', 'Monday', 'SMP', 'TE001');

-- --------------------------------------------------------

--
-- Struktur dari tabel `mata_pelajaran`
--

CREATE TABLE `mata_pelajaran` (
  `id` int(11) NOT NULL,
  `pelajaran` text NOT NULL,
  `tingkat` enum('SD','SMP','SMA') NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `mata_pelajaran`
--

INSERT INTO `mata_pelajaran` (`id`, `pelajaran`, `tingkat`) VALUES
(1, 'Matematika', 'SD'),
(2, 'B. Indoneisa', 'SD'),
(3, 'B. Inggris', 'SD'),
(4, 'Agama', 'SD'),
(5, 'PKN', 'SD'),
(6, 'IPS', 'SD'),
(7, 'PJOK', 'SD'),
(8, 'PLBJ', 'SD'),
(9, 'Seni Budaya', 'SD'),
(10, 'IPA', 'SD'),
(11, 'Prakarya', 'SD'),
(12, 'B. Mandarin', 'SD'),
(13, 'Matematika', 'SMP'),
(14, 'B. Indonesia', 'SMP'),
(15, 'B. Inggris', 'SMP'),
(16, 'Agama', 'SMP'),
(17, 'PKN', 'SMP'),
(18, 'IPS', 'SMP'),
(19, 'PJOK', 'SMP'),
(20, 'PLBJ', 'SMP'),
(21, 'Seni Budaya', 'SMP'),
(22, 'Fisika', 'SMP'),
(23, 'Kimia', 'SMP'),
(24, 'Biologi', 'SMP'),
(25, 'Prakarya', 'SMP'),
(26, 'B. Mandarin', 'SMP'),
(27, 'B. Indonesia', 'SMA'),
(28, 'B. Inggris', 'SMA'),
(29, 'Agama', 'SMA'),
(30, 'PKN', 'SMA'),
(31, 'IPS', 'SMA'),
(32, 'PJOK', 'SMA'),
(33, 'Seni Budaya', 'SMA'),
(34, 'Matematika Wajib', 'SMA'),
(35, 'Matematika Peminatan', 'SMA'),
(36, 'Prakarya', 'SMA'),
(37, 'Sejarah', 'SMA'),
(38, 'B. Mandarin', 'SMA'),
(39, 'Fisika', 'SMA'),
(40, 'Kimia', 'SMA'),
(41, 'Geografi', 'SMA'),
(42, 'Biologi', 'SMA'),
(43, 'Ekonomi', 'SMA');

-- --------------------------------------------------------

--
-- Struktur dari tabel `murid`
--

CREATE TABLE `murid` (
  `idMurid` varchar(10) NOT NULL,
  `namaMurid` text NOT NULL,
  `namaOrtu` text NOT NULL,
  `noHP` varchar(12) NOT NULL,
  `gender` enum('Laki-Laki','Perempuan') NOT NULL,
  `kelas` text NOT NULL,
  `tglDaftar` date NOT NULL,
  `paket` text NOT NULL,
  `tingkat` enum('TK','SD','SMP','SMA') NOT NULL,
  `statusMurid` enum('Aktif','Pasif') NOT NULL DEFAULT 'Aktif'
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COMMENT='Berisi data murid';

--
-- Dumping data untuk tabel `murid`
--

INSERT INTO `murid` (`idMurid`, `namaMurid`, `namaOrtu`, `noHP`, `gender`, `kelas`, `tglDaftar`, `paket`, `tingkat`, `statusMurid`) VALUES
('SD2001', 'Jason Giordano', 'Nadia', '081386528416', 'Laki-Laki', '2', '2020-07-16', 'Bimbel, Bahasa Mandarin, Bahasa Inggris', 'SD', 'Aktif'),
('MP9002', 'vanesa raykita', 'yusua', '081298429237', 'Perempuan', '9', '2020-07-16', 'Bimbel', 'SMP', 'Aktif'),
('MP9005', 'david tse', 'alim', '081290801185', 'Laki-Laki', '9', '2020-07-16', 'Bimbel', 'SMP', 'Aktif'),
('MP8006', 'Nikolas Julistin Rusli', 'Juniarti Zhuang', '08128288108', 'Laki-Laki', '8', '2020-07-16', 'Bimbel', 'SMP', 'Aktif'),
('TKTK001', 'Samuel', 'xxx', '0000', 'Laki-Laki', 'A', '2020-08-10', 'Bimbel', 'TK', 'Aktif');

-- --------------------------------------------------------

--
-- Struktur dari tabel `nilai_murid`
--

CREATE TABLE `nilai_murid` (
  `id` int(11) NOT NULL,
  `idMurid` varchar(12) NOT NULL,
  `namaMurid` text NOT NULL,
  `mapel` text NOT NULL,
  `tingkat` enum('SD','SMP','SMA') NOT NULL,
  `jenis` enum('UH','UTS','UAS') NOT NULL,
  `nilai` text NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `nilai_murid`
--

INSERT INTO `nilai_murid` (`id`, `idMurid`, `namaMurid`, `mapel`, `tingkat`, `jenis`, `nilai`) VALUES
(1, 'SM10001', 'Budiman', 'B. Indonesia', 'SMA', 'UH', '75'),
(2, 'MP7001', 'JN', 'Matematika', 'SMP', 'UH', '87|90'),
(3, 'MP7001', 'JN', 'B. Indonesia', 'SMP', 'UH', '86|78'),
(4, 'SD6002', 'Kayla', 'Matematika', 'SD', 'UH', '90|99'),
(5, 'SD6001', 'Jonathan Voice', 'Matematika', 'SD', 'UH', '75|80'),
(6, 'SD6002', 'Kayla', 'B. Indoneisa', 'SD', 'UH', '85|90'),
(7, 'SD6002', 'Kayla', 'PKN', 'SD', 'UH', '80'),
(8, 'SD6002', 'Kayla', 'PLBJ', 'SD', 'UH', '80'),
(9, 'SD6001', 'Jonathan Voice', 'B. Indoneisa', 'SD', 'UH', '80|90'),
(10, 'SD6001', 'Jonathan Voice', 'PJOK', 'SD', 'UH', '80'),
(11, 'MP7001', 'JN', 'Matematika', 'SMP', '', '90'),
(12, '', '', '', '', '', ''),
(13, '', '', '', '', '', ''),
(14, 'SD2001', 'Jason Giordano', 'Matematika', 'SD', 'UH', '80'),
(16, 'SD2001', 'Jason Giordano', 'B. Indoneisa', 'SD', 'UH', '90'),
(17, 'SD2001', 'Jason Giordano', 'B. Inggris', 'SD', 'UH', '85'),
(18, 'SD2001', 'Jason Giordano', 'Agama', 'SD', 'UH', '98');

-- --------------------------------------------------------

--
-- Struktur dari tabel `pembayaranmurid`
--

CREATE TABLE `pembayaranmurid` (
  `id_pembayaran` int(11) NOT NULL,
  `idMurid` varchar(12) NOT NULL,
  `tglBayar` date NOT NULL,
  `bulan` enum('Januari','Februari','Maret','April','Mei','Juni','Juli','Agustus','September','Oktober','November','Desember') NOT NULL,
  `total` text NOT NULL,
  `metodePembayaran` enum('Cash','Rekening BCA','OVO','DANA') NOT NULL,
  `tingkatan` enum('TK','SD','SMP','SMA') NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `pembayarantentor`
--

CREATE TABLE `pembayarantentor` (
  `id_bayar` int(11) NOT NULL,
  `tglBayar` date NOT NULL,
  `idTentor` varchar(12) COLLATE utf8_unicode_ci NOT NULL,
  `bulan` enum('Januari','Februari','Maret','April','Mei','Juni','Juli','Agustus','September','Oktober','November','Desember') COLLATE utf8_unicode_ci NOT NULL,
  `kehadiran` text COLLATE utf8_unicode_ci NOT NULL,
  `total` text COLLATE utf8_unicode_ci NOT NULL,
  `metodePembayaran` enum('Cash','Rekening BCA') COLLATE utf8_unicode_ci NOT NULL,
  `tingkatan` enum('TK','SD','SMP','SMA') COLLATE utf8_unicode_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `pembelian_kantin`
--

CREATE TABLE `pembelian_kantin` (
  `id_pembelian` int(11) NOT NULL,
  `kodeKantin` text COLLATE utf8_unicode_ci NOT NULL,
  `idMurid` varchar(12) COLLATE utf8_unicode_ci NOT NULL,
  `kuantitas` int(11) NOT NULL,
  `harga` text COLLATE utf8_unicode_ci NOT NULL,
  `jenis` enum('Alat Tulis','Makanan') COLLATE utf8_unicode_ci NOT NULL,
  `pembayaran` enum('Cash','OVO','DANA','Hutang') COLLATE utf8_unicode_ci NOT NULL,
  `tglBeli` date NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data untuk tabel `pembelian_kantin`
--

INSERT INTO `pembelian_kantin` (`id_pembelian`, `kodeKantin`, `idMurid`, `kuantitas`, `harga`, `jenis`, `pembayaran`, `tglBeli`) VALUES
(1, 'AT001', 'MP7001', 5, '12500', 'Alat Tulis', 'Cash', '2020-06-24'),
(2, 'MA001', 'SD6002', 1, '13000', 'Makanan', 'Cash', '2020-06-24'),
(3, 'AT001', 'SD6001', 3, '7500', 'Alat Tulis', 'Cash', '2020-06-24'),
(4, 'MA001', 'SD6001', 2, '26000', 'Makanan', 'Cash', '2020-07-16'),
(5, 'AT001', 'SD6002', 3, '7500', 'Alat Tulis', 'Hutang', '2020-07-16'),
(7, 'AT001', 'SD6001', 1, '2500', 'Alat Tulis', 'Cash', '2020-07-20'),
(8, 'MA001', 'SD6001', 1, '13000', 'Makanan', 'Hutang', '2020-07-20'),
(11, 'MA002', 'MP9002', 1, '15000', 'Makanan', 'Cash', '2020-07-23'),
(12, 'AT002', 'MP9002', 2, '5000', 'Alat Tulis', 'Hutang', '2020-07-23'),
(13, 'MA001', 'MP8006', 2, '30000', 'Makanan', 'Hutang', '2020-07-23');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tentor`
--

CREATE TABLE `tentor` (
  `idTentor` varchar(10) NOT NULL,
  `namaTentor` text NOT NULL,
  `pendidikan` text NOT NULL,
  `noHP` varchar(12) NOT NULL,
  `gender` enum('Laki-Laki','Perempuan') NOT NULL,
  `kelas` text NOT NULL,
  `tglDaftar` date NOT NULL,
  `paket` text NOT NULL,
  `hariMengajar` text NOT NULL,
  `tingkat` text NOT NULL,
  `jenisTentor` enum('Harian','Tetap') NOT NULL,
  `jamAjar` enum('10.00-20.00','11.00-19.00','14.00-20.00') NOT NULL,
  `status` enum('Aktif','Cuti') NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tentor`
--

INSERT INTO `tentor` (`idTentor`, `namaTentor`, `pendidikan`, `noHP`, `gender`, `kelas`, `tglDaftar`, `paket`, `hariMengajar`, `tingkat`, `jenisTentor`, `jamAjar`, `status`) VALUES
('TE006', 'Fiorent', 'SMK', '081293260958', 'Perempuan', 'A,B,2', '2020-07-16', 'Bimbel, Bahasa Inggris', 'Monday, Thursday, Tuesday, Friday, Wednesday', 'TK-SD', 'Tetap', '10.00-20.00', 'Aktif'),
('TE005', 'Catheryne', 'S1', '081385457080', 'Perempuan', '8', '2020-07-16', 'Bimbel', 'Friday', 'SMP', 'Tetap', '14.00-20.00', 'Aktif'),
('TE004', 'Gladys Patricia', 'S1', '089570263268', 'Perempuan', '6', '2020-07-16', 'Bimbel', 'Monday, Tuesday, Wednesday', 'TK-SD', 'Harian', '11.00-19.00', 'Aktif'),
('TE001', 'Cherryl Jasmine', 'S1', '08992483583', 'Perempuan', '9', '2020-07-16', 'Bimbel', 'Monday, Thursday, Tuesday, Friday, Wednesday', 'SMP', 'Tetap', '14.00-20.00', 'Aktif');

-- --------------------------------------------------------

--
-- Struktur dari tabel `user`
--

CREATE TABLE `user` (
  `idUser` varchar(16) NOT NULL,
  `username` varchar(16) NOT NULL,
  `password` varchar(16) NOT NULL,
  `role` text NOT NULL,
  `jenis` enum('Tentor','Murid','Admin') NOT NULL,
  `idLain` varchar(10) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `user`
--

INSERT INTO `user` (`idUser`, `username`, `password`, `role`, `jenis`, `idLain`) VALUES
('AD001', 'admin', 'admin', 'Administrasi', 'Admin', ''),
('TE001', 'Gladys', '1234', 'Akademik', 'Tentor', 'TE004'),
('TE002', 'Fiorent', '1234', 'Akademik', 'Tentor', 'TE006'),
('MU001', 'Jason', '1234', 'User', 'Murid', 'SD2001');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `absensi_murid`
--
ALTER TABLE `absensi_murid`
  ADD PRIMARY KEY (`id_absen`);

--
-- Indeks untuk tabel `absensi_tentor`
--
ALTER TABLE `absensi_tentor`
  ADD PRIMARY KEY (`id_absen`);

--
-- Indeks untuk tabel `biaya_bimbingan`
--
ALTER TABLE `biaya_bimbingan`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `honor_tentor`
--
ALTER TABLE `honor_tentor`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `kantin`
--
ALTER TABLE `kantin`
  ADD PRIMARY KEY (`kodeKantin`);

--
-- Indeks untuk tabel `kbm`
--
ALTER TABLE `kbm`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `mata_pelajaran`
--
ALTER TABLE `mata_pelajaran`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `murid`
--
ALTER TABLE `murid`
  ADD PRIMARY KEY (`idMurid`);

--
-- Indeks untuk tabel `nilai_murid`
--
ALTER TABLE `nilai_murid`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `pembayaranmurid`
--
ALTER TABLE `pembayaranmurid`
  ADD PRIMARY KEY (`id_pembayaran`);

--
-- Indeks untuk tabel `pembayarantentor`
--
ALTER TABLE `pembayarantentor`
  ADD PRIMARY KEY (`id_bayar`);

--
-- Indeks untuk tabel `pembelian_kantin`
--
ALTER TABLE `pembelian_kantin`
  ADD PRIMARY KEY (`id_pembelian`);

--
-- Indeks untuk tabel `tentor`
--
ALTER TABLE `tentor`
  ADD PRIMARY KEY (`idTentor`);

--
-- Indeks untuk tabel `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`idUser`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `absensi_murid`
--
ALTER TABLE `absensi_murid`
  MODIFY `id_absen` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT untuk tabel `absensi_tentor`
--
ALTER TABLE `absensi_tentor`
  MODIFY `id_absen` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT untuk tabel `biaya_bimbingan`
--
ALTER TABLE `biaya_bimbingan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT untuk tabel `honor_tentor`
--
ALTER TABLE `honor_tentor`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT untuk tabel `kbm`
--
ALTER TABLE `kbm`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT untuk tabel `mata_pelajaran`
--
ALTER TABLE `mata_pelajaran`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;

--
-- AUTO_INCREMENT untuk tabel `nilai_murid`
--
ALTER TABLE `nilai_murid`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT untuk tabel `pembayaranmurid`
--
ALTER TABLE `pembayaranmurid`
  MODIFY `id_pembayaran` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT untuk tabel `pembayarantentor`
--
ALTER TABLE `pembayarantentor`
  MODIFY `id_bayar` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `pembelian_kantin`
--
ALTER TABLE `pembelian_kantin`
  MODIFY `id_pembelian` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
