<?php

/**
 * Modulde portfolio helper
 */
class ModZtPortfolioHelper {

    static private $_portfolios = null;
    static private $_tags = null;
    static private $_map = null;

    /**
     * Get all portfolio
     * @return type
     */
    static public function getPortfolios($number = null, $offset = 0, $orderby = 'ASC') {
        
        $languageTag = JFactory::getLanguage()->getTag();
        
        if (empty(self::$_portfolios)) {
            
            $db = JFactory::getDbo();
            
            $query = $db->getQuery(true);
            
            $query->select('*')
                    ->from($db->quoteName('#__ztportfolio_items'))
                    ->where('`language`=\'' . $languageTag . '\' OR `language`=\'*\'')
                    ->order($db->quoteName('ztportfolio_item_id'));
            if($orderby == 'DESC') {
                $query->order('ordering DESC');
            }       
            if($number != null){
                $query->setLimit($number, $offset);
                
            }
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
        if (!empty(self::$_tags)) {
            if (empty(self::$_map)) {
                self::$_map = array();
                foreach (self::$_tags as $key => $item) {
                    self::$_map[$item['ztportfolio_tag_id']] = $key;
                }
            }
        }
    }

    /**
     * Get category by id
     * @param type $id
     * @return int
     */
    static public function getTag($id) {
        if (!empty(self::$_tags)) {
            if (isset(self::$_map[$id])) {
                return self::$_tags[self::$_map[$id]];
            }
        }
        return 0;
    }

    /**
     * Get all categories
     * @return type
     */
    static public function getTags($number = null) {
        if (empty(self::$_tags)) {
            $languageTag = JFactory::getLanguage()->getTag();
            $db = JFactory::getDbo();
            $query = $db->getQuery(true);
            $query->select('*')
                    ->from($db->quoteName('#__ztportfolio_tags'))
                    ->where('`language`=\'' . $languageTag . '\' OR `language`=\'*\'')
                    ->order($db->quoteName('ztportfolio_tag_id'));
            if($number != null){
                $query->setLimit($number);
                
            }
            self::$_tags = $db->setQuery($query)
                    ->loadAssocList();
        }
        self::_mapData();
        return self::$_tags;
        
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
     * Get class name from strong
     * @param type $input
     * @return type
     */
    static public function getClass($input){
        return preg_replace("/[^a-zA-Z0-9\-]+/", "", str_replace(' ', '-', strtolower($input)));
    }
    
}
