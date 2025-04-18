-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : ven. 18 avr. 2025 à 10:14
-- Version du serveur : 8.3.0
-- Version de PHP : 8.2.18

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `pixelplate`
--

-- --------------------------------------------------------

--
-- Structure de la table `doctrine_migration_versions`
--

DROP TABLE IF EXISTS `doctrine_migration_versions`;
CREATE TABLE IF NOT EXISTS `doctrine_migration_versions` (
  `version` varchar(191) COLLATE utf8mb3_unicode_ci NOT NULL,
  `executed_at` datetime DEFAULT NULL,
  `execution_time` int DEFAULT NULL,
  PRIMARY KEY (`version`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

--
-- Déchargement des données de la table `doctrine_migration_versions`
--

INSERT INTO `doctrine_migration_versions` (`version`, `executed_at`, `execution_time`) VALUES
('DoctrineMigrations\\Version20250404132318', '2025-04-04 13:23:55', 102),
('DoctrineMigrations\\Version20250404133822', '2025-04-04 13:38:51', 31),
('DoctrineMigrations\\Version20250404134505', '2025-04-04 13:45:14', 110),
('DoctrineMigrations\\Version20250411145833', '2025-04-11 14:58:46', 53),
('DoctrineMigrations\\Version20250412190006', '2025-04-12 19:00:21', 68),
('DoctrineMigrations\\Version20250412191659', '2025-04-12 19:17:07', 14),
('DoctrineMigrations\\Version20250412191935', '2025-04-12 19:19:43', 13),
('DoctrineMigrations\\Version20250412201551', '2025-04-12 20:15:55', 14),
('DoctrineMigrations\\Version20250412213319', '2025-04-12 21:33:22', 371),
('DoctrineMigrations\\Version20250412222110', '2025-04-12 22:21:15', 177),
('DoctrineMigrations\\Version20250412223411', '2025-04-12 22:34:18', 479),
('DoctrineMigrations\\Version20250414210630', '2025-04-14 21:06:42', 57),
('DoctrineMigrations\\Version20250414221737', '2025-04-14 22:17:42', 22),
('DoctrineMigrations\\Version20250414222025', '2025-04-14 22:20:30', 12),
('DoctrineMigrations\\Version20250414222357', '2025-04-14 22:24:02', 14),
('DoctrineMigrations\\Version20250414222909', '2025-04-14 22:29:15', 13),
('DoctrineMigrations\\Version20250416161615', '2025-04-16 16:16:29', 55);

-- --------------------------------------------------------

--
-- Structure de la table `menu`
--

DROP TABLE IF EXISTS `menu`;
CREATE TABLE IF NOT EXISTS `menu` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `price` double NOT NULL,
  `description` longtext COLLATE utf8mb4_unicode_ci,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `menu`
--

INSERT INTO `menu` (`id`, `name`, `price`, `description`) VALUES
(18, 'Miam Mioum', 24, 'Un menu pour apprécier les premières chaleurs & épices du printemps');

-- --------------------------------------------------------

--
-- Structure de la table `menu_desserts`
--

DROP TABLE IF EXISTS `menu_desserts`;
CREATE TABLE IF NOT EXISTS `menu_desserts` (
  `menu_id` int NOT NULL,
  `plate_id` int NOT NULL,
  PRIMARY KEY (`menu_id`,`plate_id`),
  KEY `IDX_2E4A95F7CCD7E912` (`menu_id`),
  KEY `IDX_2E4A95F7DF66E98B` (`plate_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `menu_desserts`
--

INSERT INTO `menu_desserts` (`menu_id`, `plate_id`) VALUES
(18, 17);

-- --------------------------------------------------------

--
-- Structure de la table `menu_entrees`
--

DROP TABLE IF EXISTS `menu_entrees`;
CREATE TABLE IF NOT EXISTS `menu_entrees` (
  `menu_id` int NOT NULL,
  `plate_id` int NOT NULL,
  PRIMARY KEY (`menu_id`,`plate_id`),
  KEY `IDX_AC39571FCCD7E912` (`menu_id`),
  KEY `IDX_AC39571FDF66E98B` (`plate_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `menu_entrees`
--

INSERT INTO `menu_entrees` (`menu_id`, `plate_id`) VALUES
(18, 15);

-- --------------------------------------------------------

--
-- Structure de la table `menu_plats`
--

DROP TABLE IF EXISTS `menu_plats`;
CREATE TABLE IF NOT EXISTS `menu_plats` (
  `menu_id` int NOT NULL,
  `plate_id` int NOT NULL,
  PRIMARY KEY (`menu_id`,`plate_id`),
  KEY `IDX_14E6416DCCD7E912` (`menu_id`),
  KEY `IDX_14E6416DDF66E98B` (`plate_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `menu_plats`
--

INSERT INTO `menu_plats` (`menu_id`, `plate_id`) VALUES
(18, 16);

-- --------------------------------------------------------

--
-- Structure de la table `messenger_messages`
--

DROP TABLE IF EXISTS `messenger_messages`;
CREATE TABLE IF NOT EXISTS `messenger_messages` (
  `id` bigint NOT NULL AUTO_INCREMENT,
  `body` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `headers` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue_name` varchar(190) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` datetime NOT NULL COMMENT '(DC2Type:datetime_immutable)',
  `available_at` datetime NOT NULL COMMENT '(DC2Type:datetime_immutable)',
  `delivered_at` datetime DEFAULT NULL COMMENT '(DC2Type:datetime_immutable)',
  PRIMARY KEY (`id`),
  KEY `IDX_75EA56E0FB7336F0` (`queue_name`),
  KEY `IDX_75EA56E0E3BD61CE` (`available_at`),
  KEY `IDX_75EA56E016BA31DB` (`delivered_at`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `plate`
--

DROP TABLE IF EXISTS `plate`;
CREATE TABLE IF NOT EXISTS `plate` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `image_spine` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image_front` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `plate`
--

INSERT INTO `plate` (`id`, `name`, `description`, `image_spine`, `image_front`) VALUES
(15, 'Gombo', 'Okras mijotés, tomates et poivrons', '68018d8c56321_spine.jpg', '68018d8c62140_front.jpg'),
(16, 'Jambalaya', 'Jambalaya aux épices, crevettes et poulet', '68018efb9b9ae_spine.webp', '68018efb9f0eb_front.webp'),
(17, 'Armo de Tiron', 'Tourte à la citrouille et aux épices', '68018f274ca76_spine.jpg', '68018f274cdf3_front.jpg');

-- --------------------------------------------------------

--
-- Structure de la table `reservation`
--

DROP TABLE IF EXISTS `reservation`;
CREATE TABLE IF NOT EXISTS `reservation` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nb_couverts` int NOT NULL,
  `date` date NOT NULL,
  `horaire` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `civilite` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `prenom` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nom` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `telephone` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` int DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_42C84955A76ED395` (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `reservation`
--

INSERT INTO `reservation` (`id`, `nb_couverts`, `date`, `horaire`, `civilite`, `prenom`, `nom`, `telephone`, `email`, `user_id`) VALUES
(2, 6, '2025-04-16', '11:30', 'Monsieur', 'test1', 'test1', '0123456789', 'test1@test.fr', 33),
(3, 6, '2025-04-16', '11:30', 'Monsieur', 'qdqds', 'fsfsf', '0123456789', 'fdfg@sdfisf.fr', 33),
(4, 5, '2025-04-16', '11:30', 'Mx', 'jacques', 'dupont', '0123456789', 'oisdfis@oisdf.fr', 33),
(5, 3, '2025-04-16', '11:30', 'Monsieur', 'fdsfs', 'sdfsfs', '0123456789', 'oisoidfsfsfd', 33),
(6, 6, '2025-04-16', '11:30', 'Monsieur', 'qdqds', 'gdgdfg', '0123456789', 'jbkifsdf@tesiof', 33),
(7, 6, '2025-04-16', '11:30', 'Monsieur', 'qsdqsd', 'qgdg', 'sdgfs', 'sdfsdf', 33),
(8, 4, '2025-04-16', '11:30', 'Monsieur', 'dfsfd', 'sdfsfd', 'sdfsfdsf', 'sdfsdf', 33),
(13, 5, '2025-04-16', '13:30', 'Monsieur', 'test6', 'test6', '0123456789', 'test6@test.fr', 37),
(17, 3, '2025-04-17', '11:30', 'Monsieur', 'test1', 'test1', '0123456789', 'test1@test.fr', 33),
(18, 1, '2025-04-24', '11:30', 'Monsieur', 'test1', 'test1', '0123456789', 'test1@test.fr', 33),
(19, 1, '2025-04-17', '11:30', 'Monsieur', 'test1', 'test1', '0123456789', 'test1@test.fr', 33),
(20, 1, '2025-04-24', '11:30', 'Monsieur', 'test2000', 'test2000', '0123456789', 'test2000@test.fr', 41),
(21, 1, '2025-04-24', '11:30', 'Monsieur', 'test1', 'test1', '0123456789', 'test1@test.fr', 33),
(22, 1, '2025-04-29', '11:30', 'Monsieur', 'test1', 'test1', '0123456789', 'test1@test.fr', 33),
(23, 4, '2025-04-17', '11:30', 'Monsieur', 'test1', 'test1', '0123456789', 'test1@test.fr', 33);

-- --------------------------------------------------------

--
-- Structure de la table `reservation_restaurant_table`
--

DROP TABLE IF EXISTS `reservation_restaurant_table`;
CREATE TABLE IF NOT EXISTS `reservation_restaurant_table` (
  `reservation_id` int NOT NULL,
  `restaurant_table_id` int NOT NULL,
  PRIMARY KEY (`reservation_id`,`restaurant_table_id`),
  KEY `IDX_B36BD51FB83297E7` (`reservation_id`),
  KEY `IDX_B36BD51FCC5AE6B3` (`restaurant_table_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `reservation_restaurant_table`
--

INSERT INTO `reservation_restaurant_table` (`reservation_id`, `restaurant_table_id`) VALUES
(2, 2),
(3, 2),
(4, 1),
(5, 3),
(6, 5),
(6, 11),
(7, 4),
(8, 6),
(13, 9),
(13, 10),
(13, 12),
(17, 1),
(18, 2),
(19, 2),
(20, 1),
(21, 5),
(22, 1),
(23, 3);

-- --------------------------------------------------------

--
-- Structure de la table `restaurant_table`
--

DROP TABLE IF EXISTS `restaurant_table`;
CREATE TABLE IF NOT EXISTS `restaurant_table` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `capacity` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `restaurant_table`
--

INSERT INTO `restaurant_table` (`id`, `name`, `capacity`) VALUES
(1, 'T1', 6),
(2, 'T2', 6),
(3, 'T3', 6),
(4, 'T4', 6),
(5, 'T5', 4),
(6, 'T6', 4),
(7, 'T7', 4),
(8, 'T8', 4),
(9, 'T9', 2),
(10, 'T10', 2),
(11, 'T11', 2),
(12, 'T12', 2),
(13, 'T13', 2);

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

DROP TABLE IF EXISTS `user`;
CREATE TABLE IF NOT EXISTS `user` (
  `id` int NOT NULL AUTO_INCREMENT,
  `email` varchar(180) COLLATE utf8mb4_unicode_ci NOT NULL,
  `roles` json NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `civilite` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `prenom` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `nom` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `telephone` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_IDENTIFIER_EMAIL` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=42 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `user`
--

INSERT INTO `user` (`id`, `email`, `roles`, `password`, `name`, `civilite`, `prenom`, `nom`, `telephone`) VALUES
(32, 'admin@pixelplate.com', '[\"ROLE_USER\", \"ROLE_ADMIN\"]', '$2y$13$RBfZX02aD0ohplNLPg7CPel6p3qHG3K24Pah6iRd4V0DoxzHpvY7i', 'Admin', NULL, NULL, NULL, NULL),
(33, 'test1@test.fr', '[\"ROLE_USER\", \"ROLE_ADMIN\"]', '$2y$13$sLitkuL03hiuaYl6UJZ2.erzAmR5chXbLYiwyeor47wAnCzCE/Bpu', 'test1', 'Monsieur', 'test1', 'test1', '0123456789'),
(34, 'test2@test.fr', '[\"ROLE_USER\", \"ROLE_ADMIN\"]', '$2y$13$DcXf/Oa8FkJNBuisd9vJyeKdWLqr8f3guSGABxkg9FgYD9dtQDF4q', 'test2', NULL, NULL, NULL, NULL),
(35, 'test4000@test.fr', '[\"ROLE_USER\", \"ROLE_ADMIN\"]', '$2y$13$7QXUQmXHVJpdyu2R3WehAOhGaikwNKYJJrkNpyIrJtYptLIJaWUEq', 'test4000', NULL, NULL, NULL, NULL),
(36, 'test50@test.fr', '[\"ROLE_USER\", \"ROLE_ADMIN\"]', '$2y$13$ADLoGLM38CwYYUcdH0XSbOMis6oUEmTTGpk34PsMeZ3M8KN.arrF2', 'test50', NULL, NULL, NULL, NULL),
(37, 'test6@test.fr', '[\"ROLE_USER\"]', '$2y$13$KDHeTdvqLnmtmZyTthMCjeiHykRS3hqlDI3oXIHO0EA/pjYFFoPoG', 'test6', 'Monsieur', 'je change de prenom', 'je change de nom', 'fsiodfsf'),
(38, 'test7@test.fr', '[]', '$2y$13$7P.6LZ3Drh21c7j6bnE0/Oe9XGjxWSJQLoNnphg39WbZ1dBAyiuuK', 'test7', 'Monsieur', 'test7(7)ghfghfgh', 'test7(7)fghfdfgd', '0123456789'),
(39, 'dqsdqsdqd', '[]', '$2y$13$RrVdXaZSXyEpyQxLjVETE.aWfWfdPcY7I85TeHEw9a9UjCCXUfjnK', 'dqsdqsdqsd', NULL, NULL, NULL, NULL),
(40, 'test18@test.fr', '[]', '$2y$13$Pxh5MkSsJGo8Lh6.5RHr.OdHMVpI8kg.XtNxEioXsjBXMGMBhAaVq', 'test18', NULL, NULL, NULL, NULL),
(41, 'test2000@test.fr', '[]', '$2y$13$9GD3ry76PAkmxzwoOHtBm./ORcoRsouMyX8kBWQ6iWAse0RLT67Wa', 'test2000', 'Monsieur', 'test2000', 'test2000', '0123456789');

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `menu_desserts`
--
ALTER TABLE `menu_desserts`
  ADD CONSTRAINT `FK_2E4A95F7CCD7E912` FOREIGN KEY (`menu_id`) REFERENCES `menu` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `FK_2E4A95F7DF66E98B` FOREIGN KEY (`plate_id`) REFERENCES `plate` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `menu_entrees`
--
ALTER TABLE `menu_entrees`
  ADD CONSTRAINT `FK_AC39571FCCD7E912` FOREIGN KEY (`menu_id`) REFERENCES `menu` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `FK_AC39571FDF66E98B` FOREIGN KEY (`plate_id`) REFERENCES `plate` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `menu_plats`
--
ALTER TABLE `menu_plats`
  ADD CONSTRAINT `FK_14E6416DCCD7E912` FOREIGN KEY (`menu_id`) REFERENCES `menu` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `FK_14E6416DDF66E98B` FOREIGN KEY (`plate_id`) REFERENCES `plate` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `reservation`
--
ALTER TABLE `reservation`
  ADD CONSTRAINT `FK_42C84955A76ED395` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`);

--
-- Contraintes pour la table `reservation_restaurant_table`
--
ALTER TABLE `reservation_restaurant_table`
  ADD CONSTRAINT `FK_B36BD51FB83297E7` FOREIGN KEY (`reservation_id`) REFERENCES `reservation` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `FK_B36BD51FCC5AE6B3` FOREIGN KEY (`restaurant_table_id`) REFERENCES `restaurant_table` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
