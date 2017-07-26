function changeLayout(layout) {
  var nav_option = jQuery('a[href$="#attrib-options"]').closest('li');
  var filter = jQuery('#jform_params_show_filter').closest('.control-group');
  if(/slide/i.test(layout)) {
    nav_option.show();
    filter.hide();
  } 
  else {
    nav_option.hide();
    filter.show(); 
  }
}