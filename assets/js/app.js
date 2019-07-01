//Requires
require('bootstrap/dist/css/bootstrap.min.css');
require('@fortawesome/fontawesome-free/css/all.min.css');
require('@fortawesome/fontawesome-free/js/all.js');
require('infinite-scroll');
const axios = require('axios');
require('../css/style.css');
require('../css/column.css');
require("jquery");

var $ = jQuery.noConflict();

import Swup from 'swup';
const swup = new Swup();

document.addEventListener("DOMContentLoaded", () => {
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
            if($(".sidebar").hasClass("sidebar__toggle")) {
                $(".sidebar").removeClass("sidebar__toggle");
                $(".anime__search_bar__content").removeClass("sidebar__enabled");
                $("main").removeClass("sidebar__enabled");
                $(".overlay").css("display", "none");
            } else {
                $(".sidebar").addClass("sidebar__toggle");
                $(".anime__search_bar__content").addClass("sidebar__enabled");
                $("main").addClass("sidebar__enabled");
                $(".overlay").css("display", "block");
            }
        });
    });

    let acc = document.getElementsByClassName("faq-list");
    for (let i = 0; i < acc.length; i++) {
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
                $('html, body').animate({scrollTop: 0}, 'slow');
            });
            $(window).scroll(function(){
                if($(window).scrollTop() < 1){
                    $(".anime__search_bar").css({
                        "background" : "#355e7e",
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

//Infinite scroll [Disabled]
    /*$(document).ready( function  () {
        new InfiniteScroll( '.anime__list', {
            path: '.page-item:last-child .page-link',
            append: '.anime__list > .row',
            history: false,
            hideNav: '.pagination',
            status: '.page-load-status'
        });
    });*/

//Autocomplete

    $(document).ready( function () {
        setTimeout(function(){
            $("#search_query").attr('readonly', false);
            $("#search_query").focus();
        },500);
        var input = $("#search_query");
        input.on("keyup change", function () {
            if(input.val() != "") {
                $(".search_recommandation_wrapper").css("display", "block");
                $(".anime__list").css("filter", "blur(5px)");
            } else {
                $(".search_recommandation_wrapper").css("display", "none");
                $(".anime__list").css("filter", "none");
            }
            $.ajax({
                url: "http://127.0.0.1:8080/api/animes",
            }).done( function (response) {
                $(".search_recommandation").html(" ");
                response.forEach((data, index) => {
                    if(data.original_title.indexOf(input.val()) != -1) {
                        let className = (index & 1) ? 'odd' : 'even';
                        let id = "/anime/" + data.id;
                        $(".search_recommandation").append("<li class=" + className + "><a href=" + id + "><img width='100' src='/uploads/images/anime_images/" + data.image + "'><span>" + data.original_title + "</span></a></li>");
                    }
                })
            })
        });

        //Note on reviews
        $(".anime__comment__thumbs_top, .anime__comment__thumbs_down").on("click", function (e) {
            var target = $(e.target);
            var reviewId = $(".anime__comment__score").attr("id");
            var vote = parseInt($(`#${reviewId}.anime__comment__score span`).text());
            var newVote = (target.is(".anime__comment__thumbs_down")) ? vote - 1 : vote + 1;
            axios.post(`/api/review/${reviewId}`, {
                vote: newVote,
            })
                .then( function (response) {
                    axios.get(`/api/review/${reviewId}`)
                        .then( function (response) {
                            console.log(response);
                            $(`#${reviewId}.anime__comment__score span`).text(response.data.vote);
                        });
                }).catch( function (response) {
                console.error(response);
            });
        })
    });
});


