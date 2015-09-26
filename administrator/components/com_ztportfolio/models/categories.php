<?php

/**
 * Categories Model
 */
class ZtPortfolioModelCategories extends JModelLegacy
{
    
    /**
     * Create new category
     * @param type $headers
     * @return type
     */
    public function create($name, $headers)
    {
        $table = $this->getTable();
        $table->name = $name;
        $table->header = $headers;
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
    public function update($id, $name, $headers){
        $table = $this->getTable();
        $table->id = $id;
        $table->name = $name;
        $table->header = $headers;
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
