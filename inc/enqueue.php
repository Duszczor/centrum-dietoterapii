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
        'https://fonts.googleapis.com/css2?family=Inter:wght@400;500;700&display=swap',
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
        ['in_footer' => true, 'strategy' => 'defer']
    );

    // Smooth-scroll module
    wp_enqueue_script(
        'dietitian-smooth-scroll-module',
        get_template_directory_uri() . '/assets/js/modules/smooth-scroll.js',
        [],
        filemtime(get_template_directory() . '/assets/js/modules/smooth-scroll.js'),
        ['in_footer' => true, 'strategy' => 'defer']
    );

    // Section observer module
    wp_enqueue_script(
        'dietitian-section-observer-module',
        get_template_directory_uri() . '/assets/js/modules/section-observer.js',
        [],
        filemtime(get_template_directory() . '/assets/js/modules/section-observer.js'),
        ['in_footer' => true, 'strategy' => 'defer']
    );

    if (is_front_page()) {
        // Homepage motion config
        wp_enqueue_script(
            'dietitian-page-motion-config',
            get_template_directory_uri() . '/assets/js/modules/page-motion/config.js',
            [],
            filemtime(get_template_directory() . '/assets/js/modules/page-motion/config.js'),
            ['in_footer' => true, 'strategy' => 'defer']
        );

        // Homepage motion widget module
        wp_enqueue_script(
            'dietitian-page-motion-widget',
            get_template_directory_uri() . '/assets/js/modules/page-motion/widget.js',
            ['dietitian-page-motion-config'],
            filemtime(get_template_directory() . '/assets/js/modules/page-motion/widget.js'),
            ['in_footer' => true, 'strategy' => 'defer']
        );

        // Homepage motion reveal module
        wp_enqueue_script(
            'dietitian-page-motion-reveal',
            get_template_directory_uri() . '/assets/js/modules/page-motion/reveal.js',
            ['dietitian-page-motion-config'],
            filemtime(get_template_directory() . '/assets/js/modules/page-motion/reveal.js'),
            ['in_footer' => true, 'strategy' => 'defer']
        );

        // Homepage motion orchestrator
        wp_enqueue_script(
            'dietitian-page-motion-module',
            get_template_directory_uri() . '/assets/js/modules/page-motion.js',
            [
                'dietitian-page-motion-config',
                'dietitian-page-motion-widget',
                'dietitian-page-motion-reveal',
            ],
            filemtime(get_template_directory() . '/assets/js/modules/page-motion.js'),
            ['in_footer' => true, 'strategy' => 'defer']
        );
    }

    // Bootstrap constants
    wp_enqueue_script(
        'dietitian-bootstrap-constants',
        get_template_directory_uri() . '/assets/js/bootstrap/constants.js',
        [],
        filemtime(get_template_directory() . '/assets/js/bootstrap/constants.js'),
        ['in_footer' => true, 'strategy' => 'defer']
    );

    // Bootstrap page context factory
    wp_enqueue_script(
        'dietitian-bootstrap-create-page-context',
        get_template_directory_uri() . '/assets/js/bootstrap/create-page-context.js',
        ['dietitian-bootstrap-constants'],
        filemtime(get_template_directory() . '/assets/js/bootstrap/create-page-context.js'),
        ['in_footer' => true, 'strategy' => 'defer']
    );

    // Bootstrap module initializer
    wp_enqueue_script(
        'dietitian-bootstrap-init-modules',
        get_template_directory_uri() . '/assets/js/bootstrap/init-modules.js',
        ['dietitian-bootstrap-constants'],
        filemtime(get_template_directory() . '/assets/js/bootstrap/init-modules.js'),
        ['in_footer' => true, 'strategy' => 'defer']
    );

    // Bootstrap app orchestrator
    wp_enqueue_script(
        'dietitian-bootstrap-app',
        get_template_directory_uri() . '/assets/js/bootstrap/bootstrap-app.js',
        [
            'dietitian-bootstrap-create-page-context',
            'dietitian-bootstrap-init-modules',
        ],
        filemtime(get_template_directory() . '/assets/js/bootstrap/bootstrap-app.js'),
        ['in_footer' => true, 'strategy' => 'defer']
    );

    // Main JavaScript file (bootstrap/composition layer)
    $main_dependencies = [
        'dietitian-navigation-module',
        'dietitian-smooth-scroll-module',
        'dietitian-section-observer-module',
        'dietitian-bootstrap-app',
    ];

    if (is_front_page()) {
        $main_dependencies[] = 'dietitian-page-motion-module';
    }

    wp_enqueue_script(
        'dietitian-main',
        get_template_directory_uri() . '/assets/js/main.js',
        $main_dependencies,
        filemtime(get_template_directory() . '/assets/js/main.js'),
        ['in_footer' => true, 'strategy' => 'defer']
    );

    // ZnanyLekarz floating widget (front page): loaded lazily on first user interaction.
    if (is_front_page()) {
        wp_enqueue_script(
            'dietitian-zl-widget-loader',
            get_template_directory_uri() . '/assets/js/modules/zl-widget-loader.js',
            ['dietitian-main'],
            filemtime(get_template_directory() . '/assets/js/modules/zl-widget-loader.js'),
            ['in_footer' => true, 'strategy' => 'defer']
        );
    }
}

add_action('wp_enqueue_scripts', 'dietitian_enqueue_assets');

/**
 * Load Google Fonts asynchronously to reduce render-blocking time.
 */
function dietitian_optimize_google_fonts_stylesheet(string $html, string $handle, string $href, string $media): string
{
    if ($handle !== 'dietitian-google-fonts') {
        return $html;
    }

    $font_href = esc_url($href);

    return "<link rel='stylesheet' id='dietitian-google-fonts-css' href='{$font_href}' media='print' onload=\"this.media='all'\" />\n<noscript><link rel='stylesheet' href='{$font_href}' /></noscript>";
}

add_filter('style_loader_tag', 'dietitian_optimize_google_fonts_stylesheet', 10, 4);

/**
 * Add preconnect hints for Google Fonts domains.
 *
 * Uses wp_head directly — wp_resource_hints was removed in WP 6.7.
 */
add_action('wp_head', function (): void {
    echo '<link rel="preconnect" href="https://fonts.googleapis.com">' . "\n";
    echo '<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>' . "\n";
}, 1);

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

/**
 * Preload main stylesheet early in <head> to reduce critical chain latency.
 */
function dietitian_preload_main_stylesheet(): void
{
    $css_path = get_template_directory() . '/assets/dist/style.css';
    $css_url  = get_template_directory_uri() . '/assets/dist/style.css';
    $version  = filemtime($css_path);

    echo '<link rel="preload" as="style" href="' . esc_url($css_url . '?ver=' . $version) . '">' . "\n";
}

add_action('wp_head', 'dietitian_preload_main_stylesheet', 1);
