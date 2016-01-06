<?php

defined('_JEXEC') or die;

// Include only once
require_once __DIR__ . '/helper.php';

$portfolios = ModZtPortfolioHelper::getPortfolios();
$tags = ModZtPortfolioHelper::getTags();
$document = JFactory::getDocument();
$document->addScript(JUri::base() . 'modules/mod_ztportfolio/core/assets/js/masonry.pkgd.min.js');
$document->addScript(JUri::base() . 'modules/mod_ztportfolio/core/assets/js/isotope.min.js');
$document->addStyleSheet(JUri::base() . 'modules/mod_ztportfolio/core/assets/css/portfolio.css');

require_once __DIR__ . '/local/default.php';