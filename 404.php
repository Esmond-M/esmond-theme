<?php
   get_header('404'); 
   
   ?>
<article id="post-<?php the_ID(); ?>" <?php post_class("em-page-content"); ?> >
   <section>
      <div class="entry-content">
      </div>
      <!-- .entry-content -->
   </section>
   <section id="em-portfolio-home-slider-section">
      <div id="em-portfolio-inner-contain">
      </div>
   </section>
   <section id="about" class="em-portfolio-about-us-section">
      <div class="upwork-btn-area">
         <a target="_blank" href="https://www.upwork.com/o/profiles/users/_~01bc262783a150ad5c/">
         <button class="upwork-btn">upwork reviews</button>		</a>
      </div>
      <h1 class="em-name"><b>Esmond MCcain</b></h1>
      <h4 class="em-site-font-color">Full-stack Web Developer</h4>
      <ul class="em-social-icons">
         <li>
            <a rel="noopener noreferrer" target="_blank" href="https://www.linkedin.com/in/esmond-m-a17244129/"><i class="fab fa-linkedin"></i></a>
         </li>
         <li>
            <a rel="noopener noreferrer" target="_blank" href="https://www.upwork.com/o/profiles/users/_~01bc262783a150ad5c/"><img class="upwork-svg-icon" src="<?php echo get_stylesheet_directory_uri(); ?>\img\svg\upwork.svg" alt="Esmond Upwork Portfolio"></a>
         </li>
         <li>
            <a rel="noopener noreferrer" target="_blank" href="https://github.com/Esmond-M"><i class="fab fa-github"></i></a>
         </li>
      </ul>
   </section>
   <section id="em-404" class="">
		<p>Page not found.</p>
         <a href="/">
         <button class="upwork-btn">Return Home</button></a>
  
   </section>
   <section class="em-portfolio-contact-section" style="background-image: url('<?php echo get_stylesheet_directory_uri() . "/img/bg.jpg"?>');">

   <div class="em-portfolio-contact-overlay"> 
        <h2 class="em-contact-section-title wow fadeInUp" data-wow-duration="0.5s" style="visibility: visible; animation-duration: 0.5s; animation-name: fadeInUp;">Contact</h2>
        <div class="em-portfolio-contact-form">
         <?php echo do_shortcode( '[gravityform id="1" title="false" description="false" ajax="true"]' );?>
        </div> 
   </div>
   </section>
</article>
<?php get_footer(); ?>