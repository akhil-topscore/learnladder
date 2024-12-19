<?php
/**
 * The template for displaying all single posts.
 *
 * @package TopscoreWP
 */

get_header(); // Include the header

while ( have_posts() ) :
	the_post();
	?>

<main id="content" <?php post_class( 'site-main' ); ?>>
	<div class="page-content">
		<!-- Post Title as Heading -->
		<h1 class="post-title"><?php the_title(); ?></h1>

		<!-- Post Meta (optional: date, author, category) -->
		<div class="post-meta">
			<span class="post-date"><?php echo get_the_date(); ?></span> | 
			<span class="post-author"><?php esc_html_e( 'By', 'topscorewp' ); ?> <?php the_author(); ?></span> |
			<span class="post-category"><?php esc_html_e( 'In', 'topscorewp' ); ?> <?php the_category( ', ' ); ?></span>
		</div>

		<!-- Post Content -->
		<div class="post-content">
			<?php the_content(); ?>
		</div>

		<!-- Post Tags -->
		<div class="post-tags">
			<?php the_tags( '<span class="tag-links">' . esc_html__( 'Tagged: ', 'topscorewp' ), ', ', '</span>' ); ?>
		</div>

		<!-- Pagination Links -->
		<div class="pagination-links">
			<?php wp_link_pages(); ?>
		</div>
	</div>

	<!-- Comments Section -->
	<?php comments_template(); ?>
</main>

<?php
endwhile;

get_footer(); // Include the footer
?>

<style>
/* CSS styles for single post */

/* General Styles */
.site-main {
	max-width: 100%;
	padding: 20px;
	background: #ffffff;
	box-shadow: 0px 2px 8px rgba(0, 0, 0, 0.1);
	overflow: hidden;
	border-top: solid 4px #406c96;
  border-bottom: solid 4px #406c96;
}

/* Post Title */
.post-title {
	font-size: 2.5rem;
	font-weight: bold;
	margin-bottom: 15px;
	color: #333333;
	text-align: center;
}

/* Post Meta */
.post-meta {
	font-size: 0.9rem;
	color: #666666;
	text-align: center;
	margin-bottom: 20px;
}

.post-meta span {
	margin-right: 10px;
}

/* Post Content */
.post-content {
	line-height: 1.8;
	font-size: 1rem;
	color: #555555;
	margin-bottom: 20px;
}

/* Post Tags */
.post-tags {
	margin-top: 20px;
	text-align: center;
}

.post-tags .tag-links a {
	display: inline-block;
	background: #0073aa;
	color: #ffffff;
	padding: 5px 10px;
	margin: 0 5px;
	border-radius: 5px;
	text-decoration: none;
	transition: background-color 0.3s ease;
}

.post-tags .tag-links a:hover {
	background-color: #005177;
}

/* Pagination Links */
.pagination-links {
	margin-top: 20px;
	text-align: center;
}

/* Comments Section */
.comments-area {
	margin-top: 40px;
}

.comments-area h2 {
	font-size: 1.5rem;
	margin-bottom: 20px;
	color: #333333;
}

.comments-area .comment-list li {
	margin-bottom: 20px;
	padding-bottom: 20px;
	border-bottom: 1px solid #eeeeee;
}

/* Media Queries for responsiveness */

/* For Tablets and smaller screens */
@media (max-width: 768px) {
	.site-main {
		max-width: 95%;
		padding: 15px;
	}

	.post-title {
		font-size: 2rem;
	}

	.post-meta {
		font-size: 0.85rem;
	}

	.post-content {
		font-size: 0.95rem;
	}

	.post-tags .tag-links a {
		font-size: 0.9rem;
		padding: 4px 8px;
	}
}

/* For Mobile Devices */
@media (max-width: 480px) {
	.site-main {
		max-width: 100%;
		padding: 10px;
	}

	.post-title {
		font-size: 1.75rem;
	}

	.post-meta {
		font-size: 0.8rem;
	}

	.post-content {
		font-size: 0.9rem;
	}

	.post-tags .tag-links a {
		font-size: 0.85rem;
		padding: 3px 7px;
	}
}
</style>
