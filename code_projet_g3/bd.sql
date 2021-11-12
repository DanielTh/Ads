-- phpMyAdmin SQL Dump
-- version 4.7.7
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost:8889
-- Généré le :  lun. 18 juin 2018 à 04:22
-- Version du serveur :  5.6.38
-- Version de PHP :  7.2.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Base de données :  `annonces_database`
--

-- --------------------------------------------------------

--
-- Structure de la table `annonces`
--

CREATE TABLE `annonces` (
  `idAnnonce` int(11) NOT NULL,
  `idAuteur` int(11) NOT NULL,
  `titreAnnonce` text NOT NULL,
  `texteAnnonce` text NOT NULL,
  `dateAnnonce` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `annonces`
--

INSERT INTO `annonces` (`idAnnonce`, `idAuteur`, `titreAnnonce`, `texteAnnonce`, `dateAnnonce`) VALUES
(1, 1, 'Chaise Haute Peg Perego', 'Chaise haute Peg Perego prima pappa diner\r\nPorte quelques marques d\'usure mais parfaitement fonctionnelle\r\ntrès solide et résistant\r\n', '2018-06-04'),
(2, 1, 'Étagère-échelle en sapin blanc', 'Étagère-échelle en sapin blanc\r\nMaisons du Monde\r\n\r\nDimensions (cm): H135 x L46 x PR39\r\n\r\nBon état.\r\n\r\nA venir récupérer sur place à Paris centre. \r\nPaiement en liquide sur place.', '2018-06-05'),
(3, 1, 'Micro ondes', 'A vendre Micro ondes SHARP. Peu servi. Je n\'ai plus le mode d\'emploi.\r\nA prendre sur place Paris 11ème avant jeudi 31mai 12H.', '2018-06-13'),
(4, 1, 'Clio 3 Estate 1.5l DCI 85cv gps TomTom\r\n', 'Bonjour,\r\nJe met en vente ma Clio 3 Estate 1.5l DCI 85cv avec GPS TomTom année 2010 -122000km ct ok (-6mois).\r\nDirection assistée, climatisation, régulateur et limitateur de vitesse , détecteurs de pluie automatique, rétroviseurs électriques, boîte manuelle. \r\nVéhicule très fiable et confortable. Je l\'a vend pour changer de modèle , aucun frais à prévoir très bien entretenu.\r\nPrix: 4800e à débattre dans la limite du raisonnable. \r\nContact par tel ou mail .', '2018-06-14'),
(6, 3, 'test', 'TESTSETSTSETSET', '2018-05-30'),
(13, 2, 'Four gaz', 'four gaz professionnel a rénover.\r\nVendu en l\'état, à venir chercher\r\nsur place à Malakoff.', '2018-06-18');

-- --------------------------------------------------------

--
-- Structure de la table `messages`
--

CREATE TABLE `messages` (
  `idAuteur1` int(11) NOT NULL,
  `idAuteur2` int(11) NOT NULL,
  `texteMessage` text NOT NULL,
  `dateMessage` date NOT NULL,
  `idMessage` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `messages`
--

INSERT INTO `messages` (`idAuteur1`, `idAuteur2`, `texteMessage`, `dateMessage`, `idMessage`) VALUES
(1, 3, 'Bonjour, combien pour TESTTEST', '2018-06-16', 1),
(3, 1, '35$', '2018-06-16', 3),
(1, 2, 'Hello World', '2018-06-16', 15),
(1, 2, 'hello?\r\n', '2018-06-18', 22),
(1, 2, 'hello\r\ncombien pour?\r\n', '2018-06-18', 23);

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

CREATE TABLE `users` (
  `idU` int(11) NOT NULL,
  `login` varchar(20) NOT NULL,
  `password` varchar(40) NOT NULL,
  `email` varchar(30) NOT NULL,
  `statut` varchar(10) NOT NULL,
  `dateInscription` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `users`
--

INSERT INTO `users` (`idU`, `login`, `password`, `email`, `statut`, `dateInscription`) VALUES
(1, 'daniel', 'aa47f8215c6f30a0dcdb2a36a9f4168e', 'daniel@gmail.com', 'user', '2018-05-28'),
(2, 'test', '098f6bcd4621d373cade4e832627b4f6', 'test@test.test', 'user', '2018-05-28'),
(3, 'mina', '91b827e257eeae8e5989d961fe3011df', 'amianata@hotmail.fr', 'user', '2018-05-30');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `annonces`
--
ALTER TABLE `annonces`
  ADD PRIMARY KEY (`idAnnonce`),
  ADD KEY `idAuteur` (`idAuteur`);

--
-- Index pour la table `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`idMessage`),
  ADD KEY `idAuteur1` (`idAuteur1`),
  ADD KEY `idAuteur2` (`idAuteur2`);

--
-- Index pour la table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`idU`),
  ADD UNIQUE KEY `login` (`login`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `annonces`
--
ALTER TABLE `annonces`
  MODIFY `idAnnonce` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT pour la table `messages`
--
ALTER TABLE `messages`
  MODIFY `idMessage` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT pour la table `users`
--
ALTER TABLE `users`
  MODIFY `idU` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `annonces`
--
ALTER TABLE `annonces`
  ADD CONSTRAINT `annonces_ibfk_1` FOREIGN KEY (`idAuteur`) REFERENCES `users` (`idU`) ON UPDATE CASCADE;

--
-- Contraintes pour la table `messages`
--
ALTER TABLE `messages`
  ADD CONSTRAINT `messages_ibfk_1` FOREIGN KEY (`idAuteur1`) REFERENCES `users` (`idU`),
  ADD CONSTRAINT `messages_ibfk_2` FOREIGN KEY (`idAuteur2`) REFERENCES `users` (`idU`);
