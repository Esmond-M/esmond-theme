<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package website-theme-name
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

	<header id="masthead" class="site-header">
	<div class="site-branding">
		 <?php       

     $custom_logo_id = get_theme_mod( 'custom_logo' );
     $logo = wp_get_attachment_image_src( $custom_logo_id , 'full' );
     if ( has_custom_logo() ) {
           $custom_logo_image = esc_url( $logo[0] );
     } else {
            $custom_logo_image = get_template_directory_uri() . '/img/logo-placeholder-image.png';
     }
     ?>
     <a href="<?php echo home_url(); ?>"><img class="site-branding-img" src="<?php echo  $custom_logo_image; ?>" alt="Logo" class="logo-img"></a> 
			
		
		</div><!-- .site-branding -->
		<?php 
			wp_nav_menu(
				array(
					'container'            => '',
					'container_class'      => '',
					'container_id'         => '',
					'container_aria_label' => '',
					'menu_class'           => 'menu',
					'menu_id'              => 'primary-menu',
					'echo'                 => true,
					'fallback_cb'          => 'wp_page_menu',
					'before'               => '',
					'after'                => '',
					'link_before'          => '',
					'link_after'           => '',
					'items_wrap'           => '<ul id="%1$s" class="%2$s">%3$s</ul>',
					'item_spacing'         => 'preserve',
					'depth'                => 0,
					'walker'               => '',
					'theme_location' => 'primary',
				)
			);
			?>
	

	<button class="emTheme-openbtn"><i class="fas fa-bars"></i> Menu</button>
		<div id="mySidenav" class="sidenav">
			<a href="javascript:void(0)" class="emTheme-closebtn">Close <i class="fa fa-times" aria-hidden="true"></i></a>
			<?php 
			wp_nav_menu(
				array(
					'container'            => '',
					'container_class'      => '',
					'container_id'         => '',
					'container_aria_label' => '',
					'menu_class'           => 'menu',
					'menu_id'              => 'primary-menu',
					'echo'                 => true,
					'fallback_cb'          => 'wp_page_menu',
					'before'               => '',
					'after'                => '',
					'link_before'          => '',
					'link_after'           => '',
					'items_wrap'           => '<ul id="%1$s" class="%2$s">%3$s</ul>',
					'item_spacing'         => 'preserve',
					'depth'                => 0,
					'walker'               => '',
					'theme_location' => 'primary',
				)
			);
			?>

	</header><!-- #masthead -->
