<div class="block-equipo">
    <div class="row collapse">
        <div class="columns small-12">Valor de mi Equipo</div>
        <div class="total columns small-12">$<?php echo number_format($data["total"],0,",",".")?></div>
        <div class="columns small-12">
            <div class="count"><?php echo $data['count']?> <small>Jugador(es)</small></div>
        </div>
    </div>
    <a class="checkout" href="/jugar/alineaciones">Ver Equipo</a>
</div>
