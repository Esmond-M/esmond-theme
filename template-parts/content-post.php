<?php
/**
 * Template part for displaying single blog post content.
 *
 * @package esmond-theme-portfolio
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class( 'em-single-post' ); ?>>

	<?php
	// ── Post Header ─────────────────────────────────────────────────
	$categories = get_the_category();
	?>
	<header class="em-post-header">
		<?php if ( $categories ) : ?>
			<div class="em-post-cats">
				<?php foreach ( $categories as $cat ) : ?>
					<a href="<?php echo esc_url( get_category_link( $cat->term_id ) ); ?>" class="em-cat-pill">
						<?php echo esc_html( $cat->name ); ?>
					</a>
				<?php endforeach; ?>
			</div>
		<?php endif; ?>

		<h1 class="em-post-title"><?php the_title(); ?></h1>

		<div class="em-post-meta">
			<span class="em-post-date">
				<time datetime="<?php echo esc_attr( get_the_date( 'c' ) ); ?>">
					<?php echo esc_html( get_the_date( 'F j, Y' ) ); ?>
				</time>
			</span>
			<span class="em-post-meta-sep">·</span>
			<span class="em-post-author">
				<?php esc_html_e( 'by', 'esmond-theme-portfolio' ); ?>
				<a href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ); ?>">
					<?php echo esc_html( get_the_author() ); ?>
				</a>
			</span>
			<?php
			$read_time = max( 1, (int) ceil( str_word_count( wp_strip_all_tags( get_the_content() ) ) / 200 ) );
			?>
			<span class="em-post-meta-sep">·</span>
			<span class="em-post-read-time"><?php echo esc_html( $read_time ); ?> min read</span>
		</div>
	</header>

	<?php
	// ── Featured Image ───────────────────────────────────────────────
	if ( has_post_thumbnail() ) :
		?>
		<div class="em-post-thumbnail">
			<?php the_post_thumbnail( 'large', array( 'class' => 'em-post-img', 'loading' => 'eager' ) ); ?>
		</div>
	<?php endif; ?>

	<?php
	// ── Post Body ────────────────────────────────────────────────────
	?>
	<div class="em-post-body entry-content">
		<?php
		the_content(
			sprintf(
				'<span class="screen-reader-text">%s</span>',
				/* translators: %s: post title */
				sprintf( esc_html__( 'Continue reading "%s"', 'esmond-theme-portfolio' ), get_the_title() )
			)
		);

		wp_link_pages( array(
			'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'esmond-theme-portfolio' ),
			'after'  => '</div>',
		) );
		?>
	</div>

	<?php
	// ── Post Footer ──────────────────────────────────────────────────
	$tags = get_the_tags();
	?>
	<footer class="em-post-footer">
		<?php if ( $tags ) : ?>
			<div class="em-post-tags">
				<?php foreach ( $tags as $tag ) : ?>
					<a href="<?php echo esc_url( get_tag_link( $tag->term_id ) ); ?>" class="em-tag-pill">
						#<?php echo esc_html( $tag->name ); ?>
					</a>
				<?php endforeach; ?>
			</div>
		<?php endif; ?>

		<?php if ( get_edit_post_link() ) : ?>
			<div class="em-post-edit">
				<?php edit_post_link( esc_html__( 'Edit post', 'esmond-theme-portfolio' ), '', '' ); ?>
			</div>
		<?php endif; ?>
	</footer>

</article>
