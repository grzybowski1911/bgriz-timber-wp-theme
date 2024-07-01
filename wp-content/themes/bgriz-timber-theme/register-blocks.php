<?php

add_action('acf/init', 'register_acf_blocks');

function register_acf_blocks()
{
    // Bail out if function doesn’t exist.
    if (!function_exists('acf_register_block')) {
        return;
    }

    // Hero banner block
    acf_register_block([
        'name' => 'hero_banner',
        'title' => __('Hero Banner', 'bgriz-timber-theme'),
        'description' => __('Large Banner block intended for hero image at top of pages.', 'bgriz-timber-theme'),
        'render_callback' => 'hero_banner_render_callback',
        'category' => 'formatting',
        'icon' => 'dashicons-desktop',
        'keywords' => ['hero','banner'],
    ]);

    // Two Thirds Img Cta Block
        acf_register_block([
            'name' => 'two_thirds_img_cta_block',
            'title' => __('Two Thirds Img Cta Block', 'bgriz-timber-theme'),
            'description' => __('Two Third Content Column with two available CTA buttons + One Third Column image', 'bgriz-timber-theme'),
            'render_callback' => 'two_thirds_img_cta_block_render_callback',
            'category' => 'formatting',
            'icon' => 'dashicons-desktop',
            'keywords' => ['two thirds cta content one third img','two thirds', 'img', 'cta'],
        ]);

        // Spinning Logo BG Section w/ Columns
        acf_register_block([
            'name' => 'spinning_logo_bg_cols',
            'title' => __('Spinning Logo BG Section w/ Columns', 'bgriz-timber-theme'),
            'description' => __('Features a spinning logo in the background and up to three columns for featured items', 'bgriz-timber-theme'),
            'render_callback' => 'spinning_logo_bg_cols_render_callback',
            'category' => 'formatting',
            'icon' => 'dashicons-desktop',
            'keywords' => ['spinning logo cols','spinning section', 'logo bg'],
        ]);

        // Post display sticky image
        acf_register_block([
            'name' => 'post_display_sticky_img',
            'title' => __('Post Display with Sticky Image', 'bgriz-timber-theme'),
            'description' => __('Displays posts in two thirds column with a one third column containing a sticky image, plus a background.', 'bgriz-timber-theme'),
            'render_callback' => 'post_display_sticky_img_render_callback',
            'category' => 'formatting',
            'icon' => 'dashicons-desktop',
            'keywords' => ['spinning logo cols','spinning section', 'logo bg'],
        ]);

        // Post display grid
        acf_register_block([
            'name' => 'post_display_grid',
            'title' => __('Post Display in grid layout', 'bgriz-timber-theme'),
            'description' => __('Displays posts in a grid style layout', 'bgriz-timber-theme'),
            'render_callback' => 'post_display_grid_render_callback',
            'category' => 'formatting',
            'icon' => 'dashicons-desktop',
            'keywords' => ['spinning logo cols','spinning section', 'logo bg'],
        ]);

        // Carousel Block
        acf_register_block([
            'name' => 'slick_slider_with_content',
            'title' => __('Slick Slider with Content', 'bgriz-timber-theme'),
            'description' => __('Display a slider of images with option content to the left or right of the slider', 'bgriz-timber-theme'),
            'render_callback' => 'slick_slider_with_content_render_callback',
            'category' => 'formatting',
            'icon' => 'dashicons-desktop',
            'keywords' => ['slider','slick', 'carousel'],
        ]);
}


/**
 *  Define Render Callbacks for custom blocks
 *
 * @param   array  $block      The block settings and attributes.
 * @param   string $content    The block content (emtpy string).
 * @param   bool   $is_preview True during AJAX preview.
 */
function hero_banner_render_callback($block, $content = '', $is_preview = false)
{
    $context = Timber::context([
        // Store block values.
        'block' => $block,
        // Store field values.
        'fields' => get_fields(),
        // Store $is_preview value.
        'is_preview' => $is_preview,
    ]);

    // Render the block.
    Timber::render('blocks/hero-banner.twig', $context);
}

function two_thirds_img_cta_block_render_callback($block, $content = '', $is_preview = false) {
    $context = Timber::context([
        // Store block values.
        'block' => $block,
        // Store field values.
        'fields' => get_fields(),
        // Store $is_preview value.
        'is_preview' => $is_preview,
    ]);

    // Render the block.
    Timber::render('blocks/two-thirds-img-cta-block.twig', $context);
}

function spinning_logo_bg_cols_render_callback($block, $content = '', $is_preview = false)
{
    $context = Timber::context([
        // Store block values.
        'block' => $block,
        // Store field values.
        'fields' => get_fields(),
        // Store $is_preview value.
        'is_preview' => $is_preview,
    ]);

    // Render the block.
    Timber::render('blocks/spinning-logo-bg-cols-block.twig', $context);
}

function post_display_sticky_img_render_callback($block, $content = '', $is_preview = false)
{
    $context = Timber::context([
        // Store block values.
        'block' => $block,
        // Store field values.
        'fields' => get_fields(),
        // Store $is_preview value.
        'is_preview' => $is_preview,
    ]);

    // Render the block.
    Timber::render('blocks/post-display-sticky-img-block.twig', $context);
}

function post_display_grid_render_callback($block, $content = '', $is_preview = false)
{
    $context = Timber::context([
        // Store block values.
        'block' => $block,
        // Store field values.
        'fields' => get_fields(),
        // Store $is_preview value.
        'is_preview' => $is_preview,
    ]);

    // Render the block.
    Timber::render('blocks/post-display-grid-block.twig', $context);
}

function slick_slider_with_content_render_callback($block, $content = '', $is_preview = false)
{
    $context = Timber::context([
        // Store block values.
        'block' => $block,
        // Store field values.
        'fields' => get_fields(),
        // Store $is_preview value.
        'is_preview' => $is_preview,
    ]);

    // Render the block.
    Timber::render('blocks/slick-slider-with-content-block.twig', $context);
}