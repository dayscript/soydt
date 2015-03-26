<?php
/**
 * @file
 * fetures_programacion.features.inc
 */

/**
 * Implements hook_views_api().
 */
function fetures_programacion_views_api($module = NULL, $api = NULL) {
  return array("api" => "3.0");
}

/**
 * Implements hook_image_default_styles().
 */
function fetures_programacion_image_default_styles() {
  $styles = array();

  // Exported image style: banner_bloque_programacion_434x115.
  $styles['banner_bloque_programacion_434x115'] = array(
    'label' => 'Banner bloque programacion (434x115)',
    'effects' => array(
      16 => array(
        'name' => 'image_scale_and_crop',
        'data' => array(
          'width' => 434,
          'height' => 115,
        ),
        'weight' => 1,
      ),
    ),
  );

  return $styles;
}

/**
 * Implements hook_node_info().
 */
function fetures_programacion_node_info() {
  $items = array(
    'banner_programacion' => array(
      'name' => t('Banner programación'),
      'base' => 'node_content',
      'description' => '',
      'has_title' => '1',
      'title_label' => t('Title'),
      'help' => '',
    ),
    'programacion' => array(
      'name' => t('Programación'),
      'base' => 'node_content',
      'description' => '',
      'has_title' => '1',
      'title_label' => t('Title'),
      'help' => '',
    ),
  );
  drupal_alter('node_info', $items);
  return $items;
}
