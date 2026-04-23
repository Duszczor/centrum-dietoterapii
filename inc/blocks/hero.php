<?php

/**
 * Default hero attributes used by dynamic rendering and template fallback.
 */
function dietitian_get_default_hero_attributes(): array
{
    return [
        'label' => 'Dietetyk kliniczny Łowicz',
        'title' => 'Dietoterapia dopasowana do Twojego zdrowia i codzienności',
        'name' => 'mgr Natalia Polit',
        'descriptionPrimary' => 'Pomagam odzyskać energię, poprawić wyniki zdrowotne i zrozumieć przyczyny dolegliwości dzięki planowi żywieniowemu skrojonemu pod Ciebie.',
        'descriptionSecondary' => 'Wspólnie wprowadzamy zmiany, które są realne do utrzymania i działają długofalowo.',
        'ctaText' => 'Sprawdź obszary wsparcia',
        'ctaUrl' => '#offer',
        'ctaNote' => 'Pierwszy krok: zobacz, w czym mogę Ci pomóc.',
        'layoutVariant' => 'content-left',
        'overlayIntensity' => 'default',
        'contentPosition' => 'center',
        'imageId' => 0,
        'imageAlt' => '',
        'openInNewTab' => false,
    ];
}

/**
 * Get allowed hero layout variants.
 */
function dietitian_get_hero_layout_variants(): array
{
    return [
        'content-left',
        'centered',
        'compact',
    ];
}

/**
 * Get allowed hero overlay intensity values.
 */
function dietitian_get_hero_overlay_intensities(): array
{
    return [
        'soft',
        'default',
        'strong',
    ];
}

/**
 * Get allowed hero content positions.
 */
function dietitian_get_hero_content_positions(): array
{
    return [
        'top',
        'center',
        'bottom',
    ];
}

/**
 * Sanitize the selected hero layout variant.
 */
function dietitian_sanitize_hero_layout_variant(string $layout_variant): string
{
    if (in_array($layout_variant, dietitian_get_hero_layout_variants(), true)) {
        return $layout_variant;
    }

    return 'content-left';
}

/**
 * Sanitize the selected hero overlay intensity.
 */
function dietitian_sanitize_hero_overlay_intensity(string $overlay_intensity): string
{
    if (in_array($overlay_intensity, dietitian_get_hero_overlay_intensities(), true)) {
        return $overlay_intensity;
    }

    return 'default';
}

/**
 * Sanitize the selected hero content position.
 */
function dietitian_sanitize_hero_content_position(string $content_position): string
{
    if (in_array($content_position, dietitian_get_hero_content_positions(), true)) {
        return $content_position;
    }

    return 'center';
}

/**
 * Validate supported CTA URLs for the hero block.
 */
function dietitian_is_valid_hero_cta_url(string $cta_url): bool
{
    if ($cta_url === '') {
        return false;
    }

    if (str_starts_with($cta_url, '#') || str_starts_with($cta_url, '/')) {
        return true;
    }

    if (str_starts_with($cta_url, 'mailto:') || str_starts_with($cta_url, 'tel:')) {
        return true;
    }

    return wp_http_validate_url($cta_url) !== false;
}

/**
 * Build hero image data with dynamic media support and static fallback.
 */
function dietitian_get_hero_image_data(array $attributes): array
{
    $image_id = (int) ($attributes['imageId'] ?? 0);

    if ($image_id > 0) {
        $src = wp_get_attachment_image_url($image_id, 'large') ?: '';
        $srcset = wp_get_attachment_image_srcset($image_id, 'full') ?: '';
        $alt = trim((string) ($attributes['imageAlt'] ?? ''));

        if ($alt === '') {
            $alt = trim((string) get_post_meta($image_id, '_wp_attachment_image_alt', true));
        }

        if ($src !== '') {
            return [
                'src' => $src,
                'srcset' => $srcset,
                'sizes' => '100vw',
                'alt' => $alt,
            ];
        }
    }

    $hero_image_uri = dietitian_get_asset_uri('images/hero/hero-bg.webp');
    $hero_image_768_uri = dietitian_get_asset_uri('images/hero/hero-bg-768.webp');
    $hero_image_1280_uri = dietitian_get_asset_uri('images/hero/hero-bg-1280.webp');
    $hero_image_1920_uri = dietitian_get_asset_uri('images/hero/hero-bg-1920.webp');

    return [
        'src' => $hero_image_1280_uri,
        'srcset' => $hero_image_768_uri . ' 768w, ' . $hero_image_1280_uri . ' 1280w, ' . $hero_image_1920_uri . ' 1920w, ' . $hero_image_uri . ' 2560w',
        'sizes' => '100vw',
        'alt' => trim((string) ($attributes['imageAlt'] ?? '')),
    ];
}

/**
 * Render callback for the custom hero block.
 */
function dietitian_render_hero_block(array $attributes = [], string $content = '', ?WP_Block $block = null): string
{
    $attributes = wp_parse_args($attributes, dietitian_get_default_hero_attributes());

    $label = trim((string) ($attributes['label'] ?? ''));
    $title = trim((string) ($attributes['title'] ?? ''));
    $name = trim((string) ($attributes['name'] ?? ''));
    $description_primary = trim((string) ($attributes['descriptionPrimary'] ?? ''));
    $description_secondary = trim((string) ($attributes['descriptionSecondary'] ?? ''));
    $cta_text = trim((string) ($attributes['ctaText'] ?? ''));
    $cta_url = trim((string) ($attributes['ctaUrl'] ?? ''));
    $cta_note = trim((string) ($attributes['ctaNote'] ?? ''));
    $layout_variant = dietitian_sanitize_hero_layout_variant((string) ($attributes['layoutVariant'] ?? 'content-left'));
    $overlay_intensity = dietitian_sanitize_hero_overlay_intensity((string) ($attributes['overlayIntensity'] ?? 'default'));
    $content_position = dietitian_sanitize_hero_content_position((string) ($attributes['contentPosition'] ?? 'center'));

    if (!dietitian_is_valid_hero_cta_url($cta_url)) {
        $cta_url = '';
    }

    if ($cta_text === '') {
        $cta_url = '';
    }

    $open_in_new_tab = !empty($attributes['openInNewTab']) && preg_match('/^https?:\/\//i', $cta_url) === 1;

    $image = dietitian_get_hero_image_data($attributes);
    $title_id = wp_unique_id('hero-title-');
    $cta_rel = $open_in_new_tab ? 'noopener noreferrer' : '';
    $hero_classes = implode(' ', [
        'hero',
        'hero--' . sanitize_html_class($layout_variant),
        'hero--overlay-' . sanitize_html_class($overlay_intensity),
        'hero--content-' . sanitize_html_class($content_position),
    ]);
    $hero_label = __('Hero section', 'dietitian-theme');

    ob_start();
?>
    <section
        class="<?php echo esc_attr($hero_classes); ?>"
        <?php if ($title !== '') : ?>aria-labelledby="<?php echo esc_attr($title_id); ?>" <?php else : ?>aria-label="<?php echo esc_attr($hero_label); ?>" <?php endif; ?>>
        <picture class="hero__media" aria-hidden="true">
            <?php if (!empty($image['srcset'])) : ?>
                <source
                    srcset="<?php echo esc_attr($image['srcset']); ?>"
                    sizes="<?php echo esc_attr($image['sizes']); ?>"
                    type="image/webp">
            <?php endif; ?>
            <img
                class="hero__image"
                src="<?php echo esc_url($image['src']); ?>"
                srcset="<?php echo esc_attr($image['srcset']); ?>"
                sizes="<?php echo esc_attr($image['sizes']); ?>"
                alt="<?php echo esc_attr($image['alt']); ?>"
                fetchpriority="high"
                loading="eager"
                decoding="sync">
        </picture>

        <div class="hero__overlay" aria-hidden="true"></div>

        <div class="hero__content">
            <div class="hero__heading">
                <?php if ($label !== '') : ?>
                    <p class="hero__label"><?php echo esc_html($label); ?></p>
                <?php endif; ?>
                <?php if ($title !== '') : ?>
                    <h1 class="hero__title" id="<?php echo esc_attr($title_id); ?>"><?php echo esc_html($title); ?></h1>
                <?php endif; ?>
                <?php if ($name !== '') : ?>
                    <p class="hero__name"><?php echo esc_html($name); ?></p>
                <?php endif; ?>
            </div>

            <div class="hero__desc">
                <?php if ($description_primary !== '') : ?>
                    <p><?php echo esc_html($description_primary); ?></p>
                <?php endif; ?>
                <?php if ($description_secondary !== '') : ?>
                    <p class="hero__desc-secondary"><?php echo esc_html($description_secondary); ?></p>
                <?php endif; ?>
            </div>

            <?php if ($cta_text !== '' && $cta_url !== '') : ?>
                <a
                    href="<?php echo esc_url($cta_url); ?>"
                    class="btn btn--primary hero__cta"
                    <?php if ($open_in_new_tab) : ?>target="_blank" rel="<?php echo esc_attr($cta_rel); ?>" <?php endif; ?>>
                    <?php echo esc_html($cta_text); ?>
                </a>
            <?php endif; ?>

            <?php if ($cta_note !== '') : ?>
                <p class="hero__cta-note"><?php echo esc_html($cta_note); ?></p>
            <?php endif; ?>
        </div>
    </section>
<?php

    return (string) ob_get_clean();
}
