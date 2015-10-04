<?php if (!empty($category)): ?>
    <?php $header = (is_array($category['header'])) ? $category['header'] : json_decode($category['header']); ?>
    <?php foreach ($header as $element): ?>
        <div id="zt-portfolio-element" data-name="<?php echo($element->name); ?>" data-type="<?php echo($element->type); ?>" data-value="<?php echo($element->value); ?>"><?php echo($element->name); ?><button onclick="headerRemove(this);" class="btn btn-mini btn-danger pull-right">x</button></div>
    <?php endforeach; ?>
<?php endif; ?>