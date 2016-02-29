<?php

defined('_JEXEC') or die('Direct Access to ' . basename(__FILE__) . ' is not allowed.');

// Include only once
require_once __DIR__ . '/helper.php';

$layout = $params->get('layout', 'default');
$number = intval($params->get('number', 10));
$readmore = $params->get('show_loadmore', 1);
$orderby = $params->get('orderby', 'ASC');

$page = 1;
if(isset($_REQUEST['page'])){
	$page = intval($_REQUEST['page']);
}
$offset = ($page - 1)*$number; 

$portfolios = ModZtPortfolioHelper::getPortfolios($number = 10, $offset, $orderby = 'DESC');

$tags = ModZtPortfolioHelper::getTags($number = null );

$document = JFactory::getDocument();

$document->addScript(JUri::base() . 'modules/mod_ztportfolio/assets/js/masonry.pkgd.min.js');
$document->addScript(JUri::base() . 'modules/mod_ztportfolio/assets/js/isotope.min.js');
$document->addStyleSheet(JUri::base() . 'modules/mod_ztportfolio/assets/css/mod_ztportfolio.css');
$document->addStyleSheet(JUri::base() . 'modules/mod_ztportfolio/assets/css/layout/'.$layout.'.css');


require_once JModuleHelper::getLayoutPath('mod_ztportfolio', $layout);
