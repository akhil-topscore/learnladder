<footer class="footer">
    <div class="container">
        <div class="footer-top flex justify-content-around flex-wrap align-items-center flex-md-row flex-column">
            <div class="row">
                <div class="col-lg-4 col-md-12 footer-logo-section">
                    <div class="footer-logo">
                        <a href="<?php echo esc_url(home_url()); ?>">
                            <?php
                            if (function_exists('the_custom_logo') && get_theme_mod('custom_logo')) {
                                the_custom_logo();
                            } else {
                                echo '<img src="' . get_template_directory_uri() . '/assets/images/logo.png" alt="' . esc_attr(get_bloginfo('name')) . '">';
                            }
                            ?>
                        </a>
                    </div>
                    <p>We are dedicated to providing high-quality products and exceptional service to our customers.</p>
                    <div class="contact-info">
                        <p><i class="fas fa-map-marker-alt"></i> Kochi, Kerala </p>
                        <p><i class="fas fa-phone-alt"></i> +91 62829 06800</p>
                        <p><i class="fas fa-envelope"></i> <a href="mailto:info@learnladder.in">info@learnladder.in</a></p>
                    </div>
                    <div class="social-icons">
                        <a href="#" aria-label="Facebook"><i class="fab fa-facebook-f"></i></a>
                        <a href="#" aria-label="Instagram"><i class="fab fa-instagram"></i></a>
                        <a href="#" aria-label="LinkedIn"><i class="fab fa-linkedin-in"></i></a>
                        <a href="#" aria-label="YouTube"><i class="fab fa-youtube"></i></a>
                    </div>
                </div>
                <div class="col-lg-8 col-md-12 footer-menus">
                    <div class="row">
                        <div class="col-md-4">
                            <h5>Quick Links</h5>
                            <?php
                            if (has_nav_menu('footer-menu')) {
                                wp_nav_menu(array(
                                    'theme_location' => 'footer-menu',
                                    'menu_class' => 'footer-menu',
                                    'container' => false,
                                ));
                            } else {
                                echo '<ul>
                                        <li><a href="#">Home</a></li>
                                        <li><a href="#">Products</a></li>
                                        <li><a href="#">Contact</a></li>
                                      </ul>';
                            }
                            ?>
                        </div>
                        <div class="col-md-4">
                            <h5>Resources</h5>
                            <ul>
                                <li><a href="#">Terms of Service</a></li>
                                <li><a href="#">Privacy Policy</a></li>
                            </ul>
                        </div>
                        <div class="col-md-4">
                            <h5>My Account</h5>
                            <ul>
                                <li><a href="#">Login</a></li>
                                <li><a href="#">Register</a></li>
                                <li><a href="#">My Orders</a></li>
                                <li><a href="#">Wishlist</a></li>
                                <li><a href="#">Account Settings</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>  
        </div>
    </div>
</footer>

<div class="float-buttons">
    <div class="navbar-cart">
        <?php if (is_user_logged_in()) : ?>
            <a href="<?php echo esc_url(wc_get_cart_url()); ?>" class="cart-icon">
                <i class="fa-solid fa-cart-shopping"></i>
                <span class="cart-count"><?php echo WC()->cart->get_cart_contents_count(); ?></span>
            </a>
        <?php endif; ?>
    </div>
    <a href="https://api.whatsapp.com/send?phone=6282906800" class="whatsapp" target="_blank">
        <i class="fab fa-whatsapp" aria-hidden="true"></i>
    </a>
</div>
<div class="scroll-top">
    <svg class="progress-circle svg-content" width="100%" height="100%" viewBox="-1 -1 102 102">
        <path d="M50,1 a49,49 0 0,1 0,98 a49,49 0 0,1 0,-98"></path>
    </svg>
</div>
<div class="footer-bottom">
    <div class="row" style="margin: 0;">
        <div class="col-md-6 copyright">
            <p>© <?php echo date("Y"); ?> <?php bloginfo('name'); ?>. All Rights Reserved.</p>
        </div>
        <div class="col-md-6 text-center copy2">
            <p>Digitally Empowered By <a href="https://topscoresoftwares.com" target="_blank">Topscore</a></p>
        </div>
    </div>
</div>

<!-- Include FontAwesome and Styles -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
<link href="https://fonts.googleapis.com/css2?family=Lato:wght@400;700&family=Poppins:wght@400;700&display=swap" rel="stylesheet">

<!-- Footer CSS -->
<style>
/* General Footer Styles */

body, p, a, ul, li {
    font-family: 'Lato', sans-serif;
}

/* Headers (h1, h2, h3, h4, h5, h6) */
h1, h2, h3, h4, h5, h6 {
    font-family: 'Poppins', sans-serif;
}


/* Footer Bottom Section */
.footer-bottom {
    background-color: #fff; 
    text-align: center;
    position: relative;
}
.footer-bottom p{
    margin:15px 0;
    line-height:0;
}

/* Footer Top Section */
.footer-top {
    margin: 0 40px;
    display: flex;
    justify-content: space-between;
}

/* Footer Logo Styles */
.footer-logo img {
    width: auto;
    height: auto;
    max-width: 150px;
}

/* Footer Menu Styles */
.footer-menus h5 {
    font-size: 16px;
    font-weight: bold;
    margin-bottom: 20px;
}

.footer-menus ul {
    list-style: none;
    padding: 0;
}

.footer-menus ul li {
    margin-bottom: 10px;
}

/* Footer Social Icons */
.social-icons a {
    margin: 0 10px;
    font-size: 18px;
    color: #555;
}

.social-icons a:hover {
    color: #f15b2a;
}


/* Footer Copyright Text */
.copyright {
    text-align: center;
    font-size: 14px;
    padding:0;
    margin:15px 0;
}

.copy2{
    padding:0;
    margin:15px 0;
}

.col-md-6.text-center.copy2 p a:hover{
    color:#f15b2a !important;
}

@media (max-width: 768px) {
    .footer-menus, .copyright, .social-icons {
        text-align: center;
    }
}
/* Cart Icon Styles */
.navbar-cart {
    text-align: center;
    margin-bottom: 10px;
}

.navbar-cart .cart-icon {
    display: inline-block;
    background-color: #fff;
    border: 2px solid #f15b2a;
    border-radius: 50%;
    padding: 10px;
    box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
    color: #f15b2a;
    font-size: 20px;
    transition: all 0.3s ease;
}

.navbar-cart .cart-icon:hover {
    background-color: #f15b2a;
    color: #fff !important;
}

.navbar-cart .cart-count {
    position: absolute;
    top: -5px;
    right: -5px;
    background-color: #ff0000;
    color: #fff;
    border-radius: 50%;
    font-size: 12px;
    width: 18px;
    height: 18px;
    display: flex;
    justify-content: center;
    align-items: center;
    font-weight: bold;
    border: 2px solid #fff;
}

</style>

<script>
// Real-time update for cart count using AJAX
jQuery(function($){
    // Trigger a cart update
    function updateCartCount() {
        $.ajax({
            url: '<?php echo admin_url( 'admin-ajax.php' ); ?>',
            type: 'GET',
            data: {
                action: 'get_cart_count',
            },
            success: function(response) {
                $('.cart-count').text(response); // Update the cart count in header
            }
        });
    }

    // WooCommerce Cart updates (add, remove, or update cart)
    $('body').on('added_to_cart removed_from_cart updated_cart_totals', function(){
        updateCartCount();
    });
});
</script>