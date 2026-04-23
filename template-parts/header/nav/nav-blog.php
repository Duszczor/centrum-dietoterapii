<?php
$site_name = get_bloginfo('name');

$posts_page_id  = (int) get_option('page_for_posts');
$posts_page_url = $posts_page_id > 0 ? get_permalink($posts_page_id) : home_url('/blog/');
$posts_page_url = is_string($posts_page_url) ? $posts_page_url : home_url('/blog/');
$posts_page_url = trailingslashit($posts_page_url);

$is_posts_listing_context =
    is_home() ||
    is_category() ||
    is_tag() ||
    is_author() ||
    is_date() ||
    is_post_type_archive('post') ||
    is_search();

$is_single_post_context = is_singular('post');

$blog_navigation_items = [
    [
        'label' => 'Wszystkie wpisy',
        'href'  => $posts_page_url,
        'key'   => 'all-posts',
    ],
    [
        'label' => 'Kategorie',
        'href'  => $posts_page_url . '#blog-categories',
        'key'   => 'categories',
    ],
    [
        'label' => 'Popularne',
        'href'  => $posts_page_url . '#blog-popular',
        'key'   => 'popular',
    ],
];

$blog_navigation_items = array_map(
    static function (array $item) use ($is_posts_listing_context): array {
        $item_key = (string) ($item['key'] ?? '');
        $is_current = false;
        $item_classes = [];

        if ($item_key === 'all-posts' && $is_posts_listing_context) {
            $is_current = true;
            $item_classes[] = 'is-active';
        } elseif ($item_key === 'categories' && is_category()) {
            $is_current = true;
            $item_classes[] = 'is-active';
        }

        return [
            'label'      => (string) ($item['label'] ?? ''),
            'href'       => (string) ($item['href'] ?? ''),
            'classes'    => $item_classes,
            'is_current' => $is_current,
        ];
    },
    $blog_navigation_items
);
?>

<?php
get_template_part('template-parts/header/nav/nav-render', null, [
    'site_name'       => $site_name,
    'nav_classes'     => 'site-nav site-nav--blog',
    'nav_label'       => 'Blog Navigation',
    'menu_id'         => 'primary-menu-blog',
    'menu_items'      => $blog_navigation_items,
    'spacer_enabled'  => true,
    'is_blog_variant' => true,
]);
?>