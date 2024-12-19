<?php
/**
 * My Addresses
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/myaccount/my-address.php.
 *
 * @package WooCommerce\Templates
 * @version 9.3.0
 */

defined( 'ABSPATH' ) || exit;

$customer_id = get_current_user_id();

$get_addresses = apply_filters(
	'woocommerce_my_account_get_addresses',
	array(
		'billing' => __( 'Billing address', 'woocommerce' ),
	),
	$customer_id
);

?>

<p class="addresses-description">
	<?php echo apply_filters( 'woocommerce_my_account_my_address_description', esc_html__( 'The following billing address will be used on the checkout page by default.', 'woocommerce' ) ); ?>
</p>

<div class="addresses-container">
<?php foreach ( $get_addresses as $name => $address_title ) : ?>
	<?php
		$address = wc_get_account_formatted_address( $name );
	?>

	<div class="address-item">
		<header class="address-title">
			<h2 class="billing_head"><?php echo esc_html( $address_title ); ?></h2>
			<a href="<?php echo esc_url( wc_get_endpoint_url( 'edit-address', $name ) ); ?>" class="edit-button">
				<?php
					printf(
						$address ? esc_html__( 'Edit %s', 'woocommerce' ) : esc_html__( 'Add %s', 'woocommerce' ),
						esc_html( $address_title )
					);
				?>
			</a>
		</header>
		<address>
			<?php
				echo $address ? wp_kses_post( $address ) : esc_html_e( 'You have not set up this address yet.', 'woocommerce' );
				do_action( 'woocommerce_my_account_after_my_address', $name );
			?>
		</address>
	</div>

<?php endforeach; ?>
</div>

<!-- Inline CSS for Grid Layout and Styling -->
<style>
    /* Root Variables for Colors and Fonts */
:root {
    --theme-color: #3f6b95;
    --theme-color2: #3f6b95;
    --theme-color3: #ea6a2b;
    --theme-color4: #2980b9;
    --title-color: #141d38;
    --body-color: #737887;
    --title-font: "Barlow", sans-serif;
    --body-font: "Roboto", sans-serif;
    --icon-font: "Font Awesome 6 Pro";
}

.billing_head{
color: #040000;
  font-family: "Lora", Sans-serif;
  font-size: 40px;
  font-weight: 700;
  font-style: italic;
  line-height: 40px;
}
    /* General Styles for the Page */
    .addresses-description {
        font-size: 16px;
        color: var(--body-color);
        margin-bottom: 20px;
        font-family: var(--body-font);
    }

    .addresses-container {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(500px, 1fr));
        gap: 20px;
        margin-top: 20px;
    }

    .address-item {
        background-color: #ffffff;
        padding: 10px;
        border-radius: 10px;
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        transition: transform 0.3s ease;
        font-family: var(--body-font);
    }

    .address-item:hover {
        transform: translateY(-5px);
    }

    .address-title {
        display: flex;
        justify-content: space-between;
        align-items: center;
        font-size: 20px;
        font-weight: bold;
        color: var(--title-color);
        margin-bottom: 10px;
        font-family: var(--title-font);
    }

    /* Styling the Edit Button */
    .edit-button {
        display: inline-block !important;
        line-height: 1;
        font-size: 15px;
        padding: 12px;
        color: #fff !important;
        text-align: center;
        transition: all 0.3s;
        border-style: solid;
        border-radius: 8px;
        box-shadow: none;
        text-decoration: none;
        border: none !important;
        width: max-content;
         background-color: var(--theme-color2);
    }

    .edit-button:hover {
        background-color: var(--theme-color4);
        transform: scale(1.05);
    }

    .edit-button:focus {
        outline: none;
    }

    address {
        font-size: 14px;
        color: var(--body-color);
        line-height: 1.6;
    }

    /* Mobile Responsiveness */
    @media (max-width: 768px) {
        .addresses-container {
            grid-template-columns: 1fr; /* Stack addresses in one column on smaller screens */
        }
    }
</style>
