var slide = 0;
var slide_max = 4;
var interval = 0;
function gotoSlide(n)
{
    if (n < window.slide)
    {
        gotoSlideL(n);
    }
    else
    {
        $("#rarrow").removeAttr("style");
        $("#s"+window.slide).removeAttr("style");
        $("#pack-info2").removeAttr("style");
        $("#pack-info2").css("background-image","url(img/slides/slide_"+window.slide+".png)");
        $("#pack-info2").css("backgroundPositionX",0);
        $("#pack-info2").animate({ backgroundPositionX: -925 }, 500);
        window.slide = n;
        if (window.slide > slide_max) window.slide = 0;
        $("#pack-info").removeAttr("style");
        $("#pack-info").css("background-image","url(img/slides/slide_"+window.slide+".png)");
        $("#pack-info").css("backgroundPositionX",925);
        $("#pack-info").animate({ backgroundPositionX: 0 }, 500);
        $("#s"+window.slide).css("background-image","url(img/slides/circle_hover.png)");
    }
}
function gotoSlideL(n)
{
    $("#larrow").removeAttr("style");
    $("#s"+window.slide).removeAttr("style");
    $("#pack-info2").removeAttr("style");
    $("#pack-info2").css("background-image","url(img/slides/slide_"+window.slide+".png)");
    $("#pack-info2").css("backgroundPositionX",0);
    $("#pack-info2").animate({ backgroundPositionX: 925 }, 500);
    window.slide = n;
    if (window.slide < 0) window.slide = slide_max;
    $("#pack-info").removeAttr("style");
    $("#pack-info").css("background-image","url(img/slides/slide_"+window.slide+".png)");
    $("#pack-info").css("backgroundPositionX",-925);
    $("#pack-info").animate({ backgroundPositionX: 0 }, 500);
    $("#s"+window.slide).css("background-image","url(img/slides/circle_hover.png)");
}
$(document).ready(function() {
    $("#s0").css("background-image","url(img/slides/circle_hover.png)");
    window.interval = window.setInterval(function() {
        gotoSlide(window.slide + 1);
    }, 5000);
    $("#s0").click(function() {
        gotoSlide(0);
        window.clearInterval(window.interval)
        window.interval = 0;
    });
    $("#s1").click(function() {
        gotoSlide(1);
        window.clearInterval(window.interval)
        window.interval = 0;
    });
    $("#s2").click(function() {
        gotoSlide(2);
        window.clearInterval(window.interval)
        window.interval = 0;
    });
    $("#s3").click(function() {
        gotoSlide(3);
        window.clearInterval(window.interval)
        window.interval = 0;
    });
    $("#s4").click(function() {
        gotoSlide(4);
        window.clearInterval(window.interval)
        window.interval = 0;
    });
    $("#larrow").click(function() {
        track("Used carousel");
        gotoSlideL(window.slide - 1);
        $("#larrow").animate({backgroundPositionX:4},100).animate({backgroundPositionX:-4},100).animate({backgroundPositionX:0},100);
        window.clearInterval(window.interval)
        window.interval = 0;
    });
    $("#rarrow").click(function() {
        track("Used carousel");
        gotoSlide(window.slide + 1);
        $("#rarrow").animate({backgroundPositionX:-4},100).animate({backgroundPositionX:4},100).animate({backgroundPositionX:0},100);
        window.clearInterval(window.interval)
        window.interval = 0;
    });
    $("#pack-info").click(function() {
        if (window.interval > -1)
        {
            window.clearInterval(window.interval)
            window.interval = -1;
        }
        else
        {
            track("Used carousel");
            gotoSlide(window.slide + 1);
            window.interval = window.setInterval(function() {
                gotoSlide(window.slide + 1);
            }, 5000);
        }
    });
});

