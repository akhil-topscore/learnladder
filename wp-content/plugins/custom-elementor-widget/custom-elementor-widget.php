<?php
/**
 * Plugin Name: Custom Elementor Widget
 * Description: A custom Elementor widget that adds styled text with a line and a button.
 * Version: 1.0
 * Author: Your Name
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly.
}

// Enqueue Google Fonts (Lora)
function custom_elementor_widget_enqueue_fonts() {
    wp_enqueue_style( 'custom-google-fonts', 'https://fonts.googleapis.com/css2?family=Lora:wght@700&display=swap', false );
}
add_action( 'wp_enqueue_scripts', 'custom_elementor_widget_enqueue_fonts' );

// Enqueue custom styles for the widget
function custom_elementor_widget_enqueue_styles() {
    wp_enqueue_style( 'custom-widget-styles', plugin_dir_url( __FILE__ ) . 'style.css' );
}
add_action( 'wp_enqueue_scripts', 'custom_elementor_widget_enqueue_styles' );

// Register the custom widget.
function register_custom_elementor_widget() {
    // Ensure Elementor is loaded before registering the widget.
    if ( did_action( 'elementor/loaded' ) ) {
        require_once( __DIR__ . '/widgets/custom-text-with-line-widget.php' );
        \Elementor\Plugin::instance()->widgets_manager->register_widget_type( new \Custom_Text_With_Line_Widget() );
    }
}
add_action( 'elementor/widgets/widgets_registered', 'register_custom_elementor_widget' );
