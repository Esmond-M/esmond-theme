<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package esmond-theme-portfolio
 */
?>
<footer id="colophon" class="site-footer emThemefooter" role="contentinfo">
    <?php if ( is_active_sidebar( 'footer-one' ) || is_active_sidebar( 'footer-two' ) || is_active_sidebar( 'footer-three' ) ) : ?>
        <aside class="footer-widgets" aria-label="Footer Widgets">
            <?php if ( is_active_sidebar( 'footer-one' ) ) : ?>
                <section class="footer-widget-area" aria-label="Footer Widget One">
                    <?php dynamic_sidebar( 'footer-one' ); ?>
                </section>
            <?php endif; ?>
            <?php if ( is_active_sidebar( 'footer-two' ) ) : ?>
                <section class="footer-widget-area" aria-label="Footer Widget Two">
                    <?php dynamic_sidebar( 'footer-two' ); ?>
                </section>
            <?php endif; ?>
            <?php if ( is_active_sidebar( 'footer-three' ) ) : ?>
                <section class="footer-widget-area" aria-label="Footer Widget Three">
                    <?php dynamic_sidebar( 'footer-three' ); ?>
                </section>
            <?php endif; ?>
        </aside>
    <?php endif; ?>

    <div class="copy-right">
        <small>© <?php echo date("Y"); ?> Esmond. All Rights Reserved.</small>
    </div>
</footer><!-- #colophon -->
<?php wp_footer(); ?>
</body>
</html>