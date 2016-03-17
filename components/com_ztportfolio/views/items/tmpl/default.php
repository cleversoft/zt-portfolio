<?php
/**
 * @package     Zt Portfolio
 *
 * @copyright   Copyright (C) 2010 - 2015 ZooTemplate. All rights reserved.
 * @license     GNU General Public License version 2 or later.
 */

defined('_JEXEC') or die();

require_once JPATH_COMPONENT . '/helpers/helper.php';
jimport( 'joomla.filesystem.file' );
$layout_type = $this->params->get('layout_type', 'default');


//Load the method jquery script.
JHtml::_('jquery.framework');

//Params
$params 	= JComponentHelper::getParams('com_ztportfolio');
$square 	= strtolower( $params->get('square', '600x600') );
$rectangle 	= strtolower( $params->get('rectangle', '600x400') );
$tower 		= strtolower( $params->get('tower', '600x800') );

//Add js and css files
$doc = JFactory::getDocument();
$doc->addStylesheet( JURI::root(true) . '/components/com_ztportfolio/assets/css/featherlight.min.css' );
$doc->addStylesheet( JURI::root(true) . '/components/com_ztportfolio/assets/css/ztportfolio.css' );
$doc->addScript( JURI::root(true) . '/components/com_ztportfolio/assets/js/jquery.shuffle.modernizr.min.js' );
$doc->addScript( JURI::root(true) . '/components/com_ztportfolio/assets/js/featherlight.min.js' );
$doc->addScript( JURI::root(true) . '/components/com_ztportfolio/assets/js/ztportfolio.js' );

$menu 	= JFactory::getApplication()->getMenu();
$itemId = '';
if(is_object($menu->getActive())) {
	$active = $menu->getActive();
	$itemId = '&Itemid=' . $active->id;
}

if( $this->params->get('show_page_heading') && $this->params->get( 'page_heading' ) ) {
	echo "<h1 class='page-header'>" . $this->params->get( 'page_heading' ) . "</h1>";
}

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

<div id="zt-portfolio" class="zt-portfolio zt-portfolio-view-items layout-<?php echo str_replace('_', '-', $layout_type); ?>">


	<?php if($this->params->get('show_filter', 1)) { ?>
		<div class="zt-portfolio-filter">
			<ul>
				<li class="active" data-group="all"><a href="#"><?php echo JText::_('COM_ZTPORTFOLIO_SHOW_ALL'); ?></a></li>
				<?php
					$filters = ZtPortfolioHelper::getAllTags();
					foreach ($filters as $filter) {
						?>
							<li data-group="<?php echo $filter->alias; ?>"><a href="#"><?php echo $filter->title; ?></a></li>
						<?php
					}	
				?>
			</ul>
		</div>
	<?php } ?>

	<?php
		//Videos
		foreach ($this->items as $key => $this->item) {

			if($this->item->video) {
				$video = parse_url($this->item->video);

				switch($video['host']) {
					case 'youtu.be':
					$video_id 	= trim($video['path'],'/');
					$video_src 	= '//www.youtube.com/embed/' . $video_id;
					break;

					case 'www.youtube.com':
					case 'youtube.com':
					parse_str($video['query'], $query);
					$video_id 	= $query['v'];
					$video_src 	= '//www.youtube.com/embed/' . $video_id;
					break;

					case 'vimeo.com':
					case 'www.vimeo.com':
					$video_id 	= trim($video['path'],'/');
					$video_src 	= "//player.vimeo.com/video/" . $video_id;
				}

				echo '<iframe class="zt-portfolio-lightbox" src="'. $video_src .'" width="500" height="281" id="zt-portfolio-video'.$this->item->ztportfolio_item_id.'" style="border:none;" webkitallowfullscreen mozallowfullscreen allowfullscreen></iframe>';
			}
		}
	?>

	<div class="zt-portfolio-items zt-portfolio-columns-<?php echo $this->params->get('columns', 3); ?>">
		<?php foreach ($this->items as $this->item) { ?>
			
			<?php
			$tags = ZtPortfolioHelper::getTags( $this->item->ztportfolio_tag_id );
			$newtags = array();
			$filter = '';
			$groups = array();
			foreach ($tags as $tag) {
				$newtags[] 	 = $tag->title;
				$filter 	.= ' ' . $tag->alias;
				$groups[] 	.= '"' . $tag->alias . '"';
			}

			$groups = implode(',', $groups);

			?>

			<div class="zt-portfolio-item" data-groups='[<?php echo $groups; ?>]'>
				<?php $this->item->url = JRoute::_('index.php?option=com_ztportfolio&view=item&id='.$this->item->ztportfolio_item_id.':'.$this->item->alias . $itemId); ?>
				
				<div class="zt-portfolio-overlay-wrapper clearfix">
					
					<?php if($this->item->video) { ?>
						<span class="zt-portfolio-icon-video"></span>
					<?php } ?>

					<?php if($this->params->get('thumbnail_type', 'masonry') == 'masonry') { ?>
						<img class="zt-portfolio-img" src="<?php echo JURI::base(true) . '/images/ztportfolio/' . $this->item->alias . '/' . JFile::stripExt(JFile::getName($this->item->image)) . '_' . $sizes[$i] . '.' . JFile::getExt($this->item->image); ?>" alt="<?php echo $this->item->title; ?>">
					<?php } else if($this->params->get('thumbnail_type', 'masonry') == 'rectangular') { ?>
						<img class="zt-portfolio-img" src="<?php echo JURI::base(true) . '/images/ztportfolio/' . $this->item->alias . '/' . JFile::stripExt(JFile::getName($this->item->image)) . '_'. $rectangle .'.' . JFile::getExt($this->item->image); ?>" alt="<?php echo $this->item->title; ?>">
					<?php } else { ?>
						<img class="zt-portfolio-img" src="<?php echo JURI::base(true) . '/images/ztportfolio/' . $this->item->alias . '/' . JFile::stripExt(JFile::getName($this->item->image)) . '_'. $square .'.' . JFile::getExt($this->item->image); ?>" alt="<?php echo $this->item->title; ?>">
					<?php } ?>

					<div class="zt-portfolio-overlay">
						<div class="sp-vertical-middle">
							<div>
								<div class="zt-portfolio-btns">
									<?php if( $this->item->video ) { ?>
										<a class="btn-zoom" href="#" data-featherlight="#zt-portfolio-video<?php echo $this->item->ztportfolio_item_id; ?>"><?php echo JText::_('COM_ZTPORTFOLIO_WATCH'); ?></a>
									<?php } else { ?>
										<a class="btn-zoom" href="<?php echo JURI::base(true) . '/images/ztportfolio/' . $this->item->alias . '/' . JFile::stripExt(JFile::getName($this->item->image)) . '_'. $rectangle .'.' . JFile::getExt($this->item->image); ?>" data-featherlight="image"><?php echo JText::_('COM_ZTPORTFOLIO_ZOOM'); ?></a>
									<?php } ?>
									<a class="btn-view" href="<?php echo $this->item->url; ?>"><?php echo JText::_('COM_ZTPORTFOLIO_VIEW'); ?></a>
								</div>
								<?php if($layout_type!='default') { ?>
								<h3 class="zt-portfolio-title">
									<a href="<?php echo $this->item->url; ?>">
										<?php echo $this->item->title; ?>
									</a>
								</h3>
								<div class="zt-portfolio-tags">
									<?php echo implode(', ', $newtags); ?>
								</div>
								<?php } ?>
							</div>
						</div>
					</div>
				</div>
				
				<?php if($layout_type=='default') { ?>
					<div class="zt-portfolio-info">
						<h3 class="zt-portfolio-title">
							<a href="<?php echo $this->item->url; ?>">
								<?php echo $this->item->title; ?>
							</a>
						</h3>
						<div class="zt-portfolio-tags">
							<?php echo implode(', ', $newtags); ?>
						</div>
					</div>
				<?php } ?>

			</div>
			
			<?php
			$i++;
			if($i==11) {
				$i = 0;
			}
			?>

		<?php } ?>
	</div>
	<?php  $pagination = $this->params->get('pagination', 'nomal'); ?>
	<?php if ($this->pagination->get('pages.total') >1) { ?>

		<?php if($pagination  == 'nomal'){ ?>
			<div class="pagination">
				<?php echo $this->pagination->getPagesLinks(); ?>
			</div>
		<?php } ?>
		<?php if($pagination  == 'ajax'){ ?>
			<div class="text-center">
	            <a class="btn btn-loadmore zt_readmore"><?php echo(JText::_('COM_ZTPORTFOLIO_LOAD_MORE')); ?></a>
	        </div>
		<?php } ?>
	<?php } ?>
</div>

<script>
	jQuery(document).ready(function(){

	    var page_number = 1;
	    jQuery('.zt_readmore').click(function(e){
	    	e.preventDefault();

	        var $this = jQuery(this);
	        var wrap = $this.closest('.zt-portfolio');
	        var number = <?php echo $this->pagination->get('limit');?>;
	        var total = <?php echo $this->pagination->get('pages.total');?>;
	        
	        jQuery.ajax({
	            url: window.location.href,
	            data: {limitstart: page_number*number, ajax_loadmore: 1},
	            type: 'POST',
	        }).success(function(response){

	        	var container = jQuery('.zt-portfolio-items');
	            
                var items = jQuery(response).find('.zt-portfolio-items .zt-portfolio-item');

                var $sizer = container.find('.shuffle__sizer');

                container.append(items);

                container.shuffle({
					itemSelector: '.zt-portfolio-item',
					sequentialFadeDelay: 150,
					sizer: $sizer
				});

                container.shuffle('appended', items);

                
                page_number++;
	            
	            if( page_number >=  total){
	                $this.hide(); 
	            }
	        });
	    });
	});
</script>
<?php if( isset($_REQUEST['ajax_loadmore']) ) {die;} ?>
