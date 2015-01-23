<?php

/**
 * Field handler to present an add to cart form for the product..
 */
class fichajes_handler_field_ver_liga extends views_handler_field {

    function construct() {
        parent::construct();
        //$this->additional_fields['tid'] = 'tid';
    }

    function query() {
        // do nothing -- to override the parent query.
    }

    

    function ver_liga($values) {

        $form = drupal_get_form('mi_liga_form', $values->entity);

        return $form;
    }



    function render($values) {
        return $this->ver_liga($values);
    }

}