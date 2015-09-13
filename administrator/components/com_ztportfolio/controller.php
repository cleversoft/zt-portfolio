<?php
defined('_JEXEC') or die;

/**
 * Main controller
 */
class ZtPortfolioController extends JControllerLegacy
{
    
    public function error(){
        $view = $this->getView('Error', 'html', 'ZtPortfolioView');
        $view->display();
    }
    
}