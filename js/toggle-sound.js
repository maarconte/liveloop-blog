jQuery(document).ready(function() {
$( '.toggle-sound' ).click(function() {
  $(this).parentsUntil('.posts-agenda').find( '.embed-container' ).fadeToggle( 'slow' );
});

});
