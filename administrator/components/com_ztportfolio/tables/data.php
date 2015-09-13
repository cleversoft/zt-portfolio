<?php

defined('_JEXEC') or die;

/**
 * Zt Portfolio categories table
 */
class ZtPortfolioTableData extends JTable
{

    /**
     * Construction
     * @param type $db
     */
    public function __construct(&$db)
    {
        parent::__construct('#__ztportfolio_data', 'id', $db);
        JTableObserverContenthistory::createObserver($this, array('typeAlias' => 'com_portfolio.data'));
    }


    /**
     * Check data validation
     * @return boolean
     */
    public function check()
    {
        if (empty($this->category) || empty($this->header) || empty($this->content))
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
            $this->modified = JFactory::getDate()->toSql();
            if (is_object($this->header))
            {
                $this->header = json_encode($this->header);
                return parent::store($updateNulls);
            }
        }
        return false;
    }

}
