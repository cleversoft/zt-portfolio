<table class="table table-striped" id="zt-portfolio-portfolios-list">
    <thead>
        <tr>
            <th width="5%" class="left"><input type="checkbox" id="check-all" onclick="publicCheckAll('#zt-portfolio-portfolios-list');"></th>
            <th width="5%" class="left"><?php echo(JText::_('COM_ZTPORTFOLIO_TABLE_PORTFOLIO_NO')); ?></th>
            <th width="40%" class="nowrap"><?php echo(JText::_('COM_ZTPORTFOLIO_TABLE_PORTFOLIO_TITLE')); ?></th>
            <th width="10%" class="nowrap center"><?php echo(JText::_('COM_ZTPORTFOLIO_TABLE_PORTFOLIO_CATEGORY')); ?></th>
            <th width="15%" class="nowrap"><?php echo(JText::_('COM_ZTPORTFOLIO_TABLE_PORTFOLIO_PUBLIC')); ?></th>
            <th width="10%" class="nowrap center"><?php echo(JText::_('COM_ZTPORTFOLIO_TABLE_PORTFOLIO_ACTION')); ?></th>
            <th width="35%"><?php echo(JText::_('COM_ZTPORTFOLIO_TABLE_PORTFOLIO_LAST_MODIFIED')); ?></th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($portfolios as $key => $portfolio): ?>
            <tr>
                <td><input type="checkbox" value="<?php echo($portfolio['id']); ?>"></td>
                <td><?php echo($key + 1); ?></td>
                <td><a href="<?php echo(rtrim(JUri::root(), '/') . '/administrator/index.php?option=com_ztportfolio&task=data.portfolio&id=' . $portfolio['id']); ?>"><?php echo($portfolio['title']); ?></a></td>
                <td class="nowrap center"><?php echo($portfolio['category']); ?></td>
                <td><?php echo($portfolio['status'] == ZtPortfolioModelData::STATUS_PUBLIC ? JText::_('COM_ZTPORTFOLIO_BUTTON_PUBLISH') : JText::_('COM_ZTPORTFOLIO_BUTTON_UNPUBLISH')); ?></td>
                <td class="nowrap center categories-controls"><span class="icon-trash" onclick="portfolioDelete(<?php echo($portfolio['id']); ?>);"></span></td>
                <td><?php echo(date('D, M d Y', $portfolio['modified'])); ?></td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>