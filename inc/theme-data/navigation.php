<?php

/**
 * Get primary navigation items
 *
 * @return array Navigation items with label and href
 */
function dietitian_get_primary_navigation_items(): array
{
    return [
        [
            'label' => 'Oferta',
            'href'  => '#offer',
        ],
        [
            'label' => 'Jak przebiega wizyta',
            'href'  => '#knowledge-base',
        ],
        [
            'label' => 'Cennik',
            'href'  => '#pricing',
        ],
        [
            'label' => 'Kontakt',
            'href'  => '#contact',
        ],
    ];
}

/**
 * Get footer navigation items
 *
 * @return array Footer navigation items with label and href
 */
function dietitian_get_footer_navigation_items(): array
{
    $items = [
        [
            'label' => 'Start',
            'href'  => home_url('/'),
        ],
    ];

    foreach (dietitian_get_primary_navigation_items() as $item) {
        $items[] = [
            'label' => $item['label'],
            'href'  => $item['href'],
        ];
    }

    return $items;
}
