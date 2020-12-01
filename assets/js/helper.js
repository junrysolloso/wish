( function() {

  if ( $('.alert-temp' ).length ) {
    setTimeout( function() {
      $( '.alert-temp' ).remove();
    }, 3000 );
  }

  if( $('.form-update').length ) {
    $( '.form-add' ).css( 'display', 'none' );
  }

})(jQuery);