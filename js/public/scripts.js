jQuery(document).ready(function ($)  {
    $('.toggle-nav').click(function(e) {
        $('.menu.hamburger-menu ul.menu-main-mobile').slideToggle(500);
 
        e.preventDefault();
    });
    
$("ul.menu-main-mobile").find('> li').click(
    function() {
        $(this).find('> ul').slideToggle();
  

       // $(this).find('> ul').toggle();
    }
);

$("ul.sub-menu").find('> li').click(
    function(e) {
        e.stopPropagation()
        $(this).find('> ul').slideToggle();
   
       // $(this).find('> ul').toggle();
    }
);
});