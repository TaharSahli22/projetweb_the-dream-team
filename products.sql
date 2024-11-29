-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 27, 2024 at 11:20 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `products`
--

-- --------------------------------------------------------

--
-- Table structure for table `produitslist`
--

CREATE TABLE `produitslist` (
  `Idproduit` int(11) NOT NULL,
  `nomproduit` varchar(60) NOT NULL,
  `origin` varchar(60) NOT NULL,
  `prixproduit` int(11) NOT NULL,
  `nbrdisponible` int(11) NOT NULL,
  `imageproduit` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `produitslist`
--

INSERT INTO `produitslist` (`Idproduit`, `nomproduit`, `origin`, `prixproduit`, `nbrdisponible`, `imageproduit`) VALUES
(3, 'Shleka', 'Egypt', 120, 40, '67478c792ed95_slide3.jpg');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `produitslist`
--
ALTER TABLE `produitslist`
  ADD PRIMARY KEY (`Idproduit`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `produitslist`
--
ALTER TABLE `produitslist`
  MODIFY `Idproduit` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
