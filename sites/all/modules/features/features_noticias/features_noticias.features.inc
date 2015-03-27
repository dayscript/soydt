<?php
/**
 * @file
 * features_noticias.features.inc
 */

/**
 * Implements hook_ctools_plugin_api().
 */
function features_noticias_ctools_plugin_api($module = NULL, $api = NULL) {
  if ($module == "field_group" && $api == "field_group") {
    return array("version" => "1");
  }
}

/**
 * Implements hook_views_api().
 */
function features_noticias_views_api($module = NULL, $api = NULL) {
  return array("api" => "3.0");
}

/**
 * Implements hook_image_default_styles().
 */
function features_noticias_image_default_styles() {
  $styles = array();

  // Exported image style: equipo_ideal_753x451.
  $styles['equipo_ideal_753x451'] = array(
    'label' => 'Equipo Ideal (753x451)',
    'effects' => array(
      18 => array(
        'name' => 'image_scale_and_crop',
        'data' => array(
          'width' => 753,
          'height' => 451,
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
function features_noticias_node_info() {
  $items = array(
    'article' => array(
      'name' => t('Noticia'),
      'base' => 'node_content',
      'description' => t('Noticias sobre el juego y el torneo.'),
      'has_title' => '1',
      'title_label' => t('Título'),
      'help' => '',
    ),
  );
  drupal_alter('node_info', $items);
  return $items;
}
