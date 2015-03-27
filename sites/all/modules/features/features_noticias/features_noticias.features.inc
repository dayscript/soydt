<?php
/**
 * @file
 * features_noticias.features.inc
 */

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
