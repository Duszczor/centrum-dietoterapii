<?php
$navigation_items = dietitian_get_primary_navigation_items();
$site_name = get_bloginfo('name');
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
            <?php $item_classes = 'site-nav__link' . ($item['href'] === '#contact' ? ' site-nav__link--contact' : ''); ?>
            <li>
                <a href="<?php echo $item['href']; ?>" class="<?php echo $item_classes; ?>">
                    <?php echo $item['label']; ?>
                </a>
            </li>
        <?php endforeach; ?>
    </ul>

    <a href="#contact" class="site-nav__cta">Kontakt</a>
</nav>