<?php

defined('_JEXEC') or die;

/**
 * Zt Portfolio properties table
 */
class ZtPortfolioTableProperties extends JTable
{

    /**
     * Construction
     * @param type $db
     */
    public function __construct(&$db)
    {
        parent::__construct('#__ztportfolio_properties', 'id', $db);
        JTableObserverContenthistory::createObserver($this, array('typeAlias' => 'com_portfolio.properties'));
    }

    /**
     * Check data validation
     * @return boolean
     */
    public function check()
    {
        if (empty($this->name) || empty($this->type))
        {
            return false;
        }
        return true;
    }
    
    /**
     * Store data
     * @param type $updateNulls
     */
    public function store($updateNulls = false)
    {
        if ($this->check())
        {
            return parent::store($updateNulls);
        }
        return false;
    }

}
