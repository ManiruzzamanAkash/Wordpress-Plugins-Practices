jQuery(document).ready(function($){


/*------------------------------------------------
                PRELOADER
------------------------------------------------*/

 $('#loader').fadeOut();
 $('#loader-container').fadeOut();

/*------------------------------------------------
                END PRELOADER
------------------------------------------------*/

/*------------------------------------------------
                STICKY HEADER
------------------------------------------------*/

$(window).scroll(function() {
if ($(this).scrollTop() > 1){  
    $('.sticky').addClass("nav-shrink");
  }
  else{
    $('.sticky').removeClass("nav-shrink");
  }
});

$('#search-btn').click(function(event){
    event.preventDefault();
    $(this).toggleClass('active');
    $('#search').fadeToggle();
    $('#search input.search-field').focus();
});

$('button.menu-toggle').click(function(){
    $('.main-navigation ul.nav-menu').slideToggle();
});

$('.main-navigation ul li.menu-item-has-children > a').after('<button class="dropdown-toggle"><i class="fa fa-angle-down"></i></button>');

$('.main-navigation button.dropdown-toggle').click(function() {
    $(this).toggleClass('active');
    $(this).parent().find('.sub-menu').first().slideToggle();
    $('#primary-menu > li:last-child button.active').unbind('keydown');
});

$(document).keyup(function(e) {
    if (e.keyCode === 27) {
        $('#search').fadeOut();
        $('#search-btn').removeClass('active');
    }
});

$(document).click(function (e) {
  var container = $("#masthead");
   if (!container.is(e.target) && container.has(e.target).length === 0) {
        $('#search').fadeOut();
        $('#search-btn').removeClass('active');
    }
});

/*--------------------------------------------------------------
 Keyboard Navigation
----------------------------------------------------------------*/
if( $(window).width() < 1024 ) {
    $('#primary-menu').find("li").last().bind( 'keydown', function(e) {
        if( e.which === 9 ) {
            e.preventDefault();
            $('#masthead').find('.menu-toggle').focus();
        }
    });

    $('#primary-menu > li:last-child button:not(.active)').bind( 'keydown', function(e) {
        if( e.which === 9 ) {
            e.preventDefault();
            $('#masthead').find('.menu-toggle').focus();
        }
    });
}
else {
    $('#primary-menu').find("li").unbind('keydown');
}

$(window).resize(function() {
    if( $(window).width() < 1024 ) {
        $('#primary-menu').find("li").last().bind( 'keydown', function(e) {
            if( e.which === 9 ) {
                e.preventDefault();
                $('#masthead').find('.menu-toggle').focus();
            }
        });

        $('#primary-menu > li:last-child button:not(.active)').bind( 'keydown', function(e) {
            if( e.which === 9 ) {
                e.preventDefault();
                $('#masthead').find('.menu-toggle').focus();
            }
        });
    }
    else {
        $('#primary-menu').find("li").unbind('keydown');
    }
});


/*------------------------------------------------
                END STICKY HEADER
------------------------------------------------*/

/*------------------------------------------------
                SLIDER AND HEADER IMAGE DISABLED
------------------------------------------------*/
if( $('body.home.page section').hasClass('main-featured-slider') ) {
    $('body.home.page').addClass('slider-enabled');
}

else {
    $('body.home.page').addClass('slider-disabled');
}

/*------------------------------------------------
                BACK TO TOP
------------------------------------------------*/

 $(window).scroll(function(){
    if ($(this).scrollTop() > 1) {
        $('.backtotop').fadeIn();
        } else {
        $('.backtotop').fadeOut();
    }
});

$('.backtotop').click(function() {
    $('html, body').animate({scrollTop: '0px'}, 800);
    return false;
});

$('.menu-toggle').click(function() {
    $('#masthead').toggleClass('menu-open');
});

/*------------------------------------------------
                END BACK TO TOP
------------------------------------------------*/

/*------------------------------------------------
                SLICK SLIDER
------------------------------------------------*/
var $a = $( "#main-slider").data('effect');

$("#main-slider").slick({
     cssEase: $a
});

$("#team .regular").slick({
    responsive: [
    {
      breakpoint: 992,
      settings: {
        slidesToShow: 2
      }
    },
    {
      breakpoint: 567,
      settings: {
        slidesToShow: 1
      }
    }
  ]
});

/*------------------------------------------------
                    Section scroll   
------------------------------------------------*/

$('.scroll-link').on('click', function(event) {
  event.preventDefault();
  var section = $(this).attr("href");

    $('html,body').animate({
        scrollTop: $(section).offset().top - 65},
    '800');
});

$(window).scroll(function() {
    $( '.infinite-loader' ).each(function(e) {
       $(this).remove();
    });
});

/*------------------------------------------------
            END JQUERY
------------------------------------------------*/
});