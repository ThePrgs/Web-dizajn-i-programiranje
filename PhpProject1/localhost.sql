-- phpMyAdmin SQL Dump
-- version 4.5.4.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: May 26, 2021 at 04:27 PM
-- Server version: 5.5.62-0+deb8u1
-- PHP Version: 7.2.25-1+0~20191128.32+debian8~1.gbp108445

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `WebDiP2020x073`
--
CREATE DATABASE IF NOT EXISTS `WebDiP2020x073` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `WebDiP2020x073`;

-- --------------------------------------------------------

--
-- Table structure for table `arhitekt`
--

CREATE TABLE IF NOT EXISTS `arhitekt` (
  `arhitekt_id` int(11) NOT NULL,
  `arhitekt_ime` varchar(45) NOT NULL,
  `arhitekt_prezime` varchar(45) NOT NULL,
  `arhitekt_godinaRodjenja` int(11) NOT NULL,
  `arhitekt_godinaSmrti` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `arhitekt`
--

INSERT INTO `arhitekt` (`arhitekt_id`, `arhitekt_ime`, `arhitekt_prezime`, `arhitekt_godinaRodjenja`, `arhitekt_godinaSmrti`) VALUES
(1, 'Ludwig Miles', 'van der Rohe', 1886, 1969),
(2, 'Michael', 'Graves', 1934, 2015),
(3, 'Earo', 'Saarinen', 1910, 1961),
(4, 'Cesar', 'Pelli', 1926, 2019),
(5, 'Zaha', 'Hadid', 1950, 2016),
(6, 'Frank Lloyd', 'Wright', 1867, 1959);

-- --------------------------------------------------------

--
-- Table structure for table `dnevnik`
--

CREATE TABLE IF NOT EXISTS `dnevnik` (
  `dnevnik_id` int(11) NOT NULL,
  `dnevnik_korisnik` varchar(45) DEFAULT NULL,
  `dnevnik_vrijeme` timestamp NULL DEFAULT NULL,
  `dnevnik_preglednik` varchar(45) DEFAULT NULL,
  `dnevnik_izmjena` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `dnevnik`
--

INSERT INTO `dnevnik` (`dnevnik_id`, `dnevnik_korisnik`, `dnevnik_vrijeme`, `dnevnik_preglednik`, `dnevnik_izmjena`) VALUES
(1, 'admin', '2021-04-05 10:32:00', 'Firefox', 'Dodan moderator na Chicago'),
(2, 'Admin', '2021-04-14 11:42:00', 'Firefox', 'Dodan moderator na Kentucky'),
(3, 'Pero', '2021-04-15 09:30:00', 'Chrome', 'Obavljen zahtjev 1'),
(4, 'Slavko', '2021-04-14 05:40:00', 'Chrome', 'Obavljen zahtjev 4'),
(5, 'Matej', '2021-04-14 07:18:00', 'Chrome', 'Poslan zahtjev 2'),
(6, 'Viktor', '2021-04-14 06:17:00', 'Firefox', 'Poslan zahtjev 3');

-- --------------------------------------------------------

--
-- Table structure for table `gradevina`
--

CREATE TABLE IF NOT EXISTS `gradevina` (
  `gradevina_id` int(11) NOT NULL,
  `gradevina_arhitekt` int(11) NOT NULL,
  `gradjevina_stil` int(11) NOT NULL,
  `gradevina_lokacija` int(11) NOT NULL,
  `naziv_gradevine` varchar(30) NOT NULL,
  `gradevina_visinaUMetrima` int(11) NOT NULL,
  `gradevina_tip` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `gradevina`
--

INSERT INTO `gradevina` (`gradevina_id`, `gradevina_arhitekt`, `gradjevina_stil`, `gradevina_lokacija`, `naziv_gradevine`, `gradevina_visinaUMetrima`, `gradevina_tip`) VALUES
(1, 1, 1, 2, 'Villa Wolf', 12, 'Stanbena'),
(2, 2, 2, 3, 'Humana Building', 127, 'Poslovna'),
(3, 3, 1, 4, 'Athens Airport', 42, 'Poslovna'),
(4, 4, 2, 5, 'Petronas Towers', 451, 'Poslovna'),
(5, 5, 3, 6, 'Phaeno Science Center', 32, 'Poslovna'),
(6, 6, 6, 1, 'Wright Home and Studio', 16, 'Stanbena');

-- --------------------------------------------------------

--
-- Table structure for table `korisnik`
--

CREATE TABLE IF NOT EXISTS `korisnik` (
  `korisnik_id` int(11) NOT NULL,
  `tipkorisnika_id` int(11) NOT NULL,
  `korisnik_email` varchar(45) NOT NULL,
  `korisnik_naziv` varchar(45) NOT NULL,
  `korisnik_lozinka` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `korisnik`
--

INSERT INTO `korisnik` (`korisnik_id`, `tipkorisnika_id`, `korisnik_email`, `korisnik_naziv`, `korisnik_lozinka`) VALUES
(1, 1, 'admin@mail.com', 'admin', 'admin'),
(2, 2, 'moderator1@mail.com', 'Pero', '1234'),
(3, 2, 'moderator2@mail.com', 'Slavko', '4321'),
(4, 3, 'rkorisnik1@mail.com', 'Josip', '1111'),
(5, 3, 'rkorisnik2@mail.com', 'Matej', '4444'),
(6, 3, 'rkorisnik3@mail.com', 'Viktor', '3333');

-- --------------------------------------------------------

--
-- Table structure for table `lokacija`
--

CREATE TABLE IF NOT EXISTS `lokacija` (
  `lokacija_id` int(11) NOT NULL,
  `lokacija_korisnik` int(11) NOT NULL,
  `lokacija_grad` varchar(45) NOT NULL,
  `lokacija_drzava` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `lokacija`
--

INSERT INTO `lokacija` (`lokacija_id`, `lokacija_korisnik`, `lokacija_grad`, `lokacija_drzava`) VALUES
(1, 2, 'Chicago', 'SAD'),
(2, 2, 'Gubin', 'Poljska'),
(3, 2, 'Kentucky', 'SAD'),
(4, 3, 'Atena', 'Grcka'),
(5, 3, 'Kuala Lampur', 'Malasia'),
(6, 3, 'Wolfsburg', 'Njemacka');

-- --------------------------------------------------------

--
-- Table structure for table `materijal`
--

CREATE TABLE IF NOT EXISTS `materijal` (
  `materijal_id` int(11) NOT NULL,
  `materijal_gradjevina` int(11) NOT NULL,
  `materijal_naziv` varchar(45) NOT NULL,
  `materijal_boja` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `materijal`
--

INSERT INTO `materijal` (`materijal_id`, `materijal_gradjevina`, `materijal_naziv`, `materijal_boja`) VALUES
(1, 1, 'Kamen', 'Siva'),
(2, 2, 'Staklo', 'Prozirna'),
(3, 3, 'Zeljezo', 'Siva'),
(4, 4, 'Mramor', 'Bijela'),
(5, 5, 'Granit', 'Crni'),
(6, 6, 'Drvo', 'Smede');

-- --------------------------------------------------------

--
-- Table structure for table `statistika`
--

CREATE TABLE IF NOT EXISTS `statistika` (
  `statistika_id` int(11) NOT NULL,
  `statistika_lokacija` int(11) NOT NULL,
  `statistika_brojZnamenitosi` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `statistika`
--

INSERT INTO `statistika` (`statistika_id`, `statistika_lokacija`, `statistika_brojZnamenitosi`) VALUES
(1, 1, 1),
(2, 2, 1),
(3, 3, 1),
(4, 4, 1),
(5, 5, 1),
(6, 6, 1);

-- --------------------------------------------------------

--
-- Table structure for table `stil`
--

CREATE TABLE IF NOT EXISTS `stil` (
  `stil_id` int(11) NOT NULL,
  `stil_naziv` varchar(45) NOT NULL,
  `stil_razdoblje` varchar(45) NOT NULL,
  `stil_opis` varchar(250) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `stil`
--

INSERT INTO `stil` (`stil_id`, `stil_naziv`, `stil_razdoblje`, `stil_opis`) VALUES
(1, 'Modernizam', '19. do 20. stoljeca', 'abstrakno, jednostavnost, izostanak ukrasa.'),
(2, 'Postmodernizam', '20. stoljece do dns', 'geometrija, uklapanje u prirodu'),
(3, 'Renesansa', '15. do 17. stoljeca', 'simetrija, harmonija, sklad, geometrija'),
(4, 'Barok', '16. do 18. stoljeca', 'stupovi, lukovi, nise, volute'),
(5, 'Viktorijanska', '19. do 20. stoljeca', 'ozivljavanja povjesnih stilova'),
(6, 'Gotika', '12. do 15. stoljece', 'siljasti luk, rebrasti svod');

-- --------------------------------------------------------

--
-- Table structure for table `tipkorisnika`
--

CREATE TABLE IF NOT EXISTS `tipkorisnika` (
  `tipkorisnika_id` int(11) NOT NULL,
  `tipkorisnika_naziv` varchar(45) NOT NULL,
  `tipkorisnika_status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tipkorisnika`
--

INSERT INTO `tipkorisnika` (`tipkorisnika_id`, `tipkorisnika_naziv`, `tipkorisnika_status`) VALUES
(1, 'administrator', 1),
(2, 'moderator', 2),
(3, 'registrirani korisnik', 3),
(4, 'neregistrirani korisnik', 4);

-- --------------------------------------------------------

--
-- Table structure for table `zahtjev`
--

CREATE TABLE IF NOT EXISTS `zahtjev` (
  `zahtjev_id` int(11) NOT NULL,
  `zahtjev_lokacija` int(11) NOT NULL,
  `zahtjev_korisnik` int(11) NOT NULL,
  `zahtjev_naziv` varchar(45) NOT NULL,
  `zahtjev_status` varchar(15) NOT NULL,
  `zahtjev_opis` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `zahtjev`
--

INSERT INTO `zahtjev` (`zahtjev_id`, `zahtjev_lokacija`, `zahtjev_korisnik`, `zahtjev_naziv`, `zahtjev_status`, `zahtjev_opis`) VALUES
(1, 2, 4, 'Dodavanje Villa Wolf', 'Odraden', 'Dodavanje Villa Wolfa u grad Gubin'),
(2, 1, 4, 'Dodavanje North Riversidea', 'Na cekanju', 'Dodavanje North Riversidea u grad Chicago'),
(3, 3, 6, 'Korekcija imena', 'Odraden', 'Promjena imena za Science Centar'),
(4, 4, 4, 'Promjena stila', 'Odraden', 'Postaviti stil na postmodernizam'),
(5, 6, 5, 'Dodavanje gradevine', 'Na cekanju', 'Dodavanje Porsche Pavilion-a u grad Wolfsburg'),
(6, 1, 5, 'Promjena imena', 'Odraden', 'Promjena Home u Home and Studio');

