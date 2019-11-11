-- phpMyAdmin SQL Dump
-- version 4.9.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Nov 11, 2019 at 10:06 PM
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
  `Group_Size` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `booking`
--

INSERT INTO `booking` (`BookingID`, `TourID`, `UserID`, `Group_Size`) VALUES
(16, 15, 17, 2),
(18, 15, 17, 2);

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
(6, 'USA'),
(7, 'Indonesia'),
(8, 'South Korea'),
(9, 'Czech Republic'),
(10, 'Afghanistan');

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
(16, 17),
(16, 11),
(17, 0),
(17, 3),
(17, 1);

-- --------------------------------------------------------

--
-- Table structure for table `state`
--

CREATE TABLE `state` (
  `StateID` int(11) NOT NULL,
  `CountryID` int(11) NOT NULL,
  `Name` varchar(255) NOT NULL,
  `Description_1` text DEFAULT NULL,
  `Description_2` text DEFAULT NULL,
  `Image_1` varchar(255) DEFAULT NULL,
  `Image_2` varchar(255) DEFAULT NULL,
  `Image_3` varchar(255) DEFAULT NULL,
  `Title_1` varchar(255) DEFAULT NULL,
  `Title_2` varchar(255) DEFAULT NULL,
  `BG_Text_Color` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `state`
--

INSERT INTO `state` (`StateID`, `CountryID`, `Name`, `Description_1`, `Description_2`, `Image_1`, `Image_2`, `Image_3`, `Title_1`, `Title_2`, `BG_Text_Color`) VALUES
(7, 2, 'Paris', 'The Champs-Elysees is a truly lovely avenue: a picture postcard scene. Nearly 2 kilometres in length, this historic thoroughfare runs from Place de la Concorde to the majestic Arc de Triomphe. But though it has since become the world\'s most beautiful avenue, the Champs-Elysees was once a swamp. The avenue has only become more beautiful with every passing decade.', 'Set in the heart of Paris, the former French royal palace today is home to one of the largest and most renowned art collections in the world. Home to Leonardo da Vinci\'s Mona Lisa, the Louvre is considered the world\'s greatest art museum, with an unparalleled collection of items covering the full spectrum of art through the ages', 'champs_elysees.jpg', 'louvre.jpg', 'paris.jpg', 'The Champs-Elysees, past and present', 'The Musee du Louvre', 'black\r\n'),
(9, 9, 'Prague', 'Prague Castle is a castle complex in Prague, Czech Republic, built in the 9th century. It is the official office of the President of the Czech Republic. The castle was a seat of power for kings of Bohemia, Holy Roman emperors, and presidents of Czechoslovakia.', 'Connecting the Old town with Lesser Town, this popular pedestrian bridge is filled with musicians, painters, vendors and tourists during the summertime.', 'prague_castle.jpg', 'Charles_bridge.jpg', 'prague.jpg', 'Prague Castle', 'Charles Bridge', 'white'),
(10, 7, 'Flores', 'These paradise islands with gorgeous scenery, pretty pink sand beaches and crystal clear waters form part of Flores, which is just an hour’s flight from Bali. While every inch of Bali’s popular beaches is often crowded with tourists, these relatively untouched tropical islands guarantee you more privacy with ravishing lagoons and even greater outdoors and sceneries.', 'Sand is sand, right? Wrong. From black and green to orange and pink hues, coastlines of the world offer an array of colorful sand options. Remember, as you check off your rainbow-beach bucket list, please take only photographs, not sand. While tempting, removing sand from the beach dilutes the color and ruins the experience for future generations.', 'komodo_dragons.jpg', 'pink_beach.jpg', 'labuan_bajo.jpg', 'Komodo Island', 'Tangsi Beach (Pink Beach)', 'white'),
(11, 10, 'afghan', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tour`
--

CREATE TABLE `tour` (
  `TourID` int(11) NOT NULL,
  `Name` text NOT NULL,
  `Description` text NOT NULL,
  `TourGuideID` int(11) NOT NULL,
  `CountryID` int(11) NOT NULL,
  `StateID` int(11) NOT NULL,
  `Start_date` varchar(100) NOT NULL,
  `End_date` varchar(100) NOT NULL,
  `Price` decimal(10,0) NOT NULL,
  `Group_Size` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tour`
--

INSERT INTO `tour` (`TourID`, `Name`, `Description`, `TourGuideID`, `CountryID`, `StateID`, `Start_date`, `End_date`, `Price`, `Group_Size`) VALUES
(15, 'sadadsad', 'asdasda', 16, 10, 11, '11/22/2019', '11/23/2019', '20', 20);

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

--
-- Dumping data for table `tourimage`
--

INSERT INTO `tourimage` (`TourImgID`, `TourID`, `AddedByUser`, `Image`) VALUES
(34, 15, 16, 'wqeqeqwe'),
(36, 15, 16, 'wqeqeqwe');

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
  `Password` text NOT NULL,
  `Profile_Image` varchar(255) NOT NULL DEFAULT '1573211573_IMG_0420.JPG'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`UserID`, `FirstName`, `LastName`, `Email`, `Password`, `Profile_Image`) VALUES
(16, 'Russell', 'Leong', 'rleong@gmail.com', 'af96cfbbb950a4123e0d08cfac0baf55', '1572777080_y.jpeg'),
(17, 'System', 'Admin', 'sysadmin@gmail.com', 'a9a9e9dcb45962970eac445259464b3f', '1573211573_IMG_0420.JPG'),
(19, 'Leo', 'Collier', 'odio@nonhendreritid.edu', 'abnd1234', '1573211573_IMG_0420.JPG'),
(20, 'Amery', 'Guthrie', 'Curabitur.dictum.Phasellus@mattisCraseget.com', 'abwd1234', '1573211573_IMG_0420.JPG'),
(21, 'Garrison', 'Hester', 'elit.sed.consequat@Aliquamnec.net', 'abwd1234', '1573211573_IMG_0420.JPG'),
(22, 'Winifred', 'Richard', 'luctus.ut.pellentesque@velitegestas.org', 'abxd1234', '1573211573_IMG_0420.JPG'),
(23, 'Ishmael', 'Byers', 'fringilla.Donec@luctus.net', 'abgd1234', '1573211573_IMG_0420.JPG'),
(24, 'Warren', 'Yates', 'tellus@ipsumdolor.org', 'abld1234', '1573211573_IMG_0420.JPG'),
(25, 'Ursa', 'Mcgee', 'id.risus@Fusce.ca', 'abqd1234', '1573211573_IMG_0420.JPG'),
(26, 'Jameson', 'Townsend', 'In.nec.orci@eu.org', 'abpd1234', '1573211573_IMG_0420.JPG'),
(27, 'Patience', 'Lambert', 'habitant@metusIn.co.uk', 'abwd1234', '1573211573_IMG_0420.JPG'),
(28, 'Oleg', 'Paul', 'Donec.at@hymenaeosMaurisut.com', 'abfd1234', '1573211573_IMG_0420.JPG'),
(29, 'Reed', 'Whitney', 'bibendum@vitaeposuere.net', 'abgd1234', '1573211573_IMG_0420.JPG'),
(30, 'Knox', 'Emerson', 'a@arcu.net', 'abld1234', '1573211573_IMG_0420.JPG'),
(31, 'Kuame', 'Ashley', 'inceptos.hymenaeos.Mauris@porttitorinterdum.ca', 'abvd1234', '1573211573_IMG_0420.JPG'),
(32, 'Colt', 'Hammond', 'nec@elitpellentesquea.com', 'abvd1234', '1573211573_IMG_0420.JPG'),
(33, 'Alfonso', 'Pearson', 'Vestibulum@eudoloregestas.com', 'abdd1234', '1573211573_IMG_0420.JPG'),
(34, 'Emi', 'Curry', 'Etiam@mauris.co.uk', 'abrd1234', '1573211573_IMG_0420.JPG'),
(35, 'Hanna', 'Morgan', 'adipiscing@ac.com', 'abyd1234', '1573211573_IMG_0420.JPG'),
(36, 'Cyrus', 'Preston', 'Aliquam.erat@adlitoratorquent.com', 'abgd1234', '1573211573_IMG_0420.JPG'),
(37, 'Helen', 'Bell', 'Suspendisse.ac@conguea.edu', 'abxd1234', '1573211573_IMG_0420.JPG'),
(38, 'Len', 'Davidson', 'dictum.eleifend@turpisNulla.com', 'abcd1234', '1573211573_IMG_0420.JPG'),
(39, 'Allistair', 'Barnes', 'lobortis.quam@adipiscingMauris.ca', 'abwd1234', '1573211573_IMG_0420.JPG'),
(40, 'Tad', 'Valentine', 'arcu.Vestibulum@facilisis.net', 'abdd1234', '1573211573_IMG_0420.JPG'),
(41, 'George', 'Holder', 'libero@litora.com', 'abmd1234', '1573211573_IMG_0420.JPG'),
(42, 'Xenos', 'Cortez', 'Suspendisse.sed@Vestibulumante.co.uk', 'abdd1234', '1573211573_IMG_0420.JPG'),
(43, 'Ruth', 'Clay', 'Nunc.laoreet@Aliquam.net', 'abcd1234', '1573211573_IMG_0420.JPG'),
(44, 'Gannon', 'Cotton', 'mollis.Duis@hendreritneque.org', 'abfd1234', '1573211573_IMG_0420.JPG'),
(45, 'Xena', 'Vang', 'pede.blandit@idrisus.edu', 'abgd1234', '1573211573_IMG_0420.JPG'),
(46, 'Tyrone', 'Russell', 'sit.amet@loremfringillaornare.edu', 'abrd1234', '1573211573_IMG_0420.JPG'),
(47, 'Kendall', 'Gonzales', 'facilisis.lorem@luctusCurabitur.com', 'abjd1234', '1573211573_IMG_0420.JPG'),
(48, 'Tamara', 'Casey', 'tristique.pharetra@bibendum.ca', 'abnd1234', '1573211573_IMG_0420.JPG'),
(49, 'Xerxes', 'Estes', 'Sed@cubiliaCurae.ca', 'abpd1234', '1573211573_IMG_0420.JPG'),
(50, 'Xerxes', 'Greene', 'Duis.dignissim@sociosquadlitora.co.uk', 'abzd1234', '1573211573_IMG_0420.JPG'),
(51, 'Gil', 'Floyd', 'et.arcu@duinec.co.uk', 'abzd1234', '1573211573_IMG_0420.JPG'),
(52, 'Asher', 'Knox', 'nisi.sem.semper@conguea.ca', 'abcd1234', '1573211573_IMG_0420.JPG'),
(53, 'Hayley', 'Ferrell', 'dolor.sit@Fuscemilorem.co.uk', 'abld1234', '1573211573_IMG_0420.JPG'),
(54, 'Brianna', 'Gould', 'libero@ac.ca', 'abhd1234', '1573211573_IMG_0420.JPG'),
(55, 'Todd', 'Perez', 'Donec.porttitor.tellus@posuere.edu', 'abxd1234', '1573211573_IMG_0420.JPG'),
(56, 'Tyler', 'Velazquez', 'diam.Sed.diam@Sedneque.org', 'abwd1234', '1573211573_IMG_0420.JPG'),
(57, 'Ivor', 'Brennan', 'volutpat.ornare.facilisis@eu.ca', 'abbd1234', '1573211573_IMG_0420.JPG'),
(58, 'Allen', 'Rodriguez', 'Fusce.aliquam.enim@velitPellentesqueultricies.ca', 'abxd1234', '1573211573_IMG_0420.JPG'),
(59, 'Cain', 'Green', 'accumsan.interdum@Proin.com', 'abfd1234', '1573211573_IMG_0420.JPG'),
(60, 'Emmanuel', 'Kim', 'odio@euismod.org', 'abnd1234', '1573211573_IMG_0420.JPG'),
(61, 'Glenna', 'Walters', 'erat.volutpat@eu.edu', 'abhd1234', '1573211573_IMG_0420.JPG'),
(62, 'Gwendolyn', 'Odom', 'egestas.ligula.Nullam@tellusjustosit.ca', 'abgd1234', '1573211573_IMG_0420.JPG'),
(63, 'Hyatt', 'Nieves', 'Aenean.gravida@quisurnaNunc.net', 'abmd1234', '1573211573_IMG_0420.JPG'),
(64, 'Maxwell', 'Carey', 'erat.nonummy.ultricies@atnisi.co.uk', 'abwd1234', '1573211573_IMG_0420.JPG'),
(65, 'Asher', 'Richard', 'cubilia.Curae@Donec.org', 'abwd1234', '1573211573_IMG_0420.JPG'),
(66, 'Felicia', 'Anthony', 'risus.at.fringilla@montesnascetur.com', 'abvd1234', '1573211573_IMG_0420.JPG'),
(67, 'Lamar', 'Lyons', 'nec.urna@idante.com', 'abwd1234', '1573211573_IMG_0420.JPG'),
(68, 'Mari', 'Becker', 'semper.et@ligula.net', 'abyd1234', '1573211573_IMG_0420.JPG'),
(69, 'Dominique', 'Harrell', 'Donec.luctus.aliquet@luctus.org', 'abkd1234', '1573211573_IMG_0420.JPG'),
(70, 'Rashad', 'Alvarado', 'tristique@elitEtiamlaoreet.com', 'absd1234', '1573211573_IMG_0420.JPG'),
(71, 'Grant', 'Alford', 'Morbi.accumsan.laoreet@a.edu', 'abjd1234', '1573211573_IMG_0420.JPG'),
(72, 'Quyn', 'Barnes', 'magna.tellus.faucibus@milorem.edu', 'abhd1234', '1573211573_IMG_0420.JPG'),
(73, 'Oleg', 'Marks', 'lectus@variusNam.co.uk', 'abld1234', '1573211573_IMG_0420.JPG'),
(74, 'Vanna', 'Ellis', 'enim.Curabitur@tincidunt.net', 'abtd1234', '1573211573_IMG_0420.JPG'),
(75, 'Destiny', 'House', 'eleifend.nunc.risus@egetlacus.co.uk', 'abdd1234', '1573211573_IMG_0420.JPG'),
(76, 'Leroy', 'Parks', 'Duis@PhasellusornareFusce.net', 'abkd1234', '1573211573_IMG_0420.JPG'),
(77, 'Janna', 'Barrera', 'sit@eratsemper.co.uk', 'abyd1234', '1573211573_IMG_0420.JPG'),
(78, 'Rhea', 'Nolan', 'nec@tempusrisusDonec.com', 'abhd1234', '1573211573_IMG_0420.JPG'),
(79, 'Daphne', 'Grant', 'adipiscing@congue.net', 'abld1234', '1573211573_IMG_0420.JPG'),
(80, 'Rinah', 'Frye', 'at@nondui.edu', 'abwd1234', '1573211573_IMG_0420.JPG'),
(81, 'Christen', 'Vaughan', 'vitae@ornare.ca', 'abgd1234', '1573211573_IMG_0420.JPG'),
(82, 'Uriah', 'Massey', 'molestie@Morbi.ca', 'abjd1234', '1573211573_IMG_0420.JPG'),
(83, 'Deirdre', 'Velez', 'magna.Lorem@turpisegestas.edu', 'abgd1234', '1573211573_IMG_0420.JPG'),
(84, 'Lynn', 'Jacobson', 'ac.nulla.In@interdum.co.uk', 'abld1234', '1573211573_IMG_0420.JPG'),
(85, 'Blake', 'Erickson', 'placerat.velit@risusodio.net', 'abpd1234', '1573211573_IMG_0420.JPG'),
(86, 'Talon', 'Browning', 'dictum.ultricies@vel.net', 'abxd1234', '1573211573_IMG_0420.JPG'),
(87, 'Alexander', 'Roth', 'placerat@nisl.edu', 'abmd1234', '1573211573_IMG_0420.JPG'),
(88, 'Ruth', 'Coleman', 'erat.eget@faucibusorci.ca', 'abrd1234', '1573211573_IMG_0420.JPG'),
(89, 'Forrest', 'Craig', 'auctor.velit@afacilisis.co.uk', 'abhd1234', '1573211573_IMG_0420.JPG'),
(90, 'Aimee', 'Mcdonald', 'sit.amet@in.org', 'abpd1234', '1573211573_IMG_0420.JPG'),
(91, 'Wylie', 'Gilbert', 'aliquam@PhasellusornareFusce.edu', 'abcd1234', '1573211573_IMG_0420.JPG'),
(92, 'Leo', 'Short', 'dictum.Phasellus.in@orciquislectus.co.uk', 'abpd1234', '1573211573_IMG_0420.JPG'),
(93, 'Kenneth', 'Gross', 'adipiscing@loremipsumsodales.co.uk', 'abkd1234', '1573211573_IMG_0420.JPG'),
(94, 'Hayden', 'Mclean', 'Fusce@eueuismod.edu', 'abqd1234', '1573211573_IMG_0420.JPG'),
(95, 'Florence', 'Horton', 'vel.pede@velitegestaslacinia.edu', 'abvd1234', '1573211573_IMG_0420.JPG'),
(96, 'Kai', 'Fowler', 'egestas@Phaselluslibero.org', 'abrd1234', '1573211573_IMG_0420.JPG'),
(97, 'Belle', 'Terrell', 'parturient@Suspendissenonleo.net', 'abrd1234', '1573211573_IMG_0420.JPG'),
(98, 'Alexis', 'Boyd', 'velit.Pellentesque@nonarcu.ca', 'abmd1234', '1573211573_IMG_0420.JPG'),
(99, 'May', 'Morin', 'conubia@fermentumconvallisligula.ca', 'abxd1234', '1573211573_IMG_0420.JPG'),
(100, 'Tucker', 'Cleveland', 'gravida@dignissimMaecenasornare.org', 'abgd1234', '1573211573_IMG_0420.JPG'),
(101, 'Rylee', 'Mccormick', 'lacus.Aliquam@habitant.org', 'abwd1234', '1573211573_IMG_0420.JPG'),
(102, 'Anastasia', 'Owen', 'Aenean.egestas.hendrerit@libero.co.uk', 'abjd1234', '1573211573_IMG_0420.JPG'),
(103, 'Adara', 'Moon', 'arcu@sitametconsectetuer.org', 'abzd1234', '1573211573_IMG_0420.JPG'),
(104, 'Howard', 'Lindsay', 'elit.pretium.et@augue.edu', 'abtd1234', '1573211573_IMG_0420.JPG'),
(105, 'Damon', 'Lynch', 'blandit@Donecnonjusto.net', 'abgd1234', '1573211573_IMG_0420.JPG'),
(106, 'Mark', 'Mcknight', 'Sed.auctor@sapienCras.com', 'abkd1234', '1573211573_IMG_0420.JPG'),
(107, 'Mollie', 'Ray', 'dictum.augue.malesuada@vitaesemper.co.uk', 'abwd1234', '1573211573_IMG_0420.JPG'),
(108, 'Elijah', 'Wolf', 'ornare.In.faucibus@fermentumarcu.edu', 'abnd1234', '1573211573_IMG_0420.JPG'),
(109, 'Flynn', 'Holden', 'nunc.ac@risusodioauctor.org', 'abvd1234', '1573211573_IMG_0420.JPG'),
(110, 'Tyrone', 'Adkins', 'nunc.interdum@nuncidenim.edu', 'abld1234', '1573211573_IMG_0420.JPG'),
(111, 'Karina', 'Wooten', 'Curabitur.ut@parturient.net', 'abtd1234', '1573211573_IMG_0420.JPG'),
(112, 'Jack', 'Frost', 'nunc.sed.libero@miloremvehicula.co.uk', 'abkd1234', '1573211573_IMG_0420.JPG'),
(113, 'Gage', 'Dotson', 'senectus.et.netus@tellusjusto.org', 'abpd1234', '1573211573_IMG_0420.JPG'),
(114, 'Justina', 'Mcknight', 'hendrerit.a@ligulaNullamenim.edu', 'abyd1234', '1573211573_IMG_0420.JPG'),
(115, 'Zane', 'Mccormick', 'quam.a.felis@malesuada.edu', 'abxd1234', '1573211573_IMG_0420.JPG'),
(116, 'Kevin', 'Joyner', 'fringilla.cursus.purus@ipsumnonarcu.org', 'abzd1234', '1573211573_IMG_0420.JPG'),
(117, 'Chantale', 'Powell', 'sapien@ametfaucibus.edu', 'abbd1234', '1573211573_IMG_0420.JPG'),
(118, 'Tanner', 'Barrera', 'Proin.dolor@ametante.ca', 'abjd1234', '1573211573_IMG_0420.JPG');

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
  MODIFY `BookingID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `country`
--
ALTER TABLE `country`
  MODIFY `CountryID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `language`
--
ALTER TABLE `language`
  MODIFY `LanguageID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=75;

--
-- AUTO_INCREMENT for table `state`
--
ALTER TABLE `state`
  MODIFY `StateID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `tour`
--
ALTER TABLE `tour`
  MODIFY `TourID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `tourimage`
--
ALTER TABLE `tourimage`
  MODIFY `TourImgID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT for table `tourreview`
--
ALTER TABLE `tourreview`
  MODIFY `TourReviewID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `UserID` int(16) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=119;

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
  ADD CONSTRAINT `tourimage_ibfk_2` FOREIGN KEY (`AddedByUser`) REFERENCES `user` (`UserID`) ON DELETE CASCADE;

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
