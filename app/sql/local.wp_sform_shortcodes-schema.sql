/*!40101 SET NAMES binary*/;
/*!40014 SET FOREIGN_KEY_CHECKS=0*/;

CREATE TABLE `wp_sform_shortcodes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `shortcode` tinytext COLLATE utf8mb4_unicode_520_ci NOT NULL,
  `name` tinytext COLLATE utf8mb4_unicode_520_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_520_ci;
