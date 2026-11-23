# drush-helper

Helpful Drush commands, installed with Composer as a `drupal-drush` package. It doesn't need a Drupal module.

## Code

- Command classes go in `src/Drush/Commands/` (namespace `DaveReid\DrushHelper\Drush\Commands`), and their names must end in `DrushCommands`. Drush 12 doesn't discover other names, even though Drush 13 does.
- Support every Drush major in `composer.json`'s `drush/drush` constraint, and test each one in CI.

## Tests

- `tests/functional.sh` installs the package into a new Drupal project with SQLite, then runs the commands. `DRUPAL_VERSION` and `DRUSH_VERSION` choose the versions (defaults: 11 and 13), e.g. `DRUPAL_VERSION=10 DRUSH_VERSION=12 tests/functional.sh`.
- The `CI` workflow runs it once per supported Drush major, each with a Drupal major that Drush supports and a different PHP version, so the jobs cover the whole PHP range without testing a version twice:
  - the oldest pair on the lowest PHP it allows;
  - the newest pair on the newest PHP release it runs on;
  - pairs in between on versions in between.

  When the Drush constraint gains a major, add a pair and move the others' PHP versions to keep them spread out.
- The job names include the PHP version and are the `ci` ruleset's required checks: update the ruleset whenever a name changes.

## Releases

- PR titles must follow [Conventional Commits](https://www.conventionalcommits.org/): PRs are squash-merged, and release-please reads the titles to pick the next version and write the changelog. `ci:`, `docs:`, `test:` and `chore:` changes don't make a release.
