<?php

// LOAD CORE (do not remove)
require_once( 'library/rarehoney.php' );

// CUSTOMIZE THE WORDPRESS ADMIN (off by default)
require_once( 'library/admin.php' );

/*********************
LAUNCH
*********************/

function rarehoney_init() {

  //Allow editor style.
  add_editor_style( get_stylesheet_directory_uri() . '/library/css/editor-style.css' );

  // let's get language support going, if you need it
  load_theme_textdomain( 'bonestheme', get_template_directory() . '/library/translation' );

  // USE THIS TEMPLATE TO CREATE CUSTOM POST TYPES EASILY
  require_once( 'library/work-post-type.php' );
  require_once( 'library/events-post-type.php' );
  require_once( 'library/pubs-post-type.php' );

  // launching operation cleanup
  add_action( 'init', 'bones_head_cleanup' );
  // A better title
  add_filter( 'wp_title', 'rw_title', 10, 3 );
  // remove WP version from RSS
  add_filter( 'the_generator', 'bones_rss_version' );
  // remove pesky injected css for recent comments widget
  add_filter( 'wp_head', 'bones_remove_wp_widget_recent_comments_style', 1 );
  // clean up comment styles in the head
  add_action( 'wp_head', 'bones_remove_recent_comments_style', 1 );
  // clean up gallery output in wp
  add_filter( 'gallery_style', 'bones_gallery_style' );

  // enqueue base scripts and styles
  add_action( 'wp_enqueue_scripts', 'bones_scripts_and_styles', 999 );
  // ie conditional wrapper

  // launching this stuff after theme setup
  bones_theme_support();

  // adding sidebars to Wordpress (these are created in functions.php)
  add_action( 'widgets_init', 'bones_register_sidebars' );

  // cleaning up random code around images
  add_filter( 'the_content', 'bones_filter_ptags_on_images' );
  // cleaning up excerpt
  add_filter( 'excerpt_more', 'bones_excerpt_more' );

} /* end bones ahoy */

// let's get this party started
add_action( 'after_setup_theme', 'rarehoney_init' );

//Register all footer sections
function rarehoney_footer_init() {
    $values = array("left", "middle", "right");
    foreach($values as $value) {
        register_sidebar(array(
            'name'          => 'Footer ' . ucfirst($value) . ' Section',
            'id'            => 'footer_' . $value,
            'before_widget' => '<div>',
            'after_widget'  => '</div>',
            'before_title'  => '<p>',
            'after_title'   => '</p>',
        ));
    }
}
add_action( 'widgets_init', 'rarehoney_footer_init' );

// Work page description widget
function rarehoney_word_description_init() {
    register_sidebar(array(
		'name'          => 'Work Page Description',
		'id'            => 'work_desc',
		'before_widget' => '<div class="archive-description">',
		'after_widget'  => '</div>',
		'before_title'  => '<h3 class="archive-title">',
		'after_title'   => '</h3>',
	));
}
add_action( 'widgets_init', 'rarehoney_word_description_init' );


/************* OEMBED SIZE OPTIONS *************/

if ( ! isset( $content_width ) ) {
	$content_width = 680;
}

/************* THUMBNAIL SIZE OPTIONS *************/

// Thumbnail sizes
add_image_size( 'bones-thumb-600', 600, 150, true );
add_image_size( 'bones-thumb-300', 300, 100, true );
add_image_size( 'post-thumb', 530, 360, true );
add_image_size( 'square', 600, 600, true );

/*
to add more sizes, simply copy a line from above
and change the dimensions & name. As long as you
upload a "featured image" as large as the biggest
set width or height, all the other sizes will be
auto-cropped.

To call a different size, simply change the text
inside the thumbnail function.

For example, to call the 300 x 100 sized image,
we would use the function:
<?php the_post_thumbnail( 'bones-thumb-300' ); ?>
for the 600 x 150 image:
<?php the_post_thumbnail( 'bones-thumb-600' ); ?>

You can change the names and dimensions to whatever
you like. Enjoy!
*/

add_filter( 'image_size_names_choose', 'bones_custom_image_sizes' );

function bones_custom_image_sizes( $sizes ) {
    return array_merge( $sizes, array(
        'bones-thumb-600' => __('600px by 150px'),
        'bones-thumb-300' => __('300px by 100px'),
        'post-thumb' => __('530px by 360px'),
        'square' => __('600px by 600px'),
    ) );
}

/*
The function above adds the ability to use the dropdown menu to select
the new images sizes you have just created from within the media manager
when you add media to your content blocks. If you add more image sizes,
duplicate one of the lines in the array and name it according to your
new image size.
*/

/************* THEME CUSTOMIZE *********************/

/* 
  A good tutorial for creating your own Sections, Controls and Settings:
  http://code.tutsplus.com/series/a-guide-to-the-wordpress-theme-customizer--wp-33722
  
  Good articles on modifying the default options:
  http://natko.com/changing-default-wordpress-theme-customization-api-sections/
  http://code.tutsplus.com/tutorials/digging-into-the-theme-customizer-components--wp-27162
  
  To do:
  - Create a js for the postmessage transport method
  - Create some sanitize functions to sanitize inputs
  - Create some boilerplate Sections, Controls and Settings
*/

function bones_theme_customizer($wp_customize) {
  // $wp_customize calls go here.
  //
  // Uncomment the below lines to remove the default customize sections 

  // $wp_customize->remove_section('title_tagline');
  // $wp_customize->remove_section('colors');
  // $wp_customize->remove_section('background_image');
  // $wp_customize->remove_section('static_front_page');
  // $wp_customize->remove_section('nav');

  // Uncomment the below lines to remove the default controls
  // $wp_customize->remove_control('blogdescription');
  
  // Uncomment the following to change the default section titles
  // $wp_customize->get_section('colors')->title = __( 'Theme Colors' );
  // $wp_customize->get_section('background_image')->title = __( 'Images' );
}

add_action( 'customize_register', 'bones_theme_customizer' );

/************* ACTIVE SIDEBARS ********************/

// Sidebars & Widgetizes Areas
function bones_register_sidebars() {
	register_sidebar(array(
		'id' => 'sidebar1',
		'name' => __( 'Sidebar 1', 'bonestheme' ),
		'description' => __( 'The first (primary) sidebar.', 'bonestheme' ),
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<h4 class="widgettitle">',
		'after_title' => '</h4>',
	));

	/*
	to add more sidebars or widgetized areas, just copy
	and edit the above sidebar code. In order to call
	your new sidebar just use the following code:

	Just change the name to whatever your new
	sidebar's id is, for example:

	register_sidebar(array(
		'id' => 'sidebar2',
		'name' => __( 'Sidebar 2', 'bonestheme' ),
		'description' => __( 'The second (secondary) sidebar.', 'bonestheme' ),
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<h4 class="widgettitle">',
		'after_title' => '</h4>',
	));

	To call the sidebar in your template, you can just copy
	the sidebar.php file and rename it to your sidebar's name.
	So using the above example, it would be:
	sidebar-sidebar2.php

	*/
} // don't remove this bracket!


/************* COMMENT LAYOUT *********************/

// Comment Layout
function bones_comments( $comment, $args, $depth ) {
   $GLOBALS['comment'] = $comment; ?>
  <div id="comment-<?php comment_ID(); ?>" <?php comment_class('cf'); ?>>
    <article  class="cf">
      <header class="comment-author vcard">
        <?php
        /*
          this is the new responsive optimized comment image. It used the new HTML5 data-attribute to display comment gravatars on larger screens only. What this means is that on larger posts, mobile sites don't have a ton of requests for comment images. This makes load time incredibly fast! If you'd like to change it back, just replace it with the regular wordpress gravatar call:
          echo get_avatar($comment,$size='32',$default='<path_to_url>' );
        */
        ?>
        <?php // custom gravatar call ?>
        <?php
          // create variable
          $bgauthemail = get_comment_author_email();
        ?>
        <img data-gravatar="http://www.gravatar.com/avatar/<?php echo md5( $bgauthemail ); ?>?s=40" class="load-gravatar avatar avatar-48 photo" height="40" width="40" src="<?php echo get_template_directory_uri(); ?>/library/images/nothing.gif" />
        <?php // end custom gravatar call ?>
        <?php printf(__( '<cite class="fn">%1$s</cite> %2$s', 'bonestheme' ), get_comment_author_link(), edit_comment_link(__( '(Edit)', 'bonestheme' ),'  ','') ) ?>
        <time datetime="<?php echo comment_time('Y-m-j'); ?>"><a href="<?php echo htmlspecialchars( get_comment_link( $comment->comment_ID ) ) ?>"><?php comment_time(__( 'F jS, Y', 'bonestheme' )); ?> </a></time>

      </header>
      <?php if ($comment->comment_approved == '0') : ?>
        <div class="alert alert-info">
          <p><?php _e( 'Your comment is awaiting moderation.', 'bonestheme' ) ?></p>
        </div>
      <?php endif; ?>
      <section class="comment_content cf">
        <?php comment_text() ?>
      </section>
      <?php comment_reply_link(array_merge( $args, array('depth' => $depth, 'max_depth' => $args['max_depth']))) ?>
    </article>
  <?php // </li> is added by WordPress automatically ?>
<?php
} // don't remove this bracket!


/*
If you're using Google Fonts, you
can replace these fonts, change it in your scss files
and be up and running in seconds.
*/
function bones_fonts() {
  wp_enqueue_style('googleFonts', '//fonts.googleapis.com/css?family=Lato:400,700,400italic,700italic');
}

add_action('wp_enqueue_scripts', 'bones_fonts');



/************* AJAX POSTS SCROLL *********************/

function my_enqueue_assets() {
	wp_enqueue_script( 'ajax-pagination',  get_stylesheet_directory_uri() . '/library/js/ajax-pagination.js', array( 'jquery' ), '1.0', true );
	global $wp_query;
	wp_localize_script( 'ajax-pagination', 'ajaxpagination', array(
		'ajaxurl' => admin_url( 'admin-ajax.php' ),
		'query_vars' => json_encode( $wp_query->query )
	));
}
//add_action( 'wp_enqueue_scripts', 'my_enqueue_assets' );

function my_ajax_pagination() {
	$query_vars = json_decode( stripslashes( $_POST['query_vars'] ), true );
	$post_ids = json_decode($_POST['id']);
	
    $query_vars['paged'] = $_POST['page'];
    $query_vars['post_status'] = 'publish';
    $query_vars['post__not_in'] = array(4908,4873);
	
//	print_r($query_vars);
//	print_r($post_ids);

    $posts = new WP_Query( $query_vars );
    $GLOBALS['wp_query'] = $posts;

    add_filter( 'editor_max_image_size', 'my_image_size_override' );

    if( !$posts->have_posts() ) {
		
    } else {
        while ( $posts->have_posts() ) { 
            $posts->the_post();
			get_template_part( 'load-posts', get_post_format() );
        }
    }
	
    remove_filter( 'editor_max_image_size', 'my_image_size_override' );

    die();
}
function my_image_size_override() {
    return array( 825, 510 );
}
//add_action( 'wp_ajax_nopriv_ajax_pagination', 'my_ajax_pagination' );
//add_action( 'wp_ajax_ajax_pagination', 'my_ajax_pagination' );



/************* CHANGE POSTS TO NEWS *********************/


function revcon_change_post_label() {
    global $menu;
    global $submenu;
    $menu[5][0] = 'News';
    $submenu['edit.php'][5][0] = 'News';
    $submenu['edit.php'][10][0] = 'Add News';
    $submenu['edit.php'][16][0] = 'News Tags';
}
function revcon_change_post_object() {
    global $wp_post_types;
    $labels = &$wp_post_types['post']->labels;
    $labels->name = 'News';
    $labels->singular_name = 'News';
    $labels->add_new = 'Add News';
    $labels->add_new_item = 'Add News';
    $labels->edit_item = 'Edit News';
    $labels->new_item = 'News';
    $labels->view_item = 'View News';
    $labels->search_items = 'Search News';
    $labels->not_found = 'No News found';
    $labels->not_found_in_trash = 'No News found in Trash';
    $labels->all_items = 'All News';
    $labels->menu_name = 'News';
    $labels->name_admin_bar = 'News';
}
 
add_action( 'admin_menu', 'revcon_change_post_label' );
add_action( 'init', 'revcon_change_post_object' );



/************* ADD JS COMPOSER TO ALL PAGES *********************/

function add_theme_stylesheet() {
    wp_enqueue_script( 'wpb_composer_front_js' );
    wp_enqueue_style( 'js_composer_front' );
    wp_enqueue_style( 'js_composer_custom_css' );
}

add_action( 'wp_enqueue_scripts', 'add_theme_stylesheet' );



/************* SHORTEN EXCERPT *********************/

function custom_excerpt_length( $length ) {
    return 20;
}
add_filter( 'excerpt_length', 'custom_excerpt_length', 999 );



/************* ALLOW HTML IN WIDGET TITLES *********************/

function html_widget_title( $title ) {
//HTML tag opening/closing brackets
$title = str_replace( '[', '<', $title );
$title = str_replace( '[/', '</', $title );
// bold -- changed from 's' to 'strong' because of strikethrough code
$title = str_replace( 'strong]', 'strong>', $title );
$title = str_replace( 'b]', 'b>', $title );
// italic
$title = str_replace( 'em]', 'em>', $title );
$title = str_replace( 'i]', 'i>', $title );
// underline
// $title = str_replace( 'u]', 'u>', $title ); // could use this, but it is deprecated so use the following instead
$title = str_replace( '<u]', '<span style="text-decoration:underline;">', $title );
$title = str_replace( '</u]', '</span>', $title );
// superscript
$title = str_replace( 'sup]', 'sup>', $title );
// subscript
$title = str_replace( 'sub]', 'sub>', $title );
// del
$title = str_replace( 'del]', 'del>', $title ); // del is like strike except it is not deprecated, but strike has wider browser support -- you might want to replace the following 'strike' section to replace all with 'del' instead
// strikethrough or <s></s>
$title = str_replace( 'strike]', 'strike>', $title );
$title = str_replace( 's]', 'strike>', $title ); // <s></s> was deprecated earlier than so we will convert it
$title = str_replace( 'strikethrough]', 'strike>', $title ); // just in case you forget that it is 'strike', not 'strikethrough'
// tt
$title = str_replace( 'tt]', 'tt>', $title ); // Will not look different in some themes, like Twenty Eleven -- FYI: http://reference.sitepoint.com/html/tt
// marquee
$title = str_replace( 'marquee]', 'marquee>', $title );
// blink
$title = str_replace( 'blink]', 'blink>', $title ); // only Firefox and Opera support this tag
// wtitle1 (to be styled in style.css using .wtitle1 class)
$title = str_replace( '<wtitle1]', '<span class="wtitle1">', $title );
$title = str_replace( '</wtitle1]', '</span>', $title );
// wtitle2 (to be styled in style.css using .wtitle2 class)
$title = str_replace( '<wtitle2]', '<span class="wtitle2">', $title );
$title = str_replace( '</wtitle2]', '</span>', $title );

return $title;
}
add_filter( 'widget_title', 'html_widget_title' );



/************* ADD URL TO REG *********************/

function extra_user_profile_fields( $user ) { ?>
    <h3><?php _e("Referal Page:", "blank"); ?></h3>
	<a target="_blank" href="<?php echo 'https://'.esc_attr( get_the_author_meta( '_wp_http_referer', $user->ID ) ); ?>" style="display: inline-block; margin-bottom: 30px;"><strong><?php echo esc_attr( get_the_author_meta( '_wp_http_referer', $user->ID ) ); ?></strong></a>
<?php }
add_action( 'show_user_profile', 'extra_user_profile_fields' );
add_action( 'edit_user_profile', 'extra_user_profile_fields' );

/* DON'T DELETE THIS CLOSING TAG */ ?>
