//
// Import third-party assets
//
// ...


//
// Project-specific scripts
//

// Require your theme's custom script files here
// ...

/**
 * Button toggles for Departments page
 *
 * @since 0.1.3
 * @author Mike Setzer
 **/
jQuery(document).ready(($) => {
  $('#staffToggle, #badgeToggle').on('click', function (event) {
    event.preventDefault(); // Prevent default behavior of the anchor tag

    // Set the target form and the collapsing form
    const targetForm = $(this).attr('id') === 'staffToggle' ? '#staffForm' : '#badgeForm';
    const otherForm = $(this).attr('id') === 'staffToggle' ? '#badgeForm' : '#staffForm';

    // Show the correct form, hide the others
    if ($(targetForm).hasClass('show')) {
      $(targetForm).collapse('hide');
    } else {
      $(targetForm).collapse('show');
      $(otherForm).collapse('hide');
    }
    $('html, body').anima1te({
      scrollTop: $('#formContainer').offset().top
    }, 500);
  });
});
