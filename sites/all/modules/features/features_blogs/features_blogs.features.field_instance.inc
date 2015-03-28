<?php
/**
 * @file
 * features_blogs.features.field_instance.inc
 */

/**
 * Implements hook_field_default_field_instances().
 */
function features_blogs_field_default_field_instances() {
  $field_instances = array();

  // Exported field_instance: 'user-user-field_profesion'
  $field_instances['user-user-field_profesion'] = array(
    'bundle' => 'user',
    'default_value' => NULL,
    'deleted' => 0,
    'description' => '',
    'display' => array(
      'default' => array(
        'label' => 'above',
        'module' => 'text',
        'settings' => array(),
        'type' => 'text_default',
        'weight' => 13,
      ),
    ),
    'ds_extras_field_template' => '',
    'entity_type' => 'user',
    'field_name' => 'field_profesion',
    'label' => 'Profesión',
    'required' => 0,
    'settings' => array(
      'text_processing' => 0,
      'user_register_form' => 0,
    ),
    'widget' => array(
      'active' => 1,
      'module' => 'text',
      'settings' => array(
        'size' => 60,
      ),
      'type' => 'text_textfield',
      'weight' => 8,
    ),
  );

  // Translatables
  // Included for use with string extractors like potx.
  t('Profesión');

  return $field_instances;
}
