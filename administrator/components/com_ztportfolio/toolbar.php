<?php

/**
 * @package     Zt Portfolio
 *
 * @copyright   Copyright (C) 2015 ZooTemplate. All rights reserved.
 * * @license     GNU GPL v2.
 */
defined('_JEXEC') or die();

class ZtPortfolioToolbar extends FOFToolbar {

    function onBrowse() {
        JToolBarHelper::preferences('com_ztportfolio');

        $categoriesView = 'index.php?option=com_categories&view=categories&extension=com_ztportfolio';
        JHtmlSidebar::addEntry(JText::_('COM_ZTPORTFOLIO_CATEGORIES'), $categoriesView, 'categories');

        parent::onBrowse();
    }

}
