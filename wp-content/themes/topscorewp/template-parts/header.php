<?php
/**
 * The template for displaying header.
 *
 * @package TopscoreWP
 */

$site_name       = get_bloginfo('name', 'display');
$topbar_enabled  = get_theme_mod('topbar_enabled', '1');
$notice_field    = get_theme_mod('notice_field', 'Notice');
$email_text      = get_theme_mod('email_text', 'Send Email');
$email_field     = get_theme_mod('email_field', 'example@example.com');
$tel_text        = get_theme_mod('tel_text', 'Call Anytime');
$tel_field       = get_theme_mod('tel_field', '02451663');
$address_text    = get_theme_mod('address_text', 'Reach Out');
$address_field   = get_theme_mod('address_field', 'Address');
$header_nav_menu = wp_nav_menu(
    array(
        'theme_location' => 'menu-1',
        'menu_class'     => 'navbar-nav ms-auto p-4 p-lg-0',
        'menu_id'        => 'responsive-menu',
        'container'      => NULL,
        'fallback_cb'     => 'WP_Bootstrap_Navwalker::fallback',
        'walker'          => new WP_Bootstrap_Navwalker(),
        'echo'           => false,
    )
);
?>
<!-- header -->
<header class="main-header">
    <nav class="navbar navbar-expand-lg navbar-light sticky-top p-0">
        <div class="container">
            <a class="navbar-brand" href="<?php echo esc_url(home_url()); ?>" title="<?php echo esc_attr($site_name); ?>" rel="home">
                <?php
                $header_logo = wp_get_attachment_image_src(get_theme_mod('custom_logo'), 'full');

                if (!empty($header_logo)) :
                ?>
                    <img src="<?php echo esc_url($header_logo[0]); ?>" width="auto" alt="<?php echo esc_attr($site_name); ?>" />
                <?php
                else :
                    echo esc_attr($site_name);
                endif;
                ?>
            </a>
            

            
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle Navigation">
                <span class="navbar-toggler-icon"></span>
            </button>


            <div class="collapse navbar-collapse" id="navbarCollapse">
                <?php if ($header_nav_menu) : ?>
                    <?php
                    // PHPCS - escaped by WordPress with "wp_nav_menu"
                    echo $header_nav_menu; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
                    ?>
                <?php endif; ?>
            </div>
            
        </div>
    </nav>
</header>
<!-- header-end -->

<style>
@media (max-width: 365px) {
    .main-header .navbar .navbar-brand img{
        height:35px;
    }
}
</style>

