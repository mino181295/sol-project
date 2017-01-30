-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Gen 30, 2017 alle 13:25
-- Versione del server: 5.6.17
-- PHP Version: 5.5.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `myalma`
--

-- --------------------------------------------------------

--
-- Struttura della tabella `assegnamento`
--

CREATE TABLE IF NOT EXISTS `assegnamento` (
  `CodiceCorso` char(5) NOT NULL,
  `IDCorsoStudi` char(5) NOT NULL,
  `Docente` varchar(40) NOT NULL,
  PRIMARY KEY (`Docente`,`CodiceCorso`,`IDCorsoStudi`),
  KEY `FKCodiceCorso` (`CodiceCorso`,`IDCorsoStudi`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dump dei dati per la tabella `assegnamento`
--

INSERT INTO `assegnamento` (`CodiceCorso`, `IDCorsoStudi`, `Docente`) VALUES
('1', '2', 'franco.callegati@unibo.it'),
('1', '1', 'stefano.rizzi@unibo.it');

-- --------------------------------------------------------

--
-- Struttura della tabella `corso`
--

CREATE TABLE IF NOT EXISTS `corso` (
  `Codice` char(5) NOT NULL,
  `IDCorsoStudi` char(5) NOT NULL,
  `Denominazione` varchar(40) NOT NULL,
  `Anno` int(1) NOT NULL,
  `Ciclo` int(1) NOT NULL,
  PRIMARY KEY (`Codice`,`IDCorsoStudi`),
  KEY `FKofferta` (`IDCorsoStudi`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dump dei dati per la tabella `corso`
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
('13', '1', 'Reti di Telecomunicaizoni', 2, 2),
('14', '1', 'Programmazione di Reti', 3, 1),
('15', '1', 'Tecnologie Web', 3, 1),
('16', '1', 'Tirocinio', 3, 1),
('17', '1', 'Laboratorio di Basi di dati', 3, 2),
('18', '1', 'Ricerca Operativa', 3, 2),
('19', '3', 'Idoneita Inglese B-2', 1, 1),
('20', '3', 'Machine Learning', 1, 1),
('21', '3', 'Sistemi Distribuiti', 1, 1),
('22', '3', 'Sicurezza nelle Reti', 1, 0),
('23', '3', 'Sistemi Informativi', 1, 2),
('24', '3', 'Programmazione Concorrente', 1, 2),
('25', '3', 'Instradamento e Trasporto', 2, 1),
('26', '3', 'Algoritmi di Ottimizzazione', 2, 0);

-- --------------------------------------------------------

--
-- Struttura della tabella `corsostudi`
--

CREATE TABLE IF NOT EXISTS `corsostudi` (
  `ID` char(5) NOT NULL,
  `Denominazione` varchar(40) NOT NULL,
  `DurataAnni` int(1) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dump dei dati per la tabella `corsostudi`
--

INSERT INTO `corsostudi` (`ID`, `Denominazione`, `DurataAnni`) VALUES
('1', 'Ingegneria e scienze informatiche', 3),
('2', 'Spicologia', 3),
('3', 'Ingegneria e scienze informatiche LM', 2);

-- --------------------------------------------------------

--
-- Struttura della tabella `evento`
--

CREATE TABLE IF NOT EXISTS `evento` (
  `Utente` varchar(40) NOT NULL,
  `Numero` int(4) NOT NULL AUTO_INCREMENT,
  `Inizio` datetime NOT NULL,
  `Fine` datetime NOT NULL,
  `Descrizione` varchar(200) NOT NULL,
  PRIMARY KEY (`Utente`,`Numero`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Struttura della tabella `iscrizione`
--

CREATE TABLE IF NOT EXISTS `iscrizione` (
  `IDCorsoStudi` char(5) NOT NULL,
  `Studente` varchar(40) NOT NULL,
  `AnnoAccademico` varchar(9) NOT NULL,
  PRIMARY KEY (`Studente`,`AnnoAccademico`),
  KEY `FKUtente` (`Studente`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dump dei dati per la tabella `iscrizione`
--

INSERT INTO `iscrizione` (`IDCorsoStudi`, `Studente`, `AnnoAccademico`) VALUES
('1', 'paolo.venturi9@studio.unibo.it', '2016-2017'),
('1', 'mario.rossi@studio.unibo.it', '2016-2017'),
('1', 'franco.callegati@unibo.it', '2016-2017'),
('3', 'luca.benini@studio.unibo.it', '2016-2017');

-- --------------------------------------------------------

--
-- Struttura della tabella `lezione`
--

CREATE TABLE IF NOT EXISTS `lezione` (
  `Numero` int(3) NOT NULL AUTO_INCREMENT,
  `OraInizio` datetime NOT NULL,
  `OraFine` datetime NOT NULL,
  `Aula` varchar(40) NOT NULL,
  `CodiceCorso` char(5) NOT NULL,
  `IDCorsoStudi` char(5) NOT NULL,
  PRIMARY KEY (`Numero`,`CodiceCorso`,`IDCorsoStudi`),
  KEY `FKesecuzione` (`CodiceCorso`,`IDCorsoStudi`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dump dei dati per la tabella `lezione`
--

INSERT INTO `lezione` (`Numero`, `OraInizio`, `OraFine`, `Aula`, `CodiceCorso`, `IDCorsoStudi`) VALUES
(1, '2017-01-23 08:00:00', '2017-01-23 09:00:00', 'A', '1', '1'),
(2, '2017-01-24 10:00:00', '2017-01-24 12:00:00', 'B', '1', '1');

-- --------------------------------------------------------

--
-- Struttura della tabella `notifica`
--

CREATE TABLE IF NOT EXISTS `notifica` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `Matricola_mit` char(10) NOT NULL,
  `Matricola_dest` char(10) NOT NULL,
  `Testo` varchar(255) NOT NULL,
  `Orario` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `Stato` char(1) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Dump dei dati per la tabella `notifica`
--

INSERT INTO `notifica` (`ID`, `Matricola_mit`, `Matricola_dest`, `Testo`, `Orario`, `Stato`) VALUES
(1, '2', '1', 'Ha caricato nuovo materiale', '2016-10-05 09:24:39', '0'),
(2, '2', '1', 'Ha modificato materiale', '2016-10-25 08:16:37', '0'),
(3, '2', '1', 'Ha caricato nuovo materiale', '2016-11-09 13:53:25', '0'),
(4, '2', '1', 'Ha annullato la lezione', '2017-01-29 17:10:57', '0'),
(5, '2', '1', 'Ha fissato orario esame', '2017-01-29 17:10:57', '0'),
(6, '2', '1', 'Ha verbaliazzato il voto d''esame', '2017-01-29 17:10:57', '0');

-- --------------------------------------------------------

--
-- Struttura della tabella `utente`
--

CREATE TABLE IF NOT EXISTS `utente` (
  `Email` varchar(40) NOT NULL,
  `TipoUtente` char(1) NOT NULL,
  `Nome` varchar(40) NOT NULL,
  `Cognome` varchar(40) NOT NULL,
  `Password` varchar(128) NOT NULL,
  `ImmagineProfilo` varchar(255) NOT NULL,
  `Salt` char(128) NOT NULL,
  `Matricola` char(10) DEFAULT NULL,
  PRIMARY KEY (`Email`),
  UNIQUE KEY `IDUtente_1` (`Matricola`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dump dei dati per la tabella `utente`
--

INSERT INTO `utente` (`Email`, `TipoUtente`, `Nome`, `Cognome`, `Password`, `ImmagineProfilo`, `Salt`, `Matricola`) VALUES
('mario.rossi@studio.unibo.it', 's', 'Mario', 'Rossi', 'de2c77702e05736c21f030100b2a008c050846e93bb02e27d7ff1edc61a6863c22f7dc9d4f45af2316ed7369a7f547e9d564ae96b17d3460ec0c928b5273e233', 'mario_rossi.jpeg', '2206e453020e2597d8ae5ec7df893d0bdcd0bb25423d03d808dcb8adac4d49e9ec4a3c7b0800d71da7f9259293d98a210d6bcefbd6c2a5cd07a6779fff9ae182', '1'),
('franco.callegati@unibo.it', 'd', 'Franco', 'Callegati', 'de2c77702e05736c21f030100b2a008c050846e93bb02e27d7ff1edc61a6863c22f7dc9d4f45af2316ed7369a7f547e9d564ae96b17d3460ec0c928b5273e233', 'franco_callegati.jpg', '2206e453020e2597d8ae5ec7df893d0bdcd0bb25423d03d808dcb8adac4d49e9ec4a3c7b0800d71da7f9259293d98a210d6bcefbd6c2a5cd07a6779fff9ae182', '2'),
('paolo.venturi9@studio.unibo.it', 's', 'Paolo', 'Venturi', 'de2c77702e05736c21f030100b2a008c050846e93bb02e27d7ff1edc61a6863c22f7dc9d4f45af2316ed7369a7f547e9d564ae96b17d3460ec0c928b5273e233', 'paolo_venturi.jpg', '2206e453020e2597d8ae5ec7df893d0bdcd0bb25423d03d808dcb8adac4d49e9ec4a3c7b0800d71da7f9259293d98a210d6bcefbd6c2a5cd07a6779fff9ae182', '3'),
('rizzi.stefano@unibo.it', 'd', 'Stefano', 'Rizzi', 'de2c77702e05736c21f030100b2a008c050846e93bb02e27d7ff1edc61a6863c22f7dc9d4f45af2316ed7369a7f547e9d564ae96b17d3460ec0c928b5273e233', '', '2206e453020e2597d8ae5ec7df893d0bdcd0bb25423d03d808dcb8adac4d49e9ec4a3c7b0800d71da7f9259293d98a210d6bcefbd6c2a5cd07a6779fff9ae182', '4'),
('luca.benini@studio.unibo.it', 's', 'Luca', 'Benini', 'de2c77702e05736c21f030100b2a008c050846e93bb02e27d7ff1edc61a6863c22f7dc9d4f45af2316ed7369a7f547e9d564ae96b17d3460ec0c928b5273e233', '', '2206e453020e2597d8ae5ec7df893d0bdcd0bb25423d03d808dcb8adac4d49e9ec4a3c7b0800d71da7f9259293d98a210d6bcefbd6c2a5cd07a6779fff9ae182', '6');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
