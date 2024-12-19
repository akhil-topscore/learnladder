<?php

/**
 * TopscoreWP functions and definitions
 *
 * @package TopscoreWP
 */

if (!defined('ABSPATH')) {
	exit; // Exit if accessed directly.
}

/**
 * Global Variables
 */
define('TOPSCORE_WP_THEME_URI', get_template_directory_uri());
define('TOPSCORE_WP_THEME_VERSION', wp_get_theme()->get('Version'));

/**
 * Sets up theme support.
 * 
 * @return void
 */
function topscorewp_setup()
{
	if (apply_filters('topscorewp_register_menus', true)) {
		register_nav_menus(array('menu-1' => esc_html__('Primary', 'topscorewp')));
		register_nav_menus(array('menu-2' => esc_html__('Secondary', 'topscorewp')));
	}

	if (apply_filters('topscorewp_add_theme_support', true)) {
		add_theme_support('post-thumbnails');
		add_theme_support('automatic-feed-links');
		add_theme_support('title-tag');
		add_theme_support(
			'html5',
			array(
				'search-form',
				'comment-form',
				'comment-list',
				'gallery',
				'caption',
				'script',
				'style',
			)
		);
		add_theme_support(
			'custom-logo',
			array(
				'height'      => 250,
				'width'       => 250,
				'flex-height' => true,
				'flex-width'  => true,
			)
		);
	}
}
add_action('after_setup_theme', 'topscorewp_setup');

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * @global int $content_width
 */
function topscorewp_content_width()
{
	$GLOBALS['content_width'] = apply_filters('topscorewp_content_width', 1920);
}
add_action('after_setup_theme', 'topscorewp_content_width', 0);

/**
 * Register widget area.
 */
function topscorewp_widgets_init()
{
	register_sidebar(
		array(
			'name'          => esc_html__('Footer Widget', 'topscorewp'),
			'id'            => 'footer-sidebar',
			'description'   => esc_html__('Widgets in this area will be shown in Footer Area.', 'topscorewp'),
			'before_widget' => '<div class="col-xl-4 col-md-6 col-sm-12 col-12"><div id="%1$s" class="footer-widget footer-links %2$s">',
			'after_widget'  => '</div></div>',
			'before_title'  => '<h3 class="text-white">',
			'after_title'   => '</h3>',
		)
	);
	register_sidebar( array(
		'name' => esc_html__( 'Shop Sidebar', 'topscorewp' ),
		'id' => 'shop-sidebar',
		'description'   => esc_html__( 'These are widgets for the Shop.','topscorewp' ),
		'before_widget' => '<div class="widget %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<h4 class="widget-title">',
		'after_title'   => '</h4>'
	  ) );
}

add_action('widgets_init', 'topscorewp_widgets_init');

/**
 * Enqueue scripts and styles.
 */
function topscorewp_scripts_styles()
{
	wp_enqueue_style('bootstrap', get_template_directory_uri() . '/assets/css/bootstrap.min.css', array(), TOPSCORE_WP_THEME_VERSION);
	wp_enqueue_style('font-awesome-6-pro', get_template_directory_uri() . '/assets/css/fontawesome.min.css', array(), TOPSCORE_WP_THEME_VERSION);
	wp_enqueue_style('style', get_template_directory_uri() . '/assets/css/style.css', array(), TOPSCORE_WP_THEME_VERSION);
	wp_enqueue_style('topscorewp-style', get_stylesheet_uri(), array(), TOPSCORE_WP_THEME_VERSION);

	wp_enqueue_script('bootstrap', get_template_directory_uri() . '/assets/js/bootstrap.min.js', array('jquery'), TOPSCORE_WP_THEME_VERSION, true);
	wp_enqueue_script('main', get_template_directory_uri() . '/assets/js/main.js', array('jquery'), TOPSCORE_WP_THEME_VERSION, true);
}
add_action('wp_enqueue_scripts', 'topscorewp_scripts_styles');

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load WooCommerce compatibility file.
 */
if ( class_exists( 'WooCommerce' ) ) {
	require get_template_directory() . '/inc/woocommerce.php';
}

/**
 * Register Custom Navigation Walker
 */
function register_navwalker()
{
	require_once get_template_directory() . '/inc/class-wp-bootstrap-navwalker.php';
}
add_action('after_setup_theme', 'register_navwalker');

/**
 * Replace Login logo with custom logo.
 */
function topscorewp_filter_login_head()
{
	if (has_custom_logo()) :
		$image = wp_get_attachment_image_src(get_theme_mod('custom_logo'), 'full');
?>
		<style type="text/css">
			.login h1 a {
				background-image: url(<?php echo esc_url($image[0]); ?>);
				background-size: contain;
				background-position: center center;
				width: auto;
			}
		</style>
<?php
	endif;
}
add_action('login_head', 'topscorewp_filter_login_head', 100);

/**
 * Replace Login url with home url.
 */
function topscorewp_login_url()
{
	return home_url();
}
add_filter('login_headerurl', 'topscorewp_login_url');

// TO SET PRODUCT PER PAGE TO 8
add_filter('loop_shop_per_page', 'set_products_per_page', 20);
function set_products_per_page($cols) {
    return 8; // Ensure it's a multiple of 4
}
function check_product_in_cart() {
    if ( isset($_POST['product_id']) ) {
        $product_id = intval($_POST['product_id']);
        
        // Check if the product is in the cart
        $found = false;
        foreach (WC()->cart->get_cart() as $cart_item_key => $cart_item) {
            if ($cart_item['product_id'] == $product_id) {
                $found = true;
                break;
            }
        }
        
        if ($found) {
            echo 'yes'; // Product is in the cart
        } else {
            echo 'no'; // Product is not in the cart
        }
    }
    wp_die(); // Always call wp_die() when using AJAX
}
add_action('wp_ajax_check_product_in_cart', 'check_product_in_cart');
add_action('wp_ajax_nopriv_check_product_in_cart', 'check_product_in_cart');

// Hook into WordPress AJAX actions for adding products to the cart
add_action('wp_ajax_mcpc_add_to_cart', 'mcpc_add_to_cart_callback');
add_action('wp_ajax_nopriv_mcpc_add_to_cart', 'mcpc_add_to_cart_callback');

function mcpc_add_to_cart_callback() {
    if (isset($_POST['product_id'])) {
        $product_id = intval($_POST['product_id']);
        
        if ($product_id > 0) {
            // Make sure WooCommerce is initialized and the cart is available
            if (!WC()->cart) {
                WC()->initialize();
            }

            // Add the product to the cart
            $added = WC()->cart->add_to_cart($product_id);
            
            // If product is successfully added, send a success response
            if ($added) {
                wp_send_json_success();
            }
        }
    }
    
    // Send an error response if something goes wrong
    wp_send_json_error();
}


function custom_cart_check_script() {
    // Enqueue script for checking the cart
    ?>
    <script type="text/javascript">
        jQuery(document).ready(function($) {
            // Function to check if the product is already in the cart
            function checkProductInCart(productId) {
                var data = {
                    action: 'check_product_in_cart',
                    product_id: productId,
                };

                $.post('<?php echo admin_url('admin-ajax.php'); ?>', data, function(response) {
                    if (response == 'yes') {
                        // Change button to "Go to Cart" and add icon
                        $('a[data-product_id="'+productId+'"]').text('Go to Cart');
                        $('a[data-product_id="'+productId+'"]').addClass('go-to-cart-button');
                    }
                });
            }

            // Check each product
            $('.add_to_cart_button').each(function() {
                var productId = $(this).data('product_id');
                checkProductInCart(productId);
            });

            // When "Go to Cart" button is clicked, redirect to cart page
            $(document).on('click', '.go-to-cart-button', function(e) {
                e.preventDefault();
                window.location.href = '<?php echo wc_get_cart_url(); ?>'; // Redirect to cart page
            });
        });
    </script>
    <?php
}
add_action('wp_footer', 'custom_cart_check_script');

add_filter('woocommerce_billing_fields', 'custom_billing_fields', 10, 1);
add_filter('woocommerce_shipping_fields', 'custom_shipping_fields', 10, 1);

function custom_billing_fields($fields) {
    // Keep these fields as required
    $required_fields = ['billing_first_name', 'billing_last_name', 'billing_phone', 'billing_email', 'billing_city', 'billing_state'];

    foreach ($fields as $key => &$field) {
        // Make required fields compulsory
        if (in_array($key, $required_fields)) {
            $field['required'] = true;
        } else {
            // All others not required
            $field['required'] = false;
        }
    }
    return $fields;
}

function custom_shipping_fields($fields) {
    // Keep these fields as required for shipping
    $required_fields = ['shipping_first_name', 'shipping_last_name', 'shipping_city', 'shipping_state'];

    foreach ($fields as $key => &$field) {
        // Make required fields compulsory
        if (in_array($key, $required_fields)) {
            $field['required'] = true;
        } else {
            // All others not required
            $field['required'] = false;
        }
    }
    return $fields;
}

add_action('woocommerce_after_checkout_validation', 'ea_skip_validation', 10, 2);

function ea_skip_validation($fields, $errors) {
    // Remove validation errors for optional fields
    unset($errors->errors['billing_address_1']);
}
// Shortcode to display the Download Sample button
function sample_file_download_button() {
    global $post;

    // Get the custom field value for the sample file URL
    $sample_file_url = get_post_meta($post->ID, 'sample_file', true);

    // Check if the custom field (sample_file) has a URL
    if ($sample_file_url) {
        return '<a href="' . esc_url($sample_file_url) . '" class="download-sample-link" download>
                    <i class="fa-solid fa-down-to-bracket download-icon"></i>
                    <span class="download-text">Download Sample</span>
                </a>';
    } else {
        return ''; // No button if the sample file doesn't exist
    }
}
add_shortcode('download_sample', 'sample_file_download_button');


function limit_short_description_input() {
    global $pagenow;

    // Apply this code only on product editing or adding pages
    if ($pagenow === 'post.php' || $pagenow === 'post-new.php') {
        $screen = get_current_screen();
        if ($screen->post_type === 'product') {
            ?>
            <script type="text/javascript">
                jQuery(document).ready(function($) {
                    // Target the short description textarea (Excerpt field)
                    var $shortDesc = $('#excerpt');
                    var maxLength = 100; // Set your character limit here

                    // Add a character count display
                    if ($('#short-desc-char-count').length === 0) {
                        $shortDesc.after('<p id="short-desc-char-count" style="color: #999; font-size: 12px;"></p>');
                    }

                    // Update character count on page load
                    updateCharacterCount($shortDesc, maxLength);

                    // Listen for input events
                    $shortDesc.on('input', function() {
                        var text = $(this).val();

                        // Truncate text if it exceeds the limit
                        if (text.length > maxLength) {
                            $(this).val(text.substring(0, maxLength));
                        }

                        // Update character count
                        updateCharacterCount($(this), maxLength);
                    });

                    // Function to update character count
                    function updateCharacterCount($field, limit) {
                        var remaining = limit - $field.val().length;
                        $('#short-desc-char-count').text(remaining + ' characters remaining.');
                    }
                });
            </script>
            <?php
        }
    }
}
add_action('admin_footer', 'limit_short_description_input');

// FUNCTION TO CREATE A ZIP FILE & DOWNLOAD ALL PRODUCTS
add_action('init', function () {
    if (isset($_GET['download-all']) && isset($_GET['order_id'])) {
        $order_id = absint($_GET['order_id']);
        $order = wc_get_order($order_id);

        if ($order) {
            $downloads = $order->get_downloadable_items();
            if (!empty($downloads)) {
                $zip = new ZipArchive();
                $zip_file = tempnam(sys_get_temp_dir(), 'downloads') . '.zip';

                if ($zip->open($zip_file, ZipArchive::CREATE) === true) {
                    foreach ($downloads as $download) {
                        $file_url = $download['download_url'];
                        $file_contents = file_get_contents($file_url);
                        $file_name = basename(parse_url($file_url, PHP_URL_PATH));
                        $zip->addFromString($file_name, $file_contents);
                    }

                    $zip->close();

                    header('Content-Type: application/zip');
                    header('Content-Disposition: attachment; filename="downloads.zip"');
                    header('Content-Length: ' . filesize($zip_file));
                    readfile($zip_file);
                    unlink($zip_file);
                    exit;
                }
            }
        }

        wp_die(__('Unable to process the download.', 'woocommerce'));
    }
});

add_filter( 'woocommerce_get_template', 'remove_screen_reader_class_from_billing_address_2', 10, 5 );

function remove_screen_reader_class_from_billing_address_2( $template, $template_name, $args, $template_path, $default_path ) {
    // Target the edit address template
    if ( 'myaccount/form-edit-address.php' === $template_name ) {
        // Read the template content into a string
        $template_content = file_get_contents( $template );
        
        // Remove the 'screen-reader-text' class from the billing_address_2 label
        $template_content = str_replace( 'class="screen-reader-text"', '', $template_content );
        
        // Write the modified content back to the template
        file_put_contents( $template, $template_content );
    }
    
    return $template;
}

// Step 1: Register the custom endpoint
add_action('init', function() {
    // Register a new endpoint, for example "/download-all"
    add_rewrite_rule('^download-all/?$', 'index.php?download_all=1', 'top');
});

// Step 2: Add query variable for "download_all"
add_filter('query_vars', function($vars) {
    $vars[] = 'download_all'; // Register the custom query variable
    return $vars;
});

// Step 3: Handle the custom endpoint request
add_action('template_redirect', function() {
    // Check if the custom query variable is set
    if (get_query_var('download_all')) {
        $order_id = intval($_GET['order_id']); // Get the order ID from the URL

        if (!$order_id) {
            wp_die(__('Invalid Order ID.', 'woocommerce')); // Validate order ID
        }

        // Call your custom function to handle downloads
        handle_download_all($order_id);
        exit;
    }
});

// Step 4: Define the download function
function handle_download_all($order_id) {
    // Fetch the WooCommerce order
    $order = wc_get_order($order_id);

    // Ensure the user has permission to access the order
    if (!$order || $order->get_user_id() !== get_current_user_id()) {
        wp_die(__('You do not have permission to access these downloads.', 'woocommerce'));
    }

    // Get all downloadable items
    $downloads = $order->get_downloadable_items();
    if (empty($downloads)) {
        wp_die(__('No downloads available for this order.', 'woocommerce'));
    }

    // Create a ZIP file
    $zip = new ZipArchive();
    $zip_file = tempnam(sys_get_temp_dir(), 'downloads_') . '.zip';
    $zip->open($zip_file, ZipArchive::CREATE);

    // Loop through each download item and add it to the ZIP file
    foreach ($downloads as $download) {
        // Fetch the file content (replace `fetch_file_content()` with your own logic)
        $file_content = file_get_contents($download['download_url']);
        $zip->addFromString(basename($download['download_url']), $file_content);
    }

    $zip->close();

    // Serve the ZIP file for download
    header('Content-Type: application/zip');
    header('Content-Disposition: attachment; filename="downloads.zip"');
    header('Content-Length: ' . filesize($zip_file));
    readfile($zip_file);

    // Clean up temporary ZIP file
    unlink($zip_file);
    exit;
}

// Handle the AJAX request for updating the cart count
function update_cart_count() {
    echo WC()->cart->get_cart_contents_count(); // Get the updated cart count
    wp_die(); // Always call wp_die() to terminate the request
}

// Hook for logged-in users
add_action('wp_ajax_get_cart_count', 'update_cart_count');

// Hook for guests (non-logged-in users)
add_action('wp_ajax_nopriv_get_cart_count', 'update_cart_count');

add_filter('woocommerce_loop_add_to_cart_link', 'custom_add_to_cart_button', 10, 2);
function custom_add_to_cart_button($button, $product) {
    if (WC()->cart->find_product_in_cart(WC()->cart->generate_cart_id($product->get_id()))) {
        // If the product is already in the cart
        $cart_url = wc_get_cart_url();
        $button = '<a href="' . esc_url($cart_url) . '" class="button go-to-cart">Go to Cart</a>';
    }
    return $button;
}

add_action('woocommerce_before_add_to_cart_button', 'replace_add_to_cart_button');
function replace_add_to_cart_button() {
    global $product;

    if (WC()->cart->find_product_in_cart(WC()->cart->generate_cart_id($product->get_id()))) {
        $cart_url = wc_get_cart_url();

        // Display "Go to Cart" button
        echo '<a href="' . esc_url($cart_url) . '" class="button single_page_go-to-cart" id="single_page_go-to-cart">Go to Cart</a>';

        // Add inline script to hide specific elements
        echo "
        <script>
            document.addEventListener('DOMContentLoaded', function () {
                var cartWrap = document.querySelector('.woocommerce div.product .wl-addto-cart.wl-style-5 form.cart .wl-cart-wrap');
                if (cartWrap) {
                    cartWrap.style.display = 'none';
                }

                var cartButton = document.querySelector('.wl-addto-cart.wl-style-5 form.cart .wl-cart-wrap button');
                if (cartButton) {
                    cartButton.style.display = 'none';
                }
            });
        </script>";
    }
}

add_filter('woocommerce_get_image_size_single', function($size) {
    return array(
        'width' => 1200, // Desired width
        'height' => 1200, // Desired height
        'crop' => 0, // Disable cropping
    );
});

function enqueue_swiper_assets() {
    // Swiper JS and CSS
    wp_enqueue_script('swiper-js', 'https://unpkg.com/swiper@8.0.6/swiper-bundle.min.js', [], '8.0.6', true);
    wp_enqueue_style('swiper-css', 'https://unpkg.com/swiper@8.0.6/swiper-bundle.min.css', [], '8.0.6');
}
add_action('wp_enqueue_scripts', 'enqueue_swiper_assets');

// REDIRECT LOGINED USERS TO HOME PAGE
function redirect_logged_in_user_from_wp_login() {
    // Check if the user is logged in and accessing wp-login.php
    if (is_user_logged_in() && strpos($_SERVER['REQUEST_URI'], 'wp-login.php') !== false) {
        wp_redirect(home_url()); // Redirect to the homepage
        exit; // Ensure no further code is executed
    }
}
add_action('init', 'redirect_logged_in_user_from_wp_login');

