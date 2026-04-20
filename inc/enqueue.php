<?php

/**
 * Enqueue Styles and Scripts
 *
 * Loads the compiled CSS and main JS file.
 * filemtime() ensures automatic cache busting on every file change.
 */
function dietitian_enqueue_assets(): void
{
    // Google Fonts — loaded here for correct <head> placement and browser resource prioritization
    wp_enqueue_style(
        'dietitian-google-fonts',
        'https://fonts.googleapis.com/css2?family=Inter:wght@400;500;700&family=Playfair+Display:wght@400;700&display=swap',
        [],
        null
    );

    // Main stylesheet (compiled from SCSS)
    wp_enqueue_style(
        'dietitian-style',
        get_template_directory_uri() . '/assets/dist/style.css',
        [],
        filemtime(get_template_directory() . '/assets/dist/style.css')
    );

    // Navigation module
    wp_enqueue_script(
        'dietitian-navigation-module',
        get_template_directory_uri() . '/assets/js/modules/navigation.js',
        [],
        filemtime(get_template_directory() . '/assets/js/modules/navigation.js'),
        true
    );

    // Smooth-scroll module
    wp_enqueue_script(
        'dietitian-smooth-scroll-module',
        get_template_directory_uri() . '/assets/js/modules/smooth-scroll.js',
        [],
        filemtime(get_template_directory() . '/assets/js/modules/smooth-scroll.js'),
        true
    );

    // Section observer module
    wp_enqueue_script(
        'dietitian-section-observer-module',
        get_template_directory_uri() . '/assets/js/modules/section-observer.js',
        [],
        filemtime(get_template_directory() . '/assets/js/modules/section-observer.js'),
        true
    );

    // Homepage motion module
    wp_enqueue_script(
        'dietitian-page-motion-module',
        get_template_directory_uri() . '/assets/js/modules/page-motion.js',
        [],
        filemtime(get_template_directory() . '/assets/js/modules/page-motion.js'),
        true
    );

    // ZnanyLekarz floating widget script (front page only)
    if (is_front_page()) {
        wp_enqueue_script(
            'dietitian-znanylekarz-widget',
            'https://platform.docplanner.com/js/widget.js',
            [],
            null,
            true
        );
    }

    // Main JavaScript file (bootstrap/composition layer)
    wp_enqueue_script(
        'dietitian-main',
        get_template_directory_uri() . '/assets/js/main.js',
        [
            'dietitian-navigation-module',
            'dietitian-smooth-scroll-module',
            'dietitian-section-observer-module',
            'dietitian-page-motion-module',
        ],
        filemtime(get_template_directory() . '/assets/js/main.js'),
        true // Load in footer
    );
}

add_action('wp_enqueue_scripts', 'dietitian_enqueue_assets');

/**
 * Preload hero image on the front page to improve LCP.
 */
function dietitian_preload_hero_image(): void
{
    if (!is_front_page()) {
        return;
    }

    $hero_block = dietitian_get_front_page_hero_block();
    $hero_attributes = is_array($hero_block) ? ($hero_block['attrs'] ?? []) : [];
    $hero_image = dietitian_get_hero_image_data(is_array($hero_attributes) ? $hero_attributes : []);

    if (empty($hero_image['src'])) {
        return;
    }

    $preload_tag = '<link rel="preload" as="image" href="' . esc_url($hero_image['src']) . '"';

    if (!empty($hero_image['srcset'])) {
        $preload_tag .= ' imagesrcset="' . esc_attr((string) $hero_image['srcset']) . '"';
    }

    $preload_tag .= ' imagesizes="100vw" fetchpriority="high">';

    echo $preload_tag;
}

add_action('wp_head', 'dietitian_preload_hero_image', 1);
