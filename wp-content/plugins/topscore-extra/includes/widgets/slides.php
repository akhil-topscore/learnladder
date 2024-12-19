<?php

namespace Topscore_Extra\Widgets;

use Elementor\Controls_Manager;
use Elementor\Core\Kits\Documents\Tabs\Global_Typography;
use Elementor\Group_Control_Background;
use Elementor\Group_Control_Text_Shadow;
use Elementor\Group_Control_Typography;
use Elementor\Icons_Manager;
use Elementor\Repeater;
use Elementor\Utils;
use Elementor\Widget_Base;
use Topscore_Extra\Plugin;

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly
}

class Slides extends Widget_Base
{

    public function get_name()
    {
        return 'slides';
    }

    public function get_title()
    {
        return esc_html__('Slides', 'topscore-extra');
    }

    public function get_icon()
    {
        return 'eicon-slides';
    }

    public function get_keywords()
    {
        return ['slides', 'carousel', 'image', 'title', 'slider'];
    }

    public function get_script_depends()
    {
        return ['imagesloaded', 'slides-script'];
    }

    public function get_style_depends()
    {
        return ['slides-style'];
    }

    public static function get_button_sizes()
    {
        return [
            'xs' => esc_html__('Extra Small', 'topscore-extra'),
            'sm' => esc_html__('Small', 'topscore-extra'),
            'md' => esc_html__('Medium', 'topscore-extra'),
            'lg' => esc_html__('Large', 'topscore-extra'),
            'xl' => esc_html__('Extra Large', 'topscore-extra'),
        ];
    }

    public function get_categories()
    {
        return ['topscore-extra'];
    }

    protected function register_controls()
    {
        $this->start_controls_section(
            'section_slides',
            [
                'label' => esc_html__('Slides', 'topscore-extra'),
            ]
        );

        $repeater = new Repeater();

        $repeater->start_controls_tabs('slides_repeater');

        $repeater->start_controls_tab(
            'background',
            [
                'label' => esc_html__('Background', 'topscore-extra'),
            ]
        );

        $repeater->add_control(
            'background_color',
            [
                'label' => esc_html__('Color', 'topscore-extra'),
                'type' => Controls_Manager::COLOR,
                'default' => '#bbbbbb',
                'selectors' => [
                    '{{WRAPPER}} {{CURRENT_ITEM}} .swiper-slide-bg' => 'background-color: {{VALUE}}',
                ],
            ]
        );

        $repeater->add_control(
            'background_image',
            [
                'label' => _x('Image', 'Background Control', 'topscore-extra'),
                'type' => Controls_Manager::MEDIA,
                'selectors' => [
                    '{{WRAPPER}} {{CURRENT_ITEM}} .swiper-slide-bg' => 'background-image: url({{URL}})',
                ],
            ]
        );

        $repeater->add_control(
            'background_size',
            [
                'label' => _x('Size', 'Background Control', 'topscore-extra'),
                'type' => Controls_Manager::SELECT,
                'default' => 'cover',
                'options' => [
                    'cover' => _x('Cover', 'Background Control', 'topscore-extra'),
                    'contain' => _x('Contain', 'Background Control', 'topscore-extra'),
                    'auto' => _x('Auto', 'Background Control', 'topscore-extra'),
                ],
                'selectors' => [
                    '{{WRAPPER}} {{CURRENT_ITEM}} .swiper-slide-bg' => 'background-size: {{VALUE}}',
                ],
                'conditions' => [
                    'terms' => [
                        [
                            'name' => 'background_image[url]',
                            'operator' => '!=',
                            'value' => '',
                        ],
                    ],
                ],
            ]
        );

        $repeater->add_control(
            'background_ken_burns',
            [
                'label' => esc_html__('Ken Burns Effect', 'topscore-extra'),
                'type' => Controls_Manager::SWITCHER,
                'default' => '',
                'conditions' => [
                    'terms' => [
                        [
                            'name' => 'background_image[url]',
                            'operator' => '!=',
                            'value' => '',
                        ],
                    ],
                ],
            ]
        );

        $repeater->add_control(
            'zoom_direction',
            [
                'label' => esc_html__('Zoom Direction', 'topscore-extra'),
                'type' => Controls_Manager::SELECT,
                'default' => 'in',
                'options' => [
                    'in' => esc_html__('In', 'topscore-extra'),
                    'out' => esc_html__('Out', 'topscore-extra'),
                ],
                'conditions' => [
                    'terms' => [
                        [
                            'name' => 'background_ken_burns',
                            'operator' => '!=',
                            'value' => '',
                        ],
                    ],
                ],
            ]
        );

        $repeater->add_control(
            'background_overlay',
            [
                'label' => esc_html__('Background Overlay', 'topscore-extra'),
                'type' => Controls_Manager::SWITCHER,
                'default' => '',
                'conditions' => [
                    'terms' => [
                        [
                            'name' => 'background_image[url]',
                            'operator' => '!=',
                            'value' => '',
                        ],
                    ],
                ],
            ]
        );

        $repeater->add_control(
            'background_overlay_color',
            [
                'label' => esc_html__('Color', 'topscore-extra'),
                'type' => Controls_Manager::COLOR,
                'default' => 'rgba(0,0,0,0.5)',
                'conditions' => [
                    'terms' => [
                        [
                            'name' => 'background_overlay',
                            'value' => 'yes',
                        ],
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} {{CURRENT_ITEM}} .elementor-background-overlay' => 'background-color: {{VALUE}}',
                ],
            ]
        );

        $repeater->add_control(
            'background_overlay_blend_mode',
            [
                'label' => esc_html__('Blend Mode', 'topscore-extra'),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    '' => esc_html__('Normal', 'topscore-extra'),
                    'multiply' => 'Multiply',
                    'screen' => 'Screen',
                    'overlay' => 'Overlay',
                    'darken' => 'Darken',
                    'lighten' => 'Lighten',
                    'color-dodge' => 'Color Dodge',
                    'color-burn' => 'Color Burn',
                    'hue' => 'Hue',
                    'saturation' => 'Saturation',
                    'color' => 'Color',
                    'exclusion' => 'Exclusion',
                    'luminosity' => 'Luminosity',
                ],
                'conditions' => [
                    'terms' => [
                        [
                            'name' => 'background_overlay',
                            'value' => 'yes',
                        ],
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} {{CURRENT_ITEM}} .elementor-background-overlay' => 'mix-blend-mode: {{VALUE}}',
                ],
            ]
        );

        $repeater->end_controls_tab();

        $repeater->start_controls_tab(
            'content',
            [
                'label' => esc_html__('Content', 'topscore-extra'),
            ]
        );

        $repeater->add_control(
            'heading',
            [
                'label' => esc_html__('Title', 'topscore-extra'),
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__('Slide Heading', 'topscore-extra'),
                'label_block' => true,
                'dynamic' => [
                    'active' => true,
                ],
            ]
        );

        $repeater->add_control(
            'description',
            [
                'label' => esc_html__('Description', 'topscore-extra'),
                'type' => Controls_Manager::TEXTAREA,
                'default' => esc_html__('Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut elit tellus, luctus nec ullamcorper mattis, pulvinar dapibus leo.', 'topscore-extra'),
                'dynamic' => [
                    'active' => true,
                ],
            ]
        );

        $repeater->add_control(
            'button_text',
            [
                'label' => esc_html__('Button Text', 'topscore-extra'),
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__('Click Here', 'topscore-extra'),
                'dynamic' => [
                    'active' => true,
                ],
            ]
        );

        $repeater->add_control(
            'link',
            [
                'label' => esc_html__('Link', 'topscore-extra'),
                'type' => Controls_Manager::URL,
                'placeholder' => esc_html__('https://your-link.com', 'topscore-extra'),
                'dynamic' => [
                    'active' => true,
                ],
            ]
        );

        $repeater->add_control(
            'link_click',
            [
                'label' => esc_html__('Apply Link On', 'topscore-extra'),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    'slide' => esc_html__('Whole Slide', 'topscore-extra'),
                    'button' => esc_html__('Button Only', 'topscore-extra'),
                ],
                'default' => 'slide',
                'conditions' => [
                    'terms' => [
                        [
                            'name' => 'link[url]',
                            'operator' => '!=',
                            'value' => '',
                        ],
                    ],
                ],
            ]
        );

        $repeater->end_controls_tab();

        $repeater->start_controls_tab(
            'style',
            [
                'label' => esc_html__('Style', 'topscore-extra'),
            ]
        );

        $repeater->add_control(
            'custom_style',
            [
                'label' => esc_html__('Custom', 'topscore-extra'),
                'type' => Controls_Manager::SWITCHER,
                'description' => esc_html__('Set custom style that will only affect this specific slide.', 'topscore-extra'),
            ]
        );

        $repeater->add_control(
            'horizontal_position',
            [
                'label' => esc_html__('Horizontal Position', 'topscore-extra'),
                'type' => Controls_Manager::CHOOSE,
                'options' => [
                    'left' => [
                        'title' => esc_html__('Left', 'topscore-extra'),
                        'icon' => 'eicon-h-align-left',
                    ],
                    'center' => [
                        'title' => esc_html__('Center', 'topscore-extra'),
                        'icon' => 'eicon-h-align-center',
                    ],
                    'right' => [
                        'title' => esc_html__('Right', 'topscore-extra'),
                        'icon' => 'eicon-h-align-right',
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} {{CURRENT_ITEM}} .swiper-slide-contents' => '{{VALUE}}',
                ],
                'selectors_dictionary' => [
                    'left' => 'margin-right: auto',
                    'center' => 'margin: 0 auto',
                    'right' => 'margin-left: auto',
                ],
                'conditions' => [
                    'terms' => [
                        [
                            'name' => 'custom_style',
                            'value' => 'yes',
                        ],
                    ],
                ],
            ]
        );

        $repeater->add_control(
            'vertical_position',
            [
                'label' => esc_html__('Vertical Position', 'topscore-extra'),
                'type' => Controls_Manager::CHOOSE,
                'options' => [
                    'top' => [
                        'title' => esc_html__('Top', 'topscore-extra'),
                        'icon' => 'eicon-v-align-top',
                    ],
                    'middle' => [
                        'title' => esc_html__('Middle', 'topscore-extra'),
                        'icon' => 'eicon-v-align-middle',
                    ],
                    'bottom' => [
                        'title' => esc_html__('Bottom', 'topscore-extra'),
                        'icon' => 'eicon-v-align-bottom',
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} {{CURRENT_ITEM}} .swiper-slide-inner' => 'align-items: {{VALUE}}',
                ],
                'selectors_dictionary' => [
                    'top' => 'flex-start',
                    'middle' => 'center',
                    'bottom' => 'flex-end',
                ],
                'conditions' => [
                    'terms' => [
                        [
                            'name' => 'custom_style',
                            'value' => 'yes',
                        ],
                    ],
                ],
            ]
        );

        $repeater->add_control(
            'text_align',
            [
                'label' => esc_html__('Text Align', 'topscore-extra'),
                'type' => Controls_Manager::CHOOSE,
                'options' => [
                    'left' => [
                        'title' => esc_html__('Left', 'topscore-extra'),
                        'icon' => 'eicon-text-align-left',
                    ],
                    'center' => [
                        'title' => esc_html__('Center', 'topscore-extra'),
                        'icon' => 'eicon-text-align-center',
                    ],
                    'right' => [
                        'title' => esc_html__('Right', 'topscore-extra'),
                        'icon' => 'eicon-text-align-right',
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} {{CURRENT_ITEM}} .swiper-slide-inner' => 'text-align: {{VALUE}}',
                ],
                'conditions' => [
                    'terms' => [
                        [
                            'name' => 'custom_style',
                            'value' => 'yes',
                        ],
                    ],
                ],
            ]
        );

        $repeater->add_control(
            'content_color',
            [
                'label' => esc_html__('Content Color', 'topscore-extra'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} {{CURRENT_ITEM}} .swiper-slide-inner .elementor-slide-heading' => 'color: {{VALUE}}',
                    '{{WRAPPER}} {{CURRENT_ITEM}} .swiper-slide-inner .elementor-slide-description' => 'color: {{VALUE}}',
                    '{{WRAPPER}} {{CURRENT_ITEM}} .swiper-slide-inner .elementor-slide-button' => 'color: {{VALUE}}; border-color: {{VALUE}}',
                ],
                'conditions' => [
                    'terms' => [
                        [
                            'name' => 'custom_style',
                            'value' => 'yes',
                        ],
                    ],
                ],
            ]
        );

        $repeater->add_group_control(
            Group_Control_Text_Shadow::get_type(),
            [
                'name' => 'repeater_text_shadow',
                'selector' => '{{WRAPPER}} {{CURRENT_ITEM}} .swiper-slide-contents',
                'conditions' => [
                    'terms' => [
                        [
                            'name' => 'custom_style',
                            'value' => 'yes',
                        ],
                    ],
                ],
            ]
        );

        $repeater->end_controls_tab();

        $repeater->end_controls_tabs();

        $this->add_control(
            'slides',
            [
                'label' => esc_html__('Slides', 'topscore-extra'),
                'type' => Controls_Manager::REPEATER,
                'show_label' => true,
                'fields' => $repeater->get_controls(),
                'default' => [
                    [
                        'heading' => esc_html__('Slide 1 Heading', 'topscore-extra'),
                        'description' => esc_html__('Lorem ipsum dolor sit amet consectetur adipiscing elit dolor', 'topscore-extra'),
                        'button_text' => esc_html__('Click Here', 'topscore-extra'),
                        'background_color' => '#833ca3',
                    ],
                    [
                        'heading' => esc_html__('Slide 2 Heading', 'topscore-extra'),
                        'description' => esc_html__('Lorem ipsum dolor sit amet consectetur adipiscing elit dolor', 'topscore-extra'),
                        'button_text' => esc_html__('Click Here', 'topscore-extra'),
                        'background_color' => '#4054b2',
                    ],
                    [
                        'heading' => esc_html__('Slide 3 Heading', 'topscore-extra'),
                        'description' => esc_html__('Lorem ipsum dolor sit amet consectetur adipiscing elit dolor', 'topscore-extra'),
                        'button_text' => esc_html__('Click Here', 'topscore-extra'),
                        'background_color' => '#1abc9c',
                    ],
                ],
                'title_field' => '{{{ heading }}}',
            ]
        );

        $this->add_responsive_control(
            'slides_height',
            [
                'label' => esc_html__('Height', 'topscore-extra'),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px', 'em', 'rem', 'vh', 'custom'],
                'range' => [
                    'px' => [
                        'min' => 100,
                        'max' => 1000,
                    ],
                    'em' => [
                        'min' => 10,
                        'max' => 100,
                    ],
                    'rem' => [
                        'min' => 10,
                        'max' => 100,
                    ],
                    'vh' => [
                        'min' => 10,
                        'max' => 100,
                    ],
                ],
                'default' => [
                    'size' => 400,
                ],
                'selectors' => [
                    '{{WRAPPER}} .swiper-slide' => 'height: {{SIZE}}{{UNIT}};',
                ],
                'separator' => 'before',
            ]
        );

        $this->add_control(
            'slides_title_tag',
            [
                'label' => esc_html__('Title HTML Tag', 'topscore-extra'),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    'h1' => 'H1',
                    'h2' => 'H2',
                    'h3' => 'H3',
                    'h4' => 'H4',
                    'h5' => 'H5',
                    'h6' => 'H6',
                    'div' => 'div',
                    'span' => 'span',
                    'p' => 'p',
                ],
                'default' => 'div',
            ]
        );

        $this->add_control(
            'slides_description_tag',
            [
                'label' => esc_html__('Description HTML Tag', 'topscore-extra'),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    'h1' => 'H1',
                    'h2' => 'H2',
                    'h3' => 'H3',
                    'h4' => 'H4',
                    'h5' => 'H5',
                    'h6' => 'H6',
                    'div' => 'div',
                    'span' => 'span',
                    'p' => 'p',
                ],
                'default' => 'div',
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'section_slider_options',
            [
                'label' => esc_html__('Slider Options', 'topscore-extra'),
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
            'section_style_slides',
            [
                'label' => esc_html__('Slides', 'topscore-extra'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_responsive_control(
            'content_max_width',
            [
                'label' => esc_html__('Content Width', 'topscore-extra'),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px', '%', 'em', 'rem', 'vw', 'custom'],
                'range' => [
                    'px' => [
                        'max' => 1000,
                    ],
                    'em' => [
                        'max' => 100,
                    ],
                    'rem' => [
                        'max' => 100,
                    ],
                ],
                'default' => [
                    'size' => 66,
                    'unit' => '%',
                ],
                'tablet_default' => [
                    'unit' => '%',
                ],
                'mobile_default' => [
                    'unit' => '%',
                ],
                'selectors' => [
                    '{{WRAPPER}} .swiper-slide-contents' => 'max-width: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'slides_padding',
            [
                'label' => esc_html__('Padding', 'topscore-extra'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em', 'rem', 'vw', 'custom'],
                'selectors' => [
                    '{{WRAPPER}} .swiper-slide-inner' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'slides_horizontal_position',
            [
                'label' => esc_html__('Horizontal Position', 'topscore-extra'),
                'type' => Controls_Manager::CHOOSE,
                'default' => 'center',
                'options' => [
                    'left' => [
                        'title' => esc_html__('Left', 'topscore-extra'),
                        'icon' => 'eicon-h-align-left',
                    ],
                    'center' => [
                        'title' => esc_html__('Center', 'topscore-extra'),
                        'icon' => 'eicon-h-align-center',
                    ],
                    'right' => [
                        'title' => esc_html__('Right', 'topscore-extra'),
                        'icon' => 'eicon-h-align-right',
                    ],
                ],
                'prefix_class' => 'elementor--h-position-',
            ]
        );

        $this->add_control(
            'slides_vertical_position',
            [
                'label' => esc_html__('Vertical Position', 'topscore-extra'),
                'type' => Controls_Manager::CHOOSE,
                'default' => 'middle',
                'options' => [
                    'top' => [
                        'title' => esc_html__('Top', 'topscore-extra'),
                        'icon' => 'eicon-v-align-top',
                    ],
                    'middle' => [
                        'title' => esc_html__('Middle', 'topscore-extra'),
                        'icon' => 'eicon-v-align-middle',
                    ],
                    'bottom' => [
                        'title' => esc_html__('Bottom', 'topscore-extra'),
                        'icon' => 'eicon-v-align-bottom',
                    ],
                ],
                'prefix_class' => 'elementor--v-position-',
            ]
        );

        $this->add_control(
            'slides_text_align',
            [
                'label' => esc_html__('Text Align', 'topscore-extra'),
                'type' => Controls_Manager::CHOOSE,
                'options' => [
                    'left' => [
                        'title' => esc_html__('Left', 'topscore-extra'),
                        'icon' => 'eicon-text-align-left',
                    ],
                    'center' => [
                        'title' => esc_html__('Center', 'topscore-extra'),
                        'icon' => 'eicon-text-align-center',
                    ],
                    'right' => [
                        'title' => esc_html__('Right', 'topscore-extra'),
                        'icon' => 'eicon-text-align-right',
                    ],
                ],
                'default' => 'center',
                'selectors' => [
                    '{{WRAPPER}} .swiper-slide-inner' => 'text-align: {{VALUE}}',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Text_Shadow::get_type(),
            [
                'name' => 'text_shadow',
                'selector' => '{{WRAPPER}} .swiper-slide-contents',
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'section_style_title',
            [
                'label' => esc_html__('Title', 'topscore-extra'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'heading_spacing',
            [
                'label' => esc_html__('Spacing', 'topscore-extra'),
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
                    '{{WRAPPER}} .swiper-slide-inner .elementor-slide-heading:not(:last-child)' => 'margin-bottom: {{SIZE}}{{UNIT}}',
                ],
            ]
        );

        $this->add_control(
            'heading_color',
            [
                'label' => esc_html__('Text Color', 'topscore-extra'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .elementor-slide-heading' => 'color: {{VALUE}}',

                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'heading_typography',
                'global' => [
                    'default' => Global_Typography::TYPOGRAPHY_PRIMARY,
                ],
                'selector' => '{{WRAPPER}} .elementor-slide-heading',
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'section_style_description',
            [
                'label' => esc_html__('Description', 'topscore-extra'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'description_spacing',
            [
                'label' => esc_html__('Spacing', 'topscore-extra'),
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
                    '{{WRAPPER}} .swiper-slide-inner .elementor-slide-description:not(:last-child)' => 'margin-bottom: {{SIZE}}{{UNIT}}',
                ],
            ]
        );

        $this->add_control(
            'description_color',
            [
                'label' => esc_html__('Text Color', 'topscore-extra'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .elementor-slide-description' => 'color: {{VALUE}}',

                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'description_typography',
                'global' => [
                    'default' => Global_Typography::TYPOGRAPHY_SECONDARY,
                ],
                'selector' => '{{WRAPPER}} .elementor-slide-description',
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'section_style_button',
            [
                'label' => esc_html__('Button', 'topscore-extra'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'button_size',
            [
                'label' => esc_html__('Size', 'topscore-extra'),
                'type' => Controls_Manager::SELECT,
                'default' => 'sm',
                'options' => self::get_button_sizes(),
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'button_typography',
                'selector' => '{{WRAPPER}} .elementor-slide-button',
                'global' => [
                    'default' => Global_Typography::TYPOGRAPHY_ACCENT,
                ],
            ]
        );

        $this->add_control(
            'button_border_width',
            [
                'label' => esc_html__('Border Width', 'topscore-extra'),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px', '%', 'em', 'rem', 'vw', 'custom'],
                'range' => [
                    'px' => [
                        'max' => 20,
                    ],
                    'em' => [
                        'max' => 2,
                    ],
                    'rem' => [
                        'max' => 2,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .elementor-slide-button' => 'border-width: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'button_border_radius',
            [
                'label' => esc_html__('Border Radius', 'topscore-extra'),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px', '%', 'em', 'rem', 'custom'],
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
                    '{{WRAPPER}} .elementor-slide-button' => 'border-radius: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->start_controls_tabs('button_tabs');

        $this->start_controls_tab(
            'normal',
            [
                'label' => esc_html__('Normal', 'topscore-extra'),
            ]
        );

        $this->add_control(
            'button_text_color',
            [
                'label' => esc_html__('Text Color', 'topscore-extra'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .elementor-slide-button' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => 'button_background',
                'types' => ['classic', 'gradient'],
                'exclude' => ['image'],
                'selector' => '{{WRAPPER}} .elementor-slide-button',
                'fields_options' => [
                    'background' => [
                        'default' => 'classic',
                    ],
                ],
            ]
        );

        $this->add_control(
            'button_border_color',
            [
                'label' => esc_html__('Border Color', 'topscore-extra'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .elementor-slide-button' => 'border-color: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab(
            'hover',
            [
                'label' => esc_html__('Hover', 'topscore-extra'),
            ]
        );

        $this->add_control(
            'button_hover_text_color',
            [
                'label' => esc_html__('Text Color', 'topscore-extra'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .elementor-slide-button:hover' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => 'button_hover_background',
                'types' => ['classic', 'gradient'],
                'exclude' => ['image'],
                'selector' => '{{WRAPPER}} .elementor-slide-button:hover',
                'fields_options' => [
                    'background' => [
                        'default' => 'classic',
                    ],
                ],
            ]
        );

        $this->add_control(
            'button_hover_border_color',
            [
                'label' => esc_html__('Border Color', 'topscore-extra'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .elementor-slide-button:hover' => 'border-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'button_hover_transition_duration',
            [
                'label' => esc_html__('Transition Duration', 'topscore-extra'),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['s', 'ms', 'custom'],
                'default' => [
                    'unit' => 'ms',
                ],
                'selectors' => [
                    '{{WRAPPER}} .elementor-slide-button' => 'transition-duration: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_tab();

        $this->end_controls_tabs();

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

    protected function render()
    {
        $settings = $this->get_settings_for_display();

        if (empty($settings['slides'])) {
            return;
        }

        $title_tag = Utils::validate_html_tag($settings['slides_title_tag']);
        $description_tag = Utils::validate_html_tag($settings['slides_description_tag']);

        $this->add_render_attribute('button', 'class', ['elementor-button', 'elementor-slide-button']);

        if (!empty($settings['button_size'])) {
            $this->add_render_attribute('button', 'class', 'elementor-size-' . $settings['button_size']);
        }

        $slides = [];
        $slide_count = 0;

        foreach ($settings['slides'] as $slide) {
            $slide_html = '';
            $btn_attributes = '';
            $slide_attributes = '';
            $slide_element = 'div';
            $btn_element = 'div';

            if (!empty($slide['link']['url'])) {
                $this->add_link_attributes('slide_link' . $slide_count, $slide['link']);

                if ('button' === $slide['link_click']) {
                    $btn_element = 'a';
                    $btn_attributes = $this->get_render_attribute_string('slide_link' . $slide_count);
                } else {
                    $slide_element = 'a';
                    $slide_attributes = $this->get_render_attribute_string('slide_link' . $slide_count);
                }
            }

            $slide_html .= '<' . $slide_element . ' class="swiper-slide-inner" ' . $slide_attributes . '>';

            $slide_html .= '<div class="swiper-slide-contents">';

            if ($slide['heading']) {
                $slide_html .= '<' . $title_tag . ' class="elementor-slide-heading">' . $slide['heading'] . '</' . $title_tag . '>';
            }

            if ($slide['description']) {
                $slide_html .= '<' . $description_tag . ' class="elementor-slide-description">' . $slide['description'] . '</' . $description_tag . '>';
            }

            if ($slide['button_text']) {
                $slide_html .= '<' . $btn_element . ' ' . $btn_attributes . ' ' . $this->get_render_attribute_string('button') . '>' . $slide['button_text'] . '</' . $btn_element . '>';
            }

            $slide_html .= '</div></' . $slide_element . '>';

            if ('yes' === $slide['background_overlay']) {
                $slide_html = '<div class="elementor-background-overlay"></div>' . $slide_html;
            }

            $ken_class = '';

            if ($slide['background_ken_burns']) {
                $ken_class = ' elementor-ken-burns elementor-ken-burns--' . $slide['zoom_direction'];
            }

            $slide_html = '<div class="swiper-slide-bg' . esc_attr($ken_class) . '" role="img"></div>' . $slide_html;

            $slides[] = '<div class="elementor-repeater-item-' . esc_attr($slide['_id']) . ' swiper-slide">' . $slide_html . '</div>';
            $slide_count++;
        }

        $direction = is_rtl() ? 'rtl' : 'ltr';

        $show_dots = (in_array($settings['navigation'], ['dots', 'both']));
        $show_arrows = (in_array($settings['navigation'], ['arrows', 'both']));

        $slides_count = count($settings['slides']);
        $swiper_class = Plugin::elementor()->experiments->is_feature_active('e_swiper_latest') ? 'swiper' : 'swiper-container';
?>
        <div class="elementor-swiper">
            <div class="elementor-slides-wrapper elementor-main-swiper <?php echo esc_attr($swiper_class); ?>" dir="<?php Utils::print_unescaped_internal_string($direction); ?>" data-animation="<?php echo esc_attr($settings['content_animation']); ?>">
                <div class="swiper-wrapper elementor-slides">
                    <?php // PHPCS - Slides for each is safe. 
                    ?>
                    <?php echo implode('', $slides); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped 
                    ?>
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
    <?php
    }

    /**
     * Render Slides widget output in the editor.
     *
     * Written as a Backbone JavaScript template and used to generate the live preview.
     *
     * @since 2.9.0
     * @access protected
     */
    protected function content_template()
    {
    ?>
        <# var direction=elementorFrontend.config.is_rtl ? 'rtl' : 'ltr' , next=elementorFrontend.config.is_rtl ? 'left' : 'right' , prev=elementorFrontend.config.is_rtl ? 'right' : 'left' , navi=settings.navigation, showDots=( 'dots'===navi || 'both'===navi ), showArrows=( 'arrows'===navi || 'both'===navi ), buttonSize=settings.button_size, titleTag=elementor.helpers.validateHTMLTag( settings.slides_title_tag ), descriptionTag=elementor.helpers.validateHTMLTag( settings.slides_description_tag ); #>
            <div class="elementor-swiper">
                <div class="elementor-slides-wrapper elementor-main-swiper {{ elementorFrontend.config.swiperClass }}" dir="{{ direction }}" data-animation="{{ settings.content_animation }}">
                    <div class="swiper-wrapper elementor-slides">
                        <# jQuery.each( settings.slides, function( index, slide ) { #>
                            <div class="elementor-repeater-item-{{ _.escape( slide._id ) }} swiper-slide">
                                <# var kenClass='' ; if ( '' !=slide.background_ken_burns ) { kenClass=' elementor-ken-burns elementor-ken-burns--' + _.escape( slide.zoom_direction ); } #>
                                    <div class="swiper-slide-bg{{ kenClass }}" role="img"></div>
                                    <# if ( 'yes'===slide.background_overlay ) { #>
                                        <div class="elementor-background-overlay"></div>
                                        <# } #>
                                            <div class="swiper-slide-inner">
                                                <div class="swiper-slide-contents">
                                                    <# if ( slide.heading ) { #>
                                                        <{{ titleTag }} class="elementor-slide-heading">{{{ slide.heading }}}</{{ titleTag }}>
                                                        <# } if ( slide.description ) { #>
                                                            <{{descriptionTag}} class="elementor-slide-description">{{{ slide.description }}}</{{descriptionTag}}>
                                                            <# } if ( slide.button_text ) { #>
                                                                <div class="elementor-button elementor-slide-button elementor-size-{{ buttonSize }}">{{{ slide.button_text }}}</div>
                                                                <# } #>
                                                </div>
                                            </div>
                            </div>
                            <# } ); #>
                    </div>
                    <# if ( 1 < settings.slides.length ) { #>
                        <# if ( showDots ) { #>
                            <div class="swiper-pagination"></div>
                            <# } #>
                                <# if ( showArrows ) { #>
                                    <div class="elementor-swiper-button elementor-swiper-button-prev" role="button" tabindex="0">
                                        <i class="eicon-chevron-{{ prev }}" aria-hidden="true"></i>
                                        <span class="elementor-screen-only"><?php echo esc_html__('Previous slide', 'topscore-extra'); ?></span>
                                    </div>
                                    <div class="elementor-swiper-button elementor-swiper-button-next" role="button" tabindex="0">
                                        <i class="eicon-chevron-{{ next }}" aria-hidden="true"></i>
                                        <span class="elementor-screen-only"><?php echo esc_html__('Next slide', 'topscore-extra'); ?></span>
                                    </div>
                                    <# } #>
                                        <# } #>
                </div>
            </div>
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
