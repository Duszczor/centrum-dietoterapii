<!DOCTYPE html>
<html <?php language_attributes(); ?>>

<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/png" href="<?php echo dietitian_get_asset_uri('images/logo/navicon.png'); ?>">
    <link rel="apple-touch-icon" href="<?php echo dietitian_get_asset_uri('images/logo/navicon.png'); ?>">
    <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>

    <?php wp_body_open(); ?>

    <?php get_template_part('template-parts/header/site-header/site-header'); ?>