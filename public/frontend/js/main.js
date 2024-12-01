$(function () {

    "use strict";

    //======MENU FIX JS======
    if ($('.main_menu').offset() != undefined) {
        $(window).bind('scroll', function () {
            if ($(window).scrollTop() > 10) {
                $('.main_menu').addClass('menu_fix');
            } else {
                $('.main_menu').removeClass('menu_fix');
            }
        });
    }


    //=======SELECT2======
    $(document).ready(function () {
        $('.select_2').select2();
    });


    //=========COUNTER.JS=========
    $('.counter').countUp();


    //=======CATEGORY SLIDER======
    $('.category_slider').slick({
        slidesToShow: 6,
        slidesToScroll: 1,
        autoplay: true,
        autoplaySpeed: 4000,
        dots: true,
        arrows: false,

        responsive: [
            {
                breakpoint: 1400,
                settings: {
                    slidesToShow: 5,
                }
            },
            {
                breakpoint: 1200,
                settings: {
                    slidesToShow: 4,
                }
            },
            {
                breakpoint: 992,
                settings: {
                    slidesToShow: 3,
                }
            },
            {
                breakpoint: 768,
                settings: {
                    slidesToShow: 2,
                }
            },
            {
                breakpoint: 576,
                settings: {
                    slidesToShow: 1,
                }
            }
        ]

    });


    //=======FEATURED SERVICE SLIDER======
    $('.featured_service_slider').slick({
        slidesToShow: 3,
        slidesToScroll: 1,
        autoplay: true,
        autoplaySpeed: 4000,
        dots: false,
        arrows: true,
        nextArrow: '<i class="far fa-long-arrow-right nextArrow"></i>',
        prevArrow: '<i class="far fa-long-arrow-left prevArrow"></i>',

        responsive: [
            {
                breakpoint: 1200,
                settings: {
                    slidesToShow: 3,
                }
            },
            {
                breakpoint: 992,
                settings: {
                    slidesToShow: 2,
                }
            },
            {
                breakpoint: 768,
                settings: {
                    slidesToShow: 1,
                }
            },
            {
                breakpoint: 576,
                settings: {
                    slidesToShow: 1,
                }
            }
        ]
    });


    //=======TESTIMONIAL SLIDER======
    $('.testi_slider').slick({
        slidesToShow: 2,
        slidesToScroll: 1,
        autoplay: true,
        autoplaySpeed: 4000,
        dots: true,
        arrows: false,

        responsive: [
            {
                breakpoint: 992,
                settings: {
                    slidesToShow: 1,
                }
            },
            {
                breakpoint: 768,
                settings: {
                    slidesToShow: 1,
                }
            },
            {
                breakpoint: 576,
                settings: {
                    slidesToShow: 1,
                }
            }
        ]
    });


    //*==========STICKY SIDEBAR=========
    $("#sticky_sidebar").stickit({
        top: 95,
    })


    //=========calender.js=========
    $(function () {
        $('#calendar_js').calendar({
            months: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
            days: ['Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat', 'Sun']
        });
    });


    //=======TESTIMONIAL SLIDER======
    $('.blog_det_slider').slick({
        slidesToShow: 2,
        slidesToScroll: 1,
        autoplay: true,
        autoplaySpeed: 4000,
        dots: true,
        arrows: false,

        responsive: [
            {
                breakpoint: 992,
                settings: {
                    slidesToShow: 2,
                }
            },
            {
                breakpoint: 768,
                settings: {
                    slidesToShow: 1,
                }
            },
            {
                breakpoint: 576,
                settings: {
                    slidesToShow: 1,
                }
            }
        ]
    });


    //=======CATEGORY SLIDER 2 ======
    $('.category_slider2').slick({
        slidesToShow: 6,
        slidesToScroll: 1,
        autoplay: false,
        autoplaySpeed: 4000,
        dots: true,
        arrows: false,

        responsive: [
            {
                breakpoint: 1400,
                settings: {
                    slidesToShow: 5,
                }
            },
            {
                breakpoint: 1200,
                settings: {
                    slidesToShow: 4,
                }
            },
            {
                breakpoint: 992,
                settings: {
                    slidesToShow: 3,
                }
            },
            {
                breakpoint: 768,
                settings: {
                    slidesToShow: 2,
                }
            },
            {
                breakpoint: 576,
                settings: {
                    slidesToShow: 1,
                }
            }
        ]
    });

    //=======FEATURED SERVICE SLIDER======
    $('.featured_service_slider2').slick({
        slidesToShow: 3,
        slidesToScroll: 1,
        autoplay: true,
        autoplaySpeed: 4000,
        dots: true,
        arrows: false,

        responsive: [
            {
                breakpoint: 1200,
                settings: {
                    slidesToShow: 3,
                }
            },
            {
                breakpoint: 992,
                settings: {
                    slidesToShow: 2,
                }
            },
            {
                breakpoint: 768,
                settings: {
                    slidesToShow: 1,
                }
            },
            {
                breakpoint: 576,
                settings: {
                    slidesToShow: 1,
                }
            }
        ]
    });


    //=======TESTIMONIAL2 SLIDER======
    $('.testi_slider2').slick({
        slidesToShow: 3,
        slidesToScroll: 1,
        autoplay: true,
        autoplaySpeed: 4000,
        dots: true,
        arrows: false,

        responsive: [
            {
                breakpoint: 1200,
                settings: {
                    slidesToShow: 2,
                }
            },
            {
                breakpoint: 992,
                settings: {
                    slidesToShow: 2,
                }
            },
            {
                breakpoint: 768,
                settings: {
                    slidesToShow: 1,
                }
            },
            {
                breakpoint: 576,
                settings: {
                    slidesToShow: 1,
                }
            }
        ]
    });



    //=======CATEGORY SLIDER 3 ======
    $('.category_slider3').slick({
        slidesToShow: 4,
        slidesToScroll: 1,
        autoplay: false,
        autoplaySpeed: 4000,
        dots: true,
        arrows: false,

        responsive: [
            {
                breakpoint: 1200,
                settings: {
                    slidesToShow: 4,
                }
            },
            {
                breakpoint: 992,
                settings: {
                    slidesToShow: 3,
                }
            },
            {
                breakpoint: 768,
                settings: {
                    slidesToShow: 2,
                }
            },
            {
                breakpoint: 576,
                settings: {
                    slidesToShow: 1,
                }
            }
        ]

    });


    //=======FEATURED SERVICE SLIDER======
    $('.featured_service_slider3').slick({
        slidesToShow: 3,
        slidesToScroll: 1,
        autoplay: true,
        autoplaySpeed: 4000,
        dots: true,
        arrows: false,

        responsive: [
            {
                breakpoint: 1200,
                settings: {
                    slidesToShow: 3,
                }
            },
            {
                breakpoint: 992,
                settings: {
                    slidesToShow: 2,
                }
            },
            {
                breakpoint: 768,
                settings: {
                    slidesToShow: 1,
                }
            },
            {
                breakpoint: 576,
                settings: {
                    slidesToShow: 1,
                }
            }
        ]
    });


    //*==========SCROLL BUTTON==========
    $('.wsus__scroll_btn').on('click', function () {
        $('html, body').animate({
            scrollTop: 0,
        }, 500);
    });

    $(window).on('scroll', function () {
        var scrolling = $(this).scrollTop();
        if (scrolling > 300) {
            $('.wsus__scroll_btn').fadeIn();
        } else {
            $('.wsus__scroll_btn').fadeOut();
        }
    });


    //*==========ORDER HISTORY==========
    $(".view_invoice").on("click", function () {
        $(".wsus_dashboard_order").fadeOut();
    });

    $('.view_invoice').on('click', function () {
        $(".wsus__invoice").fadeIn();
    });

    $(".go_back").on("click", function () {
        $(".wsus_dashboard_order").fadeIn();
    });

    $(".go_back").on("click", function () {
        $(".wsus__invoice").fadeOut();
    });



    //*==========DASHBOARD TICKET==========
    $(".ticket_invoice_view").on("click", function () {
        $(".support_ticket").fadeOut();
    });

    $('.ticket_invoice_view').on('click', function () {
        $(".wsus__ticket_list_view").fadeIn();
    });

    $(".go_ticket").on("click", function () {
        $(".support_ticket").fadeIn();
    });

    $(".go_ticket").on("click", function () {
        $(".wsus__ticket_list_view").fadeOut();
    });


    $(".dash_info_btn").click(function () {
        $(".wsus_dash_personal_info").toggleClass("show");
    });

    $(".dash_info_btn").click(function () {
        $(".dash_info_btn").toggleClass("active");
    });


    //=======FEATURED SERVICE SLIDER======
    $('.related_services_slider').slick({
        slidesToShow: 3,
        slidesToScroll: 1,
        autoplay: true,
        autoplaySpeed: 4000,
        dots: false,
        arrows: true,
        nextArrow: '<i class="far fa-angle-right nextArrow"></i>',
        prevArrow: '<i class="far fa-angle-left prevArrow"></i>',

        responsive: [
            {
                breakpoint: 1200,
                settings: {
                    slidesToShow: 3,
                }
            },
            {
                breakpoint: 992,
                settings: {
                    slidesToShow: 2,
                }
            },
            {
                breakpoint: 768,
                settings: {
                    slidesToShow: 1,
                }
            },
            {
                breakpoint: 576,
                settings: {
                    slidesToShow: 1,
                }
            }
        ]
    });


    //=======MOBILE MENU ICON======
    $(".navbar-toggler").on("click", function () {
        $(".navbar-toggler").toggleClass("show_m_close");
    });

    $(".wsus__message__button").click(function () {
        $(".wsus__message_area").addClass("show_chat");
    });

    $(".close_chat").click(function () {
        $(".wsus__message_area").removeClass("show_chat");
    });




});
