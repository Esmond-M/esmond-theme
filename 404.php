<?php
/**
 * The template for displaying 404 pages (not found)
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @package website-theme-name
 */

get_header();
?>

	<main id="primary" class="site-main">

		<section class="error-404 not-found">
    <div class="blog-content pt60">
    <div class="container">
      <div class="row">
        <div class="col-sm-4">

			<section class="error-404 not-found">
				<header class="page-header">
					<h1 class="page-title"><strong>Page not found.</strong></h1>
          <h3></h3>
				</header><!-- .page-header -->

				<div class="page-content">
					<a href="<?php echo home_url();?>" class="btn">Return Home</a>
				</div><!-- .page-content -->
			</section><!-- .error-404 -->

			</div>
		</div>
	</div>
</div>
			
		</section>
		<!-- .error-404 -->

	</main><!-- #main -->

<?php
get_footer();
