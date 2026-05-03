<?php
$site_name       = (string) ($args['site_name'] ?? get_bloginfo('name'));
$nav_classes     = (string) ($args['nav_classes'] ?? 'site-nav');
$nav_label       = (string) ($args['nav_label'] ?? 'Primary Navigation');
$menu_id         = (string) ($args['menu_id'] ?? 'primary-menu');
$menu_items      = is_array($args['menu_items'] ?? null) ? $args['menu_items'] : [];
$cta_href        = (string) ($args['cta_href'] ?? '');
$cta_label       = (string) ($args['cta_label'] ?? '');
$spacer_enabled  = !empty($args['spacer_enabled']);
$is_blog_variant = !empty($args['is_blog_variant']);
?>

<nav class="<?php echo esc_attr($nav_classes); ?>" aria-label="<?php echo esc_attr($nav_label); ?>">
    <a href="<?php echo esc_url(home_url('/')); ?>" class="site-nav__logo" aria-label="<?php echo esc_attr($site_name); ?>">
        <picture>
            <source srcset="<?php echo esc_url(dietitian_get_asset_uri('images/logo/logo.webp')); ?>" type="image/webp">
            <img src="<?php echo esc_url(dietitian_get_asset_uri('images/logo/logo.png')); ?>"
                alt="<?php echo esc_attr($site_name); ?>"
                class="site-nav__logo-image"
                width="606"
                height="202"
                fetchpriority="high"
                loading="eager"
                decoding="async">
        </picture>
    </a>

    <button class="site-nav__toggle" aria-label="Otwórz menu nawigacji" aria-expanded="false" aria-controls="<?php echo esc_attr($menu_id); ?>" type="button">
        <span class="site-nav__toggle-bar"></span>
        <span class="site-nav__toggle-bar"></span>
        <span class="site-nav__toggle-bar"></span>
    </button>

    <ul class="site-nav__menu" id="<?php echo esc_attr($menu_id); ?>">
        <?php foreach ($menu_items as $item) : ?>
            <?php
            $item_href = (string) ($item['href'] ?? '');
            $item_label = (string) ($item['label'] ?? '');
            $item_classes = 'site-nav__link';

            if (!empty($item['classes']) && is_array($item['classes'])) {
                $item_classes .= ' ' . implode(' ', array_map('sanitize_html_class', $item['classes']));
            }
            ?>
            <li>
                <a
                    href="<?php echo esc_url($item_href); ?>"
                    class="<?php echo esc_attr(trim($item_classes)); ?>"
                    <?php if (!empty($item['is_current'])) : ?>aria-current="page" <?php endif; ?>>
                    <?php echo esc_html($item_label); ?>
                </a>
            </li>
        <?php endforeach; ?>
    </ul>

    <?php if ($spacer_enabled) : ?>
        <span class="site-nav__spacer" aria-hidden="true"></span>
    <?php endif; ?>

    <?php if ($is_blog_variant && $cta_href !== '' && $cta_label !== '') : ?>
        <a href="<?php echo esc_url($cta_href); ?>" class="site-nav__cta btn btn--primary site-nav__cta--blog">
            <?php echo esc_html($cta_label); ?>
        </a>
    <?php elseif (!$is_blog_variant && $cta_href !== '' && $cta_label !== '') : ?>
        <a href="<?php echo esc_url($cta_href); ?>" class="site-nav__cta"><?php echo esc_html($cta_label); ?></a>
    <?php endif; ?>
</nav>