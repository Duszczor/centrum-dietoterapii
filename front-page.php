<?php

/**
 * Front Page Template
 *
 * Gutenberg Hero block is rendered first if present in page content.
 * All other sections - including offer-cards - are rendered via template partials
 * in the order defined by dietitian_get_home_sections().
 */

get_header();
?>

<main id="main-content">
    <?php
    // Get hero block from page content for dynamic rendering
    $hero_block = dietitian_get_front_page_hero_block();

    // Render Hero block if present in page content
    if ($hero_block !== null) {
        echo render_block($hero_block);
    }

    // Render remaining sections via template partials, skipping already-rendered Hero block
    foreach (dietitian_get_home_sections() as $section_slug) {
        if ($section_slug === 'hero' && $hero_block !== null) {
            continue;
        }

        get_template_part('template-parts/sections/' . $section_slug . '/' . $section_slug);
    }
    ?>
</main>

<?php get_footer();
