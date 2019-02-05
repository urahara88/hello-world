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

class AjaxExampleForm extends FormBase
{

    public function getFormId()
    {
        return 'ajax_example_form';
    }

    public function getOptions()
    {
        return array(
            '1' => 'Option 1',
            '2' => 'Option 2',
            '3' => 'Option 3',
            '4' => 'Option 4',
        );
    }
    public function getSubOptions()
    {
        return array(

            '1'=> array('SubOptions11','SubOptions12','SubOptions13'),
            '2'=> array('SubOptions21','SubOptions22','SubOptions23'),
            '3'=> array('SubOptions31','SubOptions32','SubOptions33'),
            '4'=> array('SubOptions41','SubOptions42','SubOptions43'),
        );
    }
    public function buildForm(array $form, FormStateInterface $form_state)
    {
        $form['dropdown'] = array(
            '#type' => 'select',
            '#title' => 'Select one..',
            '#options' =>$this->getOptions(),
            '#ajax' => array(
                'callback' => '::checkUserEmailValidation',
                'effect' => 'fade',
                'wrapper'=> 'ajax-result-div',
                'event' => 'change',
                'progress' => array(
                    'type' => 'throbber',
                    'message' => NULL,
                ),
            ),
        );
        $form['acordding']=array(
            '#type'   => 'details',
            '#prefix' => '<div id="ajax-result-div">',
            '#suffix' => '</div>',
            '#open'   => TRUE,
        );
        $form['acordding']['ajax_result']= array(
            '#type' => 'textfield',
            '#title' => 'Ajax Response'
        );
        $form['acordding']['ajax_result_1']= array(
            '#type' => 'textfield',
            '#title' => 'Ajax Response'
        );
        return $form;
    }

    public function checkUserEmailValidation(array $form, FormStateInterface $form_state) {

//        $ajax_response = new AjaxResponse();
//
//        // Check if User or email exists or not
//        if (user_load_by_name($form_state->getValue('user_email')) || user_load_by_mail($form_state->getValue('user_email'))) {
//            $text = 'User or Email is exists';
//        } else {
//            $text = 'User or Email does not exists';
//        }
//        $ajax_response->addCommand(new HtmlCommand('#my_ajax_result', $text));

        $var=$form_state->getValue('dropdown');
        debug($var,null,false);
        //return $ajax_response;
        $form['acordding']['ajax_result']['#value']='Op:'.$this->getSubOptions()[$var][0];
        $form['acordding']['ajax_result_1']['#value']='Op:'.$this->getSubOptions()[$var][1];
        //debug($form['ajax_result'],null,false);
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
    public function submitForm(array &$form, FormStateInterface $form_state)
    {
        // TODO: Implement submitForm() method.
    }
}
