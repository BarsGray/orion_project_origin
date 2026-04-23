<?php
if (!defined('ABSPATH')) {
  exit;
}





/**
 * Enqueue scripts and styles.
 */
function orion_th_scripts() {

  wp_deregister_script('jquery');
  wp_register_script('jquery', get_template_directory_uri() . '/assets/js/jquery-4.0.0.min.js', array(), null, true);
  wp_enqueue_script('jquery');
	wp_enqueue_script( 'orion_th-navigation', get_template_directory_uri() . '/assets/js/navigation.js', array(), null, true );
	wp_enqueue_script( 'orion_th-customizer', get_template_directory_uri() . '/assets/js/customizer.js', array('customize-preview'), null, true );
	wp_enqueue_script( 'swiper', get_template_directory_uri() . '/assets/js/swiper-bundle.min.js', array('jquery'), null, true );
	wp_enqueue_script( 'fancybox', get_template_directory_uri() . '/assets/js/fancybox.umd.js', array('jquery'), null, true );
	wp_enqueue_script( 'main', get_template_directory_uri() . '/assets/js/main.js', array('jquery'), _S_VERSION, true );


	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'orion_th_scripts' );





function orion_th_style()
{
	wp_enqueue_style( 'orion_th-style', get_stylesheet_uri(), array(), _S_VERSION );
  wp_enqueue_style('swiper-bundle', get_template_directory_uri() . '/assets/css/swiper-bundle.min.css', array('orion_th-style'), null, 'all');
  wp_enqueue_style('fancybox', get_template_directory_uri() . '/assets/css/fancybox.css', array('orion_th-style'), null, 'all');
  wp_enqueue_style('styles', get_template_directory_uri() . '/assets/css/styles.css', array('orion_th-style'), _S_VERSION, 'all');

}

add_action('wp_enqueue_scripts', 'orion_th_style');