<?php
/**
 * ZT News
 * 
 * @package     Joomla
 * @subpackage  Module
 * @version     2.0.0
 * @author      ZooTemplate 
 * @email       support@zootemplate.com 
 * @link        http://www.zootemplate.com 
 * @copyright   Copyright (c) 2015 ZooTemplate
 * @license     GPL v2
 */
defined('_JEXEC') or die('Restricted access');

jimport('joomla.html.html');
jimport('joomla.access.access');
jimport('joomla.form.formfield');

/**
 * Class exists checking
 */
class JFormFieldJevent extends JFormField
{

    /**
     * Element name
     *
     * @access  protected
     * @var   string
     */
    protected $type = 'jevent';

    protected function getInput()
    {
        $db = JFactory::getDBO();
        $document = JFactory::getDocument();
        $document->addScript(JURI::root() . 'modules/mod_ztportfolio/admin/js/adminscript.js');
        $cId = JRequest::getVar('id', 0);
        $sql = "SELECT params FROM #__modules WHERE id=$cId";
        $db->setQuery($sql);
        $data = $db->loadResult();
        $params = new JRegistry($data);
        $layout = $params->get('layout', 'default');
        ?>
        <script type="text/javascript">
            jQuery(document).ready(function () {
                changeLayout('<?php echo $layout ?>');
                jQuery('#jform_params_layout').change(function () {
                    var layout = jQuery(this).val();
                    layout = layout.split(':')[1];
                    changeLayout(layout);
                })
            })
        </script>
        <?php
    }

}
