<?php

class ZtPortfolioHelperToolbar
{

    static public function addToolBar()
    {
        JFactory::getDocument()->addScriptDeclaration('    (function (w) {
        if (typeof (w.jQuery) === \'undefined\') {
            console.log(\'jQuery undefined\');
            return false;
        } else {
            var $ = w.jQuery;
        }

        function clearToolBar() {
            $(\'div#toolbar\').html(\'\');
        }

        function addCustomToolBar(command, icon, title, cClass) {
            var cClass = (typeof (cClass) === \'undefined\') ? \'btn btn-small\' : cClass;
            var html = \'<div class="btn-wrapper" id="toolbar-home">\';
            html += \'<a href="\' + command + \'" class="\' + cClass + \'"><span class="icon-\' + icon + \'"></span> \' + title + \'</a>\';
            html += \'</div>\';
            $(\'div#toolbar\').append(html);
        }
        $(w.document).ready(function(){
                addCustomToolBar(\'' . JRoute::_('index.php?option=com_ztportfolio') . '\', \'home\', \'' . JText::_('COM_PORTFOLIO_HOME') . '\', \'btn btn-small btn-success\');
                addCustomToolBar(\'' . JRoute::_('index.php?option=com_ztportfolio&view=categories') . '\', \'list-2\', \'' . JText::_('COM_PORTFOLIO_CATEGORIES_MANAGER') . '\', \'btn btn-small btn-small\');
                addCustomToolBar(\'' . JRoute::_('index.php?option=com_ztportfolio&view=data') . '\', \'paragraph-center\', \'' . JText::_('COM_PORTFOLIO_CONTENT_MANAGER') . '\', \'btn btn-small btn-primary\');
            });
    })(window);
');
    }

}