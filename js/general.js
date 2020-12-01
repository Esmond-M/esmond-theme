jQuery(document).ready(function($) {
	
var fixmeTop = jQuery('.site-header').offset().top;
jQuery(window).scroll(function() {
    var currentScroll = jQuery(window).scrollTop();
    if (currentScroll >= fixmeTop) {
      jQuery('.site-header').css({
             position: 'fixed' ,
             zIndex:'1000' ,
		     width:'100%' ,
		     background: 'white' ,
		     top: '0'
        });
	  jQuery('.wrookies-fixedheader-placeholder').css({
             display: 'block'
        });
    } else {
        jQuery('.site-header').css({
            position: 'relative',
	       
        });
	  jQuery('.wrookies-fixedheader-placeholder').css({
             display: 'none'
        });		
    }
});
	jQuery( ".wrookies-closebtn" ).click(function() {
   jQuery('#mySidenav').css({
             width: '0px'
        }); 
});
	
		jQuery( ".wrookies-openbtn" ).click(function() {
   jQuery('#mySidenav').css({
             width: '250px'
        }); 
});

});