<div id="checkout">
    <div class="columns small-6 text-right">
        <div class="subheader">Si esta seguro que desea comprar estos jugadores, haga click a continuación.</div>
    </div>
    <div class="columns small-6">
        <div class="clearfix">
            <label class="left">Valor de la compra</label>
            <div class="text-blue right">$<?php echo number_format($data["total"],0,",",".")?></div>
        </div>
        <div class="clearfix">
            <label class="left">Saldo disponible</label>
            <div class="text-blue right">$<?php echo number_format($data["saldo"],0,",",".")?></div>
        </div>
        <?php if($data["total"]>0):?>
            <a href="#" data-reveal-id="checkout-popup" data-reveal-ajax="/carrito/checkout" class="columns button small success">Comprar</a>
        <?php endif?>
    </div>
</div>
<div id="checkout-popup" class="reveal-modal tiny" data-reveal data-options="close_on_background_click: false;" >
</div>