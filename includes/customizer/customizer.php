<?php
/**
 * Customizer settings for the Plugerdy Responsive Menu.
 *
 * @package plugerdy_nav_menu_Widget
 */

if (!defined('ABSPATH')) {
 exit; // Exit if accessed directly.
}

// include plugin_dir_path( __FILE__ ) . 'settings.php';
include plugin_dir_path( __FILE__ ) . 'panels/settings-panel.php';
include plugin_dir_path( __FILE__ ) . 'panels/plugerdy-global-settings.php';


/**
 * Enqueue customizer preview script.
 */
function plugerdy_nav_menu_enqueue_preview_script()
{
 wp_enqueue_script(
  'plugerdy-responsive-nav--preview',
  plugin_dir_url(__FILE__) . 'customize-preview.js', // Updated file path
  array('jquery', 'customize-preview'),
  false,
  true
 );
}
add_action('customize_preview_init', 'plugerdy_nav_menu_enqueue_preview_script');

/**
 * Output dynamic CSS based on Customizer settings.
 */
function plugerdy_nav_menu_dynamic_css()
{
 $menu_width = get_theme_mod('plugerdy_nav_menu_width');
 $menu_btn_size = get_theme_mod('plugerdy_nav_btn_size');
 $menu_btn_color = get_theme_mod('plugerdy_nav_btn_color');
 $menu_background = get_theme_mod('plugerdy_nav_menu_bg_color');
 $menu_opacity = get_theme_mod('plugerdy_nav_menu_opacity');
 $menu_color = get_theme_mod('plugerdy_nav_menu_text_color');

 $custom_css = ":root {";
 if ($menu_width) {
  $custom_css .= "--plugerdy-responsive-nav-width: {$menu_width}vw;";
 }

 if ($menu_btn_size) {
  $custom_css .= "--plugerdy-nav-btn-size: {$menu_btn_size}px;";
 }

 if ($menu_btn_color) {
  $custom_css .= "--plugerdy-nav-btn-color: {$menu_btn_color};";
 }

 if ($menu_background) {
  $custom_css .= "--plugerdy-nav-btn-background-color: {$menu_background};";
 }

 if ($menu_opacity) {
  $menu_opacity = $menu_opacity / 100;
 }

 $custom_css .= "--plugerdy-responsive-nav-opacity: {$menu_opacity};";
 if ($menu_color) {
  $custom_css .= "--plugerdy-responsive-nav-color: {$menu_color};";
 }

 $custom_css .= "}";

 if (!empty(trim($custom_css, ":root {};"))) {
  echo "<style type='text/css'>{$custom_css}</style>";
 }
}
add_action('wp_head', 'plugerdy_nav_menu_dynamic_css');
