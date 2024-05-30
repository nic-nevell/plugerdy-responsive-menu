<?php
/**
 * Customizer settings for the Plugerdy Responsive Menu.
 *
 * @package PlugerdyResponsiveMenu
 */

if (!defined('ABSPATH')) {
 exit; // Exit if accessed directly.
}

// Add action to register the panel
add_action('customize_register', 'register_plugerdy_responsive_menu_panel');

/**
 * Register the Panel within Customize.
 *
 * @param \WP_Customize_Manager $wp_customize The customize manager object.
 *
 * @return void
 */
function register_plugerdy_responsive_menu_panel(\WP_Customize_Manager $wp_customize)
{
 // Create a panel for settings
 $wp_customize->add_panel(
  'plugerdy_responsive_menu',
  array(
   'title' => esc_html__('Plugerdy Responsive Menu', ''),
   'description' => esc_html__('Please resize the preview pane to revel the navigation button before customization'),
   'priority' => 10,
  ));

  // Register sections and controls under this panel
  register_plugerdy_responsive_menu_basic_section($wp_customize);
  register_plugerdy_responsive_menu_advanced_section($wp_customize);
}

/**
 * Register the Basic Controls within Customize.
 *
 * @param \WP_Customize_Manager $wp_customize The customize manager object.
 *
 * @return void
 */
function register_plugerdy_responsive_menu_basic_section(\WP_Customize_Manager $wp_customize)
{
 // Basic Settings Section
 $wp_customize->add_section('plugerdy_responsive_menu_basic_section', array(
  'title' => esc_html__('Basic Settings', ''),
  'panel' => 'plugerdy_responsive_menu',
 ));

 //
 // Width settings
 //
 $wp_customize->add_setting(
  'plugerdy_responsive_menu_width',
  array(
   'transport' => 'postMessage',
   'sanitize_callback' => 'absint',
  )
 );
 $wp_customize->add_control(
  'plugerdy_responsive_menu_width',
  array(
   'label' => __('Menu Width (%)', 'plugerdy-responsive-menu'),
   'description' => 'Defaults to min of 200px to stop menu overflow on small screens',
   'section' => 'plugerdy_responsive_menu_basic_section',
   'settings' => 'plugerdy_responsive_menu_width',
   'transport' => 'postMessage',
   'type' => 'range',
   'input_attrs' => array(
    'min' => 0,
    'max' => 100,
    'step' => 1,
   ),
  )
 );

 //
 // Background color
 //
 $wp_customize->add_setting(
  'plugerdy_responsive_menu_bg_color',
  array(
   'transport' => 'postMessage',
   'sanitize_callback' => 'sanitize_hex_color',
   'sanitize_js_callback' => 'maybe_hash_hex_color',
  )
 );
 $wp_customize->add_control(
  new WP_Customize_Color_Control(
   $wp_customize,
   'plugerdy_responsive_menu_bg_color',
   array(
    'label' => __('Background Color', 'plugerdy-responsive-menu'),
    'section' => 'plugerdy_responsive_menu_basic_section',
    'settings' => 'plugerdy_responsive_menu_bg_color',
   )
  )
 );

 //
 // Opacity settings
 //
 $wp_customize->add_setting(
  'plugerdy_responsive_menu_opacity',
  array(
   'transport' => 'postMessage',
   'sanitize_callback' => 'absint',
  )
 );
 $wp_customize->add_control(
  'plugerdy_responsive_menu_opacity',
  array(
   'label' => __('Menu Opacity (%)', 'plugerdy-responsive-menu'),
   'section' => 'plugerdy_responsive_menu_basic_section',
   'settings' => 'plugerdy_responsive_menu_opacity',
   'transport' => 'postMessage',
   'type' => 'range',
   'input_attrs' => array(
    'min' => 10,
    'max' => 100,
    'step' => 1,
   ),
  )
 );

 //
 // Font Size Control
 //
 $wp_customize->add_setting('plugerdy_responsive_nav_font_size', array(
  'transport' => 'postMessage',
  'sanitize_callback' => 'absint',
 ));
 $wp_customize->add_control('plugerdy_responsive_nav_font_size', array(
  'type' => 'range',
  'label' => esc_html__('Font Size', ''),
  'section' => 'plugerdy_responsive_menu_basic_section',
  'input_attrs' => array(
   'min' => 10,
   'max' => 30,
   'step' => 1,
  ),
 ));

 //
 // Text color
 //
 $wp_customize->add_setting(
  'plugerdy_responsive_menu_text_color',
  array(
   'transport' => 'postMessage',
   'sanitize_callback' => 'sanitize_hex_color',
   'sanitize_js_callback' => 'maybe_hash_hex_color',
  )
 );
 $wp_customize->add_control(
  new WP_Customize_Color_Control(
   $wp_customize,
   'plugerdy_responsive_menu_text_color',
   array(
    'label' => __('Text Color', ''),
    'section' => 'plugerdy_responsive_menu_basic_section',
    'settings' => 'plugerdy_responsive_menu_text_color',
   )
  )
 );

}

/**
 * Register the advanced Controls within Customize.
 *
 * @param \WP_Customize_Manager $wp_customize The customize manager object.
 *
 * @return void
 */
function register_plugerdy_responsive_menu_advanced_section(\WP_Customize_Manager $wp_customize)
{

  // Advanced Settings Section
 $wp_customize->add_section('plugerdy_responsive_menu_advanced_section', array(
  'title' => esc_html__('Advanced Settings', ''),
  'panel' => 'plugerdy_responsive_menu',
 ));

 //
 // License settings
 //
 $wp_customize->add_setting(
  'plugerdy_responsive_menu_license_key',
  array(
   'default' => 'plugerdyABCD',
   'sanitize_callback' => 'sanitize_text_field',
  )
 );

 $wp_customize->add_control(
  'my_plugin_license_key',
  array(
   'label' => __('Enter your license key:', 'plugerdy-responsive-menu'),
   'section' => 'plugerdy_responsive_menu_advanced_section',
   'settings' => 'plugerdy_responsive_menu_license_key',
   'type' => 'text',
  )
 );

 //
 // Menu Animation
 //
 $wp_customize->add_setting(
  'plugerdy_responsive_menu_animation',
  array(
   'default' => 'animation-off',
   'transport' => 'postMessage',
   'sanitize_callback' => 'sanitize_key',
  )
 );
 $wp_customize->add_control(
  'plugerdy_responsive_menu_animation',
  array(
   'label' => __('Menu Animation', 'plugerdy-responsive-menu'),
   'section' => 'plugerdy_responsive_menu_advanced_section',
   'settings' => 'plugerdy_responsive_menu_animation',
   'type' => 'radio',
   'choices' => array(
    'animation-off' => __('Off', 'plugerdy-responsive-menu'),
    'animation-on' => __('On', 'plugerdy-responsive-menu'),
   ),
  )
 );

 //
 // Button settings
 //
 $wp_customize->add_setting(
  'plugerdy_responsive_menu_btn_color',
  array(
   'transport' => 'postMessage',
   'sanitize_callback' => 'sanitize_hex_color',
   'sanitize_js_callback' => 'maybe_hash_hex_color',
  )
 );

 $wp_customize->add_control(
  new WP_Customize_Color_Control(
   $wp_customize,
   'plugerdy_responsive_menu_btn_color',
   array(
    'label' => __('Button Color', 'plugerdy-responsive-menu'),
    'section' => 'plugerdy_responsive_menu_advanced_section',
    'settings' => 'plugerdy_responsive_menu_btn_color',
   ),
  )
 );

 $wp_customize->add_setting(
  'plugerdy_responsive_menu_btn_size',
  array(
   'transport' => 'postMessage',
   'sanitize_callback' => 'absint',
  )
 );
 $wp_customize->add_control(
  'plugerdy_responsive_menu_btn_size',
  array(
   'label' => __('Button size', 'plugerdy-responsive-menu'),
   'section' => 'plugerdy_responsive_menu_advanced_section',
   'settings' => 'plugerdy_responsive_menu_btn_size',
   'transport' => 'postMessage',
   'type' => 'range',
   'input_attrs' => array(
    'min' => 28,
    'max' => 48,
    'step' => 1,
   ),
  )
 );

 //
 // Reveal direction
 //
 $wp_customize->add_setting(
  'plugerdy_responsive_nav_reveal_direction',
  array(
   'default' => 'from-right',
   'transport' => 'postMessage',
   'sanitize_callback' => 'sanitize_key',
  )
 );
 $wp_customize->add_control(
  'plugerdy_responsive_nav_reveal_direction',
  array(
   'label' => __('Reveal Direction', 'plugerdy-responsive-menu'),
   'section' => 'plugerdy_responsive_menu_advanced_section',
   'settings' => 'plugerdy_responsive_nav_reveal_direction',
   'type' => 'radio',
   'choices' => array(
    'from-top' => __('Top', 'plugerdy-responsive-menu'),
    'from-bottom' => __('Bottom', 'plugerdy-responsive-menu'),
    'from-center' => __('center', 'plugerdy-responsive-menu'),
    'from-right' => __('Right', 'plugerdy-responsive-menu'),
    'from-left' => __('Left', 'plugerdy-responsive-menu'),
   ),
  )
 );

}
