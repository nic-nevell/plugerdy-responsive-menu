<?php
/**
 * Customizer settings for the Plugerdy Responsive Menu.
 *
 * @package Weblite_Nav_Menu_Widget
 */

if (!defined('ABSPATH')) {
  exit; // Exit if accessed directly.
}

// Include WordPress Customizer API.
add_action('customize_register', 'weblite_nav_menu_customizer_settings');

/**
 * Register Customizer settings for the navigation menu widget.
 *
 * @param WP_Customize_Manager $wp_customize The Customizer object.
 */
function weblite_nav_menu_customizer_settings($wp_customize)
{
  // 
  // Add a new section for plugin settings.
  // 
  $wp_customize->add_section(
    'weblite_nav_menu_settings',
    array(
      'title' => __('Plugerdy Responsive Menu', 'plugerdy-responsive-nav'),
      'priority' => 30,
      'description' => 'Please resize the preview pane to revel the navigation button before customization'
    )
  );

  //
  // Button settings
  //
  $wp_customize->add_setting(
    'weblite_nav_btn_color',
    array(
      'transport' => 'postMessage',
      'sanitize_callback' => 'sanitize_hex_color',
      'sanitize_js_callback' => 'maybe_hash_hex_color',
    )
  );
  $wp_customize->add_control(
    new WP_Customize_Color_Control(
      $wp_customize,
      'weblite_nav_btn_color',
      array(
        'label' => __('Button Color', 'plugerdy-responsive-nav'),
        'section' => 'weblite_nav_menu_settings',
        'settings' => 'weblite_nav_btn_color',
      ),
    )
  );

  $wp_customize->add_setting(
    'weblite_nav_btn_size',
    array(
      'transport' => 'postMessage',
      'sanitize_callback' => 'absint',
    )
  );
  $wp_customize->add_control(
    'weblite_nav_btn_size',
    array(
      'label' => __('Button size', 'plugerdy-responsive-nav'),
      'section' => 'weblite_nav_menu_settings',
      'settings' => 'weblite_nav_btn_size',
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
    'weblite_nav_menu_reveal_direction',
    array(
      'default' => 'from-right',
      'transport' => 'postMessage',
      'sanitize_callback' => 'sanitize_key',
    )
  );
  $wp_customize->add_control(
    'weblite_nav_menu_reveal_direction',
    array(
      'label' => __('Reveal Direction', 'plugerdy-responsive-nav'),
      'section' => 'weblite_nav_menu_settings',
      'settings' => 'weblite_nav_menu_reveal_direction',
      'type' => 'radio',
      'choices' => array(
        'from-top' => __('Top', 'plugerdy-responsive-nav'),
        'from-bottom' => __('Bottom', 'plugerdy-responsive-nav'),
        'from-center' => __('center', 'plugerdy-responsive-nav'),
        'from-right' => __('Right', 'plugerdy-responsive-nav'),
        'from-left' => __('Left', 'plugerdy-responsive-nav'),
      ),
    )
  );

  //
  // Width settings
  //
  $wp_customize->add_setting(
    'weblite_nav_menu_width',
    array(
      'transport' => 'postMessage',
      'sanitize_callback' => 'absint',
    )
  );
  $wp_customize->add_control(
    'weblite_nav_menu_width',
    array(
      'label' => __('Menu Width (%)', 'plugerdy-responsive-nav'),
      'description' => 'Defaults to min of 200px to stop menu overflow on small screens',
      'section' => 'weblite_nav_menu_settings',
      'settings' => 'weblite_nav_menu_width',
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
    'weblite_nav_menu_bg_color',
    array(
      'transport' => 'postMessage',
      'sanitize_callback' => 'sanitize_hex_color',
      'sanitize_js_callback' => 'maybe_hash_hex_color',
    )
  );
  $wp_customize->add_control(
    new WP_Customize_Color_Control(
      $wp_customize,
      'weblite_nav_menu_bg_color',
      array(
        'label' => __('Background Color', 'plugerdy-responsive-nav'),
        'section' => 'weblite_nav_menu_settings',
        'settings' => 'weblite_nav_menu_bg_color',
      )
    )
  );

  //
  // Opacity settings
  //
  $wp_customize->add_setting(
    'weblite_nav_menu_opacity',
    array(
      'transport' => 'postMessage',
      'sanitize_callback' => 'absint',
    )
  );
  $wp_customize->add_control(
    'weblite_nav_menu_opacity',
    array(
      'label' => __('Menu Opacity (%)', 'plugerdy-responsive-nav'),
      'section' => 'weblite_nav_menu_settings',
      'settings' => 'weblite_nav_menu_opacity',
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
  // Text color
  //
  $wp_customize->add_setting(
    'weblite_nav_menu_text_color',
    array(
      'transport' => 'postMessage',
      'sanitize_callback' => 'sanitize_hex_color',
      'sanitize_js_callback' => 'maybe_hash_hex_color',
    )
  );
  $wp_customize->add_control(
    new WP_Customize_Color_Control(
      $wp_customize,
      'weblite_nav_menu_text_color',
      array(
        'label' => __('Text Color', ''),
        'section' => 'weblite_nav_menu_settings',
        'settings' => 'weblite_nav_menu_text_color',
      )
    )
  );

  //
  // License settings
  //
  $wp_customize->add_setting(
    'weblite_nav_menu_license_key',
    array(
      'default' => 'WEBLITEABCD',
      'sanitize_callback' => 'sanitize_text_field',
    )
        );

  $wp_customize->add_control(
    'my_plugin_license_key',
    array(
      'label' => __('Enter your license key:', 'plugerdy-responsive-nav'),
      'section' => 'weblite_nav_menu_settings',
      'type' => 'text',
    )
  );

  //
  // Menu Animation
  //
  $wp_customize->add_setting(
    'weblite_nav_menu_animation',
    array(
      'default' => 'animation-off',
      'transport' => 'postMessage',
      'sanitize_callback' => 'sanitize_key',
    )
  );
  $wp_customize->add_control(
    'weblite_nav_menu_animation',
    array(
      'label' => __('Menu Animation', 'plugerdy-responsive-nav'),
      'section' => 'weblite_nav_menu_settings',
      'settings' => 'weblite_nav_menu_animation',
      'type' => 'radio',
      'choices' => array(
        'animation-off' => __('Off', 'plugerdy-responsive-nav'),
        'animation-on' => __('On', 'plugerdy-responsive-nav'),
      ),
    )
  );

}

/**
 * Enqueue customizer preview script.
 */
function weblite_nav_menu_enqueue_preview_script()
{
  wp_enqueue_script(
    'plugerdy-responsive-nav--preview',
    plugin_dir_url(__FILE__) . 'customize-preview.js', // Updated file path
    array('jquery', 'customize-preview'),
    false,
    true
  );
}
add_action('customize_preview_init', 'weblite_nav_menu_enqueue_preview_script');

/**
 * Output dynamic CSS based on Customizer settings.
 */
function weblite_nav_menu_dynamic_css()
{
  $menu_width = get_theme_mod('weblite_nav_menu_width');
  $menu_btn_size = get_theme_mod('weblite_nav_btn_size');
  $menu_btn_color = get_theme_mod('weblite_nav_btn_color');
  $menu_background = get_theme_mod('weblite_nav_menu_bg_color');
  $menu_opacity = get_theme_mod('weblite_nav_menu_opacity');
  $menu_color = get_theme_mod('weblite_nav_menu_text_color');

  $custom_css = ":root {";
  if ($menu_width)
    $custom_css .= "--plugerdy-responsive-nav-width: {$menu_width}vw;";
  if ($menu_btn_size)
    $custom_css .= "--plugerdy-nav-btn-size: {$menu_btn_size}px;";
  if ($menu_btn_color)
    $custom_css .= "--plugerdy-nav-btn-color: {$menu_btn_color};";
  if ($menu_background)
    $custom_css .= "--plugerdy-nav-btn-background-color: {$menu_background};";
  if ($menu_opacity)
    $menu_opacity = $menu_opacity / 100;
  $custom_css .= "--plugerdy-responsive-nav-opacity: {$menu_opacity};";
  if ($menu_color)
    $custom_css .= "--plugerdy-responsive-nav-color: {$menu_color};";
  $custom_css .= "}";

  if (!empty(trim($custom_css, ":root {};"))) {
    echo "<style type='text/css'>{$custom_css}</style>";
  }
}
add_action('wp_head', 'weblite_nav_menu_dynamic_css');

/**
 * Output premium dynamic CSS based on Customizer settings.
 */
function weblite_nav_menu_premium_dynamic_css()
{
  $menu_animation = get_theme_mod('weblite_nav_menu_animation');

  $custom_css = ":root {";
  if ($menu_animation)
    $custom_css .= "--plugerdy-responsive-nav-width: {$menu_width}vw;";

  if (!empty(trim($custom_css, ":root {};"))) {
    echo "<style type='text/css'>{$custom_css}</style>";
  }
}
add_action('wp_head', 'weblite_nav_menu_dynamic_css');


/**
 * Check if a valid license key is present and apply premium styles if verified.
 */
function weblite_nav_menu_widget_license_key($wp_customize)
{
  $license_key = get_theme_mod('weblite_nav_menu_widget_license_key');

  if (!empty($license_key) && my_plugin_verify_license($license_key)) {
    add_action('wp_head', 'weblite_nav_menu_premium_dynamic_css');
  }
}
add_action('customize_register', 'weblite_nav_menu_widget_license_key');


/**
 * Verify the license key against your server or local conditions
 */
function my_plugin_verify_license($license_key)
{
  $valid_keys = ['WEBLITEABCD', 'WEBLITE1234', 'WEBLITE4321'];

  // Check if the provided license key is in the array of valid keys
  return in_array($license_key, $valid_keys);
}
