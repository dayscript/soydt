<div class="agregar clearfix <?php echo ($data["disabled"]?"disabled":"")?>">
    <?php if($data["disabled"]):?>
        <a href="#">
            <div class="basket"></div> <div class="text"><?php echo $data["text"]?></div>
            <div class="columns small-16"><small><?php echo $data["subtext"]?></small></div>
        </a>
    <?php else:?>
        <a href="#" data-reveal-id="add-player" class="" data-reveal-ajax="/carrito/add/<?php echo $data["nid"]?>">
            <div class="basket"></div> <div class="text"><?php echo $data["text"]?></div>
            <div class="columns small-16"><small><?php echo $data["subtext"]?></small></div>
        </a>
    <?php endif?>
</div>
<div id="add-player" class="reveal-modal tiny" data-reveal data-options="close_on_background_click: false;" ></div>