<?php
$title = 'Obszary Moich Specjalizacji';
$intro = 'Specjalizuję się w dietoterapii ukierunkowanej na konkretne problemy zdrowotne. Poniżej znajdziesz trzy główne obszary, w których mogę Ci skutecznie pomóc:';
$cards = dietitian_get_offer_cards();
$card_visuals = [
    [
        'modifier' => 'left',
        'icon' => 'gut-health',
    ],
    [
        'modifier' => 'featured',
        'icon' => 'metabolic',
    ],
    [
        'modifier' => 'right',
        'icon' => 'fertility-support',
    ],
];
$section_title_id = wp_unique_id('offer-title-');

if ($cards === []) {
    return;
}
?>

<section class="offer-cards" id="offer" aria-labelledby="<?php echo esc_attr($section_title_id); ?>">
    <div class="offer-cards__container">
        <div class="offer-cards__header">
            <h2 class="offer-cards__title" id="<?php echo esc_attr($section_title_id); ?>"><?php echo esc_html($title); ?></h2>
            <p class="offer-cards__intro"><?php echo esc_html($intro); ?></p>
        </div>

        <div class="offer-cards__grid">
            <?php foreach ($cards as $index => $card) : ?>
                <?php
                $card_variant = $card_visuals[$index]['modifier'] ?? 'left';
                $card_icon = $card_visuals[$index]['icon'] ?? 'gut-health';
                $card_title = trim(wp_strip_all_tags((string) ($card['title'] ?? '')));
                $card_subtitle = trim(wp_strip_all_tags((string) ($card['subtitle'] ?? '')));
                $card_description = trim(wp_strip_all_tags((string) ($card['description'] ?? '')));
                $card_items = array_filter(array_map(static function ($item): string {
                    return trim(wp_strip_all_tags((string) $item));
                }, (array) ($card['items'] ?? [])));
                ?>
                <article class="offer-card offer-card--<?php echo esc_attr($card_variant); ?>">
                    <span class="offer-card__icon-wrap" aria-hidden="true">
                        <?php echo dietitian_get_icon_svg($card_icon, 'offer-card__icon'); ?>
                    </span>

                    <div class="offer-card__content">
                        <?php if ($card_title !== '') : ?>
                            <h3 class="offer-card__heading"><?php echo esc_html($card_title); ?></h3>
                        <?php endif; ?>
                        <?php if ($card_subtitle !== '') : ?>
                            <p class="offer-card__subtitle"><?php echo esc_html($card_subtitle); ?></p>
                        <?php endif; ?>
                        <?php if ($card_description !== '') : ?>
                            <p class="offer-card__description"><?php echo esc_html($card_description); ?></p>
                        <?php endif; ?>
                    </div>

                    <?php if (!empty($card_items)) : ?>
                        <ul class="offer-card__list">
                            <?php foreach ($card_items as $item) : ?>
                                <li><?php echo esc_html($item); ?></li>
                            <?php endforeach; ?>
                        </ul>
                    <?php endif; ?>
                </article>
            <?php endforeach; ?>
        </div>
    </div>
</section>