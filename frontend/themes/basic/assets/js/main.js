(function() {
    'use strict';

    function trackScroll() {
        var scrolled = window.pageYOffset;
        var coords = document.documentElement.clientHeight;

        if (scrolled > coords) {
            goTopBtn.classList.add('back_to_top-show');
        }
        if (scrolled < coords) {
            goTopBtn.classList.remove('back_to_top-show');
        }
    }

    function backToTop() {
        if (window.pageYOffset > 0) {
            window.scrollBy(0, -80);
            setTimeout(backToTop, 0);
        }
    }

    var goTopBtn = document.querySelector('.scrolltop');

    window.addEventListener('scroll', trackScroll);
    goTopBtn.addEventListener('click', backToTop);
})();

var mobileMenu = (function () {
    var btn = document.getElementById('mobileBtn');
    var menu = document.getElementById('mobile-menu');
    btn.addEventListener('click', function () {
        if (btn.classList.contains('active')) {
            btn.classList.remove('active');
            menu.classList.remove('active');
        } else {
            btn.classList.add('active');
            menu.classList.add('active');
        }
    })
})();


//new LazyLoad();