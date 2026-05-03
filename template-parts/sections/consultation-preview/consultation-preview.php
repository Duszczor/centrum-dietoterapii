<?php $consultation_preview_image = dietitian_get_asset_uri('images/consultation-preview/consultation-preview.jpg'); ?>

<section
    class="consultation-preview"
    id="knowledge-base"
    aria-labelledby="consultation-preview-title">

    <div class="consultation-preview__container">
        <div class="consultation-preview__content">
            <h2 class="consultation-preview__title" id="consultation-preview-title">
                Jak przebiega wizyta?
            </h2>

            <span class="consultation-preview__line" aria-hidden="true"></span>

            <p class="consultation-preview__lead">
                <strong>Pierwsza wizyta trwa ok. 75 minut, wizyty kontrolne 30 minut.</strong>
                Podczas spotkania dokładnie omawiamy Twoją sytuację zdrowotną, styl życia, dotychczasowe nawyki oraz cel, które chcesz osiągnąć.
            </p>

            <p>Po spotkaniu w ciągu 7 dni otrzymasz ode mnie całe podsumowanie konsultacji, plan działania oraz indywidualny jadłospis (jeżeli decydujemy się dodatkowo na taką opcję współpracy).</p>

            <p class="consultation-preview__subheading">CO ZE SOBĄ ZABRAĆ?</p>

            <ul class="consultation-preview__list">
                <li>aktualne badania krwi (z ostatnich 6 miesięcy)</li>
                <li>wypisy ze szpitala</li>
                <li>USG, gastroskopię, kolonoskopię, testy oddechowe, itd.</li>
                <li>spis stosowanych leków i suplementów (z dawkami oraz nazwą producenta).</li>
            </ul>

            <p class="consultation-preview__summary">
                Przez cały okres trwania współpracy mamy kontakt przez e-mail lub na czacie w aplikacji dietetycznej, aby na bieżąco wprowadzać zmiany, które będą Cię jeszcze bardziej wspierać w tym całym procesie 🙂
            </p>

            <a class="btn btn--primary consultation-preview__cta" href="#contact">UMÓW SIĘ</a>
        </div>

        <figure class="consultation-preview__media">
            <img
                class="consultation-preview__image"
                src="<?php echo esc_url($consultation_preview_image); ?>"
                alt="Zdjęcie dietetyczki podczas konsultacji"
                width="3951"
                height="5939"
                loading="lazy"
                decoding="async">
        </figure>
    </div>
</section>