<?php
   /* Template Name: Portfolio Template*/ 
   get_header(); 
   
   ?>
<main class="wrapper" role="main">
   <!-- section -->
   <section>
      <div class="page-portfolio-page">
         <h1 class="portfolio-main-title"><?php the_title(); ?></h1>
         <div class="portfolio-search-container">
            <?php  $selected_certificate = $_POST['em-portfolio-filter'];  ?>
            <form  action="" method="post">
               <h3><?php _e( 'Search by Portfolio Category', 'textdomain' ); ?></h3>
               <select class="portfolio-filter-search-box" name="em-portfolio-filter">
                  <option <?php if ($_POST['em-portfolio-filter'] == "all" || isset($_POST['em-portfolio-filter']) ) echo 'selected="selected" '; ?> value="all">All</option>
                  <?php
                     $categories = get_terms( array(
                          'taxonomy' => 'category', 
                          'orderby' => 'name',
                          'order' => 'ASC',
                     ) );
                      
                     foreach( $categories as $category ) {
                                   
                         ?> 
                  <option <?php if ($_POST['em-portfolio-filter'] == $category->name) echo 'selected="selected" '; ?> value="<?php echo $category->name ; ?>"><?php echo $category->name ; ?></option>
                  <?php
                     } 
                     
                     ?>
               </select>
               <input class="esmondblankboilerplatetheme-advanced-submit-btn" type="submit"  value="Filter" />
            </form>
         </div>
         <?php 
            if( isset($_POST['em-portfolio-filter']) )
            {
                  query_posts(array( 
                    'post_type' => 'esmond-b-theme-port',
                    'posts_per_page' => -1 ,
                    'meta_key' => 'em_portfolio_project_name',
                    'orderby' => 'meta_value',
                    'order' => 'ASC' ,
                    'tax_query' => array(
                    array(
                        'taxonomy' => 'category',
                        'field'    => 'slug',
                        'terms'    => $selected_certificate,
                    ),
                ),
                ) );  
            }
            if(  !isset($_POST['em-portfolio-filter']) || $_POST['em-portfolio-filter'] == "all") {
              query_posts(array( 
                    'post_type' => 'esmond-b-theme-port',
                    'posts_per_page' => -1 ,
                    'meta_key' => 'em_portfolio_project_name',
                    'orderby' => 'meta_value',
                    'order' => 'ASC'
                ) ); 
            }
            
            ?>
         <div class="esmondblankboilerplatetheme-portfolio-wrapper">
            <!-- start photo div container -->  
           
            <?php while (have_posts()) : the_post(); ?>
			  <?php 
			 $portfolio_project_image_id = get_post_meta( get_the_ID(), "em_portfolio_project_image_id", true );
             $portfolio_project_image = wp_get_attachment_url( $portfolio_project_image_id );
	
			 ?>
            <div class="portfolio-photo-contain">
               <div class="cust-portfolio-content">
                  <div class="cust-portfolio-content-overlay"></div>
                  <div class="cust-portfolio-content-image" style="background-image: url(<?php echo $portfolio_project_image; ?>);">
                  </div>
                  <div class="cust-portfolio-content-details cust-portfolio-fadeIn-bottom">
                     <h3 class="cust-portfolio-content-reviewquote"><?php $portfolio_project_description = get_post_meta( get_the_ID(), 'em_portfolio_project_description', true );
                        // Check if the custom field has a value.
                        if ( ! empty( $portfolio_project_description ) ) {
                           ?> <button class="portfolio-review-btn" data-balloon-length="large" aria-label="<?php  echo str_replace("\"","&quot;",$portfolio_project_description); ?>" data-balloon-pos="up">Bio</button> 
                        <?php 
                           }
                           			?> 
                     </h3>
                  </div>
               </div>
               <h3 class="portfolio-cert-h3"><?php $portfolio_project_name = get_post_meta( get_the_ID(), 'em_portfolio_project_name', true );
                  // Check if the custom field has a value.
                  if ( ! empty( $portfolio_project_name ) ) {
                     echo  $portfolio_project_name;
                  }?> </h3>
            </div>
            <?php endwhile;?>
         </div>
         <!-- End photo div container -->    
      </div>
   </section>
   <!-- /section -->
</main>
<?php get_footer(); ?>