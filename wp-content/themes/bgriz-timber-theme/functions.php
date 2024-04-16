<?php
/**
 * Timber starter-theme
 * https://github.com/timber/starter-theme
 */

// Load Composer dependencies.
require_once __DIR__ . '/vendor/autoload.php';

require_once __DIR__ . '/src/StarterSite.php';

Timber\Timber::init();

// Sets the directories (inside your theme) to find .twig files.
Timber::$dirname = [ 'templates', 'views' ];

new StarterSite();

// Add function to query posts in twig files 

// Function to fetch posts
function get_custom_posts($post_type) {
  $args = array(
      'post_type' => $post_type,
      'posts_per_page' => -1,
  );

  $query = new WP_Query($args);
  $posts_with_thumbnails = array();

  foreach ($query->posts as $post) {
      setup_postdata($post);
      $thumbnail_url = get_the_post_thumbnail_url($post->ID);

      // Collecting all necessary post data
      $posts_with_thumbnails[] = array(
          'ID' => $post->ID,
          'post_title' => get_the_title($post),
          'post_excerpt' => get_the_excerpt($post),
          'thumbnail_url' => $thumbnail_url ? $thumbnail_url : '',
      );
  }

  wp_reset_postdata();
  return $posts_with_thumbnails;
}


// Add custom function to Twig
add_filter('get_twig', 'add_custom_twig_functions');
function add_custom_twig_functions($twig) {
  $twig->addFunction(new \Twig\TwigFunction('get_custom_posts', 'get_custom_posts'));
  return $twig;
}

// Register blocks 

include('register-blocks.php');

/**
 * Enqueue Tailwind CSS
 */

function enqueue_styles() {
    wp_enqueue_style( 'tailwindcss', get_template_directory_uri() . '/dist/css/style.css', array(), '1.0.0', 'all' );
    wp_enqueue_style( 'sass-css', get_template_directory_uri() . '/dist/css/sass-comp.css', array(), '1.0.0', 'all' );
  }
add_action( 'wp_enqueue_scripts', 'enqueue_styles' );
add_action( 'enqueue_block_editor_assets', 'enqueue_styles' ); // Hook for editor


// Define custom post type for Jobs
function custom_post_type_jobs() {
  $labels = array(
      'name'                  => _x( 'Jobs', 'Post Type General Name', 'bgriz_timber_theme' ),
      'singular_name'         => _x( 'Job', 'Post Type Singular Name', 'bgriz_timber_theme' ),
      'menu_name'             => __( 'Jobs', 'bgriz_timber_theme' ),
      'name_admin_bar'        => __( 'Job', 'bgriz_timber_theme' ),
      'archives'              => __( 'Job Archives', 'bgriz_timber_theme' ),
      'attributes'            => __( 'Job Attributes', 'bgriz_timber_theme' ),
      'parent_item_colon'     => __( 'Parent Job:', 'bgriz_timber_theme' ),
      'all_items'             => __( 'All Jobs', 'bgriz_timber_theme' ),
      'add_new_item'          => __( 'Add New Job', 'bgriz_timber_theme' ),
      'add_new'               => __( 'Add New', 'bgriz_timber_theme' ),
      'new_item'              => __( 'New Job', 'bgriz_timber_theme' ),
      'edit_item'             => __( 'Edit Job', 'bgriz_timber_theme' ),
      'update_item'           => __( 'Update Job', 'bgriz_timber_theme' ),
      'view_item'             => __( 'View Job', 'bgriz_timber_theme' ),
      'view_items'            => __( 'View Jobs', 'bgriz_timber_theme' ),
      'search_items'          => __( 'Search Job', 'bgriz_timber_theme' ),
      'not_found'             => __( 'Not found', 'bgriz_timber_theme' ),
      'not_found_in_trash'    => __( 'Not found in Trash', 'bgriz_timber_theme' ),
      'featured_image'        => __( 'Featured Image', 'bgriz_timber_theme' ),
      'set_featured_image'    => __( 'Set featured image', 'bgriz_timber_theme' ),
      'remove_featured_image' => __( 'Remove featured image', 'bgriz_timber_theme' ),
      'use_featured_image'    => __( 'Use as featured image', 'bgriz_timber_theme' ),
      'insert_into_item'      => __( 'Insert into job', 'bgriz_timber_theme' ),
      'uploaded_to_this_item' => __( 'Uploaded to this job', 'bgriz_timber_theme' ),
      'items_list'            => __( 'Jobs list', 'bgriz_timber_theme' ),
      'items_list_navigation' => __( 'Jobs list navigation', 'bgriz_timber_theme' ),
      'filter_items_list'     => __( 'Filter jobs list', 'bgriz_timber_theme' ),
  );
  $args = array(
      'label'                 => __( 'Job', 'bgriz_timber_theme' ),
      'description'           => __( 'Post type for displaying information about past jobs', 'bgriz_timber_theme' ),
      'labels'                => $labels,
      'supports'              => array( 'title', 'editor', 'thumbnail', 'excerpt', 'custom-fields' ),
      'taxonomies'            => array( 'category', 'post_tag' ),
      'hierarchical'          => false,
      'public'                => true,
      'menu_icon'             => 'dashicons-businessman',
      'show_ui'               => true,
      'show_in_menu'          => true,
      'menu_position'         => 5,
      'show_in_admin_bar'     => true,
      'show_in_nav_menus'     => true,
      'show_in_rest'          => true,
      'can_export'            => true,
      'has_archive'           => true,
      'exclude_from_search'   => false,
      'publicly_queryable'    => true,
      'capability_type'       => 'post',
  );
  register_post_type( 'job', $args );
}
add_action( 'init', 'custom_post_type_jobs', 0 );

// Define custom post type for Projects
function custom_post_type_projects() {
  $labels = array(
      'name'                  => _x( 'Projects', 'Post Type General Name', 'bgriz_timber_theme' ),
      'singular_name'         => _x( 'Project', 'Post Type Singular Name', 'bgriz_timber_theme' ),
      'menu_name'             => __( 'Projects', 'bgriz_timber_theme' ),
      'name_admin_bar'        => __( 'Project', 'bgriz_timber_theme' ),
      'archives'              => __( 'Project Archives', 'bgriz_timber_theme' ),
      'attributes'            => __( 'Project Attributes', 'bgriz_timber_theme' ),
      'parent_item_colon'     => __( 'Parent Project:', 'bgriz_timber_theme' ),
      'all_items'             => __( 'All Projects', 'bgriz_timber_theme' ),
      'add_new_item'          => __( 'Add New Project', 'bgriz_timber_theme' ),
      'add_new'               => __( 'Add New', 'bgriz_timber_theme' ),
      'new_item'              => __( 'New Project', 'bgriz_timber_theme' ),
      'edit_item'             => __( 'Edit Project', 'bgriz_timber_theme' ),
      'update_item'           => __( 'Update Project', 'bgriz_timber_theme' ),
      'view_item'             => __( 'View Project', 'bgriz_timber_theme' ),
      'view_items'            => __( 'View Projects', 'bgriz_timber_theme' ),
      'search_items'          => __( 'Search Project', 'bgriz_timber_theme' ),
      'not_found'             => __( 'Not found', 'bgriz_timber_theme' ),
      'not_found_in_trash'    => __( 'Not found in Trash', 'bgriz_timber_theme' ),
      'featured_image'        => __( 'Featured Image', 'bgriz_timber_theme' ),
      'set_featured_image'    => __( 'Set featured image', 'bgriz_timber_theme' ),
      'remove_featured_image' => __( 'Remove featured image', 'bgriz_timber_theme' ),
      'use_featured_image'    => __( 'Use as featured image', 'bgriz_timber_theme' ),
      'insert_into_item'      => __( 'Insert into project', 'bgriz_timber_theme' ),
      'uploaded_to_this_item' => __( 'Uploaded to this project', 'bgriz_timber_theme' ),
      'items_list'            => __( 'Projects list', 'bgriz_timber_theme' ),
      'items_list_navigation' => __( 'Projects list navigation', 'bgriz_timber_theme' ),
      'filter_items_list'     => __( 'Filter projects list', 'bgriz_timber_theme' ),
  );
  $args = array(
      'label'                 => __( 'Project', 'bgriz_timber_theme' ),
      'description'           => __( 'Post type for displaying information about various projects', 'bgriz_timber_theme' ),
      'labels'                => $labels,
      'supports'              => array( 'title', 'editor', 'thumbnail', 'excerpt', 'custom-fields' ),
      'taxonomies'            => array( 'category', 'post_tag' ),
      'hierarchical'          => false,
      'public'                => true,
      'menu_icon'             => 'dashicons-portfolio',
      'show_ui'               => true,
      'show_in_menu'          => true,
      'menu_position'         => 5,
      'show_in_admin_bar'     => true,
      'show_in_nav_menus'     => true,
      'show_in_rest'          => true,
      'can_export'            => true,
      'has_archive'           => true,
      'exclude_from_search'   => false,
      'publicly_queryable'    => true,
      'capability_type'       => 'post',
  );
  register_post_type( 'project', $args );
}
add_action( 'init', 'custom_post_type_projects', 0 );


