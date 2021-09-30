-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le :  mar. 27 avr. 2021 à 16:34
-- Version du serveur :  5.7.23
-- Version de PHP :  7.2.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `chromatique`
--

-- --------------------------------------------------------

--
-- Structure de la table `chapters`
--

DROP TABLE IF EXISTS `chapters`;
CREATE TABLE IF NOT EXISTS `chapters` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `chapter_name` varchar(45) DEFAULT NULL COMMENT 'nom du chapitre',
  `chapter_number` int(11) NOT NULL COMMENT 'numero du chapitre',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `tomes_id` int(10) UNSIGNED NOT NULL,
  PRIMARY KEY (`id`,`tomes_id`),
  UNIQUE KEY `id_UNIQUE` (`id`),
  KEY `fk_chapters_tomes1_idx` (`tomes_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `chapters`
--

INSERT INTO `chapters` (`id`, `chapter_name`, `chapter_number`, `created_at`, `updated_at`, `tomes_id`) VALUES
(2, '932', 932, '2021-04-20 22:00:00', NULL, 1),
(3, '933', 933, '2021-04-21 22:00:00', NULL, 1);

-- --------------------------------------------------------

--
-- Structure de la table `mangas`
--

DROP TABLE IF EXISTS `mangas`;
CREATE TABLE IF NOT EXISTS `mangas` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `manga_name` varchar(45) DEFAULT NULL COMMENT 'Nom du manga',
  `author` varchar(45) DEFAULT NULL COMMENT 'Auteur du manga',
  `synopsis` mediumtext COMMENT 'Résumé du manga',
  `manga_jacket` varchar(255) NOT NULL COMMENT 'Couverture du manga',
  `manga_banner` varchar(45) DEFAULT NULL COMMENT 'bannière de page du manga',
  `manga_directory` varchar(60) DEFAULT NULL,
  `home_order` int(11) DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `users_id` int(10) UNSIGNED NOT NULL,
  `chapter_id` int(11) NOT NULL,
  PRIMARY KEY (`id`,`users_id`),
  UNIQUE KEY `id_UNIQUE` (`id`),
  KEY `fk_mangas_users1_idx` (`users_id`)
) ENGINE=InnoDB AUTO_INCREMENT=34 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `mangas`
--

INSERT INTO `mangas` (`id`, `manga_name`, `author`, `synopsis`, `manga_jacket`, `manga_banner`, `manga_directory`, `home_order`, `created_at`, `updated_at`, `users_id`, `chapter_id`) VALUES
(1, 'One Piece', NULL, NULL, '/tome_93/tome-93.jpg', NULL, '/One_Piece', 0, '2021-04-02 22:00:00', NULL, 1, 0),
(29, 'Dragon Ball Super', NULL, NULL, '/Dragon Ball Super/Dragon Ball Super.jpg', NULL, NULL, 0, '2021-04-18 14:55:32', '2021-04-18 14:55:32', 1, 0),
(30, 'Highschool of the dead', NULL, NULL, '/Highschool of the dead/Highschool of the dead.jpg', NULL, NULL, 0, '2021-04-18 14:56:57', '2021-04-18 14:56:57', 1, 0),
(31, 'Hunter X Hunter', NULL, NULL, '/Hunter X Hunter/Hunter X Hunter.jpg', NULL, NULL, 0, '2021-04-18 14:57:26', '2021-04-18 14:57:26', 1, 0),
(32, 'Naruto', NULL, NULL, '/Naruto/Naruto.jpg', NULL, NULL, 0, '2021-04-18 15:02:12', '2021-04-18 15:02:12', 1, 0),
(33, 'Demon Slayer', NULL, NULL, '/Demon Slayer/Demon Slayer.jpg', NULL, NULL, 0, '2021-04-18 15:02:30', '2021-04-18 15:02:30', 1, 0);

-- --------------------------------------------------------

--
-- Structure de la table `pages`
--

DROP TABLE IF EXISTS `pages`;
CREATE TABLE IF NOT EXISTS `pages` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `page_name` varchar(256) NOT NULL,
  `page_number` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `chapters_id` int(10) UNSIGNED DEFAULT NULL,
  `tome_id` int(11) NOT NULL,
  UNIQUE KEY `id_UNIQUE` (`id`),
  KEY `fk_pages_mangas1` (`chapters_id`)
) ENGINE=InnoDB AUTO_INCREMENT=54 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `pages`
--

INSERT INTO `pages` (`id`, `page_name`, `page_number`, `created_at`, `updated_at`, `chapters_id`, `tome_id`) VALUES
(6, '/One_Piece/tome_93/932-03.png', 3, NULL, NULL, 2, 1),
(7, '/One_Piece/tome_93/932-04.png', 1, NULL, NULL, 3, 1),
(51, '/One_Piece/tome_934/934-02.png', 2, '2021-04-27 14:05:18', '2021-04-27 14:05:18', NULL, 24),
(52, '/One_Piece/tome_934/934-03.png', 3, '2021-04-27 14:05:18', '2021-04-27 14:05:18', NULL, 24),
(53, '/One_Piece/tome_934/934-04.png', 4, '2021-04-27 14:05:18', '2021-04-27 14:05:18', NULL, 24);

-- --------------------------------------------------------

--
-- Structure de la table `tomes`
--

DROP TABLE IF EXISTS `tomes`;
CREATE TABLE IF NOT EXISTS `tomes` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `tome_name` varchar(45) NOT NULL COMMENT 'nom du tome',
  `views` int(11) DEFAULT NULL COMMENT 'nombre de vue du manga',
  `rankings` int(11) DEFAULT NULL COMMENT 'note du manga',
  `tome_jacket` varchar(45) DEFAULT NULL COMMENT 'couverture du tome',
  `tome_number` int(11) DEFAULT NULL COMMENT 'numero du tome',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `manga_id` int(10) UNSIGNED NOT NULL,
  PRIMARY KEY (`id`,`manga_id`),
  UNIQUE KEY `name_UNIQUE` (`tome_name`),
  UNIQUE KEY `id_UNIQUE` (`id`),
  KEY `fk_tomes_mangas1_idx` (`manga_id`)
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `tomes`
--

INSERT INTO `tomes` (`id`, `tome_name`, `views`, `rankings`, `tome_jacket`, `tome_number`, `created_at`, `updated_at`, `manga_id`) VALUES
(1, 'Tome 93', NULL, NULL, '/tome_93/tome-93.jpg', 93, '2021-04-02 22:00:00', NULL, 1),
(24, 'tome_934', NULL, NULL, '/tome_934/tome_934.png', 934, '2021-04-27 14:05:18', '2021-04-27 14:05:18', 1);

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `email` varchar(64) NOT NULL COMMENT 'e-mail de l''utilisateur',
  `password` varchar(64) NOT NULL COMMENT 'mdp de l''utilisateur',
  `pseudo` varchar(64) NOT NULL,
  `avatar` varchar(45) DEFAULT NULL,
  `role` enum('admin','reader','dev','uploader') NOT NULL DEFAULT 'reader' COMMENT 'Rôle du compte :\nAdmin\nDev\nReader\nUploader',
  `status` tinyint(3) DEFAULT '0' COMMENT '1 => actif 2 => désactivé/bloqué	',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email_UNIQUE` (`email`),
  UNIQUE KEY `id_UNIQUE` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `users`
--

INSERT INTO `users` (`id`, `email`, `password`, `pseudo`, `avatar`, `role`, `status`, `created_at`, `updated_at`) VALUES
(1, 'nicos.infso@test.fr', 'chromatique', 'Sieg', NULL, 'admin', 1, '2021-04-02 22:00:00', NULL),
(2, 'test@test.com', 'test', 'ken', NULL, 'reader', 0, '2021-04-16 22:00:00', NULL);

-- --------------------------------------------------------

--
-- Structure de la table `users_historys`
--

DROP TABLE IF EXISTS `users_historys`;
CREATE TABLE IF NOT EXISTS `users_historys` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `users_id` int(10) UNSIGNED NOT NULL,
  `mangas_id` int(10) UNSIGNED NOT NULL,
  `tomes_id` int(10) UNSIGNED NOT NULL,
  `chapters_id` int(10) UNSIGNED NOT NULL,
  `pages_id` int(10) UNSIGNED NOT NULL,
  PRIMARY KEY (`id`,`users_id`,`mangas_id`,`tomes_id`,`chapters_id`,`pages_id`),
  UNIQUE KEY `id_UNIQUE` (`id`),
  KEY `fk_users_historys_users1_idx` (`users_id`),
  KEY `fk_users_historys_mangas1_idx` (`mangas_id`),
  KEY `fk_users_historys_tomes1_idx` (`tomes_id`),
  KEY `fk_users_historys_chapters1_idx` (`chapters_id`),
  KEY `fk_users_historys_pages1_idx` (`pages_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `chapters`
--
ALTER TABLE `chapters`
  ADD CONSTRAINT `fk_chapters_tomes1` FOREIGN KEY (`tomes_id`) REFERENCES `tomes` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Contraintes pour la table `mangas`
--
ALTER TABLE `mangas`
  ADD CONSTRAINT `fk_mangas_users1` FOREIGN KEY (`users_id`) REFERENCES `users` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Contraintes pour la table `pages`
--
ALTER TABLE `pages`
  ADD CONSTRAINT `fk_pages_mangas1` FOREIGN KEY (`chapters_id`) REFERENCES `chapters` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `tomes`
--
ALTER TABLE `tomes`
  ADD CONSTRAINT `fk_tomes_mangas1` FOREIGN KEY (`manga_id`) REFERENCES `mangas` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Contraintes pour la table `users_historys`
--
ALTER TABLE `users_historys`
  ADD CONSTRAINT `fk_users_historys_chapters1` FOREIGN KEY (`chapters_id`) REFERENCES `chapters` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_users_historys_mangas1` FOREIGN KEY (`mangas_id`) REFERENCES `mangas` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_users_historys_pages1` FOREIGN KEY (`pages_id`) REFERENCES `pages` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_users_historys_tomes1` FOREIGN KEY (`tomes_id`) REFERENCES `tomes` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_users_historys_users1` FOREIGN KEY (`users_id`) REFERENCES `users` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
