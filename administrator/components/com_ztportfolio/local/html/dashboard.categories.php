<table class="table table-striped" id="categories-list">
    <thead>
        <tr>
            <th width="5%" class="left"><?php echo(JText::_('COM_ZTPORTFOLIO_TABLE_PORTFOLIO_NO')); ?></th>
            <th width="75%" class="nowrap"><?php echo(JText::_('COM_ZTPORTFOLIO_TABLE_PORTFOLIO_TITLE')); ?></th>
            <th width="20%" class="nowrap center"><?php echo(JText::_('COM_ZTPORTFOLIO_TABLE_PORTFOLIO_ACTION')); ?></th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($categories as $key => $category): ?>
            <tr>
                <td><?php echo($key + 1); ?></td>
                <td><a href="<?php echo(rtrim(JUri::root(), '/') . '/administrator/index.php?option=com_ztportfolio&task=properties.display&id=' . $category['id']); ?>"><?php echo($category['name']); ?></a></td>
                <td class="nowrap center categories-controls"><span class="icon-trash" onclick="categoryDelete(<?php echo($category['id']); ?>);"></span></td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>