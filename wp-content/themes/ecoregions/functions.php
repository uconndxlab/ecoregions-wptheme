<?php

if ( !defined('ECOREGIONS_THEME_VER') ) {
    define('ECOREGIONS_THEME_VER', '1.0.0');
}

function ecoregions_register_navigation_menus() {
    register_nav_menus(
        array(
            'footer-meta' => esc_html__( 'Footer Meta', 'ecoregions' )
        )
    );
}

function ecoregions_enqueue_global_scripts() {
    wp_enqueue_style( 'ecoregions_style', get_stylesheet_uri(), array(), ECOREGIONS_THEME_VER );
}

function ecoregions_theme_support() {
    add_theme_support( 'post-thumbnails' );

    // Add default posts and comments RSS feed links to head.
    // add_theme_support( 'automatic-feed-links' );

    ecoregions_register_navigation_menus();

    add_theme_support(
        'html5',
        array(
            'search-form',
            'comment-form',
            'comment-list',
            'gallery',
            'caption',
            'style',
            'script',
        )
    );

    add_theme_support( 'customize-selective-refresh-widgets' );
}


function ecoregions_run_hooks() {
    add_action('after_setup_theme', 'ecoregions_theme_support' );
    add_action('wp_enqueue_scripts', 'ecoregions_enqueue_global_scripts');
}

ecoregions_run_hooks();

function isHTMX() {
    return isset($_SERVER['HTTP_HX_REQUEST']);
}
