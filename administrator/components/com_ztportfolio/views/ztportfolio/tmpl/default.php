<?php ZtPortfolioHelperToolbar::addToolBar(); ?>
<div class="row-fluid">
    <div class="span3">
        <h2><?php echo(JText::_('COM_ZTPORTFOLIO_HEADER_CATEGORY_LIST')); ?></h2>
        <div id="zt-portfolio-categories-list">
            <?php echo $this->get('html')->fetch('com_ztportfolio://html/dashboard.categories.php'); ?>
        </div>
    </div>
    <div class="span9">
        <h2><?php echo(JText::_('COM_ZTPORTFOLIO_HEADER_PORTFOLIO_LIST')); ?></h2>
        <div id="zt-portfolio-categories-list">
            <?php echo $this->get('html')->fetch('com_ztportfolio://html/dashboard.portfolio.php'); ?>
        </div>
    </div>
</div>