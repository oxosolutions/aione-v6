/**
 * Oxo Framework
 *
 * WARNING: This file is part of the Oxo Core Framework.
 * Do not edit the core files.
 * Add any modifications necessary under a child theme.
 *
 * @version: 1.0.0
 * @package  Oxo/Admin Interface
 * @author   OXOSolutions
 * @link	 http://oxosolutions.com
 */

( function( $ ) {

	"use strict";

	$( document ).ready( function() {

		// show or hide megamenu fields on parent and child list items
		oxo_megamenu.menu_item_mouseup();
		oxo_megamenu.megamenu_status_update();
		oxo_megamenu.megamenu_fullwidth_update();
		oxo_megamenu.update_megamenu_fields();

		// setup automatic thumbnail handling
		$( '.remove-oxo-megamenu-thumbnail' ).manage_thumbnail_display();
		$( '.oxo-megamenu-thumbnail-image' ).css( 'display', 'block' );
		$( ".oxo-megamenu-thumbnail-image[src='']" ).css( 'display', 'none' );

		// setup new media uploader frame
		oxo_media_frame_setup();
	});

	// "extending" wpNavMenu
	var oxo_megamenu = {

		menu_item_mouseup: function() {
			$( document ).on( 'mouseup', '.menu-item-bar', function( event, ui ) {
				if( ! $( event.target ).is( 'a' )) {
					setTimeout( oxo_megamenu.update_megamenu_fields, 300 );
				}
			});
		},

		megamenu_status_update: function() {

			$( document ).on( 'click', '.edit-menu-item-megamenu-status', function() {
				var parent_li_item = $( this ).parents( '.menu-item:eq( 0 )' );

				if( $( this ).is( ':checked' ) ) {
					parent_li_item.addClass( 'oxo-megamenu' );
				} else 	{
					parent_li_item.removeClass( 'oxo-megamenu' );
				}

				oxo_megamenu.update_megamenu_fields();
			});
		},

		megamenu_fullwidth_update: function() {

			$( document ).on( 'click', '.edit-menu-item-megamenu-width', function() {
				var parent_li_item = $( this ).parents( '.menu-item:eq( 0 )' );

				if( $( this ).is( ':checked' ) ) {
					parent_li_item.addClass( 'oxo-megamenu-fullwidth' );
				} else 	{
					parent_li_item.removeClass( 'oxo-megamenu-fullwidth' );
				}

				oxo_megamenu.update_megamenu_fields();
			});
		},

		update_megamenu_fields: function() {
			var menu_li_items = $( '.menu-item');

			menu_li_items.each( function( i ) 	{

				var megamenu_status = $( '.edit-menu-item-megamenu-status', this );
				var megamenu_fullwidth = $( '.edit-menu-item-megamenu-width', this );

				if( ! $( this ).is( '.menu-item-depth-0' ) ) {
					var check_against = menu_li_items.filter( ':eq(' + (i-1) + ')' );

					if( check_against.is( '.oxo-megamenu' ) ) {
						megamenu_status.attr( 'checked', 'checked' );
						$( this ).addClass( 'oxo-megamenu' );
					} else {
						megamenu_status.attr( 'checked', '' );
						$( this ).removeClass( 'oxo-megamenu' );
					}

					if( check_against.is( '.oxo-megamenu-fullwidth' ) ) {
						megamenu_fullwidth.attr( 'checked', 'checked' );
						$( this ).addClass( 'oxo-megamenu-fullwidth' );
					} else {
						megamenu_fullwidth.attr( 'checked', '' );
						$( this ).removeClass( 'oxo-megamenu-fullwidth' );
					}
				} else {
					if( megamenu_status.attr( 'checked' ) ) {
						$( this ).addClass( 'oxo-megamenu' );
					}

					if( megamenu_fullwidth.attr( 'checked' ) ) {
						$( this ).addClass( 'oxo-megamenu-fullwidth' );
					}
				}
			});
		}

	};

	$.fn.manage_thumbnail_display = function( variables ) {
		var button_id;

		return this.click( function( e ){
			e.preventDefault();

			button_id = this.id.replace( 'oxo-media-remove-', '' );
			$( '#edit-menu-item-megamenu-thumbnail-'+button_id ).val( '' );
			$( '#oxo-media-img-'+button_id ).attr( 'src', '' ).css( 'display', 'none' );
		});
	}

	function oxo_media_frame_setup() {
		var oxo_media_frame;
		var item_id;

		$( document.body ).on( 'click.oxoOpenMediaManager', '.oxo-open-media', function(e){

			e.preventDefault();

			item_id = this.id.replace('oxo-media-upload-', '');

			if ( oxo_media_frame ) {
				oxo_media_frame.open();
				return;
			}

			oxo_media_frame = wp.media.frames.oxo_media_frame = wp.media({

				className: 'media-frame oxo-media-frame',
				frame: 'select',
				multiple: false,
				library: {
					type: 'image'
				}
			});

			oxo_media_frame.on('select', function(){

				var media_attachment = oxo_media_frame.state().get('selection').first().toJSON();

				$( '#edit-menu-item-megamenu-thumbnail-'+item_id ).val( media_attachment.url );
				$( '#oxo-media-img-'+item_id ).attr( 'src', media_attachment.url ).css( 'display', 'block' );

			});

			oxo_media_frame.open();
		});

	}
})( jQuery );