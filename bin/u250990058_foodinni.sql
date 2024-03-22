-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : ven. 22 mars 2024 à 15:47
-- Version du serveur : 10.11.7-MariaDB-cll-lve
-- Version de PHP : 7.2.34

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `u250990058_foodinni`
--

-- --------------------------------------------------------

--
-- Structure de la table `account`
--

CREATE TABLE `account` (
  `identifier` varchar(10) NOT NULL,
  `mail` varchar(50) NOT NULL,
  `firstname` varchar(20) NOT NULL,
  `lastname` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `account`
--

INSERT INTO `account` (`identifier`, `mail`, `firstname`, `lastname`) VALUES
('benjamin', 'benjamin.emereau@seamk.fi', 'benjamin', 'emereau'),
('emilien', 'emilien.ouvrard@seamk.fi', 'emilien', 'ouvrard'),
('timo', 'timo.ohrlein@seamk.fi', 'timo', 'öhrlein');

-- --------------------------------------------------------

--
-- Structure de la table `brand`
--

CREATE TABLE `brand` (
  `name` varchar(20) NOT NULL,
  `mail` varchar(50) DEFAULT NULL,
  `image` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `brand`
--

INSERT INTO `brand` (`name`, `mail`, `image`) VALUES
('coca cola', NULL, 'https://upload.wikimedia.org/wikipedia/commons/thumb/c/ce/Coca-Cola_logo.svg/1024px-Coca-Cola_logo.svg.png'),
('pågen', NULL, 'https://upload.wikimedia.org/wikipedia/fr/thumb/c/ca/Pagen.gif/1280px-Pagen.gif'),
('pirkka', NULL, 'https://upload.wikimedia.org/wikipedia/commons/thumb/6/66/Pirkka_logo.svg/2560px-Pirkka_logo.svg.png'),
('valio', NULL, 'https://upload.wikimedia.org/wikipedia/fr/4/41/Valio_Logo.png');

-- --------------------------------------------------------

--
-- Structure de la table `cashier`
--

CREATE TABLE `cashier` (
  `identifier` varchar(10) NOT NULL,
  `password` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `cashier`
--

INSERT INTO `cashier` (`identifier`, `password`) VALUES
('emilien', '374132e5eac8b044d8bf94fcc8b23b52'),
('timo', '40654a722343c7ae296732284a7d41c2');

-- --------------------------------------------------------

--
-- Structure de la table `category`
--

CREATE TABLE `category` (
  `name` varchar(20) NOT NULL,
  `image` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `category`
--

INSERT INTO `category` (`name`, `image`) VALUES
('bakery', NULL),
('beverages', NULL),
('dairy products', NULL),
('fruit and vegetables', NULL),
('groceries', NULL),
('household items', NULL),
('meat and fish', NULL),
('personal care', NULL),
('snacks', NULL);

-- --------------------------------------------------------

--
-- Structure de la table `customer`
--

CREATE TABLE `customer` (
  `identifier` varchar(10) NOT NULL,
  `password` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `customer`
--

INSERT INTO `customer` (`identifier`, `password`) VALUES
('emilien', '5f6e7373d2689043fc7e3d9d18ae1d1f');

-- --------------------------------------------------------

--
-- Structure de la table `item`
--

CREATE TABLE `item` (
  `ean13` varchar(13) NOT NULL,
  `name` varchar(80) NOT NULL,
  `bulk` tinyint(1) DEFAULT NULL,
  `stock` int(11) DEFAULT NULL,
  `stock_kg` decimal(7,3) DEFAULT NULL,
  `price` decimal(5,2) DEFAULT NULL,
  `price_kg` decimal(5,2) DEFAULT NULL,
  `discount` decimal(2,2) DEFAULT NULL,
  `image` text DEFAULT NULL,
  `brand` varchar(20) DEFAULT NULL,
  `category` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `item`
--

INSERT INTO `item` (`ean13`, `name`, `bulk`, `stock`, `stock_kg`, `price`, `price_kg`, `discount`, `image`, `brand`, `category`) VALUES
('2000613700005', 'onion', 1, NULL, NULL, NULL, 1.39, NULL, 'https://public.keskofiles.com/f/k-ruoka/product/2000613700005?auto=format&fm=jpg&cs=srgb', NULL, 'fruit and vegetables'),
('6408430037001', 'valio aura blue cheese 170g piece', NULL, NULL, NULL, 3.15, NULL, 0.20, 'https://public.keskofiles.com/f/k-ruoka/product/6408430037001?auto=format&fm=jpg&cs=srgb', 'valio', 'dairy products'),
('6410405255761', 'pirkka shortbread 300g orange', NULL, NULL, NULL, 2.69, NULL, 0.26, 'https://public.keskofiles.com/f/k-ruoka/product/6410405255761?auto=format&fm=jpg&cs=srgb', 'pirkka', 'snacks'),
('6410405260253', 'pirkka spanish tangerine 650g', NULL, NULL, NULL, 1.00, NULL, NULL, 'https://public.keskofiles.com/f/k-ruoka/product/6410405260253?auto=format&fm=jpg&cs=srgb', 'pirkka', 'fruit and vegetables'),
('6415600550413', 'coca-cola zero 0,33l 24-pack', NULL, NULL, NULL, 14.49, NULL, 0.31, 'https://public.keskofiles.com/f/k-ruoka/product/6415600550413?auto=format&fm=jpg&cs=srgb', 'coca cola', 'beverages'),
('7311070032352', 'pågen oivallus rye whole wheat bread 15 pcs/530g', NULL, NULL, NULL, 2.99, NULL, 0.10, 'https://public.keskofiles.com/f/k-ruoka/product/0NNH0/7311070032352?auto=format&fm=jpg&cs=srgb', 'pågen', 'bakery');

-- --------------------------------------------------------

--
-- Structure de la table `item_orders`
--

CREATE TABLE `item_orders` (
  `ean13` varchar(13) NOT NULL,
  `id_orders` int(11) NOT NULL,
  `quantity` int(11) DEFAULT NULL,
  `quantity_kg` decimal(7,3) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `item_receipt`
--

CREATE TABLE `item_receipt` (
  `ean13` varchar(13) NOT NULL,
  `id_receipt` int(11) NOT NULL,
  `quantity` int(11) DEFAULT NULL,
  `quantity_kg` decimal(4,2) DEFAULT NULL,
  `price` decimal(5,2) DEFAULT NULL,
  `price_kg` decimal(5,2) DEFAULT NULL,
  `final_price` decimal(6,2) NOT NULL,
  `discount` decimal(2,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `manager`
--

CREATE TABLE `manager` (
  `identifier` varchar(10) NOT NULL,
  `password` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `manager`
--

INSERT INTO `manager` (`identifier`, `password`) VALUES
('emilien', '0b137b50701a3e1dd0942d6ae7b831e3'),
('timo', '6dbd53d3d81e7f87c92c3fe2ba7351b0');

-- --------------------------------------------------------

--
-- Structure de la table `orders`
--

CREATE TABLE `orders` (
  `id_orders` int(11) NOT NULL,
  `identifier` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `receipt`
--

CREATE TABLE `receipt` (
  `id_receipt` int(11) NOT NULL,
  `datetime` datetime NOT NULL,
  `identifier` varchar(10) NOT NULL,
  `identifier_1` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `shopping_list`
--

CREATE TABLE `shopping_list` (
  `ean13` varchar(13) NOT NULL,
  `identifier` varchar(10) NOT NULL,
  `quantity` int(11) DEFAULT NULL,
  `quantity_kg` decimal(4,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `account`
--
ALTER TABLE `account`
  ADD PRIMARY KEY (`identifier`),
  ADD UNIQUE KEY `mail` (`mail`);

--
-- Index pour la table `brand`
--
ALTER TABLE `brand`
  ADD PRIMARY KEY (`name`);

--
-- Index pour la table `cashier`
--
ALTER TABLE `cashier`
  ADD PRIMARY KEY (`identifier`);

--
-- Index pour la table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`name`);

--
-- Index pour la table `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`identifier`);

--
-- Index pour la table `item`
--
ALTER TABLE `item`
  ADD PRIMARY KEY (`ean13`),
  ADD KEY `brand` (`brand`),
  ADD KEY `category` (`category`);

--
-- Index pour la table `item_orders`
--
ALTER TABLE `item_orders`
  ADD PRIMARY KEY (`ean13`,`id_orders`),
  ADD KEY `id_orders` (`id_orders`);

--
-- Index pour la table `item_receipt`
--
ALTER TABLE `item_receipt`
  ADD PRIMARY KEY (`ean13`,`id_receipt`),
  ADD KEY `id_receipt` (`id_receipt`);

--
-- Index pour la table `manager`
--
ALTER TABLE `manager`
  ADD PRIMARY KEY (`identifier`);

--
-- Index pour la table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id_orders`),
  ADD KEY `identifier` (`identifier`);

--
-- Index pour la table `receipt`
--
ALTER TABLE `receipt`
  ADD PRIMARY KEY (`id_receipt`),
  ADD KEY `identifier` (`identifier`),
  ADD KEY `identifier_1` (`identifier_1`);

--
-- Index pour la table `shopping_list`
--
ALTER TABLE `shopping_list`
  ADD PRIMARY KEY (`ean13`,`identifier`),
  ADD KEY `identifier` (`identifier`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `orders`
--
ALTER TABLE `orders`
  MODIFY `id_orders` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `receipt`
--
ALTER TABLE `receipt`
  MODIFY `id_receipt` int(11) NOT NULL AUTO_INCREMENT;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `cashier`
--
ALTER TABLE `cashier`
  ADD CONSTRAINT `cashier_ibfk_1` FOREIGN KEY (`identifier`) REFERENCES `account` (`identifier`);

--
-- Contraintes pour la table `customer`
--
ALTER TABLE `customer`
  ADD CONSTRAINT `customer_ibfk_1` FOREIGN KEY (`identifier`) REFERENCES `account` (`identifier`);

--
-- Contraintes pour la table `item`
--
ALTER TABLE `item`
  ADD CONSTRAINT `item_ibfk_1` FOREIGN KEY (`brand`) REFERENCES `brand` (`name`),
  ADD CONSTRAINT `item_ibfk_2` FOREIGN KEY (`category`) REFERENCES `category` (`name`);

--
-- Contraintes pour la table `item_orders`
--
ALTER TABLE `item_orders`
  ADD CONSTRAINT `item_orders_ibfk_1` FOREIGN KEY (`ean13`) REFERENCES `item` (`ean13`),
  ADD CONSTRAINT `item_orders_ibfk_2` FOREIGN KEY (`id_orders`) REFERENCES `orders` (`id_orders`);

--
-- Contraintes pour la table `item_receipt`
--
ALTER TABLE `item_receipt`
  ADD CONSTRAINT `item_receipt_ibfk_1` FOREIGN KEY (`ean13`) REFERENCES `item` (`ean13`),
  ADD CONSTRAINT `item_receipt_ibfk_2` FOREIGN KEY (`id_receipt`) REFERENCES `receipt` (`id_receipt`);

--
-- Contraintes pour la table `manager`
--
ALTER TABLE `manager`
  ADD CONSTRAINT `manager_ibfk_1` FOREIGN KEY (`identifier`) REFERENCES `account` (`identifier`);

--
-- Contraintes pour la table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`identifier`) REFERENCES `manager` (`identifier`);

--
-- Contraintes pour la table `receipt`
--
ALTER TABLE `receipt`
  ADD CONSTRAINT `receipt_ibfk_1` FOREIGN KEY (`identifier`) REFERENCES `cashier` (`identifier`),
  ADD CONSTRAINT `receipt_ibfk_2` FOREIGN KEY (`identifier_1`) REFERENCES `customer` (`identifier`);

--
-- Contraintes pour la table `shopping_list`
--
ALTER TABLE `shopping_list`
  ADD CONSTRAINT `shopping_list_ibfk_1` FOREIGN KEY (`ean13`) REFERENCES `item` (`ean13`),
  ADD CONSTRAINT `shopping_list_ibfk_2` FOREIGN KEY (`identifier`) REFERENCES `customer` (`identifier`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
