//Requires
require('../css/style.css');
require('../css/column.css');
require('bootstrap/dist/css/bootstrap.css');
require('@fortawesome/fontawesome-free/css/all.min.css');
require('@fortawesome/fontawesome-free/js/all.js');
require('infinite-scroll');

var $ = require("jquery");
$ = jQuery.noConflict();

$(document).ready( function () {
    $(".anime__star").on("mouseover", function () {
        $(".anime__star").removeClass("star__colored");
        let id = $(this).attr("id");
        id = id.split("-");
        id = parseInt(id[1]);
        for(let i = 0; i < id; i++) {
            $("#star-" + i).addClass("star__colored");
        }
        $("#star-" + id).addClass("star__colored");
        $("#star-" + id).on("click", function () {
            $("#review_note").val(id);
        });
    });
});

$(document).ready( function () {
    $(".menu__toggle").on("click", function () {
        $(".sidebar").addClass("sidebar__toggle");
        $(".overlay").css("display", "block");
        $("body").css("overflow", "hidden");
    });
    $(".overlay").on("click", function () {
        $(".sidebar").removeClass("sidebar__toggle");
        $(".overlay").css("display", "none");
        $("body").css("overflow", "visible");
    })
});

let acc = document.getElementsByClassName("faq-list");
let i;

for (i = 0; i < acc.length; i++) {
    acc[i].addEventListener("click", function() {
        this.classList.toggle("active__faq");
        var panel = this.nextElementSibling;
        if (panel.style.maxHeight){
            panel.style.maxHeight = null;
        } else {
            panel.style.maxHeight = panel.scrollHeight + "px";
        }
    });
}

$(document).ready(function() {
    function scroll_to_top(div) {
        $(div).click(function() {
            $('html,body').animate({scrollTop: 0}, 'slow');
        });
        $(window).scroll(function(){
            if($(window).scrollTop() < 1){
                $(".anime__search_bar").css({
                    "background" : "#fff",
                    "padding" : "25px"
                });
                $(".navbar__img").removeClass("reduce_logo");
                $(div).fadeOut();
            } else{
                $(".anime__search_bar").css({
                    "background" : "#355e7e",
                    "padding" : "10px"
                });
                $(".navbar__img").addClass("reduce_logo");
                $(div).fadeIn();
            }
        });
    }
    scroll_to_top("#scroll_to_top");
});

$(document).ready( function () {
    $(".youtube").on("click", function () {
        $(".anime__overlay_embed").addClass("visible__overlay")
    });
    $(".anime__overlay_embed").on("click", function () {
        $(this).removeClass("visible__overlay");
    });
});


$(document).ready( function  () {
    new InfiniteScroll( '.anime__list', {
        path: '.page-item:last-child .page-link',
        append: '.anime__list > .row',
        history: false,
        hideNav: '.pagination'
    });
});