<?php

namespace Drupal\copyright_block\Plugin\Block;

use Drupal\Core\Block\BlockBase;
use Drupal\Core\Form\FormStateInterface;

/**
 * Provides a 'CopyrightBlock' block.
 *
 * @Block(
 *  id = "copyright_block",
 *  admin_label = @Translation("Copyright block"),
 * )
 */
class CopyrightBlock extends BlockBase {

  /**
   * {@inheritdoc}
   */
  public function blockForm($form, FormStateInterface $form_state) {
    $form['year'] = array(
      '#type' => 'number',
      '#title' => $this->t('Year'),
      '#description' => $this->t(''),
      '#default_value' => isset($this->configuration['year']) ? $this->configuration['year'] : '2016',
      '#weight' => '0',
    );

    $form['content'] = array(
      '#type' => 'textfield',
      '#title' => $this->t('Content'),
      '#description' => $this->t(''),
      '#default_value' => isset($this->configuration['content']) ? $this->configuration['content'] : '',
      '#weight' => '0',
    );

    return $form;
  }

  /**
   * {@inheritdoc}
   */
  public function blockValidate($form, FormStateInterface $form_state) {
    $year = $form_state->getValue('year');
    if ((int)$form_state->getValue('year') > (int)date('Y')) {
      //dpm($year, 'no valid');
      drupal_set_message('This year incorrect!', 'error');
      $form_state->setErrorByName('year', $this->t('This year incorrect!'));
    }
  }

  /**
   * {@inheritdoc}
   */
  public function blockSubmit($form, FormStateInterface $form_state) {
    $this->configuration['year'] = $form_state->getValue('year');
    $this->configuration['content'] = $form_state->getValue('content');
  }

  /**
   * {@inheritdoc}
   */
  public function build() {
    $year_str = !empty($this->configuration['year']) ? $this->configuration['year']: date('Y');
    $year = (int)$year_str;
    if($year < (int)date('Y')) {
      $year_str = $year . '-' . date('Y');
    }
    $build = [];
    $build['copyright_block_year']['#markup'] = '<span> &copy; ' . $this->configuration['content'] . ', ' .  $year_str. '</span>';

    return $build;
  }

}
