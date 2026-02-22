<?php
/**
 * The Page class file.
 *
 * @package Sjdworld\SjdwTheme\Posts
 */

namespace Sjdworld\SjdwTheme\Posts;

use WP_Post;

/**
 * The Page class.
 */
class Page {

	/**
	 * Initialise functions.
	 *
	 * @return void
	 */
	public function init(): void {

		// Register shortcodes.
		add_filter( 'body_class', array( $this, 'body_class' ) );
	}

	/**
	 * Initialise functions.
	 *
	 * @return void
	 */
	public function admin_init(): void {

		// Add meta box.
		add_action(
			'add_meta_boxes_page',
			function ( WP_Post $post ) { // phpcs:ignore Generic.CodeAnalysis.UnusedFunctionParameter
				add_meta_box(
					'sjdw-theme-page-additional',
					__( 'Options', 'sjdw-theme' ),
					array( $this, 'render_additional_meta' ),
					'page',
					'side'
				);
			}
		);

		// Save meta box.
		add_action( 'save_post_page', array( $this, 'save_meta_boxes' ) );
	}

	/**
	 * Add the body class.
	 *
	 * @param string[] $classes An array of body class names.
	 *
	 * @return string[]
	 */
	public function body_class( array $classes ): array {

		if ( is_page() || is_home() || is_category() ) {

			if ( is_home() || is_category() ) {
				$page_id = (int) get_option( 'page_for_posts' );
			} else {
				$page_id = get_the_ID();
			}

			// Get the body_class.
			$body_class = get_post_meta( $page_id, '_body_class', true );

			if ( ! empty( $body_class ) ) {
				$classes[] = $body_class;
			}
		}

		return $classes;
	}

	/**
	 * Meta box display callback.
	 *
	 * @param WP_Post $post Current post object.
	 *
	 * @return void
	 */
	public function render_additional_meta( WP_Post $post ): void {

		$body_class = get_post_meta( $post->ID, '_body_class', true );
		$hide_title = (int) get_post_meta( $post->ID, '_hide_title', true );

		// Nonce.
		$html = wp_nonce_field( basename( __FILE__ ), 'sjdw_nonce', false, false );

		// Title.
		$html .= '<p class="form-group">';
		$html .= wp_sprintf(
			'<label class="form-label">%1$s</label>
			<input type="text" name="body_class" value="%2$s" class="widefat">',
			esc_html__( 'Body CSS Class', 'sjdw-theme' ),
			esc_attr( $body_class )
		);
		$html .= '</p>';

		// Hide Title.
		$html .= '<p class="form-group">';
		$html .= wp_sprintf(
			'<input type="checkbox" class="checkbox" id="%1$s" name="hide_title" value="1" %2$s />
			<label for="%1$s">%3$s</label>',
			uniqid( 'hide_title' ),
			checked( $hide_title, 1, false ),
			esc_html__( 'Hide Page Title', 'sjdw-theme' ),
		);
		$html .= '</p>';

		echo $html; //phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
	}

	/**
	 * Save meta box content.
	 *
	 * @param int $post_id Post ID.
	 *
	 * @return void
	 */
	public function save_meta_boxes( $post_id ): void {

		// Exit if not save.
		if (
			( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) ||
			! current_user_can( 'edit_page', $post_id ) ||
			empty( $_POST['sjdw_nonce'] ) ||
			! wp_verify_nonce( sanitize_text_field( wp_unslash( $_POST['sjdw_nonce'] ) ), basename( __FILE__ ) )
		) {
			return;
		}

		$post       = wp_unslash( $_POST );
		$body_class = isset( $post['body_class'] ) ? sanitize_text_field( $post['body_class'] ) : '';
		$hide_title = isset( $post['hide_title'] ) ? absint( $post['hide_title'] ) : 0;

		// Update the post details.
		update_post_meta( $post_id, '_body_class', $body_class );
		update_post_meta( $post_id, '_hide_title', $hide_title );
	}
}
