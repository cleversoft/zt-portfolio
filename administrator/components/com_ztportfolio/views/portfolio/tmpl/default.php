<?php
ZtPortfolioHelperToolbar::toolBar();
$portfolio = $this->get('portfolio', null);
$categories = $this->get('categories');
$properties = $this->get('properties');
$headers = array();
if (!empty($portfolio['header'])) {
    foreach ($portfolio['header'] as $header) {
        $headers[$header->type][$header->name] = $header->value;
    }
}
?>
<div class="row-fluid" >
    <div class="span9">
        <div class="form-group" style="margin-bottom: 15px;">
            <label class="control-label"><?php echo(JText::_('COM_ZTPORTFOLIO_LABEL_PORTFOLIO_URL')); ?></label>
            <div class="controls">
                <input id="portfolio-url"  type="text" value="<?php echo(!empty($portfolio) ? $portfolio['url'] : ''); ?>">
            </div>
            <i><?php echo(JText::_('COM_ZTPORTFOLIO_LABEL_PORTFOLIO_URL_DESCRIPTION')); ?></i>
        </div>
        <div class="accordion" id="zt-portfolio-editor">
            <div class="accordion-group">
                <div class="accordion-heading">
                    <a class="accordion-toggle" data-toggle="collapse" data-parent="#zt-portfolio-editor" href="#collapseOne">
                        <?php echo(JText::_('COM_ZTPORTFOLIO_LABEL_PORTFOLIO_EDIT_PROPERTIES')); ?>
                    </a>
                </div>
                <div id="collapseOne" class="accordion-body collapse in">
                    <div class="accordion-inner">
                        <div class="row-fluid">
                            <?php foreach ($properties as $property): ?>
                                <div class="form-group">
                                    <label class="control-label"><?php echo($property['name']); ?></label>
                                    <div class="controls">
                                        <div style="padding: 5px;">
                                            <?php if (!empty($headers[$property['type']][$property['name']])): ?>
                                                <?php if ($property['type'] == 'date'): ?>
                                                    <div class="input-append date">
                                                        <input id="zt-portfolio-property-element" readonly data-provide="datepicker" type="text" value="<?php echo($headers[$property['type']][$property['name']]); ?>" data-name="<?php echo ($property['name']); ?>" data-type="<?php echo ($property['type']); ?>"><span class="add-on"><i class="icon-calendar"></i></span>
                                                    </div>
                                                <?php else: ?>
                                                    <input id="zt-portfolio-property-element" type="text" value="<?php echo($headers[$property['type']][$property['name']]); ?>" data-name="<?php echo ($property['name']); ?>" data-type="<?php echo ($property['type']); ?>">
                                                <?php endif; ?>
                                            <?php else: ?>
                                                <?php if ($property['type'] == 'date'): ?>
                                                    <div class="input-append date">
                                                        <input id="zt-portfolio-property-element" readonly data-provide="datepicker" type="text" value="" data-name="<?php echo ($property['name']); ?>" data-type="<?php echo ($property['type']); ?>"><span class="add-on"><i class="icon-calendar"></i></span>
                                                    </div>
                                                <?php else: ?>
                                                    <input id="zt-portfolio-property-element" type="text" value="" data-name="<?php echo ($property['name']); ?>" data-type="<?php echo ($property['type']); ?>">
                                                <?php endif; ?>   
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                </div>
            </div>
            <div class="accordion-group">
                <div class="accordion-heading">
                    <a class="accordion-toggle" data-toggle="collapse" data-parent="#zt-portfolio-editor" href="#collapseTwo">
                        <?php echo(JText::_('COM_ZTPORTFOLIO_LABEL_PORTFOLIO_DESCRIPTION')); ?>
                    </a>
                </div>
                <div id="collapseTwo" class="accordion-body collapse">
                    <div class="accordion-inner">
                        <table width="100%">
                            <tr>
                                <td>
                                    <div class="form-group">
                                        <label class="control-label"></label>
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
                        </table>
                    </div>
                </div>
            </div>
            <div class="accordion-group">
                <div class="accordion-heading">
                    <a class="accordion-toggle" data-toggle="collapse" data-parent="#zt-portfolio-editor" href="#collapseThree">
                        <?php echo(JText::_('COM_ZTPORTFOLIO_LABEL_PORTFOLIO_CONTENT')); ?>
                    </a>
                </div>
                <div id="collapseThree" class="accordion-body collapse">
                    <div class="accordion-inner">
                        <table width="100%">
                            <tr>
                                <td>
                                    <div class="form-group">
                                        <label class="control-label"></label>
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
                </div>
            </div>
        </div>

    </div>
    <div class="span3">
        <div class="form-group">
            <label class="control-label"><?php echo(JText::_('COM_ZTPORTFOLIO_LABEL_PORTFOLIO_TITLE')); ?></label>
            <div class="controls">
                <input id="portfolio-title"  type="text" value="<?php echo((!empty($portfolio) ? $portfolio['title'] : '')); ?>">
            </div>
        </div>
        <div class="form-group">
            <label class="control-label"><?php echo(JText::_('COM_ZTPORTFOLIO_LABEL_PORTFOLIO_CATEGORIES')); ?></label>
            <div class="controls">
                <select id="category-selector" multiple>
                    <?php foreach ($categories as $category): ?>
                        <?php if (!empty($portfolio)): ?>
                            <option value="<?php echo($category['id']); ?>" <?php echo((in_array($category['id'], $portfolio['category'])) ? 'selected' : ''); ?>> <?php echo($category['name']); ?></option>
                        <?php else: ?>
                            <option value="<?php echo($category['id']); ?>"> <?php echo($category['name']); ?></option>
                        <?php endif; ?>
                    <?php endforeach; ?>
                </select>
            </div>
        </div>
        <div class="form-group">
            <label class="control-label"><?php echo(JText::_('COM_ZTPORTFOLIO_LABEL_PORTFOLIO_THUMBNAIL')); ?></label>
            <div class="controls">
                <input id="portfolio-thumbnail"  type="text" readonly="true" value="<?php echo((!empty($portfolio) ? $portfolio['thumbnail'] : '')); ?>">
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
        $('#category-selector').chosen({no_results_text: "Oops, nothing found!"});
    })(window, jQuery);
</script>
