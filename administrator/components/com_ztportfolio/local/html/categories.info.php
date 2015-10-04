<?php if (empty($category)): ?>
    <h2><?php echo(JText::_('COM_ZTPORTFOLIO_HEADER_CREATE_CATEGORY')); ?></h2>
<?php else: ?>
    <h2><?php echo(JText::_('COM_ZTPORTFOLIO_HEADER_EDIT_CATEGORY')); ?></h2>
<?php endif; ?>
<div class="form-group">
    <label class="control-label"><?php echo(JText::_('COM_ZTPORTFOLIO_LABEL_CATEGORY_NAME')); ?></label>
    <div class="controls">
        <input id="category-name" minlength="5" type="text" value="<?php echo((!empty($category) ? $category['name'] : '')); ?>">
    </div>
</div>
<label class="control-label"><?php echo(JText::_('COM_ZTPORTFOLIO_LABEL_HEADER')); ?></label>
<div id="zt-portfolio-container">
    <?php if (!empty($category)): ?>
        <?php $header = (is_array($category['header'])) ? $category['header'] : json_decode($category['header']); ?>
        <?php foreach ($header as $element): ?>
            <div id="zt-portfolio-element" data-name="<?php echo($element->name); ?>" data-type="<?php echo($element->type); ?>" data-value="<?php echo($element->value); ?>"><?php echo($element->name); ?><button onclick="headerRemove(this);" class="btn btn-mini btn-danger pull-right">x</button></div>
        <?php endforeach; ?>
    <?php endif; ?>
</div>
<div id="zt-portfolio-category-tools">
    <?php if (empty($category)): ?>
        <button onclick="categoryCreate();" class="btn btn-success"><?php echo(JText::_('COM_ZTPORTFOLIO_BUTTON_CREATE')); ?></button>
    <?php else: ?>
        <button onclick="categorySave(<?php echo($category['id']); ?>);" class="btn btn-success"><?php echo(JText::_('COM_ZTPORTFOLIO_BUTTON_SAVE')); ?></button>
    <?php endif; ?>
    <button onclick="categoryClear();" class="btn btn-default pull-right"><?php echo(JText::_('COM_ZTPORTFOLIO_BUTTON_CLEAR')); ?></button>
</div>