<?php

/**
 * SEO
 *
 * Outputs meta description, canonical URL, Open Graph, Twitter Card,
 * and Schema.org JSON-LD when no third-party SEO plugin is active.
 * Hooked into wp_head with an early priority.
 */
function dietitian_is_seo_plugin_active(): bool
{
    return defined('WPSEO_VERSION') || defined('RANK_MATH_VERSION');
}

function dietitian_get_meta_description(): string
{
    if (is_singular()) {
        $desc = get_the_excerpt() ?: get_bloginfo('description');
    } elseif (is_category() || is_tag()) {
        $desc = wp_strip_all_tags(get_the_archive_description()) ?: get_bloginfo('description');
    } elseif (is_search()) {
        /* translators: %s: search query */
        $desc = sprintf('Wyniki wyszukiwania dla: %s — Centrum Dietoterapii', get_search_query());
    } else {
        $desc = get_bloginfo('description');
    }

    if (!$desc) {
        $desc = 'Centrum Dietoterapii – dietetyka kliniczna, leczenie dietą, indywidualne plany żywienia. Regulacja ciśnienia, cholesterolu i cukru pod okiem doświadczonego dietetyka.';
    }

    return wp_strip_all_tags($desc);
}

function dietitian_get_canonical_url(): string
{
    if (is_singular()) {
        return (string) get_permalink();
    }

    if (is_front_page()) {
        return home_url('/');
    }

    if (is_home()) {
        $posts_page_id = (int) get_option('page_for_posts');
        return $posts_page_id > 0 ? (string) get_permalink($posts_page_id) : home_url('/blog/');
    }

    if (is_category() || is_tag()) {
        $term_link = get_term_link(get_queried_object());
        return !is_wp_error($term_link) ? $term_link : '';
    }

    return '';
}

function dietitian_output_seo_tags(): void
{
    if (dietitian_is_seo_plugin_active()) {
        return;
    }

    $meta_desc    = dietitian_get_meta_description();
    $canonical    = dietitian_get_canonical_url();

    echo '<meta name="description" content="' . esc_attr($meta_desc) . '">' . "\n";

    if ($canonical) {
        echo '<link rel="canonical" href="' . esc_url($canonical) . '">' . "\n";
    }

    // --- Open Graph + Twitter Card ---
    $og_title = is_singular() ? wp_strip_all_tags(get_the_title()) : get_bloginfo('name');
    $og_url   = $canonical ?: home_url('/');
    $og_type  = is_singular('post') ? 'article' : 'website';
    $og_image = (is_singular() && has_post_thumbnail())
        ? (string) get_the_post_thumbnail_url(null, 'large')
        : get_template_directory_uri() . '/assets/images/logo/logo.png';

    echo '<meta property="og:type" content="' . esc_attr($og_type) . '">' . "\n";
    echo '<meta property="og:title" content="' . esc_attr($og_title) . '">' . "\n";
    echo '<meta property="og:description" content="' . esc_attr($meta_desc) . '">' . "\n";
    echo '<meta property="og:url" content="' . esc_url($og_url) . '">' . "\n";
    echo '<meta property="og:site_name" content="' . esc_attr(get_bloginfo('name')) . '">' . "\n";
    echo '<meta property="og:locale" content="pl_PL">' . "\n";

    if ($og_image) {
        echo '<meta property="og:image" content="' . esc_url($og_image) . '">' . "\n";
    }

    echo '<meta name="twitter:card" content="summary_large_image">' . "\n";
    echo '<meta name="twitter:title" content="' . esc_attr($og_title) . '">' . "\n";
    echo '<meta name="twitter:description" content="' . esc_attr($meta_desc) . '">' . "\n";

    if ($og_image) {
        echo '<meta name="twitter:image" content="' . esc_url($og_image) . '">' . "\n";
    }
}

add_action('wp_head', 'dietitian_output_seo_tags', 2);

/**
 * Schema.org JSON-LD for the front page.
 * Reuses contact data from theme-data to avoid duplication.
 */
function dietitian_output_schema_org(): void
{
    if (!is_front_page()) {
        return;
    }

    $contact = dietitian_get_contact_data();
    $phone   = ltrim($contact['phone_href'], 'tel:');

    $schema = [
        '@context'         => 'https://schema.org',
        '@type'            => 'MedicalBusiness',
        'name'             => 'Centrum Dietoterapii',
        'description'      => 'Dietetyka kliniczna, indywidualne plany żywienia, leczenie dietą.',
        'url'              => home_url('/'),
        'telephone'        => $phone,
        'email'            => ltrim($contact['email_href'], 'mailto:'),
        'medicalSpecialty' => 'DietNutrition',
        'priceRange'       => '$$',
        'address'          => [
            '@type'           => 'PostalAddress',
            'streetAddress'   => $contact['address_lines'][0],
            'addressLocality' => $contact['city'],
            'postalCode'      => '99-400',
            'addressCountry'  => 'PL',
        ],
    ];

    echo '<script type="application/ld+json">' . "\n";
    echo wp_json_encode($schema, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT);
    echo "\n" . '</script>' . "\n";
}

add_action('wp_head', 'dietitian_output_schema_org', 3);
