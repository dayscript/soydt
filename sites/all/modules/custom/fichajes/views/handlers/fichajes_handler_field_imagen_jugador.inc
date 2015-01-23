<?php

/**
 * Field handler to present an add to cart form for the product..
 */
class fichajes_handler_field_imagen_jugador extends views_handler_field {

    function construct() {
        parent::construct();
        //$this->additional_fields['tid'] = 'tid';
    }

    function query() {
        // do nothing -- to override the parent query.
    }

    function imagen_jugador($values) {
        //dpm($values->_entity_properties['entity object']);
        $entidad = $values->_entity_properties['entity object'];
        $id = $entidad->field_id_dayscore[LANGUAGE_NONE][0]['value'];

        $uri = 'public://players/'.$id.'.jpg';
        if (file_exists($uri)) {
            $imagen_usuario['style_name'] = 'jugador_fichajes_102x102';
            $imagen_usuario['path'] = $uri;
            $imagen_usuario = theme('image_style', $imagen_usuario);
            $datos['uri'] = $imagen_usuario;
            //dpm($datos['uri']);
            $output = $datos['uri'];
        }else{
            $output = '<img typeof="foaf:Image" src="/sites/all/themes/ligafantastica_omega/images/user-icon.jpg" width="105" height="105" style="max-width:105px;" alt="">';
        }
        return $output;
    }

    function render($values) {
        return $this->imagen_jugador($values);
    }

}
