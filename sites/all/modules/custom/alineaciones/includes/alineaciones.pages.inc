<?php
function update_suscription_league($accion, $id) {
  $league = node_load($id);
  GLOBAL $user;



  $parameters = drupal_get_query_parameters();
  //if(isset($parameters['token'])  && drupal_valid_token($parameters['token'], 'user_'.$user->uid)) {
    
$esta = '';
    switch ($accion) {
      case 'unirse':

          foreach ($league->field_participantes[LANGUAGE_NONE] as $key => $value) {
            if($value['uid'] == $user->uid){
            $esta = $user->uid;
            }
          }
          if(empty($esta)){
            if(!empty($league->field_participantes[LANGUAGE_NONE])){
            $ultimoId = end(array_keys($league->field_participantes[LANGUAGE_NONE]));
            $ultimoId++;
            $league->field_participantes[LANGUAGE_NONE][$ultimoId]['uid'] = $user->uid; 
            }else{
              $league->field_participantes[LANGUAGE_NONE][0]['uid'] = $user->uid; 
            }
          }   
        break;
      case 'salir':
        foreach ($league->field_participantes[LANGUAGE_NONE] as $key => $value) {
          if($value['uid'] == $user->uid){
            unset($league->field_participantes[LANGUAGE_NONE][$key]);
          }
        }
        
        break;
    }

    node_save($league);
  //}
  drupal_goto('jugar/ligas');
  return 'hola';
}