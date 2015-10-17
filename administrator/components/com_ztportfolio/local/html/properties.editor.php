<div class="row-fluid">
    <div class="span3">
        <div id="zt-portfolio-properties-editor">
            <div class="form-group">
                <label class="control-label"><?php echo(JText::_('COM_ZTPORTFOLIO_LABEL_NAME')); ?></label>
                <div class="controls">
                    <input id="property-name" minlength="5" type="text" value="<?php echo (!empty($activeProperty) ? $activeProperty['name'] : ''); ?>">
                </div>
            </div>
            <div class="form-group">
                <label class="control-label"><?php echo(JText::_('COM_ZTPORTFOLIO_LABEL_TYPE')); ?></label>
                <div class="controls">
                    <select id="property-type">
                        <option value="text" <?php echo (!empty($activeProperty)  && $activeProperty['type'] == 'text' ? 'selected' : ''); ?>><?php echo(JText::_('COM_ZTPORTFOLIO_TYPE_TEXT')); ?></option>
                        <option value="date" <?php echo (!empty($activeProperty)  && $activeProperty['type'] == 'date' ? 'selected' : ''); ?>><?php echo(JText::_('COM_ZTPORTFOLIO_TYPE_DATE')); ?></option>
                        <option value="number" <?php echo (!empty($activeProperty)  && $activeProperty['type'] == 'number' ? 'selected' : ''); ?>><?php echo(JText::_('COM_ZTPORTFOLIO_TYPE_NUMBER')); ?></option>
                    </select>
                </div>
            </div>
            <div class="form-group">
                <label class="control-label"><?php echo(JText::_('COM_ZTPORTFOLIO_LABEL_DEFAULT')); ?></label>
                <div class="controls">
                    <input id="property-value" type="text" value="<?php echo (!empty($activeProperty) ? $activeProperty['value'] : ''); ?>">
                </div>
            </div>
        </div>
    </div>
</div>