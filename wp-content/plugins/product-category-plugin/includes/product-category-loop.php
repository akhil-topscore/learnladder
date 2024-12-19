<?php

function mcpc_display_categories() {
    $categories = get_terms(array(
        'taxonomy' => 'product_cat',
        'parent' => 0,
        'hide_empty' => true,
    ));

    $valid_categories = array_filter($categories, function ($category) {
        return get_posts(array(
            'post_type' => 'product',
            'posts_per_page' => 1,
            'tax_query' => array(
                array(
                    'taxonomy' => 'product_cat',
                    'field' => 'term_id',
                    'terms' => $category->term_id,
                ),
            ),
        ));
    });

    ob_start(); ?>

    <div class="mcpc-filter-container">
        <!-- Filter button and divider for styling -->
        <div class="mcpc-filter-control">
            <span class="mcpc-filter-text">Study Packages</span>
            <div class="mcpc-horizontal-divider"></div>
            <button id="mcpc-filter-button" class="mcpc-filter-button">Filter</button>
        </div>

        
        <div id="mcpc-filter-section" class="mcpc-filter-section">
            <div class="mcpc-filter-content">
                <div class="mcpc-filter-grid row">
                    <div class="mcpc-filter-col col-md-3">
                        <select id="parent-category" class="mcpc-select">
                            <option value="">Select Category</option>
                            <?php foreach ($valid_categories as $category): ?>
                                <option value="<?php echo esc_attr($category->term_id); ?>">
                                    <?php echo esc_html($category->name); ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <div class="mcpc-filter-col col-md-3">
                        <select id="child-category" class="mcpc-select">
                            <option value="">Select Subcategory</option>
                        </select>
                    </div>

                    <div class="mcpc-search-container col-md-5">
                        <div class="mcpc-search-controls">
                            <input type="text" id="search-bar" class="mcpc-search-bar" placeholder="Search products..." style="padding: 3px;">
                            <button id="search-button" class="mcpc-search-button">Search</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Loader and Product loop container -->
    <div class="loader" style="display: none;"></div>
    <div id="mcpc-product-loop" class="custom-product-cards-grid">
       
    </div>
    <div class="no-products-overlay" id="no-products-message" style="text-align: center; display: none;">
        <strong>No products found.</strong><br>Try adjusting your filters or search term.
    </div>

    <?php
    return ob_get_clean();
}

add_shortcode('mcpc_categories', 'mcpc_display_categories');
function mcpc_get_child_categories() {
    $parent_id = isset($_GET['parent_id']) ? intval($_GET['parent_id']) : 0;

    $child_categories = get_terms(array(
        'taxonomy' => 'product_cat',
        'parent' => $parent_id,
        'hide_empty' => true,
    ));

    $options = empty($child_categories) 
        ? '<option value="">No subcategories available</option>' 
        : '';

    foreach ($child_categories as $child) {
        $options .= '<option value="' . esc_attr($child->term_id) . '">' . esc_html($child->name) . '</option>';
    }

    wp_send_json_success($options);
}
add_action('wp_ajax_mcpc_get_child_categories', 'mcpc_get_child_categories');
add_action('wp_ajax_nopriv_mcpc_get_child_categories', 'mcpc_get_child_categories');

function mcpc_filter_products() {
    $parent_id = isset($_GET['parent_id']) ? intval($_GET['parent_id']) : 0;
    $child_id = isset($_GET['child_id']) ? intval($_GET['child_id']) : 0;
    $search_term = isset($_GET['search_term']) ? sanitize_text_field($_GET['search_term']) : '';

    $tax_query = array();

    if ($parent_id) {
        $tax_query[] = array(
            'taxonomy' => 'product_cat',
            'field' => 'term_id',
            'terms' => $parent_id,
        );
    }

    if ($child_id) {
        $tax_query[] = array(
            'taxonomy' => 'product_cat',
            'field' => 'term_id',
            'terms' => $child_id,
        );
    }

    $args = array(
        'post_type' => 'product',
        'posts_per_page' => 10,
        'tax_query' => $tax_query,
        's' => $search_term,
    );

    $loop = new WP_Query($args);

    ob_start();
    if ($loop->have_posts()) :
        while ($loop->have_posts()) : $loop->the_post();
            wc_get_template_part('content', 'product'); // Use WooCommerce product template
        endwhile;
    endif;

    wp_reset_postdata();
    $output = ob_get_clean();
    echo $output ?: ''; // Return empty if no products found
    wp_die();
}
add_action('wp_ajax_mcpc_filter_products', 'mcpc_filter_products');
add_action('wp_ajax_nopriv_mcpc_filter_products', 'mcpc_filter_products');



?>