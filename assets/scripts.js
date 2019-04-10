( function ( $ ) {

	$( '[data-var-idx]' ).on( 'click', function ( e ) {
		e.preventDefault();

		var _this = $( this );
		var _select = $( 'table.variations select:first' );
		var _idx = parseInt( _this.attr( 'data-var-idx' ) ) + 1;

		if( _this.hasClass( 'active' ) ) {

			_this.removeClass( 'active' ).blur();
			_idx = 0;

		} else {

			_this.parents( '.visual-variations' ).find( 'li button' ).removeClass( 'active' );
			_this.addClass( 'active' );

		}

		_select.find( 'option' ).eq( _idx ).attr( 'selected', true );
		_select.trigger( 'change' );

	} );

} )( jQuery );