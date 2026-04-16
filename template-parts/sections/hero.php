<?php
$hero_image_uri = dietitian_get_asset_uri('images/hero/hero-bg.webp');
$hero_image_768_uri = dietitian_get_asset_uri('images/hero/hero-bg-768.webp');
$hero_image_1280_uri = dietitian_get_asset_uri('images/hero/hero-bg-1280.webp');
$hero_image_1920_uri = dietitian_get_asset_uri('images/hero/hero-bg-1920.webp');
$hero_image_srcset = $hero_image_768_uri . ' 768w, ' . $hero_image_1280_uri . ' 1280w, ' . $hero_image_1920_uri . ' 1920w, ' . $hero_image_uri . ' 2560w';
?>
<section class="hero" aria-labelledby="hero-title">

    <picture class="hero__media" aria-hidden="true">
        <source
            srcset="<?php echo $hero_image_srcset; ?>"
            sizes="100vw"
            type="image/webp">
        <img
            class="hero__image"
            src="<?php echo $hero_image_1280_uri; ?>"
            srcset="<?php echo $hero_image_srcset; ?>"
            sizes="100vw"
            alt=""
            width="1280"
            height="852"
            fetchpriority="high"
            loading="eager"
            decoding="async">
    </picture>

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