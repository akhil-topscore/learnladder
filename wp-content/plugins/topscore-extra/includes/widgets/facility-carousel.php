<?php

namespace Topscore_Extra\Widgets;

use Elementor\Controls_Manager;
use Elementor\Icons_Manager;
use Elementor\Utils;
use Elementor\Widget_Base;
use Topscore_Extra\Plugin;

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly
}

class Facility_Carousel extends Widget_Base
{

    public function get_name()
    {
        return 'facility-carousel';
    }

    public function get_title()
    {
        return esc_html__('Facility Carousel', 'topscore-extra');
    }

    public function get_icon()
    {
        return 'eicon-price-table';
    }

    public function get_keywords()
    {
        return ['facility', 'carousel'];
    }

    public function get_script_depends()
    {
        return ['facility-script'];
    }

    public function get_style_depends()
    {
        return ['facility-style'];
    }

    public function get_categories()
    {
        return ['topscore-extra'];
    }

    protected function register_controls()
    {
        $this->start_controls_section(
            'section_facility',
            [
                'label' => esc_html__('Facility', 'topscore-extra'),
                'tab' => Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'posts-per-page',
            [
                'label' => __('Post Per Page', 'topscore-extra'),
                'type' => Controls_Manager::SELECT,
                'multiple' => false,
                'default' => '3',
                'options' => [
                    '3' => '3',
                    '6' => '6',
                    '-1' => '-1',
                ]
            ]
        );

        $this->add_control(
            'post-order-by',
            [
                'label' => __('Order By', 'topscore-extra'),
                'type' => Controls_Manager::SELECT,
                'multiple' => false,
                'default' => 'date',
                'options' => [
                    'name' => 'name',
                    'title' => 'title',
                    'date' => 'date',
                    'rand' => 'rand'
                ]
            ]
        );

        $this->add_control(
            'post-order',
            [
                'label' => __('Order', 'topscore-extra'),
                'type' => Controls_Manager::SELECT,
                'multiple' => false,
                'default' => 'DESC',
                'options' => [
                    'ASC' => 'ASC',
                    'DESC' => 'DESC',
                ]
            ]
        );

        $slides_per_view = range(1, 10);
        $slides_per_view = array_combine($slides_per_view, $slides_per_view);

        $this->add_responsive_control(
            'slides_per_view',
            [
                'type' => Controls_Manager::SELECT,
                'label' => esc_html__('Slides Per View', 'topscore-extra'),
                'options' => ['' => esc_html__('Default', 'topscore-extra')] + $slides_per_view,
                'inherit_placeholders' => false,
                'frontend_available' => true,
            ]
        );

        $this->add_responsive_control(
            'slides_to_scroll',
            [
                'type' => Controls_Manager::SELECT,
                'label' => esc_html__('Slides to Scroll', 'topscore-extra'),
                'description' => esc_html__('Set how many slides are scrolled per swipe.', 'topscore-extra'),
                'options' => ['' => esc_html__('Default', 'topscore-extra')] + $slides_per_view,
                'inherit_placeholders' => false,
                'frontend_available' => true,
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'section_slider_options',
            [
                'label' => esc_html__('Facility Slider Options', 'topscore-extra'),
                'type' => Controls_Manager::SECTION,
            ]
        );

        $this->add_control(
            'navigation',
            [
                'label' => esc_html__('Navigation', 'topscore-extra'),
                'type' => Controls_Manager::SELECT,
                'default' => 'both',
                'options' => [
                    'both' => esc_html__('Arrows and Dots', 'topscore-extra'),
                    'arrows' => esc_html__('Arrows', 'topscore-extra'),
                    'dots' => esc_html__('Dots', 'topscore-extra'),
                    'none' => esc_html__('None', 'topscore-extra'),
                ],
                'frontend_available' => true,
            ]
        );

        $this->add_control(
            'autoplay',
            [
                'label' => esc_html__('Autoplay', 'topscore-extra'),
                'type' => Controls_Manager::SWITCHER,
                'default' => 'yes',
                'frontend_available' => true,
            ]
        );

        $this->add_control(
            'pause_on_hover',
            [
                'label' => esc_html__('Pause on Hover', 'topscore-extra'),
                'type' => Controls_Manager::SWITCHER,
                'default' => 'yes',
                'render_type' => 'none',
                'frontend_available' => true,
                'condition' => [
                    'autoplay!' => '',
                ],
            ]
        );

        $this->add_control(
            'pause_on_interaction',
            [
                'label' => esc_html__('Pause on Interaction', 'topscore-extra'),
                'type' => Controls_Manager::SWITCHER,
                'default' => 'yes',
                'render_type' => 'none',
                'frontend_available' => true,
                'condition' => [
                    'autoplay!' => '',
                ],
            ]
        );

        $this->add_control(
            'autoplay_speed',
            [
                'label' => esc_html__('Autoplay Speed', 'topscore-extra'),
                'type' => Controls_Manager::NUMBER,
                'default' => 5000,
                'condition' => [
                    'autoplay' => 'yes',
                ],
                'selectors' => [
                    '{{WRAPPER}} .swiper-slide' => 'transition-duration: calc({{VALUE}}ms*1.2)',
                ],
                'render_type' => 'none',
                'frontend_available' => true,
            ]
        );

        $this->add_control(
            'infinite',
            [
                'label' => esc_html__('Infinite Loop', 'topscore-extra'),
                'type' => Controls_Manager::SWITCHER,
                'default' => 'yes',
                'frontend_available' => true,
            ]
        );

        $this->add_control(
            'transition',
            [
                'label' => esc_html__('Transition', 'topscore-extra'),
                'type' => Controls_Manager::SELECT,
                'default' => 'slide',
                'options' => [
                    'slide' => esc_html__('Slide', 'topscore-extra'),
                    'fade' => esc_html__('Fade', 'topscore-extra'),
                ],
                'frontend_available' => true,
            ]
        );

        $this->add_control(
            'transition_speed',
            [
                'label' => esc_html__('Transition Speed', 'topscore-extra') . ' (ms)',
                'type' => Controls_Manager::NUMBER,
                'default' => 500,
                'render_type' => 'none',
                'frontend_available' => true,
            ]
        );

        $this->add_control(
            'content_animation',
            [
                'label' => esc_html__('Content Animation', 'topscore-extra'),
                'type' => Controls_Manager::SELECT,
                'default' => 'fadeInUp',
                'options' => [
                    '' => esc_html__('None', 'topscore-extra'),
                    'fadeInDown' => esc_html__('Down', 'topscore-extra'),
                    'fadeInUp' => esc_html__('Up', 'topscore-extra'),
                    'fadeInRight' => esc_html__('Right', 'topscore-extra'),
                    'fadeInLeft' => esc_html__('Left', 'topscore-extra'),
                    'zoomIn' => esc_html__('Zoom', 'topscore-extra'),
                ],
                'assets' => [
                    'styles' => [
                        [
                            'name' => 'e-animations',
                            'conditions' => [
                                'terms' => [
                                    [
                                        'name' => 'content_animation',
                                        'operator' => '!==',
                                        'value' => '',
                                    ],
                                ],
                            ],
                        ],
                    ],
                ],
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'section_style_navigation',
            [
                'label' => esc_html__('Navigation', 'topscore-extra'),
                'tab' => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'navigation' => ['arrows', 'dots', 'both'],
                ],
            ]
        );

        $this->add_control(
            'heading_style_arrows',
            [
                'label' => esc_html__('Arrows', 'topscore-extra'),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before',
                'condition' => [
                    'navigation' => ['arrows', 'both'],
                ],
            ]
        );

        $this->add_control(
            'arrows_position',
            [
                'label' => esc_html__('Position', 'topscore-extra'),
                'type' => Controls_Manager::SELECT,
                'default' => 'inside',
                'options' => [
                    'inside' => esc_html__('Inside', 'topscore-extra'),
                    'outside' => esc_html__('Outside', 'topscore-extra'),
                ],
                'prefix_class' => 'elementor-arrows-position-',
                'condition' => [
                    'navigation' => ['arrows', 'both'],
                ],
            ]
        );

        $this->add_responsive_control(
            'arrows_size',
            [
                'label' => esc_html__('Size', 'topscore-extra'),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px', 'em', 'rem', 'custom'],
                'range' => [
                    'px' => [
                        'max' => 100,
                    ],
                    'em' => [
                        'max' => 10,
                    ],
                    'rem' => [
                        'max' => 10,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .elementor-swiper-button' => 'font-size: {{SIZE}}{{UNIT}}',
                ],
                'condition' => [
                    'navigation' => ['arrows', 'both'],
                ],
            ]
        );

        $this->add_control(
            'arrows_color',
            [
                'label' => esc_html__('Color', 'topscore-extra'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .elementor-swiper-button' => 'color: {{VALUE}}',
                    '{{WRAPPER}} .elementor-swiper-button svg' => 'fill: {{VALUE}}',
                ],
                'condition' => [
                    'navigation' => ['arrows', 'both'],
                ],
            ]
        );

        $this->add_control(
            'heading_style_dots',
            [
                'label' => esc_html__('Pagination', 'topscore-extra'),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before',
                'condition' => [
                    'navigation' => ['dots', 'both'],
                ],
            ]
        );

        $this->add_control(
            'dots_position',
            [
                'label' => esc_html__('Position', 'topscore-extra'),
                'type' => Controls_Manager::SELECT,
                'default' => 'inside',
                'options' => [
                    'outside' => esc_html__('Outside', 'topscore-extra'),
                    'inside' => esc_html__('Inside', 'topscore-extra'),
                ],
                'prefix_class' => 'elementor-pagination-position-',
                'condition' => [
                    'navigation' => ['dots', 'both'],
                ],
            ]
        );

        $swiper_class = Plugin::elementor()->experiments->is_feature_active('e_swiper_latest') ? 'swiper' : 'swiper-container';

        $this->add_responsive_control(
            'dots_size',
            [
                'label' => esc_html__('Size', 'topscore-extra'),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px', 'em', 'rem', 'custom'],
                'range' => [
                    'px' => [
                        'max' => 100,
                    ],
                    'em' => [
                        'max' => 10,
                    ],
                    'rem' => [
                        'max' => 10,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .swiper-pagination-bullet' => 'height: {{SIZE}}{{UNIT}}; width: {{SIZE}}{{UNIT}}',
                    '{{WRAPPER}} .' . $swiper_class . '-horizontal .swiper-pagination-progressbar' => 'height: {{SIZE}}{{UNIT}}',
                    '{{WRAPPER}} .swiper-pagination-fraction' => 'font-size: {{SIZE}}{{UNIT}}',
                ],
                'condition' => [
                    'navigation' => ['dots', 'both'],
                ],
            ]
        );

        $this->add_control(
            'dots_color_inactive',
            [
                'label' => esc_html__('Color', 'topscore-extra'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    // The opacity property will override the default inactive dot color which is opacity 0.2.
                    '{{WRAPPER}} .swiper-pagination-bullet:not(.swiper-pagination-bullet-active)' => 'background-color: {{VALUE}}; opacity: 1;',
                ],
                'condition' => [
                    'navigation' => ['dots', 'both'],
                ],
            ]
        );

        $this->add_control(
            'dots_color',
            [
                'label' => esc_html__('Active Color', 'topscore-extra'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .swiper-pagination-bullet-active' => 'background-color: {{VALUE}};',
                ],
                'condition' => [
                    'navigation' => ['dots', 'both'],
                ],
            ]
        );

        $this->end_controls_section();
    }

    /**
     * Render the widget output on the frontend.
     */
    protected function render()
    {
        $settings = $this->get_settings_for_display();

        $show_dots = (in_array($settings['navigation'], ['dots', 'both']));
        $show_arrows = (in_array($settings['navigation'], ['arrows', 'both']));

        $swiper_class = Plugin::elementor()->experiments->is_feature_active('e_swiper_latest') ? 'swiper' : 'swiper-container';

        $postsPerPage = $settings['posts-per-page'];
        $orderBy = $settings['post-order-by'];
        $order = $settings['post-order'];

        $args = array(
            'post_type' => 'facilities',
            'post_status' => 'publish',
            'posts_per_page' => $postsPerPage,
            'orderby' => $orderBy,
            'order' => $order
        );

        $the_query = new \WP_Query($args);
        $slides_count = $the_query->post_count;
        if ($the_query->have_posts()) :
?>
            <div class="elementor-swiper">
                <div class="elementor-facility-wrapper elementor-main-swiper <?php echo esc_attr($swiper_class); ?>">
                    <div class="swiper-wrapper elementor-slides">
                        <?php while ($the_query->have_posts()) :
                            $the_query->the_post();
                            $post_id = get_the_ID();  ?>
                            <div class="swiper-slide">
                                <div class="facility-card">
                                    <div class="image-wrap">
                                        <figure class="image">
                                            <a href="<?php the_permalink(); ?>">
                                                <img width="420" height="320" src="<?php echo esc_url(get_the_post_thumbnail_url($post_id, 'medium')); ?>" alt="<?php the_title(); ?>">
                                            </a>
                                        </figure>
                                    </div>
                                    <div class="content-wrap">
                                        <h4 class="title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h4>
                                    </div>
                                </div>
                            </div>
                        <?php endwhile;
                        wp_reset_postdata(); ?>
                    </div>
                    <?php if (1 < $slides_count) : ?>
                        <?php if ($show_dots) : ?>
                            <div class="swiper-pagination"></div>
                        <?php endif; ?>
                        <?php if ($show_arrows) : ?>
                            <div class="elementor-swiper-button elementor-swiper-button-prev" role="button" tabindex="0">
                                <?php $this->render_swiper_button('previous'); ?>
                                <span class="elementor-screen-only"><?php echo esc_html__('Previous slide', 'topscore-extra'); ?></span>
                            </div>
                            <div class="elementor-swiper-button elementor-swiper-button-next" role="button" tabindex="0">
                                <?php $this->render_swiper_button('next'); ?>
                                <span class="elementor-screen-only"><?php echo esc_html__('Next slide', 'topscore-extra'); ?></span>
                            </div>
                        <?php endif; ?>
                    <?php endif; ?>
                </div>
            </div>
        <?php endif; ?>
<?php
    }

    private function render_swiper_button($type)
    {
        $direction = 'next' === $type ? 'right' : 'left';

        if (is_rtl()) {
            $direction = 'right' === $direction ? 'left' : 'right';
        }

        $icon_value = 'eicon-chevron-' . $direction;

        Icons_Manager::render_icon([
            'library' => 'eicons',
            'value' => $icon_value,
        ], ['aria-hidden' => 'true']);
    }
}
