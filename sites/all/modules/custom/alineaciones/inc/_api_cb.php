<?php

function alineaciones_api_estadio_cb ($id) {
  $torneo_id = (int)$id;
  $data = alineaciones_data($torneo_id);

  //-----Datos del Torneo------
  $fecha_torneo = $data["alineacion"]->field_fecha_torneo[LANGUAGE_NONE][0]['target_id'];
  $fecha_activa = $_SESSION['fecha_activa']->nid;

  //-----Datos del Usuario------
  $capitan_usuario = $data["alineacion"]->field_capitan[LANGUAGE_NONE];

  // Array de id's de los nodos de los futbolistas que compró el usuario
  // TODO: ¿BUG? Este campo muestra 1 futbolista menos, revisar la funcion
  // carrito_get_equipo_usuario();
  $equipo_usuario = $data["equipo"]->field_jugadores2[LANGUAGE_NONE];

  // tid de la formación del usuario
  $formacion_usuario = $data["alineacion"]->field_formacion[LANGUAGE_NONE][0]['tid'];
  $puntos_usuario = $data['alineacion']->field_total[LANGUAGE_NONE][0]['value'];

  $alineacion_usuario_id = $data["alineacion"]->nid;
  $alineacion_usuario = '';
  $suplentes_usuario = $data["alineacion"]->field_suplentes[LANGUAGE_NONE];

  $data_filtered = array();

  // function _es_torneo_activo() {
  //   return $fecha_torneo === $fecha_activa;
  // }

  function _coords_posicion_px ($x = 0, $y = 0) {
    $p = array();
    $p['x'] = 230 + ($x - 1) * 64;
    $p['y'] = 55 + ($y - 1) * 28;

    return $p;
  }



  //-----Datos: Fecha de Juego------
  $i = 0;
  foreach ($data["fechas"] as $fecha) :
      $data_filtered['filtros']["fechas"][$i]['id'] = $fecha->nid;
      $data_filtered['filtros']["fechas"][$i]['nombre'] = $fecha->title;
      $i++;
      if( $fecha_activa == $fecha->nid ) break;
  endforeach;


  //-----Datos: Formaciones------
  $i = 0;
  foreach ($data["formaciones"] as $formacion) :
      $fid = $formacion->tid;

      $data_filtered['filtros']["formaciones"][$fid]['id'] = $fid;
      $data_filtered['filtros']["formaciones"][$fid]['nombre'] = $formacion->name;

      $posiciones = get_posiciones ($formacion->description);
      // kpr($f);
      $j = 0;
      foreach ( $posiciones as $f ) :
        $data_filtered['filtros']["formaciones"][$fid]['data'][$j]['tipo'] = $f['position'];
        $data_filtered['filtros']["formaciones"][$fid]['data'][$j]['coords'] = _coords_posicion_px ($f['x'], $f['y']);
        $j++;
      endforeach;

      if ($formacion_usuario == $formacion->tid)
        $formacion_activa = $posiciones;

      $i++;
  endforeach;



  //-----Datos: Alineacion del Usuario------
  $data_filtered['juego']['alineacion']['id'] = $alineacion_usuario_id;
  $alineados = array();
  $alineados_ids = array();

  $j = 0;
  for ($i=1; $i<=11; $i++):

    // Asignar las propiedades al array incluso si esta vacio
    // Para evitar que el array se desordene despues cuando se añadan las propiedades de tipo y coords.
    $data_filtered['juego']['formacion'][$j]['alineado'] = 0;
    $data_filtered['juego']['formacion'][$j]['alineado_id'] = 0;

    if ( isset($data["alineacion"]->{"field_jugador" . $i}[LANGUAGE_NONE]) ) :
      if ( $data["alineacion"]->{"field_jugador" . $i}[LANGUAGE_NONE][0]['target_id'] > 0 ) :
        $futbolista_id = $data["alineacion"]->{"field_jugador" . $i}[LANGUAGE_NONE][0]['target_id'];
        // array_push($alineados_ids, $futbolista_id);
        $alineados['p' . $i]['posicion'] = $i;
        $alineados['p' . $i]['id'] = $futbolista_id;
        array_push ($alineados_ids, $futbolista_id);

        // Este campo se expone en la formacion para validar despues si dicha posicion
        // Tiene ya un jugador asignado
        $data_filtered['juego']['formacion'][$j]['alineado'] = $i;
        $data_filtered['juego']['formacion'][$j]['alineado_id'] = $futbolista_id;

      endif;
    endif;

    $j++;

  endfor;


  //-----Datos: Suplentes------
  $i = 0;
  $suplentes = array();
  $suplentes_ids = array();
  if ( isset ($suplentes_usuario)) :
    foreach ($suplentes_usuario as $s) :
      $suplentes[$i]['futbolista_id'] = $s['target_id'];
      array_push ($suplentes_ids, $s['target_id']);
      $i++;
    endforeach;
  endif;


  //-----Datos: Futbolistas------
  $equipo_ids = array_merge ($alineados_ids, $suplentes_ids);

  // $equipo_ids = array();
  // foreach ($equipo_usuario as $futbolista) :
    // array_push($equipo_ids, $futbolista['target_id']);
  // endforeach;

  $equipo_nodes = node_load_multiple($equipo_ids);

  $i = 0;
  foreach ($equipo_nodes as $futbolista) :

      $futbolista_apellido = explode (" ", $futbolista->field_apellidos[LANGUAGE_NONE][0]['value']);
      $futbolista_apellido = $futbolista_apellido[0];

      $data_filtered["equipo"][$i]['id'] = $futbolista->nid;
      $data_filtered["equipo"][$i]['nombre'] = $futbolista->title;
      $data_filtered["equipo"][$i]['apellido'] = $futbolista_apellido ;
      $data_filtered["equipo"][$i]['equipo'] = $futbolista->field_equipo[LANGUAGE_NONE][0]['target_id'];
      $data_filtered["equipo"][$i]['posicion'] = $futbolista->field_posicion[LANGUAGE_NONE][0]['tid'];
      $i++;
  endforeach;


  //Temp: Guardar el array de jugadores alineados
  $data_filtered['juego']['alineacion']['alineados'] = $alineados;
  $data_filtered['juego']['alineacion']['suplentes'] = $suplentes;


  //-----Datos: Juego Actual------
  $data_filtered['juego']['capitan'] = ($capitan_usuario) ? $capitan_usuario[0]['target_id'] : '';
  $data_filtered['juego']['es_torneo_activo'] = (int)($fecha_torneo === $fecha_activa);
  $data_filtered['juego']['fecha_torneo'] = $fecha_torneo;
  $data_filtered['juego']['fecha_activa'] = $fecha_activa;
  $data_filtered['juego']['puntos'] = isset($puntos_usuario) ? $puntos_usuario : "0";
  $data_filtered['juego']['formacion_id'] = $formacion_usuario;


  $i = 0;
  foreach ($formacion_activa as $f) :
    // El tipo de posicion en la formacion determina si es 1:Arquero, 2:Defensa, 3:Volante, 4:Delantero
    $data_filtered['juego']['formacion'][$i]['tipo'] = $f['position'];
    $data_filtered['juego']['formacion'][$i]['coords'] = _coords_posicion_px ($f['x'], $f['y']);
    $i++;
  endforeach;

  // kpr($data); kpr($data_filtered['juego']['alineacion']['alineados']); kpr($data_filtered['juego']['formacion']); return;
  drupal_json_output($data_filtered);

}

?>