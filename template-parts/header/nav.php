<nav class="site-nav" aria-label="Primary Navigation">

    <?php $navigation_items = dietitian_get_primary_navigation_items(); ?>

    <a href="<?php echo esc_url(home_url('/')); ?>" class="site-nav__logo" aria-label="<?php echo esc_attr(get_bloginfo('name')); ?>">
        <img
            src="<?php echo esc_url(dietitian_get_asset_uri('images/logo/logo.png')); ?>"
            alt="<?php echo esc_attr(get_bloginfo('name')); ?>"
            class="site-nav__logo-image">
    </a>

    <button
        class="site-nav__toggle"
        aria-label="Toggle navigation"
        aria-expanded="false"
        aria-controls="primary-menu"
        type="button">
        <span class="site-nav__toggle-bar"></span>
        <span class="site-nav__toggle-bar"></span>
        <span class="site-nav__toggle-bar"></span>
    </button>

    <ul class="site-nav__menu" id="primary-menu">
        <?php foreach ($navigation_items as $item) : ?>
            <li>
                <a href="<?php echo esc_attr($item['href']); ?>" class="site-nav__link">
                    <?php echo esc_html($item['label']); ?>
                </a>
            </li>
        <?php endforeach; ?>
    </ul>

    <a href="#contact" class="site-nav__cta">Kontakt</a>

</nav>