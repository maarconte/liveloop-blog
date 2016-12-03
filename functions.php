<?php
function wpm_enqueue_styles(){
wp_enqueue_style( 'parent-style', get_template_directory_uri() . '/style.css' );
}
add_action( 'wp_enqueue_scripts', 'wpm_enqueue_styles' );

add_action('init', 'my_custom_init'); function my_custom_init() {
/* notre code PHP pour rajouter les custom post type */
register_post_type(   'agenda',
array(
		'label' => 'Agenda',
		'labels' => array(
		'name' => 'Agenda',
		'singular_name' => 'Agenda',
		'all_items' => 'Tous les concerts',
		'add_new_item' => 'Ajouter un concert',
		'edit_item' => 'Éditer le concert',
		'new_item' => 'Nouveau concert',
		'view_item' => 'Voir le concert',
		'search_items' => 'Rechercher parmis les concerts',
		'not_found' => 'Pas de concerts trouvés',
		'not_found_in_trash'=> 'Pas de concerts dans la corbeille'
	),
	'public' => true,
	'capability_type' => 'post',
	'supports' => array(
		'title',
		'thumbnail',
	),
	'has_archive' => true
) );
}

add_action( 'wp_default_scripts', function( $scripts ) {
    if ( ! empty( $scripts->registered['jquery'] ) ) {
        $jquery_dependencies = $scripts->registered['jquery']->deps;
        $scripts->registered['jquery']->deps = array_diff( $jquery_dependencies, array( 'jquery-migrate' ) );
    }
} );

/**
 * Register our sidebars and widgetized areas.
 *
 */
function agenda_widgets_init() {

	register_sidebar( array(
		'name'          => 'Agenda Description',
		'id'            => 'agenda-description',
		'before_widget' => '<div class="widget widget_text">',
		'after_widget'  => '</div>',
	) );

}
add_action( 'widgets_init', 'agenda_widgets_init' );

function site_widgets_init() {

	register_sidebar( array(
		'name'          => 'Site Description',
		'id'            => 'site-description',
		'before_widget' => '<div class="widget widget_text">',
		'after_widget'  => '</div>',
	) );

}
add_action( 'widgets_init', 'site_widgets_init' );


function get_artists() {
	global $wpdb;
	$artists = $wpdb->get_var("SELECT COUNT(DISTINCT(post_title)) FROM `wp_posts` WHERE post_type = 'agenda' && post_status = 'publish' ");
	echo $artists;
}

function get_most_viewed_artist() {
	global $wpdb;
	$artist = $wpdb->get_var("SELECT post_title FROM `wp_posts` WHERE post_type = 'agenda' && post_status = 'publish' GROUP BY post_title ORDER BY COUNT(post_title) DESC LIMIT 1");
	echo $artist;
}

function get_most_viewed_artist_count() {
	global $wpdb;
	$concert_count = $wpdb->get_var("SELECT COUNT(post_title) FROM `wp_posts` WHERE post_type = 'agenda' && post_status = 'publish' GROUP BY post_title ORDER BY COUNT(post_title) DESC LIMIT 1");
	echo $concert_count;
}

function dyad_jetpack() {
	//Responsive videos
		add_theme_support( 'jetpack-responsive-videos' );

		//Site logo
		add_image_size( 'dyad-site-logo', 600, 300 );
		add_theme_support( 'site-logo', array(
			'header-text' => array(
				'site-title',
				'site-description',
			),
			'size' => 'dyad-site-logo',
		) );

		//Featured content
		add_theme_support( 'featured-content' , array(
			'featured_content_filter' => 'dyad_get_banner_posts',
			'max_posts' => 6,
			'post_types' => array( 'post' ),
		) );

			//Infinite scroll
		add_theme_support( 'infinite-scroll', array(
			'container' => 'posts',
			'footer' => 'primary',
			'footer_widgets' => array( 'sidebar-1'),
			'render' => 'dyad_infinite_scroll_render',
			'wrapper' => false,
			'posts_per_page' => 12,
			'render' => 'liveloop_infinite_scroll_render',
		) );
}
add_action( 'after_setup_theme', 'dyad_jetpack' );

//function jetpack_infinite_scroll_query_args( $args ) {
//		$args['meta_key'] = 'date';
//		$args['orderby'] = 'date';
//		$args['order']   = 'DESC';
//		return $args;
//}
//add_filter( 'infinite_scroll_query_args', 'jetpack_infinite_scroll_query_args' );

/**
 * Custom render function for Infinite Scroll.
 */
function liveloop_infinite_scroll_render() {
	while ( have_posts() ) :
		the_post();
		if (get_post_type() == 'agenda') {
			get_template_part( 'template-parts/content', 'agenda' );
		} else {
			get_template_part( 'template-parts/content', 'blocks' );
		}
	endwhile;
}
add_action( 'infinite_scroll_render', 'liveloop_infinite_scroll_render');
