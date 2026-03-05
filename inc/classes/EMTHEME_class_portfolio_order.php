<?php
declare(strict_types=1);

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Adds a drag-and-drop order manager page under the EM Portfolio post type menu.
 * Saves order by writing menu_order on each post via AJAX.
 */
class EMTHEME_Portfolio_Order {

	public function __construct() {
		add_action( 'admin_menu', [ $this, 'add_order_page' ] );
		add_action( 'admin_enqueue_scripts', [ $this, 'enqueue_scripts' ] );
		add_action( 'wp_ajax_em_save_portfolio_order', [ $this, 'save_order' ] );
	}

	public function add_order_page(): void {
		add_submenu_page(
			'edit.php?post_type=esmond-portfolio',
			'Reorder Portfolio',
			'Reorder',
			'edit_posts',
			'em-portfolio-order',
			[ $this, 'render_page' ]
		);
	}

	public function enqueue_scripts( string $hook ): void {
		if ( 'esmond-portfolio_page_em-portfolio-order' !== $hook ) {
			return;
		}
		wp_enqueue_script(
			'em-portfolio-order',
			get_stylesheet_directory_uri() . '/assets/js/admin-portfolio-order.js',
			[ 'jquery', 'jquery-ui-sortable' ],
			'1.0.0',
			true
		);
		wp_localize_script( 'em-portfolio-order', 'emPortfolioOrder', [
			'ajaxUrl' => admin_url( 'admin-ajax.php' ),
			'nonce'   => wp_create_nonce( 'em_portfolio_order' ),
		] );
	}

	public function render_page(): void {
		if ( ! current_user_can( 'edit_posts' ) ) {
			wp_die( esc_html__( 'You do not have permission to access this page.', 'esmond-theme-portfolio' ) );
		}

		$posts = get_posts( [
			'post_type'      => 'esmond-portfolio',
			'post_status'    => 'publish',
			'posts_per_page' => -1,
			'orderby'        => 'menu_order',
			'order'          => 'ASC',
		] );
		?>
		<div class="wrap">
			<h1>Reorder Portfolio</h1>
			<p style="color:#666;">Drag items into the order you want them to appear on the front page, then click <strong>Save Order</strong>.</p>

			<ul id="em-sortable-portfolio" style="margin-top:16px;">
				<?php foreach ( $posts as $post ) : ?>
					<li class="em-order-item" data-id="<?php echo esc_attr( (string) $post->ID ); ?>">
						<span class="dashicons dashicons-menu" style="vertical-align:middle;margin-right:8px;color:#999;cursor:grab;"></span>
						<?php echo esc_html( $post->post_title ); ?>
						<span class="em-order-badge"><?php echo esc_html( (string) $post->menu_order ); ?></span>
					</li>
				<?php endforeach; ?>
			</ul>

			<p style="margin-top:16px;">
				<button id="em-save-order" class="button button-primary">Save Order</button>
				<span id="em-order-notice" style="margin-left:12px;display:none;"></span>
			</p>
		</div>

		<style>
			#em-sortable-portfolio {
				max-width: 560px;
				list-style: none;
				padding: 0;
				margin: 0;
			}
			.em-order-item {
				background: #fff;
				border: 1px solid #ddd;
				border-radius: 4px;
				padding: 10px 14px;
				margin-bottom: 6px;
				cursor: grab;
				display: flex;
				align-items: center;
				font-size: 14px;
				user-select: none;
			}
			.em-order-item:active { cursor: grabbing; }
			.em-order-item.ui-sortable-helper {
				box-shadow: 0 4px 12px rgba(0,0,0,0.15);
				border-color: #2271b1;
			}
			.em-order-item.ui-sortable-placeholder {
				background: #f0f6fc;
				border: 2px dashed #2271b1;
				visibility: visible !important;
			}
			.em-order-badge {
				margin-left: auto;
				background: #f0f0f0;
				border-radius: 10px;
				padding: 2px 8px;
				font-size: 12px;
				color: #888;
				min-width: 24px;
				text-align: center;
			}
		</style>

		<?php
	}

	public function save_order(): void {
		check_ajax_referer( 'em_portfolio_order', 'nonce' );

		if ( ! current_user_can( 'edit_posts' ) ) {
			wp_send_json_error( 'Insufficient permissions.' );
		}

		$ids = isset( $_POST['ids'] ) ? (array) $_POST['ids'] : [];

		if ( empty( $ids ) ) {
			wp_send_json_error( 'No items received.' );
		}

		foreach ( $ids as $index => $id ) {
			$post_id = absint( $id );
			if ( ! $post_id ) {
				continue;
			}
			// Verify the post belongs to the right post type before updating
			if ( get_post_type( $post_id ) !== 'esmond-portfolio' ) {
				continue;
			}
			wp_update_post( [
				'ID'         => $post_id,
				'menu_order' => $index,
			] );
		}

		wp_send_json_success();
	}


}

new EMTHEME_Portfolio_Order();
