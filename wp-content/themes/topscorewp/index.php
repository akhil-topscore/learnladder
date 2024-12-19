<?php
/**
 * The main template file
 *
 * It is used to display a page when nothing more specific matches a query.
 *
 * @package TopscoreWP
 */

get_header();

if ( is_front_page() ) {
	get_template_part( 'template-parts/front-page' );
} elseif ( is_singular() ) {
	get_template_part( 'template-parts/single' );
} elseif ( is_archive() || is_home() ) {
	get_template_part( 'template-parts/archive' );
} else {
	get_template_part( 'template-parts/404' );
}
get_footer();
