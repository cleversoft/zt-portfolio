<?php
$doc = JFactory::getDocument();
$doc->addStylesheet( JURI::root(true) . '/components/com_ztportfolio/assets/css/featherlight.min.css' );
$doc->addStylesheet( JURI::root(true) . '/components/com_ztportfolio/assets/css/ztportfolio.css' );
$doc->addScript( JURI::root(true) . '/components/com_ztportfolio/assets/js/jquery.shuffle.modernizr.min.js' );
$doc->addScript( JURI::root(true) . '/components/com_ztportfolio/assets/js/featherlight.min.js' );
$doc->addScript( JURI::root(true) . '/components/com_ztportfolio/assets/js/ztportfolio.js' );

?>
<div class="portfolio-wrap">
    <div class="portfolio-header">
        <?php if(JString::trim($sub_title) != '') : ?>
        <div class="portfolio-sub-header">
            <?php echo $sub_title ?>
        </div>
        <?php endif ?>
        <?php if($show_filter == 1) : ?>
        <div class="portfolio-header-center-right">
            <span data-filter="all" class="zt_filter filter-all active"><?php echo(JText::_('MOD_ZTPORTFOLIO_ALL_CATEGORY')); ?></span>
            <?php foreach ($tags as $tag): ?>
                <?php $class = $tag['alias']; ?>
                <?php $filter[] = $class; ?>
                <span data-filter="<?php echo $class; ?>" class="zt_filter filter-<?php echo $class; ?>"><?php echo($tag['title']); ?></span>
            <?php endforeach; ?>
        </div> 
        <?php endif ?>
    </div>
    <div class="portfolio-content row">
        <div class="portfolio-content-center">
            <?php foreach ($portfolios as $portfolio): ?>
                <?php $portfolio['ztportfolio_tag_id'] = json_decode($portfolio['ztportfolio_tag_id']); ?>
                <?php $class = array(); ?>
                <?php foreach ($portfolio['ztportfolio_tag_id'] as $id): ?>
                    <?php $portfolioTag = ModZtPortfolioHelper::getTag($id); ?>
                    <?php $class[] = $portfolioTag['alias']; ?>
                <?php endforeach; ?>
                <?php  ?> 
                <div class="<?php echo(implode(' ', $class));  ?> gird-common all col-md-<?php echo 12/$column ?>" > 
                    <div class="zt-portfolio-item">
                        <div class="zt-portfolio-thumb">
                        <a href="<?php echo(ModZtPortfolioHelper::getPortfolioUrl($portfolio)); ?>">
                            <img width="800" height="600" src="<?php echo ModZtPortfolioHelper::getUrl($portfolio['image']); ?>"  />
                        </a>
                        </div> 
                        <div class="zt-portfolio-info">
                            <h3 class="zt-portfolio-title">
                                <a href="<?php echo(ModZtPortfolioHelper::getPortfolioUrl($portfolio)); ?>"><?php echo($portfolio['title']); ?></a>
                            </h3>
                            <div class="zt-portfolio-description">   
                            <?php echo substr($portfolio['description'], 0, 90);  ?>
                            </div>
                        </div>                        
                    </div>                    
                </div>
            <?php endforeach; ?>
        </div>
    </div>
    <?php
    if($readmore == 1 && count($portfolios) < $count_portfolios){
        ?>
        <div class="text-center">
            <input type="button" value="<?php echo(JText::_('MOD_ZTPORTFOLIO_LOAD_MORE')); ?>" class="btn btn-loadmore zt_readmore" />
        </div>
        <?php
    }
    ?>
    <script type="text/javascript">
        jQuery(window).load(function () {
            var $ = jQuery;


            function bindEvent(container){
                var button_class = "active";
                
                container.isotope({
                    masonry: {
                        // use element for option
                        columnWidth: '.gird-common'
                    },
                    itemSelector: '.gird-common'
                });
                
                $('.zt_filter').click(function () {
                    container.isotope({filter: '.' + $(this).data('filter')});

                    console.log('.' + $(this).data('filter'));

                    $('.zt_filter').removeClass(button_class);

                    $(this).addClass(button_class);
                });

            }
            var container = $('.portfolio-content');
            bindEvent(container);

            var page_number = 2;
            $('.zt_readmore').click(function(){
                var $this = $(this);
                var wrap = $this.closest('.zt-portfolio');
                var number = <?php echo $number;?>;
                var count = <?php echo $count_portfolios;?>;
                $.ajax({
                    url: window.location.href,
                    data: {page: page_number},
                    type: 'POST',
                }).success(function(response){
                    
                    if(response != 'no_portfolios'){
                        var items = $(response).find('.portfolio-content .gird-common');
                        container.append(items).isotope( 'appended', items );
                        bindEvent(container);
                    }
                    if( number*page_number >=  count){
                        $this.hide(); 
                    }else {
                        page_number++;
                    }
                    
                });
            });

        });
    </script>
</div>