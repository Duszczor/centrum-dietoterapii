<!DOCTYPE html>
<html <?php language_attributes(); ?>>

<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php
    // Output meta description only when no SEO plugin is active (Yoast/RankMath handle it themselves).
    if (!defined('WPSEO_VERSION') && !defined('RANK_MATH_VERSION')) {
        $meta_desc = '';
        if (is_singular()) {
            $meta_desc = get_the_excerpt() ?: get_bloginfo('description');
        } else {
            $meta_desc = get_bloginfo('description');
        }
        // Fallback for sites with empty tagline
        if (!$meta_desc) {
            $meta_desc = 'Centrum Dietoterapii – dietetyka kliniczna, leczenie dietą, indywidualne plany żywienia. Regulacja ciśnienia, cholesterolu i cukru pod okiem doświadczonego dietetyka.';
        }
        echo '<meta name="description" content="' . esc_attr(wp_strip_all_tags($meta_desc)) . '">' . "\n    ";
    }
    ?>
    <link rel="icon" type="image/png" href="<?php echo dietitian_get_asset_uri('images/logo/navicon.png'); ?>">
    <link rel="apple-touch-icon" href="<?php echo dietitian_get_asset_uri('images/logo/navicon.png'); ?>">
    <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>

    <?php wp_body_open(); ?>

    <?php get_template_part('template-parts/header/site-header/site-header'); ?>