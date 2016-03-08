<?php
/**
 * @package     Zt Portfolio
 *
 * @copyright   Copyright (C) 2015 ZooTemplate. All rights reserved.
 ** @license     GNU GPL v2.
 */

defined('_JEXEC') or die();

JHtml::_('formbehavior.chosen', 'select');
JHtml::_('bootstrap.framework');

$doc = JFactory::getDocument();
$doc->addStylesheet( JURI::base(true) . '/components/com_ztportfolio/assets/css/ztportfolio.css' );
$doc->addScript( JURI::base(true) . '/components/com_ztportfolio/assets/js/ztportfolio.js' );
$doc->addStylesheet( JURI::base(true) . '/components/com_ztportfolio/assets/datepicker/css/jquery-ui-1.9.2.custom.min.css' );
$doc->addScript( JURI::base(true) . '/components/com_ztportfolio/assets/datepicker/js/jquery-ui-1.9.2.custom.min.js');
echo $this->getRenderedForm();