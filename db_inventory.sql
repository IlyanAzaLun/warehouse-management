-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 09, 2021 at 08:11 AM
-- Server version: 10.4.22-MariaDB
-- PHP Version: 7.3.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_inventory`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_invoice`
--

CREATE TABLE `tbl_invoice` (
  `invoice_id` varchar(255) NOT NULL,
  `date` varchar(255) NOT NULL,
  `date_due` varchar(255) NOT NULL,
  `to_customer_destination` varchar(255) NOT NULL,
  `order_id` varchar(255) NOT NULL,
  `sub_total` varchar(255) DEFAULT NULL,
  `shipping_cost` varchar(255) DEFAULT NULL,
  `discount` varchar(25) DEFAULT NULL,
  `other_cost` varchar(255) DEFAULT NULL,
  `grand_total` varchar(255) DEFAULT NULL,
  `status_item` tinyint(1) NOT NULL,
  `status_validation` tinyint(1) NOT NULL,
  `status_payment` tinyint(1) NOT NULL,
  `status_settlement` tinyint(1) NOT NULL,
  `status_active` tinyint(1) NOT NULL,
  `user` varchar(255) NOT NULL,
  `note` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_invoice`
--

INSERT INTO `tbl_invoice` (`invoice_id`, `date`, `date_due`, `to_customer_destination`, `order_id`, `sub_total`, `shipping_cost`, `discount`, `other_cost`, `grand_total`, `status_item`, `status_validation`, `status_payment`, `status_settlement`, `status_active`, `user`, `note`) VALUES
('0001/INV/SEL/1221', '1639031929', '1639636729', 'C0002', '0001/ORD/SEL/1221', '0', '0', '0', '0', '0', 0, 0, 0, 0, 1, 'Iyang Agung Supriatna', 'Di input oleh bagian gudang');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_item`
--

CREATE TABLE `tbl_item` (
  `item_code` varchar(255) NOT NULL,
  `item_name` varchar(255) NOT NULL,
  `item_category` varchar(255) NOT NULL,
  `MG` varchar(255) NOT NULL,
  `ML` varchar(255) NOT NULL,
  `VG` varchar(255) NOT NULL,
  `PG` varchar(255) NOT NULL,
  `falvour` varchar(255) NOT NULL,
  `brand_1` varchar(255) NOT NULL,
  `brand_2` varchar(255) NOT NULL,
  `quantity` int(255) NOT NULL,
  `unit` varchar(25) NOT NULL,
  `capital_price` varchar(255) NOT NULL,
  `selling_price` varchar(255) NOT NULL,
  `customs` varchar(4) NOT NULL,
  `note` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_item`
--

INSERT INTO `tbl_item` (`item_code`, `item_name`, `item_category`, `MG`, `ML`, `VG`, `PG`, `falvour`, `brand_1`, `brand_2`, `quantity`, `unit`, `capital_price`, `selling_price`, `customs`, `note`) VALUES
('ACC-0001', 'HAT', 'ACC', '', '', '', '', '', 'B.E.D', '', 1581, 'pcs', '50,000', '60,000', '2019', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Laborum quas exercitationem illum unde quibusdam, id eveniet blanditiis ad minus numquam necessitatibus omnis tempora sit autem culpa nemo animi praesentium, dolore.'),
('BAT-0001', 'ABC', 'BATTERY', '', '', '', '', '', 'B.E.D', '', 1, 'pcs', '30.000', '40,000', '2019', 'Battre AA \r\nLorem ipsum dolor sit amet consectetur adipisicing elit. Laborum quas exercitationem illum unde quibusdam, id eveniet blanditiis ad minus numquam necessitatibus omnis tempora sit autem culpa nemo animi praesentium, dolore.'),
('LIQ-FC-0001', 'Acai Pomegranate Nic Salt E-Liquid by Bloom', 'LIQUID FREEBASE CREAMY', '12', '12', '12', '12', '50', 'Unknown', '', 2081, 'pac', '250,000', '300,000', '2019', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Laborum quas exercitationem illum unde quibusdam, id eveniet blanditiis ad minus numquam necessitatibus omnis tempora sit autem culpa nemo animi praesentium, dolore.'),
('LIQ-FF-0001', 'SEBATS', 'LIQUID FREEBASE FRUITY', '3', '100', '70', '30', 'djarum', 'bed', '', 100, 'pcs', '120,000', '110,000', '', ''),
('LIQ-FF-0002', 'SEBATS', 'LIQUID FREEBASE FRUITY', '5', '100', '70', '30', 'djarum', 'BED', '', 100, 'pcs', '100,000', '120,000', '', '100 FREE 5'),
('LIQ-FF-0003', 'SEBATS', 'LIQUID FREEBASE FRUITY', '10', '100', '70', '30', 'DJARUM', 'BED', '', 0, 'pcs', '150,000', '180,000', '2021', ''),
('LIQ-SC-0001', 'COKLAT', 'LIQUID SALT CREAMY', '70', '80', '897', '988', 'Coklat', 'BED', '', 720, 'pac', '199,999', '299,999', '2019', ''),
('LIQ-SF-0001', 'MARJAN', 'LIQUID SALT FRUITY', '12', '12', '12', '12', 'Orange', 'BED', '', 3220, 'pac', '80.000', '950.000', '2019', 'Note\r\nLorem ipsum dolor sit amet consectetur adipisicing elit. Laborum quas exercitationem illum unde quibusdam, id eveniet blanditiis ad minus numquam necessitatibus omnis tempora sit autem culpa nemo animi praesentium, dolore.');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_item_history`
--

CREATE TABLE `tbl_item_history` (
  `history_id` int(11) NOT NULL,
  `item_code` varchar(255) NOT NULL,
  `previous_selling_price` varchar(255) NOT NULL,
  `previous_capital_price` varchar(255) NOT NULL,
  `previous_quantity` varchar(255) NOT NULL,
  `status_in_out` varchar(50) NOT NULL,
  `update_at` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_item_history`
--

INSERT INTO `tbl_item_history` (`history_id`, `item_code`, `previous_selling_price`, `previous_capital_price`, `previous_quantity`, `status_in_out`, `update_at`) VALUES
(1, 'LIQ-FC-0001', '300,000', '250,000', '2091', 'OUT (-10)', 1639031929),
(2, 'ACC-0001', '60,000', '50,000', '1591', 'OUT (-10)', 1639031929);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_order`
--

CREATE TABLE `tbl_order` (
  `index_order` varchar(255) NOT NULL,
  `order_id` varchar(255) NOT NULL,
  `item_id` varchar(255) NOT NULL,
  `capital_price` varchar(255) NOT NULL,
  `selling_price` varchar(255) NOT NULL,
  `quantity` int(255) NOT NULL,
  `unit` varchar(25) NOT NULL,
  `rabate` varchar(255) NOT NULL,
  `user_id` varchar(255) DEFAULT NULL,
  `date` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_order`
--

INSERT INTO `tbl_order` (`index_order`, `order_id`, `item_id`, `capital_price`, `selling_price`, `quantity`, `unit`, `rabate`, `user_id`, `date`) VALUES
('a5438f1c-2a46-4dbd-87b6-e6b053d268e3', '0001/ORD/SEL/1221', 'ACC-0001', '50,000', '60,000', -10, 'pcs', '0', 'C0002', 1639031929),
('eeffafad-284b-452f-8ca1-5455847cdd2d', '0001/ORD/SEL/1221', 'LIQ-FC-0001', '250,000', '300,000', -10, 'pac', '0', 'C0002', 1639031929);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_role`
--

CREATE TABLE `tbl_role` (
  `id` varchar(255) NOT NULL,
  `role_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_role`
--

INSERT INTO `tbl_role` (`id`, `role_name`) VALUES
('190f670e-4907-11ec-8cc8-1be21be013bc', 'Marketing'),
('5347d8a4-4925-11ec-8cc8-1be21be013bc', 'Supplier'),
('752c0ad8-4925-11ec-8cc8-1be21be013bc', 'Customer'),
('c046aeb0-40f9-11ec-ae08-0d3b0460d819', 'Administrator'),
('c046d399-40f9-11ec-ae08-0d3b0460d819', 'Finance'),
('dc9126cc-57de-11ec-86f5-54e1ada26e81', 'Warehouse'),
('df9a5008-49c5-11ec-915b-5cac4cba0f32', 'Shipping');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_user`
--

CREATE TABLE `tbl_user` (
  `user_id` varchar(255) NOT NULL,
  `user_fullname` varchar(255) NOT NULL,
  `user_email` varchar(255) NOT NULL,
  `user_image` varchar(128) NOT NULL,
  `user_password` varchar(255) NOT NULL,
  `role_id` varchar(255) NOT NULL,
  `is_active` tinyint(1) NOT NULL,
  `date_created` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_user`
--

INSERT INTO `tbl_user` (`user_id`, `user_fullname`, `user_email`, `user_image`, `user_password`, `role_id`, `is_active`, `date_created`) VALUES
('50f859c9-73d1-4217-b2e4-7d9e59be7fc4', 'Iyang Agung Supriatna', 'iyangagungs', 'assets/images/default.jpg', '$2y$10$C6IJzcNTEsdxZHelB62J9u/nMOL0Z1kQyK5PWGoI.Wnm/0R4ouX8a', 'c046aeb0-40f9-11ec-ae08-0d3b0460d819', 1, 1636431432),
('98a7ec62-9f1e-4bc1-b375-2ef86ad876da', 'Rifky Fahriansyach', 'chefrifkyfahriansyach', 'assets/images/default.jpg', '$2y$10$ITV/.ZWZwJj8WueWocEihuFWxpweW3rzv6g/btc3PSeBNL7NB0aBW', '190f670e-4907-11ec-8cc8-1be21be013bc', 1, 1638933662),
('a7862489-75ad-4436-9ed9-145df4fd5fb4', 'Tuti', 'tuti_shipping', 'assets/images/default.jpg', '$2y$10$rnvWkmJVXCcPTl.vXltkEORMFZOBFvuTc4xcDU.xHHFBFUgifmk4e', 'df9a5008-49c5-11ec-915b-5cac4cba0f32', 1, 1638977417),
('ec61343b-6863-43a6-a064-03a9ca551c4d', 'Nurlaila Azizah', 'nurlailahazizah', 'assets/images/default.jpg', '$2y$10$uftpjkRFSEniBKlXUegI7uIG6HqsfAmF6RaPv42AHekTjlHd5HViW', 'c046d399-40f9-11ec-ae08-0d3b0460d819', 1, 1636465803),
('ed29e269-2637-4231-ba0c-341408adccc2', 'Dedi', 'dedi_warehouse', 'assets/images/default.jpg', '$2y$10$jE/hu87IGxObMY15TnhIKeWvTgZk28HByAEyuF8EcassgvpvgZp4W', 'dc9126cc-57de-11ec-86f5-54e1ada26e81', 1, 1638937357);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_user_access_menu`
--

CREATE TABLE `tbl_user_access_menu` (
  `id` varchar(255) NOT NULL,
  `role_id` varchar(255) NOT NULL,
  `category_id` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_user_access_menu`
--

INSERT INTO `tbl_user_access_menu` (`id`, `role_id`, `category_id`) VALUES
('0470f51c-5839-11ec-86f5-54e1ada26e81', 'c046aeb0-40f9-11ec-ae08-0d3b0460d819', '92589956-c498-4e3f-86fd-d7f489c964a3'),
('04715c9f-5839-11ec-86f5-54e1ada26e81', 'c046d399-40f9-11ec-ae08-0d3b0460d819', '92589956-c498-4e3f-86fd-d7f489c964a3'),
('0471a5ba-5839-11ec-86f5-54e1ada26e81', 'df9a5008-49c5-11ec-915b-5cac4cba0f32', '92589956-c498-4e3f-86fd-d7f489c964a3'),
('08eeeaab-57d8-11ec-86f5-54e1ada26e81', '190f670e-4907-11ec-8cc8-1be21be013bc', '41baae76-4166-11ec-ae08-0d3b0460d819'),
('1991f7ed-4e89-11ec-a560-5cac4cba0f32', '5347d8a4-4925-11ec-8cc8-1be21be013bc', '8bad6901-4798-472e-a810-38f11f207ea8'),
('19a1dcf7-4e89-11ec-a560-5cac4cba0f32', 'c046aeb0-40f9-11ec-ae08-0d3b0460d819', '8bad6901-4798-472e-a810-38f11f207ea8'),
('19ada67b-4e89-11ec-a560-5cac4cba0f32', 'c046d399-40f9-11ec-ae08-0d3b0460d819', '8bad6901-4798-472e-a810-38f11f207ea8'),
('1e31d0ec-583c-11ec-86f5-54e1ada26e81', 'df9a5008-49c5-11ec-915b-5cac4cba0f32', '41baae76-4166-11ec-ae08-0d3b0460d819'),
('2cd33a88-57df-11ec-86f5-54e1ada26e81', 'dc9126cc-57de-11ec-86f5-54e1ada26e81', '41baae76-4166-11ec-ae08-0d3b0460d819'),
('35a0197f-4129-11ec-ae08-0d3b0460d819', 'c046aeb0-40f9-11ec-ae08-0d3b0460d819', 'dec9f1e2-4127-11ec-ae08-0d3b0460d819'),
('35a0301d-4129-11ec-ae08-0d3b0460d819', 'c046aeb0-40f9-11ec-ae08-0d3b0460d819', 'deca10c9-4127-11ec-ae08-0d3b0460d819'),
('458f224e-4129-11ec-ae08-0d3b0460d819', 'c046d399-40f9-11ec-ae08-0d3b0460d819', 'deca10c9-4127-11ec-ae08-0d3b0460d819'),
('6e33a609-4166-11ec-ae08-0d3b0460d819', 'c046d399-40f9-11ec-ae08-0d3b0460d819', '41baae76-4166-11ec-ae08-0d3b0460d819'),
('6e33bb7b-4166-11ec-ae08-0d3b0460d819', 'c046aeb0-40f9-11ec-ae08-0d3b0460d819', '41baae76-4166-11ec-ae08-0d3b0460d819'),
('6e5f0953-4907-11ec-8cc8-1be21be013bc', 'c046aeb0-40f9-11ec-ae08-0d3b0460d819', '85f50b77-69ec-44e7-8a54-def0e8a1efea'),
('70ce988e-415c-11ec-ae08-0d3b0460d819', 'c046aeb0-40f9-11ec-ae08-0d3b0460d819', '85f50b77-69ec-44e7-8a54-def0e8a1efec'),
('70ceb125-415c-11ec-ae08-0d3b0460d819', 'c046d399-40f9-11ec-ae08-0d3b0460d819', '85f50b77-69ec-44e7-8a54-def0e8a1efec'),
('962123a9-4907-11ec-8cc8-1be21be013bc', '190f670e-4907-11ec-8cc8-1be21be013bc', '85f50b77-69ec-44e7-8a54-def0e8a1efea'),
('96213c68-4907-11ec-8cc8-1be21be013bc', 'c046d399-40f9-11ec-ae08-0d3b0460d819', '85f50b77-69ec-44e7-8a54-def0e8a1efea'),
('f0a3ed94-57de-11ec-86f5-54e1ada26e81', 'dc9126cc-57de-11ec-86f5-54e1ada26e81', '8bad6901-4798-472e-a810-38f11f207ea8');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_user_information`
--

CREATE TABLE `tbl_user_information` (
  `user_id` varchar(255) NOT NULL,
  `user_fullname` varchar(255) NOT NULL,
  `owner_name` varchar(255) DEFAULT NULL,
  `user_address` text NOT NULL,
  `village` varchar(255) NOT NULL,
  `sub-district` varchar(255) NOT NULL,
  `district` varchar(255) NOT NULL,
  `province` varchar(255) NOT NULL,
  `zip` varchar(10) NOT NULL,
  `user_contact_phone` varchar(15) NOT NULL,
  `user_contact_email` varchar(35) NOT NULL,
  `role_id` varchar(255) NOT NULL,
  `type_id` varchar(255) DEFAULT NULL COMMENT 'WS, Agen Biasa, Agen Special, Distri, Dll',
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `note` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_user_information`
--

INSERT INTO `tbl_user_information` (`user_id`, `user_fullname`, `owner_name`, `user_address`, `village`, `sub-district`, `district`, `province`, `zip`, `user_contact_phone`, `user_contact_email`, `role_id`, `type_id`, `is_active`, `note`) VALUES
('50f859c9-73d1-4217-b2e4-7d9e59be7fc4', 'Iyang Agung Supriatna', '', 'Jl. Tanjungkerta, Dsn. Panteneun Rt 004/Rw 006', 'Ds Licin', 'Kec. Cimalaka', 'Kab. Sumedang', 'Prov. Jawabarat', '432345', '628986102327', 'iyang_agung_s@protonmail.com', 'c046aeb0-40f9-11ec-ae08-0d3b0460d819', '', 1, 'Administrator'),
('98a7ec62-9f1e-4bc1-b375-2ef86ad876da', 'Rifky Fahriansyach', NULL, 'Jl. Guntursari IV No. 20', 'Turangga', 'Lengkong', '-', 'Jawa Barat', '42064', '081322740415', 'chefrifkyfahriansyach@gmail.com', '190f670e-4907-11ec-8cc8-1be21be013bc', NULL, 1, ''),
('a7862489-75ad-4436-9ed9-145df4fd5fb4', 'Tuti', NULL, '-', '-', '-', '-', '-', '1234', '1234', 'tuti@shipping.com', 'df9a5008-49c5-11ec-915b-5cac4cba0f32', NULL, 1, ''),
('C0001', 'Alphine', 'Alpha sagala', 'Jl. Sunda 30,', 'Margaluyu', 'Cimaung', 'Bandung', 'Jawabarat', '346345', '8099923847', 'Alphine@admin.com', '752c0ad8-4925-11ec-8cc8-1be21be013bc', 'Agen biasa', 0, 'Customer'),
('C0002', 'Relife', 'John Doe', 'St. 123, ABC', 'Downtown', 'Subdistrict', 'Distric', 'USA', '987234', '98972093842', 'johndoe@example.com', '752c0ad8-4925-11ec-8cc8-1be21be013bc', 'Agen biasa', 0, 'Customer'),
('ec61343b-6863-43a6-a064-03a9ca551c4d', 'Nurlaila Azizah', NULL, 'Jl. Sunda 30,', 'Margaluyu', 'Cimaung', 'Bandung', 'Jawabarat', '346345', '8099923847', 'nurlailaazizah@admin.com', 'c046d399-40f9-11ec-ae08-0d3b0460d819', NULL, 1, 'Customer'),
('ed29e269-2637-4231-ba0c-341408adccc2', 'Dedi', NULL, '-', '-', '-', '-', '-', '1234', '123', 'dedi@warehouse.com', 'dc9126cc-57de-11ec-86f5-54e1ada26e81', NULL, 1, ''),
('S0001', 'Supseller', 'Jhonson', 'St. 423 D', 'A', 'B', 'C', 'D', '345098', '09283097345', 'Jhon@mail.com', '5347d8a4-4925-11ec-8cc8-1be21be013bc', 'Supplier', 1, 'Supplier');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_user_menu`
--

CREATE TABLE `tbl_user_menu` (
  `menu_id` varchar(255) NOT NULL,
  `parent_id` varchar(255) NOT NULL,
  `category_id` varchar(255) NOT NULL,
  `title` varchar(255) NOT NULL,
  `url` varchar(255) NOT NULL,
  `menu_controller` varchar(255) NOT NULL,
  `icon` varchar(255) NOT NULL,
  `is_active` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_user_menu`
--

INSERT INTO `tbl_user_menu` (`menu_id`, `parent_id`, `category_id`, `title`, `url`, `menu_controller`, `icon`, `is_active`) VALUES
('0bf8954a-e21e-4be1-ab14-62e16779440b', '9d9b9783-9ff5-479a-87c0-c1b00b52bf35', '92589956-c498-4e3f-86fd-d7f489c964a3', 'Buat pengembalian barang', 'shipping/return', 'Shipping', 'fa fa-tw fa-undo-alt', 1),
('0db37be1-41fa-464d-8a29-a3772811884b', '', '85f50b77-69ec-44e7-8a54-def0e8a1efec', 'Barang', '', '', 'fa fa-tw fa-box', 1),
('14f5eed6-0fac-4375-a7d3-bb51f28d3c86', 'a93e3526-4134-11ec-ae08-0d3b0460d819', 'dec9f1e2-4127-11ec-ae08-0d3b0460d819', 'Peran', 'configuration/role', 'Role', 'fa fa-tw fa-dice', 1),
('203419ab-490a-11ec-8cc8-1be21be013bc', '', '85f50b77-69ec-44e7-8a54-def0e8a1efec', 'Pelanggan', 'customer', 'customer', 'fas fa-tw fa-child', 1),
('2a34eff1-b6aa-4eee-b2ed-feafb892719f', 'a93e3526-4134-11ec-ae08-0d3b0460d819', 'dec9f1e2-4127-11ec-ae08-0d3b0460d819', 'Daftar pengguna', 'users', 'users', 'fa fa-tw fa-users', 1),
('2b008579-4135-11ec-ae08-0d3b0460d819', 'a93e3526-4134-11ec-ae08-0d3b0460d819', 'dec9f1e2-4127-11ec-ae08-0d3b0460d819', 'Menu', 'configuration/menu', 'Menu', 'fas fa-tw fa-th-large', 1),
('34bb5023-c344-4a17-afcf-b5a986e7911c', '', '85f50b77-69ec-44e7-8a54-def0e8a1efea', 'Penjualan', 'sale', 'selling', 'fa fa-tw fa-file-invoice text-danger', 1),
('359bd956-9336-4fdc-8cf8-1d42296605eb', 'fbf11b11-7d07-4dce-9fc6-3a21d4a177d6', '8bad6901-4798-472e-a810-38f11f207ea8', 'Buat antrian barang', 'warehouse/queue', 'Warehouse', 'far fa-tw fa-circle text-primary', 1),
('52eacc07-eed3-43e8-9e93-0310749aa3be', '0db37be1-41fa-464d-8a29-a3772811884b', '85f50b77-69ec-44e7-8a54-def0e8a1efec', 'Tambah barang', 'items', 'Items', 'far fa-tw fa-circle text-primary', 1),
('9d9b9783-9ff5-479a-87c0-c1b00b52bf35', '', '92589956-c498-4e3f-86fd-d7f489c964a3', 'Pengiriman barang', '', '', 'fa fa-tw fa-truck', 1),
('9dd386cb-4909-11ec-8cc8-1be21be013bc', '', '85f50b77-69ec-44e7-8a54-def0e8a1efec', 'Pemasok', 'supplier', 'supplier', 'fas fa-tw fa-people-carry', 1),
('a14b5cea-6c32-436c-a474-09ff17b934bd', '', 'deca10c9-4127-11ec-ae08-0d3b0460d819', 'Riwayat aktivitas', 'activity', 'activity', 'fas fa-tw fa-history', 1),
('a87acd37-4166-11ec-ae08-0d3b0460d819', '', '41baae76-4166-11ec-ae08-0d3b0460d819', 'Dashboard', 'dashboard', 'Welcome', 'fas fa-tachometer-alt', 1),
('a93e3526-4134-11ec-ae08-0d3b0460d819', '', 'dec9f1e2-4127-11ec-ae08-0d3b0460d819', 'Konfigurasi', '', '', 'fa fa-tw fa-cog', 1),
('b6f27b24-4128-11ec-ae08-0d3b0460d819', '', 'deca10c9-4127-11ec-ae08-0d3b0460d819', 'Profilku', 'user', '', 'fas fa-tw fa-user', 1),
('f0f4a736-6546-4413-903a-384c32f48052', '9d9b9783-9ff5-479a-87c0-c1b00b52bf35', '92589956-c498-4e3f-86fd-d7f489c964a3', 'Daftar antrian barang', 'shipping/queue', 'Shipping', 'fa fa-tw fa-circle text-primary', 1),
('f5902e19-08f5-4e7e-91d5-9295e167012b', '', '85f50b77-69ec-44e7-8a54-def0e8a1efea', 'Pembelian', 'purchase', 'purchasing', 'fa fa-tw fa-file-invoice text-warning', 1),
('f8b6ef10-eb05-4fb7-bb19-66866379bf49', '0db37be1-41fa-464d-8a29-a3772811884b', '85f50b77-69ec-44e7-8a54-def0e8a1efec', 'Tambah persediaan barang', 'stocks', 'stock', 'far fa-tw fa-circle text-primary', 1),
('fbf11b11-7d07-4dce-9fc6-3a21d4a177d6', '', '8bad6901-4798-472e-a810-38f11f207ea8', 'Gudang', '', '', 'fas fa-tw fa-warehouse', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_user_menu_category`
--

CREATE TABLE `tbl_user_menu_category` (
  `category_id` varchar(255) NOT NULL,
  `category_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_user_menu_category`
--

INSERT INTO `tbl_user_menu_category` (`category_id`, `category_name`) VALUES
('41baae76-4166-11ec-ae08-0d3b0460d819', ''),
('85f50b77-69ec-44e7-8a54-def0e8a1efea', 'INVOICE'),
('85f50b77-69ec-44e7-8a54-def0e8a1efec', 'MASTER DATA'),
('8bad6901-4798-472e-a810-38f11f207ea8', 'WAREHOUSE'),
('92589956-c498-4e3f-86fd-d7f489c964a3', 'SHIPPING'),
('dec9f1e2-4127-11ec-ae08-0d3b0460d819', 'CONFIGURATION'),
('deca10c9-4127-11ec-ae08-0d3b0460d819', 'INFORMATION');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_invoice`
--
ALTER TABLE `tbl_invoice`
  ADD PRIMARY KEY (`invoice_id`);

--
-- Indexes for table `tbl_item`
--
ALTER TABLE `tbl_item`
  ADD PRIMARY KEY (`item_code`);

--
-- Indexes for table `tbl_item_history`
--
ALTER TABLE `tbl_item_history`
  ADD PRIMARY KEY (`history_id`);

--
-- Indexes for table `tbl_order`
--
ALTER TABLE `tbl_order`
  ADD PRIMARY KEY (`index_order`);

--
-- Indexes for table `tbl_role`
--
ALTER TABLE `tbl_role`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_user`
--
ALTER TABLE `tbl_user`
  ADD PRIMARY KEY (`user_id`);

--
-- Indexes for table `tbl_user_access_menu`
--
ALTER TABLE `tbl_user_access_menu`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_user_information`
--
ALTER TABLE `tbl_user_information`
  ADD PRIMARY KEY (`user_id`);

--
-- Indexes for table `tbl_user_menu`
--
ALTER TABLE `tbl_user_menu`
  ADD PRIMARY KEY (`menu_id`);

--
-- Indexes for table `tbl_user_menu_category`
--
ALTER TABLE `tbl_user_menu_category`
  ADD PRIMARY KEY (`category_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_item_history`
--
ALTER TABLE `tbl_item_history`
  MODIFY `history_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
