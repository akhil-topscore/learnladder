<?php
namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

class Elementor_Image_Card extends Widget_Base {

    public function get_name() {
        return 'elementor_image_card';
    }

    public function get_title() {
        return __( 'Image Card', 'elementor-image-card' );
    }

    public function get_icon() {
        return 'fa fa-image';
    }

    public function get_categories() {
        return [ 'general' ];
    }

    protected function _register_controls() {
        $this->start_controls_section(
            'content_section',
            [
                'label' => __( 'Content', 'elementor-image-card' ),
                'tab'   => Controls_Manager::TAB_CONTENT,
            ]
        );
    
        $this->add_control(
            'image',
            [
                'label' => __( 'Image', 'elementor-image-card' ),
                'type' => Controls_Manager::MEDIA,
                'default' => [
                    'url' => '',
                ],
            ]
        );
    
        $this->add_control(
            'heading',
            [
                'label' => __( 'Heading', 'elementor-image-card' ),
                'type' => Controls_Manager::TEXT,
                'default' => __( 'Your Heading Here', 'elementor-image-card' ),
            ]
        );
    
        // Adding Typography control for Heading
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'heading_typography',
                'label' => __( 'Heading Typography', 'elementor-image-card' ),
                'selector' => '{{WRAPPER}} .eic-widget-heading',
            ]
        );
    
        // Adding Text Alignment for Heading
        $this->add_responsive_control(
            'heading_alignment',
            [
                'label' => __( 'Heading Alignment', 'elementor-image-card' ),
                'type' => Controls_Manager::CHOOSE,
                'options' => [
                    'left' => [
                        'title' => __( 'Left', 'elementor-image-card' ),
                        'icon' => 'fa fa-align-left',
                    ],
                    'center' => [
                        'title' => __( 'Center', 'elementor-image-card' ),
                        'icon' => 'fa fa-align-center',
                    ],
                    'right' => [
                        'title' => __( 'Right', 'elementor-image-card' ),
                        'icon' => 'fa fa-align-right',
                    ],
                ],
                'default' => 'center',
                'selectors' => [
                    '{{WRAPPER}} .eic-widget-heading' => 'text-align: {{VALUE}};',
                ],
            ]
        );
    
        $this->add_control(
            'link',
            [
                'label' => __( 'Link', 'elementor-image-card' ),
                'type' => Controls_Manager::URL,
                'placeholder' => __( 'https://your-link.com', 'elementor-image-card' ),
                'default' => [
                    'url' => '',
                    'is_external' => false,
                    'nofollow' => false,
                ],
            ]
        );
    
        $this->add_control(
            'button_text',
            [
                'label' => __( 'Button Text', 'elementor-image-card' ),
                'type' => Controls_Manager::TEXT,
                'default' => __( 'Click Here', 'elementor-image-card' ),
            ]
        );
    
        // Adding Typography control for Button
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'button_typography',
                'label' => __( 'Button Typography', 'elementor-image-card' ),
                'selector' => '{{WRAPPER}} .eic-widget-button',
            ]
        );
    
        // Adding Text Alignment for Button
        $this->add_responsive_control(
            'button_alignment',
            [
                'label' => __( 'Button Alignment', 'elementor-image-card' ),
                'type' => Controls_Manager::CHOOSE,
                'options' => [
                    'left' => [
                        'title' => __( 'Left', 'elementor-image-card' ),
                        'icon' => 'fa fa-align-left',
                    ],
                    'center' => [
                        'title' => __( 'Center', 'elementor-image-card' ),
                        'icon' => 'fa fa-align-center',
                    ],
                    'right' => [
                        'title' => __( 'Right', 'elementor-image-card' ),
                        'icon' => 'fa fa-align-right',
                    ],
                ],
                'default' => 'center',
                'selectors' => [
                    '{{WRAPPER}} .eic-widget-button' => 'text-align: {{VALUE}};',
                ],
            ]
        );
    
        $this->add_control(
            'button_link',
            [
                'label' => __( 'Button Link', 'elementor-image-card' ),
                'type' => Controls_Manager::URL,
                'placeholder' => __( 'https://your-button-link.com', 'elementor-image-card' ),
                'default' => [
                    'url' => '',
                    'is_external' => false,
                    'nofollow' => false,
                ],
            ]
        );
    
        $this->add_control(
            'button_background_color',
            [
                'label' => __( 'Button Background Color', 'elementor-image-card' ),
                'type' => Controls_Manager::COLOR,
                'default' => '#0073e6',
                'selectors' => [
                    '{{WRAPPER}} .eic-widget-button' => 'background-color: {{VALUE}};',
                ],
            ]
        );
    
        $this->add_control(
            'button_hover_color',
            [
                'label' => __( 'Button Hover Color', 'elementor-image-card' ),
                'type' => Controls_Manager::COLOR,
                'default' => '#005bb5',
                'selectors' => [
                    '{{WRAPPER}} .eic-widget-button:hover' => 'background-color: {{VALUE}};',
                ],
            ]
        );
    
        $this->end_controls_section();
    }
    

    protected function render() {
        $settings = $this->get_settings_for_display();
        $image = $settings['image']['url'];
        $heading = $settings['heading'];
        $link = $settings['link']['url'];
        $button_text = $settings['button_text'];
        $button_link = $settings['button_link']['url'];
    
        ?>
        <div class="eic-widget-wrapper">
            <div class="eic-widget-container">
                <a href="<?php echo esc_url( $link ); ?>" target="<?php echo $settings['link']['is_external'] ? '_blank' : '_self'; ?>" rel="<?php echo $settings['link']['nofollow'] ? 'nofollow' : ''; ?>">
                    <img src="<?php echo esc_url( $image ); ?>" alt="<?php echo esc_attr( $heading ); ?>" class="eic-widget-image">
                </a>
                <div class="eic-widget-content">
                    <h2 class="eic-widget-heading"><?php echo esc_html( $heading ); ?></h2>
                    <a href="<?php echo esc_url( $button_link ); ?>" target="<?php echo $settings['button_link']['is_external'] ? '_blank' : '_self'; ?>" rel="<?php echo $settings['button_link']['nofollow'] ? 'nofollow' : ''; ?>" class="eic-widget-button">
                        <?php echo esc_html( $button_text ); ?>
                    </a>
                </div>
            </div>
        </div>
        <?php
    }
    
    protected function _content_template() {
    }
}
