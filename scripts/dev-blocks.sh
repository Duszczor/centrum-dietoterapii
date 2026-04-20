#!/usr/bin/env bash
set -euo pipefail

ROOT_DIR="$(cd "$(dirname "${BASH_SOURCE[0]}")/.." && pwd)"

cd "$ROOT_DIR"

shopt -s nullglob
BLOCK_ENTRIES=("$ROOT_DIR"/blocks/*/src/index.js)
shopt -u nullglob

if [ ${#BLOCK_ENTRIES[@]} -eq 0 ]; then
  echo "No block entry files found in $ROOT_DIR/blocks"
  exit 1
fi

declare -a pids=()

cleanup() {
  for pid in "${pids[@]}"; do
    kill "$pid" 2>/dev/null || true
  done

  wait || true
}

trap cleanup EXIT INT TERM

for entry in "${BLOCK_ENTRIES[@]}"; do
  block_dir="$(dirname "$(dirname "$entry")")"
  block_slug="$(basename "$block_dir")"
  relative_entry="${entry#$ROOT_DIR/}"
  relative_output_dir="${block_dir#$ROOT_DIR/}/build"

  echo "Watching block: $block_slug"
  npx --no-install wp-scripts start "$relative_entry" --output-path="$relative_output_dir" --output-filename=index.js &
  pids+=("$!")
done

wait -n