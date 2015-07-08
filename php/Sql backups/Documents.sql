-- phpMyAdmin SQL Dump
-- version 4.4.6.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Creato il: Lug 09, 2015 alle 00:05
-- Versione del server: 5.6.24
-- Versione PHP: 5.3.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

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
  `titolo` text COLLATE utf8_unicode_ci COMMENT 'Titolo del documento',
  `idUtente` text COLLATE utf8_unicode_ci NOT NULL COMMENT 'Indice Utente',
  `luogoRilascio` text COLLATE utf8_unicode_ci COMMENT 'Luogo rilascio del documento',
  `dataRilascio` datetime DEFAULT CURRENT_TIMESTAMP COMMENT 'Data di rilascio del documento',
  `imgLocation` text COLLATE utf8_unicode_ci COMMENT 'il PATH del file .png/.pdf del certificato',
  `isCertificato` tinyint(1) DEFAULT NULL COMMENT 'bool di controllo del tipo del documento',
  `isAttestato` tinyint(1) DEFAULT NULL COMMENT 'bool di controllo del tipo del documento',
  `idCorso` text COLLATE utf8_unicode_ci NOT NULL COMMENT 'Chiave indice corso fatto dal utente',
  `risultatoAttestato` text COLLATE utf8_unicode_ci COMMENT 'Risultato conseguito nel attestato',
  `descrizione` text COLLATE utf8_unicode_ci COMMENT 'Informazioni aggiuntivi'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='Tabella dei documenti';

--
-- Dump dei dati per la tabella `Documents`
--

INSERT INTO `Documents` (`ChiaveInterna`, `idDocumento`, `titolo`, `idUtente`, `luogoRilascio`, `dataRilascio`, `imgLocation`, `isCertificato`, `isAttestato`, `idCorso`, `risultatoAttestato`, `descrizione`) VALUES
(0, '3SSIJfHFwSgi3vT5oktZ94jupWgyMG', 'Questo Ã¨ il titolo', '0qiPoUmD3YWzOABn3ftfzT8VK1FBqz', 'Pordenone', '2015-07-08 23:21:49', 'http://lbtest.altervista.org/Immagine.png', 0, 1, '', 'I''M THE WINNER', 'Questa Ã¨ descrizione');

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
