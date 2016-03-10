<?php
/**
 * Created by PhpStorm.
 * User: jcorrego
 * Date: 26/03/15
 * Time: 9:28 PM
 */

/**
 * Obtiene los datos para el boton de agregar al carrito
 */
function agregar_data(){
    $data["disabled"] = false;
    $data["text"] = "Agregar";
    $data["subtext"] = "Al carrito de compras";
    $saldo = get_saldo();
    if (arg(0) == 'node' && is_numeric(arg(1))) $nodeid = arg(1);
    else $nodeid = 0;
    $data["nid"] = $nodeid;
    $node = node_load($nodeid);
    $saldo -= $node->field_precio["und"][0]["value"];
    $carrito = get_carrito_compras();
    $equipo = carrito_get_equipo_usuario();
    $total = 0;
    if(isset($carrito->field_jugadores['und'])){
        foreach($carrito->field_jugadores['und'] as $key=>$jugador){
            if($jugador['target_id'] == $nodeid){
                $data["disabled"] = true;
                $data["subtext"] = "Este jugador ya se encuentra en el carrito";
                return $data;
            }
            $jug = node_load($jugador["target_id"]);
            $saldo -= $jug->field_precio["und"][0]["value"];
            $total++;
        }
    }
    if(isset($equipo->field_jugadores2['und'])){
        foreach($equipo->field_jugadores2['und'] as $key=>$jugador){
            if($jugador['target_id'] == $nodeid){
                $data["disabled"] = true;
                $data["subtext"] = "Este jugador ya está en su equipo";
                return $data;
            }
            $total++;
        }
    }
    if($total>=100){ // limite de jugadores de un equipo
        $data["disabled"] = true;
        $data["subtext"] = "Ha alcanzado el limite de jugadores.";
        return $data;

    }
    if($saldo < 0){
        $data["disabled"] = true;
        $data["subtext"] = "Presupuesto insuficiente para agregar este jugador";
        return $data;
    }
    return $data;
}
/**
 * Obtiene los datos de mi equipo
 */
function equipo_data(){
    $data["total"] = 0;
    $data["count"] = 0;
    $equipo= carrito_get_equipo_usuario();
    $data['obj'] = $equipo;
    if(isset($equipo->field_jugadores2['und'])){
        $data["count"] = count($equipo->field_jugadores2['und']);
        foreach($equipo->field_jugadores2['und'] as $key=>$jugador){
            $jug = node_load($jugador['target_id']);
            $data["total"] += $jug->field_precio['und'][0]['value'];
        }
    }
    return $data;
}

/**
 * Obtiene los datos para el carrito
 */
function carrito_data(){
    $data["saldo"] = get_saldo();
    $data["total"] = 0;
    $data["count"] = 0;
    $carrito = get_carrito_compras();
    $data['obj'] = $carrito;
    if(isset($carrito->field_jugadores['und'])){
        $data["count"] = count($carrito->field_jugadores['und']);
        foreach($carrito->field_jugadores['und'] as $key=>$jugador){
            $jug = node_load($jugador['target_id']);
            $data["total"] += $jug->field_precio['und'][0]['value'];
        }
    }
    return $data;
}

/**
 * @return bool|mixed|stdClass
 * @throws Exception
 */
function get_carrito_compras(){
    global $user;
    $query = new EntityFieldQuery();
    $result = $query->entityCondition('entity_type', 'node')
        ->entityCondition('bundle', 'carro_de_compras')
        ->propertyCondition('status', 1)
        ->propertyCondition('uid',$user->uid,"=")
        ->execute();
    if (isset($result['node'])) {
        $nids = array_keys($result['node']);
        $node = node_load($nids[0]);
    } else {
        $node = new stdClass();
        $node->title = 'Carrito de compras de ' . $user->name;
        $node->type = "carro_de_compras";
        node_object_prepare($node);
        $node->language = LANGUAGE_NONE;
        $node->uid = $user->uid;
        $node->status = 1;
        $node->promote = 0;
        $node->comment = 0;
        $node = node_submit($node);
        node_save($node);
    }
    return $node;
}


/**
 * @throws Exception
 */
function get_saldo(){
    global $user;
    $us = user_load($user->uid);
    if (!isset($us->field_saldo['und']) || $us->field_saldo['und'][0]['value'] < 0) {
        $us->field_saldo['und'][0]['value'] = 500000000;
        user_save($us);
    }
    return $us->field_saldo['und'][0]['value'];
}


