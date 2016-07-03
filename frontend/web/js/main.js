window.onload = function() {
        try {
          TagCanvas.Start('myCanvas','tags',{
			minBrightness: 0.5,
            textColour: '#ff0000',
            outlineColour: '#034bb9',
            reverse: true,
            depth: 0.8,
            maxSpeed: 0.05
          });
        } catch(e) {
          // something went wrong, hide the canvas container
          document.getElementById('myCanvasContainer').style.display = 'none';
        }
};
function randomInteger(min, max) {
  var rand = min + Math.random() * (max - min)
  rand = Math.round(rand);
  return rand;
}
$(document).ready(function() {
    $('.navbar-nav.navbar-right.nav .dropdown').hover(function() {
        $(this).find('.dropdown-menu').first().stop(true, true).slideDown(150);
    }, function() {
        $(this).find('.dropdown-menu').first().stop(true, true).slideUp(105)
    });
    $('#go-top').click(function() {
        $('html, body').animate({scrollTop: 0},500);
        return false;
    })
    $('.table-profile').slick({
        slidesToShow: 1,
        slidesToScroll: 1,
        arrows: false,
    });
    $('.carousel-team').slick({
        prevArrow: ".carousel-team + .slider-control .glyphicon-chevron-left",
        nextArrow: ".carousel-team + .slider-control .glyphicon-chevron-right",
        slidesToShow: $('.carousel-team').attr("data-show"),
        slidesToScroll: 1,
        autoplay: false,
        autoplaySpeed: 4000,
        responsive: [
            {
                breakpoint: 1199,
                settings: {
                    slidesToShow: $('.carousel-team').attr("data-show") - 1,
                }
            },
            {
                breakpoint: 767,
                settings: {
                    slidesToShow: $('.carousel-team').attr("data-show") - 2,
                }
            },
            {
                breakpoint: 321,
                settings: {
                    slidesToShow: 1,
                }
            }
        ]
    });
    if ($('.nav > .active > a').attr('href') == '/index.php?r=site%2Findex') {
        $('canvas').attr('width', $('#myCanvasContainer').width());
        $('.carousel-sponsors').slick({
            prevArrow: ".carousel-sponsors + .slider-control .glyphicon-chevron-left",
            nextArrow: ".carousel-sponsors + .slider-control .glyphicon-chevron-right",
            slidesToShow: $('.carousel-sponsors').attr("data-show"),
            slidesToScroll: 1,
            autoplay: false,
            autoplaySpeed: 3000,
            responsive: [
                {
                    breakpoint: 991,
                    settings: {
                        slidesToShow: 3,
                    }
                },
                {
                    breakpoint: 767,
                    settings: {
                        slidesToShow: 2,
                    }
                },
                {
                    breakpoint: 481,
                    settings: {
                        slidesToShow: 1,
                    }
                }

            ]
        });
    } else {
        $('.carousel-sponsors').slick({
            prevArrow: ".carousel-sponsors + .slider-control .glyphicon-chevron-left",
            nextArrow: ".carousel-sponsors + .slider-control .glyphicon-chevron-right",
            slidesToShow: $('.carousel-sponsors').attr("data-show"),
            slidesToScroll: 1,
            autoplay: false,
            autoplaySpeed: 3000,
        });
    }

    $('.events-feed').slick({
        prevArrow: ".events-feed + .slider-control .glyphicon-chevron-left",
        nextArrow: ".events-feed + .slider-control .glyphicon-chevron-right",
        slidesToShow: $('.events-feed').attr("data-show"),
        slidesToScroll: 1,
        autoplay: false,
        autoplaySpeed: 2000,
        responsive: [
            {
                breakpoint: 1199,
                settings: {
                    slidesToShow: $('.events-feed').attr("data-show") - 1,
                }
            },
            {
                breakpoint: 991,
                settings: {
                    slidesToShow: 4,
                }
            },
            {
                breakpoint: 641,
                settings: {
                    slidesToShow: 3,
                }
            },
            {
                breakpoint: 481,
                settings: {
                    slidesToShow: 2,
                }
            }

        ]
    });
    $('.ad-carousel').slick({
        prevArrow: false,
        nextArrow: false,
        infinite: true,
        autoplay: true,
        autoplaySpeed: 9000,
        speed: 1000,
        fade: true,
        cssEase: 'linear'
    });
    $(".wrap-img").css("height", function() {
        return $(this).width() * 0.75;
    });
    $(".img-modal").click(function() {
        var $src = $(this).attr("src");
        $("#imgModal .modal-body")/*.attr("src", $src).width($(window).width())*/.height($(window).height()/1.5).css("background-image", 'url('+$src+')');
    });
    if ($('*').is('aside')) {
        var section = $('section[class*="col-"]'); var aside = $('aside[class*="col-"]').height();
        console.log((aside+ ', ' + section.height()));
        if ((aside - section.height()) > 0) { $('.subsection.bg-white').height($('.subsection.bg-white').height() + (aside - section.height()) + 54);}

    }
    $('span.not-set').parents('tr').css('display', 'none');
});

	

 