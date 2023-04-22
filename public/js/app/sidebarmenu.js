/*
Template Name: Admin Template
Author: Wrappixel

File: js
*/
// ============================================================== 
// Auto select left navbar
// ============================================================== 
$(function () {
    "use strict";
    var url = (window.location + "").split('?')[0];
    var path = url.replace(window.location.protocol + "//" + window.location.host + "/", "");
    const currentPath = window.location.pathname.substring(1); // Obtém a URL após o domínio
    const element = $('ul#sidebarnav a').filter(function () {
      const href = this.href.split('?')[0]; // Remove a parte de querystring da URL
      const path = href.replace(window.location.origin + '/', ''); // Remove o domínio e a barra inicial da URL
      // Verifica se a URL ou o caminho da URL contém a URL atual
      return href === window.location.href || path === currentPath || (currentPath.startsWith(path) && path !== '');
    });
    element.parentsUntil(".sidebar-nav").each(function (index) {
        if ($(this).is("li") && $(this).children("a").length !== 0) {
            $(this).children("a").addClass("active");
            $(this).parent("ul#sidebarnav").length === 0
                ? $(this).addClass("active")
                : $(this).addClass("selected");
        }
        else if (!$(this).is("ul") && $(this).children("a").length === 0) {
            $(this).addClass("selected");

        }
        else if ($(this).is("ul")) {
            $(this).addClass('in');
        }

    });

    element.addClass("active");
    $('#sidebarnav a').on('click', function (e) {

        if (!$(this).hasClass("active")) {
            // hide any open menus and remove all other classes
            $("ul", $(this).parents("ul:first")).removeClass("in");
            $("a", $(this).parents("ul:first")).removeClass("active");

            // open our new menu and add the open class
            $(this).next("ul").addClass("in");
            $(this).addClass("active");

        }
        else if ($(this).hasClass("active")) {
            $(this).removeClass("active");
            $(this).parents("ul:first").removeClass("active");
            $(this).next("ul").removeClass("in");
        }
    })
    $('#sidebarnav >li >a.has-arrow').on('click', function (e) {
        e.preventDefault();
    });

});