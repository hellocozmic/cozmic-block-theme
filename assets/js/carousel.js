/**
 * Carousel dots and auto-advance.
 *
 * The carousel already works without this file: the track is a CSS
 * scroll-snap container, so it swipes, scrolls and tabs on its own, and every
 * slide is in the document. This adds the dots, keeps them in sync, and
 * advances the slides on a timer.
 *
 * Deliberately not a slider library. A client site should not download one to
 * move three panels sideways, and anything that hides content until JavaScript
 * runs is the wrong trade on a site whose whole job is being readable.
 *
 * @package CozmicBlockTheme
 */

( function () {
	'use strict';

	var INTERVAL = 6000;

	var reduceMotion = window.matchMedia
		? window.matchMedia( '(prefers-reduced-motion: reduce)' )
		: { matches: false };

	/**
	 * Wire one carousel.
	 *
	 * @param {HTMLElement} root Element carrying .cz-carousel.
	 */
	function setup( root ) {
		var track = root.querySelector( '.cz-carousel__track' );

		if ( ! track ) {
			return;
		}

		var slides = Array.prototype.slice.call(
			track.querySelectorAll( '.cz-carousel__slide' )
		);

		if ( slides.length < 2 ) {
			return;
		}

		root.setAttribute( 'aria-roledescription', 'carousel' );

		slides.forEach( function ( slide, i ) {
			slide.setAttribute( 'role', 'group' );
			slide.setAttribute( 'aria-roledescription', 'slide' );
			slide.setAttribute( 'aria-label', i + 1 + ' of ' + slides.length );
		} );

		var dots = document.createElement( 'div' );
		dots.className = 'cz-carousel__dots';
		dots.setAttribute( 'role', 'tablist' );
		dots.setAttribute( 'aria-label', 'Choose a slide' );

		var buttons = slides.map( function ( slide, i ) {
			var dot = document.createElement( 'button' );
			dot.type = 'button';
			dot.className = 'cz-carousel__dot';
			dot.setAttribute( 'role', 'tab' );
			dot.setAttribute( 'aria-label', 'Slide ' + ( i + 1 ) );
			dot.addEventListener( 'click', function () {
				// scrollLeft rather than scrollIntoView: the latter also
				// scrolls the *page* to bring the carousel into view, which
				// yanks the viewport when a dot is clicked near the fold.
				track.scrollLeft = slide.offsetLeft - track.offsetLeft;
				stop();
			} );
			dots.appendChild( dot );
			return dot;
		} );

		root.appendChild( dots );

		var current = 0;

		function mark( index ) {
			current = index;
			buttons.forEach( function ( dot, i ) {
				dot.setAttribute( 'aria-current', i === index ? 'true' : 'false' );
				dot.setAttribute( 'aria-selected', i === index ? 'true' : 'false' );
			} );
		}

		mark( 0 );

		// Which slide is showing, read from the scroll position rather than
		// tracked in a variable, so a swipe or a trackpad scroll updates the
		// dots exactly like a click does.
		if ( 'IntersectionObserver' in window ) {
			var spy = new IntersectionObserver(
				function ( entries ) {
					entries.forEach( function ( entry ) {
						if ( entry.isIntersecting ) {
							mark( slides.indexOf( entry.target ) );
						}
					} );
				},
				{ root: track, threshold: 0.6 }
			);

			slides.forEach( function ( slide ) {
				spy.observe( slide );
			} );
		}

		var timer = null;

		function advance() {
			var next = slides[ ( current + 1 ) % slides.length ];
			track.scrollLeft = next.offsetLeft - track.offsetLeft;
		}

		function start() {
			if ( timer || reduceMotion.matches ) {
				return;
			}
			timer = window.setInterval( advance, INTERVAL );
		}

		function stop() {
			if ( timer ) {
				window.clearInterval( timer );
				timer = null;
			}
		}

		// Any sign of intent stops the timer for good. Content sliding away
		// mid-sentence is the single most irritating thing a carousel does.
		[ 'pointerdown', 'touchstart', 'keydown', 'focusin' ].forEach( function ( type ) {
			root.addEventListener( type, stop, { passive: true } );
		} );

		root.addEventListener( 'mouseenter', stop );

		document.addEventListener( 'visibilitychange', function () {
			if ( document.hidden ) {
				stop();
			}
		} );

		start();
	}

	document.querySelectorAll( '.cz-carousel' ).forEach( setup );
}() );
