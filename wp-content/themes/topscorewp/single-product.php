<?php
/**
 * Template Name: Custom Single Product
 */

defined('ABSPATH') || exit;

get_header('shop');

if (!isset($product) || !is_a($product, 'WC_Product')) {
    $product = wc_get_product(get_the_ID());
}

if (!$product) {
    echo '<p>Product not found.</p>';
    get_footer('shop');
    exit;
}
?>

<div class="custom-product-page">
    <div class="product-container">
        <div class="product-image">
            <?php if (has_post_thumbnail()) {
                the_post_thumbnail('large');
            } ?>
        </div>

        <div class="product-details">
            <h2 class="product-title"><?php the_title(); ?></h2>
            <div class="product-description"><?php the_content(); ?></div>
            <div class="product-pricing">
                <?php if ($product->is_on_sale()) : ?>
                    <span class="product-regular-price" style="text-decoration: line-through;">
                        <?php echo wc_price($product->get_regular_price()); ?>
                    </span>
                    <span class="product-sale-price" style="color: #416a95;">
                        <?php echo wc_price($product->get_sale_price()); ?>
                    </span>
                <?php else : ?>
                    <span class="product-price"><?php echo $product->get_price_html(); ?></span>
                <?php endif; ?>
            </div>
            <div class="product-actions">
                <?php woocommerce_quantity_input(); ?>
                <button class="add-to-cart-button button"><?php echo esc_html('Add to Cart'); ?></button>
                <button class="buy-now-button button"><?php echo esc_html('Buy Now'); ?></button>
            </div>
        </div>
    </div>
</div>

<div class="product-cards-section">
    <h2 class="smlr-prd-head"><?php esc_html_e('Similar Products', 'custom-product-card'); ?></h2>
    <?php
    $settings = [
        'number_of_products' => 4,
        'selected_category' => '',
        'sort_order' => 'desc',
    ];

    $args = [
        'post_type' => 'product',
        'posts_per_page' => $settings['number_of_products'],
        'orderby' => 'date',
        'order' => $settings['sort_order'] === 'asc' ? 'ASC' : 'DESC',
    ];

    if (!empty($settings['selected_category'])) {
        $args['tax_query'] = [
            [
                'taxonomy' => 'product_cat',
                'field' => 'term_id',
                'terms' => $settings['selected_category'],
            ],
        ];
    }

    $query = new WP_Query($args);

    if ($query->have_posts()) {
        echo '<div class="custom-product-cards-grid">';
        while ($query->have_posts()) {
            $query->the_post();
            $product = wc_get_product(get_the_ID());

            if (!$product) {
                continue;
            }
            ?>
            <a href="<?php echo esc_url(get_permalink($product->get_id())); ?>" class="custom-product-card-link">
                <div class="custom-product-card-item">
                    <div class="custom-product-image"><?php echo wp_kses_post($product->get_image()); ?></div>
                    <h2 class="custom-product-title"><?php echo esc_html($product->get_name()); ?></h2>
                    <p class="custom-product-description"><?php echo esc_html(wp_trim_words($product->get_description(), 20)); ?></p>
                    <div class="custom-product-price">
                        <?php if ($product->is_on_sale()) : ?>
                            <span class="custom-reduced-price"><?php echo wp_kses_post(wc_price($product->get_regular_price())); ?></span>
                            <span class="custom-current-price"><?php echo wp_kses_post(wc_price($product->get_sale_price())); ?></span>
                        <?php else : ?>
                            <span class="custom-current-price"><?php echo wp_kses_post($product->get_price_html()); ?></span>
                        <?php endif; ?>
                    </div>
                </div>
            </a>
            <?php
        }
        echo '</div>';
        wp_reset_postdata();
    } else {
        echo __('No products found', 'custom-product-card');
    }
    ?>
</div>


<?php get_footer('shop'); ?>

<style>
.product-regular-price{
	text-decoration: line-through;
    color: #888;
    font-size: 14px;
    font-weight: 600;
}

.product-sale-price{
	color: #ff5722;
	font-size: 22px;
	font-weight: 700;
	margin-left: 10px;
}
.custom-product-page .product-container {
    display: flex;
    padding: 20px;
    max-width: 1200px;
    margin: auto;
}

.custom-product-page .product-image {
    flex: 1;
    display: flex;
    justify-content: center;
    align-items: center;
    padding: 10px;
}

.custom-product-page .product-image img {
    max-width: 80%;
    height: auto;
}

.custom-product-page .product-details {
    flex: 1;
    padding: 30px 30px;
}

/* Updated Product Title Style */
.custom-product-page .product-title {
    font-family: 'Poppins', sans-serif;
    font-size: 30px;
    font-weight: 700;
    line-height: 18px;
    text-align: left;
    color: #333; /* Adjust if you want a different color */
}

.custom-product-page .product-description {
    margin-bottom: 20px;
    color: #666;
}

.custom-product-page .product-pricing .product-price {
    font-size: 20px;
    font-weight: bold;
    color: #333;
}

.custom-product-page .product-actions {
    display: flex;
    align-items: center;
    gap: 10px;
}

.custom-product-page .add-to-cart-button,
.custom-product-page .buy-now-button {
    padding: 10px 20px;
    font-size: 14px;
    color: #fff;
    background-color: #416a95;
    border: none;
    border-radius: 4px;
    cursor: pointer;
}

.custom-product-page .add-to-cart-button:hover,
.custom-product-page .buy-now-button:hover {
    background-color: #333;
}

.custom-product-cards-grid {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
    gap: 16px;
    justify-content: center;
    align-items: center;
    max-width: 1200px;
    margin: 0 auto;
}

.custom-product-card-item {
    background-color: #fff;
    border-radius: 8px;
    padding: 5px;
    text-align: left;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    transition: box-shadow 0.3s, transform 0.3s;
}

.custom-product-card-item:hover {
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.2);
    transform: translateY(-5px);
}

.custom-product-image img {
    width: 100%;
    height: auto;
    display: block;
    margin: 0 auto;
}

.custom-product-title {
    font-size: 1.2em;
    margin: 10px 0;
    font-weight: bold;
}

.custom-product-description {
    font-size: 0.9em;
    color: #555;
    margin: 10px 0;
    overflow-wrap: break-word;
    display: -webkit-box;
    -webkit-line-clamp: 3;
    -webkit-box-orient: vertical;
    overflow: hidden;
}

.custom-product-price {
    display: flex;
    justify-content: start;
    margin-top: 15px;
}

.custom-current-price {
    font-size: 1.1em;
    color: #e74c3c;
    font-weight: bold;
    margin-right: 5px;
}

.custom-product-card-item .custom-product-price .custom-reduced-price {
    text-decoration: line-through;
    color: #8b8b8b;
    margin-left: 10px;
    margin-right: 5px;
    font-size: 0.8rem;
}

.smlr-prd-head {
    font-family: 'Poppins', sans-serif;
    font-size: 30px; 
    font-weight: 700; 
    line-height: 30px; 
    text-align: center; 
}

.product-cards-section {
    margin-top: 20px;
}
</style>
