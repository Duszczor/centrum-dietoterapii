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

add_filter('document_title_parts', 'dietitian_custom_title_parts');
function dietitian_custom_title_parts(array $parts): array
{
    $site_name = get_bloginfo('name');

    if (is_front_page()) {
        $parts['title'] = 'Centrum Dietoterapii | Dietetyk, Łowicz';
        unset($parts['tagline'], $parts['site']);
        return $parts;
    }

    if (is_home()) {
        $parts['title'] = 'Blog dietetyczny';
        $parts['site']  = $site_name;
        return $parts;
    }

    if (is_category()) {
        $parts['title'] = single_cat_title('', false);
        $parts['site']  = $site_name;
        return $parts;
    }

    if (is_tag()) {
        $parts['title'] = single_tag_title('', false);
        $parts['site']  = $site_name;
        return $parts;
    }

    if (is_search()) {
        /* translators: %s: search query */
        $parts['title'] = sprintf('Wyniki dla: %s', get_search_query());
        $parts['site']  = $site_name;
        return $parts;
    }

    if (!isset($parts['site'])) {
        $parts['site'] = $site_name;
    }

    return $parts;
}
