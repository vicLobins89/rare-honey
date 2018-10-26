<?php

// let's create the function for the custom type
function events_post_type() { 
	// creating (registering) the custom type 
	register_post_type( 'events_post', /* (http://codex.wordpress.org/Function_Reference/register_post_type) */
		// let's now add all the options for this post type
		array( 'labels' => array(
			'name' => __( 'Events', 'bonestheme' ), /* This is the Title of the Group */
			'singular_name' => __( 'Event', 'bonestheme' ), /* This is the individual type */
			'all_items' => __( 'All Events', 'bonestheme' ), /* the all items menu item */
			'add_new' => __( 'Add Event', 'bonestheme' ), /* The add new menu item */
			'add_new_item' => __( 'Add New Event', 'bonestheme' ), /* Add New Display Title */
			'edit' => __( 'Edit', 'bonestheme' ), /* Edit Dialog */
			'edit_item' => __( 'Edit Event', 'bonestheme' ), /* Edit Display Title */
			'new_item' => __( 'New Event', 'bonestheme' ), /* New Display Title */
			'view_item' => __( 'View Event', 'bonestheme' ), /* View Display Title */
			'search_items' => __( 'Search Event', 'bonestheme' ), /* Search Custom Type Title */ 
			'not_found' =>  __( 'No Events found.', 'bonestheme' ), /* This displays if there are no entries yet */ 
			'not_found_in_trash' => __( 'No Events found', 'bonestheme' ), /* This displays if there is nothing in the trash */
			'parent_item_colon' => ''
			), /* end of arrays */
			'description' => __( 'This is an Events post type.', 'bonestheme' ), /* Custom Type Description */
			'public' => true,
			'publicly_queryable' => true,
			'exclude_from_search' => false,
			'show_ui' => true,
			'query_var' => true,
			'menu_position' => 9, /* this is what order you want it to appear in on the left hand side menu */ 
			'menu_icon' => 'dashicons-megaphone', /* the icon for the custom post type menu */
			'rewrite'	=> array( 'slug' => 'event', 'with_front' => false ), /* you can specify its url slug */
			'has_archive' => 'event', /* you can rename the slug here */
			'capability_type' => 'post',
			'hierarchical' => false,
			/* the next one is important, it tells what's enabled in the post editor */
			'supports' => array( 'title', 'editor', 'author', 'thumbnail', 'excerpt', 'trackbacks', 'custom-fields', 'comments', 'revisions', 'sticky')
		) /* end of options */
	); /* end of register post type */
	
	/* this adds your post categories to your custom post type */
	register_taxonomy_for_object_type( 'category', 'events_post' );
	/* this adds your post tags to your custom post type */
	register_taxonomy_for_object_type( 'post_tag', 'events_post' );
	
}

	// adding the function to the Wordpress init
	add_action( 'init', 'events_post_type');
	
	/*
	for more information on taxonomies, go here:
	http://codex.wordpress.org/Function_Reference/register_taxonomy
	*/
	
	// now let's add custom categories (these act like categories)
	register_taxonomy( 'events_cat', 
		array('events_post'), /* if you change the name of register_post_type( 'events_post', then you have to change this */
		array('hierarchical' => true,     /* if this is true, it acts like categories */
			'labels' => array(
				'name' => __( 'Events Categories', 'bonestheme' ), /* name of the custom taxonomy */
				'singular_name' => __( 'Events Category', 'bonestheme' ), /* single taxonomy name */
				'search_items' =>  __( 'Search Events Categories', 'bonestheme' ), /* search title for taxomony */
				'all_items' => __( 'All Events Categories', 'bonestheme' ), /* all title for taxonomies */
				'parent_item' => __( 'Parent Events Category', 'bonestheme' ), /* parent title for taxonomy */
				'parent_item_colon' => __( 'Parent Events Category:', 'bonestheme' ), /* parent taxonomy title */
				'edit_item' => __( 'Edit Events Category', 'bonestheme' ), /* edit custom taxonomy title */
				'update_item' => __( 'Update Events Category', 'bonestheme' ), /* update title for taxonomy */
				'add_new_item' => __( 'Add New Events Category', 'bonestheme' ), /* add new title for taxonomy */
				'new_item_name' => __( 'New Events Category Name', 'bonestheme' ) /* name title for taxonomy */
			),
			'show_admin_column' => true, 
			'show_ui' => true,
			'query_var' => true,
			'rewrite' => array( 'slug' => 'events' ),
		)
	);
	
	// now let's add custom tags (these act like categories)
	register_taxonomy( 'events_tag', 
		array('events_post'), /* if you change the name of register_post_type( 'events_post', then you have to change this */
		array('hierarchical' => false,    /* if this is false, it acts like tags */
			'labels' => array(
				'name' => __( 'Events Tags', 'bonestheme' ), /* name of the custom taxonomy */
				'singular_name' => __( 'Events Tag', 'bonestheme' ), /* single taxonomy name */
				'search_items' =>  __( 'Search Events Tags', 'bonestheme' ), /* search title for taxomony */
				'all_items' => __( 'All Events Tags', 'bonestheme' ), /* all title for taxonomies */
				'parent_item' => __( 'Parent Events Tag', 'bonestheme' ), /* parent title for taxonomy */
				'parent_item_colon' => __( 'Parent Events Tag:', 'bonestheme' ), /* parent taxonomy title */
				'edit_item' => __( 'Edit Events Tag', 'bonestheme' ), /* edit custom taxonomy title */
				'update_item' => __( 'Update Events Tag', 'bonestheme' ), /* update title for taxonomy */
				'add_new_item' => __( 'Add New Events Tag', 'bonestheme' ), /* add new title for taxonomy */
				'new_item_name' => __( 'New Events Tag Name', 'bonestheme' ) /* name title for taxonomy */
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
