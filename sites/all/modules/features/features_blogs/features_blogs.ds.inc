<?php
/**
 * @file
 * features_blogs.ds.inc
 */

/**
 * Implements hook_ds_layout_settings_info().
 */
function features_blogs_ds_layout_settings_info() {
  $export = array();

  $ds_layout = new stdClass();
  $ds_layout->api_version = 1;
  $ds_layout->id = 'user|user|form';
  $ds_layout->entity_type = 'user';
  $ds_layout->bundle = 'user';
  $ds_layout->view_mode = 'form';
  $ds_layout->layout = 'ds_1col';
  $ds_layout->settings = array(
    'regions' => array(
      'ds_content' => array(
        0 => 'account',
        1 => 'field_nombres',
        2 => 'field_apellidos',
        3 => 'field_cedula',
        4 => 'field_departamento',
        5 => 'field_tel_fono_movil',
        6 => 'field_sexo',
        7 => 'field_equipo_favorito',
        8 => 'field_fecha_de_nacimiento',
        9 => 'field_profesion',
        10 => 'field_acepto',
      ),
      'ds_hidden' => array(
        11 => 'timezone',
        12 => 'ckeditor',
      ),
      'hidden' => array(
        13 => 'googleanalytics',
        14 => 'locale',
        15 => 'picture',
        16 => 'redirect',
        17 => 'field_saldo',
        18 => 'metatags',
        19 => '_add_existing_field',
      ),
    ),
    'fields' => array(
      'account' => 'ds_content',
      'field_nombres' => 'ds_content',
      'field_apellidos' => 'ds_content',
      'field_cedula' => 'ds_content',
      'field_departamento' => 'ds_content',
      'field_tel_fono_movil' => 'ds_content',
      'field_sexo' => 'ds_content',
      'field_equipo_favorito' => 'ds_content',
      'field_fecha_de_nacimiento' => 'ds_content',
      'field_profesion' => 'ds_content',
      'field_acepto' => 'ds_content',
      'timezone' => 'ds_hidden',
      'ckeditor' => 'ds_hidden',
      'googleanalytics' => 'hidden',
      'locale' => 'hidden',
      'picture' => 'hidden',
      'redirect' => 'hidden',
      'field_saldo' => 'hidden',
      'metatags' => 'hidden',
      '_add_existing_field' => 'hidden',
    ),
    'classes' => array(),
    'wrappers' => array(
      'ds_content' => 'div',
      'ds_hidden' => 'div',
    ),
    'layout_wrapper' => 'div',
    'layout_attributes' => '',
    'layout_attributes_merge' => 1,
    'layout_link_attribute' => '',
    'layout_link_custom' => '',
  );
  $export['user|user|form'] = $ds_layout;

  return $export;
}
