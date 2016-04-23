<?php
/**
 * Created by PhpStorm.
 * User: lex
 * Date: 23.04.16
 * Time: 4:56
 */


function copyright_block_config_form() {
  $form = array();
  $conf = variable_get('copyright_block_conf', NULL);
  $form['copyright_block_conf'] = array(
    '#type' => 'container',
    '#title' => t('Copyright'),
    '#tree' => TRUE,
  );
  $form['copyright_block_conf']['description'] = array(
    '#type' => 'textfield',
    '#title' => t('Copyright text'),
    '#default_value' => isset($conf['description'])? $conf['description']: '',
    //'#description' => ''
  );
  // Year of birth site
  $form['copyright_block_conf']['birth_year'] = array(
    '#type' => 'textfield',
    '#title' => t('Year of birth site'),

    '#default_value' => isset($conf['birth_year']) ? $conf['birth_year']: '2000',
    //'#description' => ''
  );
  return system_settings_form($form);
}
