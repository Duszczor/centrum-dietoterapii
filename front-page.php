<?php

/**
 * Front Page Template
 *
 * Renders the front page with dynamic Gutenberg blocks and fallback template partials.
 * Blocks (Hero, Offer Cards) are rendered first if present in page content.
 * Remaining sections are rendered via template partials.
 */

get_header();
?>

<main id="main-content">
    <?php
    // Get blocks from page content for dynamic rendering
    $hero_block = dietitian_get_front_page_hero_block();
    $offer_cards_block = dietitian_get_front_page_offer_cards_block();

    // Render Hero block if present in page content
    if ($hero_block !== null) {
        echo render_block($hero_block);
    }

    // Render remaining sections from configured home sections
    foreach (dietitian_get_home_sections() as $section_slug) {
        // Skip Hero section if already rendered via block
        if ($section_slug === 'hero' && $hero_block !== null) {
            continue;
        }

        // Render Offer Cards block or fallback template partial
        if ($section_slug === 'offer-cards') {
            if ($offer_cards_block !== null) {
                echo render_block($offer_cards_block);
            } else {
                get_template_part('template-parts/sections/' . $section_slug . '/' . $section_slug);
            }
            continue;
        }

        // Render all other sections via template partials
        get_template_part('template-parts/sections/' . $section_slug . '/' . $section_slug);
    }
    ?>
</main>

<?php get_footer();
