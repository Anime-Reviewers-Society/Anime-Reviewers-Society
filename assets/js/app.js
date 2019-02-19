//Requires
require('../css/style.css');
require('../css/admin/app.css');
require('bootstrap/dist/css/bootstrap.css');
require('@fortawesome/fontawesome-free/css/all.min.css');
require('@fortawesome/fontawesome-free/js/all.js');

var $ = require("jquery");
$(document).ready(function () {
    $(".menu__toggle, .overlay").on( "click", function () {
        console.log("clicked");
        if($(".sidebar").hasClass("sidebar__toggle")) {
            $(".overlay").css("display", "none");
            $(".sidebar").removeClass("sidebar__toggle");
            $(this).removeClass("menu__hidden");
        } else {
            $(".sidebar").addClass("sidebar__toggle");
            $(".overlay").css("display", "block");
            $(this).addClass("menu__hidden");
        }
    });
    $(".sidebar__item").on("click", function () {
        if($(this).has("sidebar__child_menu")) {
            $(".sidebar__child_menu").css("display", "block");
        }
    })
});
