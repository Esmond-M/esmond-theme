<?php
/*
 *  Author: Esmond Mccain
 *  URL: https://esmondmccain.com | @esmondblankboilerplatetheme
 *  Custom functions, support, custom post types and more.
 */

/*------------------------------------*\
	External Modules/Files
\*------------------------------------*/

// Load any external files you have here

/*------------------------------------*\
	Theme Support
\*------------------------------------*/

if (!isset($content_width))
{
    $content_width = 900;
}

if (function_exists('add_theme_support'))
{
    // Add Menu Support
    add_theme_support('menus');

    // Add Thumbnail Theme Support
    add_theme_support('post-thumbnails');
    add_image_size('large', 700, '', true); // Large Thumbnail
    add_image_size('medium', 250, '', true); // Medium Thumbnail
    add_image_size('small', 120, '', true); // Small Thumbnail
    add_image_size('custom-size', 700, 200, true); // Custom Thumbnail Size call using the_post_thumbnail('custom-size');

    
    add_theme_support('custom-header', array(
	'default-image'			=> get_template_directory_uri() . '/img/headers/default.jpg',
	'header-text'			=> false,
	'default-text-color'		=> '000',
	'width'				=> 1000,
	'height'			=> 198,
	'random-default'		=> false,
	'wp-head-callback'		=> $wphead_cb,
	'admin-head-callback'		=> $adminhead_cb,
	'admin-preview-callback'	=> $adminpreview_cb
    ));
	
    add_theme_support( 'custom-logo', array(
    'height' => null,
    'width'  => null,
     ) );

    // Enables post and comment RSS feed links to head
    add_theme_support('automatic-feed-links');

}

/*------------------------------------*\
	Functions
\*------------------------------------*/

// esmondblankboilerplatetheme Blank navigation
function esmondblankboilerplatetheme_nav()
{
	wp_nav_menu(
	array(
		'theme_location'  => 'header-menu',
		'menu'            => '',
		'container'       => 'div',
		'container_class' => 'main-nav',
		'container_id'    => '',
		'menu_class'      => 'menu',
		'menu_id'         => '',
		'echo'            => true,
		'fallback_cb'     => false,
		'before'          => '',
		'after'           => '',
		'link_before'     => '',
		'link_after'      => '',
		'items_wrap'      => '<ul id="menu-navbar" class="menu" >%3$s</ul>',
		'depth'           => 0,
		'walker'          => ''
		)
	);
}
// esmondblankboilerplatetheme Blank  mobile navigation
function esmondblankboilerplatetheme_nav_hamburger()
{
	wp_nav_menu(
	array(
		'theme_location'  => 'header-menu',
		'menu'            => '',
		'container'       => 'div',
		'container_class' => 'menu hamburger-menu',
		'container_id'    => '',
		'menu_class'      => 'menu',
		'menu_id'         => '',
		'echo'            => true,
		'fallback_cb'     => false,
		'before'          => '',
		'after'           => '',
		'link_before'     => '',
		'link_after'      => '',
		'items_wrap'      => '<ul class="menu-main-mobile" >%3$s</ul>',
		'depth'           => 0,
		'walker'          => ''
		)
	);
}

// esmondblankboilerplatetheme Blank  footer navigation
function esmondblankboilerplatetheme_footer_nav()
{
	wp_nav_menu(
	array(
		'theme_location'  => 'footer-menu',
		'menu'            => '',
		'container'       => 'div',
		'container_class' => 'footer-menu',
		'container_id'    => '',
		'menu_class'      => '',
		'menu_id'         => '',
		'echo'            => true,
		'fallback_cb'     => false,
		'before'          => '',
		'after'           => '',
		'link_before'     => '',
		'link_after'      => '',
		'items_wrap'      => '<ul class="" style="padding: 0;" >%3$s</ul>',
		'depth'           => 1,
		'walker'          => ''
		)
	);
}

// Load esmondblankboilerplatetheme Blank scripts
function esmondblankboilerplatetheme_scripts()
{
	    $rand = rand( 1, 99999999999 );
   	    wp_register_script('conditionizr', get_template_directory_uri() . '/js/lib/conditionizr-4.3.0.min.js', array(), '4.3.0'); // Conditionizr
        wp_enqueue_script('conditionizr'); // Enqueue it!

        wp_register_script('modernizr', get_template_directory_uri() . '/js/lib/modernizr-2.7.1.min.js', array(), '2.7.1'); // Modernizr
        wp_enqueue_script('modernizr'); // Enqueue it!

        wp_register_script('esmondblankboilerplatethemescripts', get_template_directory_uri() . '/js/public/scripts.js', array('jquery'), $rand ); // Custom scripts
        wp_enqueue_script('esmondblankboilerplatethemescripts'); // Enqueue it!	
}

// Load esmondblankboilerplatetheme Blank styles
function esmondblankboilerplatetheme_styles()
{
	$rand = rand( 1, 99999999999 );
    wp_register_style('normalize', get_template_directory_uri() . '/normalize.css', array(), '1.0', 'all');
    wp_enqueue_style('normalize'); // Enqueue it!

    wp_register_style('esmondblankboilerplatetheme', get_template_directory_uri() . '/style.css', array(), $rand, 'all');
    wp_enqueue_style('esmondblankboilerplatetheme'); // Enqueue it!
}

// Register esmondblankboilerplatetheme Blank Navigation
function register_esmondblankboilerplatetheme_menu()
{
    register_nav_menus(array( // Using array to specify more menus if needed
        'header-menu' => __('Header Menu', 'esmondblankboilerplatetheme'), // Main Navigation
        'sidebar-menu' => __('Sidebar Menu', 'esmondblankboilerplatetheme'), // Sidebar Navigation
        'footer-menu' => __('Footer Menu', 'esmondblankboilerplatetheme') // Extra Navigation if needed (duplicate as many as you need!)
    ));
}

// Remove invalid rel attribute values in the categorylist
function remove_category_rel_from_category_list($thelist)
{
    return str_replace('rel="category tag"', 'rel="tag"', $thelist);
}

// Add page slug to body class
function add_slug_to_body_class($classes)
{
    global $post;
    if (is_home()) {
        $key = array_search('blog', $classes);
        if ($key > -1) {
            unset($classes[$key]);
        }
    } elseif (is_page()) {
        $classes[] = sanitize_html_class($post->post_name);
    } elseif (is_singular()) {
        $classes[] = sanitize_html_class($post->post_name);
    }

    return $classes;
}

// If Dynamic Sidebar Exists
if (function_exists('register_sidebar'))
{
    // Define Sidebar Widget Area 1
    register_sidebar(array(
        'name' => __('Widget Area 1', 'esmondblankboilerplatetheme'),
        'description' => __('Description for this widget-area...', 'esmondblankboilerplatetheme'),
        'id' => 'widget-area-1',
        'before_widget' => '<div id="%1$s" class="%2$s">',
        'after_widget' => '</div>',
        'before_title' => '<h3>',
        'after_title' => '</h3>'
    ));

    // Define Sidebar Widget Area 2
    register_sidebar(array(
        'name' => __('Widget Area 2', 'esmondblankboilerplatetheme'),
        'description' => __('Description for this widget-area...', 'esmondblankboilerplatetheme'),
        'id' => 'widget-area-2',
        'before_widget' => '<div id="%1$s" class="%2$s">',
        'after_widget' => '</div>',
        'before_title' => '<h3>',
        'after_title' => '</h3>'
    ));
}

// Remove wp_head() injected Recent Comment styles
function my_remove_recent_comments_style()
{
    global $wp_widget_factory;
    remove_action('wp_head', array(
        $wp_widget_factory->widgets['WP_Widget_Recent_Comments'],
        'recent_comments_style'
    ));
}

// Pagination for paged posts
function esmondblankboilerplatethemewp_pagination()
{
    global $wp_query;
    $big = 999999999;
    echo paginate_links(array(
        'base' => str_replace($big, '%#%', get_pagenum_link($big)),
        'format' => '?paged=%#%',
        'current' => max(1, get_query_var('paged')),
        'total' => $wp_query->max_num_pages
    ));
}

// Custom Excerpts
function esmondblankboilerplatethemewp_index($length) // Create 20 Word Callback for Index page Excerpts, call using esmondblankboilerplatethemewp_excerpt('esmondblankboilerplatethemewp_index');
{
    return 20;
}

// Create 40 Word Callback for Custom Post Excerpts, call using esmondblankboilerplatethemewp_excerpt('esmondblankboilerplatethemewp_custom_post');
function esmondblankboilerplatethemewp_custom_post($length)
{
    return 40;
}

// Create the Custom Excerpts callback
function esmondblankboilerplatethemewp_excerpt($length_callback = '', $more_callback = '')
{
    global $post;
    if (function_exists($length_callback)) {
        add_filter('excerpt_length', $length_callback);
    }
    if (function_exists($more_callback)) {
        add_filter('excerpt_more', $more_callback);
    }
    $output = get_the_excerpt();
    $output = apply_filters('wptexturize', $output);
    $output = apply_filters('convert_chars', $output);
    $output = '<p>' . $output . '</p>';
    echo $output;
}

// Custom View Article link to Post
function esmondblankboilerplatetheme_blank_view_article($more)
{
    global $post;
    return '... <a class="view-article" href="' . get_permalink($post->ID) . '">' . __('View Article', 'esmondblankboilerplatetheme') . '</a>';
}

// Remove 'text/css' from our enqueued stylesheet
function esmondblankboilerplatetheme_style_remove($tag)
{
    return preg_replace('~\s+type=["\'][^"\']++["\']~', '', $tag);
}

// Remove thumbnail width and height dimensions that prevent fluid images in the_thumbnail
function remove_thumbnail_dimensions( $html )
{
    $html = preg_replace('/(width|height)=\"\d*\"\s/', "", $html);
    return $html;
}

// Custom Gravatar in Settings > Discussion
function esmondblankboilerplatethemegravatar ($avatar_defaults)
{
    $myavatar = get_template_directory_uri() . '/img/gravatar.jpg';
    $avatar_defaults[$myavatar] = "Custom Gravatar";
    return $avatar_defaults;
}

// Threaded Comments
function enable_threaded_comments()
{
    if (!is_admin()) {
        if (is_singular() AND comments_open() AND (get_option('thread_comments') == 1)) {
            wp_enqueue_script('comment-reply');
        }
    }
}

// Custom Comments Callback
function esmondblankboilerplatethemecomments($comment, $args, $depth)
{
	$GLOBALS['comment'] = $comment;
	extract($args, EXTR_SKIP);

	if ( 'div' == $args['style'] ) {
		$tag = 'div';
		$add_below = 'comment';
	} else {
		$tag = 'li';
		$add_below = 'div-comment';
	}
?>
    <!-- heads up: starting < for the html tag (li or div) in the next line: -->
    <<?php echo $tag ?> <?php comment_class(empty( $args['has_children'] ) ? '' : 'parent') ?> id="comment-<?php comment_ID() ?>">
	<?php if ( 'div' != $args['style'] ) : ?>
	<div id="div-comment-<?php comment_ID() ?>" class="comment-body">
	<?php endif; ?>
	<div class="comment-author vcard">
	<?php if ($args['avatar_size'] != 0) echo get_avatar( $comment, $args['180'] ); ?>
	<?php printf(__('<cite class="fn">%s</cite> <span class="says">says:</span>'), get_comment_author_link()) ?>
	</div>
<?php if ($comment->comment_approved == '0') : ?>
	<em class="comment-awaiting-moderation"><?php _e('Your comment is awaiting moderation.') ?></em>
	<br />
<?php endif; ?>

	<div class="comment-meta commentmetadata"><a href="<?php echo htmlspecialchars( get_comment_link( $comment->comment_ID ) ) ?>">
		<?php
			printf( __('%1$s at %2$s'), get_comment_date(),  get_comment_time()) ?></a><?php edit_comment_link(__('(Edit)'),'  ','' );
		?>
	</div>

	<?php comment_text() ?>

	<div class="reply">
	<?php comment_reply_link(array_merge( $args, array('add_below' => $add_below, 'depth' => $depth, 'max_depth' => $args['max_depth']))) ?>
	</div>
	<?php if ( 'div' != $args['style'] ) : ?>
	</div>
	<?php endif; ?>
<?php }

/*------------------------------------*\
	Nav Menu Functions
\*------------------------------------*/
/*
*
* Walker for the main menu 
*
*/

function addHamburgerCaret( $output, $item, $depth, $args ){

if('header-menu' == $args->theme_location){
    if (in_array("menu-item-has-children", $item->classes)) {
        $output .='<button class="hamburger-dropdown-btn" ><span class="sub-menu-toggle icon-em-caret-dwn"></span></button>';
    }
}
    return $output;
}

function addDesktopCaret( $output, $item, $depth, $args ){

if('header-menu' == $args->theme_location && $depth == 1){
    if (in_array("menu-item-has-children", $item->classes)) {
        $output .='<button class="desktop-dropdown-btn desktop-dropdown-caret" ><span class="sub-menu-toggle icon-em-caret-right"></span></button>';
    }
}
    return $output;
}
function change_ul_item_classes_in_nav( $classes, $args, $depth ) {

    if ( 0 == $depth ) {
        $classes[] = 'second-level-sub-menu';
    }
	
    if ( 1 == $depth ) {
        $classes[] = 'third-level-sub-menu';
    }
   
    return $classes;
}

/*------------------------------------*\
	Custom Post Types
\*------------------------------------*/

// Create Custom Post type for a Portfolio grid, called Portfolio items
function create_post_type_em_portfolio_items_1()
{
    register_taxonomy_for_object_type('category', 'esmond-b-theme-port'); // Register Taxonomies for Category
    register_taxonomy_for_object_type('post_tag', 'esmond-b-theme-port');
    register_post_type('esmond-b-theme-port', // Register Custom Post Type
        array(
        'labels' => array(
            'name' => __('EM Portfolio items', 'esmond-b-theme-port'), // Rename these to suit
            'singular_name' => __('Portfolio item', 'esmond-b-theme-port'),
            'add_new' => __('Add New', 'Portfolio item'),
            'add_new_item' => __('Add New Portfolio item Post', 'esmond-b-theme-port'),
            'edit' => __('Edit', 'esmond-b-theme-port'),
            'edit_item' => __('Edit Portfolio items Post', 'esmond-b-theme-port'),
            'new_item' => __('New Portfolio item Post', 'esmond-b-theme-port'),
            'view' => __('View Portfolio item Post', 'esmond-b-theme-port'),
            'view_item' => __('View Portfolio item Post', 'esmond-b-theme-port'),
            'search_items' => __('Search Portfolio item Post', 'esmond-b-theme-port'),
            'not_found' => __('No Portfolio item Posts found', 'esmond-b-theme-port'),
            'not_found_in_trash' => __('No Portfolio item Posts found in Trash', 'esmond-b-theme-port')
        ),
		'public' => false,  // it's not public, it shouldn't have it's own permalink, and so on
        'publicly_queryable' => true,  // you should be able to query it
        'show_ui' => true,  // you should be able to edit it in wp-admin
        'show_in_nav_menus' => false,  // you shouldn't be able to add it to menus
        'hierarchical' => true, // Allows your posts to behave like Hierarchy Pages
        'has_archive' => true,
        'supports' => array(
            'title',
            'thumbnail'
        ), // Go to Dashboard Custom Portfolio item post for supports
        'can_export' => true, // Allows export in Tools > Export
        'taxonomies' => array(
            'post_tag',
            'category'
        ) // Add Category and Post Tags support
    ));
	
}

/**
 Adding meta box for post
@return void
 */
function esmondBlankThemePortfolioCustomFields()
{
    $screens = ['esmond-b-theme-port'];
    foreach ($screens as $screen) {
        add_meta_box(
            'em_portfolio_two_metaboxes',    // Unique ID
            'Portfolio Fields',  // Box title
            'esmondBlankThemePortfolioCustomFieldsHtml',
            $screen,                  // Post type
            'normal',
            'high'
        );
    }
}
/**
Styles for custom metabox on backend
@param $post callback
@return callable
 */
function esmondBlankThemePortfolioCustomFieldsHtml($post)
{
  ?>
    <style type="text/css">
        .post_meta_extras p {
            margin: 20px;
        }

        .post_meta_extras label {
            display: block;
            margin-bottom: 10px;
        }
		#em-portfolio-image-metaboxes .error {
            color: red;
        } 
    </style>
<?php 
// Add an nonce field so we can check for it later.
wp_nonce_field( 'em_portfolio_custom_fields', 'em_portfolio_custom_fields_nonce' );

// Use get_post_meta to retrieve an existing value from the database.
$portfolio_project_description_value = get_post_meta( $post->ID, 'em_portfolio_project_description', true );
$portfolio_project_name_value = get_post_meta( $post->ID, 'em_portfolio_project_name', true );

// Display the form, using the current value.
?>
	<style>
	#postimagediv {
    display: none;
    } 
	</style>
    <div class="post_meta_extras">
        <p>
            <label>Portfolio Button Description</label>
            <textarea name="em_portfolio_project_description" rows="8" cols="50"><?php echo esc_attr( $portfolio_project_description_value ); ?></textarea>
            <label>Project Name</label>
			<input class="" type="text" name="em_portfolio_project_name"  value="<?php echo esc_attr( $portfolio_project_name_value ); ?>" size="30" />
        </p>
    </div>
    <?php
}

/**
Save meta box value to database
@param $post_id of wordpress post
@return string
 */
function esmondBlankThemePortfolioSaveCustomFields($post_id)
{
/*
 * We need to verify this came from the our screen and with proper authorization,
 * because save_post can be triggered at other times.
 */

// Check if our nonce is set.
if ( ! isset( $_POST['em_portfolio_custom_fields_nonce'] ) ) {
    return $post_id;
}

$nonce = $_POST['em_portfolio_custom_fields_nonce'];

// Verify that the nonce is valid.
if ( ! wp_verify_nonce( $nonce, 'em_portfolio_custom_fields' ) ) {
    return $post_id;
}

/*
 * If this is an autosave, our form has not been submitted,
 * so we don't want to do anything.
 */
if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
    return $post_id;
}

// Check the user's permissions.
if ( 'page' == $_POST['post_type'] ) {
    if ( ! current_user_can( 'edit_page', $post_id ) ) {
        return $post_id;
    }
} else {
    if ( ! current_user_can( 'edit_post', $post_id ) ) {
        return $post_id;
    }
}

/* OK, it's safe for us to save the data now. */

// Sanitize the user input.
$portfolio_project_description_input_data = sanitize_text_field( $_POST['em_portfolio_project_description'] );
$portfolio_project_name_input_data = sanitize_text_field( $_POST['em_portfolio_project_name'] );


// Update the meta field.
update_post_meta( $post_id, 'em_portfolio_project_description', $portfolio_project_description_input_data );
update_post_meta( $post_id, 'em_portfolio_project_name', $portfolio_project_name_input_data );
}

function em_portfolio_image_add_metabox () {
	add_meta_box(
		'em-portfolio-image-metaboxes', // Unique ID
		__( 'Portfolio featured Image', 'text-domain' ) ,
		'em_portfolio_image_metabox',
		'esmond-b-theme-port',
		'normal',
		'low'
	);
}

function em_portfolio_image_metabox ( $post ) {
	global $content_width, $_wp_additional_image_sizes;

	$image_id = get_post_meta( $post->ID, 'em_portfolio_project_image_id', true );

	$old_content_width = $content_width;
	$content_width = 254;

	if ( $image_id && get_post( $image_id ) ) {

		if ( ! isset( $_wp_additional_image_sizes['post-thumbnail'] ) ) {
			$thumbnail_html = wp_get_attachment_image( $image_id, array( $content_width, $content_width ) );
		} else {
			$thumbnail_html = wp_get_attachment_image( $image_id, 'post-thumbnail' );
		}

		if ( ! empty( $thumbnail_html ) ) {
			$content = $thumbnail_html;
			$content .= '<p class="hide-if-no-js"><a href="javascript:;" id="remove_em_portfolio_image_button" >' . esc_html__( 'Remove Project image', 'esmondblankboilerplatetheme' ) . '</a></p>';
			$content .= '<input type="hidden" id="upload_em_portfolio_image" name="em_portfolio_project_image" value="' . esc_attr( $image_id ) . '"  required />';
		}

		$content_width = $old_content_width;
	} else {

		$content = '<img src="" style="width:' . esc_attr( $content_width ) . 'px;height:auto;border:0;display:none;" />';
		$content .= '<p class="hide-if-no-js"><a title="' . esc_attr__( 'Set Portfolio image', 'text-domain' ) . '" href="javascript:;" id="upload_em_portfolio_image_button" id="set-em-portfolio-image" data-uploader_title="' . esc_attr__( 'Choose an image', 'esmondblankboilerplatetheme' ) . '" data-uploader_button_text="' . esc_attr__( 'Set Project image', 'esmondblankboilerplatetheme' ) . '">' . esc_html__( 'Set Portfolio image', 'text-domain' ) . '</a></p>';
		$content .= '<input type="hidden" id="upload_em_portfolio_image" name="em_portfolio_project_image" value=""  required />';

	}

	echo $content;
}

function em_portfolio_image_save ( $post_id ) {
	if( isset( $_POST['em_portfolio_project_image'] ) ) {
		$image_id = (int) $_POST['em_portfolio_project_image'];
		update_post_meta( $post_id, 'em_portfolio_project_image_id', $image_id );
	}
	
}

function em_post_type_portfolio_admin_script( $hook ) {
	$rand = rand( 1, 99999999999 );
	global $post_type;
    if( 'esmond-b-theme-port' == $post_type ) {
		wp_enqueue_script( 'em_post_type_portfolio_script', get_stylesheet_directory_uri() . '/js/admin/em-post-type-portfolio.js', array('jquery'), $rand, true );
		wp_enqueue_script( 'em_post_type_portfolio_validate', get_stylesheet_directory_uri() . '/js/admin/jquery.validate.min.js', array('jquery'), $rand, true );
	}
    
}

/*------------------------------------*\
	Actions + Filters
\*------------------------------------*/

// Add Actions

add_action('wp_enqueue_scripts', 'esmondblankboilerplatetheme_scripts'); // Add Conditional Page Scripts
add_action('get_header', 'enable_threaded_comments'); // Enable Threaded Comments
add_action('wp_enqueue_scripts', 'esmondblankboilerplatetheme_styles'); // Add Theme Stylesheet
add_action('init', 'register_esmondblankboilerplatetheme_menu'); // Add esmondblankboilerplatetheme Blank Menu
add_action('init', 'create_post_type_em_portfolio_items_1'); // Add our Portfolio items Post Type
add_action('widgets_init', 'my_remove_recent_comments_style'); // Remove inline Recent Comment Styles from wp_head()
add_action('init', 'esmondblankboilerplatethemewp_pagination'); // Add our esmondblankboilerplatetheme Pagination
add_action('add_meta_boxes', 'esmondBlankThemePortfolioCustomFields');
add_action('save_post', 'esmondBlankThemePortfolioSaveCustomFields');
add_action( 'add_meta_boxes', 'em_portfolio_image_add_metabox' );
add_action( 'save_post', 'em_portfolio_image_save', 10, 1 );
add_action( 'admin_enqueue_scripts', 'em_post_type_portfolio_admin_script' );

// Remove Actions
remove_action('wp_head', 'feed_links_extra', 3); // Display the links to the extra feeds such as category feeds
remove_action('wp_head', 'feed_links', 2); // Display the links to the general feeds: Post and Comment Feed
remove_action('wp_head', 'rsd_link'); // Display the link to the Really Simple Discovery service endpoint, EditURI link
remove_action('wp_head', 'wlwmanifest_link'); // Display the link to the Windows Live Writer manifest file.
remove_action('wp_head', 'index_rel_link'); // Index link
remove_action('wp_head', 'parent_post_rel_link', 10, 0); // Prev link
remove_action('wp_head', 'start_post_rel_link', 10, 0); // Start link
remove_action('wp_head', 'adjacent_posts_rel_link', 10, 0); // Display relational links for the posts adjacent to the current post.
remove_action('wp_head', 'wp_generator'); // Display the XHTML generator that is generated on the wp_head hook, WP version
remove_action('wp_head', 'adjacent_posts_rel_link_wp_head', 10, 0);
remove_action('wp_head', 'rel_canonical');
remove_action('wp_head', 'wp_shortlink_wp_head', 10, 0);

// Add Filters
add_filter('avatar_defaults', 'esmondblankboilerplatethemegravatar'); // Custom Gravatar in Settings > Discussion
add_filter('body_class', 'add_slug_to_body_class'); // Add slug to body class (Starkers build)
add_filter('widget_text', 'do_shortcode'); // Allow shortcodes in Dynamic Sidebar
add_filter('widget_text', 'shortcode_unautop'); // Remove <p> tags in Dynamic Sidebars (better!)
add_filter('the_category', 'remove_category_rel_from_category_list'); // Remove invalid rel attribute
add_filter('the_excerpt', 'shortcode_unautop'); // Remove auto <p> tags in Excerpt (Manual Excerpts only)
add_filter('the_excerpt', 'do_shortcode'); // Allows Shortcodes to be executed in Excerpt (Manual Excerpts only)
add_filter('excerpt_more', 'esmondblankboilerplatetheme_blank_view_article'); // Add 'View Article' button instead of [...] for Excerpts
add_filter('style_loader_tag', 'esmondblankboilerplatetheme_style_remove'); // Remove 'text/css' from enqueued stylesheet
add_filter('post_thumbnail_html', 'remove_thumbnail_dimensions', 10); // Remove width and height dynamic attributes to thumbnails
add_filter('image_send_to_editor', 'remove_thumbnail_dimensions', 10); // Remove width and height dynamic attributes to post images
add_filter( 'walker_nav_menu_start_el', 'addHamburgerCaret',10,4); // Only add caret element to 'sub level' items on the mobile menu.
add_filter( 'walker_nav_menu_start_el', 'addDesktopCaret',10,4); // Only add caret element to 'sub level' items on the desktop menu.
add_filter( 'nav_menu_submenu_css_class', 'change_ul_item_classes_in_nav', 10, 3 );

// Remove Filters
remove_filter('the_excerpt', 'wpautop'); // Remove <p> tags from Excerpt altogether
