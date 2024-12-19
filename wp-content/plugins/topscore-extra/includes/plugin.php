<?php

namespace Topscore_Extra;

use Topscore_Extra\Widgets\Content_Carousel;
use Topscore_Extra\Widgets\Facility_Carousel;
use Topscore_Extra\Widgets\News_Scroll;
use Topscore_Extra\Widgets\Section_Title_Widget;
use Topscore_Extra\Widgets\Slides;
use Topscore_Extra\Widgets\Testimonial_Carousel;
use Topscore_Extra\Widgets\Aspect_Widget;
use Topscore_Extra\Widgets\Events;
use Topscore_Extra\Widgets\Gallery;
use Topscore_Extra\Widgets\Category_Slider;

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}

/**
 * Plugin class.
 *
 * The main class that initiates and runs the addon.
 *
 * @since 1.0.0
 */
final class Plugin
{

    /**
     * Addon Version
     *
     * @since 1.0.0
     * @var string The addon version.
     */
    const VERSION = '2.0.0';

    /**
     * Minimum Elementor Version
     *
     * @since 1.0.0
     * @var string Minimum Elementor version required to run the addon.
     */
    const MINIMUM_ELEMENTOR_VERSION = '3.21.0';

    /**
     * Minimum PHP Version
     *
     * @since 1.0.0
     * @var string Minimum PHP version required to run the addon.
     */
    const MINIMUM_PHP_VERSION = '7.4';

    /**
     * Instance
     *
     * @since 1.0.0
     * @access private
     * @static
     * @var \Topscore_Extra\Plugin The single instance of the class.
     */
    private static $_instance = null;

    /**
     * @return \Elementor\Plugin
     */
    public static function elementor()
    {
        return \Elementor\Plugin::$instance;
    }

    /**
     * Instance
     *
     * Ensures only one instance of the class is loaded or can be loaded.
     *
     * @since 1.0.0
     * @access public
     * @static
     * @return \Topscore_Extra\Plugin An instance of the class.
     */
    public static function instance()
    {

        if (is_null(self::$_instance)) {
            self::$_instance = new self();
        }
        return self::$_instance;
    }

    /**
     * Constructor
     *
     * Perform some compatibility checks to make sure basic requirements are meet.
     * If all compatibility checks pass, initialize the functionality.
     *
     * @since 1.0.0
     * @access public
     */
    public function __construct()
    {

        if ($this->is_compatible()) {
            add_action('elementor/init', [$this, 'init']);
        }
    }

    /**
     * Compatibility Checks
     *
     * Checks whether the site meets the addon requirement.
     *
     * @since 1.0.0
     * @access public
     */
    public function is_compatible()
    {

        // Check if Elementor installed and activated
        if (!did_action('elementor/loaded')) {
            add_action('admin_notices', [$this, 'admin_notice_missing_main_plugin']);
            return false;
        }

        // Check for required Elementor version
        if (!version_compare(ELEMENTOR_VERSION, self::MINIMUM_ELEMENTOR_VERSION, '>=')) {
            add_action('admin_notices', [$this, 'admin_notice_minimum_elementor_version']);
            return false;
        }

        // Check for required PHP version
        if (version_compare(PHP_VERSION, self::MINIMUM_PHP_VERSION, '<')) {
            add_action('admin_notices', [$this, 'admin_notice_minimum_php_version']);
            return false;
        }

        return true;
    }

    /**
     * Admin notice
     *
     * Warning when the site doesn't have Elementor installed or activated.
     *
     * @since 1.0.0
     * @access public
     */
    public function admin_notice_missing_main_plugin()
    {

        if (isset($_GET['activate'])) unset($_GET['activate']);

        $message = sprintf(
            /* translators: 1: Plugin name 2: Elementor */
            esc_html__('"%1$s" requires "%2$s" to be installed and activated.', 'topscore-extra'),
            '<strong>' . esc_html__('Topscore Extra', 'topscore-extra') . '</strong>',
            '<strong>' . esc_html__('Elementor', 'topscore-extra') . '</strong>'
        );

        printf('<div class="notice notice-warning is-dismissible"><p>%1$s</p></div>', $message);
    }

    /**
     * Admin notice
     *
     * Warning when the site doesn't have a minimum required Elementor version.
     *
     * @since 1.0.0
     * @access public
     */
    public function admin_notice_minimum_elementor_version()
    {

        if (isset($_GET['activate'])) unset($_GET['activate']);

        $message = sprintf(
            /* translators: 1: Plugin name 2: Elementor 3: Required Elementor version */
            esc_html__('"%1$s" requires "%2$s" version %3$s or greater.', 'topscore-extra'),
            '<strong>' . esc_html__('Topscore Extra', 'topscore-extra') . '</strong>',
            '<strong>' . esc_html__('Elementor', 'topscore-extra') . '</strong>',
            self::MINIMUM_ELEMENTOR_VERSION
        );

        printf('<div class="notice notice-warning is-dismissible"><p>%1$s</p></div>', $message);
    }

    /**
     * Admin notice
     *
     * Warning when the site doesn't have a minimum required PHP version.
     *
     * @since 1.0.0
     * @access public
     */
    public function admin_notice_minimum_php_version()
    {

        if (isset($_GET['activate'])) unset($_GET['activate']);

        $message = sprintf(
            /* translators: 1: Plugin name 2: PHP 3: Required PHP version */
            esc_html__('"%1$s" requires "%2$s" version %3$s or greater.', 'topscore-extra'),
            '<strong>' . esc_html__('Topscore Extra', 'topscore-extra') . '</strong>',
            '<strong>' . esc_html__('PHP', 'topscore-extra') . '</strong>',
            self::MINIMUM_PHP_VERSION
        );

        printf('<div class="notice notice-warning is-dismissible"><p>%1$s</p></div>', $message);
    }

    /**
     * Initialize
     *
     * Load the addons functionality only after Elementor is initialized.
     *
     * Fired by `elementor/init` action hook.
     *
     * @since 1.0.0
     * @access public
     */
    public function init()
    {
        require_once(__DIR__ . '/base/base-carousel.php');
        require_once(__DIR__ . '/elementor-functions.php');
        require_once(__DIR__ . '/custom-posts.php');

        // Register widget styles & scripts
        add_action('elementor/frontend/after_register_scripts', [$this, 'widget_scripts']);
        add_action('elementor/frontend/after_enqueue_styles', [$this, 'widget_styles']);

        // Register widgets
        add_action('elementor/widgets/register', [$this, 'register_widgets']);

        // Register category
        add_action('elementor/elements/categories_registered', [$this, 'add_elementor_widget_categories']);
    }

    /**
     * widget_scripts
     *
     * Load required plugin script files.
     *
     * @since 1.0.0
     * @access public
     */
    public function widget_scripts()
    {
        wp_register_script('slides-script', plugins_url('../assets/js/slides.js', __FILE__), ['elementor-frontend'], self::VERSION, true);
        wp_register_script('content-script', plugins_url('../assets/js/content.js', __FILE__), ['elementor-frontend'], self::VERSION, true);
        wp_register_script('carousel-script', plugins_url('../assets/js/carousel.js', __FILE__), ['elementor-frontend'], self::VERSION, true);
        wp_register_script('facility-script', plugins_url('../assets/js/facility.js', __FILE__), ['elementor-frontend'], self::VERSION, true);
        wp_register_script('gallery-script', plugins_url('../assets/js/gallery.js', __FILE__), ['elementor-frontend'], self::VERSION, true);
        wp_register_script('testimonial-script', plugins_url('../assets/js/testimonial.js', __FILE__), ['elementor-frontend'], self::VERSION, true);
    }

    public function get_script_depends()
    {
        return ['slides-script', 'content-script', 'carousel-script', 'facility-script', 'gallery-script', 'testimonial-script'];
    }

    /**
     * widget_styles
     *
     * Load required plugin style files.
     *
     * @since 1.0.0
     * @access public
     */
    public function widget_styles()
    {
        wp_register_style('news-style', plugins_url('../assets/css/news.min.css', __FILE__), self::VERSION);
        wp_register_style('events-style', plugins_url('../assets/css/events.min.css', __FILE__), self::VERSION);
        wp_register_style('slides-style', plugins_url('../assets/css/slides.min.css', __FILE__), self::VERSION);
        wp_register_style('content-style', plugins_url('../assets/css/content.min.css', __FILE__), self::VERSION);
        wp_register_style('carousel-style', plugins_url('../assets/css/carousel.min.css', __FILE__), self::VERSION);
        wp_register_style('facility-style', plugins_url('../assets/css/facility.min.css', __FILE__), self::VERSION);
        wp_register_style('gallery-style', plugins_url('../assets/css/gallery.min.css', __FILE__), self::VERSION);
        wp_register_style('testimonial-style', plugins_url('../assets/css/testimonial.min.css', __FILE__), self::VERSION);
        wp_register_style('title-style', plugins_url('../assets/css/section-title.min.css', __FILE__), self::VERSION);
       wp_register_style('category-style', plugins_url('../assets/css/category.min.css', __FILE__), self::VERSION);
    }

    public function get_style_depends()
    {
        return ['title-style', 'news-style', 'events-style', 'slides-style', 'content-style', 'carousel-style', 'facility-style', 'gallery-style', 'testimonial-style','category-style'];
    }

    /**
     * Register Widgets
     *
     * Load widgets files and register new Elementor widgets.
     *
     * Fired by `elementor/widgets/register` action hook.
     *
     * @param \Elementor\Widgets_Manager $widgets_manager Elementor widgets manager.
     */
    public function register_widgets($widgets_manager)
    {

        require_once(__DIR__ . '/widgets/events.php');
        require_once(__DIR__ . '/widgets/slides.php');
        require_once(__DIR__ . '/widgets/gallery.php');
        require_once(__DIR__ . '/widgets/news-scroll.php');
        require_once(__DIR__ . '/widgets/content-carousel.php');
        require_once(__DIR__ . '/widgets/facility-carousel.php');
        require_once(__DIR__ . '/widgets/testimonial-carousel.php');
        require_once(__DIR__ . '/widgets/aspect.php');
        require_once(__DIR__ . '/widgets/section-title.php');
        require_once(__DIR__ . '/widgets/category-slider.php');

        $widgets_manager->register(new Events());
        $widgets_manager->register(new Slides());
        $widgets_manager->register(new Gallery());
        $widgets_manager->register(new News_Scroll());
        $widgets_manager->register(new Aspect_Widget());
        $widgets_manager->register(new Content_Carousel());
        $widgets_manager->register(new Facility_Carousel());
        $widgets_manager->register(new Testimonial_Carousel());
        $widgets_manager->register(new Section_Title_Widget());
        $widgets_manager->register(new Category_Slider());
        // $widgets_manager->register(new Category_Slider());
    }

    /**
     * Register widget categories
     */
    public function add_elementor_widget_categories($elements_manager)
    {
        $elements_manager->add_category(
            'topscore-extra',
            [
                'title' => esc_html__('Topscore Extras', 'topscore-extra'),
                'icon' => 'fa fa-plug',
            ]
        );
    }
}
