<?php
/**
 * The ContactWidget class file.
 *
 * @package Sjdworld\SjdwTheme\Widgets
 */

namespace Sjdworld\SjdwTheme\Widgets;

use WP_Widget;

/**
 * The ContactWidget class.
 */
class ContactWidget extends WP_Widget {

	/**
	 * Initiate the class.
	 */
	public function __construct() {

		// Invoke parent.
		parent::__construct(
			'sjdw_contact_widget',
			'SJDW - Contact & Social Links'
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

		$instance = wp_parse_args(
			$instance,
			array(
				'title'     => '',
				'address'   => '',
				'phone'     => '',
				'email'     => '',
				'facebook'  => '',
				'twitter'   => '',
				'instagram' => '',
				'linkedin'  => '',
				'youtube'   => '',
			)
		);

		$html = $args['before_widget'];

		if ( ! empty( $instance['title'] ) ) {
			$html .= $args['before_title'] . apply_filters( 'widget_title', $instance['title'] ) . $args['after_title'];
		}

		ob_start();
		get_template_part( 'template-parts/contact', 'icons', $instance );
		$html .= ob_get_clean();
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

		$instance = wp_parse_args(
			$instance,
			array(
				'title'     => '',
				'address'   => '',
				'phone'     => '',
				'email'     => '',
				'facebook'  => '',
				'twitter'   => '',
				'instagram' => '',
				'linkedin'  => '',
				'youtube'   => '',
			)
		);

		// Title.
		$html = $this->render_field( 'title', $instance['title'], __( 'Title', 'sjdw-theme' ) );

		// Address.
		$html .= $this->render_field( 'address', $instance['address'], __( 'Address', 'sjdw-theme' ) );

		// Phone.
		$html .= $this->render_field( 'phone', $instance['phone'], __( 'Phone', 'sjdw-theme' ) );

		// Email.
		$html .= $this->render_field( 'email', $instance['email'], __( 'Email', 'sjdw-theme' ) );

		// Facebook.
		$html .= $this->render_field( 'facebook', $instance['facebook'], __( 'Facebook Link', 'sjdw-theme' ) );

		// Twitter.
		$html .= $this->render_field( 'twitter', $instance['twitter'], __( 'Twitter Link', 'sjdw-theme' ) );

		// Instagram.
		$html .= $this->render_field( 'instagram', $instance['instagram'], __( 'Instagram Link', 'sjdw-theme' ) );

		// Linkedin.
		$html .= $this->render_field( 'linkedin', $instance['linkedin'], __( 'Linkedin Link', 'sjdw-theme' ) );

		// Youtube.
		$html .= $this->render_field( 'youtube', $instance['youtube'], __( 'Youtube Link', 'sjdw-theme' ) );

		echo $html; //phpcs:ignore WordPress.Security.EscapeOutput

		return '';
	}

	/**
	 * Render the form field output.
	 *
	 * @param string $name  The field name.
	 * @param string $value The field value.
	 * @param string $label The field label.
	 *
	 * @return string
	 */
	private function render_field( string $name, string $value, string $label ): string {

		$html  = '<p class="form-group">';
		$html .= wp_sprintf(
			'<label>%1$s</label><input type="text" name="%2$s" value="%3$s" class="widefat">',
			esc_html( $label ),
			$this->get_field_name( $name ),
			esc_attr( $value )
		);
		$html .= '</p>';

		return $html;
	}
}
