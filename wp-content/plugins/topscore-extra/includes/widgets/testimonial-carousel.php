<?php

namespace Topscore_Extra\Widgets;

use Elementor\Controls_Manager;
use Elementor\Core\Kits\Documents\Tabs\Global_Colors;
use Elementor\Core\Kits\Documents\Tabs\Global_Typography;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Text_Stroke;
use Elementor\Repeater;
use Elementor\Utils;
use Topscore_Extra\Base\Base_Carousel;

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly
}

class Testimonial_Carousel extends Base_Carousel
{

    public function get_name()
    {
        return 'testimonial-carousel-tpx';
    }

    public function get_title()
    {
        return esc_html__('Testimonial Carousel', 'topscore-extra');
    }

    public function get_icon()
    {
        return 'eicon-testimonial-carousel';
    }

    public function get_keywords()
    {
        return ['testimonial', 'carousel', 'image'];
    }

    public function get_script_depends()
    {
        return ['carousel-script', 'testimonial-script'];
    }

    public function get_style_depends()
    {
        return ['carousel-style', 'testimonial-style'];
    }

    public function get_categories()
    {
        return ['topscore-extra'];
    }

    protected function register_controls()
    {
        parent::register_controls();

        $this->start_injection([
            'of' => 'slides',
        ]);

        $this->add_control(
            'skin',
            [
                'label' => esc_html__('Skin', 'topscore-extra'),
                'type' => Controls_Manager::SELECT,
                'default' => 'default',
                'options' => [
                    'default' => esc_html__('Default', 'topscore-extra'),
                    'bubble' => esc_html__('Bubble', 'topscore-extra'),
                ],
                'prefix_class' => 'elementor-testimonial--skin-',
                'render_type' => 'template',
            ]
        );

        $this->add_control(
            'layout',
            [
                'label' => esc_html__('Layout', 'topscore-extra'),
                'type' => Controls_Manager::SELECT,
                'default' => 'image_inline',
                'options' => [
                    'image_inline' => esc_html__('Image Inline', 'topscore-extra'),
                    'image_stacked' => esc_html__('Image Stacked', 'topscore-extra'),
                    'image_above' => esc_html__('Image Above', 'topscore-extra'),
                    'image_left' => esc_html__('Image Left', 'topscore-extra'),
                    'image_right' => esc_html__('Image Right', 'topscore-extra'),
                ],
                'prefix_class' => 'elementor-testimonial--layout-',
                'render_type' => 'template',
            ]
        );

        $this->add_responsive_control(
            'alignment',
            [
                'label' => esc_html__('Alignment', 'topscore-extra'),
                'type' => Controls_Manager::CHOOSE,
                'default' => 'center',
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
                'prefix_class' => 'elementor-testimonial-%s-align-',
            ]
        );

        $this->end_injection();

        $this->start_controls_section(
            'section_skin_style',
            [
                'label' => esc_html__('Bubble', 'topscore-extra'),
                'tab' => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'skin' => 'bubble',
                ],
            ]
        );

        $this->add_control(
            'background_color',
            [
                'label' => esc_html__('Background Color', 'topscore-extra'),
                'type' => Controls_Manager::COLOR,
                'alpha' => false,
                'selectors' => [
                    '{{WRAPPER}} .elementor-testimonial__content, {{WRAPPER}} .elementor-testimonial__content:after' => 'background-color: {{VALUE}}',
                ],
            ]
        );

        $this->add_responsive_control(
            'text_padding',
            [
                'label' => esc_html__('Padding', 'topscore-extra'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em', 'rem', 'vw', 'custom'],
                'default' => [
                    'top' => '20',
                    'bottom' => '20',
                    'left' => '20',
                    'right' => '20',
                    'unit' => 'px',
                ],
                'selectors' => [
                    '{{WRAPPER}} .elementor-testimonial__content' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}',
                    '{{WRAPPER}}.elementor-testimonial--layout-image_left .elementor-testimonial__footer,
					{{WRAPPER}}.elementor-testimonial--layout-image_right .elementor-testimonial__footer' => 'padding-top: {{TOP}}{{UNIT}}',
                    '{{WRAPPER}}.elementor-testimonial--layout-image_above .elementor-testimonial__footer,
					{{WRAPPER}}.elementor-testimonial--layout-image_inline .elementor-testimonial__footer,
					{{WRAPPER}}.elementor-testimonial--layout-image_stacked .elementor-testimonial__footer' => 'padding: 0 {{RIGHT}}{{UNIT}} 0 {{LEFT}}{{UNIT}}',
                ],
            ]
        );

        $this->add_responsive_control(
            'border_radius',
            [
                'label' => esc_html__('Border Radius', 'topscore-extra'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em', 'rem', 'custom'],
                'selectors' => [
                    '{{WRAPPER}} .elementor-testimonial__content' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'border',
            [
                'label' => esc_html__('Border', 'topscore-extra'),
                'type' => Controls_Manager::SWITCHER,
                'selectors' => [
                    '{{WRAPPER}} .elementor-testimonial__content, {{WRAPPER}} .elementor-testimonial__content:after' => 'border-style: solid',
                ],
            ]
        );

        $this->add_control(
            'border_color',
            [
                'label' => esc_html__('Border Color', 'topscore-extra'),
                'type' => Controls_Manager::COLOR,
                'default' => '#000',
                'selectors' => [
                    '{{WRAPPER}} .elementor-testimonial__content' => 'border-color: {{VALUE}}',
                    '{{WRAPPER}} .elementor-testimonial__content:after' => 'border-color: transparent {{VALUE}} {{VALUE}} transparent',
                ],
                'condition' => [
                    'border' => 'yes',
                ],
            ]
        );

        $this->add_responsive_control(
            'border_width',
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
                    '{{WRAPPER}} .elementor-testimonial__content, {{WRAPPER}} .elementor-testimonial__content:after' => 'border-width: {{SIZE}}{{UNIT}}',
                    '{{WRAPPER}}.elementor-testimonial--layout-image_stacked .elementor-testimonial__content:after,
					{{WRAPPER}}.elementor-testimonial--layout-image_inline .elementor-testimonial__content:after' => 'margin-top: -{{SIZE}}{{UNIT}}',
                    '{{WRAPPER}}.elementor-testimonial--layout-image_above .elementor-testimonial__content:after' => 'margin-bottom: -{{SIZE}}{{UNIT}}',
                ],
                'condition' => [
                    'border' => 'yes',
                ],
            ]
        );

        $this->end_controls_section();

        $this->start_injection([
            'at' => 'before',
            'of' => 'section_navigation',
        ]);

        $this->start_controls_section(
            'section_content_style',
            [
                'label' => esc_html__('Content', 'topscore-extra'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_responsive_control(
            'content_gap',
            [
                'label' => esc_html__('Gap', 'topscore-extra'),
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
                    '{{WRAPPER}}.elementor-testimonial--layout-image_inline .elementor-testimonial__footer,
					{{WRAPPER}}.elementor-testimonial--layout-image_stacked .elementor-testimonial__footer' => 'margin-top: {{SIZE}}{{UNIT}}',
                    '{{WRAPPER}}.elementor-testimonial--layout-image_above .elementor-testimonial__footer' => 'margin-bottom: {{SIZE}}{{UNIT}}',
                    '{{WRAPPER}}.elementor-testimonial--layout-image_left .elementor-testimonial__footer' => 'padding-right: {{SIZE}}{{UNIT}}',
                    '{{WRAPPER}}.elementor-testimonial--layout-image_right .elementor-testimonial__footer' => 'padding-left: {{SIZE}}{{UNIT}}',
                ],
            ]
        );

        $this->add_control(
            'content_color',
            [
                'label' => esc_html__('Text Color', 'topscore-extra'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .elementor-testimonial__text' => 'color: {{VALUE}}',
                ],
                'global' => [
                    'default' => Global_Colors::COLOR_TEXT,
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'content_typography',
                'selector' => '{{WRAPPER}} .elementor-testimonial__text',
                'global' => [
                    'default' => Global_Typography::TYPOGRAPHY_TEXT,
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Text_Stroke::get_type(),
            [
                'name' => 'text_stroke',
                'selector' => '{{WRAPPER}} .elementor-testimonial__text',
            ]
        );

        $this->add_control(
            'name_title_style',
            [
                'label' => esc_html__('Name', 'topscore-extra'),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );

        $this->add_control(
            'name_color',
            [
                'label' => esc_html__('Text Color', 'topscore-extra'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .elementor-testimonial__name' => 'color: {{VALUE}}',
                ],
                'global' => [
                    'default' => Global_Colors::COLOR_TEXT,
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'name_typography',
                'selector' => '{{WRAPPER}} .elementor-testimonial__name',
                'global' => [
                    'default' => Global_Typography::TYPOGRAPHY_PRIMARY,
                ],
            ]
        );

        $this->add_control(
            'heading_title_style',
            [
                'label' => esc_html__('Title', 'topscore-extra'),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );

        $this->add_control(
            'title_color',
            [
                'label' => esc_html__('Text Color', 'topscore-extra'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .elementor-testimonial__title' => 'color: {{VALUE}}',
                ],
                'global' => [
                    'default' => Global_Colors::COLOR_PRIMARY,
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'title_typography',
                'selector' => '{{WRAPPER}} .elementor-testimonial__title',
                'global' => [
                    'default' => Global_Typography::TYPOGRAPHY_SECONDARY,
                ],
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'section_image_style',
            [
                'label' => esc_html__('Image', 'topscore-extra'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_responsive_control(
            'image_size',
            [
                'label' => esc_html__('Size', 'topscore-extra'),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px', 'em', 'rem', 'custom'],
                'range' => [
                    'px' => [
                        'max' => 200,
                    ],
                    'em' => [
                        'max' => 20,
                    ],
                    'rem' => [
                        'max' => 20,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .elementor-testimonial__image img' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}}',
                    '{{WRAPPER}}.elementor-testimonial--layout-image_left .elementor-testimonial__content:after,
					 {{WRAPPER}}.elementor-testimonial--layout-image_right .elementor-testimonial__content:after' => 'top: calc( {{text_padding.TOP}}{{text_padding.UNIT}} + ({{SIZE}}{{UNIT}} / 2) - 8px );',

                    'body:not(.rtl) {{WRAPPER}}.elementor-testimonial--layout-image_stacked:not(.elementor-testimonial--align-center):not(.elementor-testimonial--align-right) .elementor-testimonial__content:after,
					 body:not(.rtl) {{WRAPPER}}.elementor-testimonial--layout-image_inline:not(.elementor-testimonial--align-center):not(.elementor-testimonial--align-right) .elementor-testimonial__content:after,
					 {{WRAPPER}}.elementor-testimonial--layout-image_stacked.elementor-testimonial--align-left .elementor-testimonial__content:after,
					 {{WRAPPER}}.elementor-testimonial--layout-image_inline.elementor-testimonial--align-left .elementor-testimonial__content:after' => 'left: calc( {{text_padding.LEFT}}{{text_padding.UNIT}} + ({{SIZE}}{{UNIT}} / 2) - 8px ); right:auto;',

                    'body.rtl {{WRAPPER}}.elementor-testimonial--layout-image_stacked:not(.elementor-testimonial--align-center):not(.elementor-testimonial--align-left) .elementor-testimonial__content:after,
					 body.rtl {{WRAPPER}}.elementor-testimonial--layout-image_inline:not(.elementor-testimonial--align-center):not(.elementor-testimonial--align-left) .elementor-testimonial__content:after,
					 {{WRAPPER}}.elementor-testimonial--layout-image_stacked.elementor-testimonial--align-right .elementor-testimonial__content:after,
					 {{WRAPPER}}.elementor-testimonial--layout-image_inline.elementor-testimonial--align-right .elementor-testimonial__content:after' => 'right: calc( {{text_padding.RIGHT}}{{text_padding.UNIT}} + ({{SIZE}}{{UNIT}} / 2) - 8px ); left:auto;',

                    'body:not(.rtl) {{WRAPPER}}.elementor-testimonial--layout-image_above:not(.elementor-testimonial--align-center):not(.elementor-testimonial--align-right) .elementor-testimonial__content:after,
					 {{WRAPPER}}.elementor-testimonial--layout-image_above.elementor-testimonial--align-left .elementor-testimonial__content:after' => 'left: calc( {{text_padding.LEFT}}{{text_padding.UNIT}} + ({{SIZE}}{{UNIT}} / 2) - 8px ); right:auto;',

                    'body.rtl {{WRAPPER}}.elementor-testimonial--layout-image_above:not(.elementor-testimonial--align-center):not(.elementor-testimonial--align-left) .elementor-testimonial__content:after,
					 {{WRAPPER}}.elementor-testimonial--layout-image_above.elementor-testimonial--align-right .elementor-testimonial__content:after' => 'right: calc( {{text_padding.RIGHT}}{{text_padding.UNIT}} + ({{SIZE}}{{UNIT}} / 2) - 8px ); left:auto;',
                ],
            ]
        );

        $this->add_responsive_control(
            'image_gap',
            [
                'label' => esc_html__('Gap', 'topscore-extra'),
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
                    'body.rtl {{WRAPPER}}.elementor-testimonial--layout-image_inline.elementor-testimonial--align-left .elementor-testimonial__image + cite,
					 body.rtl {{WRAPPER}}.elementor-testimonial--layout-image_above.elementor-testimonial--align-left .elementor-testimonial__image + cite,
					 body:not(.rtl) {{WRAPPER}}.elementor-testimonial--layout-image_inline .elementor-testimonial__image + cite,
					 body:not(.rtl) {{WRAPPER}}.elementor-testimonial--layout-image_above .elementor-testimonial__image + cite' => 'margin-left: {{SIZE}}{{UNIT}}; margin-right: 0;',

                    'body:not(.rtl) {{WRAPPER}}.elementor-testimonial--layout-image_inline.elementor-testimonial--align-right .elementor-testimonial__image + cite,
					 body:not(.rtl) {{WRAPPER}}.elementor-testimonial--layout-image_above.elementor-testimonial--align-right .elementor-testimonial__image + cite,
					 body.rtl {{WRAPPER}}.elementor-testimonial--layout-image_inline .elementor-testimonial__image + cite,
					 body.rtl {{WRAPPER}}.elementor-testimonial--layout-image_above .elementor-testimonial__image + cite' => 'margin-right: {{SIZE}}{{UNIT}}; margin-left:0;',

                    '{{WRAPPER}}.elementor-testimonial--layout-image_stacked .elementor-testimonial__image + cite,
					 {{WRAPPER}}.elementor-testimonial--layout-image_left .elementor-testimonial__image + cite,
					 {{WRAPPER}}.elementor-testimonial--layout-image_right .elementor-testimonial__image + cite' => 'margin-top: {{SIZE}}{{UNIT}}',
                ],
            ]
        );

        $this->add_control(
            'image_border',
            [
                'label' => esc_html__('Border', 'topscore-extra'),
                'type' => Controls_Manager::SWITCHER,
                'selectors' => [
                    '{{WRAPPER}} .elementor-testimonial__image img' => 'border-style: solid',
                ],
            ]
        );

        $this->add_control(
            'image_border_color',
            [
                'label' => esc_html__('Border Color', 'topscore-extra'),
                'type' => Controls_Manager::COLOR,
                'default' => '#000',
                'selectors' => [
                    '{{WRAPPER}} .elementor-testimonial__image img' => 'border-color: {{VALUE}}',
                ],
                'condition' => [
                    'image_border' => 'yes',
                ],
            ]
        );

        $this->add_responsive_control(
            'image_border_width',
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
                    '{{WRAPPER}} .elementor-testimonial__image img' => 'border-width: {{SIZE}}{{UNIT}}',
                ],
                'condition' => [
                    'image_border' => 'yes',
                ],
            ]
        );

        $this->add_control(
            'image_border_radius',
            [
                'label' => esc_html__('Border Radius', 'topscore-extra'),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px', '%', 'em', 'rem', 'custom'],
                'selectors' => [
                    '{{WRAPPER}} .elementor-testimonial__image img' => 'border-radius: {{SIZE}}{{UNIT}}',
                ],
            ]
        );

        $this->end_controls_section();

        $this->end_injection();

        $this->update_responsive_control(
            'width',
            [
                'selectors' => [
                    '{{WRAPPER}}.elementor-arrows-yes .elementor-main-swiper' => 'width: calc( {{SIZE}}{{UNIT}} - 40px )',
                    '{{WRAPPER}} .elementor-main-swiper' => 'width: {{SIZE}}{{UNIT}}',
                ],
            ]
        );

        $this->update_responsive_control(
            'slides_per_view',
            [
                'condition' => null,
            ]
        );

        $this->update_responsive_control(
            'slides_to_scroll',
            [
                'condition' => null,
            ]
        );

        $this->remove_control('effect');
        $this->remove_responsive_control('height');
        $this->remove_control('pagination_position');
    }

    protected function add_repeater_controls(Repeater $repeater)
    {
        $repeater->add_control(
            'content',
            [
                'label' => esc_html__('Content', 'topscore-extra'),
                'type' => Controls_Manager::TEXTAREA,
                'dynamic' => [
                    'active' => true,
                ],
            ]
        );

        $repeater->add_control(
            'image',
            [
                'label' => esc_html__('Image', 'topscore-extra'),
                'type' => Controls_Manager::MEDIA,
                'dynamic' => [
                    'active' => true,
                ],
            ]
        );

        $repeater->add_control(
            'name',
            [
                'label' => esc_html__('Name', 'topscore-extra'),
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__('John Doe', 'topscore-extra'),
                'dynamic' => [
                    'active' => true,
                ],
                'ai' => [
                    'active' => false,
                ],
            ]
        );

        $repeater->add_control(
            'title',
            [
                'label' => esc_html__('Title', 'topscore-extra'),
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__('CEO', 'topscore-extra'),
                'dynamic' => [
                    'active' => true,
                ],
                'ai' => [
                    'active' => false,
                ],
            ]
        );
    }

    protected function get_repeater_defaults()
    {
        $placeholder_image_src = Utils::get_placeholder_image_src();

        return [
            [
                'content' => esc_html__('Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut elit tellus, luctus nec ullamcorper mattis, pulvinar dapibus leo.', 'topscore-extra'),
                'name' => esc_html__('John Doe', 'topscore-extra'),
                'title' => esc_html__('CEO', 'topscore-extra'),
                'image' => [
                    'url' => $placeholder_image_src,
                ],
            ],
            [
                'content' => esc_html__('Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut elit tellus, luctus nec ullamcorper mattis, pulvinar dapibus leo.', 'topscore-extra'),
                'name' => esc_html__('John Doe', 'topscore-extra'),
                'title' => esc_html__('CEO', 'topscore-extra'),
                'image' => [
                    'url' => $placeholder_image_src,
                ],
            ],
            [
                'content' => esc_html__('Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut elit tellus, luctus nec ullamcorper mattis, pulvinar dapibus leo.', 'topscore-extra'),
                'name' => esc_html__('John Doe', 'topscore-extra'),
                'title' => esc_html__('CEO', 'topscore-extra'),
                'image' => [
                    'url' => $placeholder_image_src,
                ],
            ],
        ];
    }

    private function print_cite($slide, $location)
    {
        if (empty($slide['name']) && empty($slide['title'])) {
            return '';
        }

        $skin = $this->get_settings('skin');
        $layout = 'bubble' === $skin ? 'image_inline' : $this->get_settings('layout');
        $locations_outside = ['image_above', 'image_right', 'image_left'];
        $locations_inside = ['image_inline', 'image_stacked'];

        $print_outside = ('outside' === $location && in_array($layout, $locations_outside));
        $print_inside = ('inside' === $location && in_array($layout, $locations_inside));

        $html = '';
        if ($print_outside || $print_inside) {
            $html = '<cite class="elementor-testimonial__cite">';
            if (!empty($slide['name'])) {
                $html .= '<span class="elementor-testimonial__name">' . $slide['name'] . '</span>';
            }
            if (!empty($slide['title'])) {
                $html .= '<span class="elementor-testimonial__title">' . $slide['title'] . '</span>';
            }
            $html .= '</cite>';
        }

        // PHPCS - the main text of a widget should not be escaped.
        echo $html; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
    }

    protected function print_slide(array $slide, array $settings, $element_key)
    {
        $lazyload = 'yes' === $this->get_settings('lazyload');

        $this->add_render_attribute($element_key . '-testimonial', [
            'class' => 'elementor-testimonial',
        ]);

        if (!empty($slide['image']['url'])) {
            $img_src = $this->get_slide_image_url($slide, $settings);

            if ($lazyload) {
                $img_attribute['class'] = 'swiper-lazy';
                $img_attribute['data-src'] = $img_src;
            } else {
                $img_attribute['src'] = $img_src;
            }

            $img_attribute['alt'] = !empty($slide['image']['alt']) ? $slide['image']['alt'] : $slide['name'];

            $this->add_render_attribute($element_key . '-image', $img_attribute);
        }

?>
        <div <?php $this->print_render_attribute_string($element_key . '-testimonial'); ?>>
            <?php if ($slide['content']) : ?>
                <div class="elementor-testimonial__content">
                    <div class="elementor-testimonial__text">
                        <?php // PHPCS - the main text of a widget should not be escaped.
                        echo $slide['content']; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped 
                        ?>
                    </div>
                    <?php $this->print_cite($slide, 'outside'); ?>
                </div>
            <?php endif; ?>
            <div class="elementor-testimonial__footer">
                <?php if ($slide['image']['url']) : ?>
                    <div class="elementor-testimonial__image">
                        <img <?php $this->print_render_attribute_string($element_key . '-image'); ?>>
                        <?php if ($lazyload) : ?>
                            <div class="swiper-lazy-preloader"></div>
                        <?php endif; ?>
                    </div>
                <?php endif; ?>
                <?php $this->print_cite($slide, 'inside'); ?>
            </div>
        </div>
<?php
    }

    protected function render()
    {
        $this->print_slider();
    }

    public function get_group_name()
    {
        return 'carousel';
    }
}
