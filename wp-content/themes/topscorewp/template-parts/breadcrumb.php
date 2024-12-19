<?php
/**
 * The template for displaying breadcrumb.
 *
 * @package TopscoreWP
 */

$attachment_image = wp_get_attachment_url( 1164 );
?>
<section class="breadcrumb-area d-flex  p-relative align-items-center" style="background-image: url(<?php echo esc_url( $attachment_image ); ?>);">
	<div class="container">
		<div class="row align-items-center">
			<div class="col-xl-12 col-lg-12">
				<div class="breadcrumb-wrap text-left mt-140">
					<div class="breadcrumb-title">
						<h2><?php echo esc_html( the_title() ); ?></h2>
					</div>
				</div>
			</div>
			<div class="breadcrumb-wrap2">
				<nav aria-label="breadcrumb">
					<ol class="breadcrumb">
						<li class="breadcrumb-item"><a href="<?php echo esc_url( home_url() ); ?>">Home</a></li>
						<li class="breadcrumb-item active" aria-current="page"><?php echo esc_html( the_title() ); ?></li>
					</ol>
				</nav>
			</div>
		</div>
	</div>
</section>
