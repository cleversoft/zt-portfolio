<?php

defined('_JEXEC') or die;

class ZtPortfolioControllerDashboard extends JControllerLegacy {
    
    /**
     * Display categories editor
     * @param type $config
     */
    public function __construct($config = array()) {
        parent::__construct($config);
    }
    
    public function display($cachable = false, $urlparams = array()) {
        $view = $this->getView('Dashboard', 'html', 'ZtPortfolioView');
        $modelCategories = $this->getModel('Categories', 'ZtPortfolioModel');
        $html = new ZtHtml();
        $html->set('nav', array('dashboard.display'=>'COM_ZTPORTFOLIO_HEADER_CATEGORIES',
            'data.display' => 'COM_ZTPORTFOLIO_HEADER_PORTFOLIOS',
            'properties.display' => 'COM_ZTPORTFOLIO_HEADER_PROPERTIES'));
        $html->set('categories', $modelCategories->listAll());
        $view->set('html', $html);
        $view->display();
    }
    
}