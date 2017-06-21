<?php
$doc = JFactory::getDocument();
$doc->addStylesheet( JURI::root(true) . '/components/com_ztportfolio/assets/css/owl.carousel.min.css' );
$doc->addStylesheet( JURI::root(true) . '/components/com_ztportfolio/assets/css/owl.theme.default.min.css' );
$doc->addStylesheet( JURI::root(true) . '/components/com_ztportfolio/assets/css/ztportfolio.css' );
$doc->addScript( JURI::root(true) . '/components/com_ztportfolio/assets/js/owl.carousel.min.js' );

//Params
$zparams     = JComponentHelper::getParams('com_ztportfolio');
$square     = strtolower( $zparams->get('quare', '600x600') );
$rectangle  = strtolower( $zparams->get('rectangle', '600x400') );
$tower      = strtolower( $zparams->get('tall', '600x800') );

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
  <div class="portfolio-content">
    <div class="portfolio-content-center owl-carousel owl-theme">
      <?php foreach ($portfolios as $portfolio): ?>
        <?php $portfolio['ztportfolio_tag_id'] = json_decode($portfolio['ztportfolio_tag_id']); ?>
        <?php $class = $tags = array(); ?>
        <?php foreach ($portfolio['ztportfolio_tag_id'] as $id): ?>
          <?php $portfolioTag = ModZtPortfolioHelper::getTag($id); ?>
          <?php $class[] = $portfolioTag['alias']; ?>
          <?php $tags[] = $portfolioTag['title'] ?>
        <?php endforeach; ?>
        <?php  ?> 
        <div class="zt-portfolio-item">
          <div class="zt-portfolio-thumb">
            <a href="<?php echo JRoute::_('index.php?option=com_ztportfolio&view=item&id='.$portfolio['ztportfolio_item_id'].':'.$portfolio['alias']) ?>">
              <?php if($thumbnail_type == 'masonry') { ?>
                <img class="zt-portfolio-img" src="<?php echo JURI::base(true) . '/images/ztportfolio/' . $portfolio['alias'] . '/' . JFile::stripExt(JFile::getName($portfolio['image'])) . '_' . $sizes[$i] . '.' . JFile::getExt($portfolio['image']); ?>" alt="<?php echo $portfolio['title'] ?>">
              <?php } else if($thumbnail_type == 'rectangle') { ?>
                <img class="zt-portfolio-img" src="<?php echo JURI::base(true) . '/images/ztportfolio/' . $portfolio['alias'] . '/' . JFile::stripExt(JFile::getName($portfolio['image'])) . '_'. $rectangle .'.' . JFile::getExt($portfolio['image']); ?>" alt="<?php echo $portfolio['title'] ?>">
              <?php } else { ?>
                <img class="zt-portfolio-img" src="<?php echo JURI::base(true) . '/images/ztportfolio/' . $portfolio['alias'] . '/' . JFile::stripExt(JFile::getName($portfolio['image'])) . '_'. $square .'.' . JFile::getExt($portfolio['image']); ?>" alt="<?php echo $portfolio['title'] ?>">
              <?php } ?>
            </a>
          </div> 
          <div class="zt-portfolio-info">
            <h3 class="zt-portfolio-title">
              <a href="<?php echo(ModZtPortfolioHelper::getPortfolioUrl($portfolio)); ?>"><?php echo($portfolio['title']); ?></a>
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
          </div>                        
        </div>                    
      <?php endforeach; ?>
    </div>
  </div>
  <script type="text/javascript">
    jQuery('.portfolio-content-center').owlCarousel({
      nav: <?php echo $show_nav == 1 ? 'true' : 'false' ?>,
      dots: <?php echo $show_dots == 1 ? 'true' : 'false' ?>,
      autoplay: <?php echo $autoplay == 1 ? 'true' : 'false' ?>,
      <?php if($responsive == 1) : ?>
      responsive: {
        0: {
          items: 1
        },
        480: {
          items: 2
        },
        768: {
          items: <?php echo $column ?>
        }
      }
      <?php else : ?>
      items: <?php echo $column ?>
      <?php endif ?>
    });
  </script>
</div>