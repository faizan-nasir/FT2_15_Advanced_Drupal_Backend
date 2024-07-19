<?php

namespace Drupal\mymodule\Controller;

use Drupal\Core\Session\AccountInterface;
use Drupal\Core\Controller\ControllerBase;

class MyModuleController extends ControllerBase
{
  protected $currentUser;
  public function __construct(AccountInterface $currentUser)
  {
    $this->currentUser = $currentUser;
  }

  /**
   * Returns the content for MyModule settings page.
   *
   * @return array
   *   A render array containing the page content.
   */
  public function firstFunction()
  {
    $build = [
      '#markup' => $this->t('This is the content of MyModule settings page.'),
    ];
    return $build;
  }

  /**
   * Returns the content for MyModule settings page.
   *
   * @return array
   *   A render array containing the page content.
   */
  public function checkPermission()
  {
    if ($this->currentUser->hasPermission('custom permission')) {
      // Get specific user information.
      $name = $this->currentUser->getDisplayName();
      $uid = $this->currentUser->id();
      $build = [
        '#markup' => $this->t("<h3>Hello {$name} your id is: {$uid}</h3>"),
      ];
    } else {
      $build = [
        '#markup' => $this->t("<h3>Permission Denied!</h3>"),
      ];
    }
    return $build;
  }
}
