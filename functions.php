<?php
/**
 * The functions and definitions.
 *
 * @package Sjdworld\SjdwTheme
 */

declare(strict_types=1);

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

// Function for initialising the theme.
if ( ! function_exists( 'sjdw_theme_initialize_theme' ) ) {
	/**
	 * Initialise the theme
	 *
	 * @return void
	 */
	function sjdw_theme_initialize_theme(): void {

		// Clean up the head.
		remove_action( 'wp_head', 'rsd_link' );
		remove_action( 'wp_head', 'wlwmanifest_link' );
		remove_action( 'wp_head', 'wp_generator' );
	}
}
add_action( 'init', 'sjdw_theme_initialize_theme' );

// Function for setting up the theme.
if ( ! function_exists( 'sjdw_theme_after_setup_theme' ) ) {
	/**
	 * Sets up theme defaults and registers the features.
	 *
	 * @return void
	 */
	function sjdw_theme_after_setup_theme(): void {

		// Load the language file for translation.
		load_theme_textdomain( 'sjdw-theme', get_template_directory() . '/languages' );

		// Add custom logo support.
		add_theme_support( 'custom-logo' );

		// Let WordPress manage the document title.
		add_theme_support( 'title-tag' );

		// Add thumbnail support.
		add_theme_support( 'post-thumbnails' );
		add_image_size( 'banner', 1300, 450, true );

		// Add support for responsive embedded content.
		add_theme_support( 'responsive-embeds' );

		// Add theme support for selective refresh for widgets.
		add_theme_support( 'customize-selective-refresh-widgets' );

		// Add support for Blocks.
		add_theme_support( 'widgets-block-editor' );

		// Add support for Block Styles.
		add_theme_support( 'wp-block-styles' );

		// Add support for full and wide align images.
		add_theme_support( 'align-wide' );

		// Add support for editor styles.
		add_theme_support( 'editor-styles' );

		// Enqueue editor styles.
		add_editor_style( 'assets/css/editor-style.min.css' );

		// Refister the navigation locations.
		register_nav_menus( array( 'main' => esc_html__( 'Main Menu', 'sjdw-theme' ) ) );

		// Switch default core markup to output valid HTML5.
		add_theme_support(
			'html5',
			array(
				'search-form',
				'comment-form',
				'comment-list',
				'gallery',
				'caption',
				'style',
				'script',
			)
		);

		// Allow text widget to have shortcodes.
		add_filter( 'widget_text', 'do_shortcode' );
	}
}
add_action( 'after_setup_theme', 'sjdw_theme_after_setup_theme' );

// Function for widget initialising.
if ( ! function_exists( 'sjdw_theme_widgets_init' ) ) {
	/**
	 * Register theme specific widget positions.
	 *
	 * @return void
	 */
	function sjdw_theme_widgets_init(): void {

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

		// Sidebar widgets.
		register_sidebar(
			array(
				'name'          => esc_html__( 'Sidebar', 'sjdw-theme' ),
				'id'            => 'blog-sidebar',
				'description'   => esc_html__( 'Add widgets here.', 'sjdw-theme' ),
				'before_widget' => '<div id="%1$s" class="widget %2$s">',
				'after_widget'  => '</div>',
				'before_title'  => '<h2 class="widget-title h4">',
				'after_title'   => '</h2>',
			)
		);

		// Footer widgets.
		register_sidebar(
			array(
				'name'          => esc_html__( 'Footer', 'sjdw-theme' ),
				'id'            => 'footer',
				'description'   => esc_html__( 'Add widgets here.', 'sjdw-theme' ),
				'before_widget' => '<div id="%1$s" class="col-12 mb-3 widget %2$s">',
				'after_widget'  => '</div>',
				'before_title'  => '<h2 class="widget-title h4">',
				'after_title'   => '</h2>',
			)
		);
	}
}
add_action( 'widgets_init', 'sjdw_theme_widgets_init' );


// Function for enqueue theme scripts.
if ( ! function_exists( 'sjdw_theme_enqueue_scripts' ) ) {
	/**
	 * Include scripts and styles for the theme
	 *
	 * @return void
	 */
	function sjdw_theme_enqueue_scripts(): void {

		$theme   = wp_get_theme( 'sjdw-theme' );
		$version = $theme->exists() ? $theme->get( 'Version' ) : null;
		$baseurl = trailingslashit( get_template_directory_uri() );

		// Enqueue default scripts.
		wp_dequeue_script( 'jquery' );
		wp_enqueue_script(
			'jquery',
			includes_url( '/js/jquery/jquery.min.js' ),
			array(),
			false, //phpcs:ignore WordPress.WP.EnqueuedResourceParameters.NoExplicitVersion
			true
		);

		// Fonts.
		wp_enqueue_style(
			'sjdw-theme-fonts',
			$baseurl . 'assets/css/fonts.min.css',
			array(),
			$version
		);

		// Bootstrap.
		wp_enqueue_script(
			'sjdw-theme-bootstrap',
			$baseurl . 'assets/vendor/bootstrap/bootstrap.bundle.min.js',
			array( 'jquery' ),
			$version,
			true
		);
		wp_enqueue_style(
			'sjdw-theme-bootstrap',
			$baseurl . 'assets/vendor/bootstrap/bootstrap.min.css',
			array(),
			$version
		);

		// Enque the theme script.
		wp_enqueue_script(
			'sjdw-theme',
			$baseurl . 'assets/js/main.min.js',
			array( 'jquery', 'sjdw-theme-bootstrap' ),
			$version,
			true
		);

		// Enque the theme styles.
		wp_enqueue_style(
			'sjdw-theme',
			$baseurl . 'assets/css/base-style.min.css',
			array( 'sjdw-theme-bootstrap' ),
			$version
		);
	}
}
add_action( 'wp_enqueue_scripts', 'sjdw_theme_enqueue_scripts' );

// Function for enqueue admin scripts.
if ( ! function_exists( 'sjdw_theme_admin_enqueue_script' ) ) {
	/**
	 * Admin Enqueue a script
	 *
	 * @return void
	 */
	function sjdw_theme_admin_enqueue_script(): void {

		$theme   = wp_get_theme();
		$version = $theme->exists() ? $theme->get( 'Version' ) : null;
		$baseurl = trailingslashit( get_template_directory_uri() );

		// Fonts.
		wp_enqueue_style(
			'sjdw-theme-fonts',
			$baseurl . 'assets/css/fonts.min.css',
			array(),
			$version
		);

		// Admin Styles.
		wp_enqueue_style(
			'sjdw-theme-admin',
			$baseurl . 'assets/css/admin-style.min.css',
			array(),
			$version
		);
	}
}
add_action( 'admin_enqueue_scripts', 'sjdw_theme_admin_enqueue_script' );

// Function for hiding page title.
if ( ! function_exists( 'sjdw_theme_hide_page_title' ) ) {
	/**
	 * Get the theme option
	 *
	 * @param int $post_id The post ID.
	 *
	 * @return bool
	 */
	function sjdw_theme_hide_page_title( int $post_id ): bool {

		$hide = (int) get_post_meta( $post_id, '_hide_title', true );

		return $hide ? true : false;
	}
}

// Function for category filter.
if ( ! function_exists( 'sjdw_theme_category_filter' ) ) {
	/**
	 * Allow nested category filter
	 *
	 * @param array<mixed> $args The arguments.
	 *
	 * @return array<mixed>
	 */
	function sjdw_theme_category_filter( array $args ): array {

		$args['checked_ontop'] = false;

		return $args;
	}
}
add_filter( 'wp_terms_checklist_args', 'sjdw_theme_category_filter' );

// Function for getting the featured thumbnail.
if ( ! function_exists( 'sjdw_theme_the_post_thumbnail' ) ) {
	/**
	 * Get post thumbnail
	 *
	 * @param int|\WP_Post $post  The post.
	 * @param string       $size  The thumbnail size.
	 * @param array<mixed> $attr  The attributes.
	 * @param string|null  $noimg The placeholder image.
	 *
	 * @return void
	 */
	function sjdw_theme_the_post_thumbnail(
		$post,
		string $size,
		array $attr = array(),
		?string $noimg = null
	): void {

		if ( has_post_thumbnail( $post ) ) {
			$image = get_the_post_thumbnail( $post, $size, $attr );
		} else {

			if ( is_null( $noimg ) ) {
				$noimg = get_template_directory_uri() . '/assets/images/no-image.png';
			}

			$image = wp_sprintf(
				'<img src="%1$s" alt="" class="%2$s"/>',
				esc_url( $noimg ),
				esc_attr( $attr['class'] )
			);
		}

		echo wp_kses_post( $image );
	}
}

// Function for getting the featured video.
if ( ! function_exists( 'sjdw_theme_get_post_featured_video' ) ) {
	/**
	 * Get post featured video
	 *
	 * @param int $post_id The post.
	 *
	 * @return string
	 */
	function sjdw_theme_get_featured_video( int $post_id ): string {

		$videoid = get_post_meta( $post_id, '_featured_video', true );
		$video   = '';

		if ( ! empty( $videoid ) ) {
			$url   = 'https://www.youtube-nocookie.com/embed/' . $videoid . '?rel=0';
			$video = '<iframe class="embed-responsive-item" src="' . esc_url( $url ) . '" rel="0"
			allowfullscreen></iframe>';
		}

		return $video;
	}
}

// Function for altering the image resize quality.
if ( ! function_exists( 'sjdw_theme_change_image_quality' ) ) {
	/**
	 * Change the image quality
	 *
	 * @param int $quality The quality for resize.
	 * @return int
	 */
	function sjdw_theme_change_image_quality( $quality ) {
		$quality = 100;
		return $quality;
	}
}
add_filter( 'jpeg_quality', 'sjdw_theme_change_image_quality' );


// Function for altering the excerpt length.
if ( ! function_exists( 'sjdw_theme_excerpt_length' ) ) {
	/**
	 * Filter the except length to certain words.
	 *
	 * @param int $length Excerpt length.
	 *
	 * @return int
	 */
	function sjdw_theme_excerpt_length( int $length ): int {
		$length = 30;
		return $length;
	}
}
add_filter( 'excerpt_length', 'sjdw_theme_excerpt_length' );


// Function for altering the excerpt read more.
if ( ! function_exists( 'sjdw_theme_excerpt_more' ) ) {
	/**
	 * Filter the "read more" excerpt string link to the post.
	 *
	 * @param string $more "Read more" excerpt string.
	 *
	 * @return string
	 */
	function sjdw_theme_excerpt_more( string $more ): string {

		if ( ! is_single() ) {
			$permalink = get_post_meta( get_the_ID(), '_external_link', true );
			$target    = get_post_meta( get_the_ID(), '_link_target', true );

			if ( empty( $permalink ) ) {
				$permalink = get_permalink( get_the_ID() );
				$target    = '';
			}

			$more = wp_sprintf(
				'... <a class="readmore" href="%1$s" target="%2$s">%3$s</a>',
				esc_url( $permalink ),
				esc_attr( $target ),
				__( 'Read more', 'sjdw-theme' )
			);
		}

		return $more;
	}
}
add_filter( 'excerpt_more', 'sjdw_theme_excerpt_more' );

// Function for adding custom settings.
if ( ! function_exists( 'sjdw_theme_customize_register' ) ) {
	/**
	 * Add custom settings for the theme.
	 *
	 * @param WP_Customize_Manager $manager The WP_Customize_Manager object.
	 *
	 * @return void
	 */
	function sjdw_theme_customize_register( WP_Customize_Manager $manager ): void {

		// Footer logo.
		$manager->add_setting( 'footer_logo' );
		$manager->add_control(
			new WP_Customize_Image_Control(
				$manager,
				'footer_logo',
				array(
					'label'    => __( 'Footer Logo', 'sjdw-theme' ),
					'section'  => 'title_tagline',
					'priority' => 9,
				)
			)
		);

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
	}
}
add_action( 'customize_register', 'sjdw_theme_customize_register' );

// Function for numeric pagination.
if ( ! function_exists( 'sjdw_theme_the_numeric_pagination' ) ) {
	/**
	 * Numeric pagination.
	 *
	 * @param WP_Query $query The query object.
	 *
	 * @return void
	 */
	function sjdw_theme_the_numeric_pagination( ?WP_Query $query = null ): void {

		global $wp_query;

		// Set the instance if null.
		if ( is_null( $query ) ) {
			$query = $wp_query;
		}

		// Check whether the instance is set.
		if ( ! $query instanceof WP_Query ) {
			return;
		}

		// Do not show if there is only one page.
		if ( $query->max_num_pages <= 1 ) {
			return;
		}

		$paged = get_query_var( 'paged' ) ? absint( get_query_var( 'paged' ) ) : 1;
		$max   = intval( $query->max_num_pages );
		$links = array();

		if ( $paged >= 1 ) {
			$links[] = $paged;
		}

		if ( $paged >= 3 ) {
			$links[] = $paged - 1;
			$links[] = $paged - 2;
		}

		if ( ( $paged + 2 ) <= $max ) {
			$links[] = $paged + 2;
			$links[] = $paged + 1;
		}

		$html = '<ul class="pagination justify-content-center mb-5">';

		if ( ! in_array( 1, $links, true ) ) {
			$class = 1 === $paged ? 'active' : '';

			$html .= wp_sprintf(
				'<li class="page-item %s"><a class="page-link" href="%s">%s</a></li>',
				$class,
				esc_url( get_pagenum_link( 1 ) ),
				'1'
			);

			if ( ! in_array( 2, $links, true ) ) {
				$html .= '<li class="page-item">…</li>';
			}
		}

		sort( $links );

		foreach ( (array) $links as $link ) {
			$class = $paged === $link ? 'active' : '';
			$html .= wp_sprintf(
				'<li class="page-item %s"><a class="page-link" href="%s">%s</a></li>',
				$class,
				esc_url( get_pagenum_link( $link ) ),
				$link
			);
		}

		if ( ! in_array( $max, $links, true ) ) {
			if ( ! in_array( $max - 1, $links, true ) ) {
				$html .= '<li class="page-item d-flex align-items-center"><span class="mr-1">…</span></li>';
			}

			$class = $paged === $max ? 'active' : '';
			$html .= wp_sprintf(
				'<li class="page-item %s"><a class="page-link" href="%s">%s</a></li>',
				$class,
				esc_url( get_pagenum_link( $max ) ),
				$max
			);
		}

		$html .= '</ul>';

		echo wp_kses_post( $html );
	}
}

// Function for getting the custom logo.
if ( ! function_exists( 'sjdw_theme_the_custom_logo' ) ) {
	/**
	 * Get the custom logo image
	 *
	 * @param string $field    Get custom logo field.
	 * @param string $default The default image if not found.
	 *
	 * @return void
	 */
	function sjdw_theme_the_custom_logo( string $field = 'custom_logo', string $default = '' ): void {

		if ( ! empty( $field ) && 'custom_logo' !== $field ) {
			$image_url = get_theme_mod( $field );
			$logo_id   = attachment_url_to_postid( $image_url );
		} else {
			$logo_id = get_theme_mod( 'custom_logo' );
		}

		$bloginfo = get_bloginfo( 'name' );

		if ( $logo_id ) {
			$image = wp_sprintf(
				'<img src="%1$s" class="%2$s" alt="%3$s">',
				esc_url( wp_get_attachment_url( $logo_id ) ),
				esc_attr( 'img-fluid ' . $field ),
				esc_attr( $bloginfo )
			);
		} elseif ( ! empty( $default ) ) {
			$image = wp_sprintf(
				'<img src="%1$s" class="img-fluid" alt="%2$s">',
				esc_url( $default ),
				esc_attr( $bloginfo )
			);
		} else {
			$image = '';
		}

		echo wp_kses_post( $image );
	}
}
