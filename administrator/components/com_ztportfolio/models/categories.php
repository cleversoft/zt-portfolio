<?php

/**
 * Categories Model
 */
class ZtPortfolioModelCategories extends JModelLegacy
{

    public function newCategory(){
        $table = $this->getTable();
        $header = new stdClass();
        $header->name = 'hello';
        $header->type = 'text';
        $header->value = 'this is value';
        $table->name = 'Hello';
        $table->header = array('header1' => $header, 'header2' => $header);
        return $table->store();
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
        $table = JTable::getInstance($type, $prefix, $config);
        return $table;
    }

}