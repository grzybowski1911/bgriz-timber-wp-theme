<?php

add_action('acf/init', 'register_acf_blocks');

function register_acf_blocks()
{
    // Bail out if function doesn’t exist.
    if (!function_exists('acf_register_block')) {
        return;
    }

    // Homepage banner block
    acf_register_block([
        'name' => 'homepage_banner',
        'title' => __('Homepage Banner', 'bgriz-timber-theme'),
        'description' => __('Large Banner block intended for homepage.', 'bgriz-timber-theme'),
        'render_callback' => 'homepage_banner_render_callback',
        'category' => 'formatting',
        'icon' => 'dashicons-desktop',
        'keywords' => ['homepage','banner'],
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
    Timber::render('blocks/spinning_logo_bg_cols_block.twig', $context);
}