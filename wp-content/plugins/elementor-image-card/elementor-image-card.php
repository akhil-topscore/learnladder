<?php
/**
 * Plugin Name: Elementor Image Card
 * Description: A custom Elementor widget for displaying an image card with a heading and link overlay.
 * Version: 1.0
 * Author: Akhil Johns
 * Author URI: akhiljohns.site
 * Text Domain: elementor-image-card
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

function elementor_image_card_enqueue_styles() {
    wp_enqueue_style( 'elementor-image-card-styles', plugins_url( '/assets/css/styles.css', __FILE__ ) );
}

add_action( 'wp_enqueue_scripts', 'elementor_image_card_enqueue_styles' );

function register_elementor_image_card_widget( $widgets_manager ) {
    require_once( __DIR__ . '/includes/class-elementor-image-card.php' );
    \Elementor\Plugin::instance()->widgets_manager->register_widget_type( new \Elementor\Elementor_Image_Card() );
}

add_action( 'elementor/widgets/widgets_registered', 'register_elementor_image_card_widget' );

function elementor_image_card_enqueue_scripts() {
    // Enqueue jQuery (WordPress includes it by default)
    wp_enqueue_script('jquery');

    // Enqueue your custom JavaScript file
    wp_enqueue_script(
        'elementor-image-card-js',
        plugins_url('assets/js/script.js', __FILE__),
        array('jquery'),
        null,
        true
    );
}

add_action('wp_enqueue_scripts', 'elementor_image_card_enqueue_scripts');
