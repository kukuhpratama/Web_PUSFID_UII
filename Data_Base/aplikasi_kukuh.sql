-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 22 Apr 2019 pada 20.46
-- Versi server: 10.1.38-MariaDB
-- Versi PHP: 7.2.15

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `aplikasi_kukuh`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `admin`
--

CREATE TABLE `admin` (
  `id_admin` int(15) NOT NULL,
  `nama_admin` varchar(255) NOT NULL,
  `email_admin` varchar(255) NOT NULL,
  `password_admin` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `admin`
--

INSERT INTO `admin` (`id_admin`, `nama_admin`, `email_admin`, `password_admin`) VALUES
(1, 'Admin PUSFID UII', 'admin@uii.ac.id', '18f139b72aeade9cadd587c4e14b2af744ded5e9');

-- --------------------------------------------------------

--
-- Struktur dari tabel `detail_penugasan`
--

CREATE TABLE `detail_penugasan` (
  `id_detail_penugasan` int(15) NOT NULL,
  `id_penugasan` int(15) NOT NULL,
  `id_pegawai` int(15) NOT NULL,
  `tugas` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `detail_sampel`
--

CREATE TABLE `detail_sampel` (
  `id_detail_sampel` int(15) NOT NULL,
  `id_sampel` int(11) NOT NULL,
  `pabrik_sampel` varchar(255) NOT NULL,
  `model_sampel` varchar(255) NOT NULL,
  `nomor_seri_sampel` varchar(255) NOT NULL,
  `kondisi_sampel` varchar(255) NOT NULL,
  `foto_ime` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `detail_verifikasi`
--

CREATE TABLE `detail_verifikasi` (
  `id_detail_verifikasi` int(15) NOT NULL,
  `id_verifikasi` int(15) NOT NULL,
  `id_pegawai` int(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `foto_permohonan`
--

CREATE TABLE `foto_permohonan` (
  `id_foto_permohonan` int(11) NOT NULL,
  `id_permohonan` int(11) NOT NULL,
  `foto` varchar(225) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `hasil_pengujian`
--

CREATE TABLE `hasil_pengujian` (
  `id_pengujian` int(15) NOT NULL,
  `id_permohonan` int(15) NOT NULL,
  `file_pengujian` varchar(255) NOT NULL,
  `status_pengujian` varchar(255) NOT NULL,
  `keterangan_pengujian` text NOT NULL,
  `keterangan_pegawai` varchar(255) NOT NULL,
  `status_pesan_klien` varchar(255) NOT NULL,
  `status_pesan_pegawai` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `histori`
--

CREATE TABLE `histori` (
  `id_history` int(15) NOT NULL,
  `id_pegawai` int(15) NOT NULL,
  `waktu_history` datetime NOT NULL,
  `aktivitas` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `keputusan_sampel`
--

CREATE TABLE `keputusan_sampel` (
  `id_keputusan` int(15) NOT NULL,
  `id_penerima` int(15) NOT NULL,
  `nomor_keputusan` varchar(255) NOT NULL,
  `tgl_keputusan` datetime NOT NULL,
  `status_keputusan` varchar(255) NOT NULL,
  `id_pegawai` int(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `klien`
--

CREATE TABLE `klien` (
  `id_klien` int(11) NOT NULL,
  `nama_klien` varchar(255) NOT NULL,
  `nik_klien` varchar(255) NOT NULL,
  `alamat_klien` text NOT NULL,
  `username_klien` varchar(255) NOT NULL,
  `password_klien` varchar(255) NOT NULL,
  `foto_klien` varchar(255) NOT NULL,
  `telpon_klien` varchar(255) NOT NULL,
  `email_klien` varchar(255) NOT NULL,
  `provinsi` varchar(255) NOT NULL,
  `status_klien` varchar(255) NOT NULL DEFAULT 'enabled'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `pegawai`
--

CREATE TABLE `pegawai` (
  `id_pegawai` int(15) NOT NULL,
  `nama_pegawai` varchar(255) NOT NULL,
  `email_pegawai` varchar(255) NOT NULL,
  `password_pegawai` varchar(255) NOT NULL,
  `jabatan_pegawai` varchar(255) NOT NULL,
  `foto_tanda_pegawai` varchar(255) NOT NULL,
  `jenis_kelamin` varchar(255) NOT NULL,
  `alamat_pegawai` text NOT NULL,
  `telepone_pegawai` varchar(255) NOT NULL,
  `status_pegawai` varchar(255) NOT NULL DEFAULT 'enabled'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `penerima`
--

CREATE TABLE `penerima` (
  `id_penerima` int(15) NOT NULL,
  `id_permohonan` int(15) NOT NULL,
  `nomor_penerima` varchar(255) NOT NULL,
  `tgl_penerima` datetime NOT NULL,
  `id_pegawai` int(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `penugasan`
--

CREATE TABLE `penugasan` (
  `id_penugasan` int(15) NOT NULL,
  `id_penerima` int(15) NOT NULL,
  `tgl_penugasan` datetime NOT NULL,
  `nomor_penugasan` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `permohonan`
--

CREATE TABLE `permohonan` (
  `id_permohonan` int(15) NOT NULL,
  `judul_permohonan` varchar(225) NOT NULL,
  `nomor_permohonan` varchar(255) NOT NULL,
  `id_klien` int(15) NOT NULL,
  `tgl_permohonan` datetime NOT NULL,
  `isi_permohonan` text NOT NULL,
  `status_permohonan` varchar(255) NOT NULL,
  `tgl_verifikasi_permohonan` datetime NOT NULL,
  `note_permohonan` text NOT NULL,
  `surat_permohonan` varchar(225) NOT NULL,
  `status_akhir` varchar(225) NOT NULL,
  `jumlah_sampel` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `riwayat_pengujian`
--

CREATE TABLE `riwayat_pengujian` (
  `id_riwayat_pengujian` int(11) NOT NULL,
  `id_pengujian` int(11) NOT NULL,
  `waktu` datetime NOT NULL,
  `keterangan` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `sampel`
--

CREATE TABLE `sampel` (
  `id_sampel` int(15) NOT NULL,
  `jenis_sampel` varchar(255) NOT NULL,
  `spesifikasi_sampel` varchar(255) NOT NULL,
  `jumlah_sampel` varchar(255) NOT NULL,
  `ket_sampel` text NOT NULL,
  `identitas_sampel` text NOT NULL,
  `id_penerima` int(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `verifikasi`
--

CREATE TABLE `verifikasi` (
  `id_verifikasi` int(15) NOT NULL,
  `id_permohonan` int(15) NOT NULL,
  `nomor_verifikasi` varchar(255) NOT NULL,
  `tgl_verifikasi` datetime NOT NULL,
  `status_verifikasi` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id_admin`);

--
-- Indeks untuk tabel `detail_penugasan`
--
ALTER TABLE `detail_penugasan`
  ADD PRIMARY KEY (`id_detail_penugasan`),
  ADD KEY `id_penugasan` (`id_penugasan`),
  ADD KEY `id_pegawai` (`id_pegawai`);

--
-- Indeks untuk tabel `detail_sampel`
--
ALTER TABLE `detail_sampel`
  ADD PRIMARY KEY (`id_detail_sampel`),
  ADD KEY `id_sampel` (`id_sampel`);

--
-- Indeks untuk tabel `detail_verifikasi`
--
ALTER TABLE `detail_verifikasi`
  ADD PRIMARY KEY (`id_detail_verifikasi`),
  ADD KEY `id_verifikasi` (`id_verifikasi`),
  ADD KEY `id_pegawai` (`id_pegawai`);

--
-- Indeks untuk tabel `foto_permohonan`
--
ALTER TABLE `foto_permohonan`
  ADD PRIMARY KEY (`id_foto_permohonan`),
  ADD KEY `id_permohonan` (`id_permohonan`);

--
-- Indeks untuk tabel `hasil_pengujian`
--
ALTER TABLE `hasil_pengujian`
  ADD PRIMARY KEY (`id_pengujian`),
  ADD KEY `id_permohonan` (`id_permohonan`);

--
-- Indeks untuk tabel `histori`
--
ALTER TABLE `histori`
  ADD PRIMARY KEY (`id_history`),
  ADD KEY `id_pegawai` (`id_pegawai`);

--
-- Indeks untuk tabel `keputusan_sampel`
--
ALTER TABLE `keputusan_sampel`
  ADD PRIMARY KEY (`id_keputusan`),
  ADD KEY `id_penerima` (`id_penerima`),
  ADD KEY `id_pegawai` (`id_pegawai`);

--
-- Indeks untuk tabel `klien`
--
ALTER TABLE `klien`
  ADD PRIMARY KEY (`id_klien`);

--
-- Indeks untuk tabel `pegawai`
--
ALTER TABLE `pegawai`
  ADD PRIMARY KEY (`id_pegawai`);

--
-- Indeks untuk tabel `penerima`
--
ALTER TABLE `penerima`
  ADD PRIMARY KEY (`id_penerima`),
  ADD KEY `id_permohonan` (`id_permohonan`),
  ADD KEY `id_pegawai` (`id_pegawai`);

--
-- Indeks untuk tabel `penugasan`
--
ALTER TABLE `penugasan`
  ADD PRIMARY KEY (`id_penugasan`),
  ADD KEY `id_penerima` (`id_penerima`);

--
-- Indeks untuk tabel `permohonan`
--
ALTER TABLE `permohonan`
  ADD PRIMARY KEY (`id_permohonan`),
  ADD KEY `id_klien` (`id_klien`);

--
-- Indeks untuk tabel `riwayat_pengujian`
--
ALTER TABLE `riwayat_pengujian`
  ADD PRIMARY KEY (`id_riwayat_pengujian`),
  ADD KEY `id_pengujian` (`id_pengujian`);

--
-- Indeks untuk tabel `sampel`
--
ALTER TABLE `sampel`
  ADD PRIMARY KEY (`id_sampel`),
  ADD KEY `id_penerima` (`id_penerima`);

--
-- Indeks untuk tabel `verifikasi`
--
ALTER TABLE `verifikasi`
  ADD PRIMARY KEY (`id_verifikasi`),
  ADD KEY `id_permohonan` (`id_permohonan`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `admin`
--
ALTER TABLE `admin`
  MODIFY `id_admin` int(15) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `detail_penugasan`
--
ALTER TABLE `detail_penugasan`
  MODIFY `id_detail_penugasan` int(15) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT untuk tabel `detail_sampel`
--
ALTER TABLE `detail_sampel`
  MODIFY `id_detail_sampel` int(15) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT untuk tabel `detail_verifikasi`
--
ALTER TABLE `detail_verifikasi`
  MODIFY `id_detail_verifikasi` int(15) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT untuk tabel `foto_permohonan`
--
ALTER TABLE `foto_permohonan`
  MODIFY `id_foto_permohonan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT untuk tabel `hasil_pengujian`
--
ALTER TABLE `hasil_pengujian`
  MODIFY `id_pengujian` int(15) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT untuk tabel `histori`
--
ALTER TABLE `histori`
  MODIFY `id_history` int(15) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=96;

--
-- AUTO_INCREMENT untuk tabel `keputusan_sampel`
--
ALTER TABLE `keputusan_sampel`
  MODIFY `id_keputusan` int(15) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `klien`
--
ALTER TABLE `klien`
  MODIFY `id_klien` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `pegawai`
--
ALTER TABLE `pegawai`
  MODIFY `id_pegawai` int(15) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `penerima`
--
ALTER TABLE `penerima`
  MODIFY `id_penerima` int(15) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT untuk tabel `penugasan`
--
ALTER TABLE `penugasan`
  MODIFY `id_penugasan` int(15) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT untuk tabel `permohonan`
--
ALTER TABLE `permohonan`
  MODIFY `id_permohonan` int(15) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT untuk tabel `riwayat_pengujian`
--
ALTER TABLE `riwayat_pengujian`
  MODIFY `id_riwayat_pengujian` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT untuk tabel `sampel`
--
ALTER TABLE `sampel`
  MODIFY `id_sampel` int(15) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT untuk tabel `verifikasi`
--
ALTER TABLE `verifikasi`
  MODIFY `id_verifikasi` int(15) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `detail_penugasan`
--
ALTER TABLE `detail_penugasan`
  ADD CONSTRAINT `detail_penugasan_ibfk_1` FOREIGN KEY (`id_pegawai`) REFERENCES `pegawai` (`id_pegawai`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `detail_penugasan_ibfk_2` FOREIGN KEY (`id_penugasan`) REFERENCES `penugasan` (`id_penugasan`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `detail_sampel`
--
ALTER TABLE `detail_sampel`
  ADD CONSTRAINT `detail_sampel_ibfk_1` FOREIGN KEY (`id_sampel`) REFERENCES `sampel` (`id_sampel`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `detail_verifikasi`
--
ALTER TABLE `detail_verifikasi`
  ADD CONSTRAINT `detail_verifikasi_ibfk_1` FOREIGN KEY (`id_pegawai`) REFERENCES `pegawai` (`id_pegawai`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `detail_verifikasi_ibfk_2` FOREIGN KEY (`id_verifikasi`) REFERENCES `verifikasi` (`id_verifikasi`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `foto_permohonan`
--
ALTER TABLE `foto_permohonan`
  ADD CONSTRAINT `foto_permohonan_ibfk_1` FOREIGN KEY (`id_permohonan`) REFERENCES `permohonan` (`id_permohonan`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `hasil_pengujian`
--
ALTER TABLE `hasil_pengujian`
  ADD CONSTRAINT `hasil_pengujian_ibfk_1` FOREIGN KEY (`id_permohonan`) REFERENCES `permohonan` (`id_permohonan`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `histori`
--
ALTER TABLE `histori`
  ADD CONSTRAINT `histori_ibfk_1` FOREIGN KEY (`id_pegawai`) REFERENCES `pegawai` (`id_pegawai`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `keputusan_sampel`
--
ALTER TABLE `keputusan_sampel`
  ADD CONSTRAINT `keputusan_sampel_ibfk_1` FOREIGN KEY (`id_pegawai`) REFERENCES `pegawai` (`id_pegawai`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `keputusan_sampel_ibfk_2` FOREIGN KEY (`id_penerima`) REFERENCES `penerima` (`id_penerima`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `penerima`
--
ALTER TABLE `penerima`
  ADD CONSTRAINT `penerima_ibfk_1` FOREIGN KEY (`id_pegawai`) REFERENCES `pegawai` (`id_pegawai`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `penerima_ibfk_2` FOREIGN KEY (`id_permohonan`) REFERENCES `permohonan` (`id_permohonan`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `penugasan`
--
ALTER TABLE `penugasan`
  ADD CONSTRAINT `penugasan_ibfk_1` FOREIGN KEY (`id_penerima`) REFERENCES `penerima` (`id_penerima`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `permohonan`
--
ALTER TABLE `permohonan`
  ADD CONSTRAINT `permohonan_ibfk_1` FOREIGN KEY (`id_klien`) REFERENCES `klien` (`id_klien`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `riwayat_pengujian`
--
ALTER TABLE `riwayat_pengujian`
  ADD CONSTRAINT `riwayat_pengujian_ibfk_1` FOREIGN KEY (`id_pengujian`) REFERENCES `hasil_pengujian` (`id_pengujian`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `sampel`
--
ALTER TABLE `sampel`
  ADD CONSTRAINT `sampel_ibfk_1` FOREIGN KEY (`id_penerima`) REFERENCES `penerima` (`id_penerima`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `verifikasi`
--
ALTER TABLE `verifikasi`
  ADD CONSTRAINT `verifikasi_ibfk_1` FOREIGN KEY (`id_permohonan`) REFERENCES `permohonan` (`id_permohonan`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
