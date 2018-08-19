(function ($) {
    "use strict";

    /*---------------------------------------------------
     Banner Slider (Default Owl Carousel)
     ----------------------------------------------------- */
    $('#banner0').owlCarousel({
        items: 6,
        autoPlay: 3000,
        singleItem: true,
        navigation: false,
        pagination: false,
        transitionStyle: 'fade'
    });
    /*---------------------------------------------------
     Scroll to top
     ----------------------------------------------------- */
    $(function () {
        $(window).scroll(function () {
            if ($(this).scrollTop() > 150) {
                $('#back-top').fadeIn();
            } else {
                $('#back-top').fadeOut();
            }
        });
    });
    $('.backtotop').click(function () {

        $('html, body').animate({scrollTop: 0}, 'slow');

    });

    /*---------------------------------------------------
     Language and Currency slideDown
     ----------------------------------------------------- */
    $('#currency, #language, #my_account').hover(function () {

        $(this).find('ul').stop(true, true).slideDown('fast');

    }, function () {

        $(this).find('ul').stop(true, true).css('display', 'none');

    });
    /*---------------------------------------------------
     Cart slideDown
     ----------------------------------------------------- */
    $('#cart').hover(function () {
        $('#cart').addClass("open");
        $('#cart').find('ul').stop(true, true).slideDown('fast');

    }, function () {
        $('#cart').removeClass("open");
        $('#cart').find('ul').stop(true, true).css('display', 'none');

    });


    /******** Top Custom Block ********/
    $('#header .links > ul > li.wrap_custom_block > div').each(function () {
        var menu = $('.header-row').offset();
        var dropdown = $(this).parent().offset();

        var i = (dropdown.left + $(this).outerWidth()) - (menu.left + $('.header-row').outerWidth());

        if (i > 0) {
            $(this).css('margin-left', '-' + (i + 5) + 'px');
        }
    });

    $(document).ready(function () {
        /*---------------------------------------------------
         Product Quantity
         ----------------------------------------------------- */
        function thebigshop_quantity() {
            $(".qtyBtn.plus").on("click", function () {
                var $inputqty = $(this).closest(".qty.quantity").find(".qty");
                var cvalue = parseInt($inputqty.val());
                if (!isNaN(cvalue)) {
                    $inputqty.val(cvalue + 1);
                }
                $inputqty.trigger("change");
            });
            $(".qtyBtn.mines").on("click", function () {
                var $inputqty = $(this).closest(".qty.quantity").find(".qty");
                var cvalue = parseInt($inputqty.val());
                if (!isNaN(cvalue) && cvalue > 1) {
                    $inputqty.val(cvalue - 1);
                }
                $inputqty.trigger("change");
            });
        }
        thebigshop_quantity();
        $(document.body).on("updated_wc_div", function () {
            thebigshop_quantity();
        });


        /*---------------------------------------------------
         Slider (Default Flexslider)
         ----------------------------------------------------- */

        $('#carousel').flexslider({
            animation: "slide",
            controlNav: false,
            animationLoop: false,
            slideshow: false,
            itemWidth: 75,
            itemMargin: 7,
            asNavFor: '#slider',
            prevText: "", //String: Set the text for the "previous" directionNav item
            nextText: "",
        });

        $('#slider').flexslider({
            animation: "slide",
            controlNav: false,
            animationLoop: false,
            slideshow: false,
            sync: "#carousel",
            prevText: "", //String: Set the text for the "previous" directionNav item
            nextText: "",
        });

        $('.slider-wrapper .flexslider').flexslider({
            animation: "slide",
            animationLoop: false,
            slideshow: true,
            slideshowSpeed: 7000,
            animationSpeed: 600,
            controlNav: false,
            directionNav: true,
            prevText: " ",
            nextText: " ",
        });

        /*---------------------------------------------------
         Product Categories
         ----------------------------------------------------- */

        $(".product-categories .cat-parent > a").after("<span class='down'></span>");
        $('.product-categories').cutomAccordion({
            classExpand: 'cat-parent',
            menuClose: false,
            autoClose: true,
            saveState: false,
            disableLink: false,
            autoExpand: false
        });
        $('.product-categories .current-cat > a').addClass('active');
        $('.product-categories .current-cat .children').css("display", "block");


        /*---------------------------------------------------
         Highlight Errors
         ----------------------------------------------------- */
        $('.text-danger').each(function () {
            var element = $(this).parent().parent();

            if (element.hasClass('form-group')) {
                element.addClass('has-error');
            }
        });

     
        /*---------------------------------------------------
         Product List
         ----------------------------------------------------- */
        $('#list-view').click(function () {
            $(".products-category > .clearfix.visible-lg-block").remove();

            $('#content .product-layout').attr('class', 'product-layout product-list col-xs-12');

            localStorage.setItem('display', 'list');

            $('.btn-group').find('#list-view').addClass('selected');
            $('.btn-group').find('#grid-view').removeClass('selected');
        });
        /*---------------------------------------------------
         tooltips on hover
         ----------------------------------------------------- */
        $('[data-toggle=\'tooltip\']').tooltip({container: 'body'});
        // Makes tooltips work on ajax generated content
        $(document).ajaxStop(function () {
            $('[data-toggle=\'tooltip\']').tooltip({container: 'body'});
        });

        /******** nivoSlider ********/

        $('#slideshownivo').nivoSlider({
            prevText: '<i class="fa fa-chevron-left"></i>',
            nextText: '<i class="fa fa-chevron-right"></i>',
        });

        $('#slideshowowl').owlCarousel({
            items: 6,
            autoPlay: 3000,
            singleItem: true,
            navigation: true,
            navigationText: ['<i class="fa fa-chevron-left"></i>', '<i class="fa fa-chevron-right"></i>'],
            pagination: true
        });
        /******** Top Custom Block ********/
        $('#header .links > ul > li.wrap_custom_block > div').each(function () {
            var menu = $('.header-row').offset();
            var dropdown = $(this).parent().offset();

            var i = (dropdown.left + $(this).outerWidth()) - (menu.left + $('.header-row').outerWidth());

            if (i > 0) {
                $(this).css('margin-left', '-' + (i + 5) + 'px');
            }
        });


        $('.drop-icon').click(function () {
            //$(this).toggleClass("active");  
            $('#header .htop').find('.left-top').slideToggle('fast');
        });


        $('.wrap_custom_block').mouseover(function () {
            $(this).find('> .custom_block').slideDown('fast');
            $(this).bind('mouseleave', function () {
                $(this).find('> .custom_block').css('display', 'none');
            });
        });
    /*---------------------------------------------------
     Portfolio
     ----------------------------------------------------- */
	$('#portfolio-list').filterable();
        
    });
    /*---------------------------------------------------
     Language and Currency Switcher
     ----------------------------------------------------- */
    $('.wcml_currency_switcher, .wcml_language_switcher').select2({
        allowClear: false,
        minimumResultsForSearch: Infinity,
    });
    $('select.wcml_language_switcher').change(function () {
        window.location = jQuery(this).val();
    });

 

    /*---------------------------------------------------
     Testimonial Slider (Default Owl Carousel)
     ----------------------------------------------------- */
    $("#testimonial-slider").owlCarousel({
        items: 2,
        itemsDesktop: [1000, 2],
        itemsDesktopSmall: [979, 2],
        itemsTablet: [767, 1],
        pagination: true,
        autoPlay: true
    });
    /*---------------------------------------------------
     Brand Slider (Default Owl Carousel)
     ----------------------------------------------------- */
    $('#brand-slider').owlCarousel({
        items: 6,
        autoPlay: 3000,
        lazyLoad: true,
        navigation: true,
        navigationText: ['<i class="fa fa-angle-left"></i>', '<i class="fa fa-angle-right"></i>'],
        pagination: true
    });
    
    /*---------------------------------------------------
      Dropdown Menu
      ----------------------------------------------------- */
    jQuery(document).ready(function () {
        var screensize = jQuery(window).width();
        /******** Menu Show Hide Sub Menu ********/
        jQuery('#menu .nav > li').mouseover(function () {
            if (screensize > 991) {
                
            jQuery(this).find('> ul').stop(true, true).slideDown('fast');
            }
            jQuery(this).bind('mouseleave', function () {
		if (screensize > 991) {
                jQuery(this).find('> ul').stop(true, true).css('display', 'none');
                 }
            });
        });
        jQuery('#menu .nav > li > ul li').mouseover(function () {
			if (screensize > 991) {
            jQuery(this).find('> ul').stop(true, true).slideDown('fast');
}
            jQuery(this).bind('mouseleave', function () {
		if (screensize > 991) {
                jQuery(this).find('> ul').stop(true, true).css('display', 'none');
                }
            });
        });

    });
      /*---------------------------------------------------
      Navigation Menu
      ----------------------------------------------------- */
jQuery('#menu .navbar-header > span').click(function () {
	  jQuery(this).toggleClass("active");  
	  jQuery("#menu .navbar-collapse").slideToggle('medium');
	});

jQuery('#menu .nav > li > ul.dropdown-menu > li.dropdown-submenu ul, .submenu, #menu .nav > li > ul').before('<span class="submore"></span>');
		jQuery('span.submore').click(function () {
            jQuery(this).next().slideToggle('fast');
            jQuery(this).toggleClass('plus');
                    });

})(jQuery);