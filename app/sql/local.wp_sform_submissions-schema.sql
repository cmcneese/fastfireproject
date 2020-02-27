/*!40101 SET NAMES binary*/;
/*!40014 SET FOREIGN_KEY_CHECKS=0*/;

CREATE TABLE `wp_sform_submissions` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `requester_type` tinytext COLLATE utf8mb4_unicode_520_ci NOT NULL,
  `requester_id` int(15) NOT NULL,
  `date` datetime NOT NULL DEFAULT '1970-01-01 00:00:00',
  `notes` text COLLATE utf8mb4_unicode_520_ci NOT NULL,
  `name` tinytext COLLATE utf8mb4_unicode_520_ci NOT NULL,
  `email` varchar(200) COLLATE utf8mb4_unicode_520_ci NOT NULL,
  `subject` varchar(200) COLLATE utf8mb4_unicode_520_ci NOT NULL,
  `object` longtext COLLATE utf8mb4_unicode_520_ci NOT NULL,
  `ip` varchar(128) COLLATE utf8mb4_unicode_520_ci NOT NULL,
  `status` tinytext COLLATE utf8mb4_unicode_520_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_520_ci;
