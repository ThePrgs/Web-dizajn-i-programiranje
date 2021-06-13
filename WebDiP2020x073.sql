-- phpMyAdmin SQL Dump
-- version 4.5.4.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jun 13, 2021 at 07:25 PM
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

-- --------------------------------------------------------

--
-- Table structure for table `dnevnik`
--

CREATE TABLE `dnevnik` (
  `dnevnik_id` int(11) NOT NULL,
  `dnevnik_korisnik` int(11) NOT NULL,
  `dnevnik_vrijeme` timestamp NULL DEFAULT NULL,
  `dnevnik_preglednik` varchar(45) DEFAULT NULL,
  `dnevnik_izmjena` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `dnevnik`
--

INSERT INTO `dnevnik` (`dnevnik_id`, `dnevnik_korisnik`, `dnevnik_vrijeme`, `dnevnik_preglednik`, `dnevnik_izmjena`) VALUES
(1, 1, '2021-04-05 10:32:00', 'Firefox', 'Dodan moderator na Chicago'),
(2, 1, '2021-04-14 11:42:00', 'Firefox', 'Dodan moderator na Kentucky'),
(3, 2, '2021-04-15 09:30:00', 'Chrome', 'Obavljen zahtjev 1'),
(4, 3, '2021-04-14 05:40:00', 'Chrome', 'Obavljen zahtjev 4'),
(5, 5, '2021-04-14 07:18:00', 'Chrome', 'Poslan zahtjev 2'),
(6, 6, '2021-04-14 06:17:00', 'Firefox', 'Poslan zahtjev 3');

-- --------------------------------------------------------

--
-- Table structure for table `gradevina`
--

CREATE TABLE `gradevina` (
  `gradevina_id` int(11) NOT NULL,
  `gradevina_lokacija` int(11) DEFAULT NULL,
  `naziv_gradevine` varchar(30) NOT NULL,
  `gradevina_kreirao` int(11) DEFAULT NULL,
  `gradevina_predlozio` int(11) DEFAULT NULL,
  `gradevina_godina` int(11) DEFAULT NULL,
  `gradevina_opis` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `gradevina`
--

INSERT INTO `gradevina` (`gradevina_id`, `gradevina_lokacija`, `naziv_gradevine`, `gradevina_kreirao`, `gradevina_predlozio`, `gradevina_godina`, `gradevina_opis`) VALUES
(1, 2, 'Villa Wolf', 2, 5, 1926, 'Lociran u srcu Gubina. Humanisticki stil.'),
(2, 3, 'Humana Building', 2, 5, 1985, 'Posthumanisticka gradevina smjestena u Kentuckyu'),
(3, 4, 'Athens Airport', 3, 6, 2001, 'Novoizgradeni dio poznatog aerodroma u Ateni'),
(4, 5, 'Petronas Towers', 3, 6, 1996, 'Jedni od najvisih tornjeva svijeta'),
(5, 6, 'Phaeno Science Center', 3, 5, 2005, 'Visokotehnoloska gradevina smjetena u Wolfsburgu'),
(6, 1, 'Wright Home and Studio', 2, 6, 1889, 'Dom poznatog arhitekta Wrighta'),
(17, 1, 'Chicago Building', 2, 4, 1905, 'Klasicni primjer Chicago skole arhitekture'),
(18, 8, 'Kip Josipa Jelacica', 3, 4, 1993, 'Poznati kip bana Josipa Jelacica'),
(19, 8, 'Tvornica Kulture', 2, 4, 2001, 'Zgrada tvornice kulture smjestena u srcu Zagreba'),
(20, 2, 'Villa Terana', 3, 5, 1993, 'Velika vila smjestena na rubu grada Gubina');

-- --------------------------------------------------------

--
-- Table structure for table `korisnik`
--

CREATE TABLE `korisnik` (
  `korisnik_id` int(11) NOT NULL,
  `tipkorisnika_id` int(11) NOT NULL,
  `korisnik_email` varchar(45) NOT NULL,
  `korisnik_naziv` varchar(45) NOT NULL,
  `korisnik_lozinka` varchar(45) NOT NULL,
  `korisnik_lozinkaSHA` varchar(70) DEFAULT NULL,
  `korisnik_ime` varchar(45) NOT NULL,
  `korisnik_datumRodj` date DEFAULT NULL,
  `korisnik_aktiviran` varchar(10) DEFAULT NULL,
  `korisnik_blokiran` int(11) DEFAULT '0',
  `korisnik_zahtjevBlokiran` int(11) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `korisnik`
--

INSERT INTO `korisnik` (`korisnik_id`, `tipkorisnika_id`, `korisnik_email`, `korisnik_naziv`, `korisnik_lozinka`, `korisnik_lozinkaSHA`, `korisnik_ime`, `korisnik_datumRodj`, `korisnik_aktiviran`, `korisnik_blokiran`, `korisnik_zahtjevBlokiran`) VALUES
(1, 1, 'admin@mail.com', 'admin', 'admin', '8c6976e5b5410415bde908bd4dee15dfb167a9c873fc4bb8a81f6f2ab448a918', 'Prga', '1999-12-10', 'Aktiviran', 0, 0),
(2, 2, 'moderator1@mail.com', 'Pero', '1234', '03ac674216f3e15c761ee1a5e255f067953623c8b388b4459e13f978d7c846f4', 'Pero', '1997-01-01', 'Aktiviran', 0, 0),
(3, 2, 'moderator2@mail.com', 'Slavko', '4321', 'fe2592b42a727e977f055947385b709cc82b16b9a87f88c6abf3900d65d0cdc3', 'Slavko', '1998-02-02', 'Aktiviran', 0, 0),
(4, 3, 'mirkoslavkic10@gmail.com', 'Josip', '1111', '0ffe1abd1a08215353c233d6e009613e95eec4253832a761af28ff37ac5a150c', 'Josip', '1999-10-12', 'Aktiviran', 0, 0),
(5, 3, 'rkorisnik2@mail.com', 'Matej', '4444', '79f06f8fde333461739f220090a23cb2a79f6d714bee100d0e4b4af249294619', 'Matej', '2000-03-03', 'Aktiviran', 0, 0),
(6, 3, 'rkorisnik3@mail.com', 'Viktor', '3333', '79f06f8fde333461739f220090a23cb2a79f6d714bee100d0e4b4af249294619', 'Viktor', '1999-05-28', 'Aktiviran', 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `lokacija`
--

CREATE TABLE `lokacija` (
  `lokacija_id` int(11) NOT NULL,
  `lokacija_korisnik` int(11) DEFAULT NULL,
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
(6, 3, 'Wolfsburg', 'Njemacka'),
(8, 2, 'Zagreb', 'Hrvatska'),
(10, 2, 'New York', 'SAD'),
(11, 3, 'Sydney', 'Australija'),
(12, 2, 'Tokyo', 'Japan');

-- --------------------------------------------------------

--
-- Table structure for table `materijal`
--

CREATE TABLE `materijal` (
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
-- Table structure for table `prijedlog`
--

CREATE TABLE `prijedlog` (
  `prijedlog_id` int(11) NOT NULL,
  `prijedlog_grad` int(11) NOT NULL,
  `prijedlog_naziv` varchar(45) NOT NULL,
  `prijedlog_opis` varchar(45) NOT NULL,
  `prijedlog_ime` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `prijedlog`
--

INSERT INTO `prijedlog` (`prijedlog_id`, `prijedlog_grad`, `prijedlog_naziv`, `prijedlog_opis`, `prijedlog_ime`) VALUES
(4, 1, 'Kip Goliata', 'Kip smjesten na trgu Chicaga', 'Marko'),
(5, 4, 'Partananon', 'Gradevina smjestena u srcu Atene', 'Ana'),
(6, 2, 'Gubin knjiznica', 'Javna knjiznica grada Gubina', 'Kreso'),
(7, 3, 'Farma obitelji Dwight', 'Velika farma obitelji Dwight', ''),
(9, 8, 'Kip kralja Tomislava', 'Kip kralja Tomislava na trgu kralja Tomislava', 'Karla'),
(10, 12, 'Hian Tu Toranj', 'Tradicionalni toranj na rubu Tokya', ''),
(11, 11, 'Sydney Operna Dvorana', 'Poznata operna dvorana Sydneya', 'Jakov'),
(12, 10, 'Trade Center', 'Poznati toranj New Yorka', 'Ivo'),
(13, 10, 'Central Park', 'Poznati park ', 'Kristijan'),
(14, 12, 'Trg Hin Ru', 'Veliki trg u centru Tokya', '');

-- --------------------------------------------------------

--
-- Table structure for table `tipkorisnika`
--

CREATE TABLE `tipkorisnika` (
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

CREATE TABLE `zahtjev` (
  `zahtjev_id` int(11) NOT NULL,
  `zahtjev_lokacija` int(11) NOT NULL,
  `zahtjev_korisnik` int(11) NOT NULL,
  `zahtjev_naziv` varchar(45) NOT NULL,
  `zahtjev_status` varchar(15) NOT NULL,
  `zahtjev_opis` varchar(100) NOT NULL,
  `zahtjev_godina` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `zahtjev`
--

INSERT INTO `zahtjev` (`zahtjev_id`, `zahtjev_lokacija`, `zahtjev_korisnik`, `zahtjev_naziv`, `zahtjev_status`, `zahtjev_opis`, `zahtjev_godina`) VALUES
(1, 2, 4, 'Villa Wolf', 'Potvrdeno', 'Jedan od prvih primjera moderna arhitekture u Europi', '1926'),
(2, 1, 4, 'Chicago Building', 'Potvrdeno', 'Klasicni primjer Chicago skole arhitekture', '1905'),
(3, 3, 6, 'Menara Telekom', 'Na cekanju', '310m visoka konstrukcija moderne arhitektue.', '2001'),
(4, 5, 4, 'Athens Hilton', 'Na cekanju', 'Luksuzni hotel, 7 katova, klasnicni i modernisticki stil', '1963'),
(5, 6, 5, 'Porche Pavilion', 'Potvrdeno', 'Porche Pavilion djelo moderne arhitekture', '2012'),
(6, 5, 5, 'Acropolis Muzej', 'Na cekanju', 'Novi parthenon, prikazuje artefakte anticke grcke', '2009'),
(15, 12, 3, 'Tokyo Central Library', 'Potvrdeno', 'Knjiznica Tokyia', '1994'),
(16, 10, 3, 'Central Perk', 'Odbijeno', 'Poznati kafic u dnu zgrade Gurban', '1995'),
(17, 11, 3, 'Beach Hub', 'Odbijeno', 'Visoko posjeceni beach hub na plazi', '2010'),
(18, 10, 3, 'Kip Slobode', 'Potvrdeno', 'Poznati kip slobode na obali New Yorka', '1842');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `dnevnik`
--
ALTER TABLE `dnevnik`
  ADD PRIMARY KEY (`dnevnik_id`),
  ADD KEY `dnevnik_korisnik_fk_idx` (`dnevnik_korisnik`);

--
-- Indexes for table `gradevina`
--
ALTER TABLE `gradevina`
  ADD PRIMARY KEY (`gradevina_id`),
  ADD KEY `lokacija_fk_idx` (`gradevina_lokacija`),
  ADD KEY `korisnik_kreirao_fk_idx` (`gradevina_kreirao`),
  ADD KEY `korisnik_zahtjev_fk` (`gradevina_predlozio`);

--
-- Indexes for table `korisnik`
--
ALTER TABLE `korisnik`
  ADD PRIMARY KEY (`korisnik_id`,`tipkorisnika_id`),
  ADD KEY `tipkorisnika_fk_idx` (`tipkorisnika_id`);

--
-- Indexes for table `lokacija`
--
ALTER TABLE `lokacija`
  ADD PRIMARY KEY (`lokacija_id`),
  ADD KEY `korisnik_id_idx` (`lokacija_korisnik`);

--
-- Indexes for table `materijal`
--
ALTER TABLE `materijal`
  ADD PRIMARY KEY (`materijal_id`,`materijal_gradjevina`),
  ADD KEY `gradjevina_fk_idx` (`materijal_gradjevina`);

--
-- Indexes for table `prijedlog`
--
ALTER TABLE `prijedlog`
  ADD PRIMARY KEY (`prijedlog_id`),
  ADD KEY `prijedlog_grad_fk_idx` (`prijedlog_grad`);

--
-- Indexes for table `tipkorisnika`
--
ALTER TABLE `tipkorisnika`
  ADD PRIMARY KEY (`tipkorisnika_id`);

--
-- Indexes for table `zahtjev`
--
ALTER TABLE `zahtjev`
  ADD PRIMARY KEY (`zahtjev_id`,`zahtjev_lokacija`,`zahtjev_korisnik`),
  ADD KEY `lokacija_fk_idx` (`zahtjev_lokacija`),
  ADD KEY `korisnik_fk_idx` (`zahtjev_korisnik`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `dnevnik`
--
ALTER TABLE `dnevnik`
  MODIFY `dnevnik_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `gradevina`
--
ALTER TABLE `gradevina`
  MODIFY `gradevina_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;
--
-- AUTO_INCREMENT for table `korisnik`
--
ALTER TABLE `korisnik`
  MODIFY `korisnik_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;
--
-- AUTO_INCREMENT for table `lokacija`
--
ALTER TABLE `lokacija`
  MODIFY `lokacija_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
--
-- AUTO_INCREMENT for table `materijal`
--
ALTER TABLE `materijal`
  MODIFY `materijal_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `prijedlog`
--
ALTER TABLE `prijedlog`
  MODIFY `prijedlog_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
--
-- AUTO_INCREMENT for table `tipkorisnika`
--
ALTER TABLE `tipkorisnika`
  MODIFY `tipkorisnika_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `zahtjev`
--
ALTER TABLE `zahtjev`
  MODIFY `zahtjev_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `dnevnik`
--
ALTER TABLE `dnevnik`
  ADD CONSTRAINT `dnevnik_korisnik_fk` FOREIGN KEY (`dnevnik_korisnik`) REFERENCES `korisnik` (`korisnik_id`);

--
-- Constraints for table `gradevina`
--
ALTER TABLE `gradevina`
  ADD CONSTRAINT `korisnik_kreirao_fk` FOREIGN KEY (`gradevina_kreirao`) REFERENCES `korisnik` (`korisnik_id`),
  ADD CONSTRAINT `korisnik_zahtjev_fk` FOREIGN KEY (`gradevina_predlozio`) REFERENCES `korisnik` (`korisnik_id`),
  ADD CONSTRAINT `lokacija_fk` FOREIGN KEY (`gradevina_lokacija`) REFERENCES `lokacija` (`lokacija_id`);

--
-- Constraints for table `korisnik`
--
ALTER TABLE `korisnik`
  ADD CONSTRAINT `tipkorisnika_fk` FOREIGN KEY (`tipkorisnika_id`) REFERENCES `tipkorisnika` (`tipkorisnika_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `lokacija`
--
ALTER TABLE `lokacija`
  ADD CONSTRAINT `korisnik_id` FOREIGN KEY (`lokacija_korisnik`) REFERENCES `korisnik` (`korisnik_id`);

--
-- Constraints for table `materijal`
--
ALTER TABLE `materijal`
  ADD CONSTRAINT `gradjevina_fk` FOREIGN KEY (`materijal_gradjevina`) REFERENCES `gradevina` (`gradevina_id`);

--
-- Constraints for table `prijedlog`
--
ALTER TABLE `prijedlog`
  ADD CONSTRAINT `prijedlog_grad_fk` FOREIGN KEY (`prijedlog_grad`) REFERENCES `lokacija` (`lokacija_id`);

--
-- Constraints for table `zahtjev`
--
ALTER TABLE `zahtjev`
  ADD CONSTRAINT `korisnikZahtjev_fk` FOREIGN KEY (`zahtjev_korisnik`) REFERENCES `korisnik` (`korisnik_id`),
  ADD CONSTRAINT `lokacijaZahtjev_fk` FOREIGN KEY (`zahtjev_lokacija`) REFERENCES `lokacija` (`lokacija_id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
