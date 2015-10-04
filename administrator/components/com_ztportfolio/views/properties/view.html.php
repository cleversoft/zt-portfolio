<?php

class ZtPortfolioViewProperties extends JViewLegacy {

    public function display($tpl = null) {
        $ztAsset = ZtAssets::getInstance();
        $ztAsset->addStyleSheet('com_ztportfolio://assets/vendor/jquery-file-tree/css/jquery-file-tree.css');
        $ztAsset->addScript('com_ztportfolio://assets/vendor/jquery-file-tree/js/jquery.easing.js');
        $ztAsset->addScript('com_ztportfolio://assets/vendor/jquery-file-tree/js/jquery-file-tree.js');
        $this->addToolbar();
        parent::display($tpl);
    }

    protected function addToolbar() {
        JToolBarHelper::title(JText::_('COM_ZTPORTFOLIO_MANAGEMENT_TITLE')  . ' > ' . JText::_('COM_ZTPORTFOLIO_HEADER_PROPERTIES'), 'list-view');
    }

}
