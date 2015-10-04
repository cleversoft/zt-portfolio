<?php
defined('_JEXEC') or die;

/**
 * Main controller
 */
class ZtPortfolioController extends JControllerLegacy
{
    
    public function __construct($config = array())
    {
        parent::__construct($config);
    }
    
    public function display($cachable = false, $urlparams = array())
    {    
        $view = $this->getView('Dashboard', 'html', 'ZtPortfolioView');
        $modelCategories = $this->getModel('Categories', 'ZtPortfolioModel');
        $html = new ZtHtml();
        $html->set('nav', array('dashboard.display'=>'COM_ZTPORTFOLIO_CATEGORIES',
            'data.display' => 'COM_ZTPORTFOLIO_PORTFOLIO',
            'properties.display' => 'COM_ZTPORTFOLIO_PROPERTIES'));
        $html->set('categories', $modelCategories->listAll());
        $view->set('html', $html);
        $view->display();
    }
    
    
}