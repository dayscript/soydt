<?php
/**
 * Funciones utilitarias
 */


/**
 * Pagina de alineaciones
 */
function alineaciones_data()
{
    $data = array();
    $data[ "fecha" ] = $_SESSION[ "fecha_activa" ];
    $data[ "fechas" ] = get_fechas();
    $data[ "equipo" ] = carrito_get_equipo_usuario();
    if ( arg( 2 ) && is_numeric( arg( 2 ) ) && arg( 2 ) > 0 )
    {
        $fecha_ali = node_load( arg( 2 ) );
        $data[ "alineacion" ] = get_alineacion( $fecha_ali, $data[ "fechas" ] );
    } else
    {
        $data[ "alineacion" ] = get_alineacion( $data[ "fecha" ], $data[ "fechas" ] );
        depurar_alineacion( $data[ "alineacion" ]->nid, $data[ "equipo" ]->nid );
        $data[ "alineacion" ] = get_alineacion( $data[ "fecha" ], $data[ "fechas" ] );
    }

    $data[ "formaciones" ] = get_formaciones();

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
 * @param $fechas
 * @param int $uid
 * @return bool|mixed|stdClass
 * @throws Exception
 */
function get_alineacion( $fecha, $fechas, $uid = 0, $verbose = false )
{
    global $user;
    if($uid){
        $us = user_load($uid);
    } else {
        $us = $user;
    }
    $query = new EntityFieldQuery();
    $result = $query->entityCondition( 'entity_type', 'node' )
        ->entityCondition( 'bundle', 'alineacion' )
        ->propertyCondition( 'status', 1 )
        ->propertyCondition( 'uid', $us->uid, "=" )
        ->fieldCondition( 'field_fecha_torneo', 'target_id', $fecha->nid, '=' )
        ->execute();
    if ( isset( $result[ 'node' ] ) )
    {
        $nids = array_keys( $result[ 'node' ] );
        $node = node_load( $nids[ 0 ] );
    } else
    {
        $keys = array_keys( $fechas );
        for ( $i = 0; $i < count( $keys ); $i ++ )
        {
            if ( $fechas[ $keys[ $i ] ]->nid == $fecha->nid )
            {
                if ( $i == 0 )
                {
                    $node = new stdClass();
                    $node->title = 'Alineación para: ' . $fecha->title . " - Usuario: " . $us->name;
                    $node->type = "alineacion";
                    node_object_prepare( $node );
                    $node->language = LANGUAGE_NONE;
                    $node->uid = $us->uid;
                    $node->status = 1;
                    $node->promote = 0;
                    $node->comment = 0;
                    $node->field_fecha_torneo[ 'und' ][ 0 ][ 'target_id' ] = $fecha->nid;
                    $node = node_submit( $node );
                    node_save( $node );
                    if($verbose)echo $node->title . "<br>";
                    $equipo = carrito_get_equipo_usuario($us->uid);
                    depurar_alineacion( $node->nid, $equipo->nid );
                } else
                {

                    $node = get_alineacion( $fechas[ $keys[ $i - 1 ] ], $fechas, $us->uid, $verbose );
                    unset( $node->nid );
                    unset( $node->vid );
                    unset( $node->path );
                    $node->field_total[ 'und' ][ 0 ][ 'value' ] = 0;
                    $node->title = 'Alineación para: ' . $fecha->title . " - Usuario: " . $us->name;
                    $node->field_fecha_torneo[ 'und' ][ 0 ][ 'target_id' ] = $fecha->nid;
                    $node = node_submit( $node );
                    node_save( $node );
                    if($verbose)echo $node->title . "<br>";
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
function get_formaciones()
{
    $voc = taxonomy_vocabulary_machine_name_load( 'formaciones' );
    $terminos = taxonomy_get_tree( $voc->vid );

    return $terminos;
}


/**
 * @return array
 * @throws EntityFieldQueryException
 */
function get_fechas()
{
    if ( isset( $_SESSION[ 'fechas' ] ) && is_array( $_SESSION[ 'fechas' ] ) && count( $_SESSION[ 'fechas' ] ) > 0 )
    {
        $fechas = $_SESSION[ 'fechas' ];
    } else
    {
        $fechas = array();
        $query = new EntityFieldQuery();
        $result = $query->entityCondition( 'entity_type', 'node' )
            ->entityCondition( 'bundle', 'fecha_del_torneo' )
            ->propertyCondition( 'status', 1 )
            ->fieldOrderBy( 'field_inicio', 'value', 'ASC' )
            ->execute();
        if ( isset( $result[ 'node' ] ) )
        {
            $nids = array_keys( $result[ 'node' ] );
            $fechas = entity_load( "node", $nids );
        }
        $_SESSION[ 'fechas' ] = $fechas;
    }

    return $fechas;
}


/**
 * @param $text
 */
function get_posiciones( $text )
{
    $positions = array();
    $lines = explode( ";", $text );
    foreach ( $lines as $line )
    {
        if ( trim( $line ) != "" )
        {
            $row = explode( "|", $line );
            $positions[ trim( $row[ 0 ] ) ] = array( "position" => trim( $row[ 1 ] ),
                                                     "x"        => trim( $row[ 2 ] ),
                                                     "y"        => trim( $row[ 3 ] ) );
        }
    }

    return $positions;
}

/**
 * Elimina un jugador si se encuentra en la lista de suplentes
 */
function borrarSuplente( $alineacion, $playerid )
{
    if ( isset( $alineacion->field_suplentes[ 'und' ] ) && is_array( $alineacion->field_suplentes[ 'und' ] ) )
    {
        foreach ( $alineacion->field_suplentes[ 'und' ] as $key => $supl )
        {
            if ( $supl[ 'target_id' ] == $playerid )
            {
                $alineacion->field_suplentes[ 'und' ][ $key ][ 'target_id' ] = 0;
                unset( $alineacion->field_suplentes[ 'und' ][ $key ] );
            }
        }
    }

    return $alineacion;
}

function autoalinear( $alineacion, $player )
{
    $formacion = taxonomy_term_load( $alineacion->field_formacion[ 'und' ][ 0 ][ 'tid' ] );
    $posiciones = get_posiciones( $formacion->description );
    $resultado = "";
    for ( $i = 1; $i <= 11; $i ++ )
    {
        if ( !isset( $alineacion->{"field_jugador" . $i}[ 'und' ] ) || $alineacion->{"field_jugador" . $i}[ 'und' ][ 0 ][ 'target_id' ] == 0 )
        {
            if ( intval( $player->field_posicion[ 'und' ][ 0 ][ 'tid' ] ) == intval( $posiciones[ $i ][ "position" ] ) )
            {
                alineaciones_alinear_jugador( $alineacion->nid, $i, $player->nid );
                $alineacion = node_load( $alineacion->nid );
                $alineacion = borrarSuplente( $alineacion, $player->nid );
                node_save( $alineacion );
                $resultado = "OK";
            }
        }
    }

    return $resultado;

}
