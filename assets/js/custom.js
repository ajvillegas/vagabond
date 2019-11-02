'use strict';

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

	if ( 100 < document.body.scrollTop || 100 < document.documentElement.scrollTop ) {
		topButton.style.display = 'block';
		header.classList.add( 'is-active', 'scroll-padding' );
	} else {
		topButton.style.display = 'none';
		header.classList.remove( 'scroll-padding' );

		if ( menu.classList.contains( 'show' ) ) {
			header.classList.add( 'is-active' );
		} else {
			header.classList.remove( 'is-active' );
		}
	}
}

function headerExpand() {
	jQuery( '#navbarSupportedContent' ).on( 'show.bs.collapse', function() {
		if ( 100 > window.pageYOffset ) {
			jQuery( '.site-header' ).addClass( 'is-active' );
		}
	});
	jQuery( '#navbarSupportedContent' ).on( 'hide.bs.collapse', function() {
		if ( 100 > window.pageYOffset ) {
			jQuery( '.site-header' ).removeClass( 'is-active' );
		}
	});
}

window.addEventListener( 'load', function() {
	scrollClasses();
	headerExpand();
	document.querySelector( '.to-top' ).addEventListener( 'click', scrollToTop );
});

window.onscroll = function() {
	scrollClasses();
};
'use strict';

( function() {
	var isIe = /(trident|msie)/i.test( navigator.userAgent );

	if ( isIe && document.getElementById && window.addEventListener ) {
		window.addEventListener( 'hashchange', function() {
			var id = location.hash.substring( 1 ),
				element;

			if ( ! /^[A-z0-9_-]+$/.test( id ) ) {
				return;
			}

			element = document.getElementById( id );

			if ( element ) {
				if ( ! /^(?:a|select|input|button|textarea)$/i.test( element.tagName ) ) {
					element.tabIndex = -1;
				}

				element.focus();
			}
		}, false );
	}
}() );
