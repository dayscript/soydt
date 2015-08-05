<?php
/**
 * Created by PhpStorm.
 * User: jcorrego
 * Date: 26/03/15
 * Time: 9:27 PM
 */

/**
 * Elimina un jugador del carro de compras
 */
function carrito_delete_player($player){
    $carrito = get_carrito_compras();
    $fecha = $_SESSION[ 'fecha_activa' ];
    $fechas = get_fechas();
    $alineacion = get_alineacion( $fecha, $fechas );
    if(isset($carrito->field_jugadores['und'])){
        foreach($carrito->field_jugadores['und'] as $key=>$jugador){
            if($jugador['target_id'] == $player){
                array_splice($carrito->field_jugadores['und'],$key,1);
                node_save($carrito);
                $alineacion->field_fichajes['und'][0]['value']++;
                if($alineacion->field_fichajes['und'][0]['value'] >3)
                    $alineacion->field_fichajes['und'][0]['value'] = 3;
                node_save($alineacion);
                return "ELIMINADO";
            }
        }
    }
    return "NO EXISTE";
}

/**
 * Callback: Vende un jugador
 */
function carrito_sell($playerid,$alineacion_id){
    $playerid = str_replace("sell","",$playerid);
    global $user;
    //$ali = node_load($alineacion_id);
    alineaciones_desalinear_jugador($alineacion_id, $playerid, true);
    $us = user_load($user->uid);
    $saldo = get_saldo();
    $equipo = carrito_get_equipo_usuario();
    $m = array();
    $m['status'] = 'success';
    $m['text'] = 'Jugador vendido correctamente. ';
    if (isset($equipo->field_jugadores2['und'])) {
        foreach ($equipo->field_jugadores2['und'] as $key => $jugador) {
            if( $jugador['target_id'] == $playerid){
                $equipo->field_jugadores2['und'][$key]['target_id'] = 0;
                unset($equipo->field_jugadores2['und'][$key]);
                node_save($equipo);
                $jug = node_load($jugador['target_id']);
                $saldo += $jug->field_precio['und'][0]['value'];
                $m['text'] .= "Su saldo disponible se ha incrementado en $".number_format($jug->field_precio['und'][0]['value'],0,",",".") . ". ";
                $us->field_saldo['und'][0]['value'] = $saldo;
                node_save($equipo);
                user_save($us);
            }
        }
    }
    drupal_json_output($m);
}

/**
 * Procesa las compras
 */
function carrito_checkout(){
    global $user;
    $us = user_load($user->uid);
    $saldo = get_saldo();
    $carrito = get_carrito_compras();
    $equipo = carrito_get_equipo_usuario();
    $fecha = $_SESSION["fecha_activa"];
    $fechas = get_fechas();
    $alineacion = get_alineacion($fecha,$fechas);
    if (isset($carrito->field_jugadores['und'])) {
        foreach ($carrito->field_jugadores['und'] as $key => $jugador) {
            if(!isset( $equipo->field_jugadores2['und'])) $equipo->field_jugadores2['und'] = array();
            $equipo->field_jugadores2['und'][] = $jugador;
            $jug = node_load($jugador['target_id']);
            $saldo -= $jug->field_precio['und'][0]['value'];
            $alineacion->field_suplentes['und'][] = $jugador;
            autoalinear($alineacion,$jug);
            $alineacion = node_load($alineacion->nid);
        }
    }
    node_save($alineacion);
    $carrito->field_jugadores['und'] = array();
    $us->field_saldo['und'][0]['value'] = $saldo;
    node_save($carrito);
    node_save($equipo);
    user_save($us);
    return "OK";
}

/**
 * Agrega un jugador
 * @param $player id de jugador a agregar
 * @return "YA EXISTE", "AGREGADO", "EQUIPO", "LIMITE JUGADORES", "PRESUPUESTO", "LIMITE FICHAJES"
 */
function carrito_add_player($player){
    $carrito = get_carrito_compras();
    $saldo = get_saldo();
    $equipo = carrito_get_equipo_usuario();
    $total = 0;
    $fecha = $_SESSION[ 'fecha_activa' ];
    $fechas = get_fechas();
    $alineacion = get_alineacion( $fecha, $fechas );
    if(!isset($alineacion->field_fichajes['und']))$alineacion->field_fichajes['und'][0]['value'] = 3;
    if( $alineacion->field_fichajes['und'][0]['value']==0 ){
        return "LIMITE FICHAJES";
    }
    if(isset($carrito->field_jugadores['und'])){
        foreach($carrito->field_jugadores['und'] as $key=>$jugador){
            if($jugador['target_id'] == $player){
                return "YA EXISTE";
            }
            $jug = node_load($jugador["target_id"]);
            $saldo -= $jug->field_precio["und"][0]["value"];
            $total++;
        }
    }
    if(isset($equipo->field_jugadores2['und'])){
        foreach($equipo->field_jugadores2['und'] as $key=>$jugador){
            if($jugador['target_id'] == $player){
                return "EQUIPO";
            }
            $total++;
        }
    }
    if($total>=15){
        return "LIMITE JUGADORES";
    }
    $node = node_load($player);
    if($saldo < $node->field_precio["und"][0]["value"]){
        return "PRESUPUESTO";
    }
    if(isset($carrito->field_jugadores['und'])) {
        $carrito->field_jugadores['und'][count($carrito->field_jugadores['und'])]['target_id'] = $player;
    } else {
        $carrito->field_jugadores['und'][0]['target_id'] = $player;
    }
    $alineacion->field_fichajes['und'][0]['value']--;
    node_save($alineacion);
    node_save($carrito);
    return "AGREGADO";
}

/**
 * @param int $uid
 * @return bool|mixed|stdClass
 * @throws Exception
 */
function carrito_get_equipo_usuario( $uid = 0){
    global $user;
    if($uid){
        $us = user_load($uid);
    } else {
        $us = $user;
    }
    $query = new EntityFieldQuery();
    $result = $query->entityCondition('entity_type', 'node')
        ->entityCondition('bundle', 'equipo_de_usuario')
        ->propertyCondition('status', 1)
        ->propertyCondition('uid',$us->uid,"=")
        ->execute();
    if (isset($result['node'])) {
        $nids = array_keys($result['node']);
        $node = node_load($nids[0]);
    } else {
        $node = new stdClass();
        $node->title = 'Equipo de ' . $us->name;
        $node->type = "equipo_de_usuario";
        node_object_prepare($node);
        $node->language = LANGUAGE_NONE;
        $node->uid = $us->uid;
        $node->status = 1;
        $node->promote = 0;
        $node->comment = 0;
        $node = node_submit($node);
        node_save($node);
        $us2 = user_load($us->uid);
        $us2->field_saldo['und'][0]['value'] = 500000000;
        if($us->uid > 0)user_save($us2);
    }
    return $node;
}
