-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3308
-- Généré le :  mar. 11 juin 2024 à 15:56
-- Version du serveur :  8.0.18
-- Version de PHP :  7.3.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `motion_case`
--

-- --------------------------------------------------------

--
-- Structure de la table `adresse`
--

DROP TABLE IF EXISTS `adresse`;
CREATE TABLE IF NOT EXISTS `adresse` (
  `id_adresse` int(11) NOT NULL AUTO_INCREMENT,
  `code_postale` varchar(50) NOT NULL,
  `commune` varchar(50) NOT NULL,
  `rue` varchar(50) NOT NULL,
  `complement` varchar(50) NOT NULL,
  PRIMARY KEY (`id_adresse`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `appartient`
--

DROP TABLE IF EXISTS `appartient`;
CREATE TABLE IF NOT EXISTS `appartient` (
  `Id_Coque` int(11) NOT NULL,
  `Id_couleur` int(11) NOT NULL,
  PRIMARY KEY (`Id_Coque`,`Id_couleur`),
  KEY `Appartient_Couleur0_FK` (`Id_couleur`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `appartient`
--

INSERT INTO `appartient` (`Id_Coque`, `Id_couleur`) VALUES
(1, 1),
(2, 8);

-- --------------------------------------------------------

--
-- Structure de la table `archives`
--

DROP TABLE IF EXISTS `archives`;
CREATE TABLE IF NOT EXISTS `archives` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

  --
  -- Structure de la table `cart`
  --

  DROP TABLE IF EXISTS `cart`;
  CREATE TABLE IF NOT EXISTS `cart` (
    `id_customer` int(11) NOT NULL,
    `libelleProduit` varchar(255) NOT NULL,
    `qteProduit` int(11) NOT NULL,
    `prixProduit` decimal(10,2) NOT NULL,
    `date_ajout` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY (`id_customer`)
  ) ENGINE=MyISAM AUTO_INCREMENT=53 DEFAULT CHARSET=utf8mb4;

  --
  -- Déchargement des données de la table `cart`
  --

  INSERT INTO `cart` (`id_customer`, `libelleProduit`, `qteProduit`, `prixProduit`, `date_ajout`) VALUES
  (8, 'Naruto', 1, '12.00', '2024-06-11 15:34:10');

  -- --------------------------------------------------------

  --
  -- Structure de la table `connexions`
  --

  DROP TABLE IF EXISTS `connexions`;
  CREATE TABLE IF NOT EXISTS `connexions` (
    `id` int(11) NOT NULL AUTO_INCREMENT,
    `login` varchar(255) NOT NULL,
    `datedeb` datetime NOT NULL,
    `datefin` datetime NOT NULL,
    PRIMARY KEY (`id`)
  ) ENGINE=MyISAM AUTO_INCREMENT=100 DEFAULT CHARSET=utf8;

  --
  -- Déchargement des données de la table `connexions`
  --

  INSERT INTO `connexions` (`id`, `login`, `datedeb`, `datefin`) VALUES
  (8, 'Mohamed', '2024-06-10 12:09:14', '0000-00-00 00:00:00'),
  (9, 'Mohamed', '2024-06-10 12:09:32', '0000-00-00 00:00:00'),
  (10, 'Mohamed', '2024-06-10 12:09:44', '0000-00-00 00:00:00'),
  (11, 'Mohamed', '2024-06-10 12:09:51', '2024-06-10 12:10:22'),
  (12, 'Mohamed', '2024-06-10 12:10:27', '2024-06-10 14:12:27'),
  (13, 'Mohamed', '2024-06-10 14:12:32', '0000-00-00 00:00:00'),
  (14, 'Mohamed', '2024-06-10 14:12:52', '0000-00-00 00:00:00'),
  (15, 'Mohamed', '2024-06-10 14:13:29', '2024-06-10 14:13:31'),
  (16, 'Mohamed', '2024-06-10 14:13:37', '2024-06-10 14:13:53'),
  (17, 'Mohamed', '2024-06-10 14:13:59', '0000-00-00 00:00:00'),
  (18, 'Mohamed', '2024-06-10 15:26:07', '0000-00-00 00:00:00'),
  (19, 'Mohamed', '2024-06-10 15:39:24', '0000-00-00 00:00:00'),
  (20, 'Mohamed', '2024-06-10 15:41:28', '0000-00-00 00:00:00'),
  (21, 'Mohamed', '2024-06-10 15:41:34', '0000-00-00 00:00:00'),
  (22, 'Mohamed', '2024-06-10 15:42:13', '2024-06-10 15:44:13'),
  (23, 'Mohamed', '2024-06-10 15:44:17', '2024-06-10 15:44:36'),
  (24, 'Mohamed', '2024-06-10 15:44:41', '2024-06-10 15:51:57'),
  (25, 'Mohamed', '2024-06-10 16:02:51', '2024-06-10 16:02:55'),
  (26, 'Mohamed', '2024-06-10 16:04:01', '2024-06-10 16:04:57'),
  (27, 'Mohamed', '2024-06-10 16:05:02', '0000-00-00 00:00:00'),
  (28, 'Mohamed', '2024-06-10 16:10:17', '0000-00-00 00:00:00'),
  (29, 'Mohamed', '2024-06-10 16:10:24', '0000-00-00 00:00:00'),
  (30, 'Mohamed', '2024-06-10 16:12:40', '0000-00-00 00:00:00'),
  (31, 'Mohamed', '2024-06-10 16:12:49', '0000-00-00 00:00:00'),
  (32, 'Mohamed', '2024-06-10 16:13:02', '2024-06-10 16:23:25'),
  (33, 'Mohamed', '2024-06-10 16:23:31', '2024-06-10 16:23:32'),
  (34, 'Mohamed', '2024-06-10 16:23:39', '2024-06-11 13:50:29'),
  (35, 'Mohamed', '2024-06-11 13:50:41', '2024-06-11 14:00:24'),
  (36, 'Mohamed', '2024-06-11 14:00:30', '0000-00-00 00:00:00'),
  (37, 'Mohamed', '2024-06-11 14:41:42', '0000-00-00 00:00:00'),
  (38, 'Mohamed', '2024-06-11 15:05:24', '0000-00-00 00:00:00'),
  (39, 'Mohamed', '2024-06-11 15:06:29', '0000-00-00 00:00:00'),
  (40, 'Mohamed', '2024-06-11 15:24:46', '0000-00-00 00:00:00'),
  (41, 'Mohamed', '2024-06-11 15:34:18', '0000-00-00 00:00:00'),
  (42, 'Mohamed', '2024-06-11 15:42:12', '0000-00-00 00:00:00'),
  (43, 'Mohamed', '2024-06-11 15:44:10', '0000-00-00 00:00:00'),
  (44, 'Mohamed', '2024-06-11 15:53:24', '0000-00-00 00:00:00'),
  (45, 'fred', '2024-06-11 15:54:05', '0000-00-00 00:00:00'),
  (46, 'fred', '2024-06-11 15:56:06', '0000-00-00 00:00:00'),
  (47, 'Mohamed', '2024-06-11 15:57:02', '0000-00-00 00:00:00'),
  (48, 'Mohamed', '2024-06-11 15:59:42', '0000-00-00 00:00:00'),
  (49, 'Mohamed', '2024-06-11 16:00:47', '0000-00-00 00:00:00'),
  (50, 'Mohamed', '2024-06-11 16:01:14', '0000-00-00 00:00:00'),
  (51, 'fred', '2024-06-11 16:01:43', '0000-00-00 00:00:00'),
  (52, 'fred', '2024-06-11 16:02:25', '0000-00-00 00:00:00'),
  (53, 'fred', '2024-06-11 16:02:52', '0000-00-00 00:00:00'),
  (54, 'Mohamed', '2024-06-11 16:13:28', '0000-00-00 00:00:00'),
  (55, 'Mohamed', '2024-06-11 16:17:02', '0000-00-00 00:00:00'),
  (56, 'Mohamed', '2024-06-11 16:17:36', '0000-00-00 00:00:00'),
  (57, 'Mohamed', '2024-06-11 16:19:55', '0000-00-00 00:00:00'),
  (58, 'Mohamed', '2024-06-11 16:20:38', '0000-00-00 00:00:00'),
  (59, 'Mohamed', '2024-06-11 16:21:21', '0000-00-00 00:00:00'),
  (60, 'Mohamed', '2024-06-11 16:23:41', '0000-00-00 00:00:00'),
  (61, 'Mohamed', '2024-06-11 16:24:22', '0000-00-00 00:00:00'),
  (62, 'Mohamed', '2024-06-11 16:25:14', '0000-00-00 00:00:00'),
  (63, 'Mohamed', '2024-06-11 16:25:34', '0000-00-00 00:00:00'),
  (64, 'Mohamed', '2024-06-11 16:25:59', '0000-00-00 00:00:00'),
  (65, 'Mohamed', '2024-06-11 16:30:27', '0000-00-00 00:00:00'),
  (66, 'Mohamed', '2024-06-11 16:31:09', '0000-00-00 00:00:00'),
  (67, 'Mohamed', '2024-06-11 16:40:53', '0000-00-00 00:00:00'),
  (68, 'Mohamed', '2024-06-11 16:52:55', '0000-00-00 00:00:00'),
  (69, 'Mohamed', '2024-06-11 16:55:03', '0000-00-00 00:00:00'),
  (70, 'Mohamed', '2024-06-11 16:56:12', '0000-00-00 00:00:00'),
  (71, 'Mohamed', '2024-06-11 16:58:20', '0000-00-00 00:00:00'),
  (72, 'Mohamed', '2024-06-11 17:00:15', '0000-00-00 00:00:00'),
  (73, 'Mohamed', '2024-06-11 17:05:16', '0000-00-00 00:00:00'),
  (74, 'fred', '2024-06-11 17:05:37', '0000-00-00 00:00:00'),
  (75, 'fred', '2024-06-11 17:05:49', '0000-00-00 00:00:00'),
  (76, 'fred', '2024-06-11 17:06:00', '0000-00-00 00:00:00'),
  (77, 'fred', '2024-06-11 17:06:08', '0000-00-00 00:00:00'),
  (78, 'Mohamed', '2024-06-11 17:09:15', '0000-00-00 00:00:00'),
  (79, 'fred', '2024-06-11 17:09:28', '0000-00-00 00:00:00'),
  (80, 'Mohamed', '2024-06-11 17:09:40', '0000-00-00 00:00:00'),
  (81, 'Mohamed', '2024-06-11 17:10:16', '0000-00-00 00:00:00'),
  (82, 'Mohamed', '2024-06-11 17:10:35', '0000-00-00 00:00:00'),
  (83, 'Mohamed', '2024-06-11 17:10:51', '0000-00-00 00:00:00'),
  (84, 'Mohamed', '2024-06-11 17:21:34', '0000-00-00 00:00:00'),
  (85, 'Mohamed', '2024-06-11 17:21:56', '0000-00-00 00:00:00'),
  (86, 'Mohamed', '2024-06-11 17:22:34', '0000-00-00 00:00:00'),
  (87, 'Mohamed', '2024-06-11 17:25:30', '0000-00-00 00:00:00'),
  (88, 'Mohamed', '2024-06-11 17:26:03', '0000-00-00 00:00:00'),
  (89, 'fred', '2024-06-11 17:26:25', '0000-00-00 00:00:00'),
  (90, 'Mohamed', '2024-06-11 17:26:52', '0000-00-00 00:00:00'),
  (91, 'Mohamed', '2024-06-11 17:27:20', '0000-00-00 00:00:00'),
  (92, 'Mohamed', '2024-06-11 17:28:24', '0000-00-00 00:00:00'),
  (93, 'Mohamed', '2024-06-11 17:30:06', '0000-00-00 00:00:00'),
  (94, 'Mohamed', '2024-06-11 17:33:43', '0000-00-00 00:00:00'),
  (95, 'Mohamed', '2024-06-11 17:34:03', '0000-00-00 00:00:00'),
  (96, 'Mohamed', '2024-06-11 17:35:50', '0000-00-00 00:00:00'),
  (97, 'Mohamed', '2024-06-11 17:48:22', '0000-00-00 00:00:00'),
  (98, 'Mohamed', '2024-06-11 17:53:09', '0000-00-00 00:00:00'),
  (99, 'Mohamed', '2024-06-11 17:53:22', '0000-00-00 00:00:00');

  -- --------------------------------------------------------

  --
  -- Structure de la table `coque`
  --

  DROP TABLE IF EXISTS `coque`;
  CREATE TABLE IF NOT EXISTS `coque` (
    `Id_Coque` int(11) NOT NULL AUTO_INCREMENT,
    `Prix` decimal(15,2) NOT NULL,
    `Marque` varchar(50) NOT NULL DEFAULT 'MotionCase',
    `description` longtext,
    `Id_motif` int(11) NOT NULL,
    `Id_modele` int(11) NOT NULL,
    PRIMARY KEY (`Id_Coque`),
    KEY `Id_Coque_Motif_FK` (`Id_motif`),
    KEY `Id_Coque_Modele0_FK` (`Id_modele`)
  ) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=utf8;

  --
  -- Déchargement des données de la table `coque`
  --

  INSERT INTO `coque` (`Id_Coque`, `Prix`, `Marque`, `description`, `Id_motif`, `Id_modele`) VALUES
  (1, '10.00', 'MotionCase', 'Coque avec un style neutre de toute beauté', 6, 1),
  (2, '12.00', 'MotionCase', 'Coque avec un style naruto majestueuse ', 1, 3),
  (3, '17.00', 'MotionCase', NULL, 4, 8),
  (4, '33.00', 'MotionCase', NULL, 9, 2),
  (5, '5.00', 'MotionCase', NULL, 2, 2),
  (6, '5.00', 'MotionCase', NULL, 8, 2),
  (7, '20.00', 'MotionCase', NULL, 10, 7),
  (8, '14.75', 'MotionCase', NULL, 11, 2),
  (9, '12.00', 'MotionCase', 'Coque incroyable au motif one piece', 12, 2);

  -- --------------------------------------------------------

  --
  -- Structure de la table `couleur`
  --

  DROP TABLE IF EXISTS `couleur`;
  CREATE TABLE IF NOT EXISTS `couleur` (
    `Id_couleur` int(11) NOT NULL AUTO_INCREMENT,
    `Nom` varchar(50) NOT NULL,
    PRIMARY KEY (`Id_couleur`)
  ) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8;

  --
  -- Déchargement des données de la table `couleur`
  --

  INSERT INTO `couleur` (`Id_couleur`, `Nom`) VALUES
  (1, 'Jaune'),
  (2, 'Noir'),
  (3, 'Rouge'),
  (4, 'Rose'),
  (5, 'Orange'),
  (6, 'Vert'),
  (7, 'Violet'),
  (8, 'Bleu'),
  (9, 'Marron'),
  (10, 'Gris '),
  (11, 'Blanc'),
  (12, 'Transparent');

  -- --------------------------------------------------------

  --
  -- Structure de la table `customer`
  --

  DROP TABLE IF EXISTS `customer`;
  CREATE TABLE IF NOT EXISTS `customer` (
    `id_customer` int(11) NOT NULL AUTO_INCREMENT,
    `login` varchar(50) NOT NULL,
    `mdp` varchar(255) NOT NULL,
    `mail` varchar(50) NOT NULL,
    `nom` varchar(50) NOT NULL,
    `prenom` varchar(50) NOT NULL,
    `id_cart` int(11) DEFAULT NULL,
    `admin` tinyint(1) NOT NULL,
    `id_cart_achat` int(11) DEFAULT NULL,
    PRIMARY KEY (`id_customer`),
    UNIQUE KEY `Customer_cart0_AK` (`id_cart_achat`)
  ) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8;

  --
  -- Déchargement des données de la table `customer`
  --

  INSERT INTO `customer` (`id_customer`, `login`, `mdp`, `mail`, `nom`, `prenom`, `id_cart`, `admin`, `id_cart_achat`) VALUES
  (7, 'Brenalax', '65e61df010e38c7651d759d84daba90fdd79dc14aa3617316501cb79da01e992', 'brenalax@gmail.com', 'Bryan', 'Test', NULL, 0, NULL),
  (8, 'Mohamed', '3100486406b39efc3f3d3565bc97cc3b9e2d7b6e3427b194f4442ef4beb05b41', 'momo@gmail.com', 'Haicheur', 'Test', NULL, 1, NULL),
  (9, 'fred', 'd0cfc2e5319b82cdc71a33873e826c93d7ee11363f8ac91c4fa3a2cfcd2286e5', 'fred@gmail.com', 'fred', 'Test', NULL, 0, NULL);

  -- --------------------------------------------------------

  --
  -- Structure de la table `livraison`
  --

  DROP TABLE IF EXISTS `livraison`;
  CREATE TABLE IF NOT EXISTS `livraison` (
    `id_customer` int(11) NOT NULL,
    `id_adresse` int(11) NOT NULL,
    PRIMARY KEY (`id_customer`,`id_adresse`),
    KEY `livraison_Adresse1_FK` (`id_adresse`)
  ) ENGINE=InnoDB DEFAULT CHARSET=utf8;

  -- --------------------------------------------------------

  --
  -- Structure de la table `modele`
  --

  DROP TABLE IF EXISTS `modele`;
  CREATE TABLE IF NOT EXISTS `modele` (
    `Id_modele` int(11) NOT NULL AUTO_INCREMENT,
    `modele` varchar(50) DEFAULT NULL,
    PRIMARY KEY (`Id_modele`)
  ) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8;

  --
  -- Déchargement des données de la table `modele`
  --

  INSERT INTO `modele` (`Id_modele`, `modele`) VALUES
  (1, '14 Pro max'),
  (2, '14 Pro '),
  (3, '14 '),
  (4, '13 Pro Max '),
  (5, '13 Pro'),
  (6, '13'),
  (7, '13 Mini'),
  (8, '12 Pro Max '),
  (9, '12 Pro'),
  (10, '12'),
  (11, '11 Pro Max'),
  (12, '11 Pro'),
  (13, '11 '),
  (14, 'Xs Max'),
  (15, 'Xs '),
  (16, 'X'),
  (17, 'Xr '),
  (18, '12 Mini');

  -- --------------------------------------------------------

  --
  -- Structure de la table `motif`
  --

  DROP TABLE IF EXISTS `motif`;
  CREATE TABLE IF NOT EXISTS `motif` (
    `Id_motif` int(11) NOT NULL AUTO_INCREMENT,
    `motif` varchar(50) NOT NULL,
    PRIMARY KEY (`Id_motif`)
  ) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8;

  --
  -- Déchargement des données de la table `motif`
  --

  INSERT INTO `motif` (`Id_motif`, `motif`) VALUES
  (1, 'Naruto'),
  (2, 'One piece '),
  (3, 'Disney'),
  (4, 'Dragon Ball '),
  (5, 'Animaux'),
  (6, 'Neutre'),
  (7, 'Basketball'),
  (8, 'Football'),
  (9, 'Star Wars'),
  (10, 'Nature'),
  (11, 'Harry Potter '),
  (12, 'Marvel'),
  (13, 'Artiste');

  --
  -- Contraintes pour les tables déchargées
  --

  --
  -- Contraintes pour la table `appartient`
  --
  ALTER TABLE `appartient`
    ADD CONSTRAINT `Appartient_Couleur0_FK` FOREIGN KEY (`Id_couleur`) REFERENCES `couleur` (`Id_couleur`),
    ADD CONSTRAINT `Appartient_Id_Coque_FK` FOREIGN KEY (`Id_Coque`) REFERENCES `coque` (`Id_Coque`);

  --
  -- Contraintes pour la table `coque`
  --
  ALTER TABLE `coque`
    ADD CONSTRAINT `Id_Coque_Modele0_FK` FOREIGN KEY (`Id_modele`) REFERENCES `modele` (`Id_modele`),
    ADD CONSTRAINT `Id_Coque_Motif_FK` FOREIGN KEY (`Id_motif`) REFERENCES `motif` (`Id_motif`);

  --
  -- Contraintes pour la table `customer`
  --
  ALTER TABLE `customer`
    ADD CONSTRAINT `Customer_cart0_FK` FOREIGN KEY (`id_cart_achat`) REFERENCES `cart` (`id`);

  --
  -- Contraintes pour la table `livraison`
  --
  ALTER TABLE `livraison`
    ADD CONSTRAINT `livraison_Adresse1_FK` FOREIGN KEY (`id_adresse`) REFERENCES `adresse` (`id_adresse`),
    ADD CONSTRAINT `livraison_Customer0_FK` FOREIGN KEY (`id_customer`) REFERENCES `customer` (`id_customer`);
  COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
