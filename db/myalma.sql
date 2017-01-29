-- phpMyAdmin SQL Dump
-- version 4.6.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Creato il: Gen 29, 2017 alle 01:12
-- Versione del server: 5.7.14
-- Versione PHP: 5.6.25

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
-- Struttura della tabella `assegnamento`
--

CREATE TABLE `assegnamento` (
  `CodiceCorso` char(5) NOT NULL,
  `IDCorsoStudi` char(5) NOT NULL,
  `Docente` varchar(40) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dump dei dati per la tabella `assegnamento`
--

INSERT INTO `assegnamento` (`CodiceCorso`, `IDCorsoStudi`, `Docente`) VALUES
('1', '2', 'gino.pino@unibo.it'),
('1', '1', 'stefano.rizzi@unibo.it');

-- --------------------------------------------------------

--
-- Struttura della tabella `corso`
--

CREATE TABLE `corso` (
  `Codice` char(5) NOT NULL,
  `IDCorsoStudi` char(5) NOT NULL,
  `Denominazione` varchar(40) NOT NULL,
  `Anno` int(1) NOT NULL,
  `Ciclo` int(1) NOT NULL
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
('18', '1', 'Ricerca Operativa', 3, 2);

-- --------------------------------------------------------

--
-- Struttura della tabella `corsostudi`
--

CREATE TABLE `corsostudi` (
  `ID` char(5) NOT NULL,
  `Denominazione` varchar(40) NOT NULL,
  `DurataAnni` int(1) NOT NULL
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

CREATE TABLE `evento` (
  `Utente` varchar(40) NOT NULL,
  `Numero` int(4) NOT NULL,
  `Inizio` date NOT NULL,
  `Fine` date NOT NULL,
  `Descrizione` varchar(200) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struttura della tabella `iscrizione`
--

CREATE TABLE `iscrizione` (
  `IDCorsoStudi` char(5) NOT NULL,
  `Studente` varchar(40) NOT NULL,
  `AnnoAccademico` varchar(9) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dump dei dati per la tabella `iscrizione`
--

INSERT INTO `iscrizione` (`IDCorsoStudi`, `Studente`, `AnnoAccademico`) VALUES
('1', 'paolo.venturi9@studio.unibo.it', '2016-2017'),
('1', 'mario.rossi@studio.unibo.it', '2016-2017');

-- --------------------------------------------------------

--
-- Struttura della tabella `lezione`
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
-- Dump dei dati per la tabella `lezione`
--

INSERT INTO `lezione` (`Numero`, `OraInizio`, `OraFine`, `Aula`, `CodiceCorso`, `IDCorsoStudi`) VALUES
(1, '2017-01-23 08:00:00', '2017-01-23 09:00:00', 'A', '1', '1'),
(2, '2017-01-24 10:00:00', '2017-01-24 12:00:00', 'B', '1', '1');

-- --------------------------------------------------------

--
-- Struttura della tabella `notifica`
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
-- Dump dei dati per la tabella `notifica`
--

INSERT INTO `notifica` (`ID`, `Matricola_mit`, `Matricola_dest`, `Testo`, `Orario`, `Stato`) VALUES
(1, '2', '1', 'ciao', '2017-01-28 22:17:25', '0'),
(2, '2', '1', 'mi chiama', '2017-01-28 22:17:25', '0'),
(3, '2', '1', 'Ha caricato un file sul cloud', '2017-01-28 22:17:25', '0'),
(4, '2', '1', 'notifica 4', '2017-01-28 22:17:25', '0'),
(5, '2', '1', 'notifica', '2017-01-28 22:17:25', '0'),
(6, '2', '1', 'notifica2', '2017-01-28 22:17:25', '0');

-- --------------------------------------------------------

--
-- Struttura della tabella `utente`
--

CREATE TABLE `utente` (
  `Email` varchar(40) NOT NULL,
  `TipoUtente` char(1) NOT NULL,
  `Nome` varchar(40) NOT NULL,
  `Cognome` varchar(40) NOT NULL,
  `Password` varchar(128) NOT NULL,
  `Salt` char(128) NOT NULL,
  `Matricola` char(10) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dump dei dati per la tabella `utente`
--

INSERT INTO `utente` (`Email`, `TipoUtente`, `Nome`, `Cognome`, `Password`, `Salt`, `Matricola`) VALUES
('mario.rossi@studio.unibo.it', 's', 'Mario', 'Rossi', '00807432eae173f652f2064bdca1b61b290b52d40e429a7d295d76a71084aa96c0233b82f1feac45529e0726559645acaed6f3ae58a286b9f075916ebf66cacc', 'f9aab579fc1b41ed0c44fe4ecdbfcdb4cb99b9023abb241a6db833288f4eea3c02f76e0d35204a8695077dcf81932aa59006423976224be0390395bae152d4ef', '1'),
('gino.pino@unibo.it', 'd', 'Gino', 'Pino', '00807432eae173f652f2064bdca1b61b290b52d40e429a7d295d76a71084aa96c0233b82f1feac45529e0726559645acaed6f3ae58a286b9f075916ebf66cacc', 'f9aab579fc1b41ed0c44fe4ecdbfcdb4cb99b9023abb241a6db833288f4eea3c02f76e0d35204a8695077dcf81932aa59006423976224be0390395bae152d4ef', '2'),
('paolo.venturi9@studio.unibo.it', 's', 'Paolo', 'Venturi', 'pw', '37EA0B7500FBDD7E6B3C21673E1C5C0FE4EF9FD459E11CA95ADA52D8CC6ADFAB83FFBF7A5EE1595FB76B79B2D7F61D84575B992029574278477B408882CCA4EA', '0000731072'),
('rizzi.stefano@unibo.it', 'd', 'Stefano', 'Rizzi', 'qwerty', '4EE92C7C7909DC2A1DDAEFE93ED97EFA27A9B8CAB8F1B90C199F917756D00F940155BADE0DA13E717F0C4A1069DE9582E0DD5B1AFFEF427FC7303AA9B593740C', NULL);

--
-- Indici per le tabelle scaricate
--

--
-- Indici per le tabelle `assegnamento`
--
ALTER TABLE `assegnamento`
  ADD PRIMARY KEY (`Docente`,`CodiceCorso`,`IDCorsoStudi`),
  ADD KEY `FKCodiceCorso` (`CodiceCorso`,`IDCorsoStudi`);

--
-- Indici per le tabelle `corso`
--
ALTER TABLE `corso`
  ADD PRIMARY KEY (`Codice`,`IDCorsoStudi`),
  ADD KEY `FKofferta` (`IDCorsoStudi`);

--
-- Indici per le tabelle `corsostudi`
--
ALTER TABLE `corsostudi`
  ADD PRIMARY KEY (`ID`);

--
-- Indici per le tabelle `evento`
--
ALTER TABLE `evento`
  ADD PRIMARY KEY (`Utente`,`Numero`);

--
-- Indici per le tabelle `iscrizione`
--
ALTER TABLE `iscrizione`
  ADD PRIMARY KEY (`Studente`,`AnnoAccademico`),
  ADD KEY `FKUtente` (`Studente`);

--
-- Indici per le tabelle `lezione`
--
ALTER TABLE `lezione`
  ADD PRIMARY KEY (`Numero`,`CodiceCorso`,`IDCorsoStudi`),
  ADD KEY `FKesecuzione` (`CodiceCorso`,`IDCorsoStudi`);

--
-- Indici per le tabelle `notifica`
--
ALTER TABLE `notifica`
  ADD PRIMARY KEY (`ID`);

--
-- Indici per le tabelle `utente`
--
ALTER TABLE `utente`
  ADD PRIMARY KEY (`Email`),
  ADD UNIQUE KEY `IDUtente_1` (`Matricola`);

--
-- AUTO_INCREMENT per le tabelle scaricate
--

--
-- AUTO_INCREMENT per la tabella `evento`
--
ALTER TABLE `evento`
  MODIFY `Numero` int(4) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT per la tabella `lezione`
--
ALTER TABLE `lezione`
  MODIFY `Numero` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT per la tabella `notifica`
--
ALTER TABLE `notifica`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
