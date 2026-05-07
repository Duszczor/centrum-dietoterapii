<?php

/**
 * Return mapping between block slugs and render callbacks.
 */
function dietitian_get_block_render_callbacks(): array
{
    return [
        'hero' => 'dietitian_render_hero_block',
    ];
}

/**
 * Register custom blocks.
 */
function dietitian_register_blocks(): void
{
    foreach (dietitian_get_block_render_callbacks() as $block_slug => $render_callback) {
        $block_path = get_template_directory() . '/blocks/' . $block_slug;

        if (!file_exists($block_path . '/block.json')) {
            continue;
        }

        register_block_type($block_path, [
            'render_callback' => $render_callback,
        ]);
    }
}

add_action('init', 'dietitian_register_blocks');
