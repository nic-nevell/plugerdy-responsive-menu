/**
 * Handles the click event on the toggle button.
 */

// Get references to DOM elements
const widget = document.getElementById('plugerdyResponsiveMenu')
const btn = document.querySelector('#webliteNavMenuToggle')
const navMenu = document.querySelector('#webliteNavMenu')
const docBody = document.body


// Function to handle clicks
function webliteNavMenuHandleClick() {
  // Initialize ariaExpanded variable
  let ariaExpanded = btn.getAttribute('aria-expanded')

  // Toggle 'plugerdy-responsive-menu-body-no-scroll' class on the <body> element to enable/disable scrolling.
  docBody.classList.toggle('plugerdy-responsive-menu-body-no-scroll')

  // Determine the new value of ariaExpanded attribute
  // Update the aria-expanded attribute of the button and navigation menu
  const newAriaExpanded = ariaExpanded === 'true' ? 'false' : 'true'

  btn.setAttribute('aria-expanded', newAriaExpanded)
  navMenu.setAttribute('aria-expanded', newAriaExpanded)

  // Calculate the height of the WordPress admin bar if present
  let adminBarHeight = NaN
  if (docBody.classList.contains('admin-bar')) {
    adminBarHeight = document.getElementById('wpadminbar').clientHeight
  }

  // If the navigation menu is aria-expanded = true
  // Move the toggle button and navigation menu back to the widget
  // Remove style adjustments added when menu is expanded
  // Remove resize event listener
  if (ariaExpanded === 'true') {
    navMenu.style.marginTop = ''
    navMenu.style.zIndex = ''

    widget.appendChild(btn)
    widget.appendChild(navMenu)

    window.removeEventListener('resize', webliteNavMenuHandleClick)

  }

  // If the navigation menu is aria-expanded = false
  // Move the toggle button and navigation menu to the body
  // Make style adjustment as need
  // add resize event listener to the window, closes the menu to eliminate unwanted behavior
  if (ariaExpanded === 'false') {
    if (adminBarHeight) {
      navMenu.style.marginTop = `${adminBarHeight}px`
    }
    navMenu.style.zIndex = '10000'

    docBody.appendChild(navMenu)
    navMenu.appendChild(btn)

    window.addEventListener('resize', webliteNavMenuHandleClick)
  }

  // Update the value of ariaExpanded for the next click event
  ariaExpanded = newAriaExpanded
}

// Attach click event listener to the toggle button
if (btn) btn.addEventListener('click', webliteNavMenuHandleClick)



