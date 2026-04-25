/**
 * Commonplace dim-mode toggle.
 *
 * Initial state is set pre-paint by an inline snippet in <head> (see
 * commonplace_dim_mode_inline in functions.php). This file exposes a
 * global toggle function for use by future toggle button blocks.
 *
 * @since Commonplace 0.1.0
 */
( function () {
	'use strict';

	/**
	 * Apply a mode to <html> and persist it.
	 *
	 * @param {string} mode 'dim' or 'cream'.
	 */
	function applyMode( mode ) {
		var doc = document.documentElement;
		if ( mode === 'dim' ) {
			doc.setAttribute( 'data-theme', 'dim' );
		} else {
			doc.setAttribute( 'data-theme', 'cream' );
		}
		try {
			localStorage.setItem( 'commonplaceTheme', mode );
		} catch ( e ) {
			/* localStorage unavailable; mode lasts for this page only. */
		}
	}

	/**
	 * Toggle between cream and dim.
	 */
	function toggle() {
		var current = document.documentElement.getAttribute( 'data-theme' );
		applyMode( current === 'dim' ? 'cream' : 'dim' );
	}

	window.commonplaceTheme = {
		applyMode: applyMode,
		toggle: toggle,
	};

	/**
	 * Attach click handlers to any `.commonplace-theme-toggle` buttons in the
	 * page. Called once on DOMContentLoaded.
	 */
	function bindToggleButtons() {
		var buttons = document.querySelectorAll( '.commonplace-theme-toggle' );
		for ( var i = 0; i < buttons.length; i++ ) {
			buttons[ i ].addEventListener( 'click', toggle );
		}
	}

	if ( document.readyState === 'loading' ) {
		document.addEventListener( 'DOMContentLoaded', bindToggleButtons );
	} else {
		bindToggleButtons();
	}
}() );
