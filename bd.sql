-- phpMyAdmin SQL Dump
-- version 4.7.7
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost:8889
-- Généré le :  mer. 20 juin 2018 à 07:13
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
  `imageAnnonce` varchar(30) NOT NULL,
  `dateAnnonce` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `annonces`
--

INSERT INTO `annonces` (`idAnnonce`, `idAuteur`, `titreAnnonce`, `texteAnnonce`, `imageAnnonce`, `dateAnnonce`) VALUES
(1, 2, 'Chaise Haute Peg Perego', 'Chaise haute Peg Perego prima pappa diner\r\nPorte quelques marques d\'usure mais parfaitement fonctionnelle\r\ntrès solide et résistant\r\n', 'chaise.jpg', '2018-06-04'),
(2, 1, 'Étagère-échelle en sapin blanc', 'Étagère-échelle en sapin blanc\r\nMaisons du Monde\r\n\r\nDimensions (cm): H135 x L46 x PR39\r\n\r\nBon état.\r\n\r\nA venir récupérer sur place à Paris centre. \r\nPaiement en liquide sur place.', 'etagere.jpg', '2018-06-05'),
(3, 1, 'Micro ondes', 'A vendre Micro ondes SHARP. Peu servi. Je n\'ai plus le mode d\'emploi.\r\nA prendre sur place Paris 11ème avant jeudi 31mai 12H.', 'micro_ondes.jpg', '2018-06-13'),
(6, 3, 'Aquarium', 'Aquarium rond en verre. Excellent état car servi 10 jours. \r\n25 cm de diamètre environ. \r\nDécoration : plante plastique et cailloux', '', '2018-05-30'),
(13, 2, 'Four gaz', 'four gaz professionnel a rénover.\r\nVendu en l\'état, à venir chercher\r\nsur place à Malakoff.', 'four.jpg', '2018-06-18');

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
(1, 3, 'Bonjour, je voudrai acheter votre aquarium', '2018-06-16', 1),
(3, 1, '10 euros', '2018-06-16', 3),
(1, 2, 'Bonjour', '2018-06-16', 15),
(2, 1, 'Bonjour', '2018-06-18', 22),
(1, 2, 'combien pour le chaise prego\r\n', '2018-06-18', 23),
(2, 1, '35euros', '2018-06-18', 24),
(1, 2, 'merci\r\n', '2018-06-19', 25),
(2, 1, 'de rien', '2018-06-20', 26),
(1, 3, 'merci', '2018-06-20', 30);

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
(2, 'medoune', '098f6bcd4621d373cade4e832627b4f6', 'medoune@gmail.com', 'user', '2018-05-28'),
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
  MODIFY `idAnnonce` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

--
-- AUTO_INCREMENT pour la table `messages`
--
ALTER TABLE `messages`
  MODIFY `idMessage` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT pour la table `users`
--
ALTER TABLE `users`
  MODIFY `idU` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

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
