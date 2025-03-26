// $('.categories br').remove();

// $(document).ready(function() {
//     $('.categories').addClass('owl-carousel');
//     $('.categories').addClass('owl-theme');
// });

// jQuery(function() {
//     jQuery('.categories.owl-carousel').owlCarousel({
//         // autoplay: true,
//         // autoplayTimeout: 4000,
//         // autoplaySpeed: 2500,
//         loop: true,
//         margin: 10,
//         nav: true,
//         navText: ["<i class='fas fa-chevron-left'></i>", "<i class='fas fa-chevron-right'></i>"],
//         navClass: ["owl-prev", "owl-next"],
//         startPosition: -1,
//         responsiveClass:true,
//         slideBy: 1,
//         smartSpeed : 900,
//         responsive:{
//             0:{
//                 items: 1
//             },
//             400:{
//                 items: 1
//             },
//             800:{
//                 items: 1
//             },
//             1200:{
//                 items: 1
//             },
//             1560:{
//                 items: 1
//             },
//             1900:{
//                 items: 1
//             }
//         }
//     });
// })


var siteCarousel = function () {
    if ( $('.nonloop-block-13').length > 0 ) {
        $('.nonloop-block-13').owlCarousel({
        center: false,
        items: 1,
        loop: true,
            stagePadding: 0,
        margin: 20,
        autoplay: true,
        autoHeight: true,
        nav: true,
            navText: ['<span class="icon-arrow_back">', '<span class="icon-arrow_forward">'],
        responsive:{
        600:{
            margin: 0,
            stagePadding: 10,
          items: 1
        },
        1000:{
            margin: 0,
            stagePadding: 0,
          items: 1
        },
        1200:{
            margin: 0,
            stagePadding: 0,
          items: 1
        }
        }
        });
    }
};
siteCarousel();