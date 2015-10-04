<?php

/**
 * Data model
 */
class ZtPortfolioModelData extends JModelLegacy
{

    /**
     * Portfolio status
     */
    const STATUS_DRAFT = 1;
    const STATUS_PUBLIC = 2;
    const STATUS_TRASH = 3;

    /**
     * Create new portfolio
     * @param type $category
     * @param type $header
     * @param type $title
     * @param type $thumbnail
     * @param type $content
     * @param type $status
     * @return type
     */
    public function create($category, $header, $title,$url, $description, $thumbnail, $content, $status = ZtPortfolioModelData::STATUS_DRAFT)
    {
        $table = $this->getTable();
        $table->category = $category;
        $table->status = $status;
        $table->header = $header;
        $table->title = $title;
        $table->url = $url;
        $table->description = $description;
        $table->thumbnail = $thumbnail;
        $table->content = $content;
        return $table->store();
    }

    /**
     * Get portfolio data by key
     * @param type $id
     * @return type
     */
    public function load($id)
    {
        $table = $this->getTable();
        $table->load($id);
        return $table->getProperties();
    }
    
    /**
     * Delete portfolio
     * @param type $id
     * @return type
     */
    public function delete($id){
        $talbe = $this->getTable();
        return $talbe->delete($id);
    }
    
    /**
     * Update portfolio
     * @param type $id
     * @param type $category
     * @param type $header
     * @param type $title
     * @param type $thumbnail
     * @param type $content
     * @param type $status
     * @return type
     */
    public function update($id, $category, $header, $title, $url, $description, $thumbnail, $content, $status)
    {
        $table = $this->getTable();
        $table->id = $id;
        $table->category = $category;
        $table->header = $header;
        $table->status = $status;
        $table->title = $title;
        $table->url = $url;
        $table->description = $description;
        $table->thumbnail = $thumbnail;
        $table->content = $content;
        return $table->store();
    }

    /**
     * List all portfolios
     */
    public function listAll()
    {
        $db = $this->getDbo();
        $query = $db->getQuery(true);
        $query->select('*')
                ->from($db->quoteName('#__ztportfolio_data'))
                ->order($db->quoteName('id'));
        return $db->setQuery($query)
                        ->loadAssocList();
    }
    
    /**
     * List all portfolio by status
     * @param type $status
     * @return type
     */
    public function listAllByStatus($status = ZtPortfolioModelData::STATUS_PUBLIC){
        $db = $this->getDbo();
        $query = $db->getQuery(true);
        $query->select('*')
                ->from($db->quoteName('#__ztportfolio_data'))
                ->where($db->quoteName('status') . '=' . $db->quote($status))
                ->order($db->quoteName('id'));
        return $db->setQuery($query)
                        ->loadAssocList();
    }

    /**
     * List by category
     * @param type $category
     * @return type
     */
    public function listByCategory($category)
    {
        $db = $this->getDbo();
        $query = $db->getQuery(true);
        $query->select('*')
                ->from($db->quoteName('#__ztportfolio_data'))
                ->where($db->quoteName('category') . '=' . $db->quote($category))
                ->order($db->quoteName('id'));
        return $db->setQuery($query)
                        ->loadAssocList();
    }

    /**
     * Get data  table
     * @param type $type
     * @param type $prefix
     * @param type $config
     * @return type
     */
    public function getTable($type = 'Data', $prefix = 'ZtPortfolioTable', $config = array())
    {
        return JTable::getInstance($type, $prefix, $config);
    }

}
