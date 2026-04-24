
<?php

// Ładny tytuł archiwum kategorii: "Kategoria: [Nazwa kategorii]"
add_filter('get_the_archive_title', function ($title) {
    if (is_category()) {
        $title = 'Kategoria: ' . single_cat_title('', false);
    }
    return $title;
});

require get_template_directory() . '/inc/theme-setup.php';
require get_template_directory() . '/inc/theme-helpers.php';
require get_template_directory() . '/inc/enqueue.php';
require get_template_directory() . '/inc/blocks.php';
require get_template_directory() . '/inc/theme-icons.php';
require get_template_directory() . '/inc/theme-data.php';
require get_template_directory() . '/inc/dev-seed.php';
