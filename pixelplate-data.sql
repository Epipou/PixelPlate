-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : ven. 18 avr. 2025 à 10:15
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
-- Déchargement des données de la table `menu`
--

INSERT INTO `menu` (`id`, `name`, `price`, `description`) VALUES
(18, 'Miam Mioum', 24, 'Un menu pour apprécier les premières chaleurs & épices du printemps');

--
-- Déchargement des données de la table `plate`
--

INSERT INTO `plate` (`id`, `name`, `description`, `image_spine`, `image_front`) VALUES
(15, 'Gombo', 'Okras mijotés, tomates et poivrons', '68018d8c56321_spine.jpg', '68018d8c62140_front.jpg'),
(16, 'Jambalaya', 'Jambalaya aux épices, crevettes et poulet', '68018efb9b9ae_spine.webp', '68018efb9f0eb_front.webp'),
(17, 'Armo de Tiron', 'Tourte à la citrouille et aux épices', '68018f274ca76_spine.jpg', '68018f274cdf3_front.jpg');

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

--
-- Déchargement des données de la table `menu_desserts`
--

INSERT INTO `menu_desserts` (`menu_id`, `plate_id`) VALUES
(18, 17);

--
-- Déchargement des données de la table `menu_entrees`
--

INSERT INTO `menu_entrees` (`menu_id`, `plate_id`) VALUES
(18, 15);

--
-- Déchargement des données de la table `menu_plats`
--

INSERT INTO `menu_plats` (`menu_id`, `plate_id`) VALUES
(18, 16);

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

COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
