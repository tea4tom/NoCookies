-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `dev-sandbox-nc`
--

-- --------------------------------------------------------

--
-- Table structure for table `nc_debugs`
--

CREATE TABLE `nc_debugs` (
  `idx` bigint(20) NOT NULL,
  `ts` timestamp NOT NULL DEFAULT current_timestamp(),
  `log` text NOT NULL,
  `flag` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `nc_sessions`
--

CREATE TABLE `nc_sessions` (
  `idx` bigint(20) NOT NULL,
  `sessionid` varchar(50) NOT NULL,
  `ping` bigint(20) NOT NULL,
  `sessionblob` text NOT NULL,
  `os` varchar(20) NOT NULL,
  `browserid` varchar(20) NOT NULL,
  `browserver` double NOT NULL,
  `browserverm` double NOT NULL,
  `browserapp` varchar(20) NOT NULL,
  `browserua` text NOT NULL,
  `logohash` text NOT NULL,
  `logosize` int(11) NOT NULL,
  `colourdepth` double NOT NULL,
  `pixeldepth` double NOT NULL,
  `pixelratio` double NOT NULL,
  `rxavail` int(11) NOT NULL,
  `ryavail` int(11) NOT NULL,
  `rxres` int(11) NOT NULL,
  `ryres` int(11) NOT NULL,
  `rxsize` int(11) NOT NULL,
  `rysize` int(11) NOT NULL,
  `fonts` text NOT NULL,
  `plugins` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `nc_debugs`
--
ALTER TABLE `nc_debugs`
  ADD PRIMARY KEY (`idx`);

--
-- Indexes for table `nc_sessions`
--
ALTER TABLE `nc_sessions`
  ADD PRIMARY KEY (`idx`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `nc_debugs`
--
ALTER TABLE `nc_debugs`
  MODIFY `idx` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `nc_sessions`
--
ALTER TABLE `nc_sessions`
  MODIFY `idx` bigint(20) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
