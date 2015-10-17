<?php
ZtPortfolioHelperToolbar::toolBar();
$portfolio = $this->get('portfolio', null);
$categories = $this->get('categories');
$properties = $this->get('properties');
?>
<div class="row-fluid" >
    <div class="span9">
        <div class="form-group">
            <label class="control-label"><?php echo(JText::_('COM_ZTPORTFOLIO_LABEL_PORTFOLIO_URL')); ?></label>
            <div class="controls">
                <input id="portfolio-url" minlength="5" type="text" value="<?php echo(!empty($portfolio) ? $portfolio['url'] : ''); ?>">
            </div>
            <i><?php echo(JText::_('COM_ZTPORTFOLIO_LABEL_PORTFOLIO_URL_DESCRIPTION')); ?></i>
        </div>
        <table width="100%">
            <tr>
                <td>
                    <div class="form-group">
                        <label class="control-label"><?php echo(JText::_('COM_ZTPORTFOLIO_LABEL_PORTFOLIO_DESCRIPTION')); ?></label>
                        <div class="controls">
                            <?php
                            $editor = JFactory::getConfig()->get('editor');
                            $editor = JEditor::getInstance($editor);
                            echo $editor->display('portfolio-description', ((!empty($portfolio) ? $portfolio['description'] : '')), 100, 100, 20, 10, true, 'portfolio-description');
                            ?>
                        </div>
                    </div>                 
                </td>
            </tr>
            <tr>
                <td>
                    <div class="form-group">
                        <label class="control-label"><?php echo(JText::_('COM_ZTPORTFOLIO_LABEL_PORTFOLIO_CONTENT')); ?></label>
                        <div class="controls">
                            <?php
                            $editor = JFactory::getConfig()->get('editor');
                            $editor = JEditor::getInstance($editor);
                            echo $editor->display('portfolio-content', ((!empty($portfolio) ? $portfolio['content'] : '')), 100, 100, 20, 10, true, 'portfolio-content');
                            ?>
                        </div>
                    </div>
                </td>
            </tr>
        </table>
    </div>
    <div class="span3">
        <div class="form-group">
            <label class="control-label"><?php echo(JText::_('COM_ZTPORTFOLIO_LABEL_PORTFOLIO_TITLE')); ?></label>
            <div class="controls">
                <input id="portfolio-title" minlength="5" type="text" value="<?php echo((!empty($portfolio) ? $portfolio['title'] : '')); ?>">
            </div>
        </div>
        <div class="form-group">
            <label class="control-label"><?php echo(JText::_('COM_ZTPORTFOLIO_LABEL_PORTFOLIO_CATEGORIES')); ?></label>
            <div class="controls">
                <?php foreach ($categories as $category): ?>
                    <div style="padding: 5px;" id="category-selector">
                        <?php if (!empty($portfolio)): ?>
                            <input type="checkbox" value="<?php echo($category['id']); ?>" <?php echo((in_array($category['id'], $portfolio['category'])) ? 'checked' : ''); ?>> <?php echo($category['name']); ?>
                        <?php else: ?>
                            <input type="checkbox" value="<?php echo($category['id']); ?>"> <?php echo($category['name']); ?>
                        <?php endif; ?>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
        <div class="form-group">
            <label class="control-label"><?php echo(JText::_('COM_ZTPORTFOLIO_LABEL_PORTFOLIO_PROPERTIES')); ?></label>
            <div class="controls">
                <?php foreach ($properties as $property): ?>
                    <div style="padding: 5px;" id="property-selector">
                        <?php if (!empty($portfolio)): ?>
                            <input type="checkbox" value="<?php echo($property['id']); ?>" data-value="<?php echo($property['value']); ?>" data-name="<?php echo($property['name']); ?>" data-type="<?php echo($property['type']); ?>"> <?php echo($property['name']); ?>
                        <?php else: ?>
                            <input type="checkbox" value="<?php echo($property['id']); ?>" data-value="<?php echo($property['value']); ?>" data-name="<?php echo($property['name']); ?>" data-type="<?php echo($property['type']); ?>"> <?php echo($property['name']); ?>
                        <?php endif; ?>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
        <div class="form-group">
            <label class="control-label"><?php echo(JText::_('COM_ZTPORTFOLIO_LABEL_PORTFOLIO_THUMBNAIL')); ?></label>
            <div class="controls">
                <input id="portfolio-thumbnail" minlength="5" type="text"" readonly="true" value="<?php echo((!empty($portfolio) ? $portfolio['thumbnail'] : '')); ?>">
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
    </div>
</div>
<script type="text/javascript">
    (function (w, $) {
        $(w.document).ready(function () {
<?php if (empty($portfolio)): ?>
                addCustomToolBar('javascript:portfolioCreate();', 'file', ' <?php echo JText::_('COM_ZTPORTFOLIO_BUTTON_CREATE'); ?>', 'btn btn-small');
<?php else: ?>
                addCustomToolBar('javascript:portfolioSave(<?php echo($portfolio['id']); ?>);', 'save', ' <?php echo JText::_('COM_ZTPORTFOLIO_BUTTON_SAVE'); ?>', 'btn btn-small');
<?php endif; ?>
            addCustomToolBar('<?php echo JRoute::_('index.php?option=com_ztportfolio&task=data.display'); ?>', 'cancel', ' <?php echo JText::_('COM_ZTPORTFOLIO_BUTTON_CANCEL'); ?>', 'btn btn-small');
        });
    })(window, jQuery);
</script>