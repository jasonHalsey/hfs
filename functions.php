<?php

/*  Remove Admin Bar
/* ------------------------------------ */ 
	add_filter('show_admin_bar', '__return_false');



/*  Add Custom JS
/* ------------------------------------ */ 
function wpb_adding_scripts() {

	$vars = "value";

	wp_register_script('app', get_stylesheet_directory_uri() . '/js/hfs-custom.js');

	wp_enqueue_script('app');

	}
	add_action( 'wp_footer', 'wpb_adding_scripts' ); 



/*  Create Client Logos Post Type
/* ------------------------------------ */
add_action('init', 'post_type_clientlogo');
function post_type_clientlogo() 
{
  $labels = array(
    'name' => _x('Client Logos', 'post type general name'),
    'singular_name' => _x('Client Logo', 'post type singular name'),
    'add_new' => _x('Add New Client Logo', 'clogo'),
    'add_new_item' => __('Add New Client Logo')
  );
 
 $args = array(
    'labels' => $labels,
    'public' => true,
    'publicly_queryable' => true,
    'show_ui' => true, 
    'query_var' => true,
    'rewrite' => array( 'slug' => 'clogo' ),
    'capability_type' => 'post',
    'hierarchical' => false,
    'menu_position' => null,
    'supports' => array('title')
    ); 
  register_post_type('clogo',$args);
  flush_rewrite_rules();
}; 

/**
 * Include and setup custom metaboxes and fields. (make sure you copy this file to outside the CMB directory)
 *
 * @category HFS
 * @package  Metaboxes
 * @license  http://www.opensource.org/licenses/gpl-license.php GPL v2.0 (or later)
 * @link     https://github.com/webdevstudios/Custom-Metaboxes-and-Fields-for-WordPress
 */

require_once 'cmb/init.php';

/**
 * Conditionally displays a field when used as a callback in the 'show_on_cb' field parameter
 *
 * @param  CMB2_Field object $field Field object
 *
 * @return bool                     True if metabox should show
 */
function cmb2_hide_if_no_cats( $field ) {
	// Don't show this field if not in the cats category
	if ( ! has_tag( 'cats', $field->object_id ) ) {
		return false;
	}
	return true;
}

add_filter( 'cmb2_meta_boxes', 'cmb2_hfs_metaboxes' );
/**
 * Define the metabox and field configurations.
 *
 * @param  array $meta_boxes
 * @return array
 */
function cmb2_hfs_metaboxes( array $meta_boxes ) {

	// Start with an underscore to hide fields from custom fields list
	$prefix = '_cmb2_';

  /**
   * Testimonial Metabox Layout
   */
  $meta_boxes['clogo_metabox'] = array(
    'id'            => 'clogo_metabox',
    'title'         => __( 'Client Logos', 'cmb2' ),
    'object_types'  => array( 'clogo' ), // Post type
    'context'       => 'normal',
    'priority'      => 'high',
    'show_names'    => true, // Show field names on the left
    'fields'        => array(
      array(
        'name'    => __( 'Client URL', 'cmb2' ),
        'id'      => $prefix . 'client_url',
        'type' => 'text_medium',
      ),
      array(
        'name' => __( 'Client Logo', 'cmb2' ),
        'desc' => __( 'Upload a Client Logo - .png/.jpg/.gif - Max Size 400px X 400px', 'cmb2' ),
        'id'   => $prefix . 'logo_image',
        'type' => 'file',
      )
    )
  	);
	return $meta_boxes;
}


?>