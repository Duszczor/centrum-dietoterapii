<?php
$navigation_items = dietitian_get_primary_navigation_items();
$site_name        = get_bloginfo('name');

$posts_page_id  = (int) get_option('page_for_posts');
$posts_page_url = $posts_page_id > 0 ? get_permalink($posts_page_id) : home_url('/blog/');
$posts_page_url = is_string($posts_page_url) ? $posts_page_url : home_url('/blog/');
$posts_page_url = trailingslashit($posts_page_url);

$main_navigation_items = [];

foreach ($navigation_items as $item) {
    if (($item['href'] ?? '') === '#contact') {
        continue;
    }

    $item_href = (string) ($item['href'] ?? '');
    $item_classes = [];
    $parsed_path = (string) parse_url($item_href, PHP_URL_PATH);
    $normalized_href = trailingslashit($parsed_path);

    if ($normalized_href === trailingslashit((string) parse_url($posts_page_url, PHP_URL_PATH))) {
        $item_classes[] = 'site-nav__link--blog';
    }

    $main_navigation_items[] = [
        'label'   => (string) ($item['label'] ?? ''),
        'href'    => $item_href,
        'classes' => $item_classes,
    ];
}

$main_navigation_items[] = [
    'label'   => 'Kontakt',
    'href'    => '#contact',
    'classes' => ['site-nav__link--contact'],
];
?>

<?php
get_template_part('template-parts/header/nav/nav-render', null, [
    'site_name'  => $site_name,
    'nav_classes' => 'site-nav',
    'nav_label'  => 'Primary Navigation',
    'menu_id'    => 'primary-menu-main',
    'menu_items' => $main_navigation_items,
    'cta_href'   => '#contact',
    'cta_label'  => 'Kontakt',
]);
?>