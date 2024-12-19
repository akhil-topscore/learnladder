<?php
/**
 * Facilities
 */
function facilities_custom_post_type()
{
	register_post_type(
		'facilities',
		array(
			'labels'      => array(
				'name'          => __('Facilities'),
				'singular_name' => __('Facility'),
			),
			'public'      => true,
			'has_archive' => true,
			'rewrite'     => array('slug' => 'facility'),
			'menu_icon'   => 'dashicons-admin-multisite',
			'supports'    => array('title', 'editor', 'thumbnail'),
		)
	);
}
add_action('init', 'facilities_custom_post_type');

/**
 * Events
 */
function events_custom_post_type()
{
	register_post_type(
		'events',
		array(
			'labels'      => array(
				'name'          => __('Events'),
				'singular_name' => __('Event'),
			),
			'public'      => true,
			'has_archive' => true,
			'rewrite'     => array('slug' => 'event'),
			'menu_icon'   => 'dashicons-calendar-alt',
			'supports'    => array('title', 'editor', 'thumbnail'),
		)
	);
}
add_action('init', 'events_custom_post_type');

/**
 * News
 */
function news_custom_post_type()
{
	register_post_type(
		'news',
		array(
			'labels'      => array(
				'name'          => __('News'),
				'singular_name' => __('News'),
			),
			'public'      => true,
			'has_archive' => true,
			'rewrite'     => array('slug' => 'news'),
			'menu_icon'   => 'dashicons-megaphone',
			'supports'    => array('title', 'editor', 'thumbnail'),
		)
	);
}
add_action('init', 'news_custom_post_type');

/**
 * Gallery
 */
function gallery_custom_post_type()
{
	register_post_type(
		'gallery',
		array(
			'labels'      => array(
				'name'          => __('Gallery'),
				'singular_name' => __('Gallery'),
			),
			'public'      => true,
			'has_archive' => false,
			'rewrite'     => array('slug' => 'gallery'),
			'menu_icon'   => 'dashicons-format-gallery',
			'supports'    => array('title', 'thumbnail'),
		)
	);
}
add_action('init', 'gallery_custom_post_type');

/**
 * Register Gallery custom column.
 *
 * @param array $columns Existing columns.
 * @return array Columns with custom column added.
 */
function gallery_posts_columns($columns)
{
	$columns = array(
		'cb'             => '<input type="checkbox" />',
		'featured_image' => 'Image',
		'title'          => 'Title',
		'date'           => 'Date',
	);
	return $columns;
}
add_filter('manage_gallery_posts_columns', 'gallery_posts_columns');

/**
 * CBSE
 */
function cbse_custom_post_type() {
    register_post_type(
		'cbse',
        array(
            'labels'      => array(
                'name'          => __( 'CBSE' ),
                'singular_name' => __( 'CBSE' ),
            ),
            'public'      => true,
            'has_archive' => true,
            'rewrite'     => array( 'slug' => 'cbse' ),
            'menu_icon'   => 'dashicons-admin-links',
            'supports'    => array( 'title' )
        )
    );
}
add_action( 'init', 'cbse_custom_post_type' );

/**
 * Show thumbnail image in custom column.
 *
 * @param array $column Existing columns.
 * @param int   $post_id Post ID of thumbnail.
 */
function posts_custom_column($column, $post_id)
{
	switch ($column) {
		case 'featured_image':
			the_post_thumbnail('thumbnail');
			break;

		default:
			break;
	}
}
add_action('manage_posts_custom_column', 'posts_custom_column', 10, 2);
