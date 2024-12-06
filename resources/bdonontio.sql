-- --------------------------------------------------------
-- Hôte:                         127.0.0.1
-- Version du serveur:           8.0.30 - MySQL Community Server - GPL
-- SE du serveur:                Win64
-- HeidiSQL Version:             12.1.0.6537
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

-- Listage de la structure de table dossiersbd. action_menus
DROP TABLE IF EXISTS `action_menus`;
CREATE TABLE IF NOT EXISTS `action_menus` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `Menu` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `action` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `code_dev` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `statut` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=51 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC;

-- Listage des données de la table dossiersbd.action_menus : ~48 rows (environ)
INSERT INTO `action_menus` (`id`, `Menu`, `action`, `code_dev`, `statut`, `created_at`, `updated_at`) VALUES
	(3, '1', 'Ajouter rôles', 'add_role', NULL, '2022-06-14 14:56:34', '2022-06-14 14:56:34'),
	(4, '1', 'Modifier rôles', 'update_role', NULL, '2022-06-14 14:56:58', '2022-06-14 14:56:58'),
	(5, '1', 'Supprimer rôles', 'delete_role', NULL, '2022-06-14 14:57:26', '2022-06-14 14:57:26'),
	(6, '1', 'Attribuer rôle', 'menu_role', NULL, '2022-06-14 15:14:57', '2022-06-14 15:14:57'),
	(7, '2', 'Ajouter menu', 'add_menu', NULL, '2022-06-14 15:24:17', '2022-06-14 15:24:17'),
	(8, '2', 'Supprimer menu', 'delete_menu', NULL, '2022-06-14 15:24:48', '2022-06-14 15:24:48'),
	(9, '2', 'Modifier Menu', 'update_menu', NULL, '2022-06-14 15:25:21', '2022-06-14 15:25:21'),
	(10, '2', 'Ajouter action', 'action_menu', NULL, '2022-06-14 15:25:58', '2022-06-14 15:25:58'),
	(11, '3', 'Modifier utilisateur', 'update_user', NULL, '2022-06-14 15:32:19', '2022-06-14 15:32:19'),
	(12, '3', 'Supprimer utilisateur', 'delete_user', NULL, '2022-06-14 15:32:44', '2022-06-14 15:32:44'),
	(13, '3', 'Réinitialiser utilisateur', 'reset_user', NULL, '2022-06-14 15:33:07', '2022-06-14 15:33:07'),
	(14, '3', 'Statut utilisateur', 'status_user', NULL, '2022-06-14 15:33:41', '2022-06-14 15:33:41'),
	(15, '3', 'Ajouter utilisateur', 'add_user', NULL, '2022-06-14 15:34:46', '2022-06-14 15:34:46'),
	(16, '4', 'Ajouter service', 'add_service', NULL, '2022-06-14 15:51:47', '2022-06-14 15:51:47'),
	(17, '4', 'Supprimer service', 'delete_service', NULL, '2022-06-14 15:52:29', '2022-06-14 15:52:29'),
	(18, '4', 'Modifier service', 'update_service', NULL, '2022-06-14 15:54:23', '2022-06-14 15:54:23'),
	(19, '5', 'Ajouter Hiérarchie', 'add_hie', NULL, '2022-06-14 15:55:34', '2022-06-14 15:55:34'),
	(20, '5', 'Supprimer hiérarchie', 'delete_hie', NULL, '2022-06-14 15:57:39', '2022-06-14 15:57:39'),
	(21, '5', 'Modifier hiérarchie', 'update_hie', NULL, '2022-06-14 15:58:01', '2022-06-14 15:58:01'),
	(22, '6', 'Ajouter catégorie', 'add_cat', NULL, '2022-06-14 16:00:35', '2022-06-14 16:00:35'),
	(23, '6', 'Modifier catégorie', 'update_cat', NULL, '2022-06-14 16:00:54', '2022-06-14 16:00:54'),
	(24, '6', 'Supprimer catégorie', 'delete_cat', NULL, '2022-06-14 16:01:11', '2022-06-14 16:01:11'),
	(25, '7', 'Ajouter incidents', 'add_incident', NULL, '2022-06-14 16:04:10', '2022-06-14 16:04:10'),
	(26, '7', 'Modifier incident', 'update_incident', NULL, '2022-06-14 16:04:34', '2022-06-14 16:04:34'),
	(27, '7', 'Supprimer incident', 'delete_incident', NULL, '2022-06-14 16:04:56', '2022-06-14 16:04:56'),
	(28, '8', 'Ajouter Incidents', 'add_incie', NULL, '2022-06-14 16:36:36', '2022-06-14 16:36:36'),
	(29, '8', 'Supprimer incident', 'delete_incie', NULL, '2022-06-14 16:45:19', '2022-06-14 16:45:19'),
	(30, '8', 'Modifier Incident', 'update_incie', NULL, '2022-06-14 16:45:50', '2022-06-14 16:45:50'),
	(31, '8', 'Modifier Etat', 'update_etat', NULL, '2022-06-14 16:46:24', '2022-06-14 16:46:24'),
	(32, '8', 'Affecter à un service', 'affec_incie', NULL, '2022-06-14 16:51:10', '2022-06-14 16:51:10'),
	(33, '11', '(action)', '(action dev)', NULL, '2022-07-21 14:56:53', '2022-07-21 14:56:53'),
	(34, '9', 'Enregistrer une validation de commission', 'add_vc', NULL, '2022-07-24 21:09:51', '2022-07-24 21:09:51'),
	(35, '9', 'Modifier une validation de commission', 'update_vc', NULL, '2022-07-24 21:10:14', '2022-07-24 21:10:14'),
	(36, '9', 'Supprimer une validation de commission', 'delete_vc', NULL, '2022-07-24 21:10:37', '2022-07-24 21:10:37'),
	(37, '10', 'Ajouter un service', 'add_serv_onontio', NULL, '2024-10-16 16:18:49', '2024-10-16 16:18:49'),
	(38, '10', 'Modifier un service', 'update_serv_onontio', NULL, '2024-10-16 16:19:19', '2024-10-16 16:19:19'),
	(39, '10', 'Supprimer un service', 'delete_serv_onontio', NULL, '2024-10-16 16:20:43', '2024-10-16 16:20:43'),
	(40, '9', 'Modifier un dossier', 'update_doc', NULL, '2024-10-25 08:33:57', '2024-10-25 08:33:57'),
	(41, '9', 'Ajouter un dossier', 'add_doc', NULL, '2024-10-25 08:34:10', '2024-10-25 08:34:10'),
	(42, '9', 'Afficher les montants payer', 'see_montant_payer', NULL, '2024-10-25 08:35:04', '2024-10-25 08:35:04'),
	(43, '9', 'Afficher les montants restant', 'see_montant_restant', NULL, '2024-10-25 08:35:30', '2024-10-25 08:35:30'),
	(44, '9', 'Affecter un dossier à un poste', 'send_doc_poste', NULL, '2024-10-25 08:45:49', '2024-10-25 08:45:49'),
	(45, '9', 'Rencontre client', 'renc_client_doc', NULL, '2024-10-25 08:46:15', '2024-10-25 08:46:15'),
	(46, '9', 'Effectuer une opération de la caisse', 'op_caisse_doc', NULL, '2024-10-25 08:46:55', '2024-10-25 08:46:55'),
	(47, '9', 'Effectuer une opération de la trésorerie', 'op_treso_doc', NULL, '2024-10-25 08:47:24', '2024-10-25 08:47:24'),
	(48, '9', 'Supprimer un dossier', 'delete_doc', NULL, '2024-10-25 08:47:48', '2024-10-25 08:47:48'),
	(49, '9', 'Afficher les montants d\'ouvertures', 'see_montant_ouv', NULL, '2024-10-26 10:10:00', '2024-10-26 10:10:00'),
	(50, '9', 'Afficher le poste', 'see_poste_doc', NULL, '2024-10-26 10:10:24', '2024-10-26 10:10:24');

-- Listage de la structure de table dossiersbd. action_menu_acces
DROP TABLE IF EXISTS `action_menu_acces`;
CREATE TABLE IF NOT EXISTS `action_menu_acces` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `Menu` bigint unsigned DEFAULT NULL,
  `Role` bigint unsigned DEFAULT NULL,
  `ActionMenu` bigint unsigned DEFAULT NULL,
  `statut` bigint unsigned DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=101 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC;

-- Listage des données de la table dossiersbd.action_menu_acces : ~87 rows (environ)
INSERT INTO `action_menu_acces` (`id`, `Menu`, `Role`, `ActionMenu`, `statut`, `created_at`, `updated_at`) VALUES
	(3, 1, 1, 0, 0, '2022-06-14 15:05:38', '2022-06-14 15:05:38'),
	(4, 1, 1, 3, 0, '2022-06-14 15:05:38', '2022-06-14 15:05:38'),
	(5, 1, 1, 4, 0, '2022-06-14 15:05:38', '2022-06-14 15:05:38'),
	(6, 1, 1, 5, 0, '2022-06-14 15:05:38', '2022-06-14 15:05:38'),
	(7, 1, 1, 6, 0, '2022-06-14 15:15:59', '2022-06-14 15:15:59'),
	(8, 2, 1, 0, 0, '2022-06-14 15:16:05', '2022-06-14 15:16:05'),
	(9, 2, 1, 7, 0, '2022-06-14 15:27:32', '2022-06-14 15:27:32'),
	(10, 2, 1, 8, 0, '2022-06-14 15:27:32', '2022-06-14 15:27:32'),
	(11, 2, 1, 9, 0, '2022-06-14 15:27:32', '2022-06-14 15:27:32'),
	(12, 2, 1, 10, 0, '2022-06-14 15:27:32', '2022-06-14 15:27:32'),
	(13, 3, 1, 0, 0, '2022-06-14 15:35:16', '2022-06-14 15:35:16'),
	(14, 3, 1, 11, 0, '2022-06-14 15:35:16', '2022-06-14 15:35:16'),
	(15, 3, 1, 12, 0, '2022-06-14 15:35:16', '2022-06-14 15:35:16'),
	(16, 3, 1, 13, 0, '2022-06-14 15:35:16', '2022-06-14 15:35:16'),
	(17, 3, 1, 14, 0, '2022-06-14 15:35:16', '2022-06-14 15:35:16'),
	(18, 3, 1, 15, 0, '2022-06-14 15:35:16', '2022-06-14 15:35:16'),
	(19, 4, 1, 0, 0, '2022-06-14 16:01:50', '2022-06-14 16:01:50'),
	(20, 5, 1, 0, 0, '2022-06-14 16:01:50', '2022-06-14 16:01:50'),
	(21, 6, 1, 0, 0, '2022-06-14 16:01:50', '2022-06-14 16:01:50'),
	(22, 4, 1, 16, 1, '2022-06-14 16:01:50', '2022-06-14 16:01:50'),
	(23, 4, 1, 17, 1, '2022-06-14 16:01:50', '2022-06-14 16:01:50'),
	(24, 4, 1, 18, 1, '2022-06-14 16:01:50', '2022-06-14 16:01:50'),
	(25, 5, 1, 19, 1, '2022-06-14 16:01:50', '2022-06-14 16:01:50'),
	(26, 5, 1, 20, 1, '2022-06-14 16:01:50', '2022-06-14 16:01:50'),
	(27, 5, 1, 21, 1, '2022-06-14 16:01:50', '2022-06-14 16:01:50'),
	(28, 6, 1, 22, 1, '2022-06-14 16:01:50', '2022-06-14 16:01:50'),
	(29, 6, 1, 23, 1, '2022-06-14 16:01:50', '2022-06-14 16:01:50'),
	(30, 6, 1, 24, 1, '2022-06-14 16:01:50', '2022-06-14 16:01:50'),
	(31, 7, 1, 0, 0, '2022-06-14 17:02:05', '2022-06-14 17:02:05'),
	(32, 8, 1, 0, 0, '2022-06-14 17:02:05', '2022-06-14 17:02:05'),
	(33, 7, 1, 25, 1, '2022-06-14 17:02:06', '2022-06-14 17:02:06'),
	(34, 7, 1, 26, 1, '2022-06-14 17:02:06', '2022-06-14 17:02:06'),
	(35, 7, 1, 27, 1, '2022-06-14 17:02:06', '2022-06-14 17:02:06'),
	(36, 8, 1, 28, 1, '2022-06-14 17:02:06', '2022-06-14 17:02:06'),
	(37, 8, 1, 29, 1, '2022-06-14 17:02:06', '2022-06-14 17:02:06'),
	(38, 8, 1, 30, 1, '2022-06-14 17:02:06', '2022-06-14 17:02:06'),
	(39, 8, 1, 31, 1, '2022-06-14 17:02:06', '2022-06-14 17:02:06'),
	(40, 8, 1, 32, 1, '2022-06-14 17:02:06', '2022-06-14 17:02:06'),
	(41, 9, 1, 0, 0, '2022-06-15 09:46:59', '2022-06-15 09:46:59'),
	(42, 3, 2, 0, 1, '2022-06-15 09:48:24', '2022-06-15 09:48:24'),
	(43, 4, 2, 0, 0, '2022-06-15 09:48:24', '2022-06-15 09:48:24'),
	(44, 5, 2, 0, 0, '2022-06-15 09:48:24', '2022-06-15 09:48:24'),
	(45, 6, 2, 0, 0, '2022-06-15 09:48:24', '2022-06-15 09:48:24'),
	(46, 8, 2, 0, 0, '2022-06-15 09:48:25', '2022-06-15 09:48:25'),
	(47, 9, 2, 0, 0, '2022-06-15 09:48:25', '2022-06-15 09:48:25'),
	(48, 3, 2, 11, 1, '2022-06-15 09:48:25', '2022-06-15 09:48:25'),
	(49, 3, 2, 12, 1, '2022-06-15 09:48:25', '2022-06-15 09:48:25'),
	(50, 3, 2, 13, 1, '2022-06-15 09:48:25', '2022-06-15 09:48:25'),
	(51, 3, 2, 14, 1, '2022-06-15 09:48:25', '2022-06-15 09:48:25'),
	(52, 3, 2, 15, 1, '2022-06-15 09:48:25', '2022-06-15 09:48:25'),
	(53, 4, 2, 16, 1, '2022-06-15 09:48:25', '2022-06-15 09:48:25'),
	(54, 4, 2, 17, 1, '2022-06-15 09:48:25', '2022-06-15 09:48:25'),
	(55, 4, 2, 18, 1, '2022-06-15 09:48:25', '2022-06-15 09:48:25'),
	(56, 5, 2, 19, 1, '2022-06-15 09:48:25', '2022-06-15 09:48:25'),
	(57, 5, 2, 20, 1, '2022-06-15 09:48:25', '2022-06-15 09:48:25'),
	(58, 5, 2, 21, 1, '2022-06-15 09:48:25', '2022-06-15 09:48:25'),
	(59, 6, 2, 22, 1, '2022-06-15 09:48:25', '2022-06-15 09:48:25'),
	(60, 6, 2, 23, 1, '2022-06-15 09:48:25', '2022-06-15 09:48:25'),
	(61, 6, 2, 24, 1, '2022-06-15 09:48:25', '2022-06-15 09:48:25'),
	(62, 8, 2, 28, 1, '2022-06-15 09:48:25', '2022-06-15 09:48:25'),
	(63, 8, 2, 29, 1, '2022-06-15 09:48:25', '2022-06-15 09:48:25'),
	(64, 8, 2, 30, 1, '2022-06-15 09:48:25', '2022-06-15 09:48:25'),
	(65, 8, 2, 31, 1, '2022-06-15 09:48:25', '2022-06-15 09:48:25'),
	(66, 8, 2, 32, 1, '2022-06-15 09:48:25', '2022-06-15 09:48:25'),
	(67, 7, 4, 0, 0, '2022-06-15 12:18:15', '2022-06-15 12:18:15'),
	(68, 9, 4, 0, 0, '2022-06-15 12:18:15', '2022-06-15 12:18:15'),
	(69, 7, 4, 25, 0, '2022-06-15 12:18:15', '2022-06-15 12:18:15'),
	(70, 7, 4, 26, 0, '2022-06-15 12:18:15', '2022-06-15 12:18:15'),
	(71, 7, 4, 27, 0, '2022-06-15 12:18:15', '2022-06-15 12:18:15'),
	(72, 9, 1, 34, 0, '2022-07-24 21:53:05', '2022-07-24 21:53:05'),
	(73, 9, 1, 35, 0, '2022-07-24 21:53:05', '2022-07-24 21:53:05'),
	(74, 9, 1, 36, 0, '2022-07-24 21:53:05', '2022-07-24 21:53:05'),
	(75, 9, 2, 34, 0, '2022-07-24 21:53:29', '2022-07-24 21:53:29'),
	(76, 9, 2, 35, 0, '2022-07-24 21:53:29', '2022-07-24 21:53:29'),
	(77, 9, 2, 36, 0, '2022-07-24 21:53:29', '2022-07-24 21:53:29'),
	(78, 10, 1, 0, 0, '2024-08-18 09:24:29', '2024-08-18 09:24:29'),
	(79, 9, 1, 40, 0, '2024-10-25 09:40:50', '2024-10-25 09:40:50'),
	(80, 9, 1, 41, 0, '2024-10-25 09:40:50', '2024-10-25 09:40:50'),
	(81, 9, 1, 42, 0, '2024-10-25 09:40:50', '2024-10-25 09:40:50'),
	(82, 9, 1, 43, 0, '2024-10-25 09:40:50', '2024-10-25 09:40:50'),
	(83, 9, 1, 44, 0, '2024-10-25 09:40:50', '2024-10-25 09:40:50'),
	(84, 9, 1, 45, 0, '2024-10-25 09:40:50', '2024-10-25 09:40:50'),
	(85, 9, 1, 46, 0, '2024-10-25 09:40:50', '2024-10-25 09:40:50'),
	(86, 9, 1, 47, 0, '2024-10-25 09:40:50', '2024-10-25 09:40:50'),
	(87, 9, 1, 48, 0, '2024-10-25 09:40:50', '2024-10-25 09:40:50'),
	(88, 9, 1, 49, 0, '2024-10-26 10:19:13', '2024-10-26 10:19:13'),
	(89, 9, 1, 50, 0, '2024-10-26 10:19:13', '2024-10-26 10:19:13'),
	(90, 9, 3, 0, 0, '2024-10-31 16:39:54', '2024-10-31 16:39:54'),
	(91, 10, 3, 0, 0, '2024-10-31 16:39:54', '2024-10-31 16:39:54'),
	(92, 9, 3, 40, 1, '2024-10-31 16:39:54', '2024-10-31 16:39:54'),
	(93, 9, 3, 41, 0, '2024-10-31 16:39:54', '2024-10-31 16:39:54'),
	(94, 9, 3, 44, 0, '2024-10-31 16:39:54', '2024-10-31 16:39:54'),
	(95, 9, 3, 48, 0, '2024-10-31 16:39:54', '2024-10-31 16:39:54'),
	(96, 9, 3, 50, 0, '2024-10-31 16:39:54', '2024-10-31 16:39:54'),
	(97, 10, 3, 37, 0, '2024-10-31 16:39:54', '2024-10-31 16:39:54'),
	(98, 10, 3, 38, 0, '2024-10-31 16:39:54', '2024-10-31 16:39:54'),
	(99, 10, 3, 39, 0, '2024-10-31 16:39:54', '2024-10-31 16:39:54'),
	(100, 9, 3, 49, 0, '2024-11-06 06:12:47', '2024-11-06 06:12:47');

-- Listage de la structure de table dossiersbd. dossiers
DROP TABLE IF EXISTS `dossiers`;
CREATE TABLE IF NOT EXISTS `dossiers` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `denomination` tinyint DEFAULT NULL,
  `nom` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `prenom` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `objet` text COLLATE utf8mb4_unicode_ci,
  `montant` bigint DEFAULT NULL COMMENT 'Montant d''ouverture ',
  `revenu` bigint DEFAULT NULL,
  `payer` bigint DEFAULT NULL,
  `solde` bigint DEFAULT NULL,
  `paramservice` bigint DEFAULT NULL COMMENT 'foreign key to service',
  `datedebut` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `datefin` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `poste` bigint DEFAULT NULL,
  `commentaire` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC;

-- Listage des données de la table dossiersbd.dossiers : ~0 rows (environ)

-- Listage de la structure de table dossiersbd. menus
DROP TABLE IF EXISTS `menus`;
CREATE TABLE IF NOT EXISTS `menus` (
  `idMenu` bigint unsigned NOT NULL AUTO_INCREMENT,
  `libelleMenu` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `titre_page` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `controller` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `route` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `Topmenu_id` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `num_ordre` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `order_ss` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `iconee` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `element_menu` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `statut` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_action` bigint unsigned DEFAULT NULL,
  `action_save` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`idMenu`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC;

-- Listage des données de la table dossiersbd.menus : ~4 rows (environ)
INSERT INTO `menus` (`idMenu`, `libelleMenu`, `titre_page`, `controller`, `route`, `Topmenu_id`, `num_ordre`, `order_ss`, `iconee`, `element_menu`, `statut`, `user_action`, `action_save`, `created_at`, `updated_at`) VALUES
	(1, 'Rôles', 'Liste des rôles', NULL, 'GR', '0', '500', NULL, 'dddd', NULL, NULL, 1, NULL, '2022-02-11 13:43:27', '2024-08-18 09:08:04'),
	(2, 'Menus', 'Liste des menus', NULL, 'GM', '0', '500', NULL, '#', NULL, NULL, 1, NULL, '2022-06-14 15:09:03', '2024-08-18 09:08:16'),
	(3, 'Utilisateurs', 'Liste des utilisateurs', NULL, 'GU', '0', '500', NULL, '#', NULL, NULL, 1, NULL, '2022-06-14 15:29:29', '2024-08-18 09:08:26'),
	(9, 'Tableau de bord', 'Tableau de bord', NULL, 'dashboard', '0', '1', NULL, '#', NULL, NULL, 1, NULL, '2022-06-15 09:38:30', '2024-08-18 09:07:50'),
	(10, 'Liste des services', 'Liste des services', NULL, 'GVSO', '0', '500', NULL, '#', NULL, NULL, 1, NULL, '2024-08-18 09:23:03', '2024-08-18 09:23:03');

-- Listage de la structure de table dossiersbd. migrations
DROP TABLE IF EXISTS `migrations`;
CREATE TABLE IF NOT EXISTS `migrations` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC;

-- Listage des données de la table dossiersbd.migrations : ~8 rows (environ)
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
	(1, '2019_12_14_000001_create_personal_access_tokens_table', 1),
	(2, '2021_11_18_164633_create_utilisateurs_table', 1),
	(3, '2021_11_18_164842_create_roles_table', 1),
	(4, '2021_11_18_164907_create_menus_table', 1),
	(5, '2021_11_18_164945_create_action_menus_table', 1),
	(6, '2021_11_18_165017_create_action_menu_acces_table', 1),
	(7, '2021_11_18_175454_create_traces_table', 1),
	(14, '2022_07_22_173037_create_validcoms_table', 2);

-- Listage de la structure de table dossiersbd. paramservices
DROP TABLE IF EXISTS `paramservices`;
CREATE TABLE IF NOT EXISTS `paramservices` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `service` bigint DEFAULT NULL,
  `typeclient` tinyint DEFAULT NULL COMMENT '1 : Personne Physique; 2 : Personne Morale',
  `ouverture` int DEFAULT NULL,
  `montantcontrat` int DEFAULT NULL,
  `tauxcontrat` float DEFAULT NULL,
  `tranchemin` int DEFAULT NULL,
  `tranchemax` int DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Listage des données de la table dossiersbd.paramservices : ~11 rows (environ)
INSERT INTO `paramservices` (`id`, `service`, `typeclient`, `ouverture`, `montantcontrat`, `tauxcontrat`, `tranchemin`, `tranchemax`, `created_at`, `updated_at`) VALUES
	(1, 2, 2, 200000, 250000, 0, 0, -1, '2024-10-17 17:35:39', '2024-10-17 17:35:39'),
	(2, 2, 1, 150000, 0, 0, 0, -1, '2024-10-17 17:36:26', '2024-10-17 17:36:26'),
	(3, 13, 2, 200000, 0, 5, 0, -1, '2024-10-20 13:28:11', '2024-10-20 13:28:11'),
	(4, 13, 1, 150000, 300000, 0, 0, -1, '2024-10-20 13:29:42', '2024-10-20 13:29:42'),
	(5, 7, 2, 200000, 0, 10, 100000, 5000000, '2024-10-20 13:39:39', '2024-10-20 13:39:39'),
	(6, 7, 2, 200000, 0, 8, 5000000, 20000000, '2024-10-20 13:40:26', '2024-10-20 13:40:26'),
	(7, 7, 2, 200000, 0, 5, 20000000, 50000000, '2024-10-20 13:41:05', '2024-10-20 13:41:05'),
	(8, 7, 2, 200000, 0, 3, 50000000, -1, '2024-10-20 13:41:40', '2024-10-20 13:41:40'),
	(9, 7, 1, 50000, 0, 2, 50000000, -1, '2024-10-20 13:42:26', '2024-10-20 13:42:26'),
	(10, 7, 1, 50000, 0, 3, 20000000, 50000000, '2024-10-20 13:43:03', '2024-10-20 13:43:03'),
	(11, 7, 1, 50000, 0, 4, 5000000, 20000000, '2024-10-20 13:43:39', '2024-10-20 13:43:39'),
	(12, 7, 1, 50000, 0, 5, 100000, 5000000, '2024-10-20 13:44:11', '2024-10-20 13:44:11');

-- Listage de la structure de table dossiersbd. rencontres
DROP TABLE IF EXISTS `rencontres`;
CREATE TABLE IF NOT EXISTS `rencontres` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `commentaire` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `dossier` bigint DEFAULT NULL,
  `date` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `nom` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `structure` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `resultat` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Listage des données de la table dossiersbd.rencontres : ~9 rows (environ)

-- Listage de la structure de table dossiersbd. roles
DROP TABLE IF EXISTS `roles`;
CREATE TABLE IF NOT EXISTS `roles` (
  `idRole` bigint unsigned NOT NULL AUTO_INCREMENT,
  `libelle` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `code` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_action` bigint unsigned DEFAULT NULL,
  `action_save` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`idRole`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC;

-- Listage des données de la table dossiersbd.roles : ~4 rows (environ)
INSERT INTO `roles` (`idRole`, `libelle`, `code`, `user_action`, `action_save`, `created_at`, `updated_at`) VALUES
	(1, 'Développeur', 'dev', 1, NULL, '2022-02-10 19:54:21', '2022-02-10 19:54:21'),
	(2, 'Administrateur', 'admin', 1, NULL, '2022-02-10 19:59:32', '2022-02-10 21:02:04'),
	(3, 'Secrétaire', 'sec', 1, NULL, '2024-08-18 09:12:28', '2024-08-18 09:12:28'),
	(4, 'Comptabilité', 'cmp', 1, NULL, '2024-08-18 09:12:48', '2024-08-18 09:12:48'),
	(5, 'Poste', 'p', 1, NULL, '2024-08-18 09:13:57', '2024-10-24 23:15:10');

-- Listage de la structure de table dossiersbd. services
DROP TABLE IF EXISTS `services`;
CREATE TABLE IF NOT EXISTS `services` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `libelle` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Listage des données de la table dossiersbd.services : ~12 rows (environ)
INSERT INTO `services` (`id`, `libelle`, `created_at`, `updated_at`) VALUES
	(2, 'CONSEILS JURIDIQUES', '2024-10-17 09:32:45', '2024-10-17 17:33:28'),
	(3, 'Audit   veille juridique', '2024-10-20 13:14:59', '2024-10-20 13:14:59'),
	(4, 'Médiation   Arbitrage', '2024-10-20 13:15:20', '2024-10-20 13:15:20'),
	(5, 'Assistance Juridique', '2024-10-20 13:15:54', '2024-10-20 13:15:54'),
	(6, 'Suivi Juridique de dossier', '2024-10-20 13:16:16', '2024-10-20 13:16:16'),
	(7, 'Recouvrement de créances à l amiable', '2024-10-20 13:16:35', '2024-10-20 13:16:35'),
	(8, 'Rédaction d actes juridiques', '2024-10-20 13:17:06', '2024-10-20 13:17:06'),
	(9, 'Gouverance et stratégie de gestion', '2024-10-20 13:17:27', '2024-10-20 13:17:27'),
	(10, 'Gestion de litige', '2024-10-20 13:17:44', '2024-10-20 13:17:44'),
	(11, 'Assistance dans le recrutement', '2024-10-20 13:18:08', '2024-10-20 13:18:08'),
	(12, 'Gestion immobilière', '2024-10-20 13:18:36', '2024-10-20 13:18:36'),
	(13, 'Etude et Analyse de projets', '2024-10-20 13:19:00', '2024-10-20 13:19:00');

-- Listage de la structure de table dossiersbd. traces
DROP TABLE IF EXISTS `traces`;
CREATE TABLE IF NOT EXISTS `traces` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `action` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `libelle` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=494 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC;

-- Listage des données de la table dossiersbd.traces : ~119 rows (environ)

-- Listage de la structure de table dossiersbd. tresoreries
DROP TABLE IF EXISTS `tresoreries`;
CREATE TABLE IF NOT EXISTS `tresoreries` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `entre` bigint unsigned DEFAULT '0',
  `sortant` bigint unsigned DEFAULT '0',
  `libelle` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `restant` bigint unsigned DEFAULT NULL,
  `solde` bigint unsigned DEFAULT NULL,
  `dossier` bigint unsigned DEFAULT NULL,
  `date` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Listage des données de la table dossiersbd.tresoreries : ~4 rows (environ)
INSERT INTO `tresoreries` (`id`, `entre`, `sortant`, `libelle`, `restant`, `solde`, `dossier`, `date`, `created_at`, `updated_at`) VALUES
	(5, 1000000, 0, 'Avances', 13000000, NULL, 2, '23-04-2024', '2024-04-23 08:23:26', '2024-04-23 08:23:26'),
	(6, 400000, 0, 'Avances', 29600000, NULL, 1, '24-04-2024', '2024-04-24 14:12:35', '2024-04-24 14:12:35'),
	(8, 1000, 0, 'NN', 13785, NULL, 3, '25-10-2024', '2024-10-24 23:45:53', '2024-10-24 23:45:53'),
	(10, 9000, 0, 'Bien', 41000, NULL, 5, '25-10-2024', '2024-10-25 10:09:06', '2024-10-25 10:09:06');

-- Listage de la structure de table dossiersbd. utilisateurs
DROP TABLE IF EXISTS `utilisateurs`;
CREATE TABLE IF NOT EXISTS `utilisateurs` (
  `idUser` bigint unsigned NOT NULL AUTO_INCREMENT,
  `nom` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `prenom` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sexe` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tel` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `mail` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `adresse` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `login` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `Role` bigint unsigned DEFAULT NULL,
  `Service` bigint unsigned DEFAULT NULL,
  `other` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `signature` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `auth` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `Societe` bigint unsigned DEFAULT NULL,
  `image` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_action` bigint unsigned DEFAULT NULL,
  `action_save` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `statut` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `remember_token` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`idUser`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC;

-- Listage des données de la table dossiersbd.utilisateurs : ~2 rows (environ)
INSERT INTO `utilisateurs` (`idUser`, `nom`, `prenom`, `sexe`, `tel`, `mail`, `adresse`, `login`, `password`, `Role`, `Service`, `other`, `signature`, `auth`, `Societe`, `image`, `user_action`, `action_save`, `statut`, `remember_token`, `created_at`, `updated_at`) VALUES
	(1, 'DJIDAGBAGBA', 'S T Emmanuel', 'M', '61310573', 'emmanueldjidagbagba@gmail.com', 'Cotonou', 'kanths', 'com8397c8070f8bb39004be88e3fe65d27f2e23f52fdste', 1, 2, 'Analyste Concepteur; Développeur; DBA Oracle; Formateur; ', NULL, NULL, NULL, NULL, 1, 's', '0', NULL, '2022-01-26 10:06:01', '2022-01-26 10:06:01'),
	(3, 'TEST', 'TEST', '', '', 'test@gmail.com', '', 'test', 'com7c4a8d09ca3762af61e59520943dc26494f8941bdste', 2, NULL, '', NULL, '', 1, NULL, 1, 's', '0', NULL, '2024-04-24 14:16:24', '2024-04-24 14:21:55'),
	(4, 'Poste', '1', '', '', 'post1tio@gmail.com', '', 'post@1tio', 'com40bd001563085fc35165329ea1ff5c5ecbdbbeefdste', 5, NULL, '', NULL, '', 1, NULL, 1, 's', '0', NULL, '2024-10-24 23:19:42', '2024-10-24 23:19:54'),
	(5, 'ADJAHOUIME', 'Mariette', '', '', 'mariette@gmail.com', '', 'amariette', 'com40bd001563085fc35165329ea1ff5c5ecbdbbeefdste', 3, NULL, '', NULL, '', 1, NULL, 1, 's', '0', NULL, '2024-10-31 16:41:11', '2024-11-06 06:11:14');

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
