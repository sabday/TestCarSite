jQuery(function( $ ) {

    // настройка
    wp.customize( 'header_phone', function( value ) {
        value.bind( function( newVal ) {
            $( '#header_phone' ).text( newVal );
        });
    });

});