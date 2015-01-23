<?php 
$datos = data_resultados();
$vars_escudo = array('style_name' => '100x100','path' => $datos['escudo']);

//dpm($datos);

?>
<div class="group-left">
<div class="datos-equipo">
    <div class="escudo"><?php if(!empty($datos['escudo'])){ print theme('image_style', $vars_escudo); }else{?> <img typeof="foaf:Image" src="/sites/default/files/default_images/escudo.png" width="100" height="100" style="max-width:105px;" alt=""> <?php } ?></div>
    <h2 class="nombre-equipo"><?php print $datos['nombre_equipo']; ?></h2>
    <div class="select-fecha">
    	<?php $form = drupal_get_form('mipuntaje_form');
      	print drupal_render($form);?>
    </div>
</div>
	<table class="views-table cols-4">
	    <thead>
	    	<tr>
	        	<th class="views-field views-field-counter">Pos.</th>
	            <th class="views-field views-field-field-nombre">Jugador</th>
	            <th class="views-field views-field-field-nombres"></th>
	            <th class="views-field views-field-points"> </th>
	    	</tr>
	    </thead>
	    <tbody>
	    	<?php 
	    	$total = 0;
	    	foreach ($datos['players'] as $key) { ?>
	    	<tr class="odd views-row-first">
	        	<td class="views-field views-field-counter"><?php print $key['posicion']; ?>.</td>
	            <td class="views-field views-field-field-nombre"><?php print $key['nombre']; ?></td>
	            <td class="views-field views-field-field-nombres"></td>
	            <td class="views-field views-field-points"><?php print $key['puntos']; ?></td>
	    	</tr>
	    	<?php 
	    	$total += $key['puntos'];
	    	} ?>
	    	<tr class="odd views-row-first"> 
	        	<td colspan="3" class="text-total">Total Fecha</td>
	        	<td class="count-total"><?php print $total; ?></td>
	    	</tr>
	    </tbody>
	</table>
</div>

<div class="group-right">
	<h2 class="block__title">Clasificaci&oacute;n General</h2>
  <div class="select-fecha2">
  	<?php $form =drupal_get_form('rankinggeneral_form');
    	print drupal_render($form);?>
  </div>
  <?php if(isset($_GET['t']) && $_GET['t']==7176):?>
  	<?php print views_embed_view('resultados', 'block_1'); ?></div>
  <?php elseif(isset($_GET['t']) && $_GET['t']==7177):?>
  	<?php print views_embed_view('resultados', 'block_2'); ?></div>
  <?php elseif(isset($_GET['t']) && $_GET['t']==7178):?>
  	<?php print views_embed_view('resultados', 'block_3'); ?></div>
  <?php elseif(isset($_GET['t']) && $_GET['t']==7346):?>
  	<?php print views_embed_view('resultados', 'block_4'); ?></div>
  <?php elseif(isset($_GET['t']) && $_GET['t']==7347):?>
  	<?php print views_embed_view('resultados', 'block_5'); ?></div>
  <?php elseif(isset($_GET['t']) && $_GET['t']==7348):?>
  	<?php print views_embed_view('resultados', 'block_6'); ?></div>
  <?php elseif(isset($_GET['t']) && $_GET['t']==7349):?>
  	<?php print views_embed_view('resultados', 'block_7'); ?></div>
  <?php elseif(isset($_GET['t']) && $_GET['t']==7350):?>
  	<?php print views_embed_view('resultados', 'block_8'); ?></div>
  <?php elseif(isset($_GET['t']) && $_GET['t']==7351):?>
  	<?php print views_embed_view('resultados', 'block_9'); ?></div>
  <?php elseif(isset($_GET['t']) && $_GET['t']==7358):?>
  	<?php print views_embed_view('resultados', 'block_10'); ?></div>
  <?php elseif(isset($_GET['t']) && $_GET['t']==7359):?>
  	<?php print views_embed_view('resultados', 'block_11'); ?></div>
  <?php else:?>
  	<?php print views_embed_view('resultados', 'block'); ?></div>
	<?php endif?>

<script type="text/javascript">
/*jQuery(document).ready(function(e) {
	jQuery('.views-field-field-nombre').css({'text-transform':'capitalize'});
});*/
jQuery(document).ready(function(e) {
  jQuery( "#edit-fecha" ).change(function () {
      var id = this.value;
      window.location.href = "/jugar/resultados/"+id;
    });  
  jQuery( "#edit-fecha--2" ).change(function () {
      var id = this.value;
      window.location.href = "/jugar/resultados/<?php echo arg(2)?>?t="+id;
    });  
});
</script>