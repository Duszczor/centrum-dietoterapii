<?php

/**
 * Default offer cards attributes used by dynamic rendering and template fallback.
 */
function dietitian_get_default_offer_cards_attributes(): array
{
    return [
        'title' => 'Obszary Moich Specjalizacji',
        'intro' => 'Specjalizuję się w dietoterapii ukierunkowanej na konkretne problemy zdrowotne. Poniżej znajdziesz trzy główne obszary, w których mogę Ci skutecznie pomóc:',
        'cards' => dietitian_get_offer_cards(),
    ];
}

/**
 * Normalize and sanitize offer cards array.
 */
function dietitian_sanitize_offer_cards(array $cards): array
{
    $default_cards = dietitian_get_default_offer_cards_attributes()['cards'];
    $sanitized_cards = [];

    foreach ($cards as $index => $card) {
        if (!is_array($card)) {
            continue;
        }

        $default_card = $default_cards[$index] ?? [
            'title' => '',
            'subtitle' => '',
            'description' => '',
            'items' => [],
        ];

        $items = [];

        foreach ((array) ($card['items'] ?? []) as $item) {
            $item = trim(wp_strip_all_tags((string) $item));

            if ($item !== '') {
                $items[] = $item;
            }
        }

        $sanitized_cards[] = [
            'title' => trim(wp_strip_all_tags((string) ($card['title'] ?? $default_card['title']))),
            'subtitle' => trim(wp_strip_all_tags((string) ($card['subtitle'] ?? $default_card['subtitle']))),
            'description' => trim(wp_strip_all_tags((string) ($card['description'] ?? $default_card['description']))),
            'items' => $items,
        ];
    }

    return $sanitized_cards;
}

/**
 * Get fixed visual configuration for each offer card position.
 */
function dietitian_get_offer_card_visuals(): array
{
    return [
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
}

/**
 * Render callback for the custom offer cards block.
 */
function dietitian_render_offer_cards_block(array $attributes = [], string $content = '', ?WP_Block $block = null): string
{
    $attributes = wp_parse_args($attributes, dietitian_get_default_offer_cards_attributes());

    $title = trim((string) ($attributes['title'] ?? ''));
    $intro = trim((string) ($attributes['intro'] ?? ''));
    $cards = dietitian_sanitize_offer_cards((array) ($attributes['cards'] ?? []));
    $card_visuals = dietitian_get_offer_card_visuals();
    $section_title_id = wp_unique_id('offer-title-');
    $section_label = __('Offer cards section', 'dietitian-theme');
    $section_anchor = trim((string) ($attributes['anchor'] ?? ''));
    $section_id = $section_anchor !== '' ? sanitize_title($section_anchor) : 'offer';

    if ($cards === []) {
        return '';
    }

    ob_start();
?>
    <section
        class="offer-cards"
        id="<?php echo esc_attr($section_id); ?>"
        <?php if ($title !== '') : ?>aria-labelledby="<?php echo esc_attr($section_title_id); ?>" <?php else : ?>aria-label="<?php echo esc_attr($section_label); ?>" <?php endif; ?>>
        <div class="offer-cards__container">
            <div class="offer-cards__header">
                <?php if ($title !== '') : ?>
                    <h2 class="offer-cards__title" id="<?php echo esc_attr($section_title_id); ?>"><?php echo esc_html($title); ?></h2>
                <?php endif; ?>
                <?php if ($intro !== '') : ?>
                    <p class="offer-cards__intro"><?php echo esc_html($intro); ?></p>
                <?php endif; ?>
            </div>

            <div class="offer-cards__grid">
                <?php foreach ($cards as $index => $card) : ?>
                    <?php
                    $card_variant = $card_visuals[$index]['modifier'] ?? 'left';
                    $card_icon = $card_visuals[$index]['icon'] ?? 'gut-health';
                    ?>
                    <article class="offer-card offer-card--<?php echo esc_attr($card_variant); ?>">
                        <span class="offer-card__icon-wrap" aria-hidden="true">
                            <?php echo dietitian_get_icon_svg($card_icon, 'offer-card__icon'); ?>
                        </span>

                        <div class="offer-card__content">
                            <?php if ($card['title'] !== '') : ?>
                                <h3 class="offer-card__heading"><?php echo esc_html($card['title']); ?></h3>
                            <?php endif; ?>
                            <?php if ($card['subtitle'] !== '') : ?>
                                <p class="offer-card__subtitle"><?php echo esc_html($card['subtitle']); ?></p>
                            <?php endif; ?>
                            <?php if ($card['description'] !== '') : ?>
                                <p class="offer-card__description"><?php echo esc_html($card['description']); ?></p>
                            <?php endif; ?>
                        </div>

                        <?php if (!empty($card['items'])) : ?>
                            <ul class="offer-card__list">
                                <?php foreach ($card['items'] as $item) : ?>
                                    <li><?php echo esc_html($item); ?></li>
                                <?php endforeach; ?>
                            </ul>
                        <?php endif; ?>
                    </article>
                <?php endforeach; ?>
            </div>
        </div>
    </section>
<?php

    return (string) ob_get_clean();
}
