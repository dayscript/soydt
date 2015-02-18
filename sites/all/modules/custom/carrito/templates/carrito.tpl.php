<div class="carrito">
    <div class="row collapse">
        <div class="data1 columns small-12 medium-6">
            <div class="columns small-12">Saldo disponible</div>
            <div class="total columns small-12">$<?php echo number_format($data["saldo"],0,",",".")?></div>
        </div>
        <div class="data2 columns small-12 medium-6">
            <div class="columns small-12">Valor carrito</div>
            <div class="total columns small-12">$<?php echo number_format($data["total"],0,",",".")?></div>
            <div class="columns small-3 text-right">
                <div class="basket right"></div>
            </div>
            <div class="columns small-9">
                <div class="count"><?php echo $data['count']?> <small>Jugador(es)</small></div>
            </div>
        </div>
    </div>
    <a class="checkout" href="/jugar/carrito">Ver Carrito</a>
</div>
