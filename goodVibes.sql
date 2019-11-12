-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Nov 12, 2019 at 07:33 PM
-- Server version: 10.4.6-MariaDB
-- PHP Version: 7.3.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `goodVibes`
--

-- --------------------------------------------------------

--
-- Table structure for table `albums`
--

CREATE TABLE `albums` (
  `id` int(11) NOT NULL,
  `title` varchar(250) NOT NULL,
  `artist` varchar(50) NOT NULL,
  `genre` varchar(50) NOT NULL,
  `artworkPath` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `albums`
--

INSERT INTO `albums` (`id`, `title`, `artist`, `genre`, `artworkPath`) VALUES
(1, 'Stellaris Utopia', '1', '7', 'assets/images/artwork/utopia.png'),
(2, 'Symphonia (Live)', '5', '6', 'assets/images/artwork/schiller.png'),
(3, 'Essential Love Songs', '4', '6', 'assets/images/artwork/clayderman.png'),
(4, 'Detroit Become Human ', '2', '7', 'assets/images/artwork/detroit_become_human.png'),
(5, 'Attack on Titan', '3', '9', 'assets/images/artwork/epica.png'),
(6, 'When we all fall asleep', '6', '1', 'assets/images/artwork/fallasleep.png'),
(7, 'Re:member', '7', '2', 'assets/images/artwork/remember.png'),
(8, 'Ill Nino', '8', '7', 'assets/images/artwork/nino.png');

-- --------------------------------------------------------

--
-- Table structure for table `artists`
--

CREATE TABLE `artists` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `artists`
--

INSERT INTO `artists` (`id`, `name`) VALUES
(1, 'Dariana'),
(2, 'Nima Fakhara'),
(3, 'Epica'),
(4, 'Richard Clayderman'),
(5, 'Schiller'),
(6, 'Billie Eilish'),
(7, 'Olafur Arnalds'),
(8, 'Enigma');

-- --------------------------------------------------------

--
-- Table structure for table `genre`
--

CREATE TABLE `genre` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `genre`
--

INSERT INTO `genre` (`id`, `name`) VALUES
(1, 'Rock'),
(2, 'Pop'),
(3, 'Classical'),
(4, 'Techno'),
(5, 'Disco'),
(6, 'Instrumental'),
(7, 'Epic'),
(8, 'Minimal'),
(9, 'Metal'),
(10, 'Rap'),
(11, 'Country'),
(12, 'Latin');

-- --------------------------------------------------------

--
-- Table structure for table `Songs`
--

CREATE TABLE `Songs` (
  `id` int(11) NOT NULL,
  `title` varchar(250) NOT NULL,
  `artists` int(11) NOT NULL,
  `album` int(11) NOT NULL,
  `genre` int(11) NOT NULL,
  `duration` varchar(8) NOT NULL,
  `path` varchar(500) NOT NULL,
  `albumOrder` int(11) NOT NULL,
  `plays` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `Songs`
--

INSERT INTO `Songs` (`id`, `title`, `artists`, `album`, `genre`, `duration`, `path`, `albumOrder`, `plays`) VALUES
(6, 'Birth of SuperNova', 1, 1, 7, '2:30', 'assets/music/birth_of_supernova.mp3', 2, 0),
(7, 'Lichtermeer', 5, 2, 2, '2:40', 'assets/music/ci_sara.mp3', 4, 0),
(8, 'Connor Main Theme (Detroit Become Human)', 2, 4, 7, '2:35', 'assets/music/detroit_become_human.mp3', 2, 0),
(9, 'Chronos', 3, 5, 9, '3:20', 'assets/music/epica_cronos.mp3', 3, 0),
(10, 'Memory', 4, 3, 6, '2:43', 'assets/music/memory.mp3', 5, 0),
(11, 'Hostage', 2, 4, 7, '2:50', 'assets/music/detroit_become_human.mp3', 2, 0),
(12, 'Dreams of a Lonely Earth', 1, 1, 7, '3:40', 'assets/music/birth_of_supernova.mp3', 1, 0),
(13, 'You should see me in a crown', 6, 6, 1, '3:21', 'assets/music/youshouldseeme.mp3', 6, 0),
(14, 'So close ', 7, 7, 2, '2:40', 'assets/music/soclose.mp3', 7, 0),
(15, 'Pieces of the Sun', 8, 8, 7, '4:15', 'assets/music/piecesofthesun.mp3', 8, 0);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `username` varchar(25) NOT NULL,
  `firstName` varchar(50) NOT NULL,
  `lastName` varchar(50) NOT NULL,
  `email` varchar(200) NOT NULL,
  `password` varchar(32) NOT NULL,
  `signUpDate` datetime NOT NULL,
  `profilePic` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`username`, `firstName`, `lastName`, `email`, `password`, `signUpDate`, `profilePic`) VALUES
('darianapro', 'Daria', 'Grin', 'Darianapro@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', '2019-11-05 00:00:00', 'assets/images/profile-pics/connor.jpg'),
('DmitryGreen', 'Dmitry', 'Green', 'Dmitry.green@me.com', '827ccb0eea8a706c4c34a16891f84e7b', '2019-11-05 00:00:00', 'assets/images/profile-pics/connor.jpg'),
('AndroidRK800', 'Rk', '800', 'Singularity3100@gmail.com', '827ccb0eea8a706c4c34a16891f84e7b', '2019-11-05 00:00:00', 'assets/images/profile-pics/connor.jpg'),
('Katerina', 'Katya', 'Skripnikov`', 'Ekaterina@gmail.com', '827ccb0eea8a706c4c34a16891f84e7b', '2019-11-05 00:00:00', 'assets/images/profile-pics/connor.jpg'),
('HankAnderson', 'Hank', 'Anderson', 'Hank@dbh.com', 'e10adc3949ba59abbe56e057f20f883e', '2019-11-06 00:00:00', 'assets/images/profile-pics/connor.jpg'),
('valeen9', 'Valentina', 'Arias', 'Veleen9@gmail.com', '827ccb0eea8a706c4c34a16891f84e7b', '2019-11-06 00:00:00', 'assets/images/profile-pics/connor.jpg'),
('kara400', 'Kara', 'Android', 'Kara@dbh.com', 'e10adc3949ba59abbe56e057f20f883e', '2019-11-11 00:00:00', 'assets/images/profile-pics/connor.jpg');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `albums`
--
ALTER TABLE `albums`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `artists`
--
ALTER TABLE `artists`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `genre`
--
ALTER TABLE `genre`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `Songs`
--
ALTER TABLE `Songs`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `albums`
--
ALTER TABLE `albums`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `artists`
--
ALTER TABLE `artists`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `genre`
--
ALTER TABLE `genre`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `Songs`
--
ALTER TABLE `Songs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
