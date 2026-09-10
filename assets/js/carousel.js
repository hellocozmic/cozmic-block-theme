/**
 * Carousel: slide indicators, mouse drag, and auto-advance.
 *
 * The carousel already works without this file: the track is a CSS
 * scroll-snap container, so it swipes, scrolls and tabs on its own, and every
 * slide is in the document. This adds the indicator dots and keeps them in
 * sync, lets a mouse drag the strip, and advances the slides on a timer.
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

	// Pixels of travel before a press becomes a drag. Below it the press is
	// still a click, so anything clickable inside a slide keeps working.
	var DRAG_THRESHOLD = 5;

	// Share of a slide the drag must cover to commit to the next one.
	// Nearest-snap alone would demand half a slide, which feels like the
	// carousel is resisting the hand.
	var COMMIT = 0.2;

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

		// Where slide i sits in the strip's scroll coordinates. offsetLeft is
		// layout position, so it does not move as the strip scrolls.
		function leftOf( i ) {
			return slides[ i ].offsetLeft - track.offsetLeft;
		}

		// scrollLeft rather than scrollIntoView: the latter also scrolls the
		// *page* to bring the carousel into view, which yanks the viewport
		// when a dot is clicked near the fold. Smoothness comes from the
		// stylesheet, so prefers-reduced-motion is honoured there.
		function show( i ) {
			track.scrollLeft = leftOf( i );
		}

		/*
		 * Indicators: plain buttons with aria-current, not an ARIA tablist.
		 * Tabs promise tabpanels and arrow-key handling; these are slides in
		 * a scroller, and a half-implemented tab pattern reads worse to a
		 * screen reader than honest buttons.
		 */
		var dots = document.createElement( 'div' );
		dots.className = 'cz-carousel__dots';
		dots.setAttribute( 'role', 'group' );
		dots.setAttribute( 'aria-label', 'Choose a slide' );

		var buttons = slides.map( function ( slide, i ) {
			var dot = document.createElement( 'button' );
			dot.type = 'button';
			dot.className = 'cz-carousel__dot';
			dot.setAttribute( 'aria-label', 'Show slide ' + ( i + 1 ) + ' of ' + slides.length );
			dot.addEventListener( 'click', function () {
				show( i );
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
			} );
		}

		mark( 0 );

		// Which slide is showing, read from the scroll position rather than
		// tracked in a variable, so a swipe, a drag or a trackpad scroll
		// updates the dots exactly like a click does.
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

		/*
		 * Mouse drag.
		 *
		 * Touch, pen and trackpads already scroll the strip natively; a mouse
		 * gets nothing, because a scroll-snap container ignores click-and-drag.
		 * Snapping is switched off for the drag (or the browser fights every
		 * pixel) and stays off until the release has glided to a slide:
		 * re-enabling it mid-glide makes the browser jump to whichever snap
		 * point happens to be nearest at that instant.
		 */
		var drag = null;
		var swallowClick = false;

		track.addEventListener( 'pointerdown', function ( e ) {
			swallowClick = false;
			if ( e.pointerType !== 'mouse' || e.button !== 0 ) {
				return;
			}
			drag = { id: e.pointerId, x: e.clientX, left: track.scrollLeft, moved: false };
		} );

		track.addEventListener( 'pointermove', function ( e ) {
			if ( ! drag || e.pointerId !== drag.id ) {
				return;
			}

			var dx = e.clientX - drag.x;

			if ( ! drag.moved ) {
				if ( Math.abs( dx ) < DRAG_THRESHOLD ) {
					return;
				}
				drag.moved = true;
				// Captured only once it is a drag. Capturing on pointerdown
				// retargets the eventual click to the track, which would break
				// every link inside a slide even when nothing was dragged.
				track.setPointerCapture( drag.id );
				track.classList.add( 'is-dragging' );
			}

			track.scrollLeft = drag.left - dx;
		} );

		function release( e ) {
			if ( ! drag || e.pointerId !== drag.id ) {
				return;
			}

			var d = drag;
			drag = null;

			if ( ! d.moved ) {
				return;
			}

			swallowClick = true;
			track.classList.remove( 'is-dragging' );
			track.classList.add( 'is-settling' );

			var width = track.clientWidth || 1;
			var from = Math.round( d.left / width );
			var travel = track.scrollLeft - d.left;
			var to = from;

			if ( travel > width * COMMIT ) {
				to = from + 1;
			} else if ( travel < -width * COMMIT ) {
				to = from - 1;
			}

			to = Math.max( 0, Math.min( slides.length - 1, to ) );
			show( to );
			settle( leftOf( to ) );
		}

		// Snapping comes back only once the glide has actually arrived. A
		// scrollend left over from the drag itself can fire first, so the
		// position is checked rather than trusted; the timer covers browsers
		// without scrollend.
		function settle( target ) {
			var fallback;

			function finish() {
				window.clearTimeout( fallback );
				track.removeEventListener( 'scrollend', check );
				track.classList.remove( 'is-settling' );
			}

			function check() {
				if ( Math.abs( track.scrollLeft - target ) <= 2 ) {
					finish();
				}
			}

			fallback = window.setTimeout( finish, 800 );
			track.addEventListener( 'scrollend', check );
		}

		track.addEventListener( 'pointerup', release );
		track.addEventListener( 'pointercancel', release );

		// A drag that ends over a link must not also follow it.
		track.addEventListener(
			'click',
			function ( e ) {
				if ( swallowClick ) {
					swallowClick = false;
					e.preventDefault();
					e.stopPropagation();
				}
			},
			true
		);

		// Images and links are natively draggable, and that drag hijacks the
		// gesture before a single pointermove arrives.
		track.addEventListener( 'dragstart', function ( e ) {
			e.preventDefault();
		} );

		var timer = null;

		function advance() {
			show( ( current + 1 ) % slides.length );
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
