<nav class="site-nav" aria-label="<?php esc_attr_e('Primary Navigation', 'dietitian-theme'); ?>">

    <a href="<?php echo esc_url(home_url('/')); ?>" class="site-nav__logo" aria-label="<?php echo esc_attr(get_bloginfo('name')); ?>">
        <img
            src="<?php echo esc_url(get_template_directory_uri() . '/assets/images/logo/logo.png'); ?>"
            alt="<?php echo esc_attr(get_bloginfo('name')); ?>"
            class="site-nav__logo-image">
    </a>

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

    <ul class="site-nav__menu" id="primary-menu">
        <li><a href="#about"><?php esc_html_e('O mnie', 'dietitian-theme'); ?></a></li>
        <li><a href="#offer"><?php esc_html_e('Oferta', 'dietitian-theme'); ?></a></li>
        <li><a href="#knowledge-base"><?php esc_html_e('Baza wiedzy', 'dietitian-theme'); ?></a></li>
    </ul>

    <a href="#contact" class="site-nav__cta"><?php esc_html_e('Kontakt', 'dietitian-theme'); ?></a>

</nav>