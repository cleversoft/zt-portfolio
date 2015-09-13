<?php
/**
 * @package     ZooTemplate.com
 * @subpackage  com_ztportfolio
 *
 * @copyright   Copyright (C) 2015. All rights reserved.
 * @license     N/A
 */

defined('_JEXEC') or die;


$document = JFactory::getDocument();

/* Permission checking */
if (!JFactory::getUser()->authorise('core.manage', 'com_ztautolinks')) {
    return JError::raiseWarning(404, JText::_('JERROR_ALERTNOAUTHOR'));
}

/* Register tables directory */
JTable::addIncludePath(__DIR__ . '/tables');
$controller = JControllerLegacy::getInstance('ZtPortfolio');
if(JFolder::exists(JPATH_ROOT . '/plugins/system/zooframework') && defined('ZTFRAMEWORK')){
    $controller->execute(JFactory::getApplication()->input->get('task'));
}else{
    return JError::raiseWarning(404, JText::_('COM_PORTFOLIO_ERROR_ZOOFRAMEWORK_REQUIRED'));
}
$controller->redirect();