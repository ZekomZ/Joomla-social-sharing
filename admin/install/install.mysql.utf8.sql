CREATE TABLE IF NOT EXISTS `#__loginradius_share_settings` (
	`id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
	`setting` varchar(255) NOT NULL,
	`value` varchar(1000) NOT NULL,
	PRIMARY KEY (`id`),
	UNIQUE KEY `setting` (`setting`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8;