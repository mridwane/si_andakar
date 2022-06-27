// to get current year
function getYear() {
    var currentDate = new Date();
    var currentYear = currentDate.getFullYear();
    document.querySelector("#displayYear").innerHTML = currentYear;
}

getYear();


// isotope js
// init Isotope
var $grid = $('.grid').isotope({
    itemSelector: '.all'
});

// store filter for each group
var filters = {};

$('.filters').on('click', '.button', function (event) {
    var $button = $(event.currentTarget);
    // get group key
    var $buttonGroup = $button.parents('.filters_menu');
    var filterGroup = $buttonGroup.attr('data-filter-group');
    // set filter for group
    filters[filterGroup] = $button.attr('data-filter');
    // combine filters
    var filterValue = concatValues(filters);
    // set filter for Isotope
    $grid.isotope({
        filter: filterValue
    });
});

// change is-checked class on buttons
$('.filters_menu').each(function (i, filters_menu) {
    var $filters_menu = $(filters_menu);
    $filters_menu.on('click', '.button', function (event) {
        $filters_menu.find('.active').removeClass('active');
        var $button = $(event.currentTarget);
        $button.addClass('active');
    });
});

// flatten object by concatting values
function concatValues(obj) {
    var value = '';
    for (var prop in obj) {
        value += obj[prop];
    }
    return value;
}
// end isotopjs

// $(window).on('load', function () {
//     $('.filters_menu li').click(function () {
//         $('.filters_menu li').removeClass('active');
//         $(this).addClass('active');

//         var data = $(this).attr('data-filter');
//         $grid.isotope({
//             filter: data
//         })
//     });

//     $('.sub_filters li').click(function () {
//         $('.sub_filters li').removeClass('active');
//         $(this).addClass('active');

//         var data = $(this).attr('data-filter');
//         $grid.isotope({
//             filter: data
//         })
//     });
//     var $grid = $(".grid").isotope({
//         itemSelector: ".all",
//         percentPosition: false,
//         masonry: {
//             columnWidth: ".all"
//         }
//     })

// });

// nice select
// $(document).ready(function () {
//     $('select').niceSelect();
// });

/** google_map js **/
// function myMap() {
//     var mapProp = {
//         center: new google.maps.LatLng(40.712775, -74.005973),
//         zoom: 18,
//     };
//     var map = new google.maps.Map(document.getElementById("googleMap"), mapProp);
// }

// client section owl carousel
$(".client_owl-carousel").owlCarousel({
    loop: true,
    margin: 0,
    dots: false,
    nav: true,
    navText: [],
    autoplay: true,
    autoplayHoverPause: true,
    navText: [
        '<i class="fa fa-angle-left" aria-hidden="true"></i>',
        '<i class="fa fa-angle-right" aria-hidden="true"></i>'
    ],
    responsive: {
        0: {
            items: 1
        },
        768: {
            items: 2
        },
        1000: {
            items: 2
        }
    }
});