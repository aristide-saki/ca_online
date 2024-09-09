-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : mar. 16 juil. 2024 à 16:24
-- Version du serveur : 10.4.27-MariaDB
-- Version de PHP : 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `db_ca_online`
--

-- --------------------------------------------------------

--
-- Structure de la table `ca_online`
--

CREATE TABLE `ca_online` (
  `id` int(11) NOT NULL,
  `contact` varchar(20) NOT NULL,
  `nom` varchar(250) NOT NULL,
  `prenom` varchar(250) NOT NULL,
  `entreprise` varchar(100) NOT NULL,
  `zone_intervention` varchar(250) NOT NULL,
  `ticket` varchar(100) NOT NULL,
  `nd` varchar(100) NOT NULL,
  `signalisation` varchar(100) NOT NULL,
  `action_corrective` varchar(250) NOT NULL,
  `statut` varchar(50) NOT NULL,
  `segment` varchar(100) NOT NULL,
  `acteur` varchar(250) NOT NULL,
  `date_reception` timestamp NULL DEFAULT NULL,
  `date_reponse` timestamp NULL DEFAULT NULL,
  `temps` varchar(250) NOT NULL,
  `commentaire_1` text NOT NULL,
  `commentaire_2` text NOT NULL,
  `noeud_ressource_hs` varchar(250) NOT NULL,
  `ressource_hs` varchar(250) NOT NULL,
  `etat_ressource_hs` varchar(250) NOT NULL,
  `nd_occupant` varchar(250) NOT NULL,
  `agent_ca` varchar(100) NOT NULL,
  `date_enregistrement` datetime NOT NULL DEFAULT current_timestamp(),
  `active` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Déchargement des données de la table `ca_online`
--

INSERT INTO `ca_online` (`id`, `contact`, `nom`, `prenom`, `entreprise`, `zone_intervention`, `ticket`, `nd`, `signalisation`, `action_corrective`, `statut`, `segment`, `acteur`, `date_reception`, `date_reponse`, `temps`, `commentaire_1`, `commentaire_2`, `noeud_ressource_hs`, `ressource_hs`, `etat_ressource_hs`, `nd_occupant`, `agent_ca`, `date_enregistrement`, `active`) VALUES
(1, '33636', 'sfhfsh', 'hsfhsfghsfh', 'sfhsfh', 'sfhsfhsfh', 'dhh', 'sfh', 'César-Erreur d\'authentification', 'Comunication infos compte OTV', 'En cours', 'Maintenance FTTH', 'Commercial', '2024-06-18 11:12:00', '2024-06-22 11:18:00', '96 hours, 6 minutes,', 'hsfhsh', 'Absence de mot de passe sur BSCS', 'fhsfh', 'fhsh', 'hshsfh', 'hsfghshsh', 'sfhsfhsfh', '2024-06-18 11:13:39', 0),
(2, '0707489784', 'SAKI', 'Kobenan', 'DEV+', 'Yopougon', 'N346', '12', 'Débit non conforme', 'Communication infos client', 'Ok', 'Signalisation mail', 'Exploitation et Support IP', '2024-06-17 11:25:00', '2024-06-19 11:35:00', '48 hours, 10 minutes, 0 seconds', 'RAS', 'Beug S.I', 'Test ', 'Test', 'Test', 'Test', 'agentca001', '2024-06-18 11:26:41', 0),
(3, '0707489784', 'SAKI', 'Kobenan', 'DEV+', 'Yopougon', 'N346', '12', 'Débit non conforme', 'Communication infos client', 'Ok', 'Signalisation mail', 'Exploitation et Support IP', '2024-06-17 11:25:00', '2024-06-19 11:35:00', '48 hours, 10 minutes, 0 seconds', 'RAS', 'Beug S.I', 'Test ', 'Test', 'Test', 'Test', 'agentca001', '2024-06-18 12:04:01', 1),
(4, 'GTUYAI', 'LOI', '3ER', 'EZ', 'ZAZA', 'DSD', 'ZA', 'César-Installation hors délais', 'Compte résilié / suspendu', 'Ok', 'Production César', 'CIC', '2024-07-05 13:27:00', '2024-07-13 13:27:00', '192:0:0', 'djdj', 'Absence de mot de passe sur BSCS', 'dgj', 'dgjdg', 'dgjd', 'dgjdg', 'jdgjd', '2024-07-05 12:48:49', 1),
(5, '', '', '', '', '', '', '', '', '', '', '', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', '', '', '', '', '', '', '2024-07-05 13:24:47', 1);

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `ca_online`
--
ALTER TABLE `ca_online`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `ca_online`
--
ALTER TABLE `ca_online`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
