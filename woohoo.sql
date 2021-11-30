-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 30, 2021 at 10:56 PM
-- Server version: 10.4.21-MariaDB
-- PHP Version: 8.0.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `woohoo`
--
CREATE DATABASE IF NOT EXISTS `woohoo` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `woohoo`;

-- --------------------------------------------------------

--
-- Table structure for table `pictures`
--

CREATE TABLE `pictures` (
  `pictureID` int(11) NOT NULL,
  `image` varchar(255) NOT NULL,
  `placeID` int(11) NOT NULL,
  `userID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `pictures`
--

INSERT INTO `pictures` (`pictureID`, `image`, `placeID`, `userID`) VALUES
(1, 'london.jpg', 2, 1),
(2, 'athens.jpeg', 3, 1),
(3, 'hoover-dam.jpg', 4, 1),
(4, 'liberty.jpg', 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `places`
--

CREATE TABLE `places` (
  `placeID` int(11) NOT NULL,
  `placeName` varchar(255) NOT NULL,
  `city` varchar(255) NOT NULL,
  `country` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `reviewScore` decimal(10,1) DEFAULT NULL,
  `userID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `places`
--

INSERT INTO `places` (`placeID`, `placeName`, `city`, `country`, `description`, `reviewScore`, `userID`) VALUES
(1, 'Statue of Liberty', 'New York', 'USA', 'A towering monument to the American ideal of liberty and justice', '4.4', 1),
(2, 'London Eye', 'London', 'United Kingdom', 'A large Ferris Wheel on the Thames', '3.6', 3),
(3, 'University of Georgia', 'Athens', 'USA', NULL, '0.0', 4),
(4, 'Hoover Dam', 'Las Vegas', 'USA', 'Holds back water, bro', NULL, 4),
(5, 'Sky Tree', 'Tokyo', 'Japan', NULL, NULL, 2),
(6, 'Mojang Office', 'Stockholm', 'Sweden', 'Block game', '5.0', 1),
(7, 'Emu War Burial', 'Outback', 'Australia', 'In the Outback, noone can hear you scream.', '2.5', 4),
(8, 'Edgar Allen Poe\'s house', 'Philadelphia', 'USA', 'Home of the famous writer', '0.0', 0),
(9, 'Statue of Diogenes', 'Sinop', 'Turkey', 'A monument to the ancient Greek philosopher', '0.0', 0),
(10, 'Gettysburg Battlefield', 'Gettysburg ', 'USA', NULL, '7.8', 3),
(11, 'Georgia State Capitol', 'Atlanta', 'USA', 'Where the Ga state legislature meets to make laws and govern.', '6.8', 4),
(12, 'Walt Disney Concert Hall', 'Los Angeles', 'USA', 'Music is played here, and in large quantities.', '7.8', 2),
(13, 'Venice Canals Walkway', 'Las Angeles', 'USA', 'A scenic residential area reminiscent of that area in GTA 5', '6.3', 3),
(14, 'Union Station', 'Las Angeles', 'USA', 'A nice big station', '7.6', 0),
(15, 'Dodger Stadium', 'Las Angeles', 'USA', 'A large sports complex', NULL, 0),
(16, 'Staples Center', 'Las Angeles', 'USA', NULL, NULL, 0),
(17, 'The Wizarding World of Harry Potter', 'Las Angeles', 'USA', 'Where magic turns into revenue', NULL, 0),
(18, 'Hollywood Sign', 'Las Angeles', 'USA', 'An inferior copy of the Bollywood version', '4.8', 3),
(19, 'Universal CityWalk Hollywood', 'Las Angeles', 'USA', 'An amusement facility', '6.7', 4),
(20, 'Angels Flight Railway', 'Las Angeles', 'USA', 'A transportation apparatus', '7.8', 2),
(21, 'Red Fort ', 'Delhi', 'India', 'A famous Mughal era fortification built by the emperor Shah Jahan', NULL, 0),
(22, 'Jama Masjid ', 'Delhi', 'India', 'A famous mosque built in 1656', NULL, 0),
(23, 'Imperial Palace', 'Tokyo', 'Japan', NULL, NULL, 0),
(24, 'Ginza District', 'Tokyo', 'Japan', 'A centuries-old shopping district', NULL, 0),
(25, 'People\'s Square', 'Shanghai', 'China', 'A large public square', NULL, 0),
(26, 'Nanjing Road', 'Shanghai', 'China', 'A 5km long shopping street attracting millions of people every year', NULL, 0),
(27, 'Museu de Arte(Art Museum)', 'São Paulo', 'Brazil', 'The largest collection of western art in Latin America', NULL, 0),
(28, 'Museo do Futebol(Football Museum)', 'São Paulo', 'Brazil', NULL, NULL, 0),
(29, 'Basilica de Guadalupe', 'Mexico City', 'Mexico', NULL, NULL, 0),
(30, 'Chapultepec Castle', 'Mexico City', 'Mexico ', NULL, NULL, 0),
(31, 'Pyramids of Giza', 'Cairo', 'Egypt', NULL, NULL, 0),
(32, 'Sphinx', 'Cairo', 'Egypt', NULL, NULL, 0);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `userID` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `dateRegistered` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`userID`, `username`, `email`, `password`, `dateRegistered`) VALUES
(1, 'Admin', 'admin@gmail.com', 'password', '2021-11-02'),
(2, 'bobby86', 'hotmale@hotmail.com', '13454321', '2021-11-03'),
(3, 'ME', 'wowowowowo@gmail.com', '54321drowssap', '2021-11-03'),
(4, 'meowjohnSMITH', 'nyan@yahoo.com', '-350u2-u5-259', '2021-11-03');

-- --------------------------------------------------------

--
-- Table structure for table `wishlist`
--

CREATE TABLE `wishlist` (
  `wishlistID` int(11) NOT NULL,
  `userID` int(11) NOT NULL,
  `placeID` int(11) NOT NULL,
  `notes` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `wishlist`
--

INSERT INTO `wishlist` (`wishlistID`, `userID`, `placeID`, `notes`) VALUES
(1, 4, 3, 'Based institution'),
(2, 4, 4, 'hella wet'),
(3, 4, 7, NULL),
(4, 2, 1, NULL),
(5, 2, 4, NULL),
(6, 3, 5, 'Nani?');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `pictures`
--
ALTER TABLE `pictures`
  ADD PRIMARY KEY (`pictureID`);

--
-- Indexes for table `places`
--
ALTER TABLE `places`
  ADD PRIMARY KEY (`placeID`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`userID`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `wishlist`
--
ALTER TABLE `wishlist`
  ADD PRIMARY KEY (`wishlistID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `pictures`
--
ALTER TABLE `pictures`
  MODIFY `pictureID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `places`
--
ALTER TABLE `places`
  MODIFY `placeID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `userID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `wishlist`
--
ALTER TABLE `wishlist`
  MODIFY `wishlistID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
