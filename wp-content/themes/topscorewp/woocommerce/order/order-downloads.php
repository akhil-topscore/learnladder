<?php
/**
 * Order Downloads.
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/order/order-downloads.php.
 *
 * @see     https://woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 3.3.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
?>
<section class="woocommerce-order-downloads">
    <?php if (isset($show_title)) : ?>
        <h2 class="woocommerce-order-downloads__title"><?php esc_html_e('Downloads', 'woocommerce'); ?></h2>
    <?php endif; ?>

    <!-- Product and Download Headings -->
    <div class="woocommerce-order-downloads__headings">
        <div class="woocommerce-order-downloads__cell">
            <span class="woocommerce-order-downloads__heading"><?php esc_html_e('Product', 'woocommerce'); ?></span>
        </div>
        <div class="woocommerce-order-downloads__cell">
            <span class="woocommerce-order-downloads__heading"><?php esc_html_e('Download', 'woocommerce'); ?></span>
        </div>
    </div>

    <!-- Loop through products -->
    <div class="woocommerce-order-downloads__list">
        <?php foreach ($downloads as $download) : ?>
            <div class="woocommerce-order-downloads__item">
                <!-- Product -->
                <div class="woocommerce-order-downloads__cell">
                    <?php if ($download['product_url']) : ?>
                        <a href="<?php echo esc_url($download['product_url']); ?>" class="woocommerce-order-downloads__value"><?php echo esc_html($download['product_name']); ?></a>
                    <?php else : ?>
                        <span class="woocommerce-order-downloads__value"><?php echo esc_html($download['product_name']); ?></span>
                    <?php endif; ?>
                </div>
                <!-- Download -->
                <div class="woocommerce-order-downloads__cell">
                    <a href="<?php echo esc_url($download['download_url']); ?>" class="woocommerce-MyAccount-downloads-file woocommerce-order-downloads__value button alt">
                        <i class="fa-solid fa-folder-arrow-down"></i> <?php echo esc_html($download['download_name']); ?>
                    </a>
                </div>
            </div>
        <?php endforeach; ?>
    </div>

    <?php 
    // Get the current order ID from the URL (e.g., /view-order/{order_id}/)
    if (is_account_page() && isset($wp_query->query_vars['order_id'])) {
        $order_id = $wp_query->query_vars['order_id'];
    }

    // Only show "Download All" button if there are 2 or more downloads
    if (count($downloads) >= 2) : ?>
        <div class="woocommerce-order-downloads__all" style="display: none; justify-content: center;">
            <!-- Integrating the custom "Download All" URL with order_id -->
            <a class="button alt woocommerce-order-downloads__download-all" href="<?php echo esc_url(home_url('/download-all?order_id=' . $order_id)); ?>">
                <i class="fa-solid fa-folder-arrow-down"></i> Download All
            </a>
        </div>
    <?php endif; ?>
</section>
