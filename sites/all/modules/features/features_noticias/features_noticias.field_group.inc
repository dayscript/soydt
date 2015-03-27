<?php
/**
 * @file
 * features_noticias.field_group.inc
 */

/**
 * Implements hook_field_group_info().
 */
function features_noticias_field_group_info() {
  $export = array();

  $field_group = new stdClass();
  $field_group->disabled = FALSE; /* Edit this to true to make a default field_group disabled initially */
  $field_group->api_version = 1;
  $field_group->identifier = 'group_derecha|node|article|teaser';
  $field_group->group_name = 'group_derecha';
  $field_group->entity_type = 'node';
  $field_group->bundle = 'article';
  $field_group->mode = 'teaser';
  $field_group->parent_name = '';
  $field_group->data = array(
    'label' => 'Derecha',
    'weight' => '1',
    'children' => array(
      0 => 'body',
      1 => 'field_subtitulo',
      2 => 'title',
      3 => 'post_date',
    ),
    'format_type' => 'div',
    'format_settings' => array(
      'label' => 'Derecha',
      'instance_settings' => array(
        'id' => '',
        'classes' => 'group-derecha field-group-div small-16 medium-12 columns',
        'description' => '',
        'show_label' => '0',
        'label_element' => 'h3',
        'effect' => 'none',
        'speed' => 'fast',
      ),
      'formatter' => 'open',
    ),
  );
  $export['group_derecha|node|article|teaser'] = $field_group;

  return $export;
}
