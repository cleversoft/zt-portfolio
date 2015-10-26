<?php

defined('_JEXEC') or die;

class ZtPortfolioControllerProperties extends JControllerAdmin {

    private $_model = null;

    public function __construct($config = array()) {
        parent::__construct($config);
        $this->_model = $this->getModel('Properties', 'ZtPortfolioModel');
    }

    /**
     * Display portfolio
     * @param type $cachable
     * @param type $urlparams
     */
    public function display($cachable = false, $urlparams = array()) {
        $jInput = JFactory::getApplication()->input;
        $view = $this->getView('Properties', 'html', 'ZtPortfolioView');
        $modelCategories = $this->getModel('Categories', 'ZtPortfolioModel');
        $modelProperties = $this->getModel('Properties', 'ZtPortfolioModel');
        $html = new ZtHtml();
        $html->set('nav', array('dashboard.display' => 'COM_ZTPORTFOLIO_CATEGORIES',
            'data.display' => 'COM_ZTPORTFOLIO_HEADER_PORTFOLIOS',
            'properties.display' => 'COM_ZTPORTFOLIO_PROPERTIES'));
        $html->set('categories', $modelCategories->listAll());
        $html->set('properties', $modelProperties->listAll());
        $view->set('html', $html);
        $view->display();
    }
    
    /**
     * Show properties editor
     */
    public function showEditor(){
        $jInput = JFactory::getApplication()->input;
        $html = new ZtHtml();
        $ajax = ZtAjax::getInstance();
        $id = $jInput->get('id', 0, 'INT');
        if($id > 0){
            $html->set('activeProperty', $this->_model->load($id));
        }
        $ajax->addHtml($html->fetch('com_ztportfolio://html/properties.editor.php'), "#zt-portfolio-property-editor .modal-body");
        $ajax->addExecute('jQuery(\'#zt-portfolio-property-editor\').modal(\'show\');');
        $ajax->response();
    }

    /**
     * Private reload
     */
    private function _reload() {
        $ajax = ZtAjax::getInstance();
        $html = new ZtHtml();
        $html->set('properties', $this->_model->listAll());
        $ajax->addHtml($html->fetch('com_ztportfolio://html/properties.php'), '#zt-portfolio-properties-list');
    }

    /**
     * Reload categories
     */
    public function reload() {
        $ajax = ZtAjax::getInstance();
        if (ZtFramework::isAjax()) {
            $this->_reload();
        }
        $ajax->response();
    }

    /**
     * Save property
     */
    public function save() {
        $ajax = ZtAjax::getInstance();
        $jInput = JFactory::getApplication()->input;
        if (ZtFramework::isAjax()) {
            $id = $jInput->get('id', 0, 'INT');
            $name = $jInput->get('name', '', 'STRING');
            $type = $jInput->get('type', '', 'STRING');
            $value = $jInput->get('value', '', 'STRING');
            if ($id > 0) {
                if ($this->_model->update($id, $name, $type, $value)) {
                    $ajax->addMessage(JText::_('COM_ZTPORTFOLIO_MESSAGE_UPDATE_PROPERTY_SUCCESSFUL'), JText::_('COM_ZTPORTFOLIO_MESSAGE_HEAD_SUCCESS'), 'success');
                    $this->_reload();
                } else {
                    $ajax->addMessage(JText::_('COM_ZTPORTFOLIO_MESSAGE_ERROR_CANOT_SAVE'), JText::_('COM_ZTPORTFOLIO_MESSAGE_HEAD_ERROR'), 'danger');
                }
            } else {
                if (empty($name) || empty($type)) {
                    $ajax->addMessage(JText::_('COM_ZTPORTFOLIO_MESSAGE_ERROR_CANOT_CREATE_PROPERTY'), JText::_('COM_ZTPORTFOLIO_MESSAGE_HEAD_ERROR'), 'danger');
                    $ajax->response();
                }
                if ($this->_model->create($name, $type, $value)) {
                    $ajax->addMessage(JText::_('COM_ZTPORTFOLIO_MESSAGE_CREATE_PROPERTY_SUCCESSFUL'), JText::_('COM_ZTPORTFOLIO_MESSAGE_HEAD_SUCCESS'), 'success');
                    $this->_reload();
                } else {
                    $ajax->addMessage(JText::_('COM_ZTPORTFOLIO_MESSAGE_ERROR_CANOT_SAVE'), JText::_('COM_ZTPORTFOLIO_MESSAGE_HEAD_ERROR'), 'danger');
                }
            }
        }
        $ajax->response();
    }
    
    /**
     * Delete category
     */
    public function delete() {
        $ajax = ZtAjax::getInstance();
        $jInput = JFactory::getApplication()->input;
        if (ZtFramework::isAjax()) {
            $id = $jInput->get('id', 0, 'INT');
            if ($this->_model->delete($id)) {
                $ajax->addMessage(JText::_('COM_ZTPORTFOLIO_MESSAGE_DELETE_PROPERTY_SUCCESSFUL'), JText::_('COM_ZTPORTFOLIO_MESSAGE_HEAD_SUCCESS'), 'success');
                $this->_reload();
            } else {
                $ajax->addMessage(JText::_('COM_ZTPORTFOLIO_MESSAGE_ERROR_CANOT_DELETE_PROPERTY'), JText::_('COM_ZTPORTFOLIO_MESSAGE_HEAD_ERROR'), 'danger');
            }
        }
        $ajax->response();
    }

}
