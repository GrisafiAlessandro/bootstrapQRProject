-- phpMyAdmin SQL Dump
-- version 4.4.6.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Creato il: Lug 09, 2015 alle 00:06
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
-- Struttura della tabella `Users`
--

CREATE TABLE IF NOT EXISTS `Users` (
  `idUtenteInterno` int(11) NOT NULL COMMENT 'Chiave primaria interna - indice degli utenti nel database',
  `idUtente` varchar(30) COLLATE utf8_unicode_ci NOT NULL COMMENT 'Indice pubblico del utente, chiave per le ricerche',
  `nome` text COLLATE utf8_unicode_ci COMMENT 'Nome del Utente',
  `cognome` text COLLATE utf8_unicode_ci COMMENT 'Cognome del Utente'
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='Tabella Degli Utenti';

--
-- Dump dei dati per la tabella `Users`
--

INSERT INTO `Users` (`idUtenteInterno`, `idUtente`, `nome`, `cognome`) VALUES
(1, '0qiPoUmD3YWzOABn3ftfzT8VK1FBqz', 'G1V2fo', '6mZqi2');

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
  MODIFY `idUtenteInterno` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Chiave primaria interna - indice degli utenti nel database',AUTO_INCREMENT=2;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
