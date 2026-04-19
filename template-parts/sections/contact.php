<?php
$contact = dietitian_get_contact_data();
$map_accordion_open = wp_is_mobile() ? '' : ' open';
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
                <div class="contact__card-main">
                    <p class="contact__eyebrow">Adres</p>
                    <h3 class="contact__card-title">Gabinet w Łowiczu</h3>
                    <p class="contact__card-intro">Konsultacje stacjonarne dla osób, które wolą spotkanie na miejscu, oraz współpraca online dla większej wygody.</p>
                    <address class="contact__address">
                        <span class="contact__info-row">
                            <span class="contact__info-icon" aria-hidden="true">
                                <?php echo dietitian_get_icon_svg('home'); ?>
                            </span>
                            <span><?php echo $contact['address_lines'][0]; ?></span>
                        </span>
                        <span class="contact__info-row">
                            <span class="contact__info-icon" aria-hidden="true">
                                <?php echo dietitian_get_icon_svg('pin'); ?>
                            </span>
                            <span><?php echo $contact['address_lines'][1]; ?></span>
                        </span>
                    </address>
                </div>
                <div class="contact__card-footer">
                    <ul class="contact__meta-list">
                        <li>Wizyty po wcześniejszym umówieniu terminu</li>
                        <li>Dogodny dojazd do gabinetu w Łowiczu</li>
                    </ul>
                </div>
            </article>

            <article class="contact__card contact__card--info contact__card--primary">
                <div class="contact__card-main">
                    <p class="contact__eyebrow">Kontakt</p>
                    <h3 class="contact__card-title">Napisz lub zadzwoń</h3>
                    <p class="contact__cta-badge">Najszybsza forma kontaktu</p>
                    <div class="contact__details">
                        <a class="contact__detail-link" href="<?php echo $contact['phone_href']; ?>">
                            <span class="contact__info-icon" aria-hidden="true">
                                <?php echo dietitian_get_icon_svg('phone'); ?>
                            </span>
                            <span class="contact__detail-copy">
                                <span class="contact__detail-label">Telefon</span>
                                <span class="contact__detail-value contact__detail-value--primary"><?php echo $contact['phone_display']; ?></span>
                            </span>
                        </a>
                        <a class="contact__detail-link" href="<?php echo $contact['email_href']; ?>">
                            <span class="contact__info-icon" aria-hidden="true">
                                <?php echo dietitian_get_icon_svg('mail'); ?>
                            </span>
                            <span class="contact__detail-copy">
                                <span class="contact__detail-label">E-mail</span>
                                <span class="contact__detail-value"><?php echo $contact['email_display']; ?></span>
                            </span>
                        </a>
                    </div>
                </div>
                <div class="contact__card-footer">
                    <p class="contact__microcopy">Najszybciej umówisz termin telefonicznie. Jeśli wolisz, napisz e-mail i wrócę do Ciebie z odpowiedzią.</p>
                    <div class="contact__actions">
                        <a href="<?php echo $contact['phone_href']; ?>" class="btn btn--primary contact__cta">Zadzwoń</a>
                        <a href="<?php echo $contact['email_href']; ?>" class="btn btn--ghost contact__ghost-link">Napisz e-mail</a>
                    </div>
                </div>
            </article>
        </div>

        <div class="contact__map-shell">
            <div class="contact__map-copy">
                <p class="contact__eyebrow">Lokalizacja</p>
                <h3 class="contact__map-title">Dojazd do gabinetu</h3>
                <p class="contact__map-intro">Praktyczne informacje przed pierwszą wizytą:</p>
                <ul class="contact__map-points">
                    <li>Adres: <?php echo $contact['address_lines'][0] . ', ' . $contact['address_lines'][1]; ?></li>
                    <li>Spotkania stacjonarne odbywają się po wcześniejszym umówieniu terminu</li>
                    <li>Jeśli jedziesz pierwszy raz, sprawdź trasę i zapisz adres w nawigacji przed wyjściem</li>
                </ul>
                <a class="contact__map-link" href="<?php echo $contact['map_url']; ?>" target="_blank" rel="noreferrer">Otwórz w Google Maps</a>
            </div>
            <details class="contact__map-accordion" <?php echo $map_accordion_open; ?>>
                <summary class="contact__map-summary">Pokaż mapę dojazdu</summary>
                <div class="contact__map-frame">
                    <iframe
                        src="<?php echo $contact['map_embed_url']; ?>"
                        title="Mapa dojazdu do gabinetu przy ulicy Tuszewskiej 76 w Łowiczu"
                        loading="lazy"
                        referrerpolicy="no-referrer-when-downgrade"
                        allowfullscreen></iframe>
                </div>
            </details>
        </div>
    </div>
</section>