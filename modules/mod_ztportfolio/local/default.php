<?php
$classStackW = array('grid-item--width2',
    'grid-item--width3',
    'grid-item--width4');
$classStackH = array(
    'grid-item--height2',
    'grid-item--height3',
    'grid-item--height4');
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
                    <?php foreach ($categories as $category): ?>
                        <?php $class = ModZtPortfolioHelper::getClass($category['name'].'-'.$category['id']); ?>
                        <?php $filter[] = $class; ?>
                        <div class="gallery-header-center-right-links" data-filter="<?php echo $class; ?>" id="filter-<?php echo $class; ?>"><?php echo($category['name']); ?></div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
        <div id="gallery-content">
            <div id="gallery-content-center">
                <?php foreach ($portfolios as $portfolio): ?>
                    <?php $portfolio['category'] = explode(',', $portfolio['category']); ?>
                    <?php $class = array();?>
                    <?php foreach($portfolio['category'] as $id): ?>
                    <?php $portfolioCategory = ModZtPortfolioHelper::getCategory($id); ?>
                    <?php $class[] =  ModZtPortfolioHelper::getClass($portfolioCategory['name'] . '-' . $portfolioCategory['id']);?>
                    <?php endforeach; ?>
                    <?php  ?>
                    <div class="<?php echo(implode(' ', $class));  ?> gird-common all <?php echo($classStackW[rand(0, 2)] . ' ' . $classStackH[rand(0, 2)]); ?>" style="background-image: url('<?php echo ModZtPortfolioHelper::getUrl('/images' . $portfolio['thumbnail']); ?>');">
                        <a href="<?php echo(ModZtPortfolioHelper::getUrl('/index.php?module=mod_ztporfolio&show=' . $portfolio['id'])); ?>"><?php echo($portfolio['title']); ?></a>
                        <div><?php echo($portfolio['url']); ?></div>
                        <div><?php echo($portfolio['description']); ?></div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
    <script type="text/javascript">
        jQuery(window).load(function () {
            var $ = jQuery;
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
    <?php $activeHeaders = json_decode($activePortfolio['header']); ?>
    <div class="row-fluid">
        <div class="span4">
            <h2><?php echo($activePortfolio['title']); ?></h2>
            <?php foreach ($activeHeaders as $activeHeader): ?>
                <div class="span6"><b><?php echo($activeHeader->name); ?></b></div>
                <div class="span6"><?php echo($activeHeader->value); ?></div>
            <?php endforeach; ?>
        </div>
        <div class="span8">
            <?php echo($activePortfolio['content']); ?>
        </div>
    </div>
<?php endif;