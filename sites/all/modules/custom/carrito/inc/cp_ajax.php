<?php
/**
 * Created by PhpStorm.
 * User: jcorrego
 * Date: 26/03/15
 * Time: 9:28 PM
 */

/**
 * @param $page_callback_result
 */
function carrito_sell_ajax($page_callback_result) {
    if($page_callback_result=="OK")
        $html = '<p>Se ha vendido correctamente el jugador.</p>
                <div>
                    <a href="#" onclick="document.location.reload();" class="button columns success tiny">Aceptar</a>
                </div>
                <a onclick="document.location.reload();" class="close-reveal-modal">&#215;</a>';
    else
        $html = '<p>Ha ocurrido un error al agregar el jugador.</p>
                <div>
                    <a href="#" onclick="document.location.reload();" class="button alert tiny columns">Aceptar</a>
                </div>
                <a onclick="document.location.reload();" class="close-reveal-modal">&#215;</a>';
    print $html;
}

/**
 * @param $page_callback_result
 * "YA EXISTE", "AGREGADO", "EQUIPO", "LIMITE JUGADORES", "PRESUPUESTO"
 */
function carrito_add_player_ajax($page_callback_result) {
    if($page_callback_result=="AGREGADO")
        $html = '<p>Se ha agregado correctamente el jugador al carrito de compras.</p>
                <div>
                    <a href="/jugar/carrito" class="button columns tiny">Ir a procesar esta compra</a>
                    <a href="#" onclick="document.location.reload();" class="button columns success tiny">Continuar</a>
                </div>
                <a onclick="document.location.reload();" class="close-reveal-modal">&#215;</a>';
    else if($page_callback_result=="YA EXISTE")
        $html = '<p>El jugador ya se encuentra en su carrito de compras.</p>
                <div>
                    <a href="/jugar/carrito" class="button columns tiny">Ver carrito de compras</a>
                    <a href="#" onclick="document.location.reload();" class="button alert columns tiny">Continuar</a>
                </div>
                <a onclick="document.location.reload();" class="close-reveal-modal">&#215;</a>';
    else if($page_callback_result=="EQUIPO")
        $html = '<p>El jugador ya se encuentra en su equipo.</p>
                <div>
                    <a href="/jugar/alineaciones" class="button columns tiny">Ver mi equipo</a>
                    <a href="#" onclick="document.location.reload();" class="button alert columns tiny">Continuar</a>
                </div>
                <a onclick="document.location.reload();" class="close-reveal-modal">&#215;</a>';
    else if($page_callback_result=="LIMITE JUGADORES")
        $html = '<p>No puede agregar mas jugadores a su carrito de compras. Recuerde que hay un límite de 15 jugadores.</p>
                <div>
                    <a href="/jugar/alineaciones" class="button columns tiny">Ver mi equipo</a>
                    <a href="/jugar/carrito" class="button columns tiny">Ver carrito de compras</a>
                    <a href="#" onclick="document.location.reload();" class="button alert columns tiny">Continuar</a>
                </div>
                <a onclick="document.location.reload();" class="close-reveal-modal">&#215;</a>';
    else if($page_callback_result=="LIMITE FICHAJES")
        $html = '<p>No puede agregar mas jugadores. Recuerda que hay un límite de fichajes por fecha.</p>
                <div>
                    <a href="/jugar/alineaciones" class="button columns tiny">Ver mi equipo</a>
                    <a href="/jugar/carrito" class="button columns tiny">Ver carrito de compras</a>
                    <a href="#" onclick="document.location.reload();" class="button alert columns tiny">Continuar</a>
                </div>
                <a onclick="document.location.reload();" class="close-reveal-modal">&#215;</a>';
    else if($page_callback_result=="PRESUPUESTO")
        $html = '<p>No tiene dinero suficiente para agregar este jugador a su carrito de compras. </p>
                <div>
                    <a href="/jugar/alineaciones" class="button columns tiny">Ver mi equipo</a>
                    <a href="/jugar/carrito" class="button columns tiny">Ver carrito de compras</a>
                    <a href="#" onclick="document.location.reload();" class="button alert columns tiny">Continuar</a>
                </div>
                <a onclick="document.location.reload();" class="close-reveal-modal">&#215;</a>';
    else
        $html = '<p>Ha ocurrido un error al agregar el jugador.</p>
                <div>
                    <a href="#" onclick="document.location.reload();" class="button alert tiny columns">Aceptar</a>
                </div>
                <a onclick="document.location.reload();" class="close-reveal-modal">&#215;</a>';
    print $html;
}
/**
 * @param $page_callback_result
 */
function carrito_checkout_ajax($page_callback_result) {
    if($page_callback_result=="OK")
        $html = '<p>Todas las compras se han procesado correctamente.</p>
                <a
                <div>
                    <a href="#" onclick="document.location.reload();" class="button success tiny columns">Continuar</a>
                    <a href="/jugar/alineaciones" class="button tiny columns">Vamos a alinear estas compras!</a>
                </div>
                <a onclick="document.location.reload();" class="close-reveal-modal">&#215;</a>';
    else if($page_callback_result=="ERROR")
        $html = '<p>Ha ocurrido un error al procesar las compras.</p>
                <div>
                    <a href="#" onclick="document.location.reload();" class="button alert tiny columns">Aceptar</a>
                </div>
                <a onclick="document.location.reload();" class="close-reveal-modal">&#215;</a>';
    else
        $html = '<p>Ha ocurrido un error desconocido al procesar las compras.</p>
                <div>
                    <a href="#" onclick="document.location.reload();" class="button alert tiny columns">Aceptar</a>
                </div>
                <a onclick="document.location.reload();" class="close-reveal-modal">&#215;</a>';
    print $html;
}

/**
 * @param $page_callback_result
 */
function carrito_delete_player_ajax($page_callback_result) {
    if($page_callback_result=="ELIMINADO")
        $html = '<p>Jugador eliminado de su carro de compras.</p>
                <div>
                    <a href="#" onclick="document.location.reload();" class="button success tiny columns">Aceptar</a>
                </div>
                <a onclick="document.location.reload();" class="close-reveal-modal">&#215;</a>';
    else if($page_callback_result=="NO EXISTE")
        $html = '<p>El Jugador no se encuentra en su carro de compras.</p>
                <div>
                    <a href="#" onclick="document.location.reload();" class="button alert tiny columns">Aceptar</a>
                </div>
                <a onclick="document.location.reload();" class="close-reveal-modal">&#215;</a>';
    else
        $html = '<p>Ha ocurrido un error desconocido.</p>
                <div>
                    <a href="#" onclick="document.location.reload();" class="button alert tiny columns">Aceptar</a>
                </div>
                <a onclick="document.location.reload();" class="close-reveal-modal">&#215;</a>';
    print $html;
}