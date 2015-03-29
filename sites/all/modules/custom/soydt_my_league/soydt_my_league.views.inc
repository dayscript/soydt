<?php


  function soydt_my_league_views_data_alter( &$data ){
    
    $data['node']['members'] = array(
        'title' => 'Miembros',
        'help'  => 'Numero de miembros de cada liga',
        'field' => array(
            'handler' => 'soydt_my_league_get_members'
        )
    );
    
    $data['node']['user_id'] = array(
        'title' => 'Id usuario logueado',
        'help'  => 'Identificador del usuario que ha iniciado sesión',
        'field' => array(
            'handler' => 'soydt_my_league_get_global_user_id'
        )
    );
    
  }
  
  
  class soydt_my_league_get_members extends views_handler_field_entity {
    
    function render( $row ){
      
      $leagueWrapper = entity_metadata_wrapper( 'node', $row->nid );
      return count( $leagueWrapper->field_league_members );
      
    }
    
  }
  
  class soydt_my_league_get_global_user_id extends views_handler_field_entity {
    
    function render ( $row ) {
      
      global $user;
      
      return $user->uid;
      
    }
    
  }