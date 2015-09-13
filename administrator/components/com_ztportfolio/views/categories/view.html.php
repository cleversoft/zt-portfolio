<?php

class ztportfolioViewCategories extends JViewLegacy
{

    public function display($tpl = null)
    {
        $this->addToolbar();
        parent::display($tpl);
    }

    protected function addToolbar()
    {
        JToolBarHelper::title(JText::_('COM_PORTFOLIO_MANAGEMENT_TITLE'));
    }

}
