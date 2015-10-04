<table class="table table-striped" id="userList">
    <thead>
        <tr>
            <th width="5%" class="left"><?php echo(JText::_('COM_ZTPORTFOLIO_TABLE_PORTFOLIO_NO')); ?></th>
            <th width="50%" class="nowrap"><?php echo(JText::_('COM_ZTPORTFOLIO_TABLE_PORTFOLIO_TITLE')); ?></th>
            <th width="10%" class="nowrap center"><?php echo(JText::_('COM_ZTPORTFOLIO_TABLE_PORTFOLIO_CATEGORY')); ?></th>
            <th width="10%" class="nowrap center"><?php echo(JText::_('COM_ZTPORTFOLIO_TABLE_PORTFOLIO_ACTION')); ?></th>
            <th width="25%"><?php echo(JText::_('COM_ZTPORTFOLIO_TABLE_PORTFOLIO_LAST_MODIFIED')); ?></th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($portfolios as $key => $portfolio): ?>
            <tr>
                <td><?php echo($key + 1); ?></td>
                <td><a href="<?php echo(rtrim(JUri::root(), '/') . '/administrator/index.php?option=com_ztportfolio&task=data.portfolio&id=' . $portfolio['id']); ?>"><?php echo($portfolio['title']); ?></a></td>
                <td class="nowrap center"><?php echo($portfolio['category']); ?></td>
                <td class="nowrap center categories-controls"><span class="icon-trash" onclick="portfolioDelete(<?php echo($portfolio['id']); ?>);"></span></td>
                <td><?php echo(date('D, M d Y', $portfolio['modified'])); ?></td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>