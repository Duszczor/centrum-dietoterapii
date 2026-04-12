<?php
$consultation_preview_image = esc_url(get_template_directory_uri() . '/assets/images/consultation-preview/consultation-preview.jpg');
?>

<section
    class="consultation-preview"
    id="knowledge-base"
    aria-labelledby="consultation-preview-title">

    <div class="consultation-preview__container">
        <div class="consultation-preview__content">
            <h2 class="consultation-preview__title" id="consultation-preview-title">
                <?php esc_html_e('Jak przebiega wizyta?', 'dietitian-theme'); ?>
            </h2>

            <span class="consultation-preview__line" aria-hidden="true"></span>

            <p class="consultation-preview__lead">
                <strong><?php esc_html_e('Pierwsza wizyta trwa ok. 75 minut, wizyty kontrolne 30 minut.', 'dietitian-theme'); ?></strong>
                <?php esc_html_e('Podczas spotkania dokładnie omawiamy Twoją sytuację zdrowotną, styl życia, dotychczasowe nawyki oraz cel, które chcesz osiągnąć.', 'dietitian-theme'); ?>
            </p>

            <p><?php esc_html_e('Po spotkaniu w ciągu 7 dni otrzymasz ode mnie całe podsumowanie konsultacji, plan działania oraz indywidualny jadłospis (jeżeli decydujemy się dodatkowo na taką opcję współpracy).', 'dietitian-theme'); ?></p>

            <p class="consultation-preview__subheading"><?php esc_html_e('CO ZE SOBĄ ZABRAĆ?', 'dietitian-theme'); ?></p>

            <ul class="consultation-preview__list">
                <li><?php esc_html_e('aktualne badania krwi (z ostatnich 6 miesięcy)', 'dietitian-theme'); ?></li>
                <li><?php esc_html_e('wypisy ze szpitala', 'dietitian-theme'); ?></li>
                <li><?php esc_html_e('USG, gastroskopię, kolonoskopię, testy oddechowe, itd.', 'dietitian-theme'); ?></li>
                <li><?php esc_html_e('spis stosowanych leków i suplementów (z dawkami oraz nazwą producenta).', 'dietitian-theme'); ?></li>
            </ul>

            <p class="consultation-preview__summary">
                <?php esc_html_e('Przez cały okres trwania współpracy mamy kontakt przez e-mail lub na czacie w aplikacji dietetycznej, aby na bieżąco wprowadzać zmiany, które będą Cię jeszcze bardziej wspierać w tym całym procesie 🙂', 'dietitian-theme'); ?>
            </p>

            <a class="hero__cta consultation-preview__cta" href="#contact"><?php esc_html_e('UMÓW SIĘ', 'dietitian-theme'); ?></a>
        </div>

        <div
            class="consultation-preview__media"
            style="background-image: url('<?php echo $consultation_preview_image; ?>');"
            role="img"
            aria-label="<?php esc_attr_e('Zdjęcie dietetyczki podczas konsultacji', 'dietitian-theme'); ?>"></div>
    </div>
</section>