$(function () {
    // Parallax
    $('.parallax-layer').parallax({
        mouseport: jQuery("#parallax"),
        yparallax: false
        },
        { xparallax: 0.2 },
        { xparallax: -0.2 },
        { xparallax: 0.1 }

        , function(){});
});
