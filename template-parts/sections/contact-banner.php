<?php
$contact_banner_image = esc_url(get_template_directory_uri() . '/assets/images/contact-banner/contact-banner.jpg');
?>

<section
    class="contact-banner"
    id="contact-banner"
    style="background-image: url('<?php echo $contact_banner_image; ?>');"
    aria-labelledby="contact-banner-title">

    <div class="contact-banner__overlay" aria-hidden="true"></div>

    <div class="contact-banner__container">
        <div class="contact-banner__content">
            <h2 class="contact-banner__title" id="contact-banner-title">
                <?php esc_html_e('Zadbajmy o Twoje zdrowie już dziś!', 'dietitian-theme'); ?>
            </h2>

            <span class="contact-banner__line" aria-hidden="true"></span>

            <a href="#contact" class="hero__cta contact-banner__cta">
                <?php esc_html_e('Kontakt', 'dietitian-theme'); ?>
            </a>
        </div>
    </div>
</section>