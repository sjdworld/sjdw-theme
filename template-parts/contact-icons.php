<?php
/**
 * The contact icons template
 *
 * @phpcs:disable Generic.Files.LineLength.TooLong
 *
 * @package Sjdworld\SjdwTheme
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

?>
<ul class="list-unstyled list-inline contact-icons">

	<?php if ( ! empty( $args['address'] ) ) : ?>
	<li class="list-inline-item address">
		<svg width="22" height="22" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 384 512"><path d="M172.3 501.7C27 291 0 269.4 0 192 0 86 86 0 192 0s192 86 192 192c0 77.4-27 99-172.3 309.7-9.5 13.8-29.9 13.8-39.5 0zM192 272c44.2 0 80-35.8 80-80s-35.8-80-80-80-80 35.8-80 80 35.8 80 80 80z"/></svg>
		<span><?php echo esc_html( $args['address'] ); ?></span>
	</li>
	<?php endif; ?>

	<?php if ( ! empty( $args['email'] ) ) : ?>
	<li class="list-inline-item email">
		<a href="mailto:<?php echo esc_attr( $args['email'] ); ?>" target="_blank">
			<svg width="22" height="22" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><path d="M464 64H48C21.5 64 0 85.5 0 112v288c0 26.5 21.5 48 48 48h416c26.5 0 48-21.5 48-48V112c0-26.5-21.5-48-48-48zm0 48v40.8c-22.4 18.3-58.2 46.7-134.6 106.5-16.8 13.2-50.2 45.1-73.4 44.7-23.2 .4-56.6-31.5-73.4-44.7C106.2 199.5 70.4 171.1 48 152.8V112h416zM48 400V214.4c22.9 18.3 55.4 43.9 104.9 82.6 21.9 17.2 60.1 55.2 103.1 55 42.7 .2 80.5-37.2 103.1-54.9 49.5-38.8 82-64.4 104.9-82.7V400H48z"/></svg>
			<span><?php echo esc_html( $args['email'] ); ?></span>
		</a>
	</li>
	<?php endif; ?>

	<?php if ( ! empty( $args['phone'] ) ) : ?>
	<li class="list-inline-item phone">
		<a href="tel:<?php echo esc_attr( preg_replace( '/[^0-9]/', '', $args['phone'] ) ); ?>" target="_blank">
			<svg width="22" height="22" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 320 512"><path d="M272 0H48C21.5 0 0 21.5 0 48v416c0 26.5 21.5 48 48 48h224c26.5 0 48-21.5 48-48V48c0-26.5-21.5-48-48-48zM160 480c-17.7 0-32-14.3-32-32s14.3-32 32-32 32 14.3 32 32-14.3 32-32 32zm112-108c0 6.6-5.4 12-12 12H60c-6.6 0-12-5.4-12-12V60c0-6.6 5.4-12 12-12h200c6.6 0 12 5.4 12 12v312z"/></svg>
			<span><?php echo esc_html( $args['phone'] ); ?></span>
		</a>
	</li>
	<?php endif; ?>

	<?php if ( ! empty( $args['twitter'] ) ) : ?>
	<li class="list-inline-item twitter">
		<a href="https://twitter.com/<?php echo esc_attr( $args['twitter'] ); ?>" target="_blank">
			<svg width="22" height="22" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><path d="M389.2 48h70.6L305.6 224.2 487 464H345L233.7 318.6 106.5 464H35.8L200.7 275.5 26.8 48H172.4L272.9 180.9 389.2 48zM364.4 421.8h39.1L151.1 88h-42L364.4 421.8z"/></svg>
		</a>
	</li>
	<?php endif; ?>

	<?php if ( ! empty( $args['facebook'] ) ) : ?>
	<li class="list-inline-item facebook">
		<a href="https://facebook.com/<?php echo esc_attr( $args['facebook'] ); ?>" target="_blank">
			<svg width="20" height="20" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 320 512"><path d="M279.1 288l14.2-92.7h-88.9v-60.1c0-25.4 12.4-50.1 52.2-50.1h40.4V6.3S260.4 0 225.4 0c-73.2 0-121.1 44.4-121.1 124.7v70.6H22.9V288h81.4v224h100.2V288z"/></svg>
		</a>
	</li>
	<?php endif; ?>

	<?php if ( ! empty( $args['instagram'] ) ) : ?>
	<li class="list-inline-item instagram">
		<a href="https://instagram.com/<?php echo esc_attr( $args['instagram'] ); ?>" target="_blank">
			<svg width="24" height="24" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"><path d="M224.1 141c-63.6 0-114.9 51.3-114.9 114.9s51.3 114.9 114.9 114.9S339 319.5 339 255.9 287.7 141 224.1 141zm0 189.6c-41.1 0-74.7-33.5-74.7-74.7s33.5-74.7 74.7-74.7 74.7 33.5 74.7 74.7-33.6 74.7-74.7 74.7zm146.4-194.3c0 14.9-12 26.8-26.8 26.8-14.9 0-26.8-12-26.8-26.8s12-26.8 26.8-26.8 26.8 12 26.8 26.8zm76.1 27.2c-1.7-35.9-9.9-67.7-36.2-93.9-26.2-26.2-58-34.4-93.9-36.2-37-2.1-147.9-2.1-184.9 0-35.8 1.7-67.6 9.9-93.9 36.1s-34.4 58-36.2 93.9c-2.1 37-2.1 147.9 0 184.9 1.7 35.9 9.9 67.7 36.2 93.9s58 34.4 93.9 36.2c37 2.1 147.9 2.1 184.9 0 35.9-1.7 67.7-9.9 93.9-36.2 26.2-26.2 34.4-58 36.2-93.9 2.1-37 2.1-147.8 0-184.8zM398.8 388c-7.8 19.6-22.9 34.7-42.6 42.6-29.5 11.7-99.5 9-132.1 9s-102.7 2.6-132.1-9c-19.6-7.8-34.7-22.9-42.6-42.6-11.7-29.5-9-99.5-9-132.1s-2.6-102.7 9-132.1c7.8-19.6 22.9-34.7 42.6-42.6 29.5-11.7 99.5-9 132.1-9s102.7-2.6 132.1 9c19.6 7.8 34.7 22.9 42.6 42.6 11.7 29.5 9 99.5 9 132.1s2.7 102.7-9 132.1z"/></svg>
		</a>
	</li>
	<?php endif; ?>

	<?php if ( ! empty( $args['linkedin'] ) ) : ?>
	<li class="list-inline-item linkedin">
		<a href="https://linkedin.com/<?php echo esc_attr( $args['linkedin'] ); ?>" target="_blank">
			<svg width="24" height="24" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"><path d="M100.3 448H7.4V148.9h92.9zM53.8 108.1C24.1 108.1 0 83.5 0 53.8a53.8 53.8 0 0 1 107.6 0c0 29.7-24.1 54.3-53.8 54.3zM447.9 448h-92.7V302.4c0-34.7-.7-79.2-48.3-79.2-48.3 0-55.7 37.7-55.7 76.7V448h-92.8V148.9h89.1v40.8h1.3c12.4-23.5 42.7-48.3 87.9-48.3 94 0 111.3 61.9 111.3 142.3V448z"/></svg>
		</a>
	</li>
	<?php endif; ?>

	<?php if ( ! empty( $args['youtube'] ) ) : ?>
	<li class="list-inline-item youtube">
		<a href="https://youtube.com/<?php echo esc_attr( $args['youtube'] ); ?>" target="_blank">
			<svg width="28" height="28" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512"><path d="M549.7 124.1c-6.3-23.7-24.8-42.3-48.3-48.6C458.8 64 288 64 288 64S117.2 64 74.6 75.5c-23.5 6.3-42 24.9-48.3 48.6-11.4 42.9-11.4 132.3-11.4 132.3s0 89.4 11.4 132.3c6.3 23.7 24.8 41.5 48.3 47.8C117.2 448 288 448 288 448s170.8 0 213.4-11.5c23.5-6.3 42-24.2 48.3-47.8 11.4-42.9 11.4-132.3 11.4-132.3s0-89.4-11.4-132.3zm-317.5 213.5V175.2l142.7 81.2-142.7 81.2z"/></svg>
		</a>
	</li>
	<?php endif; ?>

</ul>
