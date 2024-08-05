<?php

// declare(strict_types=1);

namespace Drupal\campaign\Controller;

use Drupal\Core\Controller\ControllerBase;

/**
 * Returns responses for Campaign routes.
 */
class CampaignController extends ControllerBase
{

  /**
   * Render static content when content via url is missing.
   *
   * return array
   *   Array containing markup to be rendered.
   */
  public function contentStatic() {
    $build = [
      '#markup' => $this->t('<h3>Content of campaign</h3>'),
    ];
    return $build;
  }

  /**
   * Function to send dynamic markup based on url value.
   *
   * @param string $content
   *   Content passed via url
   *
   * @return array
   *   Returns array of markup.
   */
  public function contentVariable($content) {
    $build = [
      '#markup' => $this->t('<h3>This is the content of My Campaign
      <strong>"@content"</strong></h3>', ['@content' => $content]),
    ];
    return $build;
  }
}
