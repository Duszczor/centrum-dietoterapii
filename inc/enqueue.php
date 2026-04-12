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

    // Main JavaScript file (deferred, loaded after HTML is parsed)
    wp_enqueue_script(
        'dietitian-main',
        get_template_directory_uri() . '/assets/js/main.js',
        [],
        filemtime(get_template_directory() . '/assets/js/main.js'),
        true // Load in footer
    );
}

add_action('wp_enqueue_scripts', 'dietitian_enqueue_assets');
