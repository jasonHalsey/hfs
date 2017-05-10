<?php

/*  Remove Admin Bar
/* ------------------------------------ */ 
	add_filter('show_admin_bar', '__return_false');




function wpb_adding_scripts() {

	$vars = "value";

	wp_register_script('app', get_stylesheet_directory_uri() . '/js/hfs-custom.js');

	wp_enqueue_script('app');

	}
	add_action( 'wp_footer', 'wpb_adding_scripts' ); 



?>