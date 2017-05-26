<?php
/**
 * @package     Zt Portfolio
 *
 * @copyright   Copyright (C) 2010 - 2015 ZooTemplate. All rights reserved.
 * @license     GNU General Public License version 2 or later.
 */

defined('_JEXEC') or die();

JLoader::register('JHtmlString', JPATH_LIBRARIES.'/joomla/html/html/string.php');

class ZtPortfolioSiteHelper {

	public static function generateMeta($item) {
		$document = JFactory::getDocument();
		$app = JFactory::getApplication();
		$menus = $app->getMenu();
		$menu = $menus->getActive();
		$title = null;

		$document->setTitle($item->title);
		$document->addCustomTag('<meta content="website" property="og:type"/>');
		$document->addCustomTag('<meta content="'.JURI::current().'" property="og:url" />');
		$document->setDescription( JHtml::_('string.truncate', $item->description, 155, false, false ) );
		$document->addCustomTag('<meta content="'. $item->title .'" property="og:title" />');
		$document->addCustomTag('<meta content="'. JURI::root().$item->image.'" property="og:image" />');
		$document->addCustomTag('<meta content="'. JHtml::_('string.truncate', $item->description, 155, false, false ) .'" property="og:description" />');
	
		return true;
	}

	public static function getNextArticle($id){

		$languageTag = JFactory::getLanguage()->getTag();
        
        if (empty(self::$_portfolios)) {
            
            $db = JFactory::getDbo();
            
            $query = $db->getQuery(true);

            $query->select('min(ztportfolio_item_id) as id')
                    ->from($db->quoteName('#__ztportfolio_items'))
                    ->where('`language`=\'' . $languageTag . '\' OR `language`=\'*\'')
                    ->where($db->quoteName('ztportfolio_item_id') .'>' . $id);
            $next_id = $db->setQuery($query)
                      ->loadAssocList();
          	if(isset($next_id[0]['id'])){
          		return self::getPortfolio($next_id[0]['id']);
          	}
        }
        return false;
	}


	public static function getPortfolio($id){

		if($id != null){
			$db = JFactory::getDbo();
            
	        $query = $db->getQuery(true);

	        $query->select('*')
	            ->from($db->quoteName('#__ztportfolio_items'))
	            ->where($db->quoteName('ztportfolio_item_id') .'=' . $id);
	        return $db->setQuery($query)
              		->loadAssocList();
		}
		return false;
		
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


	public static function getPreviousArticle($id){

		$languageTag = JFactory::getLanguage()->getTag();
        
        if (empty(self::$_portfolios)) {
            
            $db = JFactory::getDbo();
            
            $query = $db->getQuery(true);

            $query->select('max(ztportfolio_item_id) as id')
                    ->from($db->quoteName('#__ztportfolio_items'))
                    ->where('`language`=\'' . $languageTag . '\' OR `language`=\'*\'')
                    ->where($db->quoteName('ztportfolio_item_id') .'<' . $id);
            $next_id = $db->setQuery($query)
                      ->loadAssocList();
          	if(isset($next_id[0]['id'])){
          		return self::getPortfolio($next_id[0]['id']);
          	}
        }
        return false;
	}

	public static function getTags($ids) {
		$db = JFactory::getDbo();
		$query = $db->getQuery(true);

		if(!is_array($ids)) {
			$ids = (array) json_decode($ids);
		}

		$ids = implode(',', $ids);

		$query->select($db->quoteName(array('ztportfolio_tag_id', 'title', 'alias')));
		$query->from($db->quoteName('#__ztportfolio_tags'));
		$query->where($db->quoteName('ztportfolio_tag_id')." IN (" .$ids . ")");
		$query->where('language in (' . $db->quote(JFactory::getLanguage()->getTag()) . ',' . $db->quote('*') . ')');

		$db->setQuery($query);

		return $db->loadObjectList();
	}

	/**
     * Get all tag
     * @return type
     */
    static public function getAllTags($number = null) {

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
        return $db->setQuery($query)
                ->loadObjectList();
        
    }


	public static function getTagList($items) {
		$db = JFactory::getDbo();
		$query = $db->getQuery(true);

		$tags = array();

		foreach ($items as $item) {
			$itemtags = json_decode( $item->ztportfolio_tag_id );
			foreach ($itemtags as $itemtag) {
				$tags[] = $itemtag;
			}
		}

		$json = json_encode(array_unique($tags));

		$result = self::getTags( $json );

		return $result;
	}

}
