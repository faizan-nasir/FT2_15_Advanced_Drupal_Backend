<?php

declare(strict_types=1);

namespace Drupal\formtask\Plugin\Block;

use Drupal\Core\Block\BlockBase;

/**
 * Provides a formtask block.
 *
 * @Block(
 *   id = "formtask_formtask",
 *   admin_label = @Translation("formtask"),
 *   category = @Translation("Custom"),
 * )
 */
final class FormtaskBlock extends BlockBase {

  /**
   * {@inheritdoc}
   */
  public function build(): array {
    $query = \Drupal::database()->select('form_task','t');
    $query->fields('t',['parent_company','labelone',
      'valueone', 'labeltwo', 'valuetwo']);
    $result = $query->execute();
    $content = '';
    foreach ($result as $row) {
      $content .= $row->parent_company . '   ';
      $content .= $row->labelone . '   ';
      $content .= $row->valueone . '   ';
      $content .= $row->labeltwo . '   ';
      $content .= $row->valuetwo . '   <br>';
    }
    $build['content'] = [
      '#markup' => $this->t($content),
      '#cache' => [
        'tags' => ['form_task_list']
      ]
    ];

    return $build;
  }

}
