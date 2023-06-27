-- phpMyAdmin SQL Dump
-- version 4.9.5deb2
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost:3306
-- Généré le : mar. 27 juin 2023 à 18:13
-- Version du serveur :  10.3.34-MariaDB-0ubuntu0.20.04.1
-- Version de PHP : 7.4.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `soccer-marketplace`
--

-- --------------------------------------------------------

--
-- Structure de la table `messenger_messages`
--

CREATE TABLE `messenger_messages` (
  `id` bigint(20) NOT NULL,
  `body` longtext COLLATE utf8_unicode_ci NOT NULL,
  `headers` longtext COLLATE utf8_unicode_ci NOT NULL,
  `queue_name` varchar(190) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` datetime NOT NULL COMMENT '(DC2Type:datetime_immutable)',
  `available_at` datetime NOT NULL COMMENT '(DC2Type:datetime_immutable)',
  `delivered_at` datetime DEFAULT NULL COMMENT '(DC2Type:datetime_immutable)'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `players`
--

CREATE TABLE `players` (
  `id` int(11) NOT NULL,
  `team_id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `surname` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `up_for_sale` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Déchargement des données de la table `players`
--

INSERT INTO `players` (`id`, `team_id`, `name`, `surname`, `up_for_sale`) VALUES
(1, 1, 'Lionel', 'Messi', 1),
(2, 2, 'Christiano', 'Ronaldo', 0),
(3, 4, 'Zinedine', 'Zidane', 0),
(4, 2, 'Laurent', 'Blanc', 0),
(5, 5, 'Christian', 'Mbapé', 1),
(7, 5, 'Ronaldino', 'Onterio', 1),
(8, 3, 'Ronaldo', 'Yeno', 0),
(9, 5, 'David', 'Trezeguet', 1),
(10, 8, 'Malabar', 'Rado', 0),
(11, 9, 'Andrianarison', 'Haja', 0),
(12, 1, 'Paul', 'Amember', 0),
(13, 3, 'Ernest', 'André', 1),
(14, 3, 'Yglesias', 'Toro', 1),
(15, 6, 'Arnold', 'Ezaico', 1),
(16, 6, 'Remi', 'Perou', 1),
(17, 6, 'Alain', 'Dylan', 0);

-- --------------------------------------------------------

--
-- Structure de la table `sales`
--

CREATE TABLE `sales` (
  `id` int(11) NOT NULL,
  `player_id` int(11) NOT NULL,
  `amount` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Déchargement des données de la table `sales`
--

INSERT INTO `sales` (`id`, `player_id`, `amount`) VALUES
(1, 7, 500000),
(2, 5, 250000),
(3, 7, 600000),
(4, 7, 600000),
(5, 9, 100000),
(6, 9, 100000),
(7, 9, 150000),
(8, 1, 300000),
(10, 3, 400000),
(11, 13, 150000),
(12, 14, 125000),
(13, 15, 175000),
(14, 16, 100000);

-- --------------------------------------------------------

--
-- Structure de la table `teams`
--

CREATE TABLE `teams` (
  `id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `country` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `money_balance` double NOT NULL,
  `owner` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Déchargement des données de la table `teams`
--

INSERT INTO `teams` (`id`, `name`, `country`, `money_balance`, `owner`) VALUES
(1, 'team 1', 'France', 2600000, 'testeur1@bocasay.com'),
(2, 'team 2', 'Madagascar', 3000000, 'testeur2@bocasay.com'),
(3, 'team 3', 'Angleterre', 1000000, 'testeur3@bocasay.com'),
(4, 'team 4', 'Angleterre', 9200000, 'schantave@bocasay.com'),
(5, 'team 5', 'Senegal', 2000000, 'schantave@bocasay.com'),
(6, 'team 6', 'Nigeria', 40000000, 'user@com.com'),
(7, 'team 7', 'Angleterre', 100000000, 'user@com.com'),
(8, 'team 8', 'Madagascar', 3000000, 'schantave@bocasay.com'),
(9, 'team 9', 'Madagascar', 10000000, 'schantave@bocasay.com'),
(10, 'team 10', 'Madagascar', 3000000, 'testeur10@com.com'),
(11, 'team 11', 'Madagascar', 10000000, 'testeur11@com.com');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `messenger_messages`
--
ALTER TABLE `messenger_messages`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_75EA56E0FB7336F0` (`queue_name`),
  ADD KEY `IDX_75EA56E0E3BD61CE` (`available_at`),
  ADD KEY `IDX_75EA56E016BA31DB` (`delivered_at`);

--
-- Index pour la table `players`
--
ALTER TABLE `players`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_264E43A6296CD8AE` (`team_id`);

--
-- Index pour la table `sales`
--
ALTER TABLE `sales`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_6B81704499E6F5DF` (`player_id`);

--
-- Index pour la table `teams`
--
ALTER TABLE `teams`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `messenger_messages`
--
ALTER TABLE `messenger_messages`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `players`
--
ALTER TABLE `players`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT pour la table `sales`
--
ALTER TABLE `sales`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT pour la table `teams`
--
ALTER TABLE `teams`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `players`
--
ALTER TABLE `players`
  ADD CONSTRAINT `FK_264E43A6296CD8AE` FOREIGN KEY (`team_id`) REFERENCES `teams` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `sales`
--
ALTER TABLE `sales`
  ADD CONSTRAINT `FK_6B81704499E6F5DF` FOREIGN KEY (`player_id`) REFERENCES `players` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
