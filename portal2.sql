-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Aug 13, 2025 at 11:51 PM
-- Server version: 8.0.30
-- PHP Version: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `portal2`
--

-- --------------------------------------------------------

--
-- Table structure for table `agendas`
--

CREATE TABLE `agendas` (
  `id` bigint UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `judul` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `lokasi` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `dresscode` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `deskripsi` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `tanggal_mulai` datetime DEFAULT NULL,
  `waktu_mulai` time DEFAULT NULL,
  `opsi_waktu_selesai` enum('tentukan','selesai') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT 'tentukan',
  `waktu_selesai_text` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `waktu_selesai` time DEFAULT NULL,
  `tanggal_selesai` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `agendas`
--

INSERT INTO `agendas` (`id`, `created_at`, `updated_at`, `judul`, `lokasi`, `dresscode`, `deskripsi`, `tanggal_mulai`, `waktu_mulai`, `opsi_waktu_selesai`, `waktu_selesai_text`, `waktu_selesai`, `tanggal_selesai`) VALUES
(5, '2025-08-03 06:38:19', '2025-08-03 07:40:24', 'Upacara Pengibaran Bendera HUT RI', 'Alun alun ', 'Korpri', 'hut ri', '2025-08-17 00:00:00', '07:00:00', 'tentukan', 's.d selesai', '09:00:00', '2025-08-17 00:00:00'),
(6, '2025-08-03 07:44:14', '2025-08-07 06:43:28', 'Upacara Penurunan Bendera HUT RI', 'Alun alun RANGKASBITUNG', 'KORPRI', 'pemberitahuan untuk semua asn kabupaten lebak yang mendapatkan jadwal upcara penurunan bendera, di himbau membawa bendera masing- masing', '2025-08-17 00:00:00', '17:00:00', 'selesai', 's.d selesai', NULL, '2025-08-17 00:00:00'),
(7, '2025-08-03 07:45:52', '2025-08-03 07:45:52', 'Renungan Suci Di taman makam Pahlawan', 'Taman Makam Pahlawan Rangkasbitung Kab. Lebak', 'KORPRI', 'Untuk Semua ASN yang mendapatkan jadwal renungan suci, dilarang keras untuk menggunakan kamera tanpa se ijin penyelenggara', '2025-08-16 00:00:00', '23:00:00', 'selesai', 's.d selesai', NULL, '2025-08-17 00:00:00'),
(8, '2025-08-03 07:47:39', '2025-08-04 01:41:49', 'Pawai Pembangunan', 'Alun alun ', 'sesuai yang sudah di tentukan', 'Untuk semua Instansi, Sekolah, dan instansi lainnya di pemerintah kabupaten lebak, di himbau agar mengikuti pawai pembangunan pada waktu yang sudah di tentukan ppp', '2025-08-17 00:00:00', '14:00:00', 'selesai', 's.d selesai', NULL, '2025-08-17 00:00:00'),
(9, '2025-08-07 05:54:59', '2025-08-07 05:54:59', 'Seba baduy', 'Alun alun ', 'pakain adat Baduy', 'fdfdfd', '2025-08-07 00:00:00', '20:54:47', 'selesai', NULL, NULL, '2025-08-09 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `banners`
--

CREATE TABLE `banners` (
  `id` bigint UNSIGNED NOT NULL,
  `judul` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `gambar` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `kategori` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `category` enum('ucapan','infografis') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `banners`
--

INSERT INTO `banners` (`id`, `judul`, `gambar`, `slug`, `kategori`, `category`, `created_at`, `updated_at`) VALUES
(3, 'Ucapan hari Kartini 2022', 'banner/hari-kartini-2022b.png', 'ucapan-hari-kartini-2022', 'ucapan', 'ucapan', '2025-07-28 02:26:01', '2025-08-05 06:31:22'),
(4, 'ucapan04', 'banner/kangker hari.jpg', 'ucapan04', 'ucapan', 'ucapan', '2025-07-28 02:28:52', '2025-07-28 02:29:01'),
(5, 'infograffis6', 'banner/imbauan idul fitri.png', 'infograffis6', 'infografis', 'ucapan', '2025-07-28 18:59:34', '2025-07-28 18:59:34'),
(12, 'Pendataan Penduduk', 'banner/pendataan penduduk.png', 'pendataan-penduduk', 'infografis', 'ucapan', '2025-08-05 20:16:07', '2025-08-05 20:16:07'),
(13, 'Pengalihan Jalur Kendaraan', 'banner/benner jalur jalan.png', 'pengalihan-jalur-kendaraan', 'infografis', 'ucapan', '2025-08-05 20:16:57', '2025-08-05 20:16:57'),
(14, 'Ucapan hari konsumen', 'banner/hari konsumen 2022nnn.png', 'ucapan-hari-konsumen', 'ucapan', 'ucapan', '2025-08-05 20:17:41', '2025-08-05 20:17:41'),
(15, 'UcapaHari Kanker Sedunia', 'banner/kangker hari.jpg', 'ucapahari-kanker-sedunia', 'ucapan', 'ucapan', '2025-08-05 20:18:07', '2025-08-05 20:18:07'),
(16, 'Himbauan Idul Fitri', 'banner/imbauan idul fitri.png', 'himbauan-idul-fitri', 'infografis', 'ucapan', '2025-08-05 20:18:49', '2025-08-05 20:18:49');

-- --------------------------------------------------------

--
-- Table structure for table `beritas`
--

CREATE TABLE `beritas` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED DEFAULT NULL,
  `judul` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `penulis` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `kategori_id` bigint UNSIGNED DEFAULT NULL,
  `thumbnail` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `konten` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` enum('draft','published') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'draft',
  `tanggal_publish` date DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `beritas`
--

INSERT INTO `beritas` (`id`, `user_id`, `judul`, `slug`, `penulis`, `kategori_id`, `thumbnail`, `konten`, `status`, `tanggal_publish`, `is_active`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, NULL, 'Bupati Lebak Berikan Kadeudeuh kepada Juara MTQ Tingkat Provinsi Banten Tahun 2025', 'bupati-lebak-berikan-kadeudeuh-kepada-juara-mtq-tingkat-provinsi-banten-tahun-2025', NULL, 3, 'berita/thumbnails/yRUUlY70wtvj7s0RLB0GGmYVPUzHBe-metaYmVyaXRhMS5qcGVn-.jpeg', '<p>Lebak – Sebagai bentuk apresiasi atas prestasi gemilang yang telah mengharumkan nama Kabupaten Lebak di tingkat provinsi, Bupati Lebak memberikan kadeudeuh kepada para juara Musabaqah Tilawatil Qur’an (MTQ) XXII Tingkat Provinsi Banten Tahun 2025. Pemberian penghargaan ini ditujukan kepada para kafilah yang berhasil meraih juara dalam berbagai cabang lomba MTQ yang digelar secara kompetitif dan penuh semangat syiar Islam.</p><p>Sebanyak 13 peserta dari Kabupaten Lebak tercatat sebagai penerima penghargaan atas prestasi yang diraih di ajang MTQ tingkat Provinsi tersebut. Mereka berhasil menorehkan prestasi membanggakan di berbagai cabang seperti Hafalan Hadis, Tilawah, Tahfidz, Qira’at, dan Syahril Qur’an.</p><p>Berikut ini adalah daftar para juara yang menerima kadeudeuh dari Bupati Lebak:</p><p>Nurul Amanila Hasna – Juara I Hafalan 100 Hadis Dengan Sanad Puteri</p><p>Muhamad Ikmal Daron – Juara I Tilawah Anak-Anak Putera</p><p>Winaya Azalia Kirana – Juara I Syahril Qur’an Puteri</p><p>Enji Fauziah – Juara I Syahril Qur’an Puteri</p><p>Sri Mulyani – Juara I Syahril Qur’an Puteri</p><p>Hoirun Nadiah – Juara III Tahfidz 20 Juz Puteri</p><p>Eri Rosanti – Juara III Hafalan 500 Hadis Tanpa Sanad Puteri</p><p>Muhamad Almuizul Kahfi – Juara III QS. Murottal Dewasa Putera</p><p>M. Fattahul La’ali – Juara III Tahfidz 20 Juz Putra</p><p>Muhamad Gofar – Juara III MQK Ula Putra</p><p>Upiyani – Juara III MQK Ulya Putri</p><p>Hilyatunissa – Juara III Tilawah Remaja Puteri</p><p>Aan Hidayat – Harapan I Qira’at Al Qur’an Mujawwad Dewasa Putera</p>', 'published', '2025-07-22', 1, '2025-07-21 20:33:45', '2025-07-25 01:04:16', NULL),
(9, NULL, 'Bupati Lebak Kukuhkan Dekranasda, Bunda PAUD & Luncurkan Koperasi Merah Putih', 'bupati-lebak-kukuhkan-dekranasda-bunda-paud-luncurkan-koperasi-merah-putih', NULL, 2, 'berita/thumbnails/wP2x0HisJcePkZgggyv7wQjllDbepv-metaQnVwYXRpIExlYmFrIEt1a3Voa2FuIERla3JhbmFzZGEsIEJ1bmRhIFBBVUQgJiBMdW5jdXJrYW4gS29wZXJhc2kgTWVyYWggUHV0aWguanBlZw==-.jpeg', '<p>Lebak, Kamis, 12 Juni 2025 — Pemerintah Kabupaten Lebak menggelar rangkaian kegiatan penting yang sarat nilai strategis dalam pembangunan daerah, bertempat di Pendopo Kabupaten Lebak, dengan tajuk Pengukuhan Pengurus Dewan Kerajinan Nasional Daerah (Dekranasda) Kabupaten Lebak &amp; Bunda PAUD Kabupaten Lebak, Pelantikan POKJA Bunda PAUD dan Bunda PAUD Kecamatan Masa Bakti 2025–2030, serta Penandatanganan Akta Pendirian Koperasi Desa/Kelurahan Merah Putih.</p><p>Kegiatan ini dihadiri langsung oleh Bupati Lebak, Sekretaris Daerah Kabupaten Lebak, Ketua DPRD Kabupaten Lebak, Perwakilan Dekranasda Provinsi Banten, serta diikuti oleh para Kepala Organisasi Perangkat Daerah (OPD) dan para Camat se-Kabupaten Lebak.</p><p>Rangkaian acara diawali dengan pengukuhan Pengurus Dekranasda Kabupaten Lebak yang bertujuan untuk memperkuat sinergi antara pemerintah daerah, pelaku UMKM, dan pengrajin lokal dalam upaya pelestarian dan pengembangan produk kerajinan khas Lebak. Pengurus yang baru dikukuhkan diharapkan dapat mendorong kemajuan sektor ekonomi kreatif serta memperluas pasar kerajinan daerah di level nasional maupun internasional.</p>', 'published', NULL, 1, '2025-07-22 19:39:16', '2025-07-24 22:28:54', NULL),
(15, NULL, 'Bupati Lebak Hadiri Rakorda FSPP, Perkuat Sinergi Pesantren Menuju Lebak RUHAY', 'bupati-lebak-hadiri-rakorda-fspp-perkuat-sinergi-pesantren-menuju-lebak-ruhay', NULL, 2, 'berita/thumbnails/VRTCGj4RkSAqtAPxp1pwOSOBkUXRnj-metaYmVyaXRhNS5qcGVn-.jpeg', '<p>Lebak – Bupati Lebak, H. Hasbi Asyidiki Jayabaya, menghadiri Rapat Koordinasi Daerah (Rakorda) Forum Silaturahmi Pondok Pesantren (FSPP) tingkat Kabupaten Lebak yang digelar pada Rabu, 4 Juni 2025, bertempat di Aula Latansa, Pondok Pesantren Latansa, Rangkasbitung. Kegiatan ini menjadi momentum penting dalam mempererat ukhuwah antarpesantren serta memperkuat peran strategis pesantren dalam pembangunan daerah.</p><p>Rakorda FSPP ini turut dihadiri oleh unsur Forum Koordinasi Pimpinan Daerah (Forkopimda) Kabupaten Lebak, Asisten Pemerintahan dan Kesejahteraan Rakyat Setda Lebak, para Kepala Organisasi Perangkat Daerah (OPD) di lingkungan Pemkab Lebak, Ketua FSPP Provinsi Banten, serta para pengurus FSPP Kecamatan se-Kabupaten Lebak.</p><p>Ketua Presidium FSPP Kabupaten Lebak, Kyai Ade Bujhaerimi, dalam sambutannya menekankan pentingnya kolaborasi antara pesantren dan pemerintah daerah dalam membangun sumber daya manusia yang berkualitas, berakhlakul karimah, dan siap menghadapi tantangan zaman. Ia juga menyampaikan apresiasi atas dukungan Pemkab Lebak terhadap pengembangan pesantren di berbagai sektor.</p>', 'published', NULL, 1, '2025-07-24 18:59:50', '2025-07-25 02:19:15', NULL),
(21, NULL, 'Pemkab Lebak Gelar Musrenbang RPJMD 2025–2029, Dorong Sinergitas Menuju Indonesia Emas 2045', 'pemkab-lebak-gelar-musrenbang-rpjmd-2025-2029-dorong-sinergitas-menuju-indonesia-emas-2045', NULL, 2, 'berita/thumbnails/0nhqwGpuXr2iCIKLwDucuOguHiNacr-metaV2hhdHNBcHAtSW1hZ2UtMjAyNS0wNi0xMS1hdC0xMy4wMS40OC5qcGVn-.jpeg', '<p>Lebak – Pemerintah Kabupaten Lebak melalui Badan Perencanaan Pembangunan, Riset, dan Inovasi Daerah (Baperida) menyelenggarakan Musyawarah Perencanaan Pembangunan Daerah (Musrenbang) dalam rangka penyusunan Rencana Pembangunan Jangka Menengah Daerah (RPJMD) Kabupaten Lebak Tahun 2025–2029. Kegiatan ini berlangsung pada Rabu, 11 Juni 2025 bertempat di Aula Multatuli, Sekretariat Daerah Kabupaten Lebak.</p><p>Musrenbang RPJMD kali ini menjadi momentum penting dalam menyelaraskan visi pembangunan daerah dengan Visi Indonesia 2029, menuju Indonesia Emas 2045.</p><p>Sekretaris Daerah Kabupaten Lebak, Budi Santoso, dalam sambutannya menyampaikan bahwa saat ini Pemerintah Daerah tengah menyusun tiga dokumen perencanaan utama, yakni RPJMD, Rencana Kerja Pemerintah Daerah (RKPD), dan Rancangan Perubahan Anggaran Pendapatan dan Belanja Daerah (R-PAPBD). “Ketiga dokumen ini menjadi fokus bersama dalam menjamin penganggaran yang terencana, akuntabel, dan tepat sasaran,” ujarnya.</p><p>Sementara itu, Bupati Lebak, H. Hasbi Asyidiki Jayabaya, sebelum membuka kegiatan secara resmi, menekankan pentingnya membangun sinergitas yang tidak hanya terbatas di tingkat pimpinan, melainkan juga melalui kepemimpinan yang kuat di seluruh lapisan pemerintahan.</p><p>“RPJMD yang disusun harus sederhana, realistis, dan mampu menjawab kebutuhan masyarakat. Anggaran pembangunan harus tepat guna dan tepat sasaran,” tegas Bupati.<br>Musrenbang RPJMD ini juga dilaksanakan secara virtual, menghadirkan narasumber dari Pemerintah Provinsi Banten dan Kementerian Perencanaan Pembangunan Nasional/Bappenas RI. Kegiatan ini bertujuan untuk menghimpun masukan dari berbagai pemangku kepentingan, guna memperkuat substansi RPJMD Kabupaten Lebak 2025–2029 agar lebih partisipatif, terarah, dan selaras dengan agenda pembangunan nasional.</p>', 'published', NULL, 1, '2025-07-24 21:42:56', '2025-07-25 02:19:10', NULL),
(22, NULL, 'cek beriata', 'cek-beriata', NULL, 7, 'berita/thumbnails/xo3YXQ0UWR30BysNJHNwfaEBWCLfUs-metaUGVta2FiIExlYmFrIEdlbGFyIEhhbGFsIEJpaGFsYWwgSWR1bCBGaXRyaSAxNDQ2IEhpanJpYWggVGFodW4gMjAyNS5qcGVn-.jpeg', '<p>dfdfdf</p>', 'published', NULL, 1, '2025-07-25 00:00:34', '2025-08-12 00:07:37', '2025-08-12 00:07:37'),
(32, NULL, 'Bupati Lebak Terima Audiensi Para Finalis Saija Adinda Kabupaten Lebak', 'bupati-lebak-terima-audiensi-para-finalis-saija-adinda-kabupaten-lebak', NULL, 7, 'berita/thumbnails/01K1W849KTGH5Z8511PXA76FB8.jpg', '<p>Lebak,- Bupati Lebak Moch. Hasbi Asyidiki Jayabaya bersama Ketua TP. PKK Lebak Belia Hasbi Jayabaya menerima audiensi para finalis saija adinda Kabupaten Lebak Tahun 2025, bertempat di Gedung Negara Kabupaten Lebak, Jum\'at (01/08/2025) Audiensi ini merupakan rangkaian dari kegiatan karantina menjelang pemilihan Saija Adinda Kabupaten Lebak 2025.…</p>', 'published', NULL, 1, '2025-08-04 21:34:12', '2025-08-04 21:34:12', NULL),
(33, NULL, 'Wakil Bupati Lebak Sosialisasikan Penataan PKL Rangkasbitung', 'wakil-bupati-lebak-sosialisasikan-penataan-pkl-rangkasbitung', NULL, 3, 'berita/thumbnails/01K2EJBHQN64EX0XHFGM2GYM2R.jpeg', '<p>Lebak, – Wakil Bupati Lebak, Amir Hamzah, memberikan sosialisasi lanjutan kepada para perwakilan Pedagang Kaki Lima (PKL) Pasar Kalijaga Rangkasbitung tentang rencana penataan dan relokasi pedagang. Bertempat di Ruang Kerja Wakil Bupati Lebak, Rabu (6/8/2025).</p><p>Sosialisasi ini membahas rencana pemindahan para pedagang kaki lima di wilayah Pasar Kalijaga Rangkasbitung ke Pasar Semi. Pemerintah memastikan akan memberikan fasilitas berupa tempat, kios dagang, keamanan, dan sarana pendukung lainnya.</p>', 'published', NULL, 1, '2025-08-12 00:19:15', '2025-08-12 00:21:02', NULL),
(34, NULL, 'Wakil bupati Lebak hadiri konferensi PGRI Kabupaten Lebak ke – XXIII masa Bakti 2025 – 2030', 'wakil-bupati-lebak-hadiri-konferensi-pgri-kabupaten-lebak-ke-xxiii-masa-bakti-2025-2030', NULL, 6, 'berita/thumbnails/01K2EJVTVBS1R8VYYGFV18M7EZ.jpeg', '<p>Lebak,- Wakil Bupati Lebak, H. Amir Hamzah didampingi Kepala BKAD dan Kepala Bagian Kesra Setda Lebak menghadiri Konferensi Persatuan Guru Republik Indonesia (PGRI) Kabupaten Lebak ke-XXIII Masa Bhakti 2025–2030 yang diselenggarakan di Gedung Balai Penjaminan Mutu Pendidikan (BPMP) Provinsi Banten, pada Rabu (6/8/2025).</p><p>Konferensi ini merupakan momentum penting bagi PGRI Kabupaten Lebak untuk menetapkan program kerja dan kepengurusan baru guna menghadapi tantangan pendidikan ke depan, sekaligus memperkuat sinergi antara pemerintah daerah dan para pendidik dalam upaya meningkatkan mutu pendidikan di Kabupaten Lebak.</p><p>Dalam sambutannya, Wakil Bupati mengapresiasi peran aktif PGRI dalam meningkatkan kualitas pendidikan di Kabupaten Lebak. Ia menegaskan bahwa guru adalah ujung tombak dalam mencetak generasi unggul.</p><p>“Konferensi ini bukan hanya sekadar rutinitas organisasi, tetapi merupakan ajang konsolidasi dan refleksi untuk memperkuat peran PGRI dalam membangun dunia pendidikan yang lebih baik. Kami berharap, sinergi antara PGRI dan pemerintah daerah dapat terus ditingkatkan demi kemajuan pendidikan di Lebak,” ujar Wakil Bupati.</p><p>Melalui forum ini, diharapkan terbentuk kepengurusan PGRI yang solid dan mampu menjawab tantangan pendidikan ke depan, seiring dengan dinamika zaman dan kebutuhan peserta didik yang terus berkembang.</p><p>Konferensi PGRI ke-XXIII ini dihadiri Ketua PGRI Provinsi Banten, Ketua PGRI Kabupaten Lebak serta para pengurus cabang PGRI dari seluruh kecamatan di Kabupaten Lebak.</p>', 'published', NULL, 1, '2025-08-12 00:28:09', '2025-08-12 00:28:09', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `berita_tag`
--

CREATE TABLE `berita_tag` (
  `berita_id` bigint UNSIGNED NOT NULL,
  `tag_id` bigint UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `berita_tag`
--

INSERT INTO `berita_tag` (`berita_id`, `tag_id`) VALUES
(15, 1),
(21, 1),
(33, 1),
(34, 1),
(1, 2),
(9, 2),
(15, 2),
(21, 2),
(22, 2),
(32, 2),
(33, 2);

-- --------------------------------------------------------

--
-- Table structure for table `data_aplikasis`
--

CREATE TABLE `data_aplikasis` (
  `id` bigint UNSIGNED NOT NULL,
  `nama` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `jenis` enum('Website','Mobile') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `deskripsi` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `link` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `icon` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `opd_pelaksana` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `kategori` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `data_aplikasis`
--

INSERT INTO `data_aplikasis` (`id`, `nama`, `jenis`, `deskripsi`, `link`, `icon`, `opd_pelaksana`, `created_at`, `updated_at`, `kategori`) VALUES
(1, 'E-office', 'Mobil', 'Aplikasi absen online pemerintah kabupaten lebak', 'https://e-office.lebakkab.go.id', 'aplikasi/icons/01K1YKGCGXBCYWEJPT1CQ5YN58.webp', 'diskominfosp', '2025-08-04 04:52:17', '2025-08-05 20:39:37', 'Internal Pemerintah'),
(2, 'CEPLEO', 'Website', 'cepleo bapenda lebak', 'https://cepleo.lebakkab.go.id/', 'aplikasi/icons/01K1YKFTTYD7VX1A3SJG0ZS699.webp', 'Bapenda', '2025-08-05 18:45:56', '2025-08-05 19:31:13', 'Aplikasi Layanan Publik'),
(3, 'Simpal', 'Website', 'Sistem manajemen Pajak', 'https://simpal.lebakkab.go.id/', 'aplikasi/icons/01K1YKDKENHXJNG7KTE2E641FB.webp', 'Bapenda', '2025-08-05 18:47:07', '2025-08-05 19:30:00', 'Aplikasi Layanan Publik'),
(4, 'Simonev', 'Website', 'Sistem Informasi Monitoring, Evaluasi, Pengendalian dan pelaporan pelaksanaan pembangunan. ', 'https://simonev.lebakkab.go.id', 'aplikasi/icons/01K1YJWEY1QT42Q5AJDK5RTXJK.webp', 'Setda', '2025-08-05 18:49:12', '2025-08-12 19:19:22', 'Aplikasi Layanan Publik'),
(5, 'SP4N LAPOR', 'Website', 'Sistem Informasi layanan asporasi dan pengaduan online rakyat. media pengaduan, aspirasi dan permintaan informas', 'https://www.lapor.go.id/', 'aplikasi/icons/01K1YJMNPCZQXY70C5SSTQ3EW2.png', 'Kemendagri', '2025-08-05 18:51:55', '2025-08-05 19:30:45', 'Aplikasi Layanan Publik'),
(6, 'OSS', 'Website', 'Sistem Informasi penyelenggaraan perizinan berbasis resiko', 'https://oss.go.id/', 'aplikasi/icons/01K1YJHDEHQD4D4TGECQNERF41.webp', 'DPMPTSP', '2025-08-05 19:14:36', '2025-08-05 19:30:52', 'Aplikasi Layanan Publik'),
(7, 'Simponie2', 'Website', 'Sistem informasi perizinan online', 'https://simponie2.lebakkab.go.id', 'aplikasi/icons/01K1YPE93GH5V2BAW8E172MEYT.webp', 'DPMPTSP', '2025-08-05 20:22:48', '2025-08-05 20:22:48', 'Aplikasi Layanan Publik'),
(8, 'EBPHTB', 'Website', 'Permohonan dan pengecekan pajak', 'https://v1.ebphtb.lebakkab.go.id/login', 'aplikasi/icons/01K1YPGJKCYD7PDYVR56ESE80E.webp', 'Bapenda', '2025-08-05 20:24:03', '2025-08-12 19:17:58', 'Aplikasi Layanan Publik'),
(9, 'Open Data Lebak', 'Website', 'Data sektoral Lebak', 'https://opendata.lebakkab.go.id/', 'aplikasi/icons/01K2ERFZG9PRX47J6478Y4NVMA.webp', 'Diskominfosp', '2025-08-12 02:06:32', '2025-08-12 19:15:23', 'Aplikasi Layanan Publik');

-- --------------------------------------------------------

--
-- Table structure for table `dokumens`
--

CREATE TABLE `dokumens` (
  `id` bigint UNSIGNED NOT NULL,
  `judul` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `kategori_dokumen_id` bigint UNSIGNED NOT NULL,
  `sumber` enum('upload','link') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'upload',
  `file_path` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `link_drive` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `dokumens`
--

INSERT INTO `dokumens` (`id`, `judul`, `slug`, `kategori_dokumen_id`, `sumber`, `file_path`, `link_drive`, `created_at`, `updated_at`) VALUES
(5, 'Perubahan Prioritas dan Plafon Anggaran Sementara (PPAS) Tahun Anggaran 2024', 'perubahan-prioritas-dan-plafon-anggaran-sementara-ppas-tahun-anggaran-2024', 1, 'upload', 'dokumens/k3bVvYnPJYSeV7g1W8MJ14rELaXOWl-metaY29udG9oLnBkZg==-.pdf', NULL, '2025-08-04 01:08:54', '2025-08-04 01:08:54'),
(6, 'Buku Perubahan KUA Tahun Anggaran 2024', 'buku-perubahan-kua-tahun-anggaran-2024', 8, 'upload', 'dokumens/brzKNkwXYU4QFGXEllR8qVdbmRuF9k-metaY29udG9oLnBkZg==-.pdf', NULL, '2025-08-04 01:23:09', '2025-08-06 00:16:42'),
(7, 'Prioritas Dan Plafon Anggaran Sementara (PPAS) TA 2024', NULL, 1, 'upload', 'dokumens/01K1Z4Q6F3XWNG7FW34XDDA59N.pdf', NULL, '2025-08-06 00:32:20', '2025-08-06 00:32:20'),
(8, 'Peraturan Daerah (PERDA) NO 9 Tahun 2023 Tentang APBD TA 2024', 'peraturan-daerah-perda-no-9-tahun-2023-tentang-apbd-ta-2024', 1, 'upload', 'dokumens/01K1Z5NFK5EEX217XAQXNX6MHM.pdf', NULL, '2025-08-06 00:48:52', '2025-08-06 00:48:52');

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint UNSIGNED NOT NULL,
  `uuid` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `fotos`
--

CREATE TABLE `fotos` (
  `id` bigint UNSIGNED NOT NULL,
  `judul` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `kategori_foto_id` bigint UNSIGNED NOT NULL,
  `gambar` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `deskripsi` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `fotos`
--

INSERT INTO `fotos` (`id`, `judul`, `kategori_foto_id`, `gambar`, `deskripsi`, `created_at`, `updated_at`) VALUES
(2, 'baduy', 3, 'yJxNRueQU39aYytr1ct5cLXm0PR6EU-metabGV1aXQuanBn-.jpg', 'baduy', '2025-08-04 01:47:49', '2025-08-04 01:47:49'),
(3, 'Upapacara hari A', 4, '20kiwxnsJlsFntxw6IDfLK7XYZTUOe-metaYmFja2Jhd2FoLmpwZw==-.jpg', 'Bupati Lebak', '2025-08-04 01:49:20', '2025-08-04 01:49:20'),
(4, 'Sawarna', 3, 'brWK2VIS8rkzsPCqUDEs2Xh7iIsIad-metaUGFudGFpLVNhd2FybmEuanBn-.jpg', 'pantai sawarna', '2025-08-04 01:49:51', '2025-08-04 01:49:51');

-- --------------------------------------------------------

--
-- Table structure for table `galeris`
--

CREATE TABLE `galeris` (
  `id` bigint UNSIGNED NOT NULL,
  `judul` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `gambar` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `galeris`
--

INSERT INTO `galeris` (`id`, `judul`, `gambar`, `created_at`, `updated_at`) VALUES
(1, 'Kegiatan Musyawarah Daerah', 'https://via.placeholder.com/600x400?text=Galeri+1', '2025-07-21 20:33:45', '2025-07-21 20:33:45'),
(2, 'Peresmian Gedung Baru', 'https://via.placeholder.com/600x400?text=Galeri+2', '2025-07-21 20:33:45', '2025-07-21 20:33:45'),
(3, 'Kegiatan Sosial', 'https://via.placeholder.com/600x400?text=Galeri+3', '2025-07-21 20:33:45', '2025-07-21 20:33:45');

-- --------------------------------------------------------

--
-- Table structure for table `halaman_ddddd`
--

CREATE TABLE `halaman_ddddd` (
  `id` bigint UNSIGNED NOT NULL,
  `judul` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `konten` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `cover` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `halaman_statis`
--

CREATE TABLE `halaman_statis` (
  `id` bigint UNSIGNED NOT NULL,
  `judul` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `isi` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `cover` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `halaman_statis`
--

INSERT INTO `halaman_statis` (`id`, `judul`, `slug`, `isi`, `cover`, `created_at`, `updated_at`) VALUES
(1, 'Tentang Kabupaten Lebak', 'Tentang Kabupaten Lebak', '<p>lebak adalah kabupoaten lbalkal</p>', 'pages/6u0yI71hwzKedL0slXuyVVF1aHV1HI-metaaGVybzQucG5n-.png', '2025-07-27 19:36:05', '2025-07-27 19:36:05'),
(2, 'Struktur Organisasi', 'Struktur Organisasi', '<p>..........</p>', NULL, '2025-07-28 02:46:49', '2025-07-28 02:46:49'),
(3, 'Visi dan Misi Kabupaten Lebak', 'visi-dan-misi-kabupaten-lebak', '<p>Visi</p><p>...............</p><p>Misi..........</p>', NULL, '2025-07-28 18:33:57', '2025-08-13 01:38:15'),
(4, 'Penghargaan kabupaten Lebak', 'penghargaan-kabupaten-lebak', '<p>dffdfdf</p>', NULL, '2025-08-07 20:25:11', '2025-08-07 20:25:11'),
(6, 'Sambutan Bupati dan Wakil Bupati Lebak', 'sambutan-bupati-dan-wakil-bupati-lebak', '<p>dssdsd</p>', 'pages/01K23VN15H1F139DTANX5YVZ6J.jpeg', '2025-08-07 20:30:04', '2025-08-07 20:30:04');

-- --------------------------------------------------------

--
-- Table structure for table `hero_sliders`
--

CREATE TABLE `hero_sliders` (
  `id` bigint UNSIGNED NOT NULL,
  `judul` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `gambar` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `order` int NOT NULL DEFAULT '0',
  `aktif` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deskripsi` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `hero_sliders`
--

INSERT INTO `hero_sliders` (`id`, `judul`, `gambar`, `status`, `order`, `aktif`, `created_at`, `updated_at`, `deskripsi`) VALUES
(4, 'Baduy', 'hero-sliders/DdwbjeGKT8KwQviPzYKGG6JUHcqrjn-metaZ2lkMDBLdHFCV3JjVWNDTkhhVnFyTlJLcmRRSEp6LW1ldGFhR1Z5YnpRdWNHNW4tLnBuZw==-.png', 1, 1, 1, '2025-08-01 00:40:20', '2025-08-04 01:52:30', 'Baduy'),
(6, 'Alun alun rangkasbitung', 'hero-sliders/yG8KFA3Q2zfOIPnEe92EovXxY4TWd3-metaaGVybzIuanBn-.jpg', 1, 0, 1, '2025-08-04 01:53:49', '2025-08-07 10:40:36', 'Alun alun rangkasbitung'),
(7, 'WadukKarian Lebak', 'hero-sliders/01K2DYY7SYV38TS160W14B7XJ9.jpg', 1, 0, 1, '2025-08-11 18:39:56', '2025-08-11 20:03:10', 'WadukKarian Lebak');

-- --------------------------------------------------------

--
-- Table structure for table `informasi_layanans`
--

CREATE TABLE `informasi_layanans` (
  `id` bigint UNSIGNED NOT NULL,
  `judul` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `deskripsi` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `cover` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `kontak` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `unit_pelaksana` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT 'aktif',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `informasi_layanans`
--

INSERT INTO `informasi_layanans` (`id`, `judul`, `deskripsi`, `cover`, `kontak`, `unit_pelaksana`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Informasi Pembuatan Kartu Keluarga', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nunc consectetur condimentum libero vestibulum imperdiet. Morbi ante justo, imperdiet eu sapien vitae, tempus fermentum enim. Quisque vel magna sit amet felis ullamcorper pretium a vitae elit. Ut ut aliquet urna. Maecenas dignissim, lorem vel blandit efficitur, arcu augue blandit augue, eu vestibulum ipsum lorem sed tortor. Cras sit amet nulla mattis, tempor est id, interdum orci. Nam eros purus, laoreet sed ante id, placerat varius lorem. Sed blandit dictum nunc, ac accumsan nisl pretium nec. Etiam maximus vestibulum rutrum. Sed tincidunt molestie urna. Mauris sollicitudin mollis elit, quis consequat libero mollis sit amet. Pellentesque semper ante augue, et sollicitudin dui bibendum et.\n\nCras ornare felis eu massa finibus ultricies. Donec eget arcu porttitor, rutrum nisl nec, sollicitudin ex. Integer convallis diam eget purus posuere, in imperdiet elit viverra. Phasellus tristique elit vestibulum, facilisis mauris dapibus, aliquet orci. In eget nisi vulputate, pulvinar ex eu, facilisis lacus. Vivamus tincidunt eleifend est, id porta velit tempor et. Phasellus elementum, nisl et pretium porta, tellus mi finibus lacus, in aliquet risus lacus ut dui. Donec iaculis eu elit nec placerat. Mauris nec posuere libero, et facilisis odio. Donec mi orci, auctor nec nulla at, venenatis dapibus sapien. Morbi ac odio aliquam, consequat massa in, eleifend nisi. Lorem ipsum dolor sit amet, consectetur adipiscing elit.\n\nCurabitur ac convallis nulla. Mauris et molestie lorem. Morbi est arcu, venenatis finibus gravida non, luctus vel eros. Phasellus mollis diam in lacus facilisis porttitor. Etiam nec augue a odio tincidunt vehicula sed quis nisi. Morbi euismod tellus ut congue tempus. Fusce eget auctor nunc, non elementum ipsum. Duis sed tortor vitae mi maximus tempus ac tempor leo.\n\nVivamus eget mauris eu mi ullamcorper maximus. Ut gravida, dolor et porta luctus, arcu lectus consectetur quam, eu rhoncus odio dui eget.', 'informasi-layanan/cp2jZxf05UFJ80mqIaExeC5QXNWTu3-metabGViYWstYmFuay1kYXRhLnBuZw==-.png', '12345678', 'Disdukcapil', 'aktif', '2025-08-03 09:02:20', '2025-08-04 01:25:59'),
(2, 'Informasi Pembuatan KTP', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nunc consectetur condimentum libero vestibulum imperdiet. Morbi ante justo, imperdiet eu sapien vitae, tempus fermentum enim. Quisque vel magna sit amet felis ullamcorper pretium a vitae elit. Ut ut aliquet urna. Maecenas dignissim, lorem vel blandit efficitur, arcu augue blandit augue, eu vestibulum ipsum lorem sed tortor. Cras sit amet nulla mattis, tempor est id, interdum orci. Nam eros purus, laoreet sed ante id, placerat varius lorem. Sed blandit dictum nunc, ac accumsan nisl pretium nec. Etiam maximus vestibulum rutrum. Sed tincidunt molestie urna. Mauris sollicitudin mollis elit, quis consequat libero mollis sit amet. Pellentesque semper ante augue, et sollicitudin dui bibendum et.\n\nCras ornare felis eu massa finibus ultricies. Donec eget arcu porttitor, rutrum nisl nec, sollicitudin ex. Integer convallis diam eget purus posuere, in imperdiet elit viverra. Phasellus tristique elit vestibulum, facilisis mauris dapibus, aliquet orci. In eget nisi vulputate, pulvinar ex eu, facilisis lacus. Vivamus tincidunt eleifend est, id porta velit tempor et. Phasellus elementum, nisl et pretium porta, tellus mi finibus lacus, in aliquet risus lacus ut dui. Donec iaculis eu elit nec placerat. Mauris nec posuere libero, et facilisis odio. Donec mi orci, auctor nec nulla at, venenatis dapibus sapien. Morbi ac odio aliquam, consequat massa in, eleifend nisi. Lorem ipsum dolor sit amet, consectetur adipiscing elit.\n\nCurabitur ac convallis nulla. Mauris et molestie lorem. Morbi est arcu, venenatis finibus gravida non, luctus vel eros. Phasellus mollis diam in lacus facilisis porttitor. Etiam nec augue a odio tincidunt vehicula sed quis nisi. Morbi euismod tellus ut congue tempus. Fusce eget auctor nunc, non elementum ipsum. Duis sed tortor vitae mi maximus tempus ac tempor leo.\n\nVivamus eget mauris eu mi ullamcorper maximus. Ut gravida, dolor et porta luctus, arcu lectus consectetur quam, eu rhoncus odio dui eget.', 'informasi-layanan/kKFBB8DoygGlRjJnVIPQmGg13pYjrR-metabGViYWstdmVjdG9yLWFnZW5kYS5wbmc=-.png', '12345678', 'Disdukcapil', 'aktif', '2025-08-03 17:20:34', '2025-08-04 01:26:30'),
(3, 'Pendaftaran Pasien RSUD ', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nunc consectetur condimentum libero vestibulum imperdiet. Morbi ante justo, imperdiet eu sapien vitae, tempus fermentum enim. Quisque vel magna sit amet felis ullamcorper pretium a vitae elit. Ut ut aliquet urna. Maecenas dignissim, lorem vel blandit efficitur, arcu augue blandit augue, eu vestibulum ipsum lorem sed tortor. Cras sit amet nulla mattis, tempor est id, interdum orci. Nam eros purus, laoreet sed ante id, placerat varius lorem. Sed blandit dictum nunc, ac accumsan nisl pretium nec. Etiam maximus vestibulum rutrum. Sed tincidunt molestie urna. Mauris sollicitudin mollis elit, quis consequat libero mollis sit amet. Pellentesque semper ante augue, et sollicitudin dui bibendum et.\n\nCras ornare felis eu massa finibus ultricies. Donec eget arcu porttitor, rutrum nisl nec, sollicitudin ex. Integer convallis diam eget purus posuere, in imperdiet elit viverra. Phasellus tristique elit vestibulum, facilisis mauris dapibus, aliquet orci. In eget nisi vulputate, pulvinar ex eu, facilisis lacus. Vivamus tincidunt eleifend est, id porta velit tempor et. Phasellus elementum, nisl et pretium porta, tellus mi finibus lacus, in aliquet risus lacus ut dui. Donec iaculis eu elit nec placerat. Mauris nec posuere libero, et facilisis odio. Donec mi orci, auctor nec nulla at, venenatis dapibus sapien. Morbi ac odio aliquam, consequat massa in, eleifend nisi. Lorem ipsum dolor sit amet, consectetur adipiscing elit.\n\nCurabitur ac convallis nulla. Mauris et molestie lorem. Morbi est arcu, venenatis finibus gravida non, luctus vel eros. Phasellus mollis diam in lacus facilisis porttitor. Etiam nec augue a odio tincidunt vehicula sed quis nisi. Morbi euismod tellus ut congue tempus. Fusce eget auctor nunc, non elementum ipsum. Duis sed tortor vitae mi maximus tempus ac tempor leo.\n\nVivamus eget mauris eu mi ullamcorper maximus. Ut gravida, dolor et porta luctus, arcu lectus consectetur quam, eu rhoncus odio dui eget.', 'informasi-layanan/xfzBD34kp2cGyBsL02EX2r45tyS1Tp-metabGViYWstYmFuay1kYXRhLnBuZw==-.png', '0818123547', 'RSUD DR ADJIDARMO', 'aktif', '2025-08-04 01:27:20', '2025-08-04 01:27:20'),
(4, 'Akta Kelahiran', 'Lokasi Pelayanan : Kantor Desa/Kelurahan\n\nWaktu Pelayanan : 5 hari kerja sejak tanggal diterimanya berkas persyaratan secara lengkap\n\nBiaya : Gratis\n\nSesuai dengan Undang-Undang No. 24 Tahun 2013 tentang Perubahan atas Undang-Undang No. 23 Tahun 2006 pencatatan kelahiran yang sebelumnya berdasarkan atas asa peristiwa, sejak ditetapkannya undang-undang ini berubah menjadi berdasarkan atas domisili, sehingga pencatatan dilakukan pada instansi pelaksanan sesuai dengan domisili pelapor.\n\nBayi yang dilaporkan kelahirannya akan terdaftar dalam Kartu Keluarga dan diberi Nomor Induk Kependudukan (NIK) sebagai dasar untuk memperoleh pelayanan masyarakat lainnya.\nSebagai hasil pelaporan kelahiran, diterbitkan Kartu Keluarga dan Akta Kelahiran.\n\nPersyaratan\n\nUntuk memperoleh Pelayanan Pelaporan Kelahiran harus memenuhi persyaratan berikut ini:\n\na. Surat Pengantar RT/RW;\nb. Surat Keterangan Kelahiran dari Rumah Sakit/Dokter/Bidan/Pilot/Nahkoda\nc. Asli dan Fotokopi KK bagi penduduk/SKSKPNP bagi penduduk non permanen;\nd. Asli dan Fotokopi KTP Orang tua/SKDS/Surat Keterangan Pelaporan Tamu;\ne. Asli dan Fotokopi Surat Nikah/Akta Perkawinan Orang tua;\nf. Asli dan Fotokopi Paspor bagi Orang Asing;\ng. Surat Keterangan Kepolisian untuk anak yang tidak diketahui asal-usulnya; dan\nh. Surat Keterangan dari lembaga sosial untuk kelahiran anak penduduk rentan.\n\nPelayanan Penerbitan Akta Kelahiran\n\nLokasi Pelayanan : Suku Dinas Kependudukan dan Catatan Sipil Kabupaten Lebak\n\nWaktu Pelayanan : 5 hari kerja sejak tanggal diterimanya berkas persyaratan secara lengkap.\n\nTarif : –\n\nAkta Kelahiran adalah Akta Catatan Sipil hasil pencatatan peristiwa kelahiran seseorang.\n\n \n\nBlangko Register Akta Kelahiran\n\nPersyaratan\n\nSangat disarankan mengurus akta kelahiran sesegera mungkin setelah bayi dilahirkan. Adapun persyaratan untuk membuat akta kelahiran adalah sebagai berikut :\n\na. Surat Keterangan Kelahiran dari Kelurahan\n\nb. Asli dan Fotokopi Surat Keterangan Kelahiran dari dokter/bidan/penolong kelahiran/Nakhoda Kapal Laut atau Pilot Pesawat Terbang dengan memperlihatkan aslinya Surat\n\nc. Nikah/Akta Perkawinan orang tua\n\nd. Fotokopi KK dan KTP orang tua\n\ne. Nama dan identitas saksi pelaporan kelahiran\n\nf. Persetujuan Kepala Dinas/Suku Dinas. dalam hal pelaporannya melebihi 60 (enam puluh) hari sejak tanggal kelahirannya, dan\n\nBerdasarkan  putusan Mahkamah Konstitusi Nomor 18 /PUU-XI/2013 tanggal 14 Maret 2013, ketentuan tentang batas waktu 1 (satu) tahun dan persyaratan penetapan pengadilan yang diisyaratkan dalam pasal 32 Undang-Undang Nomor 23 Tahun 2006 dibatalkan. Dengan demikian pencatatan kelahiran yang melampaui batas 1 (satu) tahun sejak tanggal kelahiran tidak melalui penetapan pengadilan.\nBerdasarkan Undang-Undang No. 24 tahun 2013 tentang Perubahan atas Undang-Undang No. 23 Tahun 2006 tentang Administrasi Kependudukan bahwa Pencatatan kelahiran wajib dilaporkan oleh penduduk pada Instansi pelaksana tempat terjadinya peristiwa diubah menjadi wajib dilaporkan oleh penduduk pada Instansi pelaksana tempat penduduk berdomisili.\n\n \n\nJenis Akta Kelahiran\n\nAkta kelahiran digolongkan menurut jarak waktu pelaporan dengan kelahiran. Ada  jenis-jenis akta kelahiran, yaitu :\n\nAkta Kelahiran Umum Akta kelahiran yang dibuat berdasarkan laporan kelahiran yang disampaikan dalam batas waktu selambat-lambatnya 60 (enam puluh) hari kerja bagi WNI dan 10 (sepuluh) hari kerja bagi WNA sejak tanggal kelahiran bayi.\nAkta Dengan Rekomendasi Akta Kelahiran yang dibuat berdasarkan Rekomendasi kepala Dinas atas laporan kelahiran yang telah melampaui batas waktu 60 (enam puluh) hari kerja', 'informasi-layanan/MN9IkAQCNSkhq4C9i2xJAS055BgZAa-metabGViYWstdmVjdG9yLWFnZW5kYS5wbmc=-.png', '0819123456', 'Kantor Desa/Kelurahan', 'aktif', '2025-08-04 01:34:06', '2025-08-04 01:34:06'),
(5, 'Akta Perkawinan', 'Pelayanan Pencatatan Perkawinan\n\nLokasi Pelayanan : \n1. Kantor Dinas Kependudukan dan Catatan Sipil Provinsi dan \n2. Kantor Suku Dinas Kependudukan dan Catatan Sipil\n\nBiaya : Gratis\n\nDinas Kependudukan dan Catatan Sipil Propinsi DKI Jakarta melayani Pencatatan Perkawinan bagi mereka yang telah melangsungkan perkawinan menurut hukum dan tata cara agama selain agama Islam. Pencatatan Perkawinan didasarkan atas Undang-undang Nomor 1 Tahun 1974 tentang Perkawinan. \n\nSesuai dengan Undang-Undang No. 24 Tahun 2013 tentang Perubahan atas Undang-Undang No. 23 Tahun 2006 Pencatatan perkawinan yang sebelumnya berdasarkan atas asa peristiwa, sejak ditetapkannya undang-undang ini berubah menjadi berdasarkan atas domisli. Sehingga pencatatan dilakukan pada instansi pelaksanan sesuai dengan domisili pelapor. \n\nSesuai dengan Undang-undang Nomor 1 Tahun 1974, usia perkawinan adalah 19 tahun bagi Pria dan 16 tahun bagi Wanita. \n\nJika Anda melangsungkan perkawinan dalam usia di bawah 21 tahun, maka Anda harus memperoleh ijin dari orang tua. Apabila Anda masih di bawah 19 tahun bagi Pria dan di bawah usia 16 tahun bagi Wanita, maka harus memperoleh Dispensasi dari Pengadilan Negeri. \n\nBerdasarkan Undang-Undang No. 24 tahun 2013 tentang Perubahan atas Undang-Undang No. 23 Tahun 2006 tentang Administrasi Kependudukan bahwa Pencatatan kelahiran wajib dilaporkan oleh penduduk pada Instansi pelaksana tempat terjadinya peristiwa diubah menjadi wajib dilaporkan oleh penduduk pada Instansi pelaksana tempat penduduk berdomisili.', 'informasi-layanan/01K1Z8JJTM6PY3SFZ088N5CRS2.png', '11111111', 'Disdukcapil', 'aktif', '2025-08-06 01:39:43', '2025-08-06 01:39:58');

-- --------------------------------------------------------

--
-- Table structure for table `kategoris`
--

CREATE TABLE `kategoris` (
  `id` bigint UNSIGNED NOT NULL,
  `nama` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `kategoris`
--

INSERT INTO `kategoris` (`id`, `nama`, `slug`, `created_at`, `updated_at`) VALUES
(2, 'Sosialisasi2', 'sosialisasi2', '2025-07-22 20:02:39', '2025-08-04 22:01:49'),
(3, 'Kesehatan', 'kesehatan', '2025-07-22 20:02:39', '2025-07-22 20:02:39'),
(6, 'Pembangunan23 rwer', 'pembangunan23-rwer', '2025-07-22 20:37:44', '2025-08-04 22:15:28'),
(7, 'Pariwisata', 'pariwisata', '2025-07-22 20:57:19', '2025-07-22 20:57:19');

-- --------------------------------------------------------

--
-- Table structure for table `kategori_dokumens`
--

CREATE TABLE `kategori_dokumens` (
  `id` bigint UNSIGNED NOT NULL,
  `nama` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `kategori_dokumens`
--

INSERT INTO `kategori_dokumens` (`id`, `nama`, `slug`, `created_at`, `updated_at`) VALUES
(1, 'IPKD 2029', 'ipkd-2029', '2025-08-03 23:02:01', '2025-08-05 23:59:41'),
(8, 'manual book', 'manual-book', '2025-08-05 23:26:00', '2025-08-06 00:00:09');

-- --------------------------------------------------------

--
-- Table structure for table `kategori_fotos`
--

CREATE TABLE `kategori_fotos` (
  `id` bigint UNSIGNED NOT NULL,
  `nama` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `cover` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `kategori_fotos`
--

INSERT INTO `kategori_fotos` (`id`, `nama`, `slug`, `cover`, `created_at`, `updated_at`) VALUES
(1, 'Pembangunan Daerah', 'pembangunan-daerah', 'kategori-foto/5XaAjuxePYNK8O2NerkExZg7q5w2Sg-metabGViYWstdmVjdG9yLXN1cnZlaS5wbmc=-.png', '2025-07-29 23:17:10', '2025-08-04 01:46:15'),
(2, 'Sosialisasi', 'sosialisasi', 'kategori-foto/b7kIxbmcSUqshfwksfXF0yPJuNSFfI-metabGViYWstdmVjdG9yLWxheWFuYW4ucG5n-.png', '2025-07-29 23:17:33', '2025-08-04 01:45:46'),
(3, 'Wisata', 'wisata', 'kategori-foto/FiwP6Vnc8DDImYdcrkYMsv1uQSjz9w-metabGViYWstYmFuay1kYXRhLnBuZw==-.png', '2025-08-04 01:44:28', '2025-08-04 01:44:28'),
(4, 'Upacara Hari nasional', 'upacara-hari-nasional', 'kategori-foto/YCPRI7Az4WpcjE6UdmdrLU5gGi8KeV-metabGViYWstdmVjdG9yLWFnZW5kYS5wbmc=-.png', '2025-08-04 01:45:21', '2025-08-04 01:45:21');

-- --------------------------------------------------------

--
-- Table structure for table `kategori_vidios`
--

CREATE TABLE `kategori_vidios` (
  `id_kategori_vidio` bigint UNSIGNED NOT NULL,
  `nama_kategori_vidio` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug_kategori_vidio` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `kategori_vidios`
--

INSERT INTO `kategori_vidios` (`id_kategori_vidio`, `nama_kategori_vidio`, `slug_kategori_vidio`, `created_at`, `updated_at`) VALUES
(1, 'Sosialisasi2', 'sosialisasi2', NULL, NULL),
(2, 'pemerintahan', 'pemerintahan', NULL, NULL),
(3, 'Tutorial', 'tutorial', NULL, NULL),
(4, 'Kegiatan', 'kegiatan', NULL, NULL),
(5, 'dokumentasi', 'dokumentasi', NULL, NULL),
(6, 'potensi', 'potensi', NULL, NULL),
(7, 'kategori baru', 'kategori-baru', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `kecamatans`
--

CREATE TABLE `kecamatans` (
  `id` bigint UNSIGNED NOT NULL,
  `nama` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `kode_kecamatan` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `deskripsi` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `alamat_kantor` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `telepon` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `website` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `logo` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `foto_kantor` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `peta_embed` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `urutan` int NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `kecamatans`
--

INSERT INTO `kecamatans` (`id`, `nama`, `slug`, `kode_kecamatan`, `deskripsi`, `alamat_kantor`, `email`, `telepon`, `website`, `logo`, `foto_kantor`, `peta_embed`, `urutan`, `created_at`, `updated_at`) VALUES
(1, 'Kecamatan Cilograng', 'kecamatan-cilograng', '45212', 'xxxx', 'Cilograng', 'cilograng@lebakkab.go.id', '02525123456', 'https://cilograng.lebakkab.go.id', 'logos/UjRg43GPSF6kQyaGlL9D7I2muVpuGH-metaMTY0ODQ1MjQ5MF9hNmJlMTlkMTIwMjk0YjE5NjBkNy5wbmc=-.png', 'foto_kantor/1RK0O9t0VjLzGZa6h0uksEIKD9ix1k-metabmFtZWxpZ2h0IHJhbmdrYXNiaXR1bmcuSlBH-.JPG', '<iframe src=\"https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3965.25134243884!2d106.24460377576601!3d-6.3615073622340494!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e4216d432ebe781%3A0xbef920dc5406e33d!2sBadan%20Perencanaan%20Pembangunan%20Daerah%20(Bappeda)%20Kabupaten%20Lebak!5e0!3m2!1sid!2sid!4v1754276545909!5m2!1sid!2sid\" width=\"600\" height=\"450\" style=\"border:0;\" allowfullscreen=\"\" loading=\"lazy\" referrerpolicy=\"no-referrer-when-downgrade\"></iframe>', 0, '2025-08-03 21:38:05', '2025-08-03 21:47:42'),
(3, 'Kecamatan Rangkasbitung', 'kecamatan-rangkasbitung', '66666', 'Kecamatan Rangkasbitung', 'Rangkasbitung', 'rangkasbitungkec@gmail.com', '0252789654', 'https://rangkasbitung.lebakkab.go.id', 'kecamatan/logo/8MtRq2Qhm6Rbz90BlqDH92YLLJ0Kdz-metaMTY0ODQ1MjQ5MF9hNmJlMTlkMTIwMjk0YjE5NjBkNy5wbmc=-.png', 'kecamatan/foto_kantor/pgkba6jacpHTmFoBApgTLLctUahfpw-metaYmVubmVyLWRpc2tvbWluZm8tMS5wbmc=-.png', '<iframe src=\"https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3965.25134243884!2d106.24460377576601!3d-6.3615073622340494!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e4216d432ebe781%3A0xbef920dc5406e33d!2sBadan%20Perencanaan%20Pembangunan%20Daerah%20(Bappeda)%20Kabupaten%20Lebak!5e0!3m2!1sid!2sid!4v1754276545909!5m2!1sid!2sid\" width=\"600\" height=\"450\" style=\"border:0;\" allowfullscreen=\"\" loading=\"lazy\" referrerpolicy=\"no-referrer-when-downgrade\"></iframe>', 0, '2025-08-03 22:10:32', '2025-08-03 22:11:16'),
(4, 'Kecamatan Bayah', 'kecamatan-bayah', '12345', 'Kecamatan Bayah', 'bayah', 'bayahkec@gmail.com', NULL, 'https://bayah.lebakkab.go.id', 'kecamatan/logo/C3axdQSm3uSDTbgUIPeWe4J6aPy2J1-metabGViYWstdW5pcXVlLnBuZw==-.png', 'kecamatan/foto_kantor/UqP6fpvT8yRy1RL8O1DCK9XnvEgSD2-metaYmVubmVyLWRpc2tvbWluZm8tMi5wbmc=-.png', '<iframe src=\"https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3965.25134243884!2d106.24460377576601!3d-6.3615073622340494!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e4216d432ebe781%3A0xbef920dc5406e33d!2sBadan%20Perencanaan%20Pembangunan%20Daerah%20(Bappeda)%20Kabupaten%20Lebak!5e0!3m2!1sid!2sid!4v1754276545909!5m2!1sid!2sid\" width=\"600\" height=\"450\" style=\"border:0;\" allowfullscreen=\"\" loading=\"lazy\" referrerpolicy=\"no-referrer-when-downgrade\"></iframe>', 0, '2025-08-03 22:13:41', '2025-08-03 22:13:41');

-- --------------------------------------------------------

--
-- Table structure for table `kritik_sarans`
--

CREATE TABLE `kritik_sarans` (
  `id` bigint UNSIGNED NOT NULL,
  `nama` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `judul` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `isi_kritik` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `tanggal` date DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '0',
  `no_hpusr` varchar(15) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `balas` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `menus`
--

CREATE TABLE `menus` (
  `id` bigint UNSIGNED NOT NULL,
  `parent_id` bigint UNSIGNED DEFAULT NULL,
  `type` enum('main_menu','top_menu','frontpage_menu') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'main_menu',
  `title` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `link` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `icon` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sort_order` int NOT NULL DEFAULT '0',
  `target` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '_self',
  `is_external` tinyint(1) NOT NULL DEFAULT '0',
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `menus`
--

INSERT INTO `menus` (`id`, `parent_id`, `type`, `title`, `link`, `icon`, `sort_order`, `target`, `is_external`, `is_active`, `created_at`, `updated_at`) VALUES
(1, NULL, 'main_menu', 'Beranda', '/', 'heroicon-o-home', 0, '_self', 0, 1, '2025-08-08 02:09:44', '2025-08-12 21:46:06'),
(2, NULL, 'main_menu', 'Profil', '#', 'heroicon-o-arrow-turn-down-right', 1, '_self', 0, 1, '2025-08-08 02:09:44', '2025-08-12 21:47:29'),
(3, 2, 'main_menu', 'Visi dan Misi', '/page/visi-dan-misi', 'mdi mdi-eye', 11, '_self', 0, 1, '2025-08-08 02:09:44', '2025-08-13 01:38:58'),
(4, 2, 'main_menu', 'Struktur Organisasi', '/Struktur Organisasi', 'fas fa-phone', 0, '_self', 0, 1, '2025-08-08 02:09:44', '2025-08-10 21:08:28'),
(5, NULL, 'frontpage_menu', 'Layanan Publik', '/layanan', 'lucide-hand-heart', 5, '_self', 0, 1, '2025-08-08 02:09:44', '2025-08-13 06:22:52'),
(6, NULL, 'main_menu', 'Kontak', '/kontak', 'fas fa-phone', 5, '_self', 0, 1, '2025-08-08 02:09:44', '2025-08-12 21:48:45'),
(7, NULL, 'main_menu', 'JDIH', 'https://jdih.lebakkab.go.id', 'fas fa-link', 4, '_self', 1, 1, '2025-08-08 02:28:31', '2025-08-10 10:24:54'),
(8, NULL, 'main_menu', 'Informasi Publik', '#', 'fas fa-home', 3, '_self', 0, 1, '2025-08-10 10:17:03', '2025-08-10 10:17:03'),
(9, NULL, 'frontpage_menu', 'Berita', '/sambutan-bupati-dan-wakil-bupati-lebak', 'heroicon-o-newspaper', 0, '_self', 0, 1, '2025-08-10 10:35:23', '2025-08-12 20:49:45'),
(10, NULL, 'frontpage_menu', 'Data OPD', '#', 'heroicon-o-arrow-down-tray', 2, '_blank', 1, 1, '2025-08-10 11:25:48', '2025-08-12 21:31:36'),
(12, NULL, 'frontpage_menu', 'Data Aplikasi', '#', 'heroicon-o-document', 7, '_self', 0, 1, '2025-08-11 18:36:02', '2025-08-12 21:23:48'),
(13, NULL, 'frontpage_menu', 'Produk Hukum', 'https://jdih.lebakkab.go.id', 'lucide-scale', 1, '_self', 1, 1, '2025-08-11 18:38:10', '2025-08-13 06:28:09'),
(14, NULL, 'frontpage_menu', 'Trasnparansi', 'https://e-office.lebakkab.go.id', 'heroicon-o-home', 0, '_self', 1, 1, '2025-08-12 20:15:57', '2025-08-12 20:31:19');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int UNSIGNED NOT NULL,
  `migration` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(5, '2025_07_09_081808_create_beritas_table', 1),
(6, '2025_07_14_070039_create_galeris_table', 1),
(8, '2025_07_23_024137_create_kategoris_table', 2),
(9, '2025_07_23_024757_add_kategori_id_to_beritas_table', 3),
(10, '2025_07_24_043344_add_kategori_id_to_beritas_table', 4),
(11, '2025_07_24_064432_create_tags_table', 5),
(12, '2025_07_24_064553_create_berita_tag_table', 5),
(13, '2025_07_25_045708_add_status_to_beritas_table', 6),
(14, '2025_07_25_054741_add_penulis_to_beritas_table', 7),
(15, '2025_07_25_060238_add_user_id_to_beritas_table', 8),
(16, '2025_07_25_084133_add_deleted_at_to_beritas_table', 9),
(17, '2025_07_28_021116_create_halaman_statis_table', 10),
(18, '2025_07_28_023200_create_pages_table', 11),
(19, '2025_07_28_035634_create_banners_table', 12),
(20, '2025_07_28_045811_rename_title_to_judul_in_banners_table', 13),
(22, '2025_07_28_052151_add_kategori_to_banners_table', 14),
(23, '2025_07_29_054959_create_kategori_vidios_table', 15),
(24, '2025_07_29_055126_create_vidios_table', 15),
(25, '2025_07_30_032111_create_kategori_fotos_table', 16),
(26, '2025_07_30_032443_create_fotos_table', 16),
(27, '2025_07_31_013617_create_settings_table', 17),
(28, '2025_07_31_075143_create_menus_table', 18),
(29, '2025_07_31_085116_create_hero_sliders_table', 19),
(32, '2025_08_01_030754_update_hero_sliders_table_add_fields', 20),
(33, '2025_08_01_031536_rename_columns_in_hero_sliders_table', 20),
(34, '2025_08_03_040042_create_polings_table', 21),
(35, '2025_08_03_045915_create_kritik_sarans_table', 22),
(36, '2025_07_14_074644_create_pengumumen_table', 23),
(37, '2025_08_03_093153_create_agendas_table', 24),
(38, '2025_08_03_153620_create_informasi_layanans_table', 25),
(39, '2025_08_04_024519_create_opds_table', 26),
(40, '2025_08_04_033030_create_kecamatans_table', 27),
(41, '2025_08_04_055441_create_kategori_dokumens_table', 28),
(42, '2025_08_04_055452_create_dokumens_table', 28),
(43, '2025_08_04_061003_add_slug_to_kategori_dokumens_table', 29),
(44, '2025_08_04_091731_create_data_aplikasis_table', 30),
(45, '2025_08_08_085940_create_menus_table', 31);

-- --------------------------------------------------------

--
-- Table structure for table `opds`
--

CREATE TABLE `opds` (
  `id` bigint UNSIGNED NOT NULL,
  `nama` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `singkatan` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `deskripsi` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `telepon` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `website` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `alamat` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `logo` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `foto_kantor` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `peta_embed` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `urutan` int NOT NULL DEFAULT '0',
  `is_published` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `opds`
--

INSERT INTO `opds` (`id`, `nama`, `slug`, `singkatan`, `deskripsi`, `email`, `telepon`, `website`, `alamat`, `logo`, `foto_kantor`, `peta_embed`, `urutan`, `is_published`, `created_at`, `updated_at`) VALUES
(1, 'Dinas Informatika Statistik dan Persandian', 'dinas-informatika-statistik-dan-persandian', 'DISKOMINFOSP', 'diskominfo lebak kabupoaten lebak', 'diskominfosp@lebakkab.go.id', '02525123456', 'https://diskominfosp.lebakkab.go.id', 'jl abdinegara no 3', 'opd/gujoub6p7SmeHUSzjgf9FTbgXXZ6O0-metaMTY0ODQ1MjQ5MF9hNmJlMTlkMTIwMjk0YjE5NjBkNy5wbmc=-.png', 'opd/G7f4uXb4tUW2cJxUyN0gfYyBT7t077-metadGFtcGFrMy5qcGc=-.jpg', '<iframe src=\"https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3965.252993328361!2d106.2425515749916!3d-6.361293393628772!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e4216d6650993ab%3A0x92291f2d5a85bb38!2sDiskominfo%20Kabupaten%20Lebak!5e0!3m2!1sid!2sid!4v1754276049935!5m2!1sid!2sid\" width=\"600\" height=\"450\" style=\"border:0;\" allowfullscreen=\"\" loading=\"lazy\" referrerpolicy=\"no-referrer-when-downgrade\"></iframe>', 0, 1, '2025-08-03 19:54:32', '2025-08-03 20:12:45'),
(2, 'Badan Pendapatan Daerah', 'badan-pendapatan-daerah', ' BAPENDA', '	Badan Pendapatan Daerah', 'bapenda@lebakkab.go.id', '025233344455', 'https://bapenda.lebakkab.go.id', 'jl rangkasbitng', 'opd/j7JCOJxrD7YqbR8IfBdxFOAYB4JBTc-metaMTY0ODQ1MjQ5MF9hNmJlMTlkMTIwMjk0YjE5NjBkNy5wbmc=-.png', NULL, '<iframe src=\"https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3965.3684160881194!2d106.23650717576598!3d-6.346315862091651!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e42173a802c28ad%3A0xcc53fd92d86ae81b!2sBadan%20Pendapatan%20Daerah%20Kabupaten%20Lebak!5e0!3m2!1sid!2sid!4v1754276281997!5m2!1sid!2sid\" width=\"600\" height=\"450\" style=\"border:0;\" allowfullscreen=\"\" loading=\"lazy\" referrerpolicy=\"no-referrer-when-downgrade\"></iframe>', 0, 1, '2025-08-03 19:58:24', '2025-08-03 19:58:24'),
(3, 'Badan Keuangan Dan Aset Daerah ', 'badan-keuangan-dan-aset-daerah', 'BKAD', 'Badan Keuangan Dan Aset Daerah ', 'bkad@lebakkab.go.id', '0252123456', 'https://bkad.lebakkab.go.id', 'jl hardiwinangun', 'opd/7jauRJXNBXntutUvggyNQ44rCAwktt-metaMTY0ODQ1MjQ5MF9hNmJlMTlkMTIwMjk0YjE5NjBkNy5wbmc=-.png', NULL, '<iframe src=\"https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3965.2731043885346!2d106.24577197576613!3d-6.358686262207581!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e42172a77bc5e3d%3A0x37dd0ac56413a06d!2sBPKAD%20Kab.%20Lebak!5e0!3m2!1sid!2sid!4v1754276402373!5m2!1sid!2sid\" width=\"600\" height=\"450\" style=\"border:0;\" allowfullscreen=\"\" loading=\"lazy\" referrerpolicy=\"no-referrer-when-downgrade\"></iframe>', 0, 1, '2025-08-03 20:00:09', '2025-08-03 20:00:09'),
(4, 'Badan Perencanaan Pembangunan RIset dan Inovasi Daerah ', 'badan-perencanaan-pembangunan-riset-dan-inovasi-daerah', 'Bapperida', 'Badan Perencanaan Pembangunan RIset dan Inovasi Daerah ', 'Bapperida@lebakkab.go.id', '0252555666', 'https://bapperida.lebakkab.go.id', 'jl abdinegara no sekian', 'opd/Sc3kXbSLoZN49mEb3TWVo2jM5848ug-metaMTY0ODQ1MjQ5MF9hNmJlMTlkMTIwMjk0YjE5NjBkNy5wbmc=-.png', NULL, '<iframe src=\"https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3965.25134243884!2d106.24460377576601!3d-6.3615073622340494!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e4216d432ebe781%3A0xbef920dc5406e33d!2sBadan%20Perencanaan%20Pembangunan%20Daerah%20(Bappeda)%20Kabupaten%20Lebak!5e0!3m2!1sid!2sid!4v1754276545909!5m2!1sid!2sid\" width=\"600\" height=\"450\" style=\"border:0;\" allowfullscreen=\"\" loading=\"lazy\" referrerpolicy=\"no-referrer-when-downgrade\"></iframe>', 0, 1, '2025-08-03 20:02:33', '2025-08-03 20:02:33'),
(5, 'Dinas Lingkungan Hidup', 'dinas-lingkungan-hidup', 'DLH', 'Dinas Lingkungan Hidup', 'dlh@lebakkab.go.id', '0252123654', 'https://dlh.lebakkab.go.id', 'Jl Siliwangi Ona', 'opd/xP14Yj7jxOGAmKIQ1r5nXO304xLoaI-metaMTY0ODQ1MjQ5MF9hNmJlMTlkMTIwMjk0YjE5NjBkNy5wbmc=-.png', 'opd/XvzC28ifS1dV5AU84qD9TWw4ENJ5v7-metaODRlMGYwNDY0MDY3MWIyYjRiNzkzOWI3NTE4ZTI5YjcuanBn-.jpg', '<iframe src=\"https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d126885.96927916248!2d106.17158498453512!3d-6.369900629847187!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e421130393fdf0f%3A0x8333284c39cb2ee!2sDinas%20Lingkungan%20Hidup!5e0!3m2!1sid!2sid!4v1754295623383!5m2!1sid!2sid\" width=\"600\" height=\"450\" style=\"border:0;\" allowfullscreen=\"\" loading=\"lazy\" referrerpolicy=\"no-referrer-when-downgrade\"></iframe>', 0, 1, '2025-08-04 01:20:34', '2025-08-04 01:20:34');

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `pengumumen`
--

CREATE TABLE `pengumumen` (
  `id` bigint UNSIGNED NOT NULL,
  `judul` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `isi` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `file_lampiran` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `mulai_tayang` datetime NOT NULL,
  `selesai_tayang` datetime NOT NULL,
  `status` enum('draft','publish') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'draft',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `pengumumen`
--

INSERT INTO `pengumumen` (`id`, `judul`, `slug`, `isi`, `file_lampiran`, `mulai_tayang`, `selesai_tayang`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Jalan Santai', 'jalan-santai', 'untukjkjkjk\nkjkjkkkj\njljjlkj \ntangall 12', NULL, '2025-08-03 00:00:00', '2025-08-08 00:00:00', 'publish', '2025-08-03 02:03:57', '2025-08-03 02:03:57'),
(2, 'Penutupan jalan', 'penutupan-jalan', 'dfdfd\ndfdfdf\ndfdfdf\ndfdfd', NULL, '2025-08-14 00:00:00', '2025-08-19 00:00:00', 'publish', '2025-08-03 02:04:47', '2025-08-03 02:04:47'),
(3, 'Peralihan jalan Alun alun', 'peralihan-jalan-alun-alun', 'fdfdfd\nfdfdfdf\nfdfdfdf\ndfdfd\n', NULL, '2025-08-15 00:00:00', '2025-08-12 00:00:00', 'publish', '2025-08-03 02:05:34', '2025-08-03 02:05:34'),
(4, 'Penutupan Jalan Raya', 'penutupan-jalan-raya', 'fdfdfd\nfdfdf\ndfdfd', NULL, '2025-08-02 00:00:00', '2025-08-19 00:00:00', 'publish', '2025-08-03 02:08:29', '2025-08-03 02:08:29'),
(5, 'Jalur Penutupan kegiatan CFD', 'jalur-penutupan-kegiatan-cfd', 'fdfdfdfdfdfd', NULL, '2025-08-07 00:00:00', '2025-08-31 00:00:00', 'publish', '2025-08-04 01:22:06', '2025-08-04 01:22:06'),
(6, 'Lomba Mancing', 'lomba-mancing', 'dfdfdf', 'pengumuman/01K2E8Q4T8W8F522QDJXMTKXP5.pdf', '2025-08-07 00:00:00', '2025-08-13 00:00:00', 'draft', '2025-08-11 21:30:49', '2025-08-11 21:30:49');

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `poling`
--

CREATE TABLE `poling` (
  `poling_id` bigint UNSIGNED NOT NULL,
  `pilihan` varchar(150) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `type` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `rating` int NOT NULL DEFAULT '0',
  `status` varchar(1) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Y',
  `id` bigint UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `poling`
--

INSERT INTO `poling` (`poling_id`, `pilihan`, `type`, `rating`, `status`, `id`) VALUES
(3, 'Bagaimana Informasi di Website Ini?', 'Pertanyaan', 0, '1', NULL),
(4, 'Baik', 'Jawaban', 20, '1', 3),
(5, 'Kurang Baik', 'Jawaban', 5, '1', 3),
(6, 'Sangat Baik', 'Jawaban', 2, '1', 3);

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

CREATE TABLE `settings` (
  `id` bigint UNSIGNED NOT NULL,
  `site_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `site_description` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `logo` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `favicon` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `whatsapp` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `facebook` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `instagram` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `twitter` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `youtube` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `footer_text` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `meta_keywords` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `meta_description` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `maintenance_mode` tinyint(1) NOT NULL DEFAULT '0',
  `google_analytics_id` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `maps_embed` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `maps_link` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `photo_bupati` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `photo_wakil_bupati` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tagline` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `logo_tagline` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `satuan_kerja` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `settings`
--

INSERT INTO `settings` (`id`, `site_name`, `site_description`, `logo`, `favicon`, `address`, `email`, `phone`, `whatsapp`, `facebook`, `instagram`, `twitter`, `youtube`, `footer_text`, `meta_keywords`, `meta_description`, `maintenance_mode`, `google_analytics_id`, `maps_embed`, `maps_link`, `photo_bupati`, `photo_wakil_bupati`, `tagline`, `logo_tagline`, `satuan_kerja`, `created_at`, `updated_at`) VALUES
(1, 'LEBAKKAB.GO.ID', 'Situs resmi layanan & informasi pemerintah daerah.', 'settings/c6FknsB1zB1bIsIrn4y9uNGzvTnzUU-metaMTY0ODQ1MjQ5MF9hNmJlMTlkMTIwMjk0YjE5NjBkNy5wbmc=-.png', NULL, 'Jl. Abdi Neara No 1', 'admin@lebakkab.go.id', '081234567890', 'https://wa.me/6281234567890', 'https://facebook.com/portalpemerintah', 'https://instagram.com/portalpemerintah', 'https://twitter.com/portalpemerintah', 'https://youtube.com/@portalpemerintah', '© 2025 Pemerintah Kabupaten lebak. All rights reserved.', 'pemerintah kabupaten lebak', 'Portal resmi layanan dan informasi Pemerintah Kabupaten lebak', 1, 'UA-XXXXXXXXX-X', '<iframe src=\"https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3965.257195219955!2d106.24506047576604!3d-6.360748762226899!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e4216d5d8954039%3A0x3c7f73c313376fef!2sSekretariat%20Daerah%20Kabupaten%20Lebak!5e0!3m2!1sid!2sid!4v1753938817166!5m2!1sid!2sid\" width=\"600\" height=\"450\" style=\"border:0;\" allowfullscreen=\"\" loading=\"lazy\" referrerpolicy=\"no-referrer-when-downgrade\"></iframe>', 'https://goo.gl/maps/abc123xyz', 'settings/01K2AKCDEQXRPDA8GY6J3D5368.png', 'settings/01K22NA7K1HG7Z4AB0MJK5P3PZ.png', 'Lebakruhay', 'settings/01K22P58ZQPZWQ0K1C80H5M9MY.png', 'Pemrintah Kabupaten Lebak', '2025-07-30 18:50:28', '2025-08-01 01:15:13');

-- --------------------------------------------------------

--
-- Table structure for table `tags`
--

CREATE TABLE `tags` (
  `id` bigint UNSIGNED NOT NULL,
  `nama` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tags`
--

INSERT INTO `tags` (`id`, `nama`, `slug`, `created_at`, `updated_at`) VALUES
(1, 'lebakruhay', 'lebakruhay', '2025-07-24 00:36:48', '2025-08-04 22:34:03'),
(2, 'beritaharini', 'beritaharini', '2025-07-24 00:38:50', '2025-08-04 22:34:13');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'moriuz', 'contact.moriuz@gmail.com', NULL, '$2y$10$ntS.KPMdf9f4xngPFpx3wOUs91Ezg9wg8sqFPG8vegIaJZGC7hLP.', 'piDAVcOZSmefOL1s2cA4oZFbzHfbfJFhk4tju7NFHPFeSdeoSnqI4qUKNX9s', '2025-07-21 20:36:11', '2025-07-21 20:36:11');

-- --------------------------------------------------------

--
-- Table structure for table `vidios`
--

CREATE TABLE `vidios` (
  `id` bigint UNSIGNED NOT NULL,
  `kategori_vidio_id` bigint UNSIGNED NOT NULL,
  `judul_vidio` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `keterangan` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `sumber_youtube` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `vidios`
--

INSERT INTO `vidios` (`id`, `kategori_vidio_id`, `judul_vidio`, `keterangan`, `sumber_youtube`, `is_active`, `created_at`, `updated_at`) VALUES
(1, 1, 'Pemkab Lebak Gelar Upacara Peringati Hari Pahlawan Tahun 2023', 'llllllllllllllll', '9NiOuemkUH8', 1, '2025-07-28 23:28:41', '2025-07-29 00:20:21'),
(2, 2, 'BIMBINGAN TEKNIS KELOMPOK INFORMASI MASYARAKAT (KIM) KABUPATEN LEBAK TAHUN 2024', 'kkkkkk', 'DairafmbPlo', 1, '2025-07-28 23:44:36', '2025-07-29 00:45:50'),
(3, 3, 'Penggunaan TTE di ', 'ini adalah vidio poenggunakan TTD elektronik', '2KTtq4ig9sg', 1, '2025-07-29 00:44:37', '2025-07-29 00:48:14'),
(4, 2, 'Potensi dan Peluang Investasi di Kabupaten Lebak', 'Potensi dan Peluang Investasi di Kabupaten Lebak', 'K3PwlVkb8ZQ', 1, '2025-07-29 02:34:32', '2025-07-29 02:34:32'),
(5, 5, 'wajah', 'xxxxxxxxxxx', '8t8sDbhZMx0', 1, '2025-07-29 02:40:43', '2025-07-29 02:40:43'),
(7, 5, 'Pemkab Lebak Gelar Upacara Peringati Hari Pahlawan Tahun 2023', 'Pemkab Lebak Gelar Upacara Peringati Hari Pahlawan Tahun 2023', '9NiOuemkUH8', 1, '2025-08-07 10:22:18', '2025-08-07 10:25:24');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `agendas`
--
ALTER TABLE `agendas`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `banners`
--
ALTER TABLE `banners`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `beritas`
--
ALTER TABLE `beritas`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `beritas_slug_unique` (`slug`),
  ADD KEY `beritas_kategori_id_foreign` (`kategori_id`),
  ADD KEY `beritas_user_id_foreign` (`user_id`);

--
-- Indexes for table `berita_tag`
--
ALTER TABLE `berita_tag`
  ADD PRIMARY KEY (`berita_id`,`tag_id`),
  ADD KEY `berita_tag_tag_id_foreign` (`tag_id`);

--
-- Indexes for table `data_aplikasis`
--
ALTER TABLE `data_aplikasis`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `dokumens`
--
ALTER TABLE `dokumens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `slug` (`slug`),
  ADD KEY `dokumens_kategori_dokumen_id_foreign` (`kategori_dokumen_id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `fotos`
--
ALTER TABLE `fotos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fotos_kategori_foto_id_foreign` (`kategori_foto_id`);

--
-- Indexes for table `galeris`
--
ALTER TABLE `galeris`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `halaman_ddddd`
--
ALTER TABLE `halaman_ddddd`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `halaman_statis_slug_unique` (`slug`);

--
-- Indexes for table `halaman_statis`
--
ALTER TABLE `halaman_statis`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `pages_slug_unique` (`slug`);

--
-- Indexes for table `hero_sliders`
--
ALTER TABLE `hero_sliders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `informasi_layanans`
--
ALTER TABLE `informasi_layanans`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `kategoris`
--
ALTER TABLE `kategoris`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `kategoris_slug_unique` (`slug`);

--
-- Indexes for table `kategori_dokumens`
--
ALTER TABLE `kategori_dokumens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `kategori_dokumens_slug_unique` (`slug`);

--
-- Indexes for table `kategori_fotos`
--
ALTER TABLE `kategori_fotos`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `kategori_fotos_slug_unique` (`slug`);

--
-- Indexes for table `kategori_vidios`
--
ALTER TABLE `kategori_vidios`
  ADD PRIMARY KEY (`id_kategori_vidio`),
  ADD UNIQUE KEY `kategori_vidios_slug_kategori_vidio_unique` (`slug_kategori_vidio`);

--
-- Indexes for table `kecamatans`
--
ALTER TABLE `kecamatans`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `kecamatans_slug_unique` (`slug`);

--
-- Indexes for table `kritik_sarans`
--
ALTER TABLE `kritik_sarans`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `menus`
--
ALTER TABLE `menus`
  ADD PRIMARY KEY (`id`),
  ADD KEY `menus_parent_id_index` (`parent_id`),
  ADD KEY `menus_type_index` (`type`),
  ADD KEY `menus_sort_order_index` (`sort_order`),
  ADD KEY `menus_is_active_index` (`is_active`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `opds`
--
ALTER TABLE `opds`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `opds_slug_unique` (`slug`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `pengumumen`
--
ALTER TABLE `pengumumen`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `pengumumen_slug_unique` (`slug`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `poling`
--
ALTER TABLE `poling`
  ADD PRIMARY KEY (`poling_id`);

--
-- Indexes for table `settings`
--
ALTER TABLE `settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tags`
--
ALTER TABLE `tags`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `tags_slug_unique` (`slug`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Indexes for table `vidios`
--
ALTER TABLE `vidios`
  ADD PRIMARY KEY (`id`),
  ADD KEY `vidios_kategori_vidio_id_foreign` (`kategori_vidio_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `agendas`
--
ALTER TABLE `agendas`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `banners`
--
ALTER TABLE `banners`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `beritas`
--
ALTER TABLE `beritas`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT for table `data_aplikasis`
--
ALTER TABLE `data_aplikasis`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `dokumens`
--
ALTER TABLE `dokumens`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `fotos`
--
ALTER TABLE `fotos`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `galeris`
--
ALTER TABLE `galeris`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `halaman_ddddd`
--
ALTER TABLE `halaman_ddddd`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `halaman_statis`
--
ALTER TABLE `halaman_statis`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `hero_sliders`
--
ALTER TABLE `hero_sliders`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `informasi_layanans`
--
ALTER TABLE `informasi_layanans`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `kategoris`
--
ALTER TABLE `kategoris`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `kategori_dokumens`
--
ALTER TABLE `kategori_dokumens`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `kategori_fotos`
--
ALTER TABLE `kategori_fotos`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `kategori_vidios`
--
ALTER TABLE `kategori_vidios`
  MODIFY `id_kategori_vidio` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `kecamatans`
--
ALTER TABLE `kecamatans`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `kritik_sarans`
--
ALTER TABLE `kritik_sarans`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `menus`
--
ALTER TABLE `menus`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;

--
-- AUTO_INCREMENT for table `opds`
--
ALTER TABLE `opds`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `pengumumen`
--
ALTER TABLE `pengumumen`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `poling`
--
ALTER TABLE `poling`
  MODIFY `poling_id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `settings`
--
ALTER TABLE `settings`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tags`
--
ALTER TABLE `tags`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `vidios`
--
ALTER TABLE `vidios`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `beritas`
--
ALTER TABLE `beritas`
  ADD CONSTRAINT `beritas_kategori_id_foreign` FOREIGN KEY (`kategori_id`) REFERENCES `kategoris` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `beritas_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `berita_tag`
--
ALTER TABLE `berita_tag`
  ADD CONSTRAINT `berita_tag_berita_id_foreign` FOREIGN KEY (`berita_id`) REFERENCES `beritas` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `berita_tag_tag_id_foreign` FOREIGN KEY (`tag_id`) REFERENCES `tags` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `dokumens`
--
ALTER TABLE `dokumens`
  ADD CONSTRAINT `dokumens_kategori_dokumen_id_foreign` FOREIGN KEY (`kategori_dokumen_id`) REFERENCES `kategori_dokumens` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `fotos`
--
ALTER TABLE `fotos`
  ADD CONSTRAINT `fotos_kategori_foto_id_foreign` FOREIGN KEY (`kategori_foto_id`) REFERENCES `kategori_fotos` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `menus`
--
ALTER TABLE `menus`
  ADD CONSTRAINT `menus_parent_id_foreign` FOREIGN KEY (`parent_id`) REFERENCES `menus` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `vidios`
--
ALTER TABLE `vidios`
  ADD CONSTRAINT `vidios_kategori_vidio_id_foreign` FOREIGN KEY (`kategori_vidio_id`) REFERENCES `kategori_vidios` (`id_kategori_vidio`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
