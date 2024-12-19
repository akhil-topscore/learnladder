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
<div class="account_pages_h4_div">
<h4 class="account_pages_h4">MY ORDERS</h4>
</div>
<div class="woocommerce-orders-list">
    <?php foreach ( $customer_orders->orders as $customer_order ) :
        $order      = wc_get_order( $customer_order );
        $item_count = $order->get_item_count() - $order->get_item_count_refunded();
        $items      = $order->get_items();
        $product_names = array();

        foreach ( $items as $item ) {
            $product_names[] = $item->get_name();
        }
        $product_names_list = implode( ', ', $product_names );
    ?>
        <div class="order-row">
            <div class="order-details">
                <div class="order-info">
                    <strong><?php esc_html_e( 'Order #', 'woocommerce' ); ?></strong>
                    <a href="<?php echo esc_url( $order->get_view_order_url() ); ?>">
                        <?php echo esc_html( $order->get_order_number() ); ?>
                    </a>
                </div>
                <div class="order-date">
                    <strong><?php esc_html_e( 'Date:', 'woocommerce' ); ?></strong>
                    <time datetime="<?php echo esc_attr( $order->get_date_created()->date( 'c' ) ); ?>">
                        <?php echo esc_html( wc_format_datetime( $order->get_date_created() ) ); ?>
                    </time>
                </div>
                <div class="order-status">
                    <strong><?php esc_html_e( 'Status:', 'woocommerce' ); ?></strong>
                    <?php echo esc_html( wc_get_order_status_name( $order->get_status() ) ); ?>
                </div>
                <div class="order-total">
                    <strong><?php esc_html_e( 'Total:', 'woocommerce' ); ?></strong>
                    <?php echo wp_kses_post( $order->get_formatted_order_total() ); ?>
                </div>
                
            </div>
            <div class="order-items">
                <strong><?php esc_html_e( 'Items:', 'woocommerce' ); ?></strong>
                <span class="product-names" title="<?php echo esc_attr( $product_names_list ); ?>">
                    <?php echo esc_html( $product_names_list ); ?>
                </span>
            </div>
            <div class="order-actions">
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

<style>
.woocommerce-orders-list {
    display: flex;
    flex-direction: column;
    gap: 15px;
}

.order-row {
    display: flex;
    flex-direction: column;
    background: #fff;
    border: 1px solid #ddd;
    border-radius: 8px;
    padding: 15px;
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    gap: 10px;
}

.order-details {
  display: flex;
  flex-wrap: wrap;
  gap: 9px;
  justify-content: space-between;
}

.order-details > div {
    flex-basis: calc(33.33% - 10px);
    flex-grow: 1;
    font-size: 14px;
    max-width:max-content;
    margin-right:15px;
}

.order-items {
    display: flex;
    align-items: center; /* Align content vertically */
    font-size: 14px;
    width: 100%; /* Full width of the parent container */
    overflow: hidden; /* Clip content that overflows */
}

.order-items strong {
    margin-right: 10px; /* Add spacing between label and product names */
    white-space: nowrap; /* Ensure label doesn't wrap */
}

.order-items .product-names {
    display: block; /* Allow block-level layout for full width */
    flex-grow: 1; /* Ensure the span takes up all available space */
    white-space: nowrap; /* Prevent wrapping of text */
    overflow: hidden; /* Clip overflowing content */
    text-overflow: ellipsis; /* Add ellipsis for overflow */
}


.order-actions {
    display: flex;
    justify-content: space-between; /* Ensure equal spacing between buttons */
    gap: 10px; /* Add some spacing between buttons */
    width: 100%; /* Full width of the parent container */
}

.order-actions .woocommerce-button {
  flex: 1;
  text-align: center;
  padding: 10px 0;
  background-color: #3f6b95 !important;
  color: #fff;
  text-decoration: none;
  border-radius: 4px;
  font-size: 15px;
  margin: 0;
  color: white !important;
  font-weight: 400 !important;
}

.order-actions .woocommerce-button:hover {
    background-color: #2980b9 !important;
}

/* Responsive Adjustments */
@media (max-width: 768px) {
    .order-actions {
        flex-direction: column; /* Stack buttons vertically on small screens */
    }

    .order-actions .woocommerce-button {
        margin: 5px 0; /* Add spacing for stacked buttons */
    }
}
</style>

<?php else : ?>

    <p><?php esc_html_e( 'No orders have been made yet.', 'woocommerce' ); ?></p>

<?php endif; ?>

<?php do_action( 'woocommerce_after_account_orders', $has_orders ); ?>
