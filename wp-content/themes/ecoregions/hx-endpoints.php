<?php
/**
 * Plugin Name: Custom HX Endpoints
 * Description: Adds custom HX endpoints using the WordPress REST API.
 */

// Register the /regions endpoint
function add_regions_endpoint() {
    register_rest_route('custom-hx/v1', '/regions', array(
        'methods' => 'GET',
        'callback' => 'get_regions',
    ));
}
add_action('rest_api_init', 'add_regions_endpoint');

// Callback function for the /regions endpoint
function get_regions() {
    // Retieve te regions taxnomies (pods)
    $regions = get_terms(array(
        'taxonomy' => 'region',
        'hide_empty' => false,
    ));
    

    // return a <ul> of regions, but wrapped in a div with class 'regions'

    $html = '<div class="regions"><ul>';
    foreach ($regions as $region) {
        $html .= '<li><a href="' . get_term_link($region) . '">' . $region->name . '</a></li>';
    }
    $html .= '</ul></div>';

    return $html;
    
}