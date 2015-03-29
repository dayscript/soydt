<?php
/**
 * @file
 * features_mis_ligas.features.inc
 */

/**
 * Implements hook_views_api().
 */
function features_mis_ligas_views_api($module = NULL, $api = NULL) {
  return array("api" => "3.0");
}

/**
 * Implements hook_node_info().
 */
function features_mis_ligas_node_info() {
  $items = array(
    'mis_ligas' => array(
      'name' => t('Mis Ligas'),
      'base' => 'node_content',
      'description' => t('Ligas creadas por los usuarios'),
      'has_title' => '1',
      'title_label' => t('Title'),
      'help' => '',
    ),
  );
  drupal_alter('node_info', $items);
  return $items;
}
