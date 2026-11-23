<?php

/**
 * @file
 * Registers this package's commands with Drupal core's dr command.
 *
 * Composer loads this file on every request. Drupal reads this global when it
 * builds its container, as it does for Drush 15's DoctorServiceProvider.
 */

declare(strict_types=1);

$GLOBALS['conf']['container_service_providers']['DrushHelperServiceProvider'] = \DaveReid\DrushHelper\DrushHelperServiceProvider::class;
