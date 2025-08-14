<?php
   get_header('404'); 
   ?>
<main id="post-<?php the_ID(); ?>" <?php post_class('em-page-content'); ?> aria-labelledby="em-404-title">
   <section class="em-404-hero em-404-hero-style" style="background: url('<?php echo esc_url( get_stylesheet_directory_uri() . '/img/bg.jpg' ); ?>') center center/cover no-repeat;">
      <h1 id="em-404-title" class="em-name"><b>Oops! Page Not Found (404)</b></h1>
      <p>Sorry, the page you are looking for does not exist or has been moved.</p>
      <div class="em-404-actions">
         <a href="/" class="upwork-btn">Return Home</a>
      </div>
   </section>
</main>
<?php get_footer(); ?>