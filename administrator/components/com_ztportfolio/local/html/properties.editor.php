<div class="row-fluid">
    <div class="span4">
        <div id="zt-portfolio-properties-editor">
            <div class="form-group">
                <label class="control-label"><?php echo(JText::_('COM_ZTPORTFOLIO_LABEL_NAME')); ?></label>
                <div class="controls">
                    <input id="property-id" type="hidden" value="<?php echo (!empty($activeProperty) ? $activeProperty['id'] : ''); ?>">
                    <input id="property-name"  type="text" value="<?php echo (!empty($activeProperty) ? $activeProperty['name'] : ''); ?>">
                </div>
            </div>
        </div>
    </div>
    <div class="span4">
        <div class="form-group">
            <label class="control-label"><?php echo(JText::_('COM_ZTPORTFOLIO_LABEL_TYPE')); ?></label>
            <div class="controls">
                <select id="property-type">
                    <option value="text" <?php echo (!empty($activeProperty) && $activeProperty['type'] == 'text' ? 'selected' : ''); ?>><?php echo(JText::_('COM_ZTPORTFOLIO_TYPE_TEXT')); ?></option>
                    <option value="date" <?php echo (!empty($activeProperty) && $activeProperty['type'] == 'date' ? 'selected' : ''); ?>><?php echo(JText::_('COM_ZTPORTFOLIO_TYPE_DATE')); ?></option>
                    <option value="number" <?php echo (!empty($activeProperty) && $activeProperty['type'] == 'number' ? 'selected' : ''); ?>><?php echo(JText::_('COM_ZTPORTFOLIO_TYPE_NUMBER')); ?></option>
                    <option value="media" <?php echo (!empty($activeProperty) && $activeProperty['type'] == 'media' ? 'selected' : ''); ?>><?php echo(JText::_('COM_ZTPORTFOLIO_TYPE_MEDIA')); ?></option>
                </select>
            </div>
        </div>
    </div>
    <div class="span4">
        <div class="form-group">
            <label class="control-label"><?php echo(JText::_('COM_ZTPORTFOLIO_LABEL_DEFAULT')); ?></label>
            <div class="controls" id="property-value-container">
                <input id="property-value" type="text" value="<?php echo (!empty($activeProperty) ? $activeProperty['value'] : ''); ?>">
            </div>
        </div>
    </div>
</div>