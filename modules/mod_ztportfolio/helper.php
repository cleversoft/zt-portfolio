<?php

/**
 * Modulde portfolio helper
 */
class ModZtPortfolioHelper {

    static private $_portfolios = null;
    static private $_categories = null;
    static private $_map = null;

    /**
     * Get all portfolio
     * @return type
     */
    static public function getPortfolios() {
        if (empty(self::$_portfolios)) {
            $db = JFactory::getDbo();
            $query = $db->getQuery(true);
            $query->select('*')
                    ->from($db->quoteName('#__ztportfolio_data'))
                    ->order($db->quoteName('id'));
            self::$_portfolios = $db->setQuery($query)
                    ->loadAssocList();
        }
        return self::$_portfolios;
    }

    /**
     * Map data
     * @param type $categories
     */
    static private function _mapData() {
        if (!empty(self::$_categories)) {
            if (empty(self::$_map)) {
                self::$_map = array();
                foreach (self::$_categories as $key => $item) {
                    self::$_map[$item['id']] = $key;
                }
            }
        }
    }

    /**
     * Get category by id
     * @param type $id
     * @return int
     */
    static public function getCategory($id) {
        if (!empty(self::$_categories)) {
            if (isset(self::$_map[$id])) {
                return self::$_categories[self::$_map[$id]];
            }
        }
        return 0;
    }

    /**
     * Get all categories
     * @return type
     */
    static public function getCategories() {
        if (empty(self::$_categories)) {
            $db = JFactory::getDbo();
            $query = $db->getQuery(true);
            $query->select('*')
                    ->from($db->quoteName('#__ztportfolio_categories'))
                    ->order($db->quoteName('id'));
            self::$_categories = $db->setQuery($query)
                    ->loadAssocList();
        }
        self::_mapData();
        return self::$_categories;
    }

    /**
     * Get url from param
     * @param type $input
     * @return type
     */
    static public function getUrl($input){
        return rtrim(JUri::root(), '/') . '/' . ltrim($input, '/');
    }
    
    /**
     * Get active portfolio
     * @return type
     */
    static public function getActivePortfolio(){
        $jInput = JFactory::getApplication()->input;
        $module = $jInput->get('module', '', 'CMD');
        $show = $jInput->get('show', 0, 'INT');
        if($module == 'mod_ztporfolio' && $show > 0){
            foreach(self::$_portfolios as $portfolio){
                if($portfolio['id'] == $show){
                    return $portfolio;
                }
            }
        }
        return array();
    }
    
    /**
     * Get class name from strong
     * @param type $input
     * @return type
     */
    static public function getClass($input){
        return preg_replace("/[^a-zA-Z0-9\-]+/", "", str_replace(' ', '-', strtolower($input)));
    }
    
}
