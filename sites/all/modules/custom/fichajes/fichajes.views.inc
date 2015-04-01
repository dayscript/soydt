<?php


/**
 * @return Funcionalidad despecífica para el view "fichar_jugadores"
 * Agrega campos a los views para diferenciar el futbolista segun si esta
 * En el carrito de compras, en el equipo de usuario, o si esta disponible
 * para comprar
 */
function fichajes_views_data_alter( &$data ){
  $data['node']['jugador_en_mi_equipo_css'] = array(
    'title' => 'Jugador en mi Equipo - Clase CSS',
    'help'  => 'Valida si el Jugador ya esta en el equipo del usuario '
               . 'actual y retorna una clase css segun el resultado',
    'field' => array(
      'handler' => 'fichajes_jugador_en_mi_equipo_css'
      )
    );

  $data['node']['jugador_en_mi_carrito_css'] = array(
    'title' => 'Jugador en mi Carrito - Clase CSS',
    'help'  => 'Valida si el Jugador ya esta en el carrito de compras del usuario '
               . 'actual y retorna una clase css segun el resultado',
    'field' => array(
      'handler' => 'fichajes_jugador_en_mi_carrito_css'
      )
    );

   $data['node']['jugador_acciones_comprar'] = array(
    'title' => 'Comprar Futbolista',
    'help' => 'Acciones disponibles al intentar comprar un jugador',
    'field' => array(
      'handler' => 'fichajes_jugador_acciones_comprar'
      )
    );
}

/**
 * @return Clase-CSS
 */
class fichajes_jugador_en_mi_equipo_css extends views_handler_field_entity {
  function render( $row ){
    global $user_soydt;
    $row_id = $row->nid;
    $css_class = ( existe_futbolista_en_referencia_entidad($row_id, $user_soydt->equipo_usuario) )
      ? 'en-equipo-usuario'
      : 'fuera-del-equipo-usuario';
    return $css_class;
  }
}

/**
 * @return Clase-CSS
 */
class fichajes_jugador_en_mi_carrito_css extends views_handler_field_entity {
  function render( $row ){
    global $user_soydt;
    $row_id = $row->nid;
    $css_class = ( existe_futbolista_en_referencia_entidad($row_id, $user_soydt->carrito_compras) )
      ? 'en-carrito-usuario'
      : 'fuera-del-carrito-usuario';
    return $css_class;
  }
}


/**
 * @return $html
 * Devuelve html que muestra una accion diferente para los futbolistas
 * segun si esta en el carrito del usuario, en el equipo del usuario,
 * o disponible para comprar
 */
class fichajes_jugador_acciones_comprar extends views_handler_field_entity {
  function render( $row ){
    global $user_soydt;
    $row_id = $row->nid;
    $acciones = array();

    if (  existe_futbolista_en_referencia_entidad($row_id, $user_soydt->equipo_usuario)) {
      $acciones['classes'] = 'en-el-equipo';
      $acciones['titulo'] = 'Ya esta en tu equipo';
      $acciones['link'] = FALSE;
      $acciones['url'] = '';
    }
    else if (  existe_futbolista_en_referencia_entidad($row_id, $user_soydt->carrito_compras) ) {
      $acciones['classes'] = 'en-el-carrito';
      $acciones['titulo'] = 'Ya esta en tu carrito';
      $acciones['link'] = FALSE;
      $acciones['url'] = '';
    }
    else {
      $acciones['classes'] = 'agregar-carrito';
      $acciones['titulo'] = 'Agregar al carrito';
      $acciones['link'] = TRUE;
      $acciones['url'] = '/carrito/add/' . $row_id;
    }

    $html  = "<div class=\"ftbl-acciones {$acciones['classes']}\">";

    if ($acciones['link']) {
      $html .= "<a href=\"#\" id=\"ftbl-$row_id\" data-reveal-id=\"show-reveal\" data-reveal-ajax=\"{$acciones['url']}\">";
    }

    $html .= "<i title=\"{$acciones['titulo']}\" class=\"sprite-juego\"></i>";

    if ($acciones['link']) {
      $html .= '</a>';
    }

    $html .= '</div>';

    return $html;
  }
}
?>