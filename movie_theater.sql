-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 06, 2022 at 08:59 PM
-- Server version: 10.4.21-MariaDB
-- PHP Version: 8.0.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `movie_theater`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `admin_id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `password` varchar(256) NOT NULL,
  `email` varchar(100) NOT NULL,
  `phone_number` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`admin_id`, `name`, `password`, `email`, `phone_number`) VALUES
(3, 'arif', '$2y$10$dW2S04ExrMuaqj6vvsZWDe2kzQSKBS.1uhsv22vkSBV.Cqe0Im25e', 'arif777@gmail.com', 32974637),
(4, 'rakib', '$2y$10$WV4yMcsl6ufDQ9aRKy9JR.3g/2N1Y4ne5kdNOVIFFufvN949JFp.S', 'rakib123@gmail.com', 21344),
(6, 'admin', '$2y$10$h4hG/ZzOvziTeZlyfkQyCOk6ZQOyOZ7za.T6s/Mem4kdKrVHjqY4u', 'admin2@gmail.com', 123523421),
(9, 'ashfaqul haque', '$2y$10$phf3xb4YPIhXjVZ/s5mkYelcZnt43LkiS9moF1KGJM2msg7WT8J5y', 'ashfaqul333@gmail.com', 1234678921);

-- --------------------------------------------------------

--
-- Table structure for table `booking`
--

CREATE TABLE `booking` (
  `ticket_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `payment_status` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `booking`
--

INSERT INTO `booking` (`ticket_id`, `user_id`, `payment_status`) VALUES
(28, 10, 'Cash'),
(30, 11, 'Cash'),
(31, 11, 'Credit'),
(32, 10, 'Credit');

-- --------------------------------------------------------

--
-- Table structure for table `movies`
--

CREATE TABLE `movies` (
  `movie_id` int(11) NOT NULL,
  `image` varchar(500) NOT NULL,
  `movie_title` varchar(100) NOT NULL,
  `genre` varchar(100) NOT NULL,
  `release_date` date NOT NULL,
  `no_of_tickets` int(11) NOT NULL,
  `showtime1` time NOT NULL,
  `showtime2` time NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `movies`
--

INSERT INTO `movies` (`movie_id`, `image`, `movie_title`, `genre`, `release_date`, `no_of_tickets`, `showtime1`, `showtime2`) VALUES
(8, 'avengers.jpg', 'avengers', 'action', '2022-01-03', 78, '02:00:00', '05:00:00'),
(10, 'spiderman.jpg', 'spiderman', 'thriller', '2022-01-11', 94, '08:50:00', '10:20:00'),
(11, 'Titanic.png', 'titanic', 'drama', '2021-12-08', 5, '11:00:00', '15:30:00'),
(18, 'quietplace2.jpg', 'a quiet place 2', 'horror', '2022-01-18', 195, '00:00:00', '00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `tickets`
--

CREATE TABLE `tickets` (
  `ticket_id` int(11) NOT NULL,
  `movie_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `no_of_tickets` int(11) NOT NULL,
  `hall_number` varchar(11) NOT NULL,
  `seat_type` varchar(10) NOT NULL,
  `date` date NOT NULL,
  `time` time NOT NULL,
  `payment_method` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tickets`
--

INSERT INTO `tickets` (`ticket_id`, `movie_id`, `user_id`, `no_of_tickets`, `hall_number`, `seat_type`, `date`, `time`, `payment_method`) VALUES
(28, 10, 10, 3, 'Hall-1', 'Premium', '2022-01-24', '00:00:00', 'Cash'),
(30, 10, 11, 3, 'Hall-1', 'regular', '2022-01-14', '00:00:00', 'Cash'),
(31, 8, 11, 2, 'Hall-2', 'Premium', '2022-01-18', '00:00:00', 'Credit'),
(32, 18, 10, 5, 'Hall-1', 'Premium', '2022-01-21', '00:00:00', 'Credit');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `phone_number` int(11) NOT NULL,
  `password` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `name`, `email`, `phone_number`, `password`) VALUES
(10, 'ashfaq', 'ashfaqul383@gmail.com', 1707666879, '$2y$10$M5IQw16Nsy4XyLL6LdEqROLdoHd9rMKwZS1HfrWApgsjT53EoHdZq'),
(11, 'shohagh', 'shohagh123@gmail.com', 12397434, '$2y$10$JR9YtQXpKwX72BR0SBvjHefWbIvXqE3G1LGh5Gbhl.IBokCHXUEzK'),
(14, 'ashfaqul', 'ashfaqul123@gmail.com', 1672888921, '$2y$10$wHXxHtgNufArZsrPnEEhSedH3Ln2wufjMraouTZiQABq7Nz51Yz1q');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`admin_id`);

--
-- Indexes for table `booking`
--
ALTER TABLE `booking`
  ADD PRIMARY KEY (`ticket_id`,`user_id`),
  ADD KEY `ticket_id` (`ticket_id`,`user_id`),
  ADD KEY `booking_ibfk_1` (`user_id`);

--
-- Indexes for table `movies`
--
ALTER TABLE `movies`
  ADD PRIMARY KEY (`movie_id`);

--
-- Indexes for table `tickets`
--
ALTER TABLE `tickets`
  ADD PRIMARY KEY (`ticket_id`),
  ADD KEY `movie_id` (`movie_id`),
  ADD KEY `tickets_ibfk_2` (`user_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `admin_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `movies`
--
ALTER TABLE `movies`
  MODIFY `movie_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT for table `tickets`
--
ALTER TABLE `tickets`
  MODIFY `ticket_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `booking`
--
ALTER TABLE `booking`
  ADD CONSTRAINT `booking_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `booking_ibfk_2` FOREIGN KEY (`ticket_id`) REFERENCES `tickets` (`ticket_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tickets`
--
ALTER TABLE `tickets`
  ADD CONSTRAINT `tickets_ibfk_1` FOREIGN KEY (`movie_id`) REFERENCES `movies` (`movie_id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `tickets_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
