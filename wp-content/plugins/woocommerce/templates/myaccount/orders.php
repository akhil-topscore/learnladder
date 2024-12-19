<?php
/**
 * Orders
 *
 * Shows orders on the account page in a grid layout.
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/myaccount/orders.php.
 *
 * @see https://woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 9.2.0
 */

defined( 'ABSPATH' ) || exit;

do_action( 'woocommerce_before_account_orders', $has_orders );

if ( $has_orders ) : ?>

    <div class="woocommerce-orders-grid">
        <?php foreach ( $customer_orders->orders as $customer_order ) :
            $order      = wc_get_order( $customer_order );
            $item_count = $order->get_item_count() - $order->get_item_count_refunded();
        ?>
            <div class="order-card">
                <div class="order-card-header">
                    <h3>
                        <a href="<?php echo esc_url( $order->get_view_order_url() ); ?>">
                            <?php echo esc_html( _x( '#', 'hash before order number', 'woocommerce' ) . $order->get_order_number() ); ?>
                        </a>
                    </h3>
                    <time datetime="<?php echo esc_attr( $order->get_date_created()->date( 'c' ) ); ?>">
                        <?php echo esc_html( wc_format_datetime( $order->get_date_created() ) ); ?>
                    </time>
                </div>
                <div class="order-card-body">
                    <p><strong><?php esc_html_e( 'Status:', 'woocommerce' ); ?></strong> <?php echo esc_html( wc_get_order_status_name( $order->get_status() ) ); ?></p>
                    <p><strong><?php esc_html_e( 'Total:', 'woocommerce' ); ?></strong> <?php echo wp_kses_post( $order->get_formatted_order_total() ); ?></p>
                    <p><strong><?php esc_html_e( 'Items:', 'woocommerce' ); ?></strong> <?php echo esc_html( $item_count ); ?></p>
                </div>
                <div class="order-card-footer">
                    <?php
                    $actions = wc_get_account_orders_actions( $order );
                    if ( ! empty( $actions ) ) :
                        foreach ( $actions as $key => $action ) : ?>
                            <a href="<?php echo esc_url( $action['url'] ); ?>" class="woocommerce-button button <?php echo esc_attr( sanitize_html_class( $key ) ); ?>">
                                <?php echo esc_html( $action['name'] ); ?>
                            </a>
                        <?php endforeach;
                    endif; ?>
                </div>
            </div>
        <?php endforeach; ?>
    </div>

<?php else : ?>

    <p><?php esc_html_e( 'No orders have been made yet.', 'woocommerce' ); ?></p>

<?php endif; ?>

<?php do_action( 'woocommerce_after_account_orders', $has_orders ); ?>
