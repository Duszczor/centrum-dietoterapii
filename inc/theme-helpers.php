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
