jQuery(document).ready(function($) {


/*
* Mobile menu
*/

//Mobile Menu Button hide on JS
$('.menu-simplenav-container').addClass('js-menu-holder');
$('.js-menu-holder').addClass('is-hidden');
$('.mobile-nav-expand').addClass('js');
$('.mobile-nav-expand a').click(function() {
  if (!$('.js-menu-holder').hasClass('is-open')) {
    $('.js-menu-holder').removeClass('is-hidden');
    $('.js-menu-holder').addClass('is-open');
    $('.js-menu-holder').fadeIn('fast');
    console.log('open')
  } else {
      $('.js-menu-holder').fadeOut('fast');
      $('.js-menu-holder').removeClass('is-open');
      console.log('close');
  }
}); //end mobile menu toggle


});
