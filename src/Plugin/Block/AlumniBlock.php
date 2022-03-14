<?php

namespace Drupal\alumni_block\Plugin\Block;

use Drupal\Core\Block\BlockBase;
use Drupal\Core\Form\FormStateInterface;

/**
 * Provides a 'Hello' Block.
 *
 * @Block(
 *   id = "alumni_block",
 *   admin_label = @Translation("Alumni block"),
 * )
 */
class AlumniBlock extends BlockBase {

  /**
   * {@inheritdoc}
   */
  public function blockForm($form, FormStateInterface $form_state) {
    $form = parent::blockForm($form, $form_state);

    $config = $this->getConfiguration();

    $form['alumni_block_text'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Text'),
      '#default_value' => $config['alumni_block_text'] ?? '',
    ];
    $form['alumni_block_link'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Link'),
      '#default_value' => $config['alumni_block_link'] ?? '',
    ];
    return $form;
  }

  /**
   * {@inheritdoc}
   */
  public function blockSubmit($form, FormStateInterface $form_state) {
    parent::blockSubmit($form, $form_state);
    $values = $form_state->getValues();
    $this->configuration['alumni_block_text'] = $values['alumni_block_text'];
    $this->configuration['alumni_block_link'] = $values['alumni_block_link'];
  }

  /**
   * {@inheritdoc}
   */
  public function build() {
    $config = $this->getConfiguration();

    if (!empty($config['alumni_block_text'])) {
      $text = $config['alumni_block_text'];
      $link = $config['alumni_block_link'];
    }
    else {
      $text = $this->t('');
      $link = $this->t('');
    }

    return [
      '#theme' => 'alumni_block',
      '#data' => ['text' => $text, 'link' => $link],
    ];
  }
}