<?php

defined('_JEXEC') or die('Direct Access to ' . basename(__FILE__) . ' is not allowed.');

// Include only once
require_once __DIR__ . '/helper.php';

$layout = $params->get('layout', 'default');
$number = intval($params->get('number', 10)); 
$readmore = $params->get('show_loadmore', 1);
$show_tags = $params->get('show_tags', 1);
$show_desc = $params->get('show_desc', 1);
$desc_limit = $params->get('desc_limit', '');
$show_dots = $params->get('show_dots', 0);
$show_nav = $params->get('show_nav', 0);
$autoplay = $params->get('autoplay', 0);
$column = $params->get('column', 3);
$mobile_items = $params->get('mobile_items', 1);
$tablet_items = $params->get('tablet_items', 1);
$space = $params->get('space', 15);
$orderby = $params->get('orderby', 'ASC');
$show_filter = $params->get('show_filter', 1);
$catids = $params->get('catid', '');
$sub_title = $params->get('sub_title', '');
$thumbnail_type = $params->get('thumbnail_type', 'rectangle');

$page = 1;
if(isset($_REQUEST['page'])){
  $page = intval($_REQUEST['page']);
}
$offset = ($page - 1)*$number; 

$portfolios = ModZtPortfolioHelper::getPortfolios($number, $catids, $offset, $orderby = 'DESC');

$count_portfolios = ModZtPortfolioHelper::countPortfolio($catids);


if(count($portfolios) == 0){
  die( 'no_portfolios');
}

$tags = ModZtPortfolioHelper::getTags();

$document = JFactory::getDocument();
$document->addScript(JUri::base() . 'modules/mod_ztportfolio/assets/js/masonry.pkgd.min.js');
$document->addScript(JUri::base() . 'modules/mod_ztportfolio/assets/js/isotope.min.js');
$document->addStyleSheet(JUri::base() . 'modules/mod_ztportfolio/assets/css/mod_ztportfolio.css');

require JModuleHelper::getLayoutPath('mod_ztportfolio', $params->get('layout', 'default'));
if(isset($_REQUEST['page'])){
  die;
}
