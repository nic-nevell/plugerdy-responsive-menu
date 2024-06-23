/**
 * Customizer preview setup for Plugerdy Responsive Menu.
 *
 * @package plugerdy_responsive_menu_Widget\Customize_Preview
 */

(function ($) {
   // Get the base font size of the site
  var baseFontSize = parseFloat($('body').css('font-size'));
  
  // Live preview logic for  btn size
  wp.customize('plugerdy_responsive_menu_btn_size', function (value) {
    value.bind(function (to) {
      $('.plugerdy-btn-burger .bar').css('width', to)
    })
  })
  // Live preview logic for button color
  wp.customize('plugerdy_responsive_menu_btn_color', function (value) {
    value.bind(function (to) {
      $('.plugerdy-btn-burger .bar').css('background-color', to)
    })
  })

  // Live preview logic for navigation menu background color
  wp.customize('plugerdy_responsive_menu_bg_color', function (value) {
    value.bind(function (to) {
      $('.plugerdy-responsive-nav').css('background-color', to)
    })
  })

  // Live preview logic for navigation menu opacity
  wp.customize('plugerdy_responsive_menu_opacity', function (value) {
    value.bind(function (to) {
      $('.plugerdy-responsive-nav').css('opacity', to)
    })
  })

  // Live preview logic for navigation menu font weight
  wp.customize('plugerdy_responsive_menu_font_weight', function (value) {
    value.bind(function (to) {
        $('.plugerdy-responsive-nav').css('font-weight', to);
    });
  });

  // Live preview logic for navigation menu font size
  wp.customize('plugerdy_responsive_menu_font_size', function (value) {
    value.bind(function (to) {
      var emValue = to / baseFontSize;
      $('.plugerdy-responsive-nav a').css('font-size', emValue + 'em');
    });
  });

  
  // Live preview logic for navigation menu text color
  wp.customize('plugerdy_responsive_menu_text_color', function (value) {
    value.bind(function (to) {
      $('.plugerdy-responsive-nav a').css('color', to)
      $('.plugerdy-btn-burger .bar').css('background-color', to)
    })
  })

  // Live preview logic for navigation menu width
  wp.customize('plugerdy_responsive_menu_width', function (value) {
    value.bind(function (to) {
      $('.plugerdy-responsive-nav').css('width', 'max(' + to + 'vw, 200px)')
    })
  })

  // Live preview logic for navigation menu reveal direction
  wp.customize('plugerdy_responsive_nav_reveal_direction', function (value) {
    value.bind(function (to) {
      $('.plugerdy-responsive-nav')
        .removeClass('from-top from-bottom from-center from-right from-left')
        .addClass(to)

      // Check if aria-expanded is false
      if ($('.plugerdy-responsive-nav').attr('aria-expanded') === 'false') {
        // Trigger a click event on the burger button to open the menu
        $('#plugerdy_nav_toggle').trigger('click')

      } else {
        // If aria-expanded is true, set it to false
        $('.plugerdy-responsive-nav').attr('aria-expanded', 'false')

        // Add a delay before setting aria-expanded to true
        setTimeout(() => {
          $('.plugerdy-responsive-nav').attr('aria-expanded', 'true')
        }, 250)
      }

    })
  })

  // Live preview logic for navigation menu reveal direction
  wp.customize('plugerdy_responsive_menu_animation', function (value) {
    value.bind(function (to) {
      $('.plugerdy-responsive-nav')
        .removeClass('animation-off animation-on')
        .addClass(to)

           // Check if aria-expanded is false
           if ($('.plugerdy-responsive-nav').attr('aria-expanded') === 'false') {
            // Trigger a click event on the burger button to open the menu
            $('#plugerdy_nav_toggle').trigger('click')
    
          } else {
            // If aria-expanded is true, set it to false
            $('.plugerdy-responsive-nav').attr('aria-expanded', 'false')
    
            // Add a delay before setting aria-expanded to true
            setTimeout(() => {
              $('.plugerdy-responsive-nav').attr('aria-expanded', 'true')
            }, 250)
          }
    })
  })

})(jQuery)

