
// slider
jQuery(document).ready(function() {
  jQuery('.tp-banner').show().revolution({
    dottedOverlay: "none",
    delay: 16000,
    startwidth: 1170,
    startheight: 540,
    hideThumbs: 200,
    thumbWidth: 100,
    thumbHeight: 50,
    thumbAmount: 5,
    navigationType: "bullet",
    navigationArrows: "solo",
    navigationStyle: "preview1",
    touchenabled: "on",
    onHoverStop: "on",
    swipe_velocity: 0.7,
    swipe_min_touches: 1,
    swipe_max_touches: 1,
    drag_block_vertical: false,
    parallax: "mouse",
    parallaxBgFreeze: "on",
    parallaxLevels: [7, 4, 3, 2, 5, 4, 3, 2, 1, 0],
    keyboardNavigation: "off",
    navigationHAlign: "center",
    navigationVAlign: "bottom",
    navigationHOffset: 0,
    navigationVOffset: 20,
    soloArrowLeftHalign: "left",
    soloArrowLeftValign: "center",
    soloArrowLeftHOffset: 20,
    soloArrowLeftVOffset: 0,
    soloArrowRightHalign: "right",
    soloArrowRightValign: "center",
    soloArrowRightHOffset: 20,
    soloArrowRightVOffset: 0,
    shadow: 0,
    fullWidth: "on",
    fullScreen: "off",
    spinner: "spinner2",
    stopLoop: "off",
    stopAfterLoops: -1,
    stopAtSlide: -1,
    shuffle: "off",
    autoHeight: "off",
    forceFullWidth: "off",
    hideThumbsOnMobile: "off",
    hideNavDelayOnMobile: 1500,
    hideBulletsOnMobile: "off",
    hideArrowsOnMobile: "off",
    hideThumbsUnderResolution: 0,
    hideSliderAtLimit: 0,
    hideCaptionAtLimit: 0,
    hideAllCaptionAtLilmit: 0,
    startWithSlide: 0,
    videoJsPath: "rs-plugin/videojs/",
    fullScreenOffsetContainer: ""
  });
}); 

// Page Loader
jQuery(window).load(function() {
  "use strict";
  jQuery('#loader').fadeOut();
});

jQuery(document).ready(function(jQuery) {
  "use strict";
  ////	Hidder Header
  var headerEle = function() {
    var jQueryheaderHeight = jQuery('header').outerHeight();
    jQuery('.hidden-header').css({
      'height': parseInt( jQueryheaderHeight ) + "px"
    });
	 jQuery('#container').find( 'header' ).eq(0).css({
		 'top': jQuery('#wpadminbar').height() + 'px'
	 });
  };
  
  jQuery(window).load(function() {
    headerEle();
  });
  jQuery(window).resize(function() {
    headerEle();
  });
  
  

  // Progress Bar
  jQuery('.skill-shortcode').appear(function() {
    jQuery('.progress').each(function() {
      jQuery('.progress-bar').css('width', function() {
        return (jQuery(this).attr('data-percentage') + '%')
      });
    });
  }, {
    accY: -100
  });
  
  // Counter
  
  jQuery('.timer').countTo();
  jQuery('.counter-item').appear(function() {
    jQuery('.timer').countTo();
  }, {
    accY: -100
  }); 
  
  // Nav Menu & Search

  jQuery(".nav > li:has(ul)").addClass("drop");
  jQuery(".nav > li.drop > ul").addClass("dropdown");
  jQuery(".nav > li.drop > ul.dropdown ul").addClass("sup-dropdown");
  
  jQuery('.show-search').click(function() {
    jQuery('.full-search').fadeIn(300);
    jQuery('.full-search input').focus();
  });
  jQuery('.full-search input').blur(function() {
    jQuery('.full-search').fadeOut(300);
  });
  
  //	Back Top Link
  var offset = 200;
  var duration = 500;
  jQuery(window).scroll(function() {
    if (jQuery(this).scrollTop() > offset) {
      jQuery('.back-to-top').fadeIn(400);
    } else {
      jQuery('.back-to-top').fadeOut(400);
    }
  });
  jQuery('.back-to-top').click(function(event) {
    event.preventDefault();
    jQuery('html, body').animate({
      scrollTop: 0
    }, 600);
    return false;
  })

  //	Sliders & Carousel
	
  // Touch Slider
  var time = 4.4,
    jQueryprogressBar,
    jQuerybar,
    jQueryelem,
    isPause,
    tick,
    percentTime;
  jQuery('.touch-slider').each(function() {
    var owl = jQuery(this),
      sliderNav = jQuery(this).attr('data-slider-navigation'),
      sliderPag = jQuery(this).attr('data-slider-pagination'),
      sliderProgressBar = jQuery(this).attr('data-slider-progress-bar');
    if (sliderNav == 'false' || sliderNav == '0') {
      var returnSliderNav = false
    } else {
      var returnSliderNav = true
    }
    if (sliderPag == 'true' || sliderPag == '1') {
      var returnSliderPag = true
    } else {
      var returnSliderPag = false
    }
    if (sliderProgressBar == 'true' || sliderProgressBar == '1') {
      var returnSliderProgressBar = progressBar
      var returnAutoPlay = false
    } else {
      var returnSliderProgressBar = false
      var returnAutoPlay = true
    }

    owl.owlCarousel({
      navigation: returnSliderNav,
      pagination: returnSliderPag,
      slideSpeed: 400,
      paginationSpeed: 400,
      lazyLoad: true,
      singleItem: true,
      autoHeight: true,
      autoPlay: returnAutoPlay,
      stopOnHover: returnAutoPlay,
      transitionStyle: "fade",
      afterInit: returnSliderProgressBar,
      startDragging: pauseOnDragging
    });
  });

  function progressBar(elem) {
    jQueryelem = elem;
    buildProgressBar();
    start();
  }

  function buildProgressBar() {
    jQueryprogressBar = jQuery("<div>", {
      id: "progressBar"
    });
    jQuerybar = jQuery("<div>", {
      id: "bar"
    });
    jQueryprogressBar.append(jQuerybar).prependTo(jQueryelem);
  }


  function pauseOnDragging() {
    isPause = true;
  }

  // Projects Carousel
  jQuery("#projects-carousel").owlCarousel({
    navigation : true,
    pagination: false,
    slideSpeed : 400,
    stopOnHover: true,
    autoPlay: 3000,
    items : 4,
    itemsDesktopSmall : [900,3],
    itemsTablet: [640,2],
    itemsMobile : [480, 1]
  });
  // Projects Carousel 2
  jQuery("#projects-carousel-2").owlCarousel({
    navigation : true,
    pagination: false,
    slideSpeed : 400,
    stopOnHover: true,
    autoPlay: 3000,
    items : 4,
    itemsDesktopSmall : [900,3],
    itemsTablet: [640,2],
    itemsMobile : [480, 1]
  });

  

  //Testimonials Carousel
  jQuery(".testimonials-carousel").owlCarousel({
    navigation: false,
    pagination: true,
    slideSpeed: 1000,
    stopOnHover: true,
    autoPlay: true,
    items: 2,
    itemsDesktopSmall: [1024, 2],
    itemsTablet: [600, 1],
    itemsMobile: [479, 1]
  });

  jQuery(".content-slider").owlCarousel({
    navigation: false,
    pagination: true,
    slideSpeed: 1000,
    stopOnHover: true,
    autoPlay: true,
    items: 1,
    itemsDesktop: [1024, 1],
    itemsDesktopSmall: [768, 2],
    itemsTablet: [600, 1],
    itemsMobile: [479, 1]
  });

  // Touch Carousel
  jQuery(".touch-slider").owlCarousel({
    navigation: true,
    pagination: true,
    slideSpeed: 2500,
    stopOnHover: true,
    autoPlay: 3000,
    singleItem: true,
    autoHeight: true,
    transitionStyle: "fade"
  });

  // Custom Carousel
  jQuery('.custom-carousel').each(function() {
    var owl = jQuery(this),
      itemsNum = jQuery(this).attr('data-appeared-items'),
      sliderNavigation = jQuery(this).attr('data-navigation');
    if (sliderNavigation == 'false' || sliderNavigation == '0') {
      var returnSliderNavigation = false
    } else {
      var returnSliderNavigation = true
    }
    if (itemsNum == 1) {
      var deskitemsNum = 1;
      var desksmallitemsNum = 1;
      var tabletitemsNum = 1;
    } else if (itemsNum >= 2 && itemsNum < 4) {
      var deskitemsNum = itemsNum;
      var desksmallitemsNum = itemsNum - 1;
      var tabletitemsNum = itemsNum - 1;
    } else if (itemsNum >= 4 && itemsNum < 8) {
      var deskitemsNum = itemsNum - 1;
      var desksmallitemsNum = itemsNum - 2;
      var tabletitemsNum = itemsNum - 3;
    } else {
      var deskitemsNum = itemsNum - 3;
      var desksmallitemsNum = itemsNum - 6;
      var tabletitemsNum = itemsNum - 8;
    }
    owl.owlCarousel({
      slideSpeed: 300,
      stopOnHover: true,
      autoPlay: false,
      navigation: returnSliderNavigation,
      pagination: false,
      lazyLoad: true,
      items: itemsNum,
      itemsDesktop: [1000, deskitemsNum],
      itemsDesktopSmall: [900, desksmallitemsNum],
      itemsTablet: [600, tabletitemsNum],
      itemsMobile: false,
      transitionStyle: "goDown",
    });
  });

  // Testimonials Carousel
  jQuery(".fullwidth-projects-carousel").owlCarousel({
    navigation: false,
    pagination: false,
    slideSpeed: 400,
    stopOnHover: true,
    autoPlay: 3000,
    items: 5,
    itemsDesktopSmall: [900, 3],
    itemsTablet: [600, 2],
    itemsMobile: [479, 1]
  });

 
  //	Css3 Transition
	
  jQuery('*').each(function() {
    if (jQuery(this).attr('data-animation')) {
      var jQueryanimationName = jQuery(this).attr('data-animation'),
        jQueryanimationDelay = "delay-" + jQuery(this).attr('data-animation-delay');
      jQuery(this).appear(function() {
        jQuery(this).addClass('animated').addClass(jQueryanimationName);
        jQuery(this).addClass('animated').addClass(jQueryanimationDelay);
      });
    }
  });
  
  // Pie Charts
	
  var pieChartClass = 'pieChart',
    pieChartLoadedClass = 'pie-chart-loaded';

  function initPieCharts() {
    var chart = jQuery('.' + pieChartClass);
    chart.each(function() {
      jQuery(this).appear(function() {
        var jQuerythis = jQuery(this),
          chartBarColor = (jQuerythis.data('bar-color')) ? jQuerythis.data('bar-color') : "#F54F36",
          chartBarWidth = (jQuerythis.data('bar-width')) ? (jQuerythis.data('bar-width')) : 150
        if (!jQuerythis.hasClass(pieChartLoadedClass)) {
          jQuerythis.easyPieChart({
            animate: 2000,
            size: chartBarWidth,
            lineWidth: 2,
            scaleColor: false,
            trackColor: "#eee",
            barColor: chartBarColor,
          }).addClass(pieChartLoadedClass);
        }
      });
    });
  }
  initPieCharts();

  //	Animation Progress Bars
  jQuery("[data-progress-animation]").each(function() {
    var jQuerythis = jQuery(this);
    jQuerythis.appear(function() {
      var delay = (jQuerythis.attr("data-appear-animation-delay") ? jQuerythis.attr("data-appear-animation-delay") : 1);
      if (delay > 1) jQuerythis.css("animation-delay", delay + "ms");
      setTimeout(function() {
        jQuerythis.animate({
          width: jQuerythis.attr("data-progress-animation")
        }, 800);
      }, delay);
    }, {
      accX: 0,
      accY: -50
    });
  });

  // Milestone Counter
  jQuery('.milestone-block').each(function() {
    jQuery(this).appear(function() {
      var jQueryendNum = parseInt(jQuery(this).find('.milestone-number').text());
      jQuery(this).find('.milestone-number').countTo({
        from: 0,
        to: jQueryendNum,
        speed: 4000,
        refreshInterval: 60,
      });
    }, {
      accX: 0,
      accY: 0
    });
  });

  //	Nivo Lightbox	
  jQuery('.lightbox').nivoLightbox({
    effect: 'fadeScale',
    keyboardNav: true,
    errorMessage: 'The requested content cannot be loaded. Please try again later.'
  });

  //	Change Slider Nav Icons
  jQuery('.relate-slider').find('.owl-prev').html('<i class="fa fa-angle-left"></i>');
  jQuery('.relate-slider').find('.owl-next').html('<i class="fa fa-angle-right"></i>');
  jQuery('.touch-slider').find('.owl-prev').html('<i class="fa fa-angle-left"></i>');
  jQuery('.touch-slider').find('.owl-next').html('<i class="fa fa-angle-right"></i>');
  jQuery('.touch-carousel, .testimonials-carousel').find('.owl-prev').html('<i class="fa fa-angle-left"></i>');
  jQuery('.touch-carousel, .testimonials-carousel').find('.owl-next').html('<i class="fa fa-angle-right"></i>');
  jQuery('.read-more').append('<i class="fa fa-angle-right"></i>');

  //	Sticky Header
  (function() {
    var docElem = document.documentElement,
      didScroll = false,
      changeHeaderOn = 100;
    document.querySelector('header');

    function init() {
      window.addEventListener('scroll', function() {
        if (!didScroll) {
          didScroll = true;
          setTimeout(scrollPage, 250);
        }
      }, false);
    }

    function scrollPage() {
      var sy = scrollY();
      if (sy >= changeHeaderOn) {
        jQuery('.top-bar').slideUp(300);
        jQuery("header").addClass("fixed-header");
        if (/iPhone|iPod|BlackBerry/i.test(navigator.userAgent) || jQuery(window).width() < 479) {
          jQuery('.navbar-default .navbar-nav > li > a').css({
            'padding-top': 12 + "px",
            'padding-bottom': 12 + "px"
          })
        } else {
          jQuery('.navbar-default .navbar-nav > li > a').css({
            'padding-top': 8 + "px",
            'padding-bottom': 8 + "px"
          })
          jQuery('.search-side').css({
            'margin-top': 0 + "px"
          });
        };
      } else {
        jQuery('.top-bar').slideDown(300);
        if (/iPhone|iPod|BlackBerry/i.test(navigator.userAgent) || jQuery(window).width() < 479) {
          jQuery('.navbar-default .navbar-nav > li > a').css({
            'padding-top': 15 + "px",
            'padding-bottom': 15 + "px"
          })
        } else {
          jQuery('.navbar-default .navbar-nav > li > a').css({
            'padding-top': 8 + "px",
            'padding-bottom': 8 + "px"
          })
          jQuery('.search-side').css({
            'margin-top': 0 + "px"
          });
        };
      }
      didScroll = false;
    }

    function scrollY() {
      return window.pageYOffset || docElem.scrollTop;
    }
    init();
  })();
});
// End JS Document

// Styles Switcher JS
function setActiveStyleSheet(title) {
  var i, a, main;
  for (i = 0;
    (a = document.getElementsByTagName("link")[i]); i++) {
    if (a.getAttribute("rel").indexOf("style") != -1 && a.getAttribute("title")) {
      a.disabled = true;
      if (a.getAttribute("title") == title) a.disabled = false;
    }
  }
}

function getActiveStyleSheet() {
  var i, a;
  for (i = 0;
    (a = document.getElementsByTagName("link")[i]); i++) {
    if (a.getAttribute("rel").indexOf("style") != -1 && a.getAttribute("title") && !a.disabled) return a.getAttribute("title");
  }
  return null;
}

function getPreferredStyleSheet() {
  var i, a;
  for (i = 0;
    (a = document.getElementsByTagName("link")[i]); i++) {
    if (a.getAttribute("rel").indexOf("style") != -1 && a.getAttribute("rel").indexOf("alt") == -1 && a.getAttribute("title")) return a.getAttribute("title");
  }
  return null;
}

function createCookie(name, value, days) {
  if (days) {
    var date = new Date();
    date.setTime(date.getTime() + (days * 24 * 60 * 60 * 1000));
    var expires = "; expires=" + date.toGMTString();
  } else expires = "";
  document.cookie = name + "=" + value + expires + "; path=/";
}

function readCookie(name) {
  var nameEQ = name + "=";
  var ca = document.cookie.split(';');
  for (var i = 0; i < ca.length; i++) {
    var c = ca[i];
    while (c.charAt(0) == ' ') c = c.substring(1, c.length);
    if (c.indexOf(nameEQ) == 0) return c.substring(nameEQ.length, c.length);
  }
  return null;
}
window.onload = function(e) {
  var cookie = readCookie("style");
  var title = cookie ? cookie : getPreferredStyleSheet();
  setActiveStyleSheet(title);
}
window.onunload = function(e) {
  var title = getActiveStyleSheet();
  createCookie("style", title, 365);
}
var cookie = readCookie("style");
var title = cookie ? cookie : getPreferredStyleSheet();
setActiveStyleSheet(title);
jQuery(document).ready(function() {
  // Styles Switcher
  jQuery(document).ready(function() {
    jQuery('.open-switcher').click(function() {
      if (jQuery(this).hasClass('show-switcher')) {
        jQuery('.switcher-box').css({
          'left': 0
        });
        jQuery('.open-switcher').removeClass('show-switcher');
        jQuery('.open-switcher').addClass('hide-switcher');
      } else if (jQuery(this).hasClass('hide-switcher')) {
        jQuery('.switcher-box').css({
          'left': '-236px'
        });
        jQuery('.open-switcher').removeClass('hide-switcher');
        jQuery('.open-switcher').addClass('show-switcher');
      }
    });
  });
  //Top Bar Switcher
  jQuery(".topbar-style").change(function() {
    if (jQuery(this).val() == 1) {
      jQuery(".top-bar").removeClass("dark-bar"),
        jQuery(".top-bar").removeClass("color-bar"),
        jQuery(window).resize();
    } else if (jQuery(this).val() == 2) {
      jQuery(".top-bar").removeClass("color-bar"),
        jQuery(".top-bar").addClass("dark-bar"),
        jQuery(window).resize();
    } else if (jQuery(this).val() == 3) {
      jQuery(".top-bar").removeClass("dark-bar"),
        jQuery(".top-bar").addClass("color-bar"),
        jQuery(window).resize();
    }
  });
  //Layout Switcher
  jQuery(".layout-style").change(function() {
    if (jQuery(this).val() == 1) {
      jQuery("#container").removeClass("boxed-page"),
        jQuery(window).resize();
    } else {
      jQuery("#container").addClass("boxed-page"),
        jQuery(window).resize();
    }
  });
  //Background Switcher
  jQuery('.switcher-box .bg-list li a').click(function() {
    var current = jQuery('.switcher-box select[id=layout-style]').find('option:selected').val();
    if (current == '2') {
      var bg = jQuery(this).css("backgroundImage");
      jQuery("body").css("backgroundImage", bg);
    } else {
      alert('Please select boxed layout');
    }
  });
});

// Mixitup portfolio filter
jQuery(function() {
  jQuery('#portfolio-list').mixItUp({
    animation: {
      duration: 800
    }
  });
});

jQuery('#submit').click(function(){

jQuery.post("assets/php/send.php", jQuery(".contact-form").serialize(),  function(response) {   
 jQuery('#success').html(response);
});
return false;

});

/**
 * Slick Nav 
 */

jQuery('.wpb-mobile-menu').slicknav({
  prependTo: '.navbar-header',
  parentTag: 'span',
  allowParentLinks: true,
  duplicate: false,
  label: '',
  closedSymbol: '<i class="fa fa-angle-right"></i>',
  openedSymbol: '<i class="fa fa-angle-down"></i>',
});