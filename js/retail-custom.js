/**
 * Retail Custom JS
 *
 * @package Retail
 *
 * Distributed under the MIT license - http://opensource.org/licenses/MIT
 */
jQuery(document).ready(function($){
    // Defining a function to adjust mobile menu and search icons position if we have a large Top Bar widget area
    function fullscreen(){

        var topbarheight = $('#top-bar').outerHeight();
        topbarheight = parseInt(topbarheight);

        if ( topbarheight > 0 ) {
            jQuery('.toggle-nav').css({
                'top' : topbarheight + 'px'
            });
            jQuery('.site-search').css({
                'top' : topbarheight + 'px'
            });
        }

        if ( ! $('#primary-menu').length ) {
            jQuery('.toggle-nav').css({
                'display' : 'none'
            });
        }

    }
  
    fullscreen();

    // Run the function in case of window resize
    jQuery(window).resize(function() {
        fullscreen();         
    });

});

jQuery(function($){

    if ( $('#home-hero-section .widget_media_image').length ) {
        $('#home-hero-section').addClass('bx-slider');
    }

    $('.bx-slider').bxSlider({
        'pager':false,
        'auto' : true,
        'mode' : 'fade',
        'pause' : 7000,
        'prevText' : '<span class="icon-chevron-left"></span>',
        'nextText' : '<span class="icon-chevron-right"></span>',
        'adaptiveHeight' : true
    });

    $('#home-hero-section .widget_media_image').each(function(){
        var MediaWidgetTitle = $('.widget-title', this).html();
        var MediaWidgetHref = $('a', this).attr('href');
        $('.widget-title', this).html('<a href="' + MediaWidgetHref + '">' + MediaWidgetTitle + '</a>');
    });

    $('.product-detail-wrap').matchHeight();

    // WooCommerce sticky add-to-cart panel
    if ( $('.woocommerce div.product form.cart').length ) {
    
        $(window).scroll(function(){
            var scrollTop = $(this).scrollTop();
            var targetTop = $(".woocommerce div.product form.cart").offset().top;
            if( scrollTop > targetTop ){
                $('#wc-sticky-addtocart').addClass('active');
            }else{
                $('#wc-sticky-addtocart').removeClass('active');
            }
        });

        $( '#wc-sticky-addtocart .options-button' ).click( function() {
            $( '#wc-sticky-addtocart table.variations' ).toggleClass( 'active' );
            $( this ).toggleClass( 'active' );
        });
    
    }

    // WooCommerce quantity buttons
    jQuery('div.quantity:not(.buttons_added), td.quantity:not(.buttons_added)').addClass('buttons_added').append('<input type="button" value="+" class="plus" />').prepend('<input type="button" value="-" class="minus" />');

    // Target quantity inputs on product pages
    jQuery('input.qty:not(.product-quantity input.qty)').each( function() {
        var min = parseFloat( jQuery( this ).attr('min') );

        if ( min && min > 0 && parseFloat( jQuery( this ).val() ) < min ) {
            jQuery( this ).val( min );
        }
    });

    jQuery( document ).on('click', '.plus, .minus', function() {

        // Get values
        var $qty        = jQuery( this ).closest('.quantity').find('.qty'),
            currentVal  = parseFloat( $qty.val() ),
            max         = parseFloat( $qty.attr('max') ),
            min         = parseFloat( $qty.attr('min') ),
            step        = $qty.attr('step');

        // Format values
        if ( ! currentVal || currentVal === '' || currentVal === 'NaN') currentVal = 0;
        if ( max === '' || max === 'NaN') max = '';
        if ( min === '' || min === 'NaN') min = 0;
        if ( step === 'any' || step === '' || step === undefined || parseFloat( step ) === 'NaN') step = 1;

        // Change the value
        if ( jQuery( this ).is('.plus') ) {

            if ( max && ( max == currentVal || currentVal > max ) ) {
                $qty.val( max );
            } else {
                $qty.val( currentVal + parseFloat( step ) );
            }

        } else {

            if ( min && ( min == currentVal || currentVal < min ) ) {
                $qty.val( min );
            } else if ( currentVal > 0 ) {
                $qty.val( currentVal - parseFloat( step ) );
            }

        }

        // Trigger change event
        $qty.trigger('change');
    });

    // Mobile Menu
    $('#primary-menu .menu-item-has-children').prepend('<span class="sub-trigger"></span>');

    $( '.toggle-nav' ).click( function() {
        $( '#page' ).toggleClass( 'is-visible' );
        $( '#masthead' ).toggleClass( 'is-visible' );
        $( this ).toggleClass( 'is-visible' );
    });
    $( '.sub-trigger' ).click( function() {
        $( this ).toggleClass( 'is-open' );
        $( this ).siblings( '.sub-menu' ).toggle( 300 );
    });

    $( '.shop-filter-wrap .shop-filter-toggle' ).click( function() {
        $( '.shop-filter-wrap #shop-filters' ).toggleClass( 'active' );
        $( this ).toggleClass( 'active' );
    });

    $( '.top-account .mini-account input' ).focusin( function() {
        $( '.top-account .mini-account' ).addClass( 'locked' );
    }).add( '.top-account .mini-account' ).focusout( function() {
        if ( !$( '.top-account .mini-account' ).is( ':focus' ) ) {
            $( '.top-account .mini-account' ).removeClass( 'locked' );
        }
    });

});

jQuery( document ).ready( function( $ ){
    $(document).on( 'added_to_wishlist removed_from_wishlist', function(){
        var counter = $('.wishlist_products_counter_number');

        $.ajax({
            url: yith_wcwl_l10n.ajax_url,
            data: {
                action: 'yith_wcwl_update_wishlist_count'
            },
            dataType: 'json',
            success: function( data ){
                counter.html( data.count );
            }
        })
    } )
});

jQuery( document ).ready( function( $ ){

    $('ul#primary-menu.demo-menu li').find('ul').each(function(){
        if( $(this).hasClass('children') ){
            $(this).parent().addClass('menu-item-has-children');
            $('#primary-menu .menu-item-has-children').prepend('<span class="sub-trigger"></span>');

            $( '.sub-trigger' ).click( function() {
                $( this ).toggleClass( 'is-open' );
                $( this ).siblings( 'ul#primary-menu.demo-menu > li > ul.children' ).toggle( 300 );
            });

        }
    });
});