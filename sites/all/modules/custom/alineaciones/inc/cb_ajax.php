<?php

/**
 * @param $page_callback_result
 */
function alineaciones_jugador_detalle_ajax($page_callback_result) {
    print render($page_callback_result);
}

/**
 * @param $page_callback_result
 */
function alineaciones_alinear_jugador_ajax($page_callback_result) {
  //-----Resultado------
  $m = array();
  if ($page_callback_result == "OK") :
    $m['status'] = 'success';
    $m['text'] = 'Jugador alineado correctamente.';

  elseif ($page_callback_result == "CAMBIO") :
    $m['status'] = 'warning';
    $m['text'] = 'Los jugadores han intercambiado posiciones correctamente.';

  elseif ($page_callback_result == "REEMPLAZO") :
    $m['status'] = 'warning';
    $m['text'] = 'El jugador ha sustituido al otro correctamente.';

  else :
    $m['status'] = 'error';
    $m['text'] = 'Ha ocurrido un error.';

  endif;

  drupal_json_output($m);
}




?>