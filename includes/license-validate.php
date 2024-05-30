<?php
/**
 * Validate License Plugerdy Responsive Menu.
 *
 * @package PlugerdyResponsiveMenu
 */

if (!defined('ABSPATH')) {
 exit; // Exit if accessed directly.
}

/**
 * Output premium dynamic CSS based on Customizer settings.
 */
function plugerdy_responsive_menu_premium_dynamic_css()
{
 $menu_animation = get_theme_mod('plugerdy_responsive_menu_animation');

 $custom_css = ":root {";
 if ($menu_animation) {
  $custom_css .= "--plugerdy-responsive-menu-width: {$menu_width}vw;";
 }

 if (!empty(trim($custom_css, ":root {};"))) {
  echo "<style type='text/css'>{$custom_css}</style>";
 }
}

add_action('wp_head', 'plugerdy_responsive_menu_dynamic_css');

/**
 * Check if a valid license key is present and apply premium styles if verified.
 */
function plugerdy_responsive_menu_widget_license_key($wp_customize)
{
 $license_key = get_theme_mod('plugerdy_responsive_menu_widget_license_key');

 if (!empty($license_key) && my_plugin_verify_license($license_key)) {
  add_action('wp_head', 'plugerdy_responsive_menu_premium_dynamic_css');
 }
}
add_action('customize_register', 'plugerdy_responsive_menu_widget_license_key');

/**
 * Verify the license key against your server or local conditions
 */
function my_plugin_verify_license($license_key)
{
 $valid_keys = ['plugerdyABCD', 'plugerdy1234', 'plugerdy4321'];

 // Check if the provided license key is in the array of valid keys
 return in_array($license_key, $valid_keys);
}
