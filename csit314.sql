-- phpMyAdmin SQL Dump
-- version 4.9.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Nov 01, 2019 at 04:39 PM
-- Server version: 10.4.8-MariaDB
-- PHP Version: 7.1.32

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `csit314`
--

-- --------------------------------------------------------

--
-- Table structure for table `booking`
--

CREATE TABLE `booking` (
  `BookingID` int(11) NOT NULL,
  `TourID` int(11) NOT NULL,
  `UserID` int(11) NOT NULL,
  `Price` decimal(10,0) NOT NULL,
  `Start_date` date NOT NULL,
  `End_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `country`
--

CREATE TABLE `country` (
  `CountryID` int(11) NOT NULL,
  `Name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `country`
--

INSERT INTO `country` (`CountryID`, `Name`) VALUES
(2, 'France'),
(3, 'Afghanistan');

-- --------------------------------------------------------

--
-- Table structure for table `language`
--

CREATE TABLE `language` (
  `LanguageID` int(11) NOT NULL,
  `Name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `language`
--

INSERT INTO `language` (`LanguageID`, `Name`) VALUES
(0, 'Afrikanns'),
(1, 'Albanian'),
(2, 'Arabic'),
(3, 'Arabic'),
(4, 'Armenian'),
(6, 'Basque'),
(7, 'Bengali'),
(8, 'Bulgarian'),
(9, 'Catalan'),
(10, 'Cambodian'),
(11, 'Chinese (Mandarin)'),
(12, 'Croatian'),
(13, 'Czech'),
(14, 'Danish'),
(15, 'Dutch'),
(17, 'English'),
(18, 'Estonian'),
(19, 'Fiji'),
(20, 'Finnish'),
(21, 'French'),
(22, 'Georgian'),
(23, 'German'),
(24, 'Greek'),
(25, 'Gujarati'),
(26, 'Hebrew'),
(27, 'Hindi'),
(28, 'Hungarian'),
(29, 'Icelandic'),
(30, 'Indonesian'),
(31, 'Irish'),
(32, 'Italian'),
(33, 'Japanese'),
(34, 'Javanese'),
(35, 'Korean'),
(36, 'Latin'),
(37, 'Latvian'),
(38, 'Lithuanian'),
(39, 'Macedonian'),
(40, 'Malay'),
(41, 'Malayalam'),
(42, 'Maltese'),
(43, 'Maori'),
(44, 'Marathi'),
(45, 'Mongolian'),
(46, 'Nepali'),
(47, 'Norwegian'),
(48, 'Persian'),
(49, 'Polish'),
(50, 'Portuguese'),
(51, 'Punjabi'),
(52, 'Quechua'),
(53, 'Romanian'),
(54, 'Russian'),
(55, 'Samoan'),
(56, 'Serbian'),
(57, 'Slovak'),
(58, 'Slovenian'),
(59, 'Spanish'),
(60, 'Swahili'),
(61, 'Swedish'),
(62, 'Tamil'),
(63, 'Tatar'),
(64, 'Telugu'),
(65, 'Thai'),
(66, 'Tibetan'),
(67, 'Tonga'),
(68, 'Turkish'),
(69, 'Ukranian'),
(70, 'Urdu'),
(71, 'Uzbek'),
(72, 'Vietnamese'),
(73, 'Welsh'),
(74, 'Xhosa');

-- --------------------------------------------------------

--
-- Table structure for table `spokenlanguage`
--

CREATE TABLE `spokenlanguage` (
  `UserID` int(11) NOT NULL,
  `LanguageID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `spokenlanguage`
--

INSERT INTO `spokenlanguage` (`UserID`, `LanguageID`) VALUES
(11, 17),
(11, 11),
(11, 21),
(12, 40),
(13, 17),
(13, 3);

-- --------------------------------------------------------

--
-- Table structure for table `state`
--

CREATE TABLE `state` (
  `StateID` int(11) NOT NULL,
  `CountryID` int(11) NOT NULL,
  `Name` varchar(255) NOT NULL,
  `Description_1` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `state`
--

INSERT INTO `state` (`StateID`, `CountryID`, `Name`, `Description_1`) VALUES
(7, 2, 'Paris', ''),
(8, 3, 'Afghan', '');

-- --------------------------------------------------------

--
-- Table structure for table `tour`
--

CREATE TABLE `tour` (
  `TourID` int(11) NOT NULL,
  `Name` varchar(255) NOT NULL,
  `Description` text NOT NULL,
  `TourGuideID` int(11) NOT NULL,
  `CountryID` int(11) NOT NULL,
  `StateID` int(11) NOT NULL,
  `Start_date` varchar(100) NOT NULL,
  `End_date` varchar(100) NOT NULL,
  `Price` decimal(10,0) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tourimage`
--

CREATE TABLE `tourimage` (
  `TourImgID` int(11) NOT NULL,
  `TourID` int(11) NOT NULL,
  `AddedByUser` int(11) NOT NULL,
  `Image` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tourreview`
--

CREATE TABLE `tourreview` (
  `TourReviewID` int(11) NOT NULL,
  `TourID` int(11) NOT NULL,
  `ReviewByUser` int(11) NOT NULL,
  `BookingID` int(11) NOT NULL,
  `Comment` text NOT NULL,
  `Rating` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `UserID` int(16) NOT NULL,
  `FirstName` varchar(255) NOT NULL,
  `LastName` varchar(255) NOT NULL,
  `Email` varchar(255) NOT NULL,
  `Password` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`UserID`, `FirstName`, `LastName`, `Email`, `Password`) VALUES
(1, 'Jonathan', 'Lua', 'jonlua@gmail.com', 'password'),
(11, 'System', 'Admin', 'sysadmin@gmail.com', 'sysadmin123'),
(12, 'Huzair', 'Yazid', 'huzairyazid@gmail.com', 'sysadmin123'),
(13, 'zayn', 'malik', 'Pu55yslayer@gmail.com', 'abcd1234!');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `booking`
--
ALTER TABLE `booking`
  ADD PRIMARY KEY (`BookingID`),
  ADD KEY `booking_ibfk_1` (`TourID`),
  ADD KEY `booking_ibfk_2` (`UserID`);

--
-- Indexes for table `country`
--
ALTER TABLE `country`
  ADD PRIMARY KEY (`CountryID`);

--
-- Indexes for table `language`
--
ALTER TABLE `language`
  ADD PRIMARY KEY (`LanguageID`);

--
-- Indexes for table `spokenlanguage`
--
ALTER TABLE `spokenlanguage`
  ADD KEY `spokenlanguages_ibfk_1` (`UserID`),
  ADD KEY `spokenlanguages_ibfk_2` (`LanguageID`);

--
-- Indexes for table `state`
--
ALTER TABLE `state`
  ADD PRIMARY KEY (`StateID`),
  ADD KEY `state_ibfk_1` (`CountryID`);

--
-- Indexes for table `tour`
--
ALTER TABLE `tour`
  ADD PRIMARY KEY (`TourID`),
  ADD KEY `tour_ibfk_1` (`TourGuideID`),
  ADD KEY `tour_ibfk_2` (`CountryID`),
  ADD KEY `tour_ibfk_3` (`StateID`);

--
-- Indexes for table `tourimage`
--
ALTER TABLE `tourimage`
  ADD PRIMARY KEY (`TourImgID`),
  ADD KEY `tourimage_ibfk_1` (`TourID`),
  ADD KEY `tourimage_ibfk_2` (`AddedByUser`);

--
-- Indexes for table `tourreview`
--
ALTER TABLE `tourreview`
  ADD PRIMARY KEY (`TourReviewID`),
  ADD KEY `usertour_ibfk_1` (`TourID`),
  ADD KEY `usertour_ibfk_2` (`ReviewByUser`),
  ADD KEY `usertour_ibfk_3` (`BookingID`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`UserID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `booking`
--
ALTER TABLE `booking`
  MODIFY `BookingID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `country`
--
ALTER TABLE `country`
  MODIFY `CountryID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `language`
--
ALTER TABLE `language`
  MODIFY `LanguageID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=75;

--
-- AUTO_INCREMENT for table `state`
--
ALTER TABLE `state`
  MODIFY `StateID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `tour`
--
ALTER TABLE `tour`
  MODIFY `TourID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT for table `tourimage`
--
ALTER TABLE `tourimage`
  MODIFY `TourImgID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=60;

--
-- AUTO_INCREMENT for table `tourreview`
--
ALTER TABLE `tourreview`
  MODIFY `TourReviewID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `UserID` int(16) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `booking`
--
ALTER TABLE `booking`
  ADD CONSTRAINT `booking_ibfk_1` FOREIGN KEY (`TourID`) REFERENCES `tour` (`TourID`) ON DELETE CASCADE,
  ADD CONSTRAINT `booking_ibfk_2` FOREIGN KEY (`UserID`) REFERENCES `user` (`UserID`) ON DELETE CASCADE;

--
-- Constraints for table `spokenlanguage`
--
ALTER TABLE `spokenlanguage`
  ADD CONSTRAINT `spokenlanguage_ibfk_1` FOREIGN KEY (`UserID`) REFERENCES `user` (`UserID`) ON DELETE CASCADE,
  ADD CONSTRAINT `spokenlanguage_ibfk_2` FOREIGN KEY (`LanguageID`) REFERENCES `language` (`LanguageID`) ON DELETE CASCADE,
  ADD CONSTRAINT `spokenlanguages_ibfk_2` FOREIGN KEY (`LanguageID`) REFERENCES `language` (`LanguageID`) ON DELETE CASCADE;

--
-- Constraints for table `state`
--
ALTER TABLE `state`
  ADD CONSTRAINT `state_ibfk_1` FOREIGN KEY (`CountryID`) REFERENCES `country` (`CountryID`);

--
-- Constraints for table `tour`
--
ALTER TABLE `tour`
  ADD CONSTRAINT `tour_ibfk_2` FOREIGN KEY (`CountryID`) REFERENCES `country` (`CountryID`),
  ADD CONSTRAINT `tour_ibfk_3` FOREIGN KEY (`StateID`) REFERENCES `state` (`StateID`),
  ADD CONSTRAINT `tour_ibfk_4` FOREIGN KEY (`TourGuideID`) REFERENCES `user` (`UserID`) ON DELETE CASCADE;

--
-- Constraints for table `tourimage`
--
ALTER TABLE `tourimage`
  ADD CONSTRAINT `tourimage_ibfk_1` FOREIGN KEY (`TourID`) REFERENCES `tour` (`TourID`) ON DELETE CASCADE,
  ADD CONSTRAINT `tourimage_ibfk_2` FOREIGN KEY (`AddedByUser`) REFERENCES `tour` (`TourGuideID`) ON DELETE CASCADE;

--
-- Constraints for table `tourreview`
--
ALTER TABLE `tourreview`
  ADD CONSTRAINT `tourreview_ibfk_1` FOREIGN KEY (`ReviewByUser`) REFERENCES `user` (`UserID`) ON DELETE CASCADE,
  ADD CONSTRAINT `usertour_ibfk_1` FOREIGN KEY (`TourID`) REFERENCES `tour` (`TourID`),
  ADD CONSTRAINT `usertour_ibfk_3` FOREIGN KEY (`BookingID`) REFERENCES `booking` (`BookingID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
