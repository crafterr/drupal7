<?php
/**
 * @file
 * Contains Drupal\vardumper_block\VarDumper\VarDumperBlock.
 */

namespace Drupal\vardumper_block\VarDumper;

use Drupal\service_container\Legacy\Drupal7;
use Drupal\vardumper\VarDumper\VarDumperDebug;
use Symfony\Component\HttpFoundation\Session\SessionInterface;

/**
 * The VarDumperBlock class.
 */
class VarDumperBlock extends VarDumperDebug {

  /**
   * The Session service.
   *
   * @var Session;
   */
  protected $session;

  /**
   * The Drupal7 legacy service.
   *
   * @var \Drupal\service_container\Legacy\Drupal7
   */
  protected $drupal7;

  /**
   * {@inheritdoc}
   */
  public function __construct(SessionInterface $session, Drupal7 $drupal7) {
    $this->session = $session;
    $this->drupal7 = $drupal7;
  }

  /**
   * {@inheritdoc}
   */
  public function dump($var, $name = '') {
    if (!$this->hasPermission()) {
      return;
    }
    $html = $this->getHeaders($name, $this->getDebugInformation()) . $this->getDebug($var);
    $this->session->getFlashBag()->add('vardumper', $html);
  }

}
