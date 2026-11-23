<?php

declare(strict_types=1);

namespace DaveReid\DrushHelper\Drush\Commands;

use Drush\Attributes as CLI;
use Drush\Boot\DrupalBootLevels;
use Drush\Commands\DrushCommands;
use Drush\Drush;

/**
 * Additional Drupal commands.
 */
class DrupalDrushCommands extends DrushCommands {

  /**
   * Checks if Drupal is installed.
   */
  #[CLI\Command(name: 'drupal:installed')]
  #[CLI\Bootstrap(DrupalBootLevels::SITE)]
  public function isInstalled(): int {
    try {
      $bootstrap = Drush::bootstrap();
      $bootstrapManager = Drush::bootstrapManager();
      if ($bootstrap->bootstrapDrupalConfigurationValidate($bootstrapManager)) {
        $bootstrap->bootstrapDrupalConfiguration($bootstrapManager);
        if ($bootstrap->bootstrapDrupalDatabaseValidate($bootstrapManager)) {
          return 0;
        }
      }
    } catch (\Exception) {
      // Do nothing.
    }
    return 1;
  }

}
