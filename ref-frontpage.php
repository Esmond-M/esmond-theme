<?php get_header(); ?>

<main id="main-content" class="em-page-content">

   <header class="em-portfolio-header">
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
      <div class="upwork-btn-area">
         <a target="_blank" href="https://www.upwork.com/o/profiles/users/_~01bc262783a150ad5c/">
            <button class="upwork-btn">Upwork Reviews</button>
         </a>
      </div>
   </header>

   <section id="about" class="em-portfolio-about-us-section">
      <h2 class="em-portfolio-section-title">About</h2>
      <p style="color: black; text-align: center; font-size:17px;">
         <strong>
            I work with different web agencies on a contract/full-time basis. I have ample experience collaborating with both different team members and clients to complete projects. I am currently working in the “LAMP/WordPress” stack but am branching out to learn more JavaScript frameworks like React for example. If you wish to contact me please message me through my email at 
            <a href="mailto:esmondmccain@gmail.com">esmondmccain@gmail.com</a> or through 
            <a class="gen-link" href="https://www.upwork.com/o/profiles/users/_~01bc262783a150ad5c/">upwork</a>.
         </strong>
      </p>
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
                  <div class="em-portfolio-progress-bar-length" data-width="100" style="width: 100%;">
                     100%
                  </div>
               </div>
            </div>
         <?php endforeach; ?>
      </div>
   </section>

   <section id="em-portfolio-home-slider-section">
      <h2 class="em-portfolio-section-title">Featured Projects</h2>
      <div id="em-portfolio-inner-contain">
         <!-- Slider content goes here -->
      </div>
   </section>

   <section class="em-portfolio-about-us-section-second">
      <h2 class="em-portfolio-section-title">Skills & Technologies</h2>
      <ul>
         <li>JavaScript (React, Node.js)</li>
         <li>PHP & WordPress</li>
         <li>HTML5 & CSS3/Sass</li>
         <li>APIs & Integrations</li>
      </ul>
   </section>

   <section id="em-portfolio-portfolio-section">
      <h2 class="em-portfolio-section-title wow fadeInUp" data-wow-duration="0.2s">Portfolio</h2>
      <nav class="controls" aria-label="Portfolio filters">
         <button type="button" class="control mixitup-control-active" data-filter="all">All</button>
         <button type="button" class="control" data-filter=".react">React</button>
         <button type="button" class="control" data-filter=".wordpress">WordPress</button>
      </nav>
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
         $portfolio_post_the_query = new WP_Query($portfolio_post_args);
         if ($portfolio_post_the_query->have_posts()) :
            $portfolio_query_count = 1;
            while ($portfolio_post_the_query->have_posts()) : $portfolio_post_the_query->the_post();
               $title      = get_the_title();
               $featured_img = get_the_post_thumbnail_url();
               $categories = get_the_category(get_the_ID());
               $category   = !empty($categories[1]->name) ? strtolower($categories[1]->name) : '';
               $url_link   = get_post_meta(get_the_ID(), 'portfolio_post_url_link_value', true);
               $popup_id   = get_post_meta(get_the_ID(), 'portfolio_post_popup_target_id_value', true);
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
            _e('Sorry, no posts matched your criteria.', 'esmond-theme-portfolio');
         endif;
         wp_reset_postdata();
         ?>
      </div>
   </section>

   <section id="em-portfolio-featured-post-section">
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
   </section>

</main>

<?php get_footer(); ?>