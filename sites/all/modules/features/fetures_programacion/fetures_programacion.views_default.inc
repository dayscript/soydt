<?php
/**
 * @file
 * fetures_programacion.views_default.inc
 */

/**
 * Implements hook_views_default_views().
 */
function fetures_programacion_views_default_views() {
  $export = array();

  $view = new view();
  $view->name = 'programacion_partidos';
  $view->description = '';
  $view->tag = 'default';
  $view->base_table = 'node';
  $view->human_name = 'Programación partidos';
  $view->core = 7;
  $view->api_version = '3.0';
  $view->disabled = FALSE; /* Edit this to true to make a default view disabled initially */

  /* Display: Master */
  $handler = $view->new_display('default', 'Master', 'default');
  $handler->display->display_options['title'] = 'Programación partidos';
  $handler->display->display_options['css_class'] = 'block-programacion';
  $handler->display->display_options['use_ajax'] = TRUE;
  $handler->display->display_options['use_more_always'] = FALSE;
  $handler->display->display_options['use_more_text'] = 'más';
  $handler->display->display_options['access']['type'] = 'perm';
  $handler->display->display_options['cache']['type'] = 'none';
  $handler->display->display_options['query']['type'] = 'views_query';
  $handler->display->display_options['exposed_form']['type'] = 'basic';
  $handler->display->display_options['exposed_form']['options']['submit_button'] = 'Aplicar';
  $handler->display->display_options['exposed_form']['options']['reset_button_label'] = 'Reiniciar';
  $handler->display->display_options['exposed_form']['options']['exposed_sorts_label'] = 'Ordenar por';
  $handler->display->display_options['exposed_form']['options']['autosubmit'] = TRUE;
  $handler->display->display_options['pager']['type'] = 'some';
  $handler->display->display_options['pager']['options']['items_per_page'] = '5';
  $handler->display->display_options['style_plugin'] = 'table';
  $handler->display->display_options['style_options']['columns'] = array(
    'field_equipo_1' => 'field_equipo_1',
    'field_equipo_2' => 'field_equipo_2',
    'field_escudo_equipo_1' => 'field_escudo_equipo_1',
    'field_escudo_equipo_2' => 'field_escudo_equipo_2',
    'field_canal_2' => 'field_canal_2',
    'nothing' => 'nothing',
    'field_fecha_1' => 'field_fecha_1',
    'field_canal_1' => 'field_canal_1',
    'field_torneo' => 'field_torneo',
  );
  $handler->display->display_options['style_options']['default'] = '-1';
  $handler->display->display_options['style_options']['info'] = array(
    'field_equipo_1' => array(
      'sortable' => 0,
      'default_sort_order' => 'asc',
      'align' => '',
      'separator' => '',
      'empty_column' => 0,
    ),
    'field_equipo_2' => array(
      'sortable' => 0,
      'default_sort_order' => 'asc',
      'align' => '',
      'separator' => '',
      'empty_column' => 0,
    ),
    'field_escudo_equipo_1' => array(
      'sortable' => 0,
      'default_sort_order' => 'asc',
      'align' => '',
      'separator' => '',
      'empty_column' => 0,
    ),
    'field_escudo_equipo_2' => array(
      'sortable' => 0,
      'default_sort_order' => 'asc',
      'align' => '',
      'separator' => '',
      'empty_column' => 0,
    ),
    'field_canal_2' => array(
      'sortable' => 0,
      'default_sort_order' => 'asc',
      'align' => '',
      'separator' => '',
      'empty_column' => 0,
    ),
    'nothing' => array(
      'align' => '',
      'separator' => '',
      'empty_column' => 0,
    ),
    'field_fecha_1' => array(
      'sortable' => 0,
      'default_sort_order' => 'asc',
      'align' => '',
      'separator' => '',
      'empty_column' => 0,
    ),
    'field_canal_1' => array(
      'sortable' => 0,
      'default_sort_order' => 'asc',
      'align' => '',
      'separator' => '',
      'empty_column' => 0,
    ),
    'field_torneo' => array(
      'sortable' => 0,
      'default_sort_order' => 'asc',
      'align' => '',
      'separator' => '',
      'empty_column' => 0,
    ),
  );
  /* Campo: Contenido: Equipo local */
  $handler->display->display_options['fields']['field_equipo_1']['id'] = 'field_equipo_1';
  $handler->display->display_options['fields']['field_equipo_1']['table'] = 'field_data_field_equipo_1';
  $handler->display->display_options['fields']['field_equipo_1']['field'] = 'field_equipo_1';
  $handler->display->display_options['fields']['field_equipo_1']['label'] = '';
  $handler->display->display_options['fields']['field_equipo_1']['exclude'] = TRUE;
  $handler->display->display_options['fields']['field_equipo_1']['element_label_colon'] = FALSE;
  $handler->display->display_options['fields']['field_equipo_1']['type'] = 'text_plain';
  /* Campo: Contenido: Equipo visitante */
  $handler->display->display_options['fields']['field_equipo_2']['id'] = 'field_equipo_2';
  $handler->display->display_options['fields']['field_equipo_2']['table'] = 'field_data_field_equipo_2';
  $handler->display->display_options['fields']['field_equipo_2']['field'] = 'field_equipo_2';
  $handler->display->display_options['fields']['field_equipo_2']['label'] = '';
  $handler->display->display_options['fields']['field_equipo_2']['exclude'] = TRUE;
  $handler->display->display_options['fields']['field_equipo_2']['element_label_colon'] = FALSE;
  $handler->display->display_options['fields']['field_equipo_2']['type'] = 'text_plain';
  /* Campo: Contenido: Escudo equipo local */
  $handler->display->display_options['fields']['field_escudo_equipo_1']['id'] = 'field_escudo_equipo_1';
  $handler->display->display_options['fields']['field_escudo_equipo_1']['table'] = 'field_data_field_escudo_equipo_1';
  $handler->display->display_options['fields']['field_escudo_equipo_1']['field'] = 'field_escudo_equipo_1';
  $handler->display->display_options['fields']['field_escudo_equipo_1']['label'] = '';
  $handler->display->display_options['fields']['field_escudo_equipo_1']['exclude'] = TRUE;
  $handler->display->display_options['fields']['field_escudo_equipo_1']['element_label_colon'] = FALSE;
  $handler->display->display_options['fields']['field_escudo_equipo_1']['type'] = 'text_plain';
  /* Campo: Contenido: Escudo equipo visitante */
  $handler->display->display_options['fields']['field_escudo_equipo_2']['id'] = 'field_escudo_equipo_2';
  $handler->display->display_options['fields']['field_escudo_equipo_2']['table'] = 'field_data_field_escudo_equipo_2';
  $handler->display->display_options['fields']['field_escudo_equipo_2']['field'] = 'field_escudo_equipo_2';
  $handler->display->display_options['fields']['field_escudo_equipo_2']['label'] = '';
  $handler->display->display_options['fields']['field_escudo_equipo_2']['exclude'] = TRUE;
  $handler->display->display_options['fields']['field_escudo_equipo_2']['element_label_colon'] = FALSE;
  $handler->display->display_options['fields']['field_escudo_equipo_2']['type'] = 'text_plain';
  /* Campo: Contenido: Canal 2 */
  $handler->display->display_options['fields']['field_canal_2']['id'] = 'field_canal_2';
  $handler->display->display_options['fields']['field_canal_2']['table'] = 'field_data_field_canal_2';
  $handler->display->display_options['fields']['field_canal_2']['field'] = 'field_canal_2';
  $handler->display->display_options['fields']['field_canal_2']['label'] = '';
  $handler->display->display_options['fields']['field_canal_2']['exclude'] = TRUE;
  $handler->display->display_options['fields']['field_canal_2']['element_label_colon'] = FALSE;
  $handler->display->display_options['fields']['field_canal_2']['type'] = 'text_plain';
  /* Campo: Global: Equipos */
  $handler->display->display_options['fields']['nothing']['id'] = 'nothing';
  $handler->display->display_options['fields']['nothing']['table'] = 'views';
  $handler->display->display_options['fields']['nothing']['field'] = 'nothing';
  $handler->display->display_options['fields']['nothing']['ui_name'] = 'Global: Equipos';
  $handler->display->display_options['fields']['nothing']['label'] = 'Equipos';
  $handler->display->display_options['fields']['nothing']['alter']['text'] = '<div class="row">
<div class="small-8 columns logo-equipos">
<img src="/sites/default/files/[field_escudo_equipo_1].png" href="50%" width="50%" />
<img src="/sites/default/files/[field_escudo_equipo_2].png" href="50%" width="50%" />
</div>
<div class="small-8  columns nombre-equipos">
<div>[field_equipo_1]</div>
<div>[field_equipo_2]</div>
</div>
</div>';
  $handler->display->display_options['fields']['nothing']['element_label_colon'] = FALSE;
  $handler->display->display_options['fields']['nothing']['element_wrapper_class'] = 'views-field-equipos';
  /* Campo: Contenido: Fecha */
  $handler->display->display_options['fields']['field_fecha_1']['id'] = 'field_fecha_1';
  $handler->display->display_options['fields']['field_fecha_1']['table'] = 'field_data_field_fecha';
  $handler->display->display_options['fields']['field_fecha_1']['field'] = 'field_fecha';
  $handler->display->display_options['fields']['field_fecha_1']['label'] = 'Hora';
  $handler->display->display_options['fields']['field_fecha_1']['element_label_colon'] = FALSE;
  $handler->display->display_options['fields']['field_fecha_1']['settings'] = array(
    'format_type' => 'hora_programacion',
    'fromto' => 'both',
    'multiple_number' => '',
    'multiple_from' => '',
    'multiple_to' => '',
  );
  /* Campo: Contenido: Canal 1 */
  $handler->display->display_options['fields']['field_canal_1']['id'] = 'field_canal_1';
  $handler->display->display_options['fields']['field_canal_1']['table'] = 'field_data_field_canal_1';
  $handler->display->display_options['fields']['field_canal_1']['field'] = 'field_canal_1';
  $handler->display->display_options['fields']['field_canal_1']['label'] = 'Canales';
  $handler->display->display_options['fields']['field_canal_1']['alter']['alter_text'] = TRUE;
  $handler->display->display_options['fields']['field_canal_1']['alter']['text'] = '<img src="/sites/default/files/[field_canal_1-value].png" />
<div>[field_canal_1-value]</div>';
  $handler->display->display_options['fields']['field_canal_1']['element_label_colon'] = FALSE;
  $handler->display->display_options['fields']['field_canal_1']['type'] = 'text_plain';
  /* Campo: Contenido: Torneo */
  $handler->display->display_options['fields']['field_torneo']['id'] = 'field_torneo';
  $handler->display->display_options['fields']['field_torneo']['table'] = 'field_data_field_torneo';
  $handler->display->display_options['fields']['field_torneo']['field'] = 'field_torneo';
  $handler->display->display_options['fields']['field_torneo']['label'] = '';
  $handler->display->display_options['fields']['field_torneo']['exclude'] = TRUE;
  $handler->display->display_options['fields']['field_torneo']['element_label_colon'] = FALSE;
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

  /* Display: Programación partidos */
  $handler = $view->new_display('block', 'Programación partidos', 'block');
  $handler->display->display_options['defaults']['filter_groups'] = FALSE;
  $handler->display->display_options['filter_groups']['operator'] = 'OR';
  $handler->display->display_options['defaults']['filters'] = FALSE;
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
    'programacion' => 'programacion',
  );
  $handler->display->display_options['filters']['type']['group'] = 1;
  /* Criterios de filtrado: Contenido: Torneo (field_torneo) */
  $handler->display->display_options['filters']['field_torneo_value']['id'] = 'field_torneo_value';
  $handler->display->display_options['filters']['field_torneo_value']['table'] = 'field_data_field_torneo';
  $handler->display->display_options['filters']['field_torneo_value']['field'] = 'field_torneo_value';
  $handler->display->display_options['filters']['field_torneo_value']['group'] = 1;
  $handler->display->display_options['filters']['field_torneo_value']['exposed'] = TRUE;
  $handler->display->display_options['filters']['field_torneo_value']['expose']['operator_id'] = 'field_torneo_value_op';
  $handler->display->display_options['filters']['field_torneo_value']['expose']['label'] = 'Torneo';
  $handler->display->display_options['filters']['field_torneo_value']['expose']['operator'] = 'field_torneo_value_op';
  $handler->display->display_options['filters']['field_torneo_value']['expose']['identifier'] = 'field_torneo_value';
  $handler->display->display_options['filters']['field_torneo_value']['expose']['remember_roles'] = array(
    2 => '2',
    1 => 0,
    3 => 0,
    4 => 0,
    5 => 0,
    6 => 0,
  );
  $handler->display->display_options['filters']['field_torneo_value']['group_info']['label'] = 'Torneo (field_torneo)';
  $handler->display->display_options['filters']['field_torneo_value']['group_info']['identifier'] = 'field_torneo_value';
  $handler->display->display_options['filters']['field_torneo_value']['group_info']['remember'] = FALSE;
  $handler->display->display_options['filters']['field_torneo_value']['group_info']['group_items'] = array(
    1 => array(),
    2 => array(),
    3 => array(),
  );
  $handler->display->display_options['block_description'] = 'Programación partidos';

  /* Display: Banner programación */
  $handler = $view->new_display('attachment', 'Banner programación', 'attachment_1');
  $handler->display->display_options['defaults']['title'] = FALSE;
  $handler->display->display_options['title'] = 'Adjunto Banner programación';
  $handler->display->display_options['defaults']['css_class'] = FALSE;
  $handler->display->display_options['css_class'] = 'block-banner';
  $handler->display->display_options['pager']['type'] = 'some';
  $handler->display->display_options['pager']['options']['items_per_page'] = '1';
  $handler->display->display_options['pager']['options']['offset'] = '0';
  $handler->display->display_options['defaults']['style_plugin'] = FALSE;
  $handler->display->display_options['style_plugin'] = 'default';
  $handler->display->display_options['defaults']['style_options'] = FALSE;
  $handler->display->display_options['defaults']['row_plugin'] = FALSE;
  $handler->display->display_options['row_plugin'] = 'fields';
  $handler->display->display_options['defaults']['row_options'] = FALSE;
  $handler->display->display_options['defaults']['fields'] = FALSE;
  /* Campo: Contenido: Imagen */
  $handler->display->display_options['fields']['field_image']['id'] = 'field_image';
  $handler->display->display_options['fields']['field_image']['table'] = 'field_data_field_image';
  $handler->display->display_options['fields']['field_image']['field'] = 'field_image';
  $handler->display->display_options['fields']['field_image']['label'] = '';
  $handler->display->display_options['fields']['field_image']['element_label_colon'] = FALSE;
  $handler->display->display_options['fields']['field_image']['click_sort_column'] = 'fid';
  $handler->display->display_options['fields']['field_image']['settings'] = array(
    'image_style' => 'banner_bloque_programacion_434x115',
    'image_link' => '',
  );
  $handler->display->display_options['defaults']['filter_groups'] = FALSE;
  $handler->display->display_options['defaults']['filters'] = FALSE;
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
    'banner_programacion' => 'banner_programacion',
  );
  $handler->display->display_options['displays'] = array(
    'block' => 'block',
    'default' => 0,
  );
  $handler->display->display_options['inherit_arguments'] = FALSE;
  $translatables['programacion_partidos'] = array(
    t('Master'),
    t('Programación partidos'),
    t('más'),
    t('Aplicar'),
    t('Reiniciar'),
    t('Ordenar por'),
    t('Asc'),
    t('Desc'),
    t('Equipos'),
    t('<div class="row">
<div class="small-8 columns logo-equipos">
<img src="/sites/default/files/[field_escudo_equipo_1].png" href="50%" width="50%" />
<img src="/sites/default/files/[field_escudo_equipo_2].png" href="50%" width="50%" />
</div>
<div class="small-8  columns nombre-equipos">
<div>[field_equipo_1]</div>
<div>[field_equipo_2]</div>
</div>
</div>'),
    t('Hora'),
    t('Canales'),
    t('<img src="/sites/default/files/[field_canal_1-value].png" />
<div>[field_canal_1-value]</div>'),
    t('Torneo'),
    t('Torneo (field_torneo)'),
    t('Banner programación'),
    t('Adjunto Banner programación'),
  );
  $export['programacion_partidos'] = $view;

  return $export;
}
