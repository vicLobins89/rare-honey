<?php

// Flush rewrite rules for custom post types
add_action( 'after_switch_theme', 'bones_flush_rewrite_rules' );

// Flush your rewrite rules
function bones_flush_rewrite_rules() {
	flush_rewrite_rules();
}

// let's create the function for the custom type
function work_post_type() { 
	// creating (registering) the custom type 
	register_post_type( 'work_post', /* (http://codex.wordpress.org/Function_Reference/register_post_type) */
		// let's now add all the options for this post type
		array( 'labels' => array(
			'name' => __( 'Work', 'bonestheme' ), /* This is the Title of the Group */
			'singular_name' => __( 'Project', 'bonestheme' ), /* This is the individual type */
			'all_items' => __( 'All Projects', 'bonestheme' ), /* the all items menu item */
			'add_new' => __( 'Add Project', 'bonestheme' ), /* The add new menu item */
			'add_new_item' => __( 'Add New Project', 'bonestheme' ), /* Add New Display Title */
			'edit' => __( 'Edit', 'bonestheme' ), /* Edit Dialog */
			'edit_item' => __( 'Edit Project', 'bonestheme' ), /* Edit Display Title */
			'new_item' => __( 'New Project', 'bonestheme' ), /* New Display Title */
			'view_item' => __( 'View Project', 'bonestheme' ), /* View Display Title */
			'search_items' => __( 'Search Projects', 'bonestheme' ), /* Search Custom Type Title */ 
			'not_found' =>  __( 'No Projects found.', 'bonestheme' ), /* This displays if there are no entries yet */ 
			'not_found_in_trash' => __( 'No Projects found', 'bonestheme' ), /* This displays if there is nothing in the trash */
			'parent_item_colon' => ''
			), /* end of arrays */
			'description' => __( 'This is a Project post type.', 'bonestheme' ), /* Custom Type Description */
			'public' => true,
			'publicly_queryable' => true,
			'exclude_from_search' => false,
			'show_ui' => true,
			'query_var' => true,
			'menu_position' => 8, /* this is what order you want it to appear in on the left hand side menu */ 
			'menu_icon' => 'dashicons-admin-customizer', /* the icon for the custom post type menu */
			'rewrite'	=> array( 'slug' => 'work', 'with_front' => false ), /* you can specify its url slug */
			'has_archive' => 'work', /* you can rename the slug here */
			'capability_type' => 'post',
			'hierarchical' => false,
			/* the next one is important, it tells what's enabled in the post editor */
			'supports' => array( 'title', 'editor', 'author', 'thumbnail', 'excerpt', 'trackbacks', 'custom-fields', 'comments', 'revisions', 'sticky')
		) /* end of options */
	); /* end of register post type */
	
	/* this adds your post categories to your custom post type */
	register_taxonomy_for_object_type( 'category', 'work_post' );
	/* this adds your post tags to your custom post type */
	register_taxonomy_for_object_type( 'post_tag', 'work_post' );
	
}

	// adding the function to the Wordpress init
	add_action( 'init', 'work_post_type');
	
	/*
	for more information on taxonomies, go here:
	http://codex.wordpress.org/Function_Reference/register_taxonomy
	*/
	
	// now let's add custom categories (these act like categories)
	register_taxonomy( 'work_cat', 
		array('work_post'), /* if you change the name of register_post_type( 'work_post', then you have to change this */
		array('hierarchical' => true,     /* if this is true, it acts like categories */
			'labels' => array(
				'name' => __( 'Services', 'bonestheme' ), /* name of the custom taxonomy */
				'singular_name' => __( 'Service', 'bonestheme' ), /* single taxonomy name */
				'search_items' =>  __( 'Search Services', 'bonestheme' ), /* search title for taxomony */
				'all_items' => __( 'All Services', 'bonestheme' ), /* all title for taxonomies */
				'parent_item' => __( 'Parent Service', 'bonestheme' ), /* parent title for taxonomy */
				'parent_item_colon' => __( 'Parent Service:', 'bonestheme' ), /* parent taxonomy title */
				'edit_item' => __( 'Edit Service', 'bonestheme' ), /* edit custom taxonomy title */
				'update_item' => __( 'Update Service', 'bonestheme' ), /* update title for taxonomy */
				'add_new_item' => __( 'Add New Service', 'bonestheme' ), /* add new title for taxonomy */
				'new_item_name' => __( 'New Service Name', 'bonestheme' ) /* name title for taxonomy */
			),
			'show_admin_column' => true, 
			'show_ui' => true,
			'query_var' => true,
			'rewrite' => array( 'slug' => 'services' ),
		)
	);
	
	// now let's add custom tags (these act like categories)
	register_taxonomy( 'work_tag', 
		array('work_post'), /* if you change the name of register_post_type( 'work_post', then you have to change this */
		array('hierarchical' => false,    /* if this is false, it acts like tags */
			'labels' => array(
				'name' => __( 'Work Tags', 'bonestheme' ), /* name of the custom taxonomy */
				'singular_name' => __( 'Work Tag', 'bonestheme' ), /* single taxonomy name */
				'search_items' =>  __( 'Search Work Tags', 'bonestheme' ), /* search title for taxomony */
				'all_items' => __( 'All Work Tags', 'bonestheme' ), /* all title for taxonomies */
				'parent_item' => __( 'Parent Work Tag', 'bonestheme' ), /* parent title for taxonomy */
				'parent_item_colon' => __( 'Parent Work Tag:', 'bonestheme' ), /* parent taxonomy title */
				'edit_item' => __( 'Edit Work Tag', 'bonestheme' ), /* edit custom taxonomy title */
				'update_item' => __( 'Update Work Tag', 'bonestheme' ), /* update title for taxonomy */
				'add_new_item' => __( 'Add New Work Tag', 'bonestheme' ), /* add new title for taxonomy */
				'new_item_name' => __( 'New Work Tag Name', 'bonestheme' ) /* name title for taxonomy */
			),
			'show_admin_column' => true,
			'show_ui' => true,
			'query_var' => true,
		)
	);
	
	/*
		looking for custom meta boxes?
		check out this fantastic tool:
		https://github.com/jaredatch/Custom-Metaboxes-and-Fields-for-WordPress
	*/
	

?>
