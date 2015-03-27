<div class="carrito">
    <div class="row collapse">
        <div class="data1 columns small-16 medium-8">
            <div class="columns small-16">Saldo disponible</div>
            <div class="total columns small-16">$<?php echo number_format($data["saldo"],0,",",".")?></div>
        </div>
        <div class="data2 columns small-16 medium-8">
            <div class="columns small-16">Valor carrito</div>
            <div class="total columns small-16">$<?php echo number_format($data["total"],0,",",".")?></div>
            <div class="columns small-5 text-right">
                <div class="basket right"></div>
            </div>
            <div class="columns small-11">
                <div class="count"><?php echo $data['count']?> <small>Jugador(es)</small></div>
            </div>
        </div>
        <div class="checkout columns small-16"><a href="/jugar/carrito">Ver Carrito</a></div>
    </div>
</div>
