<?php
/**
* Funciones utilitarias
*/


/**
* Pagina de alineaciones
*/
function alineaciones_data($torneo_id){
  $torneo_id = ($torneo_id) ? $torneo_id : 0;
  $data = array();
  $data["fecha"] = $_SESSION["fecha_activa"];
  $data["fechas"] = get_fechas();
  if( $torneo_id && is_numeric($torneo_id) && $torneo_id > 0){
    $fecha_ali = node_load($torneo_id);
    $data["alineacion"] = get_alineacion($fecha_ali,$data["fechas"]);
  } else {
    $data["alineacion"] = get_alineacion($data["fecha"],$data["fechas"]);
  }
  $data["equipo"] = carrito_get_equipo_usuario();
  $data["formaciones"] = get_formaciones();

  /* if(isset($equipo->field_jugadores2['und'])){
    $data["count"] = count($equipo->field_jugadores2['und']);
    foreach($equipo->field_jugadores2['und'] as $key=>$jugador){
      $jug = node_load($jugador['target_id']);
      $data["total"] += $jug->field_precio['und'][0]['value'];
    }
  }*/
return $data;
}


/**
* @param $fecha
*/
function get_alineacion($fecha, $fechas){
  global $user;
  $query = new EntityFieldQuery();
  $result = $query->entityCondition('entity_type', 'node')
  ->entityCondition('bundle', 'alineacion')
  ->propertyCondition('status', 1)
  ->propertyCondition('uid',$user->uid,"=")
  ->fieldCondition('field_fecha_torneo', 'target_id', $fecha->nid ,'=')
  ->execute();
  if (isset($result['node'])) {
    $nids = array_keys($result['node']);
    $node = node_load($nids[0]);
  } else {
    $keys = array_keys($fechas);
    for($i=0;$i<count($keys); $i++){
      if($fechas[$keys[$i]]->nid == $fecha->nid){
        if($i==0){
          $node = new stdClass();
          $node->title = 'Alineación para: ' . $fecha->title. " - Usuario: ".$user->name;
          $node->type = "alineacion";
          node_object_prepare($node);
          $node->language = LANGUAGE_NONE;
          $node->uid = $user->uid;
          $node->status = 1;
          $node->promote = 0;
          $node->comment = 0;
          $node->field_fecha_torneo['und'][0]['target_id'] = $fecha->nid;
          $node = node_submit($node);
          node_save($node);
        } else {
          $node = get_alineacion($fechas[$keys[$i-1]],$fechas);
          unset($node->nid);
          unset($node->vid);
          unset($node->path);
          $node->title = 'Alineación para: ' . $fecha->title. " - Usuario: ".$user->name;
          $node->field_fecha_torneo['und'][0]['target_id'] = $fecha->nid;
          $node = node_submit($node);
          node_save($node);
        }
        break;
      }
    }
  }
  return $node;
}


/**
* @return array
*/
function get_formaciones(){
  $voc = taxonomy_vocabulary_machine_name_load('formaciones');
  $terminos = taxonomy_get_tree($voc->vid);
  return $terminos;
}


/**
* @return array
* @throws EntityFieldQueryException
*/
function get_fechas(){
  if(isset($_SESSION['fechas']) && is_array($_SESSION['fechas']) && count($_SESSION['fechas'])>0){
    $fechas = $_SESSION['fechas'];
  } else {
    $fechas = array();
    $query = new EntityFieldQuery();
    $result = $query->entityCondition('entity_type', 'node')
    ->entityCondition('bundle', 'fecha_del_torneo')
    ->propertyCondition('status', 1)
    ->fieldOrderBy('field_inicio', 'value', 'ASC')
    ->execute();
    if (isset($result['node'])) {
      $nids = array_keys($result['node']);
      $fechas = entity_load("node", $nids);
    }
    $_SESSION['fechas'] = $fechas;
  }
  return $fechas;
}


/**
* @param $text
*/
function get_posiciones($text){
  $positions = array();
  $lines = explode(";",$text);
  foreach($lines as $line){
    if(trim($line) != ""){
      $row = explode("|",$line);
      $positions[trim($row[0])] = array("position"=>trim($row[1]),
        "x"=>trim($row[2]),
        "y"=>trim($row[3]));
    }
  }
  return$positions;
}

?>