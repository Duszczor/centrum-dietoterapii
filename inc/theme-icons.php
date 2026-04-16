<?php

function dietitian_get_icon_svg(string $icon, string $class_name = ''): string
{
    $class_attribute = $class_name !== '' ? ' class="' . $class_name . '"' : '';

    $icons = [
        'gut-health' => <<<SVG
<svg{$class_attribute} viewBox="0 0 64 64" fill="none" xmlns="http://www.w3.org/2000/svg">
    <path d="M25.5 13.5V18.5" stroke="currentColor" stroke-width="3" stroke-linecap="round"/>
    <path d="M38.5 13.5V18.5" stroke="currentColor" stroke-width="3" stroke-linecap="round"/>
    <path d="M25 18.5C19.7 18.5 15.5 22.7 15.5 28V31C15.5 36.3 19.7 40.5 25 40.5" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"/>
    <path d="M39 18.5C44.3 18.5 48.5 22.7 48.5 28V31C48.5 36.3 44.3 40.5 39 40.5" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"/>
    <path d="M25 28H39" stroke="currentColor" stroke-width="3" stroke-linecap="round"/>
    <path d="M28 33H36" stroke="currentColor" stroke-width="3" stroke-linecap="round"/>
    <path d="M25 40.5V49" stroke="currentColor" stroke-width="3" stroke-linecap="round"/>
    <path d="M39 40.5V49" stroke="currentColor" stroke-width="3" stroke-linecap="round"/>
    <path d="M32 10L33.6 13.4L37 15L33.6 16.6L32 20L30.4 16.6L27 15L30.4 13.4L32 10Z" stroke="var(--icon-accent, currentColor)" stroke-width="2.2" stroke-linejoin="round"/>
</svg>
SVG,
        'metabolic' => <<<SVG
<svg{$class_attribute} viewBox="0 0 64 64" fill="none" xmlns="http://www.w3.org/2000/svg">
    <circle cx="32" cy="31" r="21" stroke="currentColor" stroke-width="2.8"/>
    <path d="M32 42.5C31.7 42.5 31.4 42.4 31.2 42.2L24.2 35.6C22.1 33.6 21.4 30.6 22.5 28C23.6 25.5 26.1 23.9 28.8 23.9C30.5 23.9 32 24.5 33.2 25.6L34 26.4L34.8 25.6C36 24.5 37.5 23.9 39.2 23.9C41.9 23.9 44.4 25.5 45.5 28C46.6 30.6 45.9 33.6 43.8 35.6L36.8 42.2C36.6 42.4 36.3 42.5 36 42.5H32Z" stroke="var(--icon-accent, currentColor)" stroke-width="2.8" stroke-linejoin="round"/>
    <path d="M17.5 31H23.5L27.1 25.7L30.7 35L34.1 28.8H39.5" stroke="currentColor" stroke-width="2.6" stroke-linecap="round" stroke-linejoin="round"/>
</svg>
SVG,
        'fertility-support' => <<<SVG
<svg{$class_attribute} viewBox="0 0 64 64" fill="none" xmlns="http://www.w3.org/2000/svg">
    <circle cx="32" cy="26" r="9" stroke="currentColor" stroke-width="3"/>
    <path d="M32 35V49" stroke="currentColor" stroke-width="3" stroke-linecap="round"/>
    <path d="M25.5 49H38.5" stroke="currentColor" stroke-width="3" stroke-linecap="round"/>
    <path d="M19 27C19 21.5 23.5 17 29 17" stroke="currentColor" stroke-width="2.6" stroke-linecap="round"/>
    <path d="M45 27C45 21.5 40.5 17 35 17" stroke="currentColor" stroke-width="2.6" stroke-linecap="round"/>
    <circle cx="47" cy="14" r="2.5" fill="var(--icon-accent, currentColor)"/>
    <path d="M45 14H49" stroke="white" stroke-width="1.8" stroke-linecap="round"/>
    <path d="M47 12V16" stroke="white" stroke-width="1.8" stroke-linecap="round"/>
</svg>
SVG,
        'home' => <<<SVG
<svg{$class_attribute} viewBox="0 0 24 24" focusable="false" aria-hidden="true">
    <path d="M4 10.5 12 4l8 6.5V20a1 1 0 0 1-1 1h-4.75v-6h-4.5v6H5a1 1 0 0 1-1-1z" fill="currentColor"/>
</svg>
SVG,
        'pin' => <<<SVG
<svg{$class_attribute} viewBox="0 0 24 24" focusable="false" aria-hidden="true">
    <path d="M12 21s6-5.52 6-11a6 6 0 1 0-12 0c0 5.48 6 11 6 11Zm0-8.25a2.75 2.75 0 1 1 0-5.5 2.75 2.75 0 0 1 0 5.5Z" fill="currentColor"/>
</svg>
SVG,
        'phone' => <<<SVG
<svg{$class_attribute} viewBox="0 0 24 24" focusable="false" aria-hidden="true">
    <path d="M6.62 10.79a15.05 15.05 0 0 0 6.59 6.59l2.2-2.2a1 1 0 0 1 1-.24c1.06.35 2.2.54 3.39.54a1 1 0 0 1 1 1V20a1 1 0 0 1-1 1C10.3 21 3 13.7 3 4a1 1 0 0 1 1-1h3.52a1 1 0 0 1 1 1c0 1.19.18 2.33.54 3.39a1 1 0 0 1-.25 1.01z" fill="currentColor"/>
</svg>
SVG,
        'mail' => <<<SVG
<svg{$class_attribute} viewBox="0 0 24 24" focusable="false" aria-hidden="true">
    <path d="M4 6h16a1 1 0 0 1 1 1v10a1 1 0 0 1-1 1H4a1 1 0 0 1-1-1V7a1 1 0 0 1 1-1Zm0 2v.2l8 5.33 8-5.33V8l-8 5.33L4 8Z" fill="currentColor"/>
</svg>
SVG,
    ];

    return $icons[$icon] ?? '';
}
