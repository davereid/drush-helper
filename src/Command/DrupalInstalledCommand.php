<?php

declare(strict_types=1);

namespace DaveReid\DrushHelper\Command;

use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

/**
 * Checks if Drupal is installed, for Drupal core's dr command.
 */
#[AsCommand(name: 'drupal:installed', description: 'Checks if Drupal is installed.')]
final class DrupalInstalledCommand extends Command {

  /**
   * @param array<string, mixed> $modules
   *   The container.modules parameter, keyed by module name.
   */
  public function __construct(private readonly array $modules) {
    parent::__construct();
  }

  /**
   * {@inheritdoc}
   */
  protected function execute(InputInterface $input, OutputInterface $output): int {
    // dr boots Drupal before an install when settings.php has a database, but
    // with no modules enabled.
    return isset($this->modules['system']) ? self::SUCCESS : self::FAILURE;
  }

}
