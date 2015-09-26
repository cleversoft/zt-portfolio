<?php ZtPortfolioHelperToolbar::addToolBar(); ?>
<div class="row-fluid">
    <div class="span6">
        <h2><?php echo(JText::_('COM_ZTPORTFOLIO_HEADER_CATEGORY_LIST')); ?> <button onclick="categoryLoadEditor(0);" class="btn btn-success"><?php echo(JText::_('COM_ZTPORTFOLIO_BUTTON_ADD')); ?></button></h2>
        <div id="zt-portfolio-categories-list">
            <?php echo $this->get('html')->fetch('com_ztportfolio://html/categories.php'); ?>
        </div>
    </div>
    <div class="span3" id="category-info">
        <?php echo $this->get('editor')->fetch('com_ztportfolio://html/categories.info.php'); ?>
    </div>
    <div class="span3" id="header-editor">
        <?php echo $this->get('editor')->fetch('com_ztportfolio://html/categories.header.php'); ?>
    </div>
</div>