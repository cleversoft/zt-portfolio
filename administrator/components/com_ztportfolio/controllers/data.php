<?php
defined('_JEXEC') or die;

class ZtPortfolioControllerData extends JControllerLegacy
{
    public function display($cachable = false, $urlparams = array())
    {
        $view = $this->getView('Data', 'html', 'ZtPortfolioView');
        $view->display();
    }
}