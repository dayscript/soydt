<?php

/**
 * Field handler to present an add to cart form for the product..
 */
class fichajes_handler_field_puntos_usuario extends views_handler_field {

    function construct() {
        parent::construct();
        //$this->additional_fields['tid'] = 'tid';
    }

    function query() {
        // do nothing -- to override the parent query.
    }

    

    function puntos_usuario($values) {
      $table = data_get_table('dayscore_user_points');
      $keys = array("id_user"=>$values->users_field_data_field_participantes_uid,"fecha"=>7176);
      $record = $table->handler()->load($keys);
      if(isset($record[0]))$puntos = $record[0]['puntos'];
      else $puntos = 0;
        //dpm($values->users_field_data_field_participantes_uid);
//          $query_usuarios = db_select('points_by_user', 'u');
//          $query_usuarios->fields('u', array('puntos'))
          //->orderBy('id_dato', 'ASC')
//          ->condition('u.id_user', $values->users_field_data_field_participantes_uid, '=')
//          ->condition('u.fecha', 7176, '=');

//          $puntos = $query_usuarios->execute()->fetchField();
        
        return $puntos;

    }



    function render($values) {
        return $this->puntos_usuario($values);
    }

}