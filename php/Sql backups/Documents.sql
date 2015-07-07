-- phpMyAdmin SQL Dump
-- version 4.4.11
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Creato il: Lug 07, 2015 alle 23:23
-- Versione del server: 5.6.24
-- Versione PHP: 5.3.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `DB_Sistema`
--

-- --------------------------------------------------------

--
-- Struttura della tabella `Documents`
--

CREATE TABLE IF NOT EXISTS `Documents` (
  `ChiaveInterna` bigint(105) NOT NULL DEFAULT '0' COMMENT 'Chiave di indicizzazione interna',
  `idDocumento` text COLLATE utf8_unicode_ci NOT NULL,
  `Titolo` text COLLATE utf8_unicode_ci COMMENT 'Titolo del documento',
  `idUtente` text COLLATE utf8_unicode_ci NOT NULL COMMENT 'Indice Utente',
  `LuogoRilascio` text COLLATE utf8_unicode_ci COMMENT 'Luogo rilascio del documento',
  `DataRilascio` datetime DEFAULT CURRENT_TIMESTAMP COMMENT 'Data di rilascio del documento',
  `imgLocation` text COLLATE utf8_unicode_ci COMMENT 'il PATH del file .png/.pdf del certificato',
  `isCertificato` tinyint(1) DEFAULT NULL COMMENT 'bool di controllo del tipo del documento',
  `isAttestato` tinyint(1) DEFAULT NULL COMMENT 'bool di controllo del tipo del documento',
  `idCorso` text COLLATE utf8_unicode_ci NOT NULL COMMENT 'Chiave indice corso fatto dal utente',
  `RisultatoAttestato` text COLLATE utf8_unicode_ci COMMENT 'Risultato conseguito nel attestato',
  `Descrizione` text COLLATE utf8_unicode_ci COMMENT 'Informazioni aggiuntivi'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='Tabella dei documenti';

--
-- Indici per le tabelle scaricate
--

--
-- Indici per le tabelle `Documents`
--
ALTER TABLE `Documents`
  ADD PRIMARY KEY (`ChiaveInterna`),
  ADD UNIQUE KEY `idDocumento` (`idDocumento`(30));

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
