      <?php
global $user;
//dpm($_SESSION['lists']);
drupal_add_library('system', 'ui.dialog');
drupal_add_js('

	jQuery(document).ready(function(){
			jQuery(".boton-comprar").mousedown(function(){
                       jQuery("#dialog").dialog({ modal: true });
                    });

});', 'inline');
$total_fichajes = 0;
   $total_carrito = 0;
   $query = db_select('node', 'n');
    $query->fields('n', array('nid'))
        ->condition('n.type', 'alineaci_n')
        ->condition('n.uid', $user->uid);
    $result = $query->execute();
    $alineacion = $query->execute()->fetchField();

    $alineados = 0;
    if(empty($_SESSION['lists'])){
      drupal_goto('/jugar/fichajes');
      $players_oncart = 0;
      $total_carrito = 0;
//      dpm($_SESSION);
    }else{
      foreach ($_SESSION['lists'] as $key) {
        $player_oncart = entity_load_single('fichajes', $key);
        //dpm($player_oncart);
        $precio_player_oncart = $player_oncart->field_precio[LANGUAGE_NONE][0]['value'];
        //dpm($precio_player_oncart);
        $total_carrito += $precio_player_oncart;
      }
    $players_oncart = count($_SESSION['lists']);
   }
    if(empty($alineacion)) {
          $tipo = 'nuevo';
          $fichajes = '15' - $players_oncart;
          $presupuesto = '500000000' - $total_carrito;
          $total_fichajes = $total_carrito;
        }else{

            $tipo ='actualizar';

            while($record = $result->fetchAssoc()) {
             $alineacion = node_load($record['nid']);
             //$datos['fichajes'] = $alineacion->field_n_fichajes[LANGUAGE_NONE][0]['value'];
             $ficha_restantes = $alineacion->field_n_fichajes[LANGUAGE_NONE][0]['value'];
             $presupuesto = $alineacion->field_dinero[LANGUAGE_NONE][0]['value'];
             $jugadores = $alineacion->field_jugadores[LANGUAGE_NONE];
             foreach ($jugadores as $jugador) {
               //dpm($jugador['target_id']);
               $play = entity_load_single('fichajes', $jugador['target_id']);
               $precioPlayer = $play->field_precio[LANGUAGE_NONE][0]['value'];
               $total_fichajes += $precioPlayer;
               //dpm($play);
               $alineados++;
             }
             $fichajes = $ficha_restantes - $players_oncart;
             
               //dpm($alineacion);
          }
          $total_fichajes = $total_fichajes + $total_carrito;
          $presupuesto = $presupuesto - $total_carrito;
        }
?>
<div class="l-content">
  <p class="message">Recuerda que no hay un mínimo de jugadores para disputar cada fecha, pero debes tener presente que cada jornada la cantidad de fichas si está limitada.</p>
  <div class="presupuesto">
    <div class="fichajes"><?php print $fichajes; ?><span>fichajes</span></div>
    <div class="presupuesto-restante"><?php print number_format($presupuesto); ?></div>
  </div>
  <table>
    <thead>
      <tr>
        <th>Eliminar</th>
        <th>Jugador</th>
        <th>Precio</th>
      </tr>
    </thead>
    <tbody>
    <?php 
    	$total = 0;
  	foreach ($_SESSION['lists'] as $jugador) {
  		$jugador_data = entity_load_single('fichajes', $jugador);
  		
  		$id_dayscore = $jugador_data->field_id_dayscore[LANGUAGE_NONE][0]['value'];
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

          $posicionId = $jugador_data->field_posici_n[LANGUAGE_NONE][0]['value'];
          switch ($posicionId) {
              case 1:
                  $posicion = "Arquero";
                  break;
              case 2:
                  $posicion = "Defensa";
                  break;  
              case 3:
                  $posicion = "Volante";
                  break;  
              case 4:
                  $posicion = "Delantero";
                  break;
              default:
                  # code...
                  break;
          }
          ?>
          <tr>
  	      <td class="eliminar-jugador"><?php
            $pres_fichar = $presupuesto + $jugador_data->field_precio[LANGUAGE_NONE][0]['value'];
            $player_data = array('jugador' => $jugador , 'presupuesto' => $pres_fichar);
           print drupal_render(drupal_get_form('eliminar_jugador_form', $player_data));?></td>
  	      <td>
  	      	<div class="imagen-jugador"><?php print $imagen; ?></div>
  	      	<p class="nombre-jugador"><?php print $jugador_data->field_nombre[LANGUAGE_NONE][0]['value']; ?></p>
  	      	<p class="posicion-jugador"><?php print $posicion; ?></p>
  	      	<p class="precio-jugador"></p>
  	      </td>
  	      <td>$<?php print number_format($jugador_data->field_precio[LANGUAGE_NONE][0]['value']); ?></td>
  	    </tr>
  	<?php
  		$total += $jugador_data->field_precio[LANGUAGE_NONE][0]['value'];
  		}
  	?>
    </tbody>
    <tfoot>
      <tr>
        <td>Total</td>
        <td id="total">$<?php print number_format($total); ?></td>
      </tr>
    </tfoot>
  </table>
  <div id="acciones">
  <?php 
    print l('Seguir Comprando', 'jugar/fichajes', array('attributes' => array('class' => 'boton-continuar')));
    $cart_data = array('fichajes' => $fichajes , 'presupuesto' => $presupuesto, 'tipo' => $tipo);
    print drupal_render(drupal_get_form('checkout_jugador_form',$cart_data));?>
  </div>
</div>
<div id="dialog" style="display:none;" title="">
<p>Tus jugadores han sido fichados. Ahora puedes alinear tu equipo.</p>
<a href="/jugar/alineacion/<?php print $_SESSION['fecha'];?>">Ir a alineación</a>
</div>
<script type="text/javascript">

        jQuery('.boton-eliminar').each(function(){
                    var player = jQuery(this).closest('tr');
                    jQuery(this).mousedown(function(){
                        jQuery( player ).slideUp();
                        return false;
                    });
    });
</script>