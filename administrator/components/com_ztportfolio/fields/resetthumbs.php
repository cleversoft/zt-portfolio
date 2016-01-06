<?php

/**
 * @package     Zt Portfolio
 *
 * @copyright   Copyright (C) 2015 ZooTemplate. All rights reserved.
 * * @license     GNU GPL v2.
 */
defined('JPATH_PLATFORM') or die;

jimport('joomla.form.formfield');

class JFormFieldResetthumbs extends JFormField {

    protected $type = 'Besetthumbs';

    protected function getInput() {

        Jhtml::_('jquery.framework');
        $doc = JFactory::getDocument();
        $doc->addScriptDeclaration('jQuery(function($) {
			$("#btn-reset-thumbs").on("click", function() {
				$(this).attr("disabled","disabled").text($(this).data("generating"));
			});
		});');

        $url = 'index.php?option=com_ztportfolio&view=thumbs&task=resetThumbs';

        return '<a id="btn-reset-thumbs" class="btn btn-primary" data-generating="' . JText::_('COM_ZTPORTFOLIO_RESET_THUMBNAIL_TEXT_LOADING') . '" href="' . $url . '">' . JText::_('COM_ZTPORTFOLIO_RESET_THUMBNAIL_TEXT') . '</a>';
    }

}
