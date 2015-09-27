<?php
ZtPortfolioHelperToolbar::addToolBar();
$portfolio = $this->get('portfolio', null);
$categories = $this->get('categories');
foreach ($categories as $key => $category) {
    if (!is_array($category['header'])) {
        $category['header'] = json_decode($category['header']);
        $categories[$key] = $category;
    }
}
$currentCategory = null;
if (empty($portfolio)) {
    if (!empty($categories)) {
        $currentCategory = reset($categories);
    }
} else {
    $currentCategory = $categories[$portfolio['category']];
}
?>
<div class="row-fluid" >
    <div class="span9">
        <div class = "form-group">
            <label class = "control-label"><?php echo(JText::_('COM_ZTPORTFOLIO_LABEL_PORTFOLIO_HEADER')); ?></label>
            <div class = "controls">
                <div id="portfolio-header-edit">
                    <?php if (!empty($currentCategory)): ?>
                        <?php foreach ($currentCategory['header'] as $key => $header): ?>
                            <div class="row-fluid">
                                <div class="span4"><?php echo($header->name); ?></div>
                                <div class="span4"><input></div>
                            </div>
                        <?php endforeach; ?>
                    <?php endif; ?> 
                </div>
            </div>
        </div>
        <div class = "form-group">
            <label class = "control-label"><?php echo(JText::_('COM_ZTPORTFOLIO_LABEL_PORTFOLIO_CONTENT')); ?></label>
            <div class = "controls">
                <?php
                $editor = JFactory::getConfig()->get('editor');
                $editor = JEditor::getInstance($editor);

                echo $editor->display('funybody', '', 100, 50, 20, 10, true, 'fuck');
                ?>
            </div>
        </div>
    </div>
    <div class="span3">
        <div class="form-group">
            <label class="control-label"><?php echo(JText::_('COM_ZTPORTFOLIO_LABEL_PORTFOLIO_TITLE')); ?></label>
            <div class="controls">
                <input id="category-name" minlength="5" type="text"">
            </div>
        </div>
        <div class="form-group">
            <label class="control-label"><?php echo(JText::_('COM_ZTPORTFOLIO_LABEL_PORTFOLIO_CATEGORY')); ?></label>
            <div class="controls">
                <select id="portfolio-category">
                    <?php foreach ($categories as $category): ?>
                        <option value="<?php echo($category['id']); ?>"><?php echo($category['name']); ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
        </div>
        <div class="form-group">
            <label class="control-label"><?php echo(JText::_('COM_ZTPORTFOLIO_LABEL_PORTFOLIO_THUMBNAIL')); ?></label>
            <div class="controls">
                <input id="portfolio-thumbnail" minlength="5" type="text"" readonly="true">
                <div id="portfolio-file-view" class="porfolio-file-view"></div>
                <script type="text/javascript">
                    jQuery(document).ready(function () {
                        jQuery('#portfolio-file-view').fileTree({root: '', script: '<?php echo (rtrim(JUri::root(true), '/') . '/administrator/index.php?option=com_ztportfolio&task=data.explorer'); ?>'}, function (file) {
                            jQuery('#portfolio-thumbnail').val(file);
                        });
                    });
                </script>
            </div>
        </div>
        <div id="zt-portfolio-portfolio-tools">
            <?php if (empty($category)): ?>
                <button onclick="categoryCreate();" class="btn btn-success"><?php echo(JText::_('COM_ZTPORTFOLIO_BUTTON_CREATE')); ?></button>
            <?php else: ?>
                <button onclick="categorySave(<?php echo($category['id']); ?>);" class="btn btn-success"><?php echo(JText::_('COM_ZTPORTFOLIO_BUTTON_SAVE')); ?></button>
            <?php endif; ?>
            <button onclick="categoryClear();" class="btn btn-default pull-right"><?php echo(JText::_('COM_ZTPORTFOLIO_BUTTON_CLEAR')); ?></button>
        </div>
    </div>
</div>