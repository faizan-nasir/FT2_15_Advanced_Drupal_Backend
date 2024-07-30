<?php

declare(strict_types=1);

namespace Drupal\employee\Form;

use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;

/**
 * Provides a employee form.
 */
final class ExampleForm extends FormBase {

  /**
   * {@inheritdoc}
   */
  public function getFormId(): string {
    return 'employee_example';
  }

  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state): array {

    $form['emp_name'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Name:'),
      '#required' => TRUE,
      '#maxLength' => 50,
    ];

    $form['emp_number'] = [
      '#type' => 'tel',
      '#title' => $this->t('Phone Number:'),
      '#required' => TRUE,
    ];

    $form['emp_email'] = [
      '#type' => 'email',
      '#title' => $this->t('Email Address:'),
      '#required' => TRUE,
      '#maxLength' => 30,
    ];

    $form['emp_gender'] = [
      '#type' => 'radios',
      '#title' => $this->t('Select Gender:'),
      '#options' => [
        'male' => $this->t('Male'),
        'female' => $this->t('Female'),
        'other' => $this->t('Other'),
      ],
    ];

    $form['actions'] = [
      '#type' => 'actions',
      'submit' => [
        '#type' => 'submit',
        '#value' => $this->t('Submit here'),
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
    $formField=$form_state->getValues();
    $empName= trim($formField['emp_name']);
    $empNumber=trim($formField['emp_number']);
    $empEmail=trim($formField['emp_email']);

    if (!preg_match("/^([a-z A-Z]+)$/", $empName)) {
      $form_state->setErrorByName(
        'emp_fullname',
        $this->t('Name should consist of alphabets and spaces!')
      );
    }

    if (!preg_match("/^(?:\+91|91|0)?[789]\d{9}$/", $empNumber)) {
      $form_state->setErrorByName(
        'emp_lastname',
        $this->t('Enter a valid 10 digit number with +91 as prefix.')
      );
    }

    if (!preg_match(
      '/\b[A-Za-z0-9._%+-]+@(gmail|yahoo|outlook|hotmail)\.com\b/',
      $empEmail
    )) {
      $form_state->setErrorByName(
        'emp_email',
        $this->t('Enter a Valid Email address of public domains like gmail, yahoo, outlook, hotmail with .com extension.'),
      );
    }
  }

  /**
   * {@inheritdoc}
   */
  public function submitForm(array &$form, FormStateInterface $form_state): void {
    $this->messenger()->addStatus($this->t('Form submission successful.'));
    $form_state->setRedirect('<front>');
  }

}
