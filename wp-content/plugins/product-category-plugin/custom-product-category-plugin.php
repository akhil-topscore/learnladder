<?php
/**
 * Plugin Name: Product_category
 * Description: A plugin to display WooCommerce products by category in Elementor.
 * Version: 1.0
 * Author: AKHIL JOHNS
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit; 
}

// 1
function mcpc_enqueue_assets() {
    wp_enqueue_style('mcpc-style', plugins_url('assets/css/style.css', __FILE__)); // Load the style.css file
    wp_enqueue_script('mcpc-script', plugins_url('assets/js/script.js', __FILE__), array('jquery'), null, true); // Load the script.js file
}
add_action('wp_enqueue_scripts', 'mcpc_enqueue_assets');

require_once plugin_dir_path( __FILE__ ) . 'includes/product-category-loop.php';

// 2
function mcpc_enqueue_scripts() {
     wp_enqueue_script('jquery');
    wp_enqueue_script('mcpc-script', plugin_dir_url(__FILE__) . 'assets/js/script.js', array('jquery'), null, true);
    wp_localize_script('mcpc-script', 'mcpc_ajax_obj', array(
        'ajax_url' => admin_url('admin-ajax.php')
    ));
    wp_enqueue_style('mcpc-style', plugin_dir_url(__FILE__) . 'assets/css/style.css');
}
add_action('wp_enqueue_scripts', 'mcpc_enqueue_scripts');

// 3
function enqueue_cart_update_script_category() {
    wp_enqueue_script(
        'cart-update-category',
        plugin_dir_url(__FILE__) . 'assets/js/cart-update.js',
        ['jquery'],
        '1.0',
        true
    );

    wp_localize_script('cart-update-category', 'myAjax', [
        'ajax_url' => admin_url('admin-ajax.php')
    ]);
}
add_action('wp_enqueue_scripts', 'enqueue_cart_update_script_category');

// 4
function handle_add_to_cart_category() {
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
add_action('wp_ajax_add_to_cart', 'handle_add_to_cart_category');
add_action('wp_ajax_nopriv_add_to_cart', 'handle_add_to_cart_category');


