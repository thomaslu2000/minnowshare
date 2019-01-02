-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 02, 2019 at 08:58 AM
-- Server version: 10.1.36-MariaDB
-- PHP Version: 7.0.32

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `minnowshare`
--

-- --------------------------------------------------------

--
-- Table structure for table `access_files`
--

CREATE TABLE `access_files` (
  `user` int(11) NOT NULL,
  `item_id` int(8) NOT NULL,
  `owner_id` int(11) NOT NULL,
  `title` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `access_files`
--

INSERT INTO `access_files` (`user`, `item_id`, `owner_id`, `title`) VALUES
(1, 13, 5, 'Kitty 4'),
(1, 16, 3, 'Bread'),
(3, 4, 1, 'Hello'),
(3, 13, 5, 'Kitty 4'),
(3, 14, 1, 'Flowy Water'),
(3, 17, 8, 'Test'),
(3, 18, 8, 'Test'),
(5, 16, 3, 'Bread');

-- --------------------------------------------------------

--
-- Table structure for table `friends`
--

CREATE TABLE `friends` (
  `id_1` int(11) NOT NULL,
  `id_2` int(11) NOT NULL,
  `status` enum('sent','received','friended') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `friends`
--

INSERT INTO `friends` (`id_1`, `id_2`, `status`) VALUES
(1, 3, 'friended'),
(1, 5, 'friended'),
(3, 1, 'friended'),
(3, 4, 'sent'),
(3, 5, 'friended'),
(3, 8, 'friended'),
(4, 3, 'received'),
(4, 5, 'friended'),
(5, 1, 'friended'),
(5, 3, 'friended'),
(5, 4, 'friended'),
(8, 3, 'friended');

-- --------------------------------------------------------

--
-- Table structure for table `friends_uploads`
--

CREATE TABLE `friends_uploads` (
  `item_id` int(8) NOT NULL,
  `owner_id` int(11) NOT NULL,
  `title` varchar(40) NOT NULL,
  `short` varchar(255) DEFAULT NULL,
  `description` text,
  `file_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `friends_uploads`
--

INSERT INTO `friends_uploads` (`item_id`, `owner_id`, `title`, `short`, `description`, `file_name`) VALUES
(2, 3, 'Goat', 'NULL', 'NULL', 'img.jpg'),
(3, 5, 'Self Portrait', 'NULL', 'Bleh', 'MV5BYmIwYzRiZDEtMGQwYS00NGIwLTkxNGEtYWIyM2U2YWM3MDc4XkEyXkFqcGdeQXVyNzU1NzE3NTg@._V1_CR0,45,480,270_AL_UX477_CR0,0,477,268_AL_.jpg'),
(4, 1, 'Hello', 'NULL', 'NULL', 'hello_1024x1024.png'),
(5, 3, 'Friend Up1', 'NULL', 'NULL', '240px-CH_cow_2_cropped.jpg'),
(6, 3, 'Friend Up2', 'NULL', 'NULL', 'cow.jpg'),
(7, 3, 'Friend Up3', 'NULL', 'NULL', '240px-CH_cow_2_cropped-1.jpg'),
(13, 5, 'Kitty 4', 'NULL', 'NULL', 'small-kitten-walking-towards_127900829_0-5.jpg'),
(14, 1, 'Flowy Water', 'NULL', 'NULL', 'water-thumb.png'),
(16, 3, 'Bread', 'NULL', 'NULL', 'bread.jpg'),
(17, 8, 'Test', 'NULL', 'NULL', 'asdf.txt'),
(18, 8, 'Test', 'NULL', 'NULL', 'asdf-1.txt');

-- --------------------------------------------------------

--
-- Table structure for table `private_uploads`
--

CREATE TABLE `private_uploads` (
  `item_id` int(8) NOT NULL,
  `owner_id` int(11) NOT NULL,
  `title` varchar(40) NOT NULL,
  `short` varchar(255) DEFAULT NULL,
  `description` text,
  `file_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `private_uploads`
--

INSERT INTO `private_uploads` (`item_id`, `owner_id`, `title`, `short`, `description`, `file_name`) VALUES
(1, 3, 'Cow 240', 'image', 'a pic of a cow, 240px', '240px-CH_cow_2_cropped.jpg'),
(2, 3, 'Cow', 'image', 'A picture of a cow', 'cow.jpg'),
(3, 3, 'Wat', 'image', 'A picture of water', 'water.jpg'),
(6, 3, 'Text with photo', 'NULL', 'NULL', 'asdf-1.txt'),
(7, 3, 'Rar file', 'archive', 'NULL', 'asf.rar'),
(8, 3, 'exe with photo', 'NULL', 'This is an exe file with a photo', 'asdfas.exe'),
(9, 3, 'Face', 'This is a face. This is a face. This is a face. This is a face. This is a face. This is a face. This is a face. This is a face. This is a face. This is a face. This is a face. This is a face. This is a face. This is a face. This is a face. This is a face.', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum. Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum. Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum. Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.', 'low_res_image.jpg'),
(10, 3, 'Face Copy', 'NULL', 'NULL', 'low_res_image-1.jpg'),
(11, 3, 'Face Copy 2', 'NULL', 'NULL', 'low_res_image-2.jpg'),
(16, 1, 'Hello', 'NULL', 'NULL', 'hello_1024x1024.png');

-- --------------------------------------------------------

--
-- Table structure for table `public_uploads`
--

CREATE TABLE `public_uploads` (
  `item_id` int(8) NOT NULL,
  `owner_id` int(11) NOT NULL,
  `title` varchar(40) NOT NULL,
  `short` varchar(255) DEFAULT NULL,
  `description` text,
  `file_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `public_uploads`
--

INSERT INTO `public_uploads` (`item_id`, `owner_id`, `title`, `short`, `description`, `file_name`) VALUES
(1, 3, 'A Goat or Something', 'NULL', 'NULL', 'img.jpg'),
(2, 3, 'File', 'NULL', 'NULL', 'asdfas.exe'),
(3, 3, 'Cow 2', 'NULL', 'NULL', 'cow.jpg'),
(4, 3, 'Text', 'NULL', 'NULL', 'asdf.txt'),
(5, 8, 'Cow Again', 'Here is a cow', 'NULL', 'cow.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `userid` int(11) NOT NULL,
  `username` varchar(20) NOT NULL,
  `pass` varchar(64) NOT NULL,
  `email` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`userid`, `username`, `pass`, `email`) VALUES
(1, 'hello', '2cf24dba5fb0a30e26e83b2ac5b9e29e1b161e5c1fa7425e73043362938b9824', 't.lu@email.com'),
(2, 'books', '6e317bcd6839e8877395411b47b2b89d2bae7ccb05f78cee32bcdf76b5294265', 't.lu@email.com'),
(3, 'water', '0f4168490e38b8447e11ba4bd656aa11b925bd22af30bac464bc153fdb608501', 't.lu@email.com'),
(4, 'soups', '7eecdc908cafa6e73428a227231b2b564089f096d361eb22b64e8552e54dcdc5', 't.lu@email.com'),
(5, 'fatso', 'bf7e9c38e4305e6d6a81845911cba71be3c17f3a856dec014b9780df4ef7f3f0', 't.lu@email.com'),
(6, 'sicko', '2537aa41b02f45838e0b8d2dea2807746a8c810a444a9fe1a43825e5d25cd7c9', 't.lu@email.com'),
(7, 'phone', '45569da57f4b7bf472d7a864ef4781451cae6383fee9fb0ae40c59aa1ce475b7', 't.lu@email.com'),
(8, 'email', '82244417f956ac7c599f191593f7e441a4fafa20a4158fd52e154f1dc4c8ed92', 't.lu@email.com'),
(9, 'hooks', 'a9fa9fda98d7712cf2c04ce6206e406c554572bedfeac6e441f13410980f7f82', 't.lu@email.com'),
(10, 'match', '4945a70fa7f9c13fe1931a3372ac5798140d42eba74d0dd805a4a216ed3a8142', 't.lu@email.com'),
(11, 'nines', '41a477c33e110c548d3c51cbf5154ae45abdd129b37648c4503971818269f2ab', 't.lu@email.com'),
(12, 'seven', '3ba8d02b16fd2a01c1a8ba1a1f036d7ce386ed953696fa57331c2ac48a80b255', 't.lu@email.com');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `access_files`
--
ALTER TABLE `access_files`
  ADD PRIMARY KEY (`user`,`item_id`),
  ADD KEY `idx_user` (`user`),
  ADD KEY `access_files_ibfk_1` (`item_id`);

--
-- Indexes for table `friends`
--
ALTER TABLE `friends`
  ADD PRIMARY KEY (`id_1`,`id_2`);

--
-- Indexes for table `friends_uploads`
--
ALTER TABLE `friends_uploads`
  ADD PRIMARY KEY (`item_id`),
  ADD KEY `idx_owner` (`owner_id`);

--
-- Indexes for table `private_uploads`
--
ALTER TABLE `private_uploads`
  ADD PRIMARY KEY (`item_id`),
  ADD KEY `idx_owner` (`owner_id`);

--
-- Indexes for table `public_uploads`
--
ALTER TABLE `public_uploads`
  ADD PRIMARY KEY (`item_id`),
  ADD KEY `idx_owner` (`owner_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`userid`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `friends_uploads`
--
ALTER TABLE `friends_uploads`
  MODIFY `item_id` int(8) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `private_uploads`
--
ALTER TABLE `private_uploads`
  MODIFY `item_id` int(8) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `public_uploads`
--
ALTER TABLE `public_uploads`
  MODIFY `item_id` int(8) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `userid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `access_files`
--
ALTER TABLE `access_files`
  ADD CONSTRAINT `access_files_ibfk_1` FOREIGN KEY (`item_id`) REFERENCES `friends_uploads` (`item_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `access_files_ibfk_2` FOREIGN KEY (`user`) REFERENCES `users` (`userid`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `private_uploads`
--
ALTER TABLE `private_uploads`
  ADD CONSTRAINT `private_uploads_ibfk_1` FOREIGN KEY (`owner_id`) REFERENCES `users` (`userid`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
