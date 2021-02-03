<?php


/* check 'post views' plugin installation */
add_action( 'admin_notices', 'theme_dependencies' );
function theme_dependencies() {
  if( ! function_exists('register_wp_simple_post_view_settings') )
    echo '<div class="error"><p>Внимание! Нужно установить плагин <a href="https://ru.wordpress.org/plugins/wp-simple-post-view" target="_blank">Post View Count</a> для корректной работы темы.</p></div>';
}

/* add theme defaults */
add_action( 'after_setup_theme', 'theme_defaults' );
function theme_defaults() {
	add_theme_support( 'html5', array(
		 'comment-list',
		 'comment-form',
		 'search-form', 
		 'script',
		 'style'
	));
	add_theme_support('title-tag');
	add_theme_support('custom-logo');
	add_theme_support( 'menus' );
	add_theme_support('widgets');
}

/* register nav menus */
register_nav_menus( 
	array(
	'footer' => 'Меню падвала',
	'header' => 'Меню шапки'
	)
);

/* add thumbnails support for posts */
if ( function_exists( 'add_theme_support' ) ) add_theme_support( 'post-thumbnails', array('post', 'page') );

/* queue styles and scripts */
add_action( 'wp_enqueue_scripts', 'theme_add_scripts' );
function theme_add_scripts() {

	wp_enqueue_style( 'default', get_template_directory_uri() .'/css/default.css', array(), null, false  );
	wp_enqueue_style( 'styles', get_template_directory_uri() .'/css/styles.css', array(), null, false  );
	wp_enqueue_style( 'engine', get_template_directory_uri() .'/css/engine.css', array(), null, false  );


	wp_enqueue_script( 'jquery', get_template_directory_uri() .'/scripts/jquery.js', array(), null, true );
	wp_enqueue_script( 'jqueryui', get_template_directory_uri() .'/scripts/jqueryui.js', array('jquery'), null, true );
	wp_enqueue_script( 'libs', get_template_directory_uri() .'/scripts/libs.js', array( 'highslide'), null, true );

	wp_enqueue_script( 'jquery-3-5-1', get_template_directory_uri() .'/scripts/jquery-3.5.1.min.js', array(), null, true );
	wp_enqueue_script( 'highslide', get_template_directory_uri() .'/scripts/highslide/highslide.js', array('jquery', 'jqueryui','jquery-3-5-1'), null, true );
	wp_enqueue_script( 'ajax', get_template_directory_uri() .'/scripts/ajax.js', array('jquery-3-5-1'), null, false );

	wp_enqueue_script('comment-reply');

	wp_localize_script( 'ajax', 'fp_posts', 
		array(
			'url' => admin_url('admin-ajax.php')
		)
	); 
}

/* register sidebars */
add_action( 'widgets_init', 'reg_widgets' );
function reg_widgets(){

	register_sidebar( array(
		'name'          => "Сайдбар",
		'id'            => "sidebar",
		'description'   => '',
		'class'         => 'col-right',
		'before_widget' => '',
		'after_widget'  => "",
		'before_title'  => '',
		'after_title'   => "",
		'before_sidebar' => '',
		'after_sidebar'  => '',
	) );

	register_sidebar( array(
		'name'          => "Подвал",
		'id'            => "footer-widget",
		'description'   => '',
		'class'         => '',
		'before_widget' => '<div class="footer-col">',
		'after_widget'  => "</div>",
		'before_title'  => '<h3 class="footer-col-title title">',
		'after_title'   => "</h3>",
		'before_sidebar' => '',
		'after_sidebar'  => '',
	) );
}

/* connect BannerWidget */
require  'includes/BannerWidget.php';

/* connect Breadcrumbs */
require  'includes/post_breadcrumb.php';

/* change pagination wrapper layout */
add_filter('navigation_markup_template', 'my_navigation_template', 10, 2 );
function my_navigation_template( $template, $class ){
 return '
 	<div class="bottom-nav clr ignore-select" id="bottom-nav">
 		<div class="pagi-nav clearfix">
 			<div class="navigation">%3$s</div>
 		</div>
 	</div>
 ';
}

/* post pagination */
function pagination() {
	$args = array(
		'show_all'           => true, 
		'end_size'           => 1,     
		'mid_size'           => 1,     
		'prev_next'          => false,  
		'add_args'           => false,
		'add_fragment'       => '',    
		'screen_reader_text' => __( 'Навигация по записям' ),
		'aria_label'         => __( 'Записи' ), 
		'class'              => 'pagination',
	);
	return the_posts_pagination($args);
}

/* ajax for front page */
add_action('wp_ajax_fp_posts', 'fp_posts_callback');
add_action('wp_ajax_nopriv_fp_posts', 'fp_posts_callback');
function fp_posts_callback() {
	$page_offset = intval( $_POST['offset'] ) * 4;

	$query = new WP_Query("orderby=date&order=DESC&post_type=post&posts_per_page=4&offset=$page_offset"); 

	if( $query->have_posts() ): ?>
    	
		<?php while ( $query->have_posts() ) : ?>
				<?php $query->the_post(); ?>

				<?php get_template_part('post-templates/short-item') ; ?>

			<?php endwhile; ?>

	<?php else: ?>
			<?php echo "nth"; ?>
	<?php endif; ?>
<?php
	
	wp_die();
}

/* custom metaboxes */
require  'includes/custom_metabox.php';


/*  comment layout callback function */
require  'includes/comment_layout.php';

/* delete url field in comment form */
add_filter('comment_form_default_fields','remove_comment_fields');
function remove_comment_fields($fields) {
    unset($fields['url']);
    return $fields;
}

/* change comment form fields order */
add_filter('comment_form_fields', 'reorder_comment_fields' );
function reorder_comment_fields( $fields ){

	$new_fields = array();

	$myorder = array('author', 'email', 'comment');

	foreach( $myorder as $key ){
		$new_fields[ $key ] = $fields[ $key ];
		unset( $fields[ $key ] );
	}

	if( $fields )
		foreach( $fields as $key => $val )
			$new_fields[ $key ] = $val;

	return $new_fields;
}

/* change login errors */
add_filter('login_errors', 'change_login_errors');
function change_login_errors() {
	return '<strong>ОШИБКА</strong>: Вы ошиблись при вводе логина или пароля.';
}

/* hide wp version */
remove_action('wp_head', 'wp_generator');
add_filter('the_generator', '__return_empty_string');

/* hide wp version from styles and scripts */
add_filter( 'script_loader_src', '_remove_script_version', 15, 1 );
add_filter( 'style_loader_src', '_remove_script_version', 15, 1 );
function _remove_script_version( $src ) {
	$parts = explode( '?', $src );
	return $parts[0];
}

/* remove unnecessary content from wp_head */
remove_action('wp_head', 'rsd_link');
remove_action('wp_head', 'feed_links', 2);
remove_action('wp_head', 'index_rel_link');
remove_action('wp_head', 'wlwmanifest_link');
remove_action('wp_head', 'feed_links_extra', 3);
remove_action('wp_head', 'start_post_rel_link', 10, 0);
remove_action('wp_head', 'parent_post_rel_link', 10, 0);
remove_action('wp_head', 'adjacent_posts_rel_link', 10, 0);

/* remove comment author class with usernames */
add_filter('comment_class', 'true_remove_css_class');
function true_remove_css_class( $classes ) {
	foreach( $classes as $key => $class ) {
		if(strstr($class, "comment-author-")) {
			unset( $classes[$key] );
		}
	}
	return $classes;
}

/* redirect ?author to 404 not found */
remove_filter('template_redirect', 'redirect_canonical');
add_action('template_redirect', 'author_archives_404');
function author_archives_404() {
	if ( is_author() || ( isset( $_GET['author'] ) && $_GET['author'] && !is_admin()) ) {
		global $wp_query;
		$wp_query->set_404();
		status_header(404);
	} else {
		redirect_canonical();
	}
}

/* change admin ID in db */
// global $wpdb;
// $wpdb->query("UPDATE $wpdb->users SET ID = 5555 WHERE ID = 1");
// $wpdb->query("UPDATE $wpdb->posts SET post_author = 5555 WHERE post_author = 1");
// $wpdb->query("UPDATE $wpdb->comments SET user_id = 5555 WHERE user_id = 1");
// $wpdb->query("UPDATE $wpdb->usermeta SET user_id = 5555 WHERE user_id = 1");
// $wpdb->query("ALTER TABLE $wpdb->users AUTO_INCREMENT = 5556"); 