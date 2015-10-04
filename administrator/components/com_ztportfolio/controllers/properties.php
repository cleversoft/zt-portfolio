<?php

defined('_JEXEC') or die;

class ZtPortfolioControllerProperties extends JControllerAdmin {

    public function __construct($config = array()) {
        parent::__construct($config);
    }

    /**
     * Display portfolio
     * @param type $cachable
     * @param type $urlparams
     */
    public function display($cachable = false, $urlparams = array()) {
        $jInput = JFactory::getApplication()->input;
        $id = $jInput->get('id', 0, 'INT');
        $view = $this->getView('Properties', 'html', 'ZtPortfolioView');
        $modelCategories = $this->getModel('Categories', 'ZtPortfolioModel');
        $html = new ZtHtml();
        $html->set('nav', array('dashboard.display' => 'COM_ZTPORTFOLIO_CATEGORIES',
            'data.display' => 'COM_ZTPORTFOLIO_HEADER_PORTFOLIOS',
            'properties.display' => 'COM_ZTPORTFOLIO_PROPERTIES'));
        $html->set('categories', $modelCategories->listAll());
        if($id > 0){
            $html->set('activeCategory', $modelCategories->load($id));
        }
        $view->set('html', $html);
        $view->display();
    }

}