<!DOCTYPE html>
<html <?php language_attributes(); ?>>

<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="alternate" hreflang="pl" href="<?php echo esc_url(home_url('/')); ?>">
    <link rel="icon" type="image/png" href="<?php echo esc_url(dietitian_get_asset_uri('images/logo/navicon.png')); ?>">
    <link rel="apple-touch-icon" href="<?php echo esc_url(dietitian_get_asset_uri('images/logo/navicon.png')); ?>">
    <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>

    <?php wp_body_open(); ?>

    <a class="skip-link screen-reader-text" href="#main-content">Przejdź do treści</a>

    <?php get_template_part('template-parts/header/site-header/site-header'); ?>