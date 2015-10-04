--
-- Table structure for table `#__ztportfolio_categories`
--

CREATE TABLE IF NOT EXISTS `#__ztportfolio_categories` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `header` text NOT NULL,
  `status` int(11) NOT NULL,
    PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


--
-- Table structure for table `#__ztportfolio_data`
--

CREATE TABLE IF NOT EXISTS `#__ztportfolio_data` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `category` int(11) NOT NULL,
  `header` text NOT NULL,
  `title` varchar(500) NOT NULL,
  `content` longtext NOT NULL,
  `status` int(11) NOT NULL,
  `thumbnail` varchar(1000) NOT NULL,
  `modified` int(11) NOT NULL,
   PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
