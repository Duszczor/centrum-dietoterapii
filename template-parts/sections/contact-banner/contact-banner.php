<?php
$banner_image_url = dietitian_get_asset_uri('images/contact-banner/contact-banner.jpg');
$banner_style = "background-image: url('{$banner_image_url}');";
?>
<section
    class="contact-banner"
    id="contact-banner"
    aria-labelledby="contact-banner-title"
    style="<?php echo esc_attr($banner_style); ?>">

    <div class="contact-banner__overlay" aria-hidden="true"></div>

    <div class="contact-banner__container">
        <div class="contact-banner__content">
            <h2 class="contact-banner__title" id="contact-banner-title">
                Zadbajmy o Twoje zdrowie już dziś!
            </h2>

            <span class="contact-banner__line" aria-hidden="true"></span>

            <a href="#contact" class="btn btn--primary contact-banner__cta">
                Kontakt
            </a>
        </div>
    </div>
</section>