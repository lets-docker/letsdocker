<?php
/**
 * Let's Docker functions and definitions
 *
 * Set up the theme and provides some helper functions, which are used in the
 * theme as custom template tags. Others are attached to action and filter
 * hooks in WordPress to change core functionality.
 *
 * When using a child theme you can override certain functions (those wrapped
 * in a function_exists() call) by defining them first in your child theme's
 * functions.php file. The child theme's functions.php file is included before
 * the parent theme's file, so the child theme functions would be used.
 *
 * @link https://codex.wordpress.org/Theme_Development
 * @link https://codex.wordpress.org/Child_Themes
 *
 * Functions that are not pluggable (not wrapped in function_exists()) are
 * instead attached to a filter or action hook.
 *
 * For more information on hooks, actions, and filters,
 * {@link https://codex.wordpress.org/Plugin_API}
 *
 * @package Let's Docker
 * @subpackage Let's Docker
 * @since Let's Docker 1.0
 */

/**
 * Set the content width based on the theme's design and stylesheet.
 *
 * @since Let's Docker 1.0
 */
if (! isset($content_width)) {
    $content_width = 660;
}


if (! function_exists('letsdocker_setup')) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 *
 * @since Let's Docker 1.0
 */
    function letsdocker_setup()
    {

        /*
         * Make theme available for translation.
         * Translations can be filed at WordPress.org. See: https://translate.wordpress.org/projects/wp-themes/letsdocker
         * If you're building a theme based on letsdocker, use a find and replace
         * to change 'letsdocker' to the name of your theme in all the template files
         */
        load_theme_textdomain('letsdocker');

        // Add default posts and comments RSS feed links to head.
        add_theme_support('automatic-feed-links');

        /*
         * Let WordPress manage the document title.
         * By adding theme support, we declare that this theme does not use a
         * hard-coded <title> tag in the document head, and expect WordPress to
         * provide it for us.
         */
        add_theme_support('title-tag');
    }
endif; // letsdocker_setup
add_action('after_setup_theme', 'letsdocker_setup');

/**
 *
 * Register new menu type to fill left sidebar
 *
 */

function register_sidebar_menu()
{
    register_nav_menu('sidebar-menu', __('Sidebar Menu'));
}
add_action('init', 'register_sidebar_menu');


/**
 *
 * Add "active" class to active menu items
 *
 */

add_filter('nav_menu_css_class', 'special_nav_class', 10, 2);

function special_nav_class($classes, $item)
{
    if (in_array('current-menu-item', $classes)) {
        $classes[] = 'active ';
    }
    return $classes;
}


/**
 *
 * Create Let's Docker Apps custom post type, will be used by docker containers
 *
 */

add_action('init', 'create_apps_type');

function create_apps_type()
{
    register_post_type(
        'letsdocker_apps',
	        array(
		        'labels' => array(
		        'name' => __('Apps'),
		        'singular_name' => __('App'),
		        'add_new' => __( 'Add New App' ),
                'add_new_item' => __( 'Add New App' ),
                'edit_item' => __( 'Edit App' ),
                'new_item' => __( 'Add New App' ),
                'view_item' => __( 'View Apps' ),
                'search_items' => __( 'Search Apps' ),
                'not_found' => __( 'No Apps found' ),
                'not_found_in_trash' => __( 'No Apps found in trash' )
	        ),
        'public' => true,
        'has_archive' => true,
        'rewrite' => array('slug' => 'apps'),
        'supports' => array( 'title', 'editor')
        )
    );
}


/**
 *
 * Apps taxonomies (apps categories)
 * 
 */

function create_apps_taxonomy() {

	$labels = array(
		'name'              => _x( 'Categories', 'taxonomy general name', 'textdomain' ),
		'singular_name'     => _x( 'Category', 'taxonomy singular name', 'textdomain' ),
		'search_items'      => __( 'Search Categories', 'textdomain' ),
		'all_items'         => __( 'All Categories', 'textdomain' ),
		'parent_item'       => __( 'Parent Category', 'textdomain' ),
		'parent_item_colon' => __( 'Parent Category:', 'textdomain' ),
		'edit_item'         => __( 'Edit Category', 'textdomain' ),
		'update_item'       => __( 'Update Category', 'textdomain' ),
		'add_new_item'      => __( 'Add Category', 'textdomain' ),
		'new_item_name'     => __( 'New Category', 'textdomain' ),
		'menu_name'         => __( 'Category', 'textdomain' ),
	);

	// create a new taxonomy
	register_taxonomy(
		'letsdocker_app_category',
		'letsdocker_apps',
		array(
			'labels'            => $labels,
			'rewrite' => array( 'slug' => 'app_category' ),
			'show_ui'           => true,
			'hierarchical'      => true,
		)
	);
}

add_action( 'init', 'create_apps_taxonomy' );


/**
 *
 * Apps base images (apps base images)
 * 
 */

function create_apps_base_taxonomy() {

	$labels = array(
		'name'              => _x( 'Bases', 'taxonomy general name', 'textdomain' ),
		'singular_name'     => _x( 'Base', 'taxonomy singular name', 'textdomain' ),
		'search_items'      => __( 'Search Bases', 'textdomain' ),
		'all_items'         => __( 'All Bases', 'textdomain' ),
		'parent_item'       => __( 'Parent Base', 'textdomain' ),
		'parent_item_colon' => __( 'Parent Base:', 'textdomain' ),
		'edit_item'         => __( 'Edit Base', 'textdomain' ),
		'update_item'       => __( 'Update Base', 'textdomain' ),
		'add_new_item'      => __( 'Add Base', 'textdomain' ),
		'new_item_name'     => __( 'New Base', 'textdomain' ),
		'menu_name'         => __( 'Base', 'textdomain' ),
	);

	// create a new taxonomy
	register_taxonomy(
		'letsdocker_app_base',
		'letsdocker_apps',
		array(
			'labels'            => $labels,
			'rewrite' => array( 'slug' => 'app_base' ),
			'show_ui'           => true,
			'hierarchical'      => true,
		)
	);
}

add_action( 'init', 'create_apps_base_taxonomy' );

/**
 *
 * Create docker ajax hook
 * 
 */
add_action("wp_ajax_create_docker", "create_docker_ajax");

function create_docker_ajax(){
 
	include '/../../../vendor/autoload.php';

	$apps = filter_var_array($_POST, FILTER_SANITIZE_STRING); //just an example filter

	include "library/docker/class.docker.php";

	$docker = new Docker();
	$docker->setProjectName($apps['project_name']);
	$docker->setApps($apps['apps']);
	$docker->letsDocker();

}

