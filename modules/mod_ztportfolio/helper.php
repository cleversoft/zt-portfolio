<?php

/**
 * Modulde portfolio helper
 */
class ModZtPortfolioHelper {

    static private $_portfolios = null;
    static private $_tags = null;
    static private $_map = null;
    static private $_categories = null;

    /**
     * Get all portfolio
     * @return type
     */
    static public function getPortfolios($number = null, $categories, $offset = 0, $orderby = 'ASC') {
        
        $languageTag = JFactory::getLanguage()->getTag();
        
        if (empty(self::$_portfolios)) {
            
            $db = JFactory::getDbo();
            
            $query = $db->getQuery(true);
            
            $query->select('*')
                    ->from($db->quoteName('#__ztportfolio_items'))
                    ->where('(`language`=\'' . $languageTag . '\' OR `language`=\'*\')')
                    ->order($db->quoteName('ztportfolio_item_id'));
            if( is_array($categories)) {
                $category_ids = $categories;
                self::getSubCategories( $categories, $category_ids, 4 );



                if(count( $category_ids) > 0){
                  $condition = '(';
                  foreach ($category_ids as $catid) {
                    $condition .= $db->qn('category_id')." = " . $db->quote( $catid ). ' OR ';
                  }
                  if($condition != ''){
                    $condition = substr($condition, 0, -3);
                    $condition .= ')';

                    $query->where($condition);
                  }
                  
                    }
                }
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

    public static function getSubCategories($ids, &$catIDs, $level){

      $languageTag = JFactory::getLanguage()->getTag();
      $db = JFactory::getDbo();

      foreach($ids as $id){
        
            $cat_query = $db->getQuery(true);
            $cat_query->select('id')
                    ->from($db->quoteName('#__categories'))
                    ->where('(`language`=\'' . $languageTag . '\' OR `language`=\'*\')')
                    ->where('`parent_id`=' . $id);
            $categories = $db->setQuery($cat_query)
                        ->loadAssocList();
              $temp_id = array();
            if(count($categories) > 0){

              foreach ($categories as $cate) {
                $temp_id[] = $cate['id'];
                $catIDs[] = $cate['id'];
              }
            }

            if($level >= 0 && count($temp_id) > 0){
              $level--;
              self::getSubCategories($temp_id, $catIDs, $level);
            }
      }
    }

    public static function countPortfolio($categories){
      $languageTag = JFactory::getLanguage()->getTag();

      $db = JFactory::getDbo();
            
      $query = $db->getQuery(true);
      $query->select( 'COUNT(*)' )
            ->from($db->quoteName('#__ztportfolio_items'))
            ->where('(`language`=\'' . $languageTag . '\' OR `language`=\'*\')');

      if( is_array($categories)) {
        
          $condition = '(';
          foreach ($categories as $catid) {
              $condition .= '`category_id`=' . $catid . ' OR ';
          }
          $condition = substr($condition, 0, -3);
          $condition .= ')';

          if($condition != '')
              $query->where($condition);
      }

      $db->setQuery($query);
      return $db->loadResult();
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
     * Get all tag
     * @return type
     */
    static public function getTags($number = null) {
        if (empty(self::$_tags)) {
            $languageTag = JFactory::getLanguage()->getTag();
            $db = JFactory::getDbo();
            $query = $db->getQuery(true);
            $query->select('*')
                    ->from($db->quoteName('#__ztportfolio_tags'))
                    ->where('(`language`=\'' . $languageTag . '\' OR `language`=\'*\')')
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
     * Get all categories
     * @return type
     */
    static public function getCategories($number = null) {
        if (empty(self::$_categories)) {

            $db = JFactory::getDbo();

            $query = $db->getQuery(true);

            $query->select('*')
                  ->from($db->quoteName('#__categories'))
                  ->where($db->quoteName('extension') . ' = ' . $db->quote('com_ztportfolio'));
            if($number != null){
                $query->setLimit($number);
                
            }
            $db->setQuery($query);

            self::$_categories =  $db->setQuery($query)
                    ->loadAssocList();
        }
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

    public static function getPortfolioUrl($item){
        $menu   = JFactory::getApplication()->getMenu();
        $itemId = '';
        if(is_object($menu->getActive())) {
            $active = $menu->getActive();
            $itemId = '&Itemid=' . $active->id;
        }
        return JRoute::_('index.php?option=com_ztportfolio&view=item&id='.$item['ztportfolio_item_id'].':'.$item['alias'] . $itemId); 
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
