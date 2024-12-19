<?php

namespace Topscore_Extra\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;

if (!defined('ABSPATH')) exit; // Exit if accessed directly

/**
 * Events Widget
 */
class Events extends Widget_Base
{

    public function get_name()
    {
        return 'events';
    }

    public function get_title()
    {
        return __('Events', 'topscore-extra');
    }

    public function get_icon()
    {
        return 'eicon-carousel-loop';
    }

    public function get_keywords()
    {
        return ['event'];
    }

    public function get_style_depends()
    {
        return ['events-style'];
    }

    public function get_categories()
    {
        return ['topscore-extra'];
    }

    protected function register_controls()
    {
        $this->start_controls_section(
            'section_event',
            [
                'label' => esc_html__('Events', 'topscore-extra'),
                'tab' => Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'event-posts-per-page',
            [
                'label' => __('Post Per Page', 'topscore-extra'),
                'type' => Controls_Manager::SELECT,
                'multiple' => false,
                'default' => '3',
                'options' => [
                    '3' => '3',
                    '6' => '6',
                    '9' => '9',
                    '-1' => '-1',
                ]
            ]
        );

        $this->add_control(
            'event-order-by',
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
            'event-order',
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

        $this->end_controls_section();
    }

    /**
     * Render the widget output on the frontend.
     */
    protected function render()
    {
        $settings = $this->get_settings_for_display();
        $postsPerPage = $settings['event-posts-per-page'];
        $orderBy = $settings['event-order-by'];
        $order = $settings['event-order'];

        $args = array(
            'post_type' => 'events',
            'post_status' => 'publish',
            'posts_per_page' => $postsPerPage,
            'orderby' => $orderBy,
            'order' => $order
        );

        $the_query = new \WP_Query($args);

        if ($the_query->have_posts()) :
?>
            <div class="event-box">
                <div class="row">
                    <?php
                    while ($the_query->have_posts()) :
                        $the_query->the_post();
                        $post_id = get_the_ID();  ?>
                        <div class="col-lg-4 col-md-6 col-sm-6">
                            <div class="event-item">
                                <div class="event-image position-relative">
                                    <img width="420" height="320" src="<?php echo esc_url(get_the_post_thumbnail_url($post_id, 'medium')); ?>" alt="<?php the_title(); ?>">
                                </div>
                                <div class="event-content">
                                    <h4><a href="<?= the_permalink(); ?>"><?= the_title() ?></a></h4>
                                    <p><a href="<?= the_permalink(); ?>">Read More <i class="fa-solid fa-arrow-right"></i></a></p>
                                </div>
                            </div>
                        </div>
                    <?php endwhile;
                    wp_reset_postdata(); ?>
                </div>
            </div>
        <?php endif; ?>
<?php
    }
}
