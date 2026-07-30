<?php

declare(strict_types=1);

namespace DaveReid\DrupalDrush\Drush\Commands;

use Drush\Attributes as CLI;
use Drush\Boot\DrupalBootLevels;
use Drush\Drush;

/**
 * Additional Drupal commands.
 */
class DrupalCommands extends DrushCommands {

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
          $this->logger()->
          return 0;
        }
      }
    } catch (\Exception) {
      // Do nothing.
    }
    return 1;
  }

}
