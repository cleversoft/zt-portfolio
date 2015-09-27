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
        $view = $this->getView('','html', 'ZtPortfolioView');
        $jInput = JFactory::getApplication()->input;
        $id = $jInput->get('id', 0, 'INT');
        $modelCategories = $this->getModel('Categories', 'ZtPortfolioModel');
        $modelData = $this->getModel('Data', 'ZtPortfolioModel');
        $html = new ZtHtml();
        $html->set('categories', $modelCategories->listAll());
        if($id == 0){
            $html->set('portfolios', $modelData->listAll());
        }else{
            $html->set('portfolios', $modelData->listByCategory($id));
        }
        $view->set('html', $html);
        $view->display();
    }

}