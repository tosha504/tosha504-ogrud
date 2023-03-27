( function () {
    console.log( "ready!" );
    const burger = jQuery( '.header__burger span' ),
    body = jQuery( 'body' ),
    nav = jQuery( '.header__menu_mob' ),
    minus = jQuery( '.header__wcag_minus' ),
    plus = jQuery( '.header__wcag_plus' ),
    contrast = jQuery( '.header__wcag_contrast' ),
    dateInput = jQuery('#datepicker');
    
    burger.on( 'click', function ( ) {
      burger.toggleClass( 'active' );
      nav.toggleClass( 'active' );
      body.toggleClass( 'fixed-page' );
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

    minus.on( 'click', function () {
      jQuery( 'body' ).removeClass( 'wcag_big' )
      setCookie('fontSizeWcag', false, 7);
    })

    if(getCookie('fontSizeWcag') == 'true') {
      jQuery( 'body' ).addClass( 'wcag_big' );
      
    }

    plus.on( 'click', function () {
      jQuery( 'body' ).addClass( 'wcag_big' );
      setCookie('fontSizeWcag', true, 7);
    })
   
    if(getCookie('wcagContrast') == 'true') {
      jQuery( 'body' ).addClass( 'wcag_contrast' );
    }
    contrast.on( 'click', function () {
      if(getCookie('wcagContrast') == 'true') {
        setCookie('wcagContrast', false, 7)
        jQuery( 'body' ).removeClass( 'wcag_contrast' );
      } else {
        jQuery( 'body' ).addClass( 'wcag_contrast' );
        setCookie('wcagContrast', true, 7)
      }
    })

    let simplepicker = new SimplePicker({
      zIndex: 10
    });

    dateInput.on('click', (e) => {
      simplepicker.open();
    });
    simplepicker.readableDate = '';

    simplepicker.on('submit', (date, readableDate) => {
      checkValueCustomSearch()
    });
    
    jQuery('.custom-search__items li').on('click', function (e) {
      if( jQuery(window).width() < 576 ) {
        const target = jQuery('#content');
        jQuery("html, body").animate({ scrollTop: jQuery(target).offset().top }, 1000);       
      }
      
      if(jQuery(e.target).siblings().hasClass('active')) {
        jQuery(e.target).siblings().removeClass('active')
      }
      jQuery(e.target).addClass('active');
      checkValueCustomSearch()
    })

  function checkValueCustomSearch() {
  //   console.log(jQuery('.custom-search__items li.active').data('slug'),
  // simplepicker.readableDate);
    //AJAX
    jQuery.ajax({
      type: 'post',
      url: localizedObject.ajaxurl,
      data: {
        action: 'get_post_tag',
        tag:  jQuery('.custom-search__items li.active').data('slug'),
        date: simplepicker.readableDate,
      },
      beforeSend: function (response) {
        // body.addClass("fixed-page");
        jQuery('#content').hide();
        jQuery('.box').addClass('active')
        jQuery('.custom-search__items li').addClass('disabled') 
      },
      success: function(response) {
        // console.log(response);
        jQuery('.box').removeClass('active')
        jQuery('.section-blog__cards').html(response).show();
        jQuery('.custom-search__items li').removeClass('disabled') 
      },
      error: function (jqXhr, textStatus, errorMessage) {
        jQuery('.box').removeClass('active')
        jQuery('.box').after('<p class="error">Something went wrong</p>');
      }
              
    });
  }

  // setTimeout(function(){
  if( getCookie('popupCookie') != 'submited'){ 
    jQuery('.cookies').css("display", "block").hide().fadeIn(2000);
  }
        
  jQuery('a.submit').click(function(){
    jQuery('.cookies').fadeOut();
    //sets the coookie to five minutes if the popup is submited (whole numbers = days)
    setCookie( 'popupCookie', 'submited', 7 );
  });
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
      d.setTime(d.getTime() + (exdays * 24 * 60 * 60 * 1000));
      var expires = "expires=" + d.toUTCString();
      document.cookie = cname + "=" + cvalue + ";" + expires + ";path=/";
    }
	// }, 5000);

  
})( jQuery );
 

