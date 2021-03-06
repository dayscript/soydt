<?php
/**
 * @file
 * features_blogs.features.inc
 */

/**
 * Implements hook_ctools_plugin_api().
 */
function features_blogs_ctools_plugin_api($module = NULL, $api = NULL) {
  if ($module == "ds" && $api == "ds") {
    return array("version" => "1");
  }
  if ($module == "field_group" && $api == "field_group") {
    return array("version" => "1");
  }
}

/**
 * Implements hook_views_api().
 */
function features_blogs_views_api($module = NULL, $api = NULL) {
  return array("api" => "3.0");
}

/**
 * Implements hook_image_default_styles().
 */
function features_blogs_image_default_styles() {
  $styles = array();

  // Exported image style: imagen_del_perfil_128x168.
  $styles['imagen_del_perfil_128x168'] = array(
    'label' => 'Imagen del perfil (128x168)',
    'effects' => array(
      17 => array(
        'name' => 'image_scale_and_crop',
        'data' => array(
          'width' => 128,
          'height' => 168,
        ),
        'weight' => 1,
      ),
    ),
  );

  return $styles;
}
