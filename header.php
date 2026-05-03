<!DOCTYPE html>
<html <?php language_attributes(); ?>>

<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php
    $no_seo_plugin = !defined('WPSEO_VERSION') && !defined('RANK_MATH_VERSION');

    // --- Meta description ---
    $meta_desc = '';
    if (is_singular()) {
        $meta_desc = get_the_excerpt() ?: get_bloginfo('description');
    } elseif (is_category() || is_tag()) {
        $meta_desc = wp_strip_all_tags(get_the_archive_description()) ?: get_bloginfo('description');
    } elseif (is_search()) {
        /* translators: %s: search query */
        $meta_desc = sprintf('Wyniki wyszukiwania dla: %s — Centrum Dietoterapii', get_search_query());
    } else {
        $meta_desc = get_bloginfo('description');
    }
    if (!$meta_desc) {
        $meta_desc = 'Centrum Dietoterapii – dietetyka kliniczna, leczenie dietą, indywidualne plany żywienia. Regulacja ciśnienia, cholesterolu i cukru pod okiem doświadczonego dietetyka.';
    }
    $meta_desc = wp_strip_all_tags($meta_desc);

    if ($no_seo_plugin) {
        echo '<meta name="description" content="' . esc_attr($meta_desc) . '">' . "\n    ";
    }

    // --- Canonical URL ---
    $canonical_url = '';
    if (is_singular()) {
        $canonical_url = (string) get_permalink();
    } elseif (is_front_page()) {
        $canonical_url = home_url('/');
    } elseif (is_home()) {
        $posts_page_id = (int) get_option('page_for_posts');
        $canonical_url = $posts_page_id > 0 ? (string) get_permalink($posts_page_id) : home_url('/blog/');
    } elseif (is_category() || is_tag()) {
        $term_link = get_term_link(get_queried_object());
        $canonical_url = !is_wp_error($term_link) ? $term_link : '';
    }
    if ($canonical_url && $no_seo_plugin) {
        echo '<link rel="canonical" href="' . esc_url($canonical_url) . '">' . "\n    ";
    }
    ?>
    <link rel="alternate" hreflang="pl" href="<?php echo esc_url(home_url('/')); ?>">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <?php if ($no_seo_plugin) : ?>
        <?php
        // --- Open Graph + Twitter Card ---
        $og_title   = is_singular() ? wp_strip_all_tags(get_the_title()) : get_bloginfo('name');
        $og_url     = $canonical_url ?: home_url('/');
        $og_type    = is_singular('post') ? 'article' : 'website';
        $og_image   = (is_singular() && has_post_thumbnail())
            ? (string) get_the_post_thumbnail_url(null, 'large')
            : esc_url(get_template_directory_uri() . '/assets/images/logo/logo.png');
        ?>
        <meta property="og:type" content="<?php echo esc_attr($og_type); ?>">
        <meta property="og:title" content="<?php echo esc_attr($og_title); ?>">
        <meta property="og:description" content="<?php echo esc_attr($meta_desc); ?>">
        <meta property="og:url" content="<?php echo esc_url($og_url); ?>">
        <meta property="og:site_name" content="<?php echo esc_attr(get_bloginfo('name')); ?>">
        <meta property="og:locale" content="pl_PL">
        <?php if ($og_image) : ?>
            <meta property="og:image" content="<?php echo esc_url($og_image); ?>">
        <?php endif; ?>
        <meta name="twitter:card" content="summary_large_image">
        <meta name="twitter:title" content="<?php echo esc_attr($og_title); ?>">
        <meta name="twitter:description" content="<?php echo esc_attr($meta_desc); ?>">
        <?php if ($og_image) : ?>
            <meta name="twitter:image" content="<?php echo esc_url($og_image); ?>">
        <?php endif; ?>
    <?php endif; ?>
    <?php if (is_front_page()) : ?>
        <script type="application/ld+json">
            <?php
            $schema = [
                '@context'          => 'https://schema.org',
                '@type'             => 'MedicalBusiness',
                'name'              => 'Centrum Dietoterapii',
                'description'       => 'Dietetyka kliniczna, indywidualne plany żywienia, leczenie dietą.',
                'url'               => home_url('/'),
                'telephone'         => '+48668156568',
                'email'             => 'kontakt@centrum-dietoterapii.pl',
                'medicalSpecialty'  => 'DietNutrition',
                'priceRange'        => '$$',
                'address'           => [
                    '@type'           => 'PostalAddress',
                    'streetAddress'   => 'Tuszewska 76 m.109',
                    'addressLocality' => 'Łowicz',
                    'postalCode'      => '99-400',
                    'addressCountry'  => 'PL',
                ],
            ];
            echo wp_json_encode($schema, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT);
            ?>
        </script>
    <?php endif; ?>
    <link rel="icon" type="image/png" href="<?php echo esc_url(dietitian_get_asset_uri('images/logo/navicon.png')); ?>">
    <link rel="apple-touch-icon" href="<?php echo esc_url(dietitian_get_asset_uri('images/logo/navicon.png')); ?>">
    <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>

    <?php wp_body_open(); ?>

    <a class="skip-link screen-reader-text" href="#main-content">Przejdź do treści</a>

    <?php get_template_part('template-parts/header/site-header/site-header'); ?>