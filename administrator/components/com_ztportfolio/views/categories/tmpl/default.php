<?php ZtPortfolioHelperToolbar::addToolBar(); ?>
<div class="row-fluid">
    <div class="span6">
        <h2><?php echo(JText::_('COM_ZTPORTFOLIO_HEADER_CATEGORY_LIST')); ?></h2>
        <div id="zt-portfolio-categories-list">
            <?php echo $this->get('html')->fetch('com_ztportfolio://html/categories.php'); ?>
        </div>
    </div>
    <div class="span3">
        <h2><?php echo(JText::_('COM_ZTPORTFOLIO_HEADER_CREATE_CATEGORY')); ?></h2>
        <div class="form-group">
            <label class="control-label"><?php echo(JText::_('COM_ZTPORTFOLIO_LABEL_CATEGORY_NAME')); ?></label>
            <div class="controls">
                <input id="category-name" minlength="5" type="text">
            </div>
        </div>
        <label class="control-label"><?php echo(JText::_('COM_ZTPORTFOLIO_LABEL_HEADER')); ?></label>
        <div id="zt-portfolio-container"></div>
        <div id="zt-portfolio-category-tools">
            <button id="category-create" class="btn btn-success"><?php echo(JText::_('COM_ZTPORTFOLIO_BUTTON_CREATE')); ?></button>
            <button id="category-clear" class="btn btn-danger pull-right"><?php echo(JText::_('COM_ZTPORTFOLIO_BUTTON_CLEAR')); ?></button>
        </div>
    </div>
    <div class="span3">
        <h2><?php echo(JText::_('COM_ZTPORTFOLIO_HEADER_HEADERS_EDITOR')); ?></h2>
        <div id="zt-portfolio-header-editor">
            <div class="form-group">
                <label class="control-label"><?php echo(JText::_('COM_ZTPORTFOLIO_LABEL_NAME')); ?></label>
                <div class="controls">
                    <input id="header-name" minlength="5" type="text">
                </div>
            </div>
            <div class="form-group">
                <label class="control-label"><?php echo(JText::_('COM_ZTPORTFOLIO_LABEL_TYPE')); ?></label>
                <div class="controls">
                    <select id="header-type">
                        <option value="text"><?php echo(JText::_('COM_ZTPORTFOLIO_TYPE_TEXT')); ?></option>
                        <option value="date"><?php echo(JText::_('COM_ZTPORTFOLIO_TYPE_DATE')); ?></option>
                        <option value="number"><?php echo(JText::_('COM_ZTPORTFOLIO_TYPE_NUMBER')); ?></option>
                    </select>
                </div>
            </div>
            <div class="form-group">
                <label class="control-label"><?php echo(JText::_('COM_ZTPORTFOLIO_LABEL_DEFAULT')); ?></label>
                <div class="controls">
                    <input id="header-default" type="text">
                </div>
            </div>
            <div class="form-group">
                <div class="controls">
                    <button id="header-add" class="btn btn-success"><?php echo(JText::_('COM_ZTPORTFOLIO_BUTTON_ADD')); ?></button>
                </div>
            </div>
        </div>
    </div>
</div>