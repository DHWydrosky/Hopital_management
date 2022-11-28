-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost
-- Généré le : lun. 28 nov. 2022 à 15:36
-- Version du serveur : 10.4.27-MariaDB
-- Version de PHP : 8.1.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `hms`
--

-- --------------------------------------------------------

--
-- Structure de la table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `admin`
--

INSERT INTO `admin` (`id`, `username`, `password`) VALUES
(1, 'admin', 'admin');

-- --------------------------------------------------------

--
-- Structure de la table `docteur`
--

CREATE TABLE `docteur` (
  `id` int(11) NOT NULL,
  `nom` varchar(50) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `date_naissance` date NOT NULL,
  `titre` varchar(50) NOT NULL DEFAULT 'generaliste',
  `experience` int(11) NOT NULL,
  `status` tinyint(1) NOT NULL,
  `prix_consultation` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `docteur`
--

INSERT INTO `docteur` (`id`, `nom`, `username`, `password`, `date_naissance`, `titre`, `experience`, `status`, `prix_consultation`) VALUES
(1, 'Pierre Jean', 'pierrejean', 'somepass', '1977-11-01', 'generaliste', 34, 0, 1000),
(3, 'kelly tibo', 'tibo', 'somepass', '1990-11-01', 'generaliste', 12, 1, 900),
(16, 'nani nano', 'nani', 'somepass', '1985-11-15', 'naniste', 14, 1, 1000),
(20, 'jeudi frank', 'jeudi', 'somepass', '1985-11-15', 'gyneco', 10, 1, 1000),
(60, 'hantz', 'koman', 'somepass', '1985-11-15', 'naniste', 23, 1, 1000),
(63, 'Temperature', 'Kemmel72', 'frete', '1985-11-15', 'pediatre', 23, 1, 1000),
(64, 'frantz polo', 'polo', '1233444', '1985-11-15', 'klike', 12, 1, 1000),
(69, 'polop', 'p[plpo', 'polo', '1985-11-15', 'polo', 35, 0, 1000),
(73, 'David Pierre', 'david', 'somepass', '1985-11-15', 'pediatre', 18, 0, 1000);

-- --------------------------------------------------------

--
-- Structure de la table `patient`
--

CREATE TABLE `patient` (
  `id` int(11) NOT NULL,
  `nom` varchar(50) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `date_naissance` date NOT NULL,
  `date_admis` date NOT NULL DEFAULT current_timestamp(),
  `date_sortie` date NOT NULL,
  `adresse` varchar(50) NOT NULL,
  `tel` varchar(15) NOT NULL,
  `groupe_sanguin` varchar(3) NOT NULL,
  `sexe` varchar(3) NOT NULL,
  `status` tinyint(1) NOT NULL,
  `doctor_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `patient`
--

INSERT INTO `patient` (`id`, `nom`, `username`, `password`, `date_naissance`, `date_admis`, `date_sortie`, `adresse`, `tel`, `groupe_sanguin`, `sexe`, `status`, `doctor_id`) VALUES
(1, 'Jacques Belle', 'jacquesbeau', 'somepass', '2000-11-16', '2022-11-16', '2022-11-23', '#12, imp pierre, portail', '+50966776677', 'o+', 'M', 0, 1),
(2, 'jean joe', 'joe', 'somepass', '2022-11-01', '2022-11-23', '2022-11-25', '23,impas', '+50977668866', 'AB', 'F', 1, 1),
(4, 'Rois', 'pierrejue', 'somemjs', '2022-10-30', '2022-11-23', '2022-11-25', '12,impasee', '+60948857945', 'o+', 'f', 1, 1),
(5, 'Vitesse Vent', 'tempe', 'somepas', '2022-10-30', '2022-11-01', '2022-11-24', '\'4hf', '+60948857945', 'o+', 'm', 1, 69),
(8, 'frantz pierre', 'franyz', 'spmepas', '2022-10-30', '2022-11-21', '2022-11-21', 'adress kay li ye', '+60948857945', 'o-', 'm', 0, 16);

-- --------------------------------------------------------

--
-- Structure de la table `prescription`
--

CREATE TABLE `prescription` (
  `prescid` int(11) NOT NULL,
  `patientid` int(11) NOT NULL,
  `presc` text NOT NULL,
  `docteurid` int(11) NOT NULL,
  `dateemise` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `prescription`
--

INSERT INTO `prescription` (`prescid`, `patientid`, `presc`, `docteurid`, `dateemise`) VALUES
(9, 1, 'amox 500 3fois/jour', 1, '2022-11-28'),
(11, 1, 'peniciline 4\r\nvita c 2fois/jour\r\nbandil avant repas', 3, '2022-11-28'),
(12, 2, 'insuline 1fois/semaine', 1, '2022-11-28');

-- --------------------------------------------------------

--
-- Structure de la table `priserendezvous`
--

CREATE TABLE `priserendezvous` (
  `rendezID` int(11) NOT NULL,
  `datedebut` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `datefin` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `patientid` int(11) NOT NULL,
  `docteurid` int(11) NOT NULL,
  `motif` varchar(250) NOT NULL DEFAULT 'consultation'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `priserendezvous`
--

INSERT INTO `priserendezvous` (`rendezID`, `datedebut`, `datefin`, `patientid`, `docteurid`, `motif`) VALUES
(1, '2022-11-30 15:29:40', '2022-11-30 15:45:40', 1, 1, 'consultation'),
(2, '2022-11-30 15:50:21', '2022-11-30 16:50:21', 4, 60, 'consultation'),
(3, '2022-11-30 05:54:00', '2022-11-30 06:55:00', 5, 16, 'consultation'),
(4, '2022-12-01 07:56:00', '2022-12-01 08:56:00', 8, 3, 'consultation'),
(6, '2022-11-27 06:51:00', '2022-11-27 07:51:00', 2, 64, 'analyse sang');

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `role` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `docteur`
--
ALTER TABLE `docteur`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- Index pour la table `patient`
--
ALTER TABLE `patient`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `usernamePatient` (`username`),
  ADD KEY `relation_patient_docteur` (`doctor_id`);

--
-- Index pour la table `prescription`
--
ALTER TABLE `prescription`
  ADD PRIMARY KEY (`prescid`),
  ADD KEY `relation_prescpatient` (`patientid`),
  ADD KEY `relation_prescdocteur` (`docteurid`);

--
-- Index pour la table `priserendezvous`
--
ALTER TABLE `priserendezvous`
  ADD PRIMARY KEY (`rendezID`),
  ADD KEY `relation_rendezvous_patient` (`patientid`),
  ADD KEY `relatiom_rendezvous_docteur` (`docteurid`);

--
-- Index pour la table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT pour la table `docteur`
--
ALTER TABLE `docteur`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=74;

--
-- AUTO_INCREMENT pour la table `patient`
--
ALTER TABLE `patient`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT pour la table `prescription`
--
ALTER TABLE `prescription`
  MODIFY `prescid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT pour la table `priserendezvous`
--
ALTER TABLE `priserendezvous`
  MODIFY `rendezID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT pour la table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `patient`
--
ALTER TABLE `patient`
  ADD CONSTRAINT `relation_patient_docteur` FOREIGN KEY (`doctor_id`) REFERENCES `docteur` (`id`);

--
-- Contraintes pour la table `prescription`
--
ALTER TABLE `prescription`
  ADD CONSTRAINT `relation_prescdocteur` FOREIGN KEY (`docteurid`) REFERENCES `docteur` (`id`),
  ADD CONSTRAINT `relation_prescpatient` FOREIGN KEY (`patientid`) REFERENCES `patient` (`id`);

--
-- Contraintes pour la table `priserendezvous`
--
ALTER TABLE `priserendezvous`
  ADD CONSTRAINT `relatiom_rendezvous_docteur` FOREIGN KEY (`docteurid`) REFERENCES `docteur` (`id`),
  ADD CONSTRAINT `relation_rendezvous_patient` FOREIGN KEY (`patientid`) REFERENCES `patient` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
