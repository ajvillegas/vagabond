/**
 * The scrolling functionality of the website.
 *
 * @package    Vagabond
 * @author     Alexis J. Villegas
 * @link       http://www.alexisvillegas.com
 * @license    GPL-2.0+
 */

function scrollToTop() {
	var element = document.querySelector( 'body' ).offsetTop;

	window.scroll({
		top: element,
		left: 0,
		behavior: 'smooth'
	});
}

function scrollClasses() {
	var header = document.querySelector( '.site-header' );
	var menu = document.querySelector( '#navbarSupportedContent' );
	var topButton = document.querySelector( '.to-top' );

	// When the user scrolls down 100px from the top of the document.
	if ( 100 < document.body.scrollTop || 100 < document.documentElement.scrollTop ) {

		// Display scroll button.
		topButton.style.display = 'block';

		// Add .is-active and .scroll-padding classes to header.
		header.classList.add( 'is-active', 'scroll-padding' );
	} else {

		// Hide scroll button.
		topButton.style.display = 'none';

		// Remove .scroll-padding class from header.
		header.classList.remove( 'scroll-padding' );

		if ( menu.classList.contains( 'show' ) ) {

			// Add .is-active class to header.
			header.classList.add( 'is-active' );
		} else {

			// Remove .is-active class from header.
			header.classList.remove( 'is-active' );
		}
	}
}

function headerExpand() {

	// Hook into the Bootstrap collapse show event.
	jQuery( '#navbarSupportedContent' ).on( 'show.bs.collapse', function() {

		// Check if document window is scrolled less than 100px.
		if ( 100 > window.pageYOffset ) {
			jQuery( '.site-header' ).addClass( 'is-active' );
		}
	});

	// Hook into the Bootstrap collapse hide event.
	jQuery( '#navbarSupportedContent' ).on( 'hide.bs.collapse', function() {

		// Check if document window is scrolled less than 100px.
		if ( 100 > window.pageYOffset ) {
			jQuery( '.site-header' ).removeClass( 'is-active' );
		}
	});
}

// When the DOM is loaded, add click handler to scroll button.
window.addEventListener( 'load', function() {
	scrollClasses();
	headerExpand();
	document.querySelector( '.to-top' ).addEventListener( 'click', scrollToTop );
});

// When the user scrolls, call function to toggle classes.
window.onscroll = function() {
	scrollClasses();
};
