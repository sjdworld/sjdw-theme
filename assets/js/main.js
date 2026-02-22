jQuery( function( $ ) {
	// Navigation
	$( '.nav-button' ).on( 'click', function() {
		if ( $( '.navigation' ).is( ':hidden' ) ) {
			$( '.navigation' ).slideDown();
			$( this ).addClass( 'collapsed' );
		} else {
			$( '.navigation' ).slideUp();
			$( this ).removeClass( 'collapsed' );
		}
	} );

	$( 'ul.menu li.menu-item-has-children > a' ).on( 'click', function( event ) {
		if ( window.innerWidth <= 991 ) {
			const rect = this.getBoundingClientRect();
			const arrowZoneWidth = 150;

			if ( event.clientX >= rect.right - arrowZoneWidth ) {
				event.preventDefault();
				const parent = $( this ).parent( 'li' );

				// Close siblings.
				parent.siblings().removeClass( 'active' )
					.find( 'ul.sub-menu' ).removeClass( 'active' );

				// Toggle this submenu & active class.
				parent.toggleClass( 'active' );
				parent.find( '> ul.sub-menu' ).toggleClass( 'active' );
			}
		}
	} );

	$( document ).on( 'click', function( e ) {
		if ( ! $( e.target ).closest( 'ul.menu' ).length ) {
			$( 'ul.sub-menu' ).removeClass( 'active' );
		}
	} );

	// Alert close
	$( '.alert .close' ).on( 'click', function( event ) {
		event.preventDefault();
		$( this )
			.parent( '.alert' )
			.fadeOut();
	} );

	//Search box
	$( '.search-action' ).on( 'click', function( event ) {
		event.preventDefault();
		$( this ).parents( '.icon-search' ).toggleClass( 'search-open' );
		if ( $( this ).parents( '.icon-search' ).hasClass( 'search-open' ) ) {
			$( 'body' ).css( { overflow: 'hidden', height: '100%' } );
		} else {
			$( 'body' ).css( { overflow: 'auto', height: 'auto' } );
		}
	} );

	// Submit post filter.
	$( 'body' ).on( 'change', '.post-filter-year', function() {
		const form = $( this ).parents( '.post-filter-form' );
		form.find( '.post-filter-month' ).val( '' );
		form.submit();
	} );
	$( 'body' ).on( 'change', '.post-filter-month', function() {
		$( this ).parents( '.post-filter-form' ).submit();
	} );

	$( window ).on( 'scroll', function() {
		const scrollTop = $( this ).scrollTop();
		if ( scrollTop > 500 ) {
			$( '#nav' ).addClass( 'fixed-nav' );
		} else {
			$( '#nav' ).removeClass( 'fixed-nav' );
		}
	} );
} );
