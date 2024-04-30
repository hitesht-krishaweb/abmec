<?php

namespace Custom_Theme\Setup;

/**
 * Class Frontend
 *
 * This class contains all setup data for the frontend
 *
 * @since      1.0
 *
 * @package    WordPress
 * @subpackage Custom_Theme\Setup
 */
class Frontend {

    public function __construct()
    {
        $this->enqueueScripts();
        $this->enqueueStyles();

    }

    private function enqueueStyles() {
        add_action('wp_enqueue_scripts', function() {
            wp_enqueue_style('abemec_css', get_template_directory_uri() . '/assets/css/main.min.css');
        });
    }

    private function enqueueScripts() {
        add_action('wp_enqueue_scripts', function() {
            wp_enqueue_script('jquery');
            wp_enqueue_script('abemec_js', get_template_directory_uri() . '/assets/js/main.min.js');
            wp_enqueue_script('abemec_plugins', get_template_directory_uri() . '/assets/js/plugins.min.js');
        });

    }
}
