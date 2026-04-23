<?php
$navigation_items = dietitian_get_primary_navigation_items();
$site_name = get_bloginfo('name');
$blog_href = trailingslashit(home_url('/blog/'));
$is_blog_context = is_home() || is_singular('post') || is_category() || is_tag() || is_author() || is_date() || is_post_type_archive('post');
?>

<nav class="site-nav" aria-label="Primary Navigation">
    <a href="<?php echo home_url('/'); ?>" class="site-nav__logo" aria-label="<?php echo $site_name; ?>">
        <img src="<?php echo dietitian_get_asset_uri('images/logo/logo.png'); ?>"
            alt="<?php echo $site_name; ?>"
            class="site-nav__logo-image">
    </a>

    <button class="site-nav__toggle" aria-label="Toggle navigation" aria-expanded="false" aria-controls="primary-menu" type="button">
        <span class="site-nav__toggle-bar"></span>
        <span class="site-nav__toggle-bar"></span>
        <span class="site-nav__toggle-bar"></span>
    </button>

    <ul class="site-nav__menu" id="primary-menu">
        <?php foreach ($navigation_items as $item) : ?>
            <?php if ($item['href'] === '#contact') continue; ?>
            <?php $item_classes = 'site-nav__link'; ?>
            <?php
            $item_href = (string) ($item['href'] ?? '');
            $normalized_item_href = trailingslashit($item_href);
            $is_blog_link = $normalized_item_href === $blog_href;
            $is_active_item = $is_blog_link && $is_blog_context;

            if ($is_blog_link) {
                $item_classes .= ' site-nav__link--blog';
            }

            if ($is_active_item) {
                $item_classes .= ' is-active';
            }
            ?>
            <li>
                <a
                    href="<?php echo esc_url($item_href); ?>"
                    class="<?php echo esc_attr($item_classes); ?>"
                    <?php if ($is_active_item) : ?>aria-current="page" <?php endif; ?>>
                    <?php echo $item['label']; ?>
                </a>
            </li>
        <?php endforeach; ?>

        <li>
            <a href="#contact" class="site-nav__link site-nav__link--contact">Kontakt</a>
        </li>
    </ul>

    <a href="#contact" class="site-nav__cta">Kontakt</a>
</nav>