<?php
$hero_image_uri = esc_url(get_template_directory_uri() . '/assets/images/hero/hero-bg.webp');
?>
<section
    class="hero"
    style="background-image: url('<?php echo $hero_image_uri; ?>');"
    aria-labelledby="hero-title">

    <div class="hero__overlay" aria-hidden="true"></div>

    <div class="hero__content">
        <div class="hero__heading">
            <p class="hero__label"><?php esc_html_e('Indywidualna Dietoterapia', 'dietitian-theme'); ?></p>
            <h1 class="hero__title" id="hero-title">
                <?php esc_html_e('Dietetyk kliniczny Łowicz', 'dietitian-theme'); ?>
            </h1>
            <p class="hero__name"><?php esc_html_e('mgr Natalia Polit', 'dietitian-theme'); ?></p>
        </div>

        <div class="hero__desc">
            <p><?php esc_html_e('Pomagam odzyskać energię, poprawić wyniki zdrowotne i zrozumieć przyczyny dolegliwości dzięki indywidualnej dietoterapii.', 'dietitian-theme'); ?></p>
            <p><?php esc_html_e('Dzięki wprowadzonym zmianom poprawisz swoje wyniki, odzyskasz energię i zmienisz swoje nawyki trwale.', 'dietitian-theme'); ?></p>
        </div>

        <a href="#offer" class="hero__cta"><?php esc_html_e('Zobacz ofertę', 'dietitian-theme'); ?></a>
    </div>
</section>