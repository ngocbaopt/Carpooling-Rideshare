/*-------------------------------------------------------------------------------------------------------------------------------*/
/*This is main JS file that contains custom style rules used in this template*/
/*-------------------------------------------------------------------------------------------------------------------------------*/
/* Template Name: Site Title*/
/* Version: 1.0 Initial Release*/
/* Build Date: 22-04-2015*/
/* Author: Unbranded*/
/* Website: http://moonart.net.ua/site/ 
/* Copyright: (C) 2015 */
/*-------------------------------------------------------------------------------------------------------------------------------*/

/*--------------------------------------------------------*/
/* TABLE OF CONTENTS: */
/*--------------------------------------------------------*/
/* 01 - VARIABLES */
/*-------------------------------------------------------------------------------------------------------------------------------*/

$(function() {

	"use strict";

	/*================*/
	/* 01 - VARIABLES */
	/*================*/
	var swipers = [], winW, winH, winScr, _isresponsive, smPoint = 768, mdPoint = 992, lgPoint = 1200, addPoint = 1600, _ismobile = navigator.userAgent.match(/Android/i) || navigator.userAgent.match(/webOS/i) || navigator.userAgent.match(/iPhone/i) || navigator.userAgent.match(/iPad/i) || navigator.userAgent.match(/iPod/i);

	/*========================*/
	/* 02 - page calculations */
	/*========================*/
	function pageCalculations(){
		winW = $(window).width();
		winH = $(window).height();
		if($('.menu-button').is(':visible')) _isresponsive = true;
		else _isresponsive = false;
		headerSticky();
		if ( $("header").height() > winH ) {
			$("header").addClass("absolute");
		}
		else{$("header").removeClass("absolute")}
	}



	/*=================================*/
	/* 03 - function on document ready */
	/*=================================*/
	pageCalculations();

	//center all images inside containers
	$('.center-image').each(function(){
		var bgSrc = $(this).attr('src');
		$(this).parent().addClass('background-block').css({'background-image':'url('+bgSrc+')'});
		$(this).hide();
	});	

	/*============================*/
	/* 04 - function on page load */
	/*============================*/
	$(window).load(function(){
		$('#loader-wrapper').fadeOut();
		initSwiper();
		$('.isotope-grid').isotope({
			itemSelector: '.isotope-item',
			percentPosition: true,
			masonry:{gutter:0,columnWidth:'.grid-sizer'}
		});
		setBG();
	});

	function setBG(){
		if( $(".blur-slider").length && winW > 992){ 
			changeBG();
		}
	}

	function changeBG(){
			if( $(".blur-slider").length && winW > 992){
				$(".blur-bg").removeClass("show");
				var index = $(".swiper-slide-active").index();
				$(".blur-bg").eq(index-1).addClass("show");
			}
	}

	/*==============================*/
	/* 05 - function on page resize */
	/*==============================*/
	function resizeCall(){
		pageCalculations();

		$('.swiper-container.initialized[data-slides-per-view="responsive"]').each(function(){
			var thisSwiper = swipers['swiper-'+$(this).attr('id')], $t = $(this), slidesPerViewVar = updateSlidesPerView($t);
			thisSwiper.params.slidesPerView = slidesPerViewVar;
			thisSwiper.reInit();
			var paginationSpan = $t.find('.pagination span');
			var paginationSlice = paginationSpan.hide().slice(0,(paginationSpan.length+1-slidesPerViewVar));
			if(paginationSlice.length<=1 || slidesPerViewVar>=$t.find('.swiper-slide').length) $t.addClass('pagination-hidden');
			else $t.removeClass('pagination-hidden');
			paginationSlice.show();
		});
	}
	if(!_ismobile){
		$(window).resize(function(){
			resizeCall();
			initSwiper();
		});
	} else{
		window.addEventListener("orientationchange", function() {
			resizeCall();
		}, false);
	}

	var footerTop, WindowTop,footerHeight;
	function headerSticky(){
		if( $(".header.style-1 .footer.style-2").length || $(".header.style-1 .footer.style-3").length ){
			if(winW > 992)	{
				footerTop = $(".footer").offset().top;
				WindowTop = $(window).scrollTop()
				footerHeight = $(".footer").height();
				if(WindowTop + winH + 96> footerTop && $("header").height() < winH){
					$("body").addClass("absolute-header");
					$(".absolute-header header").css({"bottom":$(document).height() - footerTop + 96 + "px"});
				}
				else{
					$(".absolute-header").removeClass("absolute-header");
				}
			}
		}
	}


	$(window).on("scroll",function(){
		headerSticky();
	});

	/*=====================*/
	/* 07 - swiper sliders */
	/*=====================*/
	function initSwiper(){
		var initIterator = 0;
		$('.swiper-container').each(function(){								  
			var $t = $(this);								  

			var index = 'swiper-unique-id-'+initIterator;

			$t.addClass('swiper-'+index + ' initialized').attr('id', index);
			$t.find('.pagination').addClass('pagination-'+index);

			var autoPlayVar = parseInt($t.attr('data-autoplay'),10);
			var centerVar = parseInt($t.attr('data-center'),10);
			var simVar = ($t.closest('.circle-description-slide-box').length)?false:true;

			var slidesPerViewVar = $t.attr('data-slides-per-view');
			if(slidesPerViewVar == 'responsive'){
				slidesPerViewVar = updateSlidesPerView($t);
			}
			else if(slidesPerViewVar != 'auto') slidesPerViewVar = parseInt(slidesPerViewVar,10);

			var loopVar = parseInt($t.attr('data-loop'),10);
			var speedVar = parseInt($t.attr('data-speed'),10);

			var slidesPerGroup = parseInt($t.attr('data-slides-per-group'),10);
			if(!slidesPerGroup){slidesPerGroup=1;}			

			swipers['swiper-'+index] = new Swiper('.swiper-'+index,{
				speed: speedVar,
				pagination: '.pagination-'+index,
				loop: loopVar,
				paginationClickable: true,
				autoplay: autoPlayVar,
				slidesPerView: slidesPerViewVar,
				slidesPerGroup: slidesPerGroup,
				keyboardControl: true,
				calculateHeight: true, 
				simulateTouch: simVar,
				centeredSlides: centerVar,
				roundLengths: true,
				onInit: function(swiper){
					var browserWidthResize = $(window).width();
					if (browserWidthResize < 750) {
							swiper.params.slidesPerGroup=1;
					} else { 
                      swiper.params.slidesPerGroup=slidesPerGroup;
					}
				},
				onResize: function(swiper){
					var browserWidthResize2 = $(window).width();
					if (browserWidthResize2 < 750) {
							swiper.params.slidesPerGroup=1;
					} else { 
                      swiper.params.slidesPerGroup=slidesPerGroup;
					  swiper.resizeFix(true);
					}					
				},									
				onSlideChangeEnd: function(swiper){
					var activeIndex = (loopVar===true)?swiper.activeLoopIndex:swiper.activeIndex;
					var qVal = $t.find('.swiper-slide-active').attr('data-val');
					$t.find('.swiper-slide[data-val="'+qVal+'"]').addClass('active');
				},
				onSlideChangeStart: function(swiper){
					$t.find('.swiper-slide.active').removeClass('active');
					changeBG();
					if($t.hasClass('thumbnails-preview')){
						var activeIndex = (loopVar===1)?swiper.activeLoopIndex:swiper.activeIndex;
						swipers['swiper-'+$t.prev().attr('id')].swipeTo(activeIndex);
						$t.prev().find('.current').removeClass('current');
						$t.prev().find('.swiper-slide[data-val="'+activeIndex+'"]').addClass('current');
					}
				},
				onSlideClick: function(swiper){
					var thisSlide = $(swiper.clickedSlide);
					if(thisSlide.hasClass('open-modal-popup')) openModalPopup(thisSlide);
					if($t.hasClass('thumbnails')) {
						swipers['swiper-'+$t.next().attr('id')].swipeTo(swiper.clickedSlideIndex);
					}
				}
			});
			swipers['swiper-'+index].reInit();
			if($t.attr('data-slides-per-view')=='responsive'){
				var paginationSpan = $t.find('.pagination span');
				var paginationSlice = paginationSpan.hide().slice(0,(paginationSpan.length+1-slidesPerViewVar));
				if(paginationSlice.length<=1 || slidesPerViewVar>=$t.find('.swiper-slide').length) $t.addClass('pagination-hidden');
				else $t.removeClass('pagination-hidden');
				paginationSlice.show();
			}
			initIterator++;
		});

	}

	function updateSlidesPerView(swiperContainer){
		if(winW>=addPoint) return parseInt(swiperContainer.attr('data-add-slides'),10);
		else if(winW>=lgPoint) return parseInt(swiperContainer.attr('data-lg-slides'),10);
		else if(winW>=mdPoint) return parseInt(swiperContainer.attr('data-md-slides'),10);
		else if(winW>=smPoint) return parseInt(swiperContainer.attr('data-sm-slides'),10);
		else return parseInt(swiperContainer.attr('data-xs-slides'),10);
	}

	//swiper arrows
	$('.swiper-arrow-left').on("click",function(){
		swipers['swiper-'+$(this).parent().attr('id')].swipePrev();
	});

	$('.swiper-arrow-right').on("click",function(){
		swipers['swiper-'+$(this).parent().attr('id')].swipeNext();
	});

	/*==============================*/
	/* 08 - buttons, clicks, hovers */
	/*==============================*/
	// top menu
	$(".cmn-toggle-switch").on("click", function(){
		$(this).toggleClass("active");
		$('.nav-container').stop().slideToggle();
		return false;
	});

	$(".small-menu-btn").on("click",function(){
		$(this).toggleClass("active");
		$(".sub-nav").stop().slideToggle();
		return false;
	});

	//modal popup
	$('.footer-slider a').on('click', function(){
		var src = $(this).find("img").attr("src");
		$('.modal-popup img').attr("src",src);
		$('.modal-popup').addClass('active');

		return false;
	});
	/*photo viewer popup*/
	function openModalPopup(foo){
		var src = foo.attr("data-src");
		$('.modal-popup img').attr("src",src);
		$('.modal-popup').addClass('active');
	}

	$(".footer-slider").on("click",function(){
		return false;
	})
	//close modal popup
	$('.modal-popup .close-button, .modal-popup .close-layer').on('click', function(){
		$('.modal-popup.active').removeClass('active');
	});
	/*open popups buttons*/
	$("header .h-search").on("click",function(){
		$(".search-popup").addClass("opened");
		$(".popup-bg").addClass("opened");
	});
	$(".video-play").on("click",function(){
		var src = $(this).attr("data-src");
		$(".video-popup iframe").attr("src",src);
		setTimeout(function(){ $(".video-popup").addClass("opened");}
		, 700);
		$(".popup-bg").addClass("opened");
		return false;
	});
	/*close popups buttons*/
	$(".popup .close").on("click",function(){
		$(".popup").removeClass("opened");
	});
	$(".header.style-4 .small-menu-btn").on("click",function(){
		$(".main-nav").stop().slideToggle();
	});
	$(".popup-bg").on("click",function(){
		$(".popup").removeClass("opened");
	}) ;
	
	$('nav > ul > li > a span').on('click', function(){
	     if ($(this).parent().parent().find('.dropmenu').hasClass('slide')){
		     $(this).parent().parent().find('.dropmenu').removeClass('slide');
		 }else{
			 $('.dropmenu').removeClass('slide');	
			 $(this).parent().parent().find('.dropmenu').addClass('slide');														 
		}
		return false
	});
	
	


    $("#addPost").click(function () {
        $.ajax({
            url: "addTrip.php",
            type: "POST",
            data: { "postText": $("#newPostText").val() }
        }).done(function () { 
                    
        });
    });

            })();