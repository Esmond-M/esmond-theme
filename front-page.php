<?php
   get_header(); 
   
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
   <section class="em-portfolio-about-us-section">
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
            <a rel="noopener noreferrer" target="_blank" href="https://www.upwork.com/o/profiles/users/_~01bc262783a150ad5c/"><img class="upwork-svg-icon" src="<?php echo get_stylesheet_directory_uri() ?>\img\svg\upwork.svg" alt="Esmond Upwork Portfolio"></a>
         </li>
         <li>
            <a rel="noopener noreferrer" target="_blank" href="https://github.com/Esmond-M"><i class="fab fa-github"></i></a>
         </li>
      </ul>
   </section>
   <section id="em-portfolio-portfolio-section" class="em-portfolio-section">
      <h2 id="portfolio" class="em-portfolio-section-title wow fadeInUp" data-wow-duration="0.2s" style="visibility: visible; animation-duration: 0.2s; animation-name: fadeInUp;">Portfolio</h2>
   </section>
   <section id="em-portfolio-featured-post-section" class="em-portfolio-section">
      <div class="em-portfolio-container">
      <h2 id="services" class="em-portfolio-section-title wow fadeInUp" data-wow-duration="0.5s" style="visibility: visible; animation-duration: 0.5s; animation-name: fadeInUp;">
         Services
      </h2>
      <div class="em-portfolio-featured-post-wrap em-portfolio-clearfix">
         <?php
            $services_post_args = array(
            	'post_type' => 'esmond-services',
            	'post_status' => 'publish',
            	'posts_per_page' => 3,
            	'orderby'   => 'date',
                   'order' => 'ASC',
            
            );
            
            // Variable to call WP_Query.
            $services_post_the_query = new WP_Query($services_post_args);
            if ( $services_post_the_query->have_posts() ) :
            	// Start the Loop
            	while ( $services_post_the_query->have_posts() ) : $services_post_the_query->the_post();
            		// Start the Loop
            		$services_query_count = 1;
            
            			$title = get_the_title();
            			$excerpt = get_the_excerpt();
            			$post_id = get_the_ID();
            			$meta = get_post_meta($post_id, 'services_post_icon_class_value', true);
            			?>
         <div class="em-portfolio-featured-post em-portfolio-featured-post<?php echo $services_query_count;?> wow fadeInLeft" data-wow-duration="0.5s" data-wow-delay="0s" style="visibility: visible; animation-duration: 0.5s; animation-delay: 0s; animation-name: fadeInLeft;">
            <div class="em-portfolio-featured-icon"><i class="<?php echo $meta; ?>"></i></div>
            <h3><?php echo $title; ?></h3>
            <div class="em-portfolio-featured-excerpt"><?php echo get_the_excerpt(); ?></div>
         </div>
         <?php
            $services_query_count + 1;
            endwhile;
            else:
            // If no posts match this query, output this text.
            	_e( 'Sorry, no posts matched your criteria.', 'textdomain' );
            endif; 
            
            // If no posts match this query, output this text. 
            wp_reset_postdata();
            
            ?> 
      </div>
   </section>
</article>
<?php get_footer(); ?>