jQuery(document).ready(function ($) {

    $(document).ready(function (e) {
        checkDesktop = window.matchMedia('(min-width: 992px)');
        checkTablet = window.matchMedia('(min-width: 768px) and (max-width: 991px)');
        checkMobile = window.matchMedia('(max-width: 767px)');

    });

    $(document).ready(function (e) {

        if (checkMobile.matches) {
            $(window).trigger('mobile');
        } else if (checkTablet.matches) {
            $(window).trigger('tablet');
        } else {
            console.log('init desk');
            $(window).trigger('desktop');
        }

    });

    $(document).ready(function (e) {

        checkDesktop.addListener(function (event) {
            if (event.matches) {
                $(window).trigger('desktop');
            }
        });
        checkTablet.addListener(function (event) {
            if (event.matches) {
                $(window).trigger('tablet');
            }
        });
        checkMobile.addListener(function (event) {
            if (event.matches) {
                $(window).trigger('mobile');
            }
        });
    });

    $(window).on('mobile', function (e) {
        var swiper = new Swiper('.swiper-container', {
            slidesPerView: '1', //'auto'
            spaceBetween: 30,
            //loop: true,
            pagination: {
                el: '.swiper-pagination',
                clickable: true,
            },
            navigation: {
                nextEl: '.swiper-button-next',
                prevEl: '.swiper-button-prev',
            },
        });
    });

    $(window).on('tablet', function (e) {
        var swiper = new Swiper('.swiper-container', {
            slidesPerView: '2', //'auto'
            spaceBetween: 30,
            //loop: true,
            pagination: {
                el: '.swiper-pagination',
                clickable: true,
            },
            navigation: {
                nextEl: '.swiper-button-next',
                prevEl: '.swiper-button-prev',
            },
        });
    });


    $(window).on('desktop', function (e) {
        var swiper = new Swiper('.swiper-container', {
            slidesPerView: '3', //'auto'
            spaceBetween: 30,
            //loop: true,
            pagination: {
                el: '.swiper-pagination',
                clickable: true,
            },
            navigation: {
                nextEl: '.swiper-button-next',
                prevEl: '.swiper-button-prev',
            },
        });
    });

});








