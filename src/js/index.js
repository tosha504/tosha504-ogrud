(function () {
  var burger = jQuery('.header__burger span'),
    body = jQuery('body'),
    nav = jQuery('.header__nav'),
    minus = jQuery('.header__wcag_minus'),
    plus = jQuery('.header__wcag_plus'),
    contrast = jQuery('.header__wcag_contrast'),
    dateInput = jQuery('#datepicker');
  burger.on('click', function () {
    burger.toggleClass('active');
    nav.toggleClass('active');
    body.toggleClass('fixed-page');
  });
  function mobNavMenu() {
    jQuery('.menu-item-has-children').on('click', function (e) {
      jQuery(e.target).siblings('ul .sub-menu').slideToggle(700);
      if (jQuery(e.target).parent().children().siblings('ul .sub-menu').css('display') == 'block') {
        jQuery(e.target).parent().siblings().children('ul .sub-menu').slideUp(700);
        jQuery(e.target).parent().siblings().children('a').removeClass('active');
      }
      if (!jQuery(e.target).hasClass('active')) {
        jQuery(e.target).addClass('active');
      } else {
        jQuery(e.target).removeClass('active');
      }
    });
  }
  function debounce(func, delay) {
    var timer;
    return function () {
      clearTimeout(timer);
      timer = setTimeout(func, delay);
    };
  }
  if (jQuery(window).width() < 1200) {
    mobNavMenu();
  }
  jQuery(window).on('resize', debounce(function () {
    if (jQuery(window).width() < 1200) {
      mobNavMenu();
    }
  }, 250));
  minus.on('click', function () {
    jQuery('body').removeClass('wcag_big');
    setCookie('fontSizeWcag', false, 7);
  });
  if (getCookie('fontSizeWcag') == 'true') {
    jQuery('body').addClass('wcag_big');
  }
  plus.on('click', function () {
    jQuery('body').addClass('wcag_big');
    setCookie('fontSizeWcag', true, 7);
  });
  if (getCookie('wcagContrast') == 'true') {
    jQuery('body').addClass('wcag_contrast');
  }
  contrast.on('click', function () {
    if (getCookie('wcagContrast') == 'true') {
      setCookie('wcagContrast', false, 7);
      jQuery('body').removeClass('wcag_contrast');
    } else {
      jQuery('body').addClass('wcag_contrast');
      setCookie('wcagContrast', true, 7);
    }
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
    if (jQuery(window).width() < 576) {
      var target = jQuery('#content');
      jQuery("html, body").animate({
        scrollTop: jQuery(target).offset().top
      }, 1000);
    }
    if (jQuery(e.target).siblings().hasClass('active')) {
      jQuery(e.target).siblings().removeClass('active');
    }
    jQuery(e.target).addClass('active');
    checkValueCustomSearch();
  });
  function checkValueCustomSearch() {
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
  setTimeout(function () {
    if (getCookie('popupCookie') != 'submited') {
      jQuery('.cookies').css("display", "block").hide().fadeIn(2000);
    }
    jQuery('a.submit').click(function () {
      jQuery('.cookies').fadeOut();
      //sets the coookie to five minutes if the popup is submited (whole numbers = days)
      setCookie('popupCookie', 'submited', 7);
    });
  }, 5000);
  function getCookie(cname) {
    var name = cname + "=";
    var ca = document.cookie.split(';');
    for (var i = 0; i < ca.length; i++) {
      var c = ca[i];
      while (c.charAt(0) == ' ') {
        c = c.substring(1);
      }
      if (c.indexOf(name) == 0) {
        return c.substring(name.length, c.length);
      }
    }
    return "";
  }
  function setCookie(cname, cvalue, exdays) {
    var d = new Date();
    d.setTime(d.getTime() + exdays * 24 * 60 * 60 * 1000);
    var expires = "expires=" + d.toUTCString();
    document.cookie = cname + "=" + cvalue + ";" + expires + ";path=/";
  }
})(jQuery);
