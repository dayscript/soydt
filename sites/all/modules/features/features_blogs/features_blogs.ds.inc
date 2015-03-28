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
        0 => 'group_registro',
        2 => 'field_nombres',
        4 => 'field_apellidos',
        5 => 'field_cedula',
        6 => 'group_tu_cuenta',
        9 => 'field_sexo',
        10 => 'group_datos_personales',
        12 => 'field_tel_fono_movil',
        14 => 'field_departamento',
        15 => 'field_profesion',
        17 => 'field_equipo_favorito',
        18 => 'field_fecha_de_nacimiento',
        19 => 'account',
        21 => 'field_acepto',
      ),
      'ds_hidden' => array(
        1 => 'timezone',
        3 => 'ckeditor',
      ),
      'hidden' => array(
        7 => 'googleanalytics',
        8 => 'locale',
        11 => 'picture',
        13 => 'redirect',
        16 => 'field_saldo',
        20 => 'metatags',
        22 => '_add_existing_field',
      ),
    ),
    'fields' => array(
      'group_registro' => 'ds_content',
      'timezone' => 'ds_hidden',
      'field_nombres' => 'ds_content',
      'ckeditor' => 'ds_hidden',
      'field_apellidos' => 'ds_content',
      'field_cedula' => 'ds_content',
      'group_tu_cuenta' => 'ds_content',
      'googleanalytics' => 'hidden',
      'locale' => 'hidden',
      'field_sexo' => 'ds_content',
      'group_datos_personales' => 'ds_content',
      'picture' => 'hidden',
      'field_tel_fono_movil' => 'ds_content',
      'redirect' => 'hidden',
      'field_departamento' => 'ds_content',
      'field_profesion' => 'ds_content',
      'field_saldo' => 'hidden',
      'field_equipo_favorito' => 'ds_content',
      'field_fecha_de_nacimiento' => 'ds_content',
      'account' => 'ds_content',
      'metatags' => 'hidden',
      'field_acepto' => 'ds_content',
      '_add_existing_field' => 'hidden',
    ),
    'classes' => array(
      'layout_class' => array(
        'row' => 'row',
      ),
    ),
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
