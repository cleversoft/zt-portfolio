<?php

defined('_JEXEC') or die('Direct Access to ' . basename(__FILE__) . ' is not allowed.');

// Include only once
require_once __DIR__ . '/helper.php';

$layout = $params->get('layout', 'default');
$number = $params->get('number', 10);
$readmore = $params->get('show_loadmore', 1);
$orderby = $params->get('orderby', 'ASC');


$portfolios = ModZtPortfolioHelper::getPortfolios($number = 10, $orderby = 'DESC');

$tags = ModZtPortfolioHelper::getTags($number = null );

$document = JFactory::getDocument();

$document->addScript(JUri::base() . 'modules/mod_ztportfolio/core/assets/js/masonry.pkgd.min.js');
$document->addScript(JUri::base() . 'modules/mod_ztportfolio/core/assets/js/isotope.min.js');
$document->addStyleSheet(JUri::base() . 'modules/mod_ztportfolio/core/assets/css/portfolio.css');


require_once JModuleHelper::getLayoutPath('mod_ztportfolio', $params->get('layout', 'default'));
