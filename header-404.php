<?php
/**
 * The header for our theme
 *
 * Displays the <head> section and everything up until <main>.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 * @package esmond-theme-portfolio
 */
?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="profile" href="https://gmpg.org/xfn/11">
    <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php wp_body_open(); ?>
<div id="page" class="site">
    <div class="emTheme-fixedheader-placeholder" aria-hidden="true"></div>
    <header id="masthead" class="site-header" role="banner">
        <nav id="site-navigation" class="main-navigation" aria-label="Primary Menu">
            <?php 
                wp_nav_menu(
                    array(
                        'menu'                 => 16,
                        'container'            => false,
                        'menu_class'           => 'menu',
                        'menu_id'              => 'primary-menu',
                        'echo'                 => true,
                        'fallback_cb'          => 'wp_page_menu',
                        'items_wrap'           => '<ul id="%1$s" class="%2$s">%3$s</ul>',
                        'theme_location'       => 'primary_menu',
                    )
                );
            ?>
        </nav>
    </header><!-- #masthead -->