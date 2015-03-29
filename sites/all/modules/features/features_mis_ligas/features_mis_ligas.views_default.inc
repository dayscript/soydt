<?php
/**
 * @file
 * features_mis_ligas.views_default.inc
 */

/**
 * Implements hook_views_default_views().
 */
function features_mis_ligas_views_default_views() {
  $export = array();

  $view = new view();
  $view->name = 'ligas';
  $view->description = '';
  $view->tag = 'default';
  $view->base_table = 'node';
  $view->human_name = 'Ligas';
  $view->core = 7;
  $view->api_version = '3.0';
  $view->disabled = FALSE; /* Edit this to true to make a default view disabled initially */

  /* Display: Master */
  $handler = $view->new_display('default', 'Master', 'default');
  $handler->display->display_options['title'] = 'Ligas';
  $handler->display->display_options['use_more_always'] = FALSE;
  $handler->display->display_options['use_more_text'] = 'más';
  $handler->display->display_options['access']['type'] = 'perm';
  $handler->display->display_options['cache']['type'] = 'none';
  $handler->display->display_options['query']['type'] = 'views_query';
  $handler->display->display_options['exposed_form']['type'] = 'basic';
  $handler->display->display_options['exposed_form']['options']['submit_button'] = 'Aplicar';
  $handler->display->display_options['exposed_form']['options']['reset_button_label'] = 'Reiniciar';
  $handler->display->display_options['exposed_form']['options']['exposed_sorts_label'] = 'Ordenar por';
  $handler->display->display_options['pager']['type'] = 'some';
  $handler->display->display_options['pager']['options']['items_per_page'] = '5';
  $handler->display->display_options['style_plugin'] = 'table';
  $handler->display->display_options['style_options']['columns'] = array(
    'title' => 'title',
  );
  $handler->display->display_options['style_options']['default'] = '-1';
  $handler->display->display_options['style_options']['info'] = array(
    'title' => array(
      'sortable' => 0,
      'default_sort_order' => 'asc',
      'align' => '',
      'separator' => '',
      'empty_column' => 0,
    ),
  );
  /* Campo: Contenido: Nid */
  $handler->display->display_options['fields']['nid']['id'] = 'nid';
  $handler->display->display_options['fields']['nid']['table'] = 'node';
  $handler->display->display_options['fields']['nid']['field'] = 'nid';
  $handler->display->display_options['fields']['nid']['label'] = '';
  $handler->display->display_options['fields']['nid']['exclude'] = TRUE;
  $handler->display->display_options['fields']['nid']['element_label_colon'] = FALSE;
  /* Campo: Contenido: Id usuario logueado */
  $handler->display->display_options['fields']['user_id']['id'] = 'user_id';
  $handler->display->display_options['fields']['user_id']['table'] = 'node';
  $handler->display->display_options['fields']['user_id']['field'] = 'user_id';
  $handler->display->display_options['fields']['user_id']['label'] = '';
  $handler->display->display_options['fields']['user_id']['exclude'] = TRUE;
  $handler->display->display_options['fields']['user_id']['element_label_colon'] = FALSE;
  /* Campo: Contenido: Título */
  $handler->display->display_options['fields']['title']['id'] = 'title';
  $handler->display->display_options['fields']['title']['table'] = 'node';
  $handler->display->display_options['fields']['title']['field'] = 'title';
  $handler->display->display_options['fields']['title']['label'] = 'Equipo';
  $handler->display->display_options['fields']['title']['alter']['word_boundary'] = FALSE;
  $handler->display->display_options['fields']['title']['alter']['ellipsis'] = FALSE;
  $handler->display->display_options['fields']['title']['element_label_colon'] = FALSE;
  /* Campo: Contenido: Miembros */
  $handler->display->display_options['fields']['members']['id'] = 'members';
  $handler->display->display_options['fields']['members']['table'] = 'node';
  $handler->display->display_options['fields']['members']['field'] = 'members';
  /* Campo: Global: Abandonar */
  $handler->display->display_options['fields']['nothing']['id'] = 'nothing';
  $handler->display->display_options['fields']['nothing']['table'] = 'views';
  $handler->display->display_options['fields']['nothing']['field'] = 'nothing';
  $handler->display->display_options['fields']['nothing']['ui_name'] = 'Global: Abandonar';
  $handler->display->display_options['fields']['nothing']['label'] = '';
  $handler->display->display_options['fields']['nothing']['alter']['text'] = 'Abandonar';
  $handler->display->display_options['fields']['nothing']['alter']['make_link'] = TRUE;
  $handler->display->display_options['fields']['nothing']['alter']['path'] = 'league/unsubscribe/[nid]/[user_id]';
  $handler->display->display_options['fields']['nothing']['alter']['absolute'] = TRUE;
  $handler->display->display_options['fields']['nothing']['alter']['link_class'] = 'use-ajax';
  $handler->display->display_options['fields']['nothing']['element_label_colon'] = FALSE;
  /* Criterio de ordenación: Contenido: Fecha del envío */
  $handler->display->display_options['sorts']['created']['id'] = 'created';
  $handler->display->display_options['sorts']['created']['table'] = 'node';
  $handler->display->display_options['sorts']['created']['field'] = 'created';
  $handler->display->display_options['sorts']['created']['order'] = 'DESC';
  /* Filtro contextual: Contenido: miembros de la liga (field_league_members) */
  $handler->display->display_options['arguments']['field_league_members_target_id']['id'] = 'field_league_members_target_id';
  $handler->display->display_options['arguments']['field_league_members_target_id']['table'] = 'field_data_field_league_members';
  $handler->display->display_options['arguments']['field_league_members_target_id']['field'] = 'field_league_members_target_id';
  $handler->display->display_options['arguments']['field_league_members_target_id']['default_action'] = 'default';
  $handler->display->display_options['arguments']['field_league_members_target_id']['exception']['title'] = 'Todo(s)';
  $handler->display->display_options['arguments']['field_league_members_target_id']['default_argument_type'] = 'php';
  $handler->display->display_options['arguments']['field_league_members_target_id']['default_argument_options']['code'] = 'global $user;

return $user->uid;';
  $handler->display->display_options['arguments']['field_league_members_target_id']['summary']['number_of_records'] = '0';
  $handler->display->display_options['arguments']['field_league_members_target_id']['summary']['format'] = 'default_summary';
  $handler->display->display_options['arguments']['field_league_members_target_id']['summary_options']['items_per_page'] = '25';
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
    'mis_ligas' => 'mis_ligas',
  );

  /* Display: Block - Mis ligas */
  $handler = $view->new_display('block', 'Block - Mis ligas', 'block');
  $handler->display->display_options['defaults']['title'] = FALSE;
  $handler->display->display_options['title'] = 'Blocks - Mis Ligas';

  /* Display: Block - Ligas */
  $handler = $view->new_display('block', 'Block - Ligas', 'block_1');
  $handler->display->display_options['defaults']['title'] = FALSE;
  $handler->display->display_options['title'] = 'Todas las ligas';
  $handler->display->display_options['defaults']['relationships'] = FALSE;
  /* Relación: Contenido: Autor */
  $handler->display->display_options['relationships']['uid']['id'] = 'uid';
  $handler->display->display_options['relationships']['uid']['table'] = 'node';
  $handler->display->display_options['relationships']['uid']['field'] = 'uid';
  $handler->display->display_options['defaults']['fields'] = FALSE;
  /* Campo: Contenido: Nid */
  $handler->display->display_options['fields']['nid']['id'] = 'nid';
  $handler->display->display_options['fields']['nid']['table'] = 'node';
  $handler->display->display_options['fields']['nid']['field'] = 'nid';
  $handler->display->display_options['fields']['nid']['label'] = '';
  $handler->display->display_options['fields']['nid']['exclude'] = TRUE;
  $handler->display->display_options['fields']['nid']['element_label_colon'] = FALSE;
  /* Campo: Campo: Nombres */
  $handler->display->display_options['fields']['field_nombres']['id'] = 'field_nombres';
  $handler->display->display_options['fields']['field_nombres']['table'] = 'field_data_field_nombres';
  $handler->display->display_options['fields']['field_nombres']['field'] = 'field_nombres';
  $handler->display->display_options['fields']['field_nombres']['relationship'] = 'uid';
  $handler->display->display_options['fields']['field_nombres']['label'] = '';
  $handler->display->display_options['fields']['field_nombres']['exclude'] = TRUE;
  $handler->display->display_options['fields']['field_nombres']['element_label_colon'] = FALSE;
  /* Campo: Campo: Apellidos */
  $handler->display->display_options['fields']['field_apellidos']['id'] = 'field_apellidos';
  $handler->display->display_options['fields']['field_apellidos']['table'] = 'field_data_field_apellidos';
  $handler->display->display_options['fields']['field_apellidos']['field'] = 'field_apellidos';
  $handler->display->display_options['fields']['field_apellidos']['relationship'] = 'uid';
  $handler->display->display_options['fields']['field_apellidos']['label'] = '';
  $handler->display->display_options['fields']['field_apellidos']['exclude'] = TRUE;
  $handler->display->display_options['fields']['field_apellidos']['element_label_colon'] = FALSE;
  /* Campo: Contenido: Id usuario logueado */
  $handler->display->display_options['fields']['user_id']['id'] = 'user_id';
  $handler->display->display_options['fields']['user_id']['table'] = 'node';
  $handler->display->display_options['fields']['user_id']['field'] = 'user_id';
  $handler->display->display_options['fields']['user_id']['label'] = '';
  $handler->display->display_options['fields']['user_id']['exclude'] = TRUE;
  $handler->display->display_options['fields']['user_id']['element_label_colon'] = FALSE;
  /* Campo: Contenido: Título */
  $handler->display->display_options['fields']['title']['id'] = 'title';
  $handler->display->display_options['fields']['title']['table'] = 'node';
  $handler->display->display_options['fields']['title']['field'] = 'title';
  $handler->display->display_options['fields']['title']['label'] = 'Equipo';
  $handler->display->display_options['fields']['title']['alter']['word_boundary'] = FALSE;
  $handler->display->display_options['fields']['title']['alter']['ellipsis'] = FALSE;
  $handler->display->display_options['fields']['title']['element_label_colon'] = FALSE;
  $handler->display->display_options['fields']['title']['link_to_node'] = FALSE;
  /* Campo: Global: Texto personalizado */
  $handler->display->display_options['fields']['nothing_1']['id'] = 'nothing_1';
  $handler->display->display_options['fields']['nothing_1']['table'] = 'views';
  $handler->display->display_options['fields']['nothing_1']['field'] = 'nothing';
  $handler->display->display_options['fields']['nothing_1']['label'] = 'Creador';
  $handler->display->display_options['fields']['nothing_1']['alter']['text'] = '[field_nombres] [field_apellidos]';
  /* Campo: Contenido: Miembros */
  $handler->display->display_options['fields']['members']['id'] = 'members';
  $handler->display->display_options['fields']['members']['table'] = 'node';
  $handler->display->display_options['fields']['members']['field'] = 'members';
  /* Campo: Global: Abandonar */
  $handler->display->display_options['fields']['nothing']['id'] = 'nothing';
  $handler->display->display_options['fields']['nothing']['table'] = 'views';
  $handler->display->display_options['fields']['nothing']['field'] = 'nothing';
  $handler->display->display_options['fields']['nothing']['ui_name'] = 'Global: Abandonar';
  $handler->display->display_options['fields']['nothing']['label'] = '';
  $handler->display->display_options['fields']['nothing']['alter']['text'] = 'Unirse';
  $handler->display->display_options['fields']['nothing']['alter']['make_link'] = TRUE;
  $handler->display->display_options['fields']['nothing']['alter']['path'] = 'league/subscribe/[nid]/[user_id]';
  $handler->display->display_options['fields']['nothing']['alter']['absolute'] = TRUE;
  $handler->display->display_options['fields']['nothing']['alter']['link_class'] = 'use-ajax';
  $handler->display->display_options['fields']['nothing']['element_label_colon'] = FALSE;
  $handler->display->display_options['defaults']['arguments'] = FALSE;
  $translatables['ligas'] = array(
    t('Master'),
    t('Ligas'),
    t('más'),
    t('Aplicar'),
    t('Reiniciar'),
    t('Ordenar por'),
    t('Asc'),
    t('Desc'),
    t('Equipo'),
    t('Miembros'),
    t('Abandonar'),
    t('Todo(s)'),
    t('Block - Mis ligas'),
    t('Blocks - Mis Ligas'),
    t('Block - Ligas'),
    t('Todas las ligas'),
    t('autor'),
    t('Creador'),
    t('[field_nombres] [field_apellidos]'),
    t('Unirse'),
  );
  $export['ligas'] = $view;

  return $export;
}
