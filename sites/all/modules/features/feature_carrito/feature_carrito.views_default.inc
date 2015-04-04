<?php
/**
 * @file
 * feature_carrito.views_default.inc
 */

/**
 * Implements hook_views_default_views().
 */
function feature_carrito_views_default_views() {
  $export = array();

  $view = new view();
  $view->name = 'carrito';
  $view->description = 'Muestra el carrito de compras';
  $view->tag = 'default';
  $view->base_table = 'node';
  $view->human_name = 'Carrito';
  $view->core = 7;
  $view->api_version = '3.0';
  $view->disabled = FALSE; /* Edit this to true to make a default view disabled initially */

  /* Display: Master */
  $handler = $view->new_display('default', 'Master', 'default');
  $handler->display->display_options['title'] = 'Carrito de compras';
  $handler->display->display_options['use_more_always'] = FALSE;
  $handler->display->display_options['use_more_text'] = 'más';
  $handler->display->display_options['access']['type'] = 'perm';
  $handler->display->display_options['cache']['type'] = 'none';
  $handler->display->display_options['query']['type'] = 'views_query';
  $handler->display->display_options['exposed_form']['type'] = 'basic';
  $handler->display->display_options['exposed_form']['options']['submit_button'] = 'Aplicar';
  $handler->display->display_options['exposed_form']['options']['reset_button_label'] = 'Reiniciar';
  $handler->display->display_options['exposed_form']['options']['exposed_sorts_label'] = 'Ordenar por';
  $handler->display->display_options['pager']['type'] = 'none';
  $handler->display->display_options['pager']['options']['offset'] = '0';
  $handler->display->display_options['style_plugin'] = 'default';
  $handler->display->display_options['style_options']['row_class'] = 'columns small-16 cf';
  $handler->display->display_options['row_plugin'] = 'fields';
  /* Comportamiento si no hay resultados: Global: Texto sin filtrar */
  $handler->display->display_options['empty']['area_text_custom']['id'] = 'area_text_custom';
  $handler->display->display_options['empty']['area_text_custom']['table'] = 'views';
  $handler->display->display_options['empty']['area_text_custom']['field'] = 'area_text_custom';
  $handler->display->display_options['empty']['area_text_custom']['empty'] = TRUE;
  $handler->display->display_options['empty']['area_text_custom']['content'] = 'En este momento su carro de compras se encuentra vacío. Si desea comprar jugadores, vaya a la pantalla de fichajes, busque los jugadores, y agréguelos a su carro de compras. ';
  /* Relación: Referencia a entidades: Referenciando entidad */
  $handler->display->display_options['relationships']['reverse_field_jugadores_node']['id'] = 'reverse_field_jugadores_node';
  $handler->display->display_options['relationships']['reverse_field_jugadores_node']['table'] = 'node';
  $handler->display->display_options['relationships']['reverse_field_jugadores_node']['field'] = 'reverse_field_jugadores_node';
  $handler->display->display_options['relationships']['reverse_field_jugadores_node']['label'] = 'Carrito';
  /* Campo: Contenido: Nid */
  $handler->display->display_options['fields']['nid']['id'] = 'nid';
  $handler->display->display_options['fields']['nid']['table'] = 'node';
  $handler->display->display_options['fields']['nid']['field'] = 'nid';
  $handler->display->display_options['fields']['nid']['label'] = '';
  $handler->display->display_options['fields']['nid']['exclude'] = TRUE;
  $handler->display->display_options['fields']['nid']['element_label_colon'] = FALSE;
  /* Campo: Contenido: Imagen */
  $handler->display->display_options['fields']['field_image']['id'] = 'field_image';
  $handler->display->display_options['fields']['field_image']['table'] = 'field_data_field_image';
  $handler->display->display_options['fields']['field_image']['field'] = 'field_image';
  $handler->display->display_options['fields']['field_image']['label'] = '';
  $handler->display->display_options['fields']['field_image']['element_label_colon'] = FALSE;
  $handler->display->display_options['fields']['field_image']['element_wrapper_class'] = 'columns small-2';
  $handler->display->display_options['fields']['field_image']['click_sort_column'] = 'fid';
  $handler->display->display_options['fields']['field_image']['settings'] = array(
    'image_style' => 'escalar_y_recortar_a_74x100',
    'image_link' => 'content',
  );
  /* Campo: Contenido: Título */
  $handler->display->display_options['fields']['title']['id'] = 'title';
  $handler->display->display_options['fields']['title']['table'] = 'node';
  $handler->display->display_options['fields']['title']['field'] = 'title';
  $handler->display->display_options['fields']['title']['label'] = '';
  $handler->display->display_options['fields']['title']['alter']['word_boundary'] = FALSE;
  $handler->display->display_options['fields']['title']['alter']['ellipsis'] = FALSE;
  $handler->display->display_options['fields']['title']['element_label_colon'] = FALSE;
  $handler->display->display_options['fields']['title']['element_wrapper_class'] = 'columns small-4';
  /* Campo: Contenido: Posición */
  $handler->display->display_options['fields']['field_posicion']['id'] = 'field_posicion';
  $handler->display->display_options['fields']['field_posicion']['table'] = 'field_data_field_posicion';
  $handler->display->display_options['fields']['field_posicion']['field'] = 'field_posicion';
  $handler->display->display_options['fields']['field_posicion']['label'] = '';
  $handler->display->display_options['fields']['field_posicion']['element_label_colon'] = FALSE;
  $handler->display->display_options['fields']['field_posicion']['element_wrapper_class'] = 'text-orange columns small-3';
  $handler->display->display_options['fields']['field_posicion']['type'] = 'taxonomy_term_reference_plain';
  /* Campo: Contenido: Precio */
  $handler->display->display_options['fields']['field_precio']['id'] = 'field_precio';
  $handler->display->display_options['fields']['field_precio']['table'] = 'field_data_field_precio';
  $handler->display->display_options['fields']['field_precio']['field'] = 'field_precio';
  $handler->display->display_options['fields']['field_precio']['label'] = '';
  $handler->display->display_options['fields']['field_precio']['element_label_colon'] = FALSE;
  $handler->display->display_options['fields']['field_precio']['element_wrapper_class'] = 'text-blue columns small-3 text-right';
  $handler->display->display_options['fields']['field_precio']['settings'] = array(
    'thousand_separator' => '.',
    'prefix_suffix' => 1,
  );
  /* Campo: Global: Texto personalizado */
  $handler->display->display_options['fields']['nothing']['id'] = 'nothing';
  $handler->display->display_options['fields']['nothing']['table'] = 'views';
  $handler->display->display_options['fields']['nothing']['field'] = 'nothing';
  $handler->display->display_options['fields']['nothing']['label'] = '';
  $handler->display->display_options['fields']['nothing']['alter']['text'] = '<a href="#" data-reveal-id="delete-player" class="button alert tiny" data-reveal-ajax="/carrito/delete/[nid]">Eliminar del carrito</a>
<div id="delete-player" class="tiny reveal-modal" data-reveal data-options="close_on_background_click: false;\'" ></div>';
  $handler->display->display_options['fields']['nothing']['alter']['path'] = '/carrito/delete/';
  $handler->display->display_options['fields']['nothing']['element_label_colon'] = FALSE;
  $handler->display->display_options['fields']['nothing']['element_wrapper_class'] = 'columns small-4';
  /* Filtro contextual: Contenido: uid del autor */
  $handler->display->display_options['arguments']['uid']['id'] = 'uid';
  $handler->display->display_options['arguments']['uid']['table'] = 'node';
  $handler->display->display_options['arguments']['uid']['field'] = 'uid';
  $handler->display->display_options['arguments']['uid']['relationship'] = 'reverse_field_jugadores_node';
  $handler->display->display_options['arguments']['uid']['default_action'] = 'default';
  $handler->display->display_options['arguments']['uid']['exception']['title'] = 'Todo(s)';
  $handler->display->display_options['arguments']['uid']['default_argument_type'] = 'current_user';
  $handler->display->display_options['arguments']['uid']['summary']['number_of_records'] = '0';
  $handler->display->display_options['arguments']['uid']['summary']['format'] = 'default_summary';
  $handler->display->display_options['arguments']['uid']['summary_options']['items_per_page'] = '25';
  /* Criterios de filtrado: Contenido: Publicado */
  $handler->display->display_options['filters']['status']['id'] = 'status';
  $handler->display->display_options['filters']['status']['table'] = 'node';
  $handler->display->display_options['filters']['status']['field'] = 'status';
  $handler->display->display_options['filters']['status']['value'] = 1;
  $handler->display->display_options['filters']['status']['group'] = 1;
  $handler->display->display_options['filters']['status']['expose']['operator'] = FALSE;
  /* Criterios de filtrado: Contenido: Tipo */
  $handler->display->display_options['filters']['type']['id'] = 'type';
  $handler->display->display_options['filters']['type']['table'] = 'node';
  $handler->display->display_options['filters']['type']['field'] = 'type';
  $handler->display->display_options['filters']['type']['value'] = array(
    'jugador' => 'jugador',
  );

  /* Display: Carrito */
  $handler = $view->new_display('page', 'Carrito', 'page');
  $handler->display->display_options['display_description'] = 'Muestra el carrito de compras';
  $handler->display->display_options['path'] = 'jugar/carrito';
  $handler->display->display_options['menu']['type'] = 'normal';
  $handler->display->display_options['menu']['title'] = 'Carrito';
  $handler->display->display_options['menu']['weight'] = '0';
  $handler->display->display_options['menu']['name'] = 'menu-jugar';
  $handler->display->display_options['menu']['context'] = 0;
  $handler->display->display_options['menu']['context_only_inline'] = 0;

  /* Display: Mi Carrito */
  $handler = $view->new_display('block', 'Mi Carrito', 'carrito_resumen');
  $handler->display->display_options['defaults']['title'] = FALSE;
  $handler->display->display_options['title'] = 'Mi Carrito';
  $handler->display->display_options['defaults']['css_class'] = FALSE;
  $handler->display->display_options['css_class'] = 'cf';
  $handler->display->display_options['defaults']['footer'] = FALSE;
  /* Pie de página: Global: Área de texto */
  $handler->display->display_options['footer']['area']['id'] = 'area';
  $handler->display->display_options['footer']['area']['table'] = 'views';
  $handler->display->display_options['footer']['area']['field'] = 'area';
  $handler->display->display_options['footer']['area']['content'] = '<a href="/jugar/carrito" class="btn-blue fright" >Ir a comprar</a>';
  $handler->display->display_options['footer']['area']['format'] = 'filtered_html';
  $handler->display->display_options['defaults']['fields'] = FALSE;
  /* Campo: Contenido: Nid */
  $handler->display->display_options['fields']['nid']['id'] = 'nid';
  $handler->display->display_options['fields']['nid']['table'] = 'node';
  $handler->display->display_options['fields']['nid']['field'] = 'nid';
  $handler->display->display_options['fields']['nid']['label'] = '';
  $handler->display->display_options['fields']['nid']['exclude'] = TRUE;
  $handler->display->display_options['fields']['nid']['element_label_colon'] = FALSE;
  /* Campo: Contenido: Imagen */
  $handler->display->display_options['fields']['field_image']['id'] = 'field_image';
  $handler->display->display_options['fields']['field_image']['table'] = 'field_data_field_image';
  $handler->display->display_options['fields']['field_image']['field'] = 'field_image';
  $handler->display->display_options['fields']['field_image']['label'] = '';
  $handler->display->display_options['fields']['field_image']['element_label_colon'] = FALSE;
  $handler->display->display_options['fields']['field_image']['element_wrapper_class'] = 'columns small-2';
  $handler->display->display_options['fields']['field_image']['click_sort_column'] = 'fid';
  $handler->display->display_options['fields']['field_image']['settings'] = array(
    'image_style' => 'escalar_y_recortar_a_40x40',
    'image_link' => 'content',
  );
  /* Campo: Contenido: Título */
  $handler->display->display_options['fields']['title']['id'] = 'title';
  $handler->display->display_options['fields']['title']['table'] = 'node';
  $handler->display->display_options['fields']['title']['field'] = 'title';
  $handler->display->display_options['fields']['title']['label'] = '';
  $handler->display->display_options['fields']['title']['alter']['word_boundary'] = FALSE;
  $handler->display->display_options['fields']['title']['alter']['ellipsis'] = FALSE;
  $handler->display->display_options['fields']['title']['element_label_colon'] = FALSE;
  $handler->display->display_options['fields']['title']['element_wrapper_class'] = 'columns small-9';
  /* Campo: Contenido: Posición */
  $handler->display->display_options['fields']['field_posicion']['id'] = 'field_posicion';
  $handler->display->display_options['fields']['field_posicion']['table'] = 'field_data_field_posicion';
  $handler->display->display_options['fields']['field_posicion']['field'] = 'field_posicion';
  $handler->display->display_options['fields']['field_posicion']['label'] = '';
  $handler->display->display_options['fields']['field_posicion']['element_label_colon'] = FALSE;
  $handler->display->display_options['fields']['field_posicion']['element_wrapper_class'] = 'text-orange columns small-5';
  $handler->display->display_options['fields']['field_posicion']['type'] = 'taxonomy_term_reference_plain';
  /* Campo: Contenido: Precio */
  $handler->display->display_options['fields']['field_precio']['id'] = 'field_precio';
  $handler->display->display_options['fields']['field_precio']['table'] = 'field_data_field_precio';
  $handler->display->display_options['fields']['field_precio']['field'] = 'field_precio';
  $handler->display->display_options['fields']['field_precio']['label'] = '';
  $handler->display->display_options['fields']['field_precio']['exclude'] = TRUE;
  $handler->display->display_options['fields']['field_precio']['element_label_colon'] = FALSE;
  $handler->display->display_options['fields']['field_precio']['element_wrapper_class'] = 'text-blue columns small-3 text-right';
  $handler->display->display_options['fields']['field_precio']['settings'] = array(
    'thousand_separator' => '.',
    'prefix_suffix' => 1,
  );
  $translatables['carrito'] = array(
    t('Master'),
    t('Carrito de compras'),
    t('más'),
    t('Aplicar'),
    t('Reiniciar'),
    t('Ordenar por'),
    t('Asc'),
    t('Desc'),
    t('En este momento su carro de compras se encuentra vacío. Si desea comprar jugadores, vaya a la pantalla de fichajes, busque los jugadores, y agréguelos a su carro de compras. '),
    t('Carrito'),
    t('<a href="#" data-reveal-id="delete-player" class="button alert tiny" data-reveal-ajax="/carrito/delete/[nid]">Eliminar del carrito</a>
<div id="delete-player" class="tiny reveal-modal" data-reveal data-options="close_on_background_click: false;\'" ></div>'),
    t('Todo(s)'),
    t('Muestra el carrito de compras'),
    t('Mi Carrito'),
    t('<a href="/jugar/carrito" class="btn-blue fright" >Ir a comprar</a>'),
  );
  $export['carrito'] = $view;

  return $export;
}
