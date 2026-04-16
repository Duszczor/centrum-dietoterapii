<?php $hero_image_uri = dietitian_get_asset_uri('images/hero/hero-bg.webp'); ?>
<section
    class="hero"
    style="background-image: url('<?php echo $hero_image_uri; ?>');"
    aria-labelledby="hero-title">

    <div class="hero__overlay" aria-hidden="true"></div>

    <div class="hero__content">
        <div class="hero__heading">
            <p class="hero__label">Indywidualna Dietoterapia</p>
            <h1 class="hero__title" id="hero-title">
                Dietetyk kliniczny Łowicz
            </h1>
            <p class="hero__name">mgr Natalia Polit</p>
        </div>

        <div class="hero__desc">
            <p>Pomagam odzyskać energię, poprawić wyniki zdrowotne i zrozumieć przyczyny dolegliwości dzięki indywidualnej dietoterapii.</p>
            <p>Dzięki wprowadzonym zmianom poprawisz swoje wyniki, odzyskasz energię i zmienisz swoje nawyki trwale.</p>
        </div>

        <a href="#offer" class="btn btn--primary hero__cta">Zobacz ofertę</a>
    </div>
</section>