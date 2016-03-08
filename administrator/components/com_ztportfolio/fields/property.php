<?php

/**
 * @package     Zt Portfolio
 *
 * @copyright   Copyright (C) 2015 ZooTemplate. All rights reserved.
 * * @license     GNU GPL v2.
 */
defined('_JEXEC') or die('Restricted access');

jimport('joomla.form.formfield');

class JFormFieldProperty extends JFormField
{

    protected $type = 'property';

    public function getInput()
    {

        $db = JFactory::getDbo();
        $query = $db->getQuery(true);
        $query->select('*')->from($db->quoteName('#__ztportfolio_properties'));
        $data = $db->setQuery($query)->loadAssocList();
        if (!empty($data))
        {
            $html = '<div id="ztportfolioPropertiesEditor">';
            if (empty($this->value))
            {
                $html .= '<input type="hidden" id="ztportfolioPropeties" name="' . $this->name . '" value="[]">';
                $jsonData = json_decode('[]');
            } else
            {
                $html .= '<input type="hidden" id="ztportfolioPropeties" name="' . $this->name . '" value="' . $this->value . '">';
                $jsonData = json_decode($this->value);
            }

            foreach ($data as $key => $item)
            {
                $html .= '<div class="control-group ">
                            <span><strong>' . htmlspecialchars($item['name']) . '</strong></span>
                            <input type="text" class="ztportfolio-property ' . (($item['type'] == 'date') ? 'bootstrap-datepicker' : '') . '" data-name="' . base64_encode($item['name']) . '" data-type="' . base64_encode($item['type']) . '"';
                if (!empty($jsonData))
                {
                    $isAdd = false;
                    foreach ($jsonData as $jsonItem)
                    {
                        if ($jsonItem->name == base64_encode($item['name']))
                        {
                            $html .= ' value="' . $jsonItem->value . '">';
                            $isAdd = true;
                            break;
                        } 
                    }
                    if(!$isAdd){
                        $html .= '>';
                    }                    
                } else
                {
                    $html .= '>';
                }
                $html .= '</div>';
            }
            $html .= '</div>';
            return $html;
        }
    }

}
