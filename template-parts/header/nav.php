<nav class="site-nav" aria-label="<?php esc_attr_e('Primary Navigation', 'dietitian-theme'); ?>">

    <?php if (has_custom_logo()) : ?>
        <div class="site-nav__logo">
            <?php the_custom_logo(); ?>
        </div>
    <?php else : ?>
        <div class="site-nav__logo">
            <a href="<?php echo esc_url(home_url('/')); ?>" class="site-nav__logo-text">
                <?php bloginfo('name'); ?>
            </a>
        </div>
    <?php endif; ?>

    <?php
    wp_nav_menu([
        'theme_location' => 'primary',
        'container'      => false,
        'menu_id'        => 'primary-menu',
        'menu_class'     => 'site-nav__menu',
        'fallback_cb'    => false,
    ]);
    ?>

    <button
        class="site-nav__toggle"
        aria-label="<?php esc_attr_e('Toggle navigation', 'dietitian-theme'); ?>"
        aria-expanded="false"
        aria-controls="primary-menu"
        type="button">
        <span class="site-nav__toggle-bar"></span>
        <span class="site-nav__toggle-bar"></span>
        <span class="site-nav__toggle-bar"></span>
    </button>

</nav>