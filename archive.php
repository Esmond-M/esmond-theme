<?php get_header(); ?>

	<main class="wrapper" role="main">
		<!-- section -->
		<section>

			<h1><?php _e( 'Archives', 'esmondblankboilerplatetheme' ); ?></h1>

			<?php get_template_part('loop'); ?>

			<?php get_template_part('pagination'); ?>

		</section>
		<!-- /section -->
	</main>


<?php get_footer(); ?>
