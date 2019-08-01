-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               10.1.31-MariaDB - mariadb.org binary distribution
-- Server OS:                    Win32
-- HeidiSQL Version:             9.4.0.5125
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;


-- Dumping database structure for e_shop
CREATE DATABASE IF NOT EXISTS `e_shop` /*!40100 DEFAULT CHARACTER SET latin1 */;
USE `e_shop`;

-- Dumping structure for table e_shop.products
CREATE TABLE IF NOT EXISTS `products` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `content` longtext NOT NULL,
  `pictureUrl` longtext NOT NULL,
  `price` double NOT NULL,
  `dateAdded` datetime NOT NULL,
  `authorId` int(11) NOT NULL,
  `quantity` int(11) NOT NULL DEFAULT '30',
  `viewCount` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_B3BA5A5AA196F9FD` (`authorId`),
  CONSTRAINT `FK_B3BA5A5AA196F9FD` FOREIGN KEY (`authorId`) REFERENCES `users` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;

-- Dumping data for table e_shop.products: ~7 rows (approximately)
/*!40000 ALTER TABLE `products` DISABLE KEYS */;
INSERT INTO `products` (`id`, `name`, `content`, `pictureUrl`, `price`, `dateAdded`, `authorId`, `quantity`, `viewCount`) VALUES
	(1, 'title1', 'content1', 'https://www.planwallpaper.com/static/images/121.jpg', 2.9, '2018-08-15 01:36:46', 3, 30, 8),
	(2, 'second title', 'second content', 'https://images.all-free-download.com/images/graphicthumb/water_waterfall_nature_214751.jpg', 3.7, '2018-08-15 14:21:47', 3, 30, 6),
	(3, 'dawda', 'dawda', 'https://s3-us-west-2.amazonaws.com/uw-s3-cdn/wp-content/uploads/sites/6/2017/11/04133712/waterfall.jpg', 7.9, '2018-08-15 14:43:50', 3, 30, 0),
	(4, 'dwadaw', 'dawda', 'https://rwallpapers.com/wp-content/uploads/2018/04/Beautiful-Nature-Wallpapers-New-Hd.jpg', 7.9, '2018-08-15 15:01:14', 3, 30, 0),
	(6, 'phone', 'phone Gosho', 'https://images.pexels.com/photos/788946/pexels-photo-788946.jpeg?auto=compress&cs=tinysrgb&dpr=2&h=650&w=940', 3.7, '2018-08-15 17:38:20', 2, 30, 52),
	(7, 'ddddd', 'ddd', 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSUNGJDZ22zOsOpeGTshD1k4fTx_IN-XzIMPEAhCg87MZ0RlabK', 7.9, '2018-08-16 01:40:37', 3, 30, 41),
	(8, 'beer', 'best beer Maria', 'https://media.istockphoto.com/photos/glass-of-light-beer-picture-id509685858?k=6&m=509685858&s=612x612&w=0&h=PufwDx7yr1KYWXE2as3XCVtG0ZDdiw8byMfe0HJpSSg=', 7.77, '2018-08-16 15:56:13', 4, 30, 92);
/*!40000 ALTER TABLE `products` ENABLE KEYS */;

-- Dumping structure for table e_shop.product_cart
CREATE TABLE IF NOT EXISTS `product_cart` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `productId` int(11) NOT NULL,
  `isDeleted` tinyint(1) NOT NULL,
  `userId` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_864BAA1636799605` (`productId`),
  KEY `IDX_864BAA1664B64DCC` (`userId`),
  CONSTRAINT `FK_864BAA1636799605` FOREIGN KEY (`productId`) REFERENCES `products` (`id`),
  CONSTRAINT `FK_864BAA1664B64DCC` FOREIGN KEY (`userId`) REFERENCES `users` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

-- Dumping data for table e_shop.product_cart: ~4 rows (approximately)
/*!40000 ALTER TABLE `product_cart` DISABLE KEYS */;
INSERT INTO `product_cart` (`id`, `productId`, `isDeleted`, `userId`) VALUES
	(1, 8, 0, 3),
	(2, 6, 1, 3),
	(3, 7, 0, 5),
	(4, 8, 0, 5);
/*!40000 ALTER TABLE `product_cart` ENABLE KEYS */;

-- Dumping structure for table e_shop.roles
CREATE TABLE IF NOT EXISTS `roles` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_B63E2EC75E237E06` (`name`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- Dumping data for table e_shop.roles: ~2 rows (approximately)
/*!40000 ALTER TABLE `roles` DISABLE KEYS */;
INSERT INTO `roles` (`id`, `name`) VALUES
	(2, 'ROLE_ADMIN'),
	(1, 'ROLE_USER');
/*!40000 ALTER TABLE `roles` ENABLE KEYS */;

-- Dumping structure for table e_shop.users
CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(100) NOT NULL,
  `fullName` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_1483A5E9E7927C74` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

-- Dumping data for table e_shop.users: ~4 rows (approximately)
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` (`id`, `email`, `fullName`, `password`) VALUES
	(2, 'gosho@abv.bg', 'Gosho', '$2y$13$BSeJghl8LC28OnTYwIAr5.omWsZpPxYqV28exqxNmRWfVc1iCdC1i'),
	(3, 'pesho@abv.bg', 'Pesho', '$2y$13$0/u8T/khX8pCx/tS5DkH/ewLdNGgDpdEl7WMMdljkDOmAVXQMK3gS'),
	(4, 'maria@abv.bg', 'Maria', '$2y$13$Kz8n4k0OY7UEiP7ZtYxXt.owgwd5PXO7dBWFzkBKhpK53fXPl16US'),
	(5, 'stamat@abv.bg', 'Stamat', '$2y$13$f52BJiSc04t/s5xCrXeqlOjrdgzLn2ocInkNRWt3gpVP01qeuGu3m');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;

-- Dumping structure for table e_shop.users_roles
CREATE TABLE IF NOT EXISTS `users_roles` (
  `user_id` int(11) NOT NULL,
  `role_id` int(11) NOT NULL,
  PRIMARY KEY (`user_id`,`role_id`),
  KEY `IDX_51498A8EA76ED395` (`user_id`),
  KEY `IDX_51498A8ED60322AC` (`role_id`),
  CONSTRAINT `FK_51498A8EA76ED395` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`),
  CONSTRAINT `FK_51498A8ED60322AC` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Dumping data for table e_shop.users_roles: ~5 rows (approximately)
/*!40000 ALTER TABLE `users_roles` DISABLE KEYS */;
INSERT INTO `users_roles` (`user_id`, `role_id`) VALUES
	(2, 1),
	(3, 1),
	(3, 2),
	(4, 1),
	(5, 1);
/*!40000 ALTER TABLE `users_roles` ENABLE KEYS */;

-- Dumping structure for table e_shop.user_orders
CREATE TABLE IF NOT EXISTS `user_orders` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `productId` int(11) NOT NULL,
  `userId` int(11) NOT NULL,
  `dateAdded` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_807DE6D336799605` (`productId`),
  KEY `IDX_807DE6D364B64DCC` (`userId`),
  CONSTRAINT `FK_807DE6D336799605` FOREIGN KEY (`productId`) REFERENCES `products` (`id`),
  CONSTRAINT `FK_807DE6D364B64DCC` FOREIGN KEY (`userId`) REFERENCES `users` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=utf8;

-- Dumping data for table e_shop.user_orders: ~3 rows (approximately)
/*!40000 ALTER TABLE `user_orders` DISABLE KEYS */;
INSERT INTO `user_orders` (`id`, `productId`, `userId`, `dateAdded`) VALUES
	(17, 8, 3, '2018-08-18 04:29:00'),
	(18, 6, 3, '2018-08-18 04:29:00'),
	(19, 6, 3, '2018-08-18 17:12:28');
/*!40000 ALTER TABLE `user_orders` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
