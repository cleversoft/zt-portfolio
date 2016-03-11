<?php


//echo '<pre>';
//print_r($portfolios);
//die;
?>
<div class="portfolio-wrap">
<div class="portfolio-wrap">
    <div class="portfolio-header">
        <div class="portfolio-header-center">
            <div class="portfolio-header-center-left">
                <div class="portfolio-header-center-left-title"><?php echo(JText::_('MOD_ZTPORTFOLIO_ALL_CATEGORY')); ?></div>
            </div>
            <div class="portfolio-header-center-right">
                <div data-filter="all" class="zt_filter filter-all"><?php echo(JText::_('MOD_ZTPORTFOLIO_ALL_CATEGORY')); ?></div>
                <?php foreach ($tags as $tag): ?>
                    <?php $class = $tag['alias']; ?>
                    <?php $filter[] = $class; ?>
                    <div data-filter="<?php echo $class; ?>" class="zt_filter filter-<?php echo $class; ?>"><?php echo($tag['title']); ?></div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
    <div class="portfolio-content">
            <?php foreach ($portfolios as $portfolio): ?>
                <?php $portfolio['ztportfolio_tag_id'] = json_decode($portfolio['ztportfolio_tag_id']); ?>
                <?php $class = array(); ?>
                <?php foreach ($portfolio['ztportfolio_tag_id'] as $id): ?>
                    <?php $portfolioTag = ModZtPortfolioHelper::getTag($id); ?>
                    <?php $class[] = $portfolioTag['alias']; ?>
                <?php endforeach; ?>
                <?php  ?>
                <div class="<?php echo(implode(' ', $class));  ?> gird-common all" style="background-image: url('<?php echo ModZtPortfolioHelper::getUrl($portfolio['image']); ?>');">
                    <a href="<?php echo(ModZtPortfolioHelper::getPortfolioUrl($portfolio)); ?>"><?php echo($portfolio['title']); ?></a>
                    <div><?php echo($portfolio['url']); ?></div>
                    <div><?php //echo($portfolio['description']); ?></div>
                    <div><?php echo($portfolio['video']); ?></div>
                </div>
            <?php endforeach; ?>
    </div>
    <?php
    if($readmore == '1' && count($portfolios) == $number){
        ?>
        <input type="button" value="Read more" data-page="<?php echo $page; ?>" class="zt_readmore">
        <?php
    }
    ?>
</div>
<script type="text/javascript">
    jQuery(window).load(function () {
        var $ = jQuery;
        $('.portfolio-content-center').masonry({
            columnWidth: 200,
            itemSelector: '.gird-common'
        });
        var button_class = "portfolio-header-center-right-links-current";
        var $container = $('.portfolio-content-center');
        
        $('.zt_filter').click(function () {
            $container.isotope({filter: '.' + $(this).data('filter')});
            console.log('.' + $(this).data('filter'));
            $('.portfolio-header-center-right-links').removeClass(button_class);
            $(this).addClass(button_class);
            $container.isotope();
        });

        var page_number = 2;
        $('.zt_readmore').click(function(){
            var $this = $(this);
            var wrap = $this.closest('.portfolio-wrap');
            $.ajax({
                url: window.location.href,
                data: {page: page_number},
                type: 'POST',
            }).success(function(response){
                page_number++;
                if(response != 'no_portfolios'){
                    wrap.find('.portfolio-content').append($(response).find('.portfolio-content').html());
                }else{
                    $this.hide(); 
                }
                
            });
        });

    });
</script>

