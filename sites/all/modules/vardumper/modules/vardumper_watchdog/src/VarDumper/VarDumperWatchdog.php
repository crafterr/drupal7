<?php
/**
 * @file
 * Contains Drupal\vardumper_watchdog\VarDumper\VarDumperWatchdog.
 */

namespace Drupal\vardumper_watchdog\VarDumper;

use Drupal\vardumper\VarDumper\VarDumperDebug;
use Psr\Log\LoggerInterface;

/**
 * The VarDumperWatchdog class.
 */
class VarDumperWatchdog extends VarDumperDebug {

  /**
   * The Logger service.
   *
   * @var \Psr\Log\LoggerInterface
   */
  protected $logger;

  /**
   * {@inheritdoc}
   */
  public function __construct(LoggerInterface $logger) {
    $this->logger = $logger;
  }

  /**
   * {@inheritdoc}
   */
  public function dump($var, $name = '') {
    // Permission are not checked in this submodule because permissions
    // are set on the module dblog from Drupal 7.
    $this->logger->debug($this->getHeaders($name, $this->getDebugInformation()) . $this->getDebug($var));
  }

}
