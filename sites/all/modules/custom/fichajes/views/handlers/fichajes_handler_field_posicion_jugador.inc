<?php

/**
 * Field handler to present an add to cart form for the product..
 */
class fichajes_handler_field_posicion_jugador extends views_handler_field {

    function construct() {
        parent::construct();
        //$this->additional_fields['tid'] = 'tid';
    }

    function query() {
        // do nothing -- to override the parent query.
    }

    function posicion_jugador($values) {
        //dpm($values);
        $entidad = $values->_entity_properties['entity object'];
        $posicion = $entidad->field_posici_n[LANGUAGE_NONE][0]['value'];

        $output = '<p>';

        switch ($posicion) {
            case 1:
                $output .= "Arquero";
                break;
            case 2:
                $output .= "Defensa";
                break;  
            case 3:
                $output .= "Volante";
                break;  
            case 4:
                $output .= "Delantero";
                break;
            default:
                # code...
                break;
        }

        $output .= '</p>';

        return $output;
    }

    function render($values) {
        return $this->posicion_jugador($values);
    }

}
