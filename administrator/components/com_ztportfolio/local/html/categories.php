<div class="row-fluid">
    <div class="span2 categories-header"><?php echo(JText::_('COM_ZTPORTFOLIO_CATEGORY_ID')); ?></div>
    <div class="span4 categories-header"><?php echo(JText::_('COM_ZTPORTFOLIO_CATEGORY_NAME')); ?></div>
    <div class="span3 categories-header"><?php echo(JText::_('COM_ZTPORTFOLIO_CATEGORY_TOTAL_HEADER')); ?></div>
    <div class="span3 categories-header"><?php echo(JText::_('COM_ZTPORTFOLIO_CATEGORY_CONTROLS')); ?></div>
</div>
<?php foreach ($categories as $key => $category): ?>
    <div class="row-fluid">
        <div class="span2 categories-data <?php echo(($key % 2 == 0) ? 'categories-data-bold' : 'categories-data-thin'); ?>"><?php echo($category['id']); ?></div>
        <div class="span4 categories-data <?php echo(($key % 2 == 0) ? 'categories-data-bold' : 'categories-data-thin'); ?>"><?php echo($category['name']); ?></div>
        <div class="span3 categories-data <?php echo(($key % 2 == 0) ? 'categories-data-bold' : 'categories-data-thin'); ?>"><?php echo(count(json_decode($category['header']))); ?></div>
        <div class="span3 categories-data <?php echo(($key % 2 == 0) ? 'categories-data-bold' : 'categories-data-thin'); ?>">
            <a><span class="icon-trash"></span></a>
            <a><span class="icon-pencil-2"></span></a>
            <a><span class="icon-delete"></span></a>
        </div>
    </div>
<?php
endforeach;
