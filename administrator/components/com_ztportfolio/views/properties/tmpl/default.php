<?php ZtPortfolioHelperToolbar::toolBar(); ?>
<?php $this->get('html')->set('active', 'properties.display'); ?>
<div id="j-sidebar-container" class="j-sidebar-container j-sidebar-visible">
    <div id="j-toggle-sidebar-wrapper">
        <div id="j-toggle-button-wrapper" class="j-toggle-button-wrapper j-toggle-visible">
            <div id="j-toggle-sidebar-button" class="j-toggle-sidebar-button hidden-phone hasTooltip" title="" type="button" onclick="toggleSidebar(false);
                    return false;" data-original-title="<?php echo(JText::_('JTOGGLE_HIDE_SIDEBAR')); ?>">
                <span id="j-toggle-sidebar-icon" class="icon-arrow-left-2 j-toggle-visible"></span>
            </div>
        </div>
        <div id="sidebar" class="sidebar">
            <div class="sidebar-nav">
                <div>
                    <?php echo $this->get('html')->fetch('com_ztportfolio://html/dashboard.nav.php'); ?>
                </div>
            </div>
        </div>
        <div id="j-toggle-sidebar"></div>
    </div>
</div>
<div id="j-main-container" class="span10 j-toggle-main">
    <div class="row-fluid">
        <div class="span12">
            <?php echo $this->get('html')->fetch('com_ztportfolio://html/properties.editor.php'); ?>
        </div>
    </div>
</div>
<script type="text/javascript">
    (function (w, $) {
        $(w.document).ready(function () {
            addCustomToolBar('javascript:categorySave();', 'save', ' <?php echo JText::_('COM_ZTPORTFOLIO_BUTTON_SAVE'); ?>', 'btn btn-small');
            addCustomToolBar('javascript:categoryClear();', 'delete', ' <?php echo JText::_('COM_ZTPORTFOLIO_BUTTON_CLEAR'); ?>', 'btn btn-small');
            addCustomToolBar('<?php echo JRoute::_('index.php?option=com_ztportfolio&task=data.display'); ?>', 'cancel', ' <?php echo JText::_('COM_ZTPORTFOLIO_BUTTON_CANCEL'); ?>', 'btn btn-small');
        });
    })(window, jQuery);
</script>