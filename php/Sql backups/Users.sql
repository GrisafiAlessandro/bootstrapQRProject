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
-- Struttura della tabella `Users`
--

CREATE TABLE IF NOT EXISTS `Users` (
  `idUtenteInterno` int(11) NOT NULL COMMENT 'Chiave primaria interna - indice degli utenti nel database',
  `idUtente` varchar(30) COLLATE utf8_unicode_ci NOT NULL COMMENT 'Indice pubblico del utente, chiave per le ricerche',
  `nome` text COLLATE utf8_unicode_ci COMMENT 'Nome del Utente',
  `cognome` text COLLATE utf8_unicode_ci COMMENT 'Cognome del Utente'
) ENGINE=InnoDB AUTO_INCREMENT=36 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='Tabella Degli Utenti';

--
-- Dump dei dati per la tabella `Users`
--

INSERT INTO `Users` (`idUtenteInterno`, `idUtente`, `nome`, `cognome`) VALUES
(1, 'XIG1C5Z10zzL4M7BiOSmEgyoAcnw5g', '38CvO2', '8wlA8r'),
(2, 'zPcvTMr46TmDEga5vuzJ9ENqxlAx8G', '8SVf9N', 'n7S9rU'),
(3, '1gBHO0O5XHzbGcOyHQ1idua2YsJPcB', 'Eizgpv', 'liZ4d3');

--
-- Indici per le tabelle scaricate
--

--
-- Indici per le tabelle `Users`
--
ALTER TABLE `Users`
  ADD PRIMARY KEY (`idUtenteInterno`),
  ADD UNIQUE KEY `idUtenteEsterno` (`idUtente`);

--
-- AUTO_INCREMENT per le tabelle scaricate
--

--
-- AUTO_INCREMENT per la tabella `Users`
--
ALTER TABLE `Users`
  MODIFY `idUtenteInterno` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Chiave primaria interna - indice degli utenti nel database',AUTO_INCREMENT=36;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
