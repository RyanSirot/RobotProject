-- phpMyAdmin SQL Dump
-- version 4.6.3
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Feb 14, 2017 at 08:40 AM
-- Server version: 5.7.13
-- PHP Version: 7.0.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `todo`
--

-- --------------------------------------------------------

--
-- Table structure for table `parts`
--

DROP TABLE IF EXISTS `parts`;
CREATE TABLE `parts` (
  `id` varchar(6) NOT NULL PRIMARY KEY,
  `model` varchar(2) DEFAULT NULL,
  `pieceId` int(1) DEFAULT NULL,
  `plant` varchar(10) DEFAULT NULL,
  `stamp` timestamp NOT NULL,

  `partName` varchar(5) DEFAULT NULL,
  `line` varchar(60) DEFAULT NULL,
  `pieceName` varchar(60) DEFAULT NULL,
  `pic` varchar(60) DEFAULT NULL,
  `status` int(1) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- insert one items
INSERT parts VALUES("259b6c","r",1,"lemon", "2017-03-29 17:15:07", "R1", "household", "top", "r1.jpeg", 1);
INSERT parts VALUES("447aac","w",2,"lemon", "2017-03-29 17:11:29", "W2", "butler", "torso", "w2.jpeg", 1);
INSERT parts VALUES("12bbfd","c",3,"lemon", "2017-03-29 17:15:07", "C3", "companion", "bottom", "c3.jpeg", 1);

INSERT parts VALUES("101346","a",1,"lemon", "2017-03-29 17:15:07", "A1", "household", "top", "a1.jpeg", 1);
INSERT parts VALUES("3757b1","b",2,"lemon", "2017-03-29 17:11:29", "B2", "butler", "torso", "b2.jpeg", 1);
INSERT parts VALUES("4aba39","m",3,"lemon", "2017-03-29 17:15:07", "M3", "companion", "bottom", "m3.jpeg", 1);
INSERT parts VALUES("1648d9","m",3,"lemon", "2017-03-29 17:15:07", "M3", "companion", "bottom", "m3.jpeg", 1);


----------------------------------------------------------


--
-- Table structure for table `session`
--

CREATE TABLE IF NOT EXISTS `ci_sessions` (
        `id` varchar(128) NOT NULL,
        `ip_address` varchar(45) NOT NULL,
        `timestamp` int(10) unsigned DEFAULT 0 NOT NULL,
        `data` blob NOT NULL,
        KEY `ci_sessions_timestamp` (`timestamp`)
);
ALTER TABLE ci_sessions ADD PRIMARY KEY (id);

-- --------------------------------------------------------

--
-- Table structure for table `robots`
--

--
-- Table structure for table `Robot`
--
DROP TABLE IF EXISTS `Robot`;
CREATE TABLE `Robot` (
  `id` int(11) NOT NULL,
  `part1CA` varchar(6) NOT NULL,
  `part2CA` varchar(6) NOT NULL,
  `part3CA` varchar(6) NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `price` decimal(10,0) DEFAULT NULL,
  `status` int(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `Robot`
--
--
-- Indexes for dumped tables
--

--
-- Indexes for table `Robot`
--
ALTER TABLE `Robot`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `Robot`
--
ALTER TABLE `Robot`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

INSERT into robot(part1CA, part2CA, part3CA) VALUES ("259b6c","447aac","12bbfd")
-- --------------------------------------------------------
-- 
-- DROP TABLE IF EXISTS `purchasepartsrecords`;
-- CREATE TABLE `purchasepartsrecords` (
--     `id` int(4) NOT NULL PRIMARY KEY,
--     `partonecacode` varchar(8) NOT NULL,
--     `parttwocacode` varchar(8) NOT NULL,
--     `partthreecacode` varchar(8) NOT NULL,
--     `partfourcacode` varchar(8) NOT NULL,
--     `partfivecacode` varchar(8) NOT NULL,
--     `partsixcacode` varchar(8) NOT NULL,
--     `partsevencacode` varchar(8) NOT NULL,
--     `parteightcacode` varchar(8) NOT NULL,
--     `partninecacode` varchar(8) NOT NULL,
--     `parttencacode` varchar(8) NOT NULL,
--     `cost` int(4) NOT NULL,
--     `datetime` timestamp NOT NULL
-- ) ENGINE=InnoDB DEFAULT CHARSET=utf8;
-- 
-- 
-- ALTER TABLE `purchasepartsrecords`
--   MODIFY `id` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;


DROP TABLE IF EXISTS `purchasepartsrecords`;
CREATE TABLE `purchasepartsrecords` (
    `id` int(4) NOT NULL PRIMARY KEY,
    `partonecacode` varchar(8) NOT NULL,
    `parttwocacode` varchar(8) NOT NULL,
    `partthreecacode` varchar(8) NOT NULL,
    `partfourcacode` varchar(8) NOT NULL,
    `partfivecacode` varchar(8) NOT NULL,
    `partsixcacode` varchar(8) NOT NULL,
    `partsevencacode` varchar(8) NOT NULL,
    `parteightcacode` varchar(8) NOT NULL,
    `partninecacode` varchar(8) NOT NULL,
    `parttencacode` varchar(8) NOT NULL,
    `cost` int(4) NOT NULL,
    `datetime` timestamp NOT NULL,
    `transactionID` INT NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

ALTER TABLE `purchasepartsrecords`
  MODIFY `id` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;


ALTER TABLE `purchasepartsrecords` 
    ADD FOREIGN KEY(`transactionID`) REFERENCES `transactions`(`transactionID`) 
    ON DELETE CASCADE ON UPDATE CASCADE;

-- --------------------------------------------------------
DROP TABLE IF EXISTS `transactions`;
CREATE TABLE `transactions` (
  `transactionID` INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `transacType` VARCHAR(45) NOT NULL,
  `transacMoney` DOUBLE NULL,
  `transacDateTime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
)ENGINE=InnoDB DEFAULT CHARSET=utf8;

























-- --------------------------------------------------------

DROP TABLE IF EXISTS `retrievepartsrecords`;
CREATE TABLE `retrievepartsrecords` (
    `id` int(4) NOT NULL PRIMARY KEY,
    `partonecacode` varchar(8) NOT NULL,
    `parttwocacode` varchar(8) DEFAULT NULL,
    `partthreecacode` varchar(8) DEFAULT NULL,
    `partfourcacode` varchar(8) DEFAULT NULL,
    `partfivecacode` varchar(8) DEFAULT NULL,
    `partsixcacode` varchar(8) DEFAULT NULL,
    `partsevencacode` varchar(8) DEFAULT NULL,
    `parteightcacode` varchar(8) DEFAULT NULL,
    `partninecacode` varchar(8) DEFAULT NULL,
    `parttencacode` varchar(8) DEFAULT NULL,
    `datetime` timestamp NOT NULL,
    `transactionID` INT NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


ALTER TABLE `retrievepartsrecords`
  MODIFY `id` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

ALTER TABLE `retrievepartsrecords` 
    ADD FOREIGN KEY(`transactionID`) REFERENCES `transactions`(`transactionID`) 
    ON DELETE CASCADE ON UPDATE CASCADE;

-- --------------------------------------------------------
--
-- Table structure for table `returnpartrecords`
--

DROP TABLE IF EXISTS `returnpartrecords`;
CREATE TABLE `returnpartrecords` (
    `id` int(4) NOT NULL PRIMARY KEY AUTO_INCREMENT,
    `partcacode` varchar(8) NOT NULL,
    `earning` int(4) NOT NULL,
    `datetime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
    `transactionID` INT NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

ALTER TABLE `returnpartrecords`
    ADD FOREIGN KEY(`transactionID`) REFERENCES `transactions`(`transactionID`)
    ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Table structure for table `Account`
--

CREATE TABLE `Account` (
  `id` int(11) NOT NULL,
  `money_spend` decimal(10,0) NOT NULL DEFAULT '0',
  `money_earned` decimal(10,0) NOT NULL DEFAULT '0',
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `Account`
--

INSERT INTO `Account` (`id`, `money_spend`, `money_earned`, `timestamp`) VALUES
  (1, '0', '0', '2017-03-30 04:55:43');

--
-- Indexes for table `Account`
--
ALTER TABLE `Account`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for table `Account`
--
ALTER TABLE `Account`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--

INSERT INTO `Account` ( `money_spend`, `money_earned`) VALUES ( '0', '0');

-- --------------------------------------------------------

--
-- Table structure for table `Token`
--

CREATE TABLE `Token` (
  `id` int(11) NOT NULL,
  `token_session` varchar(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `Token`
--
ALTER TABLE `Token`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `Token`
--
ALTER TABLE `Token`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

INSERT INTO `token` (`token_session`) VALUES ("abcdef");
--
-- Table structure for table `assemblyRecords`
--
DROP TABLE IF EXISTS `assemblyRecords`;
CREATE TABLE `assemblyRecords` (
  `assemblyID` INT(6) NOT NULL AUTO_INCREMENT,
  `partTopCACode` VARCHAR(8) NOT NULL,
  `partBodyCACode` VARCHAR(8) NOT NULL,
  `partBtmCACode` VARCHAR(8) NOT NULL,
  `assemblyDateTime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `assemblyPrice` DOUBLE NOT NULL,
  `robotID` INT NOT NULL,
  `transactionID` INT NOT NULL,
  PRIMARY KEY (`assemblyID`));


ALTER TABLE `assemblyRecords`
    ADD FOREIGN KEY(`transactionID`) REFERENCES `transactions`(`transactionID`)
    ON DELETE CASCADE ON UPDATE CASCADE;
-- --------------------------------------------------------

--
-- Table structure for table `shipmentRecords`
--
DROP TABLE IF EXISTS `shipmentRecords`;
CREATE TABLE `shipmentRecords` (
  `shipmentID` INT(6) NOT NULL AUTO_INCREMENT,
  `shipmentDateTime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `shipmentProfit` DOUBLE NOT NULL,
  `robotID` VARCHAR(6) NOT NULL,
  `transactionID` INT NOT NULL,
  PRIMARY KEY (`shipmentID`));

ALTER TABLE `shipmentRecords`
    ADD FOREIGN KEY(`transactionID`) REFERENCES `transactions`(`transactionID`)
    ON DELETE CASCADE ON UPDATE CASCADE;

  -- alter the Robot table
  ALTER TABLE `Robot` ADD `type` VARCHAR(20) NOT NULL AFTER `status`;

