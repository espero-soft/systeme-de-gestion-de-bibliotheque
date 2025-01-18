SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";

SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT;
SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS;
SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION;
SET NAMES utf8mb4;

CREATE DATABASE IF NOT EXISTS `library`;
USE `library`;

-- Création de la table `users`
CREATE TABLE `users` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `firstname` VARCHAR(255) DEFAULT NULL,
  `lastname` VARCHAR(255) DEFAULT NULL,
  `email` VARCHAR(255) NOT NULL,
  `adresse` VARCHAR(255) DEFAULT NULL,
  `register_date` DATE DEFAULT NULL,
  `user_status` ENUM('admin', 'user') DEFAULT 'user',
  `password` VARCHAR(255) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Création de la table `books`
CREATE TABLE `books` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `title` VARCHAR(255) NOT NULL,
  `name_author` VARCHAR(255) NOT NULL,
  `genre` VARCHAR(255) NOT NULL,
  `publication_year` YEAR NOT NULL,
  `ISBN` VARCHAR(13) NOT NULL,
  `stock` INT NOT NULL DEFAULT 0,
  `quantity_loan` INT NOT NULL DEFAULT 0,
  `description` TEXT DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `ISBN` (`ISBN`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Création de la table `handle_loan`
CREATE TABLE `handle_loan` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `id_book` INT NOT NULL,
  `id_user` INT NOT NULL,
  `loan_date` DATE NOT NULL,
  `due_date` DATE NOT NULL,
  `loan_status` ENUM('active', 'returned', 'overdue') DEFAULT 'active',
  PRIMARY KEY (`id`),
  KEY `id_book` (`id_book`),
  KEY `id_user` (`id_user`),
  CONSTRAINT `handle_loan_ibfk_1` FOREIGN KEY (`id_book`) REFERENCES `books` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `handle_loan_ibfk_2` FOREIGN KEY (`id_user`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Déclencheur pour gérer la valeur par défaut de `register_date`
DELIMITER //

CREATE TRIGGER `before_insert_users`
BEFORE INSERT ON `users`
FOR EACH ROW
BEGIN
  IF NEW.register_date IS NULL THEN
    SET NEW.register_date = CURDATE();
  END IF;
END;
//

DELIMITER ;

-- Insertion des données dans la table `users`
INSERT INTO `users` (`id`, `firstname`, `lastname`, `email`, `adresse`, `register_date`, `user_status`, `password`) VALUES
(2, 'Mamadou Saliou', 'Ba', 'mamadousaliouba588@gmail.com', 'Ziguinchor', NULL, 'admin', 'fbd5ddd739aad060d935e481a906b5c849f18fdd'),
(3, 'Binta', 'Ba', 'binta123@gmail.com', 'Dakar', NULL, 'user', 'f7c3bc1d808e04732adf679965ccc34ca7ae3441'),
(4, 'Houleyma', 'Ba', 'houley123@gmail.com', 'Saint-louis', NULL, 'admin', 'f7c3bc1d808e04732adf679965ccc34ca7ae3441'),
(12, 'Mariama', 'Ba', 'mariama9024@gmail.com', 'Labe', NULL, 'admin', '72ebdbda61bdb9a3c831f87950c25a1996d1ef31');

-- Insertion des données dans la table `books`
INSERT INTO `books` (`id`, `title`, `name_author`, `genre`, `publication_year`, `ISBN`, `stock`, `quantity_loan`, `description`) VALUES
(4, 'Les Secrets de la forêt', 'Marie Leblanc', 'fantastique', 2019, '9781234567890', 10, 0, 'Une jeune femme découvre un monde magique caché dans une forêt et lutte pour rétablir l\'équilibre entre nature et modernité.'),
(5, 'Le Voyageur des étoiles', 'Jean Dupont', 'fiction', 2015, '9781234567891', 5, 0, 'Une aventure intergalactique où un scientifique découvre une civilisation extraterrestre en quête de rédemption.'),
(6, 'Les étoiles du désert', 'Fatou Diallo', 'roman', 2018, '9781234567892', 15, 0, 'Une fresque historique captivante sur les caravanes de sel traversant le Sahara au 16ᵉ siècle.'),
(20, 'L\'Ombre du passé', 'Ahmed Sylla', 'roman', 2022, '9781234567899', 14, 0, 'Un détective privé enquête sur une série de meurtres liés à un secret enfoui depuis des décennies.');

COMMIT;

SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT;
SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS;
SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION;
