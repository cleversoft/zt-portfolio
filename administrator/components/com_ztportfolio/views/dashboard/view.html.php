<?php

class ZtPortfolioViewDashboard extends JViewLegacy
{

    public function display($tpl = null)
    {
        $this->addToolbar();
        parent::display($tpl);
    }

    protected function addToolbar()
    {
        JToolBarHelper::title(JText::_('COM_ZTPORTFOLIO_MANAGEMENT_TITLE') . ' > ' . JText::_('COM_ZTPORTFOLIO_HEADER_CATEGORIES'), 'folder');
    }

}
