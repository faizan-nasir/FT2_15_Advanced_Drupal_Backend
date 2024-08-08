<?php

declare(strict_types=1);

namespace Drupal\formtask\Form;
use Drupal\Core\Cache\Cache;
use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;

/**
 * Provides a Formtask form.
 */
final class FormTask extends FormBase {

  /**
   * {@inheritdoc}
   */
  public function getFormId(): string {
    return 'formtask_form_task';
  }

  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state): array {

    $form['parent_company'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Parent Company'),
      '#required' => TRUE,
    ];
    $form['labelone'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Label 1'),
      '#required' => TRUE,
    ];
    $form['valueone'] = [
      '#type' => 'number',
      '#title' => $this->t('Value 1'),
      '#required' => TRUE,
    ];

    $form['labeltwo'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Label 2'),
      '#required' => TRUE,
    ];
    $form['valuetwo'] = [
      '#type' => 'number',
      '#title' => $this->t('Value 2'),
      '#required' => TRUE,
    ];

    $form['actions'] = [
      '#type' => 'actions',
      'submit' => [
        '#type' => 'submit',
        '#value' => $this->t('Submit'),
      ],
    ];

    return $form;
  }

  /**
   * {@inheritdoc}
   */
  public function validateForm(array &$form, FormStateInterface $form_state): void {
    // @todo Validate the form here.
    // Example:
    // @code
    //   if (mb_strlen($form_state->getValue('message')) < 10) {
    //     $form_state->setErrorByName(
    //       'message',
    //       $this->t('Message should be at least 10 characters.'),
    //     );
    //   }
    // @endcode
  }

  /**
   * {@inheritdoc}
   */
  public function submitForm(array &$form, FormStateInterface $form_state): void {
    \Drupal::messenger()->addMessage("Details Submitted Successfully");
    $values = $form_state->getValues();
    \Drupal::database()->insert('form_task')->fields([
      'parent_company' => $values['parent_company'],
      'labelone' => $values['labelone'],
      'valueone' => $values['valueone'],
      'labeltwo' => $values['labeltwo'],
      'valuetwo' => $values['valuetwo'],
    ])->execute();
    Cache::invalidateTags(['form_task_list']);
  }

}
