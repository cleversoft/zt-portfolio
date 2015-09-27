<?php

defined('_JEXEC') or die;

class ZtPortfolioControllerData extends JControllerLegacy {

    public function display($cachable = false, $urlparams = array()) {
        $view = $this->getView('Data', 'html', 'ZtPortfolioView');
        $modelCategories = $this->getModel('Categories', 'ZtPortfolioModel');
        $view->set('categories', $modelCategories->listAll());
        $view->display();
    }

    /**
     * Get list
     * @param type $path
     * @return type
     */
    private function _getList($path) {
        $rootPath = JPATH_ROOT . '/images';
        if(!empty($path)){
            $shortPath = '/' . trim($path, '/') . '/';
        }else{
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
