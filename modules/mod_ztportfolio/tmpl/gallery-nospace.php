<?php

$doc = JFactory::getDocument();
$doc->addStylesheet( JURI::root(true) . '/components/com_ztportfolio/assets/css/featherlight.min.css' );
$doc->addStylesheet( JURI::root(true) . '/components/com_ztportfolio/assets/css/ztportfolio.css' );
$doc->addScript( JURI::root(true) . '/components/com_ztportfolio/assets/js/jquery.shuffle.modernizr.min.js' );
$doc->addScript( JURI::root(true) . '/components/com_ztportfolio/assets/js/featherlight.min.js' );
$doc->addScript( JURI::root(true) . '/components/com_ztportfolio/assets/js/ztportfolio.js' );

//Params
$zparams     = JComponentHelper::getParams('com_ztportfolio');
$square     = strtolower( $zparams->get('square', '600x600') );
$rectangle  = strtolower( $zparams->get('rectangle', '600x400') );
$tower      = strtolower( $zparams->get('tower', '600x800') );

$i = 0;
//Sizes
$sizes = array(
    $rectangle,
    $tower,
    $square,

    $tower,
    $rectangle,
    $square,

    $square,
    $rectangle,
    $tower,

    $square,
    $tower,
    $rectangle
);

?>
<div class="zt-portfolio layout-gallery-nospace">
    <div class="zt-portfolio-header"> 
        <?php if(JString::trim($sub_title) != '') : ?>
        <div class="portfolio-sub-header">
            <?php echo $sub_title ?>
        </div>
        <?php endif ?>
        <?php if($show_filter == 1) : ?>
        <div class="zt-portfolio-filter">
            <ul>
                <li class="zt_filter filter-all active" data-filter="all"><span><?php echo JText::_('MOD_ZTPORTFOLIO_ALL_CATEGORY'); ?></span></li>
                <?php
                foreach ($tags as $tag) {
                    $class = $tag['alias'];
                    $filter[] = $class; 
                ?>
                <li data-filter="<?php echo $class; ?>" class="zt_filter filter-<?php echo $class; ?>"><span><?php echo($tag['title']); ?></span></li>
                <?php
                }   
                ?>
            </ul>
        </div> 
        <?php endif ?> 
    </div>
    <div class="portfolio-content zt-portfolio-column-<?php echo $column ?>">
        <?php foreach ($portfolios as $portfolio): ?>
            <?php $portfolio['ztportfolio_tag_id'] = json_decode($portfolio['ztportfolio_tag_id']); ?>
            <?php $class = $tags = array(); ?>
            <?php foreach ($portfolio['ztportfolio_tag_id'] as $id): ?>
                <?php $portfolioTag = ModZtPortfolioHelper::getTag($id); ?>
                <?php $class[] = $portfolioTag['alias']; ?>
                <?php $tags[] = $portfolioTag['title'] ?>
            <?php endforeach; ?>
            <?php 
                if($thumbnail_type == 'masonry') {
                    $src = JURI::base(true) . '/images/ztportfolio/' . $portfolio['alias'] . '/' . JFile::stripExt(JFile::getName($portfolio['image'])) . '_' . $sizes[$i] . '.' . JFile::getExt($portfolio['image']);
                    $alt = $portfolio['title'];
                } else if($thumbnail_type == 'rectangle') {
                    $src = JURI::base(true) . '/images/ztportfolio/' . $portfolio['alias'] . '/' . JFile::stripExt(JFile::getName($portfolio['image'])) . '_'. $rectangle .'.' . JFile::getExt($portfolio['image']);
                    $alt = $portfolio['title'];
                } else {
                    $src = JURI::base(true) . '/images/ztportfolio/' . $portfolio['alias'] . '/' . JFile::stripExt(JFile::getName($portfolio['image'])) . '_'. $square .'.' . JFile::getExt($portfolio['image']);
                    $alt = $portfolio['title'];
                } 
            ?>
            <div class="zt-portfolio-item <?php echo(implode(' ', $class));  ?> gird-common all"> 
                <div class="zt-portfolio-overlay-wrapper">
                    <div class="zt-portfolio-thumb">
                        <img class="zt-portfolio-img" src="<?php echo $src; ?>" alt="<?php echo $alt ?>">
                    </div> 
                    <div class="zt-portfolio-overlay">
                        <div>
                            <h3 class="zt-portfolio-title">
                                <a href="<?php echo JRoute::_('index.php?option=com_ztportfolio&view=item&id='.$portfolio['ztportfolio_item_id'].':'.$portfolio['alias']) ?>"><?php echo($portfolio['title']); ?></a>
                            </h3>
                            <?php if($show_tags == 1) : ?>
                            <div class="zt-portfolio-tags">
                                <?php echo(implode(' ', $tags));  ?>
                            </div>
                            <?php endif ?>
                            <?php if($show_desc == 1) : ?>
                                <div class="zt-portfolio-description"> 
                                <?php if($desc_limit == '') : ?>
                                <?php echo JText::_($portfolio['description']) ?>
                                <?php else : ?>
                                <?php echo substr($portfolio['description'], 0, $desc_limit);  ?>
                                <?php endif ?>
                                </div>
                            <?php endif ?>
                            <div class="zt-portfolio-btns">
                                <a href="<?php echo $src ?>" data-featherlight="image"><i class="fa fa-search"></i></a>
                                <a href="<?php echo JRoute::_('index.php?option=com_ztportfolio&view=item&id='.$portfolio['ztportfolio_item_id'].':'.$portfolio['alias']) ?>"><i class="fa fa-link"></i></a>
                            </div>
                        </div>
                    </div>                        
                </div>
            </div>
            <?php
            $i++;
            if($i==11) {
                $i = 0;
            }
            ?>
        <?php endforeach; ?>
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
                    $('.zt_filter').removeClass(button_class);
                    $(this).addClass(button_class);
                });

            }
            var container = $('.portfolio-content');
            bindEvent(container);

            var page_number = 2;
            $('.zt_readmore').click(function(){
                var $this = $(this);
                var wrap = $this.closest('.portfolio-wrap');
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