-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 09, 2021 at 10:27 AM
-- Server version: 10.4.17-MariaDB
-- PHP Version: 8.0.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `canvas`
--
CREATE DATABASE IF NOT EXISTS `canvas` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `canvas`;

-- --------------------------------------------------------

--
-- Table structure for table `tb_access`
--

CREATE TABLE `tb_access` (
  `access_id` int(11) NOT NULL,
  `role_id` int(11) DEFAULT NULL,
  `menu_id` int(11) DEFAULT NULL,
  `id_input` varchar(128) DEFAULT NULL,
  `dt_input` datetime DEFAULT NULL,
  `id_update` varchar(128) DEFAULT NULL,
  `dt_update` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_access`
--

INSERT INTO `tb_access` (`access_id`, `role_id`, `menu_id`, `id_input`, `dt_input`, `id_update`, `dt_update`) VALUES
(1, 1, 1, 'system', '2021-04-08 11:51:19', 'system', '2021-04-08 11:51:19'),
(3, 2, 2, 'ranggadpermadi@gmail.com', '2021-04-08 16:32:44', 'ranggadpermadi@gmail.com', '2021-04-08 16:32:44'),
(4, 1, 2, 'ranggadpermadi@gmail.com', '2021-04-09 13:55:13', 'ranggadpermadi@gmail.com', '2021-04-09 13:55:13');

-- --------------------------------------------------------

--
-- Table structure for table `tb_menu`
--

CREATE TABLE `tb_menu` (
  `menu_id` int(11) NOT NULL,
  `menu_nama` varchar(25) DEFAULT NULL,
  `menu_url` varchar(225) DEFAULT NULL,
  `menu_icon` varchar(128) DEFAULT NULL,
  `menu_status` int(1) DEFAULT NULL,
  `id_input` varchar(128) DEFAULT NULL,
  `dt_input` datetime DEFAULT NULL,
  `id_update` varchar(128) DEFAULT NULL,
  `dt_update` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_menu`
--

INSERT INTO `tb_menu` (`menu_id`, `menu_nama`, `menu_url`, `menu_icon`, `menu_status`, `id_input`, `dt_input`, `id_update`, `dt_update`) VALUES
(1, 'admin', 'admin', 'fas fa-fw fa-tachometer-alt', 1, 'system', '2021-04-08 11:50:17', 'system', '2021-04-08 11:50:17'),
(2, 'user', 'user', NULL, 1, 'ranggadpermadi@gmail.com', '2021-04-08 14:24:35', 'ranggadpermadi@gmail.com', '2021-04-08 14:24:35'),
(3, 'Denial', 'Star', NULL, 0, 'ranggadpermadi@gmail.com', '2021-04-08 14:40:43', 'ranggadpermadi@gmail.com', '2021-04-08 15:25:14');

-- --------------------------------------------------------

--
-- Table structure for table `tb_role`
--

CREATE TABLE `tb_role` (
  `role_id` int(11) NOT NULL,
  `role_nama` varchar(25) DEFAULT NULL,
  `id_input` varchar(128) DEFAULT NULL,
  `dt_input` datetime DEFAULT NULL,
  `id_update` varchar(128) DEFAULT NULL,
  `dt_update` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_role`
--

INSERT INTO `tb_role` (`role_id`, `role_nama`, `id_input`, `dt_input`, `id_update`, `dt_update`) VALUES
(1, 'Admin', 'system', '2021-04-08 11:44:04', 'system', '2021-04-08 11:44:04'),
(2, 'User', 'system', '2021-04-08 11:44:45', 'system', '2021-04-08 11:44:45');

-- --------------------------------------------------------

--
-- Table structure for table `tb_submenu`
--

CREATE TABLE `tb_submenu` (
  `submenu_id` int(11) NOT NULL,
  `menu_id` int(11) DEFAULT NULL,
  `submenu_nama` varchar(35) DEFAULT NULL,
  `submenu_url` varchar(225) DEFAULT NULL,
  `submenu_icon` varchar(128) DEFAULT NULL,
  `submenu_status` tinyint(1) DEFAULT NULL,
  `id_input` varchar(128) DEFAULT NULL,
  `dt_input` datetime DEFAULT NULL,
  `id_update` varchar(128) DEFAULT NULL,
  `dt_update` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_submenu`
--

INSERT INTO `tb_submenu` (`submenu_id`, `menu_id`, `submenu_nama`, `submenu_url`, `submenu_icon`, `submenu_status`, `id_input`, `dt_input`, `id_update`, `dt_update`) VALUES
(1, 1, 'Dashboard', 'admin', 'fas fa-fw fa-tachometer-alt', 1, 'system', '2021-04-08 12:26:15', 'system', '2021-04-08 12:26:15'),
(2, 1, 'Menu Management', 'admin/menu', 'fas fa-fw fa-folder-open', 1, 'system', '2021-04-08 12:29:32', 'ranggadpermadi@gmail.com', '2021-04-08 15:30:49'),
(3, 1, 'Role', 'admin/role', 'fas fa-fw fa-user-cog', 1, 'ranggadpermadi@gmail.com', '2021-04-08 15:26:13', 'ranggadpermadi@gmail.com', '2021-04-08 15:26:13'),
(4, 2, 'Profile', 'user', 'fas fa-fw fa-user', 1, 'ranggadpermadi@gmail.com', '2021-04-08 16:31:22', 'ranggadpermadi@gmail.com', '2021-04-08 16:31:22');

-- --------------------------------------------------------

--
-- Table structure for table `tb_token`
--

CREATE TABLE `tb_token` (
  `token_id` int(11) NOT NULL,
  `user_email` varchar(128) DEFAULT NULL,
  `token` varchar(255) DEFAULT NULL,
  `token_status` int(11) DEFAULT NULL,
  `token_created` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `tb_users`
--

CREATE TABLE `tb_users` (
  `user_id` int(11) NOT NULL,
  `role_id` int(11) DEFAULT NULL,
  `user_nama` varchar(45) DEFAULT NULL,
  `user_email` varchar(128) DEFAULT NULL,
  `user_picture` varchar(128) DEFAULT NULL,
  `user_password` varchar(255) DEFAULT NULL,
  `user_bio` varchar(255) DEFAULT NULL,
  `user_status` int(11) DEFAULT NULL,
  `user_created` datetime DEFAULT NULL,
  `user_modified` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_users`
--

INSERT INTO `tb_users` (`user_id`, `role_id`, `user_nama`, `user_email`, `user_picture`, `user_password`, `user_bio`, `user_status`, `user_created`, `user_modified`) VALUES
(1, 1, 'Rangga', 'ranggadpermadi@gmail.com', '117163b2bd02fbc4dcb45c3f52eb8bd9.jpg', '$2y$10$fAQpW/50oguzsL7pTaPFUetQirbUM/1AxUtqFItuF5mEHTaeRrYIu', 'Hello, i am recently using this app!', 1, '2021-04-07 16:30:15', '2021-04-09 15:17:17');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tb_access`
--
ALTER TABLE `tb_access`
  ADD PRIMARY KEY (`access_id`);

--
-- Indexes for table `tb_menu`
--
ALTER TABLE `tb_menu`
  ADD PRIMARY KEY (`menu_id`);

--
-- Indexes for table `tb_role`
--
ALTER TABLE `tb_role`
  ADD PRIMARY KEY (`role_id`);

--
-- Indexes for table `tb_submenu`
--
ALTER TABLE `tb_submenu`
  ADD PRIMARY KEY (`submenu_id`);

--
-- Indexes for table `tb_token`
--
ALTER TABLE `tb_token`
  ADD PRIMARY KEY (`token_id`);

--
-- Indexes for table `tb_users`
--
ALTER TABLE `tb_users`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tb_access`
--
ALTER TABLE `tb_access`
  MODIFY `access_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tb_menu`
--
ALTER TABLE `tb_menu`
  MODIFY `menu_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tb_role`
--
ALTER TABLE `tb_role`
  MODIFY `role_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tb_submenu`
--
ALTER TABLE `tb_submenu`
  MODIFY `submenu_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tb_token`
--
ALTER TABLE `tb_token`
  MODIFY `token_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tb_users`
--
ALTER TABLE `tb_users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
