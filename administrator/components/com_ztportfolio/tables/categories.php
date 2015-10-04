<?php

defined('_JEXEC') or die;

/**
 * Zt Portfolio data table
 */
class ZtPortfolioTableCategories extends JTable
{

    /**
     * Construction
     * @param type $db
     */
    public function __construct(&$db)
    {
        parent::__construct('#__ztportfolio_categories', 'id', $db);
        JTableObserverContenthistory::createObserver($this, array('typeAlias' => 'com_portfolio.categories'));
    }

    /**
     * Check data validation
     * @return boolean
     */
    public function check()
    {
        if (empty($this->name))
        {
            return false;
        }
        return true;
    }
    
    /**
     * Load data from database
     * @param type $keys
     * @param type $reset
     * @return type
     */
    public function load($keys = null, $reset = true)
    {
        $result = parent::load($keys, $reset);
        if($result){
            $this->header = json_decode($this->header);
        }
        return $result;
    }

    /**
     * Store data
     * @param type $updateNulls
     */
    public function store($updateNulls = false)
    {
        if ($this->check())
        {
            if (is_object($this->header) || is_array($this->header))
            {
                $this->header = json_encode($this->header);
                return parent::store($updateNulls);
            }
        }
        return false;
    }

}
