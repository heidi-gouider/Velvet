-- phpMyAdmin SQL Dump
-- version 5.2.1deb3
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost:3306
-- Généré le : mer. 24 juil. 2024 à 11:09
-- Version du serveur : 10.11.8-MariaDB-0ubuntu0.24.04.1
-- Version de PHP : 8.2.20

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `Velvet`
--

-- --------------------------------------------------------

--
-- Structure de la table `artist`
--

CREATE TABLE `artist` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `artist`
--

INSERT INTO `artist` (`id`, `name`) VALUES
(1, 'Neil Young'),
(2, 'YES'),
(3, 'Rolling Stones'),
(4, 'Queens of the Stone Age'),
(5, 'Serge Gainsbourg'),
(6, 'AC/DC'),
(7, 'Marillion'),
(8, 'Bob Dylan'),
(9, 'Fleshtones'),
(10, 'The Clash'),
(23, 'Queens Of The Stone Age');

-- --------------------------------------------------------

--
-- Structure de la table `commande`
--

CREATE TABLE `commande` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `date_commande` date NOT NULL,
  `total` decimal(10,2) NOT NULL,
  `etat` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `commande`
--

INSERT INTO `commande` (`id`, `user_id`, `date_commande`, `total`, `etat`) VALUES
(1, 6, '2024-06-28', 4.00, 0),
(2, 6, '2024-06-28', 4.00, 0),
(3, 6, '2024-06-28', 15.00, 1),
(4, 6, '2024-06-28', 30.00, 1),
(5, 6, '2024-06-28', 99.00, 0),
(6, 6, '2024-06-28', 30.00, 0),
(7, 7, '2024-07-01', 45.00, 0),
(8, 7, '2024-07-01', 66.00, 0),
(9, 5, '2024-07-02', 20.00, 0),
(10, 8, '2024-07-03', 8.00, 0),
(11, 8, '2024-07-03', 0.00, 0),
(12, 8, '2024-07-03', 99.00, 0),
(13, 7, '2024-07-04', 12.00, 0),
(14, 7, '2024-07-04', 36.00, 0),
(15, 5, '2024-07-08', 75.00, 0),
(16, 5, '2024-07-09', 12.00, 0),
(17, 5, '2024-07-10', 28.00, 0),
(18, 5, '2024-07-11', 24.00, 0),
(19, 5, '2024-07-11', 28.00, 0),
(20, 5, '2024-07-11', 28.00, 0),
(21, 5, '2024-07-11', 45.00, 0),
(22, 5, '2024-07-11', 12.00, 0);

-- --------------------------------------------------------

--
-- Structure de la table `contact`
--

CREATE TABLE `contact` (
  `id` int(11) NOT NULL,
  `objet` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `message` longtext DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `detail`
--

CREATE TABLE `detail` (
  `id` int(11) NOT NULL,
  `disc_id` int(11) DEFAULT NULL,
  `commande_id` int(11) DEFAULT NULL,
  `quantity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `detail`
--

INSERT INTO `detail` (`id`, `disc_id`, `commande_id`, `quantity`) VALUES
(1, 193, 1, 1),
(2, 193, 2, 1),
(3, 198, 3, 1),
(4, 198, 4, 2),
(5, 203, 5, 3),
(6, 197, 6, 2),
(7, 198, 7, 3),
(8, 205, 8, 2),
(9, 195, 9, 1),
(10, 193, 10, 2),
(11, 206, 11, 3),
(12, 203, 12, 3),
(13, 193, 13, 3),
(14, 192, 14, 3),
(15, 198, 15, 5),
(16, 193, 16, 3),
(17, 191, 17, 2),
(18, 194, 18, 2),
(19, 191, 19, 2),
(20, 191, 20, 2),
(21, 197, 21, 3),
(22, 193, 22, 3);

-- --------------------------------------------------------

--
-- Structure de la table `disc`
--

CREATE TABLE `disc` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `picture` varchar(255) DEFAULT NULL,
  `artist_id` int(11) DEFAULT NULL,
  `prix` int(11) DEFAULT NULL,
  `label` varchar(255) NOT NULL,
  `quantite` int(11) NOT NULL,
  `quantite_vendu` int(11) DEFAULT NULL,
  `year` int(11) NOT NULL,
  `genre` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `disc`
--

INSERT INTO `disc` (`id`, `title`, `picture`, `artist_id`, `prix`, `label`, `quantite`, `quantite_vendu`, `year`, `genre`) VALUES
(191, 'Fugazi', 'Fugazi.jpeg', 7, 14, 'EMI', 15, NULL, 1984, 'Prog'),
(192, 'Songs for the Deaf', 'Songs for the Deaf.jpeg', 4, 12, 'Interscope Records', 20, NULL, 2002, 'Rock/Stoner'),
(193, 'Harvest Moon', 'Harvest Moon.jpeg', 1, 4, 'Reprise Records', 20, NULL, 1992, 'Rock'),
(194, 'Initials BB', 'Initials BB.jpeg', 5, 12, 'Philips', 10, NULL, 1968, 'Chanson/Pop Rock'),
(195, 'After the Gold Rush', 'After the Gold Rush.jpeg', 1, 18, 'Reprise Records', 15, NULL, 1970, 'Country Rock'),
(196, 'Broken Arrow', 'Broken Arrow.jpeg', 1, 15, 'Reprise Records', 10, NULL, 0, 'Country Rock'),
(197, 'Highway To Hell', 'Highway To Hell.jpeg', 6, 15, 'Atlantic', 3, NULL, 1979, 'Hard Rock'),
(198, 'Drama', 'Drama.jpeg', 2, 15, 'Atlantic', 0, NULL, 0, ''),
(199, 'Year of the Horse', 'Year of the Horse.jpeg', 1, 7, 'Reprise Records', 15, NULL, 0, 'Country Rock'),
(200, 'Ragged Glory', 'Ragged Glory.jpeg', 1, 11, 'Reprise Records', 20, NULL, 0, 'Rock'),
(201, 'Rust Never Sleeps', 'Rust Never Sleeps.jpeg', 1, 15, 'Reprise Records', 0, NULL, 0, ''),
(202, 'Exile on main street', 'Exile on main street.jpeg', 1, 33, 'Rolling Stones Records', 0, NULL, 0, ''),
(203, 'London Calling', 'London Calling.jpeg', 10, 33, 'CBS', 0, NULL, 0, ''),
(204, 'Beggars Banquet', 'Beggars Banquet.jpeg', 1, 33, 'Rolling Stones Records', 0, NULL, 0, ''),
(205, 'Laboratory of sound', 'Laboratory of sound.jpeg', 9, 33, 'Rebel Rec.', 15, NULL, 0, 'Hard Rock'),
(206, 'Songs for the Deaf', 'https://en.wikipedia.org/wiki/Songs_for_the_Deaf#/media/File:Queens_of_the_Stone_Age_-_Songs_for_the_Deaf.png', 23, NULL, 'Interscope Records', 0, NULL, 0, ''),
(207, 'test', 'fugazi.jpeg', 1, 20, 'test', 20, NULL, 0, '');

-- --------------------------------------------------------

--
-- Structure de la table `messenger_messages`
--

CREATE TABLE `messenger_messages` (
  `id` bigint(20) NOT NULL,
  `body` longtext NOT NULL,
  `headers` longtext NOT NULL,
  `queue_name` varchar(190) NOT NULL,
  `created_at` datetime NOT NULL COMMENT '(DC2Type:datetime_immutable)',
  `available_at` datetime NOT NULL COMMENT '(DC2Type:datetime_immutable)',
  `delivered_at` datetime DEFAULT NULL COMMENT '(DC2Type:datetime_immutable)'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `reset_password_request`
--

CREATE TABLE `reset_password_request` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `selector` varchar(20) NOT NULL,
  `hashed_token` varchar(100) NOT NULL,
  `requested_at` datetime NOT NULL COMMENT '(DC2Type:datetime_immutable)',
  `expires_at` datetime NOT NULL COMMENT '(DC2Type:datetime_immutable)'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `email` varchar(180) NOT NULL,
  `roles` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL COMMENT '(DC2Type:json)' CHECK (json_valid(`roles`)),
  `password` varchar(255) NOT NULL,
  `is_verified` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `user`
--

INSERT INTO `user` (`id`, `email`, `roles`, `password`, `is_verified`) VALUES
(5, 'lala@la.la', '[\"ROLE_ADMIN\"]', '$2y$13$d2vrygApq6kv58kcSKhosO4ch3JhsxNzJAAFHJLPitvZ2qLdb7wXS', 0),
(6, 'lili@li.li', '[]', '$2y$13$AhYsxnBZaSjuu4Qg1CpSp.bxYoBpurv6Da8Djz/LZIThQpe58s4ha', 0),
(7, 'mama@ma.ma', '[]', '$2y$13$Ap41N09btir57wMAB4H4t.MXABqtIZ9u7nQCwPCQOeOGs5MMgJvFi', 0),
(8, 'lolo@lo.lo', '[]', '$2y$13$AE4yrb81gZroQfnfTvJfVuaGEbd2HKRO6XTiSvzHKRcslgTRkS2si', 1),
(9, 'nini@ni.ni', '[]', '$2y$13$ewdB5/6n/QzTEWW33Fo4GOuIVrRNtql827AZdZUA1DVO1xY7KrS8O', 1);

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `artist`
--
ALTER TABLE `artist`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `commande`
--
ALTER TABLE `commande`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_6EEAA67DA76ED395` (`user_id`);

--
-- Index pour la table `contact`
--
ALTER TABLE `contact`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `detail`
--
ALTER TABLE `detail`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_2E067F93C38F37CA` (`disc_id`),
  ADD KEY `IDX_2E067F9382EA2E54` (`commande_id`);

--
-- Index pour la table `disc`
--
ALTER TABLE `disc`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_2AF5530B7970CF8` (`artist_id`);

--
-- Index pour la table `messenger_messages`
--
ALTER TABLE `messenger_messages`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_75EA56E0FB7336F0` (`queue_name`),
  ADD KEY `IDX_75EA56E0E3BD61CE` (`available_at`),
  ADD KEY `IDX_75EA56E016BA31DB` (`delivered_at`);

--
-- Index pour la table `reset_password_request`
--
ALTER TABLE `reset_password_request`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_7CE748AA76ED395` (`user_id`);

--
-- Index pour la table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `UNIQ_IDENTIFIER_EMAIL` (`email`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `artist`
--
ALTER TABLE `artist`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT pour la table `commande`
--
ALTER TABLE `commande`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT pour la table `contact`
--
ALTER TABLE `contact`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `detail`
--
ALTER TABLE `detail`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT pour la table `disc`
--
ALTER TABLE `disc`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=208;

--
-- AUTO_INCREMENT pour la table `messenger_messages`
--
ALTER TABLE `messenger_messages`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `reset_password_request`
--
ALTER TABLE `reset_password_request`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT pour la table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `commande`
--
ALTER TABLE `commande`
  ADD CONSTRAINT `FK_6EEAA67DA76ED395` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`);

--
-- Contraintes pour la table `detail`
--
ALTER TABLE `detail`
  ADD CONSTRAINT `FK_2E067F9382EA2E54` FOREIGN KEY (`commande_id`) REFERENCES `commande` (`id`),
  ADD CONSTRAINT `FK_2E067F93C38F37CA` FOREIGN KEY (`disc_id`) REFERENCES `disc` (`id`);

--
-- Contraintes pour la table `disc`
--
ALTER TABLE `disc`
  ADD CONSTRAINT `FK_2AF5530B7970CF8` FOREIGN KEY (`artist_id`) REFERENCES `artist` (`id`);

--
-- Contraintes pour la table `reset_password_request`
--
ALTER TABLE `reset_password_request`
  ADD CONSTRAINT `FK_7CE748AA76ED395` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
