<?php
/**
 * The template for displaying the header.
 *
 * @package Sjdworld\SjdwTheme
 */

declare(strict_types=1);

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

$sjdw_theme_logo = get_template_directory_uri() . '/assets/images/logo.svg';

?>
<!DOCTYPE html>
<html class="no-js" <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>

	<!-- wrapper start -->
	<div id="wrapper">

		<!-- header start -->
		<header id="header">

			<!-- topbar start -->
			<?php if ( is_active_sidebar( 'topbar' ) ) : ?>
				<section id="topbar">
					<div class="container top-container">
						<?php dynamic_sidebar( 'topbar' ); ?>
					</div>
				</section>
			<?php endif; ?>
			<!-- topbar start -->

			<!-- headbar start -->
			<section id="headbar">
				<div class="container">
					<div class="row align-items-center">
						<div id="logo-holder" class="col-lg-auto">
							<a class="custom-logo-link" href="<?php echo esc_url( home_url() ); ?>">
								<?php
								sjdw_theme_the_custom_logo(
									'custom_logo',
									$sjdw_theme_logo
								);
								?>
							</a>
							<div class="d-inline-flex align-items-center mobile-menu-holder">
								<?php if ( has_nav_menu( 'main' ) ) : ?>
									<button type="button" class="nav-button" aria-label="Menu">
										<span class="icon-bar"></span>
										<span class="icon-bar"></span>
										<span class="icon-bar"></span>
									</button>
								<?php endif; ?>
							</div>
						</div>
						<div id="nav-holder" class="col-lg">

							<?php if ( has_nav_menu( 'main' ) ) : ?>
								<!-- start main navigation -->
								<nav id="nav" role="navigation">
									<div class="navigation">
									<?php
										wp_nav_menu(
											array(
												'theme_location' => 'main',
												'container'      => '',
												'items_wrap'     => '<ul id="main-menu" class="menu">%3$s</ul>',
											)
										);
									?>
									<?php
									if (
										get_theme_mod( 'call_button_text' )
										&& get_theme_mod( 'call_button_link' )
									) :
										?>
										<a class="btn btn-primary call-button"
											href="<?php echo esc_url( get_theme_mod( 'call_button_link' ) ); ?>">
											<?php echo esc_html( get_theme_mod( 'call_button_text' ) ); ?>
										</a>
									<?php endif; ?>
									</div>
								</nav>
								<!-- end main navigation -->
							<?php endif; ?>

						</div>
					</div>
				</div>
			</section>
			<!-- headbar end -->

		</header>
		<!-- header end -->
