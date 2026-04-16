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

    // Main JavaScript file (bootstrap/composition layer)
    wp_enqueue_script(
        'dietitian-main',
        get_template_directory_uri() . '/assets/js/main.js',
        [
            'dietitian-navigation-module',
            'dietitian-smooth-scroll-module',
            'dietitian-section-observer-module',
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

    $hero_image_uri = dietitian_get_asset_uri('images/hero/hero-bg.webp');
    $hero_image_768_uri = dietitian_get_asset_uri('images/hero/hero-bg-768.webp');
    $hero_image_1280_uri = dietitian_get_asset_uri('images/hero/hero-bg-1280.webp');
    $hero_image_1920_uri = dietitian_get_asset_uri('images/hero/hero-bg-1920.webp');
    $hero_image_srcset = $hero_image_768_uri . ' 768w, ' . $hero_image_1280_uri . ' 1280w, ' . $hero_image_1920_uri . ' 1920w, ' . $hero_image_uri . ' 2560w';

    echo '<link rel="preload" as="image" href="' . $hero_image_1280_uri . '" imagesrcset="' . $hero_image_srcset . '" imagesizes="100vw" type="image/webp" fetchpriority="high">';
}

add_action('wp_head', 'dietitian_preload_hero_image', 1);
