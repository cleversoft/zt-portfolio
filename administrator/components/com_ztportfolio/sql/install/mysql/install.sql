CREATE TABLE IF NOT EXISTS `#__ztportfolio_items` (
  `ztportfolio_item_id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `alias` varchar(55) NOT NULL,
  `category_id` int(11) NOT NULL,
  `image` text NOT NULL,
  `video` text NOT NULL,
  `properties` text NOT NULL,
  `description` mediumtext,
  `ztportfolio_tag_id` text NOT NULL,
  `url` text NOT NULL,
  `enabled` tinyint(3) NOT NULL DEFAULT '1',
  `language` varchar(255) NOT NULL DEFAULT '*',
  `access` int(5) NOT NULL DEFAULT '1',
  `ordering` int(10) NOT NULL DEFAULT '0',
  `created_by` bigint(20) NOT NULL DEFAULT '0',
  `created_on` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `modified_by` bigint(20) NOT NULL DEFAULT '0',
  `modified_on` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `locked_by` bigint(20) NOT NULL DEFAULT '0',
  `locked_on` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`ztportfolio_item_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS `#__ztportfolio_tags` (
  `ztportfolio_tag_id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `alias` varchar(55) NOT NULL,
  `language` varchar(255) NOT NULL DEFAULT '*',
  `category_id` int(11) NOT NULL,
  PRIMARY KEY (`ztportfolio_tag_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


CREATE TABLE IF NOT EXISTS `#__ztportfolio_properties` (
  `ztportfolio_property_id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(256) NOT NULL,
  `type` varchar(25) NOT NULL,
  `value` varchar(512) NOT NULL,
  PRIMARY KEY (`ztportfolio_property_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
