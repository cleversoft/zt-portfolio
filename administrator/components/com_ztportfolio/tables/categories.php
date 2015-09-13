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
        parent::__construct('#__ztportfolio_categories', 'category', $db);
        JTableObserverContenthistory::createObserver($this, array('typeAlias' => 'com_portfolio.data'));
    }

    /**
     * Check data validation
     * @return boolean
     */
    public function check()
    {
        if (empty($this->name) || empty($this->header))
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
            if (is_object($this->header) || is_array($this->header))
            {
                $this->header = json_encode($this->header);
                return parent::store($updateNulls);
            }
        }
        return false;
    }

}
