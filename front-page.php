<?php
   get_header(); 
?>
<main id="post-<?php the_ID(); ?>" <?php post_class("em-page-content"); ?> >
   <section>
      <div class="entry-content">
      </div>
      <!-- .entry-content -->
   </section>
   <section id="em-portfolio-hero-section">
      <div id="em-portfolio-inner-contain">
      </div>
   </section>
   <header id="about" class="em-portfolio-about-us-section">
      <div class="upwork-btn-area">
         <a target="_blank" href="https://www.upwork.com/o/profiles/users/_~01bc262783a150ad5c/">
         <button class="upwork-btn">upwork reviews</button>		</a>
      </div>
      <h1 class="em-name"><b>Esmond MCcain</b></h1>
      <p class="em-heading-h4 em-site-font-color">Full-stack Web Developer</p>
      <nav aria-label="Social links">
         <ul class="em-social-icons">
            <li>
               <a rel="noopener noreferrer" target="_blank" href="https://www.linkedin.com/in/esmond-m-a17244129/"><i class="fab fa-linkedin"></i></a>
            </li>
            <li>
               <a rel="noopener noreferrer" target="_blank" href="https://www.upwork.com/o/profiles/users/_~01bc262783a150ad5c/">
                  <img class="upwork-svg-icon" src="<?php echo get_stylesheet_directory_uri(); ?>/img/svg/upwork.svg" alt="Esmond Upwork Portfolio">
               </a>
            </li>
            <li>
               <a rel="noopener noreferrer" target="_blank" href="https://github.com/Esmond-M"><i class="fab fa-github"></i></a>
            </li>
         </ul>
      </nav>
   </header>
   <section class="em-portfolio-about-us-section-second">
      <div class="em-portfolio-about-sec wow zoomIn" data-wow-duration="1s" data-wow-delay="0.1s" style="visibility: visible; animation-duration: 1s; animation-delay: 0.1s; animation-name: zoomIn;">
         <div class="em-portfolio-content">
            <h2 id="about" class="em-portfolio-section-title">About</h2>
            <p style="color: black; text-align: center;font-size:17px;"><strong>I work with different web agencies on a contract/full-time basis. I have ample experience collaborating with both different team members and clients to complete projects. I am currently working in the “LAMP/WordPress” stack but am branching out to learn more JavaScript frameworks like React for example. If you wish to contact me please message me through my email at <a href="mailto:esmondmccain@gmail.com">esmondmccain@gmail.com</a> or through <a class="gen-link" href="https://www.upwork.com/o/profiles/users/_~01bc262783a150ad5c/">upwork</a>.</strong></p>
         </div>
         <div class="em-portfolio-progress-bar-sec">
         <?php
         $skills = [
            'WORDPRESS THEME DEVELOPMENT',
            'WORDPRESS PLUGIN DEVELOPMENT',
            'PHP & BACKEND DEVELOPMENT',
            'FRONTEND DEVELOPMENT',
            'TEAM COLLABORATION'
         ];
         foreach ($skills as $skill) : ?>
            <div class="em-portfolio-progress">
               <h3><?php echo $skill; ?></h3>
               <div class="em-portfolio-progress-bar">
                  <div class="em-portfolio-progress-bar-length" data-width="100" style="width: 100%; visibility: visible;">
                     100%
                  </div>
               </div>
            </div>
         <?php endforeach; ?>
         </div>
      </div>
   </section>

   <section id="em-portfolio-portfolio-section" >
      <h2 id="portfolio" class="em-portfolio-section-title wow fadeInUp" data-wow-duration="0.2s">Portfolio</h2>
      <div class="controls">
         <button type="button" class="control mixitup-control-active" data-filter="all">All</button>
         <button type="button" class="control" data-filter=".react">React</button>
         <button type="button" class="control" data-filter=".wordpress">WordPress</button>
      </div>

      <div class="em-modal-container">
         <?php
         // Portfolio Query Arguments
         $portfolio_post_args = array(
            'post_type'      => 'esmond-portfolio',
            'post_status'    => 'publish',
            'posts_per_page' => 9,
            'orderby'        => 'menu_order',
            'order'          => 'ASC',
         );

         // Run Query
         $portfolio_post_the_query = new WP_Query($portfolio_post_args);

         // Check for posts
         if ($portfolio_post_the_query->have_posts()) :
            $portfolio_query_count = 1;
            while ($portfolio_post_the_query->have_posts()) : $portfolio_post_the_query->the_post();

               // Gather post data
               $title      = get_the_title();
               $excerpt    = get_the_excerpt();
               $post_id    = get_the_ID();
               $featured_img = get_the_post_thumbnail_url();
               $categories = get_the_category($post_id);
               $category   = !empty($categories[1]->name) ? strtolower($categories[1]->name) : '';
               $url_link   = get_post_meta($post_id, 'portfolio_post_url_link_value', true);
               $popup_id   = get_post_meta($post_id, 'portfolio_post_popup_target_id_value', true);

               // Output portfolio item
               ?>
              <article class="em-modal modal-<?php echo $portfolio_query_count; ?> mix <?php echo esc_attr($category); ?>">
                  <div class="em-modal-inner">
                     <?php if ($featured_img): ?>
                        <figure>
                           <img src="<?php echo esc_url($featured_img); ?>" alt="<?php echo esc_attr($title); ?>" />
                        </figure>
                     <?php endif; ?>
                     <div class="em-modal-caption">
                        <h3><?php echo esc_html($title); ?></h3>
                        <div class="em-modal-btn-contain">
                           <?php if ($url_link): ?>
                              <a class="em-portfolio-portfolio-link" href="<?php echo esc_url($url_link); ?>" target="_blank" rel="noopener noreferrer">
                                 <button type="button">Visit</button>
                              </a>
                           <?php endif; ?>
                           <?php if ($popup_id): ?>
                              <a id="<?php echo esc_attr($popup_id); ?>" class="em-portfolio-portfolio-image" style="cursor: pointer;">
                                 <button class="port-detail-btn" type="button">Details</button>
                              </a>
                           <?php endif; ?>
                        </div>
                     </div>
                  </div>
               </article>
               <?php
               $portfolio_query_count++;
            endwhile;
         else:
            // No posts found
            _e('Sorry, no posts matched your criteria.', 'esmond-theme-portfolio');
         endif;

         // Reset post data
         wp_reset_postdata();
         ?>
      </div>
   </section>

   <section id="em-portfolio-featured-post-section">
      <div class="em-portfolio-container">
      <h2 class="em-portfolio-section-title wow fadeInUp" data-wow-duration="0.5s">Services</h2>
      <div class="em-portfolio-featured-post-wrap em-portfolio-clearfix">
         <?php
         $services_post_args = array(
            'post_type'      => 'esmond-services',
            'post_status'    => 'publish',
            'posts_per_page' => 6,
            'orderby'        => 'date',
            'order'          => 'ASC',
         );
         $services_post_the_query = new WP_Query($services_post_args);
         if ($services_post_the_query->have_posts()) :
            $services_query_count = 1;
            while ($services_post_the_query->have_posts()) : $services_post_the_query->the_post();
               $title = get_the_title();
               $meta  = get_post_meta(get_the_ID(), 'services_post_icon_class_value', true);
               ?>
               <article class="em-portfolio-featured-post em-portfolio-featured-post-<?php echo $services_query_count;?> wow fadeInLeft" data-wow-duration="0.5s">
                  <div class="em-portfolio-featured-icon"><i class="<?php echo esc_attr($meta); ?>"></i></div>
                  <h3 class="em-heading-h3"><?php echo esc_html($title); ?></h3>
                  <div class="em-portfolio-featured-excerpt"><?php echo get_the_excerpt(); ?></div>
               </article>
               <?php
               $services_query_count++;
            endwhile;
         else:
            _e('Sorry, no posts matched your criteria.', 'esmond-theme-portfolio');
         endif;
         wp_reset_postdata();
         ?>
      </div>
        </div>
   </section>
</main>
<?php get_footer(); ?>