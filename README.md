# Drush Helper

Helpful Drush commands for Drupal sites. It's a Composer package of type `drupal-drush`, so it doesn't need a Drupal module to be installed or enabled.

## Requirements

- Drush 12 or 13
- Drupal 10 or 11, as supported by your Drush version
- PHP 8.1 or newer, as required by your Drush and Drupal versions

## Installation

```shell
composer require davereid/drush-helper
```

Drupal projects based on `drupal/recommended-project` install it in `drush/Commands/contrib/drush-helper`, where Drush finds it.

## Commands

### `drupal:installed`

Exits with `0` if Drupal is installed (its settings load and its database is reachable), and `1` if it isn't. It prints nothing, so it's meant for scripts:

```shell
if drush drupal:installed; then
  drush deploy
else
  drush site:install --existing-config --yes
fi
```

## Development

`tests/functional.sh` installs the package into a new Drupal project with SQLite and runs the commands. `DRUPAL_VERSION` and `DRUSH_VERSION` choose the versions:

```shell
DRUPAL_VERSION=10 DRUSH_VERSION=12 tests/functional.sh
```

Pull request titles must follow [Conventional Commits](https://www.conventionalcommits.org/), since release-please uses them for versions and the changelog. See [`AGENTS.md`](AGENTS.md) for the code and CI conventions.

## License

[GPL-2.0-or-later](LICENSE)
