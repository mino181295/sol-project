-- phpMyAdmin SQL Dump
-- version 4.5.2
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jan 31, 2017 at 12:07 
-- Server version: 10.1.16-MariaDB
-- PHP Version: 5.6.24

CREATE DATABASE `myalma`;
USE `myalma`;

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `myalma`
--

-- --------------------------------------------------------

--
-- Table structure for table `assegnamento`
--

CREATE TABLE `assegnamento` (
  `CodiceCorso` char(5) NOT NULL,
  `IDCorsoStudi` char(5) NOT NULL,
  `Docente` varchar(40) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `assegnamento`
--

INSERT INTO `assegnamento` (`CodiceCorso`, `IDCorsoStudi`, `Docente`) VALUES
('14', '1', 'franco.callegati@unibo.it'),
('15', '1', 'franco.callegati@unibo.it'),
('21', '3', 'franco.callegati@unibo.it'),
('22', '3', 'franco.callegati@unibo.it'),
('1', '1', 'stefano.rizzi@unibo.it');

-- --------------------------------------------------------

--
-- Table structure for table `corso`
--

CREATE TABLE `corso` (
  `Codice` char(5) NOT NULL,
  `IDCorsoStudi` char(5) NOT NULL,
  `Denominazione` varchar(40) NOT NULL,
  `Anno` int(1) NOT NULL,
  `Ciclo` int(1) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `corso`
--

INSERT INTO `corso` (`Codice`, `IDCorsoStudi`, `Denominazione`, `Anno`, `Ciclo`) VALUES
('1', '1', 'Ingegneria del software', 3, 1),
('1', '2', 'Statistica Psicometrica', 1, 2),
('2', '1', 'Analisi Matematica', 1, 1),
('3', '1', 'Idoneita Inglese', 1, 1),
('4', '1', 'Programmazione', 1, 1),
('5', '1', 'Algebra e Geometria', 1, 2),
('6', '1', 'Algoritmi e Strutture dati', 1, 2),
('7', '1', 'Architetture degli Elaboratori', 1, 2),
('8', '1', 'Programmazione ad Oggetti', 2, 1),
('9', '1', 'Sistemi Operativi', 2, 1),
('10', '1', 'Algoritmi Numerici', 2, 2),
('11', '1', 'Basi di dati', 2, 2),
('12', '1', 'Fisica', 2, 2),
('13', '1', 'Reti di Telecomunicaizoni', 2, 1),
('14', '1', 'Programmazione di Reti', 3, 1),
('15', '1', 'Tecnologie Web', 3, 1),
('16', '1', 'Tirocinio', 3, 1),
('17', '1', 'Laboratorio di Basi di dati', 3, 2),
('18', '1', 'Ricerca Operativa', 3, 2),
('19', '3', 'Idoneita Inglese B-2', 1, 1),
('20', '3', 'Machine Learning', 1, 1),
('21', '3', 'Sistemi Distribuiti', 1, 1),
('22', '3', 'Sicurezza nelle Reti', 2, 1),
('23', '3', 'Sistemi Informativi', 1, 2),
('24', '3', 'Programmazione Concorrente', 1, 2),
('25', '3', 'Instradamento e Trasporto', 2, 1),
('26', '3', 'Algoritmi di Ottimizzazione', 2, 0);

-- --------------------------------------------------------

--
-- Table structure for table `corsostudi`
--

CREATE TABLE `corsostudi` (
  `ID` char(5) NOT NULL,
  `Denominazione` varchar(40) NOT NULL,
  `DurataAnni` int(1) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `corsostudi`
--

INSERT INTO `corsostudi` (`ID`, `Denominazione`, `DurataAnni`) VALUES
('1', 'Ingegneria e scienze informatiche', 3),
('2', 'Spicologia', 3),
('3', 'Ingegneria e scienze informatiche LM', 2);

-- --------------------------------------------------------

--
-- Table structure for table `evento`
--

CREATE TABLE `evento` (
  `Utente` varchar(40) NOT NULL,
  `Numero` int(4) NOT NULL,
  `Inizio` datetime NOT NULL,
  `Fine` datetime NOT NULL,
  `Descrizione` varchar(200) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `evento`
--

INSERT INTO `evento` (`Utente`, `Numero`, `Inizio`, `Fine`, `Descrizione`) VALUES
('mario.rossi@studio.unibo.it', 1, '2017-01-31 16:00:00', '2017-01-31 17:00:00', 'Discussione progetto TW!'),
('mario.rossi@studio.unibo.it', 2, '2017-01-28 10:00:00', '2017-01-31 12:00:00', 'Corsa bici unibo!'),
('franco.callegati@unibo.it', 1, '2017-01-25 10:00:00', '2017-01-25 12:00:00', 'Esame reti-1'),
('franco.callegati@unibo.it', 2, '2017-01-30 08:00:00', '2017-01-30 10:00:00', 'Esame reti-2');

-- --------------------------------------------------------

--
-- Table structure for table `iscrizione`
--

CREATE TABLE `iscrizione` (
  `IDCorsoStudi` char(5) NOT NULL,
  `Studente` varchar(40) NOT NULL,
  `AnnoAccademico` varchar(9) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `iscrizione`
--

INSERT INTO `iscrizione` (`IDCorsoStudi`, `Studente`, `AnnoAccademico`) VALUES
('1', 'paolo.venturi9@studio.unibo.it', '2016-2017'),
('1', 'mario.rossi@studio.unibo.it', '2016-2017'),
('1', 'franco.callegati@unibo.it', '2016-2017'),
('3', 'luca.benini@studio.unibo.it', '2016-2017');

-- --------------------------------------------------------

--
-- Table structure for table `lezione`
--

CREATE TABLE `lezione` (
  `Numero` int(3) NOT NULL,
  `OraInizio` datetime NOT NULL,
  `OraFine` datetime NOT NULL,
  `Aula` varchar(40) NOT NULL,
  `CodiceCorso` char(5) NOT NULL,
  `IDCorsoStudi` char(5) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `lezione`
--

INSERT INTO `lezione` (`Numero`, `OraInizio`, `OraFine`, `Aula`, `CodiceCorso`, `IDCorsoStudi`) VALUES
(1, '2017-01-23 08:00:00', '2017-01-23 09:00:00', 'A', '1', '1'),
(2, '2017-01-24 10:00:00', '2017-01-24 12:00:00', 'B', '1', '1'),
(1, '2017-01-30 09:00:00', '2017-01-30 11:00:00', 'Magna', '14', '1'),
(1, '2017-01-31 10:00:00', '2017-01-31 13:00:00', 'Magna', '15', '1'),
(1, '2017-02-01 13:00:00', '2017-02-01 16:00:00', 'C', '13', '1'),
(1, '2017-01-31 09:00:00', '2017-01-31 12:00:00', 'Z', '2', '1'),
(1, '2017-01-30 08:00:00', '2017-01-30 13:00:00', 'A', '4', '1'),
(1, '2017-02-03 11:00:00', '2017-02-03 16:00:00', 'MAGNA', '9', '1'),
(1, '2017-02-02 08:00:00', '2017-02-02 15:00:00', 'A', '3', '1'),
(1, '2017-01-30 08:00:00', '2017-01-30 12:00:00', 'N', '8', '1'),
(2, '2017-02-01 08:00:00', '2017-02-01 11:00:00', 'MAGNA', '8', '1'),
(1, '2017-01-31 08:00:00', '2017-01-31 10:00:00', 'MAGNA', '21', '3'),
(1, '2017-02-03 08:00:00', '2017-02-03 11:00:00', 'MAGNA', '22', '3');

-- --------------------------------------------------------

--
-- Table structure for table `notifica`
--

CREATE TABLE `notifica` (
  `ID` int(11) NOT NULL,
  `Matricola_mit` char(10) NOT NULL,
  `Matricola_dest` char(10) NOT NULL,
  `Testo` varchar(255) NOT NULL,
  `Orario` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `Stato` char(1) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `notifica`
--

INSERT INTO `notifica` (`ID`, `Matricola_mit`, `Matricola_dest`, `Testo`, `Orario`, `Stato`) VALUES
(1, '3', '1', 'Ha caricato nuovo materiale', '2016-10-09 05:49:25', '0'),
(2, '2', '1', 'Ha modificato materiale', '2016-10-28 16:33:26', '0'),
(3, '5', '1', 'Ha caricato nuovo materiale', '2016-11-09 06:21:45', '1'),
(4, '2', '1', 'Ha annullato la lezione', '2016-12-06 09:51:07', '1'),
(5, '4', '1', 'Ha fissato orario esame', '2017-01-10 09:25:28', '1'),
(6, '2', '1', 'Ha verbaliazzato il voto d''esame', '2017-01-17 14:51:28', '1');

-- --------------------------------------------------------

--
-- Table structure for table `utente`
--

CREATE TABLE `utente` (
  `Email` varchar(40) NOT NULL,
  `TipoUtente` char(1) NOT NULL,
  `Nome` varchar(40) NOT NULL,
  `Cognome` varchar(40) NOT NULL,
  `Password` varchar(128) NOT NULL,
  `ImmagineProfilo` varchar(255) NOT NULL,
  `Salt` char(128) NOT NULL,
  `Matricola` char(10) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `utente`
--

INSERT INTO `utente` (`Email`, `TipoUtente`, `Nome`, `Cognome`, `Password`, `ImmagineProfilo`, `Salt`, `Matricola`) VALUES
('mario.rossi@studio.unibo.it', 's', 'Mario', 'Rossi', 'de2c77702e05736c21f030100b2a008c050846e93bb02e27d7ff1edc61a6863c22f7dc9d4f45af2316ed7369a7f547e9d564ae96b17d3460ec0c928b5273e233', 'mario_rossi.jpeg', '2206e453020e2597d8ae5ec7df893d0bdcd0bb25423d03d808dcb8adac4d49e9ec4a3c7b0800d71da7f9259293d98a210d6bcefbd6c2a5cd07a6779fff9ae182', '1'),
('franco.callegati@unibo.it', 'd', 'Franco', 'Callegati', 'de2c77702e05736c21f030100b2a008c050846e93bb02e27d7ff1edc61a6863c22f7dc9d4f45af2316ed7369a7f547e9d564ae96b17d3460ec0c928b5273e233', 'franco_callegati.jpg', '2206e453020e2597d8ae5ec7df893d0bdcd0bb25423d03d808dcb8adac4d49e9ec4a3c7b0800d71da7f9259293d98a210d6bcefbd6c2a5cd07a6779fff9ae182', '2'),
('paolo.venturi9@studio.unibo.it', 's', 'Paolo', 'Venturi', 'de2c77702e05736c21f030100b2a008c050846e93bb02e27d7ff1edc61a6863c22f7dc9d4f45af2316ed7369a7f547e9d564ae96b17d3460ec0c928b5273e233', 'paolo_venturi.jpg', '2206e453020e2597d8ae5ec7df893d0bdcd0bb25423d03d808dcb8adac4d49e9ec4a3c7b0800d71da7f9259293d98a210d6bcefbd6c2a5cd07a6779fff9ae182', '3'),
('rizzi.stefano@unibo.it', 'd', 'Stefano', 'Rizzi', 'de2c77702e05736c21f030100b2a008c050846e93bb02e27d7ff1edc61a6863c22f7dc9d4f45af2316ed7369a7f547e9d564ae96b17d3460ec0c928b5273e233', '', '2206e453020e2597d8ae5ec7df893d0bdcd0bb25423d03d808dcb8adac4d49e9ec4a3c7b0800d71da7f9259293d98a210d6bcefbd6c2a5cd07a6779fff9ae182', '4'),
('luca.benini@studio.unibo.it', 's', 'Luca', 'Benini', 'de2c77702e05736c21f030100b2a008c050846e93bb02e27d7ff1edc61a6863c22f7dc9d4f45af2316ed7369a7f547e9d564ae96b17d3460ec0c928b5273e233', '', '2206e453020e2597d8ae5ec7df893d0bdcd0bb25423d03d808dcb8adac4d49e9ec4a3c7b0800d71da7f9259293d98a210d6bcefbd6c2a5cd07a6779fff9ae182', '5'),
('direzione@studio.unibo.it', 'a', 'Direzione', 'Unibo', 'de2c77702e05736c21f030100b2a008c050846e93bb02e27d7ff1edc61a6863c22f7dc9d4f45af2316ed7369a7f547e9d564ae96b17d3460ec0c928b5273e233', '', '2206e453020e2597d8ae5ec7df893d0bdcd0bb25423d03d808dcb8adac4d49e9ec4a3c7b0800d71da7f9259293d98a210d6bcefbd6c2a5cd07a6779fff9ae182', '0');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `assegnamento`
--
ALTER TABLE `assegnamento`
  ADD PRIMARY KEY (`Docente`,`CodiceCorso`,`IDCorsoStudi`),
  ADD KEY `FKCodiceCorso` (`CodiceCorso`,`IDCorsoStudi`);

--
-- Indexes for table `corso`
--
ALTER TABLE `corso`
  ADD PRIMARY KEY (`Codice`,`IDCorsoStudi`),
  ADD KEY `FKofferta` (`IDCorsoStudi`);

--
-- Indexes for table `corsostudi`
--
ALTER TABLE `corsostudi`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `evento`
--
ALTER TABLE `evento`
  ADD PRIMARY KEY (`Utente`,`Numero`);

--
-- Indexes for table `iscrizione`
--
ALTER TABLE `iscrizione`
  ADD PRIMARY KEY (`Studente`,`AnnoAccademico`),
  ADD KEY `FKUtente` (`Studente`);

--
-- Indexes for table `lezione`
--
ALTER TABLE `lezione`
  ADD PRIMARY KEY (`Numero`,`CodiceCorso`,`IDCorsoStudi`),
  ADD KEY `FKesecuzione` (`CodiceCorso`,`IDCorsoStudi`);

--
-- Indexes for table `notifica`
--
ALTER TABLE `notifica`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `utente`
--
ALTER TABLE `utente`
  ADD PRIMARY KEY (`Email`),
  ADD UNIQUE KEY `IDUtente_1` (`Matricola`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `evento`
--
ALTER TABLE `evento`
  MODIFY `Numero` int(4) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `lezione`
--
ALTER TABLE `lezione`
  MODIFY `Numero` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `notifica`
--
ALTER TABLE `notifica`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

CREATE USER 'secure_user'@'localhost' IDENTIFIED BY 'eKcGZr59zAa2BEWU';
GRANT SELECT, INSERT, UPDATE ON `myalma`.* TO 'secure_user'@'localhost';