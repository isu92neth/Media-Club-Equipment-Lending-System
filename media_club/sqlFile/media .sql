-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 10, 2020 at 01:34 PM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.2.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `media`
--

DELIMITER $$
--
-- Procedures
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `delete_event` ()  NO SQL
BEGIN
DELETE
FROM `event`
WHERE `Event Name` IN(SELECT `Event Name` FROM `equipment`
WHERE `Equipment Status` = 'RETURNED');
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `delete_rent` ()  BEGIN
DELETE FROM `rented` WHERE `rented`.`Returned` = 'YES';
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `insert_club_owned` (IN `Eq_Identity` INT, IN `Eq_Donor` VARCHAR(60), IN `Eq_Date` DATE, IN `Eq_Model` VARCHAR(50), IN `Eq_Name` VARCHAR(50))  BEGIN
INSERT INTO `equipment`(`equipment`.`Serial Number`,`equipment`.`Equipment Model`,`equipment`.`Equipment Name`)
VALUES
(Eq_Identity,Eq_Model,Eq_Name);
INSERT INTO `club owned`(`club owned`.`Equipment Identification Number`,`club owned`.`Donor`,`club owned`.`Date Donated`)
VALUES
(Eq_Identity,Eq_Donor,Eq_Date);
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `insert_member_owned` (IN `Eq_Index` INT, IN `Mem_ID` VARCHAR(10), IN `Eq_Model` VARCHAR(50), IN `Eq_Name` VARCHAR(50))  BEGIN
INSERT INTO `equipment`(`equipment`.`Serial Number`,`equipment`.`Equipment Model`,`equipment`.`Equipment Name`)
VALUES
(Eq_Index,Eq_Model,Eq_Name);
INSERT INTO `member owned`(`member owned`.`Equipment Index Number`,`member owned`.`Member ID`)
VALUES
(Eq_Index,Mem_ID);
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `insert_rent` (IN `Eq_Rent_ID` INT, IN `Eq_Ref` INT, IN `Eq_Model` VARCHAR(60), IN `Eq_Name` VARCHAR(50), IN `Rent_Location` VARCHAR(100), IN `Eq_Rent_Fee` DOUBLE, IN `Date_Rent` DATE, IN `Date_to_Return` DATE)  BEGIN
INSERT INTO `equipment`(`Serial Number`,`Equipment Model`,`Equipment Name`)
VALUES
( Eq_Ref,Eq_Model,Eq_Name);
INSERT INTO `rented`(`rented`.`Equipment ID`,`rented`.`Equipment Reference Number`,`rented`.`Place`,`rented`.`Rent Fee(Rs)`,`rented`.`Date Rented`,`rented`.`Return Date`)
VALUES
( Eq_Rent_ID,Eq_Ref, Rent_Location,Eq_Rent_Fee,Date_Rent,Date_to_Return);
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `set_current_event_null` (IN `MemberID` VARCHAR(10))  NO SQL
BEGIN
UPDATE `crew member` 
SET `crew member`.`Current Event` = NULL
WHERE `crew member`.`ID` = MemberID;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `update_after_returned_eq` ()  BEGIN
UPDATE `equipment`
SET `equipment`.`Equipment Status`= 'AVAILABLE',
`equipment`.`Member ID`= NULL,
`equipment`.`Event Name`= NULL
WHERE `equipment`.`Equipment Status` = 'RETURNED';
END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `administator`
--

CREATE TABLE `administator` (
  `Admin Registration Number` varchar(30) NOT NULL,
  `Admin ID` varchar(10) NOT NULL,
  `Post` varchar(45) NOT NULL,
  `Username` varchar(10) NOT NULL,
  `Password` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `administator`
--

INSERT INTO `administator` (`Admin Registration Number`, `Admin ID`, `Post`, `Username`, `Password`) VALUES
('E/15/156', '977461279V', 'Wise President', 'admin', 'admin');

-- --------------------------------------------------------

--
-- Table structure for table `club owned`
--

CREATE TABLE `club owned` (
  `Equipment Identification Number` int(11) NOT NULL,
  `Donor` varchar(50) NOT NULL,
  `Date Donated` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `club owned`
--

INSERT INTO `club owned` (`Equipment Identification Number`, `Donor`, `Date Donated`) VALUES
(2013, 'Mr.Kamal Perera', '2016-05-05'),
(450052, 'Mr Supun Perera', '2018-09-03'),
(5600734, 'Mr Sarath Ekanayake', '2011-09-03'),
(34500712, 'Mr Kamal Silva', '2016-08-03');

--
-- Triggers `club owned`
--
DELIMITER $$
CREATE TRIGGER `delete_eq_club_owned` AFTER DELETE ON `club owned` FOR EACH ROW BEGIN
DELETE FROM `equipment` WHERE `equipment`.`Serial Number` = old.`Equipment Identification Number`;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `crew member`
--

CREATE TABLE `crew member` (
  `Registration Number` varchar(30) NOT NULL,
  `ID` varchar(10) NOT NULL,
  `First Name` varchar(45) NOT NULL,
  `Middle Name` varchar(45) DEFAULT NULL,
  `Last Name` varchar(45) NOT NULL,
  `Faculty` varchar(45) NOT NULL,
  `Current Event` varchar(60) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `crew member`
--

INSERT INTO `crew member` (`Registration Number`, `ID`, `First Name`, `Middle Name`, `Last Name`, `Faculty`, `Current Event`) VALUES
('E/15/156', '977461279V', 'Kasun', 'Chamara', 'Rathnayake', 'Engineering', 'Open Day'),
('E/16/012', '977463335V', 'Isurika', 'Nethmini', 'Adikari', 'Engineering', 'Reach For Water'),
('E/16/290', '977465553V', 'Kalani', NULL, 'Prabhoda', 'Engineering', NULL),
('A/17/233', '977465577V', 'Amali', 'Tharaka', 'Herath', 'Arts', NULL),
('A/18/290', '977488553V', 'Supun', NULL, 'Mudalige', 'Arts', 'Open Day');

-- --------------------------------------------------------

--
-- Table structure for table `equipment`
--

CREATE TABLE `equipment` (
  `Serial Number` int(11) NOT NULL,
  `Equipment Model` varchar(45) NOT NULL,
  `Equipment Name` varchar(45) NOT NULL,
  `Member ID` varchar(10) DEFAULT NULL,
  `Event Name` varchar(60) DEFAULT NULL,
  `Equipment Status` varchar(10) NOT NULL DEFAULT 'AVAILABLE'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `equipment`
--

INSERT INTO `equipment` (`Serial Number`, `Equipment Model`, `Equipment Name`, `Member ID`, `Event Name`, `Equipment Status`) VALUES
(2013, 'Canon 87', 'Camera', NULL, NULL, 'AVAILABLE'),
(230057, 'Nikon D5600', 'Camera', '977461279V', 'Open Day', 'TAKEN'),
(450052, 'Nikon D500', 'Camera', '977461279V', 'Open Day', 'TAKEN'),
(450076, 'Canon EOS 90D', 'Camera', NULL, NULL, 'AVAILABLE'),
(456078, 'Nikon D780', 'Camera', NULL, NULL, 'AVAILABLE'),
(560023, 'Tripod 3120', 'Camera Tripod', NULL, NULL, 'AVAILABLE'),
(560045, 'VCT-5208', 'Camera Tripod', NULL, NULL, 'AVAILABLE'),
(1300786, 'Nikon D850', 'Camera', NULL, NULL, 'AVAILABLE'),
(4500246, 'Nikon D7500', 'Camera', NULL, NULL, 'AVAILABLE'),
(5600734, 'Nikon D850', 'Camera', NULL, NULL, 'AVAILABLE'),
(34500712, 'Canon EOS 7D Mark II', 'Camera', NULL, NULL, 'AVAILABLE');

-- --------------------------------------------------------

--
-- Table structure for table `event`
--

CREATE TABLE `event` (
  `Event Name` varchar(60) NOT NULL,
  `Place` varchar(100) NOT NULL,
  `Start Time` time NOT NULL,
  `EndTime` time NOT NULL,
  `Year` year(4) NOT NULL,
  `Month` int(2) NOT NULL,
  `Day` int(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `event`
--

INSERT INTO `event` (`Event Name`, `Place`, `Start Time`, `EndTime`, `Year`, `Month`, `Day`) VALUES
('Open Day', 'Peradeniya', '08:31:00', '20:00:00', 2013, 3, 5),
('Reach for Water', 'Gatambe grounds, Peradeniya', '10:00:00', '18:00:00', 2020, 7, 4),
('Run for Life', 'Galleface, Colombo', '10:00:00', '17:00:00', 2020, 8, 23);

-- --------------------------------------------------------

--
-- Stand-in structure for view `events`
-- (See below for the actual view)
--
CREATE TABLE `events` (
`Event Name` varchar(60)
,`Venue` varchar(100)
,`Start Time` time
,`End Time` time
,`Year` year(4)
,`Month` int(2)
,`Day` int(2)
,`Member F.Name` varchar(45)
,`Member L.Name` varchar(45)
,`Faculty` varchar(45)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `member`
-- (See below for the actual view)
--
CREATE TABLE `member` (
`MEMBER_NAME` varchar(45)
,`ID` varchar(10)
,`EVENT` varchar(60)
,`EQUIPMENT` varchar(45)
,`SERIAL_NUMBER` int(11)
,`IS_RETUNED` varchar(10)
);

-- --------------------------------------------------------

--
-- Table structure for table `member owned`
--

CREATE TABLE `member owned` (
  `Equipment Index Number` int(11) NOT NULL,
  `Member ID` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `member owned`
--

INSERT INTO `member owned` (`Equipment Index Number`, `Member ID`) VALUES
(450076, '977463335V'),
(1300786, '977463335V'),
(560023, '977465553V'),
(230057, '977465577V');

--
-- Triggers `member owned`
--
DELIMITER $$
CREATE TRIGGER `delete_eq_member_owned` AFTER DELETE ON `member owned` FOR EACH ROW BEGIN 
DELETE FROM `equipment` WHERE `equipment`.`Serial Number`=old.`Equipment Index Number`;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `rented`
--

CREATE TABLE `rented` (
  `Equipment ID` int(11) NOT NULL,
  `Equipment Reference Number` int(11) NOT NULL,
  `Place` varchar(100) NOT NULL,
  `Rent Fee(Rs)` double NOT NULL,
  `Date Rented` date NOT NULL,
  `Return Date` date NOT NULL,
  `Returned` varchar(5) NOT NULL DEFAULT 'NO'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `rented`
--

INSERT INTO `rented` (`Equipment ID`, `Equipment Reference Number`, `Place`, `Rent Fee(Rs)`, `Date Rented`, `Return Date`, `Returned`) VALUES
(23, 560045, 'No.45/76, 1st Lane, Kandy', 4000, '2020-03-02', '2020-08-04', 'NO'),
(52, 4500246, 'No.378a, 2nd Lane, Kandy', 3000, '2020-03-03', '2020-06-02', 'NO'),
(456, 456078, 'No.22b, Peradeniya', 5000, '2019-12-03', '2020-06-04', 'NO');

--
-- Triggers `rented`
--
DELIMITER $$
CREATE TRIGGER `delete_eq_rented` AFTER DELETE ON `rented` FOR EACH ROW BEGIN 
DELETE FROM `equipment` WHERE `equipment`.`Serial Number` = old.`Equipment Reference Number`;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Structure for view `events`
--
DROP TABLE IF EXISTS `events`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `events`  AS  select `event`.`Event Name` AS `Event Name`,`event`.`Place` AS `Venue`,`event`.`Start Time` AS `Start Time`,`event`.`EndTime` AS `End Time`,`event`.`Year` AS `Year`,`event`.`Month` AS `Month`,`event`.`Day` AS `Day`,`crew member`.`First Name` AS `Member F.Name`,`crew member`.`Last Name` AS `Member L.Name`,`crew member`.`Faculty` AS `Faculty` from (`event` left join `crew member` on(`event`.`Event Name` = `crew member`.`Current Event`)) order by `event`.`Year`,`event`.`Month`,`event`.`Day` ;

-- --------------------------------------------------------

--
-- Structure for view `member`
--
DROP TABLE IF EXISTS `member`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `member`  AS  select `crew member`.`First Name` AS `MEMBER_NAME`,`crew member`.`ID` AS `ID`,`crew member`.`Current Event` AS `EVENT`,`equipment`.`Equipment Name` AS `EQUIPMENT`,`equipment`.`Serial Number` AS `SERIAL_NUMBER`,`equipment`.`Equipment Status` AS `IS_RETUNED` from (`crew member` left join `equipment` on(`crew member`.`ID` = `equipment`.`Member ID`)) order by `crew member`.`First Name` ;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `administator`
--
ALTER TABLE `administator`
  ADD PRIMARY KEY (`Admin ID`),
  ADD UNIQUE KEY `Admin Registration Number_UNIQUE` (`Admin Registration Number`),
  ADD UNIQUE KEY `Admin ID_UNIQUE` (`Admin ID`);

--
-- Indexes for table `club owned`
--
ALTER TABLE `club owned`
  ADD PRIMARY KEY (`Equipment Identification Number`),
  ADD UNIQUE KEY `Equipment Identification Number_UNIQUE` (`Equipment Identification Number`);

--
-- Indexes for table `crew member`
--
ALTER TABLE `crew member`
  ADD PRIMARY KEY (`ID`),
  ADD UNIQUE KEY `Registration  Number_UNIQUE` (`Registration Number`),
  ADD UNIQUE KEY `ID_UNIQUE` (`ID`),
  ADD KEY `Current event_idx` (`Current Event`);

--
-- Indexes for table `equipment`
--
ALTER TABLE `equipment`
  ADD PRIMARY KEY (`Serial Number`),
  ADD UNIQUE KEY `Serial Number_UNIQUE` (`Serial Number`),
  ADD KEY `Event name_idx` (`Event Name`),
  ADD KEY `equipment_ibfk_1` (`Member ID`);

--
-- Indexes for table `event`
--
ALTER TABLE `event`
  ADD PRIMARY KEY (`Event Name`),
  ADD UNIQUE KEY `Event Name_UNIQUE` (`Event Name`);

--
-- Indexes for table `member owned`
--
ALTER TABLE `member owned`
  ADD PRIMARY KEY (`Equipment Index Number`),
  ADD UNIQUE KEY `Equipment Index Number_UNIQUE` (`Equipment Index Number`),
  ADD KEY `f2_idx` (`Member ID`);

--
-- Indexes for table `rented`
--
ALTER TABLE `rented`
  ADD PRIMARY KEY (`Equipment ID`),
  ADD UNIQUE KEY `Equipment ID_UNIQUE` (`Equipment ID`),
  ADD KEY `ref number_idx` (`Equipment Reference Number`);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `administator`
--
ALTER TABLE `administator`
  ADD CONSTRAINT `Admin ID` FOREIGN KEY (`Admin ID`) REFERENCES `crew member` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `club owned`
--
ALTER TABLE `club owned`
  ADD CONSTRAINT `Equipment Id` FOREIGN KEY (`Equipment Identification Number`) REFERENCES `equipment` (`Serial Number`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `crew member`
--
ALTER TABLE `crew member`
  ADD CONSTRAINT `Current event` FOREIGN KEY (`Current Event`) REFERENCES `event` (`Event Name`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Constraints for table `equipment`
--
ALTER TABLE `equipment`
  ADD CONSTRAINT `equipment_ibfk_1` FOREIGN KEY (`Member ID`) REFERENCES `crew member` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `equipment_ibfk_2` FOREIGN KEY (`Event Name`) REFERENCES `event` (`Event Name`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Constraints for table `member owned`
--
ALTER TABLE `member owned`
  ADD CONSTRAINT `f1` FOREIGN KEY (`Equipment Index Number`) REFERENCES `equipment` (`Serial Number`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `f2` FOREIGN KEY (`Member ID`) REFERENCES `crew member` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `rented`
--
ALTER TABLE `rented`
  ADD CONSTRAINT `ref number` FOREIGN KEY (`Equipment Reference Number`) REFERENCES `equipment` (`Serial Number`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
