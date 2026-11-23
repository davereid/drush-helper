#!/usr/bin/env bash
# Installs this package into a new Drupal project and checks drupal:installed's exit codes.
# Usage: DRUPAL_VERSION=11 DRUSH_VERSION=13 tests/functional.sh
set -euo pipefail

repo=$(cd "$(dirname "$0")/.." && pwd)
dir=$(mktemp -d)
trap 'chmod -R u+w "$dir"; rm -rf "$dir"' EXIT

composer create-project --no-interaction --no-install "drupal/recommended-project:^${DRUPAL_VERSION:-11}" "$dir"
composer -d "$dir" config repositories.local path "$repo"
composer -d "$dir" require --no-interaction "drush/drush:^${DRUSH_VERSION:-13}" 'davereid/drush-helper:*@dev'

drush="$dir/vendor/bin/drush"
# Fails if Drush doesn't discover the command, so the exit code checks below can't pass by accident.
"$drush" help drupal:installed >/dev/null

if "$drush" drupal:installed; then
  echo "FAIL: drupal:installed exited 0 before install" >&2
  exit 1
fi

# Drupal 11.4 and later also have core's dr command.
dr="$dir/vendor/bin/dr"
if [ -x "$dr" ] && "$dr" drupal:installed; then
  echo "FAIL: dr drupal:installed exited 0 before install" >&2
  exit 1
fi

"$drush" site:install --yes --db-url="sqlite://localhost/$dir/db.sqlite" minimal
"$drush" drupal:installed
if [ -x "$dr" ]; then
  # Fails if dr doesn't discover the command.
  "$dr" help drupal:installed >/dev/null
  "$dr" drupal:installed
fi
echo "PASS"
