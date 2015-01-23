<?php
drupal_add_library('system', 'ui.dialog');

?>
<script>
/*
jQuery(document).ready(function(){
    jQuery('#edit-submit').click(function(){

        jQuery('#equipoCreado').dialog({ modal: true, resizable: false });
       alert('click');
   });
});*/
</script>
<div id="bloque-mi-carrito" class="block bloque-mi-carrito upper">
    <div class="content">
        <span class="presupuesto"></span>
        <a href="#" class="checkout">Ir al carrito</a>
        <div class="fichajes"><span class="nro-fichajes"><?php print $data['fichajes']; ?></span><p>Vacantes </p></div>
        <div class="total-fichajes"><span class="ttl-fichajes"><?php print $data['total_fichajes']; ?></span><p>Valor de mi equipo</p></div>
        <a href="/jugar/fichajes<?php print $data['Links']; ?>" class="bt-confirmar"><?php print $data['texto_link']; ?></a>
    </div>
</div>
<div id="enAlineacion" style="display:none;">
    <p>Este jugador ya se encuentra en tu alineación.</p>
</div>
<div id="enCarrito" style="display:none;">
    <p>Este jugador ya se encuentra en tu carrito.</p>
</div>
<div id="sinFichajes" style="display:none;">
    <p>No tienes mas fichajes.</p>
</div>
<div id="sinPresupuesto" style="display:none;">
    <p>Presupuesto Insuficiente.</p>
</div>
<div id="equipoCreado" style="display:none;">
    <p>Ya tienes un equipo ya puedes fichar jugadores.</p>
</div>