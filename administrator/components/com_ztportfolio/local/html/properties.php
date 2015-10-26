<table class="table table-striped" id="zt-portfolio-categories-list">
    <thead>
        <tr>
            <th width="5%" class="left"><?php echo(JText::_('COM_ZTPORTFOLIO_TABLE_PORTFOLIO_NO')); ?></th>
            <th width="25%" class="nowrap"><?php echo(JText::_('COM_ZTPORTFOLIO_TABLE_PROPERTY_NAME')); ?></th>
            <th width="25%" class="nowrap"><?php echo(JText::_('COM_ZTPORTFOLIO_TABLE_PROPERTY_TYPE')); ?></th>
            <th width="25%" class="nowrap"><?php echo(JText::_('COM_ZTPORTFOLIO_TABLE_PROPERTY_DEFAULT')); ?></th>
            <th width="20%" class="nowrap center"><?php echo(JText::_('COM_ZTPORTFOLIO_TABLE_PORTFOLIO_ACTION')); ?></th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($properties as $key => $property): ?>
            <tr>
                <td><?php echo($key + 1); ?></td>
                <td><a href="javascript:propertyEditor(<?php echo($property['id']); ?>);"><?php echo($property['name']); ?></a></td>
                <td><?php echo($property['type']); ?></td>
                <td><?php echo($property['value']); ?></td>
                <td class="nowrap center categories-controls"><span class="icon-trash" onclick="propertyDelete(<?php echo($property['id']); ?>);"></span></td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>