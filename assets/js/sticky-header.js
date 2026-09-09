/**
 * Tell the sticky header when it has left the top of the page.
 *
 * The header is sticky in CSS with no help from here. All this adds is the
 * `cz-stuck` class that earns it a shadow, so the page still works with the
 * script blocked or failed - it just never gets the depth cue.
 *
 * A one-pixel sentinel plus IntersectionObserver rather than a scroll
 * listener: the observer fires twice per page (on the way out of view and back
 * in) instead of on every frame of every scroll, which keeps this off the main
 * thread during scrolling entirely.
 *
 * @package CozmicBlockTheme
 */

( function () {
	'use strict';

	var header = document.querySelector( '.wp-site-blocks > header.wp-block-template-part' );

	if ( ! header || ! ( 'IntersectionObserver' in window ) ) {
		return;
	}

	var sentinel = document.createElement( 'div' );
	sentinel.setAttribute( 'aria-hidden', 'true' );
	sentinel.style.cssText = 'position:absolute;top:0;left:0;height:1px;width:1px;pointer-events:none;';
	header.parentNode.insertBefore( sentinel, header );

	new IntersectionObserver(
		function ( entries ) {
			header.classList.toggle( 'cz-stuck', ! entries[ 0 ].isIntersecting );
		},
		{ threshold: 0 }
	).observe( sentinel );
}() );
