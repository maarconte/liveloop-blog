jQuery(document).ready(function() {
$( '.toggle-video' ).click(function() {
  $(this).parentsUntil('.posts-agenda').find( '.embed-container' ).fadeToggle( 'slow' );
});

});
