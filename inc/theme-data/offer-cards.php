<?php

/**
 * Get service offer cards
 *
 * @return array Service cards with title, subtitle, description, and items
 */
function dietitian_get_offer_cards(): array
{
    return [
        [
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
