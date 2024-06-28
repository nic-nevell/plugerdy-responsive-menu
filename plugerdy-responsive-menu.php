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
require_once plugin_dir_path(__FILE__) . 'includes/customizer/customizer.php';

class Plugerdy_Responsive_Menu extends WP_Widget
{

    public function __construct()
    {
        $id_base = 'plugerdy-responsive-menu-widget'; // A unique identifier for the widget
        $name = __('Plugerdy Responsive Menu Widget'); // The name of the widget

        $options = array(
            'description' => __('Adds a responsive navigation menu to your WordPress site.'),
            // 'customize_selective_refresh' => true,
            // 'show_instance_in_rest' => true,
            'classname' => 'plugerdy-responsive-menu-widget', // Optional CSS class
        ); // An array of options to configure the widget

        parent::__construct(
            $id_base,
            $name,
            $options
        );

        // Add assets (CSS, JS, etc.)
        add_action('wp_enqueue_scripts', array($this, 'load_assets'));
        add_action('wp_head', array($this, 'output_dynamic_css'));
    }

    /**
     * Enqueue assets (CSS, JS, etc.).
     * 
     * @return void
     */
    public function load_assets()
    {
        // Enqueue CSS with versioning based on file modification time
        wp_enqueue_style(
            'plugerdy_responsive_menu_css', // Handle for the stylesheet
            plugin_dir_url(__FILE__) . 'assets/css/style.css', // URL of the CSS file
            array(), // Dependencies (none in this case)
            filemtime(plugin_dir_path(__FILE__) . 'assets/css/style.css'), // Version number based on file modification time
            'all' // Media type (applies to all media types)
        );

        // Enqueue JavaScript with versioning based on file modification time
        wp_enqueue_script(
            'plugerdy_responsive_menu_js', // Handle for the script
            plugin_dir_url(__FILE__) . 'assets/js/main.js', // URL of the JavaScript file
            array('jquery'), // Dependencies (jQuery in this case)
            filemtime(plugin_dir_path(__FILE__) . 'assets/js/main.js'), // Version number based on file modification time
            true// Add to footer
        );
    }

    /**
     * Output dynamic CSS based on Customizer settings.
     * 
     *@return void
     */
    public function output_dynamic_css()
    {
        $menu_width = get_theme_mod('plugerdy_responsive_menu_width');
        $menu_btn_size = get_theme_mod('plugerdy_responsive_menu_btn_size');
        $menu_btn_color = get_theme_mod('plugerdy_responsive_menu_btn_color');
        $menu_background = get_theme_mod('plugerdy_responsive_menu_bg_color');
        $menu_opacity = get_theme_mod('plugerdy_responsive_menu_opacity');
        $menu_color = get_theme_mod('plugerdy_responsive_menu_text_color');
        $menu_font_weight = get_theme_mod('plugerdy_responsive_menu_font_weight');
        $menu_font_size = get_theme_mod('plugerdy_responsive_menu_font_size');
        $menu_link_spacing = get_theme_mod('plugerdy_responsive_menu_link_spacing');

        $custom_css = ":root {";
        if ($menu_width) {
            $custom_css .= "--plugerdy-responsive-menu-width: {$menu_width}vw;";
        }

        if ($menu_btn_size) {
            $custom_css .= "--plugerdy-responsive-menu-btn-size: {$menu_btn_size}px;";
        }

        if ($menu_btn_color) {
            $custom_css .= "--plugerdy-responsive-menu-btn-color: {$menu_btn_color};";
        }

        if ($menu_background) {
            $custom_css .= "--plugerdy-responsive-menu-bg-color: {$menu_background};";
        }

        if ($menu_opacity) {
            $menu_opacity = $menu_opacity / 100;
            $custom_css .= "--plugerdy-responsive-menu-opacity: {$menu_opacity};";
        }

        if ($menu_color) {
            $custom_css .= "--plugerdy-responsive-menu-color: {$menu_color};";
        }

        if ($menu_font_weight) {
            $custom_css .= "--plugerdy-responsive-menu-font-weight: {$menu_font_weight};";
        }

        if ($menu_font_size) {
            $menu_font_size .= 'px';
            $custom_css .= "--plugerdy-responsive-menu-font-size: {$menu_font_size}";
        }

        if ($menu_link_spacing) {
            $menu_link_spacing .= 'px';
            $custom_css .= "--plugerdy-responsive-menu-link-spacing: {$menu_link_spacing}";
        }

        $custom_css .= "}";

        if (!empty(trim($custom_css, ":root {};"))) {
            echo '<!-- Plugerdy Responsive Menu CSS -->';
            echo "<style type='text/css'>{$custom_css}</style>";
        }
    }

    /**
     * Widget output function.
     *
     * @param array $args Widget arguments.
     * @param array $instance Widget instance.
     */
    public function widget($args, $instance)
    {
        // Get the selected reveal direction from Customizer settings
        $reveal_direction = get_theme_mod('plugerdy_responsive_nav_reveal_direction', 'from-right');
        $premium_animation = get_theme_mod('plugerdy_responsive_menu_animation');

        $nav_shadow= get_theme_mod('plugerdy_responsive_menu_shadow');

        // Get the selected menu ID
        $nav_menu = !empty($instance['nav_menu']) ? $instance['nav_menu'] : '';

        // Output widget container
        echo $args['before_widget'];

        echo $this->load_content($reveal_direction, $premium_animation, $nav_menu, $nav_shadow);

        // Output widget closing container
        echo $args['after_widget'];
    }

    /**
     * Widget frontend content
     *
     * @param string $reveal_direction The direction the menu reveals from.
     * @param string $premium_animation The premium animation class for the menu.
     * @param string $nav_menu The ID of the selected navigation menu.
     */
    public function load_content($reveal_direction, $premium_animation, $nav_menu, $nav_shadow)
    {
        // Output navigation menu container
        ob_start();
        ?>
        <div id="plugerdy-responsive-menu">
            <!-- Output burger button for toggling the menu -->
            <button class="plugerdy-btn-burger" aria-expanded="false" aria-controls="plugerdy-responsive-nav" id="plugerdy-nav-toggle" aria-label="toggle for navigation menu">
                <span class="bar bar-top"></span>
                <span class="bar bar-middle"></span>
                <span class="bar bar-bottom"></span>
            </button>

            <!-- Output navigation menu -->
            <nav class="plugerdy-responsive-nav <?php echo esc_attr($reveal_direction); ?> <?php echo esc_attr($premium_animation); ?> <?php echo esc_attr($nav_shadow); ?>" id="plugerdy-responsive-nav" aria-expanded="false">
            <?php
                wp_nav_menu(array(
                    'menu' => $nav_menu, // Use the selected menu ID
                    'container' => 'ul', // Remove default container
                ));
            ?>
            </nav>
        </div>
        <?php
        return ob_get_clean();
    }


/**
 * Widget form function.
 *
 * @param array $instance Widget instance.
 */
    public function form($instance)
    {
        global $wp_customize;
        $nav_menu = isset($instance['nav_menu']) ? $instance['nav_menu'] : '';
        // URL for the thumbnail image
        $thumbnail_url = plugin_dir_url(__FILE__) . 'assets/images/thumbnail.png';

        // Get menus.
        $menus = wp_get_nav_menus();

        $empty_menus_style = '';
        $not_empty_menus_style = '';
        if (empty($menus)) {
            $empty_menus_style = ' style="display:none" ';
        } else {
            $not_empty_menus_style = ' style="display:none" ';
        }

        $nav_menu_style = '';
        if (!$nav_menu) {
            $nav_menu_style = 'display: none;';
        }

        // If no menus exist, direct the user to go and create some.
        ?>
    <p class="nav-menu-widget-no-menus-message" <?php echo $not_empty_menus_style; ?>>
        <?php
if ($wp_customize instanceof WP_Customize_Manager) {
            $url = 'javascript: wp.customize.panel( "nav_menus" ).focus();';
        } else {
            $url = admin_url('nav-menus.php');
        }

        printf(
            /* translators: %s: URL to create a new menu. */
            __('No menus have been created yet. <a href="%s">Create some</a>.'),
            // The URL can be a `javascript:` link, so esc_attr() is used here instead of esc_url().
            esc_attr($url)
        );
        ?>
    </p>
    <div class="nav-menu-widget-form-controls" <?php echo $empty_menus_style; ?>>
        <!-- Add the thumbnail preview -->
        <p>
            <label><?php _e('Preview:');?></label>
            <img  src="<?php echo esc_url($thumbnail_url); ?>" alt="<?php _e('Widget Thumbnail');?>"/>
        </p>
        <p>
            <label for="<?php echo $this->get_field_id('nav_menu'); ?>">
                <?php _e('Select Menu:');?>
            </label>
            <select id="<?php echo $this->get_field_id('nav_menu'); ?>" name="<?php echo $this->get_field_name('nav_menu'); ?>">
                <option value="0"><?php _e('&mdash; Select &mdash;');?></option>
                <?php foreach ($menus as $menu): ?>
                    <option value="<?php echo esc_attr($menu->term_id); ?>" <?php selected($nav_menu, $menu->term_id);?>>
                        <?php echo esc_html($menu->name); ?>
                    </option>
                <?php endforeach;?>
            </select>

            <br>
                <button type="button" class="button" onclick="window.location.href='<?php echo esc_url(admin_url('nav-menus.php')); ?>';"><?php _e('Or Create/Edit Menu here');?></button>
                <br>
            </p>
        <?php if ($wp_customize instanceof WP_Customize_Manager): ?>
            <p class="edit-selected-nav-menu" style="<?php echo $nav_menu_style; ?>">&nbs
            <button type="button" class="button" onclick="window.location.href='<?php echo esc_url(admin_url('nav-menus.php')); ?>';"><?php _e('Create Menu');?></button>
            </p>
        <?php endif;?>
    </div>
    <?php
}

    /**
     * Update widget settings.
     *
     * @param array $new_instance New widget instance.
     * @param array $old_instance Old widget instance.
     * @return array Updated widget instance.
     */
    public function update($new_instance, $old_instance)
    {
        $instance = array();
        $instance['nav_menu'] = (!empty($new_instance['nav_menu'])) ? strip_tags($new_instance['nav_menu']) : '';
        return $instance;
    }
}

/**
 * Register Plugerdy Responsive Menu Widget.
 */
function register_plugerdy_responsive_menu()
{
    register_widget('Plugerdy_Responsive_Menu');
}
add_action('widgets_init', 'register_plugerdy_responsive_menu');
