<?php

remove_action( 'genesis_header', 'genesis_header_markup_open', 5 );
add_action( 'genesis_header', 'showcase_header_markup_open', 5 );
/**
 * Echo the opening structural markup for the header.
 *
 * @since 1.2.0
 *
 * @uses genesis_markup()          Apply contextual markup.
 * @uses genesis_structural_wrap() Maybe add opening .wrap div tag with header context.
 */
function showcase_header_markup_open() {

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
