<?php
$map_src = 'https://www.google.com/maps?q=Tuszewska+76,+99-400+%C5%81owicz&z=15&output=embed';
?>

<section class="contact" id="contact" aria-labelledby="contact-title">
    <div class="contact__container">
        <div class="contact__header">
            <p class="contact__section-badge">Stacjonarnie i online</p>
            <h2 class="contact__title" id="contact-title">Kontakt</h2>
            <p class="contact__subtitle">Umów wizytę, zadaj pytanie o współpracę albo sprawdź, jak dojechać do gabinetu.</p>
        </div>

        <div class="contact__grid">
            <article class="contact__card contact__card--info">
                <p class="contact__eyebrow">Adres</p>
                <h3 class="contact__card-title">Gabinet w Łowiczu</h3>
                <p class="contact__card-intro">Konsultacje stacjonarne dla osób, które wolą spotkanie na miejscu, oraz współpraca online dla większej wygody.</p>
                <address class="contact__address">
                    <span class="contact__info-row">
                        <span class="contact__info-icon" aria-hidden="true">
                            <svg viewBox="0 0 24 24" focusable="false" aria-hidden="true">
                                <path d="M4 10.5 12 4l8 6.5V20a1 1 0 0 1-1 1h-4.75v-6h-4.5v6H5a1 1 0 0 1-1-1z" fill="currentColor" />
                            </svg>
                        </span>
                        <span>Tuszewska 76 m.109</span>
                    </span>
                    <span class="contact__info-row">
                        <span class="contact__info-icon" aria-hidden="true">
                            <svg viewBox="0 0 24 24" focusable="false" aria-hidden="true">
                                <path d="M12 21s6-5.52 6-11a6 6 0 1 0-12 0c0 5.48 6 11 6 11Zm0-8.25a2.75 2.75 0 1 1 0-5.5 2.75 2.75 0 0 1 0 5.5Z" fill="currentColor" />
                            </svg>
                        </span>
                        <span>99-400 Łowicz</span>
                    </span>
                </address>
                <ul class="contact__meta-list">
                    <li>Wizyty po wcześniejszym umówieniu terminu</li>
                    <li>Dogodny dojazd do gabinetu w Łowiczu</li>
                </ul>
            </article>

            <article class="contact__card contact__card--info contact__card--primary">
                <p class="contact__eyebrow">Kontakt</p>
                <h3 class="contact__card-title">Napisz lub zadzwoń</h3>
                <p class="contact__cta-badge">Najszybsza forma kontaktu</p>
                <div class="contact__details">
                    <a class="contact__detail-link" href="tel:+48668156568">
                        <span class="contact__info-icon" aria-hidden="true">
                            <svg viewBox="0 0 24 24" focusable="false" aria-hidden="true">
                                <path d="M6.62 10.79a15.05 15.05 0 0 0 6.59 6.59l2.2-2.2a1 1 0 0 1 1-.24c1.06.35 2.2.54 3.39.54a1 1 0 0 1 1 1V20a1 1 0 0 1-1 1C10.3 21 3 13.7 3 4a1 1 0 0 1 1-1h3.52a1 1 0 0 1 1 1c0 1.19.18 2.33.54 3.39a1 1 0 0 1-.25 1.01z" fill="currentColor" />
                            </svg>
                        </span>
                        <span class="contact__detail-copy">
                            <span class="contact__detail-label">Telefon</span>
                            <span class="contact__detail-value contact__detail-value--primary">668-156-568</span>
                        </span>
                    </a>
                    <a class="contact__detail-link" href="mailto:kontakt@centrum-dietoterapii.pl">
                        <span class="contact__info-icon" aria-hidden="true">
                            <svg viewBox="0 0 24 24" focusable="false" aria-hidden="true">
                                <path d="M4 6h16a1 1 0 0 1 1 1v10a1 1 0 0 1-1 1H4a1 1 0 0 1-1-1V7a1 1 0 0 1 1-1Zm0 2v.2l8 5.33 8-5.33V8l-8 5.33L4 8Z" fill="currentColor" />
                            </svg>
                        </span>
                        <span class="contact__detail-copy">
                            <span class="contact__detail-label">E-mail</span>
                            <span class="contact__detail-value">kontakt@centrum-dietoterapii.pl</span>
                        </span>
                    </a>
                </div>
                <p class="contact__microcopy">Najszybciej umówisz termin telefonicznie. Jeśli wolisz, napisz e-mail i wrócę do Ciebie z odpowiedzią.</p>
                <div class="contact__actions">
                    <a href="tel:+48668156568" class="hero__cta contact__cta">Zadzwoń</a>
                    <a href="mailto:kontakt@centrum-dietoterapii.pl" class="contact__ghost-link">Napisz e-mail</a>
                </div>
            </article>
        </div>

        <div class="contact__map-shell">
            <div class="contact__map-copy">
                <p class="contact__eyebrow">Lokalizacja</p>
                <h3 class="contact__map-title">Dojazd do gabinetu</h3>
                <p class="contact__map-intro">Praktyczne informacje przed pierwszą wizytą:</p>
                <ul class="contact__map-points">
                    <li>Adres: Tuszewska 76 m.109, 99-400 Łowicz</li>
                    <li>Spotkania stacjonarne odbywają się po wcześniejszym umówieniu terminu</li>
                    <li>Jeśli jedziesz pierwszy raz, sprawdź trasę i zapisz adres w nawigacji przed wyjściem</li>
                </ul>
                <a class="contact__map-link" href="https://www.google.com/maps?q=Tuszewska+76,+99-400+%C5%81owicz" target="_blank" rel="noreferrer">Otwórz w Google Maps</a>
            </div>
            <div class="contact__map-frame">
                <iframe
                    src="<?php echo esc_url($map_src); ?>"
                    title="Mapa dojazdu do gabinetu przy ulicy Tuszewskiej 76 w Łowiczu"
                    loading="lazy"
                    referrerpolicy="no-referrer-when-downgrade"
                    allowfullscreen></iframe>
            </div>
        </div>
    </div>
</section>