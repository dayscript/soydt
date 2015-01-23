<?php 
//dpm($data);

if(!user_is_logged_in()){
	drupal_goto('<front>');
}

global $user;


  $datos = data_resultados();
$vars_escudo = array('style_name' => '100x100','path' => $datos['escudo']);


module_load_include('inc', 'node', 'node.pages');
$node_form = new stdClass;
$node_form->type = 'liga';
$node_form->language = LANGUAGE_NONE;
$form = drupal_get_form('liga_node_form', $node_form);

global $user;
$type = 'liga';
module_load_include('inc', 'node', 'node.pages');
$node = (object) array('uid' => $user->uid, 'name' => (isset($user->name) ? $user->name : ''), 'type' => $type, 'language' => LANGUAGE_NONE);
$form = drupal_get_form($type.'_node_form',$node);

?>
<div class="group-left">
	<div class="box-mis-ligas"><h2 class="nombre-equipo">Crear liga</h2><div class="form-league"><?php print drupal_render($form);?></div></div>
	<div class="mis-ligas">
		<h2 class="nombre-equipo">Mis ligas</h2>
			<?php print views_embed_view('ligas', 'block_1');?>
	</div>
</div>

<div class="group-right">
	<h2 class="block__title">Clasificación de ligas</h2>
	<?php print views_embed_view('ligas', 'block'); ?></div>

<style type="text/css">

</style>
<script type="text/javascript">
jQuery(document).ready(function(e) {
	jQuery('.unirse-pass').click(function(e){
		e.preventDefault();
		jQuery('.pass-form').hide();
		jQuery(this).closest('.views-field-unirse').find(".pass-form").fadeIn();   
	});
});
</script>

