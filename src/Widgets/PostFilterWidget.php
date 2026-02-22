<?php
/**
 * The PostFilterWidget class file.
 *
 * @package Sjdworld\SjdwTheme\Widgets
 */

namespace Sjdworld\SjdwTheme\Widgets;

use WP_Widget;

/**
 * The PostFilterWidget class.
 */
class PostFilterWidget extends WP_Widget {

	/**
	 * Initiate the class.
	 */
	public function __construct() {

		// Invoke parent.
		parent::__construct(
			'sjdw_post_filter_widget',
			'SJDW - Year & Month Filter'
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

		global $wpdb;

		$title      = isset( $instance['title'] ) ? esc_html( $instance['title'] ) : '';
		$show_month = isset( $instance['show_month'] ) ? absint( $instance['show_month'] ) : 0;
		$year       = (int) get_query_var( 'year' );
		$years      = array();
		$monthnum   = (int) get_query_var( 'monthnum' );
		$all_months = array(
			1  => __( 'January', 'sjdw-theme' ),
			2  => __( 'February', 'sjdw-theme' ),
			3  => __( 'March', 'sjdw-theme' ),
			4  => __( 'April', 'sjdw-theme' ),
			5  => __( 'May', 'sjdw-theme' ),
			6  => __( 'June', 'sjdw-theme' ),
			7  => __( 'July', 'sjdw-theme' ),
			8  => __( 'August', 'sjdw-theme' ),
			9  => __( 'September', 'sjdw-theme' ),
			10 => __( 'October', 'sjdw-theme' ),
			11 => __( 'November', 'sjdw-theme' ),
			12 => __( 'December', 'sjdw-theme' ),
		);

		$results = wp_cache_get( 'sjdw_theme_filter_years' );

		if ( false === $results ) {
			//phpcs:ignore WordPress.DB.DirectDatabaseQuery.DirectQuery
			$results = $wpdb->get_results(
				'SELECT DISTINCT YEAR(`post_date`) AS `year` FROM `wp_posts`
				WHERE `post_type` = "post" AND `post_status` = "publish"
				ORDER BY `post_date` DESC'
			);

			wp_cache_set( 'sjdw_theme_filter_years', $results );
		}

		if ( is_array( $results ) ) {
			foreach ( $results as $key => $value ) {
				$years[ absint( $value->year ) ] = absint( $value->year );
			}
		}

		$html = $args['before_widget'];

		if ( ! empty( $title ) ) {
			$html .= $args['before_title'] . apply_filters( 'widget_title', $title ) . $args['after_title'];
		}

		$action = get_permalink( (int) get_option( 'page_for_posts' ) );

		$html .= '<form class="post-filter-form" action="' . esc_url( $action ) . '" method="get">';

		// Year Dropdown.
		$html .= '<p class="form-group">';
		$html .= '<select name="year" class="form-control post-filter-year">';
		$html .= '<option value="">' . __( 'Select Year', 'sjdw-theme' ) . '</option>';
		foreach ( $years as $key => $value ) {
			$html .= wp_sprintf(
				'<option %1$s value="%2$s">%3$s</option>',
				selected( $year, $key, false ),
				esc_attr( (string) $key ),
				esc_html( (string) $value )
			);
		}
		$html .= '</select>';
		$html .= '</p>';

		if ( absint( $show_month ) ) {

			$months  = array();
			$results = wp_cache_get( 'sjdw_theme_filter_months' );

			if ( false === $results ) {
				//phpcs:ignore WordPress.DB.DirectDatabaseQuery.DirectQuery
				$results = $wpdb->get_results(
					'SELECT DISTINCT MONTH(`post_date`) AS `month` FROM `wp_posts`
					WHERE `post_type` = "post" AND `post_status` = "publish"
					AND YEAR(`post_date`) = "' . absint( $year ) . '" ORDER BY `post_date` DESC'
				);

				wp_cache_set( 'sjdw_theme_filter_months', $results );
			}

			if ( is_array( $results ) ) {
				foreach ( $results as $row ) {
					if ( ! empty( $row->month ) && array_key_exists( $row->month, $all_months ) ) {
						$months[ $row->month ] = $all_months[ $row->month ];
					}
				}
			}

			// Month Dropdown.
			$html .= '<p class="form-group">';
			$html .= '<select name="monthnum" class="form-control post-filter-month">';
			$html .= '<option value="">' . __( 'Select Month', 'sjdw-theme' ) . '</option>';
			foreach ( $months as $key => $value ) {
				$html .= wp_sprintf(
					'<option %1$s value="%2$s">%3$s</option>',
					selected( $monthnum, $key, false ),
					esc_attr( (string) $key ),
					esc_html( $value )
				);
			}
			$html .= '</select>';
			$html .= '</p>';
		}

		$html .= '</form>';
		$html .= $args['after_widget'];

		echo $html; //phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
	}

	/**
	 * Outputs the settings update form.
	 *
	 * @param  mixed $instance Current settings.
	 * @return string
	 */
	public function form( $instance ): string {

		$title      = isset( $instance['title'] ) ? esc_html( $instance['title'] ) : '';
		$show_month = isset( $instance['show_month'] ) ? absint( $instance['show_month'] ) : 0;

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
			uniqid( 'show_month' ),
			$this->get_field_name( 'show_month' ),
			checked( $show_month, 1, false ),
			esc_html__( 'Show Month', 'sjdw-theme' ),
		);
		$html .= '</p>';

		echo $html; //phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped

		return '';
	}
}
