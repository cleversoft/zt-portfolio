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
<div class="zt-portfolio layout-slider">
  <div class="portfolio-header">
    <?php if(JString::trim($sub_title) != '') : ?>
      <div class="portfolio-sub-header">
        <?php echo $sub_title ?>
      </div>
    <?php endif ?>
  </div>
  <div class="portfolio-content owl-carousel owl-theme">
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
      <div class="zt-portfolio-item"> 
        <div class="zt-portfolio-overlay-wrapper">
          <div class="zt-portfolio-thumb">
            <img class="zt-portfolio-img" src="<?php echo $src; ?>" alt="<?php echo $alt ?>">
          </div> 
          <div class="zt-portfolio-overlay">
            <div>
              <div class="zt-portfolio-btns">
                <a href="<?php echo $src ?>" data-featherlight="image"><i class="fa fa-search"></i></a>
                <a href="<?php echo JRoute::_('index.php?option=com_ztportfolio&view=item&id='.$portfolio['ztportfolio_item_id'].':'.$portfolio['alias']) ?>"><i class="fa fa-link"></i></a>
              </div>
            </div>
          </div>
        </div>
        <div class="zt-portfolio-info">
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
  <script type="text/javascript">
    jQuery('.layout-slider .portfolio-content').owlCarousel({
      nav: <?php echo $show_nav == 1 ? 'true' : 'false' ?>,
      dots: <?php echo $show_dots == 1 ? 'true' : 'false' ?>,
      autoplay: <?php echo $autoplay == 1 ? 'true' : 'false' ?>,
      margin: <?php echo $space ?>,
      responsive: {
        0: {
          items: <?php echo $mobile_items ?>
        },
        768: {
          items: <?php echo $tablet_items ?>
        },
        1024: {
          items: <?php echo $column ?>
        }
      }
    });
  </script>
</div>