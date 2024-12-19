<?php
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class Custom_Text_With_Line_Widget extends \Elementor\Widget_Base {

    public function get_name() {
        return 'custom_text_with_line'; // Unique ID for your widget
    }

    public function get_title() {
        return __( 'Text With Line and Button', 'custom-elementor-widget' );
    }

    public function get_icon() {
        return 'eicon-text'; // Elementor icon
    }

    public function get_categories() {
        return [ 'general' ]; // Widget category in Elementor
    }

    protected function register_controls() {

        // Content section for text, line, and button
        $this->start_controls_section(
            'content_section',
            [
                'label' => __( 'Content', 'custom-elementor-widget' ),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        // Control for text
        $this->add_control(
            'custom_text',
            [
                'label' => __( 'Text', 'custom-elementor-widget' ),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => __( 'Your Custom Text', 'custom-elementor-widget' ),
            ]
        );

        // Control for button text
        $this->add_control(
            'button_text',
            [
                'label' => __( 'Button Text', 'custom-elementor-widget' ),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => __( 'Click Me', 'custom-elementor-widget' ),
            ]
        );

        // Control for button link
        $this->add_control(
            'button_link',
            [
                'label' => __( 'Button URL', 'custom-elementor-widget' ),
                'type' => \Elementor\Controls_Manager::URL,
                'placeholder' => __( 'https://your-link.com', 'custom-elementor-widget' ),
                'default' => [
                    'url' => '',
                    'is_external' => false,
                    'nofollow' => false,
                ],
            ]
        );

        $this->end_controls_section();

        // Style section for text
        $this->start_controls_section(
            'style_text_section',
            [
                'label' => __( 'Text Style', 'custom-elementor-widget' ),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

        // Typography control for text
        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'text_typography',
                'label' => __( 'Typography', 'custom-elementor-widget' ),
                'selector' => '{{WRAPPER}} .text',
            ]
        );

        // Color control for text
        $this->add_control(
            'text_color',
            [
                'label' => __( 'Text Color', 'custom-elementor-widget' ),
                'type' => \Elementor\Controls_Manager::COLOR,
                // 'selectors' => [
                //     '{{WRAPPER}} .text' => 'color: {{VALUE}};',
                // ],
            ]
        );

        $this->end_controls_section();

        // Style section for line
        $this->start_controls_section(
            'style_line_section',
            [
                'label' => __( 'Line Style', 'custom-elementor-widget' ),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

        // Color control for line
        $this->add_control(
            'line_color',
            [
                'label' => __( 'Line Color', 'custom-elementor-widget' ),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .line' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        // Line thickness control
       /* The above code is defining a control for a custom Elementor widget in PHP. It is adding a
       control for setting the line thickness with a slider input. The control allows the user to
       set the line thickness within a range of 1 to 10 pixels with a step of 1 pixel. The
       'selectors' part of the code specifies that the value set by the user will be applied to the
       height of the element with the class 'line' within the widget wrapper. */
        $this->add_control(
            'line_thickness',
            [
                'label' => __( 'Line Thickness', 'custom-elementor-widget' ),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => 1,
                        'max' => 10,
                        'step' => 1,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .line' => 'height: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();

        // Style section for button
        $this->start_controls_section(
            'style_button_section',
            [
                'label' => __( 'Button Style', 'custom-elementor-widget' ),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

        // Typography control for button
        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'button_typography',
                'label' => __( 'Button Typography', 'custom-elementor-widget' ),
                'selector' => '{{WRAPPER}} .custom-button',
            ]
        );

        // Button text color control
        $this->add_control(
            'button_text_color',
            [
                'label' => __( 'Button Text Color', 'custom-elementor-widget' ),
                'type' => \Elementor\Controls_Manager::COLOR,
                // 'selectors' => [
                //     '{{WRAPPER}} .custom-button' => 'color: {{VALUE}};',
                // ],
            ]
        );

        // Button background color control
        $this->add_control(
            'button_background_color',
            [
                'label' => __( 'Button Background Color', 'custom-elementor-widget' ),
                'type' => \Elementor\Controls_Manager::COLOR,
                // 'selectors' => [
                //     '{{WRAPPER}} .custom-button' => 'background-color: {{VALUE}};',
                // ],
            ]
        );

        // Button border type control
        $this->add_control(
            'button_border_type',
            [
                'label' => __( 'Button Border Type', 'custom-elementor-widget' ),
                'type' => \Elementor\Controls_Manager::SELECT,
                'options' => [
                    'none' => __( 'None', 'custom-elementor-widget' ),
                    'solid' => __( 'Solid', 'custom-elementor-widget' ),
                    'dashed' => __( 'Dashed', 'custom-elementor-widget' ),
                    'dotted' => __( 'Dotted', 'custom-elementor-widget' ),
                ],
                'default' => 'none',
            ]
        );

        // Button border width control
        $this->add_control(
            'button_border_width',
            [
                'label' => __( 'Button Border Width', 'custom-elementor-widget' ),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 10,
                        'step' => 1,
                    ],
                ],
                // 'selectors' => [
                //     '{{WRAPPER}} .custom-button' => 'border-width: {{SIZE}}{{UNIT}};',
                // ],
            ]
        );

        // Button border radius control
        $this->add_control(
            'button_border_radius',
            [
                'label' => __( 'Button Border Radius', 'custom-elementor-widget' ),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => [ 'px', '%' ],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 100,
                        'step' => 1,
                    ],
                ],
                // 'selectors' => [
                //     '{{WRAPPER}} .custom-button' => 'border-radius: {{SIZE}}{{UNIT}};',
                // ],
            ]
        );

        // Button hover effects
        // $this->start_controls_tab(
        //     'button_hover_tab',
        //     [
        //         'label' => __( 'Hover', 'custom-elementor-widget' ),
        //     ]
        // );

        // // Button hover background color
        // $this->add_control(
        //     'button_hover_background_color',
        //     [
        //         'label' => __( 'Hover Background Color', 'custom-elementor-widget' ),
        //         'type' => \Elementor\Controls_Manager::COLOR,
        //         'selectors' => [
        //             '{{WRAPPER}} .custom-button:hover' => 'background-color: {{VALUE}};',
        //         ],
        //     ]
        // );

        // // Button hover text color
        // $this->add_control(
        //     'button_hover_text_color',
        //     [
        //         'label' => __( 'Hover Text Color', 'custom-elementor-widget' ),
        //         'type' => \Elementor\Controls_Manager::COLOR,
        //         'selectors' => [
        //             '{{WRAPPER}} .custom-button:hover' => 'color: {{VALUE}};',
        //         ],
        //     ]
        // );

        // $this->end_controls_tab();
        $this->end_controls_section();
    }

    protected function render() {
        $settings = $this->get_settings_for_display();
    
        // Default values if not set
        $text_color = esc_attr($settings['text_color'] ?? '#000000'); // Default black
        $line_color = esc_attr($settings['line_color'] ?? '#000000'); // Default black
        $line_thickness = ($settings['line_thickness']['size'] ?? 2) . 'px'; // Default 2px
        $button_text_color = esc_attr($settings['button_text_color'] ?? '#FFFFFF'); // Default white
        $button_background_color = esc_attr($settings['button_background_color'] ?? '#0073e6'); // Default blue
        $button_border_type = esc_attr($settings['button_border_type'] ?? 'none'); // Default none
        $button_border_width = ($settings['button_border_width']['size'] ?? 0) . 'px'; // Default 0px
        $button_border_radius = ($settings['button_border_radius']['size'] ?? 0) . 'px'; // Default 0px
        $button_link = esc_url($settings['button_link']['url'] ?? '#'); // Default link to #
        $custom_text = esc_html($settings['custom_text'] ?? 'Your Custom Text'); // Default text
    
        ?>
        
        <div class="custom-text-with-line">
            <div class="text" style="color: <?php echo $text_color; ?>;"><?php echo $custom_text; ?></div>
            <div class="line" style="background-color: <?php echo $line_color; ?>; height: <?php echo $line_thickness; ?>;"></div>
            <a class="custom-button" 
               href="<?php echo $button_link; ?>" 
               style="
                   color: <?php  echo $button_text_color; ?>; 
                   background-color: <?php echo $button_background_color; ?>; 
                   border-style: <?php echo $button_border_type; ?>; 
                   border-width: <?php echo $button_border_width; ?>; 
                   border-radius: <?php echo $button_border_radius; ?>;">
                <?php echo esc_html($settings['button_text']); ?>
            </a>
        </div>
    
        <?php
    }
    
    
}

// Register the widget
\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new Custom_Text_With_Line_Widget() );
