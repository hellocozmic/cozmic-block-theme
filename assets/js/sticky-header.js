/**
 * Sticky header: the shadow cue, and the header's height as a CSS variable.
 *
 * The header is sticky in CSS with no help from here. This adds the
 * `cz-stuck` class that earns it a shadow and a compact size, and publishes
 * the header's height as `--cz-header-height` so a hero can fill exactly the
 * rest of the first screen. With the script blocked the page still works: the
 * header never gains its shadow, and the hero uses the fallback height that
 * style.css computes.
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

	if ( ! header ) {
		return;
	}

	var root = document.documentElement;
	var queued = false;

	/*
	 * Measured only while the header is at full size. Once it sticks it
	 * compacts, and a hero sized against the compact height would overshoot
	 * the first screen it is meant to fill.
	 */
	function measure() {
		queued = false;
		if ( ! header.classList.contains( 'cz-stuck' ) ) {
			root.style.setProperty( '--cz-header-height', header.offsetHeight + 'px' );
		}
	}

	function queue() {
		if ( ! queued ) {
			queued = true;
			window.requestAnimationFrame( measure );
		}
	}

	measure();
	window.addEventListener( 'resize', queue, { passive: true } );
	// Web fonts can re-wrap the menu after first paint.
	window.addEventListener( 'load', queue );

	if ( ! ( 'IntersectionObserver' in window ) ) {
		return;
	}

	/*
	 * The sentinel goes at the very top of <body>, never beside the header.
	 * It used to be inserted into .wp-site-blocks, where it became the first
	 * child - which made the header the *second* child, and WordPress's root
	 * blockGap, zeroed only on :first-child, came back as a margin above it.
	 */
	var sentinel = document.createElement( 'div' );
	sentinel.setAttribute( 'aria-hidden', 'true' );
	sentinel.style.cssText = 'position:absolute;top:0;left:0;height:1px;width:1px;pointer-events:none;';
	document.body.insertBefore( sentinel, document.body.firstChild );

	new IntersectionObserver(
		function ( entries ) {
			header.classList.toggle( 'cz-stuck', ! entries[ 0 ].isIntersecting );
		},
		{ threshold: 0 }
	).observe( sentinel );
}() );
