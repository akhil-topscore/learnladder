<?php
namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

class Custom_Product_Card extends Widget_Base {

    public function get_name() {
        return 'custom_product_card';
    }

    public function get_title() {
        return __( 'Product Card', 'custom-product-card' );
    }

    public function get_icon() {
        return 'fa fa-shopping-cart';
    }

    public function get_categories() {
        return [ 'general' ];
    }

    protected function _register_controls() {
        $this->start_controls_section(
            'content_section',
            [
                'label' => __( 'Content', 'custom-product-card' ),
                'tab'   => Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'number_of_products',
            [
                'label' => __( 'Number of Products', 'custom-product-card' ),
                'type' => Controls_Manager::NUMBER,
                'default' => 4,
            ]
        );

        $this->add_control(
            'selected_category',
            [
                'label' => __( 'Select Category', 'custom-product-card' ),
                'type' => Controls_Manager::SELECT,
                'options' => $this->get_product_categories(),
                'default' => '',
            ]
        );

        $this->add_control(
            'sort_order',
            [
                'label' => __( 'Sort By Date', 'custom-product-card' ),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    'desc' => __( 'New', 'custom-product-card' ),
                    'asc' => __( 'Old', 'custom-product-card' ),
                ],
                'default' => 'desc',
            ]
        );
        $this->end_controls_section();
    }

    protected function get_product_categories() {
        $terms = get_terms( [
            'taxonomy' => 'product_cat',
            'hide_empty' => true,
        ] );

        $categories = [];
        foreach ( $terms as $term ) {
            $categories[$term->term_id] = $term->name;
        }

        return $categories;
    }

protected function render() {
    $settings = $this->get_settings_for_display();
    $number_of_products = $settings['number_of_products'];
    $selected_category = $settings['selected_category'];
    $sort_order = $settings['sort_order'] === 'asc' ? 'ASC' : 'DESC';

    $args = [
        'post_type' => 'product',
        'posts_per_page' => $number_of_products,
        'orderby' => 'date',
        'order' => $sort_order,
    ];

    if ( ! empty( $selected_category ) ) {
        $args['tax_query'] = [
            [
                'taxonomy' => 'product_cat',
                'field' => 'term_id',
                'terms' => $selected_category,
            ],
        ];
    }

    $query = new \WP_Query( $args );

    if ( $query->have_posts() ) {
        echo '<div class="custom-product-cards-grid">';
        while ( $query->have_posts() ) {
            $query->the_post();
            $product = wc_get_product( get_the_ID() );

            if ( ! $product ) {
                continue;
            }

            // Get the product URL to redirect to the product page
            $product_url = get_permalink( $product->get_id() );

            // Check if WooCommerce cart is initialized
            $in_cart = ( WC()->cart && WC()->cart->find_product_in_cart( WC()->cart->generate_cart_id( $product->get_id() ) ) ) ? true : false;
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
                    <?php
                // Display the discount badge if there's a discount
if ($discount_percentage > 0) {
    echo '<div class="custom-discount-badge">' . esc_html($discount_percentage . '% off') . '</div>';
}
?>
                    <div class="custom-product-image">
                        <?php echo wp_kses_post( $product->get_image('full') ); ?>
                    </div>
                    <h2 class="custom-product-title"><?php echo esc_html( $product->get_name() ); ?></h2>
                    <p class="custom-product-description"><?php echo esc_html( wp_trim_words( $product->get_short_description(), 10 ) ); ?></p>
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
                            <i class="add-to-cart-icon fa <?php echo $in_cart ? 'fa-shopping-cart added-to-cart' : 'fa-cart-plus'; ?>" 
                               data-product-id="<?php echo esc_attr($product->get_id()); ?>" 
                               title="<?php echo $in_cart ? 'Go to Cart' : 'Add to Cart'; ?>">
                            </i>
                        </div>
                    </div>
                </div>
            </a>
            <?php
        }
        echo '</div>';
        wp_reset_postdata();
    } else {
        echo __( 'No products found', 'custom-product-card' );
    }
}



    protected function _content_template() {
    }
}
?>
