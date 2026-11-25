<?php

declare(strict_types=1);

namespace DaveReid\DrushHelper;

use DaveReid\DrushHelper\Command\DrupalInstalledCommand;
use Drupal\Core\DependencyInjection\ContainerBuilder;
use Drupal\Core\DependencyInjection\ServiceProviderInterface;

/**
 * Adds this package's commands to Drupal core's dr command.
 *
 * Core only discovers dr commands in enabled modules, so src/autoload.php
 * registers this provider instead, as Drush 15 does.
 */
final class DrushHelperServiceProvider implements ServiceProviderInterface {

  /**
   * {@inheritdoc}
   */
  public function register(ContainerBuilder $container): void {
    $container->register(DrupalInstalledCommand::class, DrupalInstalledCommand::class)
      ->setArguments(['%container.modules%'])
      ->setPublic(TRUE)
      ->addTag('console.command');
  }

}
