<?php
/**
 * Plugin Name: Plugerdy Responsive Menu
 * Description: Adds a responsive navigation menu widget to your WordPress site.
 * Version: 1.0.0
 * Author: Nic Nevell
 * Author URI: https://plugerdy.com
 * Text Domain: plugerdy-responsive-menu
 */

// Include Customizer settings
require_once plugin_dir_path(__FILE__) . 'includes/customizer.php';

class Plugerdy_Responsive_Menu extends WP_Widget {
  
  public function __construct() {
    $id_base = 'plugerdy_responsive_menu_widget'; // A unique identifier for the widget
    $name = __( 'Plugerdy Responsive Menu Widget' ); // The name of the widget

    $options = array(
      'description' => __( 'Adds a responsive navigation menu to your wordpress site.' ), 
      // 'customize_selective_refresh' => true,
      // 'show_instance_in_rest' => true,
      'classname' => 'plugerdy-responsive-menu-widget' // Optional CSS class
    ); // An array of options to configure the widget

    parent::__construct(
      $id_base,
      $name,
      $options
     );

    // Add assets (CSS, JS, etc.)
    add_action('wp_enqueue_scripts', array($this, 'load_assets'));
  }

  /**
   * Widget output function.
   *
   * @param array $args Widget arguments.
   * @param array $instance Widget instance.
   */
  public function widget($args, $instance) {
    // Get the selected reveal direction from Customizer settings
   $reveal_direction = get_theme_mod( 'weblite_nav_menu_reveal_direction' );
   $premium_animation = get_theme_mod( 'weblite_nav_menu_animation');
   
    // Output widget container
    echo $args['before_widget'];


    // Output navigation menu container
    echo '<div id="plugerdyResponsiveMenu">';

    // Output burger button for toggling the menu
    echo '<button class="plugerdy-btn-burger" aria-expanded="false" aria-controls="webliteNavMenu" id="webliteNavMenuToggle" aria-label="toggle for navigation menu">';
    echo '<span class="bar bar-top"></span>';
    echo '<span class="bar bar-middle"></span>';
    echo '<span class="bar bar-bottom"></span>';
    echo '</button>';

    // Output navigation menu
    // echo '<nav class="plugerdy-responsive-menu ' . esc_attr( $reveal_direction ) . '" id="webliteNavMenu" aria-expanded="false">';

    echo '<nav class="plugerdy-responsive-menu ' . esc_attr($reveal_direction) . ' ' . esc_attr($premium_animation) . '" id="webliteNavMenu" aria-expanded="false">';
    wp_nav_menu(array(
      'theme_location' => 'nav-widget',
      // 'menu_class' => 'nav-widget-menu',
      'container' => 'ul', // Remove default container
    ));
    echo '</nav>';

    // Close navigation menu container
    echo '</div>';

    // Output widget closing container
    echo $args['after_widget'];
  }

  /**
   * Enqueue assets (CSS, JS, etc.).
   */
  public function load_assets() {
    // Enqueue CSS with versioning based on file modification time
    wp_enqueue_style(
      'weblite_nav_menu_css', // Handle for the stylesheet
      plugin_dir_url(__FILE__) . 'assets/css/style.css', // URL of the CSS file
      array(), // Dependencies (none in this case)
      filemtime(plugin_dir_path(__FILE__) . 'assets/css/style.css'), // Version number based on file modification time
      'all' // Media type (applies to all media types)
    );

    // Enqueue JavaScript with versioning based on file modification time
    wp_enqueue_script(
      'weblite_nav_menu_js', // Handle for the script
      plugin_dir_url(__FILE__) . 'assets/js/main.js', // URL of the JavaScript file
      array('jquery'), // Dependencies (jQuery in this case)
      filemtime(plugin_dir_path(__FILE__) . 'assets/js/main.js'), // Version number based on file modification time
      true // Add to footer
    );

}
  /**
   * Widget form function.
   *
   * @param array $instance Widget instance.
   */
  public function form($instance) {
    // Widget form fields
    // You can add form fields here if needed
  }

  /**
   * Update widget settings.
   *
   * @param array $new_instance New widget instance.
   * @param array $old_instance Old widget instance.
   */
  public function update($new_instance, $old_instance) {
    // Update widget settings
    // You can add update logic here if needed
  }
}

/**
 * Register Weblite Nav Menu Widget.
 */
function register_plugerdy_responsive_menu() {
  register_widget('Plugerdy_Responsive_Menu');
}
add_action('widgets_init', 'register_plugerdy_responsive_menu');
