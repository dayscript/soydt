<?php 
drupal_add_library('system', 'ui.dialog');
$info_alineacion = datos_alineaciones();
$vars_escudo = array('style_name' => '100x100','path' => $info_alineacion['escudo']);

$fecha_actual = arg(2);
  $fecha_activa = $_SESSION['fecha'];
if($fecha_actual < $fecha_activa ){
$background = $data['module_path'].'/images/bg2.png';
} else {
$background = $data['module_path'].'/images/bg.png';
}


//dpm($entidades);
?>
<div class="datos-equipo">
    <div class="escudo"><?php if(!empty($info_alineacion['escudo'])){ print theme('image_style', $vars_escudo); }else{?> <img typeof="foaf:Image" src="/sites/default/files/default_images/escudo.png" width="100" height="100" style="max-width:105px;" alt=""> <?php } ?></div>
    <h2 class="nombre-equipo"><?php print $info_alineacion['nombre_equipo']; ?></h2>
    <span><?php print l('Editar', $data['link_edicion'], array('attributes' => array('class' => 'editar-usuario'))); ?></span>
</div>
<div class="opciones-alineacion">
	<?php $form = drupal_get_form('alineacion_form');
  	print drupal_render($form);?>
</div>
<div class="puntos-box">
  <div class="puntos-por-fecha">
    <div><?php if(!empty($info_alineacion['puntos'])){  print $info_alineacion['puntos']; }else{ ?> 0 <?php } ?></div>
    <span>pts fecha</span>
  </div>
</div>
<div id="page-wrap">
        <div id="ground"  bg="<?php print $background; ?>" style="background: url(/<?php print $background; ?>) no-repeat 0px 0px; background-size: 100%;">
        	<?php foreach ($info_alineacion['players'] as $posicion) { 
            //dpm($info_alineacion['players']);
            if ($posicion['posicion'] != 'suplente') {
                //dpm($posicion);
          		if (!empty($posicion['id'])) { ?>
          			<div <?php if($fecha_actual >= $fecha_activa ){ ?> draggable="true" ondragend="reactive(event)"<?php } ?>posicion="<?php print $posicion['nombre_posicion']; ?>" class="player" id="<?php print $posicion['posicion']; ?>">
  		                <img class="img-player" posicion-unica="<?php print $posicion['nombre_posicion']; ?>" <?php if(!empty($posicion['id'])){ ?> jugador="<?php print $posicion['id']; ?>"<?php } ?> src="/<?php print $data['module_path'];?>/images/<?php print $posicion['camisa'];?>.png"/>
  		                <span class="star "></span> 
  		                <div class="player-info">
  		                    <span class="nombre"><?php print $posicion['nombre']; ?></span>
  		                    <span class="puntos"><?php if(!empty($posicion['puntos'])){  print $posicion['puntos']; }else{ ?> 0 <?php } ?></span>
  		                </div><?php if ($posicion['capitan'] == $posicion['id'] || $posicion['capitan']==1 ):?> <div class="capitan"></div> <?php else:?><div style="display:none"><?php print_r($posicion)?></div><?php endif;?>
                      <?php if (arg(2) == $_SESSION['fecha']) { ?>
                        <div class="acciones acciones-hide">
                          <span class="info-jugador" id="info-jugador1<?php print $posicion['id'];?>">info</span>
                          <span presupuesto="<?php print $posicion['presu_act']; ?>" fichaje="<?php print $posicion['n_fichajes']; ?>" alineacion="<?php print $posicion['alineacion'];?>" jugador="<?php print $posicion['key_jugador'];?>" posicion="<?php print $posicion['posicion']; ?>" class="vender-jugador">vender</span>
                          <span class="select-capitan" alineacion="<?php print $posicion['alineacion']; ?>" jugador="<?php print $posicion['id'];?>" >select</span>
                          <span class="alinear-jugador">alinear</span>
                          <span class="sacar-jugador">sacar</span>
                      </div>
                          <div class="show-info" id="info-jugador1<?php print $posicion['id']; ?>" >
                          <div class="Cerrar-info" id="Cerrar-info1<?php print $posicion['id']; ?>"></div>
                          <div class="container-info-gamer">
                            <div class="fotoJugador"></div>
                            <div></div>
                            <?php 
                            $player = entity_load_single('fichajes',$posicion['id']);
                              //dpm($player);


                            $total = 0;

                            $id_dayscore = $player->field_id_dayscore[LANGUAGE_NONE][0]['value'];

                            $uri = 'public://players/'.$id_dayscore.'.jpg';

                            $uri = 'public://players/'.$id_dayscore.'.jpg';
                            if (file_exists($uri)) {
                              $vars = array(
                              'style_name' => 'jugador_fichajes_102x102',
                              'path' => $uri,
                              );
                            $imagen = theme('image_style', $vars);
                            }else{
                              $imagen = '<img typeof="foaf:Image" src="/sites/all/themes/ligafantastica_omega/images/user-icon.jpg" width="105" height="105" style="max-width:105px;" alt="">';
                            }
                            $precioju = $player->field_precio[LANGUAGE_NONE][0]['value'];

                            ?>
                            <br/>
                            <div class="imagen-jugador-popup"><?php print $imagen; ?></div>
                              <div class="Nombre-Jugador">
                                <span class="Camiseta-Jugador">
                                  <img class="suplent" jugador="<?php print $posicion['id'];?>" src="/<?php print $data['module_path'];?>/images/<?php print $posicion['camisa'];?>.png" width="35" />
                              </span>
                              <strong><?php print $player->field_nombre[LANGUAGE_NONE][0]['value']; ?></strong>
                              <div class="posicion-jugador"><?php print $posicion['nombre_posicion']; ?></div>
                              <div class="Valor-Jugador"><strong>$ <?php print number_format($precioju);?></strong></div>
                              </div>
                            <br>
                            <div class="datos-deligas">
                                <table>
                                  <tbody><tr>
                                    <td>PUNTOS DE LIGA: </td>
                                    <td class="puntos-liga">-</td>
                                  </tr>
                                  <tr>
                                    <td>Puntos última fecha: </td>
                                    <td class="puntos-fecha">-</td>
                                  </tr>

                                  </tbody>
                                </table>
                            </div>
                          </div>
                          </div>
                      <?php } ?>
              		</div>

          		<?php }else{ ?>
          			<div  <?php if($fecha_actual >= $fecha_activa ){ ?> draggable="true" <?php } ?> posicion="<?php print $posicion['nombre_posicion']; ?>" class="player" id="<?php print $posicion['posicion']; ?>">
  		                <img class="img-player" src="/<?php print $data['module_path'];?>/images/player.png"/>
              		</div>

          		<?php } ?>
        		<?php } ?>
        	<?php } ?>
        </div>
</div>
<div class="suplencia-titulo">Mi Banquillo</div>
<div id="suplentes">
<?php
    $nSuplentes = 0;
    if(!$info_alineacion['players'])$info_alineacion['players'] = array();
    foreach ($info_alineacion['players'] as $posicion) { 
      if ($posicion['posicion'] == 'suplente') {
        //dpm($posicion);?>
        <div draggable="true" posicion="<?php print $posicion['nombre_posicion']; ?>" class="suplente img-player" id="<?php print $posicion['posicion'];?>">
            <img  posicion-unica="<?php print $posicion['nombre_posicion']; ?>" class="suplent img-player" jugador="<?php print $posicion['id'];?>" src="/<?php print $data['module_path'];?>/images/<?php print $posicion['camisa'];?>.png"/>
            <div class="player-info">
                <span class="nombre"><?php print $posicion['nombre'];?></span>
                <span class="puntos">0</span>
            </div>
            <div class="acciones">
                          <span class="info-jugador info-suple" id="info-jugador1<?php print $posicion['id'];?>">info</span>
                          <span presupuesto="<?php print $posicion['presu_act']; ?>" fichaje="<?php print $posicion['n_fichajes']; ?>" alineacion="<?php print $posicion['alineacion'];?>" jugador="<?php print $posicion['key_jugador'];?>" class="vender-jugador">vender</span>
                          <span class="select-capitan" alineacion="<?php print $posicion['alineacion']; ?>" jugador="<?php print $posicion['id'];?>" >select</span>
                          <span class="alinear-jugador">alinear</span>
                          <span class="sacar-jugador">sacar</span>
            </div>
            <div class="show-info" id="info-jugador1<?php print $posicion['id']; ?>" >
                          <div class="Cerrar-info" id="Cerrar-info1<?php print $posicion['id']; ?>"></div>
                          <div class="container-info-gamer">
                            <div class="fotoJugador"></div>
                            <div></div>
                            <?php 
                            $player = entity_load_single('fichajes',$posicion['id']);
                              //dpm($player);


                            $total = 0;

                            $id_dayscore = $player->field_id_dayscore[LANGUAGE_NONE][0]['value'];

                            $uri = 'public://players/'.$id_dayscore.'.jpg';
                            if (file_exists($uri)) {
                              $vars = array(
                              'style_name' => 'jugador_fichajes_102x102',
                              'path' => $uri,
                              );
                            $imagen = theme('image_style', $vars);
                            }else{
                              $imagen = '<img typeof="foaf:Image" src="/sites/all/themes/ligafantastica_omega/images/user-icon.jpg" width="105" height="105" style="max-width:105px;" alt="">';
                            }

                            
                            $precioju = $player->field_precio[LANGUAGE_NONE][0]['value'];

                            ?>
                            <br/>
                            <div class="imagen-jugador-popup"><?php print $imagen; ?></div>
                              <div class="Nombre-Jugador">
                                <span class="Camiseta-Jugador">
                                  <img class="suplent" jugador="<?php print $posicion['id'];?>" src="/<?php print $data['module_path'];?>/images/<?php print $posicion['camisa'];?>.png" width="35" />
                              </span>
                              <strong><?php print $player->field_nombre[LANGUAGE_NONE][0]['value']; ?></strong>
                              <div class="posicion-jugador"><?php print $posicion['nombre_posicion']; ?></div>
                              <div class="Valor-Jugador"><strong>$ <?php print number_format($precioju);?></strong></div>
                              </div>
                            <br>
                            <div class="datos-deligas">
                                <table>
                                  <tbody><tr>
                                    <td>PUNTOS DE LIGA: </td>
                                    <td class="puntos-liga">-</td>
                                  </tr>
                                  <tr>
                                    <td>Puntos de fecha: </td>
                                    <td class="puntos-fecha">-</td>
                                  </tr>

                                  </tbody>
                                </table>
                            </div>
                          </div>
                          </div>
        </div>

   <?php  
        $nSuplentes++;
        if($nSuplentes == 4) { 
        break; 
        } 
      }
    }

    if($nSuplentes < 4){
      while($nSuplentes <= 4){?>
        <div class="suplente" id="<?php print $nSuplentes;?>">
            <img src="/<?php print $data['module_path'];?>/images/player.png"/>
        </div>
    <?php  
        $nSuplentes++;
        if($nSuplentes == 4) { 
        break; 
        } 
      }
    }?>

</div>
<?php
if(true || $fecha_actual < $fecha_activa ){ ?>
<div class="guardar-compartir">
  <img src="/<?php print $data['module_path'];?>/images/alineacion-cerrada.png"/>
</div>
<?php
} else {?>
<div class="guardar-compartir">
  <?php $form = drupal_get_form('guardar_alineacion_form');
    print drupal_render($form);?>
</div>
<?php
}
?>
<ul class="convenciones">
    <li class="info">Información del jugador</li>
    <li class="vender">Vender</li>
    <li >Seleccionar como capitan</li>
    <!--<li class="alinear">Alinear como titular</li>
    <li class="sacar">Sacar de la titular</li>-->
</ul>
<div id="alineacionGuardada" style="display:none;">
            <p>¡Listo! alineación guardada, la puedes cambiar cuando quieras, o esperar a los resultados de la próxima fecha.</p>
</div>
<div id="vender" style="display:none;" title="">
<p>Estas seguro de vender este jugador.</p>
<a class="vender-si" href="#">Vender</a>
</div>
<div id="vendido" style="display:none;" title="">
<p>Jugador vendido satisfactoriamente.</p>
</div>
<div id="capitan" style="display:none;" title="">
<p>Capitan seleccionado satisfactoriamente.</p>
</div>
<div id="no" style="display:none;" title="">
<p>Este jugador no pertenece a esta posición.</p>
</div>
<script type="text/javascript">
// JavaScript Document

var dragSrcEl = null;

function handleDragStart(e) {
  // Target (this) element is the source node.
  //this.style.opacity = '0.4';
  //alert(this.id);
  dragSrcEl = this;

  var posicion = jQuery(this).attr('posicion');

  e.dataTransfer.effectAllowed = 'move';
  e.dataTransfer.setData('text/html', this.innerHTML);
  e.dataTransfer.setData('posicion', posicion);

}
function handleDragOver(e) {
  if (e.preventDefault) {
    e.preventDefault(); // Necessary. Allows us to drop.
  }

  e.dataTransfer.dropEffect = 'move';  // See the section on the DataTransfer object.

  return false;
}
function handleDragEnter(e) {
  // this / e.target is the current hover target.
  this.classList.add('over');
}

function handleDragLeave(e) {
  this.classList.remove('over');  // this / e.target is previous target element.
  if (e.preventDefault) {
    e.preventDefault(); // Necessary. Allows us to drop.
  }
}
function handleDrop(e) {
  // this/e.target is current target element.

    if (e.stopPropagation) {
    e.stopPropagation(); // Stops some browsers from redirecting.
  }
  if (e.preventDefault) {
    e.preventDefault(); // Necessary. Allows us to drop.
  }

  var posicion = e.dataTransfer.getData('posicion');

  var thisPosicion = jQuery(this).attr('posicion');

  if(thisPosicion != posicion){
    jQuery("#no").dialog({ modal: true, resizable: false });
  }else{
    jQuery('.suplentes .acciones').removeClass('acciones-hide');
      if (dragSrcEl != this) {
      // Set the source column's HTML to the HTML of the columnwe dropped on.
      dragSrcEl.innerHTML = this.innerHTML;
      this.innerHTML = e.dataTransfer.getData('text/html');
      console.log('hola');


              jQuery('.info-jugador').click(function(){
                jQuery('.player').css( "z-index","1" );
                jQuery(this).closest('.player').css( "z-index","1000" ); 
                    jQuery(".show-info").each(function() {
                       jQuery('.show-info1').css({'display':'none'});
                       jQuery('.show-info').css({'display':'none'});
                       jQuery('.show-info2').css({'display':'none'});
                    });
                    
                    jQuery(this).closest('.player').find(".show-info").fadeIn();    
                    
              });
                            jQuery('.info-suple').click(function(){
                jQuery('.player').css( "z-index","1" );
                jQuery(this).closest('.suplente').css( "z-index","1000" ); 
                    jQuery(".show-info").each(function() {
                       jQuery('.show-info1').css({'display':'none'});
                       jQuery('.show-info').css({'display':'none'});
                       jQuery('.show-info2').css({'display':'none'});
                    });
                    
                    jQuery(this).closest('.suplente').find(".show-info").fadeIn();    
                    
              });
jQuery('.Cerrar-info').click(function(){
                jQuery('.player').css( "z-index","1" );
                    jQuery('.show-info').fadeOut(100);
                  });
          
            jQuery('.show-info').css({'display':'none'});
            jQuery(".show-info1").each(function() {
                  jQuery('.show-info1').css({'display':'none'});
                   jQuery('.show-info').css({'display':'none'});
                   jQuery('.show-info2').css({'display':'none'}); 
            });

            jQuery(".vender-jugador").click(function(){
                    //jQuery("#vender").dialog({ modal: true, resizable: false });
                    var id =  jQuery(this).attr('jugador');
                    var aling =  jQuery(this).attr('alineacion');
                    var presu =  jQuery(this).attr('presupuesto');
                    var ficha =  jQuery(this).attr('fichaje');
                    var posicion = jQuery(this).attr('posicion');
                    console.log(posicion);
                    console.log(aling);

                    jQuery.ajax({
                           url: "/vender/jugador",
                           type: "post",
                           dataType: "json",
                           data: "id=" + id +"&aling="+aling+"&presu="+presu+"&ficha="+ficha+"&posicion="+posicion,                
                            success: function(rs)
                            {
                                jQuery("#vendido").dialog({ modal: true, resizable: false });
                                location.reload();
                            }
                        });  
              });

            jQuery(".select-capitan").click(function(){
                    //jQuery("#vender").dialog({ modal: true, resizable: false });
                    var id =  jQuery(this).attr('jugador');
                    var aling =  jQuery(this).attr('alineacion');
                    var idi =  jQuery(this).attr('id');
                    var alineado = jQuery( "#edit-formacion" ).val();
                    console.log(id);
                    console.log(aling);

                    jQuery(".star").removeClass('capitan');
                    jQuery( ".player" ).removeClass('capitan');

                    jQuery(this).addClass('capitan');
                    //jQuery(this).parent('.player').find('.star').addClass('capitan');

                    jQuery.ajax({
                           url: "/jugador/capitan",
                           type: "post",
                           dataType: "json",
                           data: "id=" + id +"&aling="+aling+"&alineado="+alineado,                
                            success: function(rs)
                            {
                                jQuery("#capitan").dialog({ modal: true, resizable: false });
                                location.reload();
                            }
                        });  
                    });

      
    }
}

  // Don't do anything if dropping the same column we're dragging.
  

  return false;
}
function handleDragEnd(e) {
  // this/e.target is the source node.
  [].forEach.call(cols, function (col) {
    col.classList.remove('over');
  });
}
var bg = jQuery( '#ground' ).attr("bg");
if(bg == 'sites/all/modules/custom/fichajes/images/bg.png'){
  var cols = document.querySelectorAll('#ground .player, #suplentes .suplente');
[].forEach.call(cols, function(col) {
  col.addEventListener('dragstart', handleDragStart, false);
  col.addEventListener('dragenter', handleDragEnter, false)
  col.addEventListener('dragover', handleDragOver, false);
  col.addEventListener('dragleave', handleDragLeave, false);
  col.addEventListener('drop', handleDrop, false);
  col.addEventListener('dragend', handleDragEnd, false);
});
}

function reactive(event){

}


jQuery(document).ready(function(e) {   
                    jQuery( '.show-info' ).css( "z-index","1000" );

              jQuery('.info-jugador').click(function(){
                jQuery('.player').css( "z-index","1" );
                jQuery(this).closest('.player').css( "z-index","1000" ); 
                    jQuery(".show-info").each(function() {
                       jQuery('.show-info1').css({'display':'none'});
                       jQuery('.show-info').css({'display':'none'});
                       jQuery('.show-info2').css({'display':'none'});
                    });
                    
                    jQuery(this).closest('.player').find(".show-info").fadeIn();    
                    
              });
                            jQuery('.info-suple').click(function(){
                jQuery('.player').css( "z-index","1" );
                jQuery(this).closest('.suplente').css( "z-index","1000" ); 
                    jQuery(".show-info").each(function() {
                       jQuery('.show-info1').css({'display':'none'});
                       jQuery('.show-info').css({'display':'none'});
                       jQuery('.show-info2').css({'display':'none'});
                    });
                    
                    jQuery(this).closest('.suplente').find(".show-info").fadeIn();    
                    
              });

          
            jQuery('.show-info').css({'display':'none'});
            jQuery(".show-info1").each(function() {
                  jQuery('.show-info1').css({'display':'none'});
                   jQuery('.show-info').css({'display':'none'});
                   jQuery('.show-info2').css({'display':'none'}); 
            });


              jQuery('.Cerrar-info').click(function(){
                jQuery('.player').css( "z-index","1" );
                    jQuery('.show-info').fadeOut(100);
                  });

            jQuery( "#edit-fecha" ).change(function () {
                var id = this.value;
                window.location.href = "/jugar/alineacion/"+id;
              });

            jQuery(".vender-jugador").click(function(){
                    //jQuery("#vender").dialog({ modal: true, resizable: false });
                    var id =  jQuery(this).attr('jugador');
                    var aling =  jQuery(this).attr('alineacion');
                    var presu =  jQuery(this).attr('presupuesto');
                    var ficha =  jQuery(this).attr('fichaje');
                    var posicion = jQuery(this).attr('posicion');
                    console.log(posicion);
                    console.log(aling);

                    jQuery.ajax({
                           url: "/vender/jugador",
                           type: "post",
                           dataType: "json",
                           data: "id=" + id +"&aling="+aling+"&presu="+presu+"&ficha="+ficha+"&posicion="+posicion,                
                            success: function(rs)
                            {
                                jQuery("#vendido").dialog({ modal: true, resizable: false });
                                location.reload();
                            }
                        });  
              });

            jQuery(".select-capitan").click(function(){
                    //jQuery("#vender").dialog({ modal: true, resizable: false });
                    var id =  jQuery(this).attr('jugador');
                    var aling =  jQuery(this).attr('alineacion');
                    var idi =  jQuery(this).attr('id');
                    var alineado = jQuery( "#edit-formacion" ).val();
//                    console.log(idjugador);
                    console.log(aling);

                    jQuery(".star").removeClass('capitan');
                    jQuery( ".player" ).removeClass('capitan');

                    jQuery(this).addClass('capitan');
                    //jQuery(this).parent('.player').find('.star').addClass('capitan');

                    jQuery.ajax({
                           url: "/jugador/capitan",
                           type: "post",
                           dataType: "json",
                           data: "id=" + id +"&aling="+aling+"&alineado="+alineado,                
                            success: function(rs)
                            {
                                jQuery("#capitan").dialog({ modal: true, resizable: false });
                                location.reload();
                            }
                        });  
                    });


           jQuery(".boton-guardar").mousedown(function() {

                    var ids = [];
                    jQuery(".player").find(".img-player").each(function(){ ids.push(jQuery(this).attr('jugador')); });
                    console.log(ids);
                    var posiciones = [];
                    jQuery(".player").each(function(){ posiciones.push(this.id); });
                    console.log(posiciones);

                jQuery.ajax({
                       url: "/guardar/posiciones",
                       type: "post",
                       dataType: "json",
                       data: "id=" + ids +"&posiciones="+posiciones,                
                        success: function(rs)
                        {
                            jQuery("#alineacionGuardada").dialog({ modal: true, resizable: false });
                            location.reload();
                        }
                    });  
            });

        
        
       
    jQuery( ".player" ).mouseenter(function() {
    jQuery( this ).css( "z-index","1000" );
    jQuery( this ).find( '.acciones' ).removeClass('acciones-hide');
    jQuery( this ).find( '.acciones' ).addClass('acciones-show');
  })
    .mouseleave(function() {
   
    jQuery( this ).find( '.acciones' ).removeClass('acciones-show');
    jQuery( this ).find( '.acciones' ).addClass('acciones-hide');
  });


    jQuery('body').find('.suplente-hide').hide();
    
    //Defining variables
    
    //Defining Ground Width and Height
    var groundWidth = 900;
    var groundHeight = 367;
    
    // Defining Ground Center
    var groundHorizontalCenter = groundWidth/2;
    var groundVerticalCenter = groundHeight/2;
    
    // Defining Ball Width and Height
    var ballWidth = 75;
    var ballHeight = 60;

    //4-4-2
        //Portero
        var izquierdaHorizontalPortero = groundWidth/3;
        var izquierdaVerticalPortero = groundHeight/3;
        //defensa 
            //izquierda
            var izquierdaHorizontalDefensa = 345; //top
            var izquierdaVerticalDefensa = groundHeight-340; //left
            //central
            var centroPrimeroHorizontalDefensa = -50;
            var centroPrimeroVerticalDefensa = 270;
            //-----
            var centroSegundoHorizontalDefensa = -40; 
            var centroSegundoVerticalDefensa = 250;
            //derecha
            var derechaHorizontalDefensa = groundWidth-270;
            var derechaVerticalDefensa = groundHeight-330;
        //Medio campo
            //defensivo
            var mcdHorizontalDefensa = -200;
            var mcdVerticalDefensa = 360;
            //mi
            var miHorizontalDefensa = groundWidth-130;
            var miVerticalDefensa = groundHeight-600;
            //md
            var mdHorizontalDefensa = groundWidth-130;
            var mdVerticalDefensa = groundHeight-570;
            //mco
            var mcoHorizontalDefensa = 520;
            var mcoVerticalDefensa = -380;
        //Delantera
            var diHorizontalDefensa = -460;
            var diVerticalDefensa = 605;
            //--
            var ddHorizontalDefensa = -470;
            var ddVerticalDefensa = 625;
            


    
    // Defining Ball Center
    var ballHorizontalCenter = ballWidth/2;
    var ballVerticalCenter = ballHeight/2;
    
    // Setting initial position of Ball
    jQuery("#ball").css("top", groundHeight-ballHeight + "px");
    jQuery("#ball").css("left", groundHorizontalCenter-ballHorizontalCenter + "px");    

    //---4-4-2---//

    //arquero
    jQuery("#po").css("top", "25%");
    jQuery("#po").css("left", "22%");

    //defensa
        //izquierdo
        jQuery("#dfi").css("top", "-20%");
        jQuery("#dfi").css("left", "343px");
        //central
        jQuery("#dfc1").css("top", "-18%");
        jQuery("#dfc1").css("left", "270px");
        //---
        jQuery("#dfc2").css("top", "-6%");
        jQuery("#dfc2").css("left", "250px");
        //Derecha
        jQuery("#dfd").css("top", "-3%");
        jQuery("#dfd").css("left", "300px");
    //Medio Campo
        //MCD
        jQuery("#mcd").css("top", "-57%");
        jQuery("#mcd").css("left", "360px");
        //mi
        jQuery("#mi").css("top", "-90%");
        jQuery("#mi").css("left", "49%");
        //md
        jQuery("#md").css("top", "-65%");
        jQuery("#md").css("left", "49%");
        //mco
        jQuery("#mco").css("top", "-106%");
        jQuery("#mco").css("left", "510px");
    //Delantera
        jQuery("#di").css("top", "-134%");
        jQuery("#di").css("left","605px");
        //--
        jQuery("#dd").css("top", "-122%");
        jQuery("#dd").css("left", "625px");
        
    // Assign Mouse Click Events to Buttons
    
    // Move Top
    jQuery( "#edit-formacion" ).change(function () {
                var id = this.value;
                var posicion_cambiante = jQuery('#mco').find('img').attr('posicion-unica');
                var alin = jQuery( "#edit-formacion" ).val();
              switch(id){
              	case '4-3-3':

                jQuery("#mco").attr("posicion","delantero");
                 if (posicion_cambiante == 'delantero') {
                    jQuery(".boton-guardar").removeAttr("disabled"); 
                    jQuery(".boton-guardar").css({'opacity':'1'});
                 }
                  if (posicion_cambiante == 'volante') {
                    jQuery(".boton-guardar").attr("disabled", "disabled");
                    jQuery(".boton-guardar").css({'opacity':'.5'});
                    jQuery("#no").dialog({ modal: true, resizable: false });
                 }
              	jQuery("#dfi").animate({top:"-20%", left:"40%"}, 1000);
	            	jQuery("#dfc1").animate({top:"-18%", left:"33%"}, 1000);
	            	jQuery("#dfc2").animate({top:"-6%", left:"31%"}, 1000);
	            	jQuery("#dfd").animate({top:"-3%", left:"38%"}, 1000);
	            	jQuery("#mcd").animate({top:"-57%", left:"46%"}, 1000);
	            	jQuery("#mi").animate({top:"-90%", left:"50%"}, 1000);
	            	jQuery("#md").animate({top:"-58%", left:"51%"}, 1000);
	            	jQuery("#mco").animate({top:"-103%", left:"63%"}, 1000);
	            	jQuery("#di").animate({top:"-134%", left:"65%"}, 1000);
	            	jQuery("#dd").animate({top:"-122%", left:"70%"}, 1000);
              	break;
              	case '4-4-2':
                if (posicion_cambiante == 'delantero') {
                    jQuery(".boton-guardar").attr("disabled", "disabled");
                    jQuery(".boton-guardar").css({'opacity':'.5'});
                    jQuery("#no").dialog({ modal: true, resizable: false });

                 }  
                 if (posicion_cambiante == 'volante') {
                    jQuery(".boton-guardar").removeAttr("disabled"); 
                    jQuery(".boton-guardar").css({'opacity':'1'});
                 } 
                jQuery("#mco").attr("posicion","volante");
              	jQuery("#dfi").animate({top:"-20%", left:"343px"}, 1000);
	            	jQuery("#dfc1").animate({top:"-18%", left:"270px"}, 1000);
	            	jQuery("#dfc2").animate({top:"-6%", left:"250px"}, 1000);
	            	jQuery("#dfd").animate({top:"-3%", left:"300px"}, 1000);
	            	jQuery("#mcd").animate({top:"-57%", left:"360px"}, 1000);
	            	jQuery("#mi").animate({top:"-90%", left:"49%"}, 1000);
	            	jQuery("#md").animate({top:"-65%", left:"49%"}, 1000);
	            	jQuery("#mco").animate({top:"-106%", left:"510px"}, 1000);
	            	jQuery("#di").animate({top:"-134%", left:"605px"}, 1000);
	            	jQuery("#dd").animate({top:"-122%", left:"625px"}, 1000);

              	break;
              }
    });

    jQuery("#btn-top").click(function(e){
        jQuery("#dd").animate({top:0 + "px", left:groundHorizontalCenter-ballHorizontalCenter + "px"}, 1000);
    });
    
    // Move Left
    jQuery("#btn-left").click(function(e){
        jQuery("#ball").animate({top:groundVerticalCenter-ballVerticalCenter + "px", left:0 + "px"}, 1000);
    });
    
    // Move Bottom
    jQuery("#btn-bottom").click(function(e){
        jQuery("#ball").animate({top:groundHeight-ballHeight + "px", left:groundHorizontalCenter-ballHorizontalCenter + "px"}, 1000);
    });
    
    // Move Right
    jQuery("#btn-right").click(function(e){
        jQuery("#ball").animate({top:groundVerticalCenter-ballVerticalCenter + "px", left:groundWidth-ballWidth + "px"}, 1000);
    });
    
});
</script>  
<style type="text/css">
.acciones-hide{
  display: none;
}
.acciones-show{
  display: block;
}

.info-jugador,
.vender-jugador,
.select-capitan,
.alinear-jugador,
.sacar-jugador{cursor:pointer;}

#page-wrap{
    margin-top:15px;
    width:900px;
    margin-right:auto;
    margin-left:auto;   
}

#title{
    font-family:Arial, Helvetica, sans-serif;
    text-align:center;
    font-size:24px;
    padding:10px;   
}

#ground{
width: 900px;
height: 367px;
/*background: url(/sites/all/modules/custom/fichajes/images/bg.png) no-repeat 0px 0px;*/
background-size: 100%;
}
.player img{
    cursor: move;
}

.suplente,
.player,
#ball
{
    width: 125px;
    position:relative;
    z-index: 0;
}

#control-panel{
    margin-top:20px;
    border:#333 thin solid;
    width:520px;
    padding:40px;
}

#control-panel .btn{
    border:#333 thin solid;
    float:left;
    width:20%;
    text-align:center;
    margin:2.0%;
    cursor:pointer;
}
#ground .player .player-info{
    font-size: 0.6em !important;
}


</style>