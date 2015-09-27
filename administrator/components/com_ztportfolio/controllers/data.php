<?php

defined('_JEXEC') or die;

class ZtPortfolioControllerData extends JControllerLegacy {

    public function __construct($config = array()) {
        parent::__construct($config);
        $this->_model = $this->getModel('Data', 'ZtPortfolioModel');
    }

    /**
     * Display portfolio
     * @param type $cachable
     * @param type $urlparams
     */
    public function display($cachable = false, $urlparams = array()) {
        $view = $this->getView('Data', 'html', 'ZtPortfolioView');
        $jInput = JFactory::getApplication()->input;
        $id = $jInput->get('id', 0, 'INT');
        $modelCategories = $this->getModel('Categories', 'ZtPortfolioModel');
        if ($id > 0) {
            $view->set('portfolio', $this->_model->load($id));
        }
        $view->set('categories', $modelCategories->listAll());
        $view->display();
    }

    /**
     * Create new portfolio
     */
    public function create() {
        $ajax = ZtAjax::getInstance();
        $jInput = JFactory::getApplication()->input;
        if (ZtFramework::isAjax()) {
            $title = $jInput->get('title', '', 'STRING');
            $header = $jInput->get('header', '', 'RAW');
            $thumbnail = $jInput->get('thumbnail', '', 'STRING');
            $content = $jInput->get('content', '', 'RAW');
            $category = $jInput->get('category', 0, 'INT');
            $headers = json_decode($jInput->get('header', '[]', 'RAW'));
            if (!empty($header) && !empty($title) && !empty($thumbnail) && $category > 0) {
                if ($this->_model->create($category, $header, $title, $thumbnail, $content, ZtPortfolioModelData::STATUS_PUBLIC)) {
                    $ajax->addMessage(JText::_('COM_ZTPORTFOLIO_MESSAGE_CREATE_PORTFOLIO_SUCCESSFUL'), JText::_('COM_ZTPORTFOLIO_MESSAGE_HEAD_SUCCESS'), 'success');
                    $ajax->addExecute('window.setTimeout(function(){window.location=\'' . JUri::root() . '/administrator/index.php?option=com_ztportfolio\';}, 3000);');
                } else {
                    $ajax->addMessage(JText::_('COM_ZTPORTFOLIO_MESSAGE_ERROR_CANOT_SAVE'), JText::_('COM_ZTPORTFOLIO_MESSAGE_HEAD_ERROR'), 'danger');
                }
            } else {
                $ajax->addMessage(JText::_('COM_ZTPORTFOLIO_MESSAGE_ERROR_FILL_FORM'), JText::_('COM_ZTPORTFOLIO_MESSAGE_HEAD_ERROR'), 'danger');
            }
        }
        $ajax->response();
    }

    /**
     * Create new portfolio
     */
    public function save() {
        $ajax = ZtAjax::getInstance();
        $jInput = JFactory::getApplication()->input;
        if (ZtFramework::isAjax()) {
            $id = $jInput->get('id', 0, 'INT');
            $title = $jInput->get('title', '', 'STRING');
            $header = $jInput->get('header', '', 'RAW');
            $thumbnail = $jInput->get('thumbnail', '', 'STRING');
            $content = $jInput->get('content', '', 'RAW');
            $category = $jInput->get('category', 0, 'INT');
            $headers = json_decode($jInput->get('header', '[]', 'RAW'));
            if (!empty($header) && !empty($title) && !empty($thumbnail) && $category > 0 && $id > 0) {
                if ($this->_model->update($id, $category, $header, $title, $thumbnail, $content, ZtPortfolioModelData::STATUS_PUBLIC)) {
                    $ajax->addMessage(JText::_('COM_ZTPORTFOLIO_MESSAGE_UPDATE_PORTFOLIO_SUCCESSFUL'), JText::_('COM_ZTPORTFOLIO_MESSAGE_HEAD_SUCCESS'), 'success');
                    $ajax->addExecute('window.setTimeout(function(){window.location=\'' . JUri::root() . '/administrator/index.php?option=com_ztportfolio\';}, 3000);');
                } else {
                    $ajax->addMessage(JText::_('COM_ZTPORTFOLIO_MESSAGE_ERROR_CANOT_SAVE'), JText::_('COM_ZTPORTFOLIO_MESSAGE_HEAD_ERROR'), 'danger');
                }
            } else {
                $ajax->addMessage(JText::_('COM_ZTPORTFOLIO_MESSAGE_ERROR_FILL_FORM'), JText::_('COM_ZTPORTFOLIO_MESSAGE_HEAD_ERROR'), 'danger');
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
                $ajax->addMessage(JText::_('COM_ZTPORTFOLIO_MESSAGE_DELETE_PORTFOLIO_SUCCESSFUL'), JText::_('COM_ZTPORTFOLIO_MESSAGE_HEAD_SUCCESS'), 'success');
                $ajax->addExecute('window.setTimeout(function(){window.location=\'' . JUri::root() . '/administrator/index.php?option=com_ztportfolio\';}, 3000);');
            } else {
                $ajax->addMessage(JText::_('COM_ZTPORTFOLIO_MESSAGE_ERROR_CANOT_DELETE_PORFOLIO'), JText::_('COM_ZTPORTFOLIO_MESSAGE_HEAD_ERROR'), 'danger');
            }
        }
        $ajax->response();
    }
    
    /**
     * Cancel
     */
    public function cancel() {
        $ajax = ZtAjax::getInstance();
        if (ZtFramework::isAjax()) {
            $ajax->addExecute('window.location=\'' . JUri::root() . '/administrator/index.php?option=com_ztportfolio\';');
        }
        $ajax->response();
    }

    /**
     * Reload header
     */
    public function loadHeader() {
        $ajax = ZtAjax::getInstance();
        $jInput = JFactory::getApplication()->input;
        $id = $jInput->get('id', 0, 'INT');
        if (ZtFramework::isAjax() && $id > 0) {
            $html = new ZtHtml();
            $modelCategories = $this->getModel('Categories', 'ZtPortfolioModel');
            $category = $modelCategories->load($id);
            if (!is_array($category['header'])) {
                $category['header'] = json_decode($category['header']);
            }
            $html->set('headers', $category['header']);
            $ajax->addHtml($html->fetch('com_ztportfolio://html/portfolio.header.php'), '#portfolio-header-edit');
        }
        $ajax->response();
    }

    /**
     * Get list
     * @param type $path
     * @return type
     */
    private function _getList($path) {
        $rootPath = JPATH_ROOT . '/images';
        if (!empty($path)) {
            $shortPath = '/' . trim($path, '/') . '/';
        } else {
            $shortPath = '/';
        }
        $currentPath = $rootPath . $shortPath;
        $folders = JFolder::folders($currentPath, '');
        $files = JFolder::files($currentPath, '');
        $returnData = '';

        $returnData .= '<ul class="jqueryFileTree" style="display: none;">';
        foreach ($folders as $folder) {
            $returnData .= '<li class="directory collapsed"><a href="#" rel="' . htmlentities($shortPath . $folder . '/') . '">' . htmlentities($folder) . '</a></li>';
        }
        foreach ($files as $file) {
            if (in_array(strtolower(substr($file, strlen($file) - 3)), array('jpg', 'jpeg', 'png', 'gif'))) {
                $ext = preg_replace('/^.*\./', '', $file);
                $returnData .= '<li class="file ext_' . $ext . '"><a href="#" rel="' . htmlentities($shortPath . $file) . '">' . htmlentities($file) . '</a></li>';
            }
        }
        $returnData .= '</ul>';
        return $returnData;
    }

    /**
     * File explorer
     */
    public function explorer() {
        $jInput = JFactory::getApplication()->input;
        $dir = $jInput->get('dir', '', 'RAW');
        echo($this->_getList($dir));
        exit();
    }

}
