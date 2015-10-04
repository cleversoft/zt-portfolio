<div class="row-fluid">
    <div class="span3" id="category-info">
        <div class="form-group">
            <label class="control-label"><?php echo(JText::_('COM_ZTPORTFOLIO_LABEL_CATEGORY_NAME')); ?></label>
            <div class="controls">
                <select id="category-name" onchange="categoryReloadHeader();" <?php echo(empty($activeCategory)?'':' disabled') ?>>
                    <option vlaue="0"><?php echo(JText::_('JNONE')); ?></option>
                    <?php foreach ($categories as $category): ?>
                    <?php if(empty($activeCategory)): ?>
                        <option value="<?php echo($category['id']); ?>"><?php echo($category['name']); ?></option>
                    <?php else: ?>
                        <option value="<?php echo($category['id']); ?>"<?php echo(($activeCategory['id'] == $category['id'])?' selected':''); ?>><?php echo($category['name']); ?></option>
                    <?php endif; ?>
                    <?php endforeach; ?>
                </select>
            </div>
        </div>
        <label class="control-label"><?php echo(JText::_('COM_ZTPORTFOLIO_LABEL_HEADER')); ?></label>
        <div id="zt-portfolio-container">
        </div>
    </div>
    <div class="span3" id="header-editor">
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
                    <button onclick="headerAdd();" class="btn btn-success"><?php echo(JText::_('COM_ZTPORTFOLIO_BUTTON_ADD')); ?></button>
                </div>
            </div>
        </div>
    </div>
</div>