<?php
/**
 * The template for displaying 404 pages (not found).
 *
 * @package TopscoreWP
 */
?>

<main id="content" class="site-main">
	<div class="error-404 not-found text-center">
		<div class="container d-flex flex-column align-items-center justify-content-center">
			<h1 class="error-title"><?php esc_html_e('404', 'topscorewp'); ?></h1>
			<h2 class="error-message"><?php esc_html_e('Oops! Page not found.', 'topscorewp'); ?></h2>
			<p class="error-description">
				<?php esc_html_e('It looks like nothing was found at this location. Maybe try one of the options below or go back to the homepage.', 'topscorewp'); ?>
			</p>

			<a href="<?php echo esc_url(home_url()); ?>" class="btn btn-primary mt-4">
				<?php esc_html_e('Return to Homepage', 'topscorewp'); ?>
			</a>

		</div>
	</div>
</main>

<style>
	/* 404 Page Styling */
.error-404 {
    padding: 50px 0;
    text-align: center;
}

.error-title {
    font-size: 120px;
    font-weight: 900;
    color: #ff4b5c;
}

.error-message {
    font-size: 30px;
    font-weight: 600;
    margin-top: 20px;
    color: #333;
}

.error-description {
    font-size: 18px;
    color: #666;
    margin-bottom: 20px;
}

.error-search {
    margin-top: 20px;
}

.error-search input[type="search"] {
    width: 300px;
    padding: 10px;
    border-radius: 4px;
    border: 1px solid #ddd;
}

.error-image img {
    max-width: 100%;
    height: auto;
}

.btn-primary {
    background-color: #ff4b5c;
    border-color: #ff4b5c;
    padding: 10px 20px;
    font-size: 18px;
    color: #fff;
}

.btn-primary:hover {
    background-color: #ff6f73;
    border-color: #ff6f73;
}

</style>