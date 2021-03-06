<?php
/**
 * Created by PhpStorm.
 * User: tito
 * Date: 2/1/2019
 * Time: 3:47 PM
 */
namespace Drupal\ajax_example\Form;

use Drupal\Core\Ajax\ReplaceCommand;
use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;
use Drupal\Core\Ajax\AjaxResponse;
use Drupal\Core\Ajax\HtmlCommand;

/**
 * Class DefaultController.
 */
class AjaxExampleForm extends FormBase {

  /**
   * {@inheritdoc}
   */
  public function getFormId() {
    return 'ajax_example_form';
  }

  /**
   * {@inheritdoc}
   */
  public function getOptions() {
    return [
      '1' => 'Option 1',
      '2' => 'Option 2',
      '3' => 'Option 3',
      '4' => 'Option 4',
    ];
  }

  /**
   * {@inheritdoc}
   */
  public function getSubOptions() {
    return [
      '1' => ['SubOptions11', 'SubOptions12', 'SubOptions13'],
      '2' => ['SubOptions21', 'SubOptions22', 'SubOptions23'],
      '3' => ['SubOptions31', 'SubOptions32', 'SubOptions33'],
      '4' => ['SubOptions41', 'SubOptions42', 'SubOptions43'],
    ];
  }

  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state) {
    $form['dropdown'] = [
      '#type' => 'select',
      '#title' => 'Select one..',
      '#options' => $this->getOptions(),
      '#ajax' => [
        'callback' => '::checkUserEmailValidation',
        'effect' => 'fade',
        'wrapper' => 'ajax-result-div',
        'event' => 'change',
        'progress' => [
          'type' => 'throbber',
          'message' => NULL,
        ],
      ],
    ];
    $form['acordding'] = [
      '#type'   => 'details',
      '#prefix' => '<div id="ajax-result-div">',
      '#suffix' => '</div>',
      '#open'   => TRUE,
    ];
    $form['acordding']['ajax_result'] = [
      '#type' => 'textfield',
      '#title' => 'Ajax Response',
    ];
    $form['acordding']['ajax_result_1'] = [
      '#type' => 'textfield',
      '#title' => 'Ajax Response',
    ];
    return $form;
  }

  public function checkUserEmailValidation(array $form, FormStateInterface $form_state) {

    // $ajax_response = new AjaxResponse();
    // Check if User or email exists or not
    // if (user_load_by_name($form_state->getValue('user_email')) ||
    // user_load_by_mail($form_state->getValue('user_email'))) {
    // $text = 'User or Email is exists';
    // } else {
    // $text = 'User or Email does not exists';
    // }
    // $ajax_response->addCommand(new HtmlCommand('#my_ajax_result', $text));

    $var = form_state->getValue('dropdown');
    debug($var, NULL, FALSE);
    // return $ajax_response;
    $form['acordding']['ajax_result']['#value'] = 'Op:'.$this->getSubOptions()[$var][0];
    $form['acordding']['ajax_result_1']['#value'] = 'Op:'.$this->getSubOptions()[$var][1];
    // debug($form['ajax_result'],null,false);
    return $form['acordding'];
  }

  /**
   * Form submission handler.
   *
   * @param array $form
   *   An associative array containing the structure of the form.
   * @param \Drupal\Core\Form\FormStateInterface $form_state
   *   The current state of the form.
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {
    // TODO: Implement submitForm() method.
  }

}
