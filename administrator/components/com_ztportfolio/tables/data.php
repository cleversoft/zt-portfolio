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
        if (empty($this->category) || empty($this->content) || empty($this->status) || empty($this->title) || empty($this->thumbnail) || strlen($this->title) > 255 || strlen($this->thumbnail) > 500)
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
            $this->status = intval($this->status);
            $this->category = intval($this->category);
            if ($this->status !== 0 && $this->category !== 0)
            {
                return parent::store($updateNulls);
            }
        }
        return false;
    }

}
