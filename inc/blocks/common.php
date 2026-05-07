<?php

/**
 * Return parsed blocks from current front-page content.
 */
function dietitian_get_front_page_blocks(): array
{
    static $front_page_blocks = null;

    if ($front_page_blocks !== null) {
        return $front_page_blocks;
    }

    if (!is_front_page()) {
        $front_page_blocks = [];

        return $front_page_blocks;
    }

    $front_page_id = (int) get_option('page_on_front');

    if ($front_page_id <= 0) {
        $front_page_blocks = [];

        return $front_page_blocks;
    }

    $post = get_post($front_page_id);

    if (!$post || empty($post->post_content)) {
        $front_page_blocks = [];

        return $front_page_blocks;
    }

    $front_page_blocks = parse_blocks($post->post_content);

    return $front_page_blocks;
}

/**
 * Return first matching block from current front-page content.
 */
function dietitian_get_front_page_block(string $block_name): ?array
{
    foreach (dietitian_get_front_page_blocks() as $block) {
        if (($block['blockName'] ?? '') === $block_name) {
            return $block;
        }
    }

    return null;
}

/**
 * Return first hero block from current front-page content.
 */
function dietitian_get_front_page_hero_block(): ?array
{
    return dietitian_get_front_page_block('dietitian/hero');
}

/**
 * Whether front page contains the custom hero block.
 */
function dietitian_front_page_has_hero_block(): bool
{
    return dietitian_get_front_page_hero_block() !== null;
}
