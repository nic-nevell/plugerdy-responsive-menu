/**
 * Customizer preview setup for the Weblite Responsive Menu.
 *
 * @package Weblite_Nav_Menu_Widget\Customize_Preview
 */

(function ($) {
  // Live preview logic for  btn size
  wp.customize('weblite_nav_btn_size', function (value) {
    value.bind(function (to) {
      $('.plugerdy-btn-burger .bar').css('width', to)
    })
  })
  // Live preview logic for button  color
  wp.customize('weblite_nav_btn_color', function (value) {
    value.bind(function (to) {
      $('.plugerdy-btn-burger .bar').css('background-color', to)
    })
  })

  // Live preview logic for navigation menu background color
  wp.customize('weblite_nav_menu_bg_color', function (value) {
    value.bind(function (to) {
      $('.plugerdy-responsive-menu').css('background-color', to)
    })
  })

  // Live preview logic for navigation menu opacity
  wp.customize('weblite_nav_menu_opacity', function (value) {
    value.bind(function (to) {
      to = to / 100
      $('.plugerdy-responsive-menu').css('opacity', to)
    })
  })

  // Live preview logic for navigation menu text color
  wp.customize('weblite_nav_menu_text_color', function (value) {
    value.bind(function (to) {
      $('.plugerdy-responsive-menu a').css('color', to)
      $('.plugerdy-btn-burger .bar').css('background-color', to)
    })
  })

  // Live preview logic for navigation menu width
  wp.customize('weblite_nav_menu_width', function (value) {
    value.bind(function (to) {
      $('.plugerdy-responsive-menu').css('width', 'max(' + to + 'vw, 200px)')
    })
  })

  // Live preview logic for navigation menu reveal direction
  wp.customize('weblite_nav_menu_reveal_direction', function (value) {
    value.bind(function (to) {
      $('.plugerdy-responsive-menu')
        .removeClass('from-top from-bottom from-center from-right from-left')
        .addClass(to)

      // Check if aria-expanded is false
      if ($('.plugerdy-responsive-menu').attr('aria-expanded') === 'false') {
        // Trigger a click event on the burger button to open the menu
        $('#webliteNavMenuToggle').trigger('click')

      } else {
        // If aria-expanded is true, set it to false
        $('.plugerdy-responsive-menu').attr('aria-expanded', 'false')

        // Add a delay before setting aria-expanded to true
        setTimeout(() => {
          $('.plugerdy-responsive-menu').attr('aria-expanded', 'true')
        }, 250)
      }

    })
  })

  // Live preview logic for navigation menu reveal direction
  wp.customize('weblite_nav_menu_animation', function (value) {
    value.bind(function (to) {
      $('.plugerdy-responsive-menu')
        .removeClass('animation-off animation-on')
        .addClass(to)
    })
  })

})(jQuery)

