<section class="hero" aria-labelledby="hero-title">

    <div class="hero__overlay" aria-hidden="true"></div>

    <div class="container hero__container">
        <div class="hero__content">

            <h1 class="hero__title" id="hero-title">
                <span class="hero__title-name"><?php echo esc_html(get_bloginfo('name')); ?></span>
                <span class="hero__title-role"><?php echo esc_html(get_bloginfo('description')); ?></span>
            </h1>

            <p class="hero__description">
                <?php esc_html_e('Pomagam odzyskać zdrowie i lepsze samopoczucie dzięki indywidualnie dopasowanemu planowi żywienia i praktycznemu wsparciu na co dzień.', 'dietitian-theme'); ?>
            </p>

            <div class="hero__actions">
                <a href="#contact" class="btn btn--primary">
                    <?php esc_html_e('Umów konsultację', 'dietitian-theme'); ?>
                </a>
            </div>

        </div>
    </div>

</section>