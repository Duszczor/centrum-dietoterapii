#!/usr/bin/env bash
set -euo pipefail

ROOT_DIR="$(cd "$(dirname "${BASH_SOURCE[0]}")/.." && pwd)"
THEME_NAME="$(basename "$ROOT_DIR")"
RELEASE_ROOT="$ROOT_DIR/release"
TARGET_DIR="$RELEASE_ROOT/$THEME_NAME"
ZIP_PATH="$RELEASE_ROOT/$THEME_NAME.zip"

if [ ! -d "$TARGET_DIR" ]; then
  echo "Release directory not found: $TARGET_DIR"
  echo "Run 'npm run release' first."
  exit 1
fi

echo "Creating ZIP archive..."
rm -f "$ZIP_PATH"

if command -v ditto >/dev/null 2>&1; then
  ditto -c -k --sequesterRsrc --keepParent "$TARGET_DIR" "$ZIP_PATH"
elif command -v zip >/dev/null 2>&1; then
  (
    cd "$RELEASE_ROOT"
    zip -rq "$ZIP_PATH" "$THEME_NAME"
  )
else
  echo "No ZIP utility found. Install 'ditto' or 'zip' and try again."
  exit 1
fi

echo "ZIP archive ready: $ZIP_PATH"