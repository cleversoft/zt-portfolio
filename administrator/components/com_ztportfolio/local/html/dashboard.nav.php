<div class="sidebar-nav">
    <ul id="submenu" class="nav nav-list">
        <?php foreach ($nav as $key => $value): ?>
            <li <?php  if (isset($active)) {
            echo ($active == $key) ? 'class="active"' : '';
        } ?>>
                <a href="<?php echo(rtrim(JUri::root(), '/') . '/administrator/index.php?option=com_ztportfolio&task=' . $key); ?>"><?php echo(JText::_($value)); ?></a>
            <li>
<?php endforeach; ?>
    </ul>
</div>