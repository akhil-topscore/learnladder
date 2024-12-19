<?php

namespace Topscore_Extra\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Utils;

if (!defined('ABSPATH')) exit; // Exit if accessed directly

/**
 * Facilities Widget
 */
class Aspect_Widget extends Widget_Base
{
    /**
     * Retrieve the widget name.
     */
    public function get_name()
    {
        return 'aspect-widget';
    }

    /**
     * Retrieve the widget title.
     */
    public function get_title()
    {
        return __('aspect Widget', 'topscore-extra');
    }

    /**
     * Retrieve the widget icon.
     */
    public function get_icon()
    {
        return 'eicon-posts-carousel';
    }

    /**
     * Retrieve the list of categories the widget belongs to.
     */
    public function get_categories()
    {
        return ['topscore-extra'];
    }

    /**
     * Retrieve the list of scripts the widget depended on.
     */
    public function get_script_depends()
    {
        return ['topscore-extra'];
    }

    /**
     * Register the widget controls.
     */
    protected function register_controls()
    {
        $this->start_controls_section(
            'section_aspect',
            [
                'label' => esc_html__('Aspect', 'topscore-extra'),
                'tab' => Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'mission_title',
            [
                'label'       => __(' Mission Title', 'topscore-extra'),
                'type'        => Controls_Manager::TEXT,
                'label_block' => true,
                'dynamic'     => [
                    'active' => true,
                ],
                'placeholder' => __('Enter your Title Here', 'topscore-extra'),
            ]
        );

        $this->add_control(
            'mission_discription',
            [
                'label'       => __(' Mission Discription', 'topscore-extra'),
                'type'        => Controls_Manager::TEXTAREA,
                'label_block' => true,
                'dynamic'     => [
                    'active' => true,
                ],
                'placeholder' => __('Enter your  Here', 'topscore-extra'),
            ]
        );
        $this->add_control(
            'mission_icon',
            [
                'label' => __('Mission Icon', 'topscore-extra'),
                'type' => Controls_Manager::MEDIA,
                'label_block' => true,
                'default' => ['url' => Utils::get_placeholder_image_src(),],
            ]
        );
        $this->add_control(
            'vision_title',
            [
                'label'       => __(' Vision Title', 'topscore-extra'),
                'type'        => Controls_Manager::TEXT,
                'label_block' => true,
                'dynamic'     => [
                    'active' => true,
                ],
                'placeholder' => __('Enter your Title Here', 'topscore-extra'),
            ]
        );

        $this->add_control(
            'vision_discription',
            [
                'label'       => __(' Vision Discription', 'topscore-extra'),
                'type'        => Controls_Manager::TEXTAREA,
                'label_block' => true,
                'dynamic'     => [
                    'active' => true,
                ],
                'placeholder' => __('Enter your  Here', 'topscore-extra'),
            ]
        );
        $this->add_control(
            'vision_icon',
            [
                'label' => __('Vision Icon', 'topscore-extra'),
                'type' => Controls_Manager::MEDIA,
                'label_block' => true,
                'default' => ['url' => Utils::get_placeholder_image_src(),],
            ]
        );

        $this->add_control(
            'slogan_title',
            [
                'label'       => __(' Slogan Title', 'topscore-extra'),
                'type'        => Controls_Manager::TEXT,
                'label_block' => true,
                'dynamic'     => [
                    'active' => true,
                ],
                'placeholder' => __('Enter your Title Here', 'topscore-extra'),
            ]
        );

        $this->add_control(
            'slogan_discription',
            [
                'label'       => __(' Slogan Discription', 'topscore-extra'),
                'type'        => Controls_Manager::TEXTAREA,
                'label_block' => true,
                'dynamic'     => [
                    'active' => true,
                ],
                'placeholder' => __('Enter your  Here', 'topscore-extra'),
            ]
        );
        $this->add_control(
            'slogan_icon',
            [
                'label' => __('Slogan Icon', 'topscore-extra'),
                'type' => Controls_Manager::MEDIA,
                'label_block' => true,
                'default' => ['url' => Utils::get_placeholder_image_src(),],
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

        $Mission_Discription = $settings['mission_discription'];
        $Mission_Title = $settings['mission_title'];
        $Mission_Icon = $settings['mission_icon'];
        $Vision_Discription = $settings['vision_discription'];
        $Vision_Title = $settings['vision_title'];
        $Vision_Icon = $settings['vision_icon'];
        $Slogan_Discription = $settings['slogan_discription'];
        $Slogan_Title = $settings['slogan_title'];
        $Slogan_Icon = $settings['slogan_icon'];
        
        
?>


<div class="pset">
  <div class="container">
    <div class="row listar-feature-items">

      <div class="col-xs-12 col-sm-6 col-md-4 listar-feature-item-wrapper listar-feature-with-image listar-height-changed" data-aos="fade-zoom-in" data-aos-group="features" data-line-height="25.2px">
        <div class="listar-feature-item listar-feature-has-link">


          <div class="listar-feature-item-inner">

            <div class="listar-feature-right-border"></div>

            <div class="listar-feature-block-content-wrapper">
              <div class="listar-feature-icon-wrapper">
                <div class="listar-feature-icon-inner">
                  <div>
                    <img alt="Businesses" class="listar-image-icon" src="<?php echo esc_url($Mission_Icon['url']); ?>">
                  </div>
                </div>
              </div>

              <div class="listar-feature-content-wrapper" style="padding-top: 0px;">

                <div class="listar-feature-item-title listar-feature-counter-added">
                  <span><span>01</span>
                  <?php echo  $Mission_Title ?> </span>
                </div>

                <div class="listar-feature-item-excerpt">
                <?php echo $Mission_Discription ?> </div>

              </div>
            </div>
          </div>
        </div>
        <div class="listar-feature-fix-bottom-padding listar-fix-feature-arrow-button-height"></div>
      </div>

      <div class="col-xs-12 col-sm-6 col-md-4 listar-feature-item-wrapper listar-feature-with-image listar-height-changed" data-aos="fade-zoom-in" data-aos-group="features" data-line-height="25.2px">
        <div class="listar-feature-item listar-feature-has-link">
          <div class="listar-feature-item-inner">

            <div class="listar-feature-right-border"></div>

            <div class="listar-feature-block-content-wrapper">
              <div class="listar-feature-icon-wrapper">
                <div class="listar-feature-icon-inner">
                  <div>
                    <img alt="Customers" class="listar-image-icon" src="<?php echo esc_url($Vision_Icon['url']); ?>">
                  </div>
                </div>
              </div>

              <div class="listar-feature-content-wrapper" style="padding-top: 0px;">

                <div class="listar-feature-item-title listar-feature-counter-added">
                  <span><span>02</span>
                  <?php echo  $Vision_Title ?> </span>
                </div>

                <div class="listar-feature-item-excerpt">
                  <?php echo $Vision_Discription ?> </div>

              </div>
            </div>
          </div>
        </div>
        <div class="listar-feature-fix-bottom-padding listar-fix-feature-arrow-button-height"></div>
      </div>

      <div class="col-xs-12 col-sm-6 col-md-4 listar-feature-item-wrapper listar-feature-with-image listar-height-changed" data-aos="fade-zoom-in" data-aos-group="features" data-line-height="25.2px">
        <div class="listar-feature-item listar-feature-has-link">
          <div class="listar-feature-item-inner">

            <div class="listar-feature-right-border"></div>

            <div class="listar-feature-block-content-wrapper">
              <div class="listar-feature-icon-wrapper">
                <div class="listar-feature-icon-inner">
                  <div>
                    <img alt="Feedback" class="listar-image-icon" src="<?php echo esc_url($Slogan_Icon['url']); ?>">
                  </div>
                </div>
              </div>

              <div class="listar-feature-content-wrapper" style="padding-top: 0px;">

                <div class="listar-feature-item-title listar-feature-counter-added">
                  <span><span>03</span>
                  <?php echo  $Slogan_Title ?> </span>
                </div>

                <div class="listar-feature-item-excerpt">
                <?php echo $Slogan_Discription ?> </div>

              </div>
            </div>
          </div>
        </div>
        <div class="listar-feature-fix-bottom-padding listar-fix-feature-arrow-button-height"></div>
      </div>
    </div>
  </div>
</div>
            
<?php
    }
}
