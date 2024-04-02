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
