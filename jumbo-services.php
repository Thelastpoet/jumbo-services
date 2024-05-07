<?php
/**
 * Plugin Name: Jumbo Services
 * Description: Jumbo Services Container
 * Version: 1.0.0
 * Author: Emmanuel Chekumbe
 * Text Domain: jumbo-services
 * 
 * Requires Plugins: elementor
 * Elementor tested up to: 3.21.4
 * Elementor Pro tested up to: 3.21.2
 */

 if ( ! defined( 'ABSPATH' )) {
     exit; // Exit if accessed directly
 }

/**
 * Register Jumbo Services Widget
 *
 */
function register_jumbo_services_widget( $widgets_manager ) {
    require_once(__DIR__ . '/widgets/jumbo-services-widget.php' );

    $widgets_manager->register( new \Jumbo_Services_Widget() );
}

add_action( 'elementor/widgets/register', 'register_jumbo_services_widget' );

/**
 * Register Jumbo Services styles
 */
function register_services_styles() {
    wp_register_style('jumbo-services-styles', plugins_url('/assets/css/jumbo-services.css', __FILE__));
}
add_action( 'wp_enqueue_scripts', 'register_services_styles' );


/**
 * Register Jumbo Services scripts
 */
function register_services_scripts() {
    wp_register_script('jumbo-services-scripts', plugins_url('/assets/js/jumbo-services.js', __FILE__));
}
add_action( 'wp_enqueue_scripts', 'register_services_scripts' );


/**
 * Hide controls in the Advanced Tab.
 *
 */
function jumbo_hide_controls() {
    // Base class for the selectors
    $base_class = '.elementor-control-';

    // List of control sections to apply the style to
    $controls_sections = [
        '_section_masking',
        '_section_style',
        '_section_transform',
        '_section_background',
        '_section_border',
        'section_custom_css_pro',
        'section_custom_attributes_pro',
    ];

    // Start the style tag
    $style = '<style>';

    // Loop through the controls sections and add them to the style
    foreach ( $controls_sections as $section ) {
        $style .= $base_class . $section . ' { display: none; }';
    }

    // Close the style tag
    $style .= '</style>';

    // Echo the complete style ta
    echo $style;
}

add_action ( 'elementor/editor/before_enqueue_scripts', 'jumbo_hide_controls' );
