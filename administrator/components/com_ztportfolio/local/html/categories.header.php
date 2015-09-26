<?php if(empty($category)): ?>
<h2><?php echo(JText::_('COM_ZTPORTFOLIO_HEADER_HEADERS_EDITOR')); ?></h2>
<?php else: ?>
<h2><?php echo(JText::_('COM_ZTPORTFOLIO_HEADER_HEADERS_EDITOR')); ?></h2>
<?php endif; ?>
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