<?php
/**
 * The Settings class file.
 *
 * @package Sjdworld\SjdwTheme
 */

declare(strict_types=1);

namespace Sjdworld\SjdwTheme;

use WP_Customize_Manager;
use WP_Customize_Image_Control;

/**
 * The Settings class.
 */
class Settings {

	/**
	 * Register actions.
	 *
	 * @return void
	 */
	public function init(): void {

		// Add custom settings for the theme.
		add_action( 'customize_register', array( $this, 'register_custom_settings' ) );

		// Register Widgets.
		add_action( 'widgets_init', array( $this, 'register_widgets' ) );
	}

	/**
	 * Add custom settings for the theme.
	 *
	 * @param WP_Customize_Manager $manager The WP_Customize_Manager object.
	 *
	 * @return void
	 */
	public function register_custom_settings( WP_Customize_Manager $manager ): void {

		// Create a new section.
		$manager->add_section(
			'sjdw_theme_options',
			array(
				'title'    => __( 'Theme Options', 'sjdw-theme' ),
				'priority' => 30,
			)
		);

		// Primary call button.
		$manager->add_setting( 'call_button_text' );
		$manager->add_control(
			'call_button_text',
			array(
				'label'    => __( 'Primary Call Button Text', 'sjdw-theme' ),
				'section'  => 'sjdw_theme_options',
				'priority' => 1,
				'type'     => 'text',
			)
		);

		$manager->add_setting( 'call_button_link' );
		$manager->add_control(
			'call_button_link',
			array(
				'label'    => __( 'Primary Call Button Link', 'sjdw-theme' ),
				'section'  => 'sjdw_theme_options',
				'priority' => 2,
				'type'     => 'url',
			)
		);

		// Default Placeholder Image.
		$manager->add_setting( 'default_image' );
		$manager->add_control(
			new WP_Customize_Image_Control(
				$manager,
				'default_image',
				array(
					'label'    => __( 'Default Placeholder Image', 'sjdw-theme' ),
					'section'  => 'sjdw_theme_options',
					'priority' => 3,
				)
			)
		);
	}

	/**
	 * Register theme specific widget positions.
	 *
	 * @return void
	 */
	public function register_widgets(): void {

		// Topbar widgets.
		register_sidebar(
			array(
				'name'          => esc_html__( 'Topbar', 'sjdw-theme' ),
				'id'            => 'topbar',
				'description'   => esc_html__( 'Add widgets here.', 'sjdw-theme' ),
				'before_widget' => '<div id="%1$s" class="widget %2$s">',
				'after_widget'  => '</div>',
			)
		);

		// Footer widgets.
		register_sidebar(
			array(
				'name'          => esc_html__( 'Blog Sidebar', 'sjdw-theme' ),
				'id'            => 'blog-sidebar',
				'description'   => esc_html__( 'Add widgets here.', 'sjdw-theme' ),
				'before_widget' => '<div id="%1$s" class="widget %2$s">',
				'after_widget'  => '</div>',
			)
		);

		// Footer widgets.
		register_sidebar(
			array(
				'name'          => esc_html__( 'Footer', 'sjdw-theme' ),
				'id'            => 'footer',
				'description'   => esc_html__( 'Add widgets here.', 'sjdw-theme' ),
				'before_widget' => '<div id="%1$s" class="widget %2$s">',
				'after_widget'  => '</div>',
			)
		);
	}
}
