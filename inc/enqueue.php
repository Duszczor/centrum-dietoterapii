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

    if (is_front_page()) {
        // Homepage motion config
        wp_enqueue_script(
            'dietitian-page-motion-config',
            get_template_directory_uri() . '/assets/js/modules/page-motion/config.js',
            [],
            filemtime(get_template_directory() . '/assets/js/modules/page-motion/config.js'),
            true
        );

        // Homepage motion widget module
        wp_enqueue_script(
            'dietitian-page-motion-widget',
            get_template_directory_uri() . '/assets/js/modules/page-motion/widget.js',
            ['dietitian-page-motion-config'],
            filemtime(get_template_directory() . '/assets/js/modules/page-motion/widget.js'),
            true
        );

        // Homepage motion reveal module
        wp_enqueue_script(
            'dietitian-page-motion-reveal',
            get_template_directory_uri() . '/assets/js/modules/page-motion/reveal.js',
            ['dietitian-page-motion-config'],
            filemtime(get_template_directory() . '/assets/js/modules/page-motion/reveal.js'),
            true
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
            true
        );
    }

    // Bootstrap constants
    wp_enqueue_script(
        'dietitian-bootstrap-constants',
        get_template_directory_uri() . '/assets/js/bootstrap/constants.js',
        [],
        filemtime(get_template_directory() . '/assets/js/bootstrap/constants.js'),
        true
    );

    // Bootstrap page context factory
    wp_enqueue_script(
        'dietitian-bootstrap-create-page-context',
        get_template_directory_uri() . '/assets/js/bootstrap/create-page-context.js',
        ['dietitian-bootstrap-constants'],
        filemtime(get_template_directory() . '/assets/js/bootstrap/create-page-context.js'),
        true
    );

    // Bootstrap module initializer
    wp_enqueue_script(
        'dietitian-bootstrap-init-modules',
        get_template_directory_uri() . '/assets/js/bootstrap/init-modules.js',
        ['dietitian-bootstrap-constants'],
        filemtime(get_template_directory() . '/assets/js/bootstrap/init-modules.js'),
        true
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
        true
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
        true // Load in footer
    );

    // Add defer to all custom scripts — they're already in footer, defer removes them
    // from the critical request chain so they don't impact LCP timing.
    $deferred_handles = [
        'dietitian-navigation-module',
        'dietitian-smooth-scroll-module',
        'dietitian-section-observer-module',
        'dietitian-bootstrap-constants',
        'dietitian-bootstrap-create-page-context',
        'dietitian-bootstrap-init-modules',
        'dietitian-bootstrap-app',
        'dietitian-main',
    ];

    if (is_front_page()) {
        $deferred_handles = array_merge($deferred_handles, [
            'dietitian-page-motion-config',
            'dietitian-page-motion-widget',
            'dietitian-page-motion-reveal',
            'dietitian-page-motion-module',
        ]);
    }

    foreach ($deferred_handles as $handle) {
        wp_script_add_data($handle, 'defer', true);
    }

    // ZnanyLekarz floating widget (front page): load only when browser is idle.
    if (is_front_page()) {
        wp_add_inline_script(
            'dietitian-main',
            "(function(){if(!document.getElementById('zl-url')){return;}var loaded=false;var events=['pointerdown','touchstart','scroll','keydown'];var loadWidget=function(){if(loaded||document.getElementById('dietitian-znanylekarz-script')){return;}loaded=true;events.forEach(function(e){window.removeEventListener(e,loadWidget,{passive:true});});var s=document.createElement('script');s.id='dietitian-znanylekarz-script';s.src='https://platform.docplanner.com/js/widget.js';s.async=true;document.body.appendChild(s);};events.forEach(function(e){window.addEventListener(e,loadWidget,{once:true,passive:true});});window.addEventListener('load',function(){window.setTimeout(loadWidget,10000);},{once:true});})();",
            'after'
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
 */
function dietitian_add_google_fonts_resource_hints(array $urls, string $relation_type): array
{
    if ($relation_type !== 'preconnect') {
        return $urls;
    }

    $urls[] = 'https://fonts.googleapis.com';
    $urls[] = [
        'href' => 'https://fonts.gstatic.com',
        'crossorigin',
    ];

    return $urls;
}

add_filter('wp_resource_hints', 'dietitian_add_google_fonts_resource_hints', 10, 2);

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

/**
 * Output defer attribute for scripts that have the 'defer' data flag set.
 */
function dietitian_add_defer_to_scripts(string $tag, string $handle): string
{
    if (wp_scripts()->get_data($handle, 'defer')) {
        // Avoid doubling up if defer is already present (e.g. via another filter).
        if (strpos($tag, ' defer') === false) {
            $tag = str_replace(' src=', ' defer src=', $tag);
        }
    }

    return $tag;
}

add_filter('script_loader_tag', 'dietitian_add_defer_to_scripts', 10, 2);
