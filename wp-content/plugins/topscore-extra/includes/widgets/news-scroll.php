<?php

namespace Topscore_Extra\Widgets;

use Elementor\Controls_Manager;
use Elementor\Widget_Base;

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly
}

class News_Scroll extends Widget_Base
{
    public function get_name()
    {
        return 'news-scroll';
    }

    public function get_title()
    {
        return esc_html__('News Scroll', 'topscore-extra');
    }

    public function get_icon()
    {
        return 'eicon-carousel-loop';
    }

    public function get_keywords()
    {
        return ['news', 'carousel', 'scroll'];
    }

    public function get_style_depends()
    {
        return ['news-style'];
    }

    public function get_categories()
    {
        return ['topscore-extra'];
    }

    protected function register_controls()
    {
        $this->start_controls_section(
            'section_news',
            [
                'label' => esc_html__('News', 'topscore-extra'),
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

        $this->add_control(
            'title_background_color',
            [
                'label' => __('Title Background Color', 'topscore-extra'),
                'type' => Controls_Manager::COLOR,
                'default' => '#5078a0',
                'selectors' => [
                    '{{WRAPPER}} .nes-news-title-wrap' => 'background-color: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'title_text_color',
            [
                'label' => __('Title Text Color', 'topscore-extra'),
                'type' => Controls_Manager::COLOR,
                'default' => '#ffffff',
                'selectors' => [
                    '{{WRAPPER}} .nes-news-title-wrap' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->end_controls_section();
    }

protected function render()
{
    $settings = $this->get_settings_for_display();

    $postsPerPage = $settings['posts-per-page'];
    $orderBy = $settings['post-order-by'];
    $order = $settings['post-order'];

    $args = array(
        'post_type' => 'news',
        'post_status' => 'publish',
        'posts_per_page' => $postsPerPage,
        'orderby' => $orderBy,
        'order' => $order
    );

    $gif_name = 'new_gif.gif';
    $gif_path = ABSPATH . 'wp-content/uploads/2024/11/' . $gif_name;

    $the_query = new \WP_Query($args);
    if ($the_query->have_posts()):
        ?>
        <div class="nes-news-scroll-container">
            <div class="nes-news-title-wrap">
                <h2>News & Events</h2>
            </div>  
            <div class="nes-news-scroll">
                <?php while ($the_query->have_posts()):
                    $the_query->the_post();

                    // Get the post's publish date
                    $publish_date = get_the_date('U'); // Unix timestamp of the publish date
                    $current_time = current_time('timestamp'); // Current time in Unix timestamp
                    $time_diff = $current_time - $publish_date; // Difference in seconds

                    // Check if the post is published within the last 24 hours (86400 seconds)
                    $is_new = $time_diff <= 86400; // 86400 seconds = 24 hours
                ?>
                    <div class="nes-news-item<?php echo $is_new ? ' nes-news-item-new' : ''; ?>">
                        <a href="<?php the_permalink(); ?>" class="nes-news-link">
                            <i class="fa-thin fa-pipe"></i>
                            <p><?php the_title(); ?></p>
                            <?php
                            if ($is_new && file_exists($gif_path)) {
                                $gif_url = content_url('uploads/2024/11/' . $gif_name); 
                                echo '<img src="' . esc_url($gif_url) . '" alt="New" class="nes-new-gif" />';
                            }
                            ?>
                        </a>
                    </div>
                <?php endwhile;
                wp_reset_postdata(); ?>
            </div>
        </div>
        <?php
    endif;
}


}
