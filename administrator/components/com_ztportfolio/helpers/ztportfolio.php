<?php

/**
 * @package     Zt Portfolio
 *
 * @copyright   Copyright (C) 2015 ZooTemplate. All rights reserved.
 * * @license     GNU GPL v2.
 */
defined('_JEXEC') or die;

/**
 * This class is required since Joomla will look for a file in helpers/ats.php with a class and method named
 * AtsHelper::addSubmenu
 */
class ZtPortfolioHelper extends JHelperContent {

    public static function addSubmenu($vName) {
        if ($view = 'categories') {
            $categoriesView = 'index.php?option=com_categories&view=categories&extension=com_ztportfolio';
            $itemsView = 'index.php?option=com_ztportfolio&view=items';
            $propertiesView = 'index.php?option=com_ztportfolio&view=properties';
            $tagsView = 'index.php?option=com_ztportfolio&view=tags';

            JHtmlSidebar::addEntry(JText::_('COM_ZTPORTFOLIO_CATEGORIES'), $categoriesView, $vName == 'categories');
            JHtmlSidebar::addEntry(JText::_('COM_ZTPORTFOLIO_TITLE_ITEMS'), $itemsView, $vName == 'items');
            JHtmlSidebar::addEntry(JText::_('COM_ZTPORTFOLIO_TITLE_PROPERTIES'), $propertiesView, $vName == 'properties');
            JHtmlSidebar::addEntry(JText::_('COM_ZTPORTFOLIO_TITLE_TAGS'), $tagsView, $vName == 'tags');
        }
    }

}
