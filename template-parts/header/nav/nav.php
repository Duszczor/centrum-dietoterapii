<?php
$is_blog_context =
    is_home() ||
    is_singular('post') ||
    is_category() ||
    is_tag() ||
    is_author() ||
    is_date() ||
    is_post_type_archive('post') ||
    is_search();

if ($is_blog_context) {
    get_template_part('template-parts/header/nav/nav-blog');
} else {
    get_template_part('template-parts/header/nav/nav-main');
}
