#!/usr/bin/env bash
# Exit immediately on error, treat unset variables as errors, fail on pipe errors.
set -euo pipefail

# ---------------------------------------------------------------------------
# Paths
# ---------------------------------------------------------------------------
ROOT_DIR="$(cd "$(dirname "${BASH_SOURCE[0]}")/.." && pwd)"
THEME_NAME="$(basename "$ROOT_DIR")"
RELEASE_ROOT="$ROOT_DIR/release"
TARGET_DIR="$RELEASE_ROOT/$THEME_NAME"

# ---------------------------------------------------------------------------
# Prepare clean target directory
# ---------------------------------------------------------------------------
mkdir -p "$RELEASE_ROOT"
echo "Cleaning previous release..."
rm -rf "$TARGET_DIR"

# ---------------------------------------------------------------------------
# Copy production files only — exclude all development-only artifacts
# ---------------------------------------------------------------------------
rsync -a \
  --exclude='.git/' \
  --exclude='.github/' \
  --exclude='node_modules/' \
  --exclude='release/' \
  --exclude='scripts/' \
  --exclude='assets/scss/' \
  --exclude='template-parts/**/*.scss' \
  --exclude='blocks/**/src/' \
  --exclude='package.json' \
  --exclude='package-lock.json' \
  --exclude='.stylelintrc.json' \
  --exclude='.gitignore' \
  --exclude='.DS_Store' \
  "$ROOT_DIR/" "$TARGET_DIR/"

# rsync --exclude does not recurse into subdirectories for .DS_Store, so clean manually.
find "$TARGET_DIR" -name '.DS_Store' -delete

echo "Release folder ready: $TARGET_DIR"
