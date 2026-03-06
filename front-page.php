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
      <p class="em-heading-h4 em-site-font-color">Full-Stack WordPress Developer</p>
      <p class="em-site-tagline">Specializing in custom themes, plugins &amp; API integrations</p>
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
            <p style="color: black; text-align: center;font-size:17px;"><strong>I work with web agencies on both contract and full-time engagements, bringing extensive experience in collaborating with teams and clients to deliver successful digital projects. My core expertise lies in the LAMP/WordPress stack, including custom theme and plugin development, API integrations, and performance optimization. I’m also expanding my skill set into modern technologies, learning PHP’s Laravel framework and JavaScript’s React library to broaden my full-stack capabilities. For inquiries, you can reach me at <a href="mailto:esmondmccain@gmail.com">esmondmccain@gmail.com</a> or via my <a class="gen-link" href="https://www.upwork.com/o/profiles/users/_~01bc262783a150ad5c/">Upwork profile</a>.</strong></p>
         </div>
         <div class="em-expertise-stack-wrap">
            <div class="em-core-expertise">
               <h3 class="em-expertise-title">Core Expertise</h3>
               <ul class="em-expertise-list">
                  <li>
                     <strong>WordPress Theme &amp; Gutenberg Development</strong>
                     <span>Custom themes, Gutenberg blocks &amp; patterns, Elementor, PSD/Figma to WordPress, performance optimization</span>
                  </li>
                  <li>
                     <strong>WordPress Plugin Development</strong>
                     <span>Custom plugin architecture, WooCommerce extensions</span>
                  </li>
                  <li>
                     <strong>API Integrations</strong>
                     <span>REST APIs, third-party service integrations, webhook systems</span>
                  </li>
                  <li>
                     <strong>Frontend Development</strong>
                     <span>JavaScript, responsive UI, accessibility improvements</span>
                  </li>
                  <li>
                     <strong>PHP Backend Development</strong>
                     <span>PHP, MySQL, WordPress hooks &amp; filters</span>
                  </li>
                  <li>
                     <strong>Accessibility &amp; Standards</strong>
                     <span>WCAG 2.1 AA, Section 508, WAI-ARIA, Lighthouse / WAVE / Axe audits</span>
                  </li>
               </ul>
            </div>
            <div class="em-tech-stack">
               <h3 class="em-expertise-title">Technologies</h3>
               <div class="em-stack-grid">
                  <div class="em-stack-group">
                     <h4>Backend</h4>
                     <ul>
                        <li>PHP</li>
                        <li>WordPress</li>
                        <li>MySQL</li>
                     </ul>
                  </div>
                  <div class="em-stack-group">
                     <h4>Frontend</h4>
                     <ul>
                        <li>JavaScript</li>
                        <li>HTML5</li>
                        <li>CSS / SCSS</li>
                     </ul>
                  </div>
                  <div class="em-stack-group">
                     <h4>Tools</h4>
                     <ul>
                        <li>Git</li>
                        <li>Elementor</li>
                        <li>WooCommerce</li>
                        <li>Advanced Custom Fields</li>
                        <li>REST / GraphQL APIs</li>
                        <li>Figma</li>
                        <li>AWS &amp; Cloudflare</li>
                     </ul>
                  </div>
               </div>
            </div>
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
            'posts_per_page' => 12,
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
               $category   = !empty($categories) ? implode(' ', array_map(fn($cat) => strtolower($cat->name), $categories)) : '';
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
      <h2 id="services" class="em-portfolio-section-title wow fadeInUp" data-wow-duration="0.5s">Services</h2>
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