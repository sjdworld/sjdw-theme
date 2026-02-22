<?php
/**
 * The WoocartWidget class file.
 *
 * @package Sjdworld\SjdwTheme\Widgets
 */

namespace Sjdworld\SjdwTheme\Widgets;

use WP_Widget;

/**
 * The WoocartWidget class.
 */
class WoocartWidget extends WP_Widget {

	/**
	 * Initialize class.
	 */
	public function __construct() {

		// Invoke parent.
		parent::__construct(
			'sjdw_woocart_widget',
			'SJDW - WooCommerce Cart Icon',
		);
	}

	/**
	 * Initialize the widgets.
	 *
	 * @return void
	 */
	public function init(): void {

		// Register widget.
		add_action(
			'widgets_init',
			function () {
				register_widget( self::class );
			}
		);
	}

	/**
	 * Echoes the widget content.
	 *
	 * @param mixed $args     The Display arguments.
	 * @param mixed $instance The instance for the this widget.
	 * @return void
	 */
	public function widget( $args, $instance ): void {

		$title      = isset( $instance['title'] ) ? esc_html( $instance['title'] ) : '';
		$show_count = isset( $instance['show_count'] ) ? absint( $instance['show_count'] ) : 0;

		$html = $args['before_widget'];

		if ( ! empty( $title ) ) {
			$html .= $args['before_title'] . apply_filters( 'widget_title', $title ) . $args['after_title'];
		}

		if ( function_exists( 'WC' ) && function_exists( 'wc_get_cart_url' ) ) {

			$args = array(
				'link'       => wc_get_cart_url(),
				'count'      => ! empty( WC()->cart ) ? WC()->cart->get_cart_contents_count() : 0,
				'show_count' => $show_count,
			);

			ob_start();
			get_template_part( 'template-parts/woocart', 'icon', $args );
			$html .= ob_get_clean();

		}

		$html .= $args['after_widget'];

		echo $html; //phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
	}

	/**
	 * Outputs the settings form.
	 *
	 * @param  mixed $instance Current settings.
	 * @return string
	 */
	public function form( $instance ): string {

		$title      = isset( $instance['title'] ) ? esc_html( $instance['title'] ) : '';
		$show_count = isset( $instance['show_count'] ) ? absint( $instance['show_count'] ) : 0;

		// Title.
		$html  = '<p class="form-group">';
		$html .= wp_sprintf(
			'<label>%1$s</label><input type="text" name="%2$s" value="%3$s" class="widefat">',
			esc_html__( 'Title', 'sjdw-theme' ),
			$this->get_field_name( 'title' ),
			esc_attr( $title )
		);
		$html .= '</p>';

		// Show Month.
		$html .= '<p class="form-group">';
		$html .= wp_sprintf(
			'<input type="checkbox" class="checkbox" id="%1$s" name="%2$s" value="1" %3$s />
			<label for="%1$s">%4$s</label>',
			uniqid( 'show_count' ),
			$this->get_field_name( 'show_count' ),
			checked( $show_count, 1, false ),
			esc_html__( 'Show Count', 'sjdw-theme' ),
		);
		$html .= '</p>';

		echo $html; //phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped

		return '';
	}
}
