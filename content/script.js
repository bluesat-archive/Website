/**
 * @file
 * A JavaScript file for the theme.
 *
 * In order for this JavaScript to be loaded on pages, see the instructions in
 * the README.txt next to this file.
 */

// JavaScript should be made compatible with libraries other than jQuery by
// wrapping it with an "anonymous closure". See:
// - https://drupal.org/node/1446420
// - http://www.adequatelygood.com/2010/3/JavaScript-Module-Pattern-In-Depth
jQuery(document).ready(function(){
  /* Print button in footer */
  jQuery('a.print').click(function(e){
    e.preventDefault();
    w = window.open(this.href);
    w.print();
  });
  
  jQuery('.accordion-handle').nextUntil('hr').hide();
    jQuery('.accordion-handle').click(function() {
    jQuery(this).nextUntil('hr').slideToggle();
    jQuery(this).toggleClass('expanded');
  });

  // display image caption under images in content area
  jQuery("#main #content .field-name-field-news-body img").each(function() {
    var imageCaption = jQuery(this).attr("alt");

    if (imageCaption != '' && typeof imageCaption !== 'undefined') {
      var imgWidth = jQuery(this).attr('width');
      style = jQuery(this).attr('style');
      // needs same style as the image plus a clear both
      jQuery(this).after('<div class="img-caption" style="clear: both; width: ' + imgWidth + 'px; ' + style + '">'+ imageCaption +'</div>');
    }   
  });

  //jQuery('#views_slideshow_cycle_teaser_section_front_page_slideshow-block').cycle('pause');
  //jQuery('#views_slideshow_cycle_div_front_page_slideshow-block_0').cycle('pause');
  //jQuery('#views_slideshow_cycle_div_front_page_slideshow-block_1').cycle('pause');
  //jQuery('#views_slideshow_cycle_div_front_page_slideshow-block_2').cycle('pause');

  /* Make sure this is the ID of the menu you want to be responsive */
  //jQuery('#nice-menu-1').slicknav();
  

});