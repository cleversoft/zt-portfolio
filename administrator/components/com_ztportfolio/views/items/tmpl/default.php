<?php
/**
 * @package     Zt Portfolio
 *
 * @copyright   Copyright (C) 2015 ZooTemplate. All rights reserved.
 ** @license     GNU GPL v2.
 */

defined('_JEXEC') or die();

// Load the method jquery script.
JHtml::_('jquery.framework');

$doc = JFactory::getDocument();
$doc->addStylesheet( JURI::base(true) . '/components/com_ztportfolio/assets/css/ztportfolio.css' );
$doc->addStylesheet( JURI::base(true) . '/components/com_ztportfolio/assets/js/ztportfolio.js' );

echo $this->getRenderedForm();