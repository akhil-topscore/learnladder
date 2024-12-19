<?php
/**
 * Edit address form
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/myaccount/form-edit-address.php.
 * 
 * @package WooCommerce\Templates
 * @version 9.3.0
 */

defined( 'ABSPATH' ) || exit;

$page_title = ( 'billing' === $load_address ) ? esc_html__( 'Billing address', 'woocommerce' ) : esc_html__( 'Shipping address', 'woocommerce' );

do_action( 'woocommerce_before_edit_account_address_form' ); ?>

<?php if ( ! $load_address ) : ?>
	<?php wc_get_template( 'myaccount/my-address.php' ); ?>
<?php else : ?>

	<form method="post" class="woocommerce-edit-address-form">

		<h2 class="address-title"><?php echo apply_filters( 'woocommerce_my_account_edit_address_title', $page_title, $load_address ); ?></h2>

		<div class="woocommerce-address-fields">
			<?php do_action( "woocommerce_before_edit_address_form_{$load_address}" ); ?>

			<div class="woocommerce-address-fields__field-wrapper grid-layout">
				<?php
				foreach ( $address as $key => $field ) {
					woocommerce_form_field( $key, $field, wc_get_post_data_by_key( $key, $field['value'] ) );
				}
				?>
			</div>

			<?php do_action( "woocommerce_after_edit_address_form_{$load_address}" ); ?>

			<p class="submit-button">
				<button type="submit" class="button save-address-button" name="save_address" value="<?php esc_attr_e( 'Save address', 'woocommerce' ); ?>"><?php esc_html_e( 'Save address', 'woocommerce' ); ?></button>
				<?php wp_nonce_field( 'woocommerce-edit_address', 'woocommerce-edit-address-nonce' ); ?>
				<input type="hidden" name="action" value="edit_address" />
			</p>
		</div>

	</form>

<?php endif; ?>

<?php do_action( 'woocommerce_after_edit_account_address_form' ); ?>

<!-- Inline CSS for Grid Layout and Styling -->
<style>
    /* Root Variables for Colors and Fonts */
    :root {
        --theme-color: #684df4;
        --theme-color2: #3f6b95;
        --theme-color3: #ea6a2b;
        --title-color: #141d38;
        --body-color: #737887;
        --title-font: "Barlow", sans-serif;
        --body-font: "Roboto", sans-serif;
        --icon-font: "Font Awesome 6 Pro";
    }
    
    /* Apply styles only for the Edit Address page */
body.woocommerce-account .woocommerce-edit-address-form .woocommerce-address-fields__field-wrapper .form-row {
    gap: 0px;
    margin: 0;
}
body.woocommerce-account .woocommerce-edit-address-form .woocommerce-address-fields__field-wrapper label{
    margin:0;
}

body.woocommerce-account .woocommerce-edit-address-form .woocommerce-address-fields__field-wrapper input,
body.woocommerce-account .woocommerce-edit-address-form .woocommerce-address-fields__field-wrapper select {
    margin: 0;
}

    /* General Form Styling */
    .woocommerce-edit-address-form {
        background-color: #f4f7fc;
        padding: 30px;
        border-radius: 10px;
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        margin-bottom: 30px;
        font-family: var(--body-font);
    }

    .woocommerce-edit-address-form .address-title {
        font-size: 24px;
        font-weight: bold;
        color: var(--title-color);
        margin-bottom: 20px;
        font-family: var(--title-font);
    }

    /* Grid Layout for Address Fields */
    .woocommerce-address-fields__field-wrapper {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
        gap: 20px;
        margin-bottom: 20px;
    }

    .woocommerce-address-fields__field-wrapper .form-row {
        display: flex;
        flex-direction: column;
    }

    .woocommerce-address-fields__field-wrapper .form-column input,
    .woocommerce-address-fields__field-wrapper .form-column select {
        width: 100%;
        padding: 12px;
        font-size: 14px;
        margin-top: 8px;
        border-radius: 6px;
        border: 1px solid #ddd;
        transition: border-color 0.3s ease;
    }

    .woocommerce-address-fields__field-wrapper .form-column input:focus,
    .woocommerce-address-fields__field-wrapper .form-column select:focus {
        border-color: var(--theme-color);
        outline: none;
    }

    /* Button Styling */
    .submit-button {
        text-align: center;
    }

    .save-address-button {
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

    .save-address-button:hover {
        background-color: var(--theme-color4);
        transform: scale(1.05);
    }

    /* Mobile Responsiveness */
    @media (max-width: 768px) {
        .woocommerce-address-fields__field-wrapper {
            grid-template-columns: 1fr; /* Stack fields in one column */
        }

        .woocommerce-edit-address-form {
            padding: 20px;
        }

        .address-title {
            font-size: 20px;
        }
    }

    /* Optional: Add background color to each field for better contrast */
    .woocommerce-address-fields__field-wrapper .form-column {
        background-color: #fff;
        padding: 15px;
        border-radius: 8px;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.05);
    }
    
    /* Ensure equal height and width for the input fields and dropdowns */
body.woocommerce-account .woocommerce-edit-address-form .woocommerce-address-fields__field-wrapper .select2-selection,
body.woocommerce-account .woocommerce-edit-address-form .woocommerce-address-fields__field-wrapper .select2-container--default .select2-selection--single {
    width: 100%; /* Ensure it takes up full width */
    height: 47px; /* Match the height of input fields */
    padding: 12px; /* Same padding as the input fields */
    font-size: 14px; /* Same font size as the input fields */
    border-radius: 6px; /* Same border radius */
    border: 1px solid #ddd; /* Same border styling */
    display: flex;
    align-items: center; /* Vertically center the text */
}

/* Ensure the select2 dropdown is aligned properly */
body.woocommerce-account .woocommerce-edit-address-form .woocommerce-address-fields__field-wrapper .select2-selection__rendered {
    padding-left: 10px; /* To ensure text inside the dropdown is not too close to the edge */
}

/* Focused state for the select2 dropdown */
body.woocommerce-account .woocommerce-edit-address-form .woocommerce-address-fields__field-wrapper .select2-selection:focus,
body.woocommerce-account .woocommerce-edit-address-form .woocommerce-address-fields__field-wrapper .select2-selection--single:focus {
    border-color: var(--theme-color);
    outline: none;
}

/* Optional: Modify the dropdown arrow position */
body.woocommerce-account .woocommerce-edit-address-form .woocommerce-address-fields__field-wrapper .select2-selection__arrow {
    position: absolute;
    right: 10px;
    top: 50%;
    transform: translateY(-50%);
}

/* Adjust mobile responsiveness for dropdowns */
@media (max-width: 768px) {
    body.woocommerce-account .woocommerce-edit-address-form .woocommerce-address-fields__field-wrapper .select2-selection {
        height: 45px; /* Reduce height for smaller screens if necessary */
    }
}
</style>
