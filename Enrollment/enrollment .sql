-- phpMyAdmin SQL Dump
-- version 3.5.2.2
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Sep 09, 2023 at 08:31 AM
-- Server version: 5.5.27
-- PHP Version: 5.4.7

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `enrollment`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE IF NOT EXISTS `admin` (
  `id` char(20) NOT NULL,
  `password` char(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `password`) VALUES
('mh', '12345');

-- --------------------------------------------------------

--
-- Table structure for table `advisor`
--

CREATE TABLE IF NOT EXISTS `advisor` (
  `AID` char(50) NOT NULL DEFAULT '',
  `SID` char(50) NOT NULL DEFAULT '',
  `session` char(100) NOT NULL DEFAULT '',
  PRIMARY KEY (`AID`,`SID`,`session`),
  KEY `SID` (`SID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `advisor`
--

INSERT INTO `advisor` (`AID`, `SID`, `session`) VALUES
('T-101', '1018120249', 'Spring 2023'),
('T-101', '1018120250', 'Spring 2023'),
('T-101', '1018120251', 'Spring 2023'),
('T-102', '1019120249', 'Spring 2023'),
('T-102', '1019120260', 'Spring 2023');

-- --------------------------------------------------------

--
-- Table structure for table `course`
--

CREATE TABLE IF NOT EXISTS `course` (
  `courseid` char(30) NOT NULL DEFAULT '',
  `title` char(100) DEFAULT NULL,
  `sem` char(10) DEFAULT NULL,
  `credit` float DEFAULT NULL,
  `session` char(50) NOT NULL DEFAULT '',
  PRIMARY KEY (`courseid`,`session`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `course`
--

INSERT INTO `course` (`courseid`, `title`, `sem`, `credit`, `session`) VALUES
('CSE 221', 'Data Structure', '3', 3, 'Spring 2023'),
('CSE 222', 'Data Structure Lab', '3', 1.5, 'Spring 2023'),
('CSE 237', 'Database Management System', '4', 3, 'Spring 2023'),
('CSE 238', 'Database Management System Lab', '4', 1.5, 'Spring 2023');

-- --------------------------------------------------------

--
-- Table structure for table `enroll`
--

CREATE TABLE IF NOT EXISTS `enroll` (
  `SID` char(50) NOT NULL DEFAULT '',
  `courseid` char(30) NOT NULL DEFAULT '',
  `sem` char(10) DEFAULT NULL,
  `session` char(50) NOT NULL DEFAULT '',
  `type` char(30) DEFAULT NULL,
  PRIMARY KEY (`SID`,`courseid`,`session`),
  KEY `courseid` (`courseid`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `enroll`
--

INSERT INTO `enroll` (`SID`, `courseid`, `sem`, `session`, `type`) VALUES
('1018120249', 'CSE 221', '3', 'Spring 2023', 'recourse'),
('1018120249', 'CSE 237', '4', 'Spring 2023', 'regular'),
('1018120249', 'CSE 238', '4', 'Spring 2023', 'recourse');

-- --------------------------------------------------------

--
-- Table structure for table `session`
--

CREATE TABLE IF NOT EXISTS `session` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `status` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `session`
--

INSERT INTO `session` (`id`, `name`, `status`) VALUES
(1, 'fall 2022', 1),
(2, 'Spring 2023', 1);

-- --------------------------------------------------------

--
-- Table structure for table `student`
--

CREATE TABLE IF NOT EXISTS `student` (
  `ID` char(30) NOT NULL,
  `name` varchar(50) DEFAULT NULL,
  `mobileno` int(11) NOT NULL,
  `dept` char(30) NOT NULL,
  `batch` int(11) NOT NULL,
  `pic` varchar(100) DEFAULT NULL,
  `password` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `student`
--

INSERT INTO `student` (`ID`, `name`, `mobileno`, `dept`, `batch`, `pic`, `password`) VALUES
('1018120249', 'Mohammad Hasan', 1921009559, 'CSE', 18, 'ca66f257932ab047b5407940645a6ef3.jpg', '123456'),
('1018120250', 'Rabiul Hasan', 1921009559, 'CSE', 18, '9ad9e0d4aa6c491ec915c216f77b8160.', '123456'),
('1018120251', 'Anik Sen', 1921009559, 'CSE', 18, 'd963c369ed239e1ccb6d8b9f99ddda7c.', '123456'),
('1019120249', 'Shuvo', 1921009559, 'CSE', 19, '39e2025702cbaf150cb50a34f73c59a7.', '123456'),
('1019120260', 'Rasel', 1921009559, 'CSE', 19, '8c999cb6d5b98866c3e0129accc4202a.', '123456');

-- --------------------------------------------------------

--
-- Table structure for table `teacher`
--

CREATE TABLE IF NOT EXISTS `teacher` (
  `tid` varchar(20) NOT NULL,
  `name` varchar(100) NOT NULL,
  `dept` char(30) NOT NULL,
  `designation` varchar(50) NOT NULL,
  `dob` date NOT NULL,
  `pic` varchar(100) DEFAULT NULL,
  `password` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`tid`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `teacher`
--

INSERT INTO `teacher` (`tid`, `name`, `dept`, `designation`, `dob`, `pic`, `password`) VALUES
('T-101', 'Md Hasan', 'CSE', 'Lecturer', '1990-12-12', '86c9c4a83022860caa738af73a1e1e45.jpg', '123456'),
('T-102', 'Md Abdul karim', 'CSE', 'Lecturer', '1990-12-11', '13247d92b5415a09a05b2403242f424b.jpg', '123456');

--
-- Constraints for dumped tables
--

--
-- Constraints for table `advisor`
--
ALTER TABLE `advisor`
  ADD CONSTRAINT `advisor_ibfk_1` FOREIGN KEY (`AID`) REFERENCES `teacher` (`tid`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `advisor_ibfk_2` FOREIGN KEY (`SID`) REFERENCES `student` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `enroll`
--
ALTER TABLE `enroll`
  ADD CONSTRAINT `enroll_ibfk_1` FOREIGN KEY (`courseid`) REFERENCES `course` (`courseid`),
  ADD CONSTRAINT `enroll_ibfk_2` FOREIGN KEY (`SID`) REFERENCES `advisor` (`SID`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
