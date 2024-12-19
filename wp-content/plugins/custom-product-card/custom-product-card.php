<?php
/**
 * Plugin Name: Product-Card
 * Description: A custom Elementor widget for displaying product cards.
 * Version: 1.0
 * Author: Akhil Johns
 * Author URI: akhiljohns.site
 * Text Domain: custom-product-card
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}
// 1
function custom_product_card_enqueue_styles() { 
    wp_enqueue_style( 'custom-product-card-styles', plugins_url( '/assets/css/styles.css', __FILE__ ) );
}

add_action( 'wp_enqueue_scripts', 'custom_product_card_enqueue_styles' );

function register_custom_product_card_widget( $widgets_manager ) {
    require_once( __DIR__ . '/includes/class-custom-product-card.php' );
    \Elementor\Plugin::instance()->widgets_manager->register_widget_type( new \Elementor\Custom_Product_Card() );
}
add_action( 'elementor/widgets/widgets_registered', 'register_custom_product_card_widget' );

// 2
function custom_product_card_enqueue_scripts() {
    // Enqueue jQuery (WordPress includes it by default)
    wp_enqueue_script('jquery');

    // Enqueue your custom JavaScript file
    wp_enqueue_script(
        'custom-product-card-js', // Handle name
        plugins_url('assets/js/custom-product-card.js', __FILE__), // Path to your JS file
        array('jquery'), // Dependencies
        null, // Version (use null for no version)
        true // Load in footer
    );
}

// Hook the function to wp_enqueue_scripts
add_action('wp_enqueue_scripts', 'custom_product_card_enqueue_scripts');

// 3
function enqueue_cart_update_script_newly_published() {
    wp_enqueue_script(
        'cart-update-newly-published',
        plugin_dir_url(__FILE__) . 'assets/js/cart-update.js',
        ['jquery'],
        '1.0',
        true
    );

    wp_localize_script('cart-update-newly-published', 'myAjax', [
        'ajax_url' => admin_url('admin-ajax.php')
    ]);
}
add_action('wp_enqueue_scripts', 'enqueue_cart_update_script_newly_published');

// 4
function handle_add_to_cart() {
    if (!isset($_POST['product_id'])) {
        wp_send_json_error(['message' => 'Product ID missing']);
    }

    $product_id = intval($_POST['product_id']);
    
    // WooCommerce function to add product to cart
    $added = WC()->cart->add_to_cart($product_id);

    if ($added) {
        wp_send_json_success(['message' => 'Product added to cart']);
    } else {
        wp_send_json_error(['message' => 'Could not add product to cart']);
    }
}
add_action('wp_ajax_add_to_cart', 'handle_add_to_cart');
add_action('wp_ajax_nopriv_add_to_cart', 'handle_add_to_cart');


