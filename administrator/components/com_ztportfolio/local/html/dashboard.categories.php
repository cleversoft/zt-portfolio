<table class="table table-striped" id="zt-portfolio-categories-list">
    <thead>
        <tr>
            <th width="5%" class="left"><input type="checkbox" id="check-all" onclick="publicCheckAll('#zt-portfolio-categories-list');"></th>
            <th width="5%" class="left"><?php echo(JText::_('COM_ZTPORTFOLIO_TABLE_PORTFOLIO_NO')); ?></th>
            <th width="55%" class="nowrap"><?php echo(JText::_('COM_ZTPORTFOLIO_TABLE_PORTFOLIO_TITLE')); ?></th>
            <th width="20%" class="nowrap"><?php echo(JText::_('COM_ZTPORTFOLIO_TABLE_PORTFOLIO_PUBLIC')); ?></th>
            <th width="20%" class="nowrap center"><?php echo(JText::_('COM_ZTPORTFOLIO_TABLE_PORTFOLIO_ACTION')); ?></th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($categories as $key => $category): ?>
            <tr>
                <td><input type="checkbox" value="<?php echo($category['id']); ?>"></td>
                <td><?php echo($key + 1); ?></td>
                <td><a href="javascript: editCategory(<?php echo ($category['id'] . ', \'' . base64_encode($category['name'])); ?>');"><?php echo($category['name']); ?></a></td>
                <td><?php echo($category['status'] == ZtPortfolioModelCategories::STATUS_PUBLIC ? JText::_('COM_ZTPORTFOLIO_BUTTON_PUBLISH') : JText::_('COM_ZTPORTFOLIO_BUTTON_UNPUBLISH')); ?></td>
                <td class="nowrap center categories-controls"><span class="icon-trash" onclick="categoryDelete(<?php echo($category['id']); ?>);"></span></td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>