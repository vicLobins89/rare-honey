<?php

// let's create the function for the custom type
function pubs_post_type() {
	// creating (registering) the custom type 
	register_post_type( 'pubs_post', /* (http://codex.wordpress.org/Function_Reference/register_post_type) */
		// let's now add all the options for this post type
		array( 'labels' => array(
			'name' => __( 'Publications', 'bonestheme' ), /* This is the Title of the Group */
			'singular_name' => __( 'Publication', 'bonestheme' ), /* This is the individual type */
			'all_items' => __( 'All Publications', 'bonestheme' ), /* the all items menu item */
			'add_new' => __( 'Add Publication', 'bonestheme' ), /* The add new menu item */
			'add_new_item' => __( 'Add New Publication', 'bonestheme' ), /* Add New Display Title */
			'edit' => __( 'Edit', 'bonestheme' ), /* Edit Dialog */
			'edit_item' => __( 'Edit Publication', 'bonestheme' ), /* Edit Display Title */
			'new_item' => __( 'New Publication', 'bonestheme' ), /* New Display Title */
			'view_item' => __( 'View Publication', 'bonestheme' ), /* View Display Title */
			'search_items' => __( 'Search Publication', 'bonestheme' ), /* Search Custom Type Title */ 
			'not_found' =>  __( 'No Publications found.', 'bonestheme' ), /* This displays if there are no entries yet */ 
			'not_found_in_trash' => __( 'No Publications found', 'bonestheme' ), /* This displays if there is nothing in the trash */
			'parent_item_colon' => ''
			), /* end of arrays */
			'description' => __( 'This is a Publications post type.', 'bonestheme' ), /* Custom Type Description */
			'public' => true,
			'publicly_queryable' => true,
			'exclude_from_search' => false,
			'show_ui' => true,
			'query_var' => true,
			'menu_position' => 10, /* this is what order you want it to appear in on the left hand side menu */ 
			'menu_icon' => 'dashicons-book-alt', /* the icon for the custom post type menu */
			'rewrite'	=> array( 'slug' => 'publication', 'with_front' => false ), /* you can specify its url slug */
			'has_archive' => 'publication', /* you can rename the slug here */
			'capability_type' => 'post',
			'hierarchical' => false,
			/* the next one is important, it tells what's enabled in the post editor */
			'supports' => array( 'title', 'editor', 'author', 'thumbnail', 'excerpt', 'trackbacks', 'custom-fields', 'comments', 'revisions', 'sticky')
		) /* end of options */
	); /* end of register post type */
	
	/* this adds your post categories to your custom post type */
	register_taxonomy_for_object_type( 'category', 'pubs_post' );
	/* this adds your post tags to your custom post type */
	register_taxonomy_for_object_type( 'post_tag', 'pubs_post' );
	
}

	// adding the function to the Wordpress init
	add_action( 'init', 'pubs_post_type');
	
	/*
	for more information on taxonomies, go here:
	http://codex.wordpress.org/Function_Reference/register_taxonomy
	*/
	
	// now let's add custom categories (these act like categories)
	register_taxonomy( 'pubs_cat', 
		array('pubs_post'), /* if you change the name of register_post_type( 'pubs_post', then you have to change this */
		array('hierarchical' => true,     /* if this is true, it acts like categories */
			'labels' => array(
				'name' => __( 'Publication Categories', 'bonestheme' ), /* name of the custom taxonomy */
				'singular_name' => __( 'Publication Category', 'bonestheme' ), /* single taxonomy name */
				'search_items' =>  __( 'Search Publication Categories', 'bonestheme' ), /* search title for taxomony */
				'all_items' => __( 'All Publication Categories', 'bonestheme' ), /* all title for taxonomies */
				'parent_item' => __( 'Parent Publication Category', 'bonestheme' ), /* parent title for taxonomy */
				'parent_item_colon' => __( 'Parent Publication Category:', 'bonestheme' ), /* parent taxonomy title */
				'edit_item' => __( 'Edit Publication Category', 'bonestheme' ), /* edit custom taxonomy title */
				'update_item' => __( 'Update Publication Category', 'bonestheme' ), /* update title for taxonomy */
				'add_new_item' => __( 'Add New Publication Category', 'bonestheme' ), /* add new title for taxonomy */
				'new_item_name' => __( 'New Publication Category Name', 'bonestheme' ) /* name title for taxonomy */
			),
			'show_admin_column' => true, 
			'show_ui' => true,
			'query_var' => true,
			'rewrite' => array( 'slug' => 'publications' ),
		)
	);
	
	// now let's add custom tags (these act like categories)
	register_taxonomy( 'pubs_tag', 
		array('pubs_post'), /* if you change the name of register_post_type( 'pubs_post', then you have to change this */
		array('hierarchical' => false,    /* if this is false, it acts like tags */
			'labels' => array(
				'name' => __( 'Publication Tags', 'bonestheme' ), /* name of the custom taxonomy */
				'singular_name' => __( 'Publication Tag', 'bonestheme' ), /* single taxonomy name */
				'search_items' =>  __( 'Search Publication Tags', 'bonestheme' ), /* search title for taxomony */
				'all_items' => __( 'All Publication Tags', 'bonestheme' ), /* all title for taxonomies */
				'parent_item' => __( 'Parent Publication Tag', 'bonestheme' ), /* parent title for taxonomy */
				'parent_item_colon' => __( 'Parent Publication Tag:', 'bonestheme' ), /* parent taxonomy title */
				'edit_item' => __( 'Edit Publication Tag', 'bonestheme' ), /* edit custom taxonomy title */
				'update_item' => __( 'Update Publication Tag', 'bonestheme' ), /* update title for taxonomy */
				'add_new_item' => __( 'Add New Publication Tag', 'bonestheme' ), /* add new title for taxonomy */
				'new_item_name' => __( 'New Publication Tag Name', 'bonestheme' ) /* name title for taxonomy */
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
