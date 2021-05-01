-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 01, 2021 at 04:48 PM
-- Server version: 10.4.18-MariaDB
-- PHP Version: 8.0.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `cr11-petadoption-faris`
--

-- --------------------------------------------------------

--
-- Table structure for table `animals`
--

CREATE TABLE `animals` (
  `pet_id` int(11) NOT NULL,
  `pet_name` varchar(255) NOT NULL,
  `city` varchar(255) NOT NULL DEFAULT 'Vienna',
  `address` varchar(255) NOT NULL DEFAULT 'Süßenbrunner Straße 101',
  `zip` int(10) NOT NULL DEFAULT 1220,
  `age` int(3) NOT NULL DEFAULT -1,
  `description` varchar(255) DEFAULT NULL,
  `hobbies` varchar(255) DEFAULT NULL,
  `breed` varchar(255) NOT NULL DEFAULT 'N/A',
  `size` varchar(5) NOT NULL DEFAULT 'N/A',
  `pet_image` varchar(255) NOT NULL,
  `status` varchar(9) NOT NULL DEFAULT 'available'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `animals`
--

INSERT INTO `animals` (`pet_id`, `pet_name`, `city`, `address`, `zip`, `age`, `description`, `hobbies`, `breed`, `size`, `pet_image`, `status`) VALUES
(1, 'Carena', 'Santo Tomas', '9443 8th Street', 8112, 4, 'Expanded', 'Picking on smaller birds', 'Corella, long-billed', 'S', 'https://tinyurl.com/6adu8k3z', 'adopted'),
(2, 'Althea', 'Carmen', '38 8th Court', 9408, 7, 'conglomeration', 'sniffing on neighbours toes', 'Gila monster', 'S', 'https://tinyurl.com/yveresxy', 'available'),
(3, 'Sebastiano', 'Filimonovo', '405 Fremont Place', 6655, 9, 'methodology', 'Looking tough', 'Boxer', 'L', 'https://tinyurl.com/js2jbze', 'adopted'),
(4, 'Cally', 'Limen', '47 Barby Trail', 2003, 7, 'Implemented', 'hanging around the aquarium', 'Yellow-billed stork', 'S', 'https://tinyurl.com/y2narysc', 'available'),
(5, 'Ciel', 'Chauk', '5 Dakota Pass', 2009, 4, 'middleware', 'Making our cat go crazy', 'Yellow mongoose', 'L', 'https://tinyurl.com/mzvkvbf3', 'available'),
(6, 'Andres', 'Ivry-sur-Seine', '823 Sachtjen Court', 2001, 14, 'stable', 'Keeping watch on our neighbours', 'British Short Hair', 'S', 'https://tinyurl.com/ec9bcw', 'available'),
(7, 'Lawrence', 'Shamakhi', '34 La Follette Street', 1990, 15, 'Assimilated', 'Checking out the ladies in the stable', 'Arabian horse', 'S', 'https://tinyurl.com/va669e94', 'adopted'),
(8, 'Dorri', 'Itapipoca', '15633 Bobwhite Lane', 1993, 25, 'Customizable', 'Public-key', 'Trumpeter swan', 'S', 'https://tinyurl.com/45av8824', 'available'),
(9, 'Mohandas', 'Poste du Lac', '4 Ruskin Junction', 1996, 11, 'initiative', 'running after his tail', 'Parrot, hawk-headed', 'L', 'https://tinyurl.com/e8arzft3', 'available'),
(10, 'Janeen', 'Sorodot', '399 Valley Edge Alley', 1994, 2, 'Robust', 'chasing cats', 'Hawk', 'L', 'https://tinyurl.com/c84bswfv', 'available'),
(11, 'Arte', 'Levin', '79 Schlimgen Pass', 1995, 26, 'Friendly little guy', 'grill parties', 'Dragon, frilled', 'S', 'https://tinyurl.com/jvkknrba', 'available'),
(12, 'Berta', 'Puor', '7 Butterfield Street', 2009, 30, 'not amused', 'counting rings on her tail', 'Ringtail cat', 'S', 'https://tinyurl.com/nzme6dd9', 'available'),
(13, 'Pansie', 'Qaţanah', '8 Miller Point', 1984, 10, 'incremental', 'figuring out new access to the garbage can', 'Raccoon, crab-eating', 'S', 'https://tinyurl.com/2fn794m3', 'available'),
(14, 'Gabie', 'Paços', '6 Vernon Center', 2003, 5, 'open for game suggestions', 'Pushing the metal gate ', 'Buffalo, wild water', 'L', 'https://tinyurl.com/25vuyb9e', 'available'),
(15, 'Ali', 'Fauske', '22890 Sugar Terrace', 1983, 15, 'he is an adorable busy guy', 'mistaking our ears for juicy source of nektar ', 'Hummingbird', 'S', ' https://tinyurl.com/2dhtv5w2', 'available'),
(16, 'L;urette', 'Spanish Town', '41 Saint Paul Park', 2002, 28, 'minds his own business; when he is fast asleep ', 'Being foxy around the ladies', 'Silver-backed fox', 'L', 'http://dummyimage.com/156x100.png/cc0000/ffffff', 'available'),
(18, 'Ginelle', 'Hubei', '609 Manufacturers Park', 2006, 4, 'Cloned from my 95 years old uncle', 'playing with stuff that does not belong to him', 'Monkey, red howler', 'S', 'http://dummyimage.com/107x100.png/5fa2dd/ffffff', 'available'),
(19, 'Lido', 'Vienna', 'Alserstrasse 18', 1220, 10, 'A well trained dog, loving spirit, very protective of owner.', 'Chewing on rubber chickens and slobering over cats', 'German shepard dog', 'L', 'https://tinyurl.com/n98n7e6x', 'adopted');

-- --------------------------------------------------------

--
-- Table structure for table `petadoption`
--

CREATE TABLE `petadoption` (
  `id` int(11) NOT NULL,
  `fk_user_id` int(11) NOT NULL,
  `fk_pet_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `petadoption`
--

INSERT INTO `petadoption` (`id`, `fk_user_id`, `fk_pet_id`) VALUES
(1, 4, 1),
(2, 4, 3),
(3, 4, 19),
(6, 3, 7),
(7, 3, 4);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `date_of_birth` date NOT NULL,
  `email` varchar(255) NOT NULL,
  `picture` varchar(255) DEFAULT NULL,
  `status` varchar(4) NOT NULL DEFAULT 'user'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `first_name`, `last_name`, `password`, `date_of_birth`, `email`, `picture`, `status`) VALUES
(1, 'Faris', 'Alsalih', '8d969eef6ecad3c29a3a629280e686cf0c3f5d5a86aff3ca12020c923adc6c92', '2021-04-01', 'falsalih@aol.com', 'avatar.png', 'adm'),
(2, 'Patrizia', 'Messerschmidt', '8d969eef6ecad3c29a3a629280e686cf0c3f5d5a86aff3ca12020c923adc6c92', '2001-09-10', 'alex@mail.com', '608be9b2967cc.jpg', 'user'),
(3, 'Jimmy', 'Dore', '8d969eef6ecad3c29a3a629280e686cf0c3f5d5a86aff3ca12020c923adc6c92', '2020-07-30', 'jimmy@mail.com', '608a9a5d4768e.jpg', 'user'),
(4, 'Viktor', 'Frankl', '8d969eef6ecad3c29a3a629280e686cf0c3f5d5a86aff3ca12020c923adc6c92', '1905-03-26', 'viktor@mail.com', '608be1f515e77.jpg', 'user'),
(5, 'Nikola', 'Tesla', '8d969eef6ecad3c29a3a629280e686cf0c3f5d5a86aff3ca12020c923adc6c92', '2020-06-05', 'tesla@mail.com', '608bf1b3a5836.jpg', 'user'),
(6, 'tester', 'vontesting', '8d969eef6ecad3c29a3a629280e686cf0c3f5d5a86aff3ca12020c923adc6c92', '2021-03-04', 'tester@mail.com', 'avatar.png', 'user');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `animals`
--
ALTER TABLE `animals`
  ADD PRIMARY KEY (`pet_id`),
  ADD KEY `petName_index` (`pet_name`),
  ADD KEY `city_index` (`city`),
  ADD KEY `breed` (`breed`),
  ADD KEY `image_index` (`pet_image`);

--
-- Indexes for table `petadoption`
--
ALTER TABLE `petadoption`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_user_id` (`fk_user_id`),
  ADD KEY `fk_car_id` (`fk_pet_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id` (`id`),
  ADD KEY `first_name` (`first_name`),
  ADD KEY `last_name` (`last_name`),
  ADD KEY `password` (`password`),
  ADD KEY `date_of_birth` (`date_of_birth`),
  ADD KEY `email` (`email`),
  ADD KEY `picture` (`picture`),
  ADD KEY `status` (`status`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `animals`
--
ALTER TABLE `animals`
  MODIFY `pet_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `petadoption`
--
ALTER TABLE `petadoption`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `petadoption`
--
ALTER TABLE `petadoption`
  ADD CONSTRAINT `petadoption_ibfk_1` FOREIGN KEY (`fk_user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `petadoption_ibfk_2` FOREIGN KEY (`fk_pet_id`) REFERENCES `animals` (`pet_id`) ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
