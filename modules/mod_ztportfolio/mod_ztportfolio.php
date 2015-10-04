<?php

defined('_JEXEC') or die;

if(!JFolder::exists(JPATH_ROOT . '/plugins/system/zooframework') && defined('ZTFRAMEWORK')){
    return JError::raiseWarning(404, JText::_('COM_ZTPORTFOLIO_ERROR_ZOOFRAMEWORK_REQUIRED'));
}

// Include the syndicate functions only once
require_once __DIR__ . '/helper.php';

ZtFramework::registerExtension(__DIR__ . '/extension.json');

$ztHtml = new ZtHtml();
$portfolios = ModZtPortfolioHelper::getPortfolios();
$categories = ModZtPortfolioHelper::getCategories();

$ztPath = ZtPath::getInstance();
$ztHtml->set('portfolios', $portfolios);
$ztHtml->set('categories', $categories);

$ztAsset = new ZtAssets();
$ztAsset->addStyleSheet('mod_ztportfolio://assets/css/portfolio.css');
$ztAsset->addScript('mod_ztportfolio://assets/js/isotope.min.js');

echo $ztHtml->fetch('mod_ztportfolio://default.php');