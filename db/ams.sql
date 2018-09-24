-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: May 14, 2018 at 07:09 PM
-- Server version: 10.1.9-MariaDB
-- PHP Version: 5.6.15

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ams`
--

-- --------------------------------------------------------

--
-- Table structure for table `article`
--

CREATE TABLE `article` (
  `article_id` int(11) NOT NULL,
  `title` varchar(100) NOT NULL,
  `descr` varchar(1000) NOT NULL,
  `user_id` int(11) NOT NULL,
  `dat` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `article`
--

INSERT INTO `article` (`article_id`, `title`, `descr`, `user_id`, `dat`) VALUES
(36, 'ACKNOWLEDGEMENT', 'I would like to thank my project supervisors, and we are also grateful to our respected teachers HOD Er. Anup Bhuju, Er. Subash Bhuju and Er. Suraj Kumar Hekka. I would also like to thank my project partners, Anand Tolang, Arpan Shah Thakuri & Naresh Chaulagain, for their collaboration on this project and the support. Finally, I also thankful to our parents for providing us the encouragement and back support.', 1, '12-05-2018'),
(37, 'Motivation', 'The mobile market continues to grow each year replacing the demand for traditional desktop applications. This makes software development for mobile devices an interesting and attractive industry to work in. Motivation for this project stems from the desire to learn and gain experience in mobile app development as well as an interest in the design and development of distributed systems. ', 1, '12-05-2018'),
(38, 'Application', 'This system can be used in many organizations like Restaurant, Hotel, Bar, Pub etc. & this system will help to these company in the sector of administration, staff management & Inventory management etc. ', 1, '12-05-2018'),
(41, 'First Article', 'This project is undertaking by a group of 4 members namely Jeeven Lamichhane from Banepa, Anand Tolang from Budol, Naresh Chaulagain from Rabiopi and Arpan Shah Thakuri from Panauti. ', 1, '12-05-2018'),
(43, 'LITERATURE REVIEW', 'Originally Java was selected due to its portability however there were concerns with its ability to produce an attractive interface. SQLite was selected due to its portability, and because it requires no administration making it perfect for embedded systems which are common among restaurant management systems. The IDE used was Android Studio due to its project organization, syntax checking, and deployment features. SQLite studio was used to manage the SQLite database. It allows management of schemas, data, and queries. Android Studio provides a WYSIWYG (what you see is what you get) interface for producing very attractive Android app. ', 3, '12-05-2018'),
(54, 'Never Mind', 'This is Your Home Page. From Here you can Post your Article.', 2, '13-05-2018');

-- --------------------------------------------------------

--
-- Table structure for table `comment`
--

CREATE TABLE `comment` (
  `comment_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `article_id` int(11) NOT NULL,
  `comments` varchar(500) NOT NULL,
  `dat` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `secure`
--

CREATE TABLE `secure` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `secure`
--

INSERT INTO `secure` (`id`, `user_id`, `email`, `password`) VALUES
(1, 1, 'Lamichhaneaj@gmail.com', '827ccb0eea8a706c4c34a16891f84e7b'),
(2, 2, 'replymisclive@gmail.com', '827ccb0eea8a706c4c34a16891f84e7b'),
(3, 3, 'deviyni@hotmail.com', '01cfcd4f6b8770febfb40cb906715822');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `fname` varchar(100) NOT NULL,
  `lname` varchar(100) NOT NULL,
  `address` varchar(100) NOT NULL,
  `phone` varchar(10) NOT NULL,
  `dob` varchar(15) NOT NULL,
  `occ` varchar(100) NOT NULL,
  `gender` varchar(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `fname`, `lname`, `address`, `phone`, `dob`, `occ`, `gender`) VALUES
(1, 'Jeeven', 'Lamichhane', 'Banepa', '9860463471', '29/07/1999', 'Student', 'Male'),
(2, 'MacAlistair', 'Lamichhanea', 'Nala', '9803610971', '29/07/1999', 'Student', 'Male'),
(3, 'Deviyni', 'Lamichhane', 'Katmandu', '9869413792', '01/06/2002', 'Writer', 'Female');

-- --------------------------------------------------------

--
-- Table structure for table `user_role`
--

CREATE TABLE `user_role` (
  `user_id` int(11) NOT NULL,
  `role` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_role`
--

INSERT INTO `user_role` (`user_id`, `role`) VALUES
(1, 'Author'),
(2, 'Visitor'),
(3, 'Author');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `article`
--
ALTER TABLE `article`
  ADD PRIMARY KEY (`article_id`),
  ADD UNIQUE KEY `title` (`title`);

--
-- Indexes for table `comment`
--
ALTER TABLE `comment`
  ADD PRIMARY KEY (`comment_id`);

--
-- Indexes for table `secure`
--
ALTER TABLE `secure`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `phone` (`phone`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `article`
--
ALTER TABLE `article`
  MODIFY `article_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=55;
--
-- AUTO_INCREMENT for table `comment`
--
ALTER TABLE `comment`
  MODIFY `comment_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;
--
-- AUTO_INCREMENT for table `secure`
--
ALTER TABLE `secure`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
