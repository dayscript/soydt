<?php
$theme_path = base_path() . drupal_get_path('theme', 'soydt_foundation');
$module_path = drupal_get_path('module','alineaciones');

/**
 * Dependencias
 */
drupal_add_js($module_path . '/js/alineaciones.js');
drupal_add_library('system', 'ui.draggable');
drupal_add_library('system', 'ui.droppable');

// Datos de la alineacion actual
$data = alineaciones_data();

// Datos de la fecha Actual
$fecha_torneo = $data["alineacion"]->field_fecha_torneo[LANGUAGE_NONE][0]['target_id'];
$fecha_activa = $_SESSION['fecha_activa']->nid;

// Datos guardados por el usuario
$alineacion_usuario = $data["alineacion"]->nid;
if(isset($data["alineacion"]->field_capitan[LANGUAGE_NONE]))
    $capitan_usuario = $data["alineacion"]->field_capitan[LANGUAGE_NONE];
if(isset($data["equipo"]->field_jugadores2[LANGUAGE_NONE]))
    $equipo_usuario = $data["equipo"]->field_jugadores2[LANGUAGE_NONE];
$formacion_usuario = $data["alineacion"]->field_formacion[LANGUAGE_NONE][0]['tid'];
$puntos_usuario = $data['alineacion']->field_total[LANGUAGE_NONE][0]['value'];

$es_fecha_torneo_activo =  ( $fecha_torneo == $fecha_activa ) ? true : false;

?>
<div id="estadio" class="estadio">
  <div class="row cancha-tribuna">
  <!-- ============== Puntajes ============== -->
  <div class="cancha-puntajes fade-me medium-2 medium-offset-1 small-8 columns">
      <div class="puntos puntos-fecha small-centered columns text-center">
          <div class="total">
            <?php echo isset($puntos_usuario) ? $puntos_usuario : "0" ?>
          </div>
          <small>Pts fecha</small>
      </div>
  </div>
  <div class="cancha-puntajes fade-me medium-2 small-8 columns">
      <div class="puntos puntos-acumulado small-centered columns text-center">

          <div class="total">000</div>
          <small>Pts acumulado</small>
      </div>
  </div>


  <!-- ============== Filtros de Alineaciones ============== -->
  <div id="filtros" class="medium-10 medium-offset-1 small-16 columns cancha-filtros fade-me <?php echo $es_fecha_torneo_activo ? "active" : "" ?>">
    <form id="alineaciones-filtros" accept-charset="UTF-8">

      <div class="small-16 medium-4 columns">
        <!-- Select Fechas -->
        <label for="fecha"><?php echo t('Fecha del torneo') ?></label>
        <select name="fecha" id="fecha">

        <?php foreach ( $data["fechas"] as $fecha ): ?>
          <option <?php echo ($fecha->nid == $fecha_torneo) ? "selected" :"" ?>
              value="<?php echo $fecha->nid?> ">
              <?php echo $fecha->title?>
          </option>

          <?php
          //-----No mostrar las fechas de torneos futuros------
          if ( $fecha_activa == $fecha->nid ) break;
          ?>
        <?php endforeach; ?>
        </select>
      </div>


      <div class="small-16 medium-4 columns">
        <!-- Select Formaciones -->
        <label for="formacion"><?php echo t('Formación') ?></label>
        <select <?php echo ( $es_fecha_torneo_activo ) ? "" : "disabled" ?>
            name="formacion" id="formacion">

        <?php foreach ( $data["formaciones"] as $formacion) : ?>
            <option <?php echo ( $formacion->tid == $formacion_usuario ) ? "selected": "" ?>
                value="<?php echo $formacion->tid; ?>">
                <?php echo $formacion->name; ?>
            </option>
        <?php

        //-----Guardar la formacion activa para luego utiliziarla posicionando los jugadores en la cancha------
        if ( $formacion->tid == $formacion_usuario )
        $positions = get_posiciones( $formacion->description );
        //----
        endforeach;
        ?>
        </select>
      </div>


      <div class="small-16 medium-8 columns end">
        <!-- Select: Capitanes -->
        <label for="capitan"><?php echo t('Capitán') ?></label>
        <select <?php echo ( $es_fecha_torneo_activo ) ? "" : "disabled" ?>
            name="capitan" id="capitan">

          <option value="0"><?php echo t('Seleccione un capitán...') ?></option>
          <?php if (isset($equipo_usuario)):?>
            <?php foreach ( $equipo_usuario as $futbolista ):

              $node_futbolista = node_load($futbolista['target_id']);

              if( isset( $capitan_usuario ) && $node_futbolista->nid == $capitan_usuario[0]['target_id']) {
                $capitan_activo = true;
              }
              else {
                $capitan_activo = false;
              }

              ?>
              <option <?php echo ($capitan_activo) ? "selected" :"" ?>
                  value="<?php echo $node_futbolista->nid?>">
                  <?php
                  print $node_futbolista->field_apellidos[LANGUAGE_NONE][0]['value']
                        . ', '
                        . $node_futbolista->field_nombres[LANGUAGE_NONE][0]['value'];
                  ?>
              </option>

            <?php endforeach ?>
          <?php endif ?>
        </select>
      </div>
      <input type="hidden" name="id_alineacion" id="id_alineacion" value="<?php echo $alineacion_usuario ?>">
    </form>
  </div> <!-- #filtros -->
  </div> <!-- .cancha-tribuna -->


<!-- ============== Alertas ============== -->
<div class="row cancha-alertas text-center">

  <?php if ($es_fecha_torneo_activo):?>
  <div id="notificacion" data-alert class="alert-box info radius medium-8 medium-centered small-16 columns fade-me">
      <strong>Nota: </strong>Recuerda que ya no es necesario guardar la alineación. <br> Cada cambio que realices queda grabado automáticamente.
      <a href="#" class="close">&times;</a>
  </div>

  <?php else :?>
  <div id="notificacion" data-alert class="alert-box warning radius medium-8 medium-centered small-16 columns fade-me">
      <strong>Nota:</strong> Esta fecha se encuentra cerrada. No se pueden realizar cambios en la alineación.
      <a href="#" class="close">&times;</a>
  </div>
  <?php endif; ?>

</div>




  <!-- ============== Cancha ============== -->
  <div id="cancha" class="cancha row <?php echo ($es_fecha_torneo_activo) ? "active" : "inactive" ?>">
    <?php
    //----- renderizar los contenedores de futbolistas ------
    for ( $i=1; $i<=11; $i++ ):
      $var = "field_jugador".$i;
      if (isset($data["alineacion"]->{$var}[LANGUAGE_NONE])
          && $data["alineacion"]->{$var}[LANGUAGE_NONE][0]['target_id']>0 ){
          $asigned = "asigned";
      } else {
          $asigned = "";
      }
      ?>

      <div id="place<?php echo $i?>"
          class="droppable fade-me place_position<?php echo $positions[$i]["position"]?> <?php echo $asigned?>"
          style="top: <?php echo 55+($positions[$i]["y"]-1)*28?>px;left: <?php echo 230+($positions[$i]["x"]-1)*65?>px;">

        <input value="<?php echo $positions[$i]["position"]?>"
            type="hidden" class="position">

        <?php if($asigned):?>
          <input value="<?php echo $data["alineacion"]->{$var}[LANGUAGE_NONE][0]['target_id']?>"
            type="hidden" class="id">
        <?php endif?>
        <img src="<?php echo $theme_path; ?>/images/futbolistas/posicion-vacia.png">
      </div>
    <?php endfor; ?>


    <div id="alineados" class="futbolistas alineados fade-me">
    <?php for($i=1;$i<=11;$i++):?>
      <?php if( isset($data["alineacion"]->{"field_jugador" . $i}[LANGUAGE_NONE])
              && $data["alineacion"]->{"field_jugador" . $i}[LANGUAGE_NONE][0]['target_id'] >0):

        $futbolista = $data["alineacion"]->{"field_jugador" . $i}[LANGUAGE_NONE][0];
        $ftb_puntos = puntos_jugador_fecha($futbolista['target_id'],$fecha_torneo);

        $node_futbolista = node_load($futbolista['target_id']);
        $ftb_id = $node_futbolista->nid;
        $ftb_posicion = $node_futbolista->field_posicion[LANGUAGE_NONE][0]['tid'];
        $ftb_equipo = $node_futbolista->field_equipo[LANGUAGE_NONE][0]['target_id'];
        $ftb_apellido = explode(" ", $node_futbolista->field_apellidos[LANGUAGE_NONE][0]['value'])[0];
            if (isset($capitan_usuario) && $ftb_id == $capitan_usuario[0]['target_id']){
                $ftb_puntos *= 2;
            }
        ?>

        <div id="<?php echo $ftb_id?>"
             class="futbolista ftb-<?php echo $ftb_id; ?> ftb-posicion-<?php echo $ftb_posicion; ?> end columns text-center" >

          <div class="ftb-equipo-imagen small-16 columns">
            <img src="<?php echo $theme_path; ?>/images/futbolistas/<?php echo $ftb_equipo; ?>.png">
          </div>

          <div class="ftb-nombre-puntos columns small-16">
            <div class="columns small-12 ftb-name">
              <a class="info" id="3info<?php echo $ftb_id?>"><?php echo $ftb_apellido; ?></a>
            </div>
            <div class="columns small-4 end text-center ftb-puntos"><?php echo $ftb_puntos?></div>

          <?php if (isset($capitan_usuario) && $ftb_id == $capitan_usuario[0]['target_id']):?>
            <div class="star sprite-juego"></div>
          <?php endif?>
          </div>

          <div class="ftb-acciones-wrapper">
            <div class="ftb-acciones">
              <a id="info<?php echo $ftb_id; ?>" class="info sprite-juego"></a>

          <?php if($es_fecha_torneo_activo):?>
              <a id="drop<?php echo $ftb_id; ?>" class="drop sprite-juego"></a>
              <a id="sell<?php echo $ftb_id; ?>"  class="sell sprite-juego"></a>
          <?php endif?>
            </div>
          </div>
        </div>
      <?php endif?>
    <?php endfor; ?>
    </div> <!-- #alineados -->

    <div id="suplentes" class="futbolistas suplentes row">
      <?php
      //TODO:
      if( $fecha_torneo != $fecha_activa || true ):
        if( isset($data["alineacion"]->field_suplentes[LANGUAGE_NONE]) ):
          foreach( $data["alineacion"]->field_suplentes[LANGUAGE_NONE] as $futbolista ):

            $node_futbolista = node_load($futbolista['target_id']);
            $ftb_id = $node_futbolista->nid;
            $ftb_posicion = $node_futbolista->field_posicion[LANGUAGE_NONE][0]['tid'];
            $ftb_equipo = $node_futbolista->field_equipo[LANGUAGE_NONE][0]['target_id'];
            $ftb_apellido = explode(" ", $node_futbolista->field_apellidos[LANGUAGE_NONE][0]['value'])[0];
      ?>

      <div id="<?php echo $ftb_id; ?>"
           class="futbolista ftb-<?php echo $ftb_id; ?> ftb-posicion-<?php echo $ftb_posicion; ?> end columns text-center fade-me" >
        <div class="ftb-equipo-imagen small-16 columns">
          <img src="<?php echo $theme_path; ?>/images/futbolistas/<?php echo $ftb_equipo; ?>.png">
        </div>

        <div class="ftb-nombre-puntos columns small-16">
          <div class="columns small-16 ftb-name">
            <a id="2info<?php echo $ftb_id; ?>" class="info"><?php echo $ftb_apellido; ?></a>
          </div>
          <!-- Los puntos no se deben mostrar para jugadores en la banca -->

          <?php if (isset($capitan_usuario) && $ftb_id == $capitan_usuario[0]['target_id']):?>
            <div class="star sprite-juego"></div>
          <?php endif?>
        </div>

          <div class="ftb-acciones-wrapper">
            <div class="ftb-acciones">
              <a id="info<?php echo $ftb_id; ?>" class="info sprite-juego"></a>
            <?php if ($es_fecha_torneo_activo): ?>
              <a id="put<?php echo $ftb_id; ?>" class="put sprite-juego"></a>
              <a id="sell<?php echo $ftb_id; ?>" class="sell sprite-juego"></a>
            <?php endif; ?>
            </div>
          </div>
      </div>

          <?php endforeach?>
        <?php endif?>
      <?php endif?>
    </div> <!-- suplentes -->
  </div> <!-- #cancha -->
</div> <!-- #estadio -->

<div class="cancha-convenciones row">
  <ul class="convenciones small-16 columns">
    <li class="info"><i class="sprite-juego"></i>Información del jugador</li>
    <li class="sell"><i class="sprite-juego"></i>Vender</li>
    <li class="star"><i class="sprite-juego"></i>Seleccionado como capitán</li>
    <li class="put"><i class="sprite-juego"></i>Alinear</li>
    <li class="drop"><i class="sprite-juego"></i>Sacar de la titular</li>
  </ul>

</div>

<!-- Placeholders para mensajes emergentes -->
<div id="alineaciones-popup" class="reveal-modal tiny" data-reveal data-options="close_on_background_click: false;" ></div>
<div id="alineaciones-popup2" class="reveal-modal tiny" data-reveal ></div>
