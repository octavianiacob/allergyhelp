jQuery(document).ready(function ($) {

  // Fixed Header
  $(window).scroll(function () {
    if ($(this).scrollTop() > 800) {
      $('#header').addClass('header-fixed');
    } else {
      $('#header').removeClass('header-fixed');
    }
  });
});