<?php namespace Topscore_Extra\Widgets;

use Elementor\Controls_Manager;
use Elementor\Widget_Base;

if ( !defined('ABSPATH')) {
	exit; // Exit if accessed directly
}

class Category_Slider extends Widget_Base {
	public function get_name() {
		return 'category-slider';
	}

	public function get_title() {
		return esc_html__('Category Slider', 'topscore-extra');
	}

	public function get_icon() {
		return 'eicon-category';
	}

	public function get_keywords() {
		return ['category',
		'slider',
		'slick'];
	}

	public function get_script_depends() {
		return ['jquery',
		'slick-js',
		'category-slider-script'];
	}

	public function get_style_depends() {
		return ['slick-css',
		'slick-theme'];
	}

	public function get_categories() {
		return ['topscore-extra'];
	}

	protected function register_controls() {
		$this->start_controls_section('section_category_slider',
			[ 'label'=> esc_html__('Category Slider', 'topscore-extra'),
			'tab'=> Controls_Manager::TAB_CONTENT,
			]);

		$this->add_responsive_control('categories_per_view',
			[ 'label'=> esc_html__('Categories Per View', 'topscore-extra'),
			'type'=> Controls_Manager::NUMBER,
			'default'=> 4,
			'min'=> 1,
			'max'=> 10,
			'tablet_default'=> 3,
			'mobile_default'=> 1, // 1 category per view on mobile
			'frontend_available'=> true,
			]);

		$this->add_control('enable_autoplay',
			[ 'label'=> esc_html__('Enable Autoplay', 'topscore-extra'),
			'type'=> Controls_Manager::SWITCHER,
			'label_on'=> esc_html__('Yes', 'topscore-extra'),
			'label_off'=> esc_html__('No', 'topscore-extra'),
			'default'=> 'yes',
			'frontend_available'=> true,
			]);

		$this->add_control('autoplay_speed',
			[ 'label'=> esc_html__('Autoplay Speed (ms)', 'topscore-extra'),
			'type'=> Controls_Manager::NUMBER,
			'default'=> 3000,
			'condition'=> [ 'enable_autoplay'=> 'yes',
			],
			'frontend_available'=> true,
			]);

		$this->add_control('scroll_speed',
			[ 'label'=> esc_html__('Scroll Speed (ms)', 'topscore-extra'),
			'type'=> Controls_Manager::NUMBER,
			'default'=> 1000,
			'frontend_available'=> true,
			]);

		$this->end_controls_section();
	}

	protected function render() {
		$settings =$this->get_settings_for_display();

		$categories_per_view =$settings['categories_per_view'];
		$enable_autoplay =$settings['enable_autoplay']==='yes' ? true: false;
		$autoplay_speed =$settings['autoplay_speed'];
		$scroll_speed =$settings['scroll_speed'];

		$args =[ 'taxonomy'=>'product_cat',
		'orderby'=>'name',
		'order'=>'ASC',
		'hide_empty'=>true,
		];

		$categories =get_terms($args);

		if (empty($categories)) {
			return;
		}

		// Enqueue Slick Slider scripts and styles
		wp_enqueue_script('slick-js', 'https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.js', ['jquery'], null, true);

		?><style>.casc-category-slider {
			overflow: hidden !important;
			/* Prevent horizontal overflow */
			position: relative;
			/* To help with centering the slick slider */
		}

		.casc-category-slider .slick-slide {
			width: max-content !important;
			display: flex !important;
			justify-content: center !important;
			align-items: center !important;
			margin: 0 10px !important;
			padding: 2px !important;
		}

		.casc-category-link {
			display: inline-block !important;
			padding: 10px 20px !important;
			font-size: 16px !important;
			font-weight: bold !important;
			text-align: center !important;
			text-decoration: none !important;
			color: black !important;
			background-color: #0073e6 !important;
			border: 2px solid black !important;
			border-radius: 8px !important;
			transition: all 0.3s ease !important;
			white-space: nowrap !important;
			background: white !important;
		}

		.casc-category-link:hover {
			background-color: #3f6b95 !important;
			border-color: black !important;
			color: #fff !important;
		}

		.slick-prev i,
		.slick-next i {
			font-size: 16px !important;
			color: #fff !important;
		}

		/* Customizing Font Awesome arrows */
		.slick-prev,
		.slick-next {
			background: white !important;
			border: none !important;
			color: #0073e6 !important;
			font-size: 16px !important;
			position: absolute !important;
			z-index: 1 !important;
			top: 50% !important;
			transform: translateY(-50%) !important;
			transition: color 0.3s ease !important;
			width: 40px !important;
			height: 40px !important;
			display: flex !important;
			justify-content: center !important;
			align-items: center !important;
			border-radius: 50% !important;
			box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1) !important;
		}

		.slick-prev:hover,
		.slick-next:hover {
			color: #005bb5 !important;
			background-color: #f1f1f1 !important;
		}

		.slick-prev i,
		.slick-next i {
			font-size: 16px !important;
			color: #0073e6 !important;
		}

		.slick-prev:hover i,
		.slick-next:hover i {
			color: #005bb5 !important;
		}

		.slick-prev {
			left: 10px !important;
			/* Adjust left arrow position */
		}

		.slick-next {
			right: 10px !important;
			/* Adjust right arrow position */
		}

		/* Make sure arrows are visible on mobile */
		@media (max-width: 768px) {

			.slick-prev,
			.slick-next {
				display: block !important;
				/* Ensure arrows are visible */
				width: 30px !important;
				height: 30px !important;
			}

			.casc-category-slider {
				padding-left: 20px !important;
				padding-right: 20px !important;
			}
		}

		/* Hide arrows on very small screen sizes if needed */
		@media (max-width: 480px) {

			.slick-prev,
			.slick-next {
				width: 30px !important;
				height: 30px !important;
			}
		}

		</style><div class="casc-category-slider"><?php foreach ($categories as $category) : ?><div><a href="<?php echo esc_url(get_term_link($category)); ?>" class="casc-category-link"><?php echo esc_html($category->name);
		?></a></div><?php endforeach;

		?></div><script>jQuery(document).ready(function ($) {
				var $slider =$('.casc-category-slider');

				// Initialize the slick slider with responsive settings
				$slider.slick({
					pauseOnHover: true,
					infinite: true,
					slidesToShow: <?php echo esc_js($categories_per_view); ?>,
					autoplay: <?php echo $enable_autoplay ? 'true' : 'false'; ?>,
					autoplaySpeed: <?php echo esc_js($autoplay_speed); ?>,
					speed: <?php echo esc_js($scroll_speed); ?>,
					arrows: true,
					prevArrow: '<button class="slick-prev"><i class="fas fa-chevron-left"></i></button>',
					nextArrow: '<button class="slick-next"><i class="fas fa-chevron-right"></i></button>',
					centerMode: true, // Centers the active category
					centerPadding: '0', // Ensures no padding around the centered item

					responsive: [ {
						breakpoint: 1024, // Tablet

						settings: {
							slidesToShow: <?php echo esc_js($categories_per_view); ?>,
						}
					}

					,
					{
					breakpoint: 768, // Mobile

					settings: {
						slidesToShow: 1, // Show 1 category on mobile
						arrows: true, // Show arrows on mobile
						centerMode: true, // Center the active item
						centerPadding: '0', // Prevent extra space on the sides
					}
				}

				]
			});
	});
</script><?php
}
}