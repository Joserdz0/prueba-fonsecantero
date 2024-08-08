-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Versión del servidor:         10.4.32-MariaDB - mariadb.org binary distribution
-- SO del servidor:              Win64
-- HeidiSQL Versión:             12.8.0.6908
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


-- Volcando estructura de base de datos para prueba_fonsecantero
DROP DATABASE IF EXISTS `prueba_fonsecantero`;
CREATE DATABASE IF NOT EXISTS `prueba_fonsecantero` /*!40100 DEFAULT CHARACTER SET utf8 COLLATE utf8_spanish_ci */;
USE `prueba_fonsecantero`;

-- Volcando estructura para tabla prueba_fonsecantero.assignments
DROP TABLE IF EXISTS `assignments`;
CREATE TABLE IF NOT EXISTS `assignments` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(100) DEFAULT NULL,
  `description` varchar(250) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `progress_id` int(11) DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`) USING BTREE,
  KEY `FK_assignments_users` (`user_id`),
  KEY `FK_assignments_progress` (`progress_id`),
  CONSTRAINT `FK_assignments_progress` FOREIGN KEY (`progress_id`) REFERENCES `progress` (`id`) ON UPDATE NO ACTION,
  CONSTRAINT `FK_assignments_users` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

-- Volcando datos para la tabla prueba_fonsecantero.assignments: ~4 rows (aproximadamente)
DELETE FROM `assignments`;
INSERT INTO `assignments` (`id`, `title`, `description`, `user_id`, `progress_id`, `status`, `created_at`, `updated_at`) VALUES
	(1, 'LAVAR ROPA', 'SEPARAR ROPA, LAVAR Y TENDER', 6, 1, 1, '2024-08-07 09:34:34', '2024-08-07 19:53:35'),
	(2, 'LAVAR GATOS', 'LIMPIAR ARENERO, CAMBIAR AGUA Y LLENAR ALIMENTADORA', 6, 1, 1, '2024-08-07 09:35:27', '2024-08-07 23:56:30'),
	(3, 'IR AL BANCO', 'IR AL BANCO, RETIRAR DINERO Y CAMBIAR TARJETA', 6, 2, 1, '2024-08-07 09:36:42', '2024-08-07 19:53:35'),
	(4, 'TERMINAR PRUEBA', 'PROGRAMAR ASIGNACIONES, CREAR DOCUMENTACION, SUBIR A GIT Y ENVIAR CORREO', 4, 1, 1, '2024-08-07 09:38:10', '2024-08-07 09:38:10');

-- Volcando estructura para tabla prueba_fonsecantero.progress
DROP TABLE IF EXISTS `progress`;
CREATE TABLE IF NOT EXISTS `progress` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) DEFAULT NULL,
  `color` varchar(50) DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

-- Volcando datos para la tabla prueba_fonsecantero.progress: ~3 rows (aproximadamente)
DELETE FROM `progress`;
INSERT INTO `progress` (`id`, `name`, `color`, `status`, `created_at`, `updated_at`) VALUES
	(1, 'PENDIENTE', '#B71C1C', 1, '2024-08-06 06:50:30', '2024-08-07 18:24:00'),
	(2, 'EN PROGRESO', '#FBC02D', 1, '2024-08-06 06:50:55', '2024-08-07 18:23:52'),
	(3, 'COMPLETADA', '#1B5E20', 1, '2024-08-06 06:51:16', '2024-08-07 18:23:42');

-- Volcando estructura para tabla prueba_fonsecantero.users
DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `password` varchar(255) DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`name`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

-- Volcando datos para la tabla prueba_fonsecantero.users: ~2 rows (aproximadamente)
DELETE FROM `users`;
INSERT INTO `users` (`id`, `name`, `password`, `status`, `created_at`, `updated_at`) VALUES
	(4, 'jose', '$2y$10$zS9efqRjZtFHOafvOzshLOhrTYe7ZQC6knmwjpLICQWTIX7q6NS86', 1, '2024-08-07 03:18:04', '2024-08-08 01:14:40'),
	(6, 'admin', '$2y$10$zS9efqRjZtFHOafvOzshLOhrTYe7ZQC6knmwjpLICQWTIX7q6NS86', 1, '2024-08-07 08:00:42', '2024-08-08 01:14:45');

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
