<?php
/**
 * The template for displaying archive pages.
 *
 * @package TopscoreWP
 */
?>
<main id="content" class="site-main">
	<header class="page-header">
		<h1 class="page-title">
			<?php
				if ( is_day() ) :
					printf( esc_html__( 'Daily Archives: %s', 'topscorewp' ), get_the_date() );
				elseif ( is_month() ) :
					printf( esc_html__( 'Monthly Archives: %s', 'topscorewp' ), get_the_date( _x( 'F Y', 'monthly archives date format', 'topscorewp' ) ) );
				elseif ( is_year() ) :
					printf( esc_html__( 'Yearly Archives: %s', 'topscorewp' ), get_the_date( _x( 'Y', 'yearly archives date format', 'topscorewp' ) ) );
				else :
					esc_html_e( 'Blog Archives', 'topscorewp' );
				endif;
			?>
		</h1>
	</header>
	<div class="page-content">
		<?php
		while ( have_posts() ) {
			the_post();
			$post_link = get_permalink();
			?>
			<article class="post">
				<?php
				printf( '<h2 class="%s"><a href="%s">%s</a></h2>', 'entry-title', esc_url( $post_link ), wp_kses_post( get_the_title() ) );
				if ( has_post_thumbnail() ) {
					printf( '<a href="%s">%s</a>', esc_url( $post_link ), get_the_post_thumbnail( $post, 'large' ) );
				}
				the_excerpt();
				?>
			</article>
		<?php } ?>
	</div>

	<?php wp_link_pages(); ?>

	<?php
	global $wp_query;
	if ( $wp_query->max_num_pages > 1 ) :
		?>
		<nav class="pagination">
			<?php /* Translators: HTML arrow */ ?>
			<div class="nav-previous"><?php next_posts_link( sprintf( __( '%s older', 'topscorewp' ), '<span class="meta-nav">&larr;</span>' ) ); ?></div>
			<?php /* Translators: HTML arrow */ ?>
			<div class="nav-next"><?php previous_posts_link( sprintf( __( 'newer %s', 'topscorewp' ), '<span class="meta-nav">&rarr;</span>' ) ); ?></div>
		</nav>
	<?php endif; ?>
</main>
