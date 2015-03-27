<?php
/**
 * @file
 * features_noticias.features.field_base.inc
 */

/**
 * Implements hook_field_default_field_bases().
 */
function features_noticias_field_default_field_bases() {
  $field_bases = array();

  // Exported field_base: 'field_equipo_ideal'
  $field_bases['field_equipo_ideal'] = array(
    'active' => 1,
    'cardinality' => -1,
    'deleted' => 0,
    'entity_types' => array(),
    'field_name' => 'field_equipo_ideal',
    'indexes' => array(
      'value' => array(
        0 => 'value',
      ),
    ),
    'locked' => 0,
    'module' => 'list',
    'settings' => array(
      'allowed_values' => array(
        'equipo_ideal' => 'Noticia - equipo Ideal',
      ),
      'allowed_values_function' => '',
    ),
    'translatable' => 0,
    'type' => 'list_text',
  );

  return $field_bases;
}
