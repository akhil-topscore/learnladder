<?php
/**
 * Custom Login Form Template for WooCommerce
 * 
 * Override by copying to yourtheme/woocommerce/myaccount/form-login.php
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

do_action( 'woocommerce_before_customer_login_form' );
?>

<div class="login-container">

    <div class="login-form">

        <h2 class="login-title"><?php esc_html_e( 'Login', 'woocommerce' ); ?></h2>

        <form class="woocommerce-form woocommerce-form-login login" method="post" action="<?php echo esc_url( wc_get_account_endpoint_url( 'login' ) ); ?>">

            <?php do_action( 'woocommerce_login_form_start' ); ?>

            <div class="form-group">
                <label for="username"><?php esc_html_e( 'Username or Email Address', 'woocommerce' ); ?> <span class="required">*</span></label>
                <input type="text" class="input-field" name="username" id="username" autocomplete="username" value="<?php echo ( ! empty( $_POST['username'] ) ) ? esc_attr( wp_unslash( $_POST['username'] ) ) : ''; ?>" required aria-required="true" />
            </div>

            <div class="form-group">
                <label for="password"><?php esc_html_e( 'Password', 'woocommerce' ); ?> <span class="required">*</span></label>
                <input class="input-field" type="password" name="password" id="password" autocomplete="current-password" required aria-required="true" />
            </div>

            <?php do_action( 'woocommerce_login_form' ); ?>

            <div class="form-options">
                <label class="remember-me">
                    <input class="remember-checkbox" name="rememberme" type="checkbox" id="rememberme" value="forever" />
                    <span><?php esc_html_e( 'Remember me', 'woocommerce' ); ?></span>
                </label>
                <button type="submit" id="user_login_btn" class="submit-btn" name="login" value="<?php esc_attr_e( 'Log in', 'woocommerce' ); ?>"><?php esc_html_e( 'Log in', 'woocommerce' ); ?></button>
            </div>

            <div class="lost-password">
                <a href="<?php echo esc_url( wp_lostpassword_url() ); ?>"><?php esc_html_e( 'Lost your password?', 'woocommerce' ); ?></a>
            </div>

            <?php do_action( 'woocommerce_login_form_end' ); ?>

            <?php wp_nonce_field( 'woocommerce-login', 'woocommerce-login-nonce' ); ?>
        </form>

    </div>

    <?php if ( 'yes' === get_option( 'woocommerce_enable_myaccount_registration' ) ) : ?>
    <div class="register-form">
        <h2 class="register-title"><?php esc_html_e( 'Register', 'woocommerce' ); ?></h2>
        <form method="post" class="woocommerce-form woocommerce-form-register register">
            <?php do_action( 'woocommerce_register_form_start' ); ?>
            <div class="form-group">
                <label for="reg_email"><?php esc_html_e( 'Email Address', 'woocommerce' ); ?> <span class="required">*</span></label>
                <input type="email" class="input-field" name="email" id="reg_email" autocomplete="email" value="<?php echo ( ! empty( $_POST['email'] ) ) ? esc_attr( wp_unslash( $_POST['email'] ) ) : ''; ?>" required aria-required="true" />
            </div>
            <div class="form-options">
                <button type="submit" id="user_reg_btn" class="submit-btn" name="register" value="<?php esc_attr_e( 'Register', 'woocommerce' ); ?>"><?php esc_html_e( 'Register', 'woocommerce' ); ?></button>
            </div>
            <?php do_action( 'woocommerce_register_form_end' ); ?>
        </form>
    </div>
    <?php endif; ?>

</div>

<?php do_action( 'woocommerce_after_customer_login_form' ); ?>


<style>
/* Login Form Styles */
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

body {
    font-family: var(--body-font);
    color: var(--body-color);
    background-color: #f4f4f4;
}

.login-container {
    max-width: 600px;
    margin: 0 auto;
    padding: 40px;
    background-color: #fff;
    border-radius: 10px;
    box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
}

.login-form,
.register-form {
    margin-bottom: 30px;
}

h2 {
    font-family: var(--title-font);
    color: var(--title-color);
    margin-bottom: 20px;
    font-size: 1.8rem;
    text-align: center;
}

.form-group {
    margin-bottom: 20px;
}

label {
    display: block;
    font-weight: 600;
    color: var(--title-color);
    font-size: 0.95rem;
}

.input-field {
    width: 100%;
    padding: 12px;
    border: 1px solid #ddd;
    border-radius: 5px;
    font-size: 1rem;
    color: #333;
    background-color: #fafafa;
    margin-top: 6px;
}

.input-field:focus {
    outline: none;
    border-color: var(--theme-color);
    background-color: #fff;
}

#user_login_btn, #user_reg_btn {
    width: 100%;
    padding: 15px;
    background-color: var(--theme-color);
    color: white;
    border: none;
    border-radius: 5px;
    font-size: 1.1rem;
    cursor: pointer;
    transition: background-color 0.3s ease;
}

#user_login_btn:hover, #user_reg_btn:hover {
    background-color: var(--theme-color4);
}

.form-options {
    display: flex;
    justify-content: space-between;
    align-items: center;
}

.remember-me {
    display: flex;
    align-items: center;
    width:50%;
}

.remember-checkbox {
    margin-right: 8px;
}

.lost-password {
    text-align: center;
    margin-top: 20px;
}

.lost-password a {
    color: var(--theme-color);
    text-decoration: none;
    transition: all 0.3s ease;
}

.lost-password a:hover {
    text-decoration: underline;
    font-weight: 600 !important;
    color: var(--theme-color3) !important;
    transform: scale(1.05);
}

.register-form .form-group {
    margin-top: 20px;
}

.register-title {
    font-family: var(--title-font);
    color: var(--title-color);
    margin-bottom: 20px;
    font-size: 1.8rem;
    text-align: center;
}

/* Mobile Responsive */
@media (max-width: 767px) {
    .login-container {
        padding: 20px;
    }

    h2 {
        font-size: 1.5rem;
    }

    .input-field {
        padding: 10px;
    }

    #user_login_btn {
        padding: 12px;
        font-size: 1rem;
        width:50%;
    }

    #user_reg_btn {
        width:100%;
    }
}
</style>
