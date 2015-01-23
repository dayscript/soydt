<?php
/**
 * @file
 * Provide views data and handlers for views_block_area.module
 */

/**
 * Implements hook_views_data_alter().
 */
function fichajes_views_data_alter(&$data) {
	//dpm($data);
    $data['search_api_index_fichajes']['imagen_jugador'] = array(
		'title' => 'Imagen Jugador',
		'help' => 'Imagen del jugador',
		'field' => array(
			'handler' => 'fichajes_handler_field_imagen_jugador',
		),
	); 
	$data['search_api_index_fichajes']['posicion_jugador'] = array(
		'title' => 'Posición del Jugador',
		'help' => 'Posición del jugador',
		'field' => array(
			'handler' => 'fichajes_handler_field_posicion_jugador',
		),
	); 
	$data['search_api_index_fichajes']['anadir_al_carro'] = array(
		'title' => 'Añadir al Carrito',
		'help' => 'Añadir jugador al carrito',
		'field' => array(
			'handler' => 'fichajes_handler_field_anadir_al_carro',
		),
	); 
	$data['search_api_index_ligas_index']['unirse'] = array(
		'title' => 'Boton Unirse',
		'help' => 'unise a la liga',
		'field' => array(
			'handler' => 'fichajes_handler_field_unirse',
		),
	);
	$data['search_api_index_ligas_index']['ver_liga'] = array(
		'title' => 'Ver Liga',
		'help' => 'ver la liga',
		'field' => array(
			'handler' => 'fichajes_handler_field_ver_liga',
		),
	);
	$data['node']['puntos_usuario'] = array(
		'title' => 'Puntos usuario',
		'help' => 'puntos del usuario por liga',
		'field' => array(
			'handler' => 'fichajes_handler_field_puntos_usuario',
		),
	);
}