<?php

function dietitian_get_asset_uri(string $asset_path): string
{
    return get_template_directory_uri() . '/assets/' . ltrim($asset_path, '/');
}

function dietitian_get_home_sections(): array
{
    return [
        'hero',
        'offer-cards',
        'contact-banner',
        'consultation-preview',
        'pricing',
        'contact',
    ];
}

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
            'href'  => home_url('/' . $item['href']),
        ];
    }

    return $items;
}

function dietitian_get_contact_data(): array
{
    return [
        'phone_href'    => 'tel:+48668156568',
        'phone_display' => '668-156-568',
        'email_href'    => 'mailto:kontakt@centrum-dietoterapii.pl',
        'email_display' => 'kontakt@centrum-dietoterapii.pl',
        'city'          => 'Łowicz',
        'address_lines' => [
            'Tuszewska 76 m.109',
            '99-400 Łowicz',
        ],
        'map_embed_url' => 'https://www.google.com/maps?q=Tuszewska+76,+99-400+%C5%81owicz&z=15&output=embed',
        'map_url'       => 'https://www.google.com/maps?q=Tuszewska+76,+99-400+%C5%81owicz',
    ];
}

function dietitian_get_offer_cards(): array
{
    return [
        [
            'modifier'     => 'left',
            'icon'         => 'gut-health',
            'title'        => 'Zdrowe Jelita & Trawienie 🦠',
            'subtitle'     => 'Choroby autoimmunologiczne i chroniczne zapalenia',
            'description'  => 'Specjalizuję się w leczeniu dietetycznym chorób, które wpływają na Twoją codzienną jakość życia.',
            'items'        => [
                'Hashimoto, RZS, łuszczyca i inne',
                'Zapalenia jelita (IBD, IBS, SIBO)',
                'Wzdęcia, zaparcia, dysbioza',
                'Problemy trawienne i bóle',
            ],
        ],
        [
            'modifier'     => 'featured',
            'icon'         => 'metabolic',
            'title'        => 'Metabolizm i Serce ❤️',
            'subtitle'     => 'Choroby metaboliczne i profilaktyka',
            'description'  => 'Pomagam zregulować ciśnienie, cholesterol i poziom cukru poprzez zmianę nawyków żywieniowych.',
            'items'        => [
                'Nadciśnienie i dyslipidemię',
                'Cukrzycę i insulinooporność',
                'Otyłość i nadawagę',
                'Profilaktykę chorób serca',
            ],
        ],
        [
            'modifier'     => 'right',
            'icon'         => 'fertility-support',
            'title'        => 'Płodność i Hormony 👶',
            'subtitle'     => 'Wsparcie przed ciążą i zmiany nawyków',
            'description'  => 'Przygotowuję Cię do najważniejszych chwil i pomagam w zmianie trybu życia na lepszy.',
            'items'        => [
                'Przygotowaniu do ciąży',
                'Problemach z płodnością',
                'Zaburzeniach hormonalnych',
                'Budowie masy i utracie wagi',
            ],
        ],
    ];
}

function dietitian_get_pricing_plans(): array
{
    return [
        [
            'modifier'      => '',
            'badge'         => '',
            'kicker'        => 'Na start',
            'title'         => 'Pierwsza konsultacja',
            'subtitle'      => 'wstępna / kontrolna',
            'card_intro'    => '',
            'price_variant' => 'split',
            'price_options' => [
                [
                    'label' => 'pierwsza',
                    'value' => '300',
                ],
                [
                    'label' => 'kontrolna',
                    'value' => '200',
                ],
            ],
            'lead'          => 'Spotkanie diagnostyczne i kontrolne z planem dalszego działania.',
            'lead_modifier' => '',
            'text'          => '',
            'features'      => [
                [
                    'text'     => 'Wywiad i ankieta zdrowotno-żywieniowa – precyzyjne zebranie danych dotyczących zdrowia, stylu życia i nawyków.',
                    'modifier' => '',
                ],
                [
                    'text'     => 'Ustalenie celu oraz priorytetów terapeutycznych dostosowanych do Twojej sytuacji.',
                    'modifier' => '',
                ],
                [
                    'text'     => 'Wstępny plan postępowania oparty na zebranych informacjach.',
                    'modifier' => '',
                ],
                [
                    'text'     => 'Plan suplementacyjny, jeżeli jest potrzebny i uzasadniony wynikami oraz objawami.',
                    'modifier' => '',
                ],
                [
                    'text'     => 'Miesięczna opieka w aplikacji: stały kontakt przez czat, monitorowanie nawyków, analiza fotodzienniczka AI oraz dostęp do 6500 przepisów.',
                    'modifier' => 'pricing__feature-highlight',
                ],
                [
                    'text'     => 'Brak indywidualnego jadłospisu',
                    'modifier' => 'pricing__feature-alert',
                ],
            ],
        ],
        [
            'modifier'      => 'pricing__card--featured',
            'badge'         => 'Najczęściej wybierana',
            'kicker'        => 'Najlepszy start',
            'title'         => 'Kompleksowa opieka',
            'subtitle'      => 'miesięczna',
            'card_intro'    => '',
            'price_variant' => 'single',
            'price_options' => [
                [
                    'label' => '30 dni wsparcia',
                    'value' => '400',
                ],
            ],
            'lead'          => 'Pakiet obejmuje konsultację wstępną oraz 30-dniowy, spersonalizowany plan żywieniowy w aplikacji mobilnej razem z planem suplementacyjnym dopasowanym do Twoich preferencji, stylu życia i potrzeb zdrowotnych.',
            'lead_modifier' => 'pricing__lead--accent',
            'text'          => 'W aplikacji możesz na bieżąco:',
            'features'      => [
                [
                    'text'     => 'wymieniać posiłki na inne propozycje, wpisywać kroki, analizować dania ze zdjęcia oraz kontrolować postępy,',
                    'modifier' => '',
                ],
                [
                    'text'     => 'dodawać swoje własne dania,',
                    'modifier' => '',
                ],
                [
                    'text'     => 'prowadzić bieżące konsultacje,',
                    'modifier' => '',
                ],
                [
                    'text'     => 'otrzymywać edukację dotyczącą prawidłowego komponowania posiłków.',
                    'modifier' => '',
                ],
            ],
        ],
        [
            'modifier'      => '',
            'badge'         => '',
            'kicker'        => 'Pełna opieka',
            'title'         => 'Kompleksowa opieka',
            'subtitle'      => '3-miesięczna',
            'card_intro'    => '',
            'price_variant' => 'single',
            'price_options' => [
                [
                    'label' => '3 miesiące współpracy',
                    'value' => '1000',
                ],
            ],
            'lead'          => 'Pakiet obejmuje wszystko to, co miesięczna współpraca – rozszerzone o pełną, 3-miesięczną opiekę.',
            'lead_modifier' => '',
            'text'          => 'To pakiet dla osób, które chcą długofalowej pracy nad zdrowiem, regularnej kontroli i systematycznego prowadzenia krok po kroku.',
            'features'      => [
                [
                    'text'     => 'Konsultację wstępną oraz 3 konsultacje kontrolne (jedna w każdym miesiącu).',
                    'modifier' => '',
                ],
                [
                    'text'     => '3 spersonalizowane plany żywieniowe i suplementacyjne – aktualizowane co 30 dni zgodnie z postępami, wynikami badań i Twoimi potrzebami.',
                    'modifier' => '',
                ],
                [
                    'text'     => 'Stały kontakt w aplikacji przez cały okres współpracy, co pozwala na bieżąco korygować działania i dopasowywać zalecenia.',
                    'modifier' => '',
                ],
            ],
        ],
    ];
}
