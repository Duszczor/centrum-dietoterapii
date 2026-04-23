/**
 * Shared utilities for Gutenberg blocks editor.
 * Common helpers for text processing, validation, and content guidelines.
 */

export const THEME_TEXT_DOMAIN = "dietitian-theme";

/**
 * Get plain text length, removing HTML tags and normalizing whitespace.
 * @param {string} value - The text value to measure
 * @returns {number} Plain text character count
 */
export function getPlainTextLength(value) {
  return (value || "")
    .replace(/<[^>]*>/g, " ")
    .replace(/\s+/g, " ")
    .trim().length;
}

/**
 * Get content guidance level based on character count.
 * @param {number} length - Plain text character length
 * @param {Object} thresholds - Object with softMax and hardMax properties
 * @param {number} thresholds.softMax - Recommended character limit
 * @param {number} thresholds.hardMax - Hard character limit
 * @returns {null|'soft'|'hard'} Guidance level or null if OK
 */
export function getFieldGuidance(length, thresholds) {
  if (length === 0) {
    return null;
  }

  if (length > thresholds.hardMax) {
    return "hard";
  }

  if (length > thresholds.softMax) {
    return "soft";
  }

  return null;
}

/**
 * Sanitize a select field value against allowed options.
 * @param {*} value - The value to validate
 * @param {Array} options - Array of valid options with 'value' property
 * @param {*} fallback - Value to use if validation fails
 * @returns {*} Validated or fallback value
 */
export function sanitizeSelectValue(value, options, fallback) {
  return options.some((option) => option.value === value) ? value : fallback;
}
