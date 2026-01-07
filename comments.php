<?php
/**
 * The template for displaying comments.
 *
 * @package Sjdworld\SjdwTheme
 */

declare(strict_types=1);

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

if ( post_password_required() ) {
	return;
}
?>

<div id="comments" class="comments-area">

	<?php if ( have_comments() ) : ?>
		<h3 class="comments-title">
			<?php
			$sjdw_theme_comments_number = get_comments_number();
			if ( 1 === $sjdw_theme_comments_number ) {
				printf(
					/* translators: 1: Post title */
					esc_html_x( 'One thought on &ldquo;%1$s&rdquo;', 'comments title', 'sjdw-theme' ),
					esc_html( get_the_title() )
				);
			} else {
				printf(
					esc_html(
						/* translators: 1: number of comments, 2: post title */
						_nx(
							'%1$s thought on &ldquo;%2$s&rdquo;',
							'%1$s thoughts on &ldquo;%2$s&rdquo;',
							$sjdw_theme_comments_number,
							'comments title',
							'sjdw-theme'
						),
					),
					esc_html( number_format_i18n( $sjdw_theme_comments_number ) ),
					esc_html( get_the_title() )
				);
			}
			?>
		</h3>

		<?php the_comments_navigation(); ?>

		<ol class="comment-list">
			<?php
			wp_list_comments(
				array(
					'style'       => 'ol',
					'short_ping'  => true,
					'avatar_size' => 42,
				)
			);
			?>
		</ol>

		<?php the_comments_navigation(); ?>

	<?php endif; ?>

	<?php if ( ! comments_open() && get_comments_number() && post_type_supports( get_post_type(), 'comments' ) ) : ?>
		<p class="no-comments"><?php esc_html_e( 'Comments are closed.', 'sjdw-theme' ); ?></p>
	<?php endif; ?>

	<?php comment_form( array( 'class_submit' => 'btn btn-primary' ) ); ?>

</div>
