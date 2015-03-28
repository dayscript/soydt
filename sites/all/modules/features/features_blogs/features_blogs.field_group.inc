<?php
/**
 * @file
 * features_blogs.field_group.inc
 */

/**
 * Implements hook_field_group_info().
 */
function features_blogs_field_group_info() {
  $export = array();

  $field_group = new stdClass();
  $field_group->disabled = FALSE; /* Edit this to true to make a default field_group disabled initially */
  $field_group->api_version = 1;
  $field_group->identifier = 'group_datos_personales|user|user|form';
  $field_group->group_name = 'group_datos_personales';
  $field_group->entity_type = 'user';
  $field_group->bundle = 'user';
  $field_group->mode = 'form';
  $field_group->parent_name = 'group_registro';
  $field_group->data = array(
    'label' => 'Datos personales',
    'weight' => '5',
    'children' => array(
      0 => 'field_apellidos',
      1 => 'field_nombres',
      2 => 'field_sexo',
      3 => 'field_fecha_de_nacimiento',
      4 => 'field_departamento',
      5 => 'field_acepto',
      6 => 'field_cedula',
      7 => 'field_tel_fono_movil',
      8 => 'field_profesion',
    ),
    'format_type' => 'tab',
    'format_settings' => array(
      'label' => 'Datos personales',
      'instance_settings' => array(
        'required_fields' => 1,
        'id' => '',
        'classes' => 'group-datos-personales field-group-htab',
        'description' => '',
      ),
      'formatter' => 'closed',
    ),
  );
  $export['group_datos_personales|user|user|form'] = $field_group;

  $field_group = new stdClass();
  $field_group->disabled = FALSE; /* Edit this to true to make a default field_group disabled initially */
  $field_group->api_version = 1;
  $field_group->identifier = 'group_registro|user|user|form';
  $field_group->group_name = 'group_registro';
  $field_group->entity_type = 'user';
  $field_group->bundle = 'user';
  $field_group->mode = 'form';
  $field_group->parent_name = '';
  $field_group->data = array(
    'label' => 'Regístrate',
    'weight' => '0',
    'children' => array(
      0 => 'group_tu_cuenta',
      1 => 'group_datos_personales',
    ),
    'format_type' => 'tabs',
    'format_settings' => array(
      'label' => 'Regístrate',
      'instance_settings' => array(
        'classes' => 'group-registro field-group-htabs medium-16 small-16 columns',
      ),
    ),
  );
  $export['group_registro|user|user|form'] = $field_group;

  return $export;
}
