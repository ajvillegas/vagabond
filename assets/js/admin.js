/**
 * JS functionality for the theme's admin.
 *
 * @package    Vagabond
 * @author     Alexis J. Villegas
 * @link       http://www.alexisvillegas.com
 * @license    GPL-2.0+
 */

( function( $ ) {
	'use strict';

	$( document ).ready( function() {

		/**
		 * Layout Settings meta box functionality.
		 *
		 * @since	1.0.0
		 */

		// Add .selected class if a layout input is checked.
		$( '#vagabond-layout-meta-box input[type="radio"]' )
			.filter( ':checked' )
			.each( function( index ) {
				$( this )
					.parent( 'label' )
					.addClass( 'selected' );
			});

		// Remove current .selected class then add to new selected layout.
		$( '#vagabond-layout-meta-box .box' ).on( 'change', function() {

			// Remove class from label.
			$( 'input[name="' + $( event.target ).attr( 'name' ) + '"]' )
				.parent( 'label' )
				.removeClass( 'selected' );

			// Add class to selected layout.
			$( event.currentTarget ).addClass( 'selected' );
		});
	});
}( jQuery ) );
