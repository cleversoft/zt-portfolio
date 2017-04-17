<?php
$doc = JFactory::getDocument();
$doc->addStylesheet( JURI::root(true) . '/components/com_ztportfolio/assets/css/owl.carousel.min.css' );
$doc->addStylesheet( JURI::root(true) . '/components/com_ztportfolio/assets/css/owl.theme.default.min.css' );
$doc->addStylesheet( JURI::root(true) . '/components/com_ztportfolio/assets/css/ztportfolio.css' );
$doc->addScript( JURI::root(true) . '/components/com_ztportfolio/assets/js/owl.carousel.min.js' );

?>
<div class="portfolio-wrap">
  <div class="portfolio-header"> 
    <div class="portfolio-header-center-left">
      <h2><?php echo(JText::_('MOD_ZTPORTFOLIO_FEATURE_PROJECTS')); ?></h2>
    </div>
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
  <div class="portfolio-content owl-carousel owl-theme">
    <div class="portfolio-content-center">
      <?php foreach ($portfolios as $portfolio): ?>
        <?php $portfolio['ztportfolio_tag_id'] = json_decode($portfolio['ztportfolio_tag_id']); ?>
        <?php $class = $tags = array(); ?>
        <?php foreach ($portfolio['ztportfolio_tag_id'] as $id): ?>
          <?php $portfolioTag = ModZtPortfolioHelper::getTag($id); ?>
          <?php $class[] = $portfolioTag['alias']; ?>
          <?php $tags[] = $portfolioTag['title'] ?>
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
              <div class="zt-portfolio-tags">
                <?php echo(implode(' ', $tags));  ?>
              </div>
              <div class="zt-portfolio-description">   
                <?php echo substr($portfolio['description'], 0, 90);  ?>
              </div>
            </div>                        
          </div>                    
        </div>
      <?php endforeach; ?>
    </div>
  </div>
  <script type="text/javascript">
    jQuery('.portfolio-content').owlCarousel();
  </script>
</div>