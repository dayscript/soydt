<?php
/**
 * @file
 * fetures_programacion.features.menu_links.inc
 */

/**
 * Implements hook_menu_default_menu_links().
 */
function fetures_programacion_menu_default_menu_links() {
  $menu_links = array();

  // Exported menu link: navigation_banner-programacin:node/add/banner-programacion
  $menu_links['navigation_banner-programacin:node/add/banner-programacion'] = array(
    'menu_name' => 'navigation',
    'link_path' => 'node/add/banner-programacion',
    'router_path' => 'node/add/banner-programacion',
    'link_title' => 'Banner programación',
    'options' => array(
      'identifier' => 'navigation_banner-programacin:node/add/banner-programacion',
    ),
    'module' => 'system',
    'hidden' => 0,
    'external' => 0,
    'has_children' => 0,
    'expanded' => 0,
    'weight' => 0,
    'customized' => 0,
    'parent_identifier' => 'navigation_agregar-contenido:node/add',
  );
  // Exported menu link: navigation_programacin:node/add/programacion
  $menu_links['navigation_programacin:node/add/programacion'] = array(
    'menu_name' => 'navigation',
    'link_path' => 'node/add/programacion',
    'router_path' => 'node/add/programacion',
    'link_title' => 'Programación',
    'options' => array(
      'identifier' => 'navigation_programacin:node/add/programacion',
    ),
    'module' => 'system',
    'hidden' => 0,
    'external' => 0,
    'has_children' => 0,
    'expanded' => 0,
    'weight' => 0,
    'customized' => 0,
    'parent_identifier' => 'navigation_agregar-contenido:node/add',
  );
  // Translatables
  // Included for use with string extractors like potx.
  t('Banner programación');
  t('Programación');


  return $menu_links;
}
