<?php
$doc = JFactory::getDocument();
$doc->addStylesheet( JURI::root(true) . '/components/com_ztportfolio/assets/css/featherlight.min.css' );
$doc->addStylesheet( JURI::root(true) . '/components/com_ztportfolio/assets/css/ztportfolio.css' );
$doc->addScript( JURI::root(true) . '/components/com_ztportfolio/assets/js/jquery.shuffle.modernizr.min.js' );
$doc->addScript( JURI::root(true) . '/components/com_ztportfolio/assets/js/featherlight.min.js' );
$doc->addScript( JURI::root(true) . '/components/com_ztportfolio/assets/js/ztportfolio.js' );

?>
<div class="zt-portfolio zt-portfolio-view-items layout-default">
    <div class="zt-portfolio-filter">
        <ul>
            <li data-filter="all" class="zt_filter filter-all"><a href="#"><?php echo(JText::_('MOD_ZTPORTFOLIO_ALL_CATEGORY')); ?></a></li>
            <?php foreach ($tags as $tag): ?>
                <?php $class = $tag['alias']; ?>
                <?php $filter[] = $class; ?>
                <li data-filter="<?php echo $class; ?>" class="zt_filter filter-<?php echo $class; ?>"><a href="#"><?php echo($tag['title']); ?></a></li>
            <?php endforeach; ?> 
        </ul>
    </div>
    <div class="portfolio-content">
            <?php foreach ($portfolios as $portfolio): ?>  
            <?php $portfolio['ztportfolio_tag_id'] = json_decode($portfolio['ztportfolio_tag_id']); ?>
                                <?php $class = array(); ?>
                                <?php foreach ($portfolio['ztportfolio_tag_id'] as $id): ?>
                                    <?php $portfolioTag = ModZtPortfolioHelper::getTag($id); ?> 
                                    <?php $class[] = $portfolioTag['alias']; ?>
                                <?php endforeach; ?>
                <div class="<?php echo(implode(' ', $class));  ?> gird-common all col-md-<?php echo 12/$column ?>" > 
                     <div class="zt-portfolio-item">
                        <div class="zt-portfolio-overlay-wrapper clearfix">
                            <img class="zt-portfolio-img" src="<?php echo ModZtPortfolioHelper::getUrl($portfolio['image']); ?>"  />
                            <div class="zt-portfolio-overlay">
                                <div class="sp-vertical-middle">
                                    <div class="zt-portfolio-btns">
                                        <a class="btn-zoom" href="<?php echo ModZtPortfolioHelper::getUrl($portfolio['image']); ?>" data-featherlight="image">Zoom</a>
                                        <a class="btn-view" href="<?php echo ModZtPortfolioHelper::getPortfolioUrl($portfolio); ?>">View</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="zt-portfolio-info">
                            <h3 class="zt-portfolio-title">
                                <a href="<?php echo(ModZtPortfolioHelper::getPortfolioUrl($portfolio)); ?>"><?php echo($portfolio['title']); ?></a>
                            </h3>
                            <div class="zt-portfolio-tags">   
                            <?php echo(implode(' ', $class));  ?>
                            </div>
                        </div>
                    </div>                    
                </div>
            <?php endforeach; ?> 
    </div>
    <?php
    if($readmore == 1 && count($portfolios) < $count_portfolios){
        ?>
        <input type="button" value="Read more" class="zt_readmore">
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