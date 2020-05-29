-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 13, 2018 at 12:56 PM
-- Server version: 10.1.26-MariaDB
-- PHP Version: 7.1.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `vape`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `username` varchar(200) NOT NULL,
  `password` varchar(200) NOT NULL,
  `avatar` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `username`, `password`, `avatar`) VALUES
(1, 'ohannavape', '$2y$10$sRYxhF8LXSV1CXndRpqx2e0TioF7uYbGPte28UTiTNdibeOydb/rS', '5b742987863b5.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `keranjang`
--

CREATE TABLE `keranjang` (
  `id` int(11) NOT NULL,
  `id_produk` int(11) NOT NULL,
  `jumlah` int(11) NOT NULL,
  `tanggal` date NOT NULL,
  `id_pemesan` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `pelanggan`
--

CREATE TABLE `pelanggan` (
  `id` int(11) NOT NULL,
  `username` varchar(200) NOT NULL,
  `email` varchar(200) NOT NULL,
  `password` varchar(200) NOT NULL,
  `nama` varchar(200) NOT NULL,
  `alamat` varchar(500) NOT NULL,
  `nohp` varchar(14) NOT NULL,
  `avatar` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pelanggan`
--

INSERT INTO `pelanggan` (`id`, `username`, `email`, `password`, `nama`, `alamat`, `nohp`, `avatar`) VALUES
(1, 'ohanna', 'ohannavape@gmail.com', '$2y$10$kgNhf/XPcNRIPVuBcw96HuS/EFjktgTRAowkHN/nZfI8dJ4ktAxoe', 'Ohanna Vape', 'Singkawang', '089292924595', '5b6efedc2154f.jpg'),
(2, 'ronal', 'ronaldopeipiro11@gmail.com', '$2y$10$n35m3alY31NsdW6Cq9xS8.YWRqABspv/E7WO8INKBdDhUtR54cm/C', 'ronal', 'Singkawang', '089620505037', '5b738b966cc73.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `pesanan`
--

CREATE TABLE `pesanan` (
  `id` int(11) NOT NULL,
  `id_pemesan` int(11) NOT NULL,
  `id_produk` int(11) NOT NULL,
  `id_transaksi` varchar(200) NOT NULL,
  `tanggal` date NOT NULL,
  `waktu` time NOT NULL,
  `jumlah_barang` varchar(10) NOT NULL,
  `jumlah_bayar` varchar(20) NOT NULL,
  `alamat_pengiriman` varchar(500) NOT NULL,
  `kodepos` varchar(10) NOT NULL,
  `bank` varchar(20) NOT NULL,
  `jasa_pengiriman` varchar(10) NOT NULL,
  `status` varchar(50) NOT NULL,
  `buktipembayaran` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pesanan`
--

INSERT INTO `pesanan` (`id`, `id_pemesan`, `id_produk`, `id_transaksi`, `tanggal`, `waktu`, `jumlah_barang`, `jumlah_bayar`, `alamat_pengiriman`, `kodepos`, `bank`, `jasa_pengiriman`, `status`, `buktipembayaran`) VALUES
(11, 1, 18, '2147483647', '2018-08-21', '23:49:54', '1', '55000', 'Jl. Panglima, Gg. Mawar, No.66, Pontianak Barat, Kota Pontianak', '839189', 'BCA', 'JNE', 'Di terima', '5b7c47db26cf3.png'),
(12, 1, 15, '2147483647', '2018-08-21', '23:49:54', '1', '75000', 'Jl. Panglima, Gg. Mawar, No.66, Pontianak Barat, Kota Pontianak', '839189', 'BCA', 'JNE', 'Di terima', '5b7c47db26cf3.png'),
(14, 1, 9, '2147483647', '2018-08-22', '00:28:41', '1', '310000', 'Jl. Merpati, No. 89, Singkawang Selatan, Kota Singkawang', '92829', 'BNI', 'JNE', 'Di terima', ''),
(15, 1, 14, '2147483647', '2018-08-22', '00:28:41', '1', '340000', 'Jl. Merpati, No. 89, Singkawang Selatan, Kota Singkawang', '92829', 'BNI', 'JNE', 'Di terima', ''),
(18, 1, 13, '22082018153487329913489670811', '2018-08-22', '00:41:39', '1', '550000', 'asajshj', '128397', 'BNI', 'TIKI', 'Belum dibayar', ''),
(19, 1, 13, '2208201815348740102379804181', '2018-08-22', '00:53:30', '1', '550000', 'adgsg', '08989', 'BRI', 'JNE', 'Pengiriman', '5b7c51b2a8a63.jpg'),
(20, 2, 11, '29082018153550610120716206152', '2018-08-29', '08:28:21', '1', '55000', 'asasa', 'saas', 'BNI', 'JNE', 'Belum dibayar', ''),
(21, 2, 14, '29082018153550610120716206152', '2018-08-29', '08:28:21', '1', '340000', 'asasa', 'saas', 'BNI', 'JNE', 'Belum dibayar', ''),
(22, 2, 1, '13092018153683518111827865062', '2018-09-13', '17:39:41', '1', '248000', 'test', '12937891', 'BNI', 'JNE', 'Di terima', '5b9a3ec8f4019.jpg'),
(23, 2, 9, '13092018153683518111827865062', '2018-09-13', '17:39:41', '1', '310000', 'test', '12937891', 'BNI', 'JNE', 'Di terima', '5b9a3ec8f4019.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `produk`
--

CREATE TABLE `produk` (
  `id` int(11) NOT NULL,
  `nama` varchar(200) NOT NULL,
  `kategori` varchar(50) NOT NULL,
  `brand` varchar(200) NOT NULL,
  `keterangan` varchar(10000) NOT NULL,
  `harga` int(20) NOT NULL,
  `stok` int(11) NOT NULL,
  `foto` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `produk`
--

INSERT INTO `produk` (`id`, `nama`, `kategori`, `brand`, `keterangan`, `harga`, `stok`, `foto`) VALUES
(1, 'Vape test 1', 'kawat', 'Test', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quibusdam, sunt ad molestiae ipsam alias aliquid fugiat, minima? Exercitationem, ratione necessitatibus, voluptate veritatis velit, molestiae neque suscipit assumenda ipsum vel corrupti.', 248000, 4, '5b6f74c09cb0e.jpg'),
(2, 'Uncle junks', 'liquid', 'hsjaghgh', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Esse corrupti quos sed repellendus nihil enim vitae optio molestias hic culpa, voluptates tenetur laudantium pariatur dicta tempora nisi corporis consequuntur iusto eos! Autem expedita ipsum laboriosam similique vero suscipit culpa necessitatibus, tempora error placeat voluptas dolore sed, dolores laborum, voluptatibus qui minus rem. Sapiente, eligendi est quisquam voluptatibus accusamus tenetur assumenda enim quam culpa quasi! Tempora minima a, amet, molestias tenetur dicta esse, accusamus vel impedit iure labore placeat nam asperiores. Omnis alias consequuntur natus, asperiores maiores. Veritatis at, voluptatem explicabo vero, mollitia iusto modi ex quae, dolorum nesciunt, earum inventore.', 800000, 49, '5b6f7c2eb4465.jpg'),
(3, 'FOG', 'aksesoris', 'sagsah', 'adajgb', 300000, 20, '5b70cf4ab53f7.jpg'),
(4, 'Liqud', 'liquid', 'bdsjvg', 'kskhd', 700000, 6, '5b70d052dadb2.jpg'),
(5, 'test', 'alat', 'zndjzhbj', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Esse corrupti quos sed repellendus nihil enim vitae optio molestias hic culpa, voluptates tenetur laudantium pariatur dicta tempora nisi corporis consequuntur iusto eos! Autem expedita ipsum laboriosam similique vero suscipit culpa necessitatibus, tempora error placeat voluptas dolore sed, dolores laborum, voluptatibus qui minus rem. Sapiente, eligendi est quisquam voluptatibus accusamus tenetur assumenda enim quam culpa quasi! Tempora minima a, amet, molestias tenetur dicta esse, accusamus vel impedit iure labore placeat nam asperiores. Omnis alias consequuntur natus, asperiores maiores. Veritatis at, voluptatem explicabo vero, mollitia iusto modi ex quae, dolorum nesciunt, earum inventore.', 30000, 50, '5b70d0a70d779.jpg'),
(7, 'Test 23', 'kawat', 'tesg', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Esse corrupti quos sed repellendus nihil enim vitae optio molestias hic culpa, voluptates tenetur laudantium pariatur dicta tempora nisi corporis consequuntur iusto eos! Autem expedita ipsum laboriosam similique vero suscipit culpa necessitatibus, tempora error placeat voluptas dolore sed, dolores laborum, voluptatibus qui minus rem. Sapiente, eligendi est quisquam voluptatibus accusamus tenetur assumenda enim quam culpa quasi! Tempora minima a, amet, molestias tenetur dicta esse, accusamus vel impedit iure labore placeat nam asperiores. Omnis alias consequuntur natus, asperiores maiores. Veritatis at, voluptatem explicabo vero, mollitia iusto modi ex quae, dolorum nesciunt, earum inventore.', 320000, 20, '5b70d9f3d38d4.png'),
(8, 'Vape3', 'mod', 'dbagvah', 'asa\r\nasasa', 30000, 6, '5b70dd0909049.jpg'),
(9, 'Vape4', 'mod', 'asdjgsa', 'sad', 310000, 1, '5b70df1d8b5d0.jpg'),
(10, 'Vape5', 'alat', 'ada', 'addnagdshgfh', 60000, 7, '5b70e0c247eda.jpg'),
(11, 'Vape1', 'liquid', 'dsjgdg', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Esse corrupti quos sed repellendus nihil enim vitae optio molestias hic culpa, voluptates tenetur laudantium pariatur dicta tempora nisi corporis consequuntur iusto eos! Autem expedita ipsum laboriosam similique vero suscipit culpa necessitatibus, tempora error placeat voluptas dolore sed, dolores laborum, voluptatibus qui minus rem. Sapiente, eligendi est quisquam voluptatibus accusamus tenetur assumenda enim quam culpa quasi! Tempora minima a, amet, molestias tenetur dicta esse, accusamus vel impedit iure labore placeat nam asperiores. Omnis alias consequuntur natus, asperiores maiores. Veritatis at, voluptatem explicabo vero, mollitia iusto modi ex quae, dolorum nesciunt, earum inventore.', 55000, 14, '5b70e0e269a23.jpg'),
(12, 'Funta', 'liquid', 'VaperBoy', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Veniam et, voluptatum blanditiis. Doloribus ex nesciunt dolor in odit voluptatem vel praesentium illo excepturi! Odit molestiae doloremque quas illo quasi voluptas ducimus tenetur repellendus eum soluta fuga perferendis architecto inventore ipsam asperiores autem dolore deleniti quam, quae nam eos? Saepe deserunt veritatis officiis dolores, culpa. Quam eveniet voluptatibus voluptatem modi quos, aut non voluptas aperiam veniam, numquam in sapiente, ducimus ad impedit! Facilis eius, officia voluptatibus deserunt ratione blanditiis amet earum culpa. Voluptatem officiis, culpa nostrum maxime? Illum, illo neque tempore libero esse, hic facere eveniet alias ab impedit blanditiis dolor!', 235000, 50, '5b72afdf5999a.jpg'),
(13, 'MOD 21267126', 'mod', 'VapeKing', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quasi laudantium accusantium facilis dolore aspernatur, esse, doloremque magni enim nostrum delectus similique repellat libero molestias eum velit ipsum nobis, non voluptate reprehenderit quis. Necessitatibus a eligendi aut aliquam quam deserunt dolorum earum, laboriosam iusto possimus expedita delectus aspernatur, libero ut debitis sequi nesciunt tempora. Aliquid, voluptas facere repellat numquam repellendus quis qui itaque aliquam eaque laborum id, a nihil officia sapiente ad nobis tenetur asperiores delectus magni mollitia placeat odio laudantium molestiae adipisci! Culpa cupiditate est, sed cumque nostrum! Maiores error cumque animi, dolore ex iusto eum aliquam odit id molestiae!', 550000, 44, '5b72b25c59e3e.jpg'),
(14, 'MOD VAPE', 'mod', 'vaper', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quasi laudantium accusantium facilis dolore aspernatur, esse, doloremque magni enim nostrum delectus similique repellat libero molestias eum velit ipsum nobis, non voluptate reprehenderit quis. Necessitatibus a eligendi aut aliquam quam deserunt dolorum earum, laboriosam iusto possimus expedita delectus aspernatur, libero ut debitis sequi nesciunt tempora. Aliquid, voluptas facere repellat numquam repellendus quis qui itaque aliquam eaque laborum id, a nihil officia sapiente ad nobis tenetur asperiores delectus magni mollitia placeat odio laudantium molestiae adipisci! Culpa cupiditate est, sed cumque nostrum! Maiores error cumque animi, dolore ex iusto eum aliquam odit id molestiae!', 340000, 19, '5b72b28395acc.jpg'),
(15, 'VAPER KING AKSESORIS', 'aksesoris', 'KINGVAPE', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quasi laudantium accusantium facilis dolore aspernatur, esse, doloremque magni enim nostrum delectus similique repellat libero molestias eum velit ipsum nobis, non voluptate reprehenderit quis. Necessitatibus a eligendi aut aliquam quam deserunt dolorum earum, laboriosam iusto possimus expedita delectus aspernatur, libero ut debitis sequi nesciunt tempora. Aliquid, voluptas facere repellat numquam repellendus quis qui itaque aliquam eaque laborum id, a nihil officia sapiente ad nobis tenetur asperiores delectus magni mollitia placeat odio laudantium molestiae adipisci! Culpa cupiditate est, sed cumque nostrum! Maiores error cumque animi, dolore ex iusto eum aliquam odit id molestiae!', 75000, 86, '5b72b348984b8.jpg'),
(16, 'VAPE209', 'kawat', 'VAPOR', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Explicabo voluptatibus nobis facilis, cum doloremque. Magnam odit commodi molestiae animi, mollitia. Illo eveniet sint odit obcaecati maiores laudantium ipsum ad officiis alias, quod corrupti quo voluptas molestias, culpa nam, incidunt sunt est libero quasi nulla labore. Sunt dolorem quam, deleniti, eos ex beatae? Dicta odio sint temporibus voluptate id unde voluptates similique earum, optio magni ab, necessitatibus minima cupiditate illum nobis aperiam incidunt nisi reprehenderit dolore neque vero error explicabo. Non velit, voluptatibus. Repellendus nobis est omnis. Explicabo, quibusdam, laudantium. Ducimus adipisci consectetur nostrum voluptatem nisi doloremque, voluptas dolorem? Nisi, ipsam?', 87500, 12, '5b72e0da99742.jpg'),
(17, 'TEST KAPAS', 'kapas', 'TEST', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Explicabo voluptatibus nobis facilis, cum doloremque. Magnam odit commodi molestiae animi, mollitia. Illo eveniet sint odit obcaecati maiores laudantium ipsum ad officiis alias, quod corrupti quo voluptas molestias, culpa nam, incidunt sunt est libero quasi nulla labore. Sunt dolorem quam, deleniti, eos ex beatae? Dicta odio sint temporibus voluptate id unde voluptates similique earum, optio magni ab, necessitatibus minima cupiditate illum nobis aperiam incidunt nisi reprehenderit dolore neque vero error explicabo. Non velit, voluptatibus. Repellendus nobis est omnis. Explicabo, quibusdam, laudantium. Ducimus adipisci consectetur nostrum voluptatem nisi doloremque, voluptas dolorem? Nisi, ipsam?', 78000, 79, '5b72e120e7c45.jpg'),
(18, 'KAPAS VAPE', 'kapas', 'VAPOR', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Explicabo voluptatibus nobis facilis, cum doloremque. Magnam odit commodi molestiae animi, mollitia. Illo eveniet sint odit obcaecati maiores laudantium ipsum ad officiis alias, quod corrupti quo voluptas molestias, culpa nam, incidunt sunt est libero quasi nulla labore. Sunt dolorem quam, deleniti, eos ex beatae? Dicta odio sint temporibus voluptate id unde voluptates similique earum, optio magni ab, necessitatibus minima cupiditate illum nobis aperiam incidunt nisi reprehenderit dolore neque vero error explicabo. Non velit, voluptatibus. Repellendus nobis est omnis. Explicabo, quibusdam, laudantium. Ducimus adipisci consectetur nostrum voluptatem nisi doloremque, voluptas dolorem? Nisi, ipsam?', 55000, 44, '5b72e1494556f.jpg'),
(19, 'TEST MOD', 'mod', 'MOD VAPE', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Explicabo voluptatibus nobis facilis, cum doloremque. Magnam odit commodi molestiae animi, mollitia. Illo eveniet sint odit obcaecati maiores laudantium ipsum ad officiis alias, quod corrupti quo voluptas molestias, culpa nam, incidunt sunt est libero quasi nulla labore. Sunt dolorem quam, deleniti, eos ex beatae? Dicta odio sint temporibus voluptate id unde voluptates similique earum, optio magni ab, necessitatibus minima cupiditate illum nobis aperiam incidunt nisi reprehenderit dolore neque vero error explicabo. Non velit, voluptatibus. Repellendus nobis est omnis. Explicabo, quibusdam, laudantium. Ducimus adipisci consectetur nostrum voluptatem nisi doloremque, voluptas dolorem? Nisi, ipsam', 89000, 91, '5b72e1763b2c2.jpg'),
(20, 'KAWAT VAPE', 'kawat', 'AKGDF', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Explicabo voluptatibus nobis facilis, cum doloremque. Magnam odit commodi molestiae animi, mollitia. Illo eveniet sint odit obcaecati maiores laudantium ipsum ad officiis alias, quod corrupti quo voluptas molestias, culpa nam, incidunt sunt est libero quasi nulla labore. Sunt dolorem quam, deleniti, eos ex beatae? Dicta odio sint temporibus voluptate id unde voluptates similique earum, optio magni ab, necessitatibus minima cupiditate illum nobis aperiam incidunt nisi reprehenderit dolore neque vero error explicabo. Non velit, voluptatibus. Repellendus nobis est omnis. Explicabo, quibusdam, laudantium. Ducimus adipisci consectetur nostrum voluptatem nisi doloremque, voluptas dolorem? Nisi, ipsam?', 92000, 9, '5b72e1b13916a.jpg');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `keranjang`
--
ALTER TABLE `keranjang`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pelanggan`
--
ALTER TABLE `pelanggan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pesanan`
--
ALTER TABLE `pesanan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `produk`
--
ALTER TABLE `produk`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `keranjang`
--
ALTER TABLE `keranjang`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `pelanggan`
--
ALTER TABLE `pelanggan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `pesanan`
--
ALTER TABLE `pesanan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `produk`
--
ALTER TABLE `produk`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
