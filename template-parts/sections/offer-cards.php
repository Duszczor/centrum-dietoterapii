<?php $offer_cards = dietitian_get_offer_cards(); ?>

<section class="offer-cards" id="offer" aria-labelledby="offer-title">
    <div class="offer-cards__container">
        <div class="offer-cards__header">
            <h2 class="offer-cards__title" id="offer-title">Obszary Moich Specjalizacji</h2>
            <p class="offer-cards__intro">Specjalizuję się w dietoterapii ukierunkowanej na konkretne problemy zdrowotne. Poniżej znajdziesz trzy główne obszary, w których mogę Ci skutecznie pomóc:</p>
        </div>

        <div class="offer-cards__grid">
            <?php foreach ($offer_cards as $card) : ?>
                <article class="offer-card offer-card--<?php echo esc_attr($card['modifier']); ?>">
                    <span class="offer-card__icon-wrap" aria-hidden="true">
                        <?php echo dietitian_get_icon_svg($card['icon'], 'offer-card__icon'); ?>
                    </span>

                    <div class="offer-card__content">
                        <h3 class="offer-card__heading"><?php echo esc_html($card['title']); ?></h3>
                        <p class="offer-card__subtitle"><?php echo esc_html($card['subtitle']); ?></p>
                        <p class="offer-card__description"><?php echo esc_html($card['description']); ?></p>
                    </div>

                    <ul class="offer-card__list">
                        <?php foreach ($card['items'] as $item) : ?>
                            <li><?php echo esc_html($item); ?></li>
                        <?php endforeach; ?>
                    </ul>
                </article>
            <?php endforeach; ?>
        </div>
    </div>
</section>