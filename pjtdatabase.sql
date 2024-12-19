-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : mar. 17 déc. 2024 à 16:19
-- Version du serveur : 10.4.32-MariaDB
-- Version de PHP : 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `blogs`
--

-- --------------------------------------------------------

--
-- Structure de la table `client`
--

CREATE TABLE `client` (
  `id` int(11) NOT NULL,
  `Name` varchar(50) NOT NULL,
  `Last_Name` varchar(50) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `cpsw` varchar(255) NOT NULL,
  `status` varchar(100) DEFAULT NULL,
  `ban_until` timestamp NULL DEFAULT NULL,
  `reset_token` varchar(200) DEFAULT NULL,
  `reset_token_expiration` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `client`
--

INSERT INTO `client` (`id`, `Name`, `Last_Name`, `email`, `password`, `cpsw`, `status`, `ban_until`, `reset_token`, `reset_token_expiration`) VALUES
(1, 'loay', 'ben', 'fortloky09@gmail.com', 'louay1234', '', 'banned', '2024-12-16 23:00:00', 'f0b2e86f6d30ef5d8fbc0822d39e7d8d3e1f85323f5699b9ea09b251190d130cd777fce6170395e1d12d6f8e13efff566f60', '2024-12-17'),
(2, 'loay', 'lay', 'faceoff@gmail.com', '1234', '', NULL, NULL, NULL, NULL),
(3, 'fadi', 'fares', 'fadi@gmail.com', '1234', '', NULL, NULL, NULL, NULL),
(4, 'tiba', 't', 'tiba@gmail.com', '1234', '', NULL, NULL, NULL, NULL),
(5, 'taher', 't', 'taher@gmail.com', '1234', '', NULL, NULL, NULL, NULL),
(6, 'loay', 't', 'loay@gmail.com', '1234', '', NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Structure de la table `comments`
--

CREATE TABLE `comments` (
  `id` int(11) NOT NULL,
  `stryid` int(11) NOT NULL,
  `user` varchar(50) NOT NULL,
  `cmt` text NOT NULL,
  `dates` datetime NOT NULL,
  `likes` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `comments`
--

INSERT INTO `comments` (`id`, `stryid`, `user`, `cmt`, `dates`, `likes`) VALUES
(1, 3, 'loay', 'fue', '2024-12-05 20:13:00', 10),
(2, 3, 'loay', 'edit', '2024-12-05 20:38:00', 2),
(3, 1, 'loay', 'aaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa', '2024-12-06 08:09:00', 117),
(4, 2, 'loay', 'dhdhda', '2024-12-06 08:24:00', 2),
(6, 2, 'amin', 'tessssst', '2024-12-06 09:30:07', 2);

-- --------------------------------------------------------

--
-- Structure de la table `commentz`
--

CREATE TABLE `commentz` (
  `id` int(11) NOT NULL,
  `stryid` int(11) NOT NULL,
  `user` varchar(100) DEFAULT NULL,
  `message_text` text DEFAULT NULL,
  `voice_file_path` varchar(255) DEFAULT NULL,
  `gif_file_path` varchar(255) DEFAULT NULL,
  `message_type` enum('text','voice','gif') NOT NULL,
  `dates` timestamp NOT NULL DEFAULT current_timestamp(),
  `likes` int(11) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `commentz`
--

INSERT INTO `commentz` (`id`, `stryid`, `user`, `message_text`, `voice_file_path`, `gif_file_path`, `message_type`, `dates`, `likes`) VALUES
(1, 1, 'loay', 'jjjjjjjjjjjjjjjjj', NULL, NULL, 'text', '2024-12-09 16:27:06', 1),
(2, 1, 'loay', 'gggggif', NULL, 'uploads/gifs/1733761772_96633009-d1818000-1318-11eb-9f1d-7f914f4ccb16.gif', 'gif', '2024-12-09 16:29:32', 8),
(3, 1, 'loay', '', 'uploads/voice/67571b09d4b35.wav', NULL, 'voice', '2024-12-09 16:30:01', 4),
(5, 2, 'temp', 'tt', 'uploads/voice/67571fdfe6dd0.wav', 'uploads/gifs/1733763039_96633009-d1818000-1318-11eb-9f1d-7f914f4ccb16.gif', 'voice', '2024-12-09 16:50:39', 0),
(6, 1, 'loay', '', NULL, 'uploads/gifs/1733764027_ANPb.gif', 'gif', '2024-12-09 17:07:07', 0),
(7, 1, 'ahmed', 'test voice pulod', '../../uploads/voice/6758661b121be.wav', NULL, 'voice', '2024-12-10 16:02:35', 0),
(8, 2, 'test', 'test all', '../../uploads/voice/675bea840f852.wav', 'uploads/gifs/1734077060_tenor_1.gif', 'voice', '2024-12-13 08:04:20', 0),
(9, 2, 'temp', 'uesr ttetet', NULL, NULL, 'text', '2024-12-16 13:18:58', 0),
(15, 2, 'loay', 'vvvv', NULL, NULL, 'text', '2024-12-16 15:17:56', 0),
(16, 1, 'loay', 'newtestnew', NULL, NULL, 'text', '2024-12-16 15:23:14', 0),
(18, 1, 'loay', 'wow', NULL, NULL, 'text', '2024-12-16 15:25:57', 0);

-- --------------------------------------------------------

--
-- Structure de la table `donations`
--

CREATE TABLE `donations` (
  `name` varchar(255) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `phone` int(11) DEFAULT NULL,
  `bank` varchar(255) DEFAULT NULL,
  `account` int(11) DEFAULT NULL,
  `iban` int(11) DEFAULT NULL,
  `amount` float DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `donations`
--

INSERT INTO `donations` (`name`, `address`, `phone`, `bank`, `account`, `iban`, `amount`) VALUES
('Ahmed', 'ahmedbrahmi0@outlook.com', 2147483647, 'Amen Bank', 2147483647, 2147483647, 23),
('Youseef ', 'ahmedbrahmi530@gmail.com', 2147483647, 'STB', 2147483647, 2147483647, 23.5),
('Ali', 'ahmedbrahmi530@gmail.com', 2147483647, 'Poste Tunisienne', 110291022, 2147483647, 24),
('Ali', 'ahmedbrahmi530@gmail.com', 2147483647, 'Poste Tunisienne', 110291022, 2147483647, 24),
('Ali', 'ahmedbrahmi530@gmail.com', 2147483647, 'Poste Tunisienne', 2147483647, 2147483647, 25),
('Ahmed', 'ahmedbrahmi0@outlook.com', 2147483647, 'Amen Bank', 2147483647, 2147483647, 32.5);

-- --------------------------------------------------------

--
-- Structure de la table `evenements`
--

CREATE TABLE `evenements` (
  `Idevenement` int(11) NOT NULL,
  `Nomevenement` varchar(50) NOT NULL,
  `Lieuevenement` varchar(50) NOT NULL,
  `Dateevenement` date NOT NULL,
  `Prixevenement` varchar(40) NOT NULL,
  `Placedisponible` varchar(40) NOT NULL,
  `eventimage` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `evenements`
--

INSERT INTO `evenements` (`Idevenement`, `Nomevenement`, `Lieuevenement`, `Dateevenement`, `Prixevenement`, `Placedisponible`, `eventimage`) VALUES
(42, 'Rome', 'esprit', '2024-12-27', '140', '12/12', '675b622e15eb4_673e18d1ce8e1_service-1.jpg'),
(43, 'test', 'esprit', '2024-12-27', '150', '24/24', '675b669ff31ba_67404f3561cfc_service-2.jpg'),
(44, 'roma', 'roma', '2024-12-27', '2000', '11/11', '67607d0b9602f_images.jpg');

-- --------------------------------------------------------

--
-- Structure de la table `monuments`
--

CREATE TABLE `monuments` (
  `id` int(11) NOT NULL,
  `name` varchar(999) NOT NULL,
  `description` text NOT NULL,
  `price` float NOT NULL,
  `image` varchar(999) NOT NULL,
  `likes` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `monuments`
--

INSERT INTO `monuments` (`id`, `name`, `description`, `price`, `image`, `likes`) VALUES
(20, 'musee du louvre', 'jhfkrbjfknjr', 332445, 'img/louvre.jpg', 0),
(21, 'gafsa', 'gafsa blasa', 12, 'img/gafsa.jpg', 0),
(22, 'tour de pise', 'pise pise is nice ', 233232, 'img/pise.jpg', 0),
(23, '9asr el djemm', 'ihfuziufhgzrhjfgzif', 3345, 'img/jemm.jpg', 0),
(27, 'Tataouine', 'ehrbjfhrjf', 332445, 'img/tataouine.jpg', 0),
(28, 'gafsa', 'gafsa blasa', 3233, 'img/gafsa.jpg', 0),
(29, 'gafsa', 'gafsa blasa', 3233, 'img/gafsa.jpg', 0),
(30, 'tour de pise', 'ihfuziufhgzrhjfgzif', 332445, 'img/pise.jpg', 0),
(31, 'musee du louvre', 'ezhjbdhjezbdhjezb', 3233, 'img/louvre.jpg', 0),
(32, '9asr el djemm', 'jhfkrbjfknjr', 3233, 'img/jemm.jpg', 0),
(33, 'tour de pise', 'jhfkrbjfknjr', 332445, 'img/pise.jpg', 0);

-- --------------------------------------------------------

--
-- Structure de la table `notifications`
--

CREATE TABLE `notifications` (
  `id` int(11) NOT NULL,
  `message` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `notifications`
--

INSERT INTO `notifications` (`id`, `message`, `created_at`) VALUES
(1, 'New monument added: Tataouine', '2024-12-10 14:35:19'),
(2, 'New monument added: gafsa', '2024-12-10 14:37:41'),
(3, 'New monument added: gafsa', '2024-12-10 14:40:27'),
(4, 'New monument added: tour de pise', '2024-12-10 14:41:59'),
(5, 'New monument added: musee du louvre', '2024-12-10 14:42:59'),
(6, 'New monument added: 9asr el djemm', '2024-12-13 07:03:17'),
(7, 'New monument added: tour de pise', '2024-12-13 07:26:49');

-- --------------------------------------------------------

--
-- Structure de la table `orders`
--

CREATE TABLE `orders` (
  `OrderId` int(11) NOT NULL,
  `ProdId` int(11) NOT NULL,
  `fullName` varchar(255) NOT NULL,
  `phoneNumber` int(11) NOT NULL,
  `Clocation` varchar(255) NOT NULL,
  `Email` varchar(255) NOT NULL,
  `Productname` varchar(100) NOT NULL,
  `Productprice` int(11) NOT NULL,
  `Quantity` int(11) NOT NULL,
  `TotalPrice` int(11) NOT NULL,
  `DatePurchase` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `produitslist`
--

CREATE TABLE `produitslist` (
  `Idproduit` int(11) NOT NULL,
  `nomproduit` varchar(50) NOT NULL,
  `origin` varchar(50) NOT NULL,
  `prixproduit` int(11) NOT NULL,
  `nbrdisponible` int(11) NOT NULL,
  `imageproduit` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `reclamation`
--

CREATE TABLE `reclamation` (
  `id` int(11) NOT NULL,
  `nom` varchar(50) NOT NULL,
  `prenom` varchar(50) NOT NULL,
  `telephone` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `dates` date NOT NULL,
  `messages` text NOT NULL,
  `voice_file_path` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `reclamation`
--

INSERT INTO `reclamation` (`id`, `nom`, `prenom`, `telephone`, `email`, `dates`, `messages`, `voice_file_path`) VALUES
(1, 'loay', 'ben', 33200400, 'fortloky09@gmail.com', '2024-12-16', 'test', NULL),
(2, 'loay', 'ben', 33200400, 'fortloky09@gmail.com', '2024-12-16', 'base', NULL);

-- --------------------------------------------------------

--
-- Structure de la table `reponse`
--

CREATE TABLE `reponse` (
  `id` int(11) NOT NULL,
  `date_reponse` date NOT NULL,
  `reponse` text NOT NULL,
  `id_reclamations` int(11) NOT NULL,
  `evaluation` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `reponse`
--

INSERT INTO `reponse` (`id`, `date_reponse`, `reponse`, `id_reclamations`, `evaluation`) VALUES
(1, '2024-12-16', 'rep', 1, NULL);

-- --------------------------------------------------------

--
-- Structure de la table `reported_comments`
--

CREATE TABLE `reported_comments` (
  `id` int(11) NOT NULL,
  `comment_id` int(11) NOT NULL,
  `reported_by` varchar(50) NOT NULL,
  `report_reason` text NOT NULL,
  `report_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `reported_comments`
--

INSERT INTO `reported_comments` (`id`, `comment_id`, `reported_by`, `report_reason`, `report_date`) VALUES
(1, 3, 'adem', 'tesst', '2024-12-06'),
(2, 6, 'loay', 'ffffff', '2024-12-06'),
(3, 0, 'temp', 'ttttttttttttttttttttt', '2024-12-08'),
(4, 3, 'temp', 'fffffffffffffffffffffffffffffffff', '2024-12-08');

-- --------------------------------------------------------

--
-- Structure de la table `reservation`
--

CREATE TABLE `reservation` (
  `Nom` varchar(50) NOT NULL,
  `Prenom` varchar(50) NOT NULL,
  `CIN` int(11) NOT NULL,
  `eventname` varchar(70) NOT NULL,
  `eventdate` varchar(40) NOT NULL,
  `Baggage` int(11) NOT NULL,
  `dateReservation` datetime DEFAULT NULL,
  `Email` varchar(255) NOT NULL,
  `IdEvent` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `reservation`
--

INSERT INTO `reservation` (`Nom`, `Prenom`, `CIN`, `eventname`, `eventdate`, `Baggage`, `dateReservation`, `Email`, `IdEvent`) VALUES
('Sahli', 'Taher', 4232, 'Rome', '2024-12-27', 50, '2024-12-12 23:51:02', 'sahlitaher2003@gmail.com', 42),
('Sahli', 'sahli', 4324234, 'test', '2024-12-27', 80, '2024-12-13 09:40:08', 'sahlitaher2003@gmail.com', 43),
('Sahli', 'Taher', 15024438, 'Rome', '2024-12-27', 70, '2024-12-12 23:22:50', 'sahlitaher2003@gmail.com', 42),
('Sahli', 'Taher', 150244383, 'test', '2024-12-27', 100, '2024-12-12 23:42:02', 'sahlitaher2003@gmail.com', 43);

-- --------------------------------------------------------

--
-- Structure de la table `storys`
--

CREATE TABLE `storys` (
  `id` int(11) NOT NULL,
  `title` varchar(50) NOT NULL,
  `subjects` text NOT NULL,
  `dates` date NOT NULL,
  `adminuser` varchar(50) NOT NULL,
  `likes` int(11) NOT NULL,
  `eventimage` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `storys`
--

INSERT INTO `storys` (`id`, `title`, `subjects`, `dates`, `adminuser`, `likes`, `eventimage`) VALUES
(1, 'loay', 'subject', '2024-12-05', 'loay', 1, 'logo1.png'),
(2, '2', '2', '2024-12-05', '2', 2, 'logo1.png'),
(3, '3', '3', '2024-12-05', '3', 3, 'logo1.png'),
(4, '4', '4', '2024-12-05', '4', 4, 'logo1.png');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `client`
--
ALTER TABLE `client`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `stryid` (`stryid`);

--
-- Index pour la table `commentz`
--
ALTER TABLE `commentz`
  ADD PRIMARY KEY (`id`),
  ADD KEY `stryid` (`stryid`);

--
-- Index pour la table `evenements`
--
ALTER TABLE `evenements`
  ADD PRIMARY KEY (`Idevenement`);

--
-- Index pour la table `monuments`
--
ALTER TABLE `monuments`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `notifications`
--
ALTER TABLE `notifications`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`OrderId`);

--
-- Index pour la table `produitslist`
--
ALTER TABLE `produitslist`
  ADD PRIMARY KEY (`Idproduit`);

--
-- Index pour la table `reclamation`
--
ALTER TABLE `reclamation`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `reponse`
--
ALTER TABLE `reponse`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `reported_comments`
--
ALTER TABLE `reported_comments`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `reservation`
--
ALTER TABLE `reservation`
  ADD PRIMARY KEY (`CIN`),
  ADD KEY `fk1` (`IdEvent`);

--
-- Index pour la table `storys`
--
ALTER TABLE `storys`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `client`
--
ALTER TABLE `client`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT pour la table `comments`
--
ALTER TABLE `comments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT pour la table `commentz`
--
ALTER TABLE `commentz`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT pour la table `evenements`
--
ALTER TABLE `evenements`
  MODIFY `Idevenement` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;

--
-- AUTO_INCREMENT pour la table `monuments`
--
ALTER TABLE `monuments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT pour la table `notifications`
--
ALTER TABLE `notifications`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT pour la table `orders`
--
ALTER TABLE `orders`
  MODIFY `OrderId` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `produitslist`
--
ALTER TABLE `produitslist`
  MODIFY `Idproduit` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `reclamation`
--
ALTER TABLE `reclamation`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT pour la table `reponse`
--
ALTER TABLE `reponse`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT pour la table `reported_comments`
--
ALTER TABLE `reported_comments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT pour la table `storys`
--
ALTER TABLE `storys`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `comments`
--
ALTER TABLE `comments`
  ADD CONSTRAINT `comments_ibfk_1` FOREIGN KEY (`stryid`) REFERENCES `storys` (`id`);

--
-- Contraintes pour la table `commentz`
--
ALTER TABLE `commentz`
  ADD CONSTRAINT `commentz_ibfk_1` FOREIGN KEY (`stryid`) REFERENCES `storys` (`id`);

--
-- Contraintes pour la table `reservation`
--
ALTER TABLE `reservation`
  ADD CONSTRAINT `fk1` FOREIGN KEY (`IdEvent`) REFERENCES `evenements` (`Idevenement`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
