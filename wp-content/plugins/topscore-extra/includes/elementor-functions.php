<?php

if (!function_exists('topscore_extra_all_elementor_style')) :
    function topscore_extra_all_elementor_style($agrs, $label, $selector, $style = 'color', $color = true, $typo = true, $mar = true, $pad = true)
    {
        if (false != $color) :
            $agrs->add_control(
                str_replace(' ', '_', $label) . '_color',
                [
                    'label'         => __($label . ' Color', 'topscore_extra'),
                    'type'          => \Elementor\Controls_Manager::COLOR,
                    'selectors'     => [
                        $selector   => $style . ': {{VALUE}}',
                    ],
                ]
            );
        endif;

        if (false != $typo) :
            //title typography
            $agrs->add_group_control(
                \Elementor\Group_Control_Typography::get_type(),
                [
                    'name'           =>  str_replace(' ', '_', $label) . '_typo',
                    'label'          => esc_html__($label . ' Typography', 'topscore_extra'),
                    'selector'       => $selector,
                ]
            );

        endif;

        if (false != $mar) :
            $agrs->add_responsive_control(
                str_replace(' ', '_', $label) . '_margin',
                [
                    'label'         => esc_html__($label . ' Margin', 'topscore_extra'),
                    'type'          => \Elementor\Controls_Manager::DIMENSIONS,
                    'size_units'    => ['px', '%', 'em'],
                    'selectors'     => [
                        $selector => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
            );

        endif;

        if (false != $pad) :
            $agrs->add_responsive_control(
                str_replace(' ', '_', $label) . '_padding',
                [
                    'label'         => esc_html__($label . ' Padding', 'topscore_extra'),
                    'type'          => \Elementor\Controls_Manager::DIMENSIONS,
                    'size_units'    => ['px', '%', 'em'],
                    'selectors'     => [
                        $selector => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
            );

        endif;
    }
endif;

if (!function_exists('topscore_extra_elementor_border_style')) :
    function topscore_extra_elementor_border_style($agrs, $label, $selector, $condition)
    {


        if (false != $selector) :
            $agrs->add_group_control(
                \Elementor\Group_Control_Border::get_type(),
                [
                    'name'      => $label . 'border',
                    'label'     => __($label . ' Border', 'topscore_extra'),
                    'selector'  => $selector,
                    'condition' => [
                        'layout_style' => $condition
                    ]
                ]
            );

            $agrs->add_responsive_control(
                str_replace(' ', '_', $label) . '_border_radious',
                [
                    'label'         => esc_html__($label . ' Border Radious', 'topscore_extra'),
                    'type'          => \Elementor\Controls_Manager::DIMENSIONS,
                    'size_units'    => ['px', '%', 'em'],
                    'selectors'     => [
                        $selector => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],

                    'condition' => [
                        'layout_style' => $condition
                    ]
                ]
            );

        endif;
    }
endif;

if (!function_exists('topscore_extra_elementor_color_style')) :
    function topscore_extra_elementor_color_style($agrs, $label, $selector, $condition, $style = 'color')
    {
        if (false != $selector) :
            $agrs->add_control(
                str_replace(' ', '_', $label) . '_color',
                [
                    'label' => __($label . ' Color', 'topscore_extra'),
                    'type' => \Elementor\Controls_Manager::COLOR,
                    'selectors' => [
                        $selector => $style . ': {{VALUE}}',
                    ],
                    'condition' => [
                        'layout_style' => $condition
                    ]
                ]
            );
        endif;
    }
endif;

if (!function_exists('topscore_extra_elementor_typography_style')) :
    function topscore_extra_elementor_typography_style($agrs, $label, $selector, $condition)
    {
        if (false != $selector) :
            $agrs->add_group_control(
                \Elementor\Group_Control_Typography::get_type(),
                [
                    'name'           =>  str_replace(' ', '_', $label) . '_typo',
                    'label'          => esc_html__($label . ' Typography', 'topscore_extra'),
                    'selector'       => $selector,
                    'condition' => [
                        'layout_style' => $condition
                    ]
                ]
            );
        endif;
    }
endif;
