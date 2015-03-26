<?php
/**
 * Module Alineaciones: callbacks hook_menu
 */


/**
 * Esta funcion solo se usa como un contenedor vacio
 * para generar la url '/jugar/alineaciones' donde luego
 * se posicionará el bloque de drupal con el contenido de la sección
 */
function alineaciones_page_cb (){
  return '';
}


/**
* Cambia la formacion
*/
function alineaciones_cambio_formacion ($alineacion_nid, $formacion_tid){
  $ali = node_load($alineacion_nid);
  $term = taxonomy_term_load($formacion_tid);
  $posiciones = get_posiciones($term->description);
  $ali->field_formacion['und'][0]['tid'] = $formacion_tid;
  node_save($ali);
  for($i=1;$i<=11;$i++) {
    if (isset($ali->{"field_jugador" . $i}['und']) && $ali->{"field_jugador" . $i}['und'][0]['target_id'] >0) {
      $pl = node_load($ali->{"field_jugador" . $i}['und'][0]['target_id']);
      if(intval($pl->field_posicion['und'][0]['tid']) != intval($posiciones[$i]["position"])){
        alineaciones_desalinear_jugador($ali->nid, $pl->nid);
        //$ali->{"field_jugador" . $i}['und'][0]['target_id'] = 0;
      }
    }
  }
  $resultado = 'OK';

  //-----Resultado------
  $m = array();
  if ($resultado == "OK") {
    $m['status'] = 'success';
    $m['text'] = 'Se cambió la formación para esta fecha.';
  } else {
    $m['status'] = 'error';
    $m['text'] = 'Ha ocurrido un error';
  }

  drupal_json_output($m);
}


/**
* Cambia el capitan
*/
function alineaciones_cambio_capitan ($alineacion_nid, $capitan_nid){
  $ali = node_load($alineacion_nid);
  $ali->field_capitan['und'][0]['target_id'] = $capitan_nid;
  node_save($ali);
  $resultado = "OK";

  //-----Resultado------
  $m = array();
  if ($resultado == "OK") {
    $m['status'] = 'success';
    $m['text'] = 'Se cambió el capitán para esta fecha.';
  } else {
    $m['status'] = 'error';
    $m['text'] = 'Ha ocurrido un error.';
  }

  drupal_json_output($m);
}


/**
* Alinear jugador
*/
function alineaciones_alinear_jugador ($alineacion_nid,$position, $playerid){
  $position = str_replace("place","",$position);
  $ali = node_load($alineacion_nid);
  $prev = 0;
  for($i=1;$i<=11;$i++){
    if(isset($ali->{"field_jugador".$i}['und']) && $ali->{"field_jugador".$i}['und'][0]['target_id']==$playerid) {
      $prev = $i;
      $ali->{"field_jugador".$i}['und'][0]['target_id'] = 0;
    }
  }
  if(isset($ali->{"field_jugador".$position}['und']) && $ali->{"field_jugador".$position}['und'][0]['target_id'] >0){
      $pl = node_load($ali->{"field_jugador".$position}['und'][0]['target_id']);
      $player = node_load($playerid);
      if($pl->field_posicion['und'][0]['tid'] == $player->field_posicion['und'][0]['tid'] && $prev){
        $ali->{"field_jugador".$prev}['und'][0]['target_id'] = $pl->nid;
        $ali->{"field_jugador".$position}['und'][0]['target_id'] = $player->nid;
        node_save($ali);
        return "CAMBIO";
      }
      $ali->{"field_jugador".$position}['und'][0]['target_id'] = $player->nid;
      $ali->field_suplentes['und'][] = array('target_id'=>$pl->nid);
      $ali = borrarSuplente($ali,$playerid);
      node_save($ali);
      return "REEMPLAZO";
  }

    $ali->{"field_jugador".$position}['und'][0]['target_id'] = $playerid;
    $ali = borrarSuplente($ali,$playerid);
    node_save($ali);
    return "OK";
}


/**
 * Detalle de jugador
 */
function alineaciones_jugador_detalle ($playerid){
  $data = array();
  $playerid = str_replace("info","",$playerid);
  $playerid = str_replace("3info","",$playerid);
  $playerid = str_replace("info","",$playerid);
  $player = node_load($playerid);
  $title = array(
    '#prefix' => '<div class="title">',
    '#suffix' => '</div>',
    '#markup'=>'<h2>' . $player->title . '</h2>'
    );
  $position = array(
    '#prefix' => '<div class="position text-orange">',
    '#suffix' => '</div>',
    '#markup'=> taxonomy_term_load($player->field_posicion['und'][0]['tid'])->name
    );
  $close = array(
    '#prefix' => '<div class="small-1 right">',
    '#suffix' => '</div>',
    '#markup'=>'<a class="close-reveal-modal">&#215;</a>'
    );
  $image = array(
    '#prefix' => '<div class="small-16 image">',
    '#theme' => 'image_style',
    '#path' => $player->field_image['und'][0]['uri'],
    '#style_name' => 'escalar_y_recortar_a_a127x170',
    '#alt' => $player->title,
    '#title' => $player->title,
    '#suffix' => '</div>',
    );
  $team = node_view(node_load($player->field_equipo['und'][0]['target_id']),'teaser');
  $team['#prefix'] = '<div class="left team">';
  $team['#suffix'] = '</div>';
  $points_html = views_embed_view('jugadores', 'block', $playerid);
  // dpm($points);
  $data["col1"] = array(
    '#prefix' => '<div class="columns small-6 col1">',
    '#suffix' => '</div>',
    'content' => array(
      $image,
      $team
      )

    );
  $data["col2"] = array(
    '#prefix' => '<div class="columns small-10 col2">',
    '#suffix' => '</div>',
    'content' => array(
      $title,
      $position,
      array('#markup'=>$points_html)
      )
    );
  $data["col3"] = $close;
  return $data;
}


/**
* Desalinear jugador
*/
function alineaciones_desalinear_jugador ($alineacion_nid, $playerid, $sell = false){
  $playerid = str_replace("drop","",$playerid);
  $ali = node_load($alineacion_nid);


  for($i=1;$i<=11;$i++){
    if (isset($ali->{"field_jugador".$i}['und'])
      && $ali->{"field_jugador".$i}['und'][0]['target_id'] == $playerid) {
      $ali->{"field_jugador".$i}['und'][0]['target_id'] = 0;
      if (!$sell) $ali->field_suplentes['und'][] = array('target_id'=>$playerid);
      $resultado = 'OK';
    }
  }
    if($sell)borrarSuplente($ali,$playerid);
    node_save($ali);
   // $resultado = "NO EXISTE";
  if (!$sell) {
    //-----Resultado------
    $m = array();
    if ($resultado == "OK") {
      $m['status'] = 'success';
      $m['text'] = 'Jugador desalineado correctamente. Ha sido enviado al banquillo.';
    }
    else {
      $m['status'] = 'error';
      $m['text'] = 'Este jugador ya se encuentra en el banquillo de suplentes.';
    }
    drupal_json_output($m);
  }
}

/**
 * Auto alinear jugador
 */
function alineaciones_autoalinear_jugador ($alineacion_nid, $playerid){
    $playerid = str_replace("put","",$playerid);
    $ali = node_load($alineacion_nid);
    $player = node_load($playerid);

    $formacion = taxonomy_term_load($ali->field_formacion['und'][0]['tid']);
    $posiciones = get_posiciones($formacion->description);
    $resultado = "";
    for($i=1;$i<=11;$i++) {
        if (!isset($ali->{"field_jugador" . $i}['und']) || $ali->{"field_jugador" . $i}['und'][0]['target_id'] == 0 ) {
            if(intval($player->field_posicion['und'][0]['tid']) == intval($posiciones[$i]["position"])){
                alineaciones_alinear_jugador($alineacion_nid,$i,$playerid);
                $ali = node_load($alineacion_nid);
                $ali = borrarSuplente($ali,$playerid);
                node_save($ali);
                $resultado = "OK";
            }
        }
    }
    //-----Resultado------
    $m = array();
    if ($resultado == "OK") {
        $m['status'] = 'success';
        $m['text'] = 'Jugador alineado en la primera posición disponible encontrada.';
    } else {
        $m['status'] = 'error';
        $m['text'] = 'No se pudo alinear este jugador, es probable que no haya una posición en la cancha disponible para el.';
    }
    drupal_json_output($m);
}

/**
 *
 */
function _cancha_block_cb() {
    // AJAX Loading of any Block
    // -----
    // Below is the simple way to do it,
    // for one or 2 blocks it works.
    // For anything more then that it would probably have a negative
    // impact since it's doing a full bootstrap for each block.
    // https://groups.drupal.org/node/24825

    include_once './includes/bootstrap.inc';
    drupal_bootstrap(DRUPAL_BOOTSTRAP_FULL);

    $block = module_invoke('alineaciones', 'block_view', 'estadio');
    print render($block['content']);
}


?>