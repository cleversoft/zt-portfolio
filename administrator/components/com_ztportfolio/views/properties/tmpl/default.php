<?php $activeProperty = $this->get('html')->get('activeProperty', NULL); ?>
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
<div class="modal hide fade" id="zt-portfolio-property-editor">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h3><?php echo(JText::_('COM_ZTPORTFOLIO_PROPERTY_EDITOR')); ?></h3>
    </div>
    <div class="modal-body">
        <?php echo $this->get('html')->fetch('com_ztportfolio://html/properties.editor.php'); ?>
    </div>
    <div class="modal-footer">
        <button data-dismiss="modal" class="btn btn-primary" onclick="propertySave();"><?php echo(JText::_('COM_ZTPORTFOLIO_BUTTON_SAVE')); ?></button>
        <button data-dismiss="modal" class="btn"><?php echo(JText::_('COM_ZTPORTFOLIO_BUTTON_CANCEL')); ?></button>
    </div>
</div>
<div id="j-main-container" class="span10 j-toggle-main">
    <div class="row-fluid">
        <div class="span8" id="zt-portfolio-properties-list">
            <?php echo $this->get('html')->fetch('com_ztportfolio://html/properties.php'); ?>
        </div>
    </div>
</div>
<script type="text/javascript">
    (function (w, $) {
        $(w.document).ready(function () {
            addCustomToolBar('javascript:propertyShowEditor();', 'plus-circle', ' <?php echo JText::_('ZT_PORTFOLIO_CATEGORIES_ADD_NEW'); ?>', 'btn btn-success');
        });
    })(window, jQuery);
</script>