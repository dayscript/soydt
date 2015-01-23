<?php

/**
 * Field handler to present an add to cart form for the product..
 */
class fichajes_handler_field_anadir_al_carro extends views_handler_field {

    function construct() {
        parent::construct();
        //$this->additional_fields['tid'] = 'tid';
    }

    function query() {
        // do nothing -- to override the parent query.
    }

    function anadir_al_carro($values) {
        //dpm($values);

     
        $output = drupal_get_form('jugadores_form', $values->entity);
        //$form = drupal_get_form('jugadores_form', $values->entity);

        return $output;
    }



    function render($values) {
        return $this->anadir_al_carro($values);
    }

}
