jQuery(function($) {

    /* -----------------------------------------
    Preloader
    ----------------------------------------- */
    $('#preloader').delay(1000).fadeOut();
    $('#loader').delay(1000).fadeOut("slow");

    /* -----------------------------------------
    Navigation
    ----------------------------------------- */
    $('.menu-toggle').click(function() {
        $(this).toggleClass('open');
    });

    /* -----------------------------------------
    Keyboard Navigation
    ----------------------------------------- */
    $(window).on('load resize', coffee_espresso_navigation)

    function coffee_espresso_navigation(event) {
        if ($(window).width() < 1200) {
            $('.main-navigation').find("li").last().bind('keydown', function(e) {
                if (e.shiftKey && e.which === 9) {
                    if ($(this).hasClass('focus')) {
                    }

                } else if (e.which === 9) {
                    e.preventDefault();
                    $('#masthead').find('.menu-toggle').focus();
                }                
            })
        } else {
            $('.main-navigation').find("li").unbind('keydown')
        }
    }

    coffee_espresso_navigation()

    var coffee_espresso_primary_menu_toggle = $('#masthead .menu-toggle');
    coffee_espresso_primary_menu_toggle.on('keydown', function(e) {
        var tabKey = e.keyCode === 9;
        var shiftKey = e.shiftKey;

        if (coffee_espresso_primary_menu_toggle.hasClass('open')) {
            if (shiftKey && tabKey) {
                e.preventDefault();
                const $the_last_li = $('.main-navigation').find("li").last()
                $the_last_li.find('a').focus()
                if (!$the_last_li.hasClass('focus')) {

                    const $is_parent_on_top = true
                    let $the_parent_ul = $the_last_li.closest('ul.sub-menu')

                    let count = 0

                    while (!!$the_parent_ul.length) {
                        ++count

                        const $the_parent_li = $the_parent_ul.closest('li')

                        if (!!$the_parent_li.length) {
                            $the_parent_li.addClass('focus')
                            $the_parent_ul = $the_parent_li.closest('ul.sub-menu')

                            // Blur the cross
                            $(this).blur()
                            $the_last_li.addClass('focus')
                        }

                        if (!$the_parent_ul.length) {
                            break;
                        }
                    }

                }

            };
        }
    })

    /* -----------------------------------------
    Main Slider
    ----------------------------------------- */

    // Determine if the document is RTL
    var isRtl = $('html').attr('dir') === 'rtl';
    
    jQuery(document).ready(function($) {
        jQuery('.product-box .owl-carousel').owlCarousel({
            margin: 20,
            nav: false,
            autoplay: false,
            lazyLoad: true,
            rtl:false,
            autoplayTimeout: 5000,
            loop: true,
            dots: false,
            responsive: {
            0: {
            items: 1,
            },
            601: {
            margin: 20,
            items: 2
            },
            1000: {
            items: 3
            },
            1200: {
            items: 4
            },
            autoplayHoverPause: false,
            mouseDrag: true
            },
        });
    });
    
    /* -----------------------------------------
    Scroll Top
    ----------------------------------------- */
    var coffee_espresso_scrollToTopBtn = $('.coffee-espresso-scroll-to-top');

    $(window).scroll(function() {
        if ($(window).scrollTop() > 400) {
            coffee_espresso_scrollToTopBtn.addClass('show');
        } else {
            coffee_espresso_scrollToTopBtn.removeClass('show');
        }
    });

    coffee_espresso_scrollToTopBtn.on('click', function(e) {
        e.preventDefault();
        $('html, body').animate({
            scrollTop: 0
        }, '300');
    });

    // Inject cart icon into WooCommerce "View Cart" link in product section
    function coffeeEspressoInjectViewCartIcon() {
        jQuery('.product-section .product-footer-box .addcart a.added_to_cart.wc-forward').each(function() {
            if ( jQuery(this).find('i.fas').length === 0 ) {
                jQuery(this).html('<i class="fas fa-eye"></i>');
            }
        });
    }

    // Runs after WC injects the button (added_to_cart fires before DOM update, so use 100ms delay)
    jQuery(document.body).on('added_to_cart', function() {
        setTimeout( coffeeEspressoInjectViewCartIcon, 100 );
    });

    // Also run after WC cart fragments refresh (covers page load when already in cart)
    jQuery(document.body).on('wc_fragments_refreshed wc_fragments_loaded', function() {
        coffeeEspressoInjectViewCartIcon();
    });

    // MutationObserver: catch the link the moment WC injects it into the DOM
    if ( typeof MutationObserver !== 'undefined' ) {
        var coffeeEspressoObserver = new MutationObserver( function( mutations ) {
            mutations.forEach( function( mutation ) {
                mutation.addedNodes.forEach( function( node ) {
                    if ( node.nodeType === 1 ) {
                        var $node = jQuery( node );
                        if ( $node.is( 'a.added_to_cart.wc-forward' ) || $node.find( 'a.added_to_cart.wc-forward' ).length ) {
                            coffeeEspressoInjectViewCartIcon();
                        }
                    }
                });
            });
        });
        var coffeeEspressoProductSection = document.querySelector( '.product-section .product-box' );
        if ( coffeeEspressoProductSection ) {
            coffeeEspressoObserver.observe( coffeeEspressoProductSection, { childList: true, subtree: true } );
        }
    }

});

/* Progress Bar */
document.addEventListener("DOMContentLoaded", function () {
    const coffee_espresso_progressBar =
        document.getElementById("coffee_espresso_aster_progress_bar");
    if (!coffee_espresso_progressBar) return;
    window.addEventListener("scroll", function () {
        const coffee_espresso_scrollTop =
            document.documentElement.scrollTop || document.body.scrollTop;
        const coffee_espresso_height =
            document.documentElement.scrollHeight -
            document.documentElement.clientHeight;
        const coffee_espresso_scrolled =
            (coffee_espresso_scrollTop / coffee_espresso_height) * 100;
        coffee_espresso_progressBar.style.width =
            coffee_espresso_scrolled + "%";
    });
});