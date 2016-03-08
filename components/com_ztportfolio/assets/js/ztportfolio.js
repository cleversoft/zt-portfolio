/**
 * @package     Zt Portfolio
 *
 * @copyright   Copyright (C) 2010 - 2015 ZooTemplate. All rights reserved.
 * @license     GNU General Public License version 2 or later.
 */

jQuery(function($) {

	var $container 	= $('.zt-portfolio-items');
	
	$(window).load(function() {
		var $sizer = $container.find('.shuffle__sizer');

		$container.shuffle({
			itemSelector: '.zt-portfolio-item',
			sequentialFadeDelay: 150,
			sizer: $sizer
		});
	});


	// Filters
	$('.zt-portfolio-filter li a').on('click', function(event){
		event.preventDefault();
		var $self = $(this);
		var $this = $(this).parent();
		
		if($this.hasClass('active')) {
			return;
		}

		$self.closest('ul').children().removeClass('active');
		$self.parent().addClass('active');

		$container.shuffle( 'shuffle', $this.data('group') );
	});

});

