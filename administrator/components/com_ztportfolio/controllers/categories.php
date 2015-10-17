<?php

defined('_JEXEC') or die;

class ZtPortfolioControllerCategories extends JControllerAdmin {

    private $_model = null;

    /**
     * Display categories editor
     * @param type $config
     */
    public function __construct($config = array()) {
        parent::__construct($config);
        $this->_model = $this->getModel('Categories', 'ZtPortfolioModel');
    }

    /**
     * Display categories editor
     * @param type $cachable
     * @param type $urlparams
     */
    public function display($cachable = false, $urlparams = array()) {
        $view = $this->getView('Categories', 'html', 'ZtPortfolioView');
        $html = new ZtHtml();
        $html->set('categories', $this->_model->listAll());
        $view->set('html', $html);
        $editor = new ZtHtml();
        $editor->set('category', array());
        $view->set('editor', $editor);
        $view->display();
    }
    
    public function updateStatus() {
        $ajax = ZtAjax::getInstance();
        $jInput = JFactory::getApplication()->input;
        if (ZtFramework::isAjax()) {
            $categories = $jInput->get('categories', '', 'STRING');
            $status = $jInput->get('status', ZtPortfolioModelCategories::STATUS_PUBLIC, 'INT');
            if (!empty($categories)) {
                if ($this->_model->updateStatus($categories, $status)) {
                    $ajax->addMessage(JText::_('COM_ZTPORTFOLIO_MESSAGE_STATUS_UPDATE_SUCCESSFUL'), JText::_('COM_ZTPORTFOLIO_MESSAGE_HEAD_SUCCESS'), 'success');
                    $this->_reload();
                } else {
                    $ajax->addMessage(JText::_('COM_ZTPORTFOLIO_MESSAGE_ERROR_CANNOT_UPDATE_STATUS'), JText::_('COM_ZTPORTFOLIO_MESSAGE_HEAD_ERROR'), 'danger');
                }
            } else {
                $ajax->addMessage(JText::_('COM_ZTPORTFOLIO_MESSAGE_ERROR_CANNOT_UPDATE_STATUS'), JText::_('COM_ZTPORTFOLIO_MESSAGE_HEAD_ERROR'), 'danger');
            }
        }
        $ajax->response();
    }
    
    /**
     * Create new categories
     */
    public function create() {
        $ajax = ZtAjax::getInstance();
        $jInput = JFactory::getApplication()->input;
        if (ZtFramework::isAjax()) {
            $name = $jInput->get('name', '', 'STRING');
            if (!empty($name)) {
                if ($this->_model->create($name)) {
                    $ajax->addMessage(JText::_('COM_ZTPORTFOLIO_MESSAGE_CREATE_CATEGORY_SUCCESSFUL'), JText::_('COM_ZTPORTFOLIO_MESSAGE_HEAD_SUCCESS'), 'success');
                    $this->_reload();
                } else {
                    $ajax->addMessage(JText::_('COM_ZTPORTFOLIO_MESSAGE_ERROR_CANOT_SAVE'), JText::_('COM_ZTPORTFOLIO_MESSAGE_HEAD_ERROR'), 'danger');
                }
            } else {
                $ajax->addMessage(JText::_('COM_ZTPORTFOLIO_MESSAGE_ERROR_CANOT_CREATE_CATEGORY'), JText::_('COM_ZTPORTFOLIO_MESSAGE_HEAD_ERROR'), 'danger');
            }
        }
        $ajax->response();
    }

    /**
     * Private reload
     */
    private function _reload() {
        $ajax = ZtAjax::getInstance();
        $html = new ZtHtml();
        $html->set('categories', $this->_model->listAll());
        $ajax->addHtml($html->fetch('com_ztportfolio://html/dashboard.categories.php'), '#zt-portfolio-zt-portfolio-categories-list');
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
     * Delete category
     */
    public function delete() {
        $ajax = ZtAjax::getInstance();
        $jInput = JFactory::getApplication()->input;
        if (ZtFramework::isAjax()) {
            $id = $jInput->get('id', 0, 'INT');
            if ($this->_model->delete($id)) {
                $ajax->addMessage(JText::_('COM_ZTPORTFOLIO_MESSAGE_DELETE_CATEGORY_SUCCESSFUL'), JText::_('COM_ZTPORTFOLIO_MESSAGE_HEAD_SUCCESS'), 'success');
                $this->_reload();
            } else {
                $ajax->addMessage(JText::_('COM_ZTPORTFOLIO_MESSAGE_ERROR_CANOT_DELETE_CATEGORY'), JText::_('COM_ZTPORTFOLIO_MESSAGE_HEAD_ERROR'), 'danger');
            }
        }
        $ajax->response();
    }

    /**
     * Create new categories
     */
    public function save() {
        $ajax = ZtAjax::getInstance();
        $jInput = JFactory::getApplication()->input;
        if (ZtFramework::isAjax()) {
            $id = $jInput->get('id', 0, 'INT');
            $name = $jInput->get('name', '', 'STRING');
            if (!empty($name) && $id > 0) {
                if ($this->_model->update($id, $name)) {
                    $ajax->addMessage(JText::_('COM_ZTPORTFOLIO_MESSAGE_UPDATE_CATEGORY_SUCCESSFUL'), JText::_('COM_ZTPORTFOLIO_MESSAGE_HEAD_SUCCESS'), 'success');
                    $this->_reload();
                } else {
                    $ajax->addMessage(JText::_('COM_ZTPORTFOLIO_MESSAGE_ERROR_CANOT_SAVE'), JText::_('COM_ZTPORTFOLIO_MESSAGE_HEAD_ERROR'), 'danger');
                }
            } else {
                $ajax->addMessage(JText::_('COM_ZTPORTFOLIO_MESSAGE_ERROR_CANOT_SAVE'), JText::_('COM_ZTPORTFOLIO_MESSAGE_HEAD_ERROR'), 'danger');
            }
        }
        $ajax->response();
    }
}
