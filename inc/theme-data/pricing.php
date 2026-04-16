<?php

/**
 * Get pricing plans
 *
 * @return array Pricing plans with details, features, and pricing
 */
function dietitian_get_pricing_plans(): array
{
    return [

        // --- Plan 1: Pierwsza konsultacja ---
        [
            'featured'     => false,
            'badge'        => '',
            'kicker'       => 'Na start',
            'title'        => 'Pierwsza konsultacja',
            'subtitle'     => 'wstępna / kontrolna',
            'split_prices' => true,
            'prices'       => [
                ['label' => 'pierwsza',  'value' => '300'],
                ['label' => 'kontrolna', 'value' => '200'],
            ],
            'lead'         => 'Spotkanie diagnostyczne i kontrolne z planem dalszego działania.',
            'lead_accent'  => false,
            'text'         => '',
            'features'     => [
                ['text' => 'Wywiad i ankieta zdrowotno-żywieniowa – precyzyjne zebranie danych dotyczących zdrowia, stylu życia i nawyków.', 'highlight' => false, 'alert' => false],
                ['text' => 'Ustalenie celu oraz priorytetów terapeutycznych dostosowanych do Twojej sytuacji.',                            'highlight' => false, 'alert' => false],
                ['text' => 'Wstępny plan postępowania oparty na zebranych informacjach.',                                                   'highlight' => false, 'alert' => false],
                ['text' => 'Plan suplementacyjny, jeżeli jest potrzebny i uzasadniony wynikami oraz objawami.',                            'highlight' => false, 'alert' => false],
                ['text' => 'Miesięczna opieka w aplikacji: stały kontakt przez czat, monitorowanie nawyków, analiza fotodzienniczka AI oraz dostęp do 6500 przepisów.', 'highlight' => true,  'alert' => false],
                ['text' => 'Brak indywidualnego jadłospisu',                                                                               'highlight' => false, 'alert' => true],
            ],
        ],

        // --- Plan 2: Kompleksowa opieka miesięczna (polecana) ---
        [
            'featured'     => true,
            'badge'        => 'Najczęściej wybierana',
            'kicker'       => 'Najlepszy start',
            'title'        => 'Kompleksowa opieka',
            'subtitle'     => 'miesięczna',
            'split_prices' => false,
            'prices'       => [
                ['label' => '30 dni wsparcia', 'value' => '400'],
            ],
            'lead'         => 'Pakiet obejmuje konsultację wstępną oraz 30-dniowy, spersonalizowany plan żywieniowy w aplikacji mobilnej razem z planem suplementacyjnym dopasowanym do Twoich preferencji, stylu życia i potrzeb zdrowotnych.',
            'lead_accent'  => true,
            'text'         => 'W aplikacji możesz na bieżąco:',
            'features'     => [
                ['text' => 'wymieniać posiłki na inne propozycje, wpisywać kroki, analizować dania ze zdjęcia oraz kontrolować postępy,', 'highlight' => false, 'alert' => false],
                ['text' => 'dodawać swoje własne dania,',                                                                                  'highlight' => false, 'alert' => false],
                ['text' => 'prowadzić bieżące konsultacje,',                                                                               'highlight' => false, 'alert' => false],
                ['text' => 'otrzymywać edukację dotyczącą prawidłowego komponowania posiłków.',                                            'highlight' => false, 'alert' => false],
            ],
        ],

        // --- Plan 3: Kompleksowa opieka 3-miesięczna ---
        [
            'featured'     => false,
            'badge'        => '',
            'kicker'       => 'Pełna opieka',
            'title'        => 'Kompleksowa opieka',
            'subtitle'     => '3-miesięczna',
            'split_prices' => false,
            'prices'       => [
                ['label' => '3 miesiące współpracy', 'value' => '1000'],
            ],
            'lead'         => 'Pakiet obejmuje wszystko to, co miesięczna współpraca – rozszerzone o pełną, 3-miesięczną opiekę.',
            'lead_accent'  => false,
            'text'         => 'To pakiet dla osób, które chcą długofalowej pracy nad zdrowiem, regularnej kontroli i systematycznego prowadzenia krok po kroku.',
            'features'     => [
                ['text' => 'Konsultację wstępną oraz 3 konsultacje kontrolne (jedna w każdym miesiącu).',                                                              'highlight' => false, 'alert' => false],
                ['text' => '3 spersonalizowane plany żywieniowe i suplementacyjne – aktualizowane co 30 dni zgodnie z postępami, wynikami badań i Twoimi potrzebami.', 'highlight' => false, 'alert' => false],
                ['text' => 'Stały kontakt w aplikacji przez cały okres współpracy, co pozwala na bieżąco korygować działania i dopasowywać zalecenia.',                'highlight' => false, 'alert' => false],
            ],
        ],

    ];
}
