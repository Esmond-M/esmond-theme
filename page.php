<?php get_header(); ?>
<div style="background-image:linear-gradient(rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.5)), url('<?php echo esc_url( get_header_image() ); ?>')" class="hero-image">
  <div class="hero-text">
    <h1 style="font-size:3rem;;margin: 0;">I am John Doe</h1>
    <p>And I'm a Photographer</p>
    <button>Hire me</button>
  </div>
</div>

	<main class="wrapper" role="main">
		<!-- section -->
		
		<section>

			<h1><?php the_title(); ?></h1>

		<?php if (have_posts()): while (have_posts()) : the_post(); ?>

			<!-- article -->
			<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

				<?php the_content(); ?>

				<?php comments_template( '', true ); // Remove if you don't want comments ?>

				<br class="clear">

			</article>
			<!-- /article -->

		<?php endwhile; ?>

		<?php else: ?>

			<!-- article -->
			<article>

				<h2><?php _e( 'Sorry, nothing to display.', 'esmondblankboilerplatetheme' ); ?></h2>

			</article>
			<!-- /article -->

		<?php endif; ?>

		</section>
		<!-- /section -->
	</main>

<?php get_footer(); ?>
