<?php

class ZtPortfolioViewCategories extends JViewLegacy
{

    public function __construct($config = array())
    {
        parent::__construct($config);
    }
    public function display($tpl = null)
    {
        $this->addToolbar();
        parent::display($tpl);
    }

    protected function addToolbar()
    {
        JToolBarHelper::title(JText::_('COM_ZTPORTFOLIO_MANAGEMENT_TITLE'));
    }

}
