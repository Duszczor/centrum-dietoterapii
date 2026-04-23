<?php

/**
 * Theme Helper Functions
 * Utility functions for asset management and common operations
 */

/**
 * Get asset URI
 *
 * Constructs the full URI to an asset file in the /assets directory.
 * Prevents double slashes and handles relative paths safely.
 *
 * @param string $asset_path Relative path from /assets (e.g., 'images/logo/logo.png')
 * @return string Full URI to the asset
 *
 * @example
 * dietitian_get_asset_uri('images/logo.png')
 * // Returns: https://example.com/wp-content/themes/dietitian-theme/assets/images/logo.png
 */
function dietitian_get_asset_uri(string $asset_path): string
{
    return get_template_directory_uri() . '/assets/' . ltrim($asset_path, '/');
}

/**
 * Get estimated read time for a post in minutes.
 *
 * Uses multibyte-safe word counting to handle Polish characters correctly.
 *
 * @param int $post_id Post ID
 * @return int Read time in minutes (minimum 1)
 */
function dietitian_get_read_time(int $post_id): int
{
    $content = (string) get_post_field('post_content', $post_id);
    preg_match_all('/\S+/u', wp_strip_all_tags($content), $matches);
    return max(1, (int) ceil(count($matches[0]) / 220));
}
