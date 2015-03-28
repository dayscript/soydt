<?php
/**
 * @file
 * features_blogs.views_default.inc
 */

/**
 * Implements hook_views_default_views().
 */
function features_blogs_views_default_views() {
  $export = array();

  $view = new view();
  $view->name = 'bogs_view';
  $view->description = '';
  $view->tag = 'default';
  $view->base_table = 'node';
  $view->human_name = 'Bog\'s view';
  $view->core = 7;
  $view->api_version = '3.0';
  $view->disabled = FALSE; /* Edit this to true to make a default view disabled initially */

  /* Display: Master */
  $handler = $view->new_display('default', 'Master', 'default');
  $handler->display->display_options['title'] = 'Blog\'s view';
  $handler->display->display_options['css_class'] = 'block-blog';
  $handler->display->display_options['use_more'] = TRUE;
  $handler->display->display_options['use_more_always'] = FALSE;
  $handler->display->display_options['use_more_text'] = 'Todos los blogs';
  $handler->display->display_options['access']['type'] = 'perm';
  $handler->display->display_options['cache']['type'] = 'none';
  $handler->display->display_options['query']['type'] = 'views_query';
  $handler->display->display_options['exposed_form']['type'] = 'basic';
  $handler->display->display_options['exposed_form']['options']['submit_button'] = 'Aplicar';
  $handler->display->display_options['exposed_form']['options']['reset_button_label'] = 'Reiniciar';
  $handler->display->display_options['exposed_form']['options']['exposed_sorts_label'] = 'Ordenar por';
  $handler->display->display_options['pager']['type'] = 'some';
  $handler->display->display_options['pager']['options']['items_per_page'] = '3';
  $handler->display->display_options['style_plugin'] = 'default';
  $handler->display->display_options['row_plugin'] = 'fields';
  /* Relación: Contenido: Autor */
  $handler->display->display_options['relationships']['uid']['id'] = 'uid';
  $handler->display->display_options['relationships']['uid']['table'] = 'node';
  $handler->display->display_options['relationships']['uid']['field'] = 'uid';
  /* Campo: Campo: Apellidos */
  $handler->display->display_options['fields']['field_apellidos']['id'] = 'field_apellidos';
  $handler->display->display_options['fields']['field_apellidos']['table'] = 'field_data_field_apellidos';
  $handler->display->display_options['fields']['field_apellidos']['field'] = 'field_apellidos';
  $handler->display->display_options['fields']['field_apellidos']['relationship'] = 'uid';
  $handler->display->display_options['fields']['field_apellidos']['label'] = '';
  $handler->display->display_options['fields']['field_apellidos']['exclude'] = TRUE;
  $handler->display->display_options['fields']['field_apellidos']['element_label_colon'] = FALSE;
  /* Campo: Campo: Nombres */
  $handler->display->display_options['fields']['field_nombres']['id'] = 'field_nombres';
  $handler->display->display_options['fields']['field_nombres']['table'] = 'field_data_field_nombres';
  $handler->display->display_options['fields']['field_nombres']['field'] = 'field_nombres';
  $handler->display->display_options['fields']['field_nombres']['relationship'] = 'uid';
  $handler->display->display_options['fields']['field_nombres']['label'] = '';
  $handler->display->display_options['fields']['field_nombres']['exclude'] = TRUE;
  $handler->display->display_options['fields']['field_nombres']['element_label_colon'] = FALSE;
  /* Campo: Usuario: Imagen */
  $handler->display->display_options['fields']['picture']['id'] = 'picture';
  $handler->display->display_options['fields']['picture']['table'] = 'users';
  $handler->display->display_options['fields']['picture']['field'] = 'picture';
  $handler->display->display_options['fields']['picture']['relationship'] = 'uid';
  $handler->display->display_options['fields']['picture']['label'] = '';
  $handler->display->display_options['fields']['picture']['exclude'] = TRUE;
  $handler->display->display_options['fields']['picture']['element_label_colon'] = FALSE;
  $handler->display->display_options['fields']['picture']['link_photo_to_profile'] = FALSE;
  $handler->display->display_options['fields']['picture']['image_style'] = 'imagen_del_perfil_128x168';
  /* Campo: Global: Nombre completo */
  $handler->display->display_options['fields']['nothing']['id'] = 'nothing';
  $handler->display->display_options['fields']['nothing']['table'] = 'views';
  $handler->display->display_options['fields']['nothing']['field'] = 'nothing';
  $handler->display->display_options['fields']['nothing']['ui_name'] = 'Global: Nombre completo';
  $handler->display->display_options['fields']['nothing']['label'] = '';
  $handler->display->display_options['fields']['nothing']['alter']['text'] = '[field_apellidos] [field_nombres]';
  $handler->display->display_options['fields']['nothing']['element_label_colon'] = FALSE;
  $handler->display->display_options['fields']['nothing']['element_wrapper_class'] = 'views-field-user-name';
  /* Campo: Usuario: Profesión */
  $handler->display->display_options['fields']['field_profesion']['id'] = 'field_profesion';
  $handler->display->display_options['fields']['field_profesion']['table'] = 'field_data_field_profesion';
  $handler->display->display_options['fields']['field_profesion']['field'] = 'field_profesion';
  $handler->display->display_options['fields']['field_profesion']['relationship'] = 'uid';
  $handler->display->display_options['fields']['field_profesion']['label'] = '';
  $handler->display->display_options['fields']['field_profesion']['element_label_colon'] = FALSE;
  /* Campo: Contenido: Título */
  $handler->display->display_options['fields']['title']['id'] = 'title';
  $handler->display->display_options['fields']['title']['table'] = 'node';
  $handler->display->display_options['fields']['title']['field'] = 'title';
  $handler->display->display_options['fields']['title']['label'] = '';
  $handler->display->display_options['fields']['title']['alter']['word_boundary'] = FALSE;
  $handler->display->display_options['fields']['title']['alter']['ellipsis'] = FALSE;
  /* Campo: Contenido: Descripción */
  $handler->display->display_options['fields']['body']['id'] = 'body';
  $handler->display->display_options['fields']['body']['table'] = 'field_data_body';
  $handler->display->display_options['fields']['body']['field'] = 'body';
  $handler->display->display_options['fields']['body']['label'] = '';
  $handler->display->display_options['fields']['body']['alter']['alter_text'] = TRUE;
  $handler->display->display_options['fields']['body']['alter']['max_length'] = '200';
  $handler->display->display_options['fields']['body']['alter']['trim'] = TRUE;
  $handler->display->display_options['fields']['body']['element_label_colon'] = FALSE;
  /* Criterio de ordenación: Contenido: Fecha del envío */
  $handler->display->display_options['sorts']['created']['id'] = 'created';
  $handler->display->display_options['sorts']['created']['table'] = 'node';
  $handler->display->display_options['sorts']['created']['field'] = 'created';
  $handler->display->display_options['sorts']['created']['order'] = 'DESC';
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
    'blog' => 'blog',
  );

  /* Display: Block - home */
  $handler = $view->new_display('block', 'Block - home', 'block');

  /* Display: Pages - blogs */
  $handler = $view->new_display('page', 'Pages - blogs', 'page_1');
  $handler->display->display_options['defaults']['pager'] = FALSE;
  $handler->display->display_options['pager']['type'] = 'full';
  $handler->display->display_options['pager']['options']['items_per_page'] = '0';
  $handler->display->display_options['pager']['options']['offset'] = '0';
  $handler->display->display_options['pager']['options']['id'] = '0';
  $handler->display->display_options['pager']['options']['quantity'] = '9';
  $handler->display->display_options['pager']['options']['expose']['items_per_page_label'] = 'Elementos por página';
  $handler->display->display_options['pager']['options']['expose']['items_per_page_options_all_label'] = '- Todos -';
  $handler->display->display_options['pager']['options']['expose']['offset_label'] = 'Desplazamiento';
  $handler->display->display_options['pager']['options']['tags']['first'] = '« primera';
  $handler->display->display_options['pager']['options']['tags']['previous'] = '‹ anterior';
  $handler->display->display_options['pager']['options']['tags']['next'] = 'siguiente ›';
  $handler->display->display_options['pager']['options']['tags']['last'] = 'última »';
  $handler->display->display_options['defaults']['fields'] = FALSE;
  /* Campo: Campo: Apellidos */
  $handler->display->display_options['fields']['field_apellidos']['id'] = 'field_apellidos';
  $handler->display->display_options['fields']['field_apellidos']['table'] = 'field_data_field_apellidos';
  $handler->display->display_options['fields']['field_apellidos']['field'] = 'field_apellidos';
  $handler->display->display_options['fields']['field_apellidos']['relationship'] = 'uid';
  $handler->display->display_options['fields']['field_apellidos']['label'] = '';
  $handler->display->display_options['fields']['field_apellidos']['exclude'] = TRUE;
  $handler->display->display_options['fields']['field_apellidos']['element_label_colon'] = FALSE;
  /* Campo: Campo: Nombres */
  $handler->display->display_options['fields']['field_nombres']['id'] = 'field_nombres';
  $handler->display->display_options['fields']['field_nombres']['table'] = 'field_data_field_nombres';
  $handler->display->display_options['fields']['field_nombres']['field'] = 'field_nombres';
  $handler->display->display_options['fields']['field_nombres']['relationship'] = 'uid';
  $handler->display->display_options['fields']['field_nombres']['label'] = '';
  $handler->display->display_options['fields']['field_nombres']['exclude'] = TRUE;
  $handler->display->display_options['fields']['field_nombres']['element_label_colon'] = FALSE;
  /* Campo: Usuario: Imagen */
  $handler->display->display_options['fields']['picture']['id'] = 'picture';
  $handler->display->display_options['fields']['picture']['table'] = 'users';
  $handler->display->display_options['fields']['picture']['field'] = 'picture';
  $handler->display->display_options['fields']['picture']['relationship'] = 'uid';
  $handler->display->display_options['fields']['picture']['label'] = '';
  $handler->display->display_options['fields']['picture']['exclude'] = TRUE;
  $handler->display->display_options['fields']['picture']['element_label_colon'] = FALSE;
  $handler->display->display_options['fields']['picture']['link_photo_to_profile'] = FALSE;
  $handler->display->display_options['fields']['picture']['image_style'] = 'imagen_del_perfil_128x168';
  /* Campo: Global: Nombre completo */
  $handler->display->display_options['fields']['nothing']['id'] = 'nothing';
  $handler->display->display_options['fields']['nothing']['table'] = 'views';
  $handler->display->display_options['fields']['nothing']['field'] = 'nothing';
  $handler->display->display_options['fields']['nothing']['ui_name'] = 'Global: Nombre completo';
  $handler->display->display_options['fields']['nothing']['label'] = '';
  $handler->display->display_options['fields']['nothing']['alter']['text'] = '[field_apellidos] [field_nombres]';
  $handler->display->display_options['fields']['nothing']['element_label_colon'] = FALSE;
  $handler->display->display_options['fields']['nothing']['element_wrapper_class'] = 'views-field-user-name';
  /* Campo: Usuario: Profesión */
  $handler->display->display_options['fields']['field_profesion']['id'] = 'field_profesion';
  $handler->display->display_options['fields']['field_profesion']['table'] = 'field_data_field_profesion';
  $handler->display->display_options['fields']['field_profesion']['field'] = 'field_profesion';
  $handler->display->display_options['fields']['field_profesion']['relationship'] = 'uid';
  $handler->display->display_options['fields']['field_profesion']['label'] = '';
  $handler->display->display_options['fields']['field_profesion']['element_label_colon'] = FALSE;
  /* Campo: Contenido: Título */
  $handler->display->display_options['fields']['title']['id'] = 'title';
  $handler->display->display_options['fields']['title']['table'] = 'node';
  $handler->display->display_options['fields']['title']['field'] = 'title';
  $handler->display->display_options['fields']['title']['label'] = '';
  $handler->display->display_options['fields']['title']['alter']['word_boundary'] = FALSE;
  $handler->display->display_options['fields']['title']['alter']['ellipsis'] = FALSE;
  /* Campo: Contenido: Descripción */
  $handler->display->display_options['fields']['body']['id'] = 'body';
  $handler->display->display_options['fields']['body']['table'] = 'field_data_body';
  $handler->display->display_options['fields']['body']['field'] = 'body';
  $handler->display->display_options['fields']['body']['label'] = '';
  $handler->display->display_options['fields']['body']['alter']['alter_text'] = TRUE;
  $handler->display->display_options['fields']['body']['alter']['max_length'] = '385';
  $handler->display->display_options['fields']['body']['alter']['trim'] = TRUE;
  $handler->display->display_options['fields']['body']['element_label_colon'] = FALSE;
  $handler->display->display_options['path'] = 'blog';
  $translatables['bogs_view'] = array(
    t('Master'),
    t('Blog\'s view'),
    t('Todos los blogs'),
    t('Aplicar'),
    t('Reiniciar'),
    t('Ordenar por'),
    t('Asc'),
    t('Desc'),
    t('autor'),
    t('[field_apellidos] [field_nombres]'),
    t('Block - home'),
    t('más'),
    t('Pages - blogs'),
    t('Elementos por página'),
    t('- Todos -'),
    t('Desplazamiento'),
    t('« primera'),
    t('‹ anterior'),
    t('siguiente ›'),
    t('última »'),
  );
  $export['bogs_view'] = $view;

  return $export;
}
