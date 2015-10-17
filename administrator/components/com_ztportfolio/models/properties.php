<?php

/**
 * Properties Model
 */
class ZtPortfolioModelProperties extends JModelLegacy
{

    /**
     * Create new property
     * @param type $name
     * @param type $type
     * @param type $value
     * @return type
     */
    public function create($name, $type='text', $value= '')
    {
        $table = $this->getTable();
        $table->name = $name;
        $table->type = $type;
        $table->value = $value;
        return $table->store();
    }

    /**
     * Get property data by key
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
     * Delete property
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
     * @param type $type
     * @param type $value
     * @return type
     */
    public function update($id, $name, $type, $value){
        $table = $this->getTable();
        $table->id = $id;
        $table->name = $name;
        $table->type = $type;
        $table->value = $value;
        return $table->store();
    }

    /**
     * List all properties
     */
    public function listAll()
    {
        $db = $this->getDbo();
        $query = $db->getQuery(true);
        $query->select('*')
                ->from($db->quoteName('#__ztportfolio_properties'))
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
    public function getTable($type = 'Properties', $prefix = 'ZtPortfolioTable', $config = array())
    {
        return JTable::getInstance($type, $prefix, $config);
    }

}
