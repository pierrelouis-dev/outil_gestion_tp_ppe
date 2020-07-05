-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : Dim 05 juil. 2020 à 22:01
-- Version du serveur :  10.4.11-MariaDB
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
-- Base de données : `outils_geestion_tp_ppe`
--

-- --------------------------------------------------------

--
-- Structure de la table `creer`
--

CREATE TABLE `creer` (
  `fk_id_tp` int(11) NOT NULL,
  `fk_id_promo` int(11) NOT NULL,
  `fk_id_prof` int(11) NOT NULL,
  `fk_id_option` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Structure de la table `eleve`
--

CREATE TABLE `eleve` (
  `id_eleve` int(11) NOT NULL,
  `login` varchar(255) NOT NULL,
  `mdp` varchar(255) NOT NULL,
  `nom_e` varchar(255) DEFAULT NULL,
  `prenom_e` varchar(255) DEFAULT NULL,
  `fk_id_promo` int(11) DEFAULT NULL,
  `id_role` int(11) NOT NULL DEFAULT 2,
  `statut_inscription` tinyint(1) NOT NULL DEFAULT 0 COMMENT '1 = vérifié \r\n0 = en attente',
  `fk_id_option` int(11) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `eleve`
--

INSERT INTO `eleve` (`id_eleve`, `login`, `mdp`, `nom_e`, `prenom_e`, `fk_id_promo`, `id_role`, `statut_inscription`, `fk_id_option`) VALUES
(23, 'pierrelouis', 'd43cf1bb64281c0764c9884d7603df4f', 'Combeau', 'pierrelouis', 1, 2, 1, 1),
(24, 'dorian', '6474c6ade84b7bd4c56d9eeef5680287', 'grigi', 'dorian', 1, 2, 1, 2);

-- --------------------------------------------------------

--
-- Structure de la table `etape`
--

CREATE TABLE `etape` (
  `id_etape` int(11) NOT NULL,
  `libelle_etape` varchar(255) DEFAULT NULL,
  `desc_etape` varchar(255) DEFAULT NULL,
  `fk_id_tp` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `etape`
--

INSERT INTO `etape` (`id_etape`, `libelle_etape`, `desc_etape`, `fk_id_tp`) VALUES
(75, 'Installer MY sql ', '<p>vous devez installer <strong>my sql</strong> sur votre serveur&nbsp;</p>\r\n', 41),
(76, 'Configurer votre base ', '<p>vous devez la condifuger en fonction de vos besoins&nbsp;</p>\r\n', 41),
(77, 'étape 1', '<p>faire l&#39;etape 1</p>\r\n', 42);

-- --------------------------------------------------------

--
-- Structure de la table `note`
--

CREATE TABLE `note` (
  `id_eleve` int(11) NOT NULL,
  `id_tp` int(11) NOT NULL,
  `note` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `note`
--

INSERT INTO `note` (`id_eleve`, `id_tp`, `note`) VALUES
(24, 42, 15);

-- --------------------------------------------------------

--
-- Structure de la table `option_eleve`
--

CREATE TABLE `option_eleve` (
  `id_option` int(11) NOT NULL,
  `libelle_option` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `option_eleve`
--

INSERT INTO `option_eleve` (`id_option`, `libelle_option`) VALUES
(1, 'SLAM'),
(2, 'SISR');

-- --------------------------------------------------------

--
-- Structure de la table `prof`
--

CREATE TABLE `prof` (
  `id_prof` int(11) NOT NULL,
  `login` varchar(255) NOT NULL,
  `mdp` varchar(255) NOT NULL,
  `verif` tinyint(1) NOT NULL,
  `nom_p` varchar(255) DEFAULT NULL,
  `prenom_p` varchar(255) DEFAULT NULL,
  `id_role` int(11) NOT NULL DEFAULT 1,
  `statut_inscription` tinyint(4) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `prof`
--

INSERT INTO `prof` (`id_prof`, `login`, `mdp`, `verif`, `nom_p`, `prenom_p`, `id_role`, `statut_inscription`) VALUES
(7, 'julian', '338c23e8eafc19ec9236404deac0bef4', 0, 'Courbez', 'Julian', 1, 1);

-- --------------------------------------------------------

--
-- Structure de la table `promotion`
--

CREATE TABLE `promotion` (
  `id_promo` int(11) NOT NULL,
  `libelle_promo` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `promotion`
--

INSERT INTO `promotion` (`id_promo`, `libelle_promo`) VALUES
(1, 'SIO 2019-2021'),
(2, 'SIO 2');

-- --------------------------------------------------------

--
-- Structure de la table `roles`
--

CREATE TABLE `roles` (
  `id` int(11) NOT NULL,
  `nom_role` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `roles`
--

INSERT INTO `roles` (`id`, `nom_role`) VALUES
(1, 'Prof'),
(2, 'eleve');

-- --------------------------------------------------------

--
-- Structure de la table `tp`
--

CREATE TABLE `tp` (
  `id_tp` int(11) NOT NULL,
  `libelle_tp` varchar(255) DEFAULT NULL,
  `desc_tp` varchar(255) DEFAULT NULL,
  `dte_deb` date DEFAULT NULL,
  `dte_fin` date DEFAULT NULL,
  `publier` tinyint(1) DEFAULT NULL,
  `Option_tp` int(11) NOT NULL,
  `fk_id_promotion` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `tp`
--

INSERT INTO `tp` (`id_tp`, `libelle_tp`, `desc_tp`, `dte_deb`, `dte_fin`, `publier`, `Option_tp`, `fk_id_promotion`) VALUES
(41, 'Tp base de donnée', '<p>Vous devez faire une base de donn&eacute;e en fonction du mcd et mrd donn&eacute;e&nbsp;</p>\r\n', '2020-05-18', '2020-05-30', 1, 1, 1),
(42, 'tp n2', '<p>desc de tp</p>\r\n', '2020-05-14', '2020-05-06', 2, 2, 1);

-- --------------------------------------------------------

--
-- Structure de la table `valider`
--

CREATE TABLE `valider` (
  `fk_id_eleve` int(11) NOT NULL,
  `fk_id_etape` int(11) NOT NULL,
  `date_validation` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `valider`
--

INSERT INTO `valider` (`fk_id_eleve`, `fk_id_etape`, `date_validation`) VALUES
(23, 75, '2020-07-05 00:00:00'),
(24, 77, '2020-07-05 00:00:00');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `creer`
--
ALTER TABLE `creer`
  ADD PRIMARY KEY (`fk_id_tp`,`fk_id_promo`,`fk_id_prof`),
  ADD KEY `fk_id_promo` (`fk_id_promo`),
  ADD KEY `fk_id_prof` (`fk_id_prof`),
  ADD KEY `fk_id_option` (`fk_id_option`);

--
-- Index pour la table `eleve`
--
ALTER TABLE `eleve`
  ADD PRIMARY KEY (`id_eleve`),
  ADD KEY `fk_id_promo` (`fk_id_promo`),
  ADD KEY `fk_eleve_role` (`id_role`),
  ADD KEY `fk_id_option` (`fk_id_option`);

--
-- Index pour la table `etape`
--
ALTER TABLE `etape`
  ADD PRIMARY KEY (`id_etape`),
  ADD KEY `fk_id_tp` (`fk_id_tp`);

--
-- Index pour la table `note`
--
ALTER TABLE `note`
  ADD PRIMARY KEY (`id_eleve`,`id_tp`),
  ADD UNIQUE KEY `id_eleve` (`id_eleve`,`id_tp`,`note`),
  ADD KEY `id_tp` (`id_tp`);

--
-- Index pour la table `option_eleve`
--
ALTER TABLE `option_eleve`
  ADD PRIMARY KEY (`id_option`);

--
-- Index pour la table `prof`
--
ALTER TABLE `prof`
  ADD PRIMARY KEY (`id_prof`),
  ADD KEY `fk_prof_role` (`id_role`);

--
-- Index pour la table `promotion`
--
ALTER TABLE `promotion`
  ADD PRIMARY KEY (`id_promo`);

--
-- Index pour la table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `tp`
--
ALTER TABLE `tp`
  ADD PRIMARY KEY (`id_tp`),
  ADD KEY `Option_tp` (`Option_tp`),
  ADD KEY `fk_id_promotion` (`fk_id_promotion`);

--
-- Index pour la table `valider`
--
ALTER TABLE `valider`
  ADD PRIMARY KEY (`fk_id_eleve`,`fk_id_etape`,`date_validation`),
  ADD KEY `fk_id_eleve` (`fk_id_eleve`),
  ADD KEY `fk_id_etape` (`fk_id_etape`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `eleve`
--
ALTER TABLE `eleve`
  MODIFY `id_eleve` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT pour la table `etape`
--
ALTER TABLE `etape`
  MODIFY `id_etape` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=78;

--
-- AUTO_INCREMENT pour la table `option_eleve`
--
ALTER TABLE `option_eleve`
  MODIFY `id_option` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT pour la table `prof`
--
ALTER TABLE `prof`
  MODIFY `id_prof` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT pour la table `promotion`
--
ALTER TABLE `promotion`
  MODIFY `id_promo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT pour la table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT pour la table `tp`
--
ALTER TABLE `tp`
  MODIFY `id_tp` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `creer`
--
ALTER TABLE `creer`
  ADD CONSTRAINT `creer_ibfk_1` FOREIGN KEY (`fk_id_tp`) REFERENCES `tp` (`id_tp`),
  ADD CONSTRAINT `creer_ibfk_2` FOREIGN KEY (`fk_id_promo`) REFERENCES `promotion` (`id_promo`),
  ADD CONSTRAINT `creer_ibfk_3` FOREIGN KEY (`fk_id_prof`) REFERENCES `prof` (`id_prof`),
  ADD CONSTRAINT `creer_ibfk_4` FOREIGN KEY (`fk_id_option`) REFERENCES `option_eleve` (`id_option`);

--
-- Contraintes pour la table `eleve`
--
ALTER TABLE `eleve`
  ADD CONSTRAINT `eleve_ibfk_1` FOREIGN KEY (`fk_id_promo`) REFERENCES `promotion` (`id_promo`),
  ADD CONSTRAINT `fk_eleve_role` FOREIGN KEY (`id_role`) REFERENCES `roles` (`id`),
  ADD CONSTRAINT `fk_id_option` FOREIGN KEY (`fk_id_option`) REFERENCES `option_eleve` (`id_option`);

--
-- Contraintes pour la table `etape`
--
ALTER TABLE `etape`
  ADD CONSTRAINT `etape_ibfk_1` FOREIGN KEY (`fk_id_tp`) REFERENCES `tp` (`id_tp`);

--
-- Contraintes pour la table `note`
--
ALTER TABLE `note`
  ADD CONSTRAINT `note_ibfk_1` FOREIGN KEY (`id_eleve`) REFERENCES `eleve` (`id_eleve`),
  ADD CONSTRAINT `note_ibfk_2` FOREIGN KEY (`id_tp`) REFERENCES `tp` (`id_tp`);

--
-- Contraintes pour la table `prof`
--
ALTER TABLE `prof`
  ADD CONSTRAINT `fk_prof_role` FOREIGN KEY (`id_role`) REFERENCES `roles` (`id`);

--
-- Contraintes pour la table `tp`
--
ALTER TABLE `tp`
  ADD CONSTRAINT `tp_ibfk_1` FOREIGN KEY (`Option_tp`) REFERENCES `option_eleve` (`id_option`),
  ADD CONSTRAINT `tp_ibfk_2` FOREIGN KEY (`fk_id_promotion`) REFERENCES `promotion` (`id_promo`);

--
-- Contraintes pour la table `valider`
--
ALTER TABLE `valider`
  ADD CONSTRAINT `valider_ibfk_1` FOREIGN KEY (`fk_id_eleve`) REFERENCES `eleve` (`id_eleve`),
  ADD CONSTRAINT `valider_ibfk_2` FOREIGN KEY (`fk_id_etape`) REFERENCES `etape` (`id_etape`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
