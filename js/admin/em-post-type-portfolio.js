jQuery(document).ready(function($) {
	// Validate required fields
	jQuery.validator.setDefaults({ 
    ignore: [], // enable validate for hidden fields
    
});
 jQuery("#post").validate();
	// Uploading files
	var file_frame;

	jQuery.fn.upload_em_portfolio_image = function( button ) {
		var button_id = button.attr('id');
		var field_id = button_id.replace( '_button', '' );

		// If the media frame already exists, reopen it.
		if ( file_frame ) {
		  file_frame.open();
		  return;
		}

		// Create the media frame.
		file_frame = wp.media.frames.file_frame = wp.media({
		  title: jQuery( this ).data( 'uploader_title' ),
		  button: {
		    text: jQuery( this ).data( 'uploader_button_text' ),
		  },
		  multiple: false
		});

		// When an image is selected, run a callback.
		file_frame.on( 'select', function() {
		  var attachment = file_frame.state().get('selection').first().toJSON();
		  jQuery("#"+field_id).val(attachment.id);
		  jQuery("#em-portfolio-image-metaboxes img").attr('src',attachment.url);
		  jQuery( '#em-portfolio-image-metaboxes img' ).show();
		  jQuery( '#' + button_id ).attr( 'id', 'remove_em_portfolio_image_button' );
		  jQuery( '#remove_em_portfolio_image_button' ).text( 'Remove Project image' );
		  jQuery("#em-portfolio-image-metaboxes img").attr('srcset',attachment.url);
		});

		// Finally, open the modal
		file_frame.open();
	};

	jQuery('#em-portfolio-image-metaboxes').on( 'click', '#upload_em_portfolio_image_button', function( event ) {
		event.preventDefault();
		jQuery.fn.upload_em_portfolio_image( jQuery(this) );
	});

	jQuery('#em-portfolio-image-metaboxes').on( 'click', '#remove_em_portfolio_image_button', function( event ) {
		event.preventDefault();
		jQuery( '#upload_em_portfolio_image' ).val( '' );
		jQuery( '#em-portfolio-image-metaboxes img' ).attr( 'src', '' );
		jQuery( '#em-portfolio-image-metaboxes img' ).hide();
		jQuery( this ).attr( 'id', 'upload_em_portfolio_image_button' );
		jQuery( '#upload_em_portfolio_image_button' ).text( 'Set Project image' );
	});

});