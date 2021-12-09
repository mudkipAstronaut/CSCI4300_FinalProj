-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 09, 2021 at 10:16 PM
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
(1, 'london-eye.jpg', 2, 1),
(2, 'athens.jpeg', 3, 1),
(3, 'hoover-dam.jpg', 4, 1),
(4, 'liberty.jpg', 1, 1),
(5, 'Tokyo_SkyTree.jpg', 5, 3),
(6, 'Hollywood_Sign.jpg', 18, 3),
(7, 'Mojang.jpg', 6, 2),
(8, 'PoeHouse-Baltimore.jpg', 8, 2),
(9, 'Gettysburg.jpg', 10, 2),
(10, 'Disney_Concert.jpg', 12, 3),
(11, 'Dodger-Stadium.jpg', 15, 3),
(12, 'jama-maszid.jpg', 22, 3),
(13, 'Tokyo-Imperial-Palace.jpg', 23, 1),
(14, 'Imperial-Bridge.jpg', 23, 2),
(15, 'Imperial.jpg', 23, 3),
(16, 'Nanjing_Road.jpg', 26, 4),
(17, 'Nanjing-road-pedestrian.jpg', 26, 1),
(18, 'MASP_Brazil.jpg', 27, 3),
(19, 'Chapultepec.jpg', 30, 3),
(20, 'Pyramid-Giza.jpg', 31, 1),
(21, 'great-pyramid.jpg', 31, 1),
(22, 'Great-Sphinx.jpg', 32, 2),
(23, 'london.jpg', 33, 1),
(24, 'india_gateway.jpg', 34, 1),
(25, 'chicago_picasso.jpg', 36, 1),
(26, 'St_Louis_arch.jpg', 35, 1),
(27, 'diogenes_statue.jpg', 9, 1),
(28, 'ga_capital.jpg', 11, 1),
(29, 'venice_canal_la.jpg', 13, 1),
(30, 'venice_canal_la1.jpg', 13, 1),
(31, 'national-monument.jpg', 37, 1),
(32, 'emu_war_burial.jpeg', 7, 1),
(33, 'staples_center.jpg', 16, 1),
(35, 'diogenes_statue1.jpg', 9, 1);

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
(8, 'Edgar Allan Poe\'s house', 'Philadelphia', 'USA', 'Home of the famous writer', '0.0', 1),
(9, 'Statue of Diogenes', 'Sinop', 'Turkey', 'A monument to the ancient Greek philosopher', '4.2', 1),
(10, 'Gettysburg Battlefield', 'Gettysburg ', 'USA', NULL, '3.9', 3),
(11, 'Georgia State Capitol', 'Atlanta', 'USA', 'Where the Ga state legislature meets to make laws and govern.', '3.4', 4),
(12, 'Walt Disney Concert Hall', 'Los Angeles', 'USA', 'Music is played here, and in large quantities.', '3.8', 2),
(13, 'Venice Canals Walkway', 'Las Angeles', 'USA', 'A scenic residential area reminiscent of that area in GTA 5', '3.2', 3),
(14, 'Union Station', 'Las Angeles', 'USA', 'A nice big station', '3.8', 1),
(15, 'Dodger Stadium', 'Las Angeles', 'USA', 'A large sports complex', NULL, 1),
(16, 'Staples Center', 'Las Angeles', 'USA', NULL, NULL, 1),
(17, 'The Wizarding World of Harry Potter', 'Las Angeles', 'USA', 'Where magic turns into revenue', NULL, 1),
(18, 'Hollywood Sign', 'Las Angeles', 'USA', 'An inferior copy of the Bollywood version', '4.8', 3),
(19, 'Universal CityWalk Hollywood', 'Las Angeles', 'USA', 'An amusement facility', '3.4', 4),
(20, 'Angels Flight Railway', 'Las Angeles', 'USA', 'A transportation apparatus', '3.9', 2),
(21, 'Red Fort ', 'Delhi', 'India', 'A famous Mughal era fortification built by the emperor Shah Jahan', NULL, 1),
(22, 'Jama Masjid ', 'Delhi', 'India', 'A famous mosque built in 1656', '2.9', 1),
(23, 'Imperial Palace', 'Tokyo', 'Japan', NULL, NULL, 1),
(24, 'Ginza District', 'Tokyo', 'Japan', 'A centuries-old shopping district', NULL, 1),
(25, 'People\'s Square', 'Shanghai', 'China', 'A large public square', NULL, 1),
(26, 'Nanjing Road', 'Shanghai', 'China', 'A 5km long shopping street attracting millions of people every year', NULL, 1),
(27, 'Museu de Arte(Art Museum)', 'São Paulo', 'Brazil', 'The largest collection of western art in Latin America', NULL, 1),
(28, 'Museo do Futebol(Football Museum)', 'São Paulo', 'Brazil', NULL, NULL, 1),
(29, 'Basilica de Guadalupe', 'Mexico City', 'Mexico', NULL, NULL, 1),
(30, 'Chapultepec Castle', 'Mexico City', 'Mexico ', NULL, NULL, 1),
(31, 'Pyramids of Giza', 'Cairo', 'Egypt', NULL, '4.1', 1),
(32, 'Sphinx', 'Cairo', 'Egypt', NULL, NULL, 1),
(33, 'Big Ben', 'London', 'United Kingdom', 'A tall clocktower next to the River Thames.', '3.5', 2),
(34, 'Gateway of India', 'Mumbai', 'India', NULL, '1.0', 1),
(35, 'Gateway Arch', 'St Louis', 'USA', 'A large arch dedicated to the American people, one of the largest monuments in the Western hemisphere', NULL, 1),
(36, 'Chicago Picasso', 'Chicago', 'USA', 'Also called The Picasso, it is an abstract sculpture made by the famous artist', NULL, 1),
(37, 'National Monument', 'Jakarta ', 'Indonesia', 'A monument to Indonesia\'s existence as a nation', NULL, 2);

-- --------------------------------------------------------

--
-- Table structure for table `reviews`
--

CREATE TABLE `reviews` (
  `reviewID` int(11) NOT NULL,
  `userID` int(11) NOT NULL,
  `placeID` int(11) NOT NULL,
  `score` decimal(10,1) DEFAULT NULL,
  `written` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `reviews`
--

INSERT INTO `reviews` (`reviewID`, `userID`, `placeID`, `score`, `written`) VALUES
(1, 4, 1, '4.4', 'It was a wonderful site, bigger than I thought it would be. The weather was nice, and you can actually walk up to the top of the statue--if you\'re okay with cardio!'),
(2, 3, 9, '3.6', 'This man was an insult to greater men, a beggar among giants, and yet it is a wonderfully made statue.'),
(3, 3, 1, '4.4', 'This is an iconic piece of Americana.'),
(5, 4, 9, '4.0', 'Based cynic versus acidified bloodthirsty authoritarian'),
(6, 4, 31, '4.6', 'This is truly a sight to behold. Herodotus would have you believe these were the product of slave labor, but that is NOT what the evidence shows.'),
(7, 3, 31, '2.8', 'It\'s cool how big they are, and I get that they\'re eternally old and all of that, but come on, IT\'S JUST A SHAPE! I could stack one up myself if I had enough slaves to do it over 20 years.'),
(10, 2, 34, '3.5', 'The structure itself is wonderful, I love the architectural style of it in all its glory. But the wait to get there was terrible--so many other people are trying to see what you are, which really brings down the whole experience.'),
(11, 3, 34, '4.5', 'Don\'t listen to the other reviewer, the crowds were nothing. It was like there was some sort of disease plaguing the land.'),
(16, 1, 9, '5.0', 'The administration sees hosting this content as a temporary expedient to satiate the passions of the masses.'),
(17, 2, 22, '2.9', 'The picture resolution is a perfect symbol of the quality of this attraction to a crowded in viewer.'),
(18, 2, 12, '3.8', 'What a beautiful, organic temple to the cold machinations of the eminent media corporation, gatekeeper of all humanity\'s visually represented passions.'),
(19, 2, 31, '5.0', 'This triangle is waaaaaaaaaaaack');

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
(1, 'Administration', 'admin@gmail.com', 'password', '2021-11-02'),
(2, 'bobby86', 'hotmale@hotmail.com', '13454321', '2021-11-03'),
(3, 'ME', 'wowowowowo@gmail.com', '54321drowssap', '2021-11-03'),
(4, 'meowjohnSMITH', 'nyan@yahoo.com', 'kittytitty', '2021-11-03');

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
(4, 2, 1, NULL),
(5, 2, 4, NULL),
(6, 3, 5, 'Nani?'),
(7, 1, 4, ''),
(8, 1, 3, 'woohoo'),
(22, 1, 7, NULL),
(24, 4, 7, NULL),
(25, 3, 7, NULL);

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
-- Indexes for table `reviews`
--
ALTER TABLE `reviews`
  ADD PRIMARY KEY (`reviewID`);

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
  MODIFY `pictureID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT for table `places`
--
ALTER TABLE `places`
  MODIFY `placeID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT for table `reviews`
--
ALTER TABLE `reviews`
  MODIFY `reviewID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `userID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `wishlist`
--
ALTER TABLE `wishlist`
  MODIFY `wishlistID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
