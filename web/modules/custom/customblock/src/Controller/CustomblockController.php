<?php

declare(strict_types=1);

namespace Drupal\customblock\Controller;

use Drupal\Core\Controller\ControllerBase;

/**
 * Returns responses for Customblock routes.
 */
final class CustomblockController extends ControllerBase {

  public function welcome() {
    return [
      '#markup' => '<h5>Hi! This is my custom welcome page.</h5>'
    ];
  }
}
