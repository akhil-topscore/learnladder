<?php
/**
 * Template for displaying product content within loops
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/content-product.php.
 *
 * @package WooCommerce\Templates
 * @version 8.6.0
 */

defined( 'ABSPATH' ) || exit;

global $product;

// Get product URL
$product_url = get_permalink( $product->get_id() );

// Get sale price and regular price
$regular_price = $product->get_regular_price();
$sale_price = $product->get_sale_price();

// Calculate discount percentage
$discount_percentage = 0;
if ($regular_price && $sale_price) {
    $discount_percentage = round((($regular_price - $sale_price) / $regular_price) * 100);
}

?>
<a href="<?php echo esc_url( $product_url ); ?>" class="custom-product-card-link">
    <div class="custom-product-card-item">
        
        <!-- Discount Badge -->
        <?php if ($discount_percentage > 0) : ?>
            <div class="custom-discount-badge"><?php echo esc_html($discount_percentage . '% off'); ?></div>
        <?php endif; ?>

        <!-- Product Image -->
        <div class="custom-product-image">
            <?php echo wp_kses_post( $product->get_image('full') ); ?>
        </div>

        <!-- Product Title -->
        <h2 class="custom-product-title"><?php echo esc_html( $product->get_name() ); ?></h2>

        <!-- Product Description -->
        <p class="custom-product-description"><?php echo esc_html( wp_trim_words( $product->get_short_description(), 10 ) ); ?></p>

        <!-- Price and Cart -->
        <div class="price-cart-cont">
            <div class="custom-product-price">
                <?php if ( $product->is_on_sale() ) : ?>
                    <span class="custom-current-price"><?php echo wp_kses_post( wc_price( $product->get_sale_price() ) ); ?></span>
                    <span class="custom-reduced-price"><?php echo wp_kses_post( wc_price( $product->get_regular_price() ) ); ?></span>
                <?php else : ?>
                    <span class="custom-current-price"><?php echo wp_kses_post( wc_price( $product->get_price_html() ) ); ?></span>
                <?php endif; ?>
            </div>

            <!-- Add to Cart / Go to Cart Button -->
            <div class="custom-product-add-to-cart">
                <?php if ( WC()->cart && WC()->cart->find_product_in_cart( WC()->cart->generate_cart_id( $product->get_id() ) ) ) : ?>
                    <i class="add-to-cart-icon fa fa-shopping-cart added-to-cart" title="Go to Cart"></i>
                <?php else : ?>
                    <i class="add-to-cart-icon fa fa-cart-plus" title="Add to Cart"></i>
                <?php endif; ?>
            </div>
        </div>
    </div>
</a>

<style>

</style>