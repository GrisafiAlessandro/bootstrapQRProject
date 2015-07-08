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
-- Struttura della tabella `Courses`
--

CREATE TABLE IF NOT EXISTS `Courses` (
  `ChiaveInterna` bigint(20) NOT NULL COMMENT 'Chiave di indicizzazione del database',
  `idCorso` text COLLATE utf8_unicode_ci NOT NULL COMMENT 'Indice del corso',
  `idDocente` text COLLATE utf8_unicode_ci NOT NULL COMMENT 'Indice del docente del corso',
  `durataCorso` text COLLATE utf8_unicode_ci,
  `programmaCorso` text COLLATE utf8_unicode_ci,
  `ulterioriInfo` text COLLATE utf8_unicode_ci COMMENT 'Qualsiasi altra informazione sul corso'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='Tabella dei corsi';

--
-- Indici per le tabelle scaricate
--

--
-- Indici per le tabelle `Courses`
--
ALTER TABLE `Courses`
  ADD PRIMARY KEY (`ChiaveInterna`),
  ADD UNIQUE KEY `idCorso` (`idCorso`(30));

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
