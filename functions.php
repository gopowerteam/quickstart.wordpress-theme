  
<?php

// function theme_enqueue() {
//   /* ALL JS FOR SITE */
//   wp_enqueue_script('manifest',get_stylesheet_directory_uri().'/dist/static/js/manifest.2ae2e69a05c33dfc65f8.js', array(), null, true);
//   wp_enqueue_script('vendor',get_stylesheet_directory_uri().'/dist/static/js/vendor.7fed9fa7b7ba482410b7.js', array(), null, true);
//   wp_enqueue_script('app',get_stylesheet_directory_uri().'index.3d86078d.js', array(), null, true);
// //   wp_enqueue_script('app', 'http://localhost:3000/app.js', array(), null, true);
//   /*  ALL CSS FOR SITE */
//   wp_enqueue_style('style',get_stylesheet_directory_uri().'/dist/static/css/app.18fc15b06532e4d1d8b465fca15ca6a3.css', array(), null, false);
// //   wp_enqueue_style('style', 'http://localhost:3000/app.css', array(), null, false);
// }
// add_action( 'wp_enqueue_scripts', 'theme_enqueue' );


// REMOVE WP EMOJI
remove_action('wp_head', 'print_emoji_detection_script',7);
remove_action('wp_print_styles', 'print_emoji_styles');
remove_action( 'admin_print_scripts', 'print_emoji_detection_script' );
remove_action( 'admin_print_styles', 'print_emoji_styles' );

// Remove oEmbed-specific JavaScript from the front-end and back-end.
remove_action( 'wp_head', 'wp_oembed_add_host_js' );
 
// // Remove all embeds rewrite rules.
// add_filter( 'rewrite_rules_array', 'disable_embeds_rewrites' );