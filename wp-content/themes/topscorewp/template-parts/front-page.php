<?php
/**
 * The template for displaying archive pages.
 *
 * @package TopscoreWP
 */

while ( have_posts() ) :
	the_post();
	?>
		<main id="content" class="site-main">
			<?php the_content(); ?>
		</main>
	<?php
endwhile;
