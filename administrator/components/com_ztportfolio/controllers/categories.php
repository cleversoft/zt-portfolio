<?php

defined('_JEXEC') or die;

class ZtPortfolioControllerCategories extends JControllerLegacy
{

    private $_model = null;

    /**
     * Display categories editor
     * @param type $config
     */
    public function __construct($config = array())
    {
        parent::__construct($config);
        $this->_model = $this->getModel('Categories', 'ZtPortfolioModel');
    }

    /**
     * Display categories editor
     * @param type $cachable
     * @param type $urlparams
     */
    public function display($cachable = false, $urlparams = array())
    {
        $view = $this->getView('Categories', 'html', 'ZtPortfolioView');
        $html = new ZtHtml();
        $html->set('categories', $this->_model->listAll());
        $view->set('html', $html);
        $view->display();
    }

    /**
     * Create new categories
     */
    public function create()
    {
        $ajax = ZtAjax::getInstance();
        $jInput = JFactory::getApplication()->input;
        if (ZtFramework::isAjax())
        {
            $name = $jInput->get('name', '' ,'STRING');
            $headers = json_decode($jInput->get('header', '[]', 'RAW'));
            if (!empty($headers) && !empty($name))
            {
                if ($this->_model->create($name, $headers))
                {
                    $ajax->addMessage(JText::_('COM_ZTPORTFOLIO_MESSAGE_CREATE_CATEGORY_SUCCESSFUL'), JText::_('COM_ZTPORTFOLIO_MESSAGE_HEAD_SUCCESS'), 'success');
                    $ajax->addExecute('categoryClear();');
                    $this->_reload();
                } else
                {
                    $ajax->addMessage(JText::_('COM_ZTPORTFOLIO_MESSAGE_ERROR_CANOT_SAVE'), JText::_('COM_ZTPORTFOLIO_MESSAGE_HEAD_ERROR'), 'danger');
                }
            } else
            {
                $ajax->addMessage(JText::_('COM_ZTPORTFOLIO_MESSAGE_ERROR_CANOT_CREATE_CATEGORY'), JText::_('COM_ZTPORTFOLIO_MESSAGE_HEAD_ERROR'), 'danger');
            }
        }
        $ajax->response();
    }

    /**
     * Private reload
     */
    private function _reload()
    {
        $ajax = ZtAjax::getInstance();
        $html = new ZtHtml();
        $html->set('categories', $this->_model->listAll());
        $ajax->addHtml($html->fetch('com_ztportfolio://html/categories.php'), '#zt-portfolio-categories-list');
    }

    /**
     * Reload categories
     */
    public function reload()
    {
        $ajax = ZtAjax::getInstance();
        if (ZtFramework::isAjax())
        {
            $this->_reload();
        }
        $ajax->response();
    }

    /**
     * Delete category
     */
    public function delete()
    {
        $ajax = ZtAjax::getInstance();
        $jInput = JFactory::getApplication()->input;
        if (ZtFramework::isAjax())
        {
            $id = $jInput->get('id', 0, 'INT');
            if ($this->_model->delete($id))
            {
                $ajax->addMessage(JText::_('COM_ZTPORTFOLIO_MESSAGE_DELETE_CATEGORY_SUCCESSFUL'), JText::_('COM_ZTPORTFOLIO_MESSAGE_HEAD_SUCCESS'), 'success');
                $this->_reload();
            } else
            {
                $ajax->addMessage(JText::_('COM_ZTPORTFOLIO_MESSAGE_ERROR_CANOT_DELETE_CATEGORY'), JText::_('COM_ZTPORTFOLIO_MESSAGE_HEAD_ERROR'), 'danger');
            }
        }
        $ajax->response();
    }

}
