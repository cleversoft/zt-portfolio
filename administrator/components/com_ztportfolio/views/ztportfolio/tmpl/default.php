<form action="<?php echo JRoute::_('index.php?option=com_ztportfolio'); ?>" method="post" name="adminForm" id="adminForm">
    <input type="hidden" name="task" value="" />
    <input type="hidden" name="boxchecked" value="1" />
    <input type="hidden" name="filter_order" value="<?php echo $listOrder; ?>" />
    <input type="hidden" name="filter_order_Dir" value="<?php echo $listDirn; ?>" />
    <?php echo JHtml::_('form.token'); ?>
</form>
<?php ZtPortfolioHelperToolbar::addToolBar(); ?>