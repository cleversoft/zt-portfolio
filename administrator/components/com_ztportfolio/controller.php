<?php
defined('_JEXEC') or die;

/**
 * Main controller
 */
class ZtPortfolioController extends JControllerLegacy
{
    
    public function display($cachable = false, $urlparams = array())
    {
        //$model = $this->getModel('Categories', 'ZtPortfolioModel');
        
        parent::display($cachable, $urlparams);
    }


    public function error(){
        $view = $this->getView('Error', 'html', 'ZtPortfolioView');
        $view->display();
    }
    
}