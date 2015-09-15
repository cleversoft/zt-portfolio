<?php
/**
 * Common helper
 */
class ZtPortfolioHelperCommon
{
    /**
     * Create header object
     * @param type $name
     * @param type $type
     * @param type $value
     * @return \stdClass
     */
    static public function createHeader($name, $type = 'text', $value = '')
    {
        $header = new stdClass();
        $header->name = $name;
        $header->type = $type;
        $header->value = $value;
        return $header;
    }

    /**
     * Encode json
     * @param type $data
     * @return type
     */
    static public function jsonEncode($data)
    {
        return json_encode($data, JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_QUOT | JSON_HEX_AMP | JSON_UNESCAPED_UNICODE);
    }

}
