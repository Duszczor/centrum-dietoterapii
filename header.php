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

    <a class="skip-link" href="#main-content">Przejdz do tresci</a>

    <header class="site-header" id="site-header">
        <div class="container">
            <?php get_template_part('template-parts/header/nav'); ?>
        </div>
    </header>