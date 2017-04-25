function changeLayout(layout) {
  var dots_wrap = jQuery('#jform_params_show_dots').closest('.control-group');
  var nav_wrap = jQuery('#jform_params_show_nav').closest('.control-group');
  var auto_wrap = jQuery('#jform_params_autoplay').closest('.control-group');
  var res_wrap = jQuery('#jform_params_responsive').closest('.control-group');
  if(/slide/i.test(layout)) {
    console.log(layout);
    dots_wrap.show();
    nav_wrap.show();
    auto_wrap.show();
    res_wrap.show();
  } 
  else {
    dots_wrap.hide();
    nav_wrap.hide();
    auto_wrap.hide();
    res_wrap.hide();
  }
}