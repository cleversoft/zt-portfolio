<?php foreach ($headers as $key => $header): ?>
    <div class="row-fluid">
        <div class="span4"><?php echo($header->name); ?></div>
        <div class="span4"><input id="portfolio-header-element" data-name="<?php echo($header->name); ?>" data-type="<?php echo($header->type); ?>" value="<?php echo($header->value); ?>"></div>
    </div>
<?php endforeach;