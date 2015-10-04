<?php
/**
 * Toolbar helper
 */
class ZtPortfolioHelperToolbar
{

    static public function toolBar()
    {
        JFactory::getDocument()->addScriptDeclaration('    (function (w) {
        if (typeof (w.jQuery) === \'undefined\') {
            console.log(\'jQuery undefined\');
            return false;
        } else {
            var $ = w.jQuery;
        }

        w.clearToolBar = function() {
            $(\'div#toolbar\').html(\'\');
        }

        w.addCustomToolBar = function(command, icon, title, cClass) {
            var cClass = (typeof (cClass) === \'undefined\') ? \'btn btn-small\' : cClass;
            var html = \'<div class="btn-wrapper" id="toolbar-home">\';
            html += \'<a href="\' + command + \'" class="\' + cClass + \'"><span class="icon-\' + icon + \'"></span> \' + title + \'</a>\';
            html += \'</div>\';
            $(\'div#toolbar\').append(html);
        }
    })(window);
');
    }

}
