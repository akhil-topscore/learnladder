<?php
/*
Plugin Name: SPCs Category Dropdown
Description: A custom plugin to display WooCommerce product categories in a dropdown menu with sorting and filtering functionality.
Version: 1.3.1
Author: Your Name
*/

if (!defined('ABSPATH')) exit;

// Register the shortcode
function spcs_category_dropdown_shortcode() {
    if (!class_exists('WooCommerce')) {
        return '<p>WooCommerce is required for this functionality.</p>';
    }

    // Retrieve categories with products
    $categories = get_terms([
        'taxonomy' => 'product_cat',
        'hide_empty' => true,
        'parent' => 0,
    ]);

    ob_start(); ?>
    <div class="spcs-container">
        <!-- Category Dropdown -->
        <div class="spcs-category-dropdown">
            <h3 class="spcs-category-heading">
                Category Filter
                <i class="fa fa-chevron-down"></i>
            </h3>
            <ul class="spcs-category-list">
                <?php foreach ($categories as $category): ?>
                    <?php if (spcs_has_products_or_children($category->term_id)): ?>
                        <li class="spcs-category-item <?php echo spcs_has_children($category->term_id) ? 'has-children' : ''; ?>">
                            <a href="<?php echo spcs_has_products($category->term_id) ? get_term_link($category->term_id) : '#'; ?>" 
                               class="spcs-category-link <?php echo spcs_has_products($category->term_id) ? '' : 'non-selectable'; ?>">
                                <?php if (spcs_has_children($category->term_id)): ?>
                                    <span class="spcs-child-indicator"><i class="fa fa-chevron-down"></i></span>
                                <?php endif; ?>
                                <?php echo esc_html($category->name); ?>
                            </a>
                            <?php if (spcs_has_children($category->term_id)): ?>
                                <ul class="spcs-subcategory-list">
                                    <?php
                                    $subcategories = get_terms([
                                        'taxonomy' => 'product_cat',
                                        'hide_empty' => true,
                                        'parent' => $category->term_id,
                                    ]);
                                    foreach ($subcategories as $subcategory): ?>
                                        <li>
                                            <a href="<?php echo get_term_link($subcategory->term_id); ?>">
                                                <?php echo esc_html($subcategory->name); ?>
                                            </a>
                                        </li>
                                    <?php endforeach; ?>
                                </ul>
                            <?php endif; ?>
                        </li>
                    <?php endif; ?>
                <?php endforeach; ?>
            </ul>
        </div>

        <!-- Sorting Dropdown -->
        <div class="spcs-sorting-dropdown">
            <h3 class="spcs-sorting-heading">
                Sort By
                <i class="fa fa-chevron-down"></i>
            </h3>
            <ul class="spcs-sorting-list">
                <li><a href="?orderby=menu_order">Default Sorting</a></li>
                <li><a href="?orderby=popularity">Sort by Popularity</a></li>
                <li><a href="?orderby=rating">Sort by Rating</a></li>
                <li><a href="?orderby=date">Sort by Latest</a></li>
                <li><a href="?orderby=price">Price: Low to High</a></li>
                <li><a href="?orderby=price-desc">Price: High to Low</a></li>
            </ul>
        </div>
    </div>
    <?php return ob_get_clean();
}
add_shortcode('spcs_category_dropdown', 'spcs_category_dropdown_shortcode');

// Helper function to check for children
function spcs_has_children($cat_id) {
    $children = get_terms([
        'taxonomy' => 'product_cat',
        'hide_empty' => true,
        'parent' => $cat_id,
    ]);
    return !empty($children);
}

// Helper function to check if a category has products
function spcs_has_products($cat_id) {
    $products = new WP_Query([
        'post_type' => 'product',
        'posts_per_page' => 1,
        'tax_query' => [
            [
                'taxonomy' => 'product_cat',
                'field' => 'term_id',
                'terms' => $cat_id,
            ],
        ],
    ]);
    return $products->have_posts();
}

// Helper function to check if a category has products or children with products
function spcs_has_products_or_children($cat_id) {
    if (spcs_has_products($cat_id)) {
        return true;
    }

    $children = get_terms([
        'taxonomy' => 'product_cat',
        'hide_empty' => true,
        'parent' => $cat_id,
    ]);

    foreach ($children as $child) {
        if (spcs_has_products($child->term_id)) {
            return true;
        }
    }
    return false;
}

// Enqueue styles and scripts
function spcs_enqueue_scripts() {
    wp_enqueue_style('spcs-style', plugins_url('/css/spcs-style.css', __FILE__));
    wp_enqueue_script('spcs-script', plugins_url('/js/spcs-script.js', __FILE__), ['jquery'], null, true);
}
add_action('wp_enqueue_scripts', 'spcs_enqueue_scripts');
?>
