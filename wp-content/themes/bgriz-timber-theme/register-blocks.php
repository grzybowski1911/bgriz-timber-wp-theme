<?php

add_action('acf/init', 'register_acf_blocks');

function register_acf_blocks()
{
    // Bail out if function doesn’t exist.
    if (!function_exists('acf_register_block')) {
        return;
    }

    // Register a new block.
    acf_register_block([
        'name' => 'homepage_banner',
        'title' => __('Homepage Banner', 'bgriz-timber-theme'),
        'description' => __('Large Banner block intended for homepage.', 'bgriz-timber-theme'),
        'render_callback' => 'homepage_banner_render_callback',
        'category' => 'formatting',
        'icon' => 'dashicons-desktop',
        'keywords' => ['homepage','banner'],
    ]);
}


/**
 *  Define Render Callbacks for custom blocks
 *
 * @param   array  $block      The block settings and attributes.
 * @param   string $content    The block content (emtpy string).
 * @param   bool   $is_preview True during AJAX preview.
 */
function homepage_banner_render_callback($block, $content = '', $is_preview = false)
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
    Timber::render('blocks/homepage-banner.twig', $context);
}