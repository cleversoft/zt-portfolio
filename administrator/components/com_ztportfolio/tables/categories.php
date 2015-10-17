<?php

defined('_JEXEC') or die;

/**
 * Zt Portfolio categories table
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
