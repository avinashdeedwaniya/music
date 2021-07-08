(function( $ ) {
	'use strict';

	/**
	 * All of the code for your admin-facing JavaScript source
	 * should reside in this file.
	 *
	 * Note: It has been assumed you will write jQuery code here, so the
	 * $ function reference has been prepared for usage within the scope
	 * of this function.
	 *
	 * This enables you to define handlers, for when the DOM is ready:
	 *
	 * $(function() {
	 *
	 * });
	 *
	 * When the window is loaded:
	 *
	 * $( window ).load(function() {
	 *
	 * });
	 *
	 * ...and/or other possibilities.
	 *
	 * Ideally, it is not considered best practise to attach more than a
	 * single DOM-ready or window-load handler for a particular page.
	 * Although scripts in the WordPress core, Plugins and Themes may be
	 * practising this, we should strive to set a better example in our own work.
	 */
	$( document ).ready(function() {
		if(jQuery('body').hasClass('post-type-music')){
			jQuery('form#post').on('submit',function(){
				var flag=false;
				
				jQuery('.music_box input').each(function(){
					if(jQuery(this).val() == ''){
						jQuery(this).addClass('error');
						flag=true;
					}
					else{
						jQuery(this).removeClass('error');
					}	
				}); 
				if(jQuery('#music_url').val() != ''){
					if(!isValidURL(jQuery('#music_url').val())){
						jQuery('#music_url').addClass('error');
						flag=true;
					}else{
						jQuery(this).removeClass('error');
					}
				} 
				if(flag){
					jQuery('.music_box .error:first').focus();
					return false;
				}
				return true;
			});
		}
	});
	function isValidURL(string) {
	  var res = string.match(/(http(s)?:\/\/.)?(www\.)?[-a-zA-Z0-9@:%._\+~#=]{2,256}\.[a-z]{2,6}\b([-a-zA-Z0-9@:%_\+.~#?&//=]*)/g);
	  return (res !== null)
	};
})( jQuery );
