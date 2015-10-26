<?php

/**
 * Categories Model
 */
class ZtPortfolioModelCategories extends JModelLegacy
{
    const STATUS_PUBLIC = 5;
    const STATUS_UNPUBLIC = 10;
    /**
     * Create new category
     * @param type $headers
     * @return type
     */
    public function create($name)
    {
        $table = $this->getTable();
        $table->name = $name;
        $table->status = ZtPortfolioModelCategories::STATUS_PUBLIC;
        return $table->store();
    }

    /**
     * Get categories data by key
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
     * Delete category
     * @param type $id
     * @return type
     */
    public function delete($id){
        $talbe = $this->getTable();
        return $talbe->delete($id);
    }


    /**
     * Update an existed category
     * @param type $id
     * @param type $name
     * @param type $headers
     * @return type
     */
    public function update($id, $name){
        $table = $this->getTable();
        $table->id = $id;
        $table->name = $name;
        return $table->store();
    }

    /**
     * List all categories
     */
    public function listAll()
    {
        $db = $this->getDbo();
        $query = $db->getQuery(true);
        $query->select('*')
                ->from($db->quoteName('#__ztportfolio_categories'))
                ->order($db->quoteName('id'));
        return $db->setQuery($query)
                        ->loadAssocList();
    }
    
    /**
     * List all categories
     */
    public function listAllByStatus($status)
    {
        $db = $this->getDbo();
        $query = $db->getQuery(true);
        $query->select('*')
                ->from($db->quoteName('#__ztportfolio_categories'))
                ->where($db->quoteName('status') . '=' . $db->quote($status))
                ->order($db->quoteName('id'));
        return $db->setQuery($query)
                        ->loadAssocList();
    }
    
    public function updateStatus($categories, $status){
        $db = $this->getDbo();
        $query = $db->getQuery(true);
        $query->update($db->quoteName('#__ztportfolio_categories'))
                ->set($db->quoteName('status') . '=' . $db->quote($status))
                ->where($db->quoteName('id') . ' IN (' . $categories . ')');
        $db->setQuery($query);
        return $db->execute();
    }

    /**
     * Get categories jtable
     * @param type $type
     * @param type $prefix
     * @param type $config
     * @return type
     */
    public function getTable($type = 'Categories', $prefix = 'ZtPortfolioTable', $config = array())
    {
        return JTable::getInstance($type, $prefix, $config);
    }

}
