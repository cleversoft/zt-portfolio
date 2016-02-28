<?php
$activePortfolio = ModZtPortfolioHelper::getActivePortfolio();
?>
<?php if (empty($activePortfolio)): ?>
    <div id="gallery">
        <div id="gallery-header">
            <div id="gallery-header-center">
                <div id="gallery-header-center-left">
                    <div id="gallery-header-center-left-title"><?php echo(JText::_('MOD_ZTPORTFOLIO_ALL_CATEGORY')); ?></div>
                </div>
                <div id="gallery-header-center-right">
                    <div class="gallery-header-center-right-links" data-filter="all" id="filter-all"><?php echo(JText::_('MOD_ZTPORTFOLIO_ALL_CATEGORY')); ?></div>
                    <?php $filter = array('all'); ?>
                    <?php foreach ($tags as $tag): ?>
                        <?php $class = $tag['alias']; ?>
                        <?php $filter[] = $class; ?>
                        <div class="gallery-header-center-right-links" data-filter="<?php echo $class; ?>" id="filter-<?php echo $class; ?>"><?php echo($tag['title']); ?></div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
        <div id="gallery-content">
            <div id="gallery-content-center">
                <?php foreach ($portfolios as $portfolio): ?>
                    <?php $portfolio['ztportfolio_tag_id'] = json_decode($portfolio['ztportfolio_tag_id']); ?>
                    <?php $class = array(); ?>
                    <?php foreach ($portfolio['ztportfolio_tag_id'] as $id): ?>
                        <?php $portfolioTag = ModZtPortfolioHelper::getTag($id); ?>
                        <?php $class[] = $portfolioTag['alias']; ?>
                    <?php endforeach; ?>
                    <?php  ?>
                    <div class="<?php echo(implode(' ', $class));  ?> gird-common all" style="background-image: url('<?php echo ModZtPortfolioHelper::getUrl($portfolio['image']); ?>');">
                        <a href="<?php echo(ModZtPortfolioHelper::getUrl('/index.php?module=mod_ztporfolio&show=' . $portfolio['ztportfolio_item_id'])); ?>"><?php echo($portfolio['title']); ?></a>
                        <div><?php echo($portfolio['url']); ?></div>
                        <div><?php echo($portfolio['description']); ?></div>
                        <div><?php echo($portfolio['video']); ?></div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
    <script type="text/javascript">
        jQuery(window).load(function () {
            var $ = jQuery;
            $('.gallery-content-center').masonry({
                columnWidth: 200,
                itemSelector: '.gird-common'
            });
            var button_class = "gallery-header-center-right-links-current";
            var $container = $('#gallery-content-center');
            
            $('[id^="filter-"]').click(function () {
                $container.isotope({filter: '.' + $(this).data('filter')});
                console.log('.' + $(this).data('filter'));
                $('.gallery-header-center-right-links').removeClass(button_class);
                $(this).addClass(button_class);
                $container.isotope();
            });

        });
    </script>
<?php else: ?>
    <?php $activeHeaders = json_decode($activePortfolio['properties']); ?>
    <div class="row-fluid">
        <div class="span4">
            <h2><?php echo($activePortfolio['title']); ?></h2>
            <?php foreach ($activeHeaders as $activeHeader): ?>
                <div class="span6"><b><?php echo(base64_decode($activeHeader->name)); ?></b></div>
                <div class="span6"><?php echo(base64_decode($activeHeader->value)); ?></div>
            <?php endforeach; ?>
        </div>
        <div class="span8">
            <div><?php echo($activePortfolio['url']); ?></div>
            <div><?php echo($activePortfolio['description']); ?></div>
            <div><?php echo($activePortfolio['video']); ?></div>
            <div><?php echo($activePortfolio['image']); ?></div>            
        </div>
    </div>
<?php endif;
<?php
if($readmore == 1){
    ?>
    <input type="button" value="Read more" class="zt_readmore">
    <?php
}
?>