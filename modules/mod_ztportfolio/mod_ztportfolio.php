<?php

defined('_JEXEC') or die('Direct Access to ' . basename(__FILE__) . ' is not allowed.');

// Include only once
require_once __DIR__ . '/helper.php';

$layout = $params->get('layout', 'default');
$number = $params->get('number', 10);

$portfolios = ModZtPortfolioHelper::getPortfolios($number);
$tags = ModZtPortfolioHelper::getTags();

$document = JFactory::getDocument();
$document->addScript(JUri::base() . 'modules/mod_ztportfolio/core/assets/js/masonry.pkgd.min.js');
$document->addScript(JUri::base() . 'modules/mod_ztportfolio/core/assets/js/isotope.min.js');
$document->addStyleSheet(JUri::base() . 'modules/mod_ztportfolio/core/assets/css/portfolio.css');


require_once JModuleHelper::getLayoutPath('mod_ztportfolio', $params->get('layout', 'default'));