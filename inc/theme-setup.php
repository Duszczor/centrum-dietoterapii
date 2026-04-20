<?php

/**
 * Theme Setup
 *
 * Registers theme supports and navigation menus.
 * Hooked into 'after_setup_theme' for proper load order.
 */
function dietitian_setup(): void
{
    // Allow WordPress to manage the <title> tag
    add_theme_support('title-tag');

    // Enable featured images on posts and pages
    add_theme_support('post-thumbnails');

    // Enable custom logo support (used in the header/nav)
    add_theme_support('custom-logo', [
        'height'      => 80,
        'width'       => 200,
        'flex-width'  => true,
        'flex-height' => true,
    ]);

    // Opt into semantic HTML5 markup for core elements
    add_theme_support('html5', [
        'search-form',
        'comment-form',
        'comment-list',
        'gallery',
        'caption',
        'navigation-widgets',
    ]);

    // Enable modern block editor layout controls
    add_theme_support('align-wide');

    // Reuse frontend styles inside the editor for closer visual parity
    add_theme_support('editor-styles');
    add_editor_style('assets/dist/style.css');

    // Register navigation menu locations
    register_nav_menus([
        'primary' => 'Primary Menu',
    ]);
}

add_action('after_setup_theme', 'dietitian_setup');
