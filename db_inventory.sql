-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Nov 10, 2021 at 04:09 AM
-- Server version: 10.4.18-MariaDB
-- PHP Version: 7.3.27

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
-- Table structure for table `tbl_item`
--

CREATE TABLE `tbl_item` (
  `item_code` varchar(255) NOT NULL,
  `item_name` varchar(255) NOT NULL,
  `item_category` varchar(255) NOT NULL,
  `quantity` int(255) NOT NULL,
  `unit` varchar(25) NOT NULL,
  `capital_price` varchar(255) NOT NULL,
  `selling_price` varchar(255) NOT NULL,
  `image_id` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_item`
--

INSERT INTO `tbl_item` (`item_code`, `item_name`, `item_category`, `quantity`, `unit`, `capital_price`, `selling_price`, `image_id`) VALUES
('ACC-1', 'Battery lithium', 'Accessories', 250, 'pcs', '20000', '30000', 'assets/image/LQD-001.jpg'),
('LQD-ML-12', 'MARJAN ACB', 'Liquid', 12, 'pac', '85000', '105000', 'assets/image/LQD-001.jpg'),
('LQD-ML001', 'Acai Pomegranate Nic Salt E-Liquid by Bloom', 'Liquid', 1000, 'pcs', '80000', '100000', 'assets/image/LQD-001.jpg'),
('LQD-NIKOTIN-1', 'MARJAN', 'Liquid', 12, 'pac', '80000', '100000', 'assets/image/LQD-001.jpg');

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
('c046aeb0-40f9-11ec-ae08-0d3b0460d819', 'Administrator'),
('c046d399-40f9-11ec-ae08-0d3b0460d819', 'Member');

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
('50f859c9-73d1-4217-b2e4-7d9e59be7fc4', 'Iyang Agung Supriatna', 'iyang_agung_s@protonmail.com', 'assets/images/default.jpg', '$2y$10$C6IJzcNTEsdxZHelB62J9u/nMOL0Z1kQyK5PWGoI.Wnm/0R4ouX8a', 'c046aeb0-40f9-11ec-ae08-0d3b0460d819', 1, 1636431432),
('ec61343b-6863-43a6-a064-03a9ca551c4d', 'Nurlaila Azizah', 'nurlailahazizah@gmail.com', 'assets/images/default.jpg', '$2y$10$uftpjkRFSEniBKlXUegI7uIG6HqsfAmF6RaPv42AHekTjlHd5HViW', 'c046d399-40f9-11ec-ae08-0d3b0460d819', 1, 1636465803);

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
('35a0197f-4129-11ec-ae08-0d3b0460d819', 'c046aeb0-40f9-11ec-ae08-0d3b0460d819', 'dec9f1e2-4127-11ec-ae08-0d3b0460d819'),
('35a0301d-4129-11ec-ae08-0d3b0460d819', 'c046aeb0-40f9-11ec-ae08-0d3b0460d819', 'deca10c9-4127-11ec-ae08-0d3b0460d819'),
('458f224e-4129-11ec-ae08-0d3b0460d819', 'c046d399-40f9-11ec-ae08-0d3b0460d819', 'deca10c9-4127-11ec-ae08-0d3b0460d819'),
('6e33a609-4166-11ec-ae08-0d3b0460d819', 'c046d399-40f9-11ec-ae08-0d3b0460d819', '41baae76-4166-11ec-ae08-0d3b0460d819'),
('6e33bb7b-4166-11ec-ae08-0d3b0460d819', 'c046aeb0-40f9-11ec-ae08-0d3b0460d819', '41baae76-4166-11ec-ae08-0d3b0460d819'),
('70ce988e-415c-11ec-ae08-0d3b0460d819', 'c046aeb0-40f9-11ec-ae08-0d3b0460d819', '85f50b77-69ec-44e7-8a54-def0e8a1efec'),
('70ceb125-415c-11ec-ae08-0d3b0460d819', 'c046d399-40f9-11ec-ae08-0d3b0460d819', '85f50b77-69ec-44e7-8a54-def0e8a1efec');

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
('14f5eed6-0fac-4375-a7d3-bb51f28d3c86', 'a93e3526-4134-11ec-ae08-0d3b0460d819', 'dec9f1e2-4127-11ec-ae08-0d3b0460d819', 'Role', 'configuration/role', 'Role', 'fa fa-tw fa-dice', 1),
('2b008579-4135-11ec-ae08-0d3b0460d819', 'a93e3526-4134-11ec-ae08-0d3b0460d819', 'dec9f1e2-4127-11ec-ae08-0d3b0460d819', 'Menu', 'configuration/menu', 'Menu', 'fas fa-tw fa-th-large', 1),
('52eacc07-eed3-43e8-9e93-0310749aa3be', '', '85f50b77-69ec-44e7-8a54-def0e8a1efec', 'List item', 'items', 'Items', 'fa fa-tw fa-boxes', 1),
('a87acd37-4166-11ec-ae08-0d3b0460d819', '', '41baae76-4166-11ec-ae08-0d3b0460d819', 'Dashboard', 'dashboard', 'Welcome', 'fas fa-tachometer-alt', 1),
('a93e3526-4134-11ec-ae08-0d3b0460d819', '', 'dec9f1e2-4127-11ec-ae08-0d3b0460d819', 'Configuration', '', '', 'fa fa-tw fa-cog', 1),
('b6f27b24-4128-11ec-ae08-0d3b0460d819', '', 'deca10c9-4127-11ec-ae08-0d3b0460d819', 'My profile', 'user', '', 'fas fa-tw fa-user', 1);

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
('85f50b77-69ec-44e7-8a54-def0e8a1efec', 'INVENTORY'),
('dec9f1e2-4127-11ec-ae08-0d3b0460d819', 'CONFIGURATION'),
('deca10c9-4127-11ec-ae08-0d3b0460d819', 'INFORMATION');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_item`
--
ALTER TABLE `tbl_item`
  ADD PRIMARY KEY (`item_code`);

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
-- Indexes for table `tbl_user_menu`
--
ALTER TABLE `tbl_user_menu`
  ADD PRIMARY KEY (`menu_id`);

--
-- Indexes for table `tbl_user_menu_category`
--
ALTER TABLE `tbl_user_menu_category`
  ADD PRIMARY KEY (`category_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;