<?php

/**
 * Field handler to present an add to cart form for the product..
 */
class fichajes_handler_field_unirse extends views_handler_field {

    function construct() {
        parent::construct();
        //$this->additional_fields['tid'] = 'tid';
    }

    function query() {
        // do nothing -- to override the parent query.
    }

    function unirse_a_liga($values) {
//    dpm($values);
        GLOBAL $user;
        $confirmation = '';
        $liga = node_load($values->entity);
        //dpm($liga);
        
        //dpm($password_value);

        $participantes = $liga->field_participantes[LANGUAGE_NONE];
            foreach ($participantes as $key) {
                if($user->uid == $key['uid']){
                    $confirmation = 'yes';
                }
                
            }

        if($confirmation == 'yes'){
            $options = array(
                      'query' => array(
                        'token' => drupal_get_token('user_'.$user->uid),
                        'destination' => current_path(),
                      ),
                      'attributes' => array('class' => array('salir')),
                    );

                    $output = l('Salir', 'jugar/ligas/salir/'.$values->entity, $options);
        }else{

            if (!empty($liga->field_clave_pass[LANGUAGE_NONE])) {
                $options = array(
                  'query' => array(
                    'token' => drupal_get_token('user_'.$user->uid),
                    'destination' => current_path(),
                  ),
                  'attributes' => array('class' => array('unirse')),
                );
                $output = '<div style ="display:none;"class="pass-form">';
                $output .= drupal_render(drupal_get_form('liga_privada_form', $values->entity));
                $output .= '</div>';
                $output .= '<a href="#" class="unirse-pass">Unirse</a>';
            }else{
                $options = array(
                  'query' => array(
                    'token' => drupal_get_token('user_'.$user->uid),
                    'destination' => current_path(),
                  ),
                  'attributes' => array('class' => array('unirse')),
                );
                $output = l('Unirse', 'jugar/ligas/unirse/'.$values->entity, $options);
            }
        }



        //dpm(node_load($values->entity));
    /*$estado = $values->field_field_activo[0]['raw']['value'];
    $options = array(
      'query' => array(
        'token' => drupal_get_token('periodo_'.$values->tid),
      ),
    );
    if($estado) {
      $output = l('Inactivar', 'admin/periodo-constitucional/inactivar/'.$values->tid, $options);
    } else {
      $output = l('Activar', 'admin/periodo-constitucional/activar/'.$values->tid, $options);
    }*/
    //dpm($output);
        return $output;
    }



    function render($values) {
        return $this->unirse_a_liga($values);
    }

}
