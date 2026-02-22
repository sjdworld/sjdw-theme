<?php
/**
 * The Post class file.
 *
 * @package Sjdworld\SjdwTheme\Posts
 */

namespace Sjdworld\SjdwTheme\Posts;

use WP_Post;

/**
 * The Page class.
 */
class Post {

	/**
	 * Initialise functions.
	 *
	 * @return void
	 */
	public function admin_init(): void {

		// Add meta box.
		add_action( 'add_meta_boxes_post', array( $this, 'add_meta_boxes' ) );

		// Save meta box.
		add_action( 'save_post_post', array( $this, 'save_meta_boxes' ) );
	}

	/**
	 * Add meta boxes.
	 *
	 * @param WP_Post $post The active post.
	 *
	 * @return void
	 */
	public function add_meta_boxes( WP_Post $post ): void { //phpcs:ignore Generic.CodeAnalysis.UnusedFunctionParameter

		add_meta_box(
			'sjdw-theme-post-additional',
			__( 'Options', 'sjdw-theme' ),
			array( $this, 'render_additional_meta' ),
			'post',
			'side'
		);

		add_meta_box(
			'sjdw-theme-post-video',
			__( 'Video', 'sjdw-theme' ),
			array( $this, 'render_video_meta' ),
			'post',
			'side'
		);
	}

	/**
	 * Meta box display callback.
	 *
	 * @param WP_Post $post Current post object.
	 *
	 * @return void
	 */
	public function render_additional_meta( WP_Post $post ): void {

		$external_link = get_post_meta( $post->ID, '_external_link', true );
		$link_target   = get_post_meta( $post->ID, '_link_target', true );

		// Nonce.
		$html = wp_nonce_field( basename( __FILE__ ), 'sjdw_nonce', false, false );

		// Title.
		$html .= '<p class="form-group">';
		$html .= wp_sprintf(
			'<label class="form-label">%1$s</label>
			<input type="text" name="external_link" value="%2$s" class="widefat">',
			esc_html__( 'External Link', 'sjdw-theme' ),
			esc_attr( $external_link )
		);
		$html .= '</p>';

		// Hide Title.
		$html .= '<p class="form-group">';
		$html .= wp_sprintf(
			'<input type="checkbox" class="checkbox" id="%1$s" name="link_target" value="_blank" %2$s />
			<label for="%1$s">%3$s</label>',
			uniqid( 'link_target' ),
			checked( $link_target, '_blank', false ),
			esc_html__( 'Open link in new Tab', 'sjdw-theme' ),
		);
		$html .= '</p>';

		echo $html; //phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
	}

	/**
	 * Meta box display callback.
	 *
	 * @param WP_Post $post Current post object.
	 *
	 * @return void
	 */
	public function render_video_meta( WP_Post $post ): void {

		$featured_video = get_post_meta( $post->ID, '_featured_video', true );

		// Video.
		$html  = '<p class="form-group">';
		$html .= wp_sprintf(
			'<label class="form-label">%1$s</label>
			<input type="text" name="featured_video" value="%2$s" class="widefat">',
			esc_html__( 'Youtube Video ID', 'sjdw-theme' ),
			esc_attr( $featured_video )
		);
		$html .= '</p>';

		if ( ! empty( $featured_video ) ) {
			$html .= '<iframe width="100%" height="auto"
				src="https://www.youtube-nocookie.com/embed/' . esc_attr( $featured_video ) . '" frameborder="0"
				allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture"
				rel="0" allowfullscreen></iframe>';
		}

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
			! current_user_can( 'edit_posts', $post_id ) ||
			empty( $_POST['sjdw_nonce'] ) ||
			! wp_verify_nonce( sanitize_text_field( wp_unslash( $_POST['sjdw_nonce'] ) ), basename( __FILE__ ) )
		) {
			return;
		}

		$post           = wp_unslash( $_POST );
		$external_link  = isset( $post['external_link'] ) ? esc_url( $post['external_link'] ) : '';
		$link_target    = isset( $post['link_target'] ) ? sanitize_text_field( $post['link_target'] ) : '';
		$featured_video = isset( $post['featured_video'] ) ? sanitize_text_field( $post['featured_video'] ) : '';

		// Update the post details.
		update_post_meta( $post_id, '_external_link', $external_link );
		update_post_meta( $post_id, '_link_target', $link_target );
		update_post_meta( $post_id, '_featured_video', $featured_video );
	}
}
