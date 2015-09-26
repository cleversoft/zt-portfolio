<div class="row-fluid">
    <div class="span2 categories-header"><?php echo(JText::_('COM_ZTPORTFOLIO_CATEGORY_ID')); ?></div>
    <div class="span4 categories-header"><?php echo(JText::_('COM_ZTPORTFOLIO_CATEGORY_NAME')); ?></div>
    <div class="span3 categories-header"><?php echo(JText::_('COM_ZTPORTFOLIO_CATEGORY_TOTAL_HEADER')); ?></div>
    <div class="span3 categories-header"><?php echo(JText::_('COM_ZTPORTFOLIO_CATEGORY_CONTROLS')); ?></div>
</div>
<?php foreach ($categories as $key => $category): ?>
    <div class="row-fluid">
        <?php $class = 'categories-data ' . (($key % 2 == 0) ? 'categories-data-bold' : 'categories-data-thin'); ?>
        <div class="span2 <?php echo($class); ?>"><?php echo($category['id']); ?></div>
        <div class="span4 <?php echo($class); ?>"><?php echo($category['name']); ?></div>
        <div class="span3 <?php echo($class); ?>"><?php echo(count(json_decode($category['header']))); ?></div>
        <div class="span3 <?php echo($class); ?> categories-controls">
            <span class="icon-pencil-2"></span>
            <span class="icon-trash" onclick="categoryDelete(<?php echo($category['id']); ?>);"></span>
        </div>
    </div>
<?php
endforeach;
