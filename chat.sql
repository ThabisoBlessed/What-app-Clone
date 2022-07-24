-- phpMyAdmin SQL Dump
-- version 5.1.3
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jun 30, 2022 at 12:14 PM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 8.1.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `chat`
--

-- --------------------------------------------------------

--
-- Table structure for table `friend_requests`
--

CREATE TABLE `friend_requests` (
  `id` int(11) NOT NULL,
  `userfrom` varchar(50) NOT NULL,
  `userto` varchar(50) NOT NULL,
  `display` varchar(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `friend_requests`
--

INSERT INTO `friend_requests` (`id`, `userfrom`, `userto`, `display`) VALUES
(6, 'belinda@gmail.com', 'Bob@gmail.com', 'yes');

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

CREATE TABLE `messages` (
  `id` int(11) NOT NULL,
  `userfrom` varchar(50) NOT NULL,
  `userto` varchar(50) NOT NULL,
  `chatmessage` text NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `messages`
--

INSERT INTO `messages` (`id`, `userfrom`, `userto`, `chatmessage`, `status`) VALUES
(1, '12', '6', 'you cool man', 0),
(2, '6', '12', 'im good howzit', 0),
(4, '12', '6', 'im good howzit', 0),
(5, '12', '6', 'im good howzit', 0),
(6, '12', '13', 'hie  you cool', 0),
(7, '13', '12', 'im good howzit', 0),
(8, '13', '12', 'you cool man', 1),
(9, '6', '19', 'you cool man', 1);

-- --------------------------------------------------------

--
-- Table structure for table `profile`
--

CREATE TABLE `profile` (
  `id` int(11) NOT NULL,
  `email` varchar(50) NOT NULL,
  `image` varchar(252) NOT NULL,
  `status` varchar(1000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `profile`
--

INSERT INTO `profile` (`id`, `email`, `image`, `status`) VALUES
(1, 'Mike@gmail.com', 'Assets/images/proff_pics/62817d0c3a9d9download.jpeg', 'shoot for the moon , aim for the stars...'),
(7, 'Bob@gmail.com', 'Assets/images/proff_pics/6281b8072d262bill.jpg', 'take it one day at a time.'),
(8, 'Belinda@gmail.com', 'Assets/images/proff_pics/6281b92d4f9ebbabrie.png', 'The sky  is the limit..'),
(9, 'Rachel@gmail.com', 'Assets/images/proff_pics/6281b997a23dftest.jpg', 'One day at a time ,with patience'),
(11, 'Mary@gmail.com', 'Assets/images/proff_pics/62a48169cfbb6IMG_2074.jpg', 'We move'),
(12, 'Miriam@gmail.com', 'Assets/images/proff_pics/62a48e7517e86IMG_2074.jpg', 'Living the dream');

-- --------------------------------------------------------

--
-- Table structure for table `publicchat`
--

CREATE TABLE `publicchat` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `message` text NOT NULL,
  `msgdate` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `publicchat`
--

INSERT INTO `publicchat` (`id`, `name`, `message`, `msgdate`) VALUES
(1, 'Bobby', 'wassup', '2022-05-24 18:06:33'),
(2, 'Mike', 'im good howzit bro', '2022-05-24 18:33:22'),
(3, 'Bobby', 'heee', '2022-05-31 13:35:01'),
(4, 'Bobby', 'heyy', '2022-05-31 13:35:59'),
(5, 'Belinda', 'jhjjh', '2022-06-11 11:54:26'),
(6, 'Belinda', 'hhggh', '2022-06-11 11:54:32'),
(7, 'Belinda', 'nbnbn', '2022-06-11 11:54:35'),
(8, 'Belinda', 'how is  it', '2022-06-11 12:03:11'),
(9, '', '', '2022-06-11 12:44:19'),
(10, 'Mike', 'hie how ', '2022-06-11 12:47:12'),
(11, 'Mike', 'im newv hear', '2022-06-11 12:47:24');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `email` varchar(90) NOT NULL,
  `password` varchar(255) NOT NULL,
  `friends` text NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `password`, `friends`, `status`) VALUES
(6, 'Mike', 'Mike@gmail.com', '827ccb0eea8a706c4c34a16891f84e7b', ',Bob@gmail.com,Miriam@gmail.com,', 0),
(12, 'Bobby', 'Bob@gmail.com', '827ccb0eea8a706c4c34a16891f84e7b', ',belinda@gmail.com,mike@gmail.com,rachel@gmail.com,', 0),
(13, 'Belinda', 'Belinda@gmail.com', '827ccb0eea8a706c4c34a16891f84e7b', ',Bob@gmail.com,rachel@gmail.com,', 0),
(14, 'Rachel', 'Rachel@gmail.com', '827ccb0eea8a706c4c34a16891f84e7b', ',Bob@gmail.com,Belinda@gmail.com,', 0),
(18, 'Mary', 'Mary@gmail.com', '827ccb0eea8a706c4c34a16891f84e7b', ',', 0),
(19, 'Miriam', 'Miriam@gmail.com', '827ccb0eea8a706c4c34a16891f84e7b', ',mike@gmail.com,', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `friend_requests`
--
ALTER TABLE `friend_requests`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `profile`
--
ALTER TABLE `profile`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `publicchat`
--
ALTER TABLE `publicchat`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `friend_requests`
--
ALTER TABLE `friend_requests`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `messages`
--
ALTER TABLE `messages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `profile`
--
ALTER TABLE `profile`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `publicchat`
--
ALTER TABLE `publicchat`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
