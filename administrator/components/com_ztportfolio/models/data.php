<?php

/**
 * Data model
 */
class ZtPortfolioModelData extends JModelLegacy
{

    /**
     * Get data  table
     * @param type $type
     * @param type $prefix
     * @param type $config
     * @return type
     */
    public function getTable($type = 'Data', $prefix = 'ZtPortfolioTable', $config = array())
    {
        $table = JTable::getInstance($type, $prefix, $config);

        return $table;
    }

}
