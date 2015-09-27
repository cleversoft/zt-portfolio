<div class="sidebar-nav">
    <ul id="submenu" class="nav nav-list">
        <?php foreach ($categories as $key => $category): ?>
        <li <?php if(JFactory::getApplication()->input->get('id', 0, 'INT') == $category['id']){echo('class="active"');} ?>>
            <a href="<?php echo(rtrim(JUri::root(), '/') . '/administrator/index.php?option=com_ztportfolio&id=' . $category['id']); ?>"><?php echo($category['name']); ?></a>
        <li>
        <?php endforeach; ?>
    </ul>
</div>