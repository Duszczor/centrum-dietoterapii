<?php $contact_banner_image = dietitian_get_asset_uri('images/contact-banner/contact-banner.jpg'); ?>

<section
    class="contact-banner"
    id="contact-banner"
    aria-labelledby="contact-banner-title">

    <picture class="contact-banner__media" aria-hidden="true">
        <img
            class="contact-banner__image"
            src="<?php echo $contact_banner_image; ?>"
            alt=""
            loading="lazy"
            decoding="async">
    </picture>

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