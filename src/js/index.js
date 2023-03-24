(function () {
  console.log("ready!");
  var burger = jQuery('.header__burger span'),
    body = jQuery('body'),
    nav = jQuery('.header__menu_mob'),
    minus = jQuery('.header__wcag_minus'),
    plus = jQuery('.header__wcag_plus'),
    contrast = jQuery('.header__wcag_contrast'),
    dateInput = jQuery('#datepicker');
  burger.on('click', function () {
    burger.toggleClass('active');
    nav.toggleClass('active');
    body.toggleClass('fixed-page');
  });

  // jQuery( '.menu-item-has-children a' ).on( 'click' , function (e) {
  //   jQuery( e.target ).siblings( 'ul .sub-menu' ).slideToggle( 700 );
  //   if ( jQuery( e.target ).parent().children().siblings( 'ul .sub-menu' ).css( 'display')  == 'block' ) {
  //       jQuery( e.target ).parent().siblings().children( 'ul .sub-menu' ).slideUp ( 700 )
  //       jQuery( e.target ).parent().siblings().children( 'a' ).removeClass( 'active' )
  //   }

  //   if( !jQuery( e.target ).hasClass( 'active' ) ) {
  //     jQuery( e.target ).addClass( 'active' )
  //   } else {
  //     jQuery( e.target ).removeClass( 'active' )
  //   }
  // })

  minus.on('click', function () {
    jQuery('body').removeClass('wcag_big');
  });
  plus.on('click', function () {
    jQuery('body').addClass('wcag_big');
  });
  contrast.on('click', function () {
    jQuery('body').toggleClass('wcag_contrast');
  });
  var simplepicker = new SimplePicker({
    zIndex: 10
  });
  dateInput.on('click', function (e) {
    simplepicker.open();
  });
  simplepicker.readableDate = '';
  simplepicker.on('submit', function (date, readableDate) {
    checkValueCustomSearch();
  });
  jQuery('.custom-search__items li').on('click', function (e) {
    if (jQuery(e.target).siblings().hasClass('active')) {
      jQuery(e.target).siblings().removeClass('active');
    }
    jQuery(e.target).addClass('active');
    checkValueCustomSearch();
  });
  function checkValueCustomSearch() {
    //   console.log(jQuery('.custom-search__items li.active').data('slug'),
    // simplepicker.readableDate);
    //AJAX
    jQuery.ajax({
      type: 'post',
      url: localizedObject.ajaxurl,
      data: {
        action: 'get_post_tag',
        tag: jQuery('.custom-search__items li.active').data('slug'),
        date: simplepicker.readableDate
      },
      beforeSend: function beforeSend(response) {
        // body.addClass("fixed-page");
        jQuery('#content').hide();
        jQuery('.box').addClass('active');
        jQuery('.custom-search__items li').addClass('disabled');
      },
      success: function success(response) {
        // console.log(response);
        jQuery('.box').removeClass('active');
        jQuery('.section-blog__cards').html(response).show();
        jQuery('.custom-search__items li').removeClass('disabled');
      },
      error: function error(jqXhr, textStatus, errorMessage) {
        jQuery('.box').removeClass('active');
        jQuery('.box').after('<p class="error">Something went wrong</p>');
      }
    });
  }
})(jQuery);
