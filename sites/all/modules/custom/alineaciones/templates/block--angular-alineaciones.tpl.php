<?php
$path = drupal_get_path('module','alineaciones');

// TODO: Estas librerias podrian ser minificadas
// y concatenadas antes de incluirse
drupal_add_js($path . '/js-angular/angular.min.js');
drupal_add_js($path . '/js-angular/alineaciones-ng.js');
drupal_add_js($path . '/js-angular/controllers.js');
drupal_add_js($path . '/js-angular/directives.js');
drupal_add_js($path . '/js-angular/filters.js');
drupal_add_js($path . '/js-angular/services.js');

drupal_add_library('system', 'ui.draggable');
drupal_add_library('system', 'ui.droppable');
?>

<div ng-app="alineaciones">
  <div id="estadio" class="estadio"
      ng-class="{ 'active' : torneoActivo }"
      ng-controller="EstadioController">

    <tribuna></tribuna>

    <div class="row cancha-alertas text-center">
      <cancha-alertas></cancha-alertas>
    </div>

    <div id="cancha" class="cancha row" ng-class="{ active : torneoActivo }">
      <alineados></alineados>
      <suplentes></suplentes>
    </div> <!-- #cancha -->

  </div> <!-- #estadio -->
</div> <!-- ng-app -->
















