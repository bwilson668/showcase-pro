<?php

add_action( 'wp_head', 'genesis_custom_header_style' );
/**
 * Custom header callback.
 *
 * It outputs special CSS to the document head, modifying the look of the header based on user input.
 *
 * @since 1.6.0
 *
 * @uses genesis_html() Check for HTML5 support.
 *
 * @return null Return null on if custom header not supported, user specified own callback, or no options set.
 */
function genesis_custom_header_style() {

    //* Do nothing if custom header not supported
    if ( ! current_theme_supports( 'custom-header' ) )
        return;

    //* Do nothing if user specifies their own callback
    if ( get_theme_support( 'custom-header', 'wp-head-callback' ) )
        return;

    $output = '';

    $header_image = get_header_image();
    $text_color   = get_header_textcolor();

    //* If no options set, don't waste the output. Do nothing.
    if ( empty( $header_image ) && ! display_header_text() && $text_color === get_theme_support( 'custom-header', 'default-text-color' ) )
        return;

    $header_selector = get_theme_support( 'custom-header', 'header-selector' );
    $title_selector  = genesis_html5() ? '.custom-header .site-title'       : '.custom-header #title';
    $desc_selector   = genesis_html5() ? '.custom-header .site-description' : '.custom-header #description';

    //* Header selector fallback
    if ( ! $header_selector )
        $header_selector = genesis_html5() ? '.custom-header .site-header' : '.custom-header #header';

    //* Header image CSS, if exists
    if ( $header_image )
        $output .= sprintf( '%s { background: url(%s) no-repeat !important; }', $header_selector, esc_url( $header_image ) );

    //* Header text color CSS, if showing text
    if ( display_header_text() && $text_color !== get_theme_support( 'custom-header', 'default-text-color' ) )
        $output .= sprintf( '%2$s a, %2$s a:hover, %3$s { color: #%1$s !important; }', esc_html( $text_color ), esc_html( $title_selector ), esc_html( $desc_selector ) );

    if ( $output )
        printf( '<style type="text/css">%s</style>' . "\n", $output );

}

add_action( 'genesis_header', 'genesis_header_markup_open', 5 );
/**
 * Echo the opening structural markup for the header.
 *
 * @since 1.2.0
 *
 * @uses genesis_markup()          Apply contextual markup.
 * @uses genesis_structural_wrap() Maybe add opening .wrap div tag with header context.
 */
function genesis_header_markup_open() {

    genesis_markup( array(
        'html5'   => '<header %s>',
        'xhtml'   => '<div id="header">',
        'context' => 'site-header',
    ) );

    echo '<div class="throwing-shade shade-divider"></div>';

    genesis_structural_wrap( 'header' );

}

// add_action( 'genesis_header', 'genesis_header_markup_close', 15 );
// /**
//  * Echo the opening structural markup for the header.
//  *
//  * @since 1.2.0
//  *
//  * @uses genesis_structural_wrap() Maybe add closing .wrap div tag with header context.
//  * @uses genesis_markup()          Apply contextual markup.
//  */
// function genesis_header_markup_close() {

//     genesis_structural_wrap( 'header', 'close' );
//     genesis_markup( array(
//         'html5' => '</header>',
//         'xhtml' => '</div>',
//     ) );

// }

// add_action( 'genesis_header', 'genesis_do_header' );
// /**
//  * Echo the default header, including the #title-area div, along with #title and #description, as well as the .widget-area.
//  *
//  * Does the `genesis_site_title`, `genesis_site_description` and `genesis_header_right` actions.
//  *
//  * @since 1.0.2
//  *
//  * @global $wp_registered_sidebars Holds all of the registered sidebars.
//  *
//  * @uses genesis_markup() Apply contextual markup.
//  */
// function genesis_do_header() {

//     global $wp_registered_sidebars;

//     genesis_markup( array(
//         'html5'   => '<div %s>',
//         'xhtml'   => '<div id="title-area">',
//         'context' => 'title-area',
//     ) );
//     do_action( 'genesis_site_title' );
//     do_action( 'genesis_site_description' );
//     echo '</div>';

//     if ( ( isset( $wp_registered_sidebars['header-right'] ) && is_active_sidebar( 'header-right' ) ) || has_action( 'genesis_header_right' ) ) {
//         genesis_markup( array(
//             'html5'   => '<aside %s>',
//             'xhtml'   => '<div class="widget-area header-widget-area">',
//             'context' => 'header-widget-area',
//         ) );

//             do_action( 'genesis_header_right' );
//             add_filter( 'wp_nav_menu_args', 'genesis_header_menu_args' );
//             add_filter( 'wp_nav_menu', 'genesis_header_menu_wrap' );
//             dynamic_sidebar( 'header-right' );
//             remove_filter( 'wp_nav_menu_args', 'genesis_header_menu_args' );
//             remove_filter( 'wp_nav_menu', 'genesis_header_menu_wrap' );

//         genesis_markup( array(
//             'html5' => '</aside>',
//             'xhtml' => '</div>',
//         ) );
//     }

// }
