<?php
/**
 * Template part for displaying single esmond-portfolio post content.
 * Customise this file to control how individual portfolio pages look.
 *
 * @package esmond-theme-portfolio
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class( 'em-single-portfolio' ); ?>>

	<header class="em-post-header">
		<h1 class="em-post-title"><?php the_title(); ?></h1>
		<?php
		$categories = get_the_category();
		if ( $categories ) :
			?>
			<div class="em-post-cats">
				<?php foreach ( $categories as $cat ) : ?>
					<a href="<?php echo esc_url( get_category_link( $cat->term_id ) ); ?>" class="em-cat-pill">
						<?php echo esc_html( $cat->name ); ?>
					</a>
				<?php endforeach; ?>
			</div>
		<?php endif; ?>
	</header>

	<?php if ( has_post_thumbnail() ) : ?>
		<div class="em-post-thumbnail">
			<?php the_post_thumbnail( 'large', array( 'class' => 'em-post-img', 'loading' => 'eager' ) ); ?>
		</div>
	<?php endif; ?>

	<div class="em-post-body entry-content">
		<?php the_content(); ?>
	</div>

	<?php if ( get_edit_post_link() ) : ?>
		<footer class="em-post-footer">
			<div class="em-post-edit">
				<?php edit_post_link( esc_html__( 'Edit', 'esmond-theme-portfolio' ), '', '' ); ?>
			</div>
		</footer>
	<?php endif; ?>

</article>
