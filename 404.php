<?php
   get_header('404'); 
   ?>
<main id="post-<?php the_ID(); ?>" <?php post_class('em-page-content'); ?> aria-labelledby="em-404-title">
   <section class="em-404-hero" style="background: url('<?php echo esc_url( get_stylesheet_directory_uri() . '/img/bg.jpg' ); ?>') center center/cover no-repeat; min-height: 400px; display: flex; flex-direction: column; justify-content: center; align-items: center; color: #fff;">
      <h1 id="em-404-title" class="em-name"><b>Oops! Page Not Found (404)</b></h1>
      <p class="em-site-font-color">Sorry, the page you are looking for does not exist or has been moved.</p>
      <div class="em-404-actions">
         <a href="/" class="upwork-btn">Return Home</a>
         <a href="javascript:history.back()" class="upwork-btn">Go Back</a>
      </div>
   </section>
</main>
<?php get_footer(); ?>