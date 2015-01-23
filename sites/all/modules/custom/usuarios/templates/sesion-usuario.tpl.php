<div id="block-system-user-menu-2" class="block block-system block-menu upper">
    <div class="content">
        <ul class="menu">
            <?php if(isset($data['nombre'])):?>
                <li class="first leaf"><span><?php print $data['uri']; ?></span></li>
                <li class="leaf">Hola: <span><?php print $data['nombre']; ?></span></li>
                <li class="leaf"><a href="/user/<?php print $data['uid']; ?>/edit">Mi Cuenta</a></li>
                <li class="last leaf"><a href="/user/logout" title="">Cerrar Sesión</a></li>
            <?php else:?>
               <!-- <li class="first leaf"><a href="/user/login" title="">Ingresar</a></li>
                <li class="last leaf"><a href="/user/register" title="">Registrarse</a></li>-->
            <?php endif;?>
        </ul> 
    </div>
</div>