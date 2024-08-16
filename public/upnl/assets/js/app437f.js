(function() {
  'use strict';

  //menu fix mobile

  let vh = window.innerHeight * 0.01;
  // Then we set the value in the --vh custom property to the root of the document
  document.documentElement.style.setProperty('--vh', `${vh}px`);

  window.addEventListener('resize', () => {
    // We execute the same script as before
    let vh = window.innerHeight * 0.01;
    document.documentElement.style.setProperty('--vh', `${vh}px`);
  });
  
  // poppup

  $('.popup-frame').magnificPopup({
		disableOn: 700,
		type: 'iframe',
		mainClass: 'mfp-fade',
		removalDelay: 160,
		preloader: false,
		fixedContentPos: false
	});

	$('.popup-img').magnificPopup({
		type: 'image',
		closeOnContentClick: true,
		mainClass: 'mfp-img-mobile',
		image: {
			verticalFit: true
		}
		
  });

  $('.popup').magnificPopup({
		type: 'inline',
    preloader: false,
    closeOnContentClick: false,
    fixedContentPos: true,
    mainClass: 'mfp-zoom-in',

    callbacks: {
      open: function() {

      },
    }
  });

  
  $('.gallery').each(function() { // the containers for all your galleries
    $(this).magnificPopup({
      delegate: 'a', // the selector for gallery item
      type: 'image',
      gallery: {
        enabled:true
      }
    });
  });

  $('.mfp-close').on('click', function(){
    $.magnificPopup.close();
  })
  $('.close-popup').on('click', function(){
    $.magnificPopup.close();
  })

  $('.cab-plans-modal .main-btn').on('click', function(){
    $.magnificPopup.close()
  })

  //

  svg4everybody();
  

  //table
  
  if($('table.responsive').length > 0){
    $('table.responsive').ngResponsiveTables();
  }
	
  //select styler

  $('select').styler();

  //datepicker

  // $( ".datepicker" ).datepicker();

  // $("#weeklyDatePicker").datetimepicker({
  //   format: 'DD-MM-YYYY'
  // });

  // //Get the value of Start and End of Week
  // $('#weeklyDatePicker').on('dp.change', function (e) {
  //     var value = $("#weeklyDatePicker").val();
  //     var firstDate = moment(value, "DD-MM-YYYY").day(0).format("DD-MM-YYYY");
  //     var lastDate =  moment(value, "DD-MM-YYYY").day(6).format("DD-MM-YYYY");
  //     $("#weeklyDatePicker").val(firstDate + " - " + lastDate);
  // });
   
  //tabs

  $('.tabs__wrap').each(function() {
    $(this).find('.tab').each(function(i) {
      $(this).parents('.tabs__wrap').find('.tab_content').children().not(':first').hide();
      $(this).click(function(){
        $(this).addClass('active').siblings().removeClass('active')
        $(this).parents('.tabs__wrap').find('.tab_content').children().eq(i).fadeIn(0).siblings('.tab_item').hide();
      
        // $(".nicescroll-box").getNiceScroll().resize();
      });
    });
  });

  //tabs
  $('[data-tabs-btn]').click(function() {
    let tabsName = $(this).parent().attr('data-tabs-btns');
    let tabNo = $(this).attr('data-tabs-btn');
    let tabsWrapper = $('[data-tabs-wrapper='+tabsName+']');

    $(this).siblings().removeClass('active');
    $(this).addClass('active');

    tabsWrapper.children().each(function(i, item) {
      $(item).hide();
      if ($(item).attr('data-tabs-item') === tabNo) {
        $(item).show().addClass('active').siblings().removeClass('active');
      }
    });
  });

  function tabsInitialization() {
    let btns = $('[data-tabs-btns]');
    let wrapper = $('[data-tabs-wrapper]');

    $(wrapper).children().not(function() {
      if ($(this).attr('data-tabs-item') === '1') {
        return true;
      }
    }).hide();

    $(btns).children().not(function() {
      if ($(this).attr('data-tabs-btn') === '1') {
        return false;
      } else {
        return true;
      }
    }).addClass('active');
  }
  
  tabsInitialization();

  //accordion

  var Accordion = function(el, multiple) {
    this.el = el || {};
    this.multiple = multiple || false;

    // Variables privadas
    var links = this.el.find('.accordion__head');
    // Evento
    links.on('click', {el: this.el, multiple: this.multiple}, this.dropdown)
  }

  Accordion.prototype.dropdown = function(e) {
    var $el = e.data.el,
        $this = $(this),
        $next = $this.next();

    $next.slideToggle();
    $this.parent().toggleClass('active');

    if($('.nicescroll-box').length !== 0){
      setTimeout(() => {
        $(".nicescroll-box").getNiceScroll().resize();
      }, 1000);
    }

    if (!e.data.multiple) {
      $el.find('.accordion__body').not($next).slideUp().parent().removeClass('active');
    };
  }	

  var accordion = new Accordion($('.accordion'), false);
  
  //nicescroll

  $(".nicescroll-box").niceScroll(".wrap",{
    cursorcolor:"#F67942",
    cursorwidth:"2px",
    cursorborder: "0px solid #fff",
    zindex: 20,
    emulatetouch: true,
    autohidemode: false,
    cursorborderradius: "0px",
    railalign: 'right',
  });
  
  
  // aos

  // AOS.init(
  //   {
  //     // Global settings
  //     disable: false, // accepts following values: 'phone', 'tablet', 'mobile', boolean, expression or function
  //     startEvent: 'DOMContentLoaded', // name of the event dispatched on the document, that AOS should initialize on
  //     initClassName: 'aos-init', // class applied after initialization
  //     animatedClassName: 'aos-animate', // class applied on animation
  //     useClassNames: false, // if true, will add content of `data-aos` as classes on scroll
  //     // Settings that can be overriden on per-element basis, by `data-aos-*` attributes:
  //     offset: 0, // offset (in px) from the original trigger point
  //     delay: 0, // values from 0 to 3000, with step 50ms
  //     duration: 700, // values from 0 to 3000, with step 50ms
  //     easing: 'ease-in-out', // default easing for AOS animations
  //     once: false, // whether animation should happen only once - while scrolling down
  //     mirror: false, // whether elements should animate out while scrolling past them
  //     anchorPlacement: 'top-bottom', // defines which position of the element regarding to window should trigger the animation
  //   }
  // );

  // setTimeout(AOS.refreshHard, 1000);
	
	//clipboard

  var affil1 = new Clipboard('.copy-text');

  function affiliatelink(id) {
    id.on('success', function (e) {

      $('.copy-success').fadeIn();
      $('.copy-success').delay(3000).fadeOut();
    });
  }

  affiliatelink(affil1);

  $('.header-burger').on('click', function(){
    $(this).toggleClass('active');
    $('.header-side').toggleClass('active');
  })
  $('.cab-burger').on('click', function(){
    $(this).toggleClass('active');
    $('.cab-menu').toggleClass('active');
  })

  $('.invest-nav__arrow.prev').on('click', function(){
    if($('.invest-tabs__item.active').prev().length == 0){
      $('.invest-tabs__item').last().addClass('active').siblings().removeClass('active');
    }else{
      $('.invest-tabs__item.active').removeClass('active').prev().addClass('active');
    }
    
    if($('.invest-plan__list.active').prev().length == 0){
      $('.invest-plan__list').last().show().addClass('active').siblings().hide().removeClass('active');
    }else{
      $('.invest-plan__list.active').hide().removeClass('active').prev().show().addClass('active');
    }
  })

  $('.invest-nav__arrow.next').on('click', function(){
    if($('.invest-tabs__item.active').next().length == 0){
      $('.invest-tabs__item').first().addClass('active').siblings().removeClass('active');
    }else{
      $('.invest-tabs__item.active').removeClass('active').next().addClass('active');
    }
    
    if($('.invest-plan__list.active').next().length == 0){
      $('.invest-plan__list').first().show().addClass('active').siblings().hide().removeClass('active');
    }else{
      $('.invest-plan__list.active').hide().removeClass('active').next().show().addClass('active');
    }
  })

  // sliders

  var walletsSlider = new Swiper('.wallets .swiper', {
    loop: true,
    slidesPerView: 4,
    spaceBetween: 0,
    // centeredSlides: true,
    // effect: 'fade',
    // fadeEffect: {
    //   crossFade: true
    // },
    autoplay: {
      delay: 3000,
      disableOnInteraction: true,
    },
    navigation: {
      nextEl: '.wallets .swiper-button-next',
      prevEl: '.wallets .swiper-button-prev',
    },
  });
  var walletsSliderAbout = new Swiper('.wallets_about .swiper', {
    loop: true,
    slidesPerView: 3,
    spaceBetween: 0,
    // centeredSlides: true,
    // effect: 'fade',
    // fadeEffect: {
    //   crossFade: true
    // },
    autoplay: {
      delay: 3000,
      disableOnInteraction: true,
    },
    navigation: {
      nextEl: '.wallets_about .swiper-button-next',
      prevEl: '.wallets_about .swiper-button-prev',
    },
  });
  var partnersSlider = new Swiper('.contacts-partners .swiper', {
    loop: true,
    slidesPerView: 1,
    spaceBetween: 0,
    effect: 'fade',
    fadeEffect: {
      crossFade: true
    },
    autoplay: {
      delay: 3000,
      disableOnInteraction: true,
    },
    navigation: {
      nextEl: '.contacts-partners__nav .swiper-button-next',
      prevEl: '.contacts-partners__nav .swiper-button-prev',
    },
  });

  var projectSlider = new Swiper('.project-slider .swiper', {
    loop: true,
    slidesPerView: 1,
    spaceBetween: 30,
    // centeredSlides: true,
    // effect: 'fade',
    // fadeEffect: {
    //   crossFade: true
    // },
    autoplay: {
      delay: 3000,
      disableOnInteraction: true,
    },
    navigation: {
      nextEl: '.project-nav .swiper-button-next',
      prevEl: '.project-nav .swiper-button-prev',
    },
    pagination: {
      el: '.project-nav .swiper-pagination',
      type: 'custom',
      renderCustom: function(swiper, current, total){
        if(total >= 10 && current >= 10){
          return `<span class="total">${current}</span>/${total}`
        }
        if(total >= 10 && current < 10){
          return `<span class="total">0${current}</span>/${total}`
        }
        if(total < 10 && current >= 10){
          return `<span class="total">${current}</span>/0${total}`
        }
        if(total < 10 && current < 10){
          return `<span class="total">0${current}</span>/0${total}`
        }
      }
    },
    breakpoints: {
      1200: {
        slidesPerView: 4,
        spaceBetween: 93,
      }, 
      991: {
        slidesPerView: 3,
        spaceBetween: 93,
      },
      767: {
        slidesPerView: 3,
        spaceBetween: 30,
      },
      480: {
        slidesPerView: 2,
        
      }
    }
  });
  var teamHeroSlider = new Swiper('.team-hero .swiper', {
    loop: true,
    slidesPerView: 1,
    spaceBetween: 0,
    centeredSlides: true,
    effect: 'fade',
    fadeEffect: {
      crossFade: true
    },
    autoplay: {
      delay: 3000,
      disableOnInteraction: true,
    },
    navigation: {
      nextEl: '.team-nav .swiper-button-next',
      prevEl: '.team-nav .swiper-button-prev',
    },
  });

  var teamContentSlider = new Swiper('.team-content .swiper', {
    loop: true,
    slidesPerView: 1,
    spaceBetween: 0,
    centeredSlides: true,
    effect: 'fade',
    fadeEffect: {
      crossFade: true
    },
  });

  teamHeroSlider.on('slideChange', function(){
    teamContentSlider.slideTo(teamHeroSlider.activeIndex);
  })

  var footerWalletsSlider = new Swiper('.footer-wallets .swiper', {
    loop: true,
    slidesPerView: 2,
    spaceBetween: 0,
    // centeredSlides: true,
    // effect: 'fade',
    // fadeEffect: {
    //   crossFade: true
    // },
    autoplay: {
      delay: 3000,
      disableOnInteraction: true,
    },
    navigation: {
      nextEl: '.footer-wallets .swiper-button-next',
      prevEl: '.footer-wallets .swiper-button-prev',
    },
    breakpoints: {
      1200: {
        slidesPerView: 4,
      },
      768: {
        slidesPerView: 3,
      }
    }
  });

  var newsSlider = new Swiper('.news-slider .swiper', {
    loop: true,
    slidesPerView: 1,
    spaceBetween: 0,
    // centeredSlides: true,
    effect: 'fade',
    fadeEffect: {
      crossFade: true
    },
    autoplay: {
      delay: 3000,
      disableOnInteraction: true,
    },
    navigation: {
      nextEl: '.news-slider .swiper-button-next',
      prevEl: '.news-slider .swiper-button-prev',
    },
  });

  
  //cabinet-Settings

  $('.cab-his__earn').on('click', function(e){
    e.preventDefault();
  
    $(this).find('.cab-his__earn-hide').fadeToggle(300);
    $(this).toggleClass('active');
    let trueH = ($(document).outerHeight(true) - $(this).find('.cab-his__earn-hide').offset().top - $(this).find('.cab-his__earn-hide').outerHeight(true));
  
    if(trueH <= 0){
      $(this).find('.cab-his__earn-hide').addClass('top');
    }
  });
  
  $(document).on('mouseup', function (e){ 
    let block = $(".cab-his__earn.active .cab-his__earn-hide"); 
    if (!block.parent().is(e.target) && block.has(e.target).length === 0) { 
        
      block.fadeOut(300); 

      block.removeClass('active').parent().removeClass('active');

      if( block.hasClass('top')){
        block.removeClass('top');
      }
    }
  });

  $('.cab-his__earn-item').click(function () {
    let html = $(this).html();
    $('.cab-his__earn-item').each(function () {
      $(this).removeClass('active');
    });
    $(this).addClass('active');
    $('.cab-his__static').html(html);
  });
 
  if($('#timer-1').length){
    let timeSec, timeDays, timeElement, duration, interval, intervalId;

    interval = 1000; // 1 second

    // get time element
    timeElement = document.querySelector("#timer-1");
    timeSec = timeElement.dataset.time;
    timeDays = document.querySelector("#timer-d");
    
    // get duration between two times
    duration = timeSec * 1000;

    // loop to countdown every 1 second
    setInterval(function() {
      // get updated duration
      duration = moment.duration(duration + interval, 'milliseconds');

      // if duration is >= 0
      if (duration.asSeconds() <= 0) {
        clearInterval(intervalId);
        // hide the countdown element
        timeElement.classList.add("hidden");
      } else {
        // otherwise, show the updated countdown

        timeDays.innerText = duration.days();
        timeElement.innerText = moment().set({
          hour: duration.hours(),
          minute: duration.minutes(),
          second: duration.seconds(),
        }).format('HH : mm : ss');
 
      }
    }, interval);
  }
  
  
  if($('#time-h').length){
    let timeSec, timeH, timeM, timeS, duration, interval;
    
    interval = 1000; // 1 second

    // get time element
    timeH = document.querySelector("#time-h");
    timeM = document.querySelector("#time-m");
    timeS = document.querySelector("#time-s");
    timeSec = document.querySelector("#timer-2").dataset.time;

    // get duration between two times
    duration = timeSec * 1000;

    // loop to countdown every 1 second
    setInterval(function() {
      // get updated duration
      duration = moment.duration(duration - interval, 'milliseconds');

        // otherwise, show the updated countdown
        timeH.innerText = moment().set('hour', duration.hours()).format('HH');
        timeM.innerText = moment().set('minute', duration.minutes()).format('mm');
        timeS.innerText = moment().set('second', duration.seconds()).format('ss');
    }, interval);
  }
  if($('#cc-number').length) {
    $('#cc-number').mask('9999 9999 9999 9999',{placeholder:"＿", "rightAlign": true, "clearIncomplete": false});
    var inputSelector = '#cc-number';

    $(inputSelector).on('click', function() {
      var currentValue = $(this).val();
      this.setSelectionRange(0, 0);
      $(this).val(currentValue);
    });
  }
  if($('#card-submit').length) {
    $('#card-submit').click(function () {
      $('.cab-card-modal__error').slideDown();
      setTimeout(function () {
        $('.cab-card-modal__error').slideUp();
      },4000);
    });
  }

  if($('.cab-promo-info').length){
    $('.cab-promo-info__close').click(function () {
      $('.cab-promo-info').removeClass('active');
    });
  }
  
})();
