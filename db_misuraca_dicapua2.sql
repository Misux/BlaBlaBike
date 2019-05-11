-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Creato il: Apr 17, 2017 alle 20:01
-- Versione del server: 10.1.16-MariaDB
-- Versione PHP: 7.0.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_misuraca_dicapua2`
--

-- --------------------------------------------------------

--
-- Struttura della tabella `annuncio`
--

CREATE TABLE `annuncio` (
  `dataA` date NOT NULL,
  `venditore` varchar(30) NOT NULL,
  `telaio` varchar(10) NOT NULL,
  `titoloA` varchar(50) NOT NULL,
  `prezzo` decimal(10,0) NOT NULL,
  `descrizione` varchar(100) DEFAULT NULL,
  `stato` varchar(10) NOT NULL DEFAULT '1',
  `acquirente` varchar(30) DEFAULT NULL,
  `confermato` varchar(15) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dump dei dati per la tabella `annuncio`
--

INSERT INTO `annuncio` (`dataA`, `venditore`, `telaio`, `titoloA`, `prezzo`, `descrizione`, `stato`, `acquirente`, `confermato`) VALUES
('2017-04-17', 'Antonio58', 'Tel092', 'Poco usata', '150', 'Bici da corsa marcata KTM. Molto leggera e comoda. Vendo perche ho appena preso un''altra bici.\r\n', 'vendesi', NULL, 'no'),
('2017-04-17', 'Framisu95', '1ywe3', 'BICI SUPER', '305', ' ', 'vendesi', NULL, 'no'),
('2017-04-17', 'Luca2017', 'TEL0987', 'Ottima bici', '255', ' Bellissima mountain bike. Tutti dettagli in annunci. Chiamami 3497898875', 'vendesi', NULL, 'no'),
('2017-04-17', 'Pizo1993', 'Tel090909', 'Bici Storia', '450', ' Pezzo unico nel suo genere. Prezzo non trattabile', 'vendesi', 'Pino1968', 'sospesa'),
('2017-04-17', 'Stefania2017', 'TEL0192', 'KTM ORIGINALE', '50', ' Ho da poco comprato un''altra bici.', 'vendesi', NULL, 'no'),
('2017-04-17', 'Stefania2017', 'TEL87654R', 'Non male', '50', ' Consiglio questa bicicletta perchÃ© ha un''ottima sella ed Ã¨ un pezzo ormai come pochi.', 'vendesi', 'Pizo1993', 'sospesa');

-- --------------------------------------------------------

--
-- Struttura della tabella `bicicletta`
--

CREATE TABLE `bicicletta` (
  `telaio` varchar(10) NOT NULL,
  `peso` decimal(10,0) UNSIGNED NOT NULL,
  `ruote` decimal(10,0) UNSIGNED NOT NULL,
  `annoP` year(4) NOT NULL,
  `annoA` year(4) NOT NULL,
  `colore` varchar(20) DEFAULT NULL,
  `proprietario` varchar(30) DEFAULT NULL,
  `nomeM` varchar(30) NOT NULL,
  `tipo` varchar(20) NOT NULL,
  `acquisita` varchar(2) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dump dei dati per la tabella `bicicletta`
--

INSERT INTO `bicicletta` (`telaio`, `peso`, `ruote`, `annoP`, `annoA`, `colore`, `proprietario`, `nomeM`, `tipo`, `acquisita`) VALUES
('1ywe3', '0', '28', 2016, 2017, '', 'Framisu95', 'Dirty', 'Mountain Bike', 'no'),
('233332', '12', '0', 2009, 2009, 'Bianca', 'Pino1968', 'Dirty', 'Bici Da Corsa', 'no'),
('TE45', '0', '26', 2014, 2015, 'Arancio', 'Antonio58', 'Miche', 'Mountain Bike', 'no'),
('TE567', '12', '0', 1978, 2017, '', 'Framisu95', 'Legnano', 'Bici Da Corsa', 'si'),
('TEL01', '20', '0', 2000, 2017, 'Giallo', 'Lella91', 'Bianchi', 'Bici Da Corsa', 'si'),
('TEL0192', '0', '28', 2013, 2014, 'Gialla', 'Stefania2017', 'KTM', 'Mountain Bike', 'no'),
('TEL02', '0', '29', 2008, 2009, 'Nera', 'Pizo1993', 'Specialized', 'Mountain Bike', 'no'),
('Tel090909', '56', '0', 2015, 2016, 'Gialla', 'Pizo1993', 'Miche', 'Bici Da Corsa', 'no'),
('Tel092', '22', '0', 2015, 2016, '', 'Antonio58', 'KTM', 'Bici Da Corsa', 'no'),
('TEL098', '8', '0', 1978, 1978, '', 'Framisu95', 'Legnano', 'Bici Da Corsa', 'no'),
('TEL0987', '0', '29', 2009, 2011, 'Gialla', 'Luca2017', 'Dirty', 'Mountain Bike', 'no'),
('TEL456', '0', '29', 2016, 2017, 'Verde', 'Luca2017', 'Specialized', 'Mountain Bike', 'si'),
('TEL675', '12', '0', 2016, 2017, '', 'Antonio58', 'Dirty', 'Bici Da Corsa', 'si'),
('TEL76543', '11', '0', 2007, 2008, '', 'Stefania2017', 'Klaxon', 'Bici Da Corsa', 'no'),
('TEL87654R', '13', '0', 1986, 1990, '', 'Stefania2017', 'Legnano', 'Bici Da Corsa', 'no'),
('TEL987', '12', '0', 1998, 2000, 'Bianca', 'Lella91', 'Bianchi', 'Bici Da Corsa', 'no'),
('TEL99', '0', '26', 2011, 2016, '', 'Lella91', 'Sigma', 'Mountain Bike', 'no');

-- --------------------------------------------------------

--
-- Struttura della tabella `commento`
--

CREATE TABLE `commento` (
  `oreMinSec` datetime NOT NULL,
  `titoloA` varchar(50) NOT NULL,
  `dataA` date NOT NULL,
  `venditoreAnnuncio` varchar(30) NOT NULL,
  `telaio` varchar(10) NOT NULL,
  `autoreCommento` varchar(30) NOT NULL,
  `testoC` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dump dei dati per la tabella `commento`
--

INSERT INTO `commento` (`oreMinSec`, `titoloA`, `dataA`, `venditoreAnnuncio`, `telaio`, `autoreCommento`, `testoC`) VALUES
('2017-04-17 19:26:57', 'Poco usata', '2017-04-17', 'Antonio58', 'Tel092', 'Framisu95', 'Sono interessato'),
('2017-04-17 19:45:54', 'BICI SUPER', '2017-04-17', 'Framisu95', '1ywe3', 'Antonio58', 'Wow non male. Ti scrivo stasera'),
('2017-04-17 19:54:37', 'KTM ORIGINALE', '2017-04-17', 'Stefania2017', 'TEL0192', 'Pizo1993', 'Prezzo trattabile?'),
('2017-04-17 19:57:49', 'Bici Storia', '2017-04-17', 'Pizo1993', 'Tel090909', 'Pino1968', 'Sono molto interessato. questo Ã¨ il mio numero 3393998783');

-- --------------------------------------------------------

--
-- Struttura della tabella `filtri`
--

CREATE TABLE `filtri` (
  `user` varchar(30) NOT NULL,
  `tipo` varchar(7) NOT NULL,
  `valore` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dump dei dati per la tabella `filtri`
--

INSERT INTO `filtri` (`user`, `tipo`, `valore`) VALUES
('Antonio58', 'uscite', 'SELECT titoloU, dataU, durata, distanza, dislivello, oraR, visibilita,\ndifficolta, luogoR, organizzatore,tipo FROM uscita WHERE dataU > now() ORDER BY dataU DESC'),
('Framisu95', 'uscite', 'SELECT titoloU, dataU, durata, distanza, dislivello, oraR, visibilita,\ndifficolta, luogoR, organizzatore,tipo FROM uscita WHERE dataU > now() ORDER BY dataU DESC'),
('Luca2017', 'uscite', 'SELECT titoloU, dataU, durata, distanza, dislivello, oraR, visibilita,\ndifficolta, luogoR, organizzatore,tipo FROM uscita WHERE dataU > now() AND tipo=''Bici Da Corsa'' ORDER BY dataU DESC');

-- --------------------------------------------------------

--
-- Struttura della tabella `nota`
--

CREATE TABLE `nota` (
  `titoloN` varchar(50) NOT NULL,
  `testoN` text NOT NULL,
  `titoloU` varchar(50) NOT NULL,
  `dataU` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dump dei dati per la tabella `nota`
--

INSERT INTO `nota` (`titoloN`, `testoN`, `titoloU`, `dataU`) VALUES
('Iscrizione', 'Obbligatoria e visita medica a portata di mano ', 'ComoBike', '2017-09-12'),
('Negozio bici', 'Da circa due anni abbiamo aperto un negozio per ogni tipo di bicicletta. Via solferini 3 Como\r\nPer maggiori info chiamami ale 3497818157', 'ComoBike', '2017-09-12'),
('Previsioni', 'Le previsioni dicono soleggiato con la presenza di nuvole', 'ColchesterBike', '2017-04-20'),
('Previsioni', 'Si spera soleggiato e non troppo caldo. L''ultima settimana vedremo.', 'GenovaBike', '2017-10-23'),
('Previsioni', 'Gli ultimi 3 giorni avremo la certezza', 'MilanoBikeNight', '2017-10-18'),
('Visita Medica', 'Gara amatoriale quindi non necessita di visita medica', 'GenovaBike', '2017-10-23');

-- --------------------------------------------------------

--
-- Struttura della tabella `partecipa`
--

CREATE TABLE `partecipa` (
  `valutazione` tinyint(1) UNSIGNED DEFAULT NULL,
  `ciclista` varchar(30) NOT NULL,
  `titoloU` varchar(50) NOT NULL,
  `dataU` date NOT NULL,
  `telaio` varchar(10) DEFAULT NULL,
  `statoPartecipazione` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dump dei dati per la tabella `partecipa`
--

INSERT INTO `partecipa` (`valutazione`, `ciclista`, `titoloU`, `dataU`, `telaio`, `statoPartecipazione`) VALUES
(NULL, 'Antonio58', 'CalaBroBike', '2018-01-11', NULL, 'sospesa'),
(NULL, 'Antonio58', 'ComoBike', '2017-09-12', 'TE45', 'confermata'),
(NULL, 'Antonio58', 'GenovaBike', '2017-10-23', 'TEL675', 'confermata'),
(NULL, 'Antonio58', 'MilanoBikeNight', '2017-10-18', 'TEL675', 'confermata'),
(NULL, 'Framisu95', 'MilanoBikeNight', '2017-10-18', 'TE567', 'confermata'),
(NULL, 'Framisu95', 'VeneziaBike', '2017-10-25', 'TE567', 'confermata'),
(NULL, 'Lella91', 'CalaBroBike', '2018-01-11', 'TEL01', 'confermata'),
(NULL, 'Lella91', 'ComoBike', '2017-09-12', 'TEL99', 'confermata'),
(NULL, 'Pino1968', 'CalaBroBike', '2018-01-11', '233332', 'confermata'),
(NULL, 'Pino1968', 'VeneziaBike', '2017-10-25', '233332', 'confermata'),
(NULL, 'Pizo1993', 'PietragallaBikes', '2017-08-08', 'TEL02', 'confermata'),
(NULL, 'Stefania2017', 'ColchesterBike', '2017-04-20', 'TEL76543', 'confermata'),
(NULL, 'Stefania2017', 'GenovaBike', '2017-10-23', 'TEL76543', 'confermata'),
(NULL, 'Stefania2017', 'VeneziaBike', '2017-10-25', 'TEL76543', 'confermata');

-- --------------------------------------------------------

--
-- Struttura della tabella `segue`
--

CREATE TABLE `segue` (
  `dataS` date NOT NULL,
  `seguace` varchar(30) NOT NULL,
  `seguito` varchar(30) NOT NULL,
  `stato` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dump dei dati per la tabella `segue`
--

INSERT INTO `segue` (`dataS`, `seguace`, `seguito`, `stato`) VALUES
('2017-03-22', 'Antonio58', 'Framisu95', 'accettata'),
('2017-04-17', 'Antonio58', 'Lella91', 'sospesa'),
('2017-04-17', 'Antonio58', 'Pino1968', 'sospesa'),
('2017-04-17', 'Antonio58', 'Pizo1993', 'sospesa'),
('2017-03-22', 'Framisu95', 'Antonio58', 'accettata'),
('2017-03-26', 'Framisu95', 'Lella91', 'sospesa'),
('2017-03-22', 'Framisu95', 'Luca2017', 'accettata'),
('2017-04-17', 'Framisu95', 'Stefania2017', 'sospesa'),
('2017-04-17', 'Lella91', 'Framisu95', 'sospesa'),
('2017-04-17', 'Lella91', 'Pino1968', 'sospesa'),
('2017-04-17', 'Lella91', 'Pizo1993', 'sospesa'),
('2017-03-22', 'Luca2017', 'Framisu95', 'accettata'),
('2017-03-26', 'Luca2017', 'Lella91', 'accettata'),
('2017-03-22', 'Luca2017', 'Stefania2017', 'sospesa'),
('2017-04-17', 'Pino1968', 'Antonio58', 'sospesa'),
('2017-04-17', 'Pino1968', 'Framisu95', 'sospesa'),
('2017-04-17', 'Pino1968', 'Icardi93', 'sospesa'),
('2017-04-17', 'Pino1968', 'Stefania2017', 'sospesa'),
('2017-04-17', 'Pizo1993', 'Framisu95', 'sospesa'),
('2017-04-17', 'Pizo1993', 'Lella91', 'sospesa'),
('2017-04-17', 'Pizo1993', 'Pino1968', 'sospesa'),
('2017-04-17', 'Pizo1993', 'Stefania2017', 'sospesa'),
('2017-03-22', 'Stefania2017', 'Antonio58', 'accettata'),
('2017-03-22', 'Stefania2017', 'Framisu95', 'accettata'),
('2017-04-17', 'Stefania2017', 'Luca2017', 'sospesa'),
('2017-04-17', 'Stefania2017', 'Pizo1993', 'sospesa');

-- --------------------------------------------------------

--
-- Struttura della tabella `tappa`
--

CREATE TABLE `tappa` (
  `numeroT` smallint(6) NOT NULL,
  `titoloU` varchar(50) NOT NULL,
  `dataU` date NOT NULL,
  `tipoT` varchar(12) NOT NULL,
  `partenza` varchar(50) NOT NULL,
  `arrivo` varchar(50) NOT NULL,
  `lunghezza` decimal(10,0) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dump dei dati per la tabella `tappa`
--

INSERT INTO `tappa` (`numeroT`, `titoloU`, `dataU`, `tipoT`, `partenza`, `arrivo`, `lunghezza`) VALUES
(1, 'CalaBroBike', '2018-01-11', 'salita', 'Bar Canturi', 'Siderno centro', '30'),
(1, 'ColchesterBike', '2017-04-20', 'piana', 'Castle', 'Park', '20'),
(1, 'ComoBike', '2017-09-12', 'piana', 'Villa Olmo', 'Villa Carlotta', '30'),
(1, 'GenovaBike', '2017-10-23', 'piana', 'Palazzo Rosso', 'Piazza De Ferrari', '17'),
(1, 'MilanoBikeNight', '2017-10-18', 'piana', 'Duomo di Milano', 'San Siro', '20'),
(1, 'PietragallaBikes', '2017-08-08', 'piana', 'Chiesa di Pietragalla', 'Chiesa di Cappelluccia', '30'),
(1, 'VeneziaBike', '2017-10-25', 'piana', 'Piazza San Marco', 'Castello di Venezia', '10'),
(2, 'CalaBroBike', '2018-01-11', 'piana', 'Siderno centro', 'Lungomare di bianco', '40'),
(2, 'ColchesterBike', '2017-04-20', 'piana', 'Park', 'Church Sant Mary', '25'),
(2, 'ComoBike', '2017-09-12', 'salita', 'Villa Carlotta', 'Baia del sultano', '35'),
(2, 'GenovaBike', '2017-10-23', 'piana', 'Piazza De Ferrari', 'Pegli', '15'),
(2, 'MilanoBikeNight', '2017-10-18', 'piana', 'San Siro', 'Duomo di Milano', '20'),
(2, 'PietragallaBikes', '2017-08-08', 'piana', 'Chiesa di Cappelluccia', 'Limitone', '15'),
(2, 'VeneziaBike', '2017-10-25', 'piana', 'Castello di Venezia', 'Scuola San Rocco', '30'),
(3, 'ColchesterBike', '2017-04-20', 'piana', 'Church Sant Mary', 'Road Avenue', '30'),
(3, 'ComoBike', '2017-09-12', 'salita', 'Baia del sultano', 'Rifugio 3 croci', '27'),
(3, 'GenovaBike', '2017-10-23', 'piana', 'Pegli', 'Acquario di Genova', '21'),
(3, 'VeneziaBike', '2017-10-25', 'piana', 'Scuola San Rocco', 'Ponte dei sospiri', '20'),
(4, 'ComoBike', '2017-09-12', 'discesa', 'Rifugio 3 croci', 'Castel Baradello', '40'),
(4, 'VeneziaBike', '2017-10-25', 'piana', 'Ponte dei sospiri', 'Piazza San Marco', '25'),
(5, 'ComoBike', '2017-09-12', 'piana', 'Castel Baradello', 'Duomo di como', '15');

-- --------------------------------------------------------

--
-- Struttura della tabella `tipologia`
--

CREATE TABLE `tipologia` (
  `tipo` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dump dei dati per la tabella `tipologia`
--

INSERT INTO `tipologia` (`tipo`) VALUES
('Bici Da Corsa'),
('Mountain Bike');

-- --------------------------------------------------------

--
-- Struttura della tabella `uscita`
--

CREATE TABLE `uscita` (
  `titoloU` varchar(50) NOT NULL,
  `dataU` date NOT NULL,
  `durata` decimal(10,0) NOT NULL,
  `distanza` decimal(10,0) UNSIGNED NOT NULL,
  `dislivello` decimal(10,0) DEFAULT NULL,
  `oraR` time NOT NULL,
  `visibilita` varchar(10) NOT NULL,
  `difficolta` varchar(10) NOT NULL,
  `luogoR` varchar(60) NOT NULL,
  `organizzatore` varchar(30) NOT NULL,
  `tipo` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dump dei dati per la tabella `uscita`
--

INSERT INTO `uscita` (`titoloU`, `dataU`, `durata`, `distanza`, `dislivello`, `oraR`, `visibilita`, `difficolta`, `luogoR`, `organizzatore`, `tipo`) VALUES
('CalaBroBike', '2018-01-11', '3', '70', '4', '11:00:00', 'pubblica', 'bassa', 'Bianco', 'Pino1968', 'Bici Da Corsa'),
('ColchesterBike', '2017-04-20', '2', '75', '5', '08:00:00', 'pubblica', 'bassa', 'Colchester Castle', 'Antonio58', 'Bici Da Corsa'),
('ComoBike', '2017-09-12', '5', '147', '26', '07:30:00', 'pubblica', 'alta', 'Villa Olmo', 'Luca2017', 'Mountain Bike'),
('GenovaBike', '2017-10-23', '3', '53', '3', '10:00:00', 'pubblica', 'media', 'Palazzo Rosso', 'Stefania2017', 'Bici Da Corsa'),
('MilanoBikeNight', '2017-10-18', '2', '40', '0', '09:00:00', 'pubblica', 'bassa', 'Duomo di Milano', 'Framisu95', 'Bici Da Corsa'),
('PietragallaBikes', '2017-08-08', '2', '45', '10', '08:30:00', 'privata', 'media', 'Pietragalla', 'Pizo1993', 'Mountain Bike'),
('VeneziaBike', '2017-10-25', '3', '85', '2', '10:00:00', 'pubblica', 'media', 'Piazza San Marco', 'Antonio58', 'Bici Da Corsa');

-- --------------------------------------------------------

--
-- Struttura della tabella `utente`
--

CREATE TABLE `utente` (
  `user` varchar(30) NOT NULL,
  `password` varchar(30) NOT NULL,
  `nome` varchar(30) DEFAULT NULL,
  `cognome` varchar(30) DEFAULT NULL,
  `luogoN` varchar(50) DEFAULT NULL,
  `residenza` varchar(50) DEFAULT NULL,
  `categoria` varchar(10) DEFAULT NULL,
  `dataN` date DEFAULT NULL,
  `sesso` enum('M','F') DEFAULT NULL,
  `email` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dump dei dati per la tabella `utente`
--

INSERT INTO `utente` (`user`, `password`, `nome`, `cognome`, `luogoN`, `residenza`, `categoria`, `dataN`, `sesso`, `email`) VALUES
('Antonio58', 'Antonio58', 'Antonio', 'Rossi', '', 'Milano', 'Esperto', '0000-00-00', 'M', 'AntoRossi@gmail.com'),
('Framisu95', 'Framisu95', '', '', '', 'Milano', 'Esperto', '0000-00-00', '', 'fra@hotmail.it'),
('Icardi93', 'Icardi93', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Icardi93@live.it'),
('Lella91', 'Lella91', 'Antonella', 'Laurino', 'Potenza', 'Pietragalla', 'Amatore', '1991-09-03', 'F', 'antonella@live.it'),
('Luca2017', 'Luca2017', 'Luca', 'Nicotra', 'Cernusco', 'Colchester', '', '0000-00-00', '', 'luca2017@gmail.com'),
('Pino1968', 'Bianco1968', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'pino1968@gmail.com'),
('Pizo1993', 'Pizo1993', '', '', '', '', 'Amatore', '0000-00-00', '', 'dikapua@outlook.it'),
('Stefania2017', 'Stefania2017', '', '', '', '', '', '1995-02-12', '', 'giuseppe.misuraca1968@gmail.com');

--
-- Indici per le tabelle scaricate
--

--
-- Indici per le tabelle `annuncio`
--
ALTER TABLE `annuncio`
  ADD PRIMARY KEY (`dataA`,`venditore`,`telaio`,`titoloA`),
  ADD KEY `venditore_fk` (`venditore`),
  ADD KEY `acquirente_fk` (`acquirente`),
  ADD KEY `telaio` (`telaio`),
  ADD KEY `titoloA` (`titoloA`),
  ADD KEY `titoloA_2` (`titoloA`),
  ADD KEY `dataA` (`dataA`);

--
-- Indici per le tabelle `bicicletta`
--
ALTER TABLE `bicicletta`
  ADD PRIMARY KEY (`telaio`),
  ADD KEY `proprietario_fk` (`proprietario`),
  ADD KEY `tipo` (`tipo`);

--
-- Indici per le tabelle `commento`
--
ALTER TABLE `commento`
  ADD PRIMARY KEY (`oreMinSec`,`titoloA`,`dataA`,`venditoreAnnuncio`,`telaio`,`autoreCommento`),
  ADD KEY `titoloA` (`titoloA`,`dataA`,`venditoreAnnuncio`,`telaio`),
  ADD KEY `autoreCommento` (`autoreCommento`);

--
-- Indici per le tabelle `filtri`
--
ALTER TABLE `filtri`
  ADD PRIMARY KEY (`user`,`tipo`),
  ADD KEY `user` (`user`);

--
-- Indici per le tabelle `nota`
--
ALTER TABLE `nota`
  ADD PRIMARY KEY (`titoloN`,`titoloU`,`dataU`),
  ADD KEY `uscitaNota_fk` (`titoloU`,`dataU`);

--
-- Indici per le tabelle `partecipa`
--
ALTER TABLE `partecipa`
  ADD PRIMARY KEY (`ciclista`,`titoloU`,`dataU`),
  ADD KEY `uscitaPartecipa_fk` (`titoloU`,`dataU`),
  ADD KEY `telaio` (`telaio`);

--
-- Indici per le tabelle `segue`
--
ALTER TABLE `segue`
  ADD PRIMARY KEY (`seguace`,`seguito`),
  ADD KEY `seguace` (`seguace`),
  ADD KEY `seguito_fk` (`seguito`);

--
-- Indici per le tabelle `tappa`
--
ALTER TABLE `tappa`
  ADD PRIMARY KEY (`numeroT`,`titoloU`,`dataU`),
  ADD KEY `uscitaTappa_fk` (`titoloU`,`dataU`);

--
-- Indici per le tabelle `tipologia`
--
ALTER TABLE `tipologia`
  ADD PRIMARY KEY (`tipo`);

--
-- Indici per le tabelle `uscita`
--
ALTER TABLE `uscita`
  ADD PRIMARY KEY (`titoloU`,`dataU`),
  ADD KEY `organizzatore_fk` (`organizzatore`),
  ADD KEY `tipoUscita_fk` (`tipo`);

--
-- Indici per le tabelle `utente`
--
ALTER TABLE `utente`
  ADD PRIMARY KEY (`user`);

--
-- Limiti per le tabelle scaricate
--

--
-- Limiti per la tabella `annuncio`
--
ALTER TABLE `annuncio`
  ADD CONSTRAINT `acquirente_fk` FOREIGN KEY (`acquirente`) REFERENCES `utente` (`user`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `annuncio_ibfk_1` FOREIGN KEY (`telaio`) REFERENCES `bicicletta` (`telaio`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `venditore_fk` FOREIGN KEY (`venditore`) REFERENCES `utente` (`user`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Limiti per la tabella `bicicletta`
--
ALTER TABLE `bicicletta`
  ADD CONSTRAINT `bicicletta_ibfk_1` FOREIGN KEY (`tipo`) REFERENCES `tipologia` (`tipo`),
  ADD CONSTRAINT `proprietario_fk` FOREIGN KEY (`proprietario`) REFERENCES `utente` (`user`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Limiti per la tabella `commento`
--
ALTER TABLE `commento`
  ADD CONSTRAINT `commento_ibfk_1` FOREIGN KEY (`titoloA`,`dataA`,`venditoreAnnuncio`,`telaio`) REFERENCES `annuncio` (`titoloA`, `dataA`, `venditore`, `telaio`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `commento_ibfk_2` FOREIGN KEY (`autoreCommento`) REFERENCES `utente` (`user`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Limiti per la tabella `filtri`
--
ALTER TABLE `filtri`
  ADD CONSTRAINT `filtri_ibfk_1` FOREIGN KEY (`user`) REFERENCES `utente` (`user`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Limiti per la tabella `nota`
--
ALTER TABLE `nota`
  ADD CONSTRAINT `uscitaNota_fk` FOREIGN KEY (`titoloU`,`dataU`) REFERENCES `uscita` (`titoloU`, `dataU`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Limiti per la tabella `partecipa`
--
ALTER TABLE `partecipa`
  ADD CONSTRAINT `ciclista_fk` FOREIGN KEY (`ciclista`) REFERENCES `utente` (`user`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `partecipa_ibfk_1` FOREIGN KEY (`telaio`) REFERENCES `bicicletta` (`telaio`) ON DELETE SET NULL ON UPDATE SET NULL,
  ADD CONSTRAINT `uscitaPartecipa_fk` FOREIGN KEY (`titoloU`,`dataU`) REFERENCES `uscita` (`titoloU`, `dataU`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Limiti per la tabella `segue`
--
ALTER TABLE `segue`
  ADD CONSTRAINT `seguace_fk` FOREIGN KEY (`seguace`) REFERENCES `utente` (`user`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `seguito_fk` FOREIGN KEY (`seguito`) REFERENCES `utente` (`user`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Limiti per la tabella `tappa`
--
ALTER TABLE `tappa`
  ADD CONSTRAINT `uscitaTappa_fk` FOREIGN KEY (`titoloU`,`dataU`) REFERENCES `uscita` (`titoloU`, `dataU`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Limiti per la tabella `uscita`
--
ALTER TABLE `uscita`
  ADD CONSTRAINT `tipoUscita_fk` FOREIGN KEY (`tipo`) REFERENCES `tipologia` (`tipo`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `uscita_ibfk_1` FOREIGN KEY (`organizzatore`) REFERENCES `utente` (`user`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
