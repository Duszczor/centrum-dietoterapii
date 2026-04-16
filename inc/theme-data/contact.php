<?php

/**
 * Get contact information
 *
 * @return array Contact data with all contact details
 */
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
