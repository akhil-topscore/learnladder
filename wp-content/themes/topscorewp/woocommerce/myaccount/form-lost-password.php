<?php
/**
 * Lost password form
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/myaccount/form-lost-password.php.
 * 
 * @package WooCommerce\Templates
 * @version 9.2.0
 */

defined( 'ABSPATH' ) || exit;

do_action( 'woocommerce_before_lost_password_form' );
?>

<form method="post" class="woocommerce-ResetPassword lost_reset_password">

	<p><?php echo apply_filters( 'woocommerce_lost_password_message', esc_html__( 'Lost your password? Please enter your username or email address. You will receive a link to create a new password via email.', 'woocommerce' ) ); ?></p>

	<!-- Grid Layout for Form -->
	<div class="woocommerce-form-row grid-layout">
		<div class="form-field">
			<label for="user_login"><?php esc_html_e( 'Username or email', 'woocommerce' ); ?>&nbsp;<span class="required" aria-hidden="true">*</span><span class="screen-reader-text"><?php esc_html_e( 'Required', 'woocommerce' ); ?></span></label>
			<input class="woocommerce-Input woocommerce-Input--text input-text" type="text" name="user_login" id="user_login" autocomplete="username" required aria-required="true" />
		</div>
	</div>

	<?php do_action( 'woocommerce_lostpassword_form' ); ?>

	<!-- Submit Button -->
	<p class="submit-button">
		<input type="hidden" name="wc_reset_password" value="true" />
		<button type="submit" class="woocommerce-Button button" value="<?php esc_attr_e( 'Reset password', 'woocommerce' ); ?>"><?php esc_html_e( 'Reset password', 'woocommerce' ); ?></button>
	</p>

	<?php wp_nonce_field( 'lost_password', 'woocommerce-lost-password-nonce' ); ?>

</form>

<?php
do_action( 'woocommerce_after_lost_password_form' );
?>

<!-- Inline CSS for Styling and Grid Layout -->
<style>
    /* General Styling for the Form */
    .woocommerce-ResetPassword {
        /*background-color: #f4f7fc;*/
        padding: 30px;
        border-radius: 10px;
        /*box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);*/
        margin-bottom: 30px;
        font-family: 'Roboto', sans-serif;
    }

    .woocommerce-ResetPassword p {
        font-size: 16px;
        color: #737887;
        margin-bottom: 20px;
    }

    /* Grid Layout for Fields */
    .woocommerce-form-row.grid-layout {
        display: grid;
        grid-template-columns: 1fr;
        gap: 20px;
        margin-bottom: 20px;
    }

    .form-field {
        display: flex;
        flex-direction: column;
    }

    .form-field label {
        font-size: 14px;
        font-weight: 600;
        color: #141d38;
        margin-bottom: 8px;
    }

    /* Input Field Styling */
    .woocommerce-Input {
        width: 100%;
        padding: 12px;
        font-size: 14px;
        border-radius: 6px;
        border: 1px solid #ddd;
        transition: border-color 0.3s ease;
    }

    .woocommerce-Input:focus {
        border-color: #684df4;
        outline: none;
    }

    /* Submit Button Styling */
    .submit-button {
        text-align: center;
    }

    .woocommerce-Button {
        display: inline-block;
        padding: 12px 30px;
        font-size: 16px;
        color: #fff;
        background-color: #3f6b95;
        border-radius: 8px;
        border: none;
        cursor: pointer;
        transition: background-color 0.3s ease;
    }

    .woocommerce-Button:hover {
        background-color: #2980b9;
    }

    /* Mobile Responsiveness */
    @media (max-width: 768px) {
        .woocommerce-form-row.grid-layout {
            grid-template-columns: 1fr; /* Stack fields in one column */
        }

        .woocommerce-ResetPassword {
            padding: 20px;
        }

        .woocommerce-Button {
            width: 100%;
        }
    }
</style>
