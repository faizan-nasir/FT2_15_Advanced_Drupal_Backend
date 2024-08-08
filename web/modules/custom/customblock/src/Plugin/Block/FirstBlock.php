<?php

declare(strict_types=1);

namespace Drupal\customblock\Plugin\Block;

use Drupal\Core\Block\BlockBase;

/**
 * Provides a first block block.
 *
 * @Block(
 *   id = "customblock_first_block",
 *   admin_label = @Translation("First Block"),
 *   category = @Translation("Custom"),
 * )
 */
final class FirstBlock extends BlockBase {

  /**
   * {@inheritdoc}
   */
  public function build(): array {
    $current_user = \Drupal::currentUser();
    $name = $current_user->getDisplayName();
    return [
      '#markup' => $this->t('Welcome @name', ['@name' => $name]),
    ];
  }

}
