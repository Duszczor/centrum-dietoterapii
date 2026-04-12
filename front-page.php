<?php get_header(); ?>

<main id="main-content">
    <?php foreach (dietitian_get_home_sections() as $section_slug) : ?>
        <?php get_template_part('template-parts/sections/' . $section_slug); ?>
    <?php endforeach; ?>
</main>

<?php get_footer(); ?>