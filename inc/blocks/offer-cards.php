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
 * Get allowed offer card modifiers.
 */
function dietitian_get_offer_card_modifiers(): array
{
    return [
        'left',
        'featured',
        'right',
    ];
}

/**
 * Get allowed offer card icons.
 */
function dietitian_get_offer_card_icons(): array
{
    return [
        'gut-health',
        'metabolic',
        'fertility-support',
    ];
}

/**
 * Sanitize an offer card modifier.
 */
function dietitian_sanitize_offer_card_modifier(string $modifier): string
{
    if (in_array($modifier, dietitian_get_offer_card_modifiers(), true)) {
        return $modifier;
    }

    return 'left';
}

/**
 * Sanitize an offer card icon slug.
 */
function dietitian_sanitize_offer_card_icon(string $icon): string
{
    if (in_array($icon, dietitian_get_offer_card_icons(), true)) {
        return $icon;
    }

    return 'gut-health';
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
            'modifier' => 'left',
            'icon' => 'gut-health',
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
            'modifier' => dietitian_sanitize_offer_card_modifier((string) ($card['modifier'] ?? $default_card['modifier'])),
            'icon' => dietitian_sanitize_offer_card_icon((string) ($card['icon'] ?? $default_card['icon'])),
            'title' => trim(wp_strip_all_tags((string) ($card['title'] ?? $default_card['title']))),
            'subtitle' => trim(wp_strip_all_tags((string) ($card['subtitle'] ?? $default_card['subtitle']))),
            'description' => trim(wp_strip_all_tags((string) ($card['description'] ?? $default_card['description']))),
            'items' => $items,
        ];
    }

    return $sanitized_cards;
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
    $section_title_id = wp_unique_id('offer-title-');
    $section_label = __('Offer cards section', 'dietitian-theme');

    if ($cards === []) {
        return '';
    }

    ob_start();
?>
    <section
        class="offer-cards"
        id="offer"
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
                <?php foreach ($cards as $card) : ?>
                    <article class="offer-card offer-card--<?php echo esc_attr($card['modifier']); ?>">
                        <span class="offer-card__icon-wrap" aria-hidden="true">
                            <?php echo dietitian_get_icon_svg($card['icon'], 'offer-card__icon'); ?>
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
