-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : jeu. 10 déc. 2020 à 20:52
-- Version du serveur :  5.7.31
-- Version de PHP : 7.3.21

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `e_commerce`
--

-- --------------------------------------------------------

--
-- Structure de la table `utilisateur`
--

DROP TABLE IF EXISTS `utilisateur`;
CREATE TABLE IF NOT EXISTS `utilisateur` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `civilite` varchar(256) COLLATE utf8_unicode_ci NOT NULL,
  `nom` varchar(256) COLLATE utf8_unicode_ci NOT NULL,
  `prenom` varchar(256) COLLATE utf8_unicode_ci NOT NULL,
  `login` varchar(256) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(256) COLLATE utf8_unicode_ci NOT NULL,
  `motDePasse` varchar(256) COLLATE utf8_unicode_ci NOT NULL,
  `adresse` varchar(256) COLLATE utf8_unicode_ci NOT NULL,
  `ville` varchar(256) COLLATE utf8_unicode_ci NOT NULL,
  `codePostal` varchar(16) COLLATE utf8_unicode_ci NOT NULL,
  `pays` varchar(256) COLLATE utf8_unicode_ci NOT NULL,
  `telephone` varchar(256) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Déchargement des données de la table `utilisateur`
--

INSERT INTO `utilisateur` (`id`, `civilite`, `nom`, `prenom`, `login`, `email`, `motDePasse`, `adresse`, `ville`, `codePostal`, `pays`, `telephone`) VALUES
(6, 'Mr.', 'Zigha', 'Hugo', 'Hugo57', 'test@test.test', 'test', 'nulle part', 'Stras', '67000', 'France', '+33123456789');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
