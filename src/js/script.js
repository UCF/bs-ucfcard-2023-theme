//
// Import third-party assets
//

// ...


//
// Project-specific scripts
//

// Require your theme's custom script files here
// ...
jQuery(document).ready(($) => {
  $('#staffToggle, #badgeToggle').on('click', function (event) {
    event.preventDefault(); // Prevent default behavior of the anchor tag

    const targetForm = $(this).attr('id') === 'staffToggle' ? '#staffForm' : '#badgeForm';
    const otherForm = $(this).attr('id') === 'staffToggle' ? '#badgeForm' : '#staffForm';

    if ($(targetForm).hasClass('show')) {
      $(targetForm).collapse('hide');
    } else {
      $(targetForm).collapse('show');
      $(otherForm).collapse('hide');
    }
  });
});
