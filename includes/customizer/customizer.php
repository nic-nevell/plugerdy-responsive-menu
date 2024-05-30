<?php
/**
 * Customizer settings for the Plugerdy Responsive Menu.
 *
 * @package plugerdy_responsive_menu_Widget
 */

if (!defined('ABSPATH')) {
 exit; // Exit if accessed directly.
}

// include plugin_dir_path( __FILE__ ) . 'settings.php';
include plugin_dir_path( __FILE__ ) . 'panels/settings-panel.php';


/**
 * Enqueue customizer preview script.
 */
function plugerdy_responsive_menu_enqueue_preview_script()
{
 wp_enqueue_script(
  'plugerdy-responsive-menu-preview',
  plugin_dir_url(__FILE__) . 'customize-preview.js', // Updated file path
  array('jquery', 'customize-preview'),
  false,
  true
 );
}
add_action('customize_preview_init', 'plugerdy_responsive_menu_enqueue_preview_script');
